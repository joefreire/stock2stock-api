# stock2stock-api
 
Stock2Stock api project as requested by Chris Sohn

API project using PHP with Lumen and SQLite I chose Lumen because it is a micro framework that uses the principles of SOLID and with a fast development.

# Requiriments
- PHP >= 7.3
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- SQLite PHP Extension

# Installation
```bash
composer install
cp .env.example .env
php artisan migrate
php -S localhost:8000 -t public
```
# Usage

The API was documentated using POSTMAN and can be used by the file
Stock2Stock_test Collection.postman_collection
or can be consulted by the url
https://documenter.getpostman.com/view/3587714/Uyxoi4jV

## License
[MIT](https://choosealicense.com/licenses/mit/)
