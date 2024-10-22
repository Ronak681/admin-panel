<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class ChangePasswordController extends Controller
{
    public function index(){
        return view('admin.changePassword');
    }
   
    
    public function changePassword(Request $request)
    {
        $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|min:2|confirmed',
            'new-password_confirmation' => 'required|min:2', 
               ]);
        
        if (!Hash::check($request->input('current-password'), Auth::guard('admin')->user()->password)) {
            return redirect()->back()->with('error','current password does not match')->withInput();
        }
        if (Hash::check($request->input('new-password'),  Auth::guard('admin')->user()->password)) {
            return redirect()->back()->with('error', 'New password cannot be the same as the current password')->withInput();
        }
        $user = Auth::guard('admin')->user();
        $user->password = Hash::make($request->input('new-password'));
        $user->save();
        
        return redirect()->route('admin.dashboard')->with('success', 'Password changed successfully!');
    }
    }

