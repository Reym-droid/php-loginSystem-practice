<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container">
    <h2>📝 Create Account</h2>
    
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
            <label for="username">👤 Username</label>
            <input 
                type="text" 
                id="username" 
                name="username" 
                value="<?php echo htmlspecialchars($username ?? ''); ?>"
                required
            >
        </div>
        
        <div class="form-group">
            <label for="password">🔒 Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <div class="form-group">
            <label for="confirm_password">🔒 Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Create Account</button>
    </form>
    
    <p class="text-center">
        Already have an account? <a href="/login">Login here</a>
    </p>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>