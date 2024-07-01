<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/register','ErpController@registershow')->name('register');
Route::get('/welcome','ErpController@welcomeshow')->name('welcome');
Route::get('/dashboard','ErpController@dashshow')->name('dashboard');
Route::get('/customerentry','ErpController@customerentryshow')->name('customerentry');
Route::get('/stockentry','ErpController@stockentryshow')->name('stockentry');
Route::get('/excel','ErpController@excelshow')->name('excel');

Route::get('/supplyentry','ErpController@supplyentryshow')->name('supplyentry');
Route::get('/purchaseentry','ErpController@purchaseentryshow')->name('purchaseentry');

Route::get('/expenseentry','ErpController@expenseentryshow')->name('expenseentry');
Route::get('/incomeentry','ErpController@incomeentryshow')->name('incomeentry');
Route::get('/depositentry','ErpController@depositentryshow')->name('depositentry');
Route::get('/withdrawentry','ErpController@withdrawentryshow')->name('withdrawentry');
Route::get('/withdrawreport','ErpController@withdrawreportshow')->name('withdrawreport');



Route::get('/billtobill','ErpController@billtobillshow')->name('billtobill');
Route::get('/billtocash','ErpController@billtocashshow')->name('billtocash');
Route::get('/hsn','ErpController@hsnshow')->name('hsn');
Route::get('/balanceentry','ErpController@balanceentryshow')->name('balanceentry');
Route::get('/bankbalance','ErpController@bankbalanceshow')->name('bankbalance');
Route::get('/cashbalance','ErpController@cashbalanceshow')->name('cashbalance');

Route::get('registeruser','ErpController@registeruser')->name('registeruser');
Route::get('loginuser','ErpController@loginuser')->name('loginuser');
Route::get('logout','ErpController@logout')->name('logout');

Route::get('index1','ProductController@productentry')->name('index1');
Route::get('stockreport','ProductController@stockreports')->name('stockreport');
Route::get('deleteproducts/{id}','ProductController@deleteproducts')->name('deleteproducts');
Route::get('productedit/{id}','ProductController@productedit')->name('productedit');
Route::get('productupdate/{id}','ProductController@productupdate')->name('productupdate');
Route::get('import','ProductController@import')->name('import');

Route::get('supplyinsert','SupplyController@supplyentry')->name('supplyinsert');
Route::get('supplyreport','SupplyController@supplyreports')->name('supplyreport');
Route::get('deletesuppliers/{id}','SupplyController@deletesuppliers')->name('deletesuppliers');
Route::get('supplyedit/{id}','SupplyController@supplyedit')->name('supplyedit');
Route::get('supplyupdate/{id}','SupplyController@supplyupdate')->name('supplyupdate');

Route::get('customerinsert','CustomerController@customerentry')->name('customerinsert');
Route::get('customerreport','CustomerController@customerreports')->name('customerreport');
Route::get('deletecustomer/{id}','CustomerController@deletecustomers')->name('deletecustomer');
Route::get('customeredit/{id}','CustomerController@customeredit')->name('customeredit');
Route::get('customerupdate/{id}','CustomerController@customerupdate')->name('customerupdate');

Route::get('expenseinsert','ExpenseController@expenseentry')->name('expenseinsert');
Route::get('expensereport','ExpenseController@expensereports')->name('expensereport');
Route::get('deleteexpense/{id}','ExpenseController@deleteexpenses')->name('deleteexpense');
Route::get('expenseedit/{id}','ExpenseController@expenseedit')->name('expenseedit');
Route::get('expenseupdate/{id}','ExpenseController@expenseupdate')->name('expenseupdate');

Route::get('incomeinsert','IncomeController@incomeentry')->name('incomeinsert');
Route::get('incomereport','IncomeController@incomereports')->name('incomereport');
Route::get('deleteincome/{id}','IncomeController@deleteincomes')->name('deleteincome');
Route::get('incomeedit/{id}','IncomeController@incomeedit')->name('incomeedit');
Route::get('incomeupdate/{id}','IncomeController@incomeupdate')->name('incomeupdate');

Route::get('depositinsert','DepositController@depositentry')->name('depositinsert');
Route::get('depositreport','DepositController@depositreports')->name('depositreport');
Route::get('deletedeposit/{id}','DepositController@deletedeposits')->name('deletedeposit');
Route::get('depositedit/{id}','DepositController@depositedit')->name('depositedit');
Route::get('depositupdate/{id}','DepositController@depositupdate')->name('depositupdate');

Route::get('withdrawinsert','WithdrawController@withdrawentry')->name('withdrawinsert');
Route::get('withdrawreport','WithdrawController@withdrawreports')->name('withdrawreport');
Route::get('deletewithdraw/{id}','WithdrawController@deletewithdraws')->name('deletewithdraw');
Route::get('withdrawedit/{id}','WithdrawController@withdrawedit')->name('withdrawedit');
Route::get('withdrawupdate/{id}','WithdrawController@withdrawupdate')->name('withdrawupdate');

Route::get('balanceinsert','BalanceController@balanceentry')->name('balanceinsert');
Route::get('balancereport','BalanceController@balancereports')->name('balancereport');
Route::get('deletebalance/{id}','BalanceController@deletebalance')->name('deletebalance');
Route::get('balanceedit/{id}','BalanceController@balanceedit')->name('balanceedit');
Route::get('balanceupdate/{id}','BalanceController@balanceupdate')->name('balanceupdate');

//dashboard//
Route::get('/dashboard','ErpController@openbal')->name('dashboard');
Route::get('/navbar','ErpController@logo')->name('navbar');
 
//purchase1//
Route::get('/purchaseentry','Purchase1Controller@create')->name('purchaseentry');
Route::get('purchase1insert','Purchase1Controller@purchase1insert')->name('purchase1insert');
Route::get('getproductname','Purchase1Controller@getproductname')->name('getproductname');
Route::get('/purchasereport','Purchase1Controller@purchasereportshow')->name('purchasereport');
Route::get('billedit/{bill_no}','Purchase1Controller@billshow')->name('billedit');
Route::get('deletepurchase/{bill_no}','Purchase1Controller@deletepurchase')->name('deletepurchase');

//sales//
Route::get('/salesentry','Sales1Controller@salesentryshow')->name('salesentry');
Route::get('getsales','Sales1Controller@getsales')->name('getsales');
Route::get('salesinsert','Sales1Controller@salesinsert')->name('salesinsert');
Route::get('print/{bill}/{customer}','Sales2Controller@print')->name('print');
Route::get('salesreport','Sales1Controller@salesreports')->name('salesreport');
Route::get('deletesales/{bill_no}','Sales1Controller@deletesales')->name('deletesales');
Route::get('salesedit/{bill_no}','Sales2Controller@salesedit')->name('salesedit');
Route::get('getsalescode','Sales2Controller@getsalescode')->name('getsalescode');
Route::get('salesupdate/{bill_no}','Sales2Controller@salesupdate')->name('salesupdate');

//bill to bill//
Route::get('billtobill','Sales2Controller@getbilltobill')->name('billtobill');
//bill to cash//
Route::get('billtocash','Sales2Controller@getbilltocash')->name('billtocash');
//hsn//
Route::get('hsn','Sales2Controller@gethsn')->name('hsn');

//receipt//
Route::get('getsalesbills','ReceiptController@getsalesbills')->name('getsalesbills');
Route::get('/receiptentry','ReceiptController@receiptentryshow')->name('receiptentry');
Route::get('/receiptinsert','ReceiptController@receiptinsert')->name('receiptinsert');
Route::get('receiptreport','ReceiptController@receiptreports')->name('receiptreport');
Route::get('deletereceipt/{bill_no}','ReceiptController@deletereceipt')->name('deletereceipt');
Route::get('receiptedit/{bill_no}','ReceiptController@receiptedit')->name('receiptedit');
Route::get('receiptupdate/{bill_no}','ReceiptController@receiptupdate')->name('receiptupdate');

//payment//
Route::get('getpurchasebills','PaymentController@getpurchasebills')->name('getpurchasebills');
Route::get('/paymententry','PaymentController@paymententryshow')->name('paymententry');
Route::get('/paymentinsert','PaymentController@paymentinsert')->name('paymentinsert');
Route::get('/paymentreport','PaymentController@paymentreportsshow')->name('paymentreport');
Route::get('deletepayment/{bill_no}','PaymentController@deletepayment')->name('deletepayment');
Route::get('paymentedit/{bill_no}','PaymentController@paymentedit')->name('paymentedit');
Route::get('paymentupdate/{bill_no}','PaymentController@paymentupdate')->name('paymentupdate');

//bankbalance//
Route::get('/bankbalance','Purchase2Controller@index')->name('bankbalance');
Route::get('/cashbalance','Purchase2Controller@index1')->name('cashbalance');
