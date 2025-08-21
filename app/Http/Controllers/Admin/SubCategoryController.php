<?php
namespace App\Http\Controllers\Admin;
use Throwable;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\HandlesException;
use App\Traits\JsonResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\DataTables\SubCategoryDataTable;

class SubCategoryController extends Controller
{
    use JsonResponseTrait, HandlesException;

    protected $baseRedirect = 'admin.dashboard';
    protected $defaultRedirect = 'admin.subcategories.index';

    public function index(SubCategoryDataTable $dataTable)
    {
        try
        {
            if (request()->ajax())
            {
                return $dataTable->ajax();
            }
            return $dataTable->render('admin.subcategories.index');
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
            $categories = Category::all();
            return view('admin.subcategories.create', compact('categories'));
        }
        catch (Throwable $e)
        {
            return self::handleException($e, $this->baseRedirect);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories,name,NULL,id,parent_id,' . ($request->parent_id ?? 'NULL'),
            'category_id' => 'required|exists:categories,id',
            'parent_id'   => 'nullable|exists:categories,id',
            'description' => 'nullable|string|max:255',
        ]);

        if ($validator->fails())
        {
            return self::validationError($validator->errors()->toArray());
        }

        try
        {
            $validated = $validator->validated();
            $validated['status'] = $request->status ?? 0;
            $subcategory = Category::create($validated);
            return self::success([
                'data' => $subcategory,
                'message' => 'SubCategory created successfully'
            ]);
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
            $subcategory = Category::findOrFail($id);
            $categories = Category::all();
            $parents = Category::where('id', '!=', $id)->get();
            return view('admin.subcategories.edit', compact('subcategory', 'categories', 'parents'));
        }
        catch (Throwable $e)
        {
            return self::handleException($e, $this->baseRedirect);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories,name,NULL,id,parent_id,' . ($request->parent_id ?? 'NULL'),
            'category_id' => 'required|exists:categories,id',
            'parent_id'   => 'nullable|exists:categories,id|not_in:' . $id,
            'description' => 'nullable|string|max:255',
        ]);

        if ($validator->fails())
        {
            return self::validationError($validator->errors()->toArray());
        }

        try
        {
            $subcategory = Category::findOrFail($id);
            $validated = $validator->validated();
            $validated['status'] = $request->status ?? 0;
            $subcategory->update($validated);
            return self::success([
                'data' => $subcategory,
                'message' => 'SubCategory updated successfully'
            ]);
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
            $subcategory = Category::findOrFail($id);
            $subcategory->delete();
            return self::success([
                'message' => 'SubCategory deleted successfully'
            ]);
        }
        catch (Throwable $e)
        {
            return self::handleException($e, $this->baseRedirect);
        }
    }
}
