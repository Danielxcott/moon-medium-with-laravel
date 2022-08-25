<?php

namespace App\View\Components\form;

use Illuminate\View\Component;

class CommentInputBox extends Component
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
        return view('components.form.comment-input-box');
    }
}
