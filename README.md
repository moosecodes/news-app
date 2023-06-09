<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Moosecodes News Application

This app uses Laravel Sail and Laravel Jetstream along with Vue 3 and Pinia.

These are the APIs that are consumed by this application:

- newsapi api
- newsdata api
- newscatcher api
- weather api

#### This application uses docker compose via Laravel Sail to start.
To start:
- run `composer install`
- run `npm ci` or `npm install` or `yarn install`
- run `npm run build` (optional)
- run `npm run dev`
- run `sail up -d` or `./vendor/bin/sail up -d`
- run `sail artisan queue:work`
- run `sail artisan websockets:serve`

#### Database migration commands:

`sail artisan migrate:refresh`

Create news articles table:
`sail artisan migrate:refresh --path=/database/migrations/articles`

Create landing page visits table:
`sail artisan migrate:refresh --path=/database/migrations/visits`

`sail artisan migrate:fresh`
