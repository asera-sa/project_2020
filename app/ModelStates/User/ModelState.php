<?php

namespace App\ModelStates\User;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class ModelState extends State
{
    public abstract static function value();

    public abstract function getName();

    public abstract function getUiClasses();

    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Active::class)
            ->allowTransition(Active::class, Inactive::class)
            ->allowTransition(Inactive::class, Active::class);
    }

    public static function getTransitionState(string $state): string
    {
        return match ($state) {
            'active' => Active::class,
            'inactive' => Inactive::class,
            default => throw new \Exception('Invalid state argument, it is not found')
        };
    }
}
