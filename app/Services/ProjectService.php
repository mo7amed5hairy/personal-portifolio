<?php

namespace App\Services;

use App\Interfaces\ProjectRepositoryInterface;
use App\DTOs\ProjectDTO;

class ProjectService
{
    public function __construct(
        protected ProjectRepositoryInterface $projectRepository
    ) {}

    public function getAllProjects()
    {
        return $this->projectRepository->getOrdered();
    }

    public function getFeaturedProjects()
    {
        return $this->projectRepository->getFeatured();
    }

    public function createProject(ProjectDTO $dto)
    {
        return $this->projectRepository->create($dto->toArray());
    }

    public function updateProject(int $id, ProjectDTO $dto)
    {
        return $this->projectRepository->update($id, $dto->toArray());
    }

    public function deleteProject(int $id)
    {
        return $this->projectRepository->delete($id);
    }

    public function getProject(int $id)
    {
        return $this->projectRepository->find($id);
    }
}
