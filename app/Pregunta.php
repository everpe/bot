<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    //Pertece a un solo quiz
    public function quiz()
    {
	    return $this->belongsTo('App\Quiz');
    }


}
