@include('components.landingpage.navbar')
<main class="main">

    <!-- Page Title -->
    <div class="page-title accent-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Blog</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="/">Beranda</a></li>
            <li class="current">Blog</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Blog Posts Section -->
    <section id="blog-posts" class="blog-posts section">

      <div class="container">
        <div class="row gy-4">

          @foreach($newsList as $news)
          <div class="col-lg-4">
              <article class="position-relative h-100">
  
                  <!-- Gambar Post -->
                  <div class="post-img position-relative overflow-hidden">
                    <img src="{{ asset('storage/' . $news->gambar) }}" class="img-fluid w-100 object-fit-cover" alt="{{ $news->judul }}" style="height: 250px;">
                      <span class="post-date">{{ \Carbon\Carbon::parse($news->published_at)->format('F d') }}</span>
                  </div>
  
                  <!-- Konten Post -->
                  <div class="post-content d-flex flex-column">
  
                      <h3 class="post-title">{{ $news->judul }}</h3>
  
                      <div class="meta d-flex align-items-center">
                          <div class="d-flex align-items-center">
                              <i class="bi bi-person"></i> <span class="ps-2">{{ $news->penulis }}</span>
                          </div>
                          <span class="px-3 text-black-50">/</span>
                          <div class="d-flex align-items-center">
                              <i class="bi bi-folder2"></i> <span class="ps-2">{{ $news->kategori }}</span>
                          </div>
                      </div>
  
                      <p>
                          {{ Str::limit($news->isi, 100) }} <!-- Menampilkan 100 karakter pertama -->
                      </p>
  
                      <hr>
  
                      <a href="{{ route('blog.show', $news->slug) }}" class="readmore stretched-link">
                          <span>Baca Selengkapnya</span><i class="bi bi-arrow-right"></i>
                      </a>
  
                  </div>
  
              </article>
          </div>
      @endforeach
        </div>
      </div>

    </section><!-- /Blog Posts Section -->

    <!-- Blog Pagination Section -->
    <!-- Blog Pagination Section -->
<section id="blog-pagination" class="blog-pagination section">
  <div class="container">
    <div class="d-flex justify-content-center">
      {{ $newsList->links('vendor.pagination.bootstrap-5') }} 
      {{-- gunakan 'bootstrap-5' jika kamu menggunakan Bootstrap --}}
    </div>
  </div>
</section>

    

  </main>

  @include('components.landingpage.footer')