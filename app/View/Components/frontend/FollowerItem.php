<?php

namespace App\View\Components\frontend;

use Illuminate\View\Component;

class FollowerItem extends Component
{
    public $follower;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($follower)
    {
        $this->follower = $follower;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.follower-item');
    }
}
