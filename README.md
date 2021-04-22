1. please pull again
2. cd into the root of the backend project
3. create .env file in the main root of the project(cp .env.example .env)
4. docker-compose exec app composer update -vvv
5. docker-compose build app
6. docker-compose up -d
7. docker-compose exec app php artisan migrate:fresh --seed
