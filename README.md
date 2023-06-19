# myRacing (v2)
iRacing race planner and season guide.

This is the source code of myRacing, which is available online for everyone at [racing.sim.tools](https://racing.sim.tools).

This is also a successor to the previous [project](https://github.com/mwgg/myRacing) with the same name. Even though this version looks largely the same, it features a complete rework of both the back-end and the front-end, and is made to be a public website, not just a personal self-hosted application. Thus, I've chosen to publish this rework in its own repo. 

![Dashboard](https://github.com/mwgg/myRacing_v2/raw/main/myracing_1.jpg)
![Planner](https://github.com/mwgg/myRacing_v2/raw/main/myracing_2.jpg)

## Running myRacing yourself

Here are some brief notes on how to get going, assuming a clean Ubuntu 20.04 box.

Install PHP8, nginx:
```
sudo apt -y install software-properties-common dirmngr apt-transport-https lsb-release ca-certificates
sudo add-apt-repository ppa:ondrej/php
sudo apt update
sudo apt install nginx openssl php8.1 php8.1-common php8.1-fpm php8.1-dom php8.1-bcmath php8.1-mbstring php8.1-curl php8.1-sqlite3
```

Create an empty database file: `touch /path/to/myracing.db`

Rename `.env.example` to `.env`, configure the database:
```
DB_CONNECTION=sqlite
DB_DATABASE=/path/to/myracing.db
```

Run the following commands in the project folder:
```
composer install
npm install
npm run prod
php artisan key:generate
php artisan migrate
php artisan update:series
php artisan update:series-season
php artisan update:series-assets
php artisan update:tracks
php artisan update:track-assets
php artisan update:cars
```

Add the following line to cron:
```
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

Configure nginx as needed by pointing it at the `public` folder, and you're good to go.
