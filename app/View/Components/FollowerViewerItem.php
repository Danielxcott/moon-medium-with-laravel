<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FollowerViewerItem extends Component
{
    public $yourfollower;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($yourfollower)
    {
        $this->yourfollower = $yourfollower;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.follower-viewer-item');
    }
}
