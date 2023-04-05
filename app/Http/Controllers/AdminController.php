<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

use App\Models\Product;

use App\Models\Order;

use PDF;

use Notification;

use App\Notifications\sendEmailNotification;

class AdminController extends Controller
{
    public function view_category() {

        $data = Category::all(); 
        return view('admin.category', compact('data'));
    }

    public function add_category(Request $request) {
        $data = new Category;

        $data->category_name = $request->category;

        $data->save();

        return redirect()->back()->with('message', 'Category added successfully');
    }

    public function delete_category($id) {
        $data = Category::find($id);
    
        $data->delete();

        return redirect()->back()->with('message', 'Category deleted successfully');
    }

    public function view_product() {

        $category = Category::all();
        return view('admin.product', compact('category'));
    }

    public function add_product(Request $request) {
        $product = new Product();

        $product->title = $request->title;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->category = $request->category;

        $image = $request->image;

        $imageName = time().'.'.$image->getClientOriginalExtension();

        $request->image->move('product', $imageName);

        $product->image = $imageName;

        $product->save();

        return redirect()->back()->with('message', 'Add Product Successfully');
    }

    public function show_product() {
        
        $product = Product::all();

        return view('admin.show_product', compact('product'));
    }

    public function delete_product($id) {

        $product = Product::find($id);

        $product->delete();

        return redirect()->back()->with('message', 'Product deleted successfully');
    }

    public function update_product($id) {

        $category = Category::all();

        $product = Product::find($id);

        return view('admin.update_product', compact('product', 'category'));

    }

    public function update_product_confirm(Request $request, $id) {

        $product = Product::find($id);

        $product->title = $request->title;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->category = $request->category;

        $image = $request->image;
        
        if ($image) {
            $imageName = time().'.'.$image->getClientOriginalExtension();

            $request->image->move('product', $imageName);

            $product->image = $imageName;
        }

        $product->save();

        return redirect()->back()->with('message', 'Update product successfully');

    }

    public function order() {

        $orders = Order::all();

        return view('admin.order', compact('orders'));

    }

    public function delivered($id) {

        $order = Order::find($id);

        $order->delivery_status = 'Delivered';

        $order->payment_status = 'Paid';

        $order->save();

        return redirect()->back()->with('delivery_success', 'Update Delivery Status Success');

    }

    public function print_pdf($id) {

        $order = Order::find($id);

        $pdf = PDF::loadView('admin.pdf', compact('order'));

        return $pdf->download('order_details.pdf');

    }

    public function send_email($id) {

        $order = Order::find($id);

        return view('admin.email_info', compact('order'));

    }

    public function send_user_email(Request $request, $id) {

        $order = Order::find($id);

        $details = [

            'greeting' => $request->greeting,
            'firstline' => $request->firstline,
            'body' => $request->body,
            'button' => $request->button,
            'url' => $request->url,
            'lastline' => $request->lastline,

        ];

        Notification::send($order, new sendEmailNotification($details));

        return redirect()->back();
    }

    public function search(Request $request) {

        $search_text = $request->search;

        $orders = Order::where('name', 'LIKE' , "%$search_text%")
        ->orWhere('phone', 'LIKE' , "%$search_text%")
        ->orWhere('product_title', 'LIKE' , "%$search_text%")
        ->get();

        return view('admin.order', compact('orders'));

    }

} 
