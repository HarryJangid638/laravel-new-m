<?php
namespace App\Http\Controllers\Admin\Auth;
use Exception;
use App\Models\Admin;
use App\Events\UserLoggedIn;
use Illuminate\Http\Request;
use App\Traits\JsonResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    use JsonResponseTrait;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(Request $request)
    {
        if(Auth::guard('admin')->check() || Auth::guard('user')->check())
        {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        try
        {
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if ($validator->fails())
            {
                return JsonResponseTrait::validationError($validator->errors()->toArray(), $validator->errors()->first());
            }

            $credentials = $validator->validated();
            $remember = $request->has('remember');

            // Try admin login first
            if (Auth::guard('admin')->attempt($credentials, $remember)) {
                $admin = Auth::guard('admin')->user();
                $admin->save();
                // event(new UserLoggedIn($admin, 'admin'));
                return JsonResponseTrait::success(['message' => 'Logged in successfully as admin']);
            }

            // If admin login fails, try user login
            if (Auth::guard('user')->attempt($credentials, $remember))
            {
                $user = Auth::guard('user')->user();
                $user->save();
                // event(new UserLoggedIn($user, 'user'));
                return JsonResponseTrait::success(['message' => 'Logged in successfully as user']);
            }
            return JsonResponseTrait::error(['message' => 'Please check login credentials']);
        }
        catch (Exception $e)
        {
            return JsonResponseTrait::error(['message' => $e->getMessage()]);
        }
    }

    public function showForgotPassword(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
        }
       return view('admin.auth.passwords.email');
    }
    public function logout(Request $request)
    {
        // Logout for both admin and user guards
        $admin = Auth::guard('admin')->user();
        if ($admin)
        {
            $admin->setRememberToken(null); // Clear the remember token
            $admin->save(); // Save changes to the database
            event(new \App\Events\UserLoggedOut($admin));

            Auth::guard('admin')->logout();
        }
        // die('gds');

        $user = Auth::guard('user')->user();
        if ($user) {
            $user->setRememberToken(null); // Clear the remember token
            $user->save(); // Save changes to the database
            event(new \App\Events\UserLoggedOut($user));
            Auth::guard('user')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->withSuccess('you have logout successfully');
    }
}
