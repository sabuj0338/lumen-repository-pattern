<?php

namespace App\Repositories;

use App\Models\MCQ;

class MCQRepository implements MCQRepositoryInterface
{
    public function all()
    {
        return MCQ::get()->map->format();
    }

    public function findById($id)
    {
        return MCQ::where('id', $id)->firstOrFail()->format();
    }

    public function delete($id)
    {
        MCQ::where('id', $id)->delete();
    }
}