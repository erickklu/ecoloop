<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use App\Models\Entry;
use App\Models\RequestedEntry;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class EntryController extends VoyagerBaseController
{
    public function store(Request $request)
    {

        $request->merge(['user_id' => Auth::id()]);

        return parent::store($request);
    }

    public function ViewEntries(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $categoryId = $request->input('category_id');
        $sortBy = $request->input('sort_by');

        $query = Entry::where('state', 'DISPONIBLE');

        if ($fromDate) {
            $query->whereDate('created_at', '>=', $fromDate);
        }

        if ($toDate) {
            $query->whereDate('created_at', '<=', $toDate);
        }

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        switch ($sortBy) {
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'az':
                $query->orderBy('title', 'asc');
                break;
            case 'za':
                $query->orderBy('title', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $publicaciones = $query->paginate(9);
        $categorias = Category::withCount(['publicaciones' => function($query) {
            $query->where('state', 'DISPONIBLE');
        }])->get();

        return view('entries.index', compact('publicaciones', 'categorias', 'fromDate', 'toDate', 'sortBy', 'categoryId'));
    }

    public function DetailEntry($id)
    {
        $publicacion = Entry::with('category')->findOrFail($id);

        if (auth()->check()) {
            $userId = Auth::id();
            $solicitudExistente = RequestedEntry::where('user_id', $userId)
                ->where('entry_id', $id)
                ->exists();
                
            $favoritas = auth()->user()->favoriteEntries->pluck('id')->toArray();


        } else {
            $solicitudExistente = false;
            $favoritas = [];
        }
        $relacionadas = Entry::where('category_id', $publicacion->category_id)
            ->where('id', '!=', $id)
            ->where('state', 'DISPONIBLE')
            ->take(4)
            ->get();

        return view('entries.detalle', compact('publicacion', 'relacionadas', 'favoritas', 'solicitudExistente'));
    }

    public function filterByCategory($categoryId, Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $sortBy = $request->input('sort_by');

        $query = Entry::where('category_id', $categoryId)->where('state', 'DISPONIBLE');

        if ($fromDate) {
            $query->whereDate('created_at', '>=', $fromDate);
        }

        if ($toDate) {
            $query->whereDate('created_at', '<=', $toDate);
        }

        switch ($sortBy) {
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'az':
                $query->orderBy('title', 'asc');
                break;
            case 'za':
                $query->orderBy('title', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $publicaciones = $query->paginate(9);
        $categorias = Category::withCount('publicaciones')->get();

        return view('entries.index', compact('publicaciones', 'categorias', 'categoryId', 'fromDate', 'toDate', 'sortBy'));
    }
}
