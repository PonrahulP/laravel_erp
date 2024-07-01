@extends('layouts.app')
  @section('main')
<div class="container mt-5">
        <div class="row">
            <h5><a href="{{route('purchasereport')}}" style="text-decoration:none;"><i class="bi bi-journal-richtext"></i> Purchase Report</a></h5>
            <hr>
            <nav class="my-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" style="text-decoration:none;">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('stockentry')}}"style="text-decoration:none;">Add Products</a></li>
                    <li class="breadcrumb-item active">Add Purchase</li>
                </ol>
            </nav>
                <form action="{{route('purchase1insert')}}" method="POST" enctype="multipart/form-data">
                @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                    {{csrf_field()}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="supplier" class="form-label fw-bold">Supplier Id:</label>
                            
                          <select name="supplier" class="form-control" style="border-color:black;">
                           <option>Select Supplier</option>
                           @foreach($suppid as $row)
                      <option>{{$row->supplier_id}}</option>
                            @endforeach
                           </select>
                           <a href="{{route('supplyentry')}}" style="text-decoration:none;">Add Supplier</a>
                           <span class="text-danger">@error('supplier') {{$message}} @enderror</span>
                        </div>
                        <div class="col-md-2">
                            <label for="bill" class="form-label fw-bold">Bill No:</label>
                            <input type="text" style="border-color:black;" class="form-control" name="bill" id="bill" value="{{$bill_no}}" readonly>
                            <input type="hidden"  class="form-control" name="bill1[]" id="bill1[]" value="" readonly>
                            <span class="text-danger">@error('bill') {{$message}} @enderror</span>
                        </div>
                        <div class="col-md-3">
                            <label for="logo" class="form-label fw-bold">Bill Image:</label>
                            <input type="file" style="border-color:black;" class="form-control" name="logo" id="logo" value="{{old('logo')}}">
                            <span class="text-danger">@error('logo') {{$message}} @enderror</span>
                        </div>
                        <div class="col-md-3">
                            <label for="date" class="form-label fw-bold">Purchase Date:</label>
                            <input type="date"  class="form-control" style="border-color:black;" name="date" id="date" value="<?php echo date('Y-m-d'); ?>" >
                            <span class="text-danger">@error('date') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="card" style="border-color:black;">
  <div class="card-body" style="border-color:black;">
                    <div class="table-responsive">
            <table class="table table-bordered" id="salesTable">
                <thead style="border-color:black;">
                    <tr>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>CGST</th>
                        <th>SGST</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody style="border-color:black;">
                    <tr>
                       <td>
<input class="form-control" list="datalistOptions" id="code[]" name="code[]" placeholder="Type to search...">
<datalist id="datalistOptions">
    @foreach($codes as $code)
  <option value="{{$code->product_code}}">
    @endforeach
</datalist></td>
                        <td><input type="text" name="product_name[]" class="form-control"></td>
                        <td><input type="number" name="quantity[]" class="form-control" required></td>
                        <td><input type="number" name="unit_price[]" class="form-control" required></td>
                        <td><input type="number" name="cgst[]" class="form-control" required></td>
                        <td><input type="number" name="sgst[]" class="form-control" required></td>
                        <td><input type="number" name="total[]" class="form-control" readonly></td>
                        <td><i class="bi bi-x-circle-fill btn btn-danger h5 removeRow"></i></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <i class="bi bi-plus-square-fill btn btn-primary" id="addRow"></i>
        <button type="submit"  id="btn" name="btn" class="btn btn-success">Submit</button>
                </div>
                </div>
                @method('GET')
                </form>
            <!-- row end -->
        </div>
        <!-- Container end -->
    </div>
    <script>
$(document).ready(function(){
    $("#addRow").click(function(){
        var newRow = '<tr>' +
           '<td>'+'<input class="form-control" list="datalistOptions" id="code[]" name="code[]" placeholder="Type to search...">'+
'<datalist id="datalistOptions">'+
'@foreach($codes as $code)'+
 '<option value="{{$code->product_code}}">'+
 '@endforeach'+
'</datalist>'+'</td>'+
            '<td><input type="text" name="product_name[]" class="form-control" ></td>' +
            '<td><input type="number" name="quantity[]" class="form-control" required></td>' +
            '<td><input type="number" name="unit_price[]" class="form-control" required></td>' +
            '<td><input type="number" name="cgst[]" class="form-control" required></td>' +
            '<td><input type="number" name="sgst[]" class="form-control" required></td>' +
            '<td><input type="number" name="total[]" class="form-control" readonly></td>' +
            '<td><i class="bi bi-x-circle-fill btn btn-danger h5 removeRow"></i></td>' +
            '</tr>';
        $("#salesTable tbody").append(newRow);
    });

    $(document).on('click', '.removeRow', function(){
        $(this).closest('tr').remove();
    });
    $(document).on('change', 'input[name="code[]"]', function(){
        var code = $(this).val();
        var row = $(this).closest('tr');
        if (code) {
            $.ajax({
                url: "{{route('getproductname')}}",
                method: "GET",
                data: { code: code },
                dataType: "json",
                success: function(data) {
                    if (data) {
                        row.find('input[name="product_name[]"]').val(data.product_name);
                    } else {
                        row.find('input[name="product_name[]"]').val("");
                    }
                }
            });
        } else {
            row.find('input[name="product_name[]"]').val("");
        }
    });
    $(document).on('input', 'input[name="quantity[]"], input[name="unit_price[]"], input[name="cgst[]"], input[name="sgst[]"]', function(){
        var row = $(this).closest('tr');
        var qty = parseFloat(row.find('input[name="quantity[]"]').val()) || 0;
        var unitPrice = parseFloat(row.find('input[name="unit_price[]"]').val()) || 0;
        var cgst = parseFloat(row.find('input[name="cgst[]"]').val()) || 0;
        var sgst = parseFloat(row.find('input[name="sgst[]"]').val()) || 0;
        var cgst1=((unitPrice*cgst/100));
        var sgst1=((unitPrice*sgst/100));
        var total =(unitPrice+cgst1+sgst1)*qty;
        row.find('input[name="total[]"]').val(total);
    });
});
</script>
    @endsection