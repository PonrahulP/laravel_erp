@extends('layouts.app')
@section('main')
<div class="container mt-5">
        <div class="row">
            <h5><i class="bi bi-plus-square-fill"></i> Update Receipt</h5>
            <hr>
            <nav class="my-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="table.php" style="text-decoration:none;">Home</a></li>
                    <li class="breadcrumb-item active">Update Receipt</li>
                </ol>
            </nav>
            <div class="col-md-8">
                <form action="{{route('receiptupdate',$gan->bill_no)}}" method="POST">
                    {{csrf_field()}}
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="name" class="form-label fw-bold">Bill No:</label>
                            <input type="text" name="bill" id="bill" style="border-color:black;" class="form-control" value="{{$gan->bill_no}}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="date" class="form-label fw-bold">Date:</label>
                            <input type="date" name="date" id="date" style="border-color:black;" class="form-control" value="{{$gan->date}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                    <div class="col-md-3">
                            <label for="amnt" class="form-label fw-bold"> Total Amount:</label>
                            <input type="text" name="amnt" id="amnt" style="border-color:black;" class="form-control" value="{{$gan->total_amount}}">
                        </div>
                        <div class="col-md-3">
                            <label for="receive" class="form-label fw-bold">Received Amount:</label>
                            <input type="text" name="receive" id="receive" style="border-color:black;" class="form-control" value="{{$gan->amount}}">
                            <input type="hidden" name="receive1" id="receive1" class="form-control" value="{{$gan->amount}}">
                        </div>
                        <div class="col-md-3">
                            <label for="pend" class="form-label fw-bold">Pending Amount:</label>
                            <input type="text" name="pend" id="pend" style="border-color:black;" class="form-control" value="{{$gan->pending_amount}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="type" class="form-label fw-bold">Payment Type:</label>
                            <input type="text" name="type" id="type" style="border-color:black;" class="form-control" value="{{$gan->payment_type}}">
                        </div>
                    </div>
                
                    <div class="mb-3">
                        <button type="submit" name="update" id="update" class="btn btn-success">Update</button>
                    </div>
                    @method('GET')
                </form>
            </div>
            <!-- row end -->
        </div>
        <!-- Container end -->
    </div>
    <script>
$(document).ready(function() {
    $('#billno').on('change', function() {
        var billNo = $(this).val();
        if (billNo) {
            $.ajax({
                url: "{{ route('getsalesbills') }}",
                method: "GET",
                data: { bill_no: billNo },
                dataType: "json",
                success: function(data) {
                    if (data) {
                    $("#amnt").val(data.grand_total);
                    } else {
                        $("#amnt").val("");
                    }
                }
            });
        } else {
            $("#amnt").val("");
        }
    });


    $('#amnt, #receive').on('input', function() {
        var amnt = parseFloat($('#amnt').val()) || 0;
        var paid = parseFloat($('#receive').val()) || 0;
        var pend = amnt - paid;
        $('#pend').val(pend.toFixed(2));
    });
});
</script>
    @endsection