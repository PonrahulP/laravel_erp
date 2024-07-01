<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .invoice-container {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .table th, .table td {
            border: 1px solid #dee2e6;
        }
        .table thead th {
            background-color: #f1f1f1;
        }
        .summary-table td {
            border: none;
        }
        .company-logo {
            width: 100px;
        }
    </style>
</head>
<body>
    <div class="container invoice-container">
        <div class="row">
            <div class="col-md-6">
                @if($data)
                <img class="rounded-circle me-2" style="height: 75px; width: 75px;" src="/logo/{{$data->logo}}" alt="User-Profile-Image">
                @endif
                <h2>ERP</h2>
                <p>
                    AAA,<br>
                    BBB,<br>
                    CCC,<br>
                    Phone: 9876543210<br>
                    Email: erp@gmail.com
                </p>
            </div>
            <div class="col-md-6 text-right">
                <h4>Invoice</h4>
                <p>
                    @if($sales1)
                    <strong>Date:</strong> {{ $sales1->sales_date }}<br>
                    <strong>Invoice #:</strong> {{ $sales1->invoice_no }}
                    @endif
                </p>
                <h4>Customer Details</h4>
                <p>
                    @if($customer)
                    {{ $customer->name }}<br>
                    {{ $customer->address }}<br>
                    {{ $customer->contact }}<br>
                    {{ $customer->email }}
                    @endif
                </p>
            </div>
        </div>
        <table class="table table-bordered mt-4">
            <thead class="thead-dark">
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sales2 as $sale)
                <tr>
                    <td>{{ $sale->product_name ?? 'N/A' }}</td>
                    <td>{{ $sale->quantity ?? 'N/A' }}</td>
                    <td>Rs. {{ $sale->unit_price ?? 'N/A' }}</td>
                    <td>Rs. {{ $sale->total ?? 'N/A' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">No products found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <table class="table summary-table table table-bordered">
            @if($sales1)
            <tr>
                <td class="text-right"><strong>Subtotal:</strong></td>
                <td class="text-right">Rs. {{ $sales1->sub_total }}</td>
            </tr>
            <tr>
                <td class="text-right"><strong>CGST ({{ $sales1->cgst }}%):</strong></td>
                <td class="text-right">Rs. {{ $sales1->cgst_amount }}</td>
            </tr>
            <tr>
                <td class="text-right"><strong>SGST ({{ $sales1->sgst }}%):</strong></td>
                <td class="text-right">Rs. {{ $sales1->sgst_amount }}</td>
            </tr>
            <tr>
                <td class="text-right"><strong>Discount:</strong></td>
                <td class="text-right">Rs. {{ $sales1->discount }}</td>
            </tr>
            <tr>
                <td class="text-right"><strong>Grand Total:</strong></td>
                <td class="text-right">Rs. {{ $sales1->grand_total }}</td>
            </tr>
           
        </table>
        <p><strong>Amount in Words:@numberToWord({{ $sales1->grand_total }})</strong>  </p>
        @endif
        <div class="row mt-4">
            <div class="col-md-6">
                <p><strong>Signature:</strong> __________________________</p>
            </div>
        </div>
    </div>
</body>
</html>
