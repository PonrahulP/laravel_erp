<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\erp;
use App\payment;
use App\purchase2;
use App\purchase1;
use App\balance;
use Session;

class PaymentController extends Controller
{
    public function getpurchasebills(Request $request)
    {
        $bill_no = $request->bill_no;
        // echo $bill_no;

        if (!$bill_no) {
            return response()->json(['error' => 'Bill number is required'], 400);
        }

        $totalAmount = DB::table('purchase2s')
            ->where('bill_no', $bill_no)
            ->sum('total');

        return response()->json(['total' => $totalAmount]);
    }
       public function paymententryshow(){
        $data=array();
        if(Session::has('uname')){
           $data=erp::where('username','=',Session::get('uname'))->first();
        }
        $bill=purchase1::all();
    
        return view('paymententry',compact('data','bill'));
       }
       public function paymentinsert(Request $request){
        $request->validate([
            'billno'=>'required',
            'date'=>'required',
            'amnt'=>'required',
            'paid'=>'required',
            'pend'=>'required',
            'type'=>'required',
        ]);
        $billno=$request->billno;
        $date=$request->date;
        $amnt=$request->amnt;
        $paid=$request->paid;
        $pend=$request->pend;
        $type=$request->type;
        DB::transaction(function () use ($billno, $date, $amnt,$paid,$pend,$type) {
            // Insert into incomes table
            payment::create([
                'bill_no' => $billno,
                'date' => $date,
                'total_amount' => $amnt,
                'amount'=>$paid,
                'pending_amount'=>$pend,
                'payment_type'=>$type
            ]);
    
            // Update balance table
            balance::where('payment_type', $type)
                ->decrement('amount', $paid);
                
        });
        return back()->with('success','Payment added successfully and added in balance successfully');
    }
    public function paymentreportsshow(){
        $data=array();
        if(Session::has('uname')){
           $data=erp::where('username','=',Session::get('uname'))->first();
        }
        $san=payment::all();
        return view('paymentreport',compact('data','san'));
       }
       public function deletepayment($bill_no){
        DB::transaction(function () use ($bill_no) {
            $receipt = payment::where('bill_no',$bill_no)->first();
            if ($receipt) {
                $amount = $receipt->amount;
                $type=$receipt->payment_type;
                $receipt->delete();
    
                balance::where('payment_type', $type)
                ->increment('amount', $amount);
            }
        });
    
        return back()->with('success','Payments deleted successfully and balance  Added to balance successfully');
        }
        public function paymentedit($bill_no){
            $data=array();
            if(Session::has('uname')){
               $data=erp::where('username','=',Session::get('uname'))->first();
            }
            $gan=payment::where('bill_no',$bill_no)->first();
            return view('paymentupdate',compact('gan','data'));
        }
        public function paymentupdate(Request $request,$bill_no){
            $bill=$request->bill;
            $date=$request->date;
            $amnt=$request->amnt;
            $paid=$request->paid;
            $paidh=$request->paid1;
            $amntf=$paid-$paidh;
            $pend=$request->pend;
            $type=$request->type;
            DB::transaction(function () use ($bill,$date,$amnt,$paid,$amntf,$pend,$type, $bill_no) {
                $receipt = payment::where('bill_no',$bill_no)->first();
                if ($receipt) {
                    $receipt->bill_no = $bill;
                    $receipt->date = $date;
                    $receipt->total_amount = $amnt;
                    $receipt->amount=$paid;
                    $receipt->pending_amount=$pend;
                    $receipt->payment_type=$type;
                    $receipt->save();
        
                    // Update the balance based on the payment type
                  
                balance::where('payment_type', $type)
                ->decrement('amount', $amntf);
                }
            });
            return redirect('paymentreport');
        }
}
