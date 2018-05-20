<?php

namespace App;

include("Person.php");


class User extends Person
{
   
    protected $fillable = [
        'name','type', 'password','nickname', 'avatar'
    ];
    protected $hidden = ['password'];

    public function comments()
    {
        return $this->hasMany('App\Commentary');
    }

    public function albums()
    {
        return $this->hasMany('App\Album');
    }

    public static function crearVectorDatos($name,$type,$password,$nickname,$avatar){
        $user = ['name' => $name,'type' =>$type,'password' =>$password,'nickname' =>$nickname,'avatar' =>$avatar];
        return $user;
    }

    public static function verificarRol($req){

        $rol = $req->session()->get('type', function() {});

        return $rol;

    }

    public static function usuarioSesionId($req){

        $id = $req->session()->get('idUser', function() {});

        return $id;

    }

    public static function verificarDatos($name,$password,$nickname,$avatar,$type){

        if($name!=''&&$password!=''&&$nickname!=''&&$avatar!=''&&$type!=''){
            return true;
        }
        else
            return false;

    }
    public static function usuarioStatus($req){

        $user=\App\User::usuarioSesionId($req);
        if ($user==null) {
            return false;
        }
        else
            return true;

    }

    public static function validar_clave($clave,&$error_clave){
        if(strlen($clave) < 6){
          $error_clave = "La clave debe tener al menos 6 caracteres";
          return false;
       }
       if(strlen($clave) > 16){
          $error_clave = "La clave no puede tener más de 16 caracteres";
          return false;
       }
       if (!preg_match('`[a-z]`',$clave)){
          $error_clave = "La clave debe tener al menos una letra minúscula";
          return false;
       }
       if (!preg_match('`[A-Z]`',$clave)){
          $error_clave = "La clave debe tener al menos una letra mayúscula";
          return false;
       }
       if (!preg_match('`[0-9]`',$clave)){
          $error_clave = "La clave debe tener al menos un caracter numérico";
          return false;
       }
       $error_clave = "";
       return true;
    }
}
