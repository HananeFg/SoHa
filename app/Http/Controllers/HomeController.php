<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function home() {
        return view('home');
    }
    public function login() {
        return view('login');
    }

    public function about() {
        return view('about');
    }

    


    public function blog($myid, $author = 'author by default') {
        $posts = [
            1 => ['title' => 'learn laravel 6'],
            2 => ['title' => 'learn Angular 8'],
        ];
    
        return view('posts.show', [
            'data' => $posts[$myid],
            'author' => $author
        ]);
    }
}
