$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /*==================================================================
    [ Show modal1 ]*/
    var customElement = $("<div>", {
        "class" : "loader05"
    });


    $('.js-show-modal1').on('click',function(e){

        $.LoadingOverlay("show", {
            image       : "",
            custom      : customElement
        });

        e.preventDefault();


        var slug = $(this).attr('data-value');
        setTimeout(function(){
        $.get( window.location.origin + '/quick-view?q=' +slug, function( data ) {
           console.log(data);
           upDateView(data);

           $('.js-modal1').addClass('show-modal1');

        });
        }, 1000);

        setTimeout(function(){
            $.LoadingOverlay("hide");
        }, 1000);
    });

    $('.js-hide-modal1').on('click',function(){
        $('.js-modal1').removeClass('show-modal1');
    });

    function upDateView(data) {
        var action_tocart = $(".quick-view-action");
        action_tocart.show();
        $(".num-product").val(1);

        var id = data.product.id;
        var image = data.product.image;
        var name = data.product.name;
        var description = data.product.description;
        var price = data.product.price;
        var sku = data.product.sku;
        var priceformat = data.product.priceformat;
        var stock_status = data.product.in_stock ? '': 'Hết hàng';

        $(".quick-view-img").attr('src', image);
        $(".quick-view-flex").attr('href', image);
        $(".quick-view-name").text(name);
        $(".quick-view-price").text(priceformat);
        $(".quick-view-desc").text(description);
        $(".quick-view-stock-status").text(stock_status);
        $(".quick-view-sku").text(sku);

        $("#product_id").val(id);
        $("#product_name").val(name);
        $("#product_final_price").val(price);

        if(data.product.in_stock !== 1){
            action_tocart.hide();
        }
    }


});
