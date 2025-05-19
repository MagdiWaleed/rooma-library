<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('masterlayout.title') }}</title>
    <link rel="stylesheet" href="../assets/style/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
        @if(app()->getLocale() == 'ar')
        <style>
            body {
                text-align: right;
            }
            .logo {
                /* float: right; */
            }
        </style>
    @endif
</head>
<body>
    <header>
        <div class="logo">
            <img src="../assets/Images/Registration-Logo.jpg" alt="{{ __('masterlayout.logo_alt_text') }}">
            <p>{{ __('masterlayout.logo_text') }}</p>
        </div>
        <nav>
            <div>
                @php
                    $currentLocale = app()->getLocale();
                    $targetLocale = ($currentLocale == 'en') ? 'ar' : 'en';
                    
                    $currentRouteName = Illuminate\Support\Facades\Route::currentRouteName();
                    $currentRouteParams = Illuminate\Support\Facades\Route::current()->parameters();
                    
                    $targetRouteParams = array_merge($currentRouteParams, ['locale' => $targetLocale]);
                @endphp

                <a href="{{ route('home.page', array_merge($currentRouteParams, ['locale' => $currentLocale])) }}">{{ __('masterlayout.nav_home') }}</a>
                <a href="{{ route('home.page', array_merge($currentRouteParams, ['locale' => $currentLocale])) }}">{{ __('masterlayout.nav_contact') }}</a>
                <a href="{{ route('home.page', array_merge($currentRouteParams, ['locale' => $currentLocale])) }}">{{ __('masterlayout.nav_about') }}</a>

                <a href="{{ route($currentRouteName ?: 'home.page', $targetRouteParams) }}">
                    @if ($currentLocale == 'en')
                        {{ __('masterlayout.switch_to_arabic') }}
                    @else
                        {{ __('masterlayout.switch_to_english') }}
                    @endif
                </a>
                
                {{-- Make sure to check these freaky ahh routes and the freaking parameters passed to them in the full Project. --}}

            </div>
        </nav>
    </header>   
    <main>
        @yield('content')
    </main>
    <script src="../assets/js/Validation.js"></script>
    <script src="../assets/js/whatsApi.js"></script>
</body>
    <footer>
        <p>{!! __('masterlayout.footer_copyright') !!}</p> {{-- Used {!! !!} because the string contains HTML &copy; entity --}}
    </footer>
</html>