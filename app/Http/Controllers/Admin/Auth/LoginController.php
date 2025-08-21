<?php
namespace App\Http\Controllers\Admin\Auth;
use Exception;
use App\Models\Admin;
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
        if(Auth::guard('admin')->check())
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
                'email' => ['required', 'email', 'exists:admins,email'],
                'password' => ['required'],
            ]);

            if ($validator->fails())
            {
                return JsonResponseTrait::validationError($validator->errors()->toArray(), $validator->errors()->first());
            }

            $credentials = $validator->validated();
            $remember = $request->has('remember');

            if (Auth::guard('admin')->attempt($credentials, $remember))
            {
                $admin = Auth::guard('admin')->user();
                $admin->save();
                return JsonResponseTrait::success(['message' => 'Logged in successfully']);
            }

            return JsonResponseTrait::error(['message' => 'Please check login credentials']);
        }
        catch (Exception $e)
        {
            return JsonResponseTrait::error(['message' => 'An unexpected error occurred. Please try again later.']);
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
        $admin = Auth::guard('admin')->user();

        if ($admin) {
            $admin->setRememberToken(null); // Clear the remember token
            $admin->save(); // Save changes to the database
        }

        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->withSuccess('you have logout successfully');
    }
}
