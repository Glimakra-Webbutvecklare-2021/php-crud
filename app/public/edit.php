<?php
    session_start();
    ob_start();
    require_once "database.php";

    // Retreive the journal entry

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $form_text = trim($_POST["text"]);
        $form_id = trim($_POST["id"]);

        // Check if there is any text from user
        if (!empty($form_text)) {
            // Prepare sql query to insert new journal entry
            $sqlquery = "UPDATE journal SET text='$form_text' WHERE id=$form_id";
            
            echo $sqlquery;

            $sqlStatement = $pdo->query($sqlquery);

            $_SESSION['message'] = "Successfully edited journal entry";
            
            header("location: index.php");
        }
    } else {
        $id = $_GET['id'];

        // Query the database
        $sqlquery = "SELECT * FROM journal WHERE id=$id";
        $result = $pdo->query($sqlquery);
        $row = $result->fetch();

        $old_text = $row['text'];
    }
    ob_end_flush();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/mvp.css@1.12/mvp.css"> 
    <title>Create Crud App</title>
</head>
<body>
    <main>
        <h1>Edit Journal Entry</h1>
        <a href="index.php">Back</a>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="text">Journal Text</label>
            <input type="number" name="id" id="id" value="<?= $id ?>" hidden>
            <input type="text" name="text" id="text" value="<?= $old_text ?>" required>

            <input type="submit" value="submit">
        </form>
    </main>
</body>
</html>