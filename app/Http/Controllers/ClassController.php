<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;

class ClassController extends Controller
{
    public function get ()
    {
        return response()->json(ClassModel::all());
    }

    public function getById (string $id)
    {
        $class = ClassModel::where('id', $id)->with('users')->first();
        // $class = ClassModel::orderBy('id', 'DESC')->first();

        if (empty($class))
        {
            return response()->json([
                'message' => 'not found'
            ], 404);
        }

        return $class;
    }
}
