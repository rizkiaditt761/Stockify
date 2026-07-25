<?php

namespace App\Repositories\User;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\User;

class UserRepositoryImplement extends Eloquent implements UserRepository
{
    /**
     * Model class to be used in this repository.
     */
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getAllUsers(array $filters = [])
{
    $query = $this->model
        ->where('id', '!=', auth()->id());

    if (!empty($filters['search'])) {

    $search = $filters['search'];

    $query->where(function ($q) use ($search) {

        $q->where('name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->orWhere('role', 'like', "%{$search}%");

    });

}


if (!empty($filters['role'])) {

    $query->where(
        'role',
        $filters['role']
    );

}


if (!empty($filters['status'])) {

    if ($filters['status'] == 'active') {

        $query->where(
            'is_active',
            true
        );

    }


    if ($filters['status'] == 'inactive') {

        $query->where(
            'is_active',
            false
        );

    }

}

    $totalUser = $this->model->count();


    $activeUser = $this->model
        ->where('is_active', true)
        ->count();


    $inactiveUser = $this->model
        ->where('is_active', false)
        ->count();

    $users = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    return [
        'users' => $users,
        'totalUser' => $totalUser,
        'activeUser' => $activeUser,
        'inactiveUser' => $inactiveUser,
    ];
}

    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function createUser($data)
    {
        return $this->model->create($data);
    }

    public function updateUser($id, $data)
    {
        $user = $this->findById($id);

        $user->update($data);

        return $user;
    }

    public function activateUser($id)
{
    $user = $this->findById($id);

    $user->update([
        'is_active' => true,
    ]);

    return $user;
}

public function deactivateUser($id)
{
    $user = $this->findById($id);

    $user->update([
        'is_active' => false,
    ]);

    return $user;
}
}