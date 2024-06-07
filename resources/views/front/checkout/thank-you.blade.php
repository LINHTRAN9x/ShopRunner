
@extends("front.layout.master")
    @section('title','Thank You !')
   @section('body')


<body style="width:100%;color:#333;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;margin-top:143px;background: #EFF7F6">
{{--<div dir="ltr" class="es-wrapper-color" lang="en" style="background-color:#EFF7F6"><!--[if gte mso 9]>--}}
{{--    <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">--}}
{{--        <v:fill type="tile" color="#eff7f6"></v:fill>--}}
{{--    </v:background>--}}
{{--    <![endif]-->--}}
{{--    <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;background-color:#EFF7F6">--}}
{{--        <tr>--}}
{{--            <td valign="top" style="padding:0;Margin:0">--}}

{{--                <table class="es-content" cellspacing="0" cellpadding="0" align="center" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">--}}
{{--                    <tr>--}}
{{--                        <td align="center" style="padding:0;Margin:0">--}}
{{--                            <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#ffffff;width:1200px" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center" role="none">--}}
{{--                                <tr>--}}
{{--                                    <td align="left" style="padding:0;Margin:0">--}}
{{--                                        <table cellspacing="0" cellpadding="0" width="100%" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                            <tr>--}}
{{--                                                <td class="es-m-p0r" valign="top" align="center" style="padding:0;Margin:0;width:1200px">--}}
{{--                                                    <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                                        <tr>--}}
{{--                                                            <td align="center" style="padding:0;Margin:0;position:relative">--}}
{{--                                                                <img class="adapt-img" src="{{ asset('front/img/Thank-you-bg.png') }}" title width="100%" height="" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" alt="img">--}}
{{--                                                            </td>--}}
{{--                                                        </tr>--}}
{{--                                                    </table></td>--}}
{{--                                            </tr>--}}
{{--                                        </table></td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td align="left" bgcolor="#6a994e" style="Margin:0;padding-left:20px;padding-right:20px;padding-top:30px;padding-bottom:30px;background-color:#6a994e">--}}
{{--                                        <table cellpadding="0" cellspacing="0" width="100%" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                            <tr>--}}
{{--                                                <td align="center" valign="top" style="padding:0;Margin:0;width:1160px">--}}
{{--                                                    <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                                        <tr>--}}
{{--                                                            <td align="center" class="es-m-txt-c" style="padding:10px;Margin:0"><h3 style="Margin:0;line-height:29px;mso-line-height-rule:exactly;font-family:Raleway, Arial, sans-serif;font-size:24px;font-style:normal;font-weight:normal;color:#ffffff">Hello {{$order->first_name}} {{ $order->last_name}}</h3></td>--}}
{{--                                                        </tr>--}}
{{--                                                        <tr>--}}
{{--                                                            <td align="center" class="es-m-txt-c" style="padding:0;Margin:0;padding-top:20px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;line-height:24px;color:#ffffff;font-size:16px">Thank you for your recent order. We are pleased to confirm that we have received your order and it is currently being processed.</p></td>--}}
{{--                                                        </tr>--}}
{{--                                                        <tr>--}}
{{--                                                            <td align="center" class="es-m-txt-c" style="padding:0;Margin:0;padding-top:30px"><!--[if mso]><a href="./account/my-order" target="_blank" hidden>--}}
{{--                                                                    <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" esdevVmlButton href="https://viewstripo.email"--}}
{{--                                                                                 style="height:39px; v-text-anchor:middle; width:161px" arcsize="13%" stroke="f"  fillcolor="#ffffff">--}}
{{--                                                                        <w:anchorlock></w:anchorlock>--}}
{{--                                                                        <center style='color:#386641; font-family:Raleway, Arial, sans-serif; font-size:14px; font-weight:400; line-height:14px;  mso-text-raise:1px'>View Order</center>--}}
{{--                                                                    </v:roundrect></a>--}}
{{--                                                                <![endif]--><!--[if !mso]><!-- --><span class="msohide es-button-border" style="border-style:solid;border-color:#ffffff;background:#ffffff;border-width:1px;display:inline-block;border-radius:5px;width:auto;mso-hide:all"><a href="./account/my-order" class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;color:#386641;font-size:16px;display:inline-block;background:#ffffff;border-radius:5px;font-family:Raleway, Arial, sans-serif;font-weight:normal;font-style:normal;line-height:19px;width:auto;text-align:center;padding:10px 30px 10px 30px;mso-padding-alt:0;mso-border-alt:10px solid  #ffffff">View Order</a></span><!--<![endif]--></td>--}}
{{--                                                        </tr>--}}
{{--                                                    </table></td>--}}
{{--                                            </tr>--}}
{{--                                        </table></td>--}}
{{--                                </tr>--}}
{{--                            </table></td>--}}
{{--                    </tr>--}}
{{--                </table>--}}
{{--                <table cellpadding="0" cellspacing="0" class="es-content" align="center" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">--}}
{{--                    <tr>--}}
{{--                        <td align="center" style="padding:0;Margin:0">--}}
{{--                            <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:1200px">--}}
{{--                                <tr>--}}
{{--                                    <td align="left" style="Margin:0;padding-left:20px;padding-right:20px;padding-bottom:30px;padding-top:40px">--}}
{{--                                        <table cellpadding="0" cellspacing="0" width="100%" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                            <tr>--}}
{{--                                                <td align="center" valign="top" style="padding:0;Margin:0;width:1160px">--}}
{{--                                                    <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                                        <tr>--}}
{{--                                                            <td align="center" style="padding:0;Margin:0"><h3 style="Margin:0;line-height:60px;mso-line-height-rule:exactly;font-family:Raleway, Arial, sans-serif;font-size:40px;font-style:normal;font-weight:normal;color:#386641">Order summary</h3></td>--}}
{{--                                                        </tr>--}}
{{--                                                        <tr>--}}
{{--                                                            <td align="center" class="es-m-p10t" style="padding:0;Margin:0;padding-left:20px;padding-right:20px;padding-top:40px"><h3 class="b_title" style="Margin:0;line-height:29px;mso-line-height-rule:exactly;font-family:Raleway, Arial, sans-serif;font-size:24px;font-style:normal;font-weight:normal;color:#386641">ORDER NO.{{ $order->id }}<br>{{ $order->created_at }}</h3></td>--}}
{{--                                                        </tr>--}}
{{--                                                    </table></td>--}}
{{--                                            </tr>--}}
{{--                                        </table></td>--}}
{{--                                </tr>--}}
{{--                                @if(isset($orderProducts) && $orderProducts->count() > 0)--}}
{{--                            @foreach($orderProducts as $item)--}}
{{--                                    <tr>--}}
{{--                                        <td align="left" style="padding:0;Margin:0;padding-left:20px;padding-right:20px;padding-bottom:40px"><!--[if mso]><table style="width:1160px" cellpadding="0" cellspacing="0"><tr><td style="width:495px" valign="top"><![endif]-->--}}
{{--                                            <table cellpadding="0" cellspacing="0" class="es-left" align="left" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">--}}
{{--                                                <tr>--}}
{{--                                                    <td align="left" class="es-m-p20b" style="padding:0;Margin:0;width:495px">--}}
{{--                                                        <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                                            <tr>--}}
{{--                                                                <td align="center" style="padding:0;Margin:0;font-size:0px"><a target="_blank" href="https://viewstripo.email" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#6A994E;font-size:16px">--}}
{{--                                                                        <img src="front/img/product/{{$item->product->productImages[0]->path}}" class="adapt-img p_image" src="" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;border-radius:10px" width="195"></a></td>--}}
{{--                                                            </tr>--}}
{{--                                                        </table></td>--}}
{{--                                                </tr>--}}
{{--                                            </table><!--[if mso]></td><td style="width:20px"></td><td style="width:645px" valign="top"><![endif]-->--}}

{{--                                            <table cellpadding="0" cellspacing="0" class="es-right" align="right" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">--}}
{{--                                                <tr>--}}
{{--                                                    <td align="left" style="padding:0;Margin:0;width:645px">--}}
{{--                                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;border-left:1px solid #386641;border-right:1px solid #386641;border-top:1px solid #386641;border-bottom:1px solid #386641;border-radius:10px" role="presentation">--}}
{{--                                                            <tr>--}}
{{--                                                                <td align="left" class="es-m-txt-c" style="Margin:0;padding-left:20px;padding-right:20px;padding-top:25px;padding-bottom:25px"><h3 class="p_name" style="Margin:0;line-height:36px;mso-line-height-rule:exactly;font-family:Raleway, Arial, sans-serif;font-size:20px;font-style:normal;font-weight:normal;color:#386641">{{$item->product->name}}</h3><p class="p_description" style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;line-height:24px;color:#4D4D4D;font-size:16px"></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;line-height:24px;color:#4D4D4D;font-size:16px"></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;line-height:24px;color:#4D4D4D;font-size:16px">QTY: {{$item->qty}}</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;line-height:24px;color:#4D4D4D;font-size:16px">SIZE: {{$item->size}}</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;line-height:24px;color:#4D4D4D;font-size:16px">--}}
{{--                                                                        @php--}}
{{--                                                                            $sizeColorMapping = [--}}
{{--                                                                                '1' => 'black',--}}
{{--                                                                                '2' => 'darkblue',--}}
{{--                                                                                '3' => 'orange',--}}
{{--                                                                                '4' => 'grey',--}}
{{--                                                                                '5' => 'lightblack',--}}
{{--                                                                                '6' => 'pink',--}}
{{--                                                                                '7' => 'violet',--}}
{{--                                                                                '8' => 'red',--}}
{{--                                                                                '9' => 'white',--}}
{{--                                                                            ];--}}
{{--                                                                            $colorNumber = $sizeColorMapping[$item->color] ?? '';--}}
{{--                                                                        @endphp--}}
{{--                                                                        COLOR: {{$colorNumber}}--}}
{{--                                                                    </p><h3 style="Margin:0;line-height:36px;mso-line-height-rule:exactly;font-family:Raleway, Arial, sans-serif;font-size:24px;font-style:normal;font-weight:normal;color:#386641" class="p_price">${{$item->amount * $item->qty}}</h3></td>--}}
{{--                                                            </tr>--}}
{{--                                                        </table></td>--}}
{{--                                                </tr>--}}
{{--                                            </table><!--[if mso]></td></tr></table><![endif]-->--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                                @endif--}}
{{--                                <tr>--}}
{{--                                    <td align="left" style="Margin:0;padding-left:20px;padding-right:20px;padding-bottom:30px;padding-top:40px">--}}
{{--                                        <table cellpadding="0" cellspacing="0" width="100%" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                            <tr>--}}
{{--                                                <td align="center" valign="top" style="padding:0;Margin:0;width:1160px">--}}
{{--                                                    <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                                        <tr>--}}
{{--                                                            <td align="center" style="padding:0;Margin:0"><h1 style="Margin:0;line-height:60px;mso-line-height-rule:exactly;font-family:Raleway, Arial, sans-serif;font-size:40px;font-style:normal;font-weight:normal;color:#386641">Order total</h1></td>--}}
{{--                                                        </tr>--}}
{{--                                                    </table></td>--}}
{{--                                            </tr>--}}
{{--                                        </table></td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td class="esdev-adapt-off" align="left" style="padding:20px;Margin:0">--}}
{{--                                        <table cellpadding="0" cellspacing="0" class="esdev-mso-table" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:1160px">--}}
{{--                                            <tr>--}}
{{--                                                <td class="esdev-mso-td" valign="top" style="padding:0;Margin:0">--}}
{{--                                                    <table cellpadding="0" cellspacing="0" class="es-left" align="left" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">--}}
{{--                                                        <tr>--}}
{{--                                                            <td align="left" style="padding:0;Margin:0;width:570px">--}}
{{--                                                                <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                                                    <tr>--}}
{{--                                                                        <td align="left" style="padding:0;Margin:0"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;line-height:24px;color:#4D4D4D;font-size:16px">Subtotal<br>Discount<br>Shipping</p></td>--}}
{{--                                                                    </tr>--}}
{{--                                                                </table></td>--}}
{{--                                                        </tr>--}}
{{--                                                    </table></td>--}}
{{--                                                <td style="padding:0;Margin:0;width:20px"></td>--}}
{{--                                                <td class="esdev-mso-td" valign="top" style="padding:0;Margin:0">--}}
{{--                                                    <table cellpadding="0" cellspacing="0" class="es-right" align="right" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">--}}
{{--                                                        <tr>--}}
{{--                                                            <td align="left" style="padding:0;Margin:0;width:570px">--}}
{{--                                                                <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                                                    <tr>--}}
{{--                                                                        <td align="right" style="padding:0;Margin:0"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;line-height:24px;color:#4D4D4D;font-size:16px">${{$subTotal}}<br>{{$discount}}%<br>${{$shipping}}--}}
{{--                                                                    </tr>--}}
{{--                                                                </table></td>--}}
{{--                                                        </tr>--}}
{{--                                                    </table></td>--}}
{{--                                            </tr>--}}
{{--                                        </table></td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td align="left" style="padding:0;Margin:0;padding-left:20px;padding-right:20px">--}}
{{--                                        <table cellpadding="0" cellspacing="0" width="100%" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                            <tr>--}}
{{--                                                <td align="center" valign="top" style="padding:0;Margin:0;width:1160px">--}}
{{--                                                    <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                                        <tr>--}}
{{--                                                            <td align="center" style="padding:0;Margin:0;padding-top:5px;padding-bottom:5px;font-size:0">--}}
{{--                                                                <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                                                    <tr>--}}
{{--                                                                        <td style="padding:0;Margin:0;border-bottom:5px dotted #333;background:unset;height:1px;width:100%;margin:0px"></td>--}}
{{--                                                                    </tr>--}}
{{--                                                                </table></td>--}}
{{--                                                        </tr>--}}
{{--                                                    </table></td>--}}
{{--                                            </tr>--}}
{{--                                        </table></td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td class="esdev-adapt-off" align="left" style="padding:20px;Margin:0">--}}
{{--                                        <table cellpadding="0" cellspacing="0" class="esdev-mso-table" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:1160px">--}}
{{--                                            <tr>--}}
{{--                                                <td class="esdev-mso-td" valign="top" style="padding:0;Margin:0">--}}
{{--                                                    <table cellpadding="0" cellspacing="0" class="es-left" align="left" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">--}}
{{--                                                        <tr>--}}
{{--                                                            <td align="left" style="padding:0;Margin:0;width:570px">--}}
{{--                                                                <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                                                    <tr>--}}
{{--                                                                        <td align="left" class="es-m-txt-l" style="padding:0;Margin:0"><h3 style="Margin:0;line-height:29px;mso-line-height-rule:exactly;font-family:Raleway, Arial, sans-serif;font-size:24px;font-style:normal;font-weight:normal;color:#386641">Total</h3></td>--}}
{{--                                                                    </tr>--}}
{{--                                                                </table></td>--}}
{{--                                                        </tr>--}}
{{--                                                    </table></td>--}}
{{--                                                <td style="padding:0;Margin:0;width:20px"></td>--}}
{{--                                                <td class="esdev-mso-td" valign="top" style="padding:0;Margin:0">--}}
{{--                                                    <table cellpadding="0" cellspacing="0" class="es-right" align="right" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">--}}
{{--                                                        <tr>--}}
{{--                                                            <td align="left" style="padding:0;Margin:0;width:570px">--}}
{{--                                                                <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                                                    <tr>--}}
{{--                                                                        <td align="right" class="es-m-txt-r" style="padding:0;Margin:0"><h3 style="Margin:0;line-height:29px;mso-line-height-rule:exactly;font-family:Raleway, Arial, sans-serif;font-size:24px;font-style:normal;font-weight:normal;color:#386641">--}}
{{--                                                                                @if ($order->shipping_method == 'express')--}}
{{--                                                                                    ${{ floatval($total) + 20 }}--}}
{{--                                                                                @elseif ($order->shipping_method == 'standard')--}}
{{--                                                                                    ${{ floatval($total) + 10 }}--}}
{{--                                                                                @else--}}
{{--                                                                                    ${{ floatval($total) }}--}}
{{--                                                                                @endif--}}
{{--                                                                                ${{$total}}--}}
{{--                                                                            </h3></td>--}}
{{--                                                                    </tr>--}}
{{--                                                                </table></td>--}}
{{--                                                        </tr>--}}
{{--                                                    </table></td>--}}
{{--                                            </tr>--}}
{{--                                        </table></td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td align="left" style="Margin:0;padding-left:20px;padding-right:20px;padding-bottom:30px;padding-top:40px">--}}
{{--                                        <table cellpadding="0" cellspacing="0" width="100%" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                            <tr>--}}
{{--                                                <td align="center" valign="top" style="padding:0;Margin:0;width:1160px">--}}
{{--                                                    <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                                        <tr>--}}
{{--                                                            <td align="center" style="padding:0;Margin:0"><h1 style="Margin:0;line-height:60px;mso-line-height-rule:exactly;font-family:Raleway, Arial, sans-serif;font-size:40px;font-style:normal;font-weight:normal;color:#386641">Billing and shipping</h1></td>--}}
{{--                                                        </tr>--}}
{{--                                                    </table></td>--}}
{{--                                            </tr>--}}
{{--                                        </table></td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td align="left" style="padding:20px;Margin:0"><!--[if mso]><table style="width:1160px" cellpadding="0" cellspacing="0"><tr><td style="width:570px" valign="top"><![endif]-->--}}
{{--                                        <table cellpadding="0" cellspacing="0" class="es-left" align="left" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">--}}
{{--                                            <tr>--}}
{{--                                                <td class="es-m-p20b" align="left" style="padding:0;Margin:0;width:570px">--}}
{{--                                                    <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                                        <tr>--}}
{{--                                                            <td align="left" style="padding:0;Margin:0"><h3 style="Margin:0;line-height:29px;mso-line-height-rule:exactly;font-family:Raleway, Arial, sans-serif;font-size:24px;font-style:normal;font-weight:normal;color:#386641">Billing</h3><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;line-height:24px;color:#4D4D4D;font-size:16px">Della Cannon<br>9618 Cinder Turnabout,<br>Jenny Lind,<br>Northwest Territories</p></td>--}}
{{--                                                        </tr>--}}
{{--                                                    </table></td>--}}
{{--                                            </tr>--}}
{{--                                        </table><!--[if mso]></td><td style="width:20px"></td><td style="width:570px" valign="top"><![endif]-->--}}
{{--                                        <table cellpadding="0" cellspacing="0" class="es-right" align="right" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">--}}
{{--                                            <tr>--}}
{{--                                                <td align="left" style="padding:0;Margin:0;width:570px">--}}
{{--                                                    <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                                        <tr>--}}
{{--                                                            <td align="left" style="padding:0;Margin:0"><h3 style="Margin:0;line-height:29px;mso-line-height-rule:exactly;font-family:Raleway, Arial, sans-serif;font-size:24px;font-style:normal;font-weight:normal;color:#386641">Shipping Address</h3><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;line-height:24px;color:#4D4D4D;font-size:16px">{{$order->country}},<br>{{$order->street_address}},<br>{{$order->town_city}}<br><br></td>--}}
{{--                                                        </tr>--}}
{{--                                                    </table></td>--}}
{{--                                            </tr>--}}
{{--                                        </table><!--[if mso]></td></tr></table><![endif]--></td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td align="left" style="padding:20px;Margin:0"><!--[if mso]><table style="width:1160px" cellpadding="0" cellspacing="0"><tr><td style="width:570px" valign="top"><![endif]-->--}}
{{--                                        <table cellpadding="0" cellspacing="0" class="es-left" align="left" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">--}}
{{--                                            <tr>--}}
{{--                                                <td class="es-m-p20b" align="left" style="padding:0;Margin:0;width:570px">--}}
{{--                                                    <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                                        <tr>--}}
{{--                                                            <td align="left" style="padding:0;Margin:0"><h3 style="Margin:0;line-height:29px;mso-line-height-rule:exactly;font-family:Raleway, Arial, sans-serif;font-size:24px;font-style:normal;font-weight:normal;color:#386641">Payment&nbsp;Method</h3><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;line-height:24px;color:#4D4D4D;font-size:16px">--}}
{{--                                                                {{$order->payment_type}}</p></td>--}}
{{--                                                        </tr>--}}
{{--                                                    </table></td>--}}
{{--                                            </tr>--}}
{{--                                        </table><!--[if mso]></td><td style="width:20px"></td><td style="width:570px" valign="top"><![endif]-->--}}
{{--                                        <table cellpadding="0" cellspacing="0" class="es-right" align="right" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">--}}
{{--                                            <tr>--}}
{{--                                                <td align="left" style="padding:0;Margin:0;width:570px">--}}
{{--                                                    <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                                        <tr>--}}
{{--                                                            <td align="left" style="padding:0;Margin:0"><h3 style="Margin:0;line-height:29px;mso-line-height-rule:exactly;font-family:Raleway, Arial, sans-serif;font-size:24px;font-style:normal;font-weight:normal;color:#386641">Shipping Method</h3><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;line-height:24px;color:#4D4D4D;font-size:16px">--}}
{{--                                                                {{$order->shipping_method}}</p></td>--}}
{{--                                                        </tr>--}}
{{--                                                    </table></td>--}}
{{--                                            </tr>--}}
{{--                                        </table><!--[if mso]></td></tr></table><![endif]--></td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td align="left" style="Margin:0;padding-left:20px;padding-right:20px;padding-top:30px;padding-bottom:40px">--}}
{{--                                        <table cellpadding="0" cellspacing="0" width="100%" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                            <tr>--}}
{{--                                                <td align="left" style="padding:0;Margin:0;width:1160px">--}}
{{--                                                    <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                                        <tr>--}}
{{--                                                            <td align="center" class="es-m-txt-c" style="padding:0;Margin:0"><!--[if mso]><a href="./account/my-order" target="_blank" hidden>--}}
{{--                                                                    <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" esdevVmlButton href="https://viewstripo.email"--}}
{{--                                                                                 style="height:39px; v-text-anchor:middle; width:161px" arcsize="13%" stroke="f"  fillcolor="#6a994e">--}}
{{--                                                                        <w:anchorlock></w:anchorlock>--}}
{{--                                                                        <center style='color:#ffffff; font-family:Raleway, Arial, sans-serif; font-size:14px; font-weight:400; line-height:14px;  mso-text-raise:1px'>View Order</center>--}}
{{--                                                                    </v:roundrect></a>--}}
{{--                                                                <![endif]--><!--[if !mso]><!-- --><span class="msohide es-button-border" style="border-style:solid;border-color:#386641;background:#6A994E;border-width:1px;display:inline-block;border-radius:5px;width:auto;mso-hide:all"><a href="./account/my-order" class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;color:#FFFFFF;font-size:16px;display:inline-block;background:#6A994E;border-radius:5px;font-family:Raleway, Arial, sans-serif;font-weight:normal;font-style:normal;line-height:19px;width:auto;text-align:center;padding:10px 30px 10px 30px;mso-padding-alt:0;mso-border-alt:10px solid #6A994E">View Order</a></span><!--<![endif]--></td>--}}
{{--                                                        </tr>--}}
{{--                                                    </table></td>--}}
{{--                                            </tr>--}}
{{--                                        </table></td>--}}
{{--                                </tr>--}}
{{--                            </table></td>--}}
{{--                    </tr>--}}
{{--                </table>--}}
{{--                <table cellpadding="0" cellspacing="0" class="es-content" align="center" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">--}}
{{--                    <tr>--}}
{{--                        <td align="center" style="padding:0;Margin:0">--}}
{{--                            <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:1200px">--}}
{{--                                <tr>--}}
{{--                                    <td align="left" style="Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px;padding-top:40px">--}}
{{--                                        <table cellpadding="0" cellspacing="0" width="100%" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                            <tr>--}}
{{--                                                <td align="center" valign="top" style="padding:0;Margin:0;width:1160px">--}}
{{--                                                    <table cellpadding="0" cellspacing="0" width="100%" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                                        <tr>--}}
{{--                                                            <td align="center" style="padding:0;Margin:0;display:none"></td>--}}
{{--                                                        </tr>--}}
{{--                                                    </table></td>--}}
{{--                                            </tr>--}}
{{--                                        </table></td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td align="left" style="padding:0;Margin:0;padding-left:20px;padding-right:20px">--}}
{{--                                        <table cellpadding="0" cellspacing="0" width="100%" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                            <tr>--}}
{{--                                                <td align="center" valign="top" style="padding:0;Margin:0;width:1160px">--}}
{{--                                                    <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                                        <tr>--}}
{{--                                                            <td align="center" style="padding:0;Margin:0;padding-top:5px;padding-bottom:5px;font-size:0">--}}
{{--                                                                <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                                                    <tr>--}}
{{--                                                                        <td style="padding:0;Margin:0;border-bottom:5px dotted #333;background:unset;height:1px;width:100%;margin:0px"></td>--}}
{{--                                                                    </tr>--}}
{{--                                                                </table></td>--}}
{{--                                                        </tr>--}}
{{--                                                    </table></td>--}}
{{--                                            </tr>--}}
{{--                                        </table></td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td align="left" style="padding:0;Margin:0;padding-left:20px;padding-right:20px;padding-bottom:40px">--}}
{{--                                        <table cellpadding="0" cellspacing="0" width="100%" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                            <tr>--}}
{{--                                                <td align="center" valign="top" style="padding:0;Margin:0;width:1160px">--}}
{{--                                                    <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                                        <tr>--}}
{{--                                                            <td align="center" style="padding:0;Margin:0;padding-top:5px;padding-bottom:5px;font-size:0">--}}
{{--                                                                <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                                                    <tr>--}}
{{--                                                                        <td style="padding:0;Margin:0;border-bottom:5px dotted #333;background:unset;height:1px;width:100%;margin:0px"></td>--}}
{{--                                                                    </tr>--}}
{{--                                                                </table></td>--}}
{{--                                                        </tr>--}}
{{--                                                    </table></td>--}}
{{--                                            </tr>--}}
{{--                                        </table></td>--}}
{{--                                </tr>--}}
{{--                            </table></td>--}}
{{--                    </tr>--}}
{{--                </table>--}}
{{--                <table cellpadding="0" cellspacing="0" class="es-footer" align="center" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">--}}
{{--                    <tr>--}}
{{--                        <td align="center" style="padding:0;Margin:0">--}}
{{--                            <table bgcolor="#ffffff" class="es-footer-body" align="center" cellpadding="0" cellspacing="0" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:1200px">--}}
{{--                                <tr>--}}
{{--                                    <td align="left" style="padding:0;Margin:0">--}}
{{--                                        <table cellpadding="0" cellspacing="0" width="100%" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                            <tr>--}}
{{--                                                <td align="center" valign="top" style="padding:0;Margin:0;width:1200px">--}}
{{--                                                    <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                                        <tr>--}}
{{--                                                            <td align="center" style="padding:0;Margin:0;padding-top:5px;padding-bottom:5px;font-size:0">--}}
{{--                                                                <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                                                    <tr>--}}
{{--                                                                        <td style="padding:0;Margin:0;border-bottom:2px solid #eff7f6;background:unset;height:1px;width:100%;margin:0px"></td>--}}
{{--                                                                    </tr>--}}
{{--                                                                </table></td>--}}
{{--                                                        </tr>--}}
{{--                                                    </table></td>--}}
{{--                                            </tr>--}}
{{--                                        </table></td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td align="left" style="Margin:0;padding-left:20px;padding-right:20px;padding-top:30px;padding-bottom:30px">--}}
{{--                                        <table cellpadding="0" cellspacing="0" width="100%" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                            <tr>--}}
{{--                                                <td align="left" style="padding:0;Margin:0;width:1160px">--}}
{{--                                                    <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                                        <tr>--}}
{{--                                                            <td style="padding:0;Margin:0">--}}
{{--                                                                <table cellpadding="0" cellspacing="0" width="100%" class="es-menu" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                                                    <tr class="links">--}}
{{--                                                                        <td align="center" valign="top" width="33.33%" id="esd-menu-id-0" style="Margin:0;padding-left:5px;padding-right:5px;padding-top:10px;padding-bottom:10px;border:0"><a target="_blank" href="" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;display:block;font-family:tahoma, verdana, segoe, sans-serif;color:#6a994e;font-size:12px">Who are you</a></td>--}}
{{--                                                                        <td align="center" valign="top" width="33.33%" id="esd-menu-id-1" style="Margin:0;padding-left:5px;padding-right:5px;padding-top:10px;padding-bottom:10px;border:0"><a target="_blank" href="" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;display:block;font-family:tahoma, verdana, segoe, sans-serif;color:#6a994e;font-size:12px">Who we serve</a></td>--}}
{{--                                                                        <td align="center" valign="top" width="33.33%" id="esd-menu-id-2" style="Margin:0;padding-left:5px;padding-right:5px;padding-top:10px;padding-bottom:10px;border:0"><a target="_blank" href="" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;display:block;font-family:tahoma, verdana, segoe, sans-serif;color:#6a994e;font-size:12px">Why SAP</a></td>--}}
{{--                                                                    </tr>--}}
{{--                                                                </table></td>--}}
{{--                                                        </tr>--}}
{{--                                                        <tr>--}}
{{--                                                            <td align="center" class="es-m-txt-c" style="padding:0;Margin:0;padding-top:20px;padding-bottom:20px;font-size:0">--}}
{{--                                                                <table cellpadding="0" cellspacing="0" class="es-table-not-adapt es-social" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                                                    <tr>--}}
{{--                                                                        <td align="center" valign="top" style="padding:0;Margin:0;padding-right:20px"><a target="_blank" href="https://viewstripo.email" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#6A994E;font-size:12px"><img src="https://static.vecteezy.com/system/resources/previews/023/986/613/non_2x/facebook-logo-facebook-logo-transparent-facebook-icon-transparent-free-free-png.png" alt="Fb" title="Facebook" height="24" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a></td>--}}
{{--                                                                        <td align="center" valign="top" style="padding:0;Margin:0;padding-right:20px"><a target="_blank" href="https://viewstripo.email" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#6A994E;font-size:12px"><img src="https://cdn.iconscout.com/icon/free/png-256/free-twitter-x-9581782-7740647.png?f=webp" alt="Tw" title="X" height="27" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a></td>--}}
{{--                                                                        <td align="center" valign="top" style="padding:0;Margin:0;padding-right:20px"><a target="_blank" href="https://viewstripo.email" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#6A994E;font-size:12px"><img src="https://e7.pngegg.com/pngimages/208/269/png-clipart-youtube-play-button-computer-icons-youtube-youtube-logo-angle-rectangle-thumbnail.png" alt="Yt" title="Youtube" height="24" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a></td>--}}
{{--                                                                        <td align="center" valign="top" style="padding:0;Margin:0"><a target="_blank" href="https://viewstripo.email" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#6A994E;font-size:12px"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a5/Instagram_icon.png/600px-Instagram_icon.png" alt="Ig" title="Instagram" height="22" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a></td>--}}
{{--                                                                    </tr>--}}
{{--                                                                </table></td>--}}
{{--                                                        </tr>--}}
{{--                                                        <tr>--}}
{{--                                                            <td align="center" style="padding:0;Margin:0"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;line-height:20px;color:#4D4D4D;font-size:13px"><a target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#6A994E;font-size:12px" href=""></a><a target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#6A994E;font-size:12px" href="https://viewstripo.email">Privacy Policy</a><a target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#6A994E;font-size:13px" href=""></a> • <a target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#6A994E;font-size:12px" href="">Unsubscribe</a></p></td>--}}
{{--                                                        </tr>--}}
{{--                                                    </table></td>--}}
{{--                                            </tr>--}}
{{--                                        </table></td>--}}
{{--                                </tr>--}}
{{--                            </table></td>--}}
{{--                    </tr>--}}
{{--                </table>--}}
{{--                <table cellpadding="0" cellspacing="0" class="es-content" align="center" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">--}}
{{--                    <tr>--}}
{{--                        <td align="center" style="padding:0;Margin:0">--}}
{{--                            <table class="es-content-body" align="center" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:1200px" role="none">--}}
{{--                                <tr>--}}
{{--                                    <td align="left" style="padding:20px;Margin:0">--}}
{{--                                        <table cellpadding="0" cellspacing="0" width="100%" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}
{{--                                            <tr>--}}
{{--                                                <td align="center" valign="top" style="padding:0;Margin:0;width:1160px">--}}
{{--                                                    <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">--}}

{{--                                                    </table></td>--}}
{{--                                            </tr>--}}
{{--                                        </table></td>--}}
{{--                                </tr>--}}
{{--                            </table></td>--}}
{{--                    </tr>--}}
{{--                </table></td>--}}
{{--        </tr>--}}
{{--    </table>--}}
{{--</div>--}}


       <div class="container shadow my-3 bg-white">
           <div class="row">
               <div class="col-md-8 p-5">
                   <div class="row border-bottom">
                       <div style="padding-top: 5px">
                           <img src="front/img/icon/received icon.png" alt="" width="45" height="45">
                       </div>

                       <div class="col">
                           <h3 class="font-weight-bold" style="font-size: 1.7em">Thank you, we received your order!</h3>
                           <p class="text-black-50">Your order #{{$order->id}} is completed and ready to ship</p>
                       </div>

                   </div>
                   <h5 class="text-black-50 font-weight-bolder mt-4">Order Details</h5>
                   @if(isset($orderProducts) && $orderProducts->count() > 0)
                       @foreach($orderProducts as $item)
                    <div class="row border-bottom">
                        <div class="col">
                            <div class="row my-3">
                                <div class="col">
                                    <img src="front/img/product/{{$item->product->productImages[0]->path}}" alt="image" width="130" height="130">
                                </div>
                                <div class="col-8">
                                    <h5 class="font-weight-bold pb-2">{{$item->product->name}} </h5>
                                    <h6>Size: {{$item->size}}</h6>
                                    <h6>Color:
                                        @php
                                            $sizeColorMapping = [
                                                '1' => 'black',
                                                '2' => 'darkblue',
                                                '3' => 'orange',
                                                '4' => 'grey',
                                                '5' => 'lightblack',
                                                '6' => 'pink',
                                                '7' => 'violet',
                                                '8' => 'red',
                                                '9' => 'white',
                                            ];
                                            $colorNumber = $sizeColorMapping[$item->color] ?? '';
                                        @endphp
                                        {{$colorNumber}}
                                    </h6>
                                    <h5 class="font-weight-bold mt-4">${{$item->product->discount ?? $item->product->price}}</h5>
                                </div>
                            </div>

                        </div>

                    </div>
                       @endforeach
                   @endif
                   <div class="row py-4">
                           <div class="col">
                               <p class="font-weight-bold text-black-50">Subtotal</p>
                               <p class="font-weight-bold text-black-50">Shipping</p>
                               <p class="font-weight-bold text-black-50">Discount</p>
                               <p class="font-weight-bold h5">Total</p>
                           </div>
                           <div class="">
                               <p class="font-weight-bold text-black-50">${{$subTotal}}</p>
                               <p class="font-weight-bold text-black-50">${{$shipping}}</p>
                               <p class="font-weight-bold text-black-50">{{$discount}}</p>
                               <p class="font-weight-bold h5">${{$total}}</p>
                           </div>
                   </div>
               </div>
               <div class="col p-5">
                   <div class="bg-light">
                       <div class="p-5">
                           <div class="mb-5">
                               <h6 class="font-weight-bold mb-3">Shipping Address</h6>
                               <p>{{$order->country}} <br>{{$order->town_city}}, {{$order->street_address}}</p>
                           </div>
                           <div class="mb-5">
                               <h6 class="font-weight-bold mb-3">Billing Address</h6>
                               <p>Viet nam <br>Detech Building 8a Tôn Thất Thuyết, Mỹ Đình, Cầu Giấy, Hà Nội</p>
                           </div>
                           <div>
                               <h6 class="font-weight-bold">Payment Info</h6>
                               <p>{{$order->payment_type}}</p>
                           </div>
                           <div>
                               <h6 class="font-weight-bold">Shipping method</h6>
                               <p>{{$order->shipping_method}}</p>
                           </div>
                       </div>

                   </div>
               </div>
           </div>
       </div>
</body>
@endsection
