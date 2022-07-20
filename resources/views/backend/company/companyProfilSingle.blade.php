@extends('backend.layouts.master')
@section('content')
    <div class="row mb-3" style="margin: 0px 12px;">
        <div class="card container-fluid">
            <h2 class="text-center" style="padding: 30px 0px; text-transform: uppercase; color:#6777ef;"><b><img style="width: 200;height:100px; border-radius: 50%;"
                src="{{ $companies->company_logo ? url('/' . $companies->company_logo) : url('food_image/no-image.png') }}"
                alt=""></a>
                </b>{{ $companies->company_name }}</h2>
                <P>{{ $companies->description }}</P>

            {{-- error message --}}
            @if ($errors->any())
                <div id="error" class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $errors->first() }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="col">
              
            </div>
        </div>
    </div>

    <div class="row mb-3" style="margin: 0px -23px;">
        <div class="container-fluid d-flex">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Sales Summary</h6>
                    </div>
                    <div class="table-responsive p-3">
                        {{-- success msg show --}}
                        @if (session()->has('success'))
                            <div id="success" class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session()->get('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="row mb-3">
                        <div class="col-xl-3 col-md-6 ">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1"> Total Order</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($oderDetails) }} </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-money-bill-alt fa-2x text-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 ">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">  Total Sales</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ $oderDetails->sum('grand_price')}} TK</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-money-bill-alt fa-2x text-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 ">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Total Items sales</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ $oderDetails->sum('order_item')}} </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-money-bill-alt fa-2x text-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="row mb-3">

                           
                            <div class="col-xl-3 col-md-6 ">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-uppercase mb-1"> ( Total Order In Week)</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ count($oderDetailsWeek)}} </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-money-bill-alt fa-2x text-primary"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 ">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-uppercase mb-1"> ( Total seles In Week )</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ $oderDetailsWeek->sum('grand_price')}} TK</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-money-bill-alt fa-2x text-primary"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 ">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-uppercase mb-1"> ( Total seles items In Week )</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ $oderDetailsWeek->sum('order_item')}} </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-money-bill-alt fa-2x text-primary"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                  



                        </div>
                        <div class="row mb-3">
                        <div class="col-xl-3 col-md-6 ">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1"> Total Order In <?php echo date('F');?> </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ count($oderDetailsMonth)}} </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-money-bill-alt fa-2x text-danger"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 ">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">  Total seles In <?php echo date('F');?> </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ $oderDetailsMonth->sum('grand_price')}} TK </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-money-bill-alt fa-2x text-danger"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 ">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1"> Total seles items In <?php echo date('F');?> </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ $oderDetailsMonth->sum('order_item')}} </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-money-bill-alt fa-2x text-danger"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="row mb-3">

                           
                            <div class="col-xl-3 col-md-6 ">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-uppercase mb-1"> Total Order In <?php echo date('Y');?> </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ count($oderDetailsYear)}} </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-money-bill-alt fa-2x text-info"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 ">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-uppercase mb-1"> Total seles In <?php echo date('Y');?> </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ $oderDetailsYear->sum('grand_price')}} TK</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-money-bill-alt fa-2x text-info"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 ">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-uppercase mb-1"> Total seles items In <?php echo date('Y');?></div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ $oderDetailsYear->sum('order_item')}} </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-money-bill-alt fa-2x text-info"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
