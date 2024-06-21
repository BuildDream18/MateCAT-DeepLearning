<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactForm;
use App\Mail\ContactUsMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;


class ContactUsController extends Controller
{

    public function contactFrom(ContactForm $request)
    {


        $files = [];

        if ($request->hasfile('files')) {
            $files = $request->file('files');
        }


        if (RateLimiter::tooManyAttempts('send-message:' . $request->email, $perMinute = 1)) {
            return 'Too many attempts!';
        }

        try {
            Mail::to("translate@epictranslations.com")->send(new ContactUsMail($request->name, $request->email, $request->subject, $request->message, $files));
        } catch (\Exception $exception) {
            return "Oops! There was some error sending the email.";
        }


        if (Mail::failures() != 0) {
            return "Email has been sent successfully.";
        }
        return "Oops! There was some error sending the email.";
    }
}
