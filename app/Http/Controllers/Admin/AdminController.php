<?php
namespace App\Http\Controllers\Admin;
use Exception;
use Throwable;
use PDOException;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Helpers\FileUploader;
use App\Events\UserLoggedOut;
use App\Traits\JsonResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    use JsonResponseTrait;

    public function profile(Request $request)
    {
        try
        {
            if ($request->isMethod('post'))
            {
                try
                {
                    $user = auth()->user();
                    $validator = Validator::make($request->all(), [
                        'name' => 'required|string|max:255',
                        'phone' => 'nullable|string|max:20',
                        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    ]);

                    if ($validator->fails())
                    {
                        return JsonResponseTrait::validationError($validator->errors()->toArray(), $validator->errors()->first());
                    }

                    $validated = $validator->validated();
                    $user->update($validated);

                    if ($request->hasFile('profile_image'))
                    {
                        $getFile = $user->uploads->first();
                        $upload = FileUploader::upload([
                            'file' => $request->file('profile_image'),
                            'path' => 'uploads/users',
                            'disk' => 'public',
                            'old_file_path' => $getFile->file_path ?? '',
                        ]);

                        if($upload)
                        {
                            $validated['profile_image'] = $upload['file_name'];
                            $user->uploads()->create($upload);
                            $getFile->delete();
                        }
                    }

                    return JsonResponseTrait::success(['message' => 'Profile updated successfully.']);
                }
                catch (QueryException $e)
                {
                    return JsonResponseTrait::error('A database error occurred: ' . $e->getMessage(), 500);
                }
                catch (PDOException $e)
                {
                    return JsonResponseTrait::error('A PDO error occurred: ' . $e->getMessage(), 500);
                }
                catch (Exception $e)
                {
                    return JsonResponseTrait::error('An error occurred: ' . $e->getMessage(), 500);
                }
            }
            return view('admin.users.profile');

        }
        catch (Throwable $th)
        {
            return redirect()->route('admin.dashboard')->with('error', 'An unexpected error occurred. Please try again.');
        }
    }

    public function logout(Request $request)
    {
        try
        {
            // Logout for both admin and user guards
            $admin = Auth::guard('admin')->user();
            if ($admin) 
            {
                $admin->setRememberToken(null); // Clear the remember token
                $admin->save(); // Save changes to the database
                // event(new UserLoggedOut($admin));
            
                Auth::guard('admin')->logout();
            }

            $user = Auth::guard('user')->user();
            if ($user) {
                $user->setRememberToken(null); // Clear the remember token
                $user->save(); // Save changes to the database
                // event(new UserLoggedOut($user));
                Auth::guard('user')->logout();
            }
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('admin.login')->withSuccess('you have logout successfully');
        }
        catch (Exception $e)
        {
            return redirect()->back()->with('error', 'Logout failed. Please try again.');
        }
    }
}
