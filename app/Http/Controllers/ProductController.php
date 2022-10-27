<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function store (Request $request)
    {
        return response()->json(
            Product::create(
                $request->validate([
                    'title' => ['required', 'string', 'max:150'],
                    'description' => ['nullable', 'string', 'max:5000']
                ])
            )
        );
    }

    public function get ()
    {
        return response()->json(
            Product::get()
        );
    }

    public function getById (string $id)
    {
        $entity = Product::where('id', $id)->first();

        if (empty($entity))
        {
            return response()->json([
                'code' => '1',
                'message' => 'product not found'
            ], 404);
        }

        return response()->json($entity);
    }

    public function updateById (string $id, Request $request)
    {
        Product::where('id', $id)->update(
            $request->validate([
                'title' => ['string', 'max:150'],
                'description' => ['string', 'max:5000']
            ])
        );

        return response()->json([
            'message' => 'product updated successfully'
        ]);
    }
}
