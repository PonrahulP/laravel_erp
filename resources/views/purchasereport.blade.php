@include('layouts.app')
@section('main')
@extends('float')
@section('float')
<div class="container mt-5">
        <div class="row">
            <div class="d-flex justify-content-between">
                <h5><i class="bi bi-journal-richtext"></i> Purchase Details</h5>
                <a href="{{route('purchaseentry')}}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> New Purchase</a>
            </div>
            @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
            <div class="col-md-12 table-responsive mt-3">
                <table id="myTable" class="table table-bordered" style="border-color:black;">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Bill Image</th>
                            <th>Bill.No</th>
                            <th>Supplier_id</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>CGST%</th>
                            <th>SGST%</th>
                            <th>Total Amount</th>
                            <!-- <th>Payment Type</th> -->
                            <th>Purchase Date</th>
                            <th>Delete</th>
                            <th>Bill</th>
                        </tr>
                    </thead>
                    <tbody id="data">
                        @foreach($p1 as $row)
                        @foreach($p2 as $row1)
                        <tr>
                            <td>{{$loop->parent->index + 1}}</td>
                            <td><img src="/images/{{$row->bill_img}}" alt="image" style='width:50px; height: 50px; object-fit: contain;'></td>
                            <td>{{$row->bill_no}}</td>
                            <td>{{$row->supplier_id}}</td>
                            <td>{{$row1->product_code}}</td>
                            <td>{{$row1->product_name}}</td>
                            <td>{{$row1->quantity}}</td>
                            <td>{{$row1->unit_price}}</td>
                            <td>{{$row1->cgst}}</td>
                            <td>{{$row1->sgst}}</td>
                            <td>{{$row1->total}}</td>
                            <td>{{$row->purchase_date}}</td>
                            <td><a href="{{route('deletepurchase',$row->bill_no)}}" onclick="return confirm('Are you delete this item?')"><i class="bi bi-trash-fill h5"></i></a></td>
                            <td><a href="{{route('billedit',$row->bill_no)}}" onclick="return confirm('Are you view this bill?')"><i class="bi bi-pencil-square h5"></i></a></td>
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