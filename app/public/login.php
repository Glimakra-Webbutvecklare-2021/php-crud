<?php 
    session_start();
    require_once "database.php";

    // Query the database
    $sqlquery = "SELECT * FROM journal";

     // Handle form submission
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $form_username = trim($_POST["username"]);
        $form_password = trim($_POST["password"]);

        // Check if there is any text from user
        if (!empty($form_username) && !empty($form_password)) {

            // Prepare sql query to pick user
            $stmt = $pdo->prepare('SELECT * FROM user WHERE username = :username');
            $stmt->execute(['username' => $form_username]);
            $user = $stmt->fetch();

            if ($user && password_verify($form_password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['message'] = "Successfully logged in";

                header("location: index.php");
                exit();
            } else {
                $_SESSION['user_id'] = null;
                $_SESSION['message'] = "Invalid username or password";

                header("location: login.php");
                exit();
            }

            
        }
    }  

    
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/mvp.css@1.12/mvp.css"> 
    <title>Simple Crud App</title>
</head>
<body>
    <main>
    <?php 
    // Write out message from other pages if exists
    if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
        echo "<article><aside><p>". $_SESSION['message'] . "</p></aside></article>";
        unset( $_SESSION['message']); // remove it once it has been written
    }
    ?>
    <h1>Login</h1>
    <form action="" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required/>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required/>

        <input type="submit" value="Login">
    </form>
    <p>Don't have an account? <a href="register.php">Register here</a>.</p>
    </main>
</body>
</html>