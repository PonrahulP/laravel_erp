@include('layouts.app')
@section('main')
@extends('float')
@section('float')
<div class="container mt-5">
        <div class="row">
            <div class="d-flex justify-content-between">
                <h5><i class="bi bi-journal-richtext"></i> Cash To Bank Details</h5>
                <a href="{{route('depositentry')}}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> New Cash To Bank</a>
            </div>
            @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
            <div class="col-md-12 table-responsive mt-3">
                <table id="myTable" class="table table-bordered" style="border-color:black;">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Bank Name</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody id="data">
                    @foreach($san as $sun)
                    <tr>
                        <td>{{$sun->id}}</td>
                        <td>{{$sun->bank_name}}</td>
                        <td>{{$sun->date}}</td>
                        <td>{{$sun->amount}}</td>
                        <td><a href="{{route('deletedeposit',$sun->id)}}" onclick="return confirm('Are you delete this item?')"><i class="bi bi-trash-fill h5"></i></a></td>
                        <td><a href="{{route('depositedit',$sun->id)}}" onclick="return confirm('Are you edit this item?')"><i class="bi bi-pencil-square h5"></i></a></td>
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