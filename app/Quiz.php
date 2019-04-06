<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'enunciado','respuesta','opcion1','opcion2','opcion3','opcion4'
    ];
    
    //Un quiz tiene muchas preguntas
    public function preguntas()
    {
	    return $this->hasMany('App\Pregunta');
    }
    

    
}
