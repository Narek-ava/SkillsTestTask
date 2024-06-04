<?php

namespace App\Decorators;

class PhpSkill extends UserDecorator
{

    public function getDescription(): string
    {
        return $this->user->getDescription() . ' PHP';
    }
}
