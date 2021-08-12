<?php

namespace App\Http\Controllers;

use App\Models\Preference;
use App\Models\Product;
use App\Models\Product_Image;
use App\Models\Product_Varient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function sync_products()
    {
        $preference = Preference::get();
        if ($preference == null){
            return redirect(users.preferences.preference)->with('error','Firstly Enter Your Preference Here');
        }
        $shop = Auth::user();
        $products = $shop->api()->rest('get', '/admin/api/2021-01/products.json');
        $products_data = json_decode(json_encode($products['body']['container']['products']));
//        dd($products_data[0]);

        foreach ($products_data as $product) {
            $this->createShopifyproducts($product,$shop);
        }

        return back();
    }

    public function createShopifyproducts($product, $shop)
    {
        if (Product::where('shopify_product_id',  $product->id)->exists()) {
            $product_add = Product::where('shopify_product_id', $product->id)->first();
        } else {
            $product_add = new Product();
        }
        if ($product->images) {
            $image = $product->images[0]->src;
        } else {
            $image = '';
        }
        $product_add->shopify_product_id = $product->id;
        $product_add->title = $product->title;
        $product_add->description = $product->body_html;
        $product_add->handle = $product->handle;
        $product_add->vendor = $product->vendor;
        $product_add->type = $product->product_type;
        $product_add->featured_image = $image;
        $product_add->tags = $product->tags;
        $product_add->options = json_encode($product->options);
        $product_add->shop_id = $shop->id;
        $product_add->published_at = $product->published_at;
        $product_add->status = $product->status;
        $product_add->save();
        foreach ($product->images as $image){
            $product_image = new Product_Image();
            $product_image->product_id = $product_add->id;
            $product_image->images = $image->id;
            $product_image->src = $image->src;
            $product_image->save();
        }
        $variant_ids = [];
        if (count($product->variants) >= 1) {
            foreach ($product->variants as $variant) {
                array_push($variant_ids, $variant->id);
                if (Product_Varient::where('shopify_variant_id',  $variant->id)->exists()) {
                    $variant_add = Product_Varient::where('shopify_variant_id', $variant->id)->first();
                } else {
                    $variant_add = new Product_Varient();
                }
                $variant_add->shopify_variant_id = $variant->id;
                $variant_add->title = $variant->title;
                $variant_add->option1 = $variant->option1;
                $variant_add->option2 = $variant->option2;
                $variant_add->option3 = $variant->option3;
                $variant_add->sku = $variant->sku;
                $variant_add->requires_shipping = $variant->requires_shipping;
                $variant_add->fulfillment_service = $variant->fulfillment_service;
                $variant_add->taxable = $variant->taxable;
                $variant_add->image = $variant->image_id;
                $variant_add->price = $variant->price;
                $variant_add->compare_at_price = $variant->compare_at_price;
                $variant_add->weight = $variant->weight;
                $variant_add->weight_unit = $variant->weight_unit;
                $variant_add->grams = $variant->grams;
                $variant_add->inventory_item_id = $variant->inventory_item_id;
                $variant_add->inventory_quantity = $variant->inventory_quantity;
                $variant_add->inventory_management = $variant->inventory_management;
                $variant_add->inventory_policy = $variant->inventory_policy;
                $variant_add->barcode = $variant->barcode;
                $variant_add->shopify_product_id = $product->id;
                $variant_add->product_id = $product_add->id;
                $variant_add->shop_id = $shop->id;
                $variant_add->save();
            }
        }
//        Product_Varient::where('shopify_product_id', $product->id)->whereNotIn('variant_id', $variant_ids)->delete();

    }

    public function products_index()
    {
        $products = Product::where('shop_id',Auth::id())->with('Product_Varients')->paginate(50);
        return view('users.products.index')->with([
            'products' => $products,
            'page_title' => 'products'
        ]);
    }
    public function create_limit(Request  $request ,$id){

        $product = Product::findorfail($id);
        if ($product->limit == null) {
            $product->limit = $request->limit;
            $product->save();
        }else{
            $product->limit = $product->limit + $request->limit;
            $product->save();
        }
        return back();
    }

}
