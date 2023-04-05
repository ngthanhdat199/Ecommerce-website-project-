<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style>
        .h2_font {
            text-align: center;
            font-size: 40px;
            padding-top: 40px;
        }

        .center {
            margin: auto;
            width: 50%;
            margin-top: 40px;
            border: 3px solid #fff;
            text-align: center;
        }

        .img_size {
            width: 150px;
            height: 150px;
        }

        .th_color {
            background: skyblue;
        }

        .th_design {
            padding: 35px;
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
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        {{ session()->get('message') }}
                    </div>
                @endif
                <h2 class="h2_font">All Products</h2>

               
                <table class="center">
                    <tr class="th_color">
                        <th class="th_design">Product Title</th>
                        <th class="th_design">Description</th>
                        <th class="th_design">Category</th>
                        <th class="th_design">Quantity</th>
                        <th class="th_design">Price</th>
                        <th class="th_design">Discount Price</th>
                        <th class="th_design">Product image</th>
                        <th class="th_design">Delete</th>
                        <th class="th_design">Edit</th>
                    </tr>
                    @foreach ($product as $item)
                        <tr>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->category }}</td>
                            <td>{{ $item->quantity}}</td>
                            <td>{{ $item->price}}</td>
                            <td>{{ $item->discount_price}}</td>
                            <td>
                                <img class="img_size" src="/product/{{ $item->image }}" >
                            </td>
                            <td>
                                <a onclick="return confirm('Are you sure to delete this?')" class="btn btn-danger" href="{{ url('delete_product', $item->id) }}">Delete</a>
                            </td>
                            <td>
                                <a class="btn btn-success" href="{{ url('update_product', $item->id) }}">Edit</a>
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