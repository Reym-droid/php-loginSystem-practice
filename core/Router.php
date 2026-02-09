<?php
// core/Router.php - Handle URL routing

class Router {
    private $routes = [];
    
    // Why router? Maps URLs to controllers
    // Example: /login → AuthController::login()
    
    public function get($uri, $controller, $method) {
        $this->routes['GET'][$uri] = ['controller' => $controller, 'method' => $method];
    }
    
    public function post($uri, $controller, $method) {
        $this->routes['POST'][$uri] = ['controller' => $controller, 'method' => $method];
    }
    
    public function dispatch() {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        // Remove trailing slashes
        $requestUri = rtrim($requestUri, '/');
        if (empty($requestUri)) {
            $requestUri = '/';
        }
        
        // Find matching route
        if (isset($this->routes[$requestMethod][$requestUri])) {
            $route = $this->routes[$requestMethod][$requestUri];
            
            // Create controller instance
            $controllerName = $route['controller'];
            $methodName = $route['method'];
            
            $controller = new $controllerName();
            $controller->$methodName();
            
        } else {
            // 404 - Route not found
            http_response_code(404);
            echo "404 - Page Not Found";
        }
    }
}
?>