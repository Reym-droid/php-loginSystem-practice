<?php
class User {
    private $db;
    
    public function __construct() {
        $this->db = Database::connect();
    }
    
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
    
    public function findByUsername($username) {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->execute(['username' => $username]);
        return $stmt->fetch();
    }
    
    public function usernameExists($username) {
        return $this->findByUsername($username) !== false;
    }
    
    public function verifyLogin($username, $password) {
        $user = $this->findByUsername($username);
        
        if ($user && password_verify($password, $user['password_hash'])) {
            return $user;
        }
        
        return false;
    }
    
    public function findById($id) {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
}
?>