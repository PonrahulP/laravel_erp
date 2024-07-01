<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\erp;
use App\purchase1;
use App\purchase2;
use App\product;
use App\supply;

class Purchase1Controller extends Controller
{
    public function create()
    {
        $data=array();
        if(Session::has('uname')){
           $data=erp::where('username','=',Session::get('uname'))->first();
        }
        // Generate the bill number
        $lastBill = purchase1::orderBy('bill_no', 'desc')->first();

        if (empty($lastBill) || empty($lastBill->bill_no)) {
            $number = "P-0000001";
        } else {
            $idd = str_replace("P-", "", $lastBill->bill_no);
            $id = str_pad($idd + 1, 7, 0, STR_PAD_LEFT);
            $number = "P-" . $id;
        }
        $suppid=supply::all();
        $codes=product::all();

        // Pass the generated bill number to the view
        return view('purchaseentry', ['bill_no' => $number],compact('data','suppid','codes'));
    }
    public function purchase1insert(Request $request){
        // echo 'hi';
        // echo $request->logo;
        $request->validate([
            'supplier'=>'required',
            'bill'=>'required',
            'logo'=>'mimes:JPEG,jpg,png,gif|max:2048',
            'date'=>'required',
            'code'=>'required|array',
            'product_name'=>'required|array',
            'quantity'=>'required|array',
            'unit_price'=>'required|array',
            'cgst'=>'required|array',
            'sgst'=>'required|array',
            'total'=>'required|array',
        ]);
        $image=time().".".$request->logo->extension();
        $request->logo->move(public_path("images"),$image);
        DB::beginTransaction();
       
        $purchase1 = purchase1::create([
            'supplier_id' => $request->supplier,
            'bill_no' => $request->bill,
            'bill_img' => $image,
            'purchase_date' => $request->date,
        ]);
        if($purchase1){
            foreach($request->code as $index=>$pcodes){
                $product = product::where('product_code', $pcodes)->first();
                $qty=$request->quantity[$index];
                if($product){
                    $newqty=$product->quantity + $qty;
                    $product->update(['quantity' => $newqty]);
                }
                $purchase2=purchase2::create([
                    'bill_no' => $request->bill,
                    'product_code' => $pcodes,
                    'product_name' => $request->product_name[$index],
                    'quantity' => $qty,
                    'unit_price' => $request->unit_price[$index],
                    'cgst'=>$request->cgst[$index],
                    'sgst'=>$request->sgst[$index],
                    'total' => $request->total[$index],
                ]);
            }
            DB::commit();
            return back()->with('success','Purchase added successfully');
        }
       
        else{
            return back()->with('fail','Purchase added failed');
        }
    }
    public function getproductname(Request $request)
    {
        $productCode = $request->code;
        $product = product::where('product_code', $productCode)->first();
    
        if ($product) {
            return response()->json([
                'product_name' => $product->product_name,
            ]);
        } else {
            return response()->json([]);
        }
    }
    public function purchasereportshow(){
        $data=array();
        if(Session::has('uname')){
           $data=erp::where('username','=',Session::get('uname'))->first();
        }
        $p1=purchase1::all();
        $p2=purchase2::all();
        return view('purchasereport',compact('data','p1','p2'));
       }
       public function billshow($bill_no){
        $data=array();
        if(Session::has('uname')){
           $data=erp::where('username','=',Session::get('uname'))->first();
        }
        $bills=purchase1::where('bill_no',$bill_no)->first();
        return view('bill',compact('data','bills'));
       }
       public function deletepurchase($bill_no) {
        try {
            // Start a database transaction
            DB::transaction(function () use ($bill_no) {
                // Find the sales records by bill number
                $purchase1 = purchase1::where('bill_no',$bill_no)->first();
              
                
                if ($purchase1) {
                    $purchase2Records = purchase2::where('bill_no',$bill_no)->get();
                    // Get the product code and quantity before deleting the sales
                    foreach ( $purchase2Records as $purchase2) {
                        // Get the product code and quantity before deleting the sales
                        $qty = $purchase2->quantity;
                        $code = $purchase2->product_code;
    
                        // Delete the purchase2 record
                        $purchase2->delete();
    
                        // Update the product quantity
                        $product = product::where('product_code', $code)->first();
                        if ($product) {
                            $product->quantity -= $qty;
                            $product->save();
                        } else {
                            // Handle the case where the product is not found
                            throw new \Exception('Product not found');
                        }
                    }
    
                    // Delete the purchase1 record
                    $purchase1->delete();
                } else {
                    // Handle the case where the sales records are not found
                    throw new \Exception('Purchase not found');
                }
            });
    
            return back()->with('success', 'Purchase deleted successfully and quantity updated successfully');
        } catch (\Exception $e) {
            // Handle exceptions and rollback the transaction
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
   
}
