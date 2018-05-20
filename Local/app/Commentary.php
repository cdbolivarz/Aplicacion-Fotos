<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commentary extends Model
{
	public $timestamps = false;
	protected $table = "COMMENTARY";
	protected $fillable = ['author','idUser','idImage','description'];
    
    public function image(){
    	return $this-> belongsTo('App\Image');
    }
    public function user(){
    	return $this-> belongsTo('App\User');
    }
}
