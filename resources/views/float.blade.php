<div class="float-start mt-5 ms-2">
<a href="{{route('stockreport')}}"><div class="shadow p-2 mb-2 bg-body-tertiary rounded text-danger"><i class="bi bi-box-fill h5"></i><br> Stock </div></a>
<a href="{{route('salesreport')}}"><div class="shadow p-2 mb-2 bg-body-tertiary rounded text-danger"><i class="bi bi-cart-plus-fill h5"></i><br> Sales </div></a>
<a href="{{route('purchasereport')}}"><div class="shadow p-2 mb-2 bg-body-tertiary rounded text-danger"><i class="bi bi-bag-check-fill h5"></i><br> Purchase </div></a>
<a href="{{route('dashboard')}}"><div class="shadow p-2 mb-2 bg-body-tertiary rounded text-danger"><i class="bi bi-house-door-fill h5"></i><br> Report</div></a>
<a href="{{route('excel')}}"><div class="shadow p-2 mb-2 bg-body-tertiary rounded text-danger"><i class="bi bi-arrow-down-circle-fill h5"></i><br> Excel </div></a>
<a href=""><div class="shadow p-2 mb-2 bg-body-tertiary rounded text-danger"><i class="bi bi-download"></i><br> Download</div></a>
</div>
@yield('float')
