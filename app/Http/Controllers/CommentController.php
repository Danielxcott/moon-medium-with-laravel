<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Article;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $comments = Comment::where("user_id",Auth::id())->latest("id")->get();
       return view("dashboard.Comment.index",compact(["comments"]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentRequest $request)
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
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentRequest  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentRequest $request,$slug,$id)
    {
       $article = Article::where("slug",$slug)->first();
       $comment = Comment::where("id",$id)->first();
        switch ($comment->status) {
            case '0':
                $comment->status = "1";
                break;
            default:
                $comment->status = "0";
                break;
        }
        $comment->update();
        return redirect()->route("detail.article",compact(["article"]));
    }

    public function updateComment(Request $request)
    {
        return dd($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       if(Auth::check())
       {
        $comment = Comment::find($request->id);
        $comment->delete();
        return response()->json(["status","the current comment is deleted"]);
       }else
       {
        return redirect()->route("login");
       }
    }
}
