@extends('layout.home')

@section('title', 'Checkout')

@section('content')

    <!-- Checkout -->
    <section class="section-wrap checkout pb-70">
        <html>

        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
            <script type="text/javascript" src="{{config('midtrans.snap_url')}}"
                data-client-key="{{config('midtrans.client-key')}}"></script>
            <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
        </head>

        <body>
            <div class="container relative">
                <div class="row">

                    <div class="ecommerce col-xs-12">

                        <table>
                            <input type="hidden" name="id_order" value="{{ $orders->id }}">
                            <div class="col-md-8" id="customer_details">
                                <div>
                                    <h2 class="heading uppercase bottom-line full-grey mb-30">billing address</h2>
                                    <p class="form-row form-row-first validate-required ecommerce-invalid ecommerce-invalid-required-field"
                                        id="billing_first_name_field">
                                        <label for="billing_first_name">Kota
                                            <abbr class="required" title="required">*</abbr>
                                        </label>
                                        <select name="kabupaten" id="kota" class="country_to_state kota"
                                            rel="calc_shipping_state">

                                        </select>
                                    </p>
                                    <p class="form-row form-row-first validate-required ecommerce-invalid ecommerce-invalid-required-field"
                                        id="billing_first_name_field">
                                        <label for="billing_first_name">Detail Alamat
                                            <abbr class="required" title="required">*</abbr>
                                        </label>
                                        <input type="text" class="input-text" placeholder value name="detail_alamat"
                                            id="billing_first_name">
                                    </p>
                                    <p class="form-row form-row-first validate-required ecommerce-invalid ecommerce-invalid-required-field"
                                        id="billing_first_name_field">
                                        <label for="billing_first_name">Atas Nama :
                                            <abbr class="required" title="required"></abbr>
                                        </label>
                                        <input type="text" class="input-text" placeholder value name="{{$orders->member->nama_member}}"
                                            id="billing_first_name">
                                    </p>
                                    <p class="form-row form-row-first validate-required ecommerce-invalid ecommerce-invalid-required-field"
                                        id="billing_first_name_field">
                                        <label for="billing_first_name">No Rekening
                                            <abbr class="required" title="required">*</abbr>
                                        </label>
                                        <input type="text" class="input-text" placeholder value name="no_rekening"
                                            id="billing_first_name">
                                    </p>
                                    <p class="form-row form-row-first validate-required ecommerce-invalid ecommerce-invalid-required-field"
                                        id="billing_first_name_field">
                                        <label for="billing_first_name">Jumlah Passengers
                                            <abbr class="required" title="required">*</abbr>
                                        </label>
                                        <input type="text" class="input-text" placeholder value name="jumlah"
                                            id="billing_first_name">
                                    </p>

                                    <div class="clear"></div>

                                </div>

                                <div class="clear"></div>

                            </div> <!-- end col -->

                            <!-- Your Order -->
                            <div class="col-md-4">
                                <div class="order-review-wrap ecommerce-checkout-review-order" id="order_review">
                                    <br>
                                    <h2 class="heading uppercase bottom-line full-grey">Your Order</h2>
                                    <table class="table shop_table ecommerce-checkout-review-order-table">
                                        <tbody>
                                            <tr class="order-total">
                                                <th><strong>Order Total</strong></th>
                                                <td>
                                                    <strong><span class="amount">Rp.
                                                            {{ number_format($orders->grand_total) }}</span></strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div id="payment" class="ecommerce-checkout-payment">
                                        <h2 class="heading uppercase bottom-line full-grey">Payment Method</h2>
                                        <ul class="payment_methods methods">

                                            <li class="payment_method_bacs">
                                                <input id="payment_method_bacs" type="radio" class="input-radio"
                                                    name="payment_method" value="bacs" checked="checked">
                                                <label for="payment_method_bacs">Direct Bank Transfer</label>
                                                <div class="payment_box payment_method_bacs">
                                                    <p>Make your payment directly into our bank account. Please use your
                                                        Order
                                                        ID as the payment reference. Your order wont be shipped until the
                                                        funds
                                                        have cleared in our account.</p>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="form-row place-order">
                                            <button class="pay-button" id="pay-button">Pay Now</button>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end order review -->
                        </table>

                        <script type="text/javascript">
                            // For example trigger on button clicked, or any time you need
                            var payButton = document.getElementById('pay-button');
                            payButton.addEventListener('click', function () {
                              // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
                              window.snap.pay('{{$snapToken}}', {
                                onSuccess: function(result){
                                  /* You may add your own implementation here */
                                  alert("payment success!"); console.log(result);
                                },
                                onPending: function(result){
                                  /* You may add your own implementation here */
                                  alert("wating your payment!"); console.log(result);
                                },
                                onError: function(result){
                                  /* You may add your own implementation here */
                                  alert("payment failed!"); console.log(result);
                                },
                                onClose: function(){
                                  /* You may add your own implementation here */
                                  alert('you closed the popup without finishing the payment');
                                }
                              })
                            });
                          </script>

                    </div> <!-- end ecommerce -->

                </div> <!-- end row -->
            </div> <!-- end container -->
        </body>

        </html>
    </section> <!-- end checkout -->

@endsection
