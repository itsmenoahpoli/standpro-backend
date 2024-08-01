<h1>Image/Video Content Management System</h1>
<p>Built with Laravel 11 (PHP), Vuejs (JavaScript/TypeScript), TailwindCss, MySQL</p>
<hr />

<h5>Installation and setup guide</h5>

```bash

git clone https://github.com/itsmenoahpoli/BBCCC-cms.git

cd BBCCC-cms

composer install

npm install

npm run dev # Dev build
# or
npm run build # Production build

# After running this command, open .env and set the database credentials
cp .env.example .env

php artisan key:generate

php artisan migrate --seed

php artisan storage:link

php artisan serve
```

<br />
<h5>List of functions/modules</h5>

-   [x] Authentication
-   [ ] Manage contents (images/videos)
-   [ ] Dashboard user interface
-   [ ] Secured API endpoints

<hr />
Made by Patrick Policarpio with :orange_heart:
