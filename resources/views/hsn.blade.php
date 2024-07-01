@extends('float')
@section('float')
@extends('layouts.app')
@section('main')
<div class="container mt-5">
        <div class="row">
            <div class="d-flex justify-content-between">
                <h5><i class="bi bi-journal-richtext"></i> HSN Details</h5>
                <!-- <a href="index.php" class="btn btn-primary"><i class="bi bi-plus-circle"></i> New Sales</a> -->
            </div>
            <div class="col-md-12 table-responsive mt-3">
                <table id="myTable" class="table table-bordered" style="border-color:black;">
                    <thead>
                        <tr>
                        <th>S.No</th>
                            <th>Product Code</th>
                            <th>CGST%</th>
                            <th>CGST Amount</th>
                            <th>SGST%</th>
                            <th>SGST Amount</th>
                        </tr>
                    </thead>
                    <tbody id="data">
                    @foreach ($salesData as $sale)
            <tr>
                <td>{{ $sale->id }}</td>
                <td>{{ $sale->product_code }}</td>
                <td>{{ $sale->cgst }}</td>
                <td>{{ $sale->cgst_amount }}</td>
                <td>{{ $sale->sgst }}</td>
                <td>{{ $sale->sgst_amount }}</td>
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