<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Mail\PasswordReset;
use App\Models\PasswordReset as ModelsPasswordReset;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function form()
    {
        if (Auth::check()) {
            return redirect()->to(route('user.homepage'));
        }
        session(['url.intended' => url()->previous()]);
        return view('user.pages.login');
    }

    public function authenticate(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended();
        }

        return back()
            ->withErrors(['login_failed' => 'Email atau password yang anda masukkan tidak sesuai.'])
            ->onlyInput('email');
    }

    public function askResetPasswordForm()
    {
        return view('user.auth.forgot_password');
    }

    public function sendResetPasswordForm(Request $request)
    {
        $validated = $request->validate([
            'email' => ['email:filter']
        ]);

        $userQ = User::where('email', '=', $validated['email']);
        if ($userQ->exists()) {

            $tokenQ = ModelsPasswordReset::where('email', '=', $validated['email']);
            app('auth.password.broker')->createToken($userQ->first());

            Mail::to($validated['email'])
                ->send(
                    new PasswordReset(
                        route('user.reset_password_form') . '?token=' . $tokenQ->first()->token . '&email=' . $tokenQ->first()->email
                    )
                );
            return redirect()->back()->with('message', 'Link untuk mereset password telah dikirimkan ke email anda.');
        }

        return redirect()->back()->with('message', 'Maaf email yang anda masukkan tidak terdaftar.');
    }

    public function resetPasswordForm(Request $request)
    {
        $request->validate([
            'token' => 'string',
            'email' => 'email:filter'
        ]);

        $resetQ = ModelsPasswordReset::where('email', '=', $request->email);

        if ($resetQ->exists() && $resetQ->first()->token === $request->token) {
            return view('user.auth.reset_password')
                ->with([
                    'email' => $request->email,
                    'token' => $request->token
                ]);
        }
    }

    public function resetPasswordAttempt(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email:filter', 'string'],
            'token' => ['required', 'string'],
            'password' => ['required', 'string', 'confirmed'],
        ]);

        $resetQ = ModelsPasswordReset::where([['email', '=', $request->email], ['token', '=', $request->token]]);
        if ($resetQ->exists()) {
            $user = User::where('email', '=', $resetQ->first()->email)->first();

            $user->update([
                'password' => $request->password
            ]);
            $resetQ->delete();

            Auth::login($user);

            return redirect()->to(route('user.homepage'));
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('user.homepage'));
    }
}
