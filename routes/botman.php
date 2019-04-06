<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('Hi  ', function ($bot) {
    $bot->reply('Hello!');
});
$botman->hears('/start', function ($bot) {
    $nombres=$bot->getUser()->getFirtName()?:"desconocido";
    $bot->reply ('hola'.$nombres.'bienvenido al bot quizzes'
    
});

$botman->hears('Start conversation', BotManController::class.'@startConversation');
