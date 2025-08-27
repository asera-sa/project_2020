<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\VisitSchedule;
use App\Models\LicenseRequest;
use App\Http\Controllers\Controller;
use App\ModelStates\License\AssignedToInspector;

class AssignInspectorController extends Controller
{
    public function __invoke(Request $request, LicenseRequest $licenseRequest)
    {
        // التحقق من صحة الطلب
        $request->validate([
            'inspector_id' => 'required',
        ]);
        // dd($request);

        VisitSchedule::create([
                'license_request_id' => $licenseRequest->id,
                'inspector_id' => $request->inspector_id,
                'visit_date' => $request->visit_date,
                'visit_time' => $request->visit_time, // وقت افتراضي، تقدر تخليه حسب اختيار المفتش
            ]);

        $licenseRequest->state->transitionTo(AssignedToInspector::class);
        $licenseRequest->save();
        return redirect()->route('license_requests.show', $licenseRequest)
                        ->with('success', __('تم تحديث حالة الطلب بنجاح.'));
    }
}
