<?php
namespace App\Http\Controllers\Admin;
use Throwable;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\HandlesException;
use App\Traits\JsonResponseTrait;
use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    use JsonResponseTrait, HandlesException;

    protected $baseRedirect = 'admin.dashboard';
    protected $defaultRedirect = 'admin.products.index';

    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('admin.products.index');
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return self::validationError($validator->errors()->toArray());
        }

        try
        {
            $validated = $validator->validated();
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

    public function edit($id)
    {
        try
        {
            $product = Product::findOrFail($id);
            return view('admin.products.edit', compact('product'));
        }
        catch (Throwable $e)
        {
            return self::handleException($e, $this->baseRedirect);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return self::validationError($validator->errors()->toArray());
        }

        try
        {
            $product = Product::findOrFail($id);
            $product->update($request->all());
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
