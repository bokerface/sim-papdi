<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryService
{
    public static function storeCategory($request)
    {
        DB::transaction(function () use ($request) {
            Category::create($request);
        });
    }
}
