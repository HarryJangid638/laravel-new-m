<?php
namespace App\Http\Controllers\Admin;
use Throwable;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Traits\HandlesException;
use App\DataTables\RoleDataTable;
use App\Traits\JsonResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

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
            if (request()->ajax())
            {
                return $dataTable->ajax(); // ✅ this returns JSON
            }
            return $dataTable->render('admin.roles.index');
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
            return view('admin.roles.create');
        }
        catch (Throwable $e)
        {
            return self::handleException($e, $this->baseRedirect);
        }
    }

    public function edit($id)
    {
        try
        {
            $role = Role::findOrFail($id);
            return view('admin.roles.edit', compact('role'));
        }
        catch (Throwable $e)
        {
            return self::handleException($e, $this->baseRedirect);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:roles,name',
            // Add other fields and rules as needed
        ]);

        if ($validator->fails()) {
            return self::validationError($validator->errors()->toArray());
        }

        try
        {
            $role = Role::create([
                'name' => $request->name,
                // Add other fields as needed
            ]);
            return self::success([
                'data' => $role,
                'message' => 'Role created successfully'
            ]);
        }
        catch (Throwable $e)
        {
            return self::handleException($e,$this->baseRedirect);
        }
    }

    public function show($id)
    {
        try
        {
            $role = Role::findOrfail($id);
            return self::success([
                'data' => $role,
                'message' => 'Role fetched successfully'
            ]);
        }
        catch (Throwable $e)
        {
            return self::handleException($e,$this->baseRedirect);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
            // Add other fields and rules as needed
        ]);

        if ($validator->fails()) {
            return self::validationError($validator->errors()->toArray());
        }

        try
        {
            $role = Role::findOrFail($id);
            $role->update([
                'name' => $request->name,
                // Add other fields as needed
            ]);
            return self::success([
                'data' => $role,
                'message' => 'Role updated successfully'
            ]);
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
            $role = Role::findOrFail($id);
            $role->delete();
            return self::success([
                'message' => 'Role deleted successfully'
            ]);
        }
        catch (Throwable $e)
        {
            return self::handleException($e,$this->baseRedirect);
        }
    }
}
