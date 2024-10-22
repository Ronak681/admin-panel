<?php
namespace App\Http\Services;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\EmailService;
use DB,Hash,Mail;

class LoginService extends AppService{

    public function authenticate($data)
    {
        $email = $data['email'];
        $password = $data['password'];
        $response = array();

        $user = User::where('email', $email)->first();

        if ($user) {
            if ($user->role == 'admin') {
                if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password])) {
                    $user = Auth::guard('admin')->user();

                    if ($user->verified_at == 1) {
                        $response['status'] = true;
                        $response['message'] = 'Logged in successfully.';
                        $response['data'] = [];
                    } else {
                        $response['status'] = false;
                        $response['message'] = 'Your account is not verified yet. Please verify your account.';
                        $response['data'] = [];
                    }
                } else {
                    $response['status'] = false;
                    $response['message'] = 'Invalid credentials.';
                    $response['data'] = [];
                }
            } else {
                $response['status'] = false;
                $response['message'] = 'You are not authorized to access this page.';
                $response['data'] = [];
            }
        } else {
            $response['status'] = false;
            $response['message'] = 'User not found.';
            $response['data'] = [];
        }

        return $response;
    }

}

