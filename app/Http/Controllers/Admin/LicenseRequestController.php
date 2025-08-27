<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\License;
use App\Enums\UserScope;
use App\Models\Institution;
use Illuminate\Http\Request;
use App\Models\LicenseRequest;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Requests\License\StoreRequest;

class LicenseRequestController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = auth()->user();
            $method = $request->route()->getActionMethod();

            // المدير يقدر يدخل لأي دالة
            if ($user->isAdministrator()) {
                return $next($request);
            }

            // مدير مكتب التفتيش يشوف  index و show
            if (
                $user->isInspectionOfficeManager() &&
                in_array($method, ['index', 'show'])
            ) {
                return $next($request);
            }
            if ($user->isInstitutionOwner() || $user->isSettlementUnitEmployee()) {
                return $next($request);
            }
            // باقي الحالات: منع
            abort(403);
        });
    }

    public function index()
    {
        $query = LicenseRequest::query();

        // فلترة حسب المستخدم لو صاحب مؤسسة
        if (auth()->user()->isInstitutionOwner()) {
            $query->whereHas('institution', function ($q) {
                $q->where('user_id', auth()->id());
            });
        }

        $licenseRequests = QueryBuilder::for($query)
            ->allowedFilters(['name'])
            ->paginate(config('app.paginate_count'));

        return view('admin.pages.license-requests.index', [
            'licenseRequests' => $licenseRequests,
        ]);
    }

    public function create()
    {
        $user = auth()->user();

        // لو هو صاحب مصلحة، نجيب بس المؤسسة التابعة له
        if ($user->isInstitutionOwner()) {
            $institutions = Institution::where('user_id', $user->id)->get();
        } else {
            // غير ذلك (مدير مثلاً)، نعرض كل المؤسسات المقبولة
            $institutions = Institution::get();
        }

        return view('admin.pages.license-requests.create', [
            'institutions' => $institutions,
        ]);
    }

    public function store(Request $request)
    {
        // جلب نوع الجهة
        $institution = \App\Models\Institution::find($request->institution_id);

        // إعداد قواعد الفاليديشن
        $rules = [
            'institution_id' => ['required', 'exists:institutions,id'],
            'site_map' => ['required', 'file', 'mimes:pdf'],
            'site_safety_plan' => ['required', 'file', 'mimes:pdf'],
        ];

        if ($institution && $institution->type === 'public') {
            $rules = array_merge($rules, [
                'safety_request' => ['required', 'file', 'mimes:pdf'],
                'committee_decision' => ['required', 'file', 'mimes:pdf'],
            ]);
        }

        if ($institution && $institution->type === 'private') {
            $rules = array_merge($rules, [
                'specialization_request' => ['required', 'file', 'mimes:pdf'],
                'legal_file' => ['required', 'file', 'mimes:pdf'],
                'company_license' => ['required', 'file', 'mimes:pdf'],
                'commercial_register' => ['required', 'file', 'mimes:pdf'],
                'chamber_of_commerce' => ['required', 'file', 'mimes:pdf'],
                'company_bylaws' => ['required', 'file', 'mimes:pdf'],
                'payment_receipt' => ['required', 'file', 'mimes:pdf'],
            ]);
        }

        // تنفيذ الفاليديشن
        $validated = $request->validate($rules);

        // إنشاء الطلب
        $licenseRequest = LicenseRequest::create([
            'institution_id' => $validated['institution_id'],
            // أي بيانات إضافية أخرى...
        ]);

        // حفظ الملفات في Media Library
        $fileFields = array_keys($rules);
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $licenseRequest->addMediaFromRequest($field)->toMediaCollection($field);
            }
        }

        return redirect()->route('license_requests.index')
            ->with('success', __('تم إضافة طلب الترخيص بنجاح.'));
    }


    public function show(LicenseRequest $licenseRequest)
    {
        // تحميل بيانات المؤسسة المرتبطة مع الطلب
        $licenseRequest->load('institution');
        $inspectors = User::where('scope', UserScope::INSPECTOR->value)->get();

        // عرض الصفحة وتمرير بيانات طلب الترخيص
        return view('admin.pages.license-requests.show')->with([
            'licenseRequest' => $licenseRequest,
            'inspectors' => $inspectors,
        ]);
    }

    public function destroy(LicenseRequest $licenseRequest)
    {
        $licenseRequest->delete();

        flash()->success(__('ui.alerts.messages.delete', ['entity' => __('ui.entities.user'), 'name' => $licenseRequest->name]));

        return redirect()->route('license_requests.index');
    }


}
