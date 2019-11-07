<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{

    /**
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProduct(Request $request)
    {

        try {

            $get_product = DB::table('product')
                ->select('id', 'name','description','price','discount','discount_type')
                ->where('status','=',1)
                ->get();

            $get_bundle = DB::table('bundle')
                ->select('id', 'name','description','product','price')
                ->where('status','=',1)
                ->get();

            return response()
                ->json(['product' => $get_product,'bundle'=>$get_bundle, 'status' => true]);


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
