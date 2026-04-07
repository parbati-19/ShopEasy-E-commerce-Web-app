<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class Shopcontroller extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with(['category' , 'images'])
            ->Active()
            ->Featured()
            ->InStock()
            ->take(8)
            ->get();

        $flashProducts = Product::with(['category' , 'images'])
            ->Active()
            ->Flash()
            ->InStock()
            ->take(8)
            ->get();

        $categories = Category::active()
            ->parent()
            ->withCount('products')
            ->get();

        return Inertia::render('Web/Home',[
            'featuredProducts' => $featuredProducts,
            'flashProducts' => $flashProducts,
            'categories' => $categories
        ]);
    }

    public function shop(){

    }
}