@extends('backend.layouts.header.refresh')
@extends('backend.layouts.master')
@section('content')
    {{-- today Online Appointment --}}
    <div class="card col-md-12">




        <div class="col-12">
            <div class="py-3 d-flex flex-row align-items-center justify-content-between">
                <h2 class="m-0 font-weight-bold text-primary">Today Food Order</h2>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush table-hover" id="dataTable">
                    <thead class="thead-light">
                        <tr>
                            <th>Serial</th>

                            <th>Order Id</th>
                            <th>Customer Name</th>
                            <th>Customer Mobile</th>


                            {{-- <th>AD</th> --}}

                            <th>Waiter</th>
                            <th>Table</th>
                            <th>Order Item</th>
                            <th>Total Price</th>
                            <th>Vat</th>
                            <th>Grand Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pricelists as $data)
                            <tr>

                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $data->order_id }}</td>
                                <td>{{ $data->order_name }}</td>


                                <td>{{ $data->order_mobile }}</td>
                                <td>{{ $data->waiter_name }}</td>

                                <td>{{ $data->table }}</td>

                                <td>{{ $data->order_item }}</td>
                                <td>{{ $data->total_price }}</td>
                                <td>{{ $data->vat }}</td>
                                <td>{{ $data->grand_price }}</td>

                                <td>
                                    <a class="btn btn-info btn-sm"
                                        href="{{ route('order-List', $data->order_id) }}">View</a>
                                 
                                    <a class="btn btn-danger btn-sm"
                                        href="{{ route('price-status', $data->order_id) }}">Payment Recived</a>
                                       

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>



    </div>
@endsection
