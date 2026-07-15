<?php

namespace App\Http\Controllers\API;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Models\Property;

class PropertyController extends Controller
{
    public function properties()
    {
        $items = Property::with(['category', 'user'])->status(Status::ACTIVE)->paginate(10);

        return $items->toJson();
    }
}
