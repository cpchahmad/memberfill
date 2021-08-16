@extends('layouts.index')
@section('content')

    <style>
        .items{
            padding-top: 4%;
        }
        .product:after {
            content: "\f107";
            font-family: 'Font Awesome 5 Free';
            font-size: 30px;
            font-weight: 900;
            float: left;
            margin-top: 3%;
        }

        .product.collapsed:after {
            content: "\f106";

        }
        .divider{
            margin: 20px 0px;
        }
        .item{
            margin-top: 1%;
        }
        .title{
            padding-left: 5%;
        }
        .limit{
            margin-left: 12%;
        }
    </style>
        <div class="row ">
            <div class="col-md-6 ">
                <h3>Groups</h3>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{route('create/group')}}"><button type="button" class="btn btn-primary float-right">Add Group</button></a>
            </div>
        </div>

    <div class="col-lg-12 col-md-12 p-4 bg-white">

        <div class="d-flex justify-content-between">
            <div class="col-md-3 title"><h6>Title</h6></div>
            <div class="col-md-2 limit"><h6>Limit</h6></div>
            <div class="col-md-2"><h6>Products</h6></div>
            <div class="col-md-2"><h6>Action</h6></div>
            <div class="col-md-3 text-center"><h6>Graph</h6></div>

        </div>
        @if (count($groups) > 0)
            @foreach($groups as $index => $group)

                <div id="group-{{$group->id}}">
                    <div class="card">
                        <div class="card-header bg-white" id="headingOne">
                            <a href="#" id="group-{{$group->id}}" class="product items"  data-toggle="collapse" data-target="#{{$group->id}}"
                               aria-expanded="true" aria-controls="collapseOne"></a>
                            <div class="d-flex justify-content-between">
                                <div class="col-md-3 items">
                                    <a href="#">
                                        <div class="col-md-3 " data-toggle="collapse" data-target="#{{$group->id}}" aria-expanded="true"
                                             aria-controls="collapseOne">{{$group->name}}</div>
                                    </a></div>

                                <div class="col-md-2 items ">
                                    <div>{{$group->limit}}</div>
                                </div>

                                <div class="col-md-2  items">
                                    <div>{{count($group->group_details)}}</div>
                                </div>
                                <div class="col-md-2  items">
                                    <a href="{{route('group-delete',($group->id))}}" class="btn btn-sm btn-danger" type="button"> Delete</a>
                                </div>

                                <div class="col-md-3">
                                    <canvas height="200" class="canvas-graph-one" data-labels={{json_encode($graph_labels[$index])}} data-values={{json_encode($graph_values[$index])}}></canvas>
                                </div>

                            </div>
                        </div>
                        <div id="{{$group->id}}" class="collapse" aria-labelledby="headingOne"
                             data-parent="#group-{{$group->id}}">
                            <div class="card-body bg-secondary">
                                @foreach($group->group_details as $group_detail)
                                    <div class="d-flex justify-content-between">
                                        <div class="flex-row item">
                                            @if(isset($group_detail->has_varients->varient_images->src))
                                                <img class="image"
                                                     src="{{$group_detail->has_varients->varient_images->src}}"
                                                     width="70px"
                                                     height="auto">
                                            @else
                                                <img class="image"
                                                     src="{{asset('assets/main.png')}}"
                                                     width="70px"
                                                     height="auto">
                                            @endif
                                        </div>

                                        <div class="flex-row item">{{$group_detail->has_varients->title}}</div>

                                        <div
                                            class="flex-row item">{{$group_detail->has_varients->inventory_quantity}}
                                            In Stock
                                        </div>

                                        <div class="flex-row item">

                                            <div>{{$group_detail->has_varients->sku}}</div>

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
                    <p>No Groups Found</p>
            @endif
            <!-- end row -->
                <div class="pagination">
                    {{ $groups->links("pagination::bootstrap-4") }}
                </div>
    </div>


@endsection
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>
    $(document).ready(function () {
        if ($('body').find('.canvas-graph-one').length > 0) {

            $('.canvas-graph-one').each(function (index,value) {
                console.log($(value).attr('data-values'))

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

