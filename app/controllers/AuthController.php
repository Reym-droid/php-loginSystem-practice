<?php
class AuthController extends Controller {
    private $userModel;
    
    public function __construct() {
        session_start();
        $this->userModel = new User();
    }
    
    public function showRegister() {
        $this->view('auth/register', ['title' => 'Register']);
    }
    
    public function register() {
        if (!$this->isPost()) {
            $this->showRegister();
            return;
        }
        
        $username = $this->input('username');
        $password = $this->input('password');
        $confirmPassword = $this->input('confirm_password');
        
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
        
        if (!empty($errors)) {
            $this->view('auth/register', [
                'title' => 'Register',
                'errors' => $errors,
                'username' => $username
            ]);
            return;
        }
        
        if ($this->userModel->create($username, $password)) {
            $this->view('auth/register', [
                'title' => 'Register',
                'success' => "✅ Registration successful! You can now login."
            ]);
        } else {
            $this->view('auth/register', [
                'title' => 'Register',
                'errors' => ["Registration failed. Please try again."]
            ]);
        }
    }
    
    public function showLogin() {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('/dashboard');
        }
        
        $this->view('auth/login', ['title' => 'Login']);
    }
    
    public function login() {
        if (!$this->isPost()) {
            $this->showLogin();
            return;
        }
        
        $username = $this->input('username');
        $password = $this->input('password');
        
        if (empty($username) || empty($password)) {
            $this->view('auth/login', [
                'title' => 'Login',
                'error' => "All fields are required!"
            ]);
            return;
        }
        
        $user = $this->userModel->verifyLogin($username, $password);
        
        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            
            $this->redirect('/dashboard');
        } else {
            $this->view('auth/login', [
                'title' => 'Login',
                'error' => "❌ Invalid username or password!"
            ]);
        }
    }
    
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