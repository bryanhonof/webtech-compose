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

```console
$ curl http://localhost:80/api/db-status
"Connection OK; waiting to send."%
```

You can also go to http://localhost:80 yourself, and see a greeting
appear. This is due to the [src/lib/views/index.php](src/lib/views/index.php)
script

## Exploring the database

There's an extra service running in this stack, that isn't available in
the production enviornment, called adminer. Head over to
http://localhost:8888 to get an interface to this service.

Adminer is a web frontend for postgres—and other databases—, this is
usefull when debugging your application.

## RESTful API

The following API endpoints are available. You can find the definitions in 
[src/routes.php](src/routes.php).

### `GET /api/db-status`

```console
$ curl http://localhost:80/api/db-status
"Connection OK; waiting to send."%
```

### `POST /api/temperature`

```console
$ curl -H "Content-Type: application/json" -X POST 'http://localhost:80/api/temperature' -d '{"value":6000}'
[{"id":11}]%
```

### `GET /api/temperature`

```console
$ curl http://localhost:80/api/temperature
[{"id":2,"value":50,"datetime":"2025-05-22 15:36:15.104792+02"},{"id":3,"value":50,"datetime":"2025-05-22 15:36:15.909615+02"},{"id":7,"value":6000,"datetime":"2025-05-22 16:25:15.597281+02"},{"id":8,"value":6000,"datetime":"2025-05-22 16:25:17.718468+02"},{"id":9,"value":6000,"datetime":"2025-05-22 17:18:42.289019+02"},{"id":10,"value":6000,"datetime":"2025-05-22 17:18:42.918058+02"},{"id":11,"value":6000,"datetime":"2025-05-22 17:28:31.965501+02"}]%
```

### `GET /api/temperature/<id>` 

```console
$ curl http://localhost:80/api/temperature/8
[{"id":8,"value":6000,"datetime":"2025-05-22 16:25:17.718468+02"}]%
```

### `GET /api/temperature?begin=<timestamp>&end=<timestamp>`

```console
$ curl 'http://localhost:80/api/temperature?begin=2025-05-22%2015:36&end=2025-05-22%2015:40'
[{"id":2,"value":50,"datetime":"2025-05-22 15:36:15.104792+02"},{"id":3,"value":50,"datetime":"2025-05-22 15:36:15.909615+02"}]%
```

### `GET /api/temperature?begin=<timestamp>`

```console
$ curl 'http://localhost:80/api/temperature?begin=2025-05-22%2017:00'
[{"id":9,"value":6000,"datetime":"2025-05-22 17:18:42.289019+02"},{"id":10,"value":6000,"datetime":"2025-05-22 17:18:42.918058+02"},{"id":11,"value":6000,"datetime":"2025-05-22 17:28:31.965501+02"}]%
```

### `PUT /api/temperature/<id>`

```console
$ curl -X PUT 'http://localhost:80/api/temperature/7' -d '{"value":42}'
[{"id":7,"value":42,"datetime":"2025-05-22 16:25:15.597281+02"}]%
```

### `PATCH /api/temperature/<id>`

```console
$ curl -X PATCH 'http://localhost:80/api/temperature/7' -d '{"value":42}'
[{"id":7,"value":42,"datetime":"2025-05-22 16:25:15.597281+02"}]%
```

### `DELETE /api/temperature/<id>`

```console
$ curl -X DELETE 'http://localhost:80/api/temperature/7'
[{"id":7,"value":42,"datetime":"2025-05-22 16:25:15.597281+02"}]%
```
