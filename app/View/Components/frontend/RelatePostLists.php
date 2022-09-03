<?php

namespace App\View\Components\frontend;

use App\Models\Article;
use Illuminate\View\Component;

class RelatePostLists extends Component
{
    public $category,$article;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($category,$article)
    {
        $this->category = $category;
        $this->article = $article;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $articles = Article::where("category_id",$this->category)->where("id","!=",$this->article)->take(5)->inRandomOrder()->get();
        return view('components.frontend.relate-post-lists',compact(["articles"]));
    }
}
