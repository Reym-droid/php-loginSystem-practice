<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container">
    <h2>Login</h2>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <form method="POST" action="/login">
        <div class="form-group">
            <label for="username">Username</label>
            <input 
                type="text" 
                id="username" 
                name="username" 
                placeholder="Enter username"
                required
            >
        </div>
        
        <div class="form-group">
            <label for="password">Password</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                placeholder="Enter password"
                required
            >
        </div>
        
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    
    <p class="text-center">
        Don't have an account? <a href="/register">Register here</a>
    </p>
    
    <p class="text-center">
        <a href="/">← Back to Home</a>
    </p>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>