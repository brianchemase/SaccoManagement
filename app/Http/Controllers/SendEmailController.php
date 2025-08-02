<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Mail;
use App\Mail\PyrethrumIntroductionMail;

use Illuminate\Http\Request;

class SendEmailController extends Controller
{
    //


    public function showForm()
    {
        return view('register');
    }

    public function sendEmails(Request $request)
    {
        $emails = $request->input('email');
        $names = $request->input('name');

        for ($i = 0; $i < count($emails); $i++) {
            $email = $emails[$i];
            $name = $names[$i];

            try {
                Mail::to($email)->send(new PyrethrumIntroductionMail($name));
                echo "Email sent to {$email}<br>";
            } catch (\Exception $e) {
                echo "Failed to send to {$email}. Error: {$e->getMessage()}<br>";
            }
        }
    }
}
