<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\receipt;
use App\erp;
use App\sales1;
use App\balance;
use Session;

class ReceiptController extends Controller
{
   public function getsalesbills(Request $request){
    $bills = $request->bill_no;
    $product = sales1::where('bill_no', $bills)->first();

    if ($product) {
        return response()->json([
            'grand_total' => $product->grand_total,
        ]);
    } else {
        return response()->json([]);
    }
   }
   public function receiptentryshow(){
    $data=array();
    if(Session::has('uname')){
       $data=erp::where('username','=',Session::get('uname'))->first();
    }
    $bill=sales1::all();

    return view('receiptentry',compact('data','bill'));
   }
   public function receiptinsert(Request $request){
    $request->validate([
        'billno'=>'required',
        'date'=>'required',
        'amnt'=>'required',
        'receive'=>'required',
        'pend'=>'required',
        'type'=>'required',
    ]);
    $billno=$request->billno;
    $date=$request->date;
    $amnt=$request->amnt;
    $receive=$request->receive;
    $pend=$request->pend;
    $type=$request->type;
    DB::transaction(function () use ($billno, $date, $amnt,$receive,$pend,$type) {
        // Insert into incomes table
        receipt::create([
            'bill_no' => $billno,
            'date' => $date,
            'total_amount' => $amnt,
            'amount'=>$receive,
            'pending_amount'=>$pend,
            'payment_type'=>$type
        ]);

        // Update balance table
        balance::where('payment_type', $type)
            ->increment('amount', $receive);
            
    });
    return back()->with('success','Receipt added successfully and added in balance successfully');
}
public function receiptreports(){
    $data=array();
    if(Session::has('uname')){
       $data=erp::where('username','=',Session::get('uname'))->first();
    }
    $rec=receipt::all();
    return view('receiptreport',compact('rec','data'));
}
public function deletereceipt($bill_no){
    DB::transaction(function () use ($bill_no) {
        $receipt = receipt::where('bill_no',$bill_no)->first();
        if ($receipt) {
            $amount = $receipt->amount;
            $type=$receipt->payment_type;
            $receipt->delete();

            balance::where('payment_type', $type)
            ->decrement('amount', $amount);
        }
    });

    return back()->with('success','Receipts deleted successfully and balance  deducted to balance successfully');
    }
    public function receiptedit($bill_no){
        $data=array();
        if(Session::has('uname')){
           $data=erp::where('username','=',Session::get('uname'))->first();
        }
        $gan=receipt::where('bill_no',$bill_no)->first();
        return view('receiptupdate',compact('gan','data'));
    }
    public function receiptupdate(Request $request,$bill_no){
        $bill=$request->bill;
        $date=$request->date;
        $amnt=$request->amnt;
        $receive=$request->receive;
        $receiveh=$request->receive1;
        $amntf=$receive-$receiveh;
        $pend=$request->pend;
        $type=$request->type;
        DB::transaction(function () use ($bill,$date,$amnt,$receive,$amntf,$pend,$type, $bill_no) {
            $receipt = receipt::where('bill_no',$bill_no)->first();
            if ($receipt) {
                $receipt->bill_no = $bill;
                $receipt->date = $date;
                $receipt->total_amount = $amnt;
                $receipt->amount=$receive;
                $receipt->pending_amount=$pend;
                $receipt->payment_type=$type;
                $receipt->save();
    
                // Update the balance based on the payment type
              
            balance::where('payment_type', $type)
            ->increment('amount', $amntf);
            }
        });
        return redirect('receiptreport');
    }
}
