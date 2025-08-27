<?php

namespace App\Http\Controllers\Admin;

use App\Models\Institution;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModelStates\Institution\RequestState;


class InstitutionStateController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = auth()->user();

            if (!$user || (!$user->isSettlementUnitEmployee() && !$user->isAdministrator())) {
                abort(403);
            }

            return $next($request);
        });
    }


    public function __invoke(Request $request, Institution $institution)
    {
        // تحقق من وجود سبب الرفض إذا كانت الحالة مرفوضة
        if ($request->state === 'rejected') {
            // خزّن سبب الرفض في حقل مخصص (مثلاً reason)
            $institution->reason = $request->input('reason');
        } else {
            // لما الحالة مش مرفوضة، امسح أي سبب رفض موجود سابقاً
            $institution->reason = null;
        }

        $institution->state->transitionTo(RequestState::getTransitionState($request->state));

        return redirect()->back();
    }
}
