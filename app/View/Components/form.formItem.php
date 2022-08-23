<?php

namespace App\View\Components;

use Illuminate\View\Component;

class form.formItem extends Component
{
    public $for,$label,$type,$title,$value;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($for,$label,$type,$title,$value="")
    {
       $this->for = $for;
       $this->label = $label;
       $this->type = $type;
       $this->title = $title;
       $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.form-item');
    }
}
