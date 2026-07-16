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

    public function getAllUsers()
    {
        return $this->model
            ->latest()
            ->get();
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

    public function deleteUser($id)
    {
        $user = $this->findById($id);

        return $user->delete();
    }
}