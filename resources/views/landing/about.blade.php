@include('components.landingpage.navbar')
<main class="main">

    <!-- Page Title -->
    <div class="page-title accent-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">About</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">About</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container">

        <div class="row position-relative">

          <div class="col-lg-7 about-img" data-aos="zoom-out" data-aos-delay="200"><img src="{{ asset('build/assets/img/hero-carousel/logo1.jpeg') }}" style="height: auto;"></div>

          <div class="col-lg-7" data-aos="fade-up" data-aos-delay="100">
            <h2 class="inner-title">Sejarah Singkat</h2>
            <div class="our-story">
              <h4>Berdiri 1988</h4>
              <h3>Pondok Pesantren Assalam</h3>
              <p>Inventore aliquam beatae at et id alias. Ipsa dolores amet consequuntur minima quia maxime autem. Quidem id sed ratione. Tenetur provident autem in reiciendis rerum at dolor. Aliquam consectetur laudantium temporibus dicta minus dolor.</p>
              <p>Inventore aliquam beatae at et id alias. Ipsa dolores amet consequuntur minima quia maxime autem. Quidem id sed ratione. Tenetur provident autem in reiciendis rerum at dolor. Aliquam consectetur laudantium temporibus dicta minus dolor.</p>
              
              <p>Vitae autem velit excepturi fugit. Animi ad non. Eligendi et non nesciunt suscipit repellendus porro in quo eveniet. Molestias in maxime doloremque.</p>

            </div>
          </div>

        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Team Section -->
    <section id="team" class="team section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Pengasuh Pondok Pesantren Assalam</h2>
        <p>Beliau adalah para pengasuh Pondok Pesantren Assalam</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">
          @foreach ($pengurus as $p )
            
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="team-member">
              <div class="member-img">
                <img src="{{ asset('storage/' . $p->foto) }}" class="img-fluid w-100 object-fit-cover" alt="{{ $p->nama }}">
                <div class="social">
                </div>
              </div>
              <div class="member-info">
                <h4>{{ $p->nama }}</h4>
                <span>Pengurus : {{ $p->divisi }}</span>
                <span>{{ $p->alamat }}</span>
                <span>No Telp: {{ $p->nomor_telepon}}</span>
                <span>Email : {{ $p->email }}</span>
              </div>
            </div>
          </div><!-- End Team Member -->
          @endforeach
        </div>

      </div>

    </section><!-- /Team Section -->
    <br>
    <br>

    
  </main>
  @include('components.landingpage.footer')