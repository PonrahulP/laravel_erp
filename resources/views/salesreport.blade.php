@include('layouts.app')
@section('main')
@extends('float')
@section('float')
<div class="container mt-5">
    <div class="row">
        <div class="d-flex justify-content-between">
            <h5><i class="bi bi-journal-richtext"></i> Sales Details</h5>
            <a href="{{route('salesentry')}}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> New Sales</a>
        </div>
        @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
        <div class="col-md-12 table-responsive mt-3">
            <table id="example" class="display table table-bordered" style="width:100%;border-color:black;">
                <thead>
                <tr>
                    <th>S.No</th>
                    <th>Bill.No</th>
                    <th>Customer ID</th>
                    <th>Total Amount</th>
                    <th>Sales Date</th>
                    <th>Delete</th>
                    <th>Edit</th>
                </tr>
                </thead>
                <tbody id="data">
                    @foreach($salesr as $rows)
                    <tr>
                        <td>{{$rows->id}}</td>
                        <td>{{$rows->bill_no}}</td>
                        <td>{{$rows->customer_id}}</td>
                        <td>{{$rows->grand_total}}</td>
                        <td>{{$rows->sales_date}}</td>
                        <td><a href="{{route('deletesales',$rows->bill_no)}}" onclick="return confirm('Are you delete this item?')"><i class="bi bi-trash-fill h5"></i></a></td>
                        <td><a href="{{route('salesedit',$rows->bill_no)}}" onclick="return confirm('Are you edit this item?')"><i class="bi bi-pencil-square h5"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@endsection