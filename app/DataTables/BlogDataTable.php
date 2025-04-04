<?php

namespace App\DataTables;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BlogDataTable extends DataTable
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
            ->addColumn('category', function($query){
                return $query->category->name;
            })
            ->addColumn('created_at', function($query){
                return date('d-M-Y | H:s', strtotime($query->created_at));
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
                <a href="' . route('admin.blog.edit', $query->id ) . '" class="btn btn-primary"><i class="fas fa-edit"></i></a> 
                <a href="' . route('admin.blog.destroy', $query->id).'" class="btn btn-danger delete-item"><i class="fas fa-trash"></i></a>
                ';
            })
            ->rawColumns(['status', 'description', 'image', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Blog $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('blog-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0)
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
            Column::make('image')->width(''),
            Column::make('title'),
            Column::make('category'),
            Column::make('description')->width(200),
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
        return 'Blog_' . date('YmdHis');
    }
}
