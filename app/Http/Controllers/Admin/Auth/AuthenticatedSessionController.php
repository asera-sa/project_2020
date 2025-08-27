<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|string|email',
    //         'password' => 'required|string',
    //     ]);

    //     // محاولة تسجيل الدخول
    //     if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
    //         // تسجيل الدخول ناجح
    //         if ($request->user()->isInstitutionOwner()) {
    //             return redirect()->route('institution.dashboard');
    //         }
    //         return redirect()->intended('dashboard'); // أو أي مسار آخر
    //     }

    //     // تسجيل الدخول فشل
    //     return redirect()->back()->withErrors([
    //         'email' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة.',
    //     ])->withInput();
    // }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = auth()->user();

        // if($user->state == "inactive")
        // abort(403);

        if ($user->isInstitutionOwner() || $user->isSettlementUnitEmployee() ||  $user->isInspectionOfficeManager()) {
            return redirect()->route('license_requests.index');
        }
        if($user->isInspector())
        {
            return redirect()->route('visit_schedules.index');
        }
        // return redirect(auth()->user()->getRedirectRoute());

        return redirect()->route('admin.dashboard');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
