<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class PagesController extends Controller
{
    public function index() {
        $title = 'Добро пожаловать на LaravelBlog!';
        return view('pages.index')->with('title', $title);
    }
    
    public function about() {
        $title = 'GitHub repo:';
        return view('pages.about')->with('title', $title);
    }

    public function contact() {
        return view('pages.contact');
    }

    public function postContact(Request $request) {
        $this->validate($request ,[
            'name' => 'required|regex:[(?:[A-Za-zА-Яа-я\s\'])]',
            'phone' => 'required|regex:[(\+38\([0-9]{3,}\)-[0-9]{3,}-[0-9]{2,}-[0-9]{2,})]',
            'email' => 'required|email',
            'body' => 'required|min:10',
            'g-recaptcha-response' => 'required|recaptcha'
        ]);
        
        $mailData = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'body' => $request->body
        ];
        \Mail::send('emails.contact', $mailData, function($msg) use ($mailData){
            $msg->from($mailData['email']);
            $msg->to('burrynter@gmail.com');
            $msg->subject('Обратная связь');
        });

        return redirect('/contact')->with('success', 'Сообщение отправлено');
    }
}