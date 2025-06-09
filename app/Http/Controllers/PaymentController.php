<?php

namespace App\Http\Controllers;

use App\Services\PaywayService;
use Illuminate\Http\Request;

use function Pest\Laravel\json;

class PaymentController extends Controller
{
    protected $paywayService ;
    public function __construct( PaywayService $paywayService ){
        $this->paywayService = $paywayService;
    }


    public function ChekoutForm(Request $request){
        $itemjs = $request->items;

        $items = json_decode($itemjs , true);

        // Check if decoding was successful, otherwise set $items as an empty array
        $items_endcode = base64_encode(json_encode($items));
        $req_time = time();
        $transactionId = time();
    
        // Calculate total cost of products
        $amount = array_reduce($items, function($sum, $item) {
            return $sum + ($item['quantity'] * $item['price']);
        }, 0);
    
        $firstName = 'Run';
        $lastName = 'Sobunma';
        $phone = '0964166767';
        $email = 'bma3995@gmail.com';
        $return_params = "Hello World!";
        $type = "purchase";
        $currency = "USD";
        $shipping = '0';
        $merchant_id = config('payway.merchant_id');
        $payment_option = "abapay";
    
        $hash = $this->paywayService->getHash(
            $req_time . $merchant_id . $transactionId . $amount 
            . $items_endcode . $shipping . $firstName . $lastName . $email 
            . $phone . $type . $payment_option . $currency  . $return_params
        );
    
        // Prepare data to be sent in response
        $datas = compact(
            'hash',
            'items_endcode',
            'req_time',
            'transactionId',
            'amount',
            'firstName',
            'lastName',
            'phone',
            'email',
            'return_params',
            'type',
            'currency',
            'shipping',
            'merchant_id',
            'payment_option'
        );
    
        return response()->json([
            'status' => 200,
            'datas' => $datas
        ]);
    }
    

}
