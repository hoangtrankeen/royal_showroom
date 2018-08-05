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
        $parent_category_list = $this->category->where('parent_id',0)->with('children')->get();
        $view->with('parent_category_list', $parent_category_list);
    }


}