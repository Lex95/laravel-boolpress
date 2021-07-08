<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendNewMail as MailSendNewMail;
use App\SendNewMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function contact() {
        return view("posts.sendMail");
    }

    public function send(Request $request) {
        Mail::to("admin@gmail.com")->send(new MailSendNewMail($request->content));
        return redirect()->route("posts.index");
    }
}
