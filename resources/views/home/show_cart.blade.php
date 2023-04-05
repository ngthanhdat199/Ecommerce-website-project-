<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <base href="/public">
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="home/images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
      
      <style>
        .center {
            margin: auto;
            width: 50%;
            text-align: center;
            padding: 50px;
        }

        table, th, td {
            border: 1px solid grey;
        }

        .th_deg {
            font-size: 30px;
            padding: 5px;
            background: skyblue;
        }

        .img_deg {
            height: 100px;
            width: 100px
        }
        
        .total_deg {
            font-size: 20px;
            padding: 20px;
        }

      </style>

   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->

         @if (session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="center">
            <table>
                <tr>
                    <th class="th_deg">Product title</th>
                    <th class="th_deg">Product quantity</th>
                    <th class="th_deg">Price</th>
                    <th class="th_deg">Image</th>
                    <th class="th_deg">Action</th>
                </tr>

                <?php $total_price = 0; ?>

                @foreach ($cart as $item)

                <tr>
                    <td>{{ $item->product_title }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ $item->price }}</td>
                    <td>
                        <img class="img_deg" src="product/{{ $item->image }}" >
                    </td>
                    <td>
                        <a class="btn btn-danger" onclick="return confirm('Are you sure want to delete this ?')" href="{{ url('delete_cart', $item->id) }}">Delete</a>
                    </td>
                </tr>

                <?php $total_price += $item->price; ?>
                
                @endforeach
                
            </table>

            <div>

                <h1 class="total_deg">Total price: ${{ $total_price }}</h1>

            </div>

            <div>
                <h1 class="total_deg">Procced to Order</h1>

                <a class="btn btn-info" href="{{ url('cash_order') }}">Cash On Delivery</a>
                
                <a class="btn btn-info" href="{{ url('stripe', $total_price) }}">Pay Using Card</a>


            </div>

        </div>

      <!-- footer start -->
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
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