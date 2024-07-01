@include('layouts.app')
@section('main')
@extends('float')
@section('float')

<div class="container mt-5">
    <div class="row">
        <div class="d-flex justify-content-between">
            <h5><i class="bi bi-journal-richtext"></i> Customer Details</h5>
            <a href="{{route('customerentry')}}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> New Customer</a>
        </div>
        @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
        <div class="col-md-12 table-responsive mt-3">
            <table id="example" class="display table table-bordered" style="width:100%;border-color:black;">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Customer_id</th>
                        <th>Customer Name</th>
                        <th>Customer Contact</th>
                        <th>Customer Address</th>
                        <th>Customer Email</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($san as $sun)
                    <tr>
                        <td>{{$sun->id}}</td>
                        <td>{{$sun->customer_id}}</td>
                        <td>{{$sun->name}}</td>
                        <td>{{$sun->contact}}</td>
                        <td>{{$sun->address}}</td>
                        <td>{{$sun->email}}</td>
                        <td><a href="{{route('deletecustomer',$sun->id)}}" onclick="return confirm('Are you delete this item?')"><i class="bi bi-trash-fill h5"></i></a></td>
                        <td><a href="{{route('customeredit',$sun->id)}}" onclick="return confirm('Are you edit this item?')"><i class="bi bi-pencil-square h5"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@endsection