@extends('backend.layouts.master')
@section('content')

<style>
    .select2-container .select2-selection--single {
        height: 43px;
    }
</style>
   

        <div class="container">

            <div class="card">


                <div class="py-3 d-flex flex-row align-items-center justify-content-between">
                    <h2 class="text-center" style="padding: 10px 400px; text-transform: uppercase; color:#6777ef;">
                        <b>
                        </b>
                    </h2>
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $errors->first() }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>



                <div class="container">
                    <div class="col-12">
                        <div class="py-3 d-flex flex-row align-items-center justify-content-between">
                            <h2 class="m-0 font-weight-bold text-primary">Today Production </h2>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush table-hover" id="dataTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Serial</th>
            
                                        <th>Order Id</th>
                                       
            
            
                                        {{-- <th>AD</th> --}}
                                        @if(Auth::user()->role==0)
                                        <th>Company Name</th>
                                        @endif
                                        <th>Item Name</th>
                                      
                                        
                                        <th>Ingredient</th>
                                        <th>Comment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productions as $production)
                                        <tr>
            
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $production->order_id }}</td>
                                            @if(Auth::user()->role==0)
                                            <td>{{ $production->company_name }}</td>
                                             @endif
                                            <td>{{ $production->item_name }}</td>
            
                                            <td>{{ $production->ingredient }}</td>
                                            <td>{{ $production->comments }}</td>

                                          
            
                                          
            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
         
@endsection


