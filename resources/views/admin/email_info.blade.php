<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <base href="/public">
    @include('admin.css')

    <style>
        label {
            display: inline-block;
            width: 200px;
            font-size: 16px;
            font-weight: bold;
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
        
        <div class="main-panel">
            <div class="content-wrapper">
                <h1 style="text-align: center; font-size: 25px">Send Email to {{ $order->email }}</h1>

                <form action="{{ url('send_user_email', $order->id) }}" method="POST">

                    @csrf

                    <div style="padding-left: 35%; padding-top: 30px">
                        <label>Email Greeting: </label>
    
                        <input type="text" name="greeting">
                    </div>

                    <div style="padding-left: 35%; padding-top: 30px">
                        <label>Email Firstline: </label>
    
                        <input type="text" name="firstline">
                    </div>

                    <div style="padding-left: 35%; padding-top: 30px">
                        <label>Email Body: </label>
    
                        <input type="text" name="body">
                    </div>

                    <div style="padding-left: 35%; padding-top: 30px">
                        <label>Email Button name: </label>
    
                        <input type="text" name="button">
                    </div>

                    <div style="padding-left: 35%; padding-top: 30px">
                        <label>Email Url: </label>
    
                        <input type="text" name="url">
                    </div>

                    <div style="padding-left: 35%; padding-top: 30px">
                        <label>Email Last Line: </label>
    
                        <input type="text" name="lastline">
                    </div>

                    <div style="padding-left: 35%; padding-top: 30px">
    
                        <input type="submit" value="Send Email" class="btn btn-primary">
                    </div>

                </form>

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