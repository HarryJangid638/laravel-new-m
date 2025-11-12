<?php
namespace App\Http\Controllers\Admin;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\FileUploader;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        try
        {
            $query = Setting::where('status', 1)->get();
            $settings = $query->groupBy('group');
            return view('admin.settings.index',compact('settings'));
        }
        catch (Exception $e)
        {
            return to_route('admin.dashboard')->with('error', 'Failed to load settings. Please try again.');
        }
    }

    public function update(Request $request)
    {
        try
        {

            // Validate the input
            $validator = Validator::make($request->all(), [
                'settings' => 'required|array',
                'settings.*' => 'nullable',
            ]);

            if ($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $settingsInput = $request->input('settings', []);
            $uploadedFiles = $request->file('settings', []);
            foreach ($settingsInput as $id => $value)
            {
                $setting = Setting::find($id);
                if ($setting)
                {
                    // Handle boolean type (checkboxes)
                    if ($setting->type === 'boolean')
                    {
                        $setting->value = isset($settingsInput[$id]) ? 1 : 0;
                    }
                    // Handle all other types (text, email, number, textarea, etc.)
                    else
                    {
                        $setting->value = $value;
                    }
                    $setting->save();
                }
            }

            foreach($uploadedFiles as $id => $file)
            {
                $setting = Setting::find($id);
                if ($setting->type === 'image' && isset($uploadedFiles[$id]))
                {
                    $getFile = $setting->uploads->first();
                    // Use your file upload helper here
                    $file = $uploadedFiles[$id];
                    // Example: FileUploader::upload returns ['file_name' => ..., ...]
                    $upload = FileUploader::upload([
                        'file' => $file,
                        'path' => 'uploads/settings',
                        'disk' => 'public',
                        'old_file_path' => $getFile->file_path ?? '',
                    ]);

                    if($upload)
                    {
                        $setting->uploads()->create($upload);
                        if($getFile)
                        {
                            $getFile->delete();
                        }
                    }
                }
            }

            return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
        }
        catch (Exception $e)
        {
            return redirect()->back()->with('error', 'Failed to update settings. Please try again.');
        }
    }
}
