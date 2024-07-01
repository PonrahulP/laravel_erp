<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\erp;
use App\income;
use App\balance;

class IncomeController extends Controller
{
    public function incomeentry(Request $request){
        $request->validate([
            'name'=>'required',
            'date'=>'required',
            'amnt'=>'required',
            'payment'=>'required',
        ]);
        $name=$request->name;
        $date=$request->date;
        $amnt=$request->amnt;
        $payment=$request->payment;
        DB::transaction(function () use ($name, $date, $amnt, $payment) {
         // Insert into incomes table
         income::create([
             'name' => $name,
             'date' => $date,
             'amount' => $amnt,
             'payment_type' => $payment
         ]);
 
         // Update balance table
         balance::where('payment_type', $payment)
             ->decrement('amount', $amnt);
     });
     return back()->with('success','Expenses added successfuly');
     
    }
    public function incomereports(){
        $data=array();
        if(Session::has('uname')){
           $data=erp::where('username','=',Session::get('uname'))->first();
        }
        $san=income::all();
        return view('incomereport',compact('san','data'));
    }
    public function deleteincomes($id){
         // Start a database transaction
    DB::transaction(function () use ($id) {
        // Find the expense by ID
        $income = income::find($id);
        if ($income) {
            // Get the payment type and amount before deleting the expense
            $paymentType = $income->payment_type;
            $amount = $income->amount;

            // Delete the expense
            $income->delete();

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

    return back()->with('success','Income deleted successfully and balance added successfully');
    }
    public function incomeedit($id){
        $data=array();
        if(Session::has('uname')){
           $data=erp::where('username','=',Session::get('uname'))->first();
        }
        $gan=income::find($id);
        return view('incomeupdate',compact('gan','data'));
    }
    public function incomeupdate(Request $request,$id){
        $name=$request->name;
        $date=$request->date;
        $amnt=$request->amnt;
        $amnth=$request->amnth;
        $payment=$request->payment;
        $amntf=$amnt-$amnth;
        DB::transaction(function () use ($name,$date,$amnt,$payment,$amntf, $id) {
            $income = income::find($id);
            if ($income) {
                $income->name = $name;
                $income->date = $date;
                $income->amount = $amnt;
                $income->payment_type = $payment;
                $income->save();
    
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
        return redirect('incomereport');
    }
}
