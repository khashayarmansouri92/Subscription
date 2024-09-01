<?php

use App\Enums\Platform\TypeEnum;
use App\Enums\Subscription\StatusEnum;
use App\Jobs\CheckSubscriptionStatusJob;
use App\Models\Subscription;
use App\Notifications\SubscriptionExpiredNotification;
use App\Services\Subscription\SubscriptionServiceInterface;
use App\Traits\InteractsWithExpiredSubscription;
use App\Traits\InteractsWithSubscription;
use App\Traits\InteractsWithUser;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

class SubscriptionService implements SubscriptionServiceInterface
{
    use InteractsWithSubscription, InteractsWithUser, InteractsWithExpiredSubscription;

    /**
     * @return void
     * @throws Exception
     */
    public function sync(): void
    {
        $subscriptions = $this->SubscriptionRepository()->findByKeyNotValue(['status' => StatusEnum::EXPIRED->value]);

        foreach ($subscriptions as $subscription) {
            $app = $subscription->app;
            $platform = $app->platform;

            try {
                $response = $this->checkSubscriptionStatus($platform->name, $subscription);
                $this->updateSubscriptionStatus($subscription, $response);
            } catch (Exception $e) {
                $message = __('messages.subscription_sync_failed', [
                    'id' => $subscription->id,
                    'error' => $e->getMessage(),
                ]);
                Log::error($message);
            }
        }
    }

    /**
     * @param string $platform
     * @param Subscription $subscription
     * @return array|mixed|null
     * @throws Exception
     */
    protected function checkSubscriptionStatus(string $platform, Subscription $subscription): mixed
    {
        $url = $this->getPlatformUrl($platform, $subscription);

        $response = Http::get($url);

        if ($response->failed()) {
            $delay = $platform === TypeEnum::ANDROID->value ? config('retry_android') : config('retry_iOS');
            $this->scheduleRetry($subscription, $delay);
            return null;
        }

        $data = $response->json();

        if ($platform === TypeEnum::ANDROID->value && isset($data['status'])) {
            return $data['status'];
        }

        if ($platform === TypeEnum::IOS->value && isset($data['subscription'])) {
            return $data['subscription'];
        }

        throw new Exception(Lang::get('custom.unexpected_response_format', [
            'platform' => $platform,
            'id' => $subscription->id,
        ]));
    }

    /**
     * @param string $platform
     * @param Subscription $subscription
     * @return string
     * @throws Exception
     */
    protected function getPlatformUrl(string $platform, Subscription $subscription): string
    {
        return match ($platform) {
            'android' => config('url_android') . $subscription->id,
            'iOS' => config('url_iOS') . $subscription->id,
            default => throw new Exception(__('messages.unknown_platform', ['platform' => $platform])),
        };
    }

    /**
     * @param Subscription $subscription
     * @param int $delay
     * @return void
     * @throws Exception
     */
    protected function scheduleRetry(Subscription $subscription, int $delay): void
    {
        $this->SubscriptionRepository()->update($subscription, ['status' => StatusEnum::PENDING->value]);
        CheckSubscriptionStatusJob::dispatch($subscription)->delay($delay);
    }

    /**
     * @param Subscription $subscription
     * @param array|null $response
     * @return void
     * @throws Exception
     */
    protected function updateSubscriptionStatus(Subscription $subscription, ?array $response): void
    {
        if (!$response) {
            throw new BadFunctionCallException();
        }

        $newStatus = $response['status'] ?? $response['subscription'] ?? null;

        if ($newStatus && $newStatus !== $subscription->status) {

            if ($subscription->status === StatusEnum::ACTIVE->value && $newStatus === StatusEnum::EXPIRED->value) {
                $this->notifyAdmin($subscription);
                $this->incrementExpiredSubscriptionCount();
            }

            $this->SubscriptionRepository()->update($subscription, ['status' => $newStatus]);
        }
    }

    /**
     * @return void
     * @throws Exception
     */
    protected function incrementExpiredSubscriptionCount(): void
    {
        $this->SubscriptionRepository()->ExpiredSubscriptionCount();
    }

    /**
     * @param Subscription $subscription
     * @return void
     * @throws Exception
     */
    protected function notifyAdmin(Subscription $subscription): void
    {
        $admin = $this->UserRepository()->getAdmin();

        $admin->notify(new SubscriptionExpiredNotification($subscription));
    }
}
