<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use App\Models\Entry;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class EntryController extends VoyagerBaseController
{
    public function store(Request $request)
    {

        $request->merge(['user_id' => Auth::id()]);
        
        return parent::store($request);
    }

    public function ViewEntrys()
    {
        $publicaciones = Entry::orderBy('created_at', 'desc')->paginate(9);
        $categorias = Category::all();
        return view('entrys.index', compact('publicaciones', 'categorias'));
    }

    /*  public function DetailEntry($id)
    {
        $publicacion = Entry::findOrFail($id);

        return view('entrys.detalle', compact('publicacion'));
    } */

    public function DetailEntry($id)
{
    $publicacion = Entry::with('category')->findOrFail($id);
    $relacionadas = Entry::where('category_id', $publicacion->category_id)
                          ->where('id', '!=', $id) 
                          ->take(4) 
                          ->get();

        return view('entrys.detalle', compact('publicacion', 'relacionadas'));
    }

    public function filterByCategory($categoryId)
    {
        $publicaciones = Entry::where('category_id', $categoryId)->get();
        $categorias = Category::all();

        return view('entrys.index', compact('publicaciones', 'categorias', 'categoryId'));
    }
}
