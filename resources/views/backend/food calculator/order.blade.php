@extends('backend.layouts.master')
@section('content')
    {{-- today Online Appointment --}}
    <div class="card col-md-12">




        <div class="col-12">
            <div class="py-3 d-flex flex-row align-items-center justify-content-between">
                <h2 class="m-0 font-weight-bold text-primary">Food Item Order</h2>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush table-hover" id="dataTable">
                    <thead class="thead-light">
                        <tr>
                            <th>Serial</th>
                            <th>Customer Name</th>
                            <th>Customer Mobile</th>



                            <th>Waiter</th>
                            <th>Table</th>
                            <th>Food Name</th>
                            <th>Food Image</th>
                            <th>Food Qunatity</th>
                            <th>Food Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($food as $fd)
                            <tr>

                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $fd->customer_name }}</td>


                                <td>{{ $fd->customer_mobile }}</td>
                                <td>{{ $fd->waiter_name }}</td>

                                <td>{{ $fd->table }}</td>

                                <td>{{ $fd->foodName }}</td>
                                <td><a href="{{ @$fd->food_photo ? url('/' . $fd->food_photo) : url('food_image/no-image.png') }}"
                                        download="" title="Click to download"><img style="width: 50px;height:50px;"
                                            src="{{ $fd->food_photo ? url('/' . $fd->food_photo) : url('food_image/no-image.png') }}"
                                            alt=""></a></td>
                                <td>{{ $fd->food_quantity }}</td>
                                <td>{{ $fd->food_price }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>



    </div>
@endsection
