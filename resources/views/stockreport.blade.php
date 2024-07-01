@include('layouts.app')
@section('main')
@extends('float')
@section('float')
<div class="container mt-5">
    <div class="row">
        <div class="d-flex justify-content-between">
            <h5><i class="bi bi-journal-richtext"></i> Products Details</h5>
            <a href="{{route('stockentry')}}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> New Products</a>
        </div>
        @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
        <div class="col-md-12 table-responsive mt-3">
            <table id="example" class="display table table-bordered" style="width:100%;border-color:black;">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Product Code</th>
                        <th>Description</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($san as $sun)
                    <tr>
                        <td>{{$sun->id}}</td>
                        <td><img src="/images/{{$sun->image}}" alt="images" style="width:50px; height: 50px; object-fit: contain;"></td>
                        <td>{{$sun->product_name}}</td>
                        <td>{{$sun->product_code}}</td>
                        <td>{{$sun->description}}</td>
                        <td>{{$sun->unit_price}}</td>
                        <td>{{$sun->quantity}}</td>
                        <td><a href="{{route('deleteproducts',$sun->id)}}" onclick="return confirm('Are you delete this item?')"><i class="bi bi-trash-fill h5"></i></a></td>
                        <td><a href="{{route('productedit',$sun->id)}}" onclick="return confirm('Are you edit this item?')"><i class="bi bi-pencil-square h5"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@endsection
