<?php

namespace App\Repositoryes;

use App\EloquentWriteRepository\EloquentWriteRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\Log;

class UserWriteRepository implements EloquentWriteRepositoryInterface
{

    public function store(array $data)
    {
        DB::beginTransaction();

        try {
            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->save();

            DB::commit();

            return $user;
        } catch (Exception $e) {
            DB::rollBack();

            Log::error('Failed to create user: ' . $e->getMessage());

            return response()->json(['message' => 'User creation failed'], 500);
        }
    }
}
