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
                                       
            
            
                                        {{-- <th>AD</th> --}}
            
                                        <th>Waiter</th>
                                        <th>Table</th>
                                        <th>Order Item</th>
                                        
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($food as $editData)
                                        <tr>
            
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $editData->order_id }}</td>
                                            <td>{{ $editData->waiter_name }}</td>
            
                                            <td>{{ $editData->table }}</td>
            
                                            <td>{{ $editData->order_item }}</td>
                                          
            
                                            <td>
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('order-List', $editData->order_id) }}">View</a>
                                                <a class="btn btn-success btn-sm"
                                                    href="{{ route('production-status', $editData->order_id) }}">Complete</a>
            
                                            </td>
            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <form action="{{ route('ingredient') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="order id"><b>Order Id</b></label>
                                <select class="form-control" name="order_id" id="order_id">
                                    <option value="">--Select--</option>
                                    @foreach ($food as $order) 
                                    <option value="{{$order->order_id}}" selected>{{$order->order_id}}</option>
                                @endforeach
                                  
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="item name"><b>Item Name</b></label>
                                <input type="text" class="form-control" 
                                    name="item_name" id="item_name" />
                            </div>
    
                            <div class="form-group col-md-6">
                                <label for="ingredient"><b>Ingredient</b></label>
                                <textarea name="ingredient" type="text" class="form-control"></textarea>
                            </div>

            
                            <div class="form-group col-md-6">
                                <label for="comments"><b>Comments</b></label>
                                <textarea name="comments" type="text" class="form-control"></textarea>
                            </div>
                           
                           
                        </div>
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
@endsection

@section('main-script')
    {{-- <script>

    $(document).ready(function(){
        var counter = 0;
        $(document).on('click','.addeventmore',function()
        {
            // $(this).closest('.add_item').append('<div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add"><div class="form-row"><table class="table align-items-center table-flush table-hover"><tbody><td><input data-id="'+counter+'" id="prod1_input1_'+counter+'" type="number" step="0.01" class="form-control qty" name="quantity[]" required></td><td class="result5"><input id="prod1_input5_'+counter+'" type="text" class="form-control" name="unit[]" value=""></td><td class="result3"><input id="prod1_input2_'+counter+'" type="{{ Auth::user()->role == 1 ? 'text' : 'hidden' }}" class="form-control" name="buying_price[]" value=""></td><td class="result4"><input id="prod1_input3_'+counter+'" type="text" class="form-control" name="selling_price[]" value=""></td><td style="width:120px"><span class="btn btn-success btn-sm addeventmore" title="Add More"><i class="fa fa-plus-circle"></i></span><span id="rmvBtn'+counter+'" class="btn btn-danger btn-sm removeeventmore" title="Remove"><i class="fa fa-minus-circle"></i></span></td></tr></tbody></table></div></div>');
    
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
    {{-- });
</script> --}} 
@endsection
