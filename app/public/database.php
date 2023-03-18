<?php
// Connect to database
define('DB_SERVER', 'mysql');
define('DB_USERNAME', 'db_user');
define('DB_PASSWORD', 'db_password');
define('DB_NAME', 'db_lamp_app');

try {
    // attempt to connect
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);

    // Let PDO know that if something goes wrong throw it as an exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // Check if the tables exist
    $result = $pdo->query("SHOW TABLES LIKE 'journal'");
    $journalTableExists = $result->rowCount() == 1;

    $result = $pdo->query("SHOW TABLES LIKE 'user'");
    $userTableExists = $result->rowCount() == 1;

    // If the tables do not exist, create them
    if (!$journalTableExists || !$userTableExists) {
       // Create the user table
        $pdo->exec("CREATE TABLE IF NOT EXISTS user (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL,
            password VARCHAR(255) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

        // Create the journal table
        $pdo->exec("CREATE TABLE IF NOT EXISTS journal (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            text VARCHAR(255) NOT NULL,
            user_id INT(11) UNSIGNED NOT NULL,
            CONSTRAINT `fk_journal_user`
                FOREIGN KEY (user_id)
                REFERENCES user(id)
                ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");


    }

} catch (PDOException $err) {
    // let the user know if something went wrong
    die("Error: Could not connect. " . $err->getMessage());
}
?>