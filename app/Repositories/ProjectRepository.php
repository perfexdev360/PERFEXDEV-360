<?php

namespace App\Repositories;

use App\Models\Project;

class ProjectRepository extends BaseRepository
{
    protected array $with = [];

    public function __construct(Project $model)
    {
        parent::__construct($model);
    }
}
