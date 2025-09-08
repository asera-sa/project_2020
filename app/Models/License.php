<?php

namespace App\Models;

use App\Traits\HasUuid;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class License extends Model implements HasMedia
{
    use HasUuid, InteractsWithMedia;

    protected $guarded = ['id'];

    protected $casts = [
        'issued_at' => 'date',
        'expires_at' => 'date',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('license');
    }

    public function licenseRequest()
    {
        return $this->belongsTo(LicenseRequest::class);
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

}
