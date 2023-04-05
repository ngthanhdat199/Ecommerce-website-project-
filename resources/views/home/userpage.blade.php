<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <title>Famms - Fashion HTML Template</title>
      <link rel="shortcut icon" href="home/images/favicon.png" type="">
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header');
         <!-- end header section -->

         <!-- slider section -->
         @include('home.slider');
         <!-- end slider section -->

      </div>
      <!-- why section -->
      @include('home.why')
      <!-- end why section -->
      
      <!-- arrival section -->
      @include('home.arrival')
      <!-- end arrival section -->
      
      <!-- product section -->
      @include('home.new_product')
      <!-- end product section -->


      <!-- Comment and reply section -->
      
      <div style="text-align: center; padding-bottom: 30px">
         <h1 style="font-size: 30px; text-align: center; padding-top: 20px" >Comments</h1>

         <form action="{{ url('add_comment') }}" method="POST">

            @csrf

            <textarea style="height: 150px; width: 600px" placeholder="Comment something here" name="comment"></textarea>

            <br>
            <input type="submit" class="btn btn-primary" value="Commnet">
         </form>

      </div>

      <div style="padding-left: 20%">
         <h1 style="font-size: 20px; padding-bottom: 20px">All Comment</h1>

         @foreach ($comments as $comment)
            <div>
               <b>{{ $comment->name }}</b>
               <p>{{ $comment->comment }}</p>

               <a style="color: blue" href="javascript::void(0);" onclick="reply(this)" data-Commentid = "{{ $comment->id }}">Reply</a>

               @foreach ($replies as $reply)
                  @if($reply->comment_id == $comment->id) 
                  <div style="padding-left: 3%; padding-bottom: 10px;">
                     <b>{{ $reply->name }}</b>
                     <p>{{ $reply->reply }}</p>

                     <a style="color: blue" href="javascript::void(0);" onclick="reply(this)" data-Commentid = "{{ $comment->id }}">Reply</a>

                  </div>
                  
                  @endif
               @endforeach

               

            </div>

            

         @endforeach

         <div style="display: none" id="replyDiv">

            <form action="{{ url('add_reply') }}" method="POST">
               @csrf

               <input type="text" id = "commentId" name="commentId" hidden>

               <textarea style="height: 100px; width: 500px" placeholder="write something here" name="reply"></textarea>
            
               <br>
   
               <input style="margin: 0; margin-bottom: 30px" type="submit" class="btn btn-primary" value="Reply">

               <a href="javascript::void(0);" onclick="reply_close(this)">Close</a>

            </form>

         </div>

      </div>


      

      <!-- end Comment and reply section -->


      <!-- subscribe section -->
      @include('home.subcribe')
      <!-- end subscribe section -->

      <!-- client section -->
      @include('home.client')
      <!-- end client section -->

      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>

      <script>
         function reply(caller) {

            document.getElementById('commentId').value=$(caller).attr('data-Commentid');

            $("#replyDiv").insertAfter($(caller));

            $("#replyDiv").show();
         }

         function reply_close(caller) {
            $("#replyDiv").hide();
         }

      </script>

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