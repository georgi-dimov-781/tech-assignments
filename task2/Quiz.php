<?php

require_once 'Question.php';

class Quiz {
    private $questions = [];

    public function addQuestion($question) {
        $this->questions[] = $question;
    }

    public function renderForm() {
        $html = '<form method="POST" action="">';

        foreach ($this->questions as $index => $question) {
            $html .= '<div style="margin-bottom: 20px;">';
            $html .= '<p><strong>Question ' . ($index + 1) . ':</strong> ' . htmlspecialchars($question->getText()) . '</p>';

            foreach ($question->getAnswers() as $answerKey => $answerText) {
                $html .= '<label style="display: block; margin-left: 20px;">';
                $html .= '<input type="radio" name="question_' . $index . '" value="' . $answerKey . '">';
                $html .= ' ' . htmlspecialchars($answerText);
                $html .= '</label>';
            }

            $html .= '</div>';
        }

        $html .= '<button type="submit" name="submit">Submit Answers</button>';
        $html .= '</form>';

        return $html;
    }

    public function validateAnswers($submittedAnswers) {
        $score = 0;
        $results = [];

        foreach ($this->questions as $index => $question) {
            $userAnswer = isset($submittedAnswers['question_' . $index]) ? $submittedAnswers['question_' . $index] : null;
            $isCorrect = $question->isCorrect($userAnswer);

            if ($isCorrect) {
                $score++;
            }

            $results[] = [
                'question' => $question->getText(),
                'correct' => $isCorrect
            ];
        }

        return [
            'score' => $score,
            'total' => count($this->questions),
            'results' => $results
        ];
    }
}
