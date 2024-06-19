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

    public function ViewEntrys(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        $query = Entry::query();

        if ($fromDate) {
            $query->whereDate('created_at', '>=', $fromDate);
        }

        if ($toDate) {
            $query->whereDate('created_at', '<=', $toDate);
        }

        $publicaciones = $query->orderBy('created_at', 'desc')->paginate(9);
        $categorias = Category::withCount('publicaciones')->get();

        return view('entrys.index', compact('publicaciones', 'categorias', 'fromDate', 'toDate'));
    }

    /*  public function DetailEntry($id)
    {
        $publicacion = Entry::findOrFail($id);

        return view('entrys.detalle', compact('publicacion'));
    } */

    public function DetailEntry($id)
    {
        $publicacion = Entry::with('category')->findOrFail($id);
        if (auth()->check()) {
            $favoritas = auth()->user()->favoriteEntries->pluck('id')->toArray();
        } else {
            $favoritas = [];
        }
        $relacionadas = Entry::where('category_id', $publicacion->category_id)
            ->where('id', '!=', $id)
            ->take(4)
            ->get();

        return view('entrys.detalle', compact('publicacion', 'relacionadas', 'favoritas'));
    }

    public function filterByCategory($categoryId)
    {
        $publicaciones = Entry::where('category_id', $categoryId)->paginate(9);
        $categorias = Category::withCount('publicaciones')->get();

        return view('entrys.index', compact('publicaciones', 'categorias', 'categoryId'));
    }
}
