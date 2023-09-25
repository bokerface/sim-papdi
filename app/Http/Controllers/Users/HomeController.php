<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Training;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return redirect()->to(route('admin.dashboard'));
        $trainings = Training::when($request->has('category'), function ($query) use ($request) {
            $query->where('category_id', '=', $request->category);
        })->get();
        $categories = Category::all();

        return view('user.pages.home')
            ->with(compact('trainings', 'categories'));
    }
}
