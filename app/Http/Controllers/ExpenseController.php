<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\erp;
use App\expense;
use App\balance;

class ExpenseController extends Controller
{
    public function expenseentry(Request $request){
        $request->validate([
            'type'=>'required',
            'name'=>'required',
            'date'=>'required',
            'amnt'=>'required',
            'payment'=>'required',
        ]);
       $type=$request->type;
       $name=$request->name;
       $date=$request->date;
       $amnt=$request->amnt;
       $payment=$request->payment;
       DB::transaction(function () use ($type, $name, $date, $amnt, $payment) {
        // Insert into expenses table
        expense::create([
            'expenses_type' => $type,
            'name' => $name,
            'date' => $date,
            'amount' => $amnt,
            'payment_type' => $payment
        ]);

        // Update balance table
        balance::where('payment_type', $payment)
            ->decrement('amount', $amnt);
    });
    return back()->with('success','Incomes added successfuly');
    }
    public function expensereports(){
        $data=array();
        if(Session::has('uname')){
           $data=erp::where('username','=',Session::get('uname'))->first();
        }
        $san=expense::all();
        return view('expensereport',compact('san','data'));
    }
    public function deleteexpenses($id){ 
       // Start a database transaction
    DB::transaction(function () use ($id) {
        // Find the expense by ID
        $expense = expense::find($id);
        if ($expense) {
            // Get the payment type and amount before deleting the expense
            $paymentType = $expense->payment_type;
            $amount = $expense->amount;

            // Delete the expense
            $expense->delete();

            // Update the balance based on the payment type
            $balance = balance::where('payment_type', $paymentType)->first();
            if ($balance) {
                $balance->amount += $amount;
                $balance->save();
            }
        } else {
            // Handle the case where the expense is not found
            throw new \Exception('Expense not found');
        }
    });

    return back()->with('success','Expenses deleted successfully and balance added successfully');
    }
    public function expenseedit($id){
        $data=array();
        if(Session::has('uname')){
           $data=erp::where('username','=',Session::get('uname'))->first();
        }
        $gan=expense::find($id);
        return view('expenseupdate',compact('gan','data'));
    }
    public function expenseupdate(Request $request,$id){
    
        $type=$request->type;
        $name=$request->name;
        $date=$request->date;
        $amnt=$request->amnt;
        $amnth=$request->amnth;
        $payment=$request->payment;
        $amntf=$amnt-$amnth;
        DB::transaction(function () use ($type,$name,$date,$amnt,$payment,$amntf, $id) {
            $expense = expense::find($id);
            if ($expense) {
                $expense->expenses_type = $type;
                $expense->name = $name;
                $expense->date = $date;
                $expense->amount = $amnt;
                $expense->payment_type = $payment;
                $expense->save();
    
                // Update the balance based on the payment type
                $balance = balance::where('payment_type', $payment)->first();
                if ($balance) {
                    $balance->amount -= $amntf;
                    $balance->save();
                }
            } else {
                // Handle the case where the expense is not found
                throw new \Exception('Expense not found');
            }
        });
        return redirect('expensereport');
}
}
