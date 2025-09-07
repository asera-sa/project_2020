<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Enums\UserScope;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\Entity;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (! auth()->user()->isAdministrator()) {
                abort(403);
            }

            return $next($request);
        });
    }

    public function index()
    {
        $users = QueryBuilder::for(User::query()->where('scope', '!=', 'institution_owner'))
        ->allowedFilters([
            'name',
            'email',
        ])
        ->paginate(config('app.paginate_count'));

        return view('admin.pages.users.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        return view('admin.pages.users.create', [
            'scopes' => collect(UserScope::cases())
            ->where('value', '!==', UserScope::INSTITUTION_OWNER->value),
        ]);
    }

    public function store(StoreRequest $request)
    {
        $validatedData = $request->safe()->merge(['password' => bcrypt($request->password), 'last_login' => now()])->toArray();

        $user = User::create($validatedData);

        if ($request->hasFile('image_profile')) {

            $user->addMediaFromRequest('image_profile')->toMediaCollection('image_profile');
        }

        flash()->success(__('ui.alerts.messages.create',   ['entity' => __('ui.entities.user'), 'name' => $user->name]));

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        return view('admin.pages.users.show', [
            'user' => $user
        ]);
    }

    public function edit(User $user)
    {
        return view('admin.pages.users.edit', [
            'user' => $user,
            'scopes' => collect(UserScope::cases())
            ->where('value', '!==', UserScope::INSTITUTION_OWNER->value),
        ]);
    }

    public function update(UpdateRequest $request, User $user)
    {
        $validatedData = $request->safe()->except(['password']);

        $user->update($validatedData);

        if ($request->filled('password')) {
            $user->update(['password' => bcrypt($request->password)]);
        }

        if ($request->hasFile('image_profile')) {
            $user->clearMediaCollection('image_profile');
            $user->addMediaFromRequest('image_profile')->toMediaCollection('image_profile');
        }

        flash()->success(__('ui.alerts.messages.update', ['entity' => __('ui.entities.user'), 'name' => $user->name]));

        return redirect()->route('admin.users.show', $user);
    }

    public function destroy(User $user)
    {
        if($user->scope == 'administrator'){
            flash()->error(__('لا يمكن حذف المستخدم غير الإداري.'));
            return redirect()->route('admin.users.show',$user);
        }
        
        $user->delete();

        flash()->success(__('ui.alerts.messages.delete', ['entity' => __('ui.entities.user'), 'name' => $user->name]));

        return redirect()->route('admin.users.index');
    }
}
