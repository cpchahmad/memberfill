@extends('layouts.index')
@section('content')
    <div class="col-lg-12 col-md-12 p-4">
        <div class="row ">
            <div class="col-md-6 pl-3">
                <h3>Orders</h3>
            </div>
            <div class="col-md-6 text-end pr-3">
                <a href="{{route('sync/orders')}}">
                    <button type="button" class="btn btn-primary float-right" >Sync Orders
                    </button>
                </a>
            </div>
        </div>

        <!-- start row -->
        <div class="row mt-3">


            <div class="col-lg-12 ">
                @if (count($orders) > 0)
                    <table class="table">
                        <thead class="border-0">
                        <tr>
                            <th>Order</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th class="text-end">Payment Status</th>
{{--                            <th class="text-end">Action</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)

                            <tr>
                                <td>
                                    <a href="#">#{{ $order->order_number }}</a>
                                    @if($order->note)
                                        <a href="#" class="show-note" title="{{$order->note}}">
                                            <i class="fa fa-sticky-note"></i></a>
                                    @endif
                                </td>

                                <td class="">{{\Illuminate\Support\Carbon::createFromTimeString($order->created_at)->format('d-m-Y')}}</td>
                                <td class="">{{ $order->first_name}} {{ $order->last_name}}</td>

                                <td class="">{{$order->currency}} {{ number_format($order->total_price, 2) }}</td>
                                <td>
                                    <div class="badge badge-pill text-end

                                                    @switch($order->financial_status)
                                    @case('paid')
                                        badge-success
@break
                                    @case('pending')
                                        badge-warning
@break
                                    @case('rejected')
                                        badge-danger
@break
                                    @case('new')
                                        badge-info
@break
                                    @default
                                    @endswitch">{{ $order->financial_status }}</div>
                                </td>

{{--                                <td>--}}
{{--                                    <div class="text-end">--}}
{{--                                        <a href="{{route('orders.view',($order->id))}}" class="btn btn-sm btn-primary" type="button"> view</a>--}}
{{--                                    </div>--}}
{{--                                </td>--}}



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
