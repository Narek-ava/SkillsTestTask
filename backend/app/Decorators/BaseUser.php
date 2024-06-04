<?php

namespace App\Decorators;

class BaseUser implements UserInterface
{

    protected $description = 'Skills:';

    public function getDescription(): string
    {
        return $this->description;
    }
}
