<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Message;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('pages.contact');
    }
    
    public function send(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'subject' => 'required|min:3',
            'message' => 'required|min:5',
        ]);

        Mail::to(config('mail.admin.address'))->send(new Message($validated));

        return back()->with('message', 'Your message has been sent!');
    }
}
