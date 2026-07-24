<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\User\UserService;
use App\Services\Activity\ActivityService;

class UserController extends Controller
{
    protected UserService $userService;
    protected ActivityService $activityService;

    public function __construct(
        UserService $userService,
        ActivityService $activityService
    ) {
        $this->userService = $userService;
        $this->activityService = $activityService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->userService->getAllUsers();

        return view(
            'pages.user.index',
            compact('users')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $user = $this->userService->createUser(
            $request->validated()
        );

        $this->activityService->log(

            'User',

            'CREATE',

            'Menambahkan user ' . $user->name,

            $user

        );

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User berhasil ditambahkan.'
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = $this->userService->findById($id);

        return view(
            'pages.user.edit',
            compact('user')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UserRequest $request,
        string $id
    ) {
        $user = $this->userService->updateUser(
            $id,
            $request->validated()
        );

        $this->activityService->log(

            'User',

            'UPDATE',

            'Mengubah data user ' . $user->name,

            $user

        );

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User berhasil diperbarui.'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = $this->userService->findById($id);

        $this->userService->deleteUser($id);

        $this->activityService->log(

            'User',

            'DELETE',

            'Menghapus user ' . $user->name,

            $user

        );

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User berhasil dihapus.'
            );
    }
}