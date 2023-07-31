<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home/index');
    }

    public function memberManage()
    {
        // dd(123);
        return view('home/member');
    }

    public function homeManage()
    {
        return view ('home/member');
    }

    public function booksManage()
    {
        return view ('home/books');
    }
}

