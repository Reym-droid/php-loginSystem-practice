<?php
class Controller {
    
    protected function view($viewPath, $data = []) {
        extract($data);
        require_once __DIR__ . '/../app/views/' . $viewPath . '.php';
    }
    
    protected function redirect($url) {
        header('Location: ' . $url);
        exit();
    }
    
    protected function input($key, $default = '') {
        return isset($_POST[$key]) ? trim($_POST[$key]) : $default;
    }
    
    protected function isPost() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
}
?>