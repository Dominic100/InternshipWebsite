document.addEventListener("DOMContentLoaded", function() {
    const questionElement = document.getElementById("question");
    const optionsElement = document.getElementById("options");
    const resultElement = document.getElementById("result");
    const submitButton = document.getElementById("submit-btn");

    // Function to conduct the quiz
    window.conductTest = function(quizData) {
        let score = 0;
        let currentQuestionIndex = 0;

        // Function to display the current question
        function displayQuestion() {
            const currentQuestion = quizData[currentQuestionIndex];
            questionElement.textContent = currentQuestion.question;
            optionsElement.innerHTML = "";
            currentQuestion.options.forEach(option => {
                const button = document.createElement("button");
                button.textContent = option;
                button.addEventListener("click", () => checkAnswer(option, currentQuestion.answer));
                optionsElement.appendChild(button);
            });
        }

        // Display the first question initially
        displayQuestion();

        // Function to check the answer
        function checkAnswer(selectedAnswer, correctAnswer) {
            if (selectedAnswer === correctAnswer) {
                resultElement.textContent = "Correct!";
                score++; // Increment the score for correct answers
            } else {
                resultElement.textContent = "Wrong!";
            }

            // Move to the next question if available
            currentQuestionIndex++;
            if (currentQuestionIndex < quizData.length) {
                displayQuestion(); // Display the next question
            } else {
                // Quiz finished, display the final score
                resultElement.textContent = "Quiz finished! Your score: " + score + "/" + quizData.length;
            }
        }

        return score; // Return the final score
    };


    // Function to check the answer
    function checkAnswer(selectedAnswer, correctAnswer) {
        if (selectedAnswer === correctAnswer) {
            resultElement.textContent = "Correct!";
        } else {
            resultElement.textContent = "Wrong!";
        }
    }
});
