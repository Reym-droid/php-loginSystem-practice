<?php
class HomeController extends Controller {
    
    public function index() {
        session_start();
        $this->view('home', ['title' => 'Home - Login System']);
    }
}
?>