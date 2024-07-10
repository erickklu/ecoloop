<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function generateReport()
    {
        $sold = Entry::where('category_id', '3')->where('state', 'NO DISPONIBLE')->get();
        $exchanged = Entry::where('category_id', '2')->where('state', 'NO DISPONIBLE')->get();
        $donated = Entry::where('category_id', '1')->where('state', 'NO DISPONIBLE')->get();


        $vendidos = Entry::where('category_id', '3')->where('state', 'NO DISPONIBLE')->count();
        $intercambiados = Entry::where('category_id', '2')->where('state', 'NO DISPONIBLE')->count();
        $donados = Entry::where('category_id', '1')->where('state', 'NO DISPONIBLE')->count();
        
        $available = Entry::where('state', 'DISPONIBLE')->get();

        return view('reports.index', compact('sold', 'exchanged', 'donated', 'available', 'vendidos', 'intercambiados', 'donados'));
    }
}
