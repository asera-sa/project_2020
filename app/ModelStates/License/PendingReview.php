<?php

namespace App\ModelStates\License;

use App\ModelStates\License\RequestState;

class PendingReview extends RequestState
{
    public static string $name = 'pending_review';

    public function getName(): string
    {
        return __('app.states.request_state.pending_review');
    }

    public function getActionName(): string
    {
        return __('app.states.request_state.actions.pending_review');
    }

    public function getUiClasses(): string
    {
        return 'pill pill-gray';
    }
}
