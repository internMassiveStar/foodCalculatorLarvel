@extends('backend.layouts.master')
@section('content')
    <div class="row mb-3" style="margin: 0px 12px;">
        <div class="card container-fluid">
            <h2 class="text-center" style="padding: 30px 0px; text-transform: uppercase; color:#6777ef;"><b>Add company
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
                <form action="{{ @$editData ? route('company-Update', $editData->id) : route('company-add') }}" method="POST">
                    @csrf
                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <label for="companyname"><b>Company Name</b></label>
                            <input type="text" class="form-control" value="{{ @$editData->name }}"
                                name="company_name" id="companyname" />
                        </div>
                      
                        
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-primary">{{ @$editData ? 'Confirm' : 'Submit' }}</button>
                        </div>
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
                                    <th>Request Name</th>
                                  
                                    <th>Public Key</th>
                                    <th>Private Key</th>
                                    <th>Join Date</th>
                                 
                                    <th width="80px">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($company as $wtr)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $wtr->name }}</td>
                                      
                                        <td>{{ $wtr->public_key }}</td>
                                        <td>{{ $wtr->private_key }}</td>
                                        <td>{{ $wtr->created_at->toDateString() }}</td>
                                        @if ($wtr->public_key==0)

                                        <td>
                                            <a class="btn btn-danger btn-sm"
                                                href="{{ route('company-Edit', $wtr->id) }}">Next Step</a>
                                        </td>
                                        @elseif ($wtr->name == 'Admin')
                                        <td>
                                            <a class="btn btn-primary btn-sm"
                                                href="#">Massive Star</a>
                                        </td>
                                        @else
                                        <td>
                                            <a class="btn btn-success btn-sm"
                                                href="#">  {{ $wtr->company_name }}</a>
                                        </td>

                                        @endif
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
