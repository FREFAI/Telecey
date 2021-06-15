<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

# Getting Started with Telecey

This project works for adding reviews on Telecome services.

This project was developed in `Laravel :- 5.8`
## Installation


```sh
    Clone the project into local

    git clone https://github.com/FREFAI/Telecey.git

```

## Getting Started
```bash
    # Go to the project folder
    cd Telecey 

    # Install all the composer packages.
    # Type the following command to install all composer packages

    composer install

```

Copy the example env file and make the required configuration changes in the .env file

```bash
    cp .env.example .env
```

Generate a new application key

```bash
    php artisan key:generate
```

Run the database migrations (Set the database connection in .env before migrating)

```bash
    php artisan migrate
```

Run these commands When all process is complete

```
php artisan db:seed --class=SettingsTableSeeder

php artisan db:seed --class=CountriesTableSeeder

php artisan db:seed --class=CurrenciesTableSeeder

mysql -u softradi_dev -p softradi_telco < public/sql/cities.sql

```

In order to run the application Type the following command

```bash
    
    php artisan serve

```
You can now access the server at [http://localhost:8000](http://localhost:8000)
