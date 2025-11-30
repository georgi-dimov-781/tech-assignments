<?php

class Question {
    private $text;
    private $answers;
    private $correctAnswer;

    public function __construct($text, $answers, $correctAnswer) {
        $this->text = $text;
        $this->answers = $answers;
        $this->correctAnswer = $correctAnswer;
    }

    public function getText() {
        return $this->text;
    }

    public function getAnswers() {
        return $this->answers;
    }

    public function isCorrect($userAnswer) {
        return $userAnswer === $this->correctAnswer;
    }
}
