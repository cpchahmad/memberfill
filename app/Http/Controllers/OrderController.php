<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_line_Item;
use App\Models\Preference;
use App\Models\Product;
use App\Models\Product_Varient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
Use \Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function sync_orders(){


        $shop = Auth::user();
        $orders = $shop->api()->rest('GET', '/admin/api/2021-01/orders.json');
        $orders_data = json_decode(json_encode($orders['body']['container']['orders']));
        $preferences = Preference::where('shop_id',Auth::user()->id)->first();
        $location = $shop->api()->rest('GET', '/admin/locations.json');
        $location = json_decode(json_encode($location));

        foreach ($orders_data as $order_key) {
            $this->createShopifyOrders($order_key, $shop,$location,$preferences);
        }

        return back()->with('success', 'Orders Sync Successfully.');
    }

    public function createShopifyOrders($order_key, $shop,$location,$preferences)
    {
        if (Order::where('shopify_order_id',  $order_key->id)->exists()) {
            $order = Order::where('shopify_order_id', $order_key->id)->first();
        } else {
            $order = new Order();
        }
        $order->shopify_order_id = $order_key->id;
        $order->order_number = $order_key->order_number;
        $order->shop_id = Auth::id();
        $order->note = $order_key->note;
        $order->date = $order_key->created_at;
        if(isset($order_key->customer)) {
            $order->first_name = $order_key->customer->first_name;
            $order->last_name = $order_key->customer->last_name;
            $order->customer_phone = $order_key->customer->phone;
        }
        $order->currency = $order_key->currency;
        $order->total_price = $order_key->total_price;
        $order->total_discount = $order_key->total_discounts;
        if (isset($order_key->shipping_lines[0])){
            $order->total_shipping = $order_key->shipping_lines[0]->price;
        }
        $order->sub_total = $order_key->subtotal_price;

        $order->financial_status = $order_key->financial_status;
        $order->fulfillment_status = $order_key->fulfillment_status;
        $order->save();

        foreach ($order_key->line_items as $item) {

            $line_item = Order_line_Item::where('shopify_order_id', $item->id)->first();
            if ($line_item == null) {
                $line_item = new Order_line_Item();
            }
            $line_item->order_id = $order->id;
            $line_item->shopify_order_id = $item->id;
            $line_item->shopify_product_id = $item->product_id;
            $line_item->sku = $item->sku;
            $line_item->title = $item->title;
            $line_item->price = $item->price;
            $line_item->quantity = $item->quantity;
            $line_item->shopify_variant_id = $item->variant_id;
            $line_item->item_src = (!empty($item->image))?$item->image:'';
            $line_item->store_created_at = Carbon::parse($order_key->created_at)->toDateString();
            $line_item->save();

            $varient_qtn = Order_line_Item::where('shopify_variant_id', $item->variant_id)->sum('quantity');

            $varient = Product_Varient::where('shopify_variant_id', $item->variant_id)->first();
            if (isset($varient)) {
                $varient->sold_quantity += $varient_qtn;
                $varient->updated_at = Carbon::now();
                $varient->save();
            }

            if ($varient_qtn == $preferences->global_limit){
                $shop->api()->rest('POST', '/admin/inventory_levels/set.json', [
                    "location_id" => $location->body->locations[0]->id,
                    "inventory_item_id"=> $varient->inventory_item_id,
                    "available"=> 0
                ]);
            }
        }

    }

    public function orders_index(){

            $orders = Order::with('line_items')->get()->sortByDesc('order_number');

        return view('users.orders.index')->with([
            'page_title' => 'Orders',
            'orders' => $orders,
        ]);
    }
}

