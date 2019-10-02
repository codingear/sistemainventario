<?php

namespace App\Http\ViewComposers;

use App\Category;
use Illuminate\Contracts\View\View;

class CategoryComposer
{
    public function compose(View $view)
    {
        $categories = Category::query()
            ->orderBy('id', 'asc')
            ->get();
        $view->with(compact('categories'));
    }
}
