<?php
namespace App\Http\Controllers\Admin;
use Throwable;
use App\Models\Permission;
use App\Traits\HandlesException;
use App\Traits\JsonResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\DataTables\PermissionDataTable;
use App\Http\Requests\Permission\StoreRequest;
use App\Http\Requests\Permission\UpdateRequest;
use Illuminate\Auth\Access\AuthorizationException;

class PermissionController extends Controller
{
    use JsonResponseTrait, HandlesException;

    protected $viewBasePath = 'admin.permissions';
    protected $baseRedirect = 'admin.dashboard';
    protected $defaultRedirect = 'admin.permissions.index';

    public function index(PermissionDataTable $dataTable)
    {
        try
        {
            Gate::authorize('assign-permission.view');
            return $dataTable->render($this->viewBasePath.'.index');
        }
        catch (AuthorizationException $e)
        {
            return to_route('admin.dashboard')->with('warning' , 'You are not authorized to access this resource.');
        }
        catch (Throwable $e)
        {
            return self::handleException($e, $this->baseRedirect);
        }
    }

    public function create()
    {
        try
        {
            Gate::authorize('assign-permission.add');
            return view($this->viewBasePath.'.create');
        }
        catch (AuthorizationException $e)
        {
            return to_route('admin.dashboard')->with('warning' , 'You are not authorized to access this resource.');
        }
        catch (Throwable $e)
        {
            return to_route($this->defaultRedirect)->with('error', $e->getMessage());
        }
    }

    public function store(StoreRequest $request)
    {
        try
        {
            Gate::authorize('assign-permission.add');
            // If the request contains a 'module' field and it's a string, auto-generate permission slugs for standard actions
            if ($request->has('module') && is_string($request->module))
            {
                $module = trim(strtolower(str_replace(' ', '-', $request->module)));
                $actions = ['add', 'edit', 'view', 'delete'];
                foreach ($actions as $action)
                {
                    Permission::create([
                        'module' => ucwords($request->module),
                        'slug' => $module . '.' . $action,
                    ]);
                }
                return to_route($this->defaultRedirect)->with('success', 'Permissions for module "' . $module . '" created successfully.');
            }
            return to_route($this->defaultRedirect)->with('success', 'Permission created successfully.');
        }
        catch (AuthorizationException $e)
        {
            return to_route('admin.dashboard')->with('warning' , 'You are not authorized to access this resource.');
        }
        catch (Throwable $e)
        {
            return to_route($this->defaultRedirect)->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        try
        {
            Gate::authorize('assign-permission.edit');
            $permission = Permission::findOrFail($id);
            return view($this->viewBasePath.'.edit', compact('permission'));
        }
        catch (AuthorizationException $e)
        {
            return to_route('admin.dashboard')->with('warning' , 'You are not authorized to access this resource.');
        }
        catch (Throwable $e)
        {
            return to_route($this->defaultRedirect)->with('error', $e->getMessage());
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        try
        {
            Gate::authorize('assign-permission.edit');
            $permission = Permission::findOrFail($id);
            $permission->update($request->validated());
            return to_route($this->defaultRedirect)->with('success', 'Permission updated successfully.');
        }
        catch (AuthorizationException $e)
        {
            return to_route('admin.dashboard')->with('warning' , 'You are not authorized to access this resource.');
        }
        catch (Throwable $e)
        {
            return to_route($this->defaultRedirect)->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        try
        {
            Gate::authorize('assign-permission.view');
            $permission = Permission::findOrFail($id);
            return view($this->viewBasePath.'.show', compact('permission'));
        }
        catch (AuthorizationException $e)
        {
            return to_route('admin.dashboard')->with('warning' , 'You are not authorized to access this resource.');
        }
        catch (Throwable $e)
        {
            return self::handleException($e, $this->baseRedirect);
        }
    }

    public function destroy($id)
    {
        try
        {
            Gate::authorize('assign-permission.delete');
            $permission = Permission::findOrFail($id);
            $permission->delete();
            return back()->with('success', 'Permission deleted successfully.');
        }
        catch (AuthorizationException $e)
        {
            return to_route('admin.dashboard')->with('warning' , 'You are not authorized to access this resource.');
        }
        catch (Throwable $e)
        {
            return back()->with('error', 'An error occurred while deleting the permission. Please try again later.');
        }
    }
}


