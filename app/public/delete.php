<?php 
        require_once "database.php";

        // Retreive which id to delete from url
        $idToRemove = $_GET['id'];

        if(isset($idToRemove)) {
            // Create sql query
            $sqlquery = "DELETE FROM journal where id=$idToRemove";
            $pdo->query($sqlquery);

            // redirect to index.php
            header("location: index.php");
        }
        

        //$result = $pdo->query($sqlquery);
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
        <h1>Delete Journal</h1>
    </main>
</body>
</html>