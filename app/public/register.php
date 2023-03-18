<?php
    session_start();
    require_once("database.php");

    // Redirect user to index page if already logged in
    if (isset($_SESSION['user_id'])) {
        header('location: index.php');
        exit();
    }
    
    // Handle form submission
    if (isset($_POST['submit'])) {
        $stmt = $pdo->prepare('SELECT * FROM user WHERE username = :username');
        $stmt->execute(['username' => $_POST['username']]);
        $user = $stmt->fetch();
        
        if ($user) {
            $_SESSION['message'] = 'Username already taken';
        } else {
            $stmt = $pdo->prepare('INSERT INTO user (username, password) VALUES (:username, :password)');
            $stmt->execute(['username' => $_POST['username'], 'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)]);
            $_SESSION['message'] = 'Succesfully created user. Please login.';

            header('location: login.php');
            exit();
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/mvp.css@1.12/mvp.css"> 
    <title>Simple Crud App: Register</title>
</head>
<body>
    <h1>Register</h1>
    <?php 
        // Write out message from other pages if exists
        if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
            echo "<article><aside><p>". $_SESSION['message'] . "</p></aside></article>";
            unset( $_SESSION['message']); // remove it once it has been written
        }
    ?>
    <form method="post" action="">
        <label>Username:</label>
        <input type="text" name="username">
        <label>Password:</label>
        <input type="password" name="password">
        <input type="submit" name="submit" value="Register">
    </form>
    <p>Already have an account? <a href="login.php">Login here</a>.</p>
</body>
</html>
