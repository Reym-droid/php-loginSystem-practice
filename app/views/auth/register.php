<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container">
    <h2>Create Account</h2>
    
    <?php if (isset($errors)): ?>
        <?php foreach($errors as $error): ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
        <?php endforeach; ?>
    <?php endif; ?>
    
    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>
    
    <form method="POST" action="/register">
        <div class="form-group">
            <label for="username">Username</label>
            <input 
                type="text" 
                id="username" 
                name="username" 
                value="<?php echo htmlspecialchars($username ?? ''); ?>"
                placeholder="Enter username"
                required
            >
            <small>At least 3 characters</small>
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
            <small>At least 6 characters</small>
        </div>
        
        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input 
                type="password" 
                id="confirm_password" 
                name="confirm_password" 
                placeholder="Re-enter password"
                required
            >
        </div>
        
        <button type="submit" class="btn btn-primary">Create Account</button>
    </form>
    
    <p class="text-center">
        Already have an account? <a href="/login">Login here</a>
    </p>
    
    <p class="text-center">
        <a href="/">← Back to Home</a>
    </p>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>