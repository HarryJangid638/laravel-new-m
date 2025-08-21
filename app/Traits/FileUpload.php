<?php
namespace App\Traits;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

trait FileUpload
{
    /**
     * Upload a file and optionally delete the old one.
     *
     * @param array $params ['file' => UploadedFile, 'path' => string, 'disk' => string, 'old_file_path' => string|null]
     * @return array|null
     */
    public static function uploadFile(array $params): ?array
    {
        $file = $params['file'] ?? null;
        $path = $params['path'] ?? '';
        $disk = $params['disk'] ?? 'public';
        $oldFilePath = $params['old_file_path'] ?? null;
        // echo $oldFilePath;die;
        if (!$file instanceof UploadedFile || !$file->isValid() || empty($path))
        {
            return null;
        }

        // Delete old file if provided
        $filePath = $oldFilePath;
        if ($oldFilePath && Storage::disk($disk)->exists($filePath))
        {
            Storage::disk($disk)->delete($filePath);
        }

        // Store new file
        $filename = $file->hashName();
        $file->storeAs($path, $filename, $disk);

        // Gather file metadata
        $mimeType = $file->getClientMimeType(); // e.g. image/jpeg
        $mediaType = explode('/', $mimeType)[0];

        $extension = $file->getClientOriginalExtension();
        $originalName = $file->getClientOriginalName();

        $mediaType = explode('/', $mimeType)[0]; // 'image' from 'image/jpeg'


        $orientation = null;
        // if ($mediaType === 'image')
        // {
        //     try
        //     {
        //         $image = Image::make($file->getRealPath()); // requires intervention/image package
        //         $orientation = $image->width() > $image->height() ? 'landscape' : 'portrait';
        //     }
        //     catch (\Exception $e)
        //     {
        //         $orientation = null;
        //     }
        // }

        return [
            'file_path' => "$path/$filename",
            'file_name' => $filename,
            'file_type' => $mimeType,
            'media_type' => $mediaType,
            'extension' => $extension,
            'orientation' => $orientation,
            'original_file_name'=> $originalName,
        ];
    }
}


