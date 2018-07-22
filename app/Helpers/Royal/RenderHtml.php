<?php
namespace App\Helpers\Royal;

use App\Model\Attribute;
use App\Model\Category;
use App\Model\Product;
use App\Model\Topic;
use Illuminate\Support\ServiceProvider;

class RenderHtml extends ServiceProvider
{
    /**
     * @return mixed
     */
    public static function getAllCategories()
    {
        return Category::where('active',1)->take(6)->get();
    }

    /**
     * @param $attr
     * @param $product
     * @return string
     * @internal param $attribute
     */
    public static function getCustomAttribute($attr, $product = null)
    {
        $html = '';

        if($product !== null){
            $attr_val = $product->attributeValue()->where('attribute_id',$attr->id)->first();
            if(!empty($attr_val)){
                if ($attr->type == 'select') {

                    $val_html = '';
                    $val_html .= "<option value='' >---Select Value---</option>";

                    foreach ($attr->attributeValue as $value) {

                        $selected = $value->id == $attr_val->id  ? ' selected' : '';
                        $val_id = $value->id;
                        $val_html .= "<option value=$val_id $selected >$value->name</option>";
                    }

                    $html = "<select name=$attr->inform_name class='form-control'>$val_html</select>";
                }
                if ($attr->type == 'text') {
                    $html = "<input name=$attr->inform_name value=$attr_val->name class='form-control'/>";
                }
            }else{
                if ($attr->type == 'select') {

                    $val_html = '';
                    $val_html .= "<option value='' >---Select Value---</option>";

                    foreach ($attr->attributeValue as $value) {

                        $val_id = $value->id;
                        $val_html .= "<option value=$val_id >$value->name</option>";
                    }

                    $html = "<select name=$attr->inform_name class='form-control'>$val_html</select>";
                }
                if ($attr->type == 'text') {
                    $html = "<input name=$attr->inform_name class='form-control'/>";
                }
            }
        }
        else{
            if ($attr->type == 'select') {

                $val_html = '';
                $val_html .= "<option value='' >---Select Value---</option>";

                foreach ($attr->attributeValue as $value) {

                    $val_id = $value->id;
                    $val_html .= "<option value=$val_id >$value->name</option>";
                }

                $html = "<select name=$attr->inform_name class='form-control'>$val_html</select>";
            }
            if ($attr->type == 'text') {
                $html = "<input name=$attr->inform_name class='form-control'/>";
            }
        }


        return $html;
    }

    //Get Recursive Category Menu
    public static function showCategories( $parent_id = 0, $char = '')
    {

        // BƯỚC 2.1: LẤY DANH SÁCH CATE CON
        $cate_child = array();
        $categories = Category::all();
        foreach ($categories as $key => $item){

            // Nếu là chuyên mục con thì hiển thị
            if ((int)$item->parent_id === $parent_id)
            {
                $cate_child[] = $item;
                unset($categories[$key]);
            }
        }
        // BƯỚC 2.2: HIỂN THỊ DANH SÁCH CHUYÊN MỤC CON NẾU CÓ
        if ($cate_child)
        {
            echo '<ul class="sub-menu">';
            foreach ($cate_child as $key => $item)
            {
                // Hiển thị tiêu đề chuyên mục
                $route = route('catalog.category',['slug'=>$item->slug]);
                echo '<li class="menu_style_dropdown menu-item"><a href='.$route.'>'.$item->name.'</a>';

                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                self::showCategories($item->id, $char.'|---');
                echo '</li>';
            }
            echo '</ul>';
        }
    }

    //Get Recursive Category Menu
    public static function showCategoriesMobile( $parent_id = 0)
    {
        // BƯỚC 2.1: LẤY DANH SÁCH CATE CON
        $cate_child = array();
        $categories = Category::all();
        foreach ($categories as $key => $item){

            // Nếu là chuyên mục con thì hiển thị
            if ((int)$item->parent_id === $parent_id)
            {
                $cate_child[] = $item;
                unset($categories[$key]);
            }
        }
        // BƯỚC 2.2: HIỂN THỊ DANH SÁCH CHUYÊN MỤC CON NẾU CÓ
        if ($cate_child)
        {
            echo '<ul class="sub-menu-m">';
            foreach ($cate_child as $key => $item)
            {
                // Hiển thị tiêu đề chuyên mục
                $route = route('catalog.category',['slug'=>$item->slug]);
                echo '<li><a href='.$route.'>'.$item->name.'</a>';

                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                self::showCategoriesMobile($item->id);
                echo '</li>';
            }
            echo '</ul>';
        }
    }

    //Get Recursive Category Menu
    public static function showLeftCategories( $parent_id = 0, $first=true)
    {

        // BƯỚC 2.1: LẤY DANH SÁCH CATE CON
        $cate_child = array();
        $categories = Category::all();
        foreach ($categories as $key => $item){

            // Nếu là chuyên mục con thì hiển thị
            if ((int)$item->parent_id === $parent_id)
            {
                $cate_child[] = $item;
                unset($categories[$key]);
            }
        }
        // BƯỚC 2.2: HIỂN THỊ DANH SÁCH CHUYÊN MỤC CON NẾU CÓ
        if ($cate_child)
        {
            if($first === true){
                echo '<ul id="main-smartmenu" class="sm sm-vertical sm-mint">';
            }else{
                echo '<ul>';
            }

            foreach ($cate_child as $key => $item)
            {
                // Hiển thị tiêu đề chuyên mục
                $route = route('catalog.category',['slug'=>$item->slug]);

                echo '<li ><h3><a href='.$route.'>'.$item->name.'</a></h3>';

                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp

                self::showLeftCategories($item->id,  $first = false);
                echo '</li>';
            }
            echo '</ul>';
        }
    }

    //Get Recursive Category Menu
    public static function showLeftTopic( $parent_id = 0, $first=true)
    {

        // BƯỚC 2.1: LẤY DANH SÁCH CATE CON
        $cate_child = array();
        $categories = Topic::all();
        foreach ($categories as $key => $item){

            // Nếu là chuyên mục con thì hiển thị
            if ((int)$item->parent_id === $parent_id)
            {
                $cate_child[] = $item;
                unset($categories[$key]);
            }
        }
        // BƯỚC 2.2: HIỂN THỊ DANH SÁCH CHUYÊN MỤC CON NẾU CÓ
        if ($cate_child)
        {
            if($first === true){
                echo '<ul id="main-smartmenu" class="sm sm-vertical sm-mint">';
            }else{
                echo '<ul>';
            }

            foreach ($cate_child as $key => $item)
            {
                // Hiển thị tiêu đề chuyên mục
                $route = route('cms.topic',['slug'=>$item->slug]);

                echo '<li ><h3><a href='.$route.'>'.$item->name.'</a></h3>';

                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp

                self::showLeftCategories($item->id,  $first = false);
                echo '</li>';
            }
            echo '</ul>';
        }
    }

    //Get Recursive Category Menu
    public static function showTopic( $parent_id = 0, $char = '')
    {

        // BƯỚC 2.1: LẤY DANH SÁCH CATE CON
        $cate_child = array();
        $categories = Topic::all();
        foreach ($categories as $key => $item){

            // Nếu là chuyên mục con thì hiển thị
            if ((int)$item->parent_id === $parent_id)
            {
                $cate_child[] = $item;
                unset($categories[$key]);
            }
        }
        // BƯỚC 2.2: HIỂN THỊ DANH SÁCH CHUYÊN MỤC CON NẾU CÓ
        if ($cate_child)
        {
            echo '<ul class="sub-menu">';
            foreach ($cate_child as $key => $item)
            {
                // Hiển thị tiêu đề chuyên mục
                $route = route('cms.topic',['slug'=>$item->slug]);
                echo '<li class="menu_style_dropdown menu-item"><a href='.$route.'>'.$item->name.'</a>';

                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                self::showCategories($item->id, $char.'|---');
                echo '</li>';
            }
            echo '</ul>';
        }
    }

    //Get Recursive Category Menu
    public static function showTopicMobile( $parent_id = 0)
    {
        // BƯỚC 2.1: LẤY DANH SÁCH CATE CON
        $cate_child = array();
        $categories = Topic::all();
        foreach ($categories as $key => $item){

            // Nếu là chuyên mục con thì hiển thị
            if ((int)$item->parent_id === $parent_id)
            {
                $cate_child[] = $item;
                unset($categories[$key]);
            }
        }
        // BƯỚC 2.2: HIỂN THỊ DANH SÁCH CHUYÊN MỤC CON NẾU CÓ
        if ($cate_child)
        {
            echo '<ul class="sub-menu-m">';
            foreach ($cate_child as $key => $item)
            {
                // Hiển thị tiêu đề chuyên mục
                $route = route('cms.topic',['slug'=>$item->slug]);
                echo '<li><a href='.$route.'>'.$item->name.'</a>';

                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                self::showCategoriesMobile($item->id);
                echo '</li>';
            }
            echo '</ul>';
        }
    }
    public static function getAllTopics()
    {
        return Topic::take(6)->get();
    }

    public static function getAllProductCategories()
    {
        return Category::where('parent_id', 0)->get();
    }

    public static function getFeaturedProduct($num = 3)
    {
        return Product::where('type_id','group')->where('featured',1)->take($num)->get();
    }

    public static function getAvailableAttribute()
    {
        $collection =  Attribute::with('attributeValue')->where('attribute.status',1)->get();

        return $collection;
    }

    public static function getYesNoOption($value)
    {
        $choseNo = '';
        $choseYes = '';
        if($value == 0){
           $choseNo = 'selected';
        }elseif($value == 1){
            $choseYes = 'selected';
        }
        $html = '';
        $html .= "<option value='0' $choseNo>No</option>";
        $html .= "<option value='1' $choseYes>Yes</option>";
        return $html;
    }
}