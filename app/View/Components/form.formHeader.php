<?php

namespace App\View\Components;

use Illuminate\View\Component;

class form.formHeader extends Component
{
    public $title,$btn_name,$link;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title,$btn_name,$link)
    {
        $this->link =$link;
        $this->title =$title;
        $this->btn_name = $btn_name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.form-header');
    }
}
