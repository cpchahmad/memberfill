<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Group_Varient;
use App\Models\Order_line_Item;
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
        $products = Product::where('shop_id',Auth::user()->id)->with('Product_Varients')->paginate(20);
        $preference = Preference::where('shop_id',Auth::user()->id)->first();
        $soldout_array = [];
        $timefilter_value = [];
        $timefilter_date = [];
        $total_product_stockIn = [];
        foreach ($products as $product) {
            $total = $product->Product_Varients->sum('sold_quantity');
            array_push($soldout_array,$total);

            if ($preference != null) {
                if ($preference->graph_interval == 'daily' && $preference->shop_id == Auth::user()->id) {

                    $data = Order_line_Item::whereDate('created_at', '>', now()->subDays(1))->where('shopify_product_id', $product->shopify_product_id)->get();

                } elseif ($preference->graph_interval == 'weekly' && $preference->shop_id == Auth::user()->id) {

                    $data = Order_line_Item::whereDate('created_at', '>', now()->subDays(7))->where('shopify_product_id', $product->shopify_product_id)->get();

                } elseif ($preference->graph_interval == 'monthly' && $preference->shop_id == Auth::user()->id) {

                    $data = Order_line_Item::whereDate('created_at', '>', now()->subDays(30))->where('shopify_product_id', $product->shopify_product_id)->get();
                } else {
                    $data = Order_line_Item::where('shopify_product_id', $product->shopify_product_id)->get();

                }
            }
            $quantity_array = [];
            $date_filter = [];
            foreach ($data as $key){
                array_push($quantity_array,$key->quantity);
                array_push($date_filter,$key->created_at->format('Y-m-d'));
            }

            array_push($timefilter_value,$quantity_array);
            array_push($timefilter_date,$date_filter);

            $product_stockIn = Product_Varient::where('product_id',$product->id)->get()->sum('inventory_quantity');
            array_push($total_product_stockIn,$product_stockIn);

        }
        $groups = Group::get();
        $graph_values = [];
        $graph_labels = [];
        $overall_groups_price = [];
        $overall_group_order_price = [];
        foreach ($groups as $group) {
            $data = DB::table('group_varients')
                ->where('group_id', $group->id)
                ->select('product_id', DB::raw('count(*) as total'),DB::raw('DATE(created_at) as date'))
                ->groupBy('product_id')
                ->get();
            $value = $data->pluck('total')->toArray();
            $label = $data->pluck('date')->toArray();
            array_push($graph_values,$value);
            array_push($graph_labels,$label);

            $group_products = $group->group_details;
            $group_products_price = 0 ;
            $group_products_order_price = 0 ;
            $order_lineitem = Order_line_Item::query();
            foreach ($group_products as $group_product){

                $group_products_price +=$group_product->has_varients->price;
                $varient_order = $order_lineitem->where('shopify_variant_id',$group_product->has_varients->shopify_variant_id)->get();
                $group_products_order_price +=$varient_order->sum('price');
            }

            array_push($overall_groups_price,$group_products_price);
            array_push($overall_group_order_price,$group_products_order_price);

        }


        return view('users.generals.general')->with([
            'page_title' => 'General',
            'products' => $products,
            'soldout_array'=>$soldout_array,
            'preference'=>$preference,
            'timefilter_value'=>$timefilter_value,
            'timefilter_date'=>$timefilter_date,
            'total_product_stockIn'=>$total_product_stockIn,
            'graph_values' => $graph_values,
            'graph_labels' => $graph_labels,
            'overall_group_order_price' => $overall_group_order_price,
            'overall_groups_price' => $overall_groups_price,

            'groups'=>$groups,

        ]);
    }

    public function product_soldout($id){
        $product_varients = Product_Varient::where('product_id',$id)->get();
        foreach ($product_varients as $product_varient){
            $product_varient->inventory_quantity = 0;
            $product_varient->save();

        }
        return back()->with('success','Sold Out Successfully');
    }
    public function varient_soldout($id){
        $product_varient = Product_Varient::where('id',$id)->first();
        $product_varient->inventory_quantity = 0 ;
        $product_varient->save();

        return back()->with('success','Sold Out Successfully');
    }

}

