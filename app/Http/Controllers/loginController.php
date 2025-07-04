<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{ 
    //middleware para usuario noo activo. terminar de construir....
    public function __construct()
    {
        $this->middleware('Check_user_estado', ['only' => ['login']]);
    }
    // agregamos view y redirectResponse para evitar el error al cargar otra pagina, un ejemplo si cargamos 
    // login que auto redirija al cpanel y verifique si el usuario tiene los permiso.
    public function index(): View|RedirectResponse
    {
        if(Auth::check()){
            return redirect()->route('panel');
        }
        return view('auth.login');
    }

    public function login(loginRequest $request){

        //Validar credenciales
        if(!Auth::validate($request->only('email','password'))){
            return redirect()->to('login')->withErrors('Credenciales incorrectas');
        }

        //Crear una sesión
        $user = Auth::getProvider()->retrieveByCredentials($request->only('email','password')); 
        Auth::login($user);

        return redirect()->route('panel')->with('login', 'Bienvenido '.$user->name);

    }
}
