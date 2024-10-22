<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserList;


class UserManagementController extends Controller{

    //
    public function index($role_id){
        $roles = [
            0 => 'Trainee',
            1 => 'Developer',
            2 => 'Senior Developer',
            3 => 'Team Lead',
            4 => 'CTO'
        ];
        $roleName = $roles[$role_id] ?? 'user';

        return view('admin.UserList.AddUser',  compact('role_id', 'roleName'));
    
    }
    public function saveUser(Request $request, $role_id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email'     => 'required|email',
            'gender'    => 'required',
            'phone'     => 'required|min:10|max:10',
            'status'    => 'required',
            'address'   => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('add.user', ['role_id' => $role_id])->withErrors($validator)->withInput();              
                             
        }

        $userlist = new UserList();
        $userlist->first_name  =    $request->first_name;
        $userlist->last_name   =    $request->last_name;
        $userlist->email       =    $request->email;
        $userlist->phone       =    $request->phone;
        $userlist->gender      =    $request->gender;
        $userlist->address     =    $request->address;
        $userlist->status      =    $request->status;
        $userlist->role_id     =    $role_id; 
        $userlist->save();
        $roleNames = [
            0 => 'Trainee',
            1 => 'Developer',
            2 => 'Senior Developer',
            3 => 'Team Lead',
            4 => 'CTO'
        ];
    
        $roleName = $roleNames[$role_id] ?? 'User';

        return redirect()->route('show.list', ['role_id' => $role_id])->with('success', "{$roleName} added successfully");
                         
    }
    public function showList(Request $request, $role_id)
    {
        $userquery = UserList::where('role_id', $role_id);
        
        if (!empty($request->search)) {
            $search = $request->search;
            $userquery->where(function($userquery) use ($search) {
                $userquery->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
            });
        }
        $userslist = $userquery->get();
        $roles = [
            0 => 'Trainee',
            1 => 'Developer',
            2 => 'Senior Developer',
            3 => 'Team Lead',
            4 => 'CTO'
        ];
        $roleName = $roles[$role_id] ?? 'User';
    
        return view('admin.UserList.UserList', compact('userslist', 'role_id', 'roleName'));
    }

    public function edituser($role_id, $user_id)
    {
        $user = UserList::find($user_id);
        
        if (!$user) {
            return redirect()->route('show.list', ['role_id' => $role_id])->with('error', 'User not found');
        }
    
        $roleNames = [
            0 => 'Trainee',
            1 => 'Developer',
            2 => 'Senior Developer',
            3 => 'Team Lead',
            4 => 'CTO'
        ];
        
        $roleName = $roleNames[$role_id] ?? 'User';
    
        return view('admin.UserList.edit', compact('user', 'role_id', 'roleName'));
    }
    
    public function UpdateUser(Request $request, $user_id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'gender'     => 'required|string',
            'phone'      => 'required|min:10|max:10',
            'status'     => 'required|string',
            'address'    => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();                  
        }
    
        $user = UserList::find($user_id);
        
        if (!$user) {
            return redirect()->route('show.list')->with('error', 'User not found');
        }
    
        $user->first_name  =    $request->first_name;
        $user->last_name   =    $request->last_name;
        $user->email       =    $request->email;
        $user->phone       =    $request->phone;
        $user->gender      =    $request->gender;
        $user->address     =    $request->address;
        $user->status      =    $request->status;
        
        $user->save();

        $roleNames = [
            0 => 'Trainee',
            1 => 'Developer',
            2 => 'Senior Developer',
            3 => 'Team Lead',
            4 => 'CTO'
        ];
    
        $roleName = $roleNames[$user->role_id] ?? 'User';
    
        return redirect()->route('show.list', ['role_id' => $user->role_id])->with('success', "{$roleName} updated successfully");
                         
    }
    
    public function deleteUser($user_id)
    {
        $user = UserList::find($user_id);
        if (!$user) {
            return redirect()->route('show.list')->with('error', 'User not found');
        }
    
        $role_id = $user->role_id;
    
        $user->delete();
    
        $roleNames = [
            0 => 'Trainee',
            1 => 'Developer',
            2 => 'Senior Developer',
            3 => 'Team Lead',
            4 => 'CTO'
        ];
    
        $roleName = $roleNames[$role_id] ?? 'User';
    
        return redirect()->route('show.list', ['role_id' => $role_id])->with('success', "{$roleName} deleted successfully");
                         
    }
}
