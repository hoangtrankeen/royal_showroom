<?php

namespace App\Http\BusinessLayer\Category;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

class HandleCategoryMedia extends Controller
{
    public $image_path;

    public function __construct()
    {
        $this->image_path = getCategoryImagePath();
    }

    public function SaveCategoryImages($image) {
        if($image){

            if (!is_dir($this->image_path)) {
                File::makeDirectory(public_path().'/'.$this->image_path,0777,true);
            }
            $name = sha1(date('YmdHis') . str_random(20));
            $image_name = $name . str_random(2) . '.' . $image->getClientOriginalExtension();

            Image::make($image)->save($this->image_path . '/' . $image_name);
        }else{
            $image_name = '';
        }
        return $image_name;
    }
}
