<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FollowerViewer extends Component
{
    public $yourfollowers;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($yourfollowers)
    {
        $this->yourfollowers = $yourfollowers;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.follower-viewer');
    }
}
