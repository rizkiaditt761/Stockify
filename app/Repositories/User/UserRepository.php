<?php

namespace App\Repositories\User;

use LaravelEasyRepository\Repository;

interface UserRepository extends Repository
{
    public function getAllUsers(array $filters = []);

    public function findById($id);

    public function createUser($data);

    public function updateUser($id, $data);

    public function activateUser($id);

    public function deactivateUser($id);
}