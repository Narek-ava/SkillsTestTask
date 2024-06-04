<?php

namespace App\Decorators;

class JavaSkill extends UserDecorator
{
    public function getDescription(): string
    {
        return $this->user->getDescription() . ' Java';
    }
}
