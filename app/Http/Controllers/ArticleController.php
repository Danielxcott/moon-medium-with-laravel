<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("dashboard.Articles.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        $articles = new Article();
        $articles->title = $request->title;
        $articles->slug = Str::slug($request->slug);
        $articles->description = $request->description;
        $articles->excerpt = Str::words($request->excerpt,50);
        $articles->category_id = $request->category_id;
        $articles->user_id = Auth::id();
        if($request->hasFile("thumbnail")){
            $newname = uniqid()."thumbnail.".$request->file("thumbnail")->extension();
            $request->file("thumbnail")->storeAs("public/thumbnail",$newname);
            $articles->thumbnail = $newname;
        }
        if($request->hasFile("images")){
            foreach($request->images as $image)
            {
                $newname = uniqid()."image.".$image->extension();
                $image->storeAs("publlic/article_images",$newname);
                $articles->images = $newname;
            }
        }
        $articles->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateArticleRequest  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}
