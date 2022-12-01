<?php

namespace App\Tests;

use App\Exceptions\CustomException;
use App\Http\Resources\ClassResource;
use App\Models\ClassModel;

class ClassTest
{
    public function getById (string $id)
    {
        $class = ClassModel::where('id', $id)->with('users')->first();
        // $class = ClassModel::orderBy('id', 'DESC')->first();

        if (empty($class))
        {
            throw new CustomException('class not found', 12, 404);
        }

        return new ClassResource($class);
    }
}
