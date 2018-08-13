<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class ProductCategoryComposer
{
    protected $category;


    public function __construct(
        \App\Model\Category $category
    )
    {
        $this->category = $category;
    }

    public function compose(View $view)
    {
        $share_parent_categories = $this->category->where('parent_id',0)->with('children')->orderBy('order')->get();
        $view->with('share_parent_categories', $share_parent_categories);
    }


}