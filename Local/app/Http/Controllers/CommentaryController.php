<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\View;

class CommentaryController extends Controller
{
    public function createComment(Request $req){
    	$description = $req->input('comentario');

    	$user = \App\User::usuarioSesionId($req);
        $idImage = $req->session()->get('idImage', function() {
            return view('inicioSesion');
        });
        $author = \App\User::where('id',$user)->get()[0]->name;
        $newCommentary = ['author' => $author,'idUser' => $user, 'idImage' => $idImage, 'description' => $description];
        \App\Commentary::create($newCommentary);

    	$image = \App\Image::where('id',$idImage)->get()[0];
    	$comments = \App\Commentary::where('idImage',$idImage)->get();
    	$req->session()->flash('idImage', $image->id);
    	return view('infoImage')->with('image',$image)->with('comments',$comments);


    }


}
