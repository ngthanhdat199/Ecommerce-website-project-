<section class="product_section layout_padding">
    <div class="container">
       <div class="heading_container heading_center">
          <h2>
             Our <span>products</span>
          </h2>
       </div>
       <div class="row">

         @foreach ($product as $item)
             

          <div class="col-sm-6 col-md-4 col-lg-4">
             <div class="box">
                <div class="option_container">
                   <div class="options">
                      <a href=" {{url('product_details', $item->id)}} " class="option1">
                      Product detail
                      </a>
                      <form action="{{ url('add_cart', $item->id) }}" method="POST">

                        @csrf

                        <div class="row">

                           <div class="col-md-4">
                              <input style="width: 100px; margin-top: 4px" type="number" name="quantity" value="1" min="1">
                           </div>

                           <div class="col-md-4">
                              <input type="submit" value="Add To Cart">
                           </div>
                           
                        </div>
                      </form>
                   </div>
                </div>
                <div class="img-box">
                   <img src="product/{{ $item->image }}" alt="">
                </div>
                <div class="detail-box">
                   <h5>
                      {{ $item->title }}
                   </h5>

                   @if ($item->discount_price != NULL)

                     <h6 style="color: red;">
                        Discount price
                        <br>
                        ${{ $item->discount_price }}
                     </h6>

                     <h6 style="color: blue; text-decoration: line-through">
                        Price
                         ${{ $item->price }}
                      </h6>

                      @else

                      <h6 style="color: blue">
                        Price
                         ${{ $item->price }}
                      </h6>


                   @endif

                </div>
             </div>
          </div>

         @endforeach

    </div>
    <div style="margin-top: 20px;">
      {!!$product->links()!!}
   </div>
 </section>