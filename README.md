# Blog Application

An application that aims to have a social connection between users who have a visionary approach in life. Users can upload images, titles, and creative descriptions and engage with each other through comments to share their thoughts and ideas.

## Getting Started

### Dependencies

* To run the application locally, the device must have installed Node.js for running React frameworks and PHP for running the back-end functions. 

### Executing program

* Clone the repository 
```
git clone https://github.com/kuschell-adish/blog-post
```
* Go to the project folder
```
cd blog-post
```
* Install the dependencies of the application
```
composer install
```
```
npm install
```

### Importing the database

* Open the MySQL on Terminal
```
mysql -u root
```
* Create a database
```
CREATE DATABASE database_name;
```
* Use the database that has been created
```
USE database_name;
```
* Import the SQL file. The file is included in the repository. 
```
SOURCE /path/to/file.sql;
```

### Running the application

* The two commands must be typed to run the application
```
php artisan serve
```
```
npm run dev
```

## Help

* If you have encountered **error in running** `npm run start`, node dependencies must be installed first. 
```
npm install
```
* If you have encountered **error in running** `php artisan serve`, composer must be installed first. 
```
composer install
```
* If you have encountered **500 server error**, .env file must be created, a .env example has been provided in this source code.

## Acknowledgements
* [psgc-api](https://psgc.gitlab.io/api/)
* [tailwind-css](https://tailwindcss.com/docs/installation/using-vite)

