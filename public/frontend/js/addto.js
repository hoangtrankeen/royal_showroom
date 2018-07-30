
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".form-cart").on('submit',function(e){
        $(".form-cart").find(".help-block").remove();
        e.preventDefault();

        var values = $(this).serialize();

        console.log(values);
        $.ajax({
            type: "POST",
            url: window.location.origin+'/add-to-cart',
            dataType: 'json',
            data: values,
            success: function( data ) {
                // swal(data.message, "success");
                if(data.success === false){
                    $(".form-cart").append("<span class='help-block'>"+data.message+"</span>");
                }else{
                    disPlayMessage(data);
                    upDateCartPanel(data)
                }

            },

            error: function(xhr, textStatus, error){
                console.log(xhr.statusText);
                console.log(textStatus);
                console.log(error);
            }
        });
    });

    function upDateCartPanel(data) {

        $('.side-cart-item').not(':first').remove();

        var i = 0;
        $.each(data.cart_items, function (key, value) {
            i++;
            var item = $("#side-cart-sample").clone();
            item.css('display','block');
            item.appendTo(".side-cart-wrapper");
            item.attr('id', 'side-cart-sample'+i);

            item.find(".header-cart-item-img").find('.side-cart-img').attr('src',value.image);
            item.find(".header-cart-item-txt").find('.side-cart-name').text(value.name);
            item.find(".header-cart-item-txt").find('.side-cart-price').find('.price').text(value.price);
            item.find(".header-cart-item-txt").find('.side-cart-price').find('.qty').text(value.qty);

        });

        $('.js-hide-modal1').trigger('click');

        $(".js-show-cart").attr("data-notify",data.count);

        $('.side-cart-total').find('#value-total').text(data.subtotal);

        //Update title has item or not
        if(!(data.count > 0) ){
            $('.side-cart-action').hide();
            $('.side-cart-empty').show();
        }else{
            $('.side-cart-action').show();
            $('.side-cart-empty').hide();
        }
    }

    function disPlayMessage(data) {
        swal('',data.message, data.status, {
            button: "Đóng"
        });
    }
});