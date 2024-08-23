# Laravel Products API

Products Management API made with [Laravel](https://laravel.com/)

## Sumary
- [How to setup the project](./README.md#how-to-setup-the-project)
- [Startup process](./README.md#startup-process)
- [API Documentation](./README.md#api-documentation)
- [DB Schema](./README.md#db-schema)
- [Testing the API](./README.md#testing-the-api)
- [Goals](./README.md#goals)

## How to setup the project

The setup is made entirely by **Docker**, with `./docker-compose.yml` and `./src/startup.sh` files, so you can start the project with:

```
docker compose up -d
```

It's also possible to change some configutations using docker compose args:
- `ENV` = Project enviroment, use `ENV=production` with you whant to run with laravel production mode. Default value is `local`
- `API_PORT` = is the port where de API is exposed. Default value is `8016`
- `DB_PORT` = is the port where de DB is exposed. Default value is `3316`
- `DB_PW` = is the mysql DB password. Default value is `password`

You can use one or more args as you wish, like in the example below:

```
ENV=production API_PORT=8000 DB_PORT=3306 DB_PW=mysql_password docker compose up -d
```

> [!NOTE]
> Keep in mind the once the project is first started, the DB configs are not dynamically changed.
> So if there is the need to update the DB **password**, just changing the docker's arg may not work.

## Startup process

When docker compose in ran, the `./src/startup.sh` script makes some verifications:
1. Does the `vendor` folder exists? if not, run `compose install`
2. Does `.env` file exists? if not, create new one based on `.env.example` and run `php artisan key:generate`
3. Does de `ENV`arg equals to `production`? if so, change `.env` params to production mode
4. If it is the first time running the script, run `php artisan migrate --force` and `php artisan db:seed --force`
5. Finally, run `php artisan serve --host=0.0.0.0`

## API Documentation

### Scramble

The documentation was made using [Scramble](https://scramble.dedoc.co/) and is available localy in `localhost:8016/docs/api` 
(you can also see in the procution version: [Deployed API](https://nelsonn.dev/docs/api))

![Scramble UI](/docs/images/scramble-ui.png)

### Postman

But if you prefer to use [Postman](https://www.postman.com/), there is json Postman Collection available in `./docs/postman_collection.js` that you can import

![Postman UI](/docs/images/postman-ui.png)

## DB Schema
The proejct DB contains the **product->category** and the **ACL** entities, as in the image below:

![DB diagram screeshot, using DBaver.](/docs/images/db-diagram.png)

## Testing the API

After stating the project, the startup process makes the migations and seeds, so the DB is ready to go. To start testing its necessary to get the api **token** via **login** endpoint

[Scramble Production Link](https://nelsonn.dev/docs/api#/operations/user.login)
```
curl --request POST \
  --url https://nelsonn.dev/api/login \
  --header 'Accept: application/json' \
  --header 'Authorization: Bearer 123' \
  --header 'Content-Type: application/json' \
  --data '{
  "email": "adm@test.com",
  "password": "password"
}'
```

Rsponse:
```
{
  "message": "Success.",
  "data": "1|unSvmhS9NySzWJDgXlp4NLAf3VSWxwXEKzIoFhRF972f0ca9"
}
```

You must use the token as a `Bearer Token` in the Authorization Header of Scramble or Postman

### ACL

As the project uses ACL for Authorization, during the seed process thera are created 3 users for testing:
- Admin `adm@test.com`, has access to all endpoint
- Product Manager `pm@test.com`, has access to Products endpoints 
- Category Product `cpm@test.com`, has access to Categories endpoints

All of the have the same passwod = `password`, so you can choose which user to use via the *login* endpoint

## Goals

- ✅ API made with Laravel
- ✅ DB made with MySQL 8.0
- ✅ Products CRUD
- ✅ Authentication using Laravel Sactum
- ✅ Products list paginated
- ✅ Implementation of ACL
- ✅ Execute project only by running `docker compose up -d`
