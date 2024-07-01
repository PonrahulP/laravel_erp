<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\erp;
use App\balance;

class BalanceController extends Controller
{
    public function balanceentry(Request $request){
        $request->validate([
            'type'=>'required',
            'amnt'=>'required',
        ]);
        $obj=new balance;
        $obj->payment_type=$request->type;
        $obj->amount=$request->amnt;
        $res=$obj->save();
        if($res){
            return back()->with('success','Balance Added Successfully');
         }else{
            return back()->with('fail','Balance Added failed');
         }
    }
    public function balancereports(){
        $data=array();
        if(Session::has('uname')){
           $data=erp::where('username','=',Session::get('uname'))->first();
        }
        $balance=balance::all();
        return view('balancereport',compact('san','balance','data'));
    }
    public function deletebalance($id){
        $sri=balance::find($id)->delete();
        return redirect()->route('balancereport')->with('success','Balance deleted successfully');
    }
    public function balanceedit($id){
        $data=array();
        if(Session::has('uname')){
           $data=erp::where('username','=',Session::get('uname'))->first();
        }
        $gan=balance::find($id);
        return view('balanceupdate',compact('gan','data'));
    }
    public function balanceupdate(Request $request,$id){
        $gan=balance::find($id);
        $gan->payment_type=$request->type;
        $gan->amount=$request->amnt;
        $gan->update();
        return redirect('balancereport');
    }
}
