<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Trivia</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>

    </style>
</head>
<body class="antialiased">
<div
    class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    <h1>Trivia game</h1>

    <div class="container">
        <div id="question">
            <strong>Question:</strong>
            <div></div>
        </div>
        <div id="answers">
            <strong>Possible answers, choose one:</strong>
            <div></div>
        </div>
        <div id="message">
            <div></div>
        </div>
        <div id="newgame">
            <div>
                <button>Start new game!</button>
            </div>
        </div>
        <div id="loading">
            <div>Loading...</div>
        </div>
    </div>
</div>
</body>

</html>
