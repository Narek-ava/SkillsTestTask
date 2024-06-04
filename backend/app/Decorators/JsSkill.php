<?php

namespace App\Decorators;

class JsSkill extends UserDecorator
{
    public function getDescription(): string
    {
        return $this->user->getDescription() . ' JS';
    }
}
