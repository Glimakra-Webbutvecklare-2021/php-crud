<?php
    session_start();
    
    // Redirect user to index page if already logged in
    if (isset($_SESSION['user_id'])) {
        header('location: index.php');
        exit();
    }
    
    // Connect to database
    require_once("database.php");
    
    // Handle form submission
    if (isset($_POST['submit'])) {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->execute(['username' => $_POST['username']]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($_POST['password'], $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header('location: index.php');
            exit();
    } else {
        $error_message = 'Invalid username or password';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($_SESSION['message'])) {
        echo "<aside><p>" . $_SESSION['message'] . "</p><aside>";
    } ?>
    <form method="post" action="">
        <label>Username:</label><br>
        <input type="text" name="username"><br>
        <label>Password:</label><br>
        <input type="password" name="password"><br><br>
        <input type="submit" name="submit" value="Login">
    </form>
    <p>Don't have an account? <a href="register.php">Register here</a>.</p>
</body>
</html>