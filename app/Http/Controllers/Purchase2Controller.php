<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\erp;

class Purchase2Controller extends Controller
{
    public function index()
    {
        $data=array();
        if(Session::has('uname')){
           $data=erp::where('username','=',Session::get('uname'))->first();
        }
        $expensesQuery = DB::table('expenses')
            ->select(DB::raw("'Expense' as type, amount, name as description, date"))
            ->where('payment_type', 'bank');

        $incomeQuery = DB::table('incomes')
            ->select(DB::raw("'Income' as type, amount, name as description, date"))
            ->where('payment_type', 'bank');

        $depositQuery = DB::table('deposits')
            ->select(DB::raw("'Deposit' as type, amount, bank_name as description, date"));

        $withdrawQuery = DB::table('withdraws')
            ->select(DB::raw("'Withdraw' as type, amount, bank_name as description, date"));

        $paymentQuery = DB::table('payments')
            ->select(DB::raw("'Purchase' as type, amount, bill_no as description, date"))
            ->where('payment_type', 'bank');

        $receiptQuery = DB::table('receipts')
            ->select(DB::raw("'Sales' as type, amount, bill_no as description, date"))
            ->where('payment_type', 'bank');

        $combinedQuery = $expensesQuery->unionAll($incomeQuery)
            ->unionAll($depositQuery)
            ->unionAll($withdrawQuery)
            ->unionAll($paymentQuery)
            ->unionAll($receiptQuery)
            ->orderBy('date', 'desc');

        $transactions = $combinedQuery->get();

        return view('bankbalance', ['transactions' => $transactions],compact('data'));
    }
    public function index1()
    {
        $data=array();
        if(Session::has('uname')){
           $data=erp::where('username','=',Session::get('uname'))->first();
        }
        $expensesQuery = DB::table('expenses')
            ->select(DB::raw("'Expense' as type, amount, name as description, date"))
            ->where('payment_type', 'cash');

        $incomeQuery = DB::table('incomes')
            ->select(DB::raw("'Income' as type, amount, name as description, date"))
            ->where('payment_type', 'cash');

        $depositQuery = DB::table('deposits')
            ->select(DB::raw("'Deposit' as type, amount, bank_name as description, date"));

        $withdrawQuery = DB::table('withdraws')
            ->select(DB::raw("'Withdraw' as type, amount, bank_name as description, date"));

        $paymentQuery = DB::table('payments')
            ->select(DB::raw("'Purchase' as type, amount, bill_no as description, date"))
            ->where('payment_type', 'cash');

        $receiptQuery = DB::table('receipts')
            ->select(DB::raw("'Sales' as type, amount, bill_no as description, date"))
            ->where('payment_type', 'cash');

        $combinedQuery = $expensesQuery->unionAll($incomeQuery)
            ->unionAll($depositQuery)
            ->unionAll($withdrawQuery)
            ->unionAll($paymentQuery)
            ->unionAll($receiptQuery)
            ->orderBy('date', 'desc');

        $transactions = $combinedQuery->get();

        return view('cashbalance', ['transactions' => $transactions],compact('data'));
    }
}
