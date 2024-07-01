<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\erp;
use App\withdraw;
use App\balance;

class WithdrawController extends Controller
{
    public function withdrawentry(Request $request){
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
         withdraw::create([
             'bank_name' => $name,
             'date' => $date,
             'amount' => $amnt
         ]);
 
         // Update balance table
         balance::where('payment_type', 'Cash')
             ->increment('amount', $amnt);
             balance::where('payment_type', 'Bank')
             ->decrement('amount', $amnt);
             
     });
     return back()->with('success','Withdraw added to cash and deducted in bank successfully');
    }
    public function withdrawreports(){
        $data=array();
        if(Session::has('uname')){
           $data=erp::where('username','=',Session::get('uname'))->first();
        }
        $san=withdraw::all();
        return view('withdrawreport',compact('san','data'));
    }
    public function deletewithdraws($id){
        DB::transaction(function () use ($id) {
            $withdraw = withdraw::find($id);
            if ($withdraw) {
                $amount = $withdraw->amount;
                $withdraw->delete();
    
                balance::where('payment_type', 'Cash')
                ->decrement('amount', $amount);
                balance::where('payment_type', 'Bank')
                ->increment('amount', $amount);
            }
        });
    
        return back()->with('success','Withdraw deleted successfully and balance added to bank and deducted to cash successfully');
    }
    public function withdrawedit($id){
        $data=array();
        if(Session::has('uname')){
           $data=erp::where('username','=',Session::get('uname'))->first();
        }
        $gan=withdraw::find($id);
        return view('withdrawupdate',compact('gan','data'));
    }
    public function withdrawupdate(Request $request,$id){
        $name=$request->name;
        $date=$request->date;
        $amnt=$request->amnt;
        $amnth=$request->amnth;
        $amntf=$amnt-$amnth;
        DB::transaction(function () use ($name,$date,$amnt,$amntf, $id) {
            $withdraw = withdraw::find($id);
            if ($withdraw) {
                $withdraw->bank_name = $name;
                $withdraw->date = $date;
                $withdraw->amount = $amnt;
                $withdraw->save();
    
                // Update the balance based on the payment type
              
            balance::where('payment_type', 'Cash')
            ->increment('amount', $amntf);
            balance::where('payment_type', 'Bank')
            ->decrement('amount', $amntf);
            }
        });
        return redirect('withdrawreport');
    }
}
