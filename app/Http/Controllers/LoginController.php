<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
//use App\Models\Customer;
use App\Models\User;



class LoginController extends Controller
{
    public function index(){
        return view('user.login');
    }
   
    public function authenticate(Request $request){
        $validator = Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required'
        ]);
       
        if($validator->passes()){
           if(Auth::guard('web')->attempt(['email'=> $request->email,'password'=> $request->password])){
            if(Auth::guard('web')->user()->role!="customer"){
                Auth::guard('web')->logout();
                return redirect()->route('account.login')->with('error','you have not authorised to access this page');
            }
             return view('user.index');
           }else{
            return redirect()->route('account.login')->with('error','either email or password incorrect');
           }
        }else{
            return redirect()->route('account.login')->withInput()->withErrors($validator);
        }
    }
public function register(){
    return view('user.register');
}
public function processRegister(Request $request){
    $validator = Validator::make($request->all(),[
        'name'=> 'required',
        'email'=>'required|email|unique:users',
        'password'=>'required'
    ]);
    if($validator->passes()){
       $user = new User();
       $user->name = $request->name;
       $user->email = $request->email;
       $user->password = Hash::make($request->password);
       $user->role = 'customer';
       $user->save();
       return redirect()->route('account.login')->with('success','you have registered successfully');
    }else{
        return redirect()->route('account.register')->withInput()->withErrors($validator);
    }

}

}
