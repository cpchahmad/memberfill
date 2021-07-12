<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Preference;
use Illuminate\Support\Facades\Auth;

class PreferenceController extends Controller
{
    public function index(){
        return view('users.preferences.preference');
    }
    public function create_limit(Request $request){
        $setting = Preference::where('shop_id',$request->shop_id)->first();
        if($setting == null)
        {

        $preference = new Preference();
        $preference->global_limit = $request->global_limit;
        $preference->graph_interval = $request->graph_interval;
        $preference->shop_id = $request->shop_id;
        $preference->enable_status = $request->enable_status;
        $preference->save();
        return back();
        }else{
            $setting->global_limit = $request->global_limit;
            $setting->graph_interval = $request->graph_interval;
            $setting->shop_id = $request->shop_id;
            $setting->enable_status = $request->enable_status;
            $setting->save();

            return back();
        }
    }
}
