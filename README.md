
## Overview 

Pet shop is a project written with PHP Laravel Framework. The framework is made for writting super API endpoints. It implements JSON Web Token for user  Authentication. Please take a look at  [JWT](https://jwt.io/). 
## Installation & Usage
<hr/>

### Downloading the Project


This framework requires PHP 8.0 and mysql database
.  
You can simply clone  `` Pet-shop-api`` like below on your git bash

```bash
git clone https://github.com/ayangzy/Pet-shop-api.git
```
After cloning the project, please run this command on the project directory
```
composer install
```
### Configure Environment
To run the application you must configure the ```.env``` environment file with your database details and mail configurations. Use the following commmand to create .env file. 
```
cp .env.example .env

```

Once you run the above command, your database configuration will be set if you are running your application on docker. However, if you are not running it on docker, please configure your database in the .env file. You can check the default .env.example if you want to manually create the .env file

### Please configure your Mail driver in the env to make the application work correctly.
You have to also configure your mail drivers in the .env file, in my own case i made use of mailtrap for testing purposes.

### Generating app key and jwt secret
Run the following commands either on the project directory or on the docker container ```petshop_api```
```

php artisan key:generate
php artisan jwt:secret
```
After jwt key and app key is generated, Run the following command at this stage to run database migrations
```
php artisan migrate
```

## Seeding DB
Once your database is correctly set up, you can seed your database by running
```
php artisan db:seed
```

If you are using docker you can ssh into the container like below
```
docker exec -it petshop_api bash
```
The above command will ssh you into the container to run the commands and generate keys for your application  too.

### Note
If you dont use docker, please type ```php artisan serve```  on the project directory to start your application
### Running with  Docker
To run this application on docker container, run the following command on the project directory
```
docker-compose build
```
Wait for the application's image to be built completely on docker then run
```
docker-compose up
```
### Clear cache inside container if you run into issues
First Enter into the docker container. Make sure you have successfully build the image wtih the above commands first
```
docker exec -it petshop_api bash
```
Then run this command 
``` 
php artisan optimize
```

And your application should be live for test on the following 

If you use docker.

[http://127.0.0.1:8002/api/documentation]( http://127.0.0.1:8002/api/documentation) 

If you are not using docker 

[http://127.0.0.1:8000/api/documentation](http://127.0.0.1:8000/api/documentation)

## Note
If you run into error, run the following commands one after the other either on the directory or on your docker container
``` 
composer update
php artisan optimize
composer dump-autoload
```

## Testing

To run test test, type the following on the project directory

``` bash
php artisan optimize
```

``` bash
php artisan test
```

There is a cron job that truncate and reseed database every day at midnight. It can be triggered by running
``` 
php artisan seeder:regenerate
```

For testing purpose, kindly find below the login credentials:
Admin login credentials remain
``` 
email: admin@buckhill.co.uk  password: admin
```
Users: User emails changes, but password remain same, you can get user emails from api/v1/admin/user-listing endpoint.
``` 
passowrd: userpassword
```

## Security

If you discover any security related issues, please email felixdecoder2020@gmail.com instead of using the issue tracker.

## Credits

- [Ayange Felix](https://github.com/ayangzy)


