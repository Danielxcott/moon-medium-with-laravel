<?php

namespace App\View\Components;

use Illuminate\View\Component;

class form.formTextarea extends Component
{
    public $for,$label,$title;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($for,$label,$title)
    {
       $this->for =$for;
       $this->label = $label;
       $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.form-textarea');
    }
}
