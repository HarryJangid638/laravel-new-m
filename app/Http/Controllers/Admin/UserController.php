<?php
namespace App\Http\Controllers\Admin;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\FileUploader;
use App\DataTables\UserDataTable;
use App\Traits\JsonResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use JsonResponseTrait;

    // Display a listing of the users.
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('admin.users.index');
    }

    // Show the form for creating a new user.
    public function create()
    {
        try
        {
            return view('admin.users.create');
        }
        catch (Exception $e)
        {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // Store a newly created user in storage.
    public function store(Request $request)
    {
        try
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
            ]);

            if ($validator->fails())
            {
                return back()->withErrors($validator)->withInput();
            }

            $data = $request->only(['name', 'email']);
            $data['password'] = bcrypt($request->password);

            $user = User::create($data);

            return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
        }
        catch (Exception $e)
        {
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    // Display the specified user.
    public function show($id)
    {
        try
        {
            $user = User::findOrFail($id);
            return view('admin.users.show', compact('user'));
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
            $user = User::findOrFail($id);
            return view('admin.users.edit', compact('user'));
        }
        catch (Exception $e)
        {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // Update the specified user in storage.
    public function update(Request $request, $id)
    {
        try
        {
            $user = User::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:6|confirmed',
            ]);

            if ($validator->fails())
            {
                return back()->withErrors($validator)->withInput();
            }

            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }
            $user->save();

            return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
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
            $user = User::findOrFail($id);
            $user->delete();
            return back()->with('success', 'User deleted successfully.');
        }
        catch (Exception $e)
        {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
