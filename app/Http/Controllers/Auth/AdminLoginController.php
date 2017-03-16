<?php

namespace vapj\Http\Controllers\Auth;

use Illuminate\Http\Request;
use vapj\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Auth;
class AdminLoginController extends Controller
{
   public function __construct(){
   	$this->middleware('guest:admin', ['except' => ['logout']]);
   }

   public function getLoginForm(){
       return view('admin.login');
   }

   public function postLoginForm(Request $request){
   	$this->validate($request, [
   		'email' => 'required|email',
   		'senha' => 'required|min:6'],
      [
        'required' => 'o campo :attribute é obrigatório',
        'email' => 'insira um e-mail válido',
        'senha.min' => 'A senha deve ter no mínimo 6 caracteres'
      ]);

   	if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->senha], $request->has('remember'))){
			return redirect()->intended(route('admin.dashboard'));
   	}

   	return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
           'email' => Lang::get('auth.failed'),
       ]);
   }

   //Desloga administrador da aplicação
   public function logout(Request $request){
      Auth::guard('admin')->logout();     
      if(!Auth::user()){
          $request->session()->flush();
          $request->session()->regenerate();
      }
      return redirect(route('admin.login'));
   }
}
