<?php
namespace App\Http\Controllers\Admin;
use Exception;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Helpers\FileUploader;
use App\DataTables\UserDataTable;
use App\Traits\JsonResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;

class UserController extends Controller
{
    use JsonResponseTrait;

    // Display a listing of the users.
    public function index(UserDataTable $dataTable)
    {
        try
        {
            Gate::authorize('users.view');
            return $dataTable->render('admin.users.index');
        }
        catch (AuthorizationException $e)
        {
            return to_route('admin.dashboard')->with('warning' , 'You are not authorized to access this resource.');
        }
        catch (Throwable $e)
        {
            return self::handleException($e,$this->baseRedirect);
        }
    }

    // Show the form for creating a new user.
    public function create()
    {
        try
        {
            Gate::authorize('users.add');
            return view('admin.users.create');
        }
        catch (AuthorizationException $e)
        {
            return to_route('admin.dashboard')->with('warning' , 'You are not authorized to access this resource.');
        }
        catch (Exception $e)
        {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // Store a newly created user in storage.
    public function store(StoreRequest $request)
    {
        try
        {
            Gate::authorize('users.add');
            $validated = $request->validated();
            if($request->has('password') && $request->filled('password'))
            {
                $validated['password'] = bcrypt($request->password);
            }
            // Handle avatar file upload if present
            if ($request->hasFile('avatar'))
            {
                $avatar = $request->file('avatar');
                $avatarPath = $avatar->store('uploads/users', 'public');
                $validated['avatar'] = $avatarPath;
            }

            $validated['password'] = bcrypt($request->input('password'));
            $user = User::create($validated);
            $user->roles()->sync(2); // Assign 'User' role by default
            return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
        }
        catch (AuthorizationException $e)
        {
            return to_route('admin.dashboard')->with('warning' , 'You are not authorized to access this resource.');
        }
        catch (ValidationException $e)
        {
            return back()->withErrors($e->validator->errors())->withInput();
        }
        catch (Exception $e)
        {
            return back()->with('error', $e->getMessage());
        }
    }

    // Display the specified user.
    public function show($id)
    {
        try
        {
            Gate::authorize('users.view');
            $user = User::findOrFail($id);
            return view('admin.users.show', compact('user'));
        }
        catch (AuthorizationException $e)
        {
            return to_route('admin.dashboard')->with('warning' , 'You are not authorized to access this resource.');
        }
        catch (Exception $e)
        {
            return back()->with('error', $e->getMessage());
        }
    }

    // Show the form for editing the specified user.
    public function edit($id)
    {
        try
        {
            Gate::authorize('users.edit');
            $user = User::findOrFail($id);
            return view('admin.users.edit', compact('user'));
        }
        catch (AuthorizationException $e)
        {
            return to_route('admin.dashboard')->with('warning' , 'You are not authorized to access this resource.');
        }
        catch (Exception $e)
        {
            return to_route('admin.users.index')->with('error', $e->getMessage());
        }
    }

    // Update the specified user in storage.
    public function update(UpdateRequest $request, $id)
    {
        try
        {
            Gate::authorize('users.edit');
            $user = User::findOrFail($id);
            $validated = $request->validated();
            if($request->has('password') && $request->filled('password'))
            {
                $validated['password'] = bcrypt($request->password);
            }

            if($request->hasFile('avatar'))
            {
                // Delete old avatar if exists
                if ($user->avatar && Storage::disk('public')->exists($user->avatar))
                {
                    Storage::disk('public')->delete($user->avatar);
                }
                $avatar = $request->file('avatar');
                $avatarPath = $avatar->store('uploads/users', 'public');
                $validated['avatar'] = $avatarPath;
            }

            $user->update($validated);
            $user->roles()->sync(2); // Assign 'User' role by default
            return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
        }
        catch (AuthorizationException $e)
        {
            return to_route('admin.dashboard')->with('warning' , 'You are not authorized to access this resource.');
        }
        catch (ValidationException $e)
        {
            return back()->withErrors($e->validator->errors())->withInput();
        }
        catch (Exception $e)
        {
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    // Remove the specified user from storage.
    public function destroy($id)
    {
        try
        {
            Gate::authorize('users.delete');
            $user = User::findOrFail($id);
            $user->delete();
            $user->roles()->detach();
            return back()->with('success', 'User deleted successfully.');
        }
        catch (AuthorizationException $e)
        {
            return to_route('admin.dashboard')->with('warning' , 'You are not authorized to access this resource.');
        }
        catch (Exception $e)
        {
            return back()->with('error',$e->getMessage());
        }
    }

    public function assignPermission(User $user)
    {
        try
        {
            Gate::authorize('assign-permission.view');
            $permissions = Permission::all();
            return view('admin.users.assign-permission.index', compact('user', 'permissions'));
        }
        catch (AuthorizationException $e)
        {
            return to_route('admin.dashboard')->with('warning' , 'You are not authorized to access this resource.');
        }
        catch (Exception $e)
        {
            return back()->with('error', $e->getMessage());
        }
    }

    public function storePermission(Request $request, User $user)
    {
        try
        {
            Gate::authorize('assign-permission.edit');
            $request->validate([
                'permissions' => 'required|array',
                'permissions.*' => 'exists:permissions,id',
            ]);

            $user->permissions()->sync($request->permissions);
            // Clear cached permissions for the user
            Cache::forget("user_permissions_{$user->id}");

            return redirect()->route('admin.users.index')->with('success', 'Permissions assigned successfully.');
        }
        catch (AuthorizationException $e)
        {
            return to_route('admin.dashboard')->with('warning' , 'You are not authorized to access this resource.');
        }
        catch (Exception $e)
        {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

}
