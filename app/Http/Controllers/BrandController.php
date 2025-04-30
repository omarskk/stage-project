<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    // Afficher la liste des marques
    public function index()
    {
        $brands = Brand::paginate(10); // Récupère toutes les marques avec pagination
        return view('brand.index', compact('brands'));
    }

    // Afficher le formulaire d'ajout de marque
    public function create()
    {
        return view('brand.create');
    }

    // Ajouter une nouvelle marque
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Brand::create([
            'name' => $request->name,
        ]);

        return redirect()->route('brand.index')->with('success', 'Marque ajoutée avec succès');
    }
    public function edit($id)
{
    $brand = Brand::findOrFail($id);
    return view('brand.edit', compact('brand'));
}
public function update(Request $request, $id)
{
    $brand = Brand::findOrFail($id);
    
    $request->validate([
        'name' => 'required|string|max:255',
    ]);
    
    $brand->update([
        'name' => $request->name,
    ]);
    
    session()->flash('success', 'La marque a été mise à jour avec succès!');
    return redirect()->route('brand.index');
}
public function destroy($id)
{
    $brand = Brand::findOrFail($id);
    $brand->delete();

    session()->flash('success', 'La marque a été supprimée avec succès!');
    return redirect()->route('brand.index');
}

}
