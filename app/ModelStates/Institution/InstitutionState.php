<?php

namespace App\ModelStates\Institution;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class RequestState extends State
{
    abstract public function getName(): string;

    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Pending::class)
            ->allowTransition(Pending::class,  Accepted::class)
            ->allowTransition(Pending::class, Rejected::class)
            ->allowTransition(Rejected::class, Accepted::class)
            ->allowTransition(Accepted::class, Rejected::class);
    }

    public static function getTransitionState($state)
    {
        return match ($state) {
            'accepted' => Accepted::class,
            'rejected' => Rejected::class,
        };
    }
}
