<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AlbumController extends Controller
{
	public function create(Request $req){


		$name = $req->input("fname");
    	$descripcion = $req->input("descripcion");
        $user = \App\User::usuarioSesionId($req);

   
        if($user!=null && $name!= "" && $descripcion!=""){
    	   $album = ['name' => $name,'description' =>$descripcion,'idUser' =>$user];
            \App\Album::create($album);
            return Redirect::to('hm')->with('message', 'Album creado correctamente');
        }else{
           return Redirect::to('crearAlbum')->with('message', 'llene todos los campos');
        }
    	

    }

    public function showOwn(Request $req){
        $user = \App\User::usuarioSesionId($req);
        
        if(\App\User::usuarioStatus($req)){
             $allAlbum = \App\Album::where('idUser',$user)->get(); //MUESTRA MIS ALBUMES
            return view('albumes')->with('albums', $allAlbum);
        }
        else{
            return Redirect::to('/');
        }
        
       
    }
    
    public function showOthers($idUser ,Request $req){
        
        $user =\App\User::usuarioSesionId($req);
        $type = \App\User::verificarRol($req);
       

        $allAlbum = \App\Album::where('idUser',$idUser)->get();

        if(sizeof($allAlbum)!=0){

        $verificacionRol = \App\User::where('id',$allAlbum[0]->idUser)->get();

        

        if(\App\User::usuarioStatus($req) && $type==($verificacionRol[0]->type)|| $type=='A'){
             return view('albumesOtros')->with('albums', $allAlbum);   //MUESTRA LOS ALBUMES DE OTRO USUARIO
        }
        else{
            
            return Redirect::to('/');
        }

      }else{
        return Redirect::to('hm')->with('message','Este usuario no tiene albumes');
         
    }

      
    }
}
