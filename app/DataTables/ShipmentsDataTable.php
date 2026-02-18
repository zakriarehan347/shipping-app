<?php

namespace App\DataTables;

use App\Models\Shipment;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ShipmentsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Shipment> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('waybill_number', function (Shipment $shipment) {
                return '<a href="' . e(route('shipments.show', $shipment)) . '" class="font-medium text-gray-900 hover:text-indigo-600">' . e($shipment->waybill_number) . '</a>';
            })
            ->addColumn('status', function (Shipment $shipment) {
                $date = $shipment->shipment_date;
                $today = now()->startOfDay();
                if ($date->isFuture()) {
                    return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-700">' . __('Pending') . '</span>';
                }
                if ($date->diffInDays($today) > 30) {
                    return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700">' . __('Inactive') . '</span>';
                }
                $label = $date->isToday() ? __('Active') : __('Delivered');
                return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">' . e($label) . '</span>';
            })
            ->orderColumn('shipment_date', 'shipment_date $1')
            ->editColumn('shipment_date', fn (Shipment $shipment) => $shipment->shipment_date?->format('M j, Y'))
            ->addColumn('print', 'shipments.print')
            ->addColumn('action', 'shipments.action')
            ->rawColumns(['waybill_number', 'status', 'print', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Shipment>
     */
    public function query(Shipment $model): QueryBuilder
    {
        return $model->newQuery()->orderByDesc('created_at');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('shipments-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(5, 'desc')
            ->selectStyleSingle()
            ->parameters([
                'language' => [
                    'url' => '//cdn.datatables.net/plug-ins/2.0.0/i18n/en.json',
                ],
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('waybill_number')->title(__('Waybill')),
            Column::make('status')->title(__('Status'))->orderable(false)->searchable(false),
            Column::make('courier_service')->title(__('Courier')),
            Column::make('shipper_name')->title(__('Shipper')),
            Column::make('receiver_name')->title(__('Receiver')),
            Column::make('shipment_date')->title(__('Date')),
            Column::computed('print')
                ->exportable(false)
                ->printable(false)
                ->width(70)
                ->addClass('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Shipments_' . date('YmdHis');
    }
}
