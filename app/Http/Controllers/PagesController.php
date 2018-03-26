<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;

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

    public function contactAdmin() {
        return view('pages.contactAdmin');
    }

    public function contactUser() {
        $users = User::all();
        return view('pages.contactUser')->with('users', $users);
    }

    public function postContactAdmin(Request $request) {
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

        return redirect('/contactAdmin')->with('success', 'Сообщение отправлено');
    }

    public function postContactUser(Request $request) {
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
            'destination' => $request->destination,
            'body' => $request->body
        ];
        \Mail::send('emails.contact', $mailData, function($msg) use ($mailData){
            $msg->from($mailData['email']);
            $msg->to($mailData['destination']);
            $msg->subject('Сообщение от пользователя LaravelBlog');
        });

        return redirect('/contactUser')->with('success', 'Сообщение отправлено');
    }
}