<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Validators\ValidatesCustomerRequests;
use Illuminate\Support\Facades\DB;


class CustomerController extends Controller
{
    use ValidatesCustomerRequests;

    /**
     * UserController constructor.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get the authenticated customer.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new UserResource(Auth::user());
    }

    /**
     * Update the authenticated user and return the user if successful.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function placeOrder(Request $request)
    {

        try {

            $user = Auth::user();

            $user_id = $user->id;

            $this->validateOrder($request);

            $order_ref = uniqid();

            $products = $request->input('product');

            foreach($products as $product) {

                if (!$product['product_id'] || !$product['qty'] || !$product['price']) {
                    return response()
                        ->json(['message' => 'product_id, qty & price must be present', 'status' => false]);
                    break;
                }
            }

            foreach($products as $product){
                $results =  DB::table('orders')->insert([
                    'product_id' => $product['product_id'],
                    'order_ref' => $order_ref,
                    'qty' => $product['qty'],
                    'price' => $product['price'],
                    'user_id' => $user_id
                ]);
            }


            return response()
                ->json(['message' => 'order placed', 'order_reference'=>$order_ref, 'status' => true]);


        }
        catch (\Exception $e) {

            return response()
                ->json(['message'=>$e->getMessage(),'status'=>false]);

        }




    }

    public function listOrder(Request $request)
    {

        try {

            $user = Auth::user();

            $user_id = $user->id;

            $this->validateGetOrder($request);

            $orders = DB::table('orders')
                ->join('product', 'orders.product_id', '=', 'product.id')
                ->select('product.name', 'orders.qty', 'orders.price')
                ->where('order_ref','=',$request->input('order_ref'))
                ->get();

            $totalPrice=0;
            foreach ($orders as $order){
                $totalPrice +=$order->price;
            }


            return response()
                ->json(['order' => $orders,'total_price'=>$totalPrice, 'status' => true]);


        }
        catch (\Exception $e) {

            return response()
                ->json(['message'=>$e->getMessage(),'status'=>false]);

        }

    }





}
