@extends('layouts.app')
@section('main')
<div class="container mt-5">
        <div class="row">
            <h5><i class="bi bi-plus-square-fill"></i> Update Products</h5>
            <hr>
            <nav class="my-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('stockreport')}}" style="text-decoration:none;">Home</a></li>
                    <li class="breadcrumb-item active">Update Products</li>
                </ol>
            </nav>
            <div class="col-md-8">
                <form action="{{route('productupdate',$gan->id)}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row mb-3">
        
                        <div class="col-md-12">
                            <label for="name" class="form-label fw-bold">Product Name:</label>
                            <input type="text" name="name" id="name" style="border-color:black;" class="form-control" value="{{$gan->product_name}}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="code" class="form-label fw-bold">Product Code:</label>
                            <input type="text" name="code" id="code" style="border-color:black;" class="form-control" value="{{$gan->product_code}}">
                        </div>
                        <div class="col-md-6">
                        <div class="form-floating">
                        <textarea class="form-control" placeholder="Description" style="border-color:black;"
                        id="desc" name="desc" style="height: 100px">{{$gan->description}}</textarea>
                       <label for="desc">Description..</label>
                         </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="qty" class="form-label fw-bold">Quantity:</label>
                            <input type="text" name="qty" id="qty" style="border-color:black;" class="form-control" value="{{$gan->quantity}}">
                        </div>
                        <div class="col-md-6">
                            <label for="uprice" class="form-label fw-bold">Unit Price:</label>
                            <input type="text" name="uprice" id="uprice" style="border-color:black;" class="form-control" value="{{$gan->unit_price}}">
                        </div>
                    </div>
                   
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="cimage" class="form-label fw-bold">current Image:</label><br>
                            <img src="/images/{{$gan->image}}" style='width:50px; height: 50px; border-color:black;' >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="uimage" class="form-label fw-bold">current Image:</label>
                            <input type="file" name="uimage" class="form-control"  style="border-color:black;" ><br>
                        </div>
                    </div>
                    
                
                    <div class="mb-3">
                        <button type="submit" name="update" id="update" class="btn btn-success">Update Product</button>
                    </div>
                    @method('GET')

                </form>
            </div>
            <!-- row end -->
        </div>
        <!-- Container end -->
    </div>
    @endsection