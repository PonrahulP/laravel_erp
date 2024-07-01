@extends('layouts.app')
@section('main')
<div class="container mt-5">
        <div class="row">
            <h5><i class="bi bi-plus-square-fill"></i> <a href="{{route('expensereport')}}" style="text-decoration:none;">Expenses Report</a></h5>
            <hr>
            <nav class="my-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" style="text-decoration:none;">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('balancereport')}}" style="text-decoration:none;">Balance</a></li>
                    <li class="breadcrumb-item active">Add Expenses</li>
                </ol>
            </nav>
            <div class="col-md-8">
                <form action="{{route('expenseinsert')}}" method="POST">
                @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                    {{csrf_field()}}
                    <div class="row mb-3">
                    <div class="input-group mb-3">
                     <label class="input-group-text fw-bold" for="inputGroupSelect01" style="border-color:black;">Expenses Type</label>
                     <select class="form-select" id="inputGroupSelect01" name="type" value="{{old('type')}}" style="border-color:black;">
                     <option selected>Choose...</option>
                      <option value="Office">Office</option>
                      <option value="Salary">Salary</option>
                       <option value="Rent">Rent</option>
                     </select>
                     <span class="text-danger">@error('type') {{$message}} @enderror</span>
                      </div> 

                    </div>

                    <label for="browser" class="form-label fw-bold">Expensers Name:</label><br>
                    <input list="browsers" class="form-control" name="name" id="name" value="{{old('name')}}" style="border-color:black;">
                   <datalist id="browsers">
                    <option value=" Rahul">
                    <option value="Subbru">
                   <option value="Raja">
                  <option value="Ponraj">
                  <option value="Sangu">
                   </datalist>
                   <span class="text-danger">@error('name') {{$message}} @enderror</span>

                     <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="date" class="form-label fw-bold">Date:</label>
                            <input type="date" name="date" id="date" class="form-control" style="border-color:black;" value="<?php echo date('Y-m-d'); ?>">
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