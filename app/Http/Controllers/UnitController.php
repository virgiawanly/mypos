<?php

namespace App\Http\Controllers;

use App\DataTables\UnitsDataTable;
use App\Http\Requests\UnitRequest;
use App\Models\Unit;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index(Request $request, UnitsDataTable $dataTable)
    {
        if ($request->ajax()) {
            return $dataTable->render();
        }

        $table = $dataTable->html();
        return view('units.index', ['table' => $table]);
    }

    public function create(): View
    {
        return view('units.form');
    }

    public function store(UnitRequest $request): RedirectResponse
    {
        Unit::create($request->validated());

        return redirect()->route('units.index')
            ->with('success', 'Berhasil!')
            ->with('success_message', 'Data berhasil ditambahkan');
    }

    public function edit(Unit $unit): View
    {
        return view('units.form', ['unit' => $unit]);
    }

    public function update(UnitRequest $request, Unit $unit): RedirectResponse
    {
        $unit->update($request->validated());

        return redirect()->route('units.index')
            ->with('success', 'Berhasil!')
            ->with('success_message', 'Data berhasil diubah');
    }

    public function destroy(Request $request, Unit $unit): RedirectResponse | JsonResponse
    {
        $unit->delete();

        if ($request->ajax()) {
            return response()->json([
                'success' => 'Berhasil!',
                'success_message' => 'Data kategori berhasil dihapus.'
            ]);
        }

        return redirect()->route('units.index')
            ->with('success', 'Berhasil!')
            ->with('success_message', 'Data berhasil dihapus.');
    }
}
