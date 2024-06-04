<?php

namespace App\Decorators;

abstract class UserDecorator implements UserInterface
{

    protected $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    abstract public function getDescription(): string;
}
