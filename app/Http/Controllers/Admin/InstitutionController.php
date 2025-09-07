<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;

use App\Models\Institution;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\Institution\StoreRequest;
use App\Http\Requests\Institution\UpdateRequest;

class InstitutionController extends Controller
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

    public function index()
    {
        $institutions = QueryBuilder::for(Institution::class)
            ->allowedFilters([
                'name',
            ])
            ->paginate(config('app.paginate_count'));

        return view('admin.pages.institutions.index', [
            'institutions' => $institutions
        ]);
    }

    public function create()
    {
        return view('admin.pages.institutions.create');
    }

    public function store(StoreRequest $request)
    {
        // إنشاء الجهة
        $userData = $request->validated();
        $userData = array_merge($userData, [
            'password' => bcrypt($request->password),
            'last_login' => now(),
            'status' => 'inactive', // الحساب غير مفعل
            'scope' => 'institution_owner', // تحديد نوع المستخدم
            'email_verification_token' => \Illuminate\Support\Str::random(64),
            'email_verification_token_expires_at' => now()->addHours(24),
        ]);

        $user = User::create($userData);

        $institutionData = [
            'name' => $request->name,
            'type' => $request->type,
            'user_id' => $user->id
        ];

        $institution = Institution::create($institutionData);

         event(new Registered($user)); // هذا يرسل رابط التحقق



        return redirect()->route('admin.institutions.show',$institution)->with('success', 'تمت إضافة الجهة بنجاح. تم إرسال رسالة التأكيد إلى البريد الإلكتروني. الحساب يحتاج تأكيد البريد الإلكتروني أولاً ثم تفعيل من قبل الإدارة. لا يمكن للمؤسسة تسجيل الدخول حتى يتم تفعيل الحساب.');
    }

    public function show(Institution $institution)
    {
        return view('admin.pages.institutions.show', compact('institution'));
    }

    public function edit(Institution $institution)
    {
        return view('admin.pages.institutions.edit', compact('institution'));
    }

    public function update(UpdateRequest $request, Institution $institution)
    {
        // تحديث البيانات الأساسية
        $institution->update($request->validated());

        flash()->success(__('ui.alerts.messages.create', ['entity' => __('ui.entities.bank'), 'name' => $institution->name]));

        return redirect()->route('admin.institutions.show', $institution)
            ->with('success', 'تم تحديث بيانات الجهة بنجاح');
    }

    public function destroy(Institution $institution)
    {
        // حذف جميع الوسائط المرتبطة بالمؤسسة
        $institution->clearMediaCollection();

        // حذف سجل المؤسسة من قاعدة البيانات
        $institution->delete();

        flash()->success(__('ui.alerts.messages.delete', ['entity' => __('ui.entities.unit'), 'name' => $institution->name]));

        return redirect()->route('admin.institutions.index')
            ->with('success', 'تم حذف الجهة بنجاح');
    }

}
