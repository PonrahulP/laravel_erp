@extends('layouts.app')
@section('main')
<div class="container mt-5">
        <div class="row">
            <h5><i class="bi bi-plus-square-fill"></i> Update Customer</h5>
            <hr>
            <nav class="my-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('customerreport')}}" style="text-decoration:none;">Home</a></li>
                    <li class="breadcrumb-item active">Update Customer</li>
                </ol>
            </nav>
            <div class="col-md-8">
                <form action="{{route('customerupdate',$gan->id)}}" method="POST">
                    {{csrf_field()}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="id" class="form-label fw-bold">Customer Id:</label>
                            <input type="text" name="id" id="id" style="border-color:black;" class="form-control" value="{{$gan->customer_id}}">
                        </div>
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-bold">Customer Name:</label>
                            <input type="text" name="name" id="name" style="border-color:black;" class="form-control" value="{{$gan->name}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="contact" class="form-label fw-bold">Contact:</label>
                            <input type="text" name="contact" id="contact" style="border-color:black;" class="form-control" value="{{$gan->contact}}">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label fw-bold">Customer Email:</label>
                            <input type="text" name="email" id="email" style="border-color:black;" class="form-control" value="{{$gan->email}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                    <div class="col-md-12">
                            <label for="address" class="form-label fw-bold">Address:</label>
                            <input type="text" name="address" id="address" style="border-color:black;" class="form-control" value="{{$gan->address}}">
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
    @endsection