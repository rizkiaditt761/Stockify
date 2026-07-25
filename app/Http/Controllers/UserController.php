<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\User\UserService;
use App\Services\Activity\ActivityService;
use Illuminate\Http\Request;

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
    public function index(Request $request)
    {
        $data = $this->userService->getAllUsers([
            'search' => $request->search,
            'role' => $request->role,
            'status' => $request->status,
        ]);

        return view(
            'pages.user.index',
            $data
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
        $user = $this->userService->findById($id);

        return view(
            'pages.user.show',
            compact('user')
        );
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
     * Temporary.
     * Akan diganti menjadi Activate / Deactivate.
     */
    public function deactivate(string $id)
{
    if ((int) auth()->id() === (int) $id) {

        return redirect()
            ->route('users.index')
            ->with(
                'warning',
                'Anda tidak dapat menonaktifkan akun yang sedang digunakan.'
            );
    }

    $user = $this->userService->deactivateUser($id);

    $this->activityService->log(

        'User',

        'DEACTIVATE',

        'Menonaktifkan user '.$user->name,

        $user

    );

    return redirect()
        ->route('users.index')
        ->with(
            'success',
            'User berhasil dinonaktifkan.'
        );
}

public function activate(string $id)
{
    $user = $this->userService->activateUser($id);

    $this->activityService->log(

        'User',

        'ACTIVATE',

        'Mengaktifkan user '.$user->name,

        $user

    );

    return redirect()
        ->route('users.index')
        ->with(
            'success',
            'User berhasil diaktifkan kembali.'
        );
}
}