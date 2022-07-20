@extends('backend.layouts.master')
@section('content')
    <div class="row mb-3" style="margin: 0px 12px;">
        <div class="card container-fluid">
            <h2 class="text-center" style="padding: 30px 0px; text-transform: uppercase; color:#6777ef;"><b>Add Waiter
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
                <form action="{{ @$editData ? route('waiter-Update', $editData->id) : route('waiter-add') }}"
                    method="POST">
                    @csrf
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="waitername"><b>Waiter Name</b></label>
                            <input type="text" class="form-control" value="{{ @$editData->waiter_name }}"
                                name="waiter_name" id="waitername" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="date"><b>Date</b></label>
                            <input type="{{ @$editData ? 'text' : 'date' }}" class="form-control"
                                value="{{ @$editData->waiter_date }}" name="waiter_date" id="date"
                                {{ @$editData ? 'readonly' : '' }} />
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
                                    <th>Waiter Name</th>
                                    @if(Auth::user()->role==0)
                                    <th>Company Name</th>
                                    @endif
                                    <th>Date</th>
                                    <th width="80px">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($waiterCom as $wtr)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $wtr->waiter_name }}</td>
                                        @if(Auth::user()->role==0)
                                        <td>{{ $wtr->company_name }}</td>
                                        @endif
                                        <td>{{ $wtr->waiter_date }}</td>

                                        <td>
                                            <a class="btn btn-success btn-sm"
                                                href="{{ route('waiter-Edit', $wtr->id) }}">Edit</a>
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
