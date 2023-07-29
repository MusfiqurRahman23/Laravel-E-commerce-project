<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Catagory;
use App\Models\Product;
use App\Models\Order;
use PDF;

class AdminController extends Controller
{
    public function view_catagory()
    {
        if(Auth::id()){
            $data= catagory::all();
            return view('admin.catagory',compact('data'));
        }
        else{
            return redirect('login');
           }
       
    }
    public function add_catagory(Request $request)
    {
        if(Auth::id()){
            $data = new catagory;
            $data-> catagory_name=$request->catagory;
            $data-> save();
            return redirect()->back()->with('message','Category added sucessfully');
        }
        else
           {
            return redirect('login');
           }

    }
    public function delete_category($id)
    {
        if(Auth::id())
        {
            $data = Catagory::find($id);
            $data->delete();
            return redirect()->back()->with('message','Category deleted sucessfully');
        }
        else
        {
         return redirect('login');
        }
       
    }
   public function view_product()
   {
    if(Auth::id())
        {
          
           $catagory = catagory::all();
           return view('admin.product',compact('catagory'));
        }
        else
        {
         return redirect('login');
        }
   }
   public function add_product(Request $request)
   {
    if(Auth::id())
    { 
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
    else
    {
     return redirect('login');
    }
    
   
}
    public function show_product()
{
    if(Auth::id())
    { 
    $product = Product::all();
    return view('admin.show_product',compact('product'));
    }
    else
    {
     return redirect('login');
    }
}
public function delete_product($id){
    if(Auth::id())
    { 
    $product = Product::find($id);
    $product->delete();
    return redirect()->back()->with('message','Product deleted sucessfully');
    }
    else
    {
     return redirect('login');
    }
}
public function edit_product($id)
{  
    if(Auth::id())
    { 
    $product = Product::find($id);
    $catagory = catagory::all();
    return view('admin.edit_product',compact('product','catagory'));
    }
    else
    {
     return redirect('login');
    }
}
public function update_product_confirm (Request $request, $id)
{
    if(Auth::id())
    { 
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
else
{
 return redirect('login');
}

}
public function order (){
    if(Auth::id())
    { 
    $order = order::all();
    return view('admin.order',compact('order'));
    }
   else
   {
   return redirect('login');
   }
}
public function delivered($id)
{  if(Auth::id())
    { 
   $order=order::find($id);
   $order->delivery_status="delivered";
   $order->Payment_status="paid";
   $order->save();
   return redirect()->back();
    }
    else
    {
    return redirect('login');
    }

}
public function print_pdf($id){
    if(Auth::id())
    { 
    $order=order::find($id);
   // $pdf = PDF::loadView('admin.pdf',compact('order'));
  //  return $pdf->download('order_details.pdf');
    }
    else
    {
    return redirect('login');
    }
}
public function searchData(Request $request)
{
    if(Auth::id())
    { 
   $searchText = $request->search;
   $order = order::where('name','LIKE',"%$searchText%")->orWhere('phone','LIKE',"%$searchText%")->orWhere('product_title','LIKE',"%$searchText%")->get();
   return view('admin.order',compact ('order'));
    }
    else
    {
    return redirect('login');
    }

}
}