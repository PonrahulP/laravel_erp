@include('layouts.app')
@section('main')
@extends('float')
@section('float')
<div class="container mt-5">
        <div class="row">
            <div class="d-flex justify-content-between">
                <h5><i class="bi bi-journal-richtext"></i> Payment Details</h5>
                <a href="{{route('paymententry')}}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> New Payment</a>
            </div>
            @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
            <div class="col-md-12 table-responsive mt-3">
                <table id="myTable" class="table table-bordered" style="border-color:black;">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Bill No</th>
                            <th>Date</th>
                            <th>Total Amount</th>
                            <th>Paid Amount</th>
                            <th>Pending Amount</th>
                            <th>Payment Type</th>
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody id="data">
                    @foreach($san as $sun)
                    <tr>
                        <td>{{$sun->id}}</td>
                        <td>{{$sun->bill_no}}</td>
                        <td>{{$sun->date}}</td>
                        <td>{{$sun->total_amount}}</td>
                        <td>{{$sun->amount}}</td>
                        <td>{{$sun->pending_amount}}</td>
                        <td>{{$sun->payment_type}}</td>
                        <td><a href="{{route('deletepayment',$sun->bill_no)}}" onclick="return confirm('Are you delete this item?')"><i class="bi bi-trash-fill h5"></i></a></td>
                        <td><a href="{{route('paymentedit',$sun->bill_no)}}" onclick="return confirm('Are you edit this item?')"><i class="bi bi-pencil-square h5"></i></a></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- row end -->
        </div>
        <!-- Container end -->
    </div>
    @endsection
    @endsection