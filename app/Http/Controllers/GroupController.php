<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Group_Varient;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\New_;
use Spatie\Permission\Models\Role;

class GroupController extends Controller
{
    public function group_index(){
        $groups = Group::all();
        return view('users.groups.index')->with([
            'groups' => $groups,
            'page_title' => 'groups'
        ]);
    }
    public function create_index(){
        $products = Product::with('Product_Varients')->get();
        return view('users.groups.create')->with([
            'products' => $products,
            'page_title' => 'group create'
        ]);
    }
    public function store(Request $request){
//        dd($request->all());
        $group = New Group();
        $group->name = $request->name;
        $group->limit = $request->limit;
        $group->shop_id = Auth::user()->id;
        $group->save();
        foreach( $request->products as $key => $product ) {

            $varients = "varients_".$product;
            foreach ($request->$varients as  $varient){
                $group_varient = new Group_Varient();
                $group_varient->group_id = $group->id;
                $group_varient->product_id = $product;
                $group_varient->varient_id = $varient;
                $group_varient->save();
            }

        }

        return back();

    }
}
