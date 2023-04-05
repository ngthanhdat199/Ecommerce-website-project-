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

        .h1_font {
            font-size: 40px;
            padding-bottom: 40px;
        }

        .text_color {
            color: #333;
            padding-bottom: 10px;
        }

        label {
            display: inline-block;
            width: 200px;
        }

        .div_design {
            padding-bottom: 20px;
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

                    <h1 class="h1_font">Add Product</h1>

                    <form action="{{ url('add_product') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="div_design">
                            <label>Product Title:</label>
                            <input class="text_color" type="text" name="title" placeholder="Enter a title" required>
                        </div>
                        <div class="div_design">
                            <label>Product Description:</label>
                            <input class="text_color" type="text" name="description" placeholder="Enter a description" required>
                        </div>
                        <div class="div_design">
                            <label>Product Quantity:</label>
                            <input class="text_color" type="number" min="0" name="quantity" placeholder="Enter a quantity" required>
                        </div>
                        <div class="div_design">
                            <label>Product Price</label>
                            <input class="text_color" type="number" name="price" placeholder="Enter a price" required>
                        </div>
                        <div class="div_design">
                            <label>Discout Price:</label>
                            <input class="text_color" type="number" name="discount_price" placeholder="Enter a discount price">
                        </div>
                        <div class="div_design">
                            <label>Product Category:</label>
                            <select class="text_color" name="category" required>

                                <option disabled selected>Add product category</option>

                                @foreach ($category as $item)
                                    <option value="{{ $item->category_name }}" >{{ $item->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="div_design">
                            <label>Product Image Here:</label>
                            <input type="file" name="image" placeholder="Enter a image link" required> 
                        </div>
                        <div class="div_desgin">
                            <input class="btn btn-primary" type="submit" value="Add Product">
                        </div>


                    </form>

                </div>
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