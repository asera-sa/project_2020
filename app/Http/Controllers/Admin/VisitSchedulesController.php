<?php

namespace App\Http\Controllers\Admin;
use App\Models\Institution;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\VisitSchedule;

class VisitSchedulesController extends Controller
{
    public function index()
    {
        $visitSchedules = QueryBuilder::for(VisitSchedule::class)
            ->allowedFilters([
                'name',
            ])
            ->paginate(config('app.paginate_count'));

        return view('admin.pages.visit-schedules.index', [
            'visitSchedules' => $visitSchedules
        ]);
    }

    public function show(VisitSchedule $visitSchedule)
    {
        return view('admin.pages.visit-schedules.show',
               ['visitSchedule' => $visitSchedule]);
    }


}
