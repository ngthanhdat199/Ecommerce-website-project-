<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Models\Product;

use App\Models\Cart;

use App\Models\Order;

use App\Models\Comment;

use App\Models\Reply;

use Session;

use Stripe;

use Illuminate\Support\ServiceProvider;

use Illuminate\Pagination\Paginator;

class HomeController extends Controller
{

    public function index() {
        
        $product = Product::paginate(3);

        $comments = Comment::all();

        $replies = Reply::all();

        return view('home.userpage', compact('product', 'comments', 'replies'));
    }

    public function redirect() {

        $usertype = Auth::user()->usertype;

        if ($usertype == '1') {

            $total_product = Product::all()->count();
            
            $total_order = Order::all()->count();

            $total_user = User::all()->count();

            $orders = Order::all();

            $total_revenue = 0;

            $order_delivered = Order::where('delivery_status', 'Delivered')->count();
            
            $order_processing = Order::where('delivery_status', 'processing')->count();

            foreach($orders as $order) {
                
                $total_revenue += $order->price;
                
            }

            return view('admin.home', compact('total_product', 'total_user', 'total_order', 'total_revenue', 'order_delivered', 'order_processing'));

        } else {
            $product = Product::paginate(3);

            $comments = Comment::all();

            $replies = Reply::all();

            return view('home.userpage', compact('product','comments', 'replies'));
        }
    }

    public function product_details($id) {

        $product = Product::find($id);

        return view('home.product_details', compact('product'));
    }

    public function add_cart(Request $request, $id) {

        // Kiểm tra user có login chưa?
        if (Auth::id()) {

            $user = Auth::user();

            $product = Product::find($id);

            $cart = new Cart;

            $cart->name = $user->name;
            
            $cart->email = $user->email;
            
            $cart->phone = $user->phone;
            
            $cart->address = $user->address;
            
            $cart->user_id = $user->id;
            
            $cart->product_title = $product->title;
            
            if($product->discount_price != NULL) {
              
                $cart->price = ($product->discount_price * $request->quantity);
                
            } else {
    
                $cart->price = ($product->price * $request->quantity);

            }

            $cart->quantity = $request->quantity;

            $cart->image = $product->image;
            
            $cart->product_id = $product->id;

            $cart->save();

            return redirect()->back();

        } else {

            return redirect('login');

        }

    }

    public function show_cart() {

        // Check if the user login id
        if (Auth::id()) {   
            
            $id = Auth::user()->id;
            
            $cart = Cart::where('user_id', '=', $id)->get();
            
            return view('home.show_cart', compact('cart'));
            
        } else {
            return redirect('login');
        }

    }

    public function delete_cart($id) {

        $cart = Cart::find($id);

        $cart->delete();

        return redirect()->back();

    }

    public function cash_order() {

        $user = Auth::user();

        $userId = $user->id;

        $datas = Cart::where('user_id', '=', $userId)->get();

        foreach($datas as $data) {

            $order = new Order;

            $order->name = $data->name;

            $order->email = $data->email;

            $order->phone = $data->phone;
            
            $order->address = $data->address;

            $order->user_id = $data->user_id;

            $order->product_title = $data->product_title;

            $order->price = $data->price;

            $order->quantity = $data->quantity;

            $order->image = $data->image;

            $order->product_id = $data->product_id;

            $order->payment_status = 'Cash on delivery';
            
            $order->delivery_status = 'processing';

            $order->save();

            $cart_id = $data->id;

            $cart = Cart::find($cart_id);

            $cart->delete();

        }

        return redirect()->back()->with('message', 'We have Received Your Order. We will connect to you soon.');
    }


    public function stripe($total_price) {

        return view('home.stripe', compact('total_price'));

    }

    public function stripePost($total_price, Request $request) {



        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $total_price * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks for payment" 
        ]);

        $user = Auth::user();

        $userId = $user->id;

        $datas = Cart::where('user_id', '=', $userId)->get();

        foreach($datas as $data) {

            $order = new Order;

            $order->name = $data->name;

            $order->email = $data->email;

            $order->phone = $data->phone;
            
            $order->address = $data->address;

            $order->user_id = $data->user_id;

            $order->product_title = $data->product_title;

            $order->price = $data->price;

            $order->quantity = $data->quantity;

            $order->image = $data->image;

            $order->product_id = $data->product_id;

            $order->payment_status = 'Paid';
            
            $order->delivery_status = 'processing';

            $order->save();

            $cart_id = $data->id;

            $cart = Cart::find($cart_id);

            $cart->delete();

        }
      
        Session::flash('success', 'Payment successful!');

        return back();
    }

    public function show_order() {

        if (Auth::id()) {   
            
            $id = Auth::user()->id;
            
            $orders = Order::where('user_id', '=', $id)->get();
            
            return view('home.show_order', compact('orders'));
            
        } else {
            return redirect('login');
        }

    }

    public function cancel_order($id) {

        $order = Order::find($id);

        $order->delivery_status = 'Cancel';
        
        $order->save();

        return redirect()->back();

    }

    public function add_comment(Request $request) {

        if(Auth::id()) {

            $comment = new Comment;

            $comment->name = Auth::user()->name;

            $comment->comment = $request->comment;

            $comment->user_id = Auth::user()->id;

            $comment->save();

            return redirect()->back();

        } else {
            return redirect('login');
        }

    }

    public function add_reply(Request $request) {

        if(Auth::id()) {

            $reply = new Reply;

            $reply->name = Auth::user()->name;

            $reply->comment_id = $request->commentId;

            $reply->reply = $request->reply;

            $reply->user_id = Auth::user()->id;

            $reply->save();

            return redirect()->back();
        } else {

            return redirect('login');

        }

    }

}
