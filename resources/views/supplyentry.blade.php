@extends('layouts.app')
@section('main')
<div class="container mt-5">
        <div class="row">
            <h5><a href="{{route('supplyreport')}}" style="text-decoration:none;"><i class="bi bi-journal-richtext"></i> Supplier Report</a></h5>
            <hr>
            <nav class="my-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" style="text-decoration:none;">Home</a></li>
                    <li class="breadcrumb-item active">Add Suppliers</li>
                </ol>
            </nav>
            <div class="col-md-8">
                <form action="{{route('supplyinsert')}}" method="POST">
                    @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                    {{csrf_field()}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="id" class="form-label fw-bold">Supplier Id:</label>
                            <input type="text" name="id" id="id" class="form-control" style="border-color:black;" value="{{old('id')}}" placeholder="Enter Supplier Id">
                            <span class="text-danger">@error('id') {{$message}} @enderror</span>
                        </div>
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-bold">Supplier Name:</label>
                            <input type="text" name="name" id="name" style="border-color:black;" class="form-control" value="{{old('name')}}" placeholder="Enter Supplier Name">
                            <span class="text-danger">@error('name') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="contact" class="form-label fw-bold">Contact:</label>
                            <input type="text" name="contact" id="contact" style="border-color:black;" value="{{old('contact')}}" class="form-control" placeholder="Enter Supplier Contact">
                            <span class="text-danger">@error('contact') {{$message}} @enderror</span>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label fw-bold">Supplier Email:</label>
                            <input type="text" name="email" id="email" style="border-color:black;" value="{{old('email')}}" class="form-control" placeholder="Enter Supplier Email">
                            <span class="text-danger">@error('email') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                    <div class="col-md-12">
                            <label for="address" class="form-label fw-bold">Address:</label>
                            <input type="text" name="address" id="address" value="{{old('address')}}" style="border-color:black;" class="form-control" placeholder="Enter Supplier Address">
                            <span class="text-danger">@error('address') {{$message}} @enderror</span>
                        </div>
                    </div>


                   
                    
                    <div class="mb-3">
                        <button type="submit" name="btn" id="btn" class="btn btn-success">Save</button>
                    </div>
                    @method('GET')

                </form>
            </div>
            <!-- row end -->
        </div>
        <!-- Container end -->
    </div>
    @endsection