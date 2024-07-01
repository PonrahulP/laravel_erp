@extends('layouts.app')
@section('main')
<div class="container mt-5">
        <div class="row">
            <h5><a href="{{route('stockreport')}}" style="text-decoration:none;"><i class="bi bi-journal-richtext"></i> Stock Report</a></h5>
            <hr>
            <nav class="my-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" style="text-decoration:none;">Home</a></li>
                    <li class="breadcrumb-item active">Add Excel Stock</li>
                </ol>
            </nav>
        
            <div class="col-md-8">
                <form action="{{route('import')}}" method="POST" enctype="multipart/form-data">
                @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                    
                    {{csrf_field()}}
                    <div class="row mb-3">
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="excel" class="form-label">Stock Excel Upload</label>
                            <input type="file" name="excel" id="excel" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="submit" name="btn" id="btn" class="btn btn-success">Save Excel</button>
                    </div>
                    @method('GET')

                </form>
            </div>
            <!-- row end -->
        </div>
        <!-- Container end -->
    </div>
    @endsection