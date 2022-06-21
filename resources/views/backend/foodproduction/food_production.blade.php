@extends('backend.layouts.master')
@section('content')

<style>
    .select2-container .select2-selection--single {
        height: 43px;
    }
</style>
    <form action="">


        <div class="container">

            <div class="card">


                <div class="py-3 d-flex flex-row align-items-center justify-content-between">
                    <h2 class="text-center" style="padding: 10px 400px; text-transform: uppercase; color:#6777ef;">
                        <b>Add Item
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

                    <div class="form-group col-md-7">
                        <label for="foodnam"><b>Food Name</b></label>
                        <select class="form-control" id="foodnam" name="food_nam">
                            <option>--Select--</option>
                            <option value="Bkash">Bkash</option>
                            <option value="Nagad">Nagad</option>
                            <option value="Cheque">Cheque</option>
                            <option value="Hand Cash">Hand Cash</option>
                        </select>
                    </div>


                </div>



                <div class="table-responsive add_item">
                    <table class="table align-items-center table-flush table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Food Iiem</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <span id="addRow" style="display: none" class="btn btn-success addeventmore"
                                    title="Add More"><i class="fa fa-plus-circle"></i></span>
                            </tr>

                        </tbody>
                    </table>
                </div>


                <div class="form-group col-md-4">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>

            </div>
        </div>


    </form>
@endsection

@section('main-script')
    <script>

    $(document).ready(function(){
        var counter = 0;
        $(document).on('click','.addeventmore',function()
        {
            $(this).closest('.add_item').append('<div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add"><div class="form-row"><table class="table align-items-center table-flush table-hover"><tbody><td><input data-id="'+counter+'" id="prod1_input1_'+counter+'" type="number" step="0.01" class="form-control qty" name="quantity[]" required></td><td class="result5"><input id="prod1_input5_'+counter+'" type="text" class="form-control" name="unit[]" value=""></td><td class="result3"><input id="prod1_input2_'+counter+'" type="{{ Auth::user()->role == 1 ? 'text' : 'hidden' }}" class="form-control" name="buying_price[]" value=""></td><td class="result4"><input id="prod1_input3_'+counter+'" type="text" class="form-control" name="selling_price[]" value=""></td><td style="width:120px"><span class="btn btn-success btn-sm addeventmore" title="Add More"><i class="fa fa-plus-circle"></i></span><span id="rmvBtn'+counter+'" class="btn btn-danger btn-sm removeeventmore" title="Remove"><i class="fa fa-minus-circle"></i></span></td></tr></tbody></table></div></div>');
    
          
      
    
      

            $(document).on('click','.removeeventmore',function(event)
            {
                $(this).closest('.delete_whole_extra_item_add').remove();
                counter -= 1;
                total();
            });
    
    
        });
    });

</script>
<script>
    $(function(){
        $('#addRow').click();
        {{--  $('#rmvBtn0').hide();  --}}
    });
</script>
@endsection
