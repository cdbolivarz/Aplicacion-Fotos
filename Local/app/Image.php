<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
	public $timestamps = false;
    protected $table = "IMAGE";
    protected $fillable = ['prop','title','description','photo'];

    public function comments()
    {
        return $this->hasMany('App\Commentary');
    }

    public function imagexalbums(){
    	return $this-> belongsTo('App\ImagexAlbum');
    }

        public static function crearVectorDatos($user,$name,$description,$destino){
        $image = ['prop'=>$user,'title' => $name,'description' =>$description,'photo' =>$destino];
        return $image;
    }

        public static function imagenSesionId($req){

        $id = $req->session()->get('idImagen', function() {});

        return $id;

    }

     public static function verificarDatos($nombre,$descripcion,$ruta){
        if($nombre != "" && $descripcion != "" && ($ruta=="image/png" || $ruta=="image/jpeg") ) return true;
        return false;
     }
}
