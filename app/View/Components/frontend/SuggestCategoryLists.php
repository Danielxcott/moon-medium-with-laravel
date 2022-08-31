<?php

namespace App\View\Components\frontend;

use App\Models\Category;
use Illuminate\View\Component;

class SuggestCategoryLists extends Component
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
        $categories = Category::orderBy("id","DESC")->with("article")->get();
        return view('components.frontend.suggest-category-lists',compact(["categories"]));
    }
}
