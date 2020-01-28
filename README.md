# Helix - Backend
This is the backend for the Helix project. It is responsibile for handling API calls and file handling.
For a description of what the Helix project is check out the [Helix Frontend](https://github.com/XanCeegor/helix_frontend)

## Project setup
### clone the repo
```
git clone https://github.com/XanCeegor/helix_backend.git
```

### Update .env file 
Rename `.env.example` to `.env` and update your database settings. Also set `QUEUE_CONNECTION` to `database`.
```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120
```

### Run the migrations
```
php php artisan migrate
```
You will need to create a user in your Users table in your database. The username must be "Anon". Other fields can be left blank.

### Configure your server
You will need to configure your PHP as well as web server to accept files over a certain size. 
PHP: Update your `php.ini` file and edit both `post_max_size` and `upload_max_filesize` to whatever size you want your server to be able to accept.
NGINX: Update your `nginx.conf` and edit `client_max_body_size` and `post_max_size` to the size you want your server to accept.

### Start dev server
```
php artisan serve
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License
[MIT](https://choosealicense.com/licenses/mit/)
