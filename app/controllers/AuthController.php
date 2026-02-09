<?php
// app/controllers/AuthController.php - Handles authentication

class AuthController extends Controller {
    private $userModel;
    
    // Why constructor? Initialize model
    public function __construct() {
        session_start();
        $this->userModel = new User();
    }
    
    // Show registration page
    public function showRegister() {
        // Why separate method? Clean separation of concerns
        $this->view('auth/register');
    }
    
    // Handle registration form submission
    public function register() {
        if (!$this->isPost()) {
            $this->showRegister();
            return;
        }
        
        $username = $this->input('username');
        $password = $this->input('password');
        $confirmPassword = $this->input('confirm_password');
        
        // Validation
        $errors = [];
        
        if (empty($username) || empty($password) || empty($confirmPassword)) {
            $errors[] = "All fields are required!";
        }
        
        if (strlen($username) < 3) {
            $errors[] = "Username must be at least 3 characters!";
        }
        
        if ($password !== $confirmPassword) {
            $errors[] = "Passwords do not match!";
        }
        
        if (strlen($password) < 6) {
            $errors[] = "Password must be at least 6 characters!";
        }
        
        if ($this->userModel->usernameExists($username)) {
            $errors[] = "Username already exists!";
        }
        
        // If validation fails, show form with errors
        if (!empty($errors)) {
            $this->view('auth/register', ['errors' => $errors, 'username' => $username]);
            return;
        }
        
        // Create user
        if ($this->userModel->create($username, $password)) {
            $this->view('auth/register', ['success' => "Registration successful! You can now login."]);
        } else {
            $this->view('auth/register', ['errors' => ["Registration failed. Please try again."]]);
        }
    }
    
    // Show login page
    public function showLogin() {
        // If already logged in, redirect to dashboard
        if (isset($_SESSION['user_id'])) {
            $this->redirect('/dashboard');
        }
        
        $this->view('auth/login');
    }
    
    // Handle login form submission
    public function login() {
        if (!$this->isPost()) {
            $this->showLogin();
            return;
        }
        
        $username = $this->input('username');
        $password = $this->input('password');
        
        // Validation
        if (empty($username) || empty($password)) {
            $this->view('auth/login', ['error' => "All fields are required!"]);
            return;
        }
        
        // Verify credentials
        $user = $this->userModel->verifyLogin($username, $password);
        
        if ($user) {
            // Login successful
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            
            $this->redirect('/dashboard');
        } else {
            $this->view('auth/login', ['error' => "Invalid username or password!"]);
        }
    }
    
    // Logout
    public function logout() {
        $_SESSION = array();
        session_destroy();
        
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time()-3600, '/');
        }
        
        $this->redirect('/login');
    }
}
?>