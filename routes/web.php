<?php
// Define all application routes

// Home
$router->get('/', 'HomeController', 'index');

// Authentication
$router->get('/register', 'AuthController', 'showRegister');
$router->post('/register', 'AuthController', 'register');
$router->get('/login', 'AuthController', 'showLogin');
$router->post('/login', 'AuthController', 'login');
$router->get('/logout', 'AuthController', 'logout');

// Dashboard
$router->get('/dashboard', 'DashboardController', 'index');
?>