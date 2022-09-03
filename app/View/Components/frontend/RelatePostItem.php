<?php

namespace App\View\Components\frontend;

use Illuminate\View\Component;

class RelatePostItem extends Component
{
    public $article;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($article)
    {
        $this->article = $article;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.relate-post-item');
    }
}
