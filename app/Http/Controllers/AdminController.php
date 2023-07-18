<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catagory;
use App\Models\Product;
use App\Models\Order;
use PDF;






class AdminController extends Controller
{
    public function view_catagory()
    {
        $data= catagory::all();
        return view('admin.catagory',compact('data'));
    }
    public function add_catagory(Request $request)
    {
       $data = new catagory;
       $data-> catagory_name=$request->catagory;
       $data-> save();
       return redirect()->back()->with('message','Category added sucessfully');
    }
    public function delete_category($id)
    {
        $data = Catagory::find($id);
        $data->delete();
        return redirect()->back()->with('message','Category deleted sucessfully');
    }
   public function view_product(){
    $catagory = catagory::all();
      return view('admin.product',compact('catagory'));
   }
   public function add_product(Request $request){
    $product =new Product;
    $product ->title=$request->title;
    $product ->description=$request->description;
    $product ->price=$request->price;
    $product ->quantity=$request->quantity;
    $product ->discount_price=$request->dis_price;
    $product ->catagory=$request->catagory;
    $image=$request->image;
    $imagename=time().'.'.$image->getClientOriginalExtension();
    $request->image->move('product',$imagename);
    $product ->image= $imagename;
    $product ->save();
    return redirect()->back()->with('message','Product added sucessfully');
}
public function show_product(){
    $product = Product::all();
    return view('admin.show_product',compact('product'));
}
public function delete_product($id){
    $product = Product::find($id);
    $product->delete();
    return redirect()->back()->with('message','Product deleted sucessfully');
}
public function edit_product($id){
    $product = Product::find($id);
    $catagory = catagory::all();
    return view('admin.edit_product',compact('product','catagory'));
}
public function update_product_confirm (Request $request, $id){
    $product = Product::find($id);
    $product ->title=$request->title;
    $product ->description=$request->description;
    $product ->price=$request->price;
    $product ->quantity=$request->quantity;
    $product ->discount_price=$request->dis_price;
    $product ->catagory=$request->catagory;
    $image=$request->image;
    if($image){
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product',$imagename);
        $product ->image= $imagename;
    }
   
    $product ->save();
    return redirect()->back()->with('message','Product updated sucessfully');

}
public function order (){
    
        $order = order::all();
    return view('admin.order',compact('order'));
}
public function delivered($id){
   $order=order::find($id);
   $order->delivery_status="delivered";
   $order->Payment_status="paid";
   $order->save();
   return redirect()->back();

}
public function print_pdf($id){
    $order=order::find($id);
   // $pdf = PDF::loadView('admin.pdf',compact('order'));
  //  return $pdf->download('order_details.pdf');
}
public function searchData(Request $request){
   $searchText = $request->search;
   $order = order::where('name','LIKE',"%$searchText%")->orWhere('phone','LIKE',"%$searchText%")->orWhere('product_title','LIKE',"%$searchText%")->get();
   return view('admin.order',compact ('order'));
}
}