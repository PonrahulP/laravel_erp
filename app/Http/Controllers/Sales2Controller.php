<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\erp;
use App\customer;
use App\sales1;
use App\sales2;
use App\product;
use Session;

class Sales2Controller extends Controller
{
    public function print($bill,$customer){
        $data=array();
        if(Session::has('uname')){
           $data=erp::where('username','=',Session::get('uname'))->first();
        }
        $sales1=sales1::where('bill_no',$bill)->first();
        $sales2=sales2::where('bill_no',$bill)->get();
        $customer=customer::where('customer_id',$customer)->first();
        return view('print',compact('sales1','sales2','customer','data'));
    }
    public function salesedit($bill_no){
        $data=array();
        if(Session::has('uname')){
           $data=erp::where('username','=',Session::get('uname'))->first();
        }
        $saleedit=sales1::where('bill_no',$bill_no)->first();
        $saleedit1=sales2::where('bill_no',$bill_no)->get();
        $product=product::all();
        return view('salesupdate',compact('data','saleedit','saleedit1','product'));
    }
    public function getsalescode(Request $request)
    {
        $productname = $request->code;
        $product = product::where('product_name', $productname)->first();
    
        if ($product) {
            return response()->json([
                'product_code' => $product->product_code,
            ]);
        } else {
            return response()->json([]);
        }
    }
    public function salesupdate(Request $request,$bill_no){
        $cusid=$request->customer_id;
        $bill=$request->bill_no;
        $invoice=$request->invoice_no;
        $date=$request->sales_date;
        $sub=$request->sub_total;
        $cgst=$request->cgst;
        $cgsta=$request->cgst_amount;
        $type=$request->type;
        $sgst=$request->sgst;
        $sgsta=$request->sgsta;
        $dis=$request->dis;
        $grand=$request->grand_total;
        $pname=$request->product_name;
        $pcode=$request->product_code;
        $qty=$request->quantity;
        $qtyh=$request->quantity1;
        $uprice=$request->unit_price;
        $total=$request->total;
        DB::transaction(function () use ($cusid,$bill,$invoice,$date,$sub,$cgst,$cgsta,$type,$sgst,$sgsta,$dis,$grand,$pname,$pcode,$qty,$qtyh,$uprice,$total,$bill_no) {
            $sales1 = sales1::find($bill_no);
            if ($sales1) {
                $sales1->customer_id = $cusid;
                $sales1->bill_no = $bill;
                $sales1->invoice_no = $invoice;
                $sales1->sales_date=$date;
                $sales1->sub_total=$sub;
                $sales1->cgst=$cgst;
                $sales1->cgst_amount=$cgsta;
                $sales1->sgst=$sgst;
                $sales1->sgst_amount=$sgsta;
                $sales1->discount=$dis;
                $sales1->grand_total=$grand;
                $sales1->sales_type=$type;
                $sales1->save();
            }
              foreach($pcode as $index=>$pcodes){
                $qtys=$qty[$index];
                $qtyhs=$qtyh[$index];
                $qtyf=$qtys-$qtyhs;
            product::where('product_code', $pcodes)
            ->decrement('quantity', $qtyf);
            $sales2=sales2::find($bill_no);
            if($sales2){
                $sales2->bill_no=$bill;
                $sales2->product_code=$pcodes;
                $sales2->product_name=$pname[$index];
                $sales2->quantity=$qtys;
                $sales2->unit_price=$uprice[$index];
                $sales2->total=$total[$index];
                $sales2->sales_type=$type;
                $sales2->save();
            }
              }
        });
        return redirect('salesreport');
    }
    public function getbilltobill(){
        $data=array();
      if(Session::has('uname')){
         $data=erp::where('username','=',Session::get('uname'))->first();
      }
      $bs=sales1::where('sales_type','Bill To Bill')->get();
      $bss=sales2::where('sales_type','Bill To Bill')->get();
      return view('billtobill',compact('data','bs','bss'));
    }
    public function getbilltocash(){
        $data=array();
      if(Session::has('uname')){
         $data=erp::where('username','=',Session::get('uname'))->first();
      }
      $cs=sales1::where('sales_type','Bill To Cash')->get();
      $css=sales2::where('sales_type','Bill To Cash')->get();
      return view('billtocash',compact('data','cs','css'));
    }
    public function gethsn(){
        $data=array();
      if(Session::has('uname')){
         $data=erp::where('username','=',Session::get('uname'))->first();
      }
      $salesData = DB::table('sales1s')
      ->join('sales2s', 'sales1s.bill_no', '=', 'sales2s.bill_no')
      ->select('sales1s.id', 'sales2s.product_code', 'sales1s.cgst', 'sales1s.cgst_amount', 'sales1s.sgst', 'sales1s.sgst_amount')
      ->get();
      return view('hsn',compact('data','salesData'));
    }
}
