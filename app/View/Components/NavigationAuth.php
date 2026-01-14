<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class NavigationAuth extends Component
{
    /**
     * Create a new component instance.
     */
    public $user;

    public function __construct()
    {
        $this->user = Auth::check() ? Auth::user() : null;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|\Closure|string
    {
        return view('components.navigation-auth');
    }
}
