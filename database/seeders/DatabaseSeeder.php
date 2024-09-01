<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\App;
use App\Models\Platform;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\Subscription;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        $iosPlatform = Platform::create(['name' => 'iOS']);
        $androidPlatform = Platform::create(['name' => 'Android']);

        $apps = [];
        for ($i = 1; $i <= 10; $i++) {
            $apps[] = App::create([
                'name' => 'iOS App ' . $i,
                'platform_id' => $iosPlatform->id,
            ]);
        }

        for ($i = 1; $i <= 10; $i++) {
            $apps[] = App::create([
                'name' => 'Android App ' . $i,
                'platform_id' => $androidPlatform->id,
            ]);
        }

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password')
        ]);
        $admin->roles()->attach($adminRole->id);

        for ($i = 1; $i <= 20; $i++) {
            $user = User::create([
                'name' => 'User ' . $i,
                'email' => 'user' . $i . '@example.com',
                'password' => Hash::make('password')
            ]);

            $user->roles()->attach($userRole->id); // Assign user role

            $randomApp = $apps[array_rand($apps)];
            Subscription::create([
                'user_id' => $user->id,
                'platform_id' => $randomApp->platform_id,
                'status' => 'active',
                'checked_at' => now(),
            ]);

            $user->apps()->attach($randomApp->id);
        }
    }
}
