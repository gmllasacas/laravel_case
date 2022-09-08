# Core requirements 

- Create a POST endpoint that receives as a body param the URL to shorten and it returns as part of the response an URL with the shortest possible length.
- Use background/async jobs to crawl the URL that is shortened, pull the title from the website, and store it.
- Create a route to get redirected to the original URL from the shortened URL, i.e From https://localhost:3000/a -> https://en.wikipedia.org/wiki/Site
- Create a GET endpoint that returns the top 100 URLs most frequently accessed, including the title crawled from step 2.

# Requirements

- A PHP 7.4.x environment
- MySQL installed
- [git](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git)

# Installation

1. Clone the repository
```
git clone https://github.com/gmllasacas/url_shortener_api.git
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

#Execution 

5. API tests

Import the postman collection and environment for the API test.

- The collection: documents/postman/laravel_case.postman_collection
- The environment: documents/postman/laravel_case-local.postman_environment.json

Define the correct url-api-v1 for the environment and select the environment on postman.

6. Tests

```
php artisan test
```

7. TODO

- Create a GET endpoint that returns the top 100 URLs most frequently accessed, including the title crawled from step 2.
