<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('order.css')}}">
    <title>Document</title>
</head>
<body>
    <div class="navbar">
        <div class="container">
            <div class="navbar-brand">LoGo <i class="fa-solid fa-truck"></i></div>
            <div class="cart"><i class="fa-solid fa-cart-shopping"></i><p id="count">0</p></div>
        </div>
    </div>
    <div class="container d-flex">
        <div id="root"></div>
        <div id="sidbar">
            <div class="head">My card</div>
            <div id="cartItem">Your cart is empty</div>
            <div class="foot" id="foot" >
                <h3>Total</h3>
                <h2 id="total">$ 0.00</h2>
                <form id="payform" action="{{route('Checkout')}}" method="post" >
                    @csrf
                    <input type="hidden" name="items" value="" id="txtItem">
                    <button type="button" id="btnPaySubmit" class="btn btn-warning" >Pay Now</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
    <form action="{{config('payway.api_url')}}" method="post" target="aba_webservice" id="aba_merchant_request" >
            @csrf
            <input type="hidden" name="hash" value="" id="hash"/>
            <input type="hidden" name="items" value="" id="items"/>
            <input type="hidden" name="req_time" value="" id="req_time" />
            <input type="hidden" name="tran_id" value="" id="tran_id"/>
            <input type="hidden" name="amount" value="" id="amount"/>
            <input type="hidden" name="firstname" value="" id="firstname" />
            <input type="hidden" name="lastname" value="" id="lastname" />
            <input type="hidden" name="phone" value="" id="phone" />
            <input type="hidden" name="email" value="" id="email" />
            <input type="hidden" name="return_params" value="" id="return_params" />
            <input type="hidden" name="type" value=""/ id="type" >
            <input type="hidden" name="currency" value="" id="currency" />
            <input type="hidden" name="shipping" value=""/ id="shipping" >
            <input type="hidden" name="merchant_id" value="" id="merchant_id" />
            <input type="hidden" name="payment_option" value="" id="payment_option" />
        </form>
        <input type="hidden" class="btn btn-warning mt-3" id="checkout_button" value="Checkout Now">
    </div>
    <script src="{{asset('order.js')}}"></script>

    <!-- aba script -->
    <script src="https://checkout.payway.com.kh/plugins/checkout2-0.js"></script>

    <!-- jquery script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!-- ajax script -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $(document).ready(function(){

            $('#checkout_button').click(function () {
                AbaPayway.checkout();
            });
            
            $('#btnPaySubmit').click(function() {
                // Correctly instantiate FormData with the form element (using querySelector or jQuery's DOM element)
                var form = new FormData(document.querySelector("#payform"));  // or use $('#payform')[0]
                
                $.ajax({
                    type: "POST",
                    url: "{{Route('Checkout')}}",
                    data: form,
                    processData: false,  
                    contentType: false, 
                    success: function(response) {
                        var data = response.datas;
                        $("#hash").val(data.hash);
                        $("#items").val(data.items_endcode);
                        $("#req_time").val(data.req_time);
                        $("#tran_id").val(data.transactionId);
                        $("#amount").val(data.amount);
                        $("#firstname").val(data.firstName);
                        $("#lastname").val(data.lastName);
                        $("#phone").val(data.phone);
                        $("#email").val(data.email);
                        $("#return_params").val(data.return_params);
                        $("#type").val(data.type);
                        $("#currency").val(data.currency);
                        $("#shipping").val(data.shipping);
                        $("#merchant_id").val(data.merchant_id);
                        $("#payment_option").val(data.payment_option);
                        $("#checkout_button").click();
                    },
                    
                });
            });
        })
    </script>
</body>
</html>