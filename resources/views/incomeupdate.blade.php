@extends('layouts.app')
@section('main')
<div class="container mt-5">
        <div class="row">
            <h5><i class="bi bi-plus-square-fill"></i> Update Income</h5>
            <hr>
            <nav class="my-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('incomereport')}}" style="text-decoration:none;">Home</a></li>
                    <li class="breadcrumb-item active">Update Income</li>
                </ol>
            </nav>
            <div class="col-md-8">
                <form action="{{route('incomeupdate',$gan->id)}}" method="POST">
                    {{csrf_field()}}
                    
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="name" class="form-label fw-bold">Name:</label>
                            <input type="text" name="name" id="name" style="border-color:black;" class="form-control" value="{{$gan->name}}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="date" class="form-label fw-bold">Date:</label>
                            <input type="date" name="date" id="date" style="border-color:black;" class="form-control" value="{{$gan->date}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                    <div class="col-md-6">
                            <label for="amnt" class="form-label fw-bold">Amount:</label>
                            <input type="text" name="amnt" id="amnt" style="border-color:black;" class="form-control" value="{{$gan->amount}}">
                        </div>
                        <div class="col-md-6">
                            <!-- <label for="amnth" class="form-label">Amount</label> -->
                            <input type="hidden" name="amnth" id="amnth" class="form-control" value="{{$gan->amount}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="payment" class="form-label fw-bold">Payment Type:</label><br>
                            <input type="radio" name="payment" id="cash" style="border-color:black;" value="cash">
                            <label for="payment" class="form-label fw-bold">Cash</label>
                            <input type="radio" name="payment" id="bank" style="border-color:black;" value="bank">
                            <label for="payment" class="form-label fw-bold">Bank</label>
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