# A-StarWars-Website
 Tool where you register, then log in, to see the planets and star-ships of Star Wars, their details and save them in a list of favorites.
 
 ```shell script
npm install
composer install
npm run dev
php artisan migrate
 ```

Create an archive .env based on .env.example, and run
 ```shell script
php artisan key:generate
 ```

To development environment, I'm used a sqlite database. To configure a sqlite database on 
env
 ```dotenv
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite
DB_FOREIGN_KEYS=true
 ```

 ```shell script
php artisan migrate
 ```
 
 
