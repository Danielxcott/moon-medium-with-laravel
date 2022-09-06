<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Photo;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Category;
use App\Models\UserRequest;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ReportArticle;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreCommentRequest;

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

    /*Article */

    public function store(Request $request)
    {
        request()->validate([
            "title" => ["required","min:3"],
            "slug" => ["required","min:3",Rule::unique("articles","slug")],
            "description" => ["required"],
            "excerpt" => ["required"],
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
        $article->excerpt = Str::words($request->excerpt,50);
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
        Gate::authorize("update",$article);
        return view("frontend.Article.edit",compact("article"));
    }

    public function update(Article $article,Request $request)
    {
        Gate::authorize("update",$article);
        request()->validate([
            "title" => ["required","min:3"],
            "slug" => ["required","string",Rule::unique("articles","slug")->ignore($article->id)],
            "description" => ["required"],
            "excerpt" => ["required"],
            "thumbnail" => ["mimes:png,jpg"],
            "images.*" => ["mimes:png,jpg"],
            "category" => ["required",Rule::exists("categories","id")],
        ]);
        $article->title = $request->title;
        $article->slug = Str::slug($article->slug);
        $entities = htmlentities($request->description,ENT_QUOTES);
        $article->description = $entities;
        $article->excerpt = Str::words($request->excerpt, 50, '...');
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

    public function destroy(Article $article)
    {
        Gate::authorize("delete",$article);
        Storage::delete("public/thumbnail/".$article->thumbnail);
        foreach($article->photos as $photo)
        {
            Storage::delete("public/article_images/".$photo->images);
            $photo->delete();
        }
        $article->delete();
        return to_route("article.index");
    }

    public function show(Article $article)
    {
        return view("frontend.Article.show",compact("article"));
    }

    public function articleReactor(Article $article)
    {

        if(User::find(Auth::id())->isReacted($article))
        {
            $article->unReacted();
        }else
        {
            $article->reacted();
        }
        return back();

    }
    /*Comment */
    public function comStore(StoreCommentRequest $request)
    {
        $validate = Validator::make($request->all(),[
            "message" => "required|string",
        ]);
        if($validate->fails())
        {
            return response()->json(["status"=>422,"message"=>$validate->errors()]);
        }
        if(Auth::check())
        {
        $getArticleOwnerId = Article::where("user_id",$request->article_owner_id)->first()->user_id;
        $comment = new Comment();
        $comment->article_id = $request->article_id;
        $comment->user_id = $request->user_id;
        $comment->message = $request->message;
        $comment->article_owner_id = $getArticleOwnerId;
        $comment->status = "0";
        $comment->save();
        return response()->json(["status"=>200,"message"=>"You comment the current post"]);
        }else
        {
            return response()->json(["status"=>401,"message"=>"Please login your acc or register the acc first"]);
        }
    }

    public function loadmessageCount(Request $request)
    {
        $message = Comment::where("article_id",$request->id)->count();
        return response()->json(["count"=>$message]);
    }

    /*Report */
    public function storeReport(Request $request,$slug)
    {
       $getArticleId = Article::where("slug",$slug)->first()->id;
       $message = $request->message;
       $userId = $request->id;
       $report = new ReportArticle();
        $report->article_id = $getArticleId;
        $report->report_message = $message;
        $report->user_id = $userId;
        $report->status = "active";
        $report->save();
        return back();
    }

    /*Profile */
    public function profileUser(User $user)
    {
        return view("frontend.Profile.index",compact("user"));
    }
    public function editProfileUser(User $user)
    {
        Gate::authorize("update",$user);
        return view("frontend.Profile.edit",compact(["user"]));
    }
    public function updateProfileUser(Request $request , User $user)
    {
        Gate::authorize("update",$user);
        request()->validate([
            "name" => ["required","min:3","max:20"],
            "username" => ["required","min:3",Rule::unique("users","username")->ignore($user->id)],
            "profile" => ["mimes:png,jpg"],
            "cover_img" => ["mimes:png,jpg,gif"],
            "livein" => ["required","min:3","max:20"],
            "mobile" => ["required","min:11","max:14"],
            "gender" => ["required",Rule::in(["0","1","2"])],
            "bio" => ["max:255"],
        ]);
        $user->name = $request->name;
      if(isset($request->username))
      {
         $user->username = $request->username;
      }
      $user->username = $user->username;
      $user->gender = $request->gender;
      $user->role = $user->role;
      $user->isBanned = $user->isBanned;
      $user->email = $request->email;
     if(isset($request->bio))
     {
      $user->bio = $request->bio;
     }else{
        $user->bio = null;
     }
     $user->livein = $request->livein;
     $user->mobile = $request->mobile;
     $user->update();
     if($request->hasFile("profile"))
     {
      Storage::delete('public/profile/'.$user->profile);
      $newname = uniqid()."profile.".$request->file("profile")->extension();
      $request->file("profile")->storeAs("public/profile",$newname);
      $user->profile = $newname;
      $user->update();
     }
     if($request->hasFile("cover_img"))
     {
      Storage::delete('public/cover/'.$user->cover_img);
      $newname = uniqid()."cover.".$request->file("cover_img")->extension();
      $request->file("cover_img")->storeAs("public/cover",$newname);
      $user->cover_img = $newname;
      $user->update();
     }
     return redirect()->route("profile.user",compact("user"));
    }

    /*User Request */
    public function userRequestStore(Request $request)
    {
        $userRequest = new UserRequest();
        $userRequest->user_id = $request->user_id;
        $userRequest->friend_id = $request->friend_id;
        $userRequest->status = "0";
        $userRequest->save();
        return response()->json(["status","message"=>"you send the friend request"]);
    }

    public function userRequestUpdate(Request $request)
    {
        $validate = Validator::make($request->all(),[
            "currentReachId" => "required|".Rule::exists("users","id"),
        ]);
        if($validate->fails() || !(Auth::id()))
        {
            return response()->json(["status"=>422,"message"=>"the id is invalid"]);
        }else
        {
            $userRequest = UserRequest::where("friend_id",$request->owner_id)->where("user_id",$request->currentReachId)->first();
            $userRequest->status = "1";
            $userRequest->update();
        }
        
        return response()->json(["message"=>"you confrim current request"]);
    }

    public function userRequestDestroy(Request $request)
    {
        
        $userRequest = UserRequest::where("user_id",$request->user_id);
        if($userRequest->exists())
        {
            $userRequest = UserRequest::where("user_id",$request->user_id)->where("friend_id",$request->friend_id)->first();
            $userRequest->delete();
        }
        return response()->json(["status","message"=>"you removed the friend request."]);

    }
    public function destroyFollowed(Request $request)
    {
        $validate = Validator::make($request->all(),[
            "currentReachId" => "required|".Rule::exists("users","id"),
        ]);
        if($validate->fails() || !(Auth::id()))
        {
            return response()->json(["status"=>422,"message"=>"the id is invalid"]);
        }else{
            $userRequest = UserRequest::where("user_id",$request->currentReachId)->where("friend_id",$request->owner_id)->where("status","1");
        if($userRequest->exists())
        {
            $userRequest = UserRequest::where("user_id",$request->currentReachId)->where("friend_id",$request->owner_id)->where("status","1")->first();
            $userRequest->delete();
            return response()->json(["message"=>"you removed unfollowed"]);
        }else{
            return response()->json(["message"=>"something wrong"]);
        }
        }
        
    }
    public function destroyRequest(Request $request)
    {
        $userRequest = UserRequest::where("user_id",$request->currentReachId)->where("friend_id",$request->owner_id)->where("status","0");
        if($userRequest->exists())
        {
            $userRequest = UserRequest::where("user_id",$request->currentReachId)->where("friend_id",$request->owner_id)->where("status","0")->first();
            $userRequest->delete();
        }
        return response()->json(["message"=>"you removed pending request"]);
    }

    public function followerCount(Request $request)
    {
       $count = UserRequest::where("friend_id",$request->id)->where("status","1")->count();
       return response()->json(["count"=>$count]);
    }

    /*User search */
   public function userSearch()
   {
    $users = User::orderBy("id","DESC")->where("id","!=",Auth::id())->inRandomOrder()->take(8)->get();
    return view("frontend.usersearch",compact("users"));
   }
}
