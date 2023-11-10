<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AccessDenied extends Component
{
    public function render()
    {
        return view('components.access-denied');
    }
}
