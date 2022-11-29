import './bootstrap';

window.onload = function () {
    const questionElement = document.querySelector('#question > div');
    const questionBlock = document.querySelector('#question');
    const answersElement = document.querySelector('#answers > div');
    const answersBlock = document.querySelector('#answers');
    const messageElement = document.querySelector('#message > div');
    const newGameBlock = document.querySelector('#newgame');
    const loadingBlock = document.querySelector('#loading');
    const answerElementClass = 'selected-answer';
    var chosenAnswer = '';

    function renderQuestion() {
        nexQuestion();
    }

    newGameBlock.addEventListener('click', () => startNewGame());

    function nexQuestion() {

        showLoader();
        fetch(`/game?answer=${chosenAnswer}`)
            .then((response) => response.json())
            .then(data => {
                hideLoader();

                messageElement.innerHTML = `<div>${data.message.text}</div>`;

                if (data.message.type == 'success') {
                    messageElement.style.color = 'green';
                } else if (data.message.type == 'alert') {
                    messageElement.style.color = 'red';
                } else {
                    messageElement.style.color = 'black';
                }

                if (data.isGameOver) {
                    gameClosed();
                } else {
                    gameOpened();
                }

                questionElement.textContent = data.question;

                let answers = data.answers ? data.answers : [];

                answersElement.innerHTML = answers.map(answer => {
                    return (`<div><button class="${answerElementClass}">${answer}</button></div>`);
                }).join('');

                document.querySelectorAll(`.${answerElementClass}`).forEach(el => {
                    el.addEventListener('click', (el) => submitAnswer(el.target.textContent))
                })
            });

    }

    function startNewGame() {
        renderQuestion();
    }

    function submitAnswer(answer) {
        chosenAnswer = answer;
        renderQuestion();
    }

    function gameClosed() {
        questionBlock.style.display = 'none';
        answersBlock.style.display = 'none';
        newGameBlock.style.display = 'block';
    }

    function gameOpened() {
        questionBlock.style.display = 'block';
        answersBlock.style.display = 'block';
        newGameBlock.style.display = 'none';
    }

    function showLoader() {
        loadingBlock.style.display = 'block';
    }

    function hideLoader() {
        loadingBlock.style.display = 'none';
    }

    renderQuestion();
};
