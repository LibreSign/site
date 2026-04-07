<!DOCTYPE html>
<html lang="{{ current_path_locale($page) }}">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $page->title }}</title>

    <!-- Primary Meta Tags -->
    <meta name="title" content="LibreSign - Electronic signature of digital documents">
    <link rel="canonical" href="{{ $page->getUrl() }}">
    <meta name="description" content="{{ $page->description }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://uideck.com/play/">
    <meta property="og:title" content="LibreSign - Electronic signature of digital documents">
    <meta property="og:description" content="LibreSign - Electronic signature of digital documents">
    <!-- TODO: Think about the image -->
    <meta property="og:image" content="">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://uideck.com/play/">
    <meta property="twitter:title" content="LibreSign - Electronic signature of digital documents">
    <meta property="twitter:description" content="LibreSign - Electronic signature of digital documents">
    <!-- TODO: Think about the image -->
    <meta property="twitter:image" content="">

    <!--====== Favicon Icon ======-->
    <link
      rel="shortcut icon"
      href="{{ $page->baseUrl }}assets/images/favicon.png"
      type="image/png"
    />

    <!-- ===== All CSS files ===== -->
    <link rel="stylesheet" href="{{ rtrim($page->baseUrl, '/') .  mix('css/main.css', 'assets/build') }}">
    <link rel="stylesheet" href="{{ $page->baseUrl }}assets/build/css/ud-styles.css" />
    @stack('styles')
  </head>
  <body>
    @include('_layouts.header')
    @yield('body')
    @include('_layouts.footer')
  </body>
</html>
