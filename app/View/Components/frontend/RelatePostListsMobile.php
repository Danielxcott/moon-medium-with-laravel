<?php

namespace App\View\Components\frontend;

use App\Models\Article;
use Illuminate\View\Component;

class RelatePostListsMobile extends Component
{
    public $categoryId,$articleId;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($categoryId,$articleId)
    {
       $this->categoryId = $categoryId;
       $this->articleId = $articleId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $articles = Article::where("category_id",$this->categoryId)->where("id","!=",$this->articleId)->take(5)->inRandomOrder()->get();
        return view('components.frontend.relate-post-lists-mobile',compact(["articles"]));
    }
}
