@extends('float')
@section('float')
@extends('layouts.app')
@section('main')
<div class="container mt-5">
        <div class="row">
            <div class="d-flex justify-content-between">
                <h5><i class="bi bi-journal-richtext"></i> Bill  To Cash Details</h5>
                <!-- <a href="index.php" class="btn btn-primary"><i class="bi bi-plus-circle"></i> New Sales</a> -->
            </div>
            <div class="col-md-12 table-responsive mt-3">
                <table id="myTable" class="table table-bordered" style="border-color:black;">
                    <thead>
                        <tr>
                        <th>S.No</th>
                            <th>Customer</th>
                            <th>Bill.No</th>
                            <th>Date</th>
                            <th>Quantity</th>
                            <th>CGST%</th>
                            <th>CGST Amount</th>
                            <th>SGST%</th>
                            <th>SGST Amount</th>
                            <th>Total Amount</th>
                        </tr>
                    </thead>
                    <tbody id="data">
                    @foreach($cs as $row)
                    @foreach($css as $row1)
                      <tr>
                        <td>{{$loop->parent->index + 1}}</td>
                        <td>{{$row->customer_id}}</td>
                        <td>{{$row->bill_no}}</td>
                        <td>{{$row->sales_date}}</td>
                        <td>{{$row1->quantity}}</td>
                        <td>{{$row->cgst}}</td>
                        <td>{{$row->cgst_amount}}</td>
                        <td>{{$row->sgst}}</td>
                        <td>{{$row->sgst_amount}}</td>
                        <td>{{$row->grand_total}}</td>
                      </tr>
                      @endforeach
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