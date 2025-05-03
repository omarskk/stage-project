<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Modele;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // عرض جميع المنتجات
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // عرض نموذج إنشاء منتج جديد
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        $modeles = Modele::all();
        return view('products.create', compact('brands', 'categories', 'modeles'));
    }

    // تخزين منتج جديد أو تحديث الكمية إذا كان موجود
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

        $existingProduct = Product::where('name', $request->name)
            ->where('brand_id', $request->brand_id)
            ->where('modele_id', $request->modele_id)
            ->where('category_id', $request->category_id)
            ->first();

        if ($existingProduct) {
            if ($request->type === 'entrée') {
                $existingProduct->quantity += $request->quantity;
                $existingProduct->save();

                return redirect()->route('products.index')->with('success', 'Quantité ajoutée au produit existant.');
            } elseif ($request->type === 'sortie') {
                if ($existingProduct->quantity >= $request->quantity) {
                    $existingProduct->quantity -= $request->quantity;
                    $existingProduct->save();

                    return redirect()->route('products.index')->with('success', 'Quantité retirée du stock avec succès.');
                } else {
                    return redirect()->back()->with('error', 'Stock insuffisant pour effectuer la sortie.');
                }
            }
        } else {
            if ($request->type === 'entrée') {
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
                return redirect()->back()->with('error', 'Produit introuvable pour effectuer une sortie.');
            }
        }
    }

    // عرض نموذج التعديل
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $brands = Brand::all();
        $categories = Category::all();
        $modeles = Modele::all();

        return view('products.edit', compact('product', 'brands', 'categories', 'modeles'));
    }

    // تحديث منتج موجود
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update([
            'name' => $request->name,
            'brand_id' => $request->brand_id,
            'modele_id' => $request->modele_id,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('products.index')->with('success', 'Produit mis à jour avec succès.');
    }

    // حذف منتج
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produit supprimé.');
    }
}
