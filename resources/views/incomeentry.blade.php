@extends('layouts.app')
@section('main')
<div class="container mt-5">
        <div class="row">
            <h5><a href="{{route('incomereport')}}" style="text-decoration:none;"><i class="bi bi-journal-richtext"></i> Income Report</a></h5>
            <hr>
            <nav class="my-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" style="text-decoration:none;">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('balancereport')}}" style="text-decoration:none;">Balance</a></li>
                    <li class="breadcrumb-item active">Add Income</li>
                </ol>
            </nav>
            <div class="col-md-8">
                <form action="{{route('incomeinsert')}}" method="POST">
                @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                    {{csrf_field()}}
                    <div class="row mb-3">
                        <div class="col-md-12">
                        <label for="name" class="form-label fw-bold">Name:</label>
                        <input list="browsers" class="form-control" name="name" style="border-color:black;" id="name" value="{{old('name')}}">

                        <datalist id="browsers">
                        <option value="Rahul">
                        <option value="Subbru">
                        <option value="Ponraj">
                        <option value="Sankavi">
                        <option value="Raja">
                        </datalist>
                        <span class="text-danger">@error('name') {{$message}} @enderror</span>

                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="date" class="form-label fw-bold">Date:</label><br>
                            <input type="date" name="date" id="date" class="form-control" style="border-color:black;" value="<?php echo date('Y-m-d'); ?>" >
                            <span class="text-danger">@error('date') {{$message}} @enderror</span>
                        </div>
                        <div class="col-md-6">
                            <label for="amnt" class="form-label fw-bold">Amount:</label>
                            <input type="text" name="amnt" id="amnt" class="form-control" style="border-color:black;" placeholder="Enter Amount" value="{{old('amnt')}}">
                            <span class="text-danger">@error('amnt') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="payment" class="form-label fw-bold">Payment Type:</label><br>
                            <input type="radio" name="payment" id="payment"  value="cash">
                            <label for="payment" class="form-label fw-bold">Cash</label>
                            <input type="radio" name="payment" id="payment" value="bank">
                            <label for="payment" class="form-label fw-bold">Bank</label>
                            <span class="text-danger">@error('payment') {{$message}} @enderror</span>
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