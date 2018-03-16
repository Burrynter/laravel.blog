<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}

?>