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
            ->filterColumn('total_amount', function ($query, $keyword) {
                $query->havingRaw('SUM(expenses.amount) LIKE ?', ["%{$keyword}%"]);
            })
            ->rawColumns(['action']);
    }
        public function query(Category $model)
            {
                return $model->newQuery()
                    ->select('categories.id', 'categories.name')
                    ->leftJoin('expenses', 'categories.id', '=', 'expenses.category_id')
                    ->selectRaw('SUM(expenses.amount) as total_amount')
                    ->groupBy('categories.id', 'categories.name');
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
            Column::make('total_amount')->title('Total Amount'), // Use the calculated total amount
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }
}