@extends('backend.layouts.master')
@section('content')
    <div class="row mb-3" style="margin: 0px 12px;">
        <div class="card container-fluid">
            <h2 class="text-center" style="padding: 30px 0px; text-transform: uppercase; color:#6777ef;"><b>Companies Profile
                </b></h2>
            
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
                        <h6 class="m-0 font-weight-bold text-primary">All Product Brand</h6>
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
                        <table class="table align-items-center table-flush" id="dataTable">
                            <thead class="thead-light">
                                <tr>

                                    <th>Serial Number</th>
                                   
                                  
                                    <th>Company Name</th>
                                    
                                    <th>logo</th>
                            
                                    <th width="80px">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($companies as $company)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $company->company_name }}</td>
                                      
                                        
                                  
                                        <td>
                                            <a href="{{ @$company->company_logo ? url('/' . $company->company_logo) : url('food_image/no-image.png') }}"
                                                download="" title="Click to download"><img style="width: 50px;height:50px;"
                                                    src="{{ $company->company_logo ? url('/' . $company->company_logo) : url('food_image/no-image.png') }}"
                                                    alt=""></a>
                                        </td>
                                      


                                        <td>
                                            <a class="btn btn-success btn-sm"
                                                href="{{ route('company-profiles', $company->id) }}">See Details</a>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
