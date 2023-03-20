<?php 
    session_start();
    require_once "database.php";

    // handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $form_username = $_POST['username'];
        $form_password = $_POST['password'];

        $result = $pdo->query("SELECT * FROM user WHERE username = '$form_username'");
        $user = $result->fetch();

        if (!$user) {
            $_SESSION['message'] = "Username does not exists";
            header("location: login.php");
            exit();
        }

        // compare password
        $correct_password = password_verify($form_password, $user['password']);
        if (!$correct_password) {
            $_SESSION['message'] = "Invalid password";
            header("location: login.php");
            exit();
        }

        // set user_id for session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['message'] = "Successfully logged in";

        // redirect to dashboard
        header("location: index.php");
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
        <form action="" method="post">
            <label for="username">Username: </label>
            <input type="text" name="username" id="username" />

            <label for="password">Password: </label>
            <input type="password" name="password" id="password" />

            <input type="submit" value="Login" />
        </form>
        <p>Missing an account? <a href="register.php">Register</a> here.</p>
    </main>
</body>
</html>