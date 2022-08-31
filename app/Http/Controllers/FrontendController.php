<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function __construct()
    {
        $this->middleware(["auth","isBanned"]);
    }

    public function index()
    { 
        return view("frontend.index");
    }
}
