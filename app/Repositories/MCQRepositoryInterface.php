<?php

namespace App\Repositories;

interface MCQRepositoryInterface
{
    public function all();

    public function findById($id);

    public function delete($id);
}