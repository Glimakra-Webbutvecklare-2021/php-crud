<?php 
    session_start();
    require_once "database.php";
    require_once "Parsedown.php";

    $id = $_GET['id'];

    // Query the database
    $sqlquery = "SELECT * FROM journal WHERE id=$id";
    $result = $pdo->query($sqlquery);
    $journal_entry = $result->fetch();

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
        $Parsedown = new Parsedown();
        $html = $Parsedown->text($journal_entry['text']);

        echo $html;
    ?>
    </main>
</body>
</html>