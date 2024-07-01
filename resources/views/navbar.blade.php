
<nav class="navbar  bg-primary">
  <div class="container-fluid d-flex align-items-center">
    <img class="rounded-circle me-2" style="height: 75px; width: 75px;" src="/logo/{{$data->logo}}" alt="User-Profile-Image">
    <a class="navbar-brand h1">SmartConnect ERP <i class="bi bi-emoji-heart-eyes"></i></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end " style="background-color: #e3f2fd;" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Dashboard Menu</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
        <li class="nav-item">
         <a class="nav-link active text-dark fw-bold" aria-current="page" href="{{route('dashboard')}}"><i class="bi bi-house h5"></i> Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-fill"></i> Customer
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="{{route('customerentry')}}"><i class="bi bi-plus-square-fill"></i> New Entry</a></li>
              <li><a class="dropdown-item" href="{{route('customerreport')}}"><i class="bi bi-journal-richtext"></i> Report</a></li>
            </ul>
          </li>
         
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-box-fill h5"></i> Stock
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="{{route('stockentry')}}"><i class="bi bi-plus-square-fill"></i> New Entry</a></li>
              <li><a class="dropdown-item" href="{{route('stockreport')}}"><i class="bi bi-journal-richtext"></i> Report</a></li>
              <li><a class="dropdown-item" href="{{route('excel')}}"><i class="bi bi-file-earmark-excel"></i> Import Excel</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-cart-plus-fill h5"></i> Sales
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="{{route('salesentry')}}"><i class="bi bi-plus-square-fill"></i> New Entry</a></li>
              <li><a class="dropdown-item" href="{{route('salesreport')}}"><i class="bi bi-journal-richtext"></i> Report</a></li>
            </ul>
          </li>
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-fill-check h5"></i> Suppliers
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="{{route('supplyentry')}}"><i class="bi bi-plus-square-fill"></i> New Entry</a></li>
              <li><a class="dropdown-item" href="{{route('supplyreport')}}"><i class="bi bi-journal-richtext"></i> Report</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-bag-plus-fill h5"></i> Purchase
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="{{route('purchaseentry')}}"><i class="bi bi-plus-square-fill"></i> New Entry</a></li>
              <li><a class="dropdown-item" href="{{route('purchasereport')}}"><i class="bi bi-journal-richtext"></i> Report</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-wallet-fill h5"></i> Transactions
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="{{route('expenseentry')}}"><i class="bi bi-coin"></i> Expenses</a></li>
              <li><a class="dropdown-item" href="{{route('incomeentry')}}"><i class="bi bi-currency-rupee"></i> Income</a></li>
              <li><a class="dropdown-item" href="#">Bank</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="{{route('depositentry')}}"><i class="bi bi-bank"></i> Deposit</a></li>
              <li><a class="dropdown-item" href="{{route('withdrawentry')}}"><i class="bi bi-cash-coin"></i> Withdraw</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-credit-card-2-back-fill h5"></i> Payment
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="{{route('paymententry')}}"><i class="bi bi-plus-square-fill"></i> New Entry</a></li>
              <li><a class="dropdown-item" href="{{route('paymentreport')}}"><i class="bi bi-journal-richtext"></i>  Report</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-receipt h5"></i> Receipt
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="{{route('receiptentry')}}"><i class="bi bi-plus-square-fill"></i> New Entry</a></li>
              <li><a class="dropdown-item" href="{{route('receiptreport')}}"><i class="bi bi-journal-richtext"></i> Report</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-percent h5"></i> GST
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="{{route('billtobill')}}"><i class="bi bi-bank2"></i> Bill To Bill</a></li>
              <li><a class="dropdown-item" href="{{route('billtocash')}}"><i class="bi bi-cash-coin"></i> Bill To Cash</a></li>
              <li><a class="dropdown-item" href="{{route('hsn')}}"><i class="bi bi-bank"></i> HSN</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="material-icons">account_balance_wallet</span> Balance
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="{{route('balanceentry')}}"><i class="bi bi-plus-square-fill"></i> New Entry</a></li>
              <li><a class="dropdown-item" href="{{route('balancereport')}}"><i class="bi bi-journal-richtext"></i> Report</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-sliders h5"></i>  Settings
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href=""><i class="bi bi-download"></i> Download</a></li>
              <li><a class="dropdown-item" href="{{route('logout')}}"><i class="bi bi-box-arrow-right"></i> Log Out</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>

