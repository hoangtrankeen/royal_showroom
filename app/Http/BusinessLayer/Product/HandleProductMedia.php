<?php

namespace App\Http\BusinessLayer\Product;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

class HandleProductMedia extends Controller
{
    public $image_path;

    public function __construct()
    {
        $this->image_path = getProductImagePath();
    }

    public function SaveProductImages($images) {
        $image_name = [];
        if($images){
            $photos = $images;
            if (!is_array($photos)) {
                $photos = [$photos];
            }
            if (!is_dir($this->image_path)) {
                File::makeDirectory(public_path().'/'.$this->image_path,0777,true);
            }
            for ($i = 0; $i < count($photos); $i++) {
                $photo = $photos[$i];
                $name = sha1(date('YmdHis') . str_random(20));
                $resize_name = $name . str_random(2) . '.' . $photo->getClientOriginalExtension();
                $image_name[] =$resize_name;
                Image::make($photo)->save($this->image_path . '/' . $resize_name);
            }
            $image_name = json_encode($image_name);
        }else{
            $image_name = null;
        }
        return $image_name;
    }

    public function DeleteProductImage($images)
    {
        if($images){
            foreach (json_decode($images) as $image){
                if(\File::exists($this->image_path.'/'.$image)){
                    \File::delete($this->image_path.'/'.$image);
                }
            }
        }
    }
}
