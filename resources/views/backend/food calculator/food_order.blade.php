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
                        @foreach ($food as $editData)
                            <tr>

                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $editData->order_id }}</td>
                                <td>{{ $editData->order_name }}</td>


                                <td>{{ $editData->order_mobile }}</td>
                                <td>{{ $editData->waiter_name }}</td>

                                <td>{{ $editData->table }}</td>

                                <td>{{ $editData->order_item }}</td>
                                <td>{{ $editData->total_price }}</td>
                                <td>{{ $editData->vat }}</td>
                                <td>{{ $editData->grand_price }}</td>

                                <td>
                                    <a class="btn btn-info btn-sm"
                                        href="{{ route('order-List', $editData->order_id) }}">View</a>
                                    <a class="btn btn-success btn-sm"
                                        href="{{ route('kitchen-status', $editData->order_id) }}">Kitchen</a>

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>



    </div>
@endsection
