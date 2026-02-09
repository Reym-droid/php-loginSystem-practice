<?php require_once __DIR__ . '/layouts/header.php'; ?>

<div class="container">
    <div class="dashboard-header">
        <h2>Welcome to Dashboard!</h2>
        <h3>Hello, <?php echo htmlspecialchars($user['username']); ?>!</h3>
    </div>
    
    <div class="success-box">
        <p>You are successfully logged in!</p>
    </div>
    
    <div class="info-box">
        <h4>Your Session Info:</h4>
        <ul>
            <li><strong>User ID:</strong> <?php echo htmlspecialchars($user['id']); ?></li>
            <li><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></li>
            <li><strong>Registered:</strong> <?php echo htmlspecialchars($user['created_at']); ?></li>
        </ul>
    </div>
    
    <a href="/logout" class="btn btn-danger">Logout</a>
</div>

<?php require_once __DIR__ . '/layouts/footer.php'; ?>