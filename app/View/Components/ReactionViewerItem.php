<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ReactionViewerItem extends Component
{
    public $reactor;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($reactor)
    {
        $this->reactor = $reactor;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.reaction-viewer-item');
    }
}
