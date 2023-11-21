<?php

// Import atau autoload kelas yang dibutuhkan
require_once '../core/Router.php';

// Contoh pengaturan rute
Router::addRoute('/', 'AuthContoller@index');
Router::addRoute('/home', 'HomeController@index');
Router::addRoute('/register', 'RegistrationController@index');
