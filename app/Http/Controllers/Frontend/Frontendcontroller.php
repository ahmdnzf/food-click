<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\About;
use App\Models\Category;
use App\Models\Chef;
use App\Models\Contact;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductRating;
use App\Models\SectionTitle;
use App\Models\Slider;
use App\Models\Testimonial;
use Auth;
use Cache;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class Frontendcontroller extends Controller
{
    function index(): View
    {
        $sectionTitles = $this->getSectionTitles();

        $sliders = Slider::where('status', 1)->get();
        // $categories = Category::where(['show_at_home' => 1, 'status' => 1])->get();
        $chefs = Chef::where(['show_at_home' => 1, 'status' => 1])->get();
        $testimonials = Testimonial::where(['show_at_home' => 1, 'status' => 1])->get();

        $categories = collect(); // Default empty if user is not logged in

        if (Auth::check()) {

            // Get the logged-in user
            $user = Auth::user();

            // Fetch categories the user has purchased from
            $categories = Category::whereIn('id', function ($query) use ($user) {
                $query->select('products.category_id')
                    ->from('products')
                    ->join('order_items', 'order_items.product_id', '=', 'products.id')
                    ->join('orders', 'orders.id', '=', 'order_items.order_id')
                    ->where('orders.user_id', $user->id);
            })->where(['show_at_home' => 1, 'status' => 1])->get();
        }

        return view(
            'frontend.home.index',
            compact(
                'sliders',
                'sectionTitles',
                'categories',
                'chefs',
                'testimonials'
            )
        );
    }

    function getSectionTitles(): Collection
    {
        $keys = [
            'chef_top_title',
            'chef_main_title',
            'chef_sub_title',
            'testimonial_top_title',
            'testimonial_main_title',
            'testimonial_sub_title',
        ];

        return SectionTitle::whereIn('key', $keys)->pluck('value', 'key');
    }

    function chef(): View
    {
        $chefs = Chef::where(['status' => 1])->paginate(8);
        return view('frontend.pages.chefs', compact('chefs'));
    }

    function about(): View
    {
        $about = About::first();
        return view('frontend.pages.about', compact('about'));
    }

    function testimonial(): View
    {
        $testimonials = Testimonial::where(['status' => 1])->paginate(9);
        return view('frontend.pages.testimonial', compact('testimonials'));
    }

    function contact(): View
    {
        $contact = Contact::first();
        return view('frontend.pages.contact', compact('contact'));
    }

    function sendContactMessage(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'max:255'],
            'message' => ['required', 'max: 1000']
        ]);

        Mail::send(new ContactMail($request->name, $request->email, $request->subject, $request->message));

        return response(['status' => 'success', 'message' => 'Message Sent Successfully!']);
    }

    function products(Request $request): View
    {
        $products = Product::where(['status' => 1])->orderBy('id', 'DESC');

        if ($request->has('search') && $request->filled('search')) {
            $products->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('short_description', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('category') && $request->filled('category')) {
            $products->whereHas('category', function ($query) use ($request) {
                $query->where('slug', $request->category);
            });
        }

        $products = $products->withAvg('reviews', 'rating')->withCount('reviews')->paginate(12);

        $categories = Category::where('status', 1)->get();

        return view('frontend.pages.product', compact('products', 'categories'));
    }


    function showProduct(string $slug): View
    {
        $product = Product::with(['productImages', 'productSizes', 'productOptions'])->where([
            'slug' => $slug,
            'status' => 1
        ])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->latest()->get();
        $reviews = ProductRating::where(['product_id' => $product->id, 'status' => 1])->paginate(30);

        return view('frontend.pages.product-view', compact('product', 'relatedProducts', 'reviews'));
    }

    function loadProductModal($productId)
    {
        $product = Product::with(['productSizes', 'productOptions'])->findOrFail($productId);
        return view('frontend.layouts.ajax-files.product-popup-modal', compact('product'))->render();
    }

    function productReviewStore(Request $request)
    {
        $request->validate([
            'rating' => ['required', 'min:1', 'max:5', 'integer'],
            'review' => ['required', 'max:500'],
            'product_id' => ['required', 'integer']
        ]);

        $user = Auth::user();

        // Ensure user has purchased the product before reviewing
        $hasPurchased = $user->orders()->whereHas('orderItems', function ($query) use ($request) {
            $query->where('product_id', $request->product_id);
        })
            ->where('order_status', 'delivered')
            ->get();


        if (count($hasPurchased) == 0) {
            throw ValidationException::withMessages(['Please buy the product before submit a review!']);
        }

        // Check if the user has already reviewed the product
        $alreadyReviewed = ProductRating::where(['user_id' => $user->id, 'product_id' => $request->product_id])->exists();
        if ($alreadyReviewed) {
            throw ValidationException::withMessages(['You already reviewed this product!']);
        }

        // Load list of harsh words
        $harshWords = file(storage_path('app/harsh_words.txt'), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        // Clean and preprocess the review
        $cleanedReview = strtolower($request->review);
        $cleanedReview = preg_replace('/[^a-zA-Z0-9\s]/', '', $cleanedReview); // Remove special characters

        // Check for harsh words
        foreach ($harshWords as $word) {
            if (strpos($cleanedReview, $word) !== false) {
                throw ValidationException::withMessages([
                    'review' => 'Harsh words are not allowed in reviews. Please revise your review.'
                ]);
            }
        }

        // Save the review
        $review = new ProductRating();
        $review->user_id = $user->id;
        $review->product_id = $request->product_id;
        $review->rating = $request->rating;
        $review->review = ucfirst($cleanedReview);
        $review->status = 0;
        $review->save();

        toastr()->success('Review added successfully and waiting to approve');

        return redirect()->back();
    }

    function applyCoupon(Request $request)
    {

        $subtotal = $request->subtotal;
        $code = $request->code;

        $coupon = Coupon::where('code', $code)->first();

        if (!$coupon) {
            return response(['message' => 'Invalid Coupon code'], 422);
        }
        if ($coupon->quantity <= 0) {
            return response(['message' => 'Coupon has been fully redeemed'], 422);
        }
        if ($coupon->expire_date < now()) {
            return response(['message' => 'Coupon has expired'], 422);
        }

        if ($coupon->discount_type === 'percent') {
            $discount = number_format($subtotal * ($coupon->discount / 100), 2);
        } elseif ($coupon->discount_type === 'amount') {
            $discount = number_format($coupon->discount, 2);
        }

        $finalTotal = $subtotal - $discount;

        session()->put('coupon', ['code' => $code, 'discount' => $discount]);

        return response(['message' => 'Coupon Applied Successfully', 'discount' => $discount, 'finalTotal' => $finalTotal, 'coupon_code' => $code]);
    }

    function destroyCoupon()
    {
        try {
            session()->forget('coupon');

            return response(['message' => 'Coupon Removed Successfully!', 'grand_cart_total' => grandCartTotal()]);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'Something went wrong']);
        }
    }
}
