1. cd into the root of the backend project
2. create .env file in the main root of the project(cp .env.example .env)
3. docker-compose exec app composer update -vvv
4. docker-compose up -d
5. Go to db container by the following steps:
    * docker-compose exec db bash
    * mysql -utilapila -p123456789
    * create "tilapila" database
7. docker-compose exec app php artisan migrate:fresh --seed
