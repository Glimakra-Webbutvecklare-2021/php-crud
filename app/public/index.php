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
    <h1>Journal</h1>
    <a href="create.php">Add Journal Entry</a>
    <?php 
        require_once "database.php";

        // Query the database
        $sqlquery = "SELECT * FROM journal";
        $result = $pdo->query($sqlquery);

        // var_dump($result->fetch());
        while($row = $result->fetch()) {
            $id = $row['id'];
            echo "<div>
                    <p>" . $row['text'] . "</p>
                    <div>
                        <a href='delete.php?id=$id'>Delete</a>
                    </div>
                </div> <hr>";
        }

        // Render the data

    ?>
    </main>
</body>
</html>