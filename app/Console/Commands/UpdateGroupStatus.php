<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Group;
use App\Enums\StatusGroup;
use Illuminate\Console\Command;

class UpdateGroupStatus extends Command
{
    protected $signature = 'groups:update-status';

    protected $description = 'تحقق من end_date للمجموعات وتحديث status إذا انتهت';

    public function handle()
    {
        $today = Carbon::today();

        $groups = Group::where('end_date', '<', $today)
                        ->where('status', StatusGroup::OPEN->value)
                        ->get();

        foreach ($groups as $group) {
            $group->status = StatusGroup::CLOSE;
            $group->save();

            $this->info("✅ Group ID {$group->id} تم تحديثه إلى CLOSE");
        }
        $this->info("✔️ تمت معالجة جميع المجموعات.");

    }
}
