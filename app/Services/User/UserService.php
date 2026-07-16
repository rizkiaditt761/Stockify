<?php

namespace App\Services\User;

use LaravelEasyRepository\BaseService;

interface UserService extends BaseService
{
    public function getAllUsers();

    public function findById($id);

    public function createUser($data);

    public function updateUser($id, $data);

    public function deleteUser($id);
}