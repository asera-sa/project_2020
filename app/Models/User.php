<?php

namespace App\Models;

use App\Enums\UserScope;
use Spatie\MediaLibrary\HasMedia;
use Spatie\ModelStates\HasStates;
use App\ModelStates\User\ModelState;
// use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia, MustVerifyEmail
{
    use  HasFactory, Notifiable, HasRoles, InteractsWithMedia, HasStates;

    protected $fillable = [
        'user_name',
        'image_profile',
        'full_name',
        'email',
        'phone',
        'password',
        'scope',
        'last_login',
        'email_verification_token',
        'email_verification_token_expires_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'scope' => UserScope::class,
    ];

    public function getImage(): string
    {
        return $this->getFirstMediaUrl('image_profile') ?: $this->getFallbackMediaPath('image');
    }

    public function getRedirectRoute()
    {
        $routes = [
            UserScope::ADMINISTRATOR->value => '/',
            // UserScope::EXTERNAL_EMPLOYEE->value => '/',
        ];

        $scopeValue = $this->scope->value; // تأكد من استخدام القيمة الصحيحة
        // dd($routes[$scopeValue]);
        return $routes[$scopeValue] ?? null; // يعيد null إذا لم يكن المفتاح موجودًا

    }

    public function visitSchedule()
    {
        return $this->hasMany(VisitSchedule::class);
    }

    public function institution()
    {
        return $this->hasOne(Institution::class);
    }

    // sope
    public function isAdministrator(): bool
    {
        return $this->scope === UserScope::ADMINISTRATOR;
    }
    public function isInspector(): bool
    {
        return $this->scope === UserScope::INSPECTOR;
    }

    public function isInspectionOfficeManager(): bool
    {
        return $this->scope === UserScope::INSPECTION_OFFICE_MANAGER;
    }

    public function isSettlementUnitEmployee(): bool
    {
        return $this->scope === UserScope::SETTLEMENT_UNIT_EMPLOYEE;
    }

    public function isInstitutionOwner(): bool
    {
        return $this->scope === UserScope::INSTITUTION_OWNER;
    }

    /**
     * التحقق من أن الحساب مفعل
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * التحقق من أن الحساب غير مفعل
     */
    public function isInactive(): bool
    {
        return $this->status !== 'active';
    }

    //end scope

}
