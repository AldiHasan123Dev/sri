@include('components.landingpage.navbar')
<main class="main">

    <!-- Page Title -->
    <div class="page-title accent-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Kontak</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Beranda</a></li>
            <li class="current">Kontak</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <div class="mb-5">
        <iframe style="width: 100%; height: 400px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3954.1323399104294!2d112.8789516!3d-7.6689185!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7cf67162e8489%3A0x2ee9c8c07d11e17b!2sPONDOK%20PESANTREN%20ASSALAM!5e0!3m2!1sid!2sid!4v1746018105279!5m2!1sid!2sid" frameborder="0" allowfullscreen=""></iframe>
      </div><!-- End Google Maps -->

      <div class="container" data-aos="fade">

        <div class="row gy-5 gx-lg-5">

          <div class="col-lg-4">

            <div class="info">
              <div class="info-item d-flex">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                  <h4>Lokasi:</h4>
                  <p>Jl. Parasrejo, Blusuk, Paras Rejo, Kec. Pohjentrek, Kota Pasuruan, Jawa Timur 67171</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex">
                <i class="bi bi-envelope flex-shrink-0"></i>
                <div>
                  <h4>Email:</h4>
                  <p>info@example.com</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex">
                <i class="bi bi-whatsapp flex-shrink-0"></i>
                <div>
                  <h4>WhatsApp:</h4>
                  <a href="">+62888888888</a>
                </div>
              </div><!-- End Info Item -->

            </div>

          </div>

          <div class="col-lg-8">
            <p>Jika Anda ingin mengetahui informasi lebih lanjut, atau berminat mendaftarkan putra/putri Anda sebagai santri, ilakan hubungi kami kami melalui email atau WhatsApp untuk komunikasi yang lebih cepat.</p>
              <p>📝 Jangan lupa, klik tombol <a href="https://docs.google.com/forms/d/e/1FAIpQLScO5gBOVwhhrfcH46wDX8KJlvu61r9F1s8ZLQIigOlfgxN0dQ/viewform?usp=sharing" class="btn btn-lg btn-danger"> Daftar </a> untuk melakukan pendaftaran secara online.</p>
              
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>
  @include('components.landingpage.footer')