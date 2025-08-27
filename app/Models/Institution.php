<?php

namespace App\Models;

use App\Traits\HasUuid;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\ModelStates\Institution\RequestState;

class Institution extends Model implements HasMedia
{
    use HasUuid, InteractsWithMedia;

    protected $guarded = ['id'];

    public function licenses()
    {
        return $this->hasMany(License::class);
    }

    public function licenseRequests()
    {
        return $this->hasMany(LicenseRequest::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
