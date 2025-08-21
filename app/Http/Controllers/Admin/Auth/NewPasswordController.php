<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request, $token)
    {
        // Decode the email
        $email = base64_decode($request->email);

        // Retrieve the password reset record for the email
        $passwordReset = DB::table('admin_password_resets')
        ->where('email', $email)
        ->first();

        // If no record exists or the token does not match, show an error
        if (!$passwordReset || !Hash::check($token, $passwordReset->token)) {
            return redirect()->route('admin.password.email')->withErrors(['email' => 'The password reset link has expired or is invalid.']);
        }

        // Check if the token has expired (e.g., 60 minutes)
        if (Carbon::parse($passwordReset->created_at)->addMinutes(60)->isPast()) {
            return redirect()->route('admin.password.email')->withErrors(['email' => 'The password reset link has expired.']);
        }
        return view('admin.auth.passwords.reset', ['token' => $token,'email'=>$email]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|confirmed|min:8',
        ]);
        // Retrieve the password reset record for the email
        $passwordReset = DB::table('admin_password_resets')
        ->where('email', $request->email)
        ->first();

        // Check if the token exists and matches
        if (!$passwordReset || !Hash::check($request->token, $passwordReset->token)) {
            return back()->withInput($request->only('email'))
            ->withErrors(['email' => 'The password reset link is invalid.']);
        }

        // Check if the token has expired
        if (Carbon::parse($passwordReset->created_at)->addMinutes(60)->isPast()) {
            return back()->withInput($request->only('email'))
            ->withErrors(['email' => 'The password reset link has expired.']);
        }

        // Retrieve the user by email
        $user = Admin::where('email', $request->email)->first();

        // Check if the new password is the same as the old password
        if (Hash::check($request->password, $user->password)) {
            return back()->withInput($request->only('email'))
            ->withErrors(['password' => 'The new password cannot be the same as your old password.']);
        }

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::broker('admins')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('admin.login')->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
    
}
