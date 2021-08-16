@extends('layouts.index')
@section('content')
    <style>
        .w-5 {
            display: none;
        }

        .form-check {
            padding-top: 2%;
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

        .product:after {
            content: "\f107";
            font-family: 'Font Awesome 5 Free';
            font-size: 30px;
            font-weight: 900;
            float: left;
        }

        .product.collapsed:after {
            content: "\f106";

        }

    </style>

    <form action="{{route('create/group')}}" method="post">
        @csrf
        <div class="row ">
            <div class="col-md-6 ">
                <div class="">
                    <h3>Group</h3>
                </div>
            </div>
            <div class="col-md-6 text-end">
                <button type="submit" class="btn btn-primary float-right">Save</button>
            </div>
        </div>

        <div class="row mt-3">

            <div class="col-lg-12 ">
                <div class="card">
                    <div class="card-header bg-white pb-1">
                        <h5 class="card-title">Create Group</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3 form-group pl-4 pr-4">
                            <div class="col-md-6">
                                <label class="">Group Name:</label>
                                <input type="text" class="form-control required  @error('name') is-invalid @enderror"
                                       name="name"/>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="limit">Group Limit:</label>
                                <input type="number" class="form-control required  @error('limit') is-invalid @enderror"
                                       name="limit"/>
                            </div>
                        </div>

                        {{--                                                @foreach($products as $product)--}}
                        {{--                                                    <ul class="form-group">--}}
                        {{--                                                        <!--List Step-2 -->--}}
                        {{--                                                        <li>--}}
                        {{--                                                            <input type="checkbox" class="form-check-input" name="products[]" value="{{$product->id}}" id="product-{{$product->id}}">--}}
                        {{--                                                            <label class="form-check-label" for="product-{{$product->id}}">{{$product->title}}</label>--}}

                        {{--                                                            @foreach($product->Product_Varients as $varient)--}}
                        {{--                                                                <ul>--}}
                        {{--                                                                    <!--List Step-3 -->--}}
                        {{--                                                                    <li>--}}
                        {{--                                                                        <input type="checkbox" class="form-check-input" name="varients_{{ $product->id }}[]" value="{{ $varient->id }}" id="varient-{{$varient->id}}">--}}
                        {{--                                                                        <label class="custom-control-label" for="varient-{{$varient->id}}">{{$varient->title}}{{$varient->option2}}</label>--}}
                        {{--                                                                    </li>--}}
                        {{--                                                                    <!--List Step-(n)--}}
                        {{--                             -->--}}
                        {{--                                                                </ul>--}}
                        {{--                                                            @endforeach--}}
                        {{--                                                        </li>--}}
                        {{--                                                    </ul>--}}
                        {{--                                                @endforeach--}}

                        {{--                                            </div>--}}

                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </form>--}}


                        <div class="col-lg-12 col-md-12 p-4 bg-white">

                            <div class="d-flex justify-content-between">
                                <div class="col-md-3 text-center"><h6>Image</h6></div>
                                <div class="col-md-3"><h6>Title</h6></div>
                                <div class="col-md-3"><h6>Vendor</h6></div>
                                <div class="col-md-3"><h6>Status</h6></div>

                            </div>
                            @if (count($products) > 0)
                                @foreach($products as $index => $product )
                                    <div id="product-{{$product->id}}">
                                        <div class="card">
                                            <div class="card-header bg-white" id="headingOne">
                                                <div class="d-flex justify-content-between">
                                                    <a href="#" id="product-{{$product->id}}" class="product items"  data-toggle="collapse" data-target="#{{$product->id}}"
                                                       aria-expanded="true" aria-controls="collapseOne"></a>
                                                    <div class="col-md-3 form-check">

                                                        <input class="product-items" name="products[]" value="{{$product->id}}" data-toggle="collapse" data-target="#{{$product->id}}" aria-expanded="true" aria-controls="collapseOne" type="checkbox" id="product-{{$product->id}}">
                                                        {{--                                <label class="form-check-label " for="product-{{$product->id}}">--}}

                                                        {{--                                </label>--}}
                                                        @if(isset($product->featured_image))
                                                            <img class="image" src="{{$product->featured_image}}"
                                                                 width="100px"
                                                                 height="auto">
                                                        @else
                                                            <img class="image" src="{{asset('assets/main.png')}}"
                                                                 width="100px"
                                                                 height="auto">
                                                        @endif
                                                    </div>


                                                    <div class="col-md-3 items">
                                                        <a href="#">
                                                            <div class="flex-row min-content" data-toggle="collapse"
                                                                 data-target="#{{$product->id}}"
                                                                 aria-expanded="true"
                                                                 aria-controls="collapseOne">{{$product->title}}</div>
                                                        </a></div>

                                                    <div class="col-md-3 items">
                                                        <div>{{$product->vendor}}</div>
                                                    </div>

                                                    <div class="col-md-3  items">
                                                        <div>{{$product->status}}</div>
                                                    </div>


                                                </div>
                                            </div>
                                            <div id="{{$product->id}}" class="collapse" aria-labelledby="headingOne"
                                                 data-parent="#product-{{$product->id}}">
                                                <div class="card-body bg-secondary">
                                                    @foreach($product->Product_Varients as $varient)
                                                        <div class="d-flex justify-content-between">
                                                            <div class="flex-row form-check">
                                                                <input class="varient" type="checkbox"
                                                                       name="varients_{{ $product->id }}[]"
                                                                       value="{{ $varient->id }}"
                                                                       id="varient-{{$varient->id}}">
                                                                {{--                                <label class="form-check-label " for="varient-{{$varient->id}}">--}}
                                                                @if(isset($varient->varient_images->src))
                                                                    <img class="image"
                                                                         src="{{$varient->varient_images->src}}"
                                                                         width="70px"
                                                                         height="auto">
                                                                @else
                                                                    <img class="image"
                                                                         src="{{asset('assets/main.png')}}"
                                                                         width="70px"
                                                                         height="auto">
                                                                @endif
                                                                {{--                                </label>--}}
                                                            </div>

                                                            <div class="flex-row item">{{$varient->title}}</div>

                                                            <div
                                                                class="flex-row item">{{$varient->inventory_quantity}}
                                                                In Stock
                                                            </div>

                                                            <div class="flex-row">

                                                                   <div>{{$varient->sku}}</div>

                                                            </div>

                                                        </div>
                                                        <hr class="divider">

                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>

                                    </div>

        @endforeach
    </form>

    @else
        <p>No Products Found</p>
    @endif
    <!-- end row -->
    <div class="pagination">
        {{ $products->links("pagination::bootstrap-4") }}
    </div>
    </div>

@endsection

<script src=" https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).on('change', 'input[type="checkbox"]', function (e) {
        var checked = $(this).prop("checked");
        var container = $(this).parent();
        var siblings = container.siblings();

        container.find('input[type="checkbox"]').prop({
            indeterminate: false,
            checked: checked
        });

        function checkSiblings(el) {

            var parent = el.parent().parent();
            var all = true;

            el.siblings().each(function () {
                return all = ($(this).children('input[type="checkbox"]').prop("checked") === checked);
            });

            if (all && checked) {

                parent.children('input[type="checkbox"]').prop({
                    indeterminate: false,
                    checked: checked
                });

                checkSiblings(parent);

            } else if (all && !checked) {

                parent.children('input[type="checkbox"]').prop("checked", checked);
                parent.children('input[type="checkbox"]').prop("indeterminate", (parent.find('input[type="checkbox"]:checked').length > 0));
                checkSiblings(parent);

            } else {

                el.parents("li").children('input[type="checkbox"]').prop({
                    indeterminate: true,
                    checked: false
                });

            }

        }

        checkSiblings(container);
    });

</script>
