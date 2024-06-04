<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(
        UserService $userService
    )
    {
        $this->userService = $userService;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = User::orderByDesc('created_at')->get();

        return response()->json($users);
    }

    /**
     * @param CreateUserRequest $request
     * @return JsonResponse
     */
    public function store(CreateUserRequest $request): JsonResponse
    {

        $user = $this->userService->createUser($request->all());

        return response()->json($user);
    }
}
