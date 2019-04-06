<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('Hi  ', function ($bot) {
    $bot->reply('Hello!');
});
$botman->hears('/start', function ($bot) {
    $nombres=$bot->getUser()->getFirtName()?:"desconocido";
    $bot->reply ('hola'.$nombres.'bienvenido al bot quizzes');
});

$botman->hears('Start conversation', BotManController::class.'@startConversation');

$botman->fallback(function($bot){
    $bot->reply("no entiendoooo");
});


$botman->hears('/ayuda', function ($bot) {
	$ayuda = ['/ayuda' => 'Mostrar este mensaje de ayuda',
          	'acerca de|acerca' => 'Ver la información quien desarrollo este lindo bot',
          	'listar quizzes|listar' => 'Listar los cuestionarios disponibles',
          	'iniciar quiz <id>' => 'Iniciar la solución de un cuestionario',
          	'ver puntajes|puntajes' => 'Ver los últimos puntajes',
          	'borrar mis datos|borrar' => 'Borrar mis datos del sistema'];
    
	$bot->reply("Los comandos disponibles son:");

	foreach($ayuda as $key=>$value)
	{
    		$bot->reply($key . ": " . $value);
	}
});
