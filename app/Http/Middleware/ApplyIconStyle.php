<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApplyIconStyle
{
    /**
     * Handle an incoming request and apply active icon style to rendered HTML.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only process standard HTML responses
        if (
            !$response instanceof \Illuminate\Http\Response ||
            $request->is('api/*') ||
            $request->ajax() ||
            $request->pjax()
        ) {
            return $response;
        }

        $contentType = $response->headers->get('Content-Type');
        if ($contentType !== null && !str_contains($contentType, 'text/html')) {
            return $response;
        }

        $activeStyle = getActiveIconStyle();
        $content = $response->getContent();

        if (!is_string($content) || $content === '') {
            return $response;
        }

        // Replace icon classes in HTML to match the user's chosen active icon style from server render (Zero-Flicker SSR)
        $processed = preg_replace_callback('/<([a-z]+)\s+([^>]*\bclass=["\'][^"\']*\bki-(?:duotone|outline|solid)\b[^"\']*["\'][^>]*)>/i', function ($matches) use ($activeStyle) {
            $tag = $matches[1];
            $attributes = $matches[2];

            // Skip ignored elements and preview containers
            if (
                str_contains($attributes, 'data-kt-icon-style-ignore') ||
                str_contains($attributes, 'data-kt-icon-preview') ||
                str_contains($attributes, 'data-kt-icon-preview-style') ||
                str_contains($attributes, 'data-kt-element="icon-style-')
            ) {
                return $matches[0];
            }

            $newAttributes = preg_replace('/\bki-(duotone|outline|solid)\b/', 'ki-' . $activeStyle, $attributes);
            return "<{$tag} {$newAttributes}>";
        }, $content);

        if ($processed !== null) {
            $response->setContent($processed);
        }

        return $response;
    }
}
