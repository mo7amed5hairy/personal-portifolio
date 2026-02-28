<?php

namespace App\Interfaces;

interface ProjectRepositoryInterface extends BaseRepositoryInterface
{
    public function getFeatured();
    public function getOrdered();
}
