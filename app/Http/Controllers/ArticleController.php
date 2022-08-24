<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\ReportArticle;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("dashboard.Articles.index",[
            "articles" => $this->getArticles(),
        ]);
    }

    protected function getArticles()
    {
        $articles = Article::latest()
        ->with(["author","category"])
        ->paginate(10)
        ->withQueryString();
        return $articles;
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
        request()->validate([
            "slug" => ["required","string",Rule::unique("articles","slug")],
        ]);
        $entities = htmlentities($request->description,ENT_QUOTES);
        $articles = new Article();
        $articles->title = $request->title;
        $articles->slug = Str::slug($request->slug);
        $articles->description = $entities;
        $articles->excerpt = Str::words($request->excerpt,50);
        $articles->category_id = $request->category;
        $articles->user_id = Auth::id();
        if($request->hasFile("thumbnail")){
            $newname = uniqid()."thumbnail.".$request->file("thumbnail")->extension();
            $request->file("thumbnail")->storeAs("public/thumbnail",$newname);
            $articles->thumbnail = $newname;
        }
        $articles->save();

        if($request->hasFile("images")){
            foreach($request->images as $image)
            {
                $newname = uniqid()."image.".$image->extension();
                $image->storeAs("public/article_images",$newname);
                $photos = new Photo();
                $photos->images = $newname;
                $photos->article_id = $articles->id;
                $photos->save();
            }
        }
        return redirect()->route("article.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view("dashboard.Articles.show",compact("article"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view("dashboard.Articles.edit",compact("article"));
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
        request()->validate([
            "slug" => ["required","string",Rule::unique("articles","slug")->ignore($article->id)],
        ]);
        $entities = htmlentities($request->description,ENT_QUOTES);
        $article->title = $request->title;
        $article->slug = Str::slug($request->slug);
        $article->description = $entities;
        $article->excerpt = Str::words($request->excerpt,50);
        $article->category_id = $request->category;
        $article->user_id = Auth::id();
        if($request->hasFile("thumbnail"))
        {
            Storage::delete("public/thumbnail/".$article->thumbnail);
            $newname = uniqid()."thumbnail.".$request->file("thumbnail")->extension();
            $request->file("thumbnail")->storeAs("public/thumbnail",$newname);
            $article->thumbnail = $newname;
        }
        $article->update();

        if(request()->hasFile("images"))
        {
            foreach($request->images as $image)
            {
                $newname = uniqid()."images.".$image->extension();
                $image->storeAs("public/article_images",$newname);
                $photo = new Photo();
                $photo->article_id = $article->id;
                $photo->images = $newname;
                $photo->save();
            }
        }
        return redirect()->route("article.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        Storage::delete("public/thumbnail/".$article->thumbnail);
        foreach($article->photos as $photo)
        {
            Storage::delete("public/article_images/".$photo->images);
            $photo->delete();
        }
        $article->delete();
        return to_route("article.index");
    }
}
