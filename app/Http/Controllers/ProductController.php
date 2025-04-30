<?php

namespace App\Http\Controllers;
use App\Models\Brand;
use App\Models\category;
use App\Models\modele;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
{
    $brands = Brand::all();
    $categories = Category::all();
    return view('products.create', compact('brands', 'categories'));
}

    

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'brand_id' => 'required|exists:brands,id',
        'modele_id' => 'required|exists:modeles,id',
        'category_id' => 'required|exists:categories,id',
        'price' => 'required|numeric|min:0',
        'quantity' => 'required|integer|min:1',
        'type' => 'required|in:entrée,sortie'
    ]);

    // On cherche un produit existant avec les mêmes attributs
    $existingProduct = Product::where('name', $request->name)
        ->where('brand_id', $request->brand_id)
        ->where('modele_id', $request->modele_id)
        ->where('category_id', $request->category_id)
        ->first();

    if ($existingProduct) {
        if ($request->type === 'entrée') {
            // Entrée : on augmente la quantité
            $existingProduct->quantity += $request->quantity;
            $existingProduct->save();
            return redirect()->route('products.index')->with('success', 'Quantité ajoutée au produit existant.');
        } elseif ($request->type === 'sortie') {
            // Sortie : on vérifie si la quantité est suffisante
            if ($existingProduct->quantity >= $request->quantity) {
                $existingProduct->quantity -= $request->quantity;
                $existingProduct->save();
                return redirect()->route('products.index')->with('success', 'Quantité retirée du stock avec succès.');
            } else {
                return redirect()->back()->with('error', 'Stock insuffisant pour effectuer la sortie.');
            }
        }
    } else {
        // Produit introuvable
        if ($request->type === 'entrée') {
            // S'il s'agit d'une entrée, on peut créer le produit
            Product::create([
                'name' => $request->name,
                'brand_id' => $request->brand_id,
                'modele_id' => $request->modele_id,
                'category_id' => $request->category_id,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'type' => $request->type,
            ]);
            return redirect()->route('products.index')->with('success', 'Nouveau produit ajouté au stock.');
        } else {
            // S'il s'agit d'une sortie mais le produit n'existe pas
            return redirect()->back()->with('error', 'Produit introuvable pour effectuer une sortie.');
        }
    }
}



public function edit($id)
{    $modeles = Modele::all();  // Fetch all models (or adjust to fit your logic)
    $categories = Category::all();  // Ensure categories are fetched

    $product = Product::find($id);
    $brands = Brand::all();  // Assuming you have a Brand model that retrieves all brands from the database
    return view('products.edit', compact('product', 'brands',"modeles",'categories'));
}

public function update(Request $request, $id)
{
    $product = Product::find($id);

    // Vérifie si le produit existe
    if (!$product) {
        return back()->with('error', 'Produit introuvable pour effectuer une sortie.');
    }

    // Validation des données
    $request->validate([
        'name' => 'required|string',
        'brand_id' => 'required|exists:brands,id',
        'modele_id' => 'required|exists:modeles,id',
        'category_id' => 'required|exists:categories,id',
        'price' => 'required|numeric',
        'quantity' => 'required|integer|min:1',
        'type' => 'required|in:entrée,sortie',
    ]);

    // Gestion de la quantité selon le type
    if ($request->type === 'sortie') {
        if ($request->quantity > $product->quantity) {
            return back()->with('error', 'La quantité demandée dépasse le stock disponible.');
        }

        $product->quantity -= $request->quantity;
    } else {
        $product->quantity += $request->quantity;
    }

    // Mise à jour des autres champs
    $product->name = $request->name;
    $product->brand_id = $request->brand_id;
    $product->modele_id = $request->modele_id;
    $product->category_id = $request->category_id;
    $product->price = $request->price;

    $product->save();

    return redirect()->route('products.index')->with('success', 'Produit mis à jour avec succès.');
}
}
