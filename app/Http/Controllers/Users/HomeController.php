<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Training;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $trainings = Training::all();

        return view('user.pages.home')
            ->with(compact('trainings'));
    }
}
