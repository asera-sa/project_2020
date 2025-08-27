<?php

namespace App\ModelStates\License;

class IssuingLicense extends RequestState
{
    public static string $name = 'issuing_license';

    public function getName(): string
    {
        return __('app.states.request_state.issuing_license');
    }

    public function getActionName(): string
    {
        return __('app.states.request_state.actions.issuing_license');
    }

    public function getUiClasses(): string
    {
        return 'pill pill-orange';
    }
}
