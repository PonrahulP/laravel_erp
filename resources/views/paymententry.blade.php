@extends('layouts.app')
@section('main')
<div class="container mt-5">
    <div class="row">
        <h5><a href="{{route('paymentreport')}}" style="text-decoration:none;"><i class="bi bi-journal-richtext"></i> Payment Report</a></h5>
        <hr>
        <nav class="my-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}" style="text-decoration:none;">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('balancereport')}}" style="text-decoration:none;">Balance</a></li>
                <li class="breadcrumb-item active">Add Payment</li>
            </ol>
        </nav>
        <div class="col-md-8">
            <form action="{{route('paymentinsert')}}" method="POST">
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
                       
                        <select name="billno" id="billno" class="form-control billno" style="border-color:black;" value="{{old('billno')}}">
                            <option>Select..</option>
                            @foreach($bill as $row)
                            <option value="{{$row->bill_no}}">{{$row->bill_no}}</option>
                            @endforeach
                          
                        </select>
                        <a href="{{route('purchaseentry')}}" style="text-decoration:none;">Add Purchase</a>
                        <span class="text-danger">@error('billno') {{$message}} @enderror</span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="date" class="form-label fw-bold">Date:</label>
                        <input type="date" name="date" id="date" class="form-control" style="border-color:black;" value="<?php echo date('Y-m-d'); ?>">
                        <span class="text-danger">@error('date') {{$message}} @enderror</span>
                    </div>
                    <div class="col-md-6">
                        <label for="amnt" class="form-label fw-bold">Total Amount:</label>
                        <input type="text" name="amnt" id="amnt" class="form-control" style="border-color:black;" placeholder="Enter Total Amount" readonly value="{{old('amnt')}}">
                        <span class="text-danger">@error('amnt') {{$message}} @enderror</span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="paid" class="form-label fw-bold">Paid Amount:</label>
                        <input type="text" name="paid" id="paid" class="form-control" style="border-color:black;" placeholder="Enter Paid Amount" value="{{old('paid')}}">
                        <span class="text-danger">@error('paid') {{$message}} @enderror</span>
                    </div>
                    <div class="col-md-6">
                        <label for="pend" class="form-label fw-bold">Pending Amount:</label>
                        <input type="text" name="pend" id="pend" class="form-control" style="border-color:black;" placeholder="Enter Pending Amount" value="{{old('pend')}}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                    <label for="pend" class="form-label fw-bold">Payment Type:</label>
                        <select class="form-select" name="type" id="type" aria-label="Default select example" style="border-color:black;" >
                            <option selected>Payment Type</option>
                            <option value="Bank">Bank</option>
                            <option value="Cash">Cash</option>
                        </select>
                        <span class="text-danger">@error('type') {{$message}} @enderror</span>
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
                url: "{{ route('getpurchasebills') }}",
                method: "get",
                data: { bill_no: billNo },
                dataType: "json",
                success: function(data) {
                    if (data) {
                    $("#amnt").val(data.total);
                    } else {
                        $("#amnt").val("");
                    }
                }
            });
        } else {
            $("#amnt").val("");
        }
    });
    $('#amnt, #paid').on('input', function() {
        var amnt = parseFloat($('#amnt').val()) || 0;
        var paid = parseFloat($('#paid').val()) || 0;
        var pend = amnt - paid;
        $('#pend').val(pend.toFixed(2));
    });
});
</script>
@endsection
