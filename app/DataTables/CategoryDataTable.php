<?php

namespace App\DataTables;

use App\Models\Category;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
{
    public function dataTable($query)
{
    return datatables()->eloquent($query)
        ->addColumn('action', function ($category) {
            return '<a href="'.route('categories.show', $category->id).'" class="px-3 py-1 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600">👁️ View</a>';
        })
        ->rawColumns(['action']); // Ensures buttons are rendered as HTML
}


    public function query(Category $model)
    {
        return Category::query()->select(['id', 'name']);

    }
    

    public function html()
    {
        return $this->builder()
            ->setTableId('categories-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(0);
    }

    protected function getColumns()
    {
        return [
            Column::make('id')->title('ID'),
            Column::make('name')->title('Category Name'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }
}
