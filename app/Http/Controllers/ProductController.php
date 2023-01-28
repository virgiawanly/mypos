<?php

namespace App\Http\Controllers;

use App\DataTables\ProductsDataTable;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request, ProductsDataTable $dataTable)
    {
        if ($request->ajax()) {
            return $dataTable->render();
        }

        $table = $dataTable->html();
        return view('products.index', ['table' => $table]);
    }

    public function create(): View
    {
        $category = old('category_id') ? Category::find(old('category_id')) : null;
        $unit = old('unit_id') ? Unit::find(old('unit_id')) : null;

        return view('products.form', ['category' => $category, 'unit' => $unit]);
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        $payload = $request->validated();

        if ($request->file('image')) {
            $file = $request->file('image');
            $imgPath = config('files.product_image_dir');
            $imgExt = $file->extension();
            $imgName = Str::slug($request->code . "-" . $request->name . "-" . uniqid()) . "." . $imgExt;
            Storage::putFileAs($imgPath, $file, $imgName);

            $payload['image'] = $imgName;
        }

        Product::create($payload);

        return redirect()->route('products.index')
            ->with('success', 'Berhasil!')
            ->with('success_message', 'Data berhasil ditambahkan');
    }

    public function show(Product $product): View
    {
        return view('products.detail', ['product' => $product]);
    }

    public function edit(Product $product): View
    {
        return view('products.form', ['product' => $product]);
    }

    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $payload = $request->except(['stock']);

        if ($request->file('image')) {
            // Store new image
            $file = $request->file('image');
            $imgPath = config('files.product_image_dir');
            $imgExt = $file->extension();
            $imgName = Str::slug($request->code . "-" . $request->name . "-" . uniqid()) . "." . $imgExt;
            Storage::putFileAs($imgPath, $file, $imgName);

            // Remove old image
            $oldImgPath = config('files.product_image_dir') . "/" . $product->image;
            Storage::delete($oldImgPath);

            $payload['image'] = $imgName;
        }

        $product->update($payload);

        return redirect()->route('products.index')
            ->with('success', 'Berhasil!')
            ->with('success_message', 'Data berhasil diubah');
    }

    public function destroy(Request $request, Product $product): RedirectResponse | JsonResponse
    {
        $product->delete();

        if ($request->ajax()) {
            return response()->json([
                'success' => 'Berhasil!',
                'success_message' => 'Data kategori berhasil dihapus.'
            ]);
        }

        return redirect()->route('products.index')
            ->with('success', 'Berhasil!')
            ->with('success_message', 'Data berhasil dihapus.');
    }
}
