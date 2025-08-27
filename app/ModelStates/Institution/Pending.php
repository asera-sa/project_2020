<?php

namespace App\ModelStates\Institution;

class Pending extends RequestState
{
    public static $name = 'pending';

    public function getName(): string
    {
        return __('app.states.request_state.pending');
    }

    public function getUiClasses(): string
    {
        return 'pill pill-slate';
    }

    public function getColorClasses(): string
    {
        return 'text-slate-700';
    }
}
