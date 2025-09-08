<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Institution;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\Institution\StoreRequest;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // عرض صفحة التسجيل
    public function show()
    {
        return view('auth.register');
    }

    // معالجة بيانات التسجيل
    public function register(StoreRequest $request)
    {
        // إنشاء الجهة
        $validatedData = $request->safe()->merge(['password' => bcrypt($request->password), 'last_login' => now()])->toArray();

        $user = User::create($validatedData);

        $validatedData = $request->safe()->merge(['user_id' => $user->id])->toArray();

        Institution::create($validatedData);

        event(new Registered($user)); // هذا يرسل رابط التحقق

        Auth::login($user);

        // بعد التسجيل، إعادة التوجيه لصفحة لوحة التحكم
        return redirect()->route('admin.dashboard')->with('success', 'تم إنشاء الحساب بنجاح.');
    }
}
