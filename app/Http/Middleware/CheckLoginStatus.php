<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CheckLoginStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // التحقق من أن المستخدم مسجل دخول
        if (Auth::check()) {
            $user = Auth::user();
            
            Log::info('User authenticated:', [
                'id' => $user->id,
                'email' => $user->email,
                'scope' => $user->scope,
                'status' => $user->status ?? 'no_status',
                'email_verified_at' => $user->email_verified_at,
                'isAdministrator' => $user->isAdministrator()
            ]);
            
            // المديرون يمكنهم الوصول دائماً بغض النظر عن status
            if ($user->isAdministrator()) {
                Log::info('User is administrator, allowing access');
                return $next($request);
            }
            
            // التحقق من تأكيد البريد الإلكتروني للمستخدمين العاديين
            if (!$user->email_verified_at) {
                Log::info('User email not verified, logging out');
                Auth::logout();
                return redirect()->route('login')->with('error', 'يرجى تأكيد بريدك الإلكتروني أولاً. تم إرسال رابط التأكيد إلى بريدك.');
            }
            
            // التحقق من أن الحساب مفعل (status = 'active')
            if (($user->status ?? 'inactive') !== 'active') {
                Log::info('User account not active, logging out. Status: ' . ($user->status ?? 'null'));
                Log::warning('PREVENTING ACCESS - User status is not active', [
                    'user_id' => $user->id,
                    'status' => $user->status,
                    'scope' => $user->scope
                ]);
                Auth::logout();
                return redirect()->route('login')->with('error', 'حسابك غير مفعل. يرجى انتظار تفعيل الحساب من قبل الإدارة.');
            }
            
            Log::info('User passed all checks, allowing access');
        }
        
        return $next($request);
    }
}
