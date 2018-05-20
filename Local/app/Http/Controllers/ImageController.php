<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\View;
use Illuminate\Support\Facades\Redirect;

class ImageController extends Controller
{
    public function createPhoto(Request $req){
    	$name = $req->input("fname");
    	$description = $req->input("descripcion");
    	$foto = $_FILES["foto"]["name"];
    	$ruta = $_FILES["foto"]["tmp_name"];
        $formato = $_FILES["foto"]["type"];
        $user = \App\User::usuarioSesionId($req);
        $req->session()->reflash();
    	$album =\App\Album::albumSesionId($req);

        if(\App\Image::verificarDatos($name,$description,$formato)){

    	$proxidImage = DB::select( DB::raw("SELECT AUTO_INCREMENT as prox FROM information_schema.TABLES
											WHERE TABLE_SCHEMA = 'baseapp' 
											AND TABLE_NAME = 'image'") );

    	$destino = "fotos/".$proxidImage[0]->prox.$foto;


    	$image = \App\Image::crearVectorDatos($user,$name,$description,$destino);

    	 $posOrder = DB::select( DB::raw("SELECT MAX(orderNumber) as cantidad FROM imagexalbum WHERE idAlbum = $album "));

    	$imagexalbum = ['idAlbum' => (int)$album, 'idImage' => (int)$proxidImage[0]->prox, 'orderNumber' => (int)$posOrder[0]->cantidad+1 ];

    	
    	\App\Image::create($image);
    	\App\ImagexAlbum::create($imagexalbum);

    	
    	copy($ruta,$destino);

		
    	return Redirect::to('hm')->with('message','Foto subida Correctamente');
    }else{
        return Redirect::to('urlfoto')->with('message','ingrese datos correctos(solo formato png o jpg)');
    }
    }


//Validacion del album seleccionado y usuario correcto de acuerdo a la sesion
    public function myPhotos($idAlbum,$idUser,Request $req){

    $user = \App\User::usuarioSesionId($req);

    //Enviar el id del album solamente para la siguiente sesion
	$req->session()->flash('albumant', $idAlbum);
    $Album=\App\Album::where('id',$idAlbum)->get()[0];
    //Enviar el idUsuario del dueño solamente para la siguiente sesion
    $req->session()->flash('duenio', $Album->idUser);


	if($user == $idUser){

	$images = DB::table('Image')
            ->join('ImagexAlbum', 'Image.id', '=', 'ImagexAlbum.idImage')
            ->where('ImagexAlbum.idAlbum', $idAlbum)
            ->orderBy('ImagexAlbum.orderNumber', 'asc')
            ->select('Image.*')
            ->get();
    
            
		return view('misFotos')->with('images', $images)->with('idUser', $user);
	}else{
		return Redirect::to('/');
	}

    }


    public function CrudPhoto(Request $req)
    {
        $idImage=Input::get('idImage');
        $eliminar=Input::get('eliminar');
        $actualizar=Input::get('actualizar');
        $etiquetar=Input::get('etiquetar');
        $album = \App\Album::albumSesionId($req);
        $idImage = Input::get('idImage');
        $user = \App\User::usuarioSesionId($req);
        $Album=\App\Album::where('id',$album)->get()[0];

        $imagen = \App\Image::where('id',$idImage)->get()[0];

        $req->session()->reflash();

        if($eliminar){
            $type = \App\User::verificarRol($req);
        
            if ($imagen->prop == $user || $type=='A') {
                unlink($imagen->photo);
                DB::delete('delete from image where id='.$idImage);

            }
            else{
                DB::delete('delete from imagexAlbum where idImage='.$idImage.' and idAlbum ='.$album);
            }
             return Redirect::to('hm')->with('message','Foto Eliminada Correctamente');
             
        }
        elseif ($actualizar) {

            $image = \App\Image::where('id',$idImage)->get()[0];
            if ($image->prop==$user) {
                return view('actualizarfoto')->with('id',$idImage);
            }
            else{
                return view("Errores.404");
            }
        }
        elseif ($etiquetar) {
            $req->session()->flash('idImagen', $idImage);

            $allAlbum = \App\Album::where('idUser',$user)->get();
            return view('seleccionarAlbum')->with('albums',$allAlbum);
        }
        else{
        $image = \App\Image::where('id',$idImage)->get()[0];
        $comments = \App\Commentary::where('idImage',$idImage)->get();
        $req->session()->flash('idImage', $image->id);
        
        return view('infoImage')->with('image',$image)->with('comments',$comments);

        }
    	
    }


    public function OtherPhotos($idAlbum,$idUser,Request $req){
    $user = \App\User::usuarioSesionId($req);
    $type = \App\User::verificarRol($req);
    $req->session()->flash('albumant', $idAlbum);

    $allAlbum = \App\Album::where('id',$idAlbum)->get();

    if(sizeof($allAlbum)!=0){

        $verificacionRol = \App\User::where('id',$allAlbum[0]->idUser)->get();
        if($type==($verificacionRol[0]->type)||$type=='A'){

            $images = DB::table('Image')
            ->join('ImagexAlbum', 'Image.id', '=', 'ImagexAlbum.idImage')
            ->where('ImagexAlbum.idAlbum', $idAlbum)
            ->orderBy('ImagexAlbum.orderNumber', 'asc')
            ->select('Image.*')
            ->get();
            
        return view('ImagenesOtros')->with('images', $images)->with('idUser', $user)->with('type',$type);
    }else{
        return Redirect::to('/');
    }

    }else{
        return Redirect::to('hm')->with('message','Este usuario no tiene albumes');
         
    }


    }

    
    public function actualizarPhoto(Request $req){
        $idImage = $req->input("idImage");
        $name = $req->input("fname");
        $description = $req->input("descripcion");
        
        if($idImage!="" && $name!="" && $description!=""){
            \App\Image::where('id', $idImage)
            ->update(['title' => $name,'description'=>$description]);
            return Redirect::to('hm')->with('message','Foto Actualizada Correctamente');
        }else{
            echo 'llene todos los campos';
        }
    }


    public function etiquetar($idAlbum,$idUser ,Request $req){
        $user = \App\User::usuarioSesionId($req);

         $image = \App\Image::imagenSesionId($req);
         
        if ($user == $idUser) {
            try{
                $posOrder = DB::select( DB::raw("SELECT MAX(orderNumber) as cantidad FROM imagexalbum WHERE idAlbum = $idAlbum "));
                $values =['idAlbum'=>$idAlbum,'idImage'=>$image,'orderNumber' => (int)$posOrder[0]->cantidad+1 ];
                \App\ImagexAlbum::create($values);
                return Redirect::to('hm')->with('message','Etiquetado Correctamente');
            }catch(\Exception $ex){
                return Redirect::to('hm')->with('message','Ya etiquetaste esa imagen en este album');
            }
           
        }
        else{
            return view('home');
        }


    }
    public function changePosition(Request $req){
        $vectorhtml = Input::get('vectorCambios');
    
        //los valores de nuevo orden representan posiciones y vienen dadas desde 1
        $nuevoOrden = explode(",", $vectorhtml);
        $user = \App\User::usuarioSesionId($req);

        $idAlbum = \App\Album::albumSesionId($req);

        $images = DB::table('ImagexAlbum')
            ->join('Image', 'Image.id', '=', 'ImagexAlbum.idImage')
            ->where('ImagexAlbum.idAlbum', $idAlbum)
            ->orderBy('ImagexAlbum.orderNumber', 'asc')
            ->select('ImagexAlbum.*')
            ->get();

         $vectorOrdenado = $nuevoOrden;
         sort($vectorOrdenado);
         $i=0;
         foreach ($images as $as) {
                $i = $i + 1;
                if($vectorOrdenado[$i-1]!=$i){
                    return view('home');
                }
            }   
           
        $numaux = "";

        for ($i=0; $i < count($images); $i++) { 
            if(!( $vectorOrdenado[$i] == $nuevoOrden[$i])){
                $numaux = $images[(int)$vectorOrdenado[$i]-1]->orderNumber;
                \App\ImagexAlbum::where('idImage', $images[(int)$vectorOrdenado[$i]-1]->idImage)
                ->where('idAlbum', $images[(int)$vectorOrdenado[$i]-1]->idAlbum)
                ->update(['orderNumber' => $images[(int)$nuevoOrden[$i]-1]->orderNumber]);
                
                \App\ImagexAlbum::where('idImage', $images[(int)$nuevoOrden[$i]-1]->idImage)
                ->where('idAlbum', $images[(int)$nuevoOrden[$i]-1]->idAlbum)
                ->update(['orderNumber' => $numaux]);
                
                $vectorOrdenado[$i] = $nuevoOrden[$i];
            } 
        }

        return Redirect::to("hm")->with('message','Cambio de Posición Efectuado');
        

       
    }
   

    }


