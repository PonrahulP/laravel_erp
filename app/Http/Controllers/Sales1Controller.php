<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\erp;
use App\sales1;
use App\sales2;
use App\customer;
use App\product;
use Session;

class Sales1Controller extends Controller
{
    public function salesentryshow(){
        $data=array();
        if(Session::has('uname')){
           $data=erp::where('username','=',Session::get('uname'))->first();
        }
        $lastinvoice = sales1::orderBy('invoice_no', 'desc')->first();

        if (empty($lastinvoice) || empty($lastinvoice->invoice_no)) {
            $number1 = "IN-0000001";
        } else {
            $idd = str_replace("IN-", "", $lastinvoice->invoice_no);
            $id = str_pad($idd + 1, 7, 0, STR_PAD_LEFT);
            $number1 = "IN-" . $id;
        }
        $lastBill = sales1::orderBy('bill_no', 'desc')->first();

        if (empty($lastBill) || empty($lastBill->bill_no)) {
            $number = "S-0000001";
        } else {
            $idd = str_replace("S-", "", $lastBill->bill_no);
            $id = str_pad($idd + 1, 7, 0, STR_PAD_LEFT);
            $number = "S-" . $id;
        }
        $cusid=customer::all();
        $code=product::all();

        return view('salesentry',['bill_no' => $number,'invoice_no'=>$number1],compact('data','cusid','code'));
       }
       public function getSales(Request $request)
       {
           $productCode = $request->code;
           $product = product::where('product_code', $productCode)->first();
       
           if ($product) {
               return response()->json([
                   'product_name' => $product->product_name,
                   'unit_price' => $product->unit_price,
               ]);
           } else {
               return response()->json([]);
           }
       }
       public function salesinsert(Request $request)
       {
           $request->validate([
               'customer' => 'required|numeric',
               'bill' => 'required',
               'invoice' => 'required',
               'date' => 'required|date',
               'sub' => 'required|numeric',
               'cgst' => 'required|numeric',
               'cgstamnt' => 'required|numeric',
               'sgst' => 'required|numeric',
               'sgstamnt' => 'required|numeric',
               'discount' => 'required|numeric',
               'grand' => 'required|numeric',
               'type' => 'required',
               'product' => 'required|array',
               'product_name' => 'required|array',
               'quantity' => 'required|array',
               'unit_price' => 'required|array',
               'total' => 'required|array',
           ]);
       
           DB::beginTransaction();
       
         
               // Insert into sales1 table
               $sales1 = sales1::create([
                   'customer_id' => $request->customer,
                   'bill_no' => $request->bill,
                   'invoice_no' => $request->invoice,
                   'sales_date' => $request->date,
                   'sub_total' => $request->sub,
                   'cgst' => $request->cgst,
                   'cgst_amount' => $request->cgstamnt,
                   'sgst' => $request->sgst,
                   'sgst_amount' => $request->sgstamnt,
                   'discount' => $request->discount,
                   'grand_total' => $request->grand,
                   'sales_type' => $request->type,
               ]);
       if($sales1){
               $lowStockProducts = [];
       
               foreach ($request->product as $index => $product_code) {
                   $product = product::where('product_code', $product_code)->first();
                   $quantity = $request->quantity[$index];
       
                   if ($product) {
                       $new_stock_quantity = $product->quantity - $quantity;
       
                       if ($new_stock_quantity < 30) {
                           $lowStockProducts[] = $product_code;
                       }
       
                       // Update product quantity
                       $product->update(['quantity' => $new_stock_quantity]);
                   }
       
                   // Insert into sales2 table
                   sales2::create([
                       'bill_no' => $request->bill,
                       'product_code' => $product_code,
                       'product_name' => $request->product_name[$index],
                       'quantity' => $quantity,
                       'unit_price' => $request->unit_price[$index],
                       'total' => $request->total[$index],
                       'sales_type' => $request->type,
                   ]);
               }
       
               // Commit transaction
               DB::commit();
       
               // Set success message and low stock products in session
               session()->flash('messages', "Form submitted successfully! <a href='".route('print', ['bill' => $request->bill, 'customer' => $request->customer])."' target='_BLANK'>Click here to print</a>");
               
               if (!empty($lowStockProducts)) {
                   session()->flash('low_stock_products', $lowStockProducts);
               }
       
               return redirect()->back();
            }else{
               // Rollback transaction
               DB::rollBack();
       
               // Set error message in session
               session()->flash('message', 'Failed to submit form!');
       
               return redirect()->back();
            }         
       }
       public function salesreports(){
        $data=array();
        if(Session::has('uname')){
           $data=erp::where('username','=',Session::get('uname'))->first();
        }
        $salesr=sales1::all();
        return view('salesreport',compact('data','salesr'));
       }
       public function deletesales($bill_no) {
        try {
            // Start a database transaction
            DB::transaction(function () use ($bill_no) {
                // Find the sales records by bill number
                $sales = sales1::where('bill_no',$bill_no)->first();
              
                
                if ($sales) {
                    $sales2Records = sales2::where('bill_no',$bill_no)->get();
                    // Get the product code and quantity before deleting the sales
                    foreach ( $sales2Records as $sales2) {
                        // Get the product code and quantity before deleting the sales
                        $qty = $sales2->quantity;
                        $code = $sales2->product_code;
    
                        // Delete the purchase2 record
                        $sales2->delete();
    
                        // Update the product quantity
                        $product = product::where('product_code', $code)->first();
                        if ($product) {
                            $product->quantity += $qty;
                            $product->save();
                        } else {
                            // Handle the case where the product is not found
                            throw new \Exception('Product not found');
                        }
                    }
    
                    // Delete the purchase1 record
                    $sales->delete();
                } else {
                    // Handle the case where the sales records are not found
                    throw new \Exception('Sales not found');
                }
            });
    
            return back()->with('success', 'Sales deleted successfully and quantity updated successfully');
        } catch (\Exception $e) {
            // Handle exceptions and rollback the transaction
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
   
       }

