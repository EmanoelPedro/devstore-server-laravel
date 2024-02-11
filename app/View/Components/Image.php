<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Image extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $src,
    public ?string $alt = null,
    public ?string $width = null,
    public ?string $height = null,
    public ?string $class = null,
    ){}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.image');
    }
}
