<?php
namespace App\Http\Controllers\Admin;
use Throwable;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Traits\HandlesException;
use App\Traits\JsonResponseTrait;
use App\Http\Controllers\Controller;
use App\DataTables\CategoryDataTable;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    use JsonResponseTrait, HandlesException;

    protected $baseRedirect = 'admin.dashboard';
    protected $defaultRedirect = 'admin.categories.index';

    public function index(CategoryDataTable $dataTable)
    {
        try
        {
            if (request()->ajax())
            {
                return $dataTable->ajax();
            }
            return $dataTable->render('admin.categories.index');
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
            return view('admin.categories.create');
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
            $category = Category::findOrFail($id);
            return view('admin.categories.edit', compact('category'));
        }
        catch (Throwable $e)
        {
            return self::handleException($e, $this->baseRedirect);
        }
    }

    public function store(StoreCategoryRequest $request)
    {
        try
        {
            $validated = $request->validated();
            $validated['status'] = $request->status ?? 0;
            $validated['parent_id'] = 0;
            $category = Category::create($validated);
            return self::success([
                'data' => $category,
                'message' => 'Category created successfully'
            ]);
        }
        catch (Throwable $e)
        {
            return self::handleException($e, $this->baseRedirect);
        }
    }

    public function show($id)
    {
        try
        {
            $category = Category::findOrFail($id);
            return self::success([
                'data' => $category,
                'message' => 'Category fetched successfully'
            ]);
        }
        catch (Throwable $e)
        {
            return self::handleException($e, $this->baseRedirect);
        }
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        try
        {
            $category = Category::findOrFail($id);
            $validated = $request->validated();
            $validated['status'] = $request->status ?? 0;
            $validated['parent_id'] = 0;
            $category->update($validated);
            return self::success([
                'data' => $category,
                'message' => 'Category updated successfully'
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
            $category = Category::findOrFail($id);
            $category->delete();
            return self::success([
                'message' => 'Category deleted successfully'
            ]);
        }
        catch (Throwable $e)
        {
            return self::handleException($e, $this->baseRedirect);
        }
    }
}
