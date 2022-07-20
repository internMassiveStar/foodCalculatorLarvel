@extends('backend.layouts.master')
@section('content')
    <div class="row mb-3" style="margin: 0px 12px;">
        <div class="card container-fluid">
            <h2 class="text-center" style="padding: 30px 0px; text-transform: uppercase; color:#6777ef;"><b>{{Auth::user()->company_name}}
                </b></h2>
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

                <form action="{{ route('set-setting-company') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="description"><b>Company Description</b></label>
                            <textarea name="description" type="text" class="form-control"></textarea>

                        </div>

                        <div class="form-group col-md-6">
                            <label for="company log" style="text"><b>Company logo</b></label>

                            <input type="file" name="company_logo" class="form-control">

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
                     
                        
                    </div>
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
              
            </div>
        </div>
    </div>

   
@endsection
