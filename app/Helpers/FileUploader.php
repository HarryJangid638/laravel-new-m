<?php
namespace App\Helpers;
use App\Traits\FileUpload;
class FileUploader
{
    use FileUpload;
    /**
     * Upload file using array of parameters.
     *
     * @param array $params
     * @return array|null
     */
    public static function upload(array $params): ?array
    {
        return self::uploadFile($params);
    }
}


