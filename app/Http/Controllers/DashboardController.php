<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\operation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    

// DashboardController.php
public function index()
{
    $products = Product::all();
    $labels = $products->pluck('name');
    $data = $products->pluck('quantity');

    return view('dashboard', compact('labels', 'data'));
}



}
