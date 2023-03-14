<?php
    session_start();
    
    // Redirect user to index page if already logged in
    if (isset($_SESSION['user_id'])) {
        header('location: index.php');
        exit();
    }
    
    // Connect to database
    $pdo = new PDO('mysql:host=localhost;dbname=todo_db', 'username', 'password');
    
    // Handle form submission
    if (isset($_POST['submit'])) {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->execute(['username' => $_POST['username']]);
        $user = $stmt->fetch();
        
        if ($user) {
            $error_message = 'Username already taken';
        } else {
            $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
            $stmt->execute(['username' => $_POST['username'], 'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)]);
            $_SESSION['user_id'] = $pdo->lastInsertId();
            header('location: index.php');
            exit();
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <?php if (isset($_SESSION['message'])) {
        echo "<aside><p>" . $_SESSION['message'] . "</p><aside>";
    } ?>
    <form method="post" action="">
        <label>Username:</label><br>
        <input type="text" name="username"><br>
        <label>Password:</label><br>
        <input type="password" name="password"><br><br>
        <input type="submit" name="submit" value="Register">
    </form>
    <p>Already have an account? <a href="login.php">Login here</a>.</p>
</body>
</html>
