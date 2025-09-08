<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserStateController extends Controller
{
    public function __invoke(Request $request, User $user)
    {
        $request->validate([
            'state' => ['required', 'in:active,inactive'],
        ]);

        if ($request->state === 'active') {
            $user->email_verified_at = now(); // تفعيل الحساب
        } else {
            $user->email_verified_at = null; // تعطيل الحساب
        }

        $user->save();

        return redirect()->back()->with('success', __('تم تحديث حالة الحساب بنجاح.'));
    }
}
