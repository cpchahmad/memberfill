<?php

namespace App\Http\Controllers;

use App\Models\Preference;
use App\Models\Product;
use App\Models\Product_Varient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GeneralController extends Controller
{
    public function index()
    {
        $products = Product::with('Product_Varients')->paginate(20);
        $preference = Preference::where('shop_id',Auth::user()->id)->first();
        $soldout_array = [];
        $total_after_timefilter = [];
        foreach ($products as $product) {
            $total_soldout = 0;
            foreach ($product->Product_Varients as $varient) {
                $total_soldout += $varient->sold_quantity;
            }
            $total = ($total_soldout);
            array_push($soldout_array,$total);

            if ($preference->graph_interval == 'daily' && $preference->shop_id == Auth::user()->id){
                $data = Product_Varient::where('created_at',"=","2021-07-08 08:32:27")
                    ->where('product_id',"=","62")->get();
                $total_count = 0 ;
                foreach ($data as $quantity)
                    $total_count += $quantity->sold_quantity;
            }
            array_push($total_after_timefilter,$total_count);

        }

        return view('users.generals.general')->with([
            'page_title' => 'General',
            'products' => $products,
            'soldout_array'=>$soldout_array,
            'preference'=>$preference,
            'total_after_timefilter'=>$total_after_timefilter,


        ]);
    }
}
//$ordersQ = Order::query()
//    ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total, sum(total_price) as total_sum'))
//    ->groupBy('date')
//    ->newQuery();
//
//$ordersQ->get();
//
//$graph_one_order_dates = $ordersQ->pluck('date')->toArray();
//$graph_one_order_values = $ordersQ->pluck('total')->toArray();
//$graph_two_order_values = $ordersQ->pluck('total_sum')->toArray();

//        if ($preference->graph_interval == 'daily' && $preference->shop_id == Auth::user()->id{
////            $data = DB::raw('SELECT * FROM `product_varients` WHERE created_at>= NOW() - INTERVAL 1 DAY')->get();
//            $data = Product_Varient::where('created_at',"=","2021-07-08 08:32:27")
//                ->where('product_id',"=","62")->get();
//            dd($data);
//        }
