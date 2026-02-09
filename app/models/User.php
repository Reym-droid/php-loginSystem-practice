<?php
// app/models/User.php - User model (handles all user database operations)

class User {
    private $db;
    
    // Why constructor? Initialize database connection
    public function __construct() {
        $this->db = Database::connect();
    }
    
    // Create new user
    // Why separate method? Reusable, testable, clean
    public function create($username, $password) {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
        
        try {
            $stmt = $this->db->prepare('INSERT INTO users (username, password_hash) VALUES (:username, :password_hash)');
            $stmt->execute([
                'username' => $username,
                'password_hash' => $passwordHash
            ]);
            return true;
        } catch(PDOException $e) {
            return false;
        }
    }
    
    // Find user by username
    public function findByUsername($username) {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->execute(['username' => $username]);
        return $stmt->fetch();
    }
    
    // Check if username exists
    public function usernameExists($username) {
        return $this->findByUsername($username) !== false;
    }
    
    // Verify login credentials
    public function verifyLogin($username, $password) {
        $user = $this->findByUsername($username);
        
        if ($user && password_verify($password, $user['password_hash'])) {
            return $user;
        }
        
        return false;
    }
    
    // Get user by ID
    public function findById($id) {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
}
?>