<?php 
 // Connect to database
 define('DB_SERVER', 'mysql');
 define('DB_USERNAME', 'db_user');
 define('DB_PASSWORD', 'db_password');
 define('DB_NAME', 'db_lamp_app');

 try {
     // attempt to connect
     $pdo = new PDO("mysql:host=". DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
     
     // Let PDO know that if something goes wrong throw it as an exception
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 } catch (PDOException $err) {
     // let the user know if something went wrong
     die("Error: Could not connect. ". $err->getMessage());
 }
?>