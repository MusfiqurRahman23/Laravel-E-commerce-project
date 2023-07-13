<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Session;
use Stripe;


class HomeController extends Controller
{
    public function index(){
        $product = Product::paginate(10);
        return view('home.UserPage',compact('product'));
    }
    public function redirect (){
        $usertype = Auth::user()->usertype;
        if($usertype=='1'){
            return view('admin.home');
        }
        else{
            $product = Product::paginate(10);
        return view('home.UserPage',compact('product'));
        }
    }
    public function product_details($id){
        $product = Product::find($id);
        return view('home.product_details',compact('product'));
    }
    public function add_cart(Request $request,$id){
       if(Auth::id()){
       $user =Auth::user();
       $product = Product::find($id);
       $cart=new cart;
       $cart->name=$user->name;
       $cart->email=$user->email;
       $cart->phone=$user->phone;
       $cart->address=$user->address;
       $cart->user_id=$user->id;
       $cart->product_title=$product->title;
       if($product->discount_price!=null){
        $cart->price=$product->discount_price * $request->quantity;
       }else{
        $cart->price=$product->price * $request->quantity;
       }
       
       $cart->image=$product->image;
       $cart->Product_id=$product->id;
       $cart->quantity=$request->quantity;
       $cart->save();
       return redirect()->back();
       }
       else{
        return redirect('login');
       }
    }
    public function show_cart(){
        if(Auth::id()){
            $id=Auth::user()->id;
            $cart=cart::where('user_id','=',$id)->get();
            return view('home.showcart',compact('cart'));
        }
       else{
        return redirect('login');
       }
    }
    public function remove_cart($id){
        $cart=cart::find($id);
        $cart->delete();
        return redirect()->back();
    }
    public function Cash_Order(){
        $user =Auth::user();
        $userid =  $user->id;
        $data=cart::where('user_id','=',$userid)->get();
        foreach ($data as $data)
          {
                 $oredr =new order;
                 $oredr->name=$data->name;
                 $oredr->email=$data->email;
                 $oredr->phone=$data->phone;
                 $oredr->address=$data->address;
                 $oredr->user_id=$data->user_id;
                 $oredr->product_title=$data->product_title;
                 $oredr->price=$data->price;
                 $oredr->quantity=$data->quantity;
                 $oredr->image=$data->image;
                 $oredr->product_id=$data->Product_id;
                 $oredr->Payment_status='cash on deleivery';
                 $oredr->delivery_status='processing';
                 $oredr-> save();
                 $cart_id=$data->id;
                 $cart=cart::find($cart_id);
                 $cart->delete();

          }
          return redirect()->back()->with('message','We recived your order. Soon, we will connect with you..');
    }
    public function stripe($total_price)
    {
        return view('home.stripe',compact('total_price'));
    }
    public function stripePost(Request $request,$total_price)
    {
        Stripe\stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $total_price * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks for payment" 
        ]);


        $user =Auth::user();
        $userid =  $user->id;
        $data=cart::where('user_id','=',$userid)->get();
        foreach ($data as $data)
          {
                 $oredr =new order;
                 $oredr->name=$data->name;
                 $oredr->email=$data->email;
                 $oredr->phone=$data->phone;
                 $oredr->address=$data->address;
                 $oredr->user_id=$data->user_id;
                 $oredr->product_title=$data->product_title;
                 $oredr->price=$data->price;
                 $oredr->quantity=$data->quantity;
                 $oredr->image=$data->image;
                 $oredr->product_id=$data->Product_id;
                 $oredr->Payment_status='paid';
                 $oredr->delivery_status='processing';
                 $oredr-> save();
                 $cart_id=$data->id;
                 $cart=cart::find($cart_id);
                 $cart->delete();

          }
      
        #Session::flash('success', 'Payment successful!');
       
              
        return back();
    }
    public function products (){
        $product= Product::paginate(10);
        return view('home.all_product',compact('product'));
    }
    
}
