# Symfony Docker

## Requirements

- docker-compose 
- composer 

## Installation

First build the project using docker
```sh
# docker compose build --pull --no-cache
make build

# docker compose up --detach
make up
```

Then, populate the `app` datatable by using `php bin/console do:mi:mi` or the [`init`](./init/init.sql) file.

## Startup
To start the project, use the following commands : 
```sh
make up
# Api is now running on https://localhost

cd pwa
ng serve
# Frontend is ow running on http://localhost:4200/
```

Se connecter ensuite une fois sur l'endpoint [https://localhost/music_bands](https://localhost/music_bands) afin de valider le certificat.