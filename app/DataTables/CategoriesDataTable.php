<?php

namespace App\DataTables;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoriesDataTable extends DataTable
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
            ->editColumn('updated_at', function ($row) {
                return $row->updated_at->format('d/m/Y H:i');
            })
            ->addColumn('action', function ($row) {
                $action = '<a href="' . route('categories.edit', $row->id) . '" class="btn btn-success me-1"><i class="bi bi-pencil-fill"></i></a>';
                $action .= '<button data-action="' . route('categories.destroy', $row->id) . '" data-name="' . $row->name . '" class="btn btn-danger delete-btn"><i class="bi bi-trash-fill"></i></button>';
                return $action;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Category $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Category $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('categories-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->processing(true)
            ->selectStyleSingle()
            ->parameters(['order' => [3, 'DESC']]);
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
            Column::make('name')->title('Nama'),
            Column::make('info')->title('Keterangan'),
            Column::make('updated_at')->title('Terakhir Diupdate'),
            Column::computed('action')
                ->title('')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center')
                ->width(150)
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Categories_' . date('YmdHis');
    }
}
