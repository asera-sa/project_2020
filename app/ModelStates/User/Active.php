<?php

namespace App\ModelStates\User;

class Active extends ModelState
{
    public static $name = 'active';

    public static function value(): string
    {
        return static::$name;
    }

    public function getName(): string
    {
        return __('app.states.user.active');
    }

    public function getUiClasses(): string
    {
        return 'pill pill-green';
    }
}
