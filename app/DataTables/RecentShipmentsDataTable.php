<?php

namespace App\DataTables;

use App\Models\Shipment;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;

class RecentShipmentsDataTable extends ShipmentsDataTable
{
    /**
     * Get the query source of dataTable (latest 10 only).
     *
     * @return QueryBuilder<Shipment>
     */
    public function query(Shipment $model): QueryBuilder
    {
        return $model->newQuery()->orderByDesc('created_at')->limit(10);
    }

    /**
     * Table id and options for dashboard (no pagination, 10 rows).
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('recent-shipments-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(5, 'desc')
            ->selectStyleSingle()
            ->parameters([
                'paging' => false,
                'searching' => true,
                'info' => false,
                'language' => [
                    'url' => '//cdn.datatables.net/plug-ins/2.0.0/i18n/en.json',
                ],
            ]);
    }

    protected function filename(): string
    {
        return 'RecentShipments_' . date('YmdHis');
    }
}
