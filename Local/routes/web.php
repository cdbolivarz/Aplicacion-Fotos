<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('layouts.ini');
});
Route::get('inicioSesion', function (Request $request) {
	$user = \App\User::usuarioSesionId($request);
	if($user!=null) return Redirect::to('/hm');
    return view('inicioSesion');
});
Route::get('reg', function (Request $request) {
	$user = \App\User::usuarioSesionId($request);
	if($user!=null) return Redirect::to('/hm');
    return view('registrarse');
});

Route::get('crearAlbum', function () {
    return view('makeAlbum');
});

Route::get('fotos', function () {
    return Redirect::to('/');
});

Route::get('urlfoto', function (Request $request) {
	$user = \App\User::usuarioSesionId($request);
	$request->session()->reflash();
	if($user==null) return Redirect::to('/');
    return view('SubirFoto');
});
Route::get('hm',function(){return view('home');});


Route::get("MostrarUsuarios", 'UserController@usuarios');
Route::get("logout", "UserController@logout");
Route::get("borrarUsuario", "UserController@borrarUsuario");
Route::post('login','UserController@login');
Route::post('register','UserController@register');



Route::post('crearFoto', 'ImageController@createPhoto');
Route::get('infoFoto', 'ImageController@CrudPhoto');
Route::get('albumEtiquetado/{idAlbum}/{idUser}', 'ImageController@etiquetar');
Route::post('actualizarFoto', 'ImageController@actualizarPhoto');
Route::get('albumSeleccionado/{idAlbum}/{idUser}','ImageController@myPhotos');
Route::get('albumSelect/{idAlbum}/{idUser}','ImageController@OtherPhotos');
Route::get('cambiarPosiciones', 'ImageController@changePosition');


Route::post('crearAlbum','AlbumController@create');
Route::post('/create','AlbumController@create');
Route::get('mostrarMisAlbumes', 'AlbumController@showOwn');
Route::get('UsuarioSeleccionado/{id}','AlbumController@showOthers');


Route::post('Comentario','CommentaryController@createComment');

