<?php
// public/index.php - Application entry point
// ALL requests go through this file

// Why? Security - only public/ folder is web-accessible

// Start session
session_start();

// Load core files
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Router.php';

// Load models
require_once __DIR__ . '/../app/models/User.php';

// Load controllers
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/DashboardController.php';

// Create router
$router = new Router();

// Load routes
require_once __DIR__ . '/../routes/web.php';

// Dispatch request
$router->dispatch();
?>