<?php
    session_start();
    
    // Clear session data
    session_unset();
    session_destroy();

    // Prepare session for success message
    session_start();
    $_SESSION['message'] = "Sucessfully logged out";
    
    // Redirect user to login page
    header('location: login.php');
    exit();
?>