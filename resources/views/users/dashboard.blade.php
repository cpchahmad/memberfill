@extends('users.default')
@section('content')
    <div class="col-lg-12 col-md-12 ">
        <div class="row ">
            <div class="col-md-12 pl-3 pt-2">
                <div class="pl-3">
                    <h3>Dashboard</h3>
                </div>
            </div>
        </div>

        <!-- start info box -->
        <div class="row ">
            <div class="col-md-12 pl-3 pt-2">
                <div class="row pl-3">

                    <div class="col-md-6 col-lg-3 col-12 mb-2 col-sm-6">
                        <div class="media shadow-sm p-0 bg-white rounded text-primary ">
                            <span class="oi top-0 rounded-left bg-primary text-light h-100 p-4 oi-badge fs-5"></span>
                            <div class="media-body p-2">
                                <h6 class="media-title m-0">Best Sales / Day</h6>
                                <div class="media-text">
                                    <h3>3980</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 col-12 mb-2 col-sm-6">
                        <div class="media shadow-sm p-0 bg-success-lighter text-light rounded">
                            <span class="oi top-0 rounded-left bg-white text-success h-100 p-4 oi-people fs-5"></span>
                            <div class="media-body p-2">
                                <h6 class="media-title m-0">Purchase</h6>
                                <div class="media-text">
                                    <h3>43848</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 col-12 mb-2 col-sm-6">
                        <div class="media shadow-sm p-0 bg-warning-lighter text-primary-darker rounded ">
                            <span class="oi top-0 rounded-left bg-white text-warning h-100 p-4 oi-cart fs-5"></span>
                            <div class="media-body p-2">
                                <h6 class="media-title m-0">Store Visits</h6>
                                <div class="media-text">
                                    <h3>58493</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 col-12 mb-2 col-sm-6">
                        <div class="media shadow-sm p-0 bg-info-lighter text-light rounded ">
                            <span class="oi top-0 rounded-left bg-white text-info h-100 p-4 oi-tag fs-5"></span>
                            <div class="media-body p-2">
                                <h6 class="media-title m-0">Total Products</h6>
                                <div class="media-text">
                                    <h3>23</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end info box -->

        <!-- start second boxes -->
        <div class="row pl-3 mt-4 mb-5">
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header p-0 bg-white">
                        <h6 class="border-bottom p-2"> Monthly recap</h6>
                        <div class="row pb-1">
                            <div class="col-sm-3 col-6 mb-2">
                                <div class="text-center">
                                    <div class="fs-smaller">
                                        <span class="oi oi-caret-top fs-smallest mr-1 text-success"></span>30%</div>
                                    <div class="fw-bold">$45,084.00</div>
                                    <div>Total Revenue</div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-6 mb-2">
                                <div class="text-center">
                                    <div class="fs-smaller">
                                        <span class="oi oi-caret-left fs-smallest mr-1 text-dark"></span>0%</div>
                                    <div class="fw-bold">$20,493.00</div>
                                    <div>Total Cost</div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-6 mb-2">
                                <div class="text-center">
                                    <div class="fs-smaller">
                                        <span class="oi oi-caret-top  fs-smallest mr-1 text-success"></span>45%</div>
                                    <div class="fw-bold">14,398</div>
                                    <div>Total Sales</div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-6 mb-2">
                                <div class="text-center">
                                    <div class="fs-smaller">
                                        <span class="oi oi-caret-bottom fs-smallest mr-1 text-danger"></span>3%</div>
                                    <div class="fw-bold">$24,591.00</div>
                                    <div>Total Profits</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <h6>Add to carts <small>(73%)</small></h6>
                                <div class="progress">
                                    <div style="width: 73%" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <br>
                                <h6>Completed purchase <small>(32%)</small></h6>
                                <div class="progress">
                                    <div style="width: 32%" class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <br>
                                <h6>Abandon carts <small>(68%)</small></h6>
                                <div class="progress">
                                    <div style="width: 68%" class="progress-bar bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <br>
                                <h6>Wishlist <small>(38%)</small></h6>
                                <div class="progress">
                                    <div style="width:38%" class="progress-bar bg-info" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <canvas id="sales"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end second boxes -->



    </div>
@endsection
