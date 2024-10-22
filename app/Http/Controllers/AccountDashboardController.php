<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class AccountDashboardController extends Controller
{
    //
    public function index(){
        return view('user.index');
    }
    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('account.login');
    }
}
