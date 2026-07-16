<?php

namespace App\Repositories\User;

use LaravelEasyRepository\Repository;

interface UserRepository extends Repository
{
    public function getAllUsers();

    public function findById($id);

    public function createUser($data);

    public function updateUser($id, $data);

    public function deleteUser($id);
}