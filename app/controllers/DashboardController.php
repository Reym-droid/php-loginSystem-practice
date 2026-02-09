<?php
class DashboardController extends Controller {
    
    public function index() {
        session_start();
        
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/login');
        }
        
        $userModel = new User();
        $user = $userModel->findById($_SESSION['user_id']);
        
        $this->view('dashboard', [
            'title' => 'Dashboard',
            'user' => $user
        ]);
    }
}
?>