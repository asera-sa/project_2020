<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAccountStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            // المديرون يمكنهم الوصول دائماً بغض النظر عن status
            if ($user->isAdministrator()) {
                return $next($request);
            }
            
            // التحقق من تأكيد البريد الإلكتروني للمستخدمين العاديين
            if (!$user->email_verified_at) {
                Auth::logout();
                return redirect()->route('login')->with('error', 'يرجى تأكيد بريدك الإلكتروني أولاً. تم إرسال رابط التأكيد إلى بريدك.');
            }
            
            // التحقق من أن الحساب مفعل للمستخدمين العاديين فقط
            if ($user->status !== 'active') {
                Auth::logout();
                return redirect()->route('login')->with('error', 'حسابك غير مفعل. يرجى انتظار تفعيل الحساب من قبل الإدارة.');
            }
        }

        return $next($request);
    }
}
