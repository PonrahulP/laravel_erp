@include('layouts.app')
@section('main')
@extends('float')
@section('float')
<div class="container mt-5">
        <div class="row">
            <h5><a href="{{route('purchasereport')}}"><i class="bi bi-journal-richtext"></i> Purchase Report</a></h5>
            <hr>
            <nav class="my-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Add Purchase</li>
                </ol>
            </nav>
            <div class="col-md-8">
               <img class="img-fluid" src="../images/{{$bills->bill_img}}" alt="image">
        </div>
        </div>
        </div>
@endsection
@endsection