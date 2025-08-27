<?php

namespace App\ModelStates\User;

class Inactive extends ModelState
{
    public static $name = 'inactive';

    public static function value(): string
    {
        return static::$name;
    }

    public function getName(): string
    {
        return __('app.states.user.inactive');
    }

    public function getUiClasses(): string
    {
        return 'pill pill-pink';
    }
}
