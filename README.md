# NotesApp

NotesApp is a web application written in PHP that allows users to manage notes. The application enables adding, editing, deleting, and viewing notes. Additionally, it offers sorting and search functionality

## Technologies

- PHP
- MySQL
- HTML, CSS, JavaScript

## Application Structure
- config/ – configuration files

- src/ – application logic

     - Controller/ – handles user requests

     - Model/ – interacts with the database

     - Utility/ – helper functions

     - request.php – functions to catch user requests

     - view.php – manages views

- templates/ – user interface templates

     - layout.php – main page template

     - pages/ – individual page views

- assets/ – static files (CSS, JS, images)

- vendor/ - composer and autoload configuration

## Database Configuration

The config/config.php file contains database connection settings. Before running the application, make sure the login credentials are correct.


```PHP
$host = '';
$dbname = '';
$user = '';
$password = '';
```

## Features

- Adding new notes
- Editing existing notes
- Deleting notes
- Viewing a list of notes
- Searching for notes

## Installation and Setup

1. Configure the MySQL database and create the necessary tables (look at database.sql file).
2. Copy the application files to a PHP server (e.g., XAMPP, Apache).
3. Set up config/config.php with the correct database credentials.
4. Open index.php in a web browser.
