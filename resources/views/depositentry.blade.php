@extends('layouts.app')
@section('main')
<div class="container mt-5">
        <div class="row">
            <h5><a href="{{route('depositreport')}}" style="text-decoration:none;"><i class="bi bi-journal-richtext"></i> Cash To Bank Report</a></h5>
            <hr>
            <nav class="my-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" style="text-decoration:none;">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('balancereport')}}" style="text-decoration:none;">Balance</a></li>
                    <li class="breadcrumb-item active">Add Cash To Bank </li>
                </ol>
            </nav>
            <div class="col-md-8">
                <form action="{{route('depositinsert')}}" method="POST">
                @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                    {{csrf_field()}}

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="name" class="form-label fw-bold"> Bank Name:</label>
                            <input type="text" name="name" id="name" class="form-control" style="border-color:black;" placeholder="Enter Bank Name" value="{{old('name')}}">
                            <span class="text-danger">@error('name') {{$message}} @enderror</span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="date" class="form-label fw-bold">Date:</label>
                            <input type="date" name="date" id="date" class="form-control" style="border-color:black;" value="<?php echo date('Y-m-d'); ?>">
                            <span class="text-danger">@error('date') {{$message}} @enderror</span>
                        </div>
                        <div class="col-md-6">
                            <label for="amnt" class="form-label fw-bold">Amount:</label>
                            <input type="text" name="amnt" id="amnt" style="border-color:black;" class="form-control" placeholder="Enter Amount" value="{{old('amnt')}}">
                            <span class="text-danger">@error('amnt') {{$message}} @enderror</span>
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