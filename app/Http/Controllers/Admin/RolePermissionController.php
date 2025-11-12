<?php
namespace App\Http\Controllers\Admin;
use Throwable;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\RoleHasPermission;
use App\Traits\JsonResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;
use Illuminate\Auth\Access\AuthorizationException;

class RolePermissionController extends Controller
{
    use JsonResponseTrait;
    public function index(Request $request, $role_id)
    {
        try
        {
            Gate::authorize('role-permissions.view');
            $role = Role::findOrFail($role_id);
            $permissions = Permission::all();

            return view('admin.role-permissions.index', compact('permissions', 'role'));
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

    public function create()
    {
        // Show the form for creating a new resource.
    }

    public function store(Request $request)
    {
        // Store a newly created resource in storage.
    }

    public function show($id)
    {
        // Display the specified resource.
    }

    public function edit($id)
    {
        // Show the form for editing the specified resource.
    }

    public function update(Request $request, $id)
    {
        try
        {

            Gate::authorize('role-permissions.edit');
            $user = auth('admin')->check() ? auth('admin')->user() : (auth('user')->check() ? auth('user')->user() : null);
            $role = Role::findOrFail($request->input('role_id'));
            $permissions = $request->input('permission_id', []);
            if($request->input('value') === 1)
            {
                RoleHasPermission::updateOrCreate(
                    [
                        'role_id' => $role->id,
                        'permission_id' => $permissions
                    ]
                );
            }
            else
            {

                RoleHasPermission::where('role_id', $role->id)->where('permission_id', $permissions)->delete();
            }
            // Cache::forget("user_permissions_{$user->id}");
            return self::success([
                'message' => 'Role Permission updated successfully'
            ]);
        }
        catch (AuthorizationException $e)
        {
            return self::error([
                'message' => 'You are not authorized to access this resource.',
                'error' => $th->getMessage()
            ]);
        }
        catch (Throwable $th)
        {
            return self::error([
                'message' => 'Failed to update Role Permission',
                'error' => $th->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        // Remove the specified resource from storage.
    }
}
