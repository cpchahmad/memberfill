@extends('layouts.index')
@section('content')

    <div class="col-lg-12 col-md-12 p-4">
        <div class="row ">
            <div class="col-md-6 pl-3">
                <h3>Groups</h3>
            </div>
            <div class="col-md-6 text-end pr-3">
                <a href="{{route('create/group')}}"><button type="button" class="btn btn-primary float-right">Add Group</button></a>
            </div>
        </div>
        <!-- start row -->
        @if (count($groups) > 0)
            @foreach($groups as $group)

        <div class="accordion" id="group-{{$group->id}}">

            <div class="card">
                <div class="card-header bg-secondary" id="headingone">
                    <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#{{$group->id}}" aria-expanded="true" aria-controls="collapseOne">
                            {{$group->name}}
                        </button>
                    </h2>
                </div>

                <div id="{{$group->id}}" class="collapse" aria-labelledby="headingone" data-parent="#group-{{$group->id}}">

                        <table class="table">
                            <thead class="border-0">
                            <tr>
                                <th scope="col">Group Id</th>
                                <th scope="col">Varient Id</th>
                                <th scope="col">Limit</th>
                              <div class="text-end"><th scope="col">Product Id</th></div>

                            </tr>
                            </thead>
                            <tbody>
                                {{--                            @dd($group->group_details[0]->has_products->varients)--}}
                               @foreach($group->group_details as $group_detail)
                                <tr>

                                    <td>
                                        {{$group_detail->group_id}}
                                    </td>
                                    <td>
                                        {{$group_detail->product_id}}
                                    </td>

                                    <td>
                                        @if($group->limit)
                                            <div class="badge badge-pill" style="background-color: greenyellow!important;">
                                                {{$group->limit}}</div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="tect-end">{{$group->id}}</div>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                </div>
            </div>

        </div>
            @endforeach
        @else
            <p>No Groups Found</p>
    @endif

        <!-- end row -->
    </div>
@endsection
