<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $slug, $action)
    {
        $user = auth()->check() ? auth()->user() : null;
        $user = Auth::user();
        if (!$user)
        {
            return redirect()->route('admin.login')->withErrors('Please login to continue.');
        }
        if (!Gate::allows('has-permission', [$slug, $action])) {
            abort(403, 'Unauthorized');
        }
        return $next($request);
    }
}
