<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\erp;
use Session;
use App\supply;

class SupplyController extends Controller
{
    public function supplyentry(Request $request){
        $request->validate([
            'id'=>'required',
            'name'=>'required',
            'contact'=>'required',
            'address'=>'required',
            'email'=>'required',
        ]);
        $obj=new supply;
        $obj->supplier_id=$request->id;
        $obj->name=$request->name;
        $obj->contact=$request->contact;
        $obj->address=$request->address;
        $obj->email=$request->email;
        $res=$obj->save();
        if($res){
            return back()->with('success','Suppliers Added Successfully');
         }else{
            return back()->with('fail','Suppliers Added failed');
         }
    }
    public function supplyreports(){
        $data=array();
        if(Session::has('uname')){
           $data=erp::where('username','=',Session::get('uname'))->first();
        }
        $san=supply::all();
        return view('supplyreport',compact('san','data'));
    }
    public function deletesuppliers($id){
        $sri=supply::find($id)->delete();
        return redirect()->route('supplyreport')->with('success','Suppliers deleted successfully');
    }
    public function supplyedit($id){
        $data=array();
        if(Session::has('uname')){
           $data=erp::where('username','=',Session::get('uname'))->first();
        }
        $gan=supply::find($id);
        return view('supplyupdate',compact('gan','data'));
    }
    public function supplyupdate(Request $request,$id){
        $gan=supply::find($id);
        $gan->supplier_id=$request->id;
        $gan->name=$request->name;
        $gan->contact=$request->contact;
        $gan->email=$request->email;
        $gan->address=$request->address;
        $gan->update();
        return redirect('supplyreport');
    }
}
