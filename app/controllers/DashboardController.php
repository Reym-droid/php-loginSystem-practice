<?php
// app/controllers/DashboardController.php

class DashboardController extends Controller {
    
    public function index() {
        session_start();
        
        // Check if logged in
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/login');
        }
        
        // Get user data
        $userModel = new User();
        $user = $userModel->findById($_SESSION['user_id']);
        
        // Show dashboard
        $this->view('dashboard', ['user' => $user]);
    }
}
?>