<?php

namespace App\View\Components\frontend;

use Illuminate\View\Component;

class CategoryItem extends Component
{
    public $name,$link;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name,$link)
    {
        $this->name = $name;
        $this->link = $link;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.category-item');
    }
}
