<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Crud App</title>
</head>
<body>
    <h1>Journal</h1>
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

        // Query the database
        $sqlquery = "SELECT * FROM journal";
        $result = $pdo->query($sqlquery);

        // var_dump($result->fetch());
        while($row = $result->fetch()) {
            echo "<p>" . $row['text'] . "</p>";
        }

        // Render the data

    ?>
</body>
</html>