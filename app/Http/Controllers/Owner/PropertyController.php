<?php

namespace App\Http\Controllers\Owner;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePropertyRequest;

class PropertyController extends Controller
{
    public function index()
    {
        $this->authorize('properties-manage');

        return response()->json([
            'message' => 'You are viewing properties as an owner',
        ]);
    }

    public function store(StorePropertyRequest $request)
    {
        $this->authorize('properties-manage');

        return Property::create($request->validated());
    }
}
