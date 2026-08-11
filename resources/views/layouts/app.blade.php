{{-- ============================================================
     SMK NEGERI 2 MOJOKERTO — LAYOUT UTAMA (LARAVEL BLADE)
     ============================================================
     Layout ini adalah "kerangka" untuk halaman-halaman website.

     CARA PAKAI (di child view, mis. halaman baru):
     ------------------------------------------------------------
       @extends('layouts.app')

       @section('title', 'Halaman Baru — SMK Negeri 2 Mojokerto')

       @section('content')
         ... konten halaman (section HTML) ...
       @endsection
     ------------------------------------------------------------

     ALUR RENDER:
       1. @include('partials.header') → memuat <!DOCTYPE>, <head>
          (meta + title @yield + seluruh CSS), <body>, preloader,
          navbar, hero, dan pembuka konten.
       2. @yield('content')          → menyisipkan konten halaman
          yang didefinisikan child view.
       3. @include('partials.footer') → memuat footer, SIBOT chatbot,
          accessibility widget, seluruh JavaScript, </body></html>.
     ============================================================ --}}
@include('partials.header')

{{-- ===== KONTEN HALAMAN (diisi oleh child view via @section) ===== --}}
@yield('content')

@include('partials.footer')
