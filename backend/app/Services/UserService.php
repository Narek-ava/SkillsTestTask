<?php

namespace App\Services;

use App\EloquentWriteRepository\EloquentWriteRepositoryInterface;

class UserService
{
    protected EloquentWriteRepositoryInterface $writeRepository;

    public function __construct(
        EloquentWriteRepositoryInterface $writeRepository
    )
    {
        $this->writeRepository = $writeRepository;
    }

    public function createUser(array $data)
    {
        return $this->writeRepository->store($data);
    }
}
