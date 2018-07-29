<?php

function presentPrice($price)
{
    if(is_numeric($price)){
        return number_format($price).' đ';
    }else{
        return $price;
    }
}

function setActiveCategory($category, $output = 'active')
{
    return request()->category == $category ? $output : '';
}

function presentDate($date = '')
{
    if($date === null){
        $date = '';
    }else{
        $date = new DateTime($date);
        $date = date_format($date,"d/m/Y");
    }
    return $date;
}

function getProductImagePath()
{
    return Config::get('royal.images.products');
}

function getCategoryImagePath()
{
    return Config::get('royal.images.categories');
}

function getProductImage($images)
{
    if($images){
        $images = json_decode($images);
        return '/'.getProductImagePath().'/'.array_first($images);
    }
    return '';
}

function getCategoryImage($image)
{
    if($image){
        return '/'.getCategoryImagePath().'/'.$image;
    }
    return '';
}

function getAllProductImages($images)
{
    if($images){
        $arr = [];
        $images = json_decode($images);
        foreach ($images as $image){
            $arr[] = '/'.getProductImagePath().'/'.$image;
        }
        return $arr;
    }
    return [];
}

function presentDateFormat($date = '')
{
    if($date === null){
        $date = '';
    }else{
        $date = new DateTime($date);
        $date = date_format($date,"d-m-Y");
    }

    return $date;
}