<?php

namespace App\View\Components;

use Illuminate\View\Component;
class SingleImage extends Component
{
    public $image;

    /**
     * Create a new component instance.
     *
     * @param string $image
     * @return void
     */
    public function __construct($image)
    {
        $this->image = $image;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.single-image');
    }
}
