<?php

namespace App\Http\BusinessLayer\MediaManager;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

class ImageHandler extends Controller
{
    public function saveImages($directory,$images) {
        $image_name = [];
        if($images){
            $photos = $images;
            if (!is_array($photos)) {
                $photos = [$photos];
            }
            if (!is_dir($directory)) {
                File::makeDirectory(public_path().'/'.$directory,0777,true);
            }
            for ($i = 0; $i < count($photos); $i++) {
                $photo = $photos[$i];
                $name = sha1(date('YmdHis') . str_random(20));
                $resize_name = $name . str_random(2) . '.' . $photo->getClientOriginalExtension();
                $image_name[] =$resize_name;
                Image::make($photo)->save($directory . '/' . $resize_name);
            }
            $image_name = json_encode($image_name);
        }else{
            $image_name = null;
        }
        return $image_name;
    }

    public function saveImage($directory,$image) {
        if($image){
            if (!is_dir($directory)) {
                File::makeDirectory(public_path().'/'.$directory,0777,true);
            }
            $name = sha1(date('YmdHis') . str_random(20));
            $image_name = $name . str_random(2) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save($directory . '/' . $image_name);
        }else{
            $image_name = '';
        }
        return $image_name;
    }

    public function updateImage($directory,$image, $old_image)
    {
        $image_name = $this->saveImage($directory, $image);
        $this->deleteImage($directory, $old_image);
        return $image_name;
    }

    public function deleteImage($directory,$old_image)
    {
        if($old_image){
            if(\File::exists($directory.'/'.$old_image)){
                \File::delete($directory.'/'.$old_image);
            }
        }
    }

    public function updateImages($directory, $image, $old_images)
    {
        $image_name = $this->saveImages($directory, $image);
        if($image_name){
            $this->deleteImages($directory, $old_images);
            return $image_name;
        }
        return $old_images;
    }

    public function deleteImages($directory,$old_images)
    {
        if($old_images){
            foreach (json_decode($old_images) as $image){
                if(\File::exists($directory.'/'.$image)){
                    \File::delete($directory.'/'.$image);
                }
            }
        }
    }


}
