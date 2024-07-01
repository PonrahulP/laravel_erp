@extends('layouts.app')
  @section('main')
<div class="container mt-5">
        <div class="row">
            <h5><a href="{{route('balancereport')}}" style="text-decoration:none;"><i class="bi bi-journal-richtext"></i> Balance Report</a></h5>
            <hr>
            <nav class="my-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" style="text-decoration:none;">Home</a></li>
                    <li class="breadcrumb-item active">Add Balance </li>
                </ol>
            </nav>
            <div class="col-md-8">
                <form action="{{route('balanceinsert')}}" method="POST">
                @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                    {{csrf_field()}}

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="type" class="form-label fw-bold">Payment Type:</label>
                        <select class="form-select" name="type" id="type" style="border-color:black;" aria-label="Default select example">
                        <option selected>Payment Type</option>
                        <option value="Bank">Bank</option>
                        <option value="Cash">Cash</option>
                        </select>
                        <span class="text-danger">@error('type') {{$message}} @enderror</span>
                        </div>
                    </div>

                    <div class="row mb-3">
              
                        <div class="col-md-12">
                            <label for="amnt" class="form-label fw-bold">Amount:</label>
                            <input type="text" name="amnt" id="amnt" class="form-control" style="border-color:black;" placeholder="Enter Amount" value="{{old('amnt')}}">
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
