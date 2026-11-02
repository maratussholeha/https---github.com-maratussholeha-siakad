{{-- 
    Nama file : navbar.blade.php
    NIM        : 3202416144
    Nama       : Mar'atussholeha
--}}

<nav class="navbar navbar-dark bg-success sticky-top shadow-sm">
    <div class="container-fluid">

        {{-- Logo dan tombol sidebar --}}
        <div class="d-flex align-items-center">
            <button
                class="navbar-toggler d-lg-none me-2"
                type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#sidebarMenu"
                aria-controls="sidebarMenu"
                aria-label="Buka menu"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <a class="navbar-brand fw-semibold"
               href="{{ route('dashboard') }}">
                <i class="bi bi-mortarboard-fill me-1"></i>
                {{ config('app.name') }}
            </a>
        </div>

        {{-- Tombol tema dan menu administrator --}}
        <div class="d-flex align-items-center gap-2">

            {{-- Tombol ganti tema --}}
            <button
                type="button"
                class="btn btn-outline-light btn-sm"
                id="themeToggle"
                aria-label="Ganti tema"
            >
                <i class="bi bi-moon-stars-fill" id="themeIcon"></i>
                <span id="themeText" class="d-none d-sm-inline">
                    Mode Gelap
                </span>
            </button>

            {{-- Menu administrator --}}
			<div class="dropdown">
				<button class="btn btn-primary dropdown-toggle" type="button"
						data-bs-toggle="dropdown" aria-expanded="false">
					<i class="bi bi-person-circle"></i>
					<span class="d-none d-sm-inline">{{ Auth::user()->name }}</span>
				</button>

				<ul class="dropdown-menu dropdown-menu-end">
					<li>
						<span class="dropdown-item-text small">
							{{ Auth::user()->name }}
							<span class="badge text-bg-secondary ms-1">{{ Auth::user()->role }}</span>
						</span>
					</li>

					<li><hr class="dropdown-divider"></li>

					<li>
						<form method="POST" action="{{ route('logout') }}">
							@csrf
							<button type="submit" class="dropdown-item text-danger">
								<i class="bi bi-box-arrow-right me-1"></i> Keluar
							</button>
						</form>
					</li>
				</ul>
			</div>

        </div>
    </div>
</nav>
