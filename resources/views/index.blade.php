@include('layouts.app')

<!-- ================= PROFIL SECTION ================= -->
<section class="profil-section section-py" id="profil">
  <div class="container">
    <div class="section-header center" data-reveal>
      <div class="section-label">Buku Sejarah SMKN 2</div>
      <h2 class="section-title">Profil <span class="accent">Sekolah</span></h2>
      <p class="section-desc">Mengenal lebih dekat sejarah, visi, misi, dan komitmen SMK Negeri 2 Mojokerto dalam mencetak lulusan vokasi berkualitas. Buka buku ini halaman demi halaman &mdash; seperti membaca buku sejarah sungguhan.</p>
    </div>

    <div class="flipbook" data-reveal style="margin-top:2.6rem">
      <div class="flipbook-stage" id="flipbook">
        <button class="flip-nav flip-prev" aria-label="Halaman sebelumnya"><i class="fas fa-chevron-left"></i></button>

        <div class="book3d">
          <div class="book-spine"></div>

          <!-- Sheet 1: Cover + Tentang Kami -->
          <div class="book-sheet active" data-sheet="0">
            <div class="book-leaf cover">
              <div class="book-cover-top">
                <div class="profil-akreditasi"><i class="fas fa-certificate"></i> Akreditasi A &mdash; BAN-SM 2023</div>
                <div class="book-cover-kicker">Buku Sejarah</div>
              </div>
              <div class="book-cover-photo">
                <img src="{{ asset('images/smkn-guru.jpg') }}" alt="Para Guru dan Staf SMK Negeri 2 Mojokerto">
              </div>
              <div class="book-cover-title">
                <div class="book-cover-eyebrow">Est. 1968</div>
                <div class="book-cover-school">SMK Negeri <em class="num-2">2</em><br>Kota Mojokerto</div>
                <div class="book-cover-sub">Kisah perjalanan sekolah vokasi unggulan Kota Mojokerto sejak tahun 1968.</div>
              </div>
            </div>
            <div class="book-leaf paper">
              <div class="book-page-head">
                <div>
                  <div class="book-page-kicker">Tentang Kami</div>
                  <div class="book-page-title">Profil <span class="num-2">Sekolah</span></div>
                </div>
                <div class="book-page-no">01</div>
              </div>
              <p class="book-page-text">Mengenal lebih dekat visi, misi, dan komitmen SMK Negeri <em class="num-2">2</em> Mojokerto dalam mencetak lulusan vokasi berkualitas.</p>
              <p class="book-page-text">Selamat datang di Buku Sejarah SMK Negeri 2 Mojokerto. Susuri perjalanan sekolah vokasi unggulan Kota Mojokerto ini halaman demi halaman &mdash; dari fondasi pendidikan kejuruan, program keahlian, hingga prestasi di tingkat provinsi dan nasional.</p>
              <div class="book-quote"><strong>&ldquo;Membentuk generasi vokasi yang beriman, berkarakter, dan berdaya saing global.&rdquo;</strong></div>
            </div>
          </div>

          <!-- Sheet 2: Sejarah -->
          <div class="book-sheet" data-sheet="1">
            <div class="book-leaf paper">
              <div class="book-page-head">
                <div>
                  <div class="book-page-kicker">BAB I &mdash; Sejarah</div>
                  <div class="book-page-title">Merintis Generasi Vokasi Sejak 1968</div>
                </div>
                <div class="book-page-no">02</div>
              </div>
              <p class="book-page-text">Berdiri sejak 1968, SMK Negeri <em class="num-2">2</em> Mojokerto telah menjadi pilihan utama keluarga Mojokerto dalam menyiapkan generasi vokasi yang kompeten, berkarakter, dan siap bersaing di era global.</p>
              <p class="book-page-text">Dari masa ke masa, sekolah ini terus bertumbuh: membuka program keahlian baru, membangun kemitraan dengan dunia usaha dan industri, hingga meraih akreditasi A dan sederet prestasi tingkat provinsi maupun nasional.</p>
              <div class="book-timeline">
                <div class="book-milestone"><span class="book-year">1968</span><span class="book-mile-text">Berdiri dan membuka pendidikan kejuruan pertama</span></div>
                <div class="book-milestone"><span class="book-year">2023</span><span class="book-mile-text">Meraih Akreditasi A dari BAN-SM</span></div>
                <div class="book-milestone"><span class="book-year">2024</span><span class="book-mile-text">Juara 1 LKS Provinsi Jawa Timur</span></div>
              </div>
            </div>
            <div class="book-leaf paper">
              <div class="book-page-head">
                <div>
                  <div class="book-page-kicker">BAB I &mdash; Sejarah (Lanjutan)</div>
                  <div class="book-page-title">Tumbuh, Berprestasi, dan Mendunia</div>
                </div>
                <div class="book-page-no">03</div>
              </div>
              <p class="book-page-text">SMK Negeri 2 Mojokerto kini menjadi sekolah kejuruan yang dinamis dengan berbagai program keahlian yang relevan dengan kebutuhan industri &mdash; mulai dari teknologi rekayasa hingga ekonomi kreatif.</p>
              <p class="book-page-text">Dukungan 80+ pendidik dan tenaga kependidikan yang kompeten serta lingkungan belajar yang modern menjadikan sekolah ini rumah bagi lebih dari 1200 siswa aktif.</p>
              <div class="book-stats">
                <div class="book-stat"><strong>57+</strong><span>Tahun Berdiri</span></div>
                <div class="book-stat"><strong>80+</strong><span>Guru &amp; Staff</span></div>
                <div class="book-stat"><strong>1200+</strong><span>Siswa Aktif</span></div>
              </div>
            </div>
          </div>

          <!-- Sheet 3: Visi & Misi -->
          <div class="book-sheet" data-sheet="2">
            <div class="book-leaf paper">
              <div class="book-page-head">
                <div>
                  <div class="book-page-kicker">BAB II &mdash; Visi</div>
                  <div class="book-page-title">Visi Sekolah</div>
                </div>
                <div class="book-page-no">04</div>
              </div>
              <p class="book-page-text" style="margin-bottom:1rem">Visi SMK Negeri <em class="num-2">2</em> Mojokerto:</p>
              <div class="vm-text">&ldquo;Menjadi sekolah menengah kejuruan yang menghasilkan lulusan beriman, bertaqwa, berkarakter, kompeten, berwawasan lingkungan, dan mampu bersaing di tingkat nasional maupun internasional.&rdquo;</div>
              <div class="book-quote">Visi ini menjadi kompas bagi seluruh program dan kegiatan sekolah dalam mencetak lulusan yang siap kerja, siap kuliah, dan berkarakter.</div>
            </div>
            <div class="book-leaf paper">
              <div class="book-page-head">
                <div>
                  <div class="book-page-kicker">BAB II &mdash; Misi</div>
                  <div class="book-page-title">Misi Sekolah</div>
                </div>
                <div class="book-page-no">05</div>
              </div>
              <div class="misi-list">
                <div class="misi-item"><div class="misi-num">1</div><div class="misi-text">Menyelenggarakan pendidikan dan pelatihan berbasis kompetensi yang relevan dengan kebutuhan industri</div></div>
                <div class="misi-item"><div class="misi-num">2</div><div class="misi-text">Mengembangkan karakter siswa yang berakhlak mulia, disiplin, dan bertanggung jawab</div></div>
                <div class="misi-item"><div class="misi-num">3</div><div class="misi-text">Membangun kemitraan strategis dengan dunia usaha dan industri untuk peningkatan kualitas lulusan</div></div>
                <div class="misi-item"><div class="misi-num">4</div><div class="misi-text">Menciptakan lingkungan belajar yang inovatif, kreatif, dan berwawasan teknologi</div></div>
              </div>
            </div>
          </div>

          <!-- Sheet 4: Penutup + Back Cover -->
          <div class="book-sheet" data-sheet="3">
            <div class="book-leaf paper">
              <div class="book-page-head">
                <div>
                  <div class="book-page-kicker">Penutup</div>
                  <div class="book-page-title">Komitmen Kami</div>
                </div>
                <div class="book-page-no">06</div>
              </div>
              <p class="book-page-text">Buku ini adalah awal dari perjalanan panjang. SMK Negeri <em class="num-2">2</em> Mojokerto terus berkomitmen mencetak lulusan yang beriman, bertaqwa, berkarakter, kompeten, berwawasan lingkungan, dan siap bersaing di tingkat nasional maupun internasional.</p>
              <p class="book-page-text">Terima kasih telah membaca buku sejarah kami. Mari bersama mencetak generasi vokasi unggulan Kota Mojokerto.</p>
              <div class="book-quote"><strong>Disiplin, Berprestasi &mdash; SMK Negeri 2 Mojokerto.</strong></div>
            </div>
            <div class="book-leaf back">
              <div class="book-back-logo"><img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SMK Negeri 2 Mojokerto"></div>
              <div class="book-back-title">SMK Negeri <em class="num-2">2</em><br>Kota Mojokerto</div>
              <div class="book-back-sub">Terima kasih telah membaca Buku Sejarah kami.</div>
              <div class="book-back-badge"><i class="fas fa-award"></i> Akreditasi A &mdash; Est. 1968</div>
            </div>
          </div>
        </div>

        <button class="flip-nav flip-next" aria-label="Halaman berikutnya"><i class="fas fa-chevron-right"></i></button>
      </div>

      <div class="flip-controls">
        <button class="flip-restart" onclick="flipRestart()"><i class="fas fa-book-open"></i> Baca dari Awal</button>
        <div class="flip-dots">
          <button class="flip-dot active" data-dot="0" aria-label="Halaman 1-2"></button>
          <button class="flip-dot" data-dot="1" aria-label="Halaman 3-4"></button>
          <button class="flip-dot" data-dot="2" aria-label="Halaman 5-6"></button>
          <button class="flip-dot" data-dot="3" aria-label="Halaman 7-8"></button>
        </div>
        <div class="flip-counter">Halaman <span id="flip-cur">1&ndash;2</span> dari <span id="flip-total">8</span></div>
      </div>
      <div class="flip-hint"><i class="fas fa-hand-pointer"></i> Klik sisi kiri/kanan buku atau gunakan tombol panah untuk membalik halaman</div>
    </div>
  </div>
</section>

<!-- ================= JENDELA KEPALA SEKOLAH (corporate glass window) ================= -->
<section class="window-section" id="sambutan">
  <div class="window-bg"></div>
  <div class="container">
    <div class="section-header center" data-reveal style="margin-bottom:1.2rem">
      <div class="section-label">Sambutan</div>
      <h2 class="section-title">Kepala <span class="accent">Sekolah</span></h2>
      <p class="section-desc">Jendela kaca modern menuju ruang kepala sekolah &mdash; buka pesan untuk melihat sambutannya.</p>
    </div>

    <div class="window-stage" data-reveal>
      <div class="window-frame" id="kepsekWindow">
        <!-- INTERIOR: isi sambutan (terlihat setelah jendela terbuka) -->
        <div class="window-scene">
          <div class="ws-inner">
            <div class="ws-left">
              <div class="ws-photo-frame">
                <img class="ws-photo" src="{{ asset('images/kepsek-nobg.png') }}" alt="Kepala Sekolah" loading="lazy" />
              </div>
              <div class="ws-photo-cap">Iswahyudi, S.ST. M.Pd</div>
              <div class="ws-photo-role">Kepala SMK Negeri <span class="num-2">2</span> Mojokerto</div>
            </div>
            <div class="ws-right">
              <div class="ws-kicker"><span class="ws-kicker-line"></span>Welcome Message</div>
              <div class="ws-welcome">Sambutan Kepala Sekolah</div>
              <div class="ws-quote">&ldquo;Pendidikan adalah proses untuk menyiapkan generasi menghadapi masa depan.&rdquo;</div>
              <p class="ws-msg">Assalamu&rsquo;alaikum warahmatullahi wabarakatuh. Selamat datang di website resmi SMK Negeri 2 Mojokerto. Kami berkomitmen mencetak generasi vokasi yang kompeten, berkarakter, dan siap bersaing di dunia industri global. Bersama seluruh civitas akademika, kami terus berinovasi demi masa depan pendidikan vokasi yang lebih baik.</p>
              <div class="ws-sign">
                <div class="ws-sign-name">Iswahyudi, S.ST. M.Pd</div>
                <div class="ws-sign-role">Kepala SMK Negeri <span class="num-2">2</span> Mojokerto</div>
              </div>
            </div>
          </div>
        </div>

        <!-- KACA JENDELA -->
        <div class="window-glass left">
          <div class="window-pane-glass"></div>
        </div>
        <div class="window-glass right">
          <div class="window-pane-glass"></div>
        </div>

        <!-- STATE TERTUTUP: FROM THE PRINCIPAL'S OFFICE -->
        <div class="window-knock">
          <div class="wk-label">From The Principal&rsquo;s Office</div>
          <div class="wk-title">SAMBUTAN<br />KEPALA SEKOLAH</div>
          <div class="wk-silhouette"><img src="{{ asset('images/kepsek-nobg.png') }}" alt="" loading="lazy" /></div>
          <button class="wk-btn" id="kepsekKnockBtn">[ Open Message ] <i class="fas fa-arrow-right"></i></button>
        </div>

        <!-- CAHAYA MASUK -->
        <div class="ws-glow"></div>

        <button class="ws-close" id="kepsekCloseBtn"><i class="fas fa-times"></i> Tutup Jendela</button>
      </div>
    </div>
  </div>
</section>
<!-- ================= JURUSAN SECTION ================= -->
<section class="jurusan-section section-py" id="jurusan">
  <div class="container">
    <div class="section-header center" data-reveal>
      <div class="section-label">Program Keahlian</div>
      <h2 class="section-title">5 <span class="accent">Jurusan</span> <span class="gold">Unggulan</span></h2>
      <p class="section-desc">Temukan bidang yang sesuai dengan minat dan bakatmu. Setiap jurusan dibimbing oleh guru profesional dan terhubung langsung dengan dunia industri.</p>
    </div>

    <div class="jurusan-carousel" data-reveal>
      <div class="carousel-stage" id="carouselStage" role="region" aria-label="Carousel jurusan unggulan">
        <!-- 01 APHP -->
        <article class="carousel-card hidden" data-index="0" data-pos="hidden" tabindex="0" role="button" aria-label="Jurusan APHP">
          <div class="card-inner">
            <div class="cc-photo p-aphp">
              <img src="{{ asset('images/aphp.png') }}" alt="Siswa APHP SMK Negeri 2 Mojokerto" loading="lazy">
            </div>
            <div class="cc-body">
              <div class="cc-abbr">APHP</div>
              <div class="cc-line"></div>
              <div class="cc-full">Agribisnis Pengolahan Hasil Pertanian</div>
              <div class="cc-desc">Mengolah hasil pertanian menjadi produk bernilai jual tinggi dengan standar industri pangan.</div>
              <div class="cc-stats">
                <span class="cc-stat">160 Siswa</span>
                <span class="cc-stat gold">88% Terserap</span>
              </div>
              <a href="career-roadmap.html" class="cc-cta">Lihat Jurusan <i class="fas fa-arrow-right"></i></a>
              <div class="cc-hint">Klik untuk melihat</div>
            </div>
          </div>
        </article>
        <!-- 02 DKV -->
        <article class="carousel-card hidden" data-index="1" data-pos="hidden" tabindex="0" role="button" aria-label="Jurusan DKV">
          <div class="card-inner">
            <div class="cc-photo p-dkv">
              <img src="{{ asset('images/dkv.png') }}" alt="Siswa DKV SMK Negeri 2 Mojokerto" loading="lazy">
            </div>
            <div class="cc-body">
              <div class="cc-abbr">DKV</div>
              <div class="cc-line"></div>
              <div class="cc-full">Desain Komunikasi Visual</div>
              <div class="cc-desc">Menciptakan karya desain, ilustrasi, dan media kreatif untuk kebutuhan industri kreatif.</div>
              <div class="cc-stats">
                <span class="cc-stat">150 Siswa</span>
                <span class="cc-stat gold">90% Terserap</span>
              </div>
              <a href="career-roadmap.html" class="cc-cta">Lihat Jurusan <i class="fas fa-arrow-right"></i></a>
              <div class="cc-hint">Klik untuk melihat</div>
            </div>
          </div>
        </article>
        <!-- 03 KULINER -->
        <article class="carousel-card hidden" data-index="2" data-pos="hidden" tabindex="0" role="button" aria-label="Jurusan Kuliner">
          <div class="card-inner">
            <div class="cc-photo p-kuliner">
              <img src="{{ asset('images/kuliner.png') }}" alt="Siswa Kuliner SMK Negeri 2 Mojokerto" loading="lazy">
            </div>
            <div class="cc-body">
              <div class="cc-abbr">KULINER</div>
              <div class="cc-line"></div>
              <div class="cc-full">Tata Boga &amp; Kuliner</div>
              <div class="cc-desc">Menguasai seni memasak, pastry, dan manajemen usaha kuliner kelas profesional.</div>
              <div class="cc-stats">
                <span class="cc-stat">180 Siswa</span>
                <span class="cc-stat gold">90% Terserap</span>
              </div>
              <a href="career-roadmap.html" class="cc-cta">Lihat Jurusan <i class="fas fa-arrow-right"></i></a>
              <div class="cc-hint">Klik untuk melihat</div>
            </div>
          </div>
        </article>
        <!-- 04 LPS -->
        <article class="carousel-card hidden" data-index="3" data-pos="hidden" tabindex="0" role="button" aria-label="Jurusan LPS">
          <div class="card-inner">
            <div class="cc-photo p-lps">
              <img src="{{ asset('images/lps.png') }}" alt="Siswa LPS SMK Negeri 2 Mojokerto" loading="lazy">
            </div>
            <div class="cc-body">
              <div class="cc-abbr">LPS</div>
              <div class="cc-line"></div>
              <div class="cc-full">Layanan Perbankan Syariah</div>
              <div class="cc-desc">Mempersiapkan tenaga profesional perbankan syariah dan lembaga keuangan mikro.</div>
              <div class="cc-stats">
                <span class="cc-stat">140 Siswa</span>
                <span class="cc-stat gold">92% Terserap</span>
              </div>
              <a href="career-roadmap.html" class="cc-cta">Lihat Jurusan <i class="fas fa-arrow-right"></i></a>
              <div class="cc-hint">Klik untuk melihat</div>
            </div>
          </div>
        </article>
        <!-- 05 RPL -->
        <article class="carousel-card active" data-index="4" data-pos="active" tabindex="0" role="button" aria-label="Jurusan RPL">
          <div class="card-inner">
            <div class="cc-photo p-rpl">
              <img src="{{ asset('images/rpl.png') }}" alt="Siswa RPL SMK Negeri 2 Mojokerto" loading="lazy">
            </div>
            <div class="cc-body">
              <div class="cc-abbr">RPL</div>
              <div class="cc-line"></div>
              <div class="cc-full">Rekayasa Perangkat Lunak</div>
              <div class="cc-desc">Membangun aplikasi web, mobile, dan solusi digital dengan teknologi terkini.</div>
              <div class="cc-stats">
                <span class="cc-stat">240 Siswa</span>
                <span class="cc-stat gold">95% Terserap</span>
              </div>
              <a href="career-roadmap.html" class="cc-cta">Lihat Jurusan <i class="fas fa-arrow-right"></i></a>
              <div class="cc-hint">Klik untuk melihat</div>
            </div>
          </div>
        </article>
      </div>

      <div class="carousel-nav">
        <button class="carousel-nav-btn" id="carouselPrev" aria-label="Jurusan sebelumnya"><i class="fas fa-chevron-left"></i></button>
        <div class="carousel-indicator"><span id="carouselCur">05</span> / <em>05</em></div>
        <button class="carousel-nav-btn" id="carouselNext" aria-label="Jurusan berikutnya"><i class="fas fa-chevron-right"></i></button>
      </div>
    </div>
  </div>
</section>

<!-- ================= JOURNEY TIMELINE / ROADMAP ================= -->
<section class="roadmap-preview-section" id="roadmap-preview">
  <!-- Map background: contours + blueprint grid + coords + compass -->
  <div class="j2k8-map" aria-hidden="true">
    <div class="j2k8-grid"></div>
    <div class="j2k8-contours"></div>
    <div class="j2k8-coords">
      <i style="top:11%;left:4%">122.42&deg; E</i>
      <i style="top:16%;right:6%">07.47&deg; S</i>
      <i style="bottom:8%;left:13%">GRID 4B</i>
      <span class="cd-dot" style="top:20%;left:23%"></span>
      <span class="cd-dot" style="top:66%;left:84%"></span>
      <span class="cd-dot" style="top:40%;left:47%"></span>
      <span class="cd-dash" style="top:30%;left:58%"></span>
      <span class="cd-dash" style="top:76%;left:32%"></span>
    </div>
    <div class="j2k8-compass">
      <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
        <circle cx="50" cy="50" r="46" fill="none" stroke="currentColor" stroke-width="2.5" opacity=".7"/>
        <circle cx="50" cy="50" r="38" fill="none" stroke="currentColor" stroke-width="1" opacity=".4"/>
        <path d="M50 14 L56 44 L50 38 L44 44 Z" fill="currentColor" opacity=".85"/>
        <path d="M50 86 L44 56 L50 62 L56 56 Z" fill="currentColor" opacity=".4"/>
        <text x="50" y="11" text-anchor="middle" font-size="13" font-weight="700" fill="#7fd4ff" font-family="ui-monospace,monospace">N</text>
      </svg>
    </div>
  </div>

  <div class="container roadmap-preview-inner">
    <div class="roadmap-preview-header">
      <span class="j2k8-label">Roadmap Pengembangan Sekolah</span>
      <h2 class="section-title">Roadmap <span class="accent">Pengembangan</span> Sekolah</h2>
      <p class="section-desc">Perjalanan transformasi SMK Negeri 2 Mojokerto menuju sekolah vokasi rujukan nasional.</p>
      <div class="j2k8-legend">
        <span><span class="lg-ic lg-done"><i class="fas fa-check"></i></span> Selesai</span>
        <span><span class="lg-ic lg-running"><i class="fas fa-circle"></i></span> Berjalan</span>
        <span><span class="lg-ic lg-goal"><i class="fas fa-star"></i></span> Target</span>
      </div>
    </div>

    <div class="j2k8-stage" id="j2k8Stage">
      <svg class="j2k8-route" viewBox="0 0 1200 1150" preserveAspectRatio="none" aria-hidden="true">
        <path class="route-base" d="M120,934 C192,790.3 268,532.2 336,503 C404,473.8 468,739.3 528,759 C588,778.7 612,709.2 696,621 C780,532.8 912,230 1032,230"/>
        <path class="route-dash" d="M120,934 C192,790.3 268,532.2 336,503 C404,473.8 468,739.3 528,759 C588,778.7 612,709.2 696,621 C780,532.8 912,230 1032,230"/>
        <path class="route-glow" d="M120,934 C192,790.3 268,532.2 336,503 C404,473.8 468,739.3 528,759 C588,778.7 612,709.2 696,621 C780,532.8 912,230 1032,230"/>
      </svg>
      <span class="j2k8-arrow" style="left:19%;top:60%"></span>
      <span class="j2k8-arrow" style="left:47%;top:65%"></span>
      <span class="j2k8-arrow" style="left:72%;top:37%"></span>

      <!-- 01 | 2020-2022 | Fondasi Sekolah (START - bottom-left) -->
      <div class="j2k8-milestone j2k8-start">
        <span class="j2k8-start-flag" style="left:3%;top:71.9%"><i class="fas fa-flag-checkered"></i> Awal Perjalanan</span>
        <div class="j2k8-checkpoint" style="left:10%;top:81.25%" tabindex="0" role="button" aria-label="2020, awal perjalanan">
          <div class="j2k8-node"><i class="fas fa-school"></i></div>
          <span class="j2k8-cp-year">2020</span>
        </div>
        <span class="j2k8-connector v" style="left:10%;top:82.3%;height:55px"></span>
        <div class="j2k8-card" style="left:1%;top:86.25%">
          <div class="j2k8-card-top">
            <span class="j2k8-num">01</span>
            <span class="j2k8-status s-done"><span class="j2k8-status-dot"></span> Selesai</span>
          </div>
          <div class="j2k8-year">2020&ndash;2022</div>
          <h3 class="j2k8-name">Fondasi Sekolah</h3>
          <p class="j2k8-desc">Renovasi laboratorium, Akreditasi A, dan penguatan kemitraan industri.</p>
        </div>
      </div>

      <!-- 02 | 2023-2024 | Digitalisasi Sekolah (top-left) -->
      <div class="j2k8-milestone">
        <div class="j2k8-checkpoint" style="left:28%;top:43.75%" tabindex="0" role="button" aria-label="2023, digitalisasi sekolah">
          <div class="j2k8-node"><i class="fas fa-laptop-code"></i></div>
          <span class="j2k8-cp-year">2023</span>
        </div>
        <span class="j2k8-connector v" style="left:28%;top:38.35%;height:40px"></span>
        <div class="j2k8-card" style="left:12%;top:24%">
          <div class="j2k8-card-top">
            <span class="j2k8-num">02</span>
            <span class="j2k8-status s-done"><span class="j2k8-status-dot"></span> Selesai</span>
          </div>
          <div class="j2k8-year">2023&ndash;2024</div>
          <h3 class="j2k8-name">Digitalisasi Sekolah</h3>
          <p class="j2k8-desc">Digitalisasi perpustakaan serta penguatan sertifikasi Cisco &amp; Oracle.</p>
        </div>
      </div>

      <!-- 03 | 2025 | Transformasi Vokasi (middle-left) -->
      <div class="j2k8-milestone">
        <div class="j2k8-checkpoint" style="left:44%;top:66%" tabindex="0" role="button" aria-label="2025, transformasi vokasi">
          <div class="j2k8-node"><i class="fas fa-gear"></i></div>
          <span class="j2k8-cp-year">2025</span>
        </div>
        <span class="j2k8-connector v" style="left:44%;top:68.8%;height:60px"></span>
        <div class="j2k8-card" style="left:28%;top:73%">
          <div class="j2k8-card-top">
            <span class="j2k8-num">03</span>
            <span class="j2k8-status s-running"><span class="j2k8-status-dot"></span> Berjalan</span>
          </div>
          <div class="j2k8-year">2025</div>
          <h3 class="j2k8-name">Transformasi Vokasi</h3>
          <p class="j2k8-desc">Penguatan pembelajaran berbasis industri dan kompetensi siswa.</p>
        </div>
      </div>

      <!-- 04 | 2026 | Penguatan Ekosistem (middle-right) -->
      <div class="j2k8-milestone">
        <div class="j2k8-checkpoint" style="left:58%;top:54%" tabindex="0" role="button" aria-label="2026, penguatan ekosistem">
          <div class="j2k8-node"><i class="fas fa-handshake"></i></div>
          <span class="j2k8-cp-year">2026</span>
        </div>
        <span class="j2k8-connector v" style="left:58%;top:47.5%;height:36px"></span>
        <div class="j2k8-card" style="left:40%;top:36%">
          <div class="j2k8-card-top">
            <span class="j2k8-num">04</span>
            <span class="j2k8-status s-running"><span class="j2k8-status-dot"></span> Berjalan</span>
          </div>
          <div class="j2k8-year">2026</div>
          <h3 class="j2k8-name">Penguatan Ekosistem</h3>
          <p class="j2k8-desc">Pengembangan program keahlian, fasilitas, dan kemitraan industri.</p>
        </div>
      </div>

      <!-- 05 | 2028 | Destination (right) -->
      <div class="j2k8-milestone j2k8-goal">
        <div class="j2k8-checkpoint" style="left:86%;top:20%" tabindex="0" role="button" aria-label="2028, target sekolah vokasi rujukan nasional">
          <div class="j2k8-node"><i class="fas fa-star"></i></div>
          <span class="j2k8-cp-year">2028</span>
          <span class="j2k8-cp-tag">Target</span>
        </div>
        <span class="j2k8-connector v" style="left:86%;top:22.7%;height:95px"></span>
        <div class="j2k8-card j2k8-goal-card" style="left:70%;top:29%">
          <div class="j2k8-card-top">
            <span class="j2k8-num">05</span>
            <span class="j2k8-status s-goal"><span class="j2k8-status-dot"></span> Target</span>
          </div>
          <div class="j2k8-year">2028</div>
          <h3 class="j2k8-name">Sekolah Vokasi Rujukan Nasional</h3>
          <p class="j2k8-desc">Target utama perjalanan transformasi SMK Negeri 2 Mojokerto.</p>
        </div>
      </div>
    </div>

    <div style="display:flex;justify-content:center;margin-top:4.5rem">
      <a href="school-roadmap.html" class="j2k8-cta">Jelajahi Perjalanan <i class="fas fa-arrow-right"></i></a>
    </div>
  </div>
</section>

<!-- ================= BERITA SECTION ================= -->
<section class="berita-section section-py" id="berita">
  <div class="container">
    <div class="section-header center" data-reveal>
      <div class="section-label">Informasi Terkini</div>
      <h2 class="section-title">Berita &amp; <span class="gold">Artikel</span></h2>
      <p class="section-desc">Ikuti cerita dan perkembangan terbaru SMKN 2 Mojokerto — prestasi, akademik, dan kegiatan.</p>
    </div>

    <div class="berita-tabs" data-reveal role="tablist" aria-label="Filter berita">
      <button class="berita-tab active" data-cat="all">Semua</button>
      <button class="berita-tab" data-cat="Prestasi">Prestasi</button>
      <button class="berita-tab" data-cat="Akademik">Akademik</button>
      <button class="berita-tab" data-cat="Kegiatan">Kegiatan</button>
    </div>

    <div class="berita-mag">
      <div class="berita-featured" data-reveal="left" data-cat="Prestasi">
        <img class="berita-featured-img" src="{{ asset('images/berita-lks.png') }}" alt="Siswa RPL SMKN 2 Mojokerto meraih juara 1 LKS Jawa Timur" loading="lazy">
        <div class="berita-featured-overlay"></div>
        <div class="berita-featured-body">
          <div class="berita-featured-cat"><i class="fas fa-trophy"></i> Prestasi</div>
          <h3 class="berita-featured-title">Siswa RPL SMKN 2 Mojokerto Raih Juara 1 LKS Provinsi Jawa Timur 2024</h3>
          <p class="berita-featured-desc">Tim siswa jurusan Rekayasa Perangkat Lunak berhasil meraih juara pertama dalam Lomba Kompetensi Siswa (LKS) tingkat Provinsi Jawa Timur kategori Web Technologies, mengalahkan 38 sekolah peserta dari seluruh Jawa Timur.</p>
          <div class="berita-meta">
            <span><i class="fas fa-calendar"></i> 15 Mei 2025</span>
            <span><i class="fas fa-clock"></i> 4 menit baca</span>
            <span><i class="fas fa-eye"></i> 1.2K views</span>
          </div>
          <a href="#" class="berita-read">Baca selengkapnya <i class="fas fa-arrow-right"></i></a>
        </div>
      </div>

      <div class="berita-feed" data-reveal="right">
        <div class="berita-feed-item" data-cat="Akademik">
          <img class="berita-feed-thumb" src="{{ asset('images/berita-ppdb.png') }}" alt="PPDB 2025/2026 resmi dibuka" loading="lazy">
          <div>
            <div class="berita-feed-cat">Akademik</div>
            <div class="berita-feed-title">PPDB 2025/2026 Resmi Dibuka, Kuota Terbatas</div>
            <div class="berita-feed-date"><i class="fas fa-calendar"></i> 1 Juni 2025</div>
          </div>
          <i class="fas fa-arrow-right berita-feed-arrow"></i>
        </div>
        <div class="berita-feed-item" data-cat="Kemitraan">
          <img class="berita-feed-thumb" src="{{ asset('images/berita-mou.png') }}" alt="Penandatanganan MoU dengan 5 perusahaan teknologi" loading="lazy">
          <div>
            <div class="berita-feed-cat">Kemitraan</div>
            <div class="berita-feed-title">MoU dengan 5 Perusahaan Teknologi Nasional Ditandatangani</div>
            <div class="berita-feed-date"><i class="fas fa-calendar"></i> 28 Mei 2025</div>
          </div>
          <i class="fas fa-arrow-right berita-feed-arrow"></i>
        </div>
        <div class="berita-feed-item" data-cat="Kegiatan">
          <img class="berita-feed-thumb" src="{{ asset('images/berita-kuliner.png') }}" alt="Festival kuliner siswa SMKN 2 Mojokerto" loading="lazy">
          <div>
            <div class="berita-feed-cat">Kegiatan</div>
            <div class="berita-feed-title">Festival Kuliner Siswa SMKN 2 Mojokerto Sukses Digelar</div>
            <div class="berita-feed-date"><i class="fas fa-calendar"></i> 10 Mei 2025</div>
          </div>
          <i class="fas fa-arrow-right berita-feed-arrow"></i>
        </div>
        <div class="berita-feed-empty" id="feedEmpty">Belum ada berita pada kategori ini.</div>
      </div>
    </div>

    <div class="berita-more" data-reveal>
      <div class="berita-more-head">
        <span class="berita-more-title">Jelajahi Berita Lainnya</span>
      </div>
      <div class="berita-more-grid">
        <div class="berita-card" data-cat="Kelulusan">
          <img class="berita-card-img" src="{{ asset('images/berita-kelulusan.png') }}" alt="100% siswa kelas XII dinyatakan lulus" loading="lazy">
          <div class="berita-card-body">
            <div class="berita-card-cat">Kelulusan</div>
            <h4 class="berita-card-title">100% Siswa Kelas XII Dinyatakan Lulus Ujian Nasional</h4>
            <div class="berita-card-meta"><i class="fas fa-calendar"></i> 20 Mei 2025</div>
          </div>
        </div>
        <div class="berita-card" data-cat="Prestasi">
          <img class="berita-card-img" src="{{ asset('images/berita-robotik.png') }}" alt="Tim robotik SMKN 2 Mojokerto menembus final nasional" loading="lazy">
          <div class="berita-card-body">
            <div class="berita-card-cat">Prestasi</div>
            <h4 class="berita-card-title">Tim Robotik SMKN 2 Mojokerto Tembus Final Nasional KRCI 2025</h4>
            <div class="berita-card-meta"><i class="fas fa-calendar"></i> 8 Mei 2025</div>
          </div>
        </div>
        <div class="berita-card" data-cat="Kegiatan">
          <img class="berita-card-img" src="{{ asset('images/berita-adiwiyata.png') }}" alt="SMKN 2 Mojokerto raih penghargaan Adiwiyata" loading="lazy">
          <div class="berita-card-body">
            <div class="berita-card-cat">Kegiatan</div>
            <h4 class="berita-card-title">SMKN 2 Mojokerto Raih Penghargaan Sekolah Adiwiyata Tingkat Kota</h4>
            <div class="berita-card-meta"><i class="fas fa-calendar"></i> 2 Mei 2025</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ================= PPDB SECTION ================= -->
<section class="ppdb-section section-py" id="ppdb">
  <div class="ppdb-bg" aria-hidden="true"></div>
  <div class="ppdb-pattern" aria-hidden="true"></div>
  <div class="ppdb-inner container">
    <div class="ppdb-head section-header center" data-reveal>
      <div class="section-label">Penerimaan Siswa Baru</div>
      <h2 class="section-title">PPDB <span class="gold">2025/2026</span></h2>
      <p class="section-desc">Langkah pertamamu menuju masa depan dimulai di sini.</p>
      <div class="ppdb-status-badge ppdb-status-closed"><span class="ppdb-status-dot"></span> Pendaftaran telah ditutup</div>
      <div class="ppdb-head-actions">
        <a href="#" class="btn btn-primary"><i class="fas fa-rocket"></i> Daftar Sekarang</a>
        <a href="#" class="btn btn-outline-white"><i class="fas fa-download"></i> Unduh Brosur</a>
      </div>
      <div class="ppdb-countdown" id="countdown">
        <div class="countdown-item"><div class="countdown-num" id="cd-hari">00</div><div class="countdown-label">Hari</div></div>
        <div class="countdown-item"><div class="countdown-num" id="cd-jam">00</div><div class="countdown-label">Jam</div></div>
        <div class="countdown-item"><div class="countdown-num" id="cd-menit">00</div><div class="countdown-label">Menit</div></div>
        <div class="countdown-item"><div class="countdown-num" id="cd-detik">00</div><div class="countdown-label">Detik</div></div>
      </div>
    </div>

    <div class="ppdb-journey" data-reveal>
      <div class="journey-start"><span class="journey-start-dot"></span> Start Here</div>
      <div class="journey-line" aria-hidden="true"></div>
      <div class="journey-step status-done">
        <div class="journey-node">01</div>
        <div class="journey-content">
          <div class="journey-step-top"><span class="journey-status status-green">&#10003; Selesai</span></div>
          <div class="journey-step-title">Registrasi Online</div>
          <div class="journey-step-desc">Buat akun dan isi formulir pendaftaran</div>
        </div>
      </div>
      <div class="journey-step status-done">
        <div class="journey-node">02</div>
        <div class="journey-content">
          <div class="journey-step-top"><span class="journey-status status-green">&#10003; Selesai</span></div>
          <div class="journey-step-title">Upload Dokumen</div>
          <div class="journey-step-desc">Lengkapi dokumen pendaftaran secara online</div>
        </div>
      </div>
      <div class="journey-step status-next">
        <div class="journey-node">03</div>
        <div class="journey-content">
          <div class="journey-step-top"><span class="journey-status status-blue">&#9679; Tahap Berikutnya</span></div>
          <div class="journey-step-title">Seleksi &amp; Tes</div>
          <div class="journey-step-desc">Ikuti proses seleksi akademik dan minat bakat</div>
        </div>
      </div>
      <div class="journey-step status-wait">
        <div class="journey-node">04</div>
        <div class="journey-content">
          <div class="journey-step-top"><span class="journey-status status-orange">&#9675; Menunggu</span></div>
          <div class="journey-step-title">Pengumuman</div>
          <div class="journey-step-desc">Cek hasil seleksi dan lakukan daftar ulang</div>
        </div>
      </div>
      <div class="journey-welcome">&#127891; Welcome to SMKN 2 Mojokerto</div>
    </div>
  </div>
</section>

<!-- ================= GALERI SECTION ================= -->
<section class="galeri-section section-py" id="galeri">
  <div class="container">
    <div class="section-header center" data-reveal>
      <div class="section-label">Dokumentasi Kegiatan</div>
      <h2 class="section-title">Galeri <span class="accent">Kegiatan</span></h2>
      <p class="section-desc">Setiap momen punya cerita — diabadikan, dikenang, dan dibagikan.</p>
    </div>
    <div class="galeri-filters" data-reveal>
      <button type="button" class="galeri-pill active" data-cat="all">Semua</button>
      <button type="button" class="galeri-pill" data-cat="akademik">Akademik</button>
      <button type="button" class="galeri-pill" data-cat="prestasi">Prestasi</button>
      <button type="button" class="galeri-pill" data-cat="kegiatan">Kegiatan</button>
      <button type="button" class="galeri-pill" data-cat="ekskul">Ekskul</button>
    </div>
    <div class="galeri-stage" data-reveal>
      <div class="galeri-ghost" aria-hidden="true">GALERI</div>
      <div class="galeri-masonry">
        <article class="gcard gcard-1" data-cat="prestasi" data-gallery="gal-1" data-rot="-1" tabindex="0">
          <div class="gcard-photo"><img src="{{ asset('images/berita-robotik.png') }}" alt="Lomba Robotik KRCI"><span class="gcard-num">01</span></div>
          <div class="gcard-info">
            <span class="gcard-badge prestasi">Prestasi</span>
            <h3 class="gcard-title">LOMBA ROBOTIK KRCI</h3>
            <p class="gcard-desc">Kompetisi inovasi dan teknologi siswa</p>
            <div class="gcard-meta"><i class="far fa-calendar-alt"></i> 3 Maret 2025</div>
            <span class="gcard-cta">Lihat Album <i class="fas fa-arrow-right"></i></span>
          </div>
        </article>
        <article class="gcard gcard-2" data-cat="kegiatan" data-gallery="gal-2" data-rot="1" tabindex="0">
          <div class="gcard-photo"><img src="{{ asset('images/kuliner.png') }}" alt="Festival Kuliner Siswa"><span class="gcard-num">02</span></div>
          <div class="gcard-info">
            <span class="gcard-badge kegiatan">Kegiatan</span>
            <h3 class="gcard-title">FESTIVAL KULINER</h3>
            <p class="gcard-desc">Kreasi rasa khas siswa tata boga</p>
            <div class="gcard-meta"><i class="far fa-calendar-alt"></i> 22 Februari 2025</div>
            <span class="gcard-cta">Lihat Album <i class="fas fa-arrow-right"></i></span>
          </div>
        </article>
        <article class="gcard gcard-3" data-cat="akademik" data-gallery="gal-3" data-rot="-0.5" tabindex="0">
          <div class="gcard-photo"><img src="{{ asset('images/berita-kelulusan.png') }}" alt="Wisuda dan Pelepasan Siswa"><span class="gcard-num">03</span></div>
          <div class="gcard-info">
            <span class="gcard-badge akademik">Akademik</span>
            <h3 class="gcard-title">WISUDA &amp; PELEPASAN</h3>
            <p class="gcard-desc">Melepas lulusan terbaik angkatan 2025</p>
            <div class="gcard-meta"><i class="far fa-calendar-alt"></i> 10 Juni 2025</div>
            <span class="gcard-cta">Lihat Album <i class="fas fa-arrow-right"></i></span>
          </div>
        </article>
        <article class="gcard gcard-4" data-cat="ekskul" data-gallery="gal-4" data-rot="1" tabindex="0">
          <div class="gcard-photo"><img src="{{ asset('images/berita-adiwiyata.png') }}" alt="Penghijauan Adiwiyata"><span class="gcard-num">04</span></div>
          <div class="gcard-info">
            <span class="gcard-badge ekskul">Ekskul</span>
            <h3 class="gcard-title">PENGHIJAUAN ADIWIYATA</h3>
            <p class="gcard-desc">Sekolah hijau, peduli lingkungan</p>
            <div class="gcard-meta"><i class="far fa-calendar-alt"></i> 20 Januari 2025</div>
            <span class="gcard-cta">Lihat Album <i class="fas fa-arrow-right"></i></span>
          </div>
        </article>
        <article class="gcard gcard-5" data-cat="kegiatan" data-gallery="gal-5" data-rot="-0.5" tabindex="0">
          <div class="gcard-photo"><img src="{{ asset('images/smkn-guru.jpg') }}" alt="Class Meeting 2025"><span class="gcard-num">05</span></div>
          <div class="gcard-info">
            <span class="gcard-badge kegiatan">Kegiatan</span>
            <h3 class="gcard-title">CLASS MEETING 2025</h3>
            <p class="gcard-desc">Semarak kompetisi dan kebersamaan antar kelas</p>
            <div class="gcard-meta"><i class="far fa-calendar-alt"></i> 12 Desember 2024</div>
            <span class="gcard-cta">Lihat Album <i class="fas fa-arrow-right"></i></span>
          </div>
        </article>
        <div class="galeri-note" aria-hidden="true">
          <i class="fas fa-quote-left"></i>
          <p>Ini bukan sekadar galeri.<br>Ini kumpulan <strong>kenangan siswa</strong>.</p>
        </div>
      </div>
    </div>
    <div class="galeri-footer" data-reveal>
      <div class="galeri-divider"></div>
      <p class="galeri-footer-text">Masih banyak cerita dari sekolah kami.</p>
      <button type="button" class="galeri-btn">Lihat Semua Foto <i class="fas fa-arrow-right"></i></button>
    </div>
  </div>
</section>

<!-- ================= LIGHTBOX GALERI ================= -->
<div class="galeri-lightbox" id="galeriLightbox" aria-hidden="true" role="dialog" aria-label="Galeri foto sekolah">
  <button type="button" class="lb-close" aria-label="Tutup"><i class="fas fa-times"></i></button>
  <button type="button" class="lb-nav lb-prev" aria-label="Sebelumnya"><i class="fas fa-chevron-left"></i></button>
  <figure class="lb-stage">
    <img class="lb-img" src="" alt="">
    <figcaption class="lb-cap">
      <span class="lb-cat"></span>
      <span class="lb-title"></span>
      <span class="lb-date"><i class="far fa-calendar-alt"></i> <span class="lb-date-txt"></span></span>
    </figcaption>
  </figure>
  <button type="button" class="lb-nav lb-next" aria-label="Berikutnya"><i class="fas fa-chevron-right"></i></button>
  <div class="lb-dots"></div>
</div>

<!-- ================= EKSKUL: ACTIVITY HUB ================= -->
<section class="ekskul-section section-py" id="ekskul">
  <div class="container">
    <div class="section-header center" data-reveal>
      <div class="section-label" style="text-transform:uppercase;letter-spacing:.22em">Kehidupan Siswa</div>
      <h2 class="section-title">Ekstrakurikuler &amp; <span class="gold">Organisasi</span></h2>
      <p class="section-desc">Berkarya, berprestasi, dan berkembang bersama komunitas sekolah.</p>
    </div>

    <!-- EKSTRAKURIKULER FEED -->
    <div class="feed-label" data-reveal>Ekstrakurikuler</div>
    <p class="feed-sub">Apa yang bisa kamu lakukan di luar kelas?</p>
    <div class="feed-wrap">
      <div class="feed-grid" id="feedEkskul">

        <!-- 01 Basket -->
        <article class="feed-card" tabindex="0" role="button" aria-label="Kartu Basket. Klik untuk membalik kartu.">
          <div class="feed-inner">
            <div class="feed-face feed-front">
              <div class="feed-post-head">
                <img class="feed-avatar" src="{{ asset('images/logo_smkn2.png') }}" alt="SMKN 2 Mojokerto">
                <div><div class="feed-school">skaneda</div><div class="feed-sub2">SMKN 2 Mojokerto</div></div>
                <i class="fa-solid fa-ellipsis-vertical feed-menu" aria-hidden="true"></i>
              </div>
              <div class="feed-photo"><img src="{{ asset('images/ekskul/basket.jpeg') }}" alt="Basket SMKN 2 Mojokerto" loading="lazy"></div>
              <div class="feed-actions">
                <i class="fa-regular fa-heart feed-ic heart" aria-hidden="true"></i><i class="fa-regular fa-comment feed-ic" aria-hidden="true"></i><i class="fa-regular fa-paper-plane feed-ic share" aria-hidden="true"></i>
                <i class="fa-regular fa-bookmark feed-ic save" aria-hidden="true"></i>
              </div>
              <div class="feed-likes">Disukai oleh <b>skaneda</b> dan 128 lainnya</div>
              <div class="feed-caption">
                <b>skaneda</b> <span class="fc-line">Basket — Latihan basket membangun kerja sama tim, sportivitas, dan teknik dasar. Satu bola, satu tim, satu tujuan.</span>
                <span class="feed-tags">#Basket #SMKN2Mojokerto #Ekstrakurikuler</span>
              </div>
              <div class="feed-comments">Lihat semua komentar (12)</div>
              <div class="feed-time">2 JAM YANG LALU</div>
            </div>
            <div class="feed-face feed-back">
              <div class="feed-back-top"><i class="fa-solid fa-arrow-left b-arrow" aria-hidden="true"></i><span class="b-name">Basket</span><span class="b-num">01</span></div>
              <img class="feed-back-avatar" src="{{ asset('images/logo_smkn2.png') }}" alt="Basket">
              <div class="feed-tagline">Teamwork &amp; Sport</div>
              <div class="divider"></div>
              <h5>Tentang</h5>
              <p class="feed-about">Latihan basket rutin membangun kerja sama tim, sportivitas, dan penguasaan teknik dasar. Anggota aktif mengikuti turnamen antar sekolah.</p>
              <div class="feed-stats">
                <div class="feed-stat"><b>18</b><span>Anggota</span></div>
                <div class="feed-stat"><b>3</b><span>Prestasi</span></div>
                <div class="feed-stat"><b>9</b><span>Kegiatan</span></div>
              </div>
              <h5>Aktivitas</h5>
              <ul class="feed-act">
                <li>Latihan rutin Rabu 15.30</li>
                <li>Turnamen antar SMK</li>
                <li>Sparring &amp; uji tanding</li>
              </ul>
              
            </div>
          </div>
        </article>

        <!-- 02 Futsal -->
        <article class="feed-card" tabindex="0" role="button" aria-label="Kartu Futsal. Klik untuk membalik kartu.">
          <div class="feed-inner">
            <div class="feed-face feed-front">
              <div class="feed-post-head">
                <img class="feed-avatar" src="{{ asset('images/logo_smkn2.png') }}" alt="SMKN 2 Mojokerto">
                <div><div class="feed-school">skaneda</div><div class="feed-sub2">SMKN 2 Mojokerto</div></div>
                <i class="fa-solid fa-ellipsis-vertical feed-menu" aria-hidden="true"></i>
              </div>
              <div class="feed-photo"><img src="{{ asset('images/ekskul/futsal.jpeg') }}" alt="Futsal SMKN 2 Mojokerto" loading="lazy"></div>
              <div class="feed-actions">
                <i class="fa-regular fa-heart feed-ic heart" aria-hidden="true"></i><i class="fa-regular fa-comment feed-ic" aria-hidden="true"></i><i class="fa-regular fa-paper-plane feed-ic share" aria-hidden="true"></i>
                <i class="fa-regular fa-bookmark feed-ic save" aria-hidden="true"></i>
              </div>
              <div class="feed-likes">Disukai oleh <b>skaneda</b> dan 96 lainnya</div>
              <div class="feed-caption">
                <b>skaneda</b> <span class="fc-line">Futsal — Cepat, lincah, dan kompak. Futsal melatih refleks, strategi, dan kekompakan tim di lapangan.</span>
                <span class="feed-tags">#Futsal #SMKN2Mojokerto #Ekstrakurikuler</span>
              </div>
              <div class="feed-comments">Lihat semua komentar (9)</div>
              <div class="feed-time">3 JAM YANG LALU</div>
            </div>
            <div class="feed-face feed-back">
              <div class="feed-back-top"><i class="fa-solid fa-arrow-left b-arrow" aria-hidden="true"></i><span class="b-name">Futsal</span><span class="b-num">02</span></div>
              <img class="feed-back-avatar" src="{{ asset('images/logo_smkn2.png') }}" alt="Futsal">
              <div class="feed-tagline">Speed &amp; Teamwork</div>
              <div class="divider"></div>
              <h5>Tentang</h5>
              <p class="feed-about">Futsal melatih kelincahan, kontrol bola, dan kerja sama tim. Rutin menggelar latihan dan turnamen internal antar kelas.</p>
              <div class="feed-stats">
                <div class="feed-stat"><b>22</b><span>Anggota</span></div>
                <div class="feed-stat"><b>2</b><span>Prestasi</span></div>
                <div class="feed-stat"><b>8</b><span>Kegiatan</span></div>
              </div>
              <h5>Aktivitas</h5>
              <ul class="feed-act">
                <li>Latihan rutin Senin &amp; Kamis</li>
                <li>Turnamen futsal pelajar</li>
                <li>Uji tanding antar sekolah</li>
              </ul>
              
            </div>
          </div>
        </article>

        <!-- 03 Bola Voli -->
        <article class="feed-card" tabindex="0" role="button" aria-label="Kartu Bola Voli. Klik untuk membalik kartu.">
          <div class="feed-inner">
            <div class="feed-face feed-front">
              <div class="feed-post-head">
                <img class="feed-avatar" src="{{ asset('images/logo_smkn2.png') }}" alt="SMKN 2 Mojokerto">
                <div><div class="feed-school">skaneda</div><div class="feed-sub2">SMKN 2 Mojokerto</div></div>
                <i class="fa-solid fa-ellipsis-vertical feed-menu" aria-hidden="true"></i>
              </div>
              <div class="feed-photo"><img src="{{ asset('images/ekskul/voli.jpeg') }}" alt="Bola Voli SMKN 2 Mojokerto" loading="lazy"></div>
              <div class="feed-actions">
                <i class="fa-regular fa-heart feed-ic heart" aria-hidden="true"></i><i class="fa-regular fa-comment feed-ic" aria-hidden="true"></i><i class="fa-regular fa-paper-plane feed-ic share" aria-hidden="true"></i>
                <i class="fa-regular fa-bookmark feed-ic save" aria-hidden="true"></i>
              </div>
              <div class="feed-likes">Disukai oleh <b>skaneda</b> dan 84 lainnya</div>
              <div class="feed-caption">
                <b>skaneda</b> <span class="fc-line">Bola Voli — Smash, blok, dan servis. Bola voli mengajarkan koordinasi dan semangat juang satu tim.</span>
                <span class="feed-tags">#BolaVoli #SMKN2Mojokerto #Ekstrakurikuler</span>
              </div>
              <div class="feed-comments">Lihat semua komentar (7)</div>
              <div class="feed-time">5 JAM YANG LALU</div>
            </div>
            <div class="feed-face feed-back">
              <div class="feed-back-top"><i class="fa-solid fa-arrow-left b-arrow" aria-hidden="true"></i><span class="b-name">Bola Voli</span><span class="b-num">03</span></div>
              <img class="feed-back-avatar" src="{{ asset('images/logo_smkn2.png') }}" alt="Bola Voli">
              <div class="feed-tagline">Coordination &amp; Spirit</div>
              <div class="divider"></div>
              <h5>Tentang</h5>
              <p class="feed-about">Latihan teknik dasar voli: passing, servis, smash, dan blok. Membangun kekompakan dan sportivitas antar anggota.</p>
              <div class="feed-stats">
                <div class="feed-stat"><b>20</b><span>Anggota</span></div>
                <div class="feed-stat"><b>2</b><span>Prestasi</span></div>
                <div class="feed-stat"><b>7</b><span>Kegiatan</span></div>
              </div>
              <h5>Aktivitas</h5>
              <ul class="feed-act">
                <li>Latihan rutin Selasa 16.00</li>
                <li>Kejuaraan voli pelajar</li>
                <li>Persahabatan antar sekolah</li>
              </ul>
              
            </div>
          </div>
        </article>

        <!-- 04 Pencak Silat -->
        <article class="feed-card feed-extra" tabindex="0" role="button" aria-label="Kartu Pencak Silat. Klik untuk membalik kartu.">
          <div class="feed-inner">
            <div class="feed-face feed-front">
              <div class="feed-post-head">
                <img class="feed-avatar" src="{{ asset('images/logo_smkn2.png') }}" alt="SMKN 2 Mojokerto">
                <div><div class="feed-school">skaneda</div><div class="feed-sub2">SMKN 2 Mojokerto</div></div>
                <i class="fa-solid fa-ellipsis-vertical feed-menu" aria-hidden="true"></i>
              </div>
              <div class="feed-photo"><img src="{{ asset('images/ekskul/silat.jpeg') }}" alt="Pencak Silat SMKN 2 Mojokerto" loading="lazy"></div>
              <div class="feed-actions">
                <i class="fa-regular fa-heart feed-ic heart" aria-hidden="true"></i><i class="fa-regular fa-comment feed-ic" aria-hidden="true"></i><i class="fa-regular fa-paper-plane feed-ic share" aria-hidden="true"></i>
                <i class="fa-regular fa-bookmark feed-ic save" aria-hidden="true"></i>
              </div>
              <div class="feed-likes">Disukai oleh <b>skaneda</b> dan 112 lainnya</div>
              <div class="feed-caption">
                <b>skaneda</b> <span class="fc-line">Pencak Silat — Disiplin diri, jaga budaya. Beladiri pencak silat membentuk karakter dan kebanggaan.</span>
                <span class="feed-tags">#PencakSilat #SMKN2Mojokerto #Ekstrakurikuler</span>
              </div>
              <div class="feed-comments">Lihat semua komentar (14)</div>
              <div class="feed-time">6 JAM YANG LALU</div>
            </div>
            <div class="feed-face feed-back">
              <div class="feed-back-top"><i class="fa-solid fa-arrow-left b-arrow" aria-hidden="true"></i><span class="b-name">Pencak Silat</span><span class="b-num">04</span></div>
              <img class="feed-back-avatar" src="{{ asset('images/logo_smkn2.png') }}" alt="Pencak Silat">
              <div class="feed-tagline">Martial Arts &amp; Discipline</div>
              <div class="divider"></div>
              <h5>Tentang</h5>
              <p class="feed-about">Beladiri, disiplin, dan pembentukan karakter lewat pencak silat. Anggota dilatih jurus, teknik, dan nilai-nilai luhur budaya.</p>
              <div class="feed-stats">
                <div class="feed-stat"><b>25</b><span>Anggota</span></div>
                <div class="feed-stat"><b>6</b><span>Prestasi</span></div>
                <div class="feed-stat"><b>10</b><span>Kegiatan</span></div>
              </div>
              <h5>Aktivitas</h5>
              <ul class="feed-act">
                <li>Latihan rutin Jumat 15.30</li>
                <li>Kejuaraan silat pelajar</li>
                <li>Latihan jurus &amp; teknik</li>
              </ul>
              
            </div>
          </div>
        </article>

        <!-- 05 Paskibra -->
        <article class="feed-card feed-extra" tabindex="0" role="button" aria-label="Kartu Paskibra. Klik untuk membalik kartu.">
          <div class="feed-inner">
            <div class="feed-face feed-front">
              <div class="feed-post-head">
                <img class="feed-avatar" src="{{ asset('images/logo_smkn2.png') }}" alt="SMKN 2 Mojokerto">
                <div><div class="feed-school">skaneda</div><div class="feed-sub2">SMKN 2 Mojokerto</div></div>
                <i class="fa-solid fa-ellipsis-vertical feed-menu" aria-hidden="true"></i>
              </div>
              <div class="feed-photo"><img src="{{ asset('images/ekskul/paskibra.jpeg') }}" alt="Paskibra SMKN 2 Mojokerto" loading="lazy"></div>
              <div class="feed-actions">
                <i class="fa-regular fa-heart feed-ic heart" aria-hidden="true"></i><i class="fa-regular fa-comment feed-ic" aria-hidden="true"></i><i class="fa-regular fa-paper-plane feed-ic share" aria-hidden="true"></i>
                <i class="fa-regular fa-bookmark feed-ic save" aria-hidden="true"></i>
              </div>
              <div class="feed-likes">Disukai oleh <b>skaneda</b> dan 140 lainnya</div>
              <div class="feed-caption">
                <b>skaneda</b> <span class="fc-line">Paskibra — Tegap melangkah, bangga mengibarkan. Disiplin baris-berbaris dan kebanggaan nasional.</span>
                <span class="feed-tags">#Paskibra #SMKN2Mojokerto #Disiplin</span>
              </div>
              <div class="feed-comments">Lihat semua komentar (18)</div>
              <div class="feed-time">8 JAM YANG LALU</div>
            </div>
            <div class="feed-face feed-back">
              <div class="feed-back-top"><i class="fa-solid fa-arrow-left b-arrow" aria-hidden="true"></i><span class="b-name">Paskibra</span><span class="b-num">05</span></div>
              <img class="feed-back-avatar" src="{{ asset('images/logo_smkn2.png') }}" alt="Paskibra">
              <div class="feed-tagline">Discipline &amp; Pride</div>
              <div class="divider"></div>
              <h5>Tentang</h5>
              <p class="feed-about">Latihan baris-berbaris dan pengibaran bendera upacara. Bertugas pada upacara bendera dan hari besar nasional.</p>
              <div class="feed-stats">
                <div class="feed-stat"><b>30</b><span>Anggota</span></div>
                <div class="feed-stat"><b>2</b><span>Prestasi</span></div>
                <div class="feed-stat"><b>9</b><span>Kegiatan</span></div>
              </div>
              <h5>Aktivitas</h5>
              <ul class="feed-act">
                <li>Upacara HUT RI</li>
                <li>Latihan PBB rutin</li>
                <li>Rekrutmen anggota baru</li>
              </ul>
              
            </div>
          </div>
        </article>

        <!-- 06 Pramuka -->
        <article class="feed-card feed-extra" tabindex="0" role="button" aria-label="Kartu Pramuka. Klik untuk membalik kartu.">
          <div class="feed-inner">
            <div class="feed-face feed-front">
              <div class="feed-post-head">
                <img class="feed-avatar" src="{{ asset('images/logo_smkn2.png') }}" alt="SMKN 2 Mojokerto">
                <div><div class="feed-school">skaneda</div><div class="feed-sub2">SMKN 2 Mojokerto</div></div>
                <i class="fa-solid fa-ellipsis-vertical feed-menu" aria-hidden="true"></i>
              </div>
              <div class="feed-photo"><img src="{{ asset('images/ekskul/pramuka.jpeg') }}" alt="Pramuka SMKN 2 Mojokerto" loading="lazy"></div>
              <div class="feed-actions">
                <i class="fa-regular fa-heart feed-ic heart" aria-hidden="true"></i><i class="fa-regular fa-comment feed-ic" aria-hidden="true"></i><i class="fa-regular fa-paper-plane feed-ic share" aria-hidden="true"></i>
                <i class="fa-regular fa-bookmark feed-ic save" aria-hidden="true"></i>
              </div>
              <div class="feed-likes">Disukai oleh <b>skaneda</b> dan 156 lainnya</div>
              <div class="feed-caption">
                <b>skaneda</b> <span class="fc-line">Pramuka — Siap jadi pribadi mandiri dan bermanfaat. Kepramukaan membentuk kemandirian, kepemimpinan, dan cinta alam.</span>
                <span class="feed-tags">#Pramuka #SMKN2Mojokerto #Kemandirian</span>
              </div>
              <div class="feed-comments">Lihat semua komentar (21)</div>
              <div class="feed-time">10 JAM YANG LALU</div>
            </div>
            <div class="feed-face feed-back">
              <div class="feed-back-top"><i class="fa-solid fa-arrow-left b-arrow" aria-hidden="true"></i><span class="b-name">Pramuka</span><span class="b-num">06</span></div>
              <img class="feed-back-avatar" src="{{ asset('images/logo_smkn2.png') }}" alt="Pramuka">
              <div class="feed-tagline">Leadership &amp; Outdoor</div>
              <div class="divider"></div>
              <h5>Tentang</h5>
              <p class="feed-about">Kepramukaan membentuk kemandirian, kepemimpinan, dan cinta alam. Kegiatan meliputi perkemahan, keterampilan, dan pengabdian masyarakat.</p>
              <div class="feed-stats">
                <div class="feed-stat"><b>35</b><span>Anggota</span></div>
                <div class="feed-stat"><b>5</b><span>Prestasi</span></div>
                <div class="feed-stat"><b>16</b><span>Kegiatan</span></div>
              </div>
              <h5>Aktivitas</h5>
              <ul class="feed-act">
                <li>Perkemahan &amp; lomba tingkat</li>
                <li>Latihan keterampilan kepramukaan</li>
                <li>Aksi bakti lingkungan</li>
              </ul>
              
            </div>
          </div>
        </article>

        <!-- 07 PMR -->
        <article class="feed-card feed-extra" tabindex="0" role="button" aria-label="Kartu PMR. Klik untuk membalik kartu.">
          <div class="feed-inner">
            <div class="feed-face feed-front">
              <div class="feed-post-head">
                <img class="feed-avatar" src="{{ asset('images/logo_smkn2.png') }}" alt="SMKN 2 Mojokerto">
                <div><div class="feed-school">skaneda</div><div class="feed-sub2">SMKN 2 Mojokerto</div></div>
                <i class="fa-solid fa-ellipsis-vertical feed-menu" aria-hidden="true"></i>
              </div>
              <div class="feed-photo"><img src="{{ asset('images/ekskul/pmr.jpeg') }}" alt="PMR SMKN 2 Mojokerto" loading="lazy"></div>
              <div class="feed-actions">
                <i class="fa-regular fa-heart feed-ic heart" aria-hidden="true"></i><i class="fa-regular fa-comment feed-ic" aria-hidden="true"></i><i class="fa-regular fa-paper-plane feed-ic share" aria-hidden="true"></i>
                <i class="fa-regular fa-bookmark feed-ic save" aria-hidden="true"></i>
              </div>
              <div class="feed-likes">Disukai oleh <b>skaneda</b> dan 132 lainnya</div>
              <div class="feed-caption">
                <b>skaneda</b> <span class="fc-line">PMR — Siaga menolong, berani berbagi. Palang Merah Remaja siap di setiap event sekolah.</span>
                <span class="feed-tags">#PMR #SMKN2Mojokerto #Sosial</span>
              </div>
              <div class="feed-comments">Lihat semua komentar (16)</div>
              <div class="feed-time">12 JAM YANG LALU</div>
            </div>
            <div class="feed-face feed-back">
              <div class="feed-back-top"><i class="fa-solid fa-arrow-left b-arrow" aria-hidden="true"></i><span class="b-name">PMR</span><span class="b-num">07</span></div>
              <img class="feed-back-avatar" src="{{ asset('images/logo_smkn2.png') }}" alt="PMR">
              <div class="feed-tagline">Health &amp; Humanity</div>
              <div class="divider"></div>
              <h5>Tentang</h5>
              <p class="feed-about">Palang Merah Remaja mengajarkan pertolongan pertama, kesehatan, dan aksi sosial kemanusiaan. Siap siaga di setiap event sekolah.</p>
              <div class="feed-stats">
                <div class="feed-stat"><b>28</b><span>Anggota</span></div>
                <div class="feed-stat"><b>4</b><span>Prestasi</span></div>
                <div class="feed-stat"><b>13</b><span>Kegiatan</span></div>
              </div>
              <h5>Aktivitas</h5>
              <ul class="feed-act">
                <li>P3K &amp; siaga event sekolah</li>
                <li>Aksi donor darah</li>
                <li>Pelatihan kesehatan remaja</li>
              </ul>
              
            </div>
          </div>
        </article>

        <!-- 08 Jurnalistik -->
        <article class="feed-card feed-extra" tabindex="0" role="button" aria-label="Kartu Jurnalistik. Klik untuk membalik kartu.">
          <div class="feed-inner">
            <div class="feed-face feed-front">
              <div class="feed-post-head">
                <img class="feed-avatar" src="{{ asset('images/logo_smkn2.png') }}" alt="SMKN 2 Mojokerto">
                <div><div class="feed-school">skaneda</div><div class="feed-sub2">SMKN 2 Mojokerto</div></div>
                <i class="fa-solid fa-ellipsis-vertical feed-menu" aria-hidden="true"></i>
              </div>
              <div class="feed-photo"><img src="{{ asset('images/ekskul/jurnalistik.jpeg') }}" alt="Jurnalistik SMKN 2 Mojokerto" loading="lazy"></div>
              <div class="feed-actions">
                <i class="fa-regular fa-heart feed-ic heart" aria-hidden="true"></i><i class="fa-regular fa-comment feed-ic" aria-hidden="true"></i><i class="fa-regular fa-paper-plane feed-ic share" aria-hidden="true"></i>
                <i class="fa-regular fa-bookmark feed-ic save" aria-hidden="true"></i>
              </div>
              <div class="feed-likes">Disukai oleh <b>skaneda</b> dan 78 lainnya</div>
              <div class="feed-caption">
                <b>skaneda</b> <span class="fc-line">Jurnalistik — Tulisan siswa, suara sekolah. Menulis berita, fotografi, dan media digital sekolah.</span>
                <span class="feed-tags">#Jurnalistik #SMKN2Mojokerto #MediaSekolah</span>
              </div>
              <div class="feed-comments">Lihat semua komentar (6)</div>
              <div class="feed-time">14 JAM YANG LALU</div>
            </div>
            <div class="feed-face feed-back">
              <div class="feed-back-top"><i class="fa-solid fa-arrow-left b-arrow" aria-hidden="true"></i><span class="b-name">Jurnalistik</span><span class="b-num">08</span></div>
              <img class="feed-back-avatar" src="{{ asset('images/logo_smkn2.png') }}" alt="Jurnalistik">
              <div class="feed-tagline">Writing &amp; Media</div>
              <div class="divider"></div>
              <h5>Tentang</h5>
              <p class="feed-about">Menulis berita, fotografi, dan pengelolaan media digital sekolah. Menjadi jembatan informasi warga sekolah.</p>
              <div class="feed-stats">
                <div class="feed-stat"><b>12</b><span>Anggota</span></div>
                <div class="feed-stat"><b>3</b><span>Prestasi</span></div>
                <div class="feed-stat"><b>8</b><span>Kegiatan</span></div>
              </div>
              <h5>Aktivitas</h5>
              <ul class="feed-act">
                <li>Liputan event sekolah</li>
                <li>Majalah sekolah tahunan</li>
                <li>Pelatihan fotografi</li>
              </ul>
              
            </div>
          </div>
        </article>

        <!-- 09 Banjari -->
        <article class="feed-card feed-extra" tabindex="0" role="button" aria-label="Kartu Banjari. Klik untuk membalik kartu.">
          <div class="feed-inner">
            <div class="feed-face feed-front">
              <div class="feed-post-head">
                <img class="feed-avatar" src="{{ asset('images/logo_smkn2.png') }}" alt="SMKN 2 Mojokerto">
                <div><div class="feed-school">skaneda</div><div class="feed-sub2">SMKN 2 Mojokerto</div></div>
                <i class="fa-solid fa-ellipsis-vertical feed-menu" aria-hidden="true"></i>
              </div>
              <div class="feed-photo"><img src="{{ asset('images/ekskul/banjari.jpeg') }}" alt="Banjari SMKN 2 Mojokerto" loading="lazy"></div>
              <div class="feed-actions">
                <i class="fa-regular fa-heart feed-ic heart" aria-hidden="true"></i><i class="fa-regular fa-comment feed-ic" aria-hidden="true"></i><i class="fa-regular fa-paper-plane feed-ic share" aria-hidden="true"></i>
                <i class="fa-regular fa-bookmark feed-ic save" aria-hidden="true"></i>
              </div>
              <div class="feed-likes">Disukai oleh <b>skaneda</b> dan 88 lainnya</div>
              <div class="feed-caption">
                <b>skaneda</b> <span class="fc-line">Banjari — Tabuhan rebana, syahdu di hati. Seni hadrah dan shalawat melatih kekompakan dan vokal.</span>
                <span class="feed-tags">#Banjari #SMKN2Mojokerto #Hadrah</span>
              </div>
              <div class="feed-comments">Lihat semua komentar (8)</div>
              <div class="feed-time">1 HARI YANG LALU</div>
            </div>
            <div class="feed-face feed-back">
              <div class="feed-back-top"><i class="fa-solid fa-arrow-left b-arrow" aria-hidden="true"></i><span class="b-name">Banjari</span><span class="b-num">09</span></div>
              <img class="feed-back-avatar" src="{{ asset('images/logo_smkn2.png') }}" alt="Banjari">
              <div class="feed-tagline">Hadrah &amp; Shalawat</div>
              <div class="divider"></div>
              <h5>Tentang</h5>
              <p class="feed-about">Seni hadrah dan shalawat dengan tabuhan rebana. Melatih kekompakan, vokal, dan penghayatan seni islami.</p>
              <div class="feed-stats">
                <div class="feed-stat"><b>22</b><span>Anggota</span></div>
                <div class="feed-stat"><b>2</b><span>Prestasi</span></div>
                <div class="feed-stat"><b>8</b><span>Kegiatan</span></div>
              </div>
              <h5>Aktivitas</h5>
              <ul class="feed-act">
                <li>Tampil di acara sekolah</li>
                <li>Latihan vokal &amp; rebana</li>
                <li>Tampil di PHBI</li>
              </ul>
              
            </div>
          </div>
        </article>

        <!-- 10 PENA -->
        <article class="feed-card feed-extra" tabindex="0" role="button" aria-label="Kartu PENA. Klik untuk membalik kartu.">
          <div class="feed-inner">
            <div class="feed-face feed-front">
              <div class="feed-post-head">
                <img class="feed-avatar" src="{{ asset('images/logo_smkn2.png') }}" alt="SMKN 2 Mojokerto">
                <div><div class="feed-school">skaneda</div><div class="feed-sub2">SMKN 2 Mojokerto</div></div>
                <i class="fa-solid fa-ellipsis-vertical feed-menu" aria-hidden="true"></i>
              </div>
              <div class="feed-photo"><img src="{{ asset('images/ekskul/pena.jpeg') }}" alt="PENA SMKN 2 Mojokerto" loading="lazy"></div>
              <div class="feed-actions">
                <i class="fa-regular fa-heart feed-ic heart" aria-hidden="true"></i><i class="fa-regular fa-comment feed-ic" aria-hidden="true"></i><i class="fa-regular fa-paper-plane feed-ic share" aria-hidden="true"></i>
                <i class="fa-regular fa-bookmark feed-ic save" aria-hidden="true"></i>
              </div>
              <div class="feed-likes">Disukai oleh <b>skaneda</b> dan 105 lainnya</div>
              <div class="feed-caption">
                <b>skaneda</b> <span class="fc-line">PENA — Panggung tempat cerita kita hidup. Seni teater: akting, naskah, dan manajemen panggung.</span>
                <span class="feed-tags">#PENA #SMKN2Mojokerto #SeniPanggung</span>
              </div>
              <div class="feed-comments">Lihat semua komentar (11)</div>
              <div class="feed-time">1 HARI YANG LALU</div>
            </div>
            <div class="feed-face feed-back">
              <div class="feed-back-top"><i class="fa-solid fa-arrow-left b-arrow" aria-hidden="true"></i><span class="b-name">PENA</span><span class="b-num">10</span></div>
              <img class="feed-back-avatar" src="{{ asset('images/logo_smkn2.png') }}" alt="PENA">
              <div class="feed-tagline">Stage &amp; Expression</div>
              <div class="divider"></div>
              <h5>Tentang</h5>
              <p class="feed-about">Seni mini teater: akting, penulisan naskah, dan manajemen panggung. Rutin pentas di acara sekolah dan luar sekolah.</p>
              <div class="feed-stats">
                <div class="feed-stat"><b>20</b><span>Anggota</span></div>
                <div class="feed-stat"><b>4</b><span>Prestasi</span></div>
                <div class="feed-stat"><b>11</b><span>Kegiatan</span></div>
              </div>
              <h5>Aktivitas</h5>
              <ul class="feed-act">
                <li>Pentas seni tahunan</li>
                <li>Latihan akting &amp; improvisasi</li>
                <li>Workshop penulisan naskah</li>
              </ul>
              
            </div>
          </div>
        </article>

        <!-- 11 Tari -->
        <article class="feed-card feed-extra" tabindex="0" role="button" aria-label="Kartu Tari. Klik untuk membalik kartu.">
          <div class="feed-inner">
            <div class="feed-face feed-front">
              <div class="feed-post-head">
                <img class="feed-avatar" src="{{ asset('images/logo_smkn2.png') }}" alt="SMKN 2 Mojokerto">
                <div><div class="feed-school">skaneda</div><div class="feed-sub2">SMKN 2 Mojokerto</div></div>
                <i class="fa-solid fa-ellipsis-vertical feed-menu" aria-hidden="true"></i>
              </div>
              <div class="feed-photo"><img src="{{ asset('images/ekskul/tari.jpeg') }}" alt="Tari SMKN 2 Mojokerto" loading="lazy"></div>
              <div class="feed-actions">
                <i class="fa-regular fa-heart feed-ic heart" aria-hidden="true"></i><i class="fa-regular fa-comment feed-ic" aria-hidden="true"></i><i class="fa-regular fa-paper-plane feed-ic share" aria-hidden="true"></i>
                <i class="fa-regular fa-bookmark feed-ic save" aria-hidden="true"></i>
              </div>
              <div class="feed-likes">Disukai oleh <b>skaneda</b> dan 118 lainnya</div>
              <div class="feed-caption">
                <b>skaneda</b> <span class="fc-line">Tari — Gerak yang bercerita. Melestarikan tari tradisional dan modern lewat latihan rutin.</span>
                <span class="feed-tags">#Tari #SMKN2Mojokerto #SeniBudaya</span>
              </div>
              <div class="feed-comments">Lihat semua komentar (13)</div>
              <div class="feed-time">1 HARI YANG LALU</div>
            </div>
            <div class="feed-face feed-back">
              <div class="feed-back-top"><i class="fa-solid fa-arrow-left b-arrow" aria-hidden="true"></i><span class="b-name">Tari</span><span class="b-num">11</span></div>
              <img class="feed-back-avatar" src="{{ asset('images/logo_smkn2.png') }}" alt="Tari">
              <div class="feed-tagline">Culture &amp; Expression</div>
              <div class="divider"></div>
              <h5>Tentang</h5>
              <p class="feed-about">Melestarikan seni tari tradisional dan modern. Anggota tampil di pentas seni, penyambutan tamu, dan lomba tari.</p>
              <div class="feed-stats">
                <div class="feed-stat"><b>24</b><span>Anggota</span></div>
                <div class="feed-stat"><b>5</b><span>Prestasi</span></div>
                <div class="feed-stat"><b>12</b><span>Kegiatan</span></div>
              </div>
              <h5>Aktivitas</h5>
              <ul class="feed-act">
                <li>Pentas seni &amp; penyambutan tamu</li>
                <li>Latihan tari tradisional</li>
                <li>Lomba tari pelajar</li>
              </ul>
              
            </div>
          </div>
        </article>

        <!-- 12 BTQ -->
        <article class="feed-card feed-extra" tabindex="0" role="button" aria-label="Kartu BTQ. Klik untuk membalik kartu.">
          <div class="feed-inner">
            <div class="feed-face feed-front">
              <div class="feed-post-head">
                <img class="feed-avatar" src="{{ asset('images/logo_smkn2.png') }}" alt="SMKN 2 Mojokerto">
                <div><div class="feed-school">skaneda</div><div class="feed-sub2">SMKN 2 Mojokerto</div></div>
                <i class="fa-solid fa-ellipsis-vertical feed-menu" aria-hidden="true"></i>
              </div>
              <div class="feed-photo"><img src="{{ asset('images/ekskul/btq.jpeg') }}" alt="BTQ SMKN 2 Mojokerto" loading="lazy"></div>
              <div class="feed-actions">
                <i class="fa-regular fa-heart feed-ic heart" aria-hidden="true"></i><i class="fa-regular fa-comment feed-ic" aria-hidden="true"></i><i class="fa-regular fa-paper-plane feed-ic share" aria-hidden="true"></i>
                <i class="fa-regular fa-bookmark feed-ic save" aria-hidden="true"></i>
              </div>
              <div class="feed-likes">Disukai oleh <b>skaneda</b> dan 92 lainnya</div>
              <div class="feed-caption">
                <b>skaneda</b> <span class="fc-line">BTQ — Membaca, menulis, dan menghayati. Baca Tulis Qur'an membangun akhlak dan spiritualitas siswa.</span>
                <span class="feed-tags">#BTQ #SMKN2Mojokerto #Spiritual</span>
              </div>
              <div class="feed-comments">Lihat semua komentar (9)</div>
              <div class="feed-time">2 HARI YANG LALU</div>
            </div>
            <div class="feed-face feed-back">
              <div class="feed-back-top"><i class="fa-solid fa-arrow-left b-arrow" aria-hidden="true"></i><span class="b-name">BTQ</span><span class="b-num">12</span></div>
              <img class="feed-back-avatar" src="{{ asset('images/logo_smkn2.png') }}" alt="BTQ">
              <div class="feed-tagline">Spiritual &amp; Akhlak</div>
              <div class="divider"></div>
              <h5>Tentang</h5>
              <p class="feed-about">Baca Tulis Qur'an membangun akhlak dan spiritualitas siswa melalui pembelajaran membaca, menulis, dan memahami Al-Qur'an.</p>
              <div class="feed-stats">
                <div class="feed-stat"><b>26</b><span>Anggota</span></div>
                <div class="feed-stat"><b>3</b><span>Prestasi</span></div>
                <div class="feed-stat"><b>12</b><span>Kegiatan</span></div>
              </div>
              <h5>Aktivitas</h5>
              <ul class="feed-act">
                <li>Khataman tahunan</li>
                <li>Tahsin &amp; tahfidz</li>
                <li>Kajian mingguan</li>
              </ul>
              
            </div>
          </div>
        </article>

      </div>
      <div class="feed-toggle">
        <button type="button" class="feed-toggle-btn" id="ekskulToggle">Lihat Semua Ekstrakurikuler <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></button>
      </div>
    </div>
<!-- ORGANISASI FEED -->
    <div class="feed-sec-divider" data-reveal><span>Organisasi</span></div>
    <p class="feed-sub">Tempat belajar memimpin dan berkontribusi bersama.</p>
    <div class="feed-wrap">
      <div class="feed-grid" id="feedOrg">

        <!-- 01 Pasus -->
        <article class="feed-card" tabindex="0" role="button" aria-label="Kartu Pasus. Klik untuk membalik kartu.">
          <div class="feed-inner">
            <div class="feed-face feed-front">
              <div class="feed-post-head">
                <img class="feed-avatar" src="{{ asset('images/logo_smkn2.png') }}" alt="SMKN 2 Mojokerto">
                <div><div class="feed-school">skaneda</div><div class="feed-sub2">SMKN 2 Mojokerto</div></div>
                <i class="fa-solid fa-ellipsis-vertical feed-menu" aria-hidden="true"></i>
              </div>
              <div class="feed-photo"><img src="{{ asset('images/ekskul/pasus.jpeg') }}" alt="Pasus SMKN 2 Mojokerto" loading="lazy"></div>
              <div class="feed-actions">
                <i class="fa-regular fa-heart feed-ic heart" aria-hidden="true"></i><i class="fa-regular fa-comment feed-ic" aria-hidden="true"></i><i class="fa-regular fa-paper-plane feed-ic share" aria-hidden="true"></i>
                <i class="fa-regular fa-bookmark feed-ic save" aria-hidden="true"></i>
              </div>
              <div class="feed-likes">Disukai oleh <b>skaneda</b> dan 72 lainnya</div>
              <div class="feed-caption">
                <b>skaneda</b> <span class="fc-line">Pasus — Pasukan khusus upacara dan ketertiban siswa. Disiplin, sigap, dan bangga menjaga nama sekolah.</span>
                <span class="feed-tags">#Pasus #SMKN2Mojokerto #Organisasi</span>
              </div>
              <div class="feed-comments">Lihat semua komentar (5)</div>
              <div class="feed-time">2 JAM YANG LALU</div>
            </div>
            <div class="feed-face feed-back">
              <div class="feed-back-top"><i class="fa-solid fa-arrow-left b-arrow" aria-hidden="true"></i><span class="b-name">Pasus</span><span class="b-num">01</span></div>
              <img class="feed-back-avatar" src="{{ asset('images/logo_smkn2.png') }}" alt="Pasus">
              <div class="feed-tagline">Discipline &amp; Service</div>
              <div class="divider"></div>
              <h5>Tentang</h5>
              <p class="feed-about">Pasukan khusus bertugas mengatur upacara bendera dan menjaga ketertiban siswa. Melatih kedisiplinan, tanggung jawab, dan kesigapan.</p>
              <div class="feed-stats">
                <div class="feed-stat"><b>15</b><span>Anggota</span></div>
                <div class="feed-stat"><b>2</b><span>Prestasi</span></div>
                <div class="feed-stat"><b>6</b><span>Kegiatan</span></div>
              </div>
              <h5>Aktivitas</h5>
              <ul class="feed-act">
                <li>Pengaturan upacara bendera</li>
                <li>Latihan PBB &amp; protokoler</li>
                <li>Ketertiban event sekolah</li>
              </ul>
              
            </div>
          </div>
        </article>

        <!-- 02 OSIS -->
        <article class="feed-card" tabindex="0" role="button" aria-label="Kartu OSIS. Klik untuk membalik kartu.">
          <div class="feed-inner">
            <div class="feed-face feed-front">
              <div class="feed-post-head">
                <img class="feed-avatar" src="{{ asset('images/logo_smkn2.png') }}" alt="SMKN 2 Mojokerto">
                <div><div class="feed-school">skaneda</div><div class="feed-sub2">SMKN 2 Mojokerto</div></div>
                <i class="fa-solid fa-ellipsis-vertical feed-menu" aria-hidden="true"></i>
              </div>
              <div class="feed-photo"><img src="{{ asset('images/ekskul/osis.jpeg') }}" alt="OSIS SMKN 2 Mojokerto" loading="lazy"></div>
              <div class="feed-actions">
                <i class="fa-regular fa-heart feed-ic heart" aria-hidden="true"></i><i class="fa-regular fa-comment feed-ic" aria-hidden="true"></i><i class="fa-regular fa-paper-plane feed-ic share" aria-hidden="true"></i>
                <i class="fa-regular fa-bookmark feed-ic save" aria-hidden="true"></i>
              </div>
              <div class="feed-likes">Disukai oleh <b>skaneda</b> dan 180 lainnya</div>
              <div class="feed-caption">
                <b>skaneda</b> <span class="fc-line">OSIS — Ruang bagi siswa untuk belajar memimpin, berkolaborasi, dan mewujudkan kegiatan sekolah.</span>
                <span class="feed-tags">#OSIS #SMKN2Mojokerto #Leadership</span>
              </div>
              <div class="feed-comments">Lihat semua komentar (24)</div>
              <div class="feed-time">3 JAM YANG LALU</div>
            </div>
            <div class="feed-face feed-back">
              <div class="feed-back-top"><i class="fa-solid fa-arrow-left b-arrow" aria-hidden="true"></i><span class="b-name">OSIS</span><span class="b-num">02</span></div>
              <img class="feed-back-avatar" src="{{ asset('images/logo_smkn2.png') }}" alt="OSIS">
              <div class="feed-tagline">Student Council &amp; Leadership</div>
              <div class="divider"></div>
              <h5>Tentang</h5>
              <p class="feed-about">Organisasi induk siswa yang menaungi seluruh kegiatan siswa. Berperan dalam perencanaan event, aspirasi, dan pengembangan sekolah.</p>
              <div class="feed-stats">
                <div class="feed-stat"><b>40</b><span>Pengurus</span></div>
                <div class="feed-stat"><b>12</b><span>Program</span></div>
                <div class="feed-stat"><b>25</b><span>Kegiatan</span></div>
              </div>
              <h5>Aktivitas</h5>
              <ul class="feed-act">
                <li>Menyusun program kerja tahunan</li>
                <li>Menyelenggarakan event sekolah</li>
                <li>Menyalurkan aspirasi siswa</li>
              </ul>
              
            </div>
          </div>
        </article>

        <!-- 03 Lacurva -->
        <article class="feed-card" tabindex="0" role="button" aria-label="Kartu Lacurva. Klik untuk membalik kartu.">
          <div class="feed-inner">
            <div class="feed-face feed-front">
              <div class="feed-post-head">
                <img class="feed-avatar" src="{{ asset('images/logo_smkn2.png') }}" alt="SMKN 2 Mojokerto">
                <div><div class="feed-school">skaneda</div><div class="feed-sub2">SMKN 2 Mojokerto</div></div>
                <i class="fa-solid fa-ellipsis-vertical feed-menu" aria-hidden="true"></i>
              </div>
              <div class="feed-photo"><img src="{{ asset('images/ekskul/lacurva.jpeg') }}" alt="Lacurva SMKN 2 Mojokerto" loading="lazy"></div>
              <div class="feed-actions">
                <i class="fa-regular fa-heart feed-ic heart" aria-hidden="true"></i><i class="fa-regular fa-comment feed-ic" aria-hidden="true"></i><i class="fa-regular fa-paper-plane feed-ic share" aria-hidden="true"></i>
                <i class="fa-regular fa-bookmark feed-ic save" aria-hidden="true"></i>
              </div>
              <div class="feed-likes">Disukai oleh <b>skaneda</b> dan 64 lainnya</div>
              <div class="feed-caption">
                <b>skaneda</b> <span class="fc-line">Lacurva — Laskar Cinta Budaya: melestarikan seni, budaya, dan kreativitas siswa lewat karya.</span>
                <span class="feed-tags">#Lacurva #SMKN2Mojokerto #SeniBudaya</span>
              </div>
              <div class="feed-comments">Lihat semua komentar (4)</div>
              <div class="feed-time">5 JAM YANG LALU</div>
            </div>
            <div class="feed-face feed-back">
              <div class="feed-back-top"><i class="fa-solid fa-arrow-left b-arrow" aria-hidden="true"></i><span class="b-name">Lacurva</span><span class="b-num">03</span></div>
              <img class="feed-back-avatar" src="{{ asset('images/logo_smkn2.png') }}" alt="Lacurva">
              <div class="feed-tagline">Culture &amp; Creativity</div>
              <div class="divider"></div>
              <h5>Tentang</h5>
              <p class="feed-about">Laskar Cinta Budaya mewadahi kreativitas seni dan budaya siswa. Aktif dalam pentas, pameran, dan pelestarian budaya lokal.</p>
              <div class="feed-stats">
                <div class="feed-stat"><b>18</b><span>Anggota</span></div>
                <div class="feed-stat"><b>3</b><span>Prestasi</span></div>
                <div class="feed-stat"><b>9</b><span>Kegiatan</span></div>
              </div>
              <h5>Aktivitas</h5>
              <ul class="feed-act">
                <li>Pentas seni budaya</li>
                <li>Pameran karya siswa</li>
                <li>Kegiatan pelestarian budaya</li>
              </ul>
              
            </div>
          </div>
        </article>

        <!-- 04 PIK-R -->
        <article class="feed-card feed-extra" tabindex="0" role="button" aria-label="Kartu PIK-R. Klik untuk membalik kartu.">
          <div class="feed-inner">
            <div class="feed-face feed-front">
              <div class="feed-post-head">
                <img class="feed-avatar" src="{{ asset('images/logo_smkn2.png') }}" alt="SMKN 2 Mojokerto">
                <div><div class="feed-school">skaneda</div><div class="feed-sub2">SMKN 2 Mojokerto</div></div>
                <i class="fa-solid fa-ellipsis-vertical feed-menu" aria-hidden="true"></i>
              </div>
              <div class="feed-photo"><img src="{{ asset('images/ekskul/pik-r.jpeg') }}" alt="PIK-R SMKN 2 Mojokerto" loading="lazy"></div>
              <div class="feed-actions">
                <i class="fa-regular fa-heart feed-ic heart" aria-hidden="true"></i><i class="fa-regular fa-comment feed-ic" aria-hidden="true"></i><i class="fa-regular fa-paper-plane feed-ic share" aria-hidden="true"></i>
                <i class="fa-regular fa-bookmark feed-ic save" aria-hidden="true"></i>
              </div>
              <div class="feed-likes">Disukai oleh <b>skaneda</b> dan 58 lainnya</div>
              <div class="feed-caption">
                <b>skaneda</b> <span class="fc-line">PIK-R — Pusat Informasi dan Konseling Remaja. Teman cerita, informasi sehat, dan pendampingan sebaya.</span>
                <span class="feed-tags">#PIKR #SMKN2Mojokerto #RemajaSehat</span>
              </div>
              <div class="feed-comments">Lihat semua komentar (3)</div>
              <div class="feed-time">6 JAM YANG LALU</div>
            </div>
            <div class="feed-face feed-back">
              <div class="feed-back-top"><i class="fa-solid fa-arrow-left b-arrow" aria-hidden="true"></i><span class="b-name">PIK-R</span><span class="b-num">04</span></div>
              <img class="feed-back-avatar" src="{{ asset('images/logo_smkn2.png') }}" alt="PIK-R">
              <div class="feed-tagline">Peer Support &amp; Health</div>
              <div class="divider"></div>
              <h5>Tentang</h5>
              <p class="feed-about">Pusat Informasi dan Konseling Remaja memberikan edukasi kesehatan remaja, pendampingan sebaya, dan kegiatan positif bagi siswa.</p>
              <div class="feed-stats">
                <div class="feed-stat"><b>14</b><span>Anggota</span></div>
                <div class="feed-stat"><b>2</b><span>Prestasi</span></div>
                <div class="feed-stat"><b>7</b><span>Kegiatan</span></div>
              </div>
              <h5>Aktivitas</h5>
              <ul class="feed-act">
                <li>Edukasi kesehatan remaja</li>
                <li>Konseling sebaya</li>
                <li>Kampanye hidup sehat</li>
              </ul>
              
            </div>
          </div>
        </article>

      </div>
      <div class="feed-toggle">
        <button type="button" class="feed-toggle-btn" id="orgToggle">Lihat Semua Organisasi <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></button>
      </div>
    </div>
  </div>
</section><!-- ================= KONTAK & FOOTER ================= -->
<section class="kontak-section section-py" id="kontak" aria-label="Kontak dan lokasi sekolah">
  <div class="container">
    <div class="ft-wrap">
      <div class="ft-head" data-reveal>
        <div class="ft-eyebrow">Temukan Kami</div>
        <h2 class="ft-title">Temukan <span class="ft-gold">Kami</span></h2>
        <p class="ft-sub">Kami siap membantu Anda.</p>
        <p class="ft-line">Informasi sekolah, PPDB, dan program keahlian.</p>
      </div>
      <div class="ft-map" data-reveal>
        <div class="ft-pin" aria-hidden="true">
          <div class="ft-pin-badge"><img src="{{ asset('images/logo_smkn2.png') }}" alt="" /></div>
          <div class="ft-pin-ring"></div>
          <div class="ft-pin-ring r2"></div>
        </div>
        <iframe title="Lokasi SMK Negeri 2 Mojokerto" src="https://www.google.com/maps?q=Jl.%20Raya%20Pulorejo%2C%20Kel.%20Pulorejo%2C%20Kec.%20Prajurit%20Kulon%2C%20Kota%20Mojokerto%2C%20Jawa%20Timur%2061325&output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
        <div class="ft-card" data-reveal>
          <div class="ft-card-head">
            <div class="ft-card-logo"><img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SMKN 2 Mojokerto" /></div>
            <div class="ft-card-title">SMKN 2 MOJOKERTO<small>Kontak &amp; Informasi</small></div>
          </div>
          <div class="ft-card-div"></div>
          <div class="ft-row">
            <div class="ft-row-icon"><i class="fas fa-location-dot"></i></div>
            <div>
              <div class="ft-row-label">Alamat</div>
              <div class="ft-row-value">Jl. Raya Pulorejo, Kel. Pulorejo, Kec. Prajurit Kulon, Kota Mojokerto, Jawa Timur 61325</div>
            </div>
          </div>
          <div class="ft-row">
            <div class="ft-row-icon"><i class="fas fa-phone"></i></div>
            <div>
              <div class="ft-row-label">Telepon</div>
              <div class="ft-row-value"><a href="tel:031222929922">0312 2292 9922</a></div>
            </div>
          </div>
          <div class="ft-row">
            <div class="ft-row-icon"><i class="fas fa-envelope"></i></div>
            <div>
              <div class="ft-row-label">Email</div>
              <div class="ft-row-value"><a href="mailto:info@smkn2mojokerto.sch.id">info@smkn2mojokerto.sch.id</a></div>
            </div>
          </div>
          <div class="ft-row">
            <div class="ft-row-icon"><i class="fas fa-clock"></i></div>
            <div>
              <div class="ft-row-label">Jam Operasional</div>
              <div class="ft-row-value">Senin&ndash;Jumat &middot; 07.00&ndash;16.00 WIB</div>
            </div>
          </div>
          <hr class="ft-stub" />
          <a class="ft-map-btn" href="https://www.google.com/maps/search/?api=1&amp;query=Jalan+Raya+Pulorejo%2C+Kelurahan+Pulorejo%2C+Kecamatan+Prajurit+Kulon%2C+Kota+Mojokerto%2C+Jawa+Timur+61325" target="_blank" rel="noopener">
            Buka di Google Maps <i class="fa-solid fa-arrow-up-right-from-square"></i>
          </a>
        </div>
      </div>
      <div class="ft-cta" data-reveal>
        <p>Punya pertanyaan? Kami siap membantu memberikan informasi seputar sekolah dan PPDB.</p>
        <button type="button" class="ft-cta-btn" onclick="toggleSibot()">Hubungi Kami <i class="fa-solid fa-arrow-right"></i></button>
      </div>
    </div>
  </div>
</section>


@include('partials.footer')
