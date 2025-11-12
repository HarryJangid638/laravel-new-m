<?php
namespace App\Http\Controllers\Admin;
use Throwable;
use App\Models\Product;
use App\Models\Category;
use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Traits\JsonResponseTrait;
use App\Traits\HandlesException;

class ProductController extends Controller
{
    use JsonResponseTrait, HandlesException;

    protected $baseRedirect = 'admin.dashboard';
    protected $defaultRedirect = 'admin.products.index';

    public function index(ProductDataTable $dataTable)
    {
        try
        {
            if (request()->ajax())
            {
                return $dataTable->ajax();
            }
            return $dataTable->render('admin.products.index');
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
            $categories = Category::where('parent_id', 0)->pluck('name', 'id');
            return view('admin.products.create', compact('categories'));
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
            $product = Product::findOrFail($id);
            $categories = Category::where('parent_id', 0)->pluck('name', 'id');
            return view('admin.products.edit', compact('product', 'categories'));
        }
        catch (Throwable $e)
        {
            return self::handleException($e, $this->baseRedirect);
        }
    }

    public function store(StoreProductRequest $request)
    {
        try
        {
            $validated = $request->validated();
            $product = Product::create($validated);
            return self::success([
                'data' => $product,
                'message' => 'Product created successfully'
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
            $product = Product::findOrFail($id);
            return self::success([
                'data' => $product,
                'message' => 'Product fetched successfully'
            ]);
        }
        catch (Throwable $e)
        {
            return self::handleException($e, $this->baseRedirect);
        }
    }

    public function update(UpdateProductRequest $request, $id)
    {
        try
        {
            $product = Product::findOrFail($id);
            $validated = $request->validated();
            $product->update($validated);
            return self::success([
                'data' => $product,
                'message' => 'Product updated successfully'
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
            $product = Product::findOrFail($id);
            $product->delete();
            return self::success([
                'message' => 'Product deleted successfully'
            ]);
        }
        catch (Throwable $e)
        {
            return self::handleException($e, $this->baseRedirect);
        }
    }
}