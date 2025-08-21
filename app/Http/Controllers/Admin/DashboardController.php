<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        try
        {
            // Admin::where('us_status',1)->first();
            return view('admin.dashboard.index');
            //code...
        }
        catch (\Throwable $th)
        {
            // return back()->with('error', $th->getMessage());
        }
    }
}
