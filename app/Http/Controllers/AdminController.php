<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Validators\ValidatesAdminRequests;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    use ValidatesAdminRequests;

    /**
     * UserController constructor.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get the authenticated user.
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
    public function addProduct(Request $request)
    {

        try {

            $user = Auth::user();

            $user_id = $user->id;
            $user_type = $user->user_type;

            if ($user_type !== 'admin') {
                return response()->json(['message' => 'Unauthorised to perform action', 'status' => false]);
            }

            $this->validateProduct($request);

            $check_product = DB::table('product')
                ->select(DB::raw('count(1) as count'))
                ->where('name', '=', $request->input('name'))
                ->get();

            if($check_product[0]->count > 0){

                return response()
                    ->json(['message' => 'product name exist', 'status' => false]);
            }



            $results =  DB::table('product')->insert([
                'name' => $request->input('name'),
                    'description' => $request->input('description'),
                    'price' => $request->input('price'),
                    'discount' => $request->input('discount'),
                    'discount_type' => $request->input('discount_type'),
                    'status' => true,
                    'created_by' => $user_id
                    ]);


            return response()
                ->json(['message' => 'product added', 'status' => true]);


        }
        catch (\Exception $e) {

            return response()
                ->json(['message'=>$e->getMessage(),'status'=>false]);

        }




    }

    public function createBundle(Request $request)
    {

        try {

            $user = Auth::user();

            $user_id = $user->id;
            $user_type = $user->user_type;

            if ($user_type !== 'admin') {
                return response()->json(['message' => 'Unauthorised to perform action', 'status' => false]);
            }

            $this->validateBundle($request);

           if(!$this->checkProducts($request->input('products'))){
               return response()
                ->json(['message' => 'some of the selected products not existing ', 'status' => false]);
           }


            $results =  DB::table('bundle')->insert([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'product' => $this->flattenProduct($request->input('products')),
                'status' => true,
                'created_by' => $user_id
            ]);


            return response()
                ->json(['message' => 'bundle successfully created', 'status' => true]);


        }
        catch (\Exception $e) {

            return response()
                ->json(['message'=>$e->getMessage(),'status'=>false]);

        }

    }

    private function flattenProduct($products){
        $selectedProduct ='';
        foreach($products as $product){
            $selectedProduct .= $product.",";
        }
        return $selectedProduct = rtrim($selectedProduct, ',');
    }

    private function checkProducts($products){

        $totalProduct = count($products);
        $selectedProduct = $this->flattenProduct($products);

        $availProduct = DB::table('product')
            ->select(DB::raw('count(1) as count'))
            ->whereRaw('id IN ('.$selectedProduct.')')
            ->get();

        return $availProduct[0]->count === $totalProduct ? true : false;
    }



}
