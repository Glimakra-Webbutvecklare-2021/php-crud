<?php 
    session_start();
    require_once "database.php";
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
    <h1>Journal</h1>
    <a href="create.php">Add Journal Entry</a>
    <?php 
        // Query the database
        $sqlquery = "SELECT * FROM journal";
        $result = $pdo->query($sqlquery);

        // Render the data
        echo "<section>";
        while($row = $result->fetch()) {
            $id = $row['id'];
            echo "<aside>
                    <p>" . $row['text'] . "</p>
                    <div>
                        <a href='delete.php?id=$id'>Delete</a>
                        <a href='edit.php?id=$id'>Edit</a>
                    </div>
                </aside>
                <hr>";
        }
        echo "</section>";

    ?>
    </main>
</body>
</html>