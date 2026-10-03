@extends('layouts.admin')

@section('title', 'Program Keahlian (Jurusan) — Admin')

@push('styles')
<style>
  .sh-tabs {
    display: flex;
    gap: .5rem;
    flex-wrap: wrap;
    margin-bottom: 1.5rem;
    border-bottom: 1px solid rgba(255,255,255,.09);
    padding-bottom: 1rem;
  }
  .sh-tab-btn {
    display: inline-flex;
    align-items: center;
    gap: .55rem;
    padding: .65rem 1.15rem;
    border-radius: 11px;
    border: 1px solid rgba(255,255,255,.1);
    background: rgba(255,255,255,.04);
    color: rgba(255,255,255,.7);
    font-size: .83rem;
    font-weight: 700;
    cursor: pointer;
    transition: all .2s ease;
  }
  .sh-tab-btn i { font-size: .85rem; opacity: .8; }
  .sh-tab-btn:hover {
    background: rgba(255,255,255,.09);
    color: #fff;
    border-color: rgba(255,255,255,.2);
  }
  .sh-tab-btn.active {
    background: linear-gradient(135deg, var(--gold-light, #ffd54a), var(--gold, #f9a825));
    color: var(--ink, #071b33);
    border-color: transparent;
    box-shadow: 0 8px 20px rgba(255,179,0,.25);
  }
  .sh-tab-btn.active i { opacity: 1; }
  .sh-tab-panel { display: none; animation: sh-fade .25s ease; }
  .sh-tab-panel.active { display: block; }
  @keyframes sh-fade { from { opacity: 0; transform: translateY(4px); } to { opacity: 1; transform: translateY(0); } }

  .sh-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1.1rem; }
  .sh-grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.1rem; }
  @media(max-width: 900px) { .sh-grid-2, .sh-grid-3 { grid-template-columns: 1fr; } }

  .sh-img-current { margin-top: .6rem; display: flex; align-items: center; gap: .8rem; }
  .sh-img-current img, .sh-img-current video { width: 80px; height: 60px; object-fit: cover; border-radius: 10px; border: 1px solid rgba(255,255,255,.14); }
  .sh-img-current span { font-size: .72rem; color: var(--text-muted); }

  .sh-save-bar {
    position: sticky;
    bottom: 14px;
    margin-top: 1.8rem;
    padding: 1.05rem 1.4rem;
    border-radius: 14px;
    background: rgba(12, 40, 70, 0.96);
    border: 1px solid rgba(255,255,255,.16);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    box-shadow: 0 -8px 28px rgba(0,0,0,.35);
    z-index: 100;
  }
  .sh-save-bar span { font-size: .8rem; color: rgba(255,255,255,.85); display: flex; align-items: center; gap: .5rem; font-weight: 600; }

  .major-code-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: .3rem .75rem;
    border-radius: 8px;
    font-weight: 800;
    font-size: .82rem;
    letter-spacing: .06em;
    background: rgba(255, 179, 0, 0.15);
    color: var(--gold-light);
    border: 1px solid rgba(255, 179, 0, 0.3);
  }
</style>
@endpush

@section('content')
  <!-- HEADER TITLE -->
  <div class="db-panel-head" style="margin-bottom:1.5rem">
    <div>
      <h2><i class="fas fa-graduation-cap" style="color:var(--gold);margin-right:.5rem"></i> Pengaturan Program Keahlian</h2>
      <p style="font-size:.8rem;color:var(--text-muted);margin-top:.25rem">Kelola seluruh konten, video profil, sambutan kakomli, kompetensi, fasilitas, dan karir per jurusan.</p>
    </div>
    <div class="db-panel-actions">
      <button class="db-btn db-btn-gold" onclick="openCreateMajorModal()"><i class="fas fa-plus"></i> Tambah Jurusan Baru</button>
    </div>
  </div>

  @if(session('success'))
    <div style="background:rgba(16,185,129,.15);border:1px solid rgba(16,185,129,.4);color:#10b981;padding:.85rem 1.2rem;border-radius:14px;margin-bottom:1.4rem;font-size:.85rem;display:flex;align-items:center;gap:.6rem">
      <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
  @endif

  @if(session('error'))
    <div style="background:rgba(239,68,68,.15);border:1px solid rgba(239,68,68,.4);color:#ef4444;padding:.85rem 1.2rem;border-radius:14px;margin-bottom:1.4rem;font-size:.85rem;display:flex;align-items:center;gap:.6rem">
      <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
    </div>
  @endif

  @if($errors->any())
    <div style="background:rgba(239,68,68,.15);border:1px solid rgba(239,68,68,.4);color:#ef4444;padding:.85rem 1.2rem;border-radius:14px;margin-bottom:1.4rem;font-size:.85rem">
      <ul style="margin:0;padding-left:1.2rem">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <!-- TAB NAVIGATION JURUSAN (TANPA DAFTAR JURUSAN OVERVIEW) -->
  <div class="sh-tabs">
    @foreach($items as $index => $item)
      <button type="button" class="sh-tab-btn {{ $loop->first ? 'active' : '' }}" data-tab="major-{{ $item->id }}">
        <i class="{{ $item->icon_url && !Str::startsWith($item->icon_url, 'images/') ? $item->icon_url : 'fas fa-graduation-cap' }}"></i> {{ $item->code }} — {{ $item->name }}
      </button>
    @endforeach
  </div>

  {{-- ================= TAB EDITOR UNTUK SETIAP JURUSAN ================= --}}
  @foreach($items as $index => $item)
    <div class="sh-tab-panel {{ $loop->first ? 'active' : '' }}" data-panel="major-{{ $item->id }}">
      <form action="{{ route('admin.majors.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- CARD 1: HERO BANNER & KICKER -->
        <div class="db-panel" style="margin-bottom:1.4rem">
          <div class="db-panel-head">
            <h2 style="font-size:.95rem"><i class="fas fa-house" style="color:var(--gold);margin-right:.5rem"></i> Section 1 — Hero Banner &amp; Identitas Jurusan ({{ $item->code }})</h2>
            <a href="{{ url('/keahlian/' . $item->slug) }}" target="_blank" style="font-size:.75rem;color:var(--gold-light);font-weight:700">
              <i class="fas fa-external-link-alt"></i> Lihat Tampilan Publik {{ $item->code }}
            </a>
          </div>

          <div class="sh-grid-2">
            <div class="db-form-group">
              <label>Kode Jurusan <span style="color:#ff7875">*</span></label>
              <input type="text" name="code" class="db-form-control" value="{{ old('code', $item->code) }}" required style="text-transform:uppercase;font-weight:800;letter-spacing:.05em">
            </div>
            <div class="db-form-group">
              <label>Nama Program Keahlian <span style="color:#ff7875">*</span></label>
              <input type="text" name="name" class="db-form-control" value="{{ old('name', $item->name) }}" required>
            </div>
          </div>

          <div class="sh-grid-2">
            <div class="db-form-group">
              <label>Slug URL Halaman Publik</label>
              <input type="text" name="slug" class="db-form-control" value="{{ old('slug', $item->slug) }}">
            </div>
            <div class="db-form-group">
              <label>Class Ikon FontAwesome (misal: fas fa-code)</label>
              <input type="text" name="icon_url" class="db-form-control" value="{{ old('icon_url', $item->icon_url) }}">
            </div>
          </div>

          <div class="db-form-group">
            <label>Subtitle / Tagline Halaman Hero</label>
            <input type="text" name="hero_subtitle" class="db-form-control" value="{{ old('hero_subtitle', $item->getDetail('hero_subtitle')) }}" placeholder="Contoh: LOGIKA → CODING → APLIKASI → INDUSTRI TEKNOLOGI">
          </div>

          <div class="db-form-group">
            <label>Upload Logo / Gambar Ikon Jurusan (Opsional)</label>
            <input type="file" name="image" accept="image/*" class="db-form-control">
            @if($item->icon_url && (Str::startsWith($item->icon_url, 'images/') || Str::startsWith($item->icon_url, 'http')))
              <div class="sh-img-current">
                <img src="{{ asset($item->icon_url) }}" alt="Logo {{ $item->code }}">
                <span>Logo saat ini — upload gambar baru untuk mengganti</span>
              </div>
            @endif
          </div>

          <div style="margin-top:1rem;display:flex;align-items:center;gap:.6rem;background:rgba(255,255,255,.03);padding:.8rem 1rem;border-radius:10px;border:1px solid rgba(255,255,255,.08)">
            <input type="checkbox" name="is_active" id="active_{{ $item->id }}" value="1" {{ $item->is_active ? 'checked' : '' }} style="width:18px;height:18px;accent-color:var(--gold);cursor:pointer">
            <label for="active_{{ $item->id }}" style="font-size:.82rem;color:#fff;font-weight:700;cursor:pointer">Aktifkan Halaman Jurusan di Website Publik</label>
          </div>
        </div>

        <!-- CARD 2: VIDEO PROFIL JURUSAN (FILE EXPLORER UPLOAD) -->
        <div class="db-panel" style="margin-bottom:1.4rem">
          <div class="db-panel-head">
            <h2 style="font-size:.95rem"><i class="fas fa-film" style="color:var(--gold);margin-right:.5rem"></i> Section 2 — Video Profil / Virtual Tour Jurusan</h2>
            <span style="font-size:.75rem;color:var(--text-muted)">Pilih video dari File Explorer atau masukkan URL</span>
          </div>

          <div class="sh-grid-2">
            <div class="db-form-group">
              <label>Judul Section Video</label>
              <input type="text" name="video_title" class="db-form-control" value="{{ old('video_title', $item->getDetail('video_title', 'MENGENAL LEBIH DEKAT ' . $item->code)) }}">
            </div>
            <div class="db-form-group">
              <label>Pilih File Video dari Komputer (File Explorer)</label>
              <input type="file" name="video_file" accept="video/mp4,video/webm,video/ogg" class="db-form-control">
            </div>
          </div>

          <div class="db-form-group">
            <label>Atau Input URL / Path Video (Opsional)</label>
            <input type="text" name="video_url" class="db-form-control" value="{{ old('video_url', $item->getDetail('video_url')) }}" placeholder="Contoh: images/videos/video-rpl.mp4">
            @if($item->getDetail('video_url'))
              <div class="sh-img-current">
                <video controls style="width:140px;height:80px;border-radius:10px">
                  <source src="{{ asset($item->getDetail('video_url')) }}">
                </video>
                <span>Video saat ini: <code>{{ $item->getDetail('video_url') }}</code></span>
              </div>
            @endif
          </div>

          <div class="db-form-group">
            <label>Deskripsi Penjelas Video Profil</label>
            <textarea name="video_desc" class="db-form-control" rows="2">{{ old('video_desc', $item->getDetail('video_desc', 'Kenali Program Keahlian ' . $item->name . ', mulai dari pembelajaran, praktik, fasilitas, hingga pengalaman yang akan kamu dapatkan.')) }}</textarea>
          </div>
        </div>

        <!-- CARD 3: TENTANG KEAHLIAN & SAMBUTAN KAKOMLI -->
        <div class="db-panel" style="margin-bottom:1.4rem">
          <div class="db-panel-head">
            <h2 style="font-size:.95rem"><i class="fas fa-user-tie" style="color:var(--gold);margin-right:.5rem"></i> Section 3 — Tentang Keahlian &amp; Sambutan Kakomli</h2>
          </div>

          <div class="db-form-group">
            <label>Paragraf Utama (Lead Profile)</label>
            <textarea name="about_lead" class="db-form-control" rows="2">{{ old('about_lead', $item->getDetail('about_lead', $item->description)) }}</textarea>
          </div>

          <div class="db-form-group">
            <label>Paragraf Penjelas (Sub Profile)</label>
            <textarea name="about_sub" class="db-form-control" rows="3">{{ old('about_sub', $item->getDetail('about_sub')) }}</textarea>
          </div>

          <div class="sh-grid-2">
            <div class="db-form-group">
              <label>Nama Lengkap Kepala Program Keahlian (Kakomli)</label>
              <input type="text" name="kakomli_name" class="db-form-control" value="{{ old('kakomli_name', $item->getDetail('kakomli_name')) }}" placeholder="Basukisna Setya Candra, S.Pd.">
            </div>
            <div class="db-form-group">
              <label>Jabatan Kakomli</label>
              <input type="text" name="kakomli_role" class="db-form-control" value="{{ old('kakomli_role', $item->getDetail('kakomli_role')) }}" placeholder="Kepala Program Keahlian {{ $item->code }}">
            </div>
          </div>

          <div class="db-form-group">
            <label>Motto / Kutipan Sambutan Kakomli</label>
            <textarea name="kakomli_quote" class="db-form-control" rows="2">{{ old('kakomli_quote', $item->getDetail('kakomli_quote')) }}</textarea>
          </div>
        </div>

        <!-- CARD 4: KOMPETENSI KEAHLIAN UTAMA -->
        <div class="db-panel" style="margin-bottom:1.4rem">
          <div class="db-panel-head">
            <h2 style="font-size:.95rem"><i class="fas fa-laptop-code" style="color:var(--gold);margin-right:.5rem"></i> Section 4 — Kompetensi Keahlian Utama</h2>
          </div>
          @php
            $comps = $item->getDetail('competencies', []);
          @endphp
          <div class="sh-grid-2">
            @for($c = 0; $c < 4; $c++)
              @php $comp = $comps[$c] ?? []; @endphp
              <div style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.08);padding:1.1rem;border-radius:14px">
                <strong style="font-size:.8rem;color:var(--gold-light);display:block;margin-bottom:.75rem"><i class="fas fa-check-circle"></i> Kompetensi {{ $c + 1 }}</strong>
                <div class="db-form-group" style="margin-bottom:.65rem">
                  <label style="font-size:.73rem">Ikon FontAwesome (misal: fa-code)</label>
                  <input type="text" name="competencies[{{ $c }}][icon]" class="db-form-control" value="{{ $comp['icon'] ?? 'fa-check-circle' }}">
                </div>
                <div class="db-form-group" style="margin-bottom:.65rem">
                  <label style="font-size:.73rem">Judul Kompetensi</label>
                  <input type="text" name="competencies[{{ $c }}][title]" class="db-form-control" value="{{ $comp['title'] ?? '' }}" placeholder="Web Development">
                </div>
                <div class="db-form-group" style="margin-bottom:0">
                  <label style="font-size:.73rem">Deskripsi Singkat</label>
                  <input type="text" name="competencies[{{ $c }}][desc]" class="db-form-control" value="{{ $comp['desc'] ?? '' }}" placeholder="Penjelasan materi...">
                </div>
              </div>
            @endfor
          </div>
        </div>

        <!-- CARD 5: FASILITAS & LAB PRAKTIK -->
        <div class="db-panel" style="margin-bottom:1.4rem">
          <div class="db-panel-head">
            <h2 style="font-size:.95rem"><i class="fas fa-building" style="color:var(--gold);margin-right:.5rem"></i> Section 5 — Fasilitas &amp; Laboratorium Praktik</h2>
          </div>
          @php
            $facs = $item->getDetail('facilities', []);
          @endphp
          <div class="sh-grid-2">
            @for($f = 0; $f < 2; $f++)
              @php $fac = $facs[$f] ?? []; @endphp
              <div style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.08);padding:1.1rem;border-radius:14px">
                <strong style="font-size:.8rem;color:var(--gold-light);display:block;margin-bottom:.75rem"><i class="fas fa-building"></i> Fasilitas / Lab {{ $f + 1 }}</strong>
                <div class="db-form-group" style="margin-bottom:.65rem">
                  <label style="font-size:.73rem">Nama Lab / Fasilitas</label>
                  <input type="text" name="facilities[{{ $f }}][title]" class="db-form-control" value="{{ $fac['title'] ?? '' }}" placeholder="Laboratorium RPL 1">
                </div>
                <div class="db-form-group" style="margin-bottom:.65rem">
                  <label style="font-size:.73rem">Deskripsi Fasilitas</label>
                  <input type="text" name="facilities[{{ $f }}][desc]" class="db-form-control" value="{{ $fac['desc'] ?? '' }}" placeholder="Spesifikasi peranti...">
                </div>
                <div class="db-form-group" style="margin-bottom:0">
                  <label style="font-size:.73rem">Path Foto Lab (Opsional)</label>
                  <input type="text" name="facilities[{{ $f }}][image]" class="db-form-control" value="{{ $fac['image'] ?? '' }}" placeholder="images/rpl/praktik-rpl.jpg">
                </div>
              </div>
            @endfor
          </div>
        </div>

        <!-- CARD 6: PROSPEK KARIR ALUMNI -->
        <div class="db-panel" style="margin-bottom:1.4rem">
          <div class="db-panel-head">
            <h2 style="font-size:.95rem"><i class="fas fa-briefcase" style="color:var(--gold);margin-right:.5rem"></i> Section 6 — Prospek Kerja &amp; Karir Alumni</h2>
          </div>
          @php
            $cars = $item->getDetail('careers', []);
          @endphp
          <div class="sh-grid-3">
            @for($cr = 0; $cr < 3; $cr++)
              @php $car = $cars[$cr] ?? []; @endphp
              <div style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.08);padding:1.1rem;border-radius:14px">
                <strong style="font-size:.8rem;color:var(--gold-light);display:block;margin-bottom:.75rem"><i class="fas fa-user-gear"></i> Karir {{ $cr + 1 }}</strong>
                <div class="db-form-group" style="margin-bottom:.65rem">
                  <label style="font-size:.73rem">Judul Profesi / Karir</label>
                  <input type="text" name="careers[{{ $cr }}][title]" class="db-form-control" value="{{ $car['title'] ?? '' }}" placeholder="Software Engineer">
                </div>
                <div class="db-form-group" style="margin-bottom:0">
                  <label style="font-size:.73rem">Deskripsi Peran</label>
                  <input type="text" name="careers[{{ $cr }}][desc]" class="db-form-control" value="{{ $car['desc'] ?? '' }}" placeholder="Deskripsi tugas...">
                </div>
              </div>
            @endfor
          </div>
        </div>

        <!-- CARD 7: CALL TO ACTION (CTA) PENUTUP -->
        <div class="db-panel" style="margin-bottom:1.4rem">
          <div class="db-panel-head">
            <h2 style="font-size:.95rem"><i class="fas fa-paper-plane" style="color:var(--gold);margin-right:.5rem"></i> Section 7 — Call to Action (CTA) Penutup</h2>
          </div>

          <div class="db-form-group">
            <label>Judul Call to Action</label>
            <input type="text" name="cta_title" class="db-form-control" value="{{ old('cta_title', $item->getDetail('cta_title', 'SIAP BERGABUNG DENGAN PROGRAM KEAHLIAN ' . $item->code . '?')) }}">
          </div>

          <div class="db-form-group">
            <label>Deskripsi Call to Action</label>
            <textarea name="cta_desc" class="db-form-control" rows="2">{{ old('cta_desc', $item->getDetail('cta_desc', 'Daftarkan dirimu dan kembangkan potensi terbaikmu bersama SMK Negeri 2 Mojokerto.')) }}</textarea>
          </div>
        </div>

        <!-- STICKY SAVE BAR (MATCHING 1:1 DENGAN SEJARAH SEKOLAH) -->
        <div class="sh-save-bar">
          <span><i class="fas fa-circle-info" style="color:var(--gold)"></i> Perubahan berlaku setelah disimpan.</span>
          <button type="submit" class="db-btn db-btn-gold" style="padding:.75rem 1.6rem;font-weight:800;border-radius:12px;box-shadow:0 8px 20px rgba(255,179,0,.3)">
            <i class="fas fa-floppy-disk"></i> Simpan Semua Perubahan ({{ $item->code }})
          </button>
        </div>
      </form>
    </div>
  @endforeach

  <!-- MODAL CREATE JURUSAN BARU (DISSEMBUNYIKAN) -->
  <div id="majorModal" style="display:none;position:fixed;inset:0;z-index:999;background:rgba(3,10,20,.82);backdrop-filter:blur(8px);align-items:center;justify-content:center;padding:1rem">
    <div style="width:min(640px,94vw);max-height:88vh;overflow-y:auto;background:var(--navy-panel);border:1px solid rgba(255,255,255,.18);border-radius:20px;padding:1.8rem;box-shadow:0 24px 60px rgba(0,0,0,.55);color:#fff;scrollbar-width:thin">
      <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.2rem;border-bottom:1px solid rgba(255,255,255,.08);padding-bottom:.8rem">
        <h3 id="majorModalTitle" style="font-size:1.15rem;margin:0"><i class="fas fa-graduation-cap" style="color:var(--gold);margin-right:.5rem"></i> Tambah Program Keahlian Baru</h3>
        <button style="background:none;border:none;color:var(--text-muted);font-size:1.3rem;cursor:pointer" onclick="closeMajorModal()">&times;</button>
      </div>

      <form id="majorForm" action="{{ route('admin.majors.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div style="display:grid;grid-template-columns:1fr 2.2fr;gap:1rem;margin-bottom:1rem">
          <div>
            <label style="display:block;font-size:.78rem;font-weight:700;color:var(--text-muted);margin-bottom:.4rem">Kode Jurusan <span style="color:#ff7875">*</span></label>
            <input type="text" name="code" id="majorCode" class="form-control" placeholder="SIJA" required style="width:100%;padding:.65rem .85rem;border-radius:10px;background:var(--navy-bg);border:1px solid rgba(255,255,255,.15);color:#fff;text-transform:uppercase;font-weight:800">
          </div>
          <div>
            <label style="display:block;font-size:.78rem;font-weight:700;color:var(--text-muted);margin-bottom:.4rem">Nama Program Keahlian <span style="color:#ff7875">*</span></label>
            <input type="text" name="name" id="majorName" class="form-control" placeholder="Nama Jurusan" required style="width:100%;padding:.65rem .85rem;border-radius:10px;background:var(--navy-bg);border:1px solid rgba(255,255,255,.15);color:#fff">
          </div>
        </div>

        <div style="margin-bottom:1.4rem;display:flex;align-items:center;gap:.6rem">
          <input type="checkbox" name="is_active" id="majorIsActive" value="1" checked style="width:18px;height:18px;accent-color:var(--gold);cursor:pointer">
          <label for="majorIsActive" style="font-size:.82rem;color:#fff;font-weight:700;cursor:pointer">Aktifkan Program Keahlian</label>
        </div>

        <div style="display:flex;justify-content:flex-end;gap:.7rem;border-top:1px solid rgba(255,255,255,.08);padding-top:1rem">
          <button type="button" class="db-btn db-btn-ghost" onclick="closeMajorModal()">Batal</button>
          <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-save"></i> Simpan Jurusan Baru</button>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  // TAB SWITCHER FUNCTION
  function switchMajorTab(tabId) {
    document.querySelectorAll('.sh-tab-btn').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.sh-tab-panel').forEach(p => p.classList.remove('active'));

    const btn = document.querySelector(`.sh-tab-btn[data-tab="${tabId}"]`);
    const panel = document.querySelector(`.sh-tab-panel[data-panel="${tabId}"]`);

    if (btn) btn.classList.add('active');
    if (panel) panel.classList.add('active');

    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  document.querySelectorAll('.sh-tab-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      const tabId = this.getAttribute('data-tab');
      switchMajorTab(tabId);
    });
  });

  function openCreateMajorModal() {
    document.getElementById('majorForm').reset();
    document.getElementById('majorIsActive').checked = true;
    document.getElementById('majorModal').style.display = 'flex';
  }

  function closeMajorModal() {
    document.getElementById('majorModal').style.display = 'none';
  }
</script>
@endpush
