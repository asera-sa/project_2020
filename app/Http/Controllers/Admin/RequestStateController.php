<?php

namespace App\Http\Controllers\Admin;

use App\Models\License;
use Illuminate\Http\Request;
use App\Models\VisitSchedule;
use App\Models\LicenseRequest;
use App\Http\Controllers\Controller;
use App\ModelStates\Institution\RequestState;


class RequestStateController extends Controller
{

    public function __invoke(Request $request, LicenseRequest $licenseRequest)
    {
        // dd($request);
        $request->validate([
            'state' => ['required'],
            'reason' => ['nullable', 'required_if:state,rejected', 'string'],
        ]);
    
        // حدّث حالة الطلب
        $licenseRequest->state = $request['state'];
        $licenseRequest->reason = $request['state'] === 'rejected' ? $request['reason'] : null;
        $licenseRequest->save();
    
      
    
        return redirect()->back()->with('success', __('تم تحديث الحالة بنجاح.'));
    }
    
}
