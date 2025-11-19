<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        // التحقق من أن المستخدم مسجل دخول وله صلاحية admin أو super_admin
        // role_id 1 = admin, 2 = super_admin
        if (! in_array(Auth::user()->role_id, [1, 2])) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
