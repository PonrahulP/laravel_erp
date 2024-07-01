<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\erp;
use App\product;
use Session;

class ProductController extends Controller
{
    public function productentry(Request $request){
        $request->validate([
            'name'=>'required',
            'code'=>'required',
            'desc'=>'required',
            'qty'=>'required',
            'uprice'=>'required',
            'image'=>'mimes:JPEG,jpg,png,gif|max:2048',
        ]);
        $imagename=time().".".$request->image->extension();
      $request->image->move(public_path("images"),$imagename);
      $obj=new product;
      $obj->product_name=$request->name;
      $obj->product_code=$request->code;
      $obj->description=$request->desc;
      $obj->unit_price=$request->uprice;
      $obj->quantity=$request->qty;
      $obj->image=$imagename;
      $res=$obj->save();
      if($res){
        return back()->with('success','Products Added Successfully');
     }else{
        return back()->with('fail','Products Added failed');
     }
    }
    public function stockreports(){
        $data=array();
        if(Session::has('uname')){
           $data=erp::where('username','=',Session::get('uname'))->first();
        }
        $san=product::all();
        return view('stockreport',compact('san','data'));
    }
    public function deleteproducts($id){
        $sri=product::find($id)->delete();
        return redirect()->route('stockreport')->with('success','Products deleted successfully');
    }
    public function productedit($id){
        $data=array();
        if(Session::has('uname')){
           $data=erp::where('username','=',Session::get('uname'))->first();
        }
        $gan=product::find($id);
        return view('stockupdate',compact('gan','data'));
    }
    public function productupdate(Request $request,$id){
        $request->validate([
            'uimage'=>'mimes:JPEG,jpg,gif,png|max:2048',
        ]);
        $gan=product::find($id);
        $imagename=time().".".$request->uimage->extension();
        $request->uimage->move(public_path('images'),$imagename);
        $gan->product_name=$request->name;
        $gan->product_code=$request->code;
        $gan->description=$request->desc;
        $gan->quantity=$request->qty;
        $gan->unit_price=$request->uprice;
        $gan->image=$imagename;
        $gan->update();
        return redirect('stockreport');
    }
    public function import(Request $request){
        $request->validate([
            'excel'=>'required|mimes:xlsx,xls,csv',
        ]);
        try {
            Excel::import(new UsersImport, $request->file('excel'));
            return back()->with('success', 'Users imported successfully.');
        } catch (\Exception $e) {
            return back()->with('fail', 'Error importing users: ' . $e->getMessage());
        }
    }
}
