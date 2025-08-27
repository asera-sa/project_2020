<?php

namespace App\ModelStates\License;

class AssignedToInspector extends RequestState
{
    public static string $name = 'assigned_to_inspector';

    public function getName(): string
    {
        return __('app.states.request_state.assigned_to_inspector');
    }

    public function getActionName(): string
    {
        return __('app.states.request_state.actions.assigned_to_inspector');
    }

    public function getUiClasses(): string
    {
        return 'pill pill-indigo';
    }
}
