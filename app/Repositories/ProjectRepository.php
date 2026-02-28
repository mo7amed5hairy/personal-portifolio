<?php

namespace App\Repositories;

use App\Interfaces\ProjectRepositoryInterface;
use App\Models\Project;

class ProjectRepository extends BaseRepository implements ProjectRepositoryInterface
{
    public function __construct(Project $model)
    {
        parent::__construct($model);
    }

    public function getFeatured()
    {
        return $this->model->where('is_featured', true)->orderBy('order')->get();
    }

    public function getOrdered()
    {
        return $this->model->orderBy('order')->get();
    }
}
