<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Pondok Pesantren Assalam</title>
  
    <!-- Favicons -->
    <link href="{{ asset('build/assets/img/logo2.jpeg') }}" rel="icon">
    <link href="{{ asset('build/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
  
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  
    <!-- Vendor CSS Files -->
    <link href="{{ asset('build/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  
    <!-- Main CSS File -->
    <link href="{{ asset('build/assets/css/main.css') }}" rel="stylesheet">
  
  </head>
  

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container position-relative d-flex align-items-center">

      <a href="/" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">Ponpes Assalam</h1><span>.</span>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="/" class="{{ Request::is('/') ? 'active' : '' }}">Beranda</a></li>
          <li><a href="/about" class="{{ Request::is('about') ? 'active' : '' }}">Tentang Kami</a></li>
          <li><a href="/pendidikan" class="{{ Request::is('pendidikan') ? 'active' : '' }}">Pendidikan</a></li>
          <li><a href="/blog" class="{{ Request::is('blog') ? 'active' : '' }}">Blog</a></li>
          <li><a href="/contact" class="{{ Request::is('contact') ? 'active' : '' }}">Kontak</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>