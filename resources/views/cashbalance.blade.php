@include('layouts.app')
@section('main')
@extends('float')
@section('float')
<div class="container mt-5">
        <div class="row">
            <div class="d-flex justify-content-between">
                <h5><i class="bi bi-journal-richtext"></i> Balance Report Details</h5>
                <a href="{{route('balancereport')}}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Balance</a>
            </div>
            <div class="col-md-12 table-responsive mt-3">
                <table id="myTable" class="table table-bordered">
                    <thead>
                        <tr>
                        <th>S.No</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Description</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $id = 1; @endphp
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $id++ }}</td>
                        <td>{{ $transaction->type }}</td>
                        <td>{{ $transaction->amount }}</td>
                        <td>{{ $transaction->description }}</td>
                        <td>{{ $transaction->date }}</td>
                    </tr>
                @endforeach
                    </tbody>
                </table>
            </div>
            <!-- row end -->
        </div>
        <!-- Container end -->
    </div>
    @endsection
    @endsection