<?php

namespace App\Http\Services;

use App\Models\User;
use App\Http\Services\EmailService; 
use Illuminate\Support\Facades\Hash;

class RegisterService extends AppService
{
    public function register($data)
    {
        $response = array();

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->role = 'admin';
        $user->verified_at = false;
        $user->remember_token = $this->createToken(60); 
        $user->save();

        $emailService = new EmailService();
        $emailService->sendEmail([
            'email' => $user->email,
            'token' => $user->remember_token,
            'subject' => 'Registered Successfully'
        ]);

        $response['status'] = 'success';
        $response['message'] = 'You have registered successfully. Verification link sent to your email. Please verify it first.';

        return $response;
    }
}
