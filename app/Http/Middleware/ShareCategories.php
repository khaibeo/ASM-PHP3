<?php

namespace App\Http\Middleware;

use App\Models\Catalogue;
use Closure;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShareCategories
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $categories = Catalogue::whereNull('parent_id')
            ->with('children')
            ->get();

        View::share('categories', $categories);

        return $next($request);
    }

}
