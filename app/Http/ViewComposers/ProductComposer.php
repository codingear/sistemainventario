<?php

namespace App\Http\ViewComposers;


use App\Product;
use Illuminate\Contracts\View\View;

class ProductComposer
{
    public function compose(View $view)
    {
        $products = Product::latest('created_at')->get();
        $view->with(compact('products'));
    }
}
