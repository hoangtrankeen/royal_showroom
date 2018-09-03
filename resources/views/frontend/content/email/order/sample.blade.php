<head><style type="text/css">
        @import url(https://fonts.googleapis.com/css?family=Roboto:400,300,500,700,700italic,900);
        body { font-family: 'Roboto', Arial, sans-serif !important; }
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
    Questions? Call us any time 24/7 at 1-800-672-4399 or simply reply to this email | Chewy.com
</div>
<table cellspacing="0" style="margin:0 auto; width:100%; border-collapse:collapse; background-color:#EEEEEE; font-family:'Roboto', Arial !important">
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
                                <td align="center" style="padding:40px 0 35px 0"><a href="{{route('home')}}" target="_blank" style="color:#128ced; text-decoration:none;outline:0;"><img alt="" src="{{public_path('frontend/images/logo.png')}}" border="0"></a>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" style="font-family:'Roboto', Arial !important">
                                    <h4>Kính chào quý khách {{Auth::guard('web')->check() ? Auth::name() : $details->billing_name}}</h4>
                                    <p>Công ty Royal đã nhận được đơn hàng mã {{$details->id}}, đặt ngày {{$details->created_at}}.</p>
                                    <p>Chúng tôi sẽ gửi thông báo đến quý khách qua một email khác ngay khi sản phẩm được giao cho đơn vị vận chuyển</p>
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
                                            <td style="vertical-align:top; padding:18px 18px 8px 23px; font-family:'Roboto', Arial !important">
                                                <p style="font-size:16px; color:#333333; text-transform:uppercase; font-weight:900; margin:0; font-family:'Roboto', Arial !important">
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
                                                            <p style="font-size:16px; color:#000; margin:0 0 5px 0; font-family:'Roboto', Arial !important">
                                                                Mã đơn hàng #:
                                                            </p>
                                                        </td>
                                                        <td align="left" style="font-family:'Roboto', Arial !important">
                                                            <p style="font-size:16px; color:#000; margin:0 0 5px 0; font-family:'Roboto', Arial !important">
                                                                {{$details->order_id}}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-family:'Roboto', Arial !important">
                                                            <p style="font-size:16px; color:#000; margin:0 0 5px 0; font-family:'Roboto', Arial !important">
                                                                Ngày mua hàng
                                                            </p>
                                                        </td>
                                                        <td align="left" style="font-family:'Roboto', Arial !important">
                                                            <p style="font-size:16px; color:#000; margin:0 0 5px 0; font-family:'Roboto', Arial !important">
                                                                {{presentDate($details->created_at)}}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-family:'Roboto', Arial !important">
                                                            <p style="font-size:16px; color:#000; margin:0 0 10px 0; font-family:'Roboto', Arial !important">
                                                                Tổng hóa đơn
                                                            </p>
                                                        </td>
                                                        <td align="left" style="font-family:'Roboto', Arial !important">
                                                            <p style="font-size:16px; color:#000; margin:0 0 10px 0; font-family:'Roboto', Arial !important">
                                                                {{presentPrice($details->billing_total)}}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-family:'Roboto', Arial !important">
                                                            <p style="font-size:16px; color:#000; margin:0 0 10px 0; font-family:'Roboto', Arial !important">
                                                                Hình thức thanh toán
                                                            </p>
                                                        </td>
                                                        <td align="left" style="font-family:'Roboto', Arial !important">
                                                            <p style="font-size:16px; color:#000; margin:0 0 10px 0; font-family:'Roboto', Arial !important">
                                                                {{presentPrice($details->shipping_method)}}
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
                                            <td style="vertical-align:top; padding:18px 18px 8px 23px; font-family:'Roboto', Arial !important">
                                                <p style="font-size:16px; color:#333333; text-transform:uppercase; font-weight:900; margin:0; font-family:'Roboto', Arial !important">
                                                    Địa chỉ nhận hàng
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align:top; padding:0 18px 18px 23px; font-family:'Roboto', Arial !important">
                                                <table width="100%" style="border-collapse:collapse">
                                                    <tbody>
                                                    <tr>
                                                        <td style="font-family:'Roboto', Arial !important">
                                                            <p style="font-size:16px; color:#000; margin:0 0 5px 0; font-family:'Roboto', Arial !important">
                                                                {{$details->billing_address}}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-family:'Roboto', Arial !important">
                                                            <p style="font-size:16px; color:#000; margin:0 0 5px 0; font-family:'Roboto', Arial !important">
                                                                {{$details->billing_province}}
                                                            </p>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td style="font-family:'Roboto', Arial !important;">
                                                            <p style="font-size:16px; color:#000; margin:0;padding:0; font-family:'Roboto', Arial !important">
                                                                {{$details->billing_city}}
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
                </tr>                        <tr>
                    <td align="center" cellspacing="0" style="padding:0; vertical-align:middle">
                        <table width="550" style="border-collapse:collapse; background-color:#FaFaFa; margin:0 auto; border-bottom:1px solid #E5E5E5">
                            <tbody>
                            <tr>
                                <td align="left" style="padding:15px 0 15px 15px; font-family:'Roboto', Arial !important" width="117"><p style="font-size:16px; text-transform:uppercase; color:#333333; margin:0; font-weight:900; font-family:'Roboto', Arial !important; ">
                                        Sản phẩm</p></td>
                                <td align="left" width="240">

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
                @foreach($details->products as $product)
                    <tr>
                        <td style=" font-family:'Roboto', Arial !important;padding:0;" align="center">
                            <table width="550" style="border-collapse:collapse;margin: 0 auto;border-bottom: 1px solid #EBEBEB">
                                <tbody>
                                <tr>

                                    <td width="117" align="right" style="padding:24px 0 24px 10px; text-align:left;">
                                        <a href="https://www.chewy.com/dp/117261?utm_medium=email&amp;utm_source=transactional&amp;utm_campaign=ShippingConfirmation" target="_blank" style="text-decoration:none; color:#000; outline:0;">
                                            <img src="{{getFeaturedImageProduct($product->image)}}" border="0">
                                        </a>
                                    </td>
                                    <td width="270" style="vertical-align:middle; padding:0 0 0 10px; font-family:'Roboto', Arial !important;">
                                        <p style="font-size:16px; margin:0; color:#000; line-height:20px; font-family:'Roboto', Arial !important">
                                            <a>{{$product->name}}}</a>
                                        </p>
                                    </td>
                                    <td align="center" width="60" style="vertical-align:middle; font-family:'Roboto', Arial !important;padding:0;">
                                        <p style="font-size:18px; color:#000; margin:0; font-family:'Roboto', Arial !important;text-align:center;">
                                            {{$product->pivot->quantity}}
                                        </p>
                                    </td>
                                    <td align="center" width="80" style="font-family:'Roboto', Arial !important;padding:0 10px 0 0;">

                                        <p style="font-size:18px; color:#bc0101; margin:0; font-family:'Roboto', Arial !important;text-align:center;font-weight:bold;text-align: right;">
                                            <a>{{$product->final_price}}}</a>
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
                                <td align="right" style="padding-bottom:15px; font-family:'Roboto', Arial !important">
                                    <p style="font-size:18px; color:#000; font-weight:900; margin:0; font-family:'Roboto', Arial !important">
                                        Tổng cộng:
                                    </p>
                                </td>
                                <td align="right" style="padding-bottom:15px; font-family:'Roboto', Arial !important">
                                    <p style="font-size:18px; color:#bc0101; font-weight:bold; margin:0; font-family:'Roboto', Arial !important">
                                        {{$details->billing_total}}
                                    </p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td align="center" style="padding-top:20px">
            <table width="604" style="border-collapse:collapse;background-color:#FFF; font-family:'Roboto', Arial !important; border-radius:5px">
                <tbody>
                <tr>
                    <td colspan="4" style="vertical-align:middle;background-color: #128ced;border-radius: 5px 5px 0 0;">
                        <table style="background-color:#128ced; width:100%; border-radius:5px 5px 0 0; border-collapse:collapse">
                            <tbody>
                            <tr>
                                <td align="center" style="vertical-align:middle; padding:22px 0; font-family:'Roboto', Arial !important">
                                    <p style="color:#FFF; font-size:18px; margin:0; font-family:'Roboto', Arial !important">
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
                                <td align="center" style="border-right:1px solid #EBEBEB; font-family:'Roboto', Arial !important">
                                    <a href="https://www.chewy.com?utm_medium=email&amp;utm_source=transactional&amp;utm_campaign=ShippingConfirmation" target="_blank" style="outline:0;color:#128ced; text-decoration:none">
                                        <p style="margin:0 0 8px 0"><img src="https://www.chewy.com/static/cms/lp/email/csr_icon.png" border="0"></p>
                                        <p style="color:#444; font-size:13px; text-transform:uppercase; margin:0; font-family:'Roboto', Arial !important">
                                            Customer <br>
                                            Service
                                        </p>
                                    </a>
                                </td>
                                <td align="center" style="border-right:1px solid #EBEBEB; font-family:'Roboto', Arial !important; vertical-align:bottom">
                                    <a href="https://www.chewy.com?utm_medium=email&amp;utm_source=transactional&amp;utm_campaign=ShippingConfirmation" target="_blank" style="outline:0;color:#128ced; text-decoration:none">
                                        <p style="margin:0 0 14px 0; font-family:'Roboto', Arial !important"><img src="https://www.chewy.com/static/cms/lp/email/shipping_icon.png" border="0"></p>
                                        <p style="color:#444; font-size:13px; text-transform:uppercase; margin:0; font-family:'Roboto', Arial !important">
                                            Free Shipping <br>
                                            orders $49+
                                        </p>
                                    </a>
                                </td>
                                <td align="center" style="border-right:1px solid #EBEBEB; font-family:'Roboto', Arial !important">
                                    <a href="https://www.chewy.com?utm_medium=email&amp;utm_source=transactional&amp;utm_campaign=ShippingConfirmation" target="_blank" style="outline:0;color:#128ced; text-decoration:none">
                                        <p style="margin:0 0 8px 0"><img src="https://www.chewy.com/static/cms/lp/email/moneyback_icon.png" border="0">
                                        </p>
                                        <p style="color:#444; font-size:13px; text-transform:uppercase; margin:0; font-family:'Roboto', Arial !important">
                                            Satisfaction <br>
                                            Guaranteed
                                        </p>
                                    </a>
                                </td>
                                <td align="center" style="font-family:'Roboto', Arial !important">
                                    <a href="https://www.chewy.com?utm_medium=email&amp;utm_source=transactional&amp;utm_campaign=ShippingConfirmation" target="_blank" style="outline:0;color:#128ced; text-decoration:none">
                                        <p style="margin:0 0 8px 0"><img src="https://www.chewy.com/static/cms/lp/email/return_icon.png" border="0"></p>
                                        <p style="color:#444; font-size:13px; text-transform:uppercase; margin:0; font-family:'Roboto', Arial !important">
                                            Hassle-Free <br>
                                            Returns
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
                        <a href="https://www.chewy.com?utm_medium=email&amp;utm_source=transactional&amp;utm_campaign=ShippingConfirmation" target="_blank" style="color:#128ced; text-decoration:none;outline:0;"><img src="https://www.chewy.com/static/cms/lp/email/gray_logo.png" border="0"></a>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>