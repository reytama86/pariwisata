<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script type="text/javascript" src="https://app.stg.midtrans.com/snap/snap.js"
        data-client-key="{{config('midtrans.client_key')}}"></script>
    </head>

    <body>


        <!-- Checkout -->
        <section class="section-wrap checkout pb-70">
            <div class="container relative">
                <div class="row">

                    <div class="ecommerce col-xs-12">
                        <h1 class="my-3">TourTrekker</h1>
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Detail Pesanan</h5>
                                <table>
                                    <tr>
                                        <td>Nama</td>
                                        <td> : {{ $orders->member->nama_member }}</td>
                                    </tr>
                                    <tr>
                                        <td>Grand Total</td>
                                        <td> : {{ $orders->grand_total }}</td>
                                    </tr>
                                </table>
                                <button class="btn btn-primary mt-3" id="pay-button">Pay Now</button>
                            </div>
                        </div>
                    </div>

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
    </body>

    </html>