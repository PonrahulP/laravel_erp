<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;
use App\erp;
use Session;
use App\sales1;
use App\purchase1;
use App\customer;
use App\supply;
use App\sales2;
use App\balance;

class ErpController extends Controller
{
   public function registershow(){
    return view('register');
   }
   public function welcomeshow(){
    return view('welcome');
   }
   public function dashshow(){
      $data=array();
      if(Session::has('uname')){
         $data=erp::where('username','=',Session::get('uname'))->first();
      }
      return view('dashboard',compact('data'));
     }
     public function customerentryshow(){
      $data=array();
      if(Session::has('uname')){
         $data=erp::where('username','=',Session::get('uname'))->first();
      }
      return view('customerentry',compact('data'));
     }
     public function stockentryshow(){
      $data=array();
      if(Session::has('uname')){
         $data=erp::where('username','=',Session::get('uname'))->first();
      }
      return view('stockentry',compact('data'));
     }
     public function excelshow(){
      $data=array();
      if(Session::has('uname')){
         $data=erp::where('username','=',Session::get('uname'))->first();
      }
      return view('excel',compact('data'));
     }
     public function supplyentryshow(){
      $data=array();
      if(Session::has('uname')){
         $data=erp::where('username','=',Session::get('uname'))->first();
      }
      return view('supplyentry',compact('data'));
     }
     public function purchaseentryshow(){
      $data=array();
      if(Session::has('uname')){
         $data=erp::where('username','=',Session::get('uname'))->first();
      }
      return view('purchaseentry',compact('data'));
     }
    
     public function expenseentryshow(){
      $data=array();
      if(Session::has('uname')){
         $data=erp::where('username','=',Session::get('uname'))->first();
      }
      return view('expenseentry',compact('data'));
     }
     public function incomeentryshow(){
      $data=array();
      if(Session::has('uname')){
         $data=erp::where('username','=',Session::get('uname'))->first();
      }
      return view('incomeentry',compact('data'));
     }
     public function depositentryshow(){
      $data=array();
      if(Session::has('uname')){
         $data=erp::where('username','=',Session::get('uname'))->first();
      }
      return view('depositentry',compact('data'));
     }
     public function withdrawentryshow(){
      $data=array();
      if(Session::has('uname')){
         $data=erp::where('username','=',Session::get('uname'))->first();
      }
      return view('withdrawentry',compact('data'));
     }
     
     public function billtobillshow(){
      $data=array();
      if(Session::has('uname')){
         $data=erp::where('username','=',Session::get('uname'))->first();
      }
      return view('billtobill',compact('data'));
     }
     public function billtocashshow(){
      $data=array();
      if(Session::has('uname')){
         $data=erp::where('username','=',Session::get('uname'))->first();
      }
      return view('billtocash',compact('data'));
     }
     public function hsnshow(){
      return view('hsn');
     }
     public function balanceentryshow(){
      $data=array();
      if(Session::has('uname')){
         $data=erp::where('username','=',Session::get('uname'))->first();
      }
      return view('balanceentry',compact('data'));
     }
     public function bankbalanceshow(){
      $data=array();
      if(Session::has('uname')){
         $data=erp::where('username','=',Session::get('uname'))->first();
      }
      return view('bankbalance',compact('data'));
     }
     public function cashbalanceshow(){
      $data=array();
      if(Session::has('uname')){
         $data=erp::where('username','=',Session::get('uname'))->first();
      }
      return view('cashbalance',compact('data'));
     }
     public function registeruser(Request $request){
      // echo $request->logo;
      $request->validate([
         'uname'=>'required',
         'pwd'=>'required|min:6|max:12',
         'mail'=>'required',
         'contact'=>'required',
         'role'=>'required',
         'bank'=>'required',
         'cash'=>'required',
         'logo'=>'mimes:JPEG,jpg,png,gif|max:2048',
      ]);
      $imagename=time().".".$request->logo->extension();
      $request->logo->move(public_path("logo"),$imagename);
      $obj=new erp;
      $obj->username=$request->uname;
      $obj->password=Hash::make($request->pwd);
      $obj->email=$request->mail;
      $obj->contact=$request->contact;
      $obj->role=$request->role;
      $obj->openbank=$request->bank;
      $obj->opencash=$request->cash;
      $obj->logo=$imagename;
      $res=$obj->save();
      if($res){
         return back()->with('success','You have registered successfully');
      }else{
         return back()->with('fail','something wrong');
      }
     }
     public function loginuser(Request $request){
      $request->validate([
         'name'=>'required',
         'password'=>'required|min:6|max:12',
      ]);
      $obj=erp::where('username','=',$request->name)->first();
      if($obj){
         if(Hash::check($request->password,$obj->password)){
            $request->session()->put('uname',$obj->username);
            return redirect('dashboard');
         }else{
            return back()->with('fail','This Password is not matched');
         }
        
      }else{
         return back()->with('fail','This username is not registered');
      }
     }
     public function logout(){
      if(Session::has('uname')){
         Session::pull('uname');
         return redirect('welcome');
      }
     }
     public function openbal(){
       $data=array();
      if(Session::has('uname')){
         $data=erp::where('username','=',Session::get('uname'))->first();
      }
      $openingBalance = erp::select('openbank','opencash')->first();
      $bank=balance::where('payment_type','Bank')->first();
      $cash=balance::where('payment_type','Cash')->first();
      $sales1=sales1::all();
      $sales2=sales2::all();
      $scount =sales1::count('bill_no');
      $pcount =purchase1::count('bill_no');
      $ccount=customer::count('customer_id');
      $sucount=supply::count('supplier_id');
      $salesData = sales2::select('product_name', 'quantity')
                         ->orderBy('quantity')
                         ->get();

        $labels = $salesData->pluck('product_name')->toArray();
        $datas = $salesData->pluck('quantity')->toArray();
      return view('dashboard',compact('data','openingBalance','bank','cash','sales1','sales2','scount','ccount','sucount','labels','datas','pcount'));
     }
}
