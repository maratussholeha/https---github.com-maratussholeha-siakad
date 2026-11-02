<?php
/*
    Nama file : app.php
    NIM       : 3202416144
    Nama      : Mar'atussholeha
*/
use App\Http\Middleware\EnsureUserHasRole;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
		// Tamu yang membuka halaman terlindungi dialihkan ke login
		$middleware->redirectGuestsTo(fn () => route('login'));

		// Pengguna yang sudah login diarahkan ke dashboard
		// saat membuka halaman khusus tamu
		$middleware->redirectUsersTo(fn () => route('dashboard'));

		// Daftarkan alias middleware untuk pemeriksaan role
		$middleware->alias([
			'role' => EnsureUserHasRole::class,
		]);
	})
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
