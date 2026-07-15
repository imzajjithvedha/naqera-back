<?php

namespace App\Http\Controllers\API;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function categories()
    {
        $items = Category::status(Status::ACTIVE)->paginate(10);

        return $items->toJson();
    }
}
