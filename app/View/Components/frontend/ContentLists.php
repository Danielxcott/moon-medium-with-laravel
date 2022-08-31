<?php

namespace App\View\Components\frontend;

use App\Models\Article;
use Illuminate\View\Component;

class ContentLists extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $articles =Article::latest()
        ->with(["author","category","photos","reactors","comments","viewers"])
        ->paginate(10)
        ->withQueryString();
        return view('components.frontend.content-lists',compact(["articles"]));
    }
}
