<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\License;
use App\Enums\UserScope;
use App\Models\Institution;
use App\Models\LicenseRequest;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use App\ModelStates\License\Completed;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Requests\License\StoreRequest;

class LicenseController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->user()?->isAdministrator() || auth()->user()?->isInspectionOfficeManager()) {
                return $next($request);
            }

            abort(403);
        });
    }

    public function index()
    {
        $licenses = QueryBuilder::for(License::with('licenseRequest.institution'))
            ->allowedFilters([
                AllowedFilter::callback('institution_name', function ($query, $value) {
                    $query->whereHas('licenseRequest.institution', function ($q) use ($value) {
                        $q->where('name', 'like', '%' . $value . '%');
                    });
                }),
            ])
            ->paginate(config('app.paginate_count'));

        return view('admin.pages.licenses.index', [
            'licenses' => $licenses
        ]);
    }


    public function create(LicenseRequest $licenseRequest)
    {
        return view('admin.pages.licenses.create', [
            'licenseRequest' => $licenseRequest,
        ]);
    }

    public function store(StoreRequest $request)
    {
        // استلام البيانات المصدقة من الريكوست
        $data = $request->validated();

        // إنشاء الترخيص وتخزينه في قاعدة البيانات
        $license = License::create($data);
        $licenseRequest = $license->licenseRequest;

        if ($request->hasFile('license')) {
            $licenseRequest->clearMediaCollection('license'); // نمسح التقرير القديم لو فيه
            $licenseRequest->addMediaFromRequest('license')->toMediaCollection('license');
        }

        $licenseRequest->state->transitionTo(Completed::class);
        $licenseRequest->save();
        flash()->success(__('ui.alerts.messages.create', ['entity' => __('ui.entities.license'), 'name' => $license->name]));

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->route('licenses.index')->with('success', 'تم إضافة طلب الترخيص بنجاح.');
    }

    public function show(License $license)
    {
        $inspectors = User::where('scope', UserScope::INSPECTOR->value)->get();

        return view('admin.pages.licenses.show', [
            'license' => $license,
            'inspectors' => $inspectors,
        ]);
    }

    public function edit(License $license)
    {
        return view('admin.pages.licenses.edit', [
            'license' => $license,
        ]);
    }

    public function destroy(License $license)
    {
        $license->delete();

        flash()->success(__('ui.alerts.messages.delete', ['entity' => __('ui.entities.user'), 'name' => $license->name]));

        return redirect()->route('admin.users.index');
    }

}
