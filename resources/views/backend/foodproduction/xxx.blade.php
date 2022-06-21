<div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
    <div class="form-row">
        <table class="table align-items-center table-flush table-hover">
            <tbody>
                <tr>
                    <td width="130px"><select class="form-control category'+counter+'" name="category_id[]" required>
                            <option value="">Select</option>
                            @foreach ($get_category as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td width="200px"><select class="form-control product1 prodct'+counter+'" data-id="'+counter+'"
                            name="product_id[]" required>
                            <option value="">Select</option>
                            @foreach ($get_product as $product)
                                <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td width="130px"><select class="form-control brand'+counter+'" name="brand_id[]" required>
                            <option value="">Select</option>
                            @foreach ($get_brand as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                            @endforeach
                        </select></td>
                    <td><input data-id="'+counter+'" id="prod1_input1_'+counter+'" type="number" step="0.01"
                            class="form-control qty" autocomplete="off" name="quantity[]" required></td>
                    <td class="result5"><input id="prod1_input5_'+counter+'" type="text" class="form-control"
                            name="unit[]" value="" readonly></td>
                    <td class="result3"><input id="prod1_input2_'+counter+'"
                            type="{{ Auth::user()->role == 1 ? 'text' : 'hidden' }}" class="form-control"
                            name="buying_price[]" value="" readonly></td>
                    <td class="result4"><input id="prod1_input3_'+counter+'" type="text" class="form-control"
                            name="selling_price[]" value="" readonly></td>
                    <td><input id="prod1_input4_'+counter+'" type="text" class="form-control sub_total"
                            name="sub_total[]" value="" readonly></td>
                    <td style="width:120px"><span class="btn btn-success btn-sm addeventmore" title="Add More"><i
                                class="fa fa-plus-circle"></i></span><span id="rmvBtn'+counter+'"
                            class="btn btn-danger btn-sm removeeventmore" title="Remove"><i
                                class="fa fa-minus-circle"></i></span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
