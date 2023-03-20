<?php
    session_start();
    require_once "database.php";
    
    if (!isset($_SESSION["user_id"])) {
        header("location: login.php");
        exit();
    }

    // Query the database
    $sqlquery = "SELECT * FROM journal";
    $result = $pdo->query($sqlquery);

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $form_text = trim($_POST["text"]);
        $user_id = $_SESSION['user_id'];

        // Check if there is any text from user
        if (!empty($form_text)) {
            // Prepare sql query to insert new journal entry
            $pdo->query("INSERT INTO journal (text, user_id) VALUES ('$form_text', $user_id)");
            $_SESSION['message'] = "Successfully added journal entry";

            header("location: index.php");
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

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="text">Journal Text</label>
        <textarea name="text" id="text" cols="30" rows="10">

        </textarea>

        <input type="submit" value="submit">
    </form>


    </main>
</body>
</html>