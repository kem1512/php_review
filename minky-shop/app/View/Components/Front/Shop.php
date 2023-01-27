<?php

namespace App\View\Components\Front;

use Illuminate\View\Component;

class Shop extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $products = Product::all();
        return view('components.front.shop')->layout('components.front.layout');
    }
}
