<?php

namespace App\ModelStates\Institution;

class Accepted extends RequestState
{
    public static $name = 'accepted';

    public function getName(): string
    {
        return __('app.states.request_state.accepted');
    }

    public function getActionName(): string
    {
        return __('app.states.request_state.actions.accepted');
    }

    public function getUiClasses(): string
    {
        return 'pill pill-green';
    }
}
