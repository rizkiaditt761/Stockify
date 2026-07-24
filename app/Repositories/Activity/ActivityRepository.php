<?php

namespace App\Repositories\Activity;

use LaravelEasyRepository\Repository;

interface ActivityRepository extends Repository
{
    public function getActivities(array $filters = []);
}