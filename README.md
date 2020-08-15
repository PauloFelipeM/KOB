<h1 align="center">
  KOB - limousine services
</h1>

[![Laravel](https://img.shields.io/badge/Awesome-Laravel-brightgreen.svg?)](https://github.com/PauloFelipeM/entire-fleet)
[![MIT License](https://img.shields.io/apm/l/atomic-design-ui.svg?)](https://github.com/tterb/atomic-design-ui/blob/master/LICENSEs)

System to control of the car services with payment square

### Modulos disponíveis no momento:

Cards;

Services type;

Ticket;

Workspaces;

Car;

Car types;


![](header.png)

-------------------------------------------------------------------------------------

## Technologies
Laravel (PHP)
React Native;

-------------------------------------------------------------------------------------

## Requirido
- Laravel 5.8
- Composer LTS
- Node.js
- NPM or Yarn
- Expo (For React Native)

-------------------------------------------------------------------------------------

## Instalation

git clone https://github.com/PauloFelipeM/KOB.git

-------------------------------------------------------------------------------------

## Configuration:

The folder "kob-backend-web" os de API and the frontend sistema make in Laravel.

Inside kob-backend-web run: composer install;


#### Open the .env file and configure your database:

DB_CONNECTION=pgsql

DB_HOST=127.0.0.1

DB_PORT=5432

DB_DATABASE=DATABASE

DB_USERNAME=postgres

DB_PASSWORD=master


#### In the .env file configure you SQUARE TOKEN:

SQUARE_TOKEN=YOU_TOKEN

-------------------------------------------------------------------------------------

### Migration:

To create the database tables run the follow command "php artisan migrate"

##### PS: The database most be create in to do this step.

-------------------------------------------------------------------------------------

-------------------------------------------------------------------------------------

# React Native APP:

### Configuration


cd kob-app

Run: yarn or npm install

After this look the EXPO docs to configure he and run the app:

https://expo.io/learn

-------------------------------------------------------------------------------------

## :memo: License

License MIT.

Create by [Paulo Felipe Martins](https://www.linkedin.com/in/paulo-felipe-martins-3940b011a/)
