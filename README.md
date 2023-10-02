# DATABASE SEEDER MIGRATIONS

php artisan make:seeder UsersTableSeeder
php artisan make:seeder CategoriesTableSeeder
php artisan make:seeder AdsTableSeeder

php artisan db:wipe && php artisan migrate && php artisan db:seed && cls && php artisan serve

git add . && git commit -m "commit 10" && git branch -M main && git push -u origin main


# API ENDPOINT
## php artisan route:list --path=api > api_routes_list.txt
