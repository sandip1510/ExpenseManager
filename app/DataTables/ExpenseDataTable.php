<?php
namespace App\DataTables;

use App\Models\Expense;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ExpenseDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()->eloquent($query)
            ->addColumn('action', function ($expense) {
                return view('expenses.partials.actions', compact('expense'))->render();
            });
    }

    public function query(Expense $model)
    {
        return $model->newQuery()
            ->select('expenses.id', 'expenses.category_id', 'expenses.amount', 'expenses.date') // Explicit table name
            ->with('category')
            ->where('expenses.user_id', auth()->id())
            ->orderBy('expenses.date', 'desc');
    }

    

    public function html()
    {
        return $this->builder()
            ->setTableId('expenses-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(0);
    }

    protected function getColumns()
    {
        return [
            // Column::make('id')->data('id')->title('ID'), // Ensure it matches the table column
            Column::make('category.name')->title('Category'),
            Column::make('amount'),
            Column::make('date'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center'),
        ];
    }

    
}
