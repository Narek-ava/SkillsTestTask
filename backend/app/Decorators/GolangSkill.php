<?php

namespace App\Decorators;

class GolangSkill extends UserDecorator
{
    public function getDescription(): string
    {
        return $this->user->getDescription() . ' Golang';
    }
}
