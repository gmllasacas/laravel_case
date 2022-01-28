# Requirements

- A PHP 7.4.x enviroment
- MySQL installed
- [git](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git)

# Installation

1. Clone the repository
```
git clone https://github.com/gmllasacas/laravel_backend_case.git
```

2. Setup environment

Copy .env.example to .env and modify it as needed

3. Run the migration and seed the database

```
php artisan migrate:fresh --seed
```

4. Generate the key

```
php artisan key:generate
```

5. API tests

Import the postman collection and enviroment for the API test.

- The collection: documents/postman/laravel_case.postman_collection
- The enviroment: documentos/postman/laravel_case-local.postman_environment.json

Define the correct url-api-v1 for the enviroment and select the enviroment on postman.

6. Tests

```
php artisan test
```

7. Done

- Endpoints for create and list

8. TODO
- Add the crawler to retrieve the title

