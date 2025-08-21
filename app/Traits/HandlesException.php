<?php
namespace App\Traits;
use Exception;
use PDOException;
use App\Traits\JsonResponseTrait;
use Illuminate\Database\QueryException;

trait HandlesException
{
    public static function handleException(\Throwable $e,$redirectRoute = null)
    {
        // Check if the request expects JSON (API)
        if (request()->expectsJson())
        {
            if ($e instanceof QueryException)
            {
                return JsonResponseTrait::internalServerError('Database query error: ' . $e->getMessage());
            }

            if ($e instanceof PDOException)
            {
                return JsonResponseTrait::internalServerError('Database connection error: ' . $e->getMessage());
            }
            return JsonResponseTrait::internalServerError('Something went wrong. ' . $e->getMessage());
        }

        // Web HTML Response
        $redirect = $redirectRoute ? redirect()->route($redirectRoute) : redirect()->back();

        if ($e instanceof QueryException)
        {
            return $redirect->with('error', 'Database query error: ' . $e->getMessage());
        }

        if ($e instanceof PDOException)
        {
            return $redirect->with('error', 'Database connection error: ' . $e->getMessage());
        }

        return $redirect->with('error', 'Something went wrong: ' . $e->getMessage());
    }
}
