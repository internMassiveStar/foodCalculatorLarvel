@extends('backend.layouts.master')
@section('content')
    <div class="row mb-3" style="margin: 0px 12px;">
        <div class="card container-fluid">
            <h2 class="text-center" style="padding: 30px 0px; text-transform: uppercase; color:#6777ef;"><b>Add Food
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
                <form action="{{ @$editData ? route('food-Update', $editData->id) : route('food-add') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="foodname"><b>Food Name</b></label>
                            <input type="text" class="form-control" value="{{ @$editData->foodName }}" name="foodName"
                                id="foodname" />
                        </div>

                        <div class="form-group col-md-6">
                            <label for="foodphoto" style="text"><b>Food Photo</b></label>

                            <input type="file" name="food_photo" class="form-control">

                        </div>

                        <div class="form-group col-md-6">
                            <label for="foodprice"><b>Food Price</b></label>
                            <input type="text" class="form-control" value="{{ @$editData->food_price }}"
                                name="food_price" id="foodprice" />
                        </div>
                        @if(Auth::user()->role==0)
                        <div class="form-group col-md-4">
                            <label for="memberInstraction"><b>Company Name</b></label>
                            <select class="form-control" name="company_id" id="company_id">
                                <option value="">--Select--</option>
                                @foreach ($companies as $company) 
                                <option value="{{$company->public_key}}" selected>{{$company->company_name}}</option>
                            @endforeach
                              
                            </select>
                        </div>
                        @endif

                        <div class="form-group col-md-6">
                            <label for="date"><b>Date</b></label>
                            <input type="{{ @$editData ? 'text' : 'date' }}" class="form-control"
                                value="{{ @$editData->food_date }}" name="food_date" id="date"
                                {{ @$editData ? 'readonly' : '' }} />
                        </div>
                        
                    </div>
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-primary">{{ @$editData ? 'Update' : 'Submit' }}</button>
                    </div>
                </form>
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
                                    <th>Food Name</th>
                                    @if(Auth::user()->role==0)
                                    <th>Company Name</th>
                                    @endif
                                    <th>Food Picture</th>
                                    <th>Food Price</th>
                                    <th>Date</th>
                                    <th width="80px">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($foodCom as $fd)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $fd->foodName }}</td>
                                        @if(Auth::user()->role==0)
                                        <td>{{ $fd->company_name }}</td>
                                        @endif
                                        <td>
                                            <a href="{{ @$fd->food_photo ? url('/' . $fd->food_photo) : url('food_image/no-image.png') }}"
                                                download="" title="Click to download"><img style="width: 50px;height:50px;"
                                                    src="{{ $fd->food_photo ? url('/' . $fd->food_photo) : url('food_image/no-image.png') }}"
                                                    alt=""></a>
                                        </td>
                                        <td>{{ $fd->food_price }}</td>
                                        <td>{{ $fd->food_date }}</td>


                                        <td>
                                            <a class="btn btn-success btn-sm"
                                                href="{{ route('food-Edit', $fd->id) }}">Edit</a>
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
