1- create .env file in main root of project
2- please copy contents in .env.example and past into .env
1- docker-compose build app
2- docker-compose up -d
3- docker-compose exec app php artisan migrate:fresh --seed
