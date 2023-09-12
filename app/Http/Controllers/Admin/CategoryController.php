<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryByName(Request $request): JsonResponse
    {
        $trainer = Category::when($request->has('q'), function ($q) use ($request) {
            $q->where('name', 'LIKE', "%{$request->q}%");
        })
            ->limit(10)
            ->get();

        return response()->json($trainer, 200);
    }

    public function create()
    {
        return view('admin.pages.category.create');
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        CategoryService::storeCategory($request->validated());
        return redirect()->back();
    }
}
