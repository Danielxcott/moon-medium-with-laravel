<?php

namespace App\View\Components\frontend;

use Illuminate\View\Component;

class SuggestCategoryItem extends Component
{
    public $name,$link,$slug;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name,$link,$slug)
    {
        $this->name = $name;
        $this->link = $link;
        $this->slug = $slug;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.suggest-category-item');
    }
}
