<?php

namespace App\Http\Controllers\Admin;
use App\Models\Institution;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Requests\Institution\StoreRequest;
use App\Http\Requests\Institution\UpdateRequest;

class InstitutionRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->user()?->isSettlementUnitEmployee()) {
                abort(403);
            }

            return $next($request);
        });
    }
    
    public function index()
    {
        $institutions = QueryBuilder::for(Institution::class)
            ->allowedFilters(['name'])
            ->where('state', 'pending')  // الشرط هنا
            ->paginate(config('app.paginate_count'));

        return view('admin.pages.institution-requests.index', [
            'institutions' => $institutions
        ]);
    }

    public function show(Institution $institution)
    {
        return view('admin.pages.institution-requests.show', compact('institution'));
    }

}
