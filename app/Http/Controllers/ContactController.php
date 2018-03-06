<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\InboxMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;
use App\Contact;

class ContactController extends Controller
{
    public function show() 
	{
		return view('contact');
	}

	public function mailToAdmin(ContactFormRequest $message, Contact $admin)


	{        //send the admin an notification

		
		$admin->notify(new InboxMessage($message));
		// redirect the user back
		return redirect()->back()->with('message', 'thanks for the message! We will get back to you soon!');
	}
}
