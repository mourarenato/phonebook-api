# Installation

Get started with Makefile:

1. Run `make fileMode`
2. Certify your `.env` is configured correctly
2. Run `make install`
3. Run `docker exec -it php-phonebook-api bash -c "php artisan jwt:secret"`
4. Run `make migrate`
5. Run `seed-db` to feed database (optional)

# Project information

This project is a simple Rest API for register numbers in a phonebook. Here is used PHP with Laravel framework.

# Using the project

- `Create a user`:

Endpoint(POST): http://10.10.0.22/api/signup

    {
        "email": "myemail@email.com",
        "password": "mypassword",
    }

- `After you must authenticate to get your bearer token`:

Endpoint(POST): http://10.10.0.22/api/signin

    {
        "email": "myemail@email.com",
        "password": "mypassword",
    }

Example of response: "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6W3siaWQiOjEsImVtYWlsIjoibXllbWFpbEBlbWFpbC5jb20iLCJwYXNzd29yZCI6IjQ3MGUzNzVhMmMyZjIxZWMyYTVhZDhjNTRiMTliYjc4YzA5YWRmNWFlZGEwODc4ZWY5N2VjNWRjMDRjNWU5MDQifV0sImlhdCI6MTY0NTg0MzAwOSwiZXhwIjoxNjQ1OTI5NDA5fQ.cESM6lySYrtmMXXTvjXuNd1lrKfM0eqzXND6eHPfkJg"

- `Now you are logged and can access others endpoints`:


`To create a record`, send request (POST) to URL http://10.10.0.22/api/phonebook/create in Postman (or another) with your bearer token

Example of request:

    {
        "name": "Joseph Lee",
        "email": "josephlee@email.com",
        "birthdate": "21/03/1998",
        "cpf": "236.486.430-53",
        "phones": {"1": "(21)98005-6578", "2": "(48)3235-7890", "3": "(14)3436-5779", "4": "(21)97678-9096"}
    }


`To update a record`, send request (UPDATE) to URL http://10.10.0.22/api/phonebook/update in Postman (or another) with your bearer token

Example of request:

    {
        "name": "Joseph Mee",
        "email": "josephlee@email.com",
        "birthdate": "21/03/1999",
        "cpf": "236.486.430-53",
        "phones": {"1": "(21)98005-6578", "2": "(48)3235-7890", "3": "(14)3436-5779", "4": "(21)97678-9096"}
    }


`To delete a record`, send request (DELETE) to URL http://10.10.0.22/api/phonebook/delete in Postman (or another) with your bearer token

Example of request:

    {
        "email": "josephlee@email.com",
    }


`To export a report`:

1. Run `php artisan queue:work"` in your php container
2. Send request (POST) to URL http://10.10.0.22/api/phonebook/export in Postman (or another) with your bearer token
3. The file is available in `public/files`


