<?php
namespace App\ModelStates\License;

use App\ModelStates\License\Rejected;
use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class RequestState extends State
{
    abstract public function getName(): string;

    public static function config(): StateConfig
    {
        return parent::config()
            ->default(PendingReview::class)
            ->allowTransition(PendingReview::class, UnderInspectionOfficeReview::class)
            ->allowTransition(PendingReview::class, Rejected::class)
            ->allowTransition(UnderInspectionOfficeReview::class, AssignedToInspector::class)
            ->allowTransition(AssignedToInspector::class, IssuingLicense::class)
            ->allowTransition(IssuingLicense::class, Completed::class);
    }

    public static function getTransitionState($state)
    {
        return match ($state) {
            'pending_review' => PendingReview::class,
            'under_inspection_office_review' => UnderInspectionOfficeReview::class,
            'rejected' => Rejected::class,
            'assigned_to_inspector' => AssignedToInspector::class,
            'issuing_license' => IssuingLicense::class,
            'completed' => Completed::class,
        };
    }
}
