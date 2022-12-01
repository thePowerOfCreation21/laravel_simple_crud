<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClassResource;
use App\Tests\ClassTest;
use Illuminate\Http\Request;
use App\Models\ClassModel;

class ClassController extends Controller
{
    public function get ()
    {
        return response()->json(
            ClassResource::collection(
                ClassModel::get()
            )
        );
    }

    public function getById (string $id)
    {
        return response()->json(
            (new ClassTest())->getById($id)
        );
    }
}
