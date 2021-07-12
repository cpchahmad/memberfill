@extends('layouts.index')
@section('content')
    <style>
        .w-5{
            display: none;
        }
        input[type="checkbox"] {
            height: 20px;
            width: 20px;
            display: inline;
            float: left;
            margin-top: 25px;
            outline: 0;
            -webkit-box-shadow: none;
            box-shadow: none;
            opacity: 1;
        }

        .min-content {
            width: 200px;
            margin-top: 16px;
        }
        .divider{
            margin: 20px 0px
        }
        .image{
            margin-left: 50px
        }
        .pagination{
            margin-top: 20px
        }
        .items{
            margin-top: 16px;
        }
        .item{
            margin-top: 10px;
        }
        .media-body{
            flex: 0 0 auto;
            flex-grow: 0;
            flex-shrink: 0;
            flex-basis: auto;
        }

    </style>
    <div class="col-lg-12 col-md-12 p-4 bg-white">
        <div class="row" style="display: none">
            <div class="col-md-6 ">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h3>Group 1</h3>

                        <div class="progress mt-1 bg-light" style="width: 42%">
                            <div class="progress-bar w-70 bg-success"></div>
                        </div>

                        <div>
                            Counter
                        </div>
                    </div>
                    <div class="col-md-6">
                        Graph
                    </div>
                </div>
            </div>
            <div class="col-md-6 ">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h3>Group 2</h3>
                        <div class="progress mt-1 bg-light" style="width: 42%">
                            <div class="progress-bar w-25 bg-success"></div>
                        </div>
                        <div>
                            Counter
                        </div>
                    </div>
                    <div class="col-md-6">
                        Graph
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 text-center"><h6>Image</h6></div>
            <div class="col-md-2"><h6>Title</h6></div>
            <div class="col-md-2 text-center"><h6>Graph</h6></div>
            <div class="col-md-1"><h6>Stock In</h6></div>
            <div class="col-md-2 text-center"><h6>Sold Out</h6></div>

        </div>
        @if (count($products) > 0)
            @foreach($products as $index => $product )
        <div id="product-{{$product->id}}">
            <div class="card">
                <div class="card-header bg-white" id="headingOne">
                        <div class="d-flex justify-content-between">
                            <div class="flex-row form-check">
                                <input class="product" data-toggle="collapse" data-target="#{{$product->id}}" aria-expanded="true" aria-controls="collapseOne" type="checkbox" id="product-{{$product->id}}">
{{--                                <label class="form-check-label " for="product-{{$product->id}}">--}}

{{--                                </label>--}}
                                @if(isset($product->featured_image))
                                    <img class="image"  src="{{$product->featured_image}}" width="100px"
                                         height="auto">
                                @else
                                    <img class="image"  src="{{asset('assets/main.png')}}" width="100px"
                                         height="auto">
                                @endif
                            </div>


                             <a  href="#"> <div class="flex-row min-content" data-toggle="collapse" data-target="#{{$product->id}}" aria-expanded="true" aria-controls="collapseOne">{{$product->title}}</div></a>
                            <div class="flex-row items">
                                    <canvas id="canvas-graph-two" data-labels="[234,23,324,324]" data-values="[{{$total_after_timefilter[0]}} , {{$total_after_timefilter[1]}} ]"></canvas>
                            </div>
                            <div class="flex-row items">145</div>


                    <div class="media-body p-2 text-black">
                                <div class="progress mt-2 bg-light" style="width: 115px;">
                                    <div class="progress-bar  bg-primary" style="width: {{($soldout_array[$index]) / ($preference->global_limit) * 100}}%;" ></div>

                                </div>

                        <span>{{$soldout_array[$index]}} / {{$preference->global_limit}}</span>
                    </div>
                            <div class="flex-row">
                                <button type="button" class="btn btn-primary items">Put Sold Out</button>
                            </div>

                        </div>
                </div>
                <div id="{{$product->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#product-{{$product->id}}">
                    <div class="card-body bg-secondary">
                    @foreach($product->Product_Varients as $varient)
                        <div class="d-flex justify-content-between">
                            <div class="flex-row form-check">
                                <input class="varient" type="checkbox" id="varient-{{$varient->id}}">
{{--                                <label class="form-check-label " for="varient-{{$varient->id}}">--}}
                                    @if(isset($varient->varient_images->src))
                                    <img class="image"  src="{{$varient->varient_images->src}}" width="70px"
                                         height="auto">
                                    @else
                                        <img class="image" src="{{asset('assets/main.png')}}" width="70px" height="auto">
                                    @endif
{{--                                </label>--}}
                            </div>

                                <div class="flex-row item">{{$varient->title}}</div>

                            <div class="flex-row item">Graph</div>

                            <div class="flex-row item">{{$varient->inventory_quantity}} In Stock</div>

                            @if($varient->sold_quantity)
                            <div class="flex-row item">{{$varient->sold_quantity}} / {{$preference->global_limit}}</div>
                            @else
                                <div class="flex-row item">0 Sold out</div>
                            @endif

                            <div class="flex-row">
                                <button type="button" class="btn btn-primary item">Put Sold Out</button>
                            </div>

                        </div>
                            <hr class="divider">
                        @endforeach

                    </div>
                </div>
            </div>

        </div>

            @endforeach


        @else
            <p>No Products Found</p>
    @endif
        <!-- end row -->
        <div class="pagination">
            {{ $products->links() }}
        </div>
    </div>


@endsection
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>
    $(document).ready(function() {
        if($('body').find('#canvas-graph-two').length > 0){
            console.log('ok');
            var config = {
                type: 'line',
                data: {
                    labels: JSON.parse($('#canvas-graph-two').attr('data-labels')),
                    datasets: [{
                        // label: 'Orders Sales',
                        backgroundColor: '#5c80d1',
                        borderColor: '#5c80d1',
                        data: JSON.parse($('#canvas-graph-two').attr('data-values')),
                        fill: false,
                    }]
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        // text: 'Summary Orders Sales'
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Date'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            ticks: {
                                beginAtZero: true
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'Sales'
                            }
                        }]
                    }
                }
            };
            var ctx_2 = document.getElementById('canvas-graph-two').getContext('2d');
            window.myLine = new Chart(ctx_2, config);
        }
    });
</script>
