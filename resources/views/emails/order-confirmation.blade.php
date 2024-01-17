

<table id="x_601669422outer_wrapper" style="background-color :  #f7f7f7; " width="100%" bgcolor="#f7f7f7">
    <tbody>
      <tr>
        <td></td>
        <td width="600">
          <div id="x_601669422wrapper" dir="ltr" style="margin :  0 auto; padding :  70px 0; width :  100%; max-width :  600px; ">
            <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
              <tbody>
                <tr>
                  <td valign="top" align="center">
                    <div id="x_601669422template_header_image">
                      <p style="margin-top :  0; ">
                        <img id="1685504619151100001_imgsrc_url_0" alt="Online Shop" style="border :  none; display :  inline-block; font-size :  14px; font-weight :  bold; height :  auto; outline :  none; text-decoration :  none; text-transform :  capitalize; vertical-align :  middle; max-width :  100%; margin-left :  0; margin-right :  0; " src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/online-shop.png'))) }}" border="0">
                      </p>
                    </div>
                    <table id="x_601669422template_container" style="background-color :  #fff; border :  1px solid #dedede; box-shadow :  0 1px 4px rgba(0,0,0,.1); border-radius :  3px; " width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#fff">
                      <tbody>
                        <tr>
                          <td valign="top" align="center">
                            <table id="x_601669422template_header" style="background-color :  rgb(42, 209, 157); color :  #fff; border-bottom :  0; font-weight :  bold; line-height :  100%; vertical-align :  middle; font-family :  &quot;Helvetica Neue&quot;, Helvetica, Roboto, Arial, sans-serif; border-radius :  3px 3px 0 0; " width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#090">
                              <tbody>
                                <tr>
                                  <td id="x_601669422header_wrapper" style="padding :  36px 48px; display :  block; ">
                                    <h1 style="font-family :  &quot;Helvetica Neue&quot;, Helvetica, Roboto, Arial, sans-serif; font-size :  30px; font-weight :  300; line-height :  150%; margin :  0; text-align :  left; text-shadow :  0 1px 0 #33ad33; color :  #fff; background-color :  inherit; ">Thank you for your order</h1>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                        </tr>
                        <tr>
                          <td valign="top" align="center">
                            <table id="x_601669422template_body" width="100%" cellspacing="0" cellpadding="0" border="0">
                              <tbody>
                                <tr>
                                  <td id="x_601669422body_content" style="background-color :  #fff; " valign="top" bgcolor="#fff">
                                    <table width="100%" cellspacing="0" cellpadding="20" border="0">
                                      <tbody>
                                        <tr>
                                          <td style="padding :  48px 48px 32px; " valign="top">
                                            <div id="x_601669422body_content_inner" style="color :  #636363; font-family :  &quot;Helvetica Neue&quot;, Helvetica, Roboto, Arial, sans-serif; font-size :  14px; line-height :  150%; text-align :  left; " align="left">
                                                <p style="margin:0 0 16px">Hi <b>{{ $order->customer->name }}</b>,</p>
                                                <p style="margin:0 0 16px">Just to let you know — we've received your order #{{ $order->id }}, and it is now being processed:</p>
                                                <p style="margin :  0 0 16px; "> Pay with {{ ucfirst(str_replace('_',' ',$order->payment_method)) }}.</p>
                                              <h2 style="color :  rgb(42, 209, 157); display :  block; font-family :  &quot;Helvetica Neue&quot;, Helvetica, Roboto, Arial, sans-serif; font-size :  18px; font-weight :  bold; line-height :  130%; margin :  0 0 18px; text-align :  left; ">
                                                <a class="x_601669422link" href="{{ route('admin#orderlist') }}" style="font-weight :  normal; text-decoration :  underline; color :  rgb(42, 209, 157); " target="_blank"> [Order #{{ $order->id }}] </a> ({{  date('F j, Y', strtotime($order->order_date))}})
                                              </h2>
                                              <div style="margin-bottom :  40px; ">
                                                <table class="x_601669422td" style="color :  #636363; border :  1px solid #e5e5e5; vertical-align :  middle; width :  100%; font-family :  'Helvetica Neue',  Helvetica,  Roboto,  Arial,  sans-serif; " width="100%" cellspacing="0" cellpadding="6" border="1">
                                                  <thead>
                                                    <tr>
                                                      <th class="x_601669422td" scope="col" style="color :  #636363; border :  1px solid #e5e5e5; vertical-align :  middle; padding :  12px; text-align :  left; " align="left">Product</th>
                                                      <th class="x_601669422td" scope="col" style="color :  #636363; border :  1px solid #e5e5e5; vertical-align :  middle; padding :  12px; text-align :  left; " align="left">Quantity</th>
                                                      <th class="x_601669422td" scope="col" style="color :  #636363; border :  1px solid #e5e5e5; vertical-align :  middle; padding :  12px; text-align :  left; " align="left">Price</th>
                                                      <th class="x_601669422td" scope="col" style="color :  #636363; border :  1px solid #e5e5e5; vertical-align :  middle; padding :  12px; text-align :  left; " align="left">Total</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    @foreach($order->items as $item)
                                                    <tr class="x_601669422order_item">
                                                      <td class="x_601669422td" style="color :  #636363; border :  1px solid #e5e5e5; padding :  12px; text-align :  left; vertical-align :  middle; font-family :  'Helvetica Neue',  Helvetica,  Roboto,  Arial,  sans-serif; " align="left"> {{ $item->product->name }} </td>
                                                      <td class="x_601669422td" style="color :  #636363; border :  1px solid #e5e5e5; padding :  12px; text-align :  left; vertical-align :  middle; font-family :  'Helvetica Neue',  Helvetica,  Roboto,  Arial,  sans-serif; " align="left"> {{ $item->quantity }} </td>
                                                      <td class="x_601669422td" style="color :  #636363; border :  1px solid #e5e5e5; padding :  12px; text-align :  left; vertical-align :  middle; font-family :  'Helvetica Neue',  Helvetica,  Roboto,  Arial,  sans-serif; " align="left">
                                                        <span class="x_601669422woocommerce-Price-amount x_601669422amount">
                                                          <span class="x_601669422woocommerce-Price-currencySymbol">Ks</span>&nbsp;{{ number_format( $item->price,2) }} </span>
                                                      </td>
                                                      <td class="x_601669422td" style="color :  #636363; border :  1px solid #e5e5e5; padding :  12px; text-align :  left; vertical-align :  middle; font-family :  'Helvetica Neue',  Helvetica,  Roboto,  Arial,  sans-serif; " align="left">
                                                        <span class="x_601669422woocommerce-Price-amount x_601669422amount">
                                                          <span class="x_601669422woocommerce-Price-currencySymbol">Ks</span>&nbsp;{{ number_format($item->price * $item->quantity,2) }} </span>
                                                      </td>
                                                    </tr>
                                                    @endforeach
                                                  </tbody>
                                                  <tfoot>
                                                    <tr>
                                                      <th class="x_601669422td" scope="row" colspan="3" style="color :  #636363; border :  1px solid #e5e5e5; vertical-align :  middle; padding :  12px; text-align :  left; border-top-width :  4px; " align="left">Subtotal:</th>
                                                      <td class="x_601669422td" style="color :  #636363; border :  1px solid #e5e5e5; vertical-align :  middle; padding :  12px; text-align :  left; border-top-width :  4px; " align="left">
                                                        <span class="x_601669422woocommerce-Price-amount x_601669422amount">
                                                          <span class="x_601669422woocommerce-Price-currencySymbol">Ks</span>&nbsp;
                                                          @php
                                                                $subtotal = 0;
                                                            @endphp
                                                            @foreach ($order->items as $item)
                                                                @php
                                                                    $subtotal += $item->price * $item->quantity;
                                                                @endphp
                                                            @endforeach
                                                            {{ number_format($subtotal,2) }}
                                                        </span>
                                                      </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="x_601669422td" scope="row" colspan="3" style="color :  #636363; border :  1px solid #e5e5e5; vertical-align :  middle; padding :  12px; text-align :  left; " align="left">Tax:</th>
                                                        <td class="x_601669422td" style="color :  #636363; border :  1px solid #e5e5e5; vertical-align :  middle; padding :  12px; text-align :  left; " align="left">
                                                            <span class="x_601669422woocommerce-Price-amount x_601669422amount">
                                                                <span class="x_601669422woocommerce-Price-currencySymbol">Ks</span>&nbsp;
                                                                {{ number_format($subtotal * 0.01,2) }}
                                                              </span>

                                                        </td>
                                                      </tr>
                                                    <tr>
                                                      <th class="x_601669422td" scope="row" colspan="3" style="color :  #636363; border :  1px solid #e5e5e5; vertical-align :  middle; padding :  12px; text-align :  left; " align="left">Shipping:</th>
                                                      <td class="x_601669422td" style="color :  #636363; border :  1px solid #e5e5e5; vertical-align :  middle; padding :  12px; text-align :  left; " align="left">Flat rate</td>
                                                    </tr>
                                                    <tr>
                                                      <th class="x_601669422td" scope="row" colspan="3" style="color :  #636363; border :  1px solid #e5e5e5; vertical-align :  middle; padding :  12px; text-align :  left; " align="left">Payment method:</th>
                                                      <td class="x_601669422td" style="color :  #636363; border :  1px solid #e5e5e5; vertical-align :  middle; padding :  12px; text-align :  left; " align="left">{{ ucfirst(str_replace('_',' ',$order->payment_method)) }}</td>
                                                    </tr>
                                                    <tr>
                                                      <th class="x_601669422td" scope="row" colspan="3" style="color :  #636363; border :  1px solid #e5e5e5; vertical-align :  middle; padding :  12px; text-align :  left; " align="left">Total:</th>
                                                      <td class="x_601669422td" style="color :  #636363; border :  1px solid #e5e5e5; vertical-align :  middle; padding :  12px; text-align :  left; " align="left">
                                                        <span class="x_601669422woocommerce-Price-amount x_601669422amount">
                                                          <span class="x_601669422woocommerce-Price-currencySymbol">Ks</span>&nbsp;{{ number_format($order->total_amount,2) }} </span>
                                                      </td>
                                                    </tr>
                                                  </tfoot>
                                                </table>
                                              </div>
                                              <table id="x_601669422addresses" style="width :  100%; vertical-align :  top; margin-bottom :  40px; padding :  0; " width="100%" cellspacing="0" cellpadding="0" border="0">
                                                <tbody>
                                                  <tr>
                                                    <td style="text-align :  left; font-family :  'Helvetica Neue',  Helvetica,  Roboto,  Arial,  sans-serif; border :  0; padding :  0; " width="50%" valign="top" align="left">
                                                      <h2 style="color :  rgb(42, 209, 157); display :  block;  font-size :  18px; font-weight :  bold; line-height :  130%; margin :  0 0 18px; text-align :  left; ">Billing address</h2>
                                                      {{ $order->customer->name }} <br>
                                                      @if ($order->company_name)
                                                        {{ $order->company_name }}<br>
                                                      @endif
                                                      {{ $order->shipping_address }}, <br>
                                                      {{ $order->shipping_township->name }}, <br>
                                                      {{ $order->shipping_state->name }}, <br>
                                                      {{ $order->shipping_country->name }}, {{ $order->shipping_zip }} <br>
                                                      <a href="tel:{{ $order->customer->phone }}" style="color :  rgb(42, 209, 157); font-weight :  normal; text-decoration :  underline; " target="_blank"> {{ $order->customer->phone }} </a>
                                                      <br>
                                                      <a href="mailto:{{ $order->customer->email }}" target="_blank"> {{ $order->customer->email }} </a>
                                                    </td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                              Thanks for using <a href="{{ URL::to("/") }}" style="color :  rgb(42, 209, 157); font-weight :  normal; text-decoration :  underline; " target="_blank">www.website.com</a>.
                                            </div>
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
                  <td valign="top" align="center">
                    <table id="x_601669422template_footer" width="100%" cellspacing="0" cellpadding="10" border="0">
                      <tbody>
                        <tr>
                          <td style="padding :  0; border-radius :  6px; " valign="top">
                            <table width="100%" cellspacing="0" cellpadding="10" border="0">
                              <tbody>
                                <tr>
                                  <td colspan="2" id="x_601669422credit" style="border-radius :  6px; border :  0; color :  #8a8a8a; font-size :  12px; line-height :  150%; text-align :  center; padding :  24px 0; " valign="middle" align="center">
                                    <p style="margin :  0 0 16px; ">Thanks, <br>
                                      {{ config('app.name') }} — Built with <a href="https://laravel.com" style="color :  rgb(42, 209, 157); font-weight :  normal; text-decoration :  underline; " target="_blank">Laravel</a>
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
          </div>
        </td>
        <td></td>
      </tr>
    </tbody>
  </table>
