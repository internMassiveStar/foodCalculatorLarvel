@extends('backend.layouts.master')
@section('content')
    <style>
        .select2-container .select2-selection--single {

            height: 43px;
        }

    </style>

    <form action="{{ route('foodcalulator-add') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3" style="margin: 0px 12px;">
            <div class="card container-fluid">
                <h2 class="text-center" style="padding: 30px 0px; text-transform: uppercase; color:#6777ef;"><b>Food
                        Calculator</b></h2>
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

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="customername"><b>Customer Name</b></label>
                            <input style="width: 60%" type="text" class="form-control" name="customer_name"
                                id="customername" />
                        </div>

                        <div class="form-group col-md-6">
                            <label for="customermobile"><b>Customer Mobile</b></label>
                            <input style="width: 60%" type="text" class="form-control" name="customer_mobile"
                                id="customermobile" />
                        </div>

                        <div class="form-group col-md-4">
                            <label for="waiter"><b>Waiter</b></label>
                            <select class="form-control" id="waiter" name="waiter">

                                <option value="">Select</option>
                                @foreach ($waiter as $w)
                                    <option value="{{ $w->id }}">{{ $w->waiter_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="table"><b>Table Number</b></label>
                            <select class="form-control" id="table" name="table">

                                <option value="">Select</option>
                                @foreach ($table as $t)
                                    <option value="{{ $t->table_name }}">{{ $t->table_name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group col-md-2" style="margin-top: 33px">
                            <button type="save" class="btn btn-primary">Save </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3" style="margin: 0px 12px;">
            <table class="table align-items-center table-flush table-hover" id="dataTable5">
                <thead class="thead-light">

                    <tr>

                        <th class="check">Select Checkbox</th>
                        <th>Food Picture</th>
                        <th>Food Name</th>
                        <th>Food Price</th>
                        <th>Food Quantity</th>
                        <th>Sub Price</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($food as $fd)
                        <tr>
                            <td><input type="checkbox" class="allChecked" name="foodchk[]"
                                    value="{{ $fd->id }}" />
                            </td>
                            <td>
                                <a href="{{ @$fd->food_photo ? url('/' . $fd->food_photo) : url('food_image/no-image.png') }}"
                                    download="" title="Click to download"><img style="width: 50px;height:50px;"
                                        src="{{ $fd->food_photo ? url('/' . $fd->food_photo) : url('food_image/no-image.png') }}"
                                        alt=""></a>
                            </td>
                            <td>{{ $fd->food_name }}</td>

                            <td><input type="text" style="width: 60px ; border:none" data-id="{{ $fd->id }}"
                                    id="food_price{{ $fd->id }}" name="food_price[]" value="{{ $fd->food_price }}"
                                    readonly />
                            </td>
                            <td><input type="text" class="foodquantity" data-id="{{ $fd->id }}"
                                    id="foodquantity{{ $fd->id }}" style="width: 60px ; border:none"
                                    name="food_quantity[]" /></td>

                            <td><input type="number" style="width: 90px ; border:none" class="sub_total"
                                    data-id="{{ $fd->id }}" id="sub_total{{ $fd->id }}" name="sub_total[]"
                                    readonly /></td>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>

        <div class="row mb-3" style="margin: 0px 12px;">
            <div class="card container-fluid">



                <div class="form-row">

                    <div class="form-group col-md-6">
                        <label><b>Total Item Selected</b></label>
                        <input style="width: 60%" type=" text" class="form-control item_qty" name="item" id="item" />
                    </div>

                    <div class="form-group col-md-6">
                        <label for="totalprice"><b>Total Price</b></label>
                        <input style="width: 60%" type="text" class="form-control" id="total" name="total_price" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="vat"><b>Vat</b></label>
                        <input style="width: 60%" type="text" class="form-control vat" name="vat" id="vat" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="grandprice"><b>Grand Total</b></label>
                        <input style="width: 60%" type="text" class="form-control gtotal" name="grand_price"
                            id="grandprice" />
                    </div>






                </div>

            </div>
        </div>

    </form>
@endsection

@section('main-script')
    <script>
        $(document).ready(function() {
            var memIdArr = [];
            var selectedMem;
            var extMem = false;
            $(".allChecked").on('change', function() {
                selectedMem = $(this).val();
                if ($(this).is(':checked')) {
                    for (var i = 0; i < memIdArr.length; i++) {
                        if (memIdArr[i] == selectedMem) {
                            extMem = true;
                        }
                    }
                    if (!extMem) {
                        memIdArr.push($(this).val());
                    } else {
                        extMem = false;
                    }
                } else {
                    for (var i = 0; i < memIdArr.length; i++) {
                        if (memIdArr[i] == selectedMem) {
                            memIdArr.splice(i, 1);
                        }
                    }
                }

                $(".item_qty").val(memIdArr.length);
                console.log('this is my item array: ' + memIdArr.length);
            });


            $(".foodquantity").keyup(function() {
                var qtyId = $(this).data('id');
                $("#sub_total" + qtyId).val(parseFloat($("#food_price" + qtyId).val()) * parseFloat(
                    $(this)
                    .val()));
                total();
            });


            function total() {
                var nullChk = 0;
                var sum = 0;
                $(".sub_total ").each(function() {
                    if ($(this).val() != "" && $(this).val() != null && $(this).val() != undefined) {
                        sum += parseFloat($(this).val());
                    } else {
                        sum += parseFloat(nullChk);
                    }
                });

                $("#total").val(sum);

                $(".vat").val(Math.round($("#total").val() * 0.15));
                $(".gtotal").val(Math.round(parseFloat(parseFloat($(".vat").val()) + parseFloat($("#total")
                    .val()))));

            }
        });
    </script>
@endsection
