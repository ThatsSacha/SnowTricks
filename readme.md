# Snowtricks

###### Snowtricks is the 6th project of OpenClassrooms back-end course.
#
#
## Features _(for anonymous visitors)_
- See snow tricks
- Register
#
## Features _(for a user)_
- Add/Update/Delete a trick
- Comment a trick
- Remove the comment for the current user logged in
#

### Tech

Snowtricks is developed under this technologies :

- PHP with Symfony & MySQL
- jQuery
- SCSS

## Installation

Snowtricks requires [PHP](https://php.net) 8.0.1 to run.

Install the bundles
You have to create a _.env_ file in /code folder with your parameters
```sh
APP_ENV=dev
APP_SECRET=
APP_URL=http://localhost:8000

MAILER_DSN=smtp://

DATABASE_URL="mysql://root:password@host:port/SnowTricks?serverVersion=5.7"
```
And then
```sh
cd Snowtricks
composer install
```
Now, you need to open you database system managment, create a new database (named like "Snowtricks") and import inside de _Snowtricks.sql_ file

If you run _Snowtricks_ under MAMP or WAMP, run on your browser http://localhost:[port]/Snowtricks

Or run into terminal
```
$ php -S localhost:8000
```

###### Then, you could create your account and receive a validation email (if you have correctly configured the _MAILER_DSN_ into the _.env_ file)