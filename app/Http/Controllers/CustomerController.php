<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\erp;
use Session;
use App\customer;

class CustomerController extends Controller
{
    public function customerentry(Request $request){
        $request->validate([
            'id'=>'required',
            'name'=>'required',
            'contact'=>'required',
            'address'=>'required',
            'email'=>'required',
        ]);
        $obj=new customer;
        $obj->customer_id=$request->id;
        $obj->name=$request->name;
        $obj->contact=$request->contact;
        $obj->address=$request->address;
        $obj->email=$request->email;
        $res=$obj->save();
        if($res){
            return back()->with('success','Customers Added Successfully');
         }else{
            return back()->with('fail','Customers Added failed');
         }
    }
    public function customerreports(){
        $data=array();
        if(Session::has('uname')){
           $data=erp::where('username','=',Session::get('uname'))->first();
        }
        $san=customer::all();
        return view('customerreport',compact('san','data'));
    }
    public function deletecustomers($id){
        $sri=customer::find($id)->delete();
        return redirect()->route('customerreport')->with('success','Suppliers deleted successfully');
    }
    public function customeredit($id){
        $data=array();
        if(Session::has('uname')){
           $data=erp::where('username','=',Session::get('uname'))->first();
        }
        $gan=customer::find($id);
        return view('customerupdate',compact('gan','data'));
    }
    public function customerupdate(Request $request,$id){
        $gan=customer::find($id);
        $gan->customer_id=$request->id;
        $gan->name=$request->name;
        $gan->contact=$request->contact;
        $gan->email=$request->email;
        $gan->address=$request->address;
        $gan->update();
        return redirect('customerreport');
    }
}
