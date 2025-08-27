<?php

namespace App\ModelStates\License;

class Completed extends RequestState
{
    public static string $name = 'completed';

    public function getName(): string
    {
        return __('app.states.request_state.completed');
    }

    public function getActionName(): string
    {
        return __('app.states.request_state.actions.completed');
    }

    public function getUiClasses(): string
    {
        return 'pill pill-green';
    }
}
