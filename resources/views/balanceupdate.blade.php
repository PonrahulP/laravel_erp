@extends('layouts.app')
@section('main')
<div class="container mt-5">
        <div class="row">
            <h5><i class="bi bi-plus-square-fill"></i> Update Bank Balance</h5>
            <hr>
            <nav class="my-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('balancereport')}}" style="text-decoration:none;">Home</a></li>
                    <li class="breadcrumb-item active">Update Bank Balance</li>
                </ol>
            </nav>
            <div class="col-md-8">
                <form action="{{route('balanceupdate',$gan->id)}}" method="POST">
                    {{csrf_field()}}
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="type" class="form-label fw-bold">Payment Type:</label>
                            <input type="text" name="type" id="type" style="border-color:black;" class="form-control" value="{{$gan->payment_type}}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        
                        <div class="col-md-12">
                            <label for="amnt" class="form-label fw-bold">Amount:</label>
                            <input type="text" name="amnt" id="amnt" style="border-color:black;" class="form-control" value="{{$gan->amount}}">
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