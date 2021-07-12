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

            $total = $product->Product_Varients->sum('sold_quantity');

            array_push($soldout_array,$total);

            if ($preference->graph_interval == 'daily' && $preference->shop_id == Auth::user()->id){

                $data = Product_Varient::whereDate( 'updated_at', '>', now()->subDays(1))->where('product_id',$product->id)->get()->sum('sold_quantity');

            }elseif ($preference->graph_interval == 'weekly' && $preference->shop_id == Auth::user()->id){

                $data = Product_Varient::whereDate( 'updated_at', '>', now()->subDays(7))->where('product_id',$product->id)->get()->sum('sold_quantity');

            }elseif ($preference->graph_interval == 'monthly' && $preference->shop_id == Auth::user()->id){

                $data = Product_Varient::whereDate( 'updated_at', '>', now()->subDays(30))->where('product_id',$product->id)->get()->sum('sold_quantity');
            }else{
                $data = Product_Varient::where('product_id',"=","62")->get()->sum('sold_quantity');

            }
            array_push($total_after_timefilter,$data);

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

