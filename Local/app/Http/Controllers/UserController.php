<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function register(Request $req){
    	$name = $req->input("fname");
    	$password = $req->input("passwd");
    	$nickname = $req->input("nickn");
    	$avatar = $req->input("avatar");
    	$type = $req->input("radio");

        $error = "";

        if(\App\User::verificarDatos($name,$password,$nickname,$avatar,$type)){
            
            if(\App\User::validar_clave($password,$error)){

                $user = \App\User::crearVectorDatos($name,$type,$password,$nickname,$avatar);
                \App\User::create($user);
                return Redirect::to('hm')->with('message', 'Registrado Correctamente');

            }else{

                return Redirect::to('reg')->with('message', $error);

            }

            
        }

    	else{
            return Redirect::to('reg')->with('message', 'llene todos los campos');
        }
    }


    public function login(Request $req)
    {
        $nickname = Input::get('nickname');
        $password = Input::get('password');

		$user = \App\User::where('nickname',$nickname);
		$passconf = $user->value('password');
		
		if($password == $passconf){
            $id = $user->value('id');
            $req->session()->put('idUser', $id);
            $name = $user->value('name');
            session()->put('name', $name);
            $type = $user->value('type');
            session()->put('type', $type);

			return view('home');
		}
        else{

            return Redirect::to('inicioSesion')->with('message', 'Campos incorrectos');
        }
  


        
    }


    public function usuarios(Request $req)  //SE VERIFICA EL TIPO DE USUARIO, PARA MOSTRARLE SEGÚN SUS PRIVILEGIOS
    {
        $user = \App\User::usuarioSesionId($req);
        $type = \App\User::verificarRol($req);
        if(\App\User::usuarioStatus($req)==false){
            return Redirect::to('/');
        }
        else
        {
            if($type=='A'&& $user!=null){
          $allUsers = DB::table('users')->get();
          return view('MostrarUsuarios')->with('users', $allUsers)->with('idUser', $user)->with('type',$type); 
        }
        elseif($type=='P'){
            $allUsers= DB::table('users')->where('type', 'P')->get();
            return view('MostrarUsuarios')->with('users', $allUsers)->with('idUser', $user)->with('type',$type);
        }
        elseif($type=='U'){
            $allUsers= DB::table('users')->where('type', 'U')->get();
            return view('MostrarUsuarios')->with('users', $allUsers)->with('idUser', $user)->with('type',$type);
        }
        }
        


       

    }

    public function logout(Request $req){
        session()->forget('idUser');
        return Redirect::to('/');
    }


    public function borrarUsuario(Request $req){
        $type = \App\User::verificarRol($req);

        $borrado= Input::get('id');
        if ($type=='A') {
            DB::delete('delete from users where id='.$borrado);
            return Redirect::to("hm")->with('message','Usuario Eliminado Correctamente');
        }
        else{
            return view("Errores.404");
        }

    }
}

