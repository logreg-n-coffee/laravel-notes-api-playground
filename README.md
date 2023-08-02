# Larvel Notes API Playground

## Steps

1. Set Local Test Environment

    Install Dependencies

    - Install [Docker](https://docs.docker.com/get-docker/)
    - Install [Composer](https://getcomposer.org/download/)
    - Install [Laravel](https://laravel.com/docs/10.x/installation)

    Setup
    - Build Docker Database Container with MySQL

        ```bash
        docker run --name mysql -d -p 3306:3306 -e MYSQL_ALLOW_EMPTY_PASSWORD=yes --restart unless-stopped mysql:latest

        --OR--

        docker run --name mysql -e MYSQL_ROOT_PASSWORD=secret -d mysql:latest
        ```

    - Prepare a database for use in Docker, so we do not need to modify the `.env` file

        ```bash
        docker exec -it mysql bash

        mysql -u root -p

        CREATE DATABASE laravel;
        ```

    - Run `composer install`. If you prefer to initialize a new Laravel project, run the following command:

        ```bash
        composer create-project --prefer-dist laravel/laravel notes-api-playground
        ```

2. Build `Note` Model, Controller, Migration, etc.

    Run `php artisan make:model Note --all`. This will create the following files:

    ```bash
       Model [app/Models/Note.php]
       Factory [database/factories/NoteFactory.php]
       Migration [database/migrations/2023_08_01_230125_create_notes_table.php]
       Seeder [database/seeders/NoteSeeder.php]
       Request [app/Http/Requests/StoreNoteRequest.php]
       Request [app/Http/Requests/UpdateNoteRequest.php]
       Controller [app/Http/Controllers/NoteController.php]
       INFO  Policy [app/Policies/NotePolicy.php]
   ```

    Run `php artisan migrate`

## How to use

- Run `php artisan migrate`
- Run `php artisan serve`

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
