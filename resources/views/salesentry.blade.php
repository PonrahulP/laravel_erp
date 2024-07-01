@extends('layouts.app')
@section('main')

<div class="container mt-5">
        <div class="row">
            <h5><a href="{{route('salesreport')}}" style="text-decoration:none;"><i class="bi bi-journal-richtext"></i> Sales Report</a></h5>
            <hr>
            <nav class="my-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" style="text-decoration:none;">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('stockentry')}}" style="text-decoration:none;">Add Products</a></li>
                    <li class="breadcrumb-item active">Add Sales</li>
                </ol>
            </nav>
          
                <form action="{{route('salesinsert')}}" method="POST">
                <div class="container">
                @if(session('messages'))
    <div class="alert alert-success">
        {!! session('messages') !!}
    </div>
@endif

@if(session('low_stock_products'))
    <div class="alert alert-warning">
        <strong>Warning!</strong> The following products have low stock:
        <ul>
            @foreach(session('low_stock_products') as $product)
                <li>{{ $product }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('message'))
    <div class="alert alert-danger">
        {{ session('message') }}
    </div>
@endif

                    {{csrf_field()}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="customer">Customer Id</label>
                           
                           
                          <select name="customer" class="form-control">
                           <option>Select Customers</option>
                          @foreach($cusid as $row)
                      <option>{{$row->customer_id}}</option>
                           @endforeach
                           </select>
                           <span class="text-danger">@error('customer') {{$message}} @enderror</span>
                        </div>
                        <div class="col-md-2">
                            <label for="bill">Bill No:</label>
                            <input type="text"  class="form-control" name="bill" id="bill" value="{{$bill_no}}" readonly>
                            <!-- <input type="hidden"  class="form-control" name="bill1[]" id="bill1[]" value="" readonly> -->
                            <span class="text-danger">@error('bill') {{$message}} @enderror</span>
                        </div>
                        <div class="col-md-3">
                            <label for="invoice">Invoice No:</label>
                            <input type="text"  class="form-control" name="invoice" id="invoice" value="{{$invoice_no}}" readonly >
                            <span class="text-danger">@error('invoice') {{$message}} @enderror</span>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                            <label for="type">Sales Type</label>
                            <select class="form-select" name="type" aria-label="Default select example">
                            <option selected>Choose</option>
                            <option value="Bill to Bill">Bill To Bill</option>
                             <option value="Bill to Cash">Bill To Cash</option>
                               </select>
                               <span class="text-danger">@error('type') {{$message}} @enderror</span>
                            </div>
                            <div class="col-md-3">
                            <label for="date">Sales Date</label>
                            <input type="date"  class="form-control" name="date" id="date" value="<?php echo date('Y-m-d'); ?>" >

                        </div>
                    </div>
                    <div class="card">
  <div class="card-body">
                    <div class="table-responsive">
            <table class="table table-bordered" id="salesTable">
                <thead>
                    <tr>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>
<input class="form-control" list="datalistOptions" id="product[]" name="product[]" placeholder="Type to search...">
<datalist id="datalistOptions">
    @foreach($code as $codes)
  <option value="{{$codes->product_code}}">
    @endforeach
</datalist>
<span class="text-danger">@error('product[]') {{$message}} @enderror</span></td>
                        <td><input type="text" name="product_name[]" class="form-control"> <span class="text-danger">@error('product_name[]') {{$message}} @enderror</span></td>
                        <td><input type="text" name="quantity[]" class="form-control" required> <span class="text-danger">@error('quantity') {{$message}} @enderror</span></td>
                        <td><input type="text" name="unit_price[]" class="form-control" required> <span class="text-danger">@error('unit_price') {{$message}} @enderror</span></td>
                        <td><input type="text" name="total[]" class="form-control" readonly> <span class="text-danger">@error('total[]') {{$message}} @enderror</span></td>
                        <td><i class="bi bi-x-circle-fill btn btn-danger h5 removeRow"></i></td>
                    </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan='4' class="text-end">Sub-total</td>
                    <td><input type="text" name="sub" id="sub" class="form-control" required></td>
                    </tr>
                    <tr>
                    <td colspan='4' class="text-end">Discount</td>
                    <td><input type="text" name="discount" id="discount" class="form-control" required></td>
                    </tr>
                    <tr>
                    <td colspan='3' class="text-end">CGST%</td>
                    <td><input type="text" name="cgst" id="cgst" class="form-control" required></td>
                    <td><input type="text" name="cgstamnt" id="cgstamnt" class="form-control" required></td>
                    </tr>
                    <tr>
                    <td colspan='3' class="text-end">SGST%</td>
                    <td><input type="text" name="sgst" id="sgst" class="form-control" required></td>
                    <td><input type="text" name="sgstamnt" id="sgstamnt" class="form-control" required></td>
                    </tr>
                    <tr>
                        <td>  <i class="bi bi-plus-square-fill btn btn-primary" id="addRow"></i></td>
                        <td colspan='3' class="text-end">Grand Total</td>
                        <td><input type="text" name="grand" id="grand" class="form-control" required></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <button type="submit"  id="btn" name="btn" class="btn btn-success">Generate Invoice</button>
       
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
            '<td>' +
                '<input class="form-control" list="datalistOptions" id="product[]" name="product[]" placeholder="Type to search...">' +
                '<datalist id="datalistOptions">' +
                '@foreach($code as $codes)' +
                '<option value="{{ $codes->product_code }}">{{ $codes->product_code }}</option>' +
                '@endforeach' +
                '</datalist>' +
                '<span class="text-danger">@error("product[]") {{$message}} @enderror</span>'+
            '</td>' +
            '<td><input type="text" name="product_name[]" class="form-control">' +'<span class="text-danger">@error("product_name[]") {{$message}} @enderror</span>'+'</td>' +
            '<td><input type="text" name="quantity[]" class="form-control" required>'+ '<span class="text-danger">@error("quantity[]") {{$message}} @enderror</span>'+'</td>' +
            '<td><input type="text" name="unit_price[]" class="form-control" required>'+ '<span class="text-danger">@error("unit_price[]") {{$message}} @enderror</span>'+'</td>' +
            '<td><input type="text" name="total[]" class="form-control" readonly>'+ '<span class="text-danger">@error("total[]") {{$message}} @enderror</span>'+'</td>' +
            '<td><i class="bi bi-x-circle-fill btn btn-danger h5 removeRow"></i></td>' +
        '</tr>';
        $("#salesTable tbody").append(newRow);
        subtotal();
    });


    // Remove a row from the sales table
    $(document).on('click', '.removeRow', function(){
        $(this).closest('tr').remove();
        subtotal();
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
    $(document).on('input', 'input[name="quantity[]"], input[name="unit_price[]"], input[name="cgst"], input[name="sgst"], input[name="discount"], input[name="sub"]', function(){
                var row = $(this).closest('tr');
                var qty = parseFloat(row.find('input[name="quantity[]"]').val()) || 0;
                var unitPrice = parseFloat(row.find('input[name="unit_price[]"]').val()) || 0;
                var tprice = unitPrice * qty;
                row.find('input[name="total[]"]').val(tprice.toFixed(2));

                var cgst = parseFloat($("#cgst").val()) || 0;
                var sgst = parseFloat($("#sgst").val()) || 0;
                var discount = parseFloat($("#discount").val()) || 0;
                var sub = parseFloat($("#sub").val()) || 0;
                
                var cgstAmount = (sub * cgst) / 100;
                $("#cgstamnt").val(cgstAmount.toFixed(2));

                var sgstAmount = (sub * sgst) / 100;
                $("#sgstamnt").val(sgstAmount.toFixed(2));

                var grandTotal = sub + cgstAmount + sgstAmount - discount;
                $("#grand").val(grandTotal.toFixed(2));

                subtotal();
            });

    // Calculate the grand total of all products
    function subtotal(){
        var subtotal = 0;
        $("input[name='total[]']").each(function(){
            subtotal += parseFloat($(this).val()) || 0;
        });
        $("#sub").val(subtotal.toFixed(2));
    }

    // Auto-fill product details based on product code
    $(document).on('change', 'input[name="product[]"]', function(){
        var code = $(this).val();
        var row = $(this).closest('tr');
        if (code) {
            $.ajax({
                url: "{{ route('getsales') }}",
                method: "GET",
                data: { code: code },
                success: function(data) {
                    if (data) {
                        row.find('input[name="product_name[]"]').val(data.product_name);
                        row.find('input[name="unit_price[]"]').val(data.unit_price);
                    } else {
                        row.find('input[name="product_name[]"]').val("");
                        row.find('input[name="unit_price[]"]').val("");
                    }
                }
            });
        } else {
            row.find('input[name="product_name[]"]').val("");
            row.find('input[name="unit_price[]"]').val("");
        }
    });

   
});
</script>
    @endsection