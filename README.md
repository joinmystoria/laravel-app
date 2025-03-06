This is a simple CRUD using Php Laravel & postgreSQL with PhpUnit test.

Note:

- When cloning on local run the ff cmd:
* composer install
* php artisan key:generate
* php artisan migrate 
* php artisan migrate:reset (If you wanna delete previous migration)
* php artisan migrate:status (Checking the list of migrations)


- CMD for local run:
* php artisan serve

- Local DB Configuration is under .env
- CMD For running PhpUnit test:
* php artisan make:factory NameFactory --model=Name
* php artisan migrate --env=testing
* php artisan test

- Helpful cmd:
* php artisan db:wipe (Deleting DB During Unit Test)
