<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Photo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

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

    public function create()
    {
        $categories = Category::all();
        return view("frontend.Article.create",compact('categories'));
    }

    public function store(Request $request)
    {
        request()->validate([
            "title" => ["required","min:3"],
            "slug" => ["required","min:3",Rule::unique("articles","slug")],
            "description" => ["required"],
            "thumbnail" => ["mimes:png,jpg"],
            "images.*" => ["mimes:png,jpg"],
            "category" => ["required",Rule::exists("categories","id")],
        ]);

        $article = new Article();
        $article->title = $request->title;
        $article->user_id = Auth::id();
        $article->category_id = $request->category;
        $article->slug = Str::slug($request->slug);
        $removeEntity = htmlentities($request->description);
        $article->description = $removeEntity;
        $article->excerpt = Str::words($removeEntity,50);
        if($request->hasFile("thumbnail"))
        {
            $newname = uniqid()."thumbnail.".$request->file("thumbnail")->extension();
            $request->file("thumbnail")->storeAs("public/thumbnail",$newname);
            $article->thumbnail = $newname;
        }
        $article->save();
        if(request()->hasFile("images"))
        {
            foreach($request->images as $image)
            {
            $photo = new Photo();
            $newname = uniqid()."image.".$image->extension();
            $image->storeAs("public/article_images",$newname);
            $photo->images = $newname;
            $photo->article_id = $article->id;
            $photo->save();
            }
        }
        return back();
    }

    public function edit(Article $article)
    {
        return view("frontend.Article.edit",compact("article"));
    }

    public function update(Article $article,Request $request)
    {
        request()->validate([
            "title" => ["required","min:3"],
            "slug" => ["required","string",Rule::unique("articles","slug")->ignore($article->id)],
            "description" => ["required"],
            "thumbnail" => ["mimes:png,jpg"],
            "images.*" => ["mimes:png,jpg"],
            "category" => ["required",Rule::exists("categories","id")],
        ]);
        $article->title = $request->title;
        $article->slug = Str::slug($article->slug);
        $entities = htmlentities($request->description,ENT_QUOTES);
        $article->description = $entities;
        $article->excerpt = Str::words($entities, 50, '...');
        $article->user_id = Auth::id();
        $article->category_id = $request->category;
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
        return redirect()->route("index.frontend");
    }

    public function thumbnailRemove(Request $request)
    {
        $article = Article::where("id",$request->id)->first();
        $articleThumbnail = $article->thumbnail;
        Storage::delete("public/thumbnail/".$articleThumbnail);
        $article->thumbnail = null;
        $article->update();
        return back();
    }
}
