<?php

namespace App\Http\Controllers;

use App\Models\License;
use Illuminate\Http\Request;
use App\Models\VisitSchedule;
use App\Models\LicenseRequest;
use App\Http\Controllers\Controller;
use App\ModelStates\Institution\RequestState;


class LicensesStateController extends Controller
{

    public function __invoke(Request $request, LicenseRequest $licenseRequest)
    {
        // dd($request['state'] === 'issuing_license' && $request->hasFile('report_license'));
        $request->validate([
            'state' => ['required'],
            'report_license' => ['nullable', 'required_if:state,issuing_license ', 'file', 'mimes:pdf,doc,docx,jpg'],
            'reason' => ['nullable', 'required_if:state,rejected', 'string'],
        ]);

        // حدّث حالة الطلب
        $licenseRequest->state = $request['state'];
        $licenseRequest->reason = $request['state'] === 'rejected' ? $request['reason'] : null;
        $licenseRequest->save();

        // رفع التقرير في حالة القبول
        if ($request['state'] === 'issuing_license' && $request->hasFile('report_license')) {
            $licenseRequest->clearMediaCollection('report_license'); // نمسح التقرير القديم لو فيه
            $licenseRequest->addMediaFromRequest('report_license')->toMediaCollection('report_license');
        }

        return redirect()->back()->with('success', __('تم تحديث الحالة بنجاح.'));
    }

}
