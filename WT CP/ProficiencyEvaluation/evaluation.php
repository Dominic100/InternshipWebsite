<?php
session_start();
include('config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM user_proficiency WHERE id='$user_id'";
$result = $conn->query($sql);

$testScores = array();

while ($row = $result->fetch_assoc()) {
    $subjects = array('ai', 'ml', 'ds', 'app_dev', 'game_dev', 'web_dev');
    foreach ($subjects as $subject) {
        if ($subject == 'app_dev' && $row[$subject] <= 1) {
            echo "Skipping test for subject " . $subject . " due to low proficiency.<br>";
            continue;
        }

        $quizFile = '';
        switch ($row[$subject]) {
            case 9:
                $quizFile = 'C:/xampp/htdocs/WT CP/ProficiencyEvaluation/quizData/quiz_hard.json';
                break;
            case 7:
                $quizFile = 'C:/xampp/htdocs/WT CP/ProficiencyEvaluation/quizData/quiz_medium_hard.json';
                break;
            case 5:
                $quizFile = 'C:/xampp/htdocs/WT CP/ProficiencyEvaluation/quizData/quiz_medium.json';
                break;
            case 3:
                $quizFile = 'C:/xampp/htdocs/WT CP/ProficiencyEvaluation/quizData/quiz_easy.json';
                break;
            default:
                echo "Invalid proficiency level for subject " . $subject . ".<br>";
                break; // Skip to the next iteration of the loop
        }

        if (!empty($quizFile) && file_exists($quizFile)) {
            $quizData = json_decode(file_get_contents($quizFile), true);
            $testScores[$subject] = "<script>conductTest(" . json_encode($quizData) . ")</script>";
        } else {
            echo "Quiz file not found for subject " . $subject . ".<br>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Game</title>
    <link rel="stylesheet" href="quiz2.css">
</head>
<body>
<div id="quiz-container">
    <h2>Quiz Game</h2>
    <div id="question"></div>
    <div id="options"></div>
    <button id="submit-btn">Submit Answer</button>
    <div id="result"></div>
    <div id="timer">Time Remaining: <span id="time">0</span> seconds</div>
</div>
<script src="../ProficiencyEvaluation/js/evaluationJS.js"></script>
<?php
foreach ($testScores as $subject => $score) {
    echo $score;
}
?>
</body>
</html>
