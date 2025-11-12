<?php
namespace App\Http\Controllers\Admin\Auth;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;


class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    /**
     * Show the form to request a password reset link.
     */
    public function showLinkRequestForm()
    {
        // custom admin view
        return view('admin.auth.passwords.email');
    }

    // public function sendResetLinkEmail(Request $request)
    // {
    //     $request->validate(['email' => 'required|email']);

    //     $status = Password::broker('admins')->sendResetLink(
    //         $request->only('email'),
    //         function ($user, $token) 
    //         {
    //             // Manually set the reset URL to use admin route
    //             $resetUrl = URL::route('admin.password.reset', ['token' => $token, 'email' => $user->email]);
    //             \Log::info('Admin password reset URL generated', ['email' => $user->email, 'reset_url' => $resetUrl]);
                
    //             $user->sendPasswordResetNotification($token, $resetUrl);
    //         }
    //     );
    
    //     return $status === Password::RESET_LINK_SENT
    //         ? back()->with('status', __($status))
    //         : back()->withErrors(['email' => __($status)]);
    // }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $email = $request->email;

        // Determine if admin or user
        if (Admin::where('email', $email)->exists()) 
        {
            $broker = 'admins';
            $routeName = 'admin.password.reset';
        } 
        elseif (User::where('email', $email)->exists()) 
        {
            $broker = 'users';
            $routeName = 'admin.password.reset';
        } 
        else 
        {
            return back()->withErrors(['email' => 'We cannot find a user with that email address.']);
        }

        $status = Password::broker($broker)->sendResetLink(
            ['email' => $email],
            function ($user, $token) use ($routeName) {
                $resetUrl = URL::route($routeName, ['token' => $token, 'email' => $user->email]);
                $user->sendPasswordResetNotification($token, $resetUrl);
            }
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
}
