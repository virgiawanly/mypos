<?php

namespace App\DataTables;

use App\Helpers\CurrencyHelper;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', 'products.action')
            ->editColumn('profit', function ($row) {
                return CurrencyHelper::formatCurrency($row->profit);
            })
            ->editColumn('buy_price', function ($row) {
                return CurrencyHelper::formatCurrency($row->buy_price);
            })
            ->editColumn('sell_price', function ($row) {
                return CurrencyHelper::formatCurrency($row->sell_price);
            })
            ->editColumn('category', function ($row) {
                return $row->category->name ?? "-";
            })
            ->editColumn('unit', function ($row) {
                return $row->unit->name ?? "-";
            })
            ->editColumn('updated_at', function ($row) {
                return $row->updated_at->format('d/m/Y H:i');
            })
            ->addColumn('action', function ($row) {
                $action = '<a href="' . route('products.show', $row->id) . '" class="btn btn-info"><i class="bi bi-eye-fill"></i></a>';
                $action .= '<a href="' . route('products.edit', $row->id) . '" class="btn btn-success"><i class="bi bi-pencil-fill"></i></a>';
                $action .= '<button data-action="' . route('products.destroy', $row->id) . '" data-name="' . $row->name . '" class="btn btn-danger delete-btn"><i class="bi bi-trash-fill"></i></button>';
                return '<div class="d-flex gap-1">' . $action . '</div>';
            })->filterColumn('profit', function ($query, $keyword) {
                $query->whereRaw("(products.sell_price - products.buy_price) LIKE ?", ["%{$keyword}%"]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->newQuery()
            ->with(['category', 'unit'])
            ->select('*', DB::raw('products.sell_price - products.buy_price AS profit'));
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('products-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->responsive(true)
            ->processing(true)
            ->selectStyleSingle()
            ->parameters(['order' => [9, 'DESC']]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')
                ->title('#')
                ->orderable(false)
                ->searchable(false)
                ->width(30),
            Column::make('code')->title('Barcode'),
            Column::make('name')->title('Nama Produk'),
            Column::make('category')->title('Kategori')->name('category.name'),
            Column::make('unit')->title('Satuan')->name('unit.name'),
            Column::make('buy_price')->title('Harga Beli')->className('text-end'),
            Column::make('sell_price')->title('Harga Jual')->className('text-end'),
            Column::make('profit')->title('Profit')->className('text-end'),
            Column::make('stock')->title('Stok Tercatat')
                ->name('stock')
                ->className('text-center')
                ->renderRaw('function(data, type, row) { return data > 0 ? data : \'<span class="badge bg-danger">Habis</span>\';}'),
            Column::make('updated_at')->title('Terakhir Diupdate'),
            Column::computed('action')
                ->title('')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center')
                ->width(160)
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Products_' . date('YmdHis');
    }
}
