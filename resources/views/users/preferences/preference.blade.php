@extends('layouts.index')
@section('content')
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
  float:right;
}

.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>

    <div class="col-lg-12 col-md-12 p-4">
        <div class="row ">
            <div class="col-md-6 pl-3">
                <h3>Enable Product SoldOut Limit</h3>
            </div>
            <div class="col-md-6 pr-3">

                </div>
                </div>
        <!-- start row -->
        <form action="{{url('create/limit')}}" method='post'>
            @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-white pb-1">
                        <div class="row">
                            <div class="col-md-6" style="font-weight:600">SoldOut Quantity</div>
                            <div class="col-md-6">
                                <label class="switch">
                                    <input type="checkbox" name="enable_status" value="1">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                            <div class="form-group">
                                <label for="#">Enter  Limit</label>
                                <input placeholder="Enter limit" name="global_limit" type="number"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="#">Graph Interval</label>
                                <select class="form-control" name="graph_interval">
                                    <option selected>--Select--</option>
                                    <option value="daily">Daily</option>
                                    <option value="weekly">Weekly</option>
                                    <option value="monthly">Monthly</option>

                                </select>

                            </div>
                            <input  name="shop_id" type="hidden"  value='{{Auth::user()->id}}'>

                            <div class="form-group float-right">
                                <input type="submit" class="btn btn-primary " value="Save">
                            </div>

                    </div>
                </div>

            </div>
        </div>
        </form>
    <!-- end row -->
    </div>

@endsection

