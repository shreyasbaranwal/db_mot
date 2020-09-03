<?php

namespace App\DataTables;

use App\Droid;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use DataTables;

class DroidsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('PLI', function(Droid $droid) {
                if ($droid->club->hasOption('mot'))
                  return "<div class=\"alert ".$droid->displayMOT()['state']."\">".$droid->displayMOT()['status']."</div>";
                else
                  return "";
            })
            ->addColumn('actions', '')
            ->editColumn('actions', function($row) {
              $crudRoutePart = "droid";
              return view('partials.datatablesActions', compact('row', 'crudRoutePart'));
            })
            ->rawColumns(['PLI', 'actions']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\DroidsDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(DroidsDataTable $model)
    {
        $droids = Droid::orderBy('id', 'asc');
        return $droids;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns([
                      'id' => [ 'title' => 'ID'],
                      'name' => [ 'title' => 'Name'],
                      'PLI' => [ 'title' => 'PLI'],
                      'actions' => [ 'title' => 'Actions']
                    ]);

    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('name'),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Droids_' . date('YmdHis');
    }
}