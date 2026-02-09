<?php
// core/Controller.php - Base controller class

class Controller {
    
    // Why base controller? All controllers inherit common methods
    
    // Load a view template
    protected function view($viewPath, $data = []) {
        // Why extract()? Converts array to variables
        // ['user' => 'John'] becomes $user = 'John'
        extract($data);
        
        // Include the view file
        require_once __DIR__ . '/../app/views/' . $viewPath . '.php';
    }
    
    // Redirect to another page
    protected function redirect($url) {
        header('Location: ' . $url);
        exit();
    }
    
    // Get POST data safely
    protected function input($key, $default = '') {
        return isset($_POST[$key]) ? trim($_POST[$key]) : $default;
    }
    
    // Check if request is POST
    protected function isPost() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
}
?>