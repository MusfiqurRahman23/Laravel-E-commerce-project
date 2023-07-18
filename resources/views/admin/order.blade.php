<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin</title>
    @include('admin.CSS')
    <style>
       
        .h1_deg{
            font-size: 25px;
            font-weight: bold;
            padding-bottom: 40px;
            text-align: center;
        }
        .table_deg{
            border: 2px solid white;
            margin: auto;
            width: 90%;
        }
        .th_deg{
        text-align: center;
        padding: 10px;
        border: 2px solid white;
        }
        .td_deg{
        text-align: center;
       
        border: 1px solid skyblue;
        }
        .img_size{
          height: 200px;
          width: 230px;
        }
        </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
     @include('admin.sidebar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
      @include('admin.navbar')
      <div class="main-panel">
          <div class="content-wrapper">   

      <h1 class="h1_deg">All Orders </h1>
      <div style="padding-left: 400px; padding-bottom:30px;">

        <form action="{{url('search')}}" method="get">
          @csrf
          <input type="text" style="color: black;" name="search" placeholder="search for something"> 
          <input type="submit" value="Search" class="btn btn-outline-primary">

        </form>
      </div>
      <table class="table_deg">
        <tr>
            <th class="th_deg">Customer Name </th>
            <th class="th_deg">Email </th>
            <th class="th_deg">Phone </th>
            <th class="th_deg">Address </th>
            <th class="th_deg">Product Title </th>
            <th class="th_deg">Quantity </th>
            <th class="th_deg">Price </th>
            <th class="th_deg">Product Id </th>
            <th class="th_deg">Payment status </th>
            <th class="th_deg">Delivery status </th>
            <th class="th_deg">Image </th>
            <th class="th_deg">Delivered </th>
            <th class="th_deg">Print PDF</th>
           
        </tr>
        <tr>
                    @forelse($order as $order)
                    <td class="td_deg">{{$order->name}}</td>
                    <td class="td_deg">{{$order->email}}</td>
                    <td class="td_deg">{{$order->phone}}</td>
                    <td class="td_deg">{{$order->address}}</td>
                    <td class="td_deg">{{$order->product_title}}</td>
                    <td class="td_deg">{{$order->quantity}}</td>
                    <td class="td_deg">{{$order->price}}</td>
                    <td class="td_deg">{{$order->Product_id}}</td>
                    <td class="td_deg">{{$order->Payment_status}}</td>
                    <td class="td_deg">{{$order->delivery_status}}</td>
                    <td class="td_deg"><img class="img_size" src="/product/{{$order->image}}" alt="img"></td>
                    <td class="th_deg">
                    @if($order->delivery_status=='processing')
                     <a class="btn btn-primary" href="{{url('delivered',$order->id)}}" onclick="return confirm('Are you sure this product will deleiverd..!')">Delivered</a>
                   @else 
                   <p style="color:green; font-size:15px">Delivered</p>
                    @endif
                   

                    </td>
                    <td><a href="{{url('print_pdf',$order->id)}" class="btn btn-secondary">Print PDF</a></td>
                </tr>
                @empty
                <tr>
                  <td style="color: red; text-align:center; font-size:40px;" colspan="20">
             
                  <p>No data found.</p>
              
                  </td>
                </tr>
                @endforelse
      </table>
          
        </div>
        <!-- main-panel ends -->
      
      
      <!-- page-body-wrapper ends -->
      </div>
      @include('admin.script')
  </body>
</html>