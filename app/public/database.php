<?php 
 // Connect to database
 define('DB_SERVER', 'mysql');
 define('DB_USERNAME', 'root');
 define('DB_PASSWORD', 'db_root_password');
 define('DB_NAME', 'journal_entry_db2');

 try {
     // attempt to connect
     $pdo = new PDO("mysql:host=". DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
     
     // Let PDO know that if something goes wrong throw it as an exception
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     // ensure that neccessary tables exists

     // -user
     $pdo->exec("CREATE TABLE IF NOT EXISTS user (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

     // -journal
     // Create the journal table
    $pdo->exec("CREATE TABLE IF NOT EXISTS journal (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        text TEXT NOT NULL,
        user_id INT(11) UNSIGNED NOT NULL,
        CONSTRAINT `fk_journal_user`
            FOREIGN KEY (user_id)
            REFERENCES user(id)
            ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");


 } catch (PDOException $err) {
     // let the user know if something went wrong
     die("Error: Could not connect. ". $err->getMessage());
 }
?>