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
            padding-bottom: 40px;
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
        .text_color{
            color: black;
            padding-bottom: 20px;
        }
        label{
            display: inline-block;
            width: 200px;
        }
        .div_design{
            padding-bottom: 15px;
        }
        .img_size{
          height: 150px;
          width: 150px;
          margin: auto;
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
    
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <div class="main-panel">
          <div class="content-wrapper">

          @if(session()->has('message'))
             <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
               {{session()->get('message')}}
             </div>
            @endif
            
          <div class='div_center'>
          <h1 class="h2_font">Update Product Details</h1>


          <form action="{{url('/update_product_confirm',$product->id)}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="div_design">
          <label>Product Title:</label>
          <input class="text_color" type ="text" name="title" placeholder="Write a title" required="" value="{{$product->title}}"> 
          </div>
          <div class="div_design">
          <label>Description:</label>
          <input class="text_color" type ="text" name="description" placeholder="Write about product description" required="" value="{{$product->description}}"> 
          </div>
          
          <div class="div_design">
          <label>Quantity:</label>
          <input class="text_color" type ="number" min="0" name="quantity" placeholder="Write a quantity" required="" value="{{$product->quantity}}"> 
          </div>
          <div class="div_design">
          <label>Price:</label>
          <input class="text_color" type ="number" name="price" placeholder="Write a price" required="" value="{{$product->price}}"> 
          </div>
          <div class="div_design">
          <label>Discount Price:</label>
          <input class="text_color" type ="number"  name="dis_price" placeholder="Write a discount is apply" value="{{$product->discount_price}}"> 
          </div>
          <div class="div_design">
          <label>Category:</label>
          <select class="text_color" name="catagory" required="">
            <option value="{{$product->catagory}}" selected="">{{$product->catagory}}</option>
            @foreach($catagory as $catagory)
            <option>{{$catagory->catagory_name}}</option>
            @endforeach
         
          </select>
          </div>
          <div class="div_design">
          <label>Current Product Image:</label>
          <img class="img_size" src="/product/{{$product->image}}" alt="img">
          </div>
          <div class="div_design">
          <label>Update Product Image:</label>
          <input class="text_color" type ="file" name="image" placeholder="image"  value=""> 
          </div>

          <div class="div_design">
          <input type ="submit" value="Update product" class="btn btn-primary"> 
          </div>
          </form>
          </div>
          </div>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    @include('admin.script')
  </body>
</html>