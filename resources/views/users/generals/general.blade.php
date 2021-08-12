@extends('layouts.index')
@section('content')
    <style>
        .w-5 {
            display: none;
        }

        input[type="checkbox"] {
            height: 20px;
            width: 20px;
            display: inline;
            float: left;
            margin-top: 12px;
            outline: 0;
            -webkit-box-shadow: none;
            box-shadow: none;
            opacity: 1;
        }
        .form-check{
            padding-top: 3%;
        }

        .min-content {


            max-width: 100px;
        }

        .divider {
            margin: 20px 0px
        }

        .image {
            margin-left: 50px
        }

        .pagination {
            float: right;
            margin-top: 20px
        }

        .items {
            padding-top: 3%;
        }

        .item {
            margin-top: 10px;
        }

        .media-body {
            flex: 0 0 auto;
            flex-grow: 0;
            flex-shrink: 0;
            flex-basis: auto;
        }

    </style>

{{--    <style>--}}

{{--        .btn-header-link:after {--}}
{{--            content: "\f107";--}}
{{--            font-family: 'Font Awesome 5 Free';--}}
{{--            font-weight: 900;--}}
{{--            float: right;--}}
{{--        }--}}

{{--        .btn-header-link.collapsed:after {--}}
{{--            content: "\f106";--}}
{{--        }--}}

{{--    </style>--}}

    <div class="row ">
        <div class="col-md-6 ">

        </div>
        <div class="col-md-6 text-end mb-2">
            <a href="{{route('sync/products')}}"><button type="button" class="btn btn-primary float-right">Sync Products</button></a>
            <a href="{{route('sync/orders')}}"><button type="button" class="btn btn-primary mr-1 float-right">Sync Orders</button></a>
        </div>

    </div>
    <div class="col-lg-12 col-md-12 p-4 bg-white">
        <div class="row" style="margin-bottom: 3%">
            @foreach($groups as $index => $group)
                <div class="col-md-6 ">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h3>Group {{$index + 1}}</h3>
                            <div class="progress mt-1 bg-light" style="width: 42%">
                                <div class="progress-bar bg-primary" style="width:@if($overall_groups_price[$index] != 0){{($overall_group_order_price[$index] / $overall_groups_price[$index]) * 100}} @else 0 @endif "></div>
                            </div>
                            <div>
                                {{$overall_group_order_price[$index]}} / {{$overall_groups_price[$index]}}
                            </div>
                        </div>

                        <div class="col-md-5">
                            <canvas height="200" class="canvas-graph-group" data-labels="{{json_encode($graph_labels[$index])}}" data-values="{{json_encode($graph_values[$index])}}"></canvas>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>


        <div class="d-flex justify-content-between">
            <div class="col-md-3 text-center"><h6>Image</h6></div>
            <div class="col-md-1"><h6>Title</h6></div>
            <div class="col-md-3 text-center"><h6>Graph</h6></div>
            <div class="col-md-1"><h6>Stock In</h6></div>
            <div class="col-md-1 text-center"><h6>Sold Out</h6></div>
            <div class="col-md-2 text-center"><h6></h6></div>
        </div>

        @if (count($products) > 0)
            @foreach($products as $index => $product )
                <div id="product-{{$product->id}}">
                    <div class="card">
                        <div class="card-header bg-white" id="headingOne">
                            <div class="d-flex justify-content-between">
{{--                                <a href="#" id="product-{{$product->id}} class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#{{$product->id}}"--}}
{{--                                   aria-expanded="true" aria-controls="collapseOne"></a>--}}
                                <div class="flex-row form-check">
                                    <input class="product" data-toggle="collapse" data-target="#{{$product->id}}"
                                           aria-expanded="true" aria-controls="collapseOne" type="checkbox"
                                           id="product-{{$product->id}}">
                                    {{--                                <label class="form-check-label " for="product-{{$product->id}}">--}}

                                    {{--                                </label>--}}
                                    @if(isset($product->featured_image))
                                        <img class="image" src="{{$product->featured_image}}" width="100px"
                                             height="auto">
                                    @else
                                        <img class="image" src="{{asset('assets/main.png')}}" width="100px"
                                             height="auto">
                                    @endif
                                </div>


                                <div class="items">
                                    <a href="#">
                                        <div class="flex-row min-content for_varient" data-toggle="collapse" data-target="#{{$product->id}}" aria-expanded="true" aria-controls="collapseOne">{{$product->title}}</div>
                                    </a></div>

                                    <div class="flex-row">
                                        <canvas height="200" class="canvas-graph-one" data-labels="{{json_encode($timefilter_date[$index])}}" data-values="{{json_encode($timefilter_value[$index])}}"></canvas>
                                    </div>


                                <div class="flex-row items">{{$total_product_stockIn[$index]}}</div>


                               <div class="items">
                                   <div class="media-body text-black">
                                       <div class="progress mt-2 bg-light" style="width: 115px;">
                                           <div class="progress-bar  bg-primary" style="width: {{($soldout_array[$index]) / ($preference->global_limit) * 100}}%;"></div>

                                       </div>

                                       <span>{{$soldout_array[$index]}} / {{$product->product_varients * $preference->global_limit}}</span>
                                   </div>
                               </div>
                                <div class="flex-row items">
                                    <a href="{{route('product-soldout',$product->id)}}">
                                        <button type="button" class="btn btn-primary item">Put Sold Out</button>
                                    </a>
                                </div>

                            </div>
                        </div>
                        <div id="{{$product->id}}" class="collapse" aria-labelledby="headingOne"
                             data-parent="#product-{{$product->id}}">
                            <div class="card-body bg-secondary">
                                @foreach($product->Product_Varients as $index => $varient)
{{--                                    @dd(json_encode($product->varient_graph_value))--}}

                                    <div class="d-flex justify-content-between">
                                        <div class="flex-row">
                                            <input class="varient" type="checkbox" id="varient-{{$varient->id}}">
                                            {{--                                <label class="form-check-label " for="varient-{{$varient->id}}">--}}
                                            @if(isset($varient->varient_images->src))
                                                <img class="image" src="{{$varient->varient_images->src}}" width="70px"
                                                     height="auto">
                                            @else
                                                <img class="image" src="{{asset('assets/main.png')}}" width="70px"
                                                     height="auto">
                                            @endif
                                            {{--                                </label>--}}
                                        </div>

                                        <div class="flex-row item">{{$varient->title}}</div>
                                        <div class="flex-row variant_chart">
                                            <canvas height="100" class="canvas-graph-two" data-labels="{{json_encode($product->varient_graph_date[$index])}}" data-values="{{json_encode($product->varient_graph_value[$index])}}"></canvas></div>
                                        <div class="flex-row item">{{$varient->inventory_quantity}} In Stock</div>
                                        @if($varient->sold_quantity)
                                            <div class="flex-row item">{{$varient->sold_quantity}} / {{$preference->global_limit}}</div>
                                        @else
                                            <div class="flex-row item">0 Sold out</div>
                                        @endif

                                        <div class="flex-row">
                                            <a href="{{route('varient-soldout',$varient->id)}}">
                                                <button type="button" class="btn btn-primary item">Put Sold Out</button>
                                            </a>

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
            {{ $products->links("pagination::bootstrap-4") }}
        </div>
    </div>

{{--    <div id="main">--}}
{{--        <div class="container">--}}
{{--            <div class="accordion" id="faq">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header" id="faqhead1">--}}
{{--                        <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq1"--}}
{{--                           aria-expanded="true" aria-controls="faq1">S.S.23</a>--}}
{{--                    </div>--}}

{{--                    <div id="faq1" class="collapse show" aria-labelledby="faqhead1" data-parent="#faq">--}}
{{--                        <div class="card-body">--}}
{{--                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf--}}
{{--                            moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.--}}
{{--                            Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda--}}
{{--                            shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea--}}
{{--                            proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim--}}
{{--                            aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header" id="faqhead2">--}}
{{--                        <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq2"--}}
{{--                           aria-expanded="true" aria-controls="faq2">S.S.S</a>--}}
{{--                    </div>--}}

{{--                    <div id="faq2" class="collapse" aria-labelledby="faqhead2" data-parent="#faq">--}}
{{--                        <div class="card-body">--}}
{{--                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf--}}
{{--                            moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.--}}
{{--                            Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda--}}
{{--                            shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea--}}
{{--                            proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim--}}
{{--                            aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header" id="faqhead3">--}}
{{--                        <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq3"--}}
{{--                           aria-expanded="true" aria-controls="faq3">S.S.S</a>--}}
{{--                    </div>--}}

{{--                    <div id="faq3" class="collapse" aria-labelledby="faqhead3" data-parent="#faq">--}}
{{--                        <div class="card-body">--}}
{{--                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf--}}
{{--                            moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.--}}
{{--                            Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda--}}
{{--                            shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea--}}
{{--                            proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim--}}
{{--                            aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">--}}
{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">--}}
{{--    <style>--}}

{{--        #main #faq .card .card-header .btn-header-link:after {--}}
{{--            content: "\f107";--}}
{{--            font-family: 'Font Awesome 5 Free';--}}
{{--            font-weight: 900;--}}
{{--            float: right;--}}
{{--        }--}}

{{--        #main #faq .card .card-header .btn-header-link.collapsed:after {--}}
{{--            content: "\f106";--}}
{{--        }--}}

{{--    </style>--}}
@endsection
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>
    $(document).ready(function () {
        if ($('body').find('.canvas-graph-one').length > 0) {

            $('.canvas-graph-one').each(function (index,value) {

                var config = {
                    type: 'line',
                    data: {
                        labels: JSON.parse($(value).attr('data-labels')),
                        datasets: [{
                            label: 'Orders Sales',
                            backgroundColor: '#5c80d1',
                            borderColor: '#5c80d1',
                            data: JSON.parse($(value).attr('data-values')),
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
                var ctx_2 = value.getContext('2d');
                window.myLine = new Chart(ctx_2, config);
            });

        }
    });
</script>

<script>
    $(document).ready(function () {
        if ($('body').find('.canvas-graph-group').length > 0) {
            $('.canvas-graph-group').each(function (index,value) {

                var config = {
                    type: 'line',
                    data: {
                        labels: JSON.parse($(value).attr('data-labels')),
                        datasets: [{
                            label: 'Products',
                            backgroundColor: '#5c80d1',
                            borderColor: '#5c80d1',
                            data: JSON.parse($(value).attr('data-values')),
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
                                    labelString: 'Products'
                                }
                            }]
                        }
                    }
                };
                var ctx_2 = value.getContext('2d');
                window.myLine = new Chart(ctx_2, config);
            });

        }
    });
</script>

<script>
    $(document).ready(function () {
    // $('.for_varient').click(function () {
        if ($('.canvas-graph-two').length >= 1) {

            $('.canvas-graph-two').each(function (index,value) {
                var config = {
                    type: 'line',
                    data: {
                        labels: JSON.parse($(value).attr('data-labels')),
                        datasets: [{
                            label: 'Orders Sales',
                            backgroundColor: '#5c80d1',
                            borderColor: '#5c80d1',
                            data: JSON.parse($(value).attr('data-values')),
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
                var ctx_2 = value.getContext('2d');
                window.myLine = new Chart(ctx_2, config);
            });

        }
    });
</script>
