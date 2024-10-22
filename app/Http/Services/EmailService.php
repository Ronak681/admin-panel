<?php
namespace App\Http\Services;
use App\Models\User;
use App\Http\Services\AppService;
use Illuminate\Support\Facades\Mail;
class EmailService extends AppService{

public function sendEmail($data){

    $token  =   $data['token'];

    Mail::send('admin.registermail',['token' => $token],function ($message) use ($data){
        $message->to($data['email']);
        $message->subject($data['subject']);
        $message->from('ronakmaheshwari200@gmail.com','Laravel');
    });

    return;
}


}