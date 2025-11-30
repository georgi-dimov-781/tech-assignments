<?php

require_once 'Quiz.php';
require_once 'Question.php';

$quiz = new Quiz();

// Add 3 questions with variable number of answers
$quiz->addQuestion(new Question(
    "What is the capital of France?",
    ['a' => 'London', 'b' => 'Paris', 'c' => 'Berlin', 'd' => 'Madrid'],
    'b'
));

$quiz->addQuestion(new Question(
    "Which programming language is this quiz written in?",
    ['a' => 'JavaScript', 'b' => 'Python', 'c' => 'PHP'],
    'c'
));

$quiz->addQuestion(new Question(
    "What is 2 + 2?",
    ['a' => '3', 'b' => '4', 'c' => '5', 'd' => '6', 'e' => '22'],
    'b'
));

?>
<!DOCTYPE html>
<html>
<head>
    <title>Quiz App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
        }
        .result {
            background-color: #f0f0f0;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Simple Quiz</h1>

    <?php
    if (isset($_POST['submit'])) {
        $validation = $quiz->validateAnswers($_POST);

        echo '<div class="result">';
        echo '<h2>Results</h2>';
        echo '<p>You scored ' . $validation['score'] . ' out of ' . $validation['total'] . '</p>';

        foreach ($validation['results'] as $index => $result) {
            $status = $result['correct'] ? '✓' : '✗';
            echo '<p>' . ($index + 1) . '. ' . $result['question'] . ' - ' . $status . '</p>';
        }

        echo '</div>';
        echo '<a href="">Try Again</a>';
    } else {
        echo $quiz->renderForm();
    }
    ?>
</body>
</html>
