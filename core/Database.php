<?php
class Database {
    private static $pdo = null;
    
    public static function connect() {
        if (self::$pdo === null) {
            try {
                // Database will be created in mvc-version folder
                $dbPath = __DIR__ . '/../database.db';
                self::$pdo = new PDO('sqlite:' . $dbPath);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                
                // Create users table
                self::$pdo->exec("
                    CREATE TABLE IF NOT EXISTS users (
                        id INTEGER PRIMARY KEY AUTOINCREMENT,
                        username TEXT UNIQUE NOT NULL,
                        password_hash TEXT NOT NULL,
                        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
                    )
                ");
                
            } catch(PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }
        
        return self::$pdo;
    }
}
?>