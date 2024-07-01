@extends('layouts.app')
@section('main')
<div class="container mt-5">
        <div class="row">
            <h5><a href="{{route('stockreport')}}" style="text-decoration:none;"><i class="bi bi-journal-richtext"></i> Products Report</a></h5>
            <hr>
            <nav class="my-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" style="text-decoration:none;">Home</a></li>
                    <li class="breadcrumb-item active">Add Products</li>
                </ol>
            </nav>
            <div class="col-md-8">
                <form action="{{route('index1')}}" method="POST" enctype="multipart/form-data">
                @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                    {{csrf_field()}}
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="name" class="form-label fw-bold">Product Name:</label>
                            <input type="text" name="name" id="name" class="form-control" style="border-color:black;" placeholder="Enter Product Name" value="{{old('name')}}">
                            <span class="text-danger">@error('name') {{$message}} @enderror</span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="code" class="form-label fw-bold">Product Code:</label>
                            <input type="text" name="code" id="code" class="form-control" style="border-color:black;" placeholder="Enter Product code" value="{{old('code')}}">
                            <span class="text-danger">@error('code') {{$message}} @enderror</span>
                        </div>
                        <div class="col-md-6">
                        <div class="form-floating">
                        <textarea class="form-control" style="border-color:black;" placeholder="Description" 
                        id="desc" name="desc" style="height: 100px" value="{{old('desc')}}"></textarea>
                       <label for="desc" >Description..</label>
                       <span class="text-danger">@error('desc') {{$message}} @enderror</span>
                         </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="qty" class="form-label fw-bold">Quantity:</label>
                            <input type="text" name="qty" id="qty" class="form-control" style="border-color:black;" placeholder="Enter Product Quantity" value="{{old('qty')}}">
                            <span class="text-danger">@error('qty') {{$message}} @enderror</span>
                        </div>
                        <div class="col-md-6">
                            <label for="uprice" class="form-label fw-bold">Unit Price:</label>
                            <input type="text" name="uprice" id="uprice" style="border-color:black;" class="form-control" placeholder="Enter Unit Price" value="{{old('uprice')}}">
                            <span class="text-danger">@error('uprice') {{$message}} @enderror</span>
                        </div>
                    </div>
                   
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="image" class="form-label fw-bold">Product Image:</label>
                            <input type="file" name="image" id="image" class="form-control" style="border-color:black;" value="{{old('image')}}">
                            <span class="text-danger">@error('image') {{$message}} @enderror</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="submit" name="btn" id="btn" class="btn btn-success">Save Product</button>
                    </div>
                    @method('GET')

                </form>
            </div>
            <!-- row end -->
        </div>
        <!-- Container end -->
    </div>
    @endsection