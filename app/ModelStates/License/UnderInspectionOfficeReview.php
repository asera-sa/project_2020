<?php

namespace App\ModelStates\License;

class UnderInspectionOfficeReview extends RequestState
{
    public static string $name = 'under_inspection_office_review';

    public function getName(): string
    {
        return __('app.states.request_state.under_inspection_office_review');
    }

    public function getActionName(): string
    {
        return __('app.states.request_state.actions.under_inspection_office_review');
    }

    public function getUiClasses(): string
    {
        return 'pill pill-blue';
    }
}
