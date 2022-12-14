<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware("isAdmin");
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        $articles = Article::orderBy("id","DESC")
         ->with(["author","category","photos","reactors","comments","viewers"])->get();
        return view("dashboard.index",compact(["users","articles"]));
    }
}
