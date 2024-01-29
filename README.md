# PlayTrivial Laravel Console Command

This Laravel console command allows users to play a Trivial game by interacting with the command line.

## Requirements

- Laravel 10.x
- PHP 8.3
- Docker

## Installation

1. Clone the repository to your local machine:

    ```bash
    git clone https://github.com/khashayarmansouri92/TrivialGame.git
    ```

2. Set up your environment variables by copying the `.env.example` file:

    ```bash
    cp .env.example .env
    ```

   Update the `.env` file with your database and other configurations.

3. Generate the application key:

    ```bash
    php artisan key:generate
    ```

4. Build and run the Docker containers:

    ```bash
    docker-compose up -d --build
    ```

5. Access the Docker container shell:

    ```bash
    docker exec -it <container-name> sh
    ```

6. Migrate the database:

    ```bash
    php artisan migrate
    ```

## Usage

Run the Trivial game console command:

```bash
docker exec -it <container-name> php artisan trivial:play
