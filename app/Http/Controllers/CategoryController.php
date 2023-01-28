<?php

namespace App\Http\Controllers;

use App\DataTables\CategoriesDataTable;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request, CategoriesDataTable $dataTable)
    {
        if ($request->ajax()) {
            return $dataTable->render();
        }

        $table = $dataTable->html();
        return view('categories.index', ['table' => $table]);
    }

    public function create(): View
    {
        return view('categories.form');
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        Category::create($request->validated());

        return redirect()->route('categories.index')
            ->with('success', 'Berhasil!')
            ->with('success_message', 'Data berhasil ditambahkan');
    }

    public function edit(Category $category): View
    {
        return view('categories.form', ['category' => $category]);
    }

    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->validated());

        return redirect()->route('categories.index')
            ->with('success', 'Berhasil!')
            ->with('success_message', 'Data berhasil diubah');
    }

    public function destroy(Request $request, Category $category): RedirectResponse | JsonResponse
    {
        $category->delete();

        if ($request->ajax()) {
            return response()->json([
                'success' => 'Berhasil!',
                'success_message' => 'Data kategori berhasil dihapus.'
            ]);
        }

        return redirect()->route('categories.index')
            ->with('success', 'Berhasil!')
            ->with('success_message', 'Data berhasil dihapus.');
    }

    public function select2(Request $request): JsonResponse
    {
        $results = Category::select('id', 'name AS text')
            ->where('name', 'LIKE', "%{$request->search}%")
            ->limit(10)
            ->get();

        return response()->json(['results' => $results]);
    }
}
