<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Centre;
use App\Models\Course;
use App\Models\Entity;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Institution;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->user()?->isAdministrator()) {
                abort(403);
            }

            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $sessions = DB::table(config('session.table', 'sessions'))
            ->where('user_id', auth()->id())
            ->latest('last_activity')
            ->get()
            ->map(function ($session) use ($request) {
                $agent = tap(new Agent(), fn($agent) => $agent->setUserAgent($session->user_agent));

                return (object) [
                    'agent' => [
                        'is_desktop' => $agent->isDesktop(),
                        'platform' => $agent->platform(),
                        'browser' => $agent->browser(),
                    ],
                    'ip_address' => $session->ip_address,
                    'is_current_device' => $session->id === $request->session()->getId(),
                    'last_activity' => Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
                ];
            });

        $institutionCount = Institution::count(); // عدد المصالح
        $userCount = User::count();      // عدد المستخدمين

        return view('admin.pages.dashboard', [
            'sessions' => $sessions,
            'institutionCount' => $institutionCount,
            'userCount' => $userCount,
        ]);
    }
}
