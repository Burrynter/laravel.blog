<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\StaticPage;
use Auth;

class PagesController extends Controller
{
    public function index() {
        $title = 'Добро пожаловать на LaravelBlog!';
        return view('pages.index')->with('title', $title);
    }

    public function about() {
        $about = StaticPage::where('title', 'about')->first();
        return view('pages.about')->with('about', $about);
    }

    public function contactAdmin() {
        if (Auth::guest()) {
            return redirect('/login');
        }
        $contact = StaticPage::where('title', 'contact')->first();
        return view('pages.contactAdmin')->with('contact', $contact);
    }

    public function contactUser() {
        if (Auth::guest()) {
            return redirect('/login');
        }
        $users = User::all();
        $contact = StaticPage::where('title', 'contact')->first();
        return view('pages.contactUser')->with(['users' => $users, 'contact' => $contact]);
    }

    public function postContactAdmin(Request $request) {
        if (Auth::guest()) {
            return redirect('/login');
        }
        
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

        return redirect()->route('contactAdmin')->with('success', 'Сообщение отправлено');
    }

    public function postContactUser(Request $request) {
        if (Auth::guest()) {
            return redirect('/login');
        }
        
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

        return redirect()->route('contactUser')->with('success', 'Сообщение отправлено');
    }
}