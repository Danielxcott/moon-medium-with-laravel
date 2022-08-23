<?php

namespace App\View\Components;

use Illuminate\View\Component;

class form.formCategory extends Component
{
    public $for,$label,$title,$categories,$value;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($for,$label,$title,$categories,$value="")
    {
        $this->for = $for;
        $this->label = $label;
        $this->title = $title;
        $this->categories = $categories;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.form-category');
    }
}
