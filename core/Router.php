<?php
class Router {
    private $routes = [];
    
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
            
            $controllerName = $route['controller'];
            $methodName = $route['method'];
            
            $controller = new $controllerName();
            $controller->$methodName();
            
        } else {
            http_response_code(404);
            echo "<h1>404 - Page Not Found</h1>";
            echo "<p>The page you're looking for doesn't exist.</p>";
            echo "<a href='/'>Go Home</a>";
        }
    }
}
?>