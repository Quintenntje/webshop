<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleFromUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->segment(1);

        // If first segment is a valid locale (fr, nl, or en), set it
        if (in_array($locale, ['fr', 'nl', 'en'])) {
            app()->setLocale($locale);
        } else {
            // Default to English if no valid locale in URL
            app()->setLocale('en');
        }

        return $next($request);
    }
}

