<?php

namespace App\View\Components;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class productCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        protected string $url,
        protected Product $product,
        protected int $rating,
    ){}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product-card');
    }
}
