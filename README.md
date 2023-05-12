# Webtech Project Local Development Environment with Docker Compose

This repository contains a Docker compose file that will set up 4 services 
that mimic the production environment pretty well. It sets up Caddy, 
PHP-fpm, Postgres, and adminer for you.

## How to use

To start up the stack, run the following.

```
$ git clone git@github.com:bryanhonof/webtech-compose.git
$ cd webtech-compose
$ docker compose up
```

Once the stack is up and running, we can see if a connection to the 
database happened successfully by trying the following. This command 
should return the version of PostgresQL.

```
$ curl http://localhost:8080/testdb.sh
```

You can also go to http://localhost:8080 yourself, and see a greeting 
appear. This is due to the `/html/index.php` script.

## Exploring the database

There's an extra service running in this stack, that isn't available in 
the production enviornment, called adminer. Head over to 
http://localhost:8888 to get an interface to this service.

Adminer is a web frontend for postgres—and other databases—, this is 
usefull when debugging your application.
