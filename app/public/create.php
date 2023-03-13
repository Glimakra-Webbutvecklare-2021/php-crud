<?php
    require_once "database.php";

    // Query the database
    $sqlquery = "SELECT * FROM journal";
    $result = $pdo->query($sqlquery);
    // Render the data

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $form_text = trim($_POST["text"]);

        // Check if there is any text from user
        if (!empty($form_text)) {
            // Prepare sql query to insert new journal entry
            $sqlquery = "INSERT INTO journal (id, text) VALUES (NULL, '$form_text')";

            $sqlStatement = $pdo->query($sqlquery);
            
            header("location: index.php");
            // echo "<p>Successfully added journal entry</p>";
        }
    }  
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
    <h1>Create Journal Entry</h1>
    <a href="index.php">Back</a>

    <form action="" method="post">
        <label for="text">Journal Text</label>
        <input type="text" name="text" id="text" required>

        <input type="submit" value="submit">
    </form>


    </main>
</body>
</html>