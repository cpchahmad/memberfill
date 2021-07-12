@extends('layouts.index')
@section('content')
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
                        <div class="row mb-3 form-group">
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

                        @foreach($products as $product)
                            <ul class="form-group">
                                <!--List Step-2 -->
                                <li>
                                    <input type="checkbox" class="form-check-input" name="products[]"
                                           value="{{$product->id}}" id="product-{{$product->id}}">
                                    <label class="form-check-label"
                                           for="product-{{$product->id}}">{{$product->title}}</label>
                                    @foreach($product->Product_Varients as $varient)
                                        <ul>
                                            <!--List Step-3 -->
                                            <li>
                                                <input type="checkbox" class="form-check-input"
                                                       name="varients_{{ $product->id }}[]" value="{{ $varient->id }}"
                                                       id="varient-{{$varient->id}}">
                                                <label class="custom-control-label"
                                                       for="varient-{{$varient->id}}">{{$varient->title}}
                                                    {{$varient->option2}}</label>
                                            </li>
                                            <!--List Step-(n)
     -->
                                        </ul>
                                    @endforeach
                                </li>
                            </ul>
                        @endforeach

                    </div>

                </div>
            </div>
        </div>
    </form>
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
