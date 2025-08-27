<?php

namespace App\ModelStates\License;

class ReviewedByInspector extends RequestState
{
    public static string $name = 'reviewed_by_inspector';

    public function getName(): string
    {
        return __('app.states.request_state.reviewed_by_inspector');
    }

    public function getActionName(): string
    {
        return __('app.states.request_state.actions.reviewed_by_inspector');
    }

    public function getUiClasses(): string
    {
        return 'pill pill-yellow';
    }
}
