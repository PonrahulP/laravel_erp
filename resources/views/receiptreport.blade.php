@include('layouts.app')
@section('main')
@extends('float')
@section('float')
<div class="container mt-5">
        <div class="row">
            <div class="d-flex justify-content-between">
                <h5><i class="bi bi-journal-richtext"></i> Receipt Details</h5>
                <a href="{{route('receiptentry')}}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> New Receipt</a>
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
                            <th>Received Amount</th>
                            <th>Pending Amount</th>
                            <th>Payment Type</th>
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody id="data">
                        @foreach($rec as $row)
                        <tr>
                            <td>{{$row->id}}</td>
                            <td>{{$row->bill_no}}</td>
                            <td>{{$row->date}}</td>
                            <td>{{$row->total_amount}}</td>
                            <td>{{$row->amount}}</td>
                            <td>{{$row->pending_amount}}</td>
                            <td>{{$row->payment_type}}</td>
                            <td><a href="{{route('deletereceipt',$row->bill_no)}}" onclick="return confirm('Are you delete this item?')"><i class="bi bi-trash-fill h5"></i></a></td>
                        <td><a href="{{route('receiptedit',$row->bill_no)}}" onclick="return confirm('Are you edit this item?')"><i class="bi bi-pencil-square h5"></i></a></td>

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