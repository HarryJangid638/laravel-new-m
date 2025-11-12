<?php
namespace App\Http\Controllers\Admin;
use Throwable;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Traits\HandlesException;
use App\DataTables\RoleDataTable;
use App\Traits\JsonResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Role\StoreRequest;
use App\Http\Requests\Role\UpdateRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;

class RoleController extends Controller
{
    use JsonResponseTrait,HandlesException;
    /**
     * The default redirect route for this controller.
     * Used as a base redirect, e.g., after create/update/delete actions.
     * Typically set to the dashboard or roles index.
     */
    protected $baseRedirect = 'admin.dashboard';
    protected $defaultRedirect = 'admin.roles.index';

    public function index(RoleDataTable $dataTable)
    {
        try
        {
            Gate::authorize('roles.view');
            return $dataTable->render('admin.roles.index');
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
        try
        {
            Gate::authorize('roles.add');
            return view('admin.roles.create');
        }
        catch (AuthorizationException $e)
        {
            return to_route('admin.dashboard')->with('warning' , 'You are not authorized to access this resource.');
        }
        catch (Throwable $e)
        {
            return to_route('admin.roles.index')->with('error',$e->getMessage());
        }
    }

    public function edit($id)
    {
        try
        {
            Gate::authorize('roles.edit');
            $role = Role::findOrFail($id);
            return view('admin.roles.edit', compact('role'));
        }
        catch (AuthorizationException $e)
        {
            return to_route('admin.dashboard')->with('warning' , 'You are not authorized to access this resource.');
        }
        catch (Throwable $e)
        {
            return to_route('admin.roles.index')->with('error',$e->getMessage());
        }
    }

    public function store(StoreRequest $request)
    {
        try
        {
            Gate::authorize('roles.add');
            $validated = $request->validated();
            $role = Role::create($validated);
            return to_route('admin.roles.index')->with('success', 'Role created successfully.');
        }
        catch (AuthorizationException $e)
        {
            return to_route('admin.dashboard')->with('warning' , 'You are not authorized to access this resource.');
        }
        catch (ValidationException $e)
        {
            return back()->withErrors($e->validator->errors())->withInput();
        }
        catch (Throwable $e)
        {
            return to_route('admin.roles.index')->with('error',$e->getMessage());
        }
    }

    public function show($id)
    {
        try
        {
            Gate::authorize('roles.view');
            $role = Role::findOrfail($id);
            return self::success([
                'data' => $role,
                'message' => 'Role fetched successfully'
            ]);
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

    public function update(UpdateRequest $request, $id)
    {
        try
        {
            Gate::authorize('roles.edit');
            $role = Role::findOrFail($id);
            $validated = $request->validated();
            $role->update($validated);
            return to_route('admin.roles.index')->with('success', 'Role updated successfully.');
        }
        catch (AuthorizationException $e)
        {
            return to_route('admin.dashboard')->with('warning' , 'You are not authorized to access this resource.');
        }
        catch (ValidationException $e)
        {
            return back()->withErrors($e->validator->errors())->withInput();
        }
        catch (Throwable $e)
        {
            return self::handleException($e,$this->baseRedirect);
        }
    }

    public function destroy($id)
    {
        try
        {
            Gate::authorize('roles.delete');
            $role = Role::findOrFail($id);
            $role->delete();
            return to_route('admin.roles.index')->with('success', 'Role deleted successfully.');
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
}
