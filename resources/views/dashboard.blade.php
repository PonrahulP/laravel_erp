@extends('layouts.app')
@section('main')
 <style>
            #blink {
                animation: blinker 1.5s linear infinite;
                text-color: red;
                font-family: sans-serif;
            }
            @keyframes blinker {
                50% {
                    opacity: 0.5;
                }
            }
        </style>
 
<!-- cards -->
<div class="row mt-3 align-baseline py-2">
  <div class="col-sm-3 mb-3 mb-sm-0 align-items-stretch">
    <div class="card text-bg-secondary mb-3 py-2">
      <div class="card-body">
        <h4 class="card-title"><i class="bi bi-cart-fill h3"></i></h4>
        <h5 class="card-text text-warning">Total Sales:<a id="blink" class="text-light" style="text-decoration:none;">
          {{$scount}}
          </a><br>
          Total Customers:<a id="blink" class="text-light" style="text-decoration:none;">
            {{$ccount}}
         </a>
        </h4>
        <hr>
        <a href="{{route('salesreport')}}" class="btn btn-primary"><i class="bi bi-journal-richtext"></i> Sales Report</a>
      </div>
    </div>
  </div>
  <div class="col-sm-3 align-items-stretch">
    <div class="card text-bg-secondary mb-3 py-2">
      <div class="card-body mh-100 d-inline-block">
        <h4 class="card-title mt-0"><i class="bi bi-bag-fill h3"></i></h4>
        <h5 class="card-text text-warning align-items-stretch">Total Purchase: <a id="blink" class="text-light" style="text-decoration:none;">   
          {{$pcount}}
       </a>
          <br>
           Total Suppliers:<a id="blink" class="text-light" style="text-decoration:none;">
            {{$sucount}}
          </a>
        </h5>
        <hr>
        <a href="{{route('purchasereport')}}" class="btn btn-primary"><i class="bi bi-journal-richtext"></i> Purchase Report</a>
      </div>
    </div>
  </div>
        <!-- </div> -->
        <!-- <div class="row mt-2"> -->

<div class="col-sm-3 mh-25 d-inline-block align-items-stretch">
    <div class="card text-bg-secondary mb-3 py-2">
  
      <div class="card-body mh-25 d-inline-block">
        <h4 class="card-title mt-0"> <i class="bi bi-bank2 h3"></i></h4>
        <h5 class="card-text text-warning py-0.2">Opening:<a id="blink" class="text-light" style="text-decoration:none;" href="{{route('registeruser')}}">
          <!-- <h5 id="blink"> -->
            {{$openingBalance->openbank}}
      </a><br>
          Current:<a class="text-light" id="blink" href="{{route('balancereport')}}" style="text-decoration:none;">
            {{$bank->amount}}
       </a>
        </h4>
        <hr>
        <a href="{{route('bankbalance')}}" class="btn btn-primary"><i class="bi bi-journal-richtext"></i> Balance Report</a>
      </div>
    </div>
  </div>
<div class="col-sm-3 mh-25 d-inline-block align-items-stretch">
    <div class="card text-bg-secondary mb-3 py-2">
      <div class="card-body mh-25 d-inline-block">
        <h4 class="card-title"><i class="bi bi-wallet2 h3"></i></h4>
        <h5 class="card-text text-warning align-items-stretch">Opening:<a id="blink" class="text-light" style="text-decoration:none;" href="{{route('registeruser')}}">
          {{$openingBalance->opencash}}
       </a><br>
          Current: <a id="blink" class="text-light"  href="{{route('balancereport')}}" style="text-decoration:none;">
            {{$cash->amount}}
        </a>
        </h4>
        <hr>
        <a href="{{route('cashbalance')}}" class="btn btn-primary"><i class="bi bi-journal-richtext"></i> Balance Report</a>
      </div>
    </div>
  </div>
<!-- </div> -->
        </div>
        </div>
<hr>
<div class="row">
  <div class="col-sm-4">
<div class="card" style="width: 25rem;border-color:black;">
  <div class="card-body">
    <h5 class="card-title" style="text-align:center;">Sales Graph</h5>
    <p class="card-text"><canvas id="myChart" width="5px" height="5px"></canvas></p>
  </div>
</div>
        </div>

<div class="card" style="width: 50rem;border-color:black;">
  <div class="card-body">
    <h5 class="card-title" style="text-align:center;">Sales Report</h5>
    <hr>
    <table class="table table-bordered" style="border-color:black;">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Customer Id</th>
                            <th>Bill.No</th>
                            <th>Product Name</th>
                            <th>Product Code</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Net Amount</th>
                        </tr>
                    </thead>
                    <tbody id="data">
                    @foreach($sales1 as $row)
                    @foreach($sales2 as $row1)
                      <tr>
                        <td>{{$loop->parent->index + 1}}</td>
                        <td>{{$row->customer_id}}</td>
                        <td>{{$row->bill_no}}</td>
                        <td>{{$row1->product_name}}</td>
                        <td>{{$row1->product_code}}</td>
                        <td>{{$row1->quantity}}</td>
                        <td>{{$row1->unit_price}}</td>
                        <td>{{$row->grand_total}}</td>
                      </tr>
                      @endforeach
                      @endforeach
                    </tbody>
                </table>
  </div>
</div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
        var labels = @json($labels);
        var data = @json($datas);
        
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar', // or 'line', 'pie', etc.
            data: {
                labels: labels,
                datasets: [{
                    label: 'QUANTITY',
                    data: data,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                legend: { display: false },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection

