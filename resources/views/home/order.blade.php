<!DOCTYPE html>
<html>
   <head>
     <!-- Basic -->
     <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="home/images/favicon.png" type="">
      <title>Famms - Fashion</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
      <style>
          .center{
            margin: auto;
            width: 70%;
            text-align: center;
            padding: 16px;
           
         }
         table,th,td
         {
            border: 1px solid  grey;
            padding: 5px;
            padding-top: 3.5rem;
            padding-left: 1rem;
         }
         .th_deg{
            font-size: 30px;
            padding: 5px;
            background: skyblue;
         }
         .tpg{
            font-size: 20px;
            padding: 40px;
         }
         .img_deg{
            height: 200px;
            width: 200px;
         }
      </style>

   </head>
   <body>
      <div class="hero_area">
         <!--header -->
         @include('home.header')
         @if(session()->has('message'))
             <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
               {{session()->get('message')}}
             </div>
            @endif
     <div class="center">
        <table>
            <tr>
                <th class="th_deg">Product Title</th>
                <th class="th_deg">Quantity</th>
                <th class="th_deg">Price</th>
                <th class="th_deg">Payment Status</th>
                <th class="th_deg">Delivery Status</th>
                <th class="th_deg">Product Image</th>
                <th class="th_deg">Cancel Order</th>
            </tr>
            @foreach($order as $order)
            <tr>
                <td>{{$order->product_title}}</td>
                <td>{{$order->quantity}}</td>
                <td>{{$order->price}}</td>
                <td>{{$order->Payment_status}}</td>
                <td>{{$order->delivery_status}}</td>
                <td><img class="img_deg" src="/product/{{$order->image}}"></td>
                
                <td>
                    @if($order->delivery_status=='processing')
                    <a onclick="return confirm('Are You sure to confirm it !!!')" class ="btn btn-danger" href="{{url('cancel_order',$order->id)}}">Cancel Order</a>
                @else 
                <p style="color:blue;">Not Allowed</p>
                @endif
                </td>
            </tr>
            @endforeach
        </table>
     </div>
        
      </div>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>