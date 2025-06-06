<?php

namespace App\DataTables;

use App\Models\PortfolioItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Calculation\Category;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PortfolioItemDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('image', function($query){
                return '<img style="width:70px" src="' . asset($query->image) . '"></img>';
            })
            ->addColumn('created_at', function($query){
                return date('d-m-Y', strtotime($query->created_at));
            })
            ->addColumn('category', function($query){
                return $query->category->name;
            })
            ->addColumn('description', function($query){
                return Str::limit(strip_tags($query->description), 150);
            })            
            ->addColumn('status', function ($query) {
                $selectedDraft = $query->status === 'draft' ? 'selected' : '';
                $selectedPublished = $query->status === 'published' ? 'selected' : '';
            
                return '
                    <select class="form-control form-control-sm status-select" data-id="' . $query->id . '">
                        <option value="draft" ' . $selectedDraft . '>Draft</option>
                        <option value="published" ' . $selectedPublished . '>Published</option>
                    </select>
                ';
            })
            
            ->addColumn('action', function($query){
                return '
                <a href="' . route('admin.portfolio-item.edit', $query->id ) . '" class="btn btn-primary"><i class="fas fa-edit"></i></a> 
                <a href="' . route('admin.portfolio-item.destroy', $query->id).'" class="btn btn-danger delete-item"><i class="fas fa-trash"></i></a>
                ';
            })
            ->rawColumns(['image', 'status', 'action', 'description'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PortfolioItem $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('portfolioitem-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->width('30'),
            Column::make('image'),
            Column::make('title'),
            Column::make('category'),
            Column::make('description')->width(200),
            Column::make('client'),
            Column::make('website'),
            Column::make('created_at'),
            Column::make('status')->width('130'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(200)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'PortfolioItem_' . date('YmdHis');
    }
}
