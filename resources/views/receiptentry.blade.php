@extends('layouts.app')
@section('main')
<div class="container mt-5">
    <div class="row">
        <h5><a href="{{route('receiptreport')}}" style="text-decoration:none;"><i class="bi bi-journal-richtext"></i> Receipt Report</a></h5>
        <hr>
        <nav class="my-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}" style="text-decoration:none;">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('balancereport')}}" style="text-decoration:none;">Balance</a></li>
                <li class="breadcrumb-item active">Add Receipt</li>
            </ol>
        </nav>
        <div class="col-md-8">
            <form action="{{route('receiptinsert')}}" method="POST">
            @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                {{csrf_field()}}
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="bill" class="form-label fw-bold">Bill No:</label>
                        <select name="billno" id="billno" class="form-control" style="border-color:black;">
                            <option>Select..</option>
                            @foreach($bill as $row)
                            <option value="{{$row->bill_no}}">{{$row->bill_no}}</option>
                            @endforeach
                        </select>
                        <a href="{{route('salesentry')}}" style="text-decoration:none;">Add Sales</a>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="date" class="form-label fw-bold">Date:</label>
                        <input type="date" name="date" id="date" class="form-control" style="border-color:black;" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="amnt" class="form-label fw-bold">Total Amount:</label>
                        <input type="text" name="amnt" id="amnt" class="form-control" style="border-color:black;" placeholder="Enter Total Amount" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="receive" class="form-label fw-bold">Received Amount:</label>
                        <input type="text" name="receive" id="receive" style="border-color:black;" class="form-control" placeholder="Enter Received Amount">
                    </div>
                    <div class="col-md-6">
                        <label for="pend" class="form-label fw-bold">Pending Amount:</label>
                        <input type="text" name="pend" id="pend" class="form-control" style="border-color:black;" placeholder="Enter Pending Amount">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                    <label for="pend" class="form-label fw-bold">Payment Type:</label>
                        <select class="form-select" name="type" id="type" style="border-color:black;" aria-label="Default select example">
                            <option selected>Payment Type</option>
                            <option value="Bank">Bank</option>
                            <option value="Cash">Cash</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" name="btn" id="btn" class="btn btn-success">Save</button>
                </div>
                @method('GET')
            </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#billno').on('change', function() {
        var billNo = $(this).val();
        // console.log('hi');
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
