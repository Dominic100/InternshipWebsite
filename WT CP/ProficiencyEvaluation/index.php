<?php
session_start();
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $ai = $_POST['ai'];
    $ml = $_POST['ml'];
    $ds = $_POST['ds'];
    $app_dev = $_POST['app_dev'];
    $game_dev = $_POST['game_dev'];
    $web_dev = $_POST['web_dev'];

    // Check if proficiencies already exist for the user
    $existingProficienciesQuery = "SELECT * FROM user_proficiency WHERE id='$user_id'";
    $existingProficienciesResult = $conn->query($existingProficienciesQuery);

    if ($existingProficienciesResult->num_rows > 0) {
        // Update existing proficiencies
        $updateQuery = "UPDATE user_proficiency SET ai='$ai', ml='$ml', ds='$ds', app_dev='$app_dev', game_dev='$game_dev', web_dev='$web_dev' WHERE id='$user_id'";

        if ($conn->query($updateQuery) === TRUE) {
            echo "Proficiencies updated successfully.";
            header("Location: test.php");
            exit();
        } else {
            echo "Error updating proficiencies: " . $conn->error;
        }
    } else {
        // Insert new proficiencies
        $insertQuery = "INSERT INTO user_proficiency (id, ai, ml, ds, app_dev, game_dev, web_dev) VALUES (
            '$user_id', '$ai', '$ml', '$ds', '$app_dev', '$game_dev', '$web_dev'
        )";

        if ($conn->query($insertQuery) === TRUE) {
            echo "Proficiencies inserted successfully.";
            header("Location: test.php");
            exit();
        } else {
            echo "Error inserting proficiencies: " . $conn->error;
        }
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proficiency Assessment</title>
</head>
<body>

<h2>Proficiency Assessment</h2>

<form action="" method="post">
    <label for="ai">Artificial Intelligence:</label>
    <select id="ai" name="ai">
        <option value="9">9</option>
        <option value="7">7</option>
        <option value="5">5</option>
        <option value="3">3</option>
        <option value="1" selected>1</option> <!-- Default value -->
    </select><br><br>

    <label for="ml">Machine Learning:</label>
    <select id="ml" name="ml">
        <option value="9">9</option>
        <option value="7">7</option>
        <option value="5">5</option>
        <option value="3">3</option>
        <option value="1" selected>1</option> <!-- Default value -->
    </select><br><br>

    <label for="ds">Data Science:</label>
    <select id="ds" name="ds">
        <option value="9">9</option>
        <option value="7">7</option>
        <option value="5">5</option>
        <option value="3">3</option>
        <option value="1" selected>1</option> <!-- Default value -->
    </select><br><br>

    <label for="app_dev">App Development:</label>
    <select id="app_dev" name="app_dev">
        <option value="9">9</option>
        <option value="7">7</option>
        <option value="5">5</option>
        <option value="3">3</option>
        <option value="1" selected>1</option> <!-- Default value -->
    </select><br><br>

    <label for="game_dev">Game Development:</label>
    <select id="game_dev" name="game_dev">
        <option value="9">9</option>
        <option value="7">7</option>
        <option value="5">5</option>
        <option value="3">3</option>
        <option value="1" selected>1</option> <!-- Default value -->
    </select><br><br>

    <label for="web_dev">Web Development:</label>
    <select id="web_dev" name="web_dev">
        <option value="9">9</option>
        <option value="7">7</option>
        <option value="5">5</option>
        <option value="3">3</option>
        <option value="1" selected>1</option> <!-- Default value -->
    </select><br><br>

    <input type="submit" value="Submit">
</form>

</body>
</html>
