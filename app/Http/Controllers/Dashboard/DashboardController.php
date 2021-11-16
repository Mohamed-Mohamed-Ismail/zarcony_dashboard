<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\DataTables;

class DashboardController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function activitiesList()
    {
        return DataTables::of(Activity::all())->addIndexColumn()
            ->make(true);
    }
}
