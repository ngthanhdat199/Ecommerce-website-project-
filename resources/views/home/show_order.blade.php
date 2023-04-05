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
            width: 70%;
            text-align: center;
            padding: 50px;
        }

        table, th, td {
            border: 1px solid grey;
        }

        .th_deg {
            font-size: 16px;
            padding: 5px;
            background: skyblue;
        }

        .cancel_btn {
            margin: 0 10px;
        }

      </style>

   </head>
   <body>
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->

         @if (session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{ session()->get('message') }}
            </div>
        @endif

        <div class='center'>
            
            <table>

                <tr>
                    <th class="th_deg">Product Title</th>
                    <th class="th_deg">Quantity</th>
                    <th class="th_deg">Price</th>
                    <th class="th_deg">Payment Status</th>
                    <th class="th_deg">Delivery Status</th>
                    <th class="th_deg">Image</th>
                    <th class="th_deg">Cancel</th>
                </tr>

                @foreach ($orders as $order)
                
                    <tr>
                        <td>{{ $order->product_title }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ $order->price }}</td>
                        <td>{{ $order->payment_status }}</td>
                        <td>{{ $order->delivery_status }}</td>
                        <td>
                            <img width="200" height="250" src="/product/{{ $order->image }}" >
                        </td>
                        <td>
                            @if ($order->delivery_status == 'Cancel' || $order->delivery_status == 'Delivered')
                        
                            <button disabled class="btn btn-danger cancel_btn">Cancel Order</button>

                            @else

                                <a onclick="return confirm('Are you sure want to cancel this order !!!')" href="{{ url('cancel_order', $order->id) }}" class="btn btn-danger cancel_btn">Cancel Order</a>

                            @endif
                        </td>
                        

                       

                    </tr>

                @endforeach

                

            </table>

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