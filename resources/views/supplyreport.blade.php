@include('layouts.app')
@section('main')
@extends('float')
@section('float')
<div class="container mt-5">
        <div class="row">
        
            <div class="d-flex justify-content-between">
                <h5><i class="bi bi-journal-richtext"></i> Suppliers Details</h5>
                <a href="{{route('supplyentry')}}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> New Suppliers</a>
            </div>
            @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
            <div class="col-md-12 table-responsive mt-3">
                <table id="myTable" class="table table-bordered" style="border-color:black;">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Supplier_id</th>
                            <th>Supplier Name</th>
                            <th>Supplier Contact</th>
                            <th>Supplier Address</th>
                            <th>Supplier Email</th>
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($san as $sun)
                    <tr>
                        <td>{{$sun->id}}</td>
                        <td>{{$sun->supplier_id}}</td>
                        <td>{{$sun->name}}</td>
                        <td>{{$sun->contact}}</td>
                        <td>{{$sun->address}}</td>
                        <td>{{$sun->email}}</td>
                        <td><a href="{{route('deletesuppliers',$sun->id)}}" onclick="return confirm('Are you delete this item?')"><i class="bi bi-trash-fill h5"></i></a></td>
                        <td><a href="{{route('supplyedit',$sun->id)}}" onclick="return confirm('Are you edit this item?')"><i class="bi bi-pencil-square h5"></i></a></td>
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