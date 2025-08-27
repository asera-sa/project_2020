<?php

namespace App\Models;

use App\Traits\HasUuid;
use Spatie\MediaLibrary\HasMedia;
use Spatie\ModelStates\HasStates;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\ModelStates\License\RequestState;

class LicenseRequest extends Model implements HasMedia
{
    use HasUuid,InteractsWithMedia, HasStates;

    protected $guarded = ['id'];

    protected $casts = [
        'state' => RequestState::class,
        'created_by' => 'date',
    ];

    public function registerMediaCollections(): void
    {
        // الإجراءات العامة والخاصة
        $this->addMediaCollection('site_safety_plan');
        $this->addMediaCollection('site_map');

        // الإجراءات العامة (General Procedures)
        $this->addMediaCollection('safety_request');
        $this->addMediaCollection('committee_decision');

        // الإجراءات الخاصة (Private Procedures)
        $this->addMediaCollection('specialization_request');
        $this->addMediaCollection('legal_file');
        $this->addMediaCollection('company_license');
        $this->addMediaCollection('commercial_register');
        $this->addMediaCollection('chamber_of_commerce');
        $this->addMediaCollection('company_bylaws');
        $this->addMediaCollection('payment_receipt');

        $this->addMediaCollection('report_license');
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function visitSchedule()
    {
        return $this->hasOne(VisitSchedule::class);
    }

    public function license()
    {
        return $this->hasOne(License::class);
    }

}
