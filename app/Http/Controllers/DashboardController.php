<?php

namespace App\Http\Controllers;

use App\DataTables\RecentShipmentsDataTable;

class DashboardController extends Controller
{
    public function index(RecentShipmentsDataTable $dataTable)
    {
        return $dataTable->render('dashboard');
    }
}
