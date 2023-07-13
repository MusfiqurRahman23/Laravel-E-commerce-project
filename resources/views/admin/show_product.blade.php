<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin</title>
    @include('admin.CSS')
    <style>
        .div_center {
            text-align: center;
            padding-top: 40px;
        }
        .h2_font{
            font-size: 40px;
           
            padding-top: 20px;
            text-align: center;
        }
        .input_color{
            color: black;
        }
        .center{
          margin: auto;
          text-align: center;
          margin-top: 40px;
          width: 50%;
          border: 3px solid white;
        }
        .th_color{
            color: blue;
            background: skyblue;
        }
        .img_size{
          height: 150px;
          width: 150px;
        }
        .th_deg{
          padding: 30px;
        }
        
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
     @include('admin.sidebar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('admin.navbar')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">

          <div class='div_center'>
          @if(session()->has('message'))
             <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
               {{session()->get('message1')}}

               <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
               {{session()->get('message2')}}
             </div>
            @endif
            <h2 class="h2_font">All Products</h2>
            <table class="center">
                <tr class="th_color">
                    <th class="th_deg">Product Title</th>
                    <th class="th_deg">Description</th>
                    <th class="th_deg">Quantity</th>
                    <th class="th_deg">Category</th>
                    <th class="th_deg">Price</th>
                    <th class="th_deg">Discount Price</th>
                    <th class="th_deg">Product image</th>
                    <th class="th_deg">Delete</th>
                    <th class="th_deg">Edit</th>
                </tr>
                <tr>
                    @foreach($product as $product)
                    <td>{{$product->title}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>{{$product->catagory}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->discount_price}}</td>
                    <td><img class="img_size" src="/product/{{$product->image}}" alt="img"></td>
                    <td><a class="btn btn-danger" href="{{url('delete_product',$product->id)}}">Delete</a></td>
                    <td><a class="btn btn-success" href="{{url('edit_product',$product->id)}}">Edit</a></td>


                </tr>
                @endforeach
            </table>
          </div>
          </div>
        </div>
          <!-- content-wrapper ends --> 
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    @include('admin.script')
  </body>
</html>