<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // private $product;

    // public function __construct(Product $product)
    // {
    //     $this->product = $product;
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::orderBy('id','desc')->paginate(9);
            

        return view('welcome', compact('products'));
    }

    public function single($slug)
    {

        $product = Product::whereSlug($slug)->first();

        return view ('single', compact('product'));
    }
}
