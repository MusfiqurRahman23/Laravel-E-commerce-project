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
               {{session()->get('message')}}
             </div>
            @endif
            <h2 class="h2_font">Add Category</h2>
            <form action="{{url('/add_catagory')}}" method="POST">
                @csrf
                <input class="input_color" type="text" name='catagory' placeholder="Write Category name:">
                <input type="submit" name="submit" class="btn btn-primary" value="Add Category">
            </form>
          </div>
          <table class="center">
            <tr>
              <td> Category Name </td>
              <td> Action </td>
            </tr>
            @foreach($data as $data)
           
            <tr>
              <td>{{$data->catagory_name}} <hr></td> 
              <td><a onclick="return confirm('Are You Sure To Delete It!')" class="btn btn-danger" href="{{url('delete_category',$data->id)}}">Delete</a></td>
            </tr>
            @endforeach
          </table>
          </div>
        </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
         @include('admin.footer')
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    @include('admin.script')
  </body>
</html>