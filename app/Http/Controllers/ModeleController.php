<?php

namespace App\Http\Controllers;
use App\Models\Modele;
use App\Models\Brand;

use Illuminate\Http\Request;

class ModeleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modeles = Modele::with('brand')->get();
        return view('modeles.index', compact('modeles'));
    }
    
    public function create()
    {
        $brands = Brand::all();
        return view('modeles.create', compact('brands'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id',
        ]);
    
        Modele::create($request->all());
    
        return redirect()->route('modele.index')->with('success', 'Modèle ajouté avec succès.');
    }
    
    public function destroy($id)
    {
        $modele = Modele::findOrFail($id);
        $modele->delete();
    
        return redirect()->route('modele.index')->with('success', 'Modèle supprimé avec succès.');
    }
    public function getByBrand($brand_id)
{
    $modeles = Modele::where('brand_id', $brand_id)->get();
    return response()->json($modeles);
}

    
}
