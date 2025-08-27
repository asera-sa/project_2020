<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\VisitSchedule;
use App\Models\LicenseRequest;
use App\Http\Controllers\Controller;
use App\ModelStates\Institution\RequestState;


class UserStateController extends Controller
{

    public function __invoke(Request $request, User $user)
    {
        $request->validate([
            'state' => ['required'],
        ]);
    
        // حدّث حالة الطلب
        $user->state = $request['state'];
        
        // إذا كان المستخدم من نوع institution_owner، يمكن تفعيل الحساب
        if ($request->has('status') && $user->scope === 'institution_owner') {
            $user->status = $request['status'];
        }
        
        $user->save();
    
        return redirect()->back()->with('success', __('تم تحديث الحالة بنجاح.'));
    }
    
}
