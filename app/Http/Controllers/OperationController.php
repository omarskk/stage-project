<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operation; // assure-toi que le modèle existe

class OperationController extends Controller
{
    public function index()
    {
        // Récupérer toutes les opérations avec les informations du produit associé
        $operations = Operation::with('product')->paginate(10);  // Correct way to paginate with relationships

        return view('operations.index', compact('operations'));
    }
}

