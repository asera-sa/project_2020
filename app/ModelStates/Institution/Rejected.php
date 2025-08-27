<?php

namespace App\ModelStates\Institution;

class Rejected extends RequestState
{
    public static $name = 'rejected';

    public function getName(): string
    {
        return __('app.states.request_state.rejected');
    }

    public function getActionName(): string
    {
        return __('app.states.request_state.actions.rejected');
    }

    public function getUiClasses(): string
    {
        return 'pill pill-red';
    }
}
