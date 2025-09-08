<?php

namespace App\Models;

use App\Traits\HasUuid;
use Spatie\ModelStates\HasStates;
use Illuminate\Database\Eloquent\Model;

class VisitSchedule extends Model
{
    use HasUuid, HasStates;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'inspector_id');
    }

    public function licenseRequest()
    {
        return $this->belongsTo(LicenseRequest::class);
    }


}
