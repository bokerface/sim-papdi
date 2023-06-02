<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegistrationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{

    public function form()
    {
        if (Auth::check()) {
            return redirect()->to(route('user.homepage'));
        }
        return view('user.pages.register');
    }

    public function register(UserRegistrationRequest $request)
    {
        $validated_request = $request->validated();

        $user = User::create($validated_request);

        Auth::login($user);

        return redirect()->intended();
    }
}
