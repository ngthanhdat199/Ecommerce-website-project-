<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style>
        .div_center {
            text-align: center;
            padding-top: 40px;
        }

        .h2_font {
            font-size: 40px;
            padding-bottom: 40px;
        }

        .inp_color {
            color: #333;
        }

        .center {
          margin: auto;
          width: 50%;
          text-align: center;
          border: 3px solid #fff;
          margin-top: 30px;
        }

        .center tr td {
          border: 3px solid #fff;
          padding: 10px 0;
        }

    </style>

  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar');
      <!-- partial -->
        @include('admin.header');

        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="div_center">
                    
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            {{ session()->get('message') }}
                        </div>
                    @endif

                    <h2 class="h2_font">Add Category</h2>

                    <form action=" {{url('/add_category')}} " method="POST">

                        @csrf

                        <input class="inp_color" type="text" name="category" placeholder="Enter a category name">
    
                        <input class="btn btn-primary" type="submit" name="Submit" value="Add Category">
                    </form>
                </div>

                <table class="center">
                    <tr>
                      <td>Category name</td>
                      <td>Action</td>
                    </tr>

                    @foreach ($data as $item)
                        <tr>
                          <td>{{ $item->category_name }}</td>
                          <td>
                            <a onclick="confirm('Are You Sure To Delete This ???')" class="btn btn-danger" href="{{url('delete_category', $item->id)}}">Delete</a>
                          </td>
                        </tr>
                    @endforeach
                </table>

            </div>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.js');
  </body>
</html>