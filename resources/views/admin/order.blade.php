<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style>
        .title_deg {
            text-align: center;
            font-size: 25px;
            font-weight: bold;
            padding-bottom: 50px;
        }

        .th_deg {
            background: skyblue;
        }

        .table_deg {
            border: 2px solid #fff;
            width: 100%;
            margin: auto;
            text-align: center
        }

        .img_size {
            width: 150px;
            height: 150px;
        }

        input[type="text"] {
            color: #333;
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

                @if (session()->has('delivery_success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        {{ session()->get('delivery_success') }}
                    </div>
                @endif

                <h1 class="title_deg">All Orders</h1>

                <div style="padding-left: 400px; padding-bottom: 30px">
                    <form action="{{ url('search') }}" method="get">

                        @csrf

                        <input type="text" name="search" placeholder="Search For Something">

                        <input type="submit" value="Search" class="btn btn-outline-primary">
                    </form>
                </div>

                <table class="table_deg">

                    <tr class="th_deg">
                        <th style="padding: 10p" class="th_deg">Name</th>
                        <th style="padding: 10p" class="th_deg">Email</th>
                        <th style="padding: 10p" class="th_deg">Phone</th>
                        <th style="padding: 10p" class="th_deg">Address</th>
                        <th style="padding: 10p" class="th_deg">Product Title</th>
                        <th style="padding: 10p" class="th_deg">Quantity</th>
                        <th style="padding: 10p" class="th_deg">Price</th>
                        <th style="padding: 10p" class="th_deg">Payment Status</th>
                        <th style="padding: 10p" class="th_deg">Delivery Status</th>
                        <th style="padding: 10px">Image</th>
                        <th style="padding: 10px">Delivered</th>
                        <th style="padding: 10px">Print PDF</th>
                        <th style="padding: 10px">Send Email</th>

                    </tr>

                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->email }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->product_title }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>{{ $order->price }}</td>
                            <td>{{ $order->payment_status }}</td>
                            <td>{{ $order->delivery_status }}</td>
                            <td>
                                <img class="img_size" src="/product/{{ $order->image }}" >
                            </td>

                            <td>

                                @if ($order->delivery_status == 'processing')
                                    <a onclick="return confirm('Are you sure this product is delivered? ')" href="{{ url('delivered', $order->id) }}" class="btn btn-primary">Delivered</a>
                                @else

                                    <button class="btn btn-primary" disabled>Delivered</button>

                                @endif

                            </td>

                            <td>

                                <a href="{{ url('print_pdf', $order->id) }}" class="btn btn-secondary">Print PDF</a>

                            </td>

                            <td>

                                <a href="{{ url('send_email', $order->id) }}" class="btn btn-info">Send email</a>

                            </td>

                            

                        </tr>

                        @empty

                        <tr>
                            <td colspan="16">
                                No data found
                            </td>
                        </tr>

                    @endforelse

                    

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