<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\erp;
use App\deposit;
use App\balance;
class DepositController extends Controller
{
    public function depositentry(Request $request){
        $request->validate([
            'name'=>'required',
            'date'=>'required',
            'amnt'=>'required',
        ]);
        $name=$request->name;
        $date=$request->date;
        $amnt=$request->amnt;
        DB::transaction(function () use ($name, $date, $amnt) {
         // Insert into incomes table
         deposit::create([
             'bank_name' => $name,
             'date' => $date,
             'amount' => $amnt
         ]);
 
         // Update balance table
         balance::where('payment_type', 'Cash')
             ->decrement('amount', $amnt);
             balance::where('payment_type', 'Bank')
             ->increment('amount', $amnt);
             
     });
     return back()->with('success','Deposits added to bank and deducted in cash successfully');
    }
    public function depositreports(){
        $data=array();
        if(Session::has('uname')){
           $data=erp::where('username','=',Session::get('uname'))->first();
        }
        $san=deposit::all();
        return view('depositreport',compact('san','data'));
    }
    public function deletedeposits($id){
    DB::transaction(function () use ($id) {
        $deposit = deposit::find($id);
        if ($deposit) {
            $amount = $deposit->amount;
            $deposit->delete();

            balance::where('payment_type', 'Cash')
            ->increment('amount', $amount);
            balance::where('payment_type', 'Bank')
            ->decrement('amount', $amount);
        }
    });

    return back()->with('success','Deposits deleted successfully and balance added to cash and deducted to bank successfully');
    }
    public function depositedit($id){
        $data=array();
        if(Session::has('uname')){
           $data=erp::where('username','=',Session::get('uname'))->first();
        }
        $gan=deposit::find($id);
        return view('depositupdate',compact('gan','data'));
    }
    public function depositupdate(Request $request,$id){
        $name=$request->name;
        $date=$request->date;
        $amnt=$request->amnt;
        $amnth=$request->amnth;
        $amntf=$amnt-$amnth;
        DB::transaction(function () use ($name,$date,$amnt,$amntf, $id) {
            $deposit = deposit::find($id);
            if ($deposit) {
                $deposit->bank_name = $name;
                $deposit->date = $date;
                $deposit->amount = $amnt;
                $deposit->save();
    
                // Update the balance based on the payment type
              
            balance::where('payment_type', 'Cash')
            ->decrement('amount', $amntf);
            balance::where('payment_type', 'Bank')
            ->increment('amount', $amntf);
            }
        });
        return redirect('depositreport');
    }
}
