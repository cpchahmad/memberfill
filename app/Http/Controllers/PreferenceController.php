<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Preference;
use Illuminate\Support\Facades\Auth;

class PreferenceController extends Controller
{
    // Preference Index
    public function index(){
        return view('users.preferences.preference');
    }
    // Set Limit
    public function create_limit(Request $request){
        $shop = Auth::user();
        $preference_data =  Preference::where('shop_id',$shop->id)->first();
        if ($preference_data != null && $preference_data->global_limit != null){
            $this->validate($request,[
                'graph_interval'=>'Required',
            ]);
        }else{
            $this->validate($request,[
                'global_limit'=>'Required',
                'graph_interval'=>'Required',
            ]);
        }
        if($preference_data == null)
        {
        $preference = new Preference();
        $preference->global_limit = $request->global_limit;
        $preference->graph_interval = $request->graph_interval;
        $preference->shop_id = $shop->id;
        $preference->enable_status = $request->enable_status;
        $preference->save();
        return redirect('generals');
        }else{
            $preference_data->global_limit = $preference_data->global_limit;
            $preference_data->graph_interval = $request->graph_interval;
            $preference_data->shop_id = $shop->id;
            $preference_data->enable_status = $request->enable_status;
            $preference_data->save();

            return redirect('generals');
        }
    }
}
