<?php

namespace App\View\Components\frontend;

use App\Models\Article;
use Illuminate\View\Component;

class PostArticleLists extends Component
{
    public $user;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $posts = Article::where("user_id",$this->user)->latest("id")->paginate("10");
        return view('components.frontend.post-article-lists',compact("posts"));
    }
}
