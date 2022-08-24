<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\ReportArticle;
use App\Http\Requests\StoreReportArticleRequest;
use App\Http\Requests\UpdateReportArticleRequest;

class ReportArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = ReportArticle::orderBy("id","DESC")->get();
        return view("dashboard.Report.index",compact(["reports"]));
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
     * @param  \App\Http\Requests\StoreReportArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReportArticleRequest $request,$slug)
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReportArticle  $reportArticle
     * @return \Illuminate\Http\Response
     */
    public function show(ReportArticle $reportArticle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReportArticle  $reportArticle
     * @return \Illuminate\Http\Response
     */
    public function edit(ReportArticle $reportArticle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReportArticleRequest  $request
     * @param  \App\Models\ReportArticle  $reportArticle
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReportArticleRequest $request, ReportArticle $reportArticle, $slug, $id)
    {
        $article = Article::where("slug",$slug)->first();
        $reportArticle = ReportArticle::find($id);
        $reportArticle->status = "remove";
        $reportArticle->update();
        return redirect()->route("detail.article",compact("article"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReportArticle  $reportArticle
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReportArticle $reportArticle,Request $request)
    {
        $reportArticle = ReportArticle::find($request->id)->first();
        $reportArticle->delete();
        return response()->json(["status","Current report is delete."]);
    }
}
