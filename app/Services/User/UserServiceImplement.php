<?php

namespace App\Services\User;

use LaravelEasyRepository\Service;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserServiceImplement extends Service implements UserService
{
    /**
     * jangan ubah nama variabel ini
     */
    protected $mainRepository;

    public function __construct(UserRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    public function getAllUsers(array $filters = [])
{
    return $this->mainRepository->getAllUsers($filters);
}

    public function findById($id)
    {
        return $this->mainRepository->findById($id);
    }

    public function createUser($data)
    {
        $data['password'] = Hash::make($data['password']);

        return $this->mainRepository->createUser($data);
    }

    public function updateUser($id, $data)
    {
        if (empty($data['password'])) {

            unset($data['password']);

        } else {

            $data['password'] = Hash::make($data['password']);

        }

        return $this->mainRepository->updateUser(
            $id,
            $data
        );
    }

    public function activateUser($id)
{
    return $this->mainRepository->activateUser($id);
}

public function deactivateUser($id)
{
    return $this->mainRepository->deactivateUser($id);
}
}