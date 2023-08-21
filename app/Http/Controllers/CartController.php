<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->has('cart') ? session()->get('cart') : [];
        $categories = Category::all('slug', 'name');
        return view('cart', compact('cart', 'categories'));
    }

    public function add(Request $request)
    {
        $product = $request->get('product');

        //verifica se existe carrinho na sessão
        if (session()->has('cart')) {

            //add produtos no carrinho existindo sessão valida
            session()->push('cart', $product);
        } else {
            //não existe carrinho na sessão valida
            $products[] = $product;

            //vai add carinho na sessã.
            session()->put('cart', $products);
        }
        flash('Produto Adicionado ao carrinho')->success();
        return redirect()->route('cart.index');
    }

    public function remove($slug)
    {
        if (!session()->has('cart')) {

            return redirect()->route('cart.index');
        }
        $products = session()->get('cart');

        $products = array_filter($products, function ($line) use ($slug) {

            return $line['slug'] != $slug;
        });

        session()->put('cart', $products);

        return redirect()->route('cart.index');
    }

    public function cancel()
    {

        session()->forget('cart');

        flash('Compra Cancelada')->success();

        return redirect()->route('home');
    }

    private function productIncrement($slug, $amount, $products)
    {

        $products = array_map(function ($line) use ($slug, $amount) {
            if ($slug == $line['slug']) {
                $line['amount'] += $amount;
            }
            return $line;
        }, $products);

        return $products;
    }
}
