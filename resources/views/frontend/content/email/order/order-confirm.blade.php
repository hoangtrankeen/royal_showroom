<head><style type="text/css">
        @import url('https://fonts.googleapis.com/css?family=Open+Sans|Roboto');

        body { font-family: 'Open Sans', sans-serif!important; }
        a[href^="tel"]{
            color:inherit;
            text-decoration:none;
            outline:0;
        }
        a:hover, a:active, a:focus{
            outline:0;
        }
        a:visited{
            color:#FFF;
        }
        span.MsoHyperlink {
            mso-style-priority:99;
            color:inherit;
        }
        span.MsoHyperlinkFollowed {
            mso-style-priority:99;
            color:inherit;
        }
    </style>
</head><body style="margin: 0; padding: 0;background-color:#EEEEEE;"><div style="display:none;font-size:1px;color:#333333;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;">
{{--@php $details = (object) $details; @endphp--}}

</div>
<table cellspacing="0" style="margin:0 auto; width:100%; border-collapse:collapse; background-color:#EEEEEE;">
    <tbody>
    <tr>
        <td align="center" style="padding:20px 23px 0 23px">
            <table width="600" style="background-color:#FFF; margin:0 auto; border-radius:5px">
                <tbody>
                <tr>
                    <td align="center">
                        <table width="500" style="margin:0 auto">
                            <tbody>
                            <tr>
                                <td align="center" style="padding:40px 0 35px 0"><a href="{{route('home')}}" target="_blank" style="color:#128ced; text-decoration:none;outline:0;"><img alt="" src="{{asset('frontend/images/icons/logo-01.png')}}" border="0"></a>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" style="font-family:'Roboto', Arial !important">
                                    <h4>Kính chào quý khách {{$order->customer}}</h4>
                                    <p>Xin cảm ơn quý khách đã đặt hàng của chúng tôi.</p>
                                    <p>{{$order->status->name}}</p>
                                    <p>{{$order->status->details}}</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" cellspacing="0" style="padding:0 0 30px 0; vertical-align:middle">
                        <table width="550" style="border-collapse:collapse; background-color:#FaFaFa; margin:0 auto; border:1px solid #E5E5E5">
                            <tbody>
                            <tr>
                                <td width="276" style="vertical-align:top; border-right:1px solid #E5E5E5">
                                    <table style="width:100%; border-collapse:collapse">
                                        <tbody>
                                        <tr>
                                            <td style="vertical-align:top; padding:18px 18px 8px 23px;">
                                                <p style="font-size:16px; color:#333333; text-transform:uppercase; font-weight:900; margin:0;">
                                                    Thông tin đơn hàng
                                                </p>
                                            </td>
                                        </tr>
                                        <tr style="">
                                            <td style="vertical-align:top; padding:0 18px 18px 23px">
                                                <table width="100%" style="border-collapse:collapse">
                                                    <tbody>
                                                    <tr>
                                                        <td style="font-family:'Roboto', Arial !important">
                                                            <p style="font-size:16px; color:#000; margin:0 0 5px 0;">
                                                                Mã đơn hàng:
                                                            </p>
                                                        </td>
                                                        <td align="left" style="font-family:'Roboto', Arial !important">
                                                            <p style="font-size:16px; color:#000; margin:0 0 5px 0;">
                                                                {{$order->id}}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-family:'Roboto', Arial !important">
                                                            <p style="font-size:16px; color:#000; margin:0 0 5px 0;">
                                                                Ngày mua hàng
                                                            </p>
                                                        </td>
                                                        <td align="left" style="font-family:'Roboto', Arial !important">
                                                            <p style="font-size:16px; color:#000; margin:0 0 5px 0;">
                                                                {{presentDate($order->created_at)}}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-family:'Roboto', Arial !important">
                                                            <p style="font-size:16px; color:#000; margin:0 0 10px 0;">
                                                                Tổng hóa đơn
                                                            </p>
                                                        </td>
                                                        <td align="left" style="font-family:'Roboto', Arial !important">
                                                            <p style="font-size:16px; color:#000; margin:0 0 10px 0;">
                                                                {{presentPrice($order->total)}}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-family:'Roboto', Arial !important">
                                                            <p style="font-size:16px; color:#000; margin:0 0 10px 0;">
                                                                Hình thức thanh toán
                                                            </p>
                                                        </td>
                                                        <td align="left" style="font-family:'Roboto', Arial !important">
                                                            <p style="font-size:16px; color:#000; margin:0 0 10px 0;">
                                                                @if(isset($order->payment_method))
                                                                    {{$order->payment_method->name}}
                                                                @endif
                                                            </p>
                                                        </td>
                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td style="vertical-align:top">
                                    <table width="100%" style="border-collapse:collapse">
                                        <tbody>
                                        <tr>
                                            <td style="vertical-align:top; padding:18px 18px 8px 23px;">
                                                <p style="font-size:16px; color:#333333; text-transform:uppercase; font-weight:900; margin:0;">
                                                    Địa chỉ nhận hàng
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align:top; padding:0 18px 18px 23px;">
                                                <table width="100%" style="border-collapse:collapse">
                                                    <tbody>
                                                    <tr>
                                                        <td style="font-family:'Roboto', Arial !important">
                                                            <p style="font-size:16px; color:#000; margin:0 0 5px 0;">
                                                                Số điện thoại
                                                            </p>
                                                        </td>
                                                        <td style="font-family:'Roboto', Arial !important">
                                                            <p style="font-size:16px; color:#000; margin:0 0 5px 0;">
                                                                {{$order->phone}}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-family:'Roboto', Arial !important">
                                                            <p style="font-size:16px; color:#000; margin:0 0 5px 0;">
                                                                Địa chỉ
                                                            </p>
                                                        </td>
                                                        <td style="font-family:'Roboto', Arial !important">
                                                            <p style="font-size:16px; color:#000; margin:0 0 5px 0;">
                                                                {{$order->address}}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-family:'Roboto', Arial !important;">
                                                            <p style="font-size:16px; color:#000; margin:0;padding:0;">
                                                                Thành phố
                                                            </p>
                                                        </td>
                                                        <td style="font-family:'Roboto', Arial !important;">
                                                            <p style="font-size:16px; color:#000; margin:0;padding:0;">
                                                                {{$order->city}}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" cellspacing="0" style="padding:0; vertical-align:middle">
                        <table width="550" style="border-collapse:collapse; background-color:#FaFaFa; margin:0 auto; border-bottom:1px solid #E5E5E5">
                            <tbody>
                            <tr>
                                <td align="left" style="padding:15px 0 15px 15px;" width="180"><p style="font-size:16px; text-transform:uppercase; color:#333333; margin:0; font-weight:900;; ">
                                        Sản phẩm</p>
                                </td>
                                <td width="60" align="right" style="font-family:'Roboto', Arial !important"><p style="margin:0; font-size:14px; color:#333333;padding:0;font-family:'Roboto', Arial !important;text-align:center;">
                                        Số lượng</p></td>
                                <td width="80" align="right" style="font-family:'Roboto', Arial !important;padding-right:10px;"><p style="margin:0; font-size:14px; color:#333333;padding:0;font-family:'Roboto', Arial !important;text-align:right;">
                                        Giá</p></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                @foreach($order->products as $product)
                    <tr>
                        <td style=";padding:0;" align="center">
                            <table width="550" style="border-collapse:collapse;margin: 0 auto;border-bottom: 1px solid #EBEBEB">
                                <tbody>
                                <tr>

                                    {{--<td width="117" align="right" style="padding:24px 0 24px 10px; text-align:left;">--}}
                                        {{--<a href="{{route('catalog.product',['slug'=> $product->slug])}}" target="_blank" style="text-decoration:none; color:#000; outline:0;">--}}
                                            {{--<img src="{{getProductImage($product->images)}}" border="0">--}}
                                        {{--</a>--}}
                                    {{--</td>--}}
                                    <td width="180" style="vertical-align:middle; padding:0 0 0 10px;;">
                                        <p style="font-size:16px; margin:0; color:#000; line-height:20px;">
                                            <a>{{$product->name}}</a>
                                        </p>
                                    </td>
                                    <td align="center" width="60" style="vertical-align:middle;;padding:0;">
                                        <p style="font-size:18px; color:#000; margin:0;;text-align:center;">
                                            {{$product->pivot->quantity}}
                                        </p>
                                    </td>
                                    <td align="center" width="80" style="font-family:'Roboto', Arial !important;padding:0 10px 0 0;">

                                        <p style="font-size:18px; color:#bc0101; margin:0;;text-align:center;font-weight:bold;text-align: right;">
                                            {{presentPrice(StoreManager::getFinalPrice($product) * $product->pivot->quantity)}}
                                        </p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td align="center" style="padding-top:24px; padding-bottom:20px">
                        <table width="520" style="border-collapse:collapse">
                            <tbody>
                            <tr>
                                <td align="right" style="padding-bottom:15px;">
                                    <p style="font-size:18px; color:#000; font-weight:900; margin:0;">
                                        Phí giao hàng :
                                    </p>
                                </td>
                                <td align="right" style="padding-bottom:15px;">
                                    <p style="font-size:18px; color:#bc0101; font-weight:bold; margin:0;">
                                       0
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" style="padding-bottom:15px;">
                                    <p style="font-size:18px; color:#000; font-weight:900; margin:0;">
                                        Tổng cộng:
                                    </p>
                                </td>
                                <td align="right" style="padding-bottom:15px;">
                                    <p style="font-size:18px; color:#bc0101; font-weight:bold; margin:0;">
                                        {{presentPrice($order->total)}}
                                    </p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td align="center" style="padding-top:20px">
            <table width="604" style="border-collapse:collapse;background-color:#FFF;; border-radius:5px">
                <tbody>
                <tr>
                    <td colspan="4" style="vertical-align:middle;background-color: #128ced;border-radius: 5px 5px 0 0;">
                        <table style="background-color:#128ced; width:100%; border-radius:5px 5px 0 0; border-collapse:collapse">
                            <tbody>
                            <tr>
                                <td align="center" style="vertical-align:middle; padding:22px 0;">
                                    <p style="color:#FFF; font-size:18px; margin:0;">
                                        Gọi cho chúng tôi qua số điện thoại <a href="tel:1-800-672-4399" target="_blank" style="text-decoration:none; color:#FFF; font-weight:bold;outline:0;">1-800-672-4399</a>
                                        hoặc trả lời email này
                                    </p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="padding:0">
                        <table cellpadding="20" style="width:100%; border-collapse:collapse">
                            <tbody>
                            <tr>
                                <td align="center" style="border-right:1px solid #EBEBEB;">
                                    <a href="https://www.chewy.com?utm_medium=email&amp;utm_source=transactional&amp;utm_campaign=ShippingConfirmation" target="_blank" style="outline:0;color:#128ced; text-decoration:none">
                                        <p style="margin:0 0 8px 0"><img src="https://www.chewy.com/static/cms/lp/email/csr_icon.png" border="0"></p>
                                        <p style="color:#444; font-size:13px; text-transform:uppercase; margin:0;">
                                            Hỗ trợ  <br>
                                            Khách hàng
                                        </p>
                                    </a>
                                </td>
                                <td align="center" style="border-right:1px solid #EBEBEB;; vertical-align:bottom">
                                    <a href="https://www.chewy.com?utm_medium=email&amp;utm_source=transactional&amp;utm_campaign=ShippingConfirmation" target="_blank" style="outline:0;color:#128ced; text-decoration:none">
                                        <p style="margin:0 0 14px 0;"><img src="https://www.chewy.com/static/cms/lp/email/shipping_icon.png" border="0"></p>
                                        <p style="color:#444; font-size:13px; text-transform:uppercase; margin:0;">
                                            Free Shipping <br>
                                            Đơn hàng 5 000 000
                                        </p>
                                    </a>
                                </td>
                                <td align="center" style="border-right:1px solid #EBEBEB;">
                                    <a href="https://www.chewy.com?utm_medium=email&amp;utm_source=transactional&amp;utm_campaign=ShippingConfirmation" target="_blank" style="outline:0;color:#128ced; text-decoration:none">
                                        <p style="margin:0 0 8px 0"><img src="https://www.chewy.com/static/cms/lp/email/moneyback_icon.png" border="0">
                                        </p>
                                        <p style="color:#444; font-size:13px; text-transform:uppercase; margin:0;">
                                            Bảo hành <br>
                                            5 năm
                                        </p>
                                    </a>
                                </td>
                                <td align="center" style="font-family:'Roboto', Arial !important">
                                    <a href="https://www.chewy.com?utm_medium=email&amp;utm_source=transactional&amp;utm_campaign=ShippingConfirmation" target="_blank" style="outline:0;color:#128ced; text-decoration:none">
                                        <p style="margin:0 0 8px 0"><img src="https://www.chewy.com/static/cms/lp/email/return_icon.png" border="0"></p>
                                        <p style="color:#444; font-size:13px; text-transform:uppercase; margin:0;">
                                            Hỗ trợ <br>
                                            Phụ kiện
                                        </p>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td align="center" style="padding-top:29px; padding-bottom:50px">
            <table style="width:100%">
                <tbody>
                <tr>
                    <td align="center" style="font-family:'Roboto', Arial !important">
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>