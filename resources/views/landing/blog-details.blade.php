@include('components.landingpage.navbar')

<main class="main">

  <!-- Page Title -->
  <div class="page-title accent-background py-4">
    <div class="container d-lg-flex justify-content-between align-items-center">
      <h1 class="mb-2 mb-lg-0">Blog Details</h1>
      <nav class="breadcrumbs">
        <ol>
          <li><a href="{{ url('/') }}">Beranda</a></li>
          <li class="current">Blog Details</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="container py-5">
    <div class="row">

      <!-- Blog Content -->
      <div class="col-lg-8">

        <section id="blog-details" class="blog-details">
          <article class="article">

            <!-- Gambar -->
            <div class="post-img mb-4" style="height: 350px; overflow: hidden; border-radius: 12px;">
              <img src="{{ asset('storage/' . $news->gambar) }}"
                   alt="{{ $news->judul }}"
                   class="img-fluid w-100 h-100"
                   style="object-fit: cover;">
            </div>

            <!-- Judul -->
            <h2 class="title mb-3">{{ $news->judul }}</h2>

            <!-- Meta -->
            <div class="meta-top mb-4">
              <ul class="list-inline text-muted small">
                <li class="list-inline-item me-3"><i class="bi bi-person"></i>Penulis : {{ $news->penulis }}</li>
                <li class="list-inline-item"><i class="bi bi-clock"></i> Tanggal : {{ \Carbon\Carbon::parse($news->published_at)->translatedFormat('d F Y') }}</li>
              </ul>
            </div>

            <!-- Isi Konten -->
            <div class="content mb-5" style="line-height: 1.8;">
              {!! nl2br(e($news->isi)) !!}
            </div>

            <!-- Meta Bottom -->
            <div class="meta-bottom d-flex align-items-center gap-4">
              <div>
                <i class="bi bi-folder"></i>
                <span class="text-muted">Kategori:</span>
                <span class="fw-semibold">{{ $news->kategori }}</span>
              </div>
            </div>

          </article>
        </section>

      </div>

      <!-- Sidebar Opsional -->
      <div class="col-lg-4 sidebar">
        <div class="widgets-container ps-lg-4">

          {{-- Widget Kategori --}}
          <div class="widget-item mb-4">
            <h4 class="widget-title mb-3">Kategori</h4>
            <ul class="list-unstyled">
              <li><a href="#">Teknologi</a></li>
              <li><a href="#">Bisnis</a></li>
              <li><a href="#">Tips</a></li>
            </ul>
          </div>

          {{-- Widget Tag --}}
          <div class="widget-item">
            <h4 class="widget-title mb-3">Tags</h4>
            <div class="tags">
              <a href="#" class="badge bg-light text-dark me-1 mb-1">Creative</a>
              <a href="#" class="badge bg-light text-dark me-1 mb-1">Tips</a>
              <a href="#" class="badge bg-light text-dark me-1 mb-1">Marketing</a>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>

</main>

@include('components.landingpage.footer')
