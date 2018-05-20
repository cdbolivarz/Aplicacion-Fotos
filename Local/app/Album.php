<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
	public $timestamps = false;
    protected $table = "album";
    protected $fillable = ['name','description','idUser'];

    public function user(){
    	return $this-> belongsTo('App\User');
    }

    public function imagexalbums(){
    	return $this-> belongsTo('App\ImagexAlbum');
    }

        public static function albumSesionId($req){

        $id = $req->session()->get('albumant', function() {});

        return $id;

    }
}
