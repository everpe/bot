<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('Hola', function ($bot) {
    $bot->reply('hola amiguito!');
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

$botman->hears('acerca', function ($bot) {   
    $msj="Creador Ever Peña B"; 
    $bot->reply ($msj);
});

$botman->hears('acerca de', function ($bot) {    
    $msj="Creador Ever Peña Ballesteros"; 
    $bot->reply ($msj);
});

$botman->hears('listar quizzes|listar', function ($bot) {
$quizzes = \App\Quiz::orderby('titulo', 'asc')->get();

foreach($quizzes as $quiz)
{
        $bot->reply($quiz->id."- ".$quiz->titulo);
}

if(count($quizzes) == 0)
        $bot->reply("Ups, no hay cuestionarios para mostrar.");
});

$botman->hears('iniciar quiz {id}', function ($bot, $id) {
	$bot->startConversation(
new \App\Conversations\RealizarQuizConversacion($id));
})->stopsConversation();
