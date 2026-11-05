<?php

/*
    Nama file : NoStoreAfterLogout.php
    NIM       : 3202416144
    Nama      : Mar'atussholeha
*/

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NoStoreAfterLogout
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Mencegah browser menyimpan halaman ke cache
        $response->headers->set(
            'Cache-Control',
            'no-store'
        );

        return $response;
    }
}
