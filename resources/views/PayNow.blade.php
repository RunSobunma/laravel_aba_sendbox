<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   
    <title>Document</title>
    <style>
        body{
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 600px;
            /* background-color: blueviolet; */
        }
        .box{
            background-color: green;
            width: 400px;
            padding: 40px 30px ; 
            border-radius: 10px;
        }
        h2{
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="{{config('payway.api_url')}}" method="post" target="aba_webservice" id="aba_merchant_request" >
            @csrf
            <input type="hidden" name="hash" value="{{$hash}}" id="hash"/>
            <input type="hidden" name="items" value="{{$items_endcode}}" id="items"/>
            <input type="hidden" name="req_time" value="{{$req_time}}"/>
            <input type="hidden" name="tran_id" value="{{$transactionId}}" id="tran_id"/>
            <input type="hidden" name="amount" value="{{$amount}}" id="amount"/>
            <input type="hidden" name="firstname" value="{{$firstName}}"/>
            <input type="hidden" name="lastname" value="{{$lastName}}"/>
            <input type="hidden" name="phone" value="{{$phone}}"/>
            <input type="hidden" name="email" value="{{$email}}"/>
            <input type="hidden" name="return_params" value="{{$return_params}}"/>
            <input type="hidden" name="type" value="{{$type}}"/>
            <input type="hidden" name="currency" value="{{$currency}}"/>
            <input type="hidden" name="shipping" value="{{$shipping}}"/>
            <input type="hidden" name="merchant_id" value="{{$merchant_id}}"/>
            <input type="hidden" name="payment_option" value="{{$payment_option}}"/>
        </form>

        <center class="">
            <div class="box">
                <h2 >
                    Total Amount : <span class="text-info" >{{$amount}}$</span>
                </h2>
                <input type="button" class="btn btn-warning mt-3" id="checkout_button" value="Checkout Now">
            </div>
        </center>
    </div>

    <!-- aba script -->
    <script src="https://checkout.payway.com.kh/plugins/checkout2-0.js"></script>
    
    

    <script>
        $(document).ready(function () {

            
            $('#checkout_button').click(function () {
                AbaPayway.checkout();
            });


        });
    </script>

</body>
</html>
