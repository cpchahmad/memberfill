@extends('layouts.index')
@section('content')
    <div class="col-lg-12 col-md-12 p-4">
        <div class="row ">
            <div class="col-md-6 pl-3">
                <h3>Products</h3>
            </div>
            <div class="col-md-6 text-end pr-3">
                <a href="{{route('sync/products')}}">
                    <button type="button" class="btn btn-primary float-right" >Sync Products
                    </button>
                </a>
            </div>
        </div>

        <!-- start row -->
        <div class="row mt-3">


            <div class="col-lg-12 ">
                @if (count($products) > 0)
                    <table class="table">
                        <thead class="border-0">
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Title</th>
                            <th scope="col">TYPE</th>
                            <th scope="col">VENDOR</th>
                            <th scope="col">PRICE</th>
                            <th scope="col">VARIENTS</th>
                            <th scope="col">Limit</th>
                            <th scope="col"></th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <th>
                                    <img src="{{$product->featured_image}}" style="max-width: 100px;height: auto;">
                                </th>
                                <td style="width: 30%"><a class="custom-a" href="#">{{$product->title}}</a>
                                </td>
                                <td>
                                    {{ucfirst($product->type)}}
                                </td>
                                <td>
                                    {{ucfirst($product->vendor)}}
                                </td>
                                <td>
{{--                                    @if(count($product->varients)>0)--}}
{{--                                        USD {{number_format($product->varients[0]->price,2)}}--}}
{{--                                    @else--}}
{{--                                        No Varients--}}
{{--                                    @endif--}}
                                </td>
                                <td>
{{--                                    {{count($product->varients)}}--}}
                                </td>
                                <td>
                                    @if($product->limit)
                                   <div class="badge badge-pill" style="background-color: greenyellow!important;">
                                    {{$product->limit}}</div>
                                    @endif
                                </td>
                                <td>
                                    <div class="text-end">
                                        <a href="#">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addlimit_{{ $product->id }}" style="margin-top: 3px; float: right">Add Limit
                                            </button>
                                        </a>
                                    </div>
                                    <div class="modal fade" id="addlimit_{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{route('create/limit',$product->id)}}" method="post">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Add Limit</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Enter limit:</label>
                                                            <input type="number" name="limit" class="form-control required  @error('limit') is-invalid @enderror" id="recipient-name">
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="save" class="btn btn-primary">Save</button>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No Products Found</p>
                @endif
            </div>

        </div>
        <!-- end row -->

    </div>

@endsection
