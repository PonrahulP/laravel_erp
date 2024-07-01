@extends('layouts.app')
@section('main')
<div class="container mt-5">
    <div class="row">
        <h5><i class="bi bi-plus-square-fill"></i> Update Sales</h5>
        <hr>
        <nav class="my-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('salesreport')}}" style="text-decoration:none;">Home</a></li>
                <li class="breadcrumb-item active">Update Sales</li>
            </ol>
        </nav>
        @if($saleedit)
        <form action="{{route('salesupdate',$saleedit->bill_no)}}" method="POST">
       {{csrf_field()}}
            <div class="card" style="border-color:black;">
                <div class="card-body" style="border-color:black;">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="customerid" class="form-label fw-bold">Customer ID:</label>
                            <a href="{{route('customerreport')}}" style="text-decoration:none;"><input type="text" name="customer_id" id="customerid" style="border-color:black;" class="form-control" value="{{$saleedit->customer_id}}"></a><br>
                        </div>
                        <div class="col-md-3">
                            <label for="bill" class="form-label fw-bold">Bill No:</label>
                            <input type="text" name="bill_no" id="bill" style="border-color:black;" class="form-control" value="{{$saleedit->bill_no}}" readonly><br>
                        </div>
                        <div class="col-md-3">
                            <label for="invoice">Invoice No:</label>
                            <input type="text" style="border-color:black;" name="invoice_no" id="invoice" class="form-control" value="{{$saleedit->invoice_no}}" readonly><br>
                        </div>
                        <div class="col-md-3">
                            <label for="date" class="form-label fw-bold">Sales Date:</label>
                            <input type="date" name="sales_date" id="date" style="border-color:black;" class="form-control" value="{{$saleedit->sales_date}}"><br>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="sub" class="form-label fw-bold">Sub Total:</label>
                            <input type="text" name="sub_total" id="sub" style="border-color:black;" class="form-control" value="{{$saleedit->sub_total}}" readonly><br>
                        </div>
                        <div class="col-md-3">
                            <label for="cgst" class="form-label fw-bold">CGST%:</label>
                            <input type="text" name="cgst" id="cgst" style="border-color:black;" class="form-control" value="{{$saleedit->cgst}}"><br>
                        </div>
                        <div class="col-md-3">
                            <label for="cgsta" class="form-label fw-bold">CGST Amount:</label>
                            <input type="text" name="cgst_amount" id="cgsta" style="border-color:black;" class="form-control" value="{{$saleedit->cgst_amount}}"><br>
                        </div>
                        <div class="col-md-3">
                        <label for="type" class="form-label fw-bold">Sales Type:</label>
                        <select class="form-select" aria-label="Default select example" style="border-color:black;" name="type">
  <option selected>Choose...</option>
  <option value="Bill To Bill">Bill To Bill</option>
  <option value="Bill To Cash">Bill To Cash</option>
</select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="sgst" class="form-label fw-bold">SGST%:</label>
                            <input type="text" name="sgst" id="sgst" style="border-color:black;" class="form-control" value="{{$saleedit->sgst}}"><br>
                        </div>
                        <div class="col-md-3">
                            <label for="sgsta" class="form-label fw-bold">SGST Amount:</label>
                            <input type="text" name="sgsta" id="sgsta" style="border-color:black;" class="form-control" value="{{$saleedit->sgst_amount}}"><br>
                        </div>
                        <div class="col-md-3">
                            <label for="dis" class="form-label fw-bold">Discount:</label>
                            <input type="text" name="dis" id="dis" style="border-color:black;" class="form-control" value="{{$saleedit->discount}}"><br>
                        </div>
                        <div class="col-md-3">
                            <label for="grand" class="form-label fw-bold">Grand Total:</label>
                            <input type="text" name="grand_total" style="border-color:black;" id="grand" class="form-control" value="{{$saleedit->grand_total}}"><br>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <p>Sales record not found.</p>
        @endif
            <div class="col-md-12 mt-4">
                <div class="card" style="border-color:black;">
                    <div class="card-body">
                        <table id="salesTable" class="display table table-bordered" style="width:100%;border-color:black;">
                            <thead>
                                <tr>
                                    <th>PRODUCT NAME</th>
                                    <th>PRODUCT CODE</th>
                                    <th>QUANTITY</th>
                                    <th>UNIT PRICE</th>
                                    <th>TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($saleedit1 as $sale)
                                        <tr>
                                        <td><select class='form-select name' name='product_name[]' style='border-color:black;'>
                                                <option value="{{$sale->product_name}}" selected>{{$sale->product_name}}</option>
                                                @foreach($product as $pro)
                                            <option value="{{$pro->product_name}}">{{$pro->product_name}}</option>
                                            @endforeach
                                        </select></td>
                                        <td><input type='text' style='border-color:black;' name='product_code[]' value='{{$sale->product_code}}' class='form-control code'></td>
                                        <td><input type='text' name='quantity[]' style='border-color:black;' value='{{$sale->quantity}}' class='form-control quantity'> <input type='hidden' name='quantity1[]' value="{{$sale->quantity}}" class='form-control quantity'></td>
                                        <td><input type='text' name='unit_price[]' style='border-color:black;' value='{{$sale->unit_price}}' class='form-control unit_price'></td>
                                        <td><input type='text' name='total[]' style='border-color:black;' value='{{$sale->total}}' class='form-control total' readonly></td>
                                        </tr>
                                        @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12 text-center mt-3">
                <button type="submit" class="btn btn-success">Update</button>
            </div>
            @method('GET')
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
    // Calculate totals when quantity or unit price changes
    $(document).on('input', '.quantity, .unit_price', function() {
        calculateRowTotal($(this).closest('tr'));
        calculateSubTotal();
        calculateGrandTotal();
    });
    // Calculate CGST amount
    $(document).on('input', '#cgst', function() {
        var subTotal = parseFloat($("#sub").val()) || 0;
        var cgstRate = parseFloat($(this).val()) || 0;
        var cgstAmount = (subTotal * cgstRate) / 100;
        $("#cgsta").val(cgstAmount.toFixed(2));
        calculateGrandTotal();
    });

    // Calculate SGST amount
    $(document).on('input', '#sgst', function() {
        var subTotal = parseFloat($("#sub").val()) || 0;
        var sgstRate = parseFloat($(this).val()) || 0;
        var sgstAmount = (subTotal * sgstRate) / 100;
        $("#sgsta").val(sgstAmount.toFixed(2));
        calculateGrandTotal();
    });

    // Recalculate grand total when discount changes
    $(document).on('input', '#dis', function() {
        calculateGrandTotal();
    });

    // Function to calculate the row total
    function calculateRowTotal(row) {
        var quantity = parseFloat(row.find('.quantity').val()) || 0;
        var unitPrice = parseFloat(row.find('.unit_price').val()) || 0;
        var total = quantity * unitPrice;
        row.find('.total').val(total.toFixed(2));
    }

    // Function to calculate the sub total
    function calculateSubTotal() {
        var subTotal = 0;
        $('.total').each(function() {
            subTotal += parseFloat($(this).val()) || 0;
        });
        $("#sub").val(subTotal.toFixed(2));
    }

    // Function to calculate the grand total
    function calculateGrandTotal() {
        var subTotal = parseFloat($("#sub").val()) || 0;
        var cgstAmount = parseFloat($("#cgsta").val()) || 0;
        var sgstAmount = parseFloat($("#sgsta").val()) || 0;
        var discount = parseFloat($("#dis").val()) || 0;
        var grandTotal = subTotal + cgstAmount + sgstAmount - discount;
        $("#grand").val(grandTotal.toFixed(2));
    }
    $(document).on('change', '.name', function(){
        var code = $(this).val();
        var row = $(this).closest('tr');
        if (code) {
            $.ajax({
                url: "{{ route('getsalescode') }}",
                method: "GET",
                data: { code: code },
                success: function(data) {
                    if (data) {
                        row.find('.code').val(data.product_code);
                    } else {
                        row.find('.code').val("");
                    }
                }
            });
        } else {
            row.find('.code').val("");
        }
    });

});
</script>
@endsection