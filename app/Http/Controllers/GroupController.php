<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Group_Varient;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\New_;
use Spatie\Permission\Models\Role;

class GroupController extends Controller
{
    public function group_index(){
        $groups = Group::with('group_details')->paginate('10');
        $graph_values = [];
        $graph_labels = [];
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


        }

        return view('users.groups.index')->with([
            'groups' => $groups,
            'graph_values' => $graph_values,
            'graph_labels' => $graph_labels,
            'page_title' => 'groups'
        ]);
    }
    public function create_index(){
        $products = Product::with('Product_Varients')->paginate('20');
        return view('users.groups.create')->with([
            'products' => $products,
            'page_title' => 'group create'
        ]);
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'limit'=>'required'
        ]);
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
