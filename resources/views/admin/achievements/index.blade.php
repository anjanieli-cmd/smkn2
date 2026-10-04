@extends('layouts.admin')

@section('title', 'Manajemen Prestasi Sekolah — SMK Negeri 2 Mojokerto')

@push('styles')
  @include('admin.partials.form-kit')
  <style>
    input[type="date"]::-webkit-calendar-picker-indicator { filter: invert(1) brightness(2) !important; cursor: pointer !important; opacity: 1 !important; }
    input[type="date"] { color-scheme: dark !important; }
    input[type="file"]::file-selector-button {
      background: rgba(255,255,255,.15) !important; color: #fff !important; border: 1px solid rgba(255,255,255,.2) !important;
      border-radius: 6px !important; padding: .3rem .6rem !important; cursor: pointer !important; margin-right: .6rem !important;
    }
    input[type="file"]::file-selector-button:hover { background: var(--gold) !important; color: var(--ink) !important; }

    .pa-tabs { display:flex; gap:.5rem; margin-bottom:1.2rem; flex-wrap:wrap; }
    .pa-tab { padding:.6rem 1.1rem; border-radius:12px; border:1px solid rgba(255,255,255,.14); background:rgba(255,255,255,.04);
      color:var(--text-muted); font-weight:700; font-size:.82rem; cursor:pointer; display:inline-flex; align-items:center; gap:.5rem; }
    .pa-tab.active { background:rgba(255,179,0,.16); border-color:rgba(255,179,0,.5); color:var(--gold-light); }
    .pa-pane { display:none; }
    .pa-pane.active { display:block; }

    .pa-badge { display:inline-block; font-size:.66rem; font-weight:800; padding:.15rem .5rem; border-radius:99px; margin-left:.35rem; vertical-align:middle; letter-spacing:.03em; }
    .pa-badge-feat { background:rgba(255,179,0,.22); color:var(--gold-light); }
    .pa-badge-off  { background:rgba(239,68,68,.2); color:#fca5a5; }

    .pa-modal { display:none; position:fixed; inset:0; z-index:999; background:rgba(3,10,20,.8); backdrop-filter:blur(8px); align-items:flex-start; justify-content:center; overflow-y:auto; padding:2rem 0; }
    .pa-modal-box { width:min(620px,94vw); background:var(--navy-panel); border:1px solid rgba(255,255,255,.14); border-radius:20px; padding:1.8rem; box-shadow:0 24px 60px rgba(0,0,0,.5); color:#fff; }
    .pa-check { display:flex; align-items:center; gap:.55rem; font-size:.82rem; color:#fff; cursor:pointer; }
    .pa-check input { width:17px; height:17px; accent-color:var(--gold); }
    .pa-photo-prev { width:100%; height:120px; border-radius:12px; object-fit:cover; background:rgba(255,255,255,.06); display:block; margin-bottom:.6rem; }
    .pa-moment { background:rgba(255,255,255,.03); border:1px solid rgba(255,255,255,.08); border-radius:14px; padding:1rem; }
    .pa-section-note { font-size:.74rem; color:var(--text-muted); margin:-.2rem 0 1rem; line-height:1.5; }
  </style>
@endpush

@section('content')
  @if(session('success'))
    <div style="background:rgba(16,185,129,.15);border:1px solid rgba(16,185,129,.4);color:#10b981;padding:.75rem 1.2rem;border-radius:12px;margin-bottom:1.2rem;font-size:.85rem;display:flex;align-items:center;gap:.6rem">
      <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
  @endif

  @if($errors->any())
    <div style="background:rgba(239,68,68,.15);border:1px solid rgba(239,68,68,.4);color:#ef4444;padding:.75rem 1.2rem;border-radius:12px;margin-bottom:1.2rem;font-size:.85rem">
      <ul style="margin:0;padding-left:1.2rem">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="db-panel-head" style="margin-bottom:1rem">
    <div>
      <h2><i class="fas fa-trophy" style="color:var(--gold);margin-right:.5rem"></i> Prestasi &amp; Penghargaan Sekolah</h2>
      <p style="font-size:.8rem;color:var(--text-muted);margin-top:.25rem">Kelola daftar prestasi dan seluruh teks yang tampil di halaman publik <strong>/prestasi</strong>.</p>
    </div>
  </div>

  <div class="pa-tabs">
    <button type="button" class="pa-tab {{ $tab === 'daftar' ? 'active' : '' }}" data-pa-tab="daftar"><i class="fas fa-list"></i> Daftar Prestasi <span style="opacity:.7">({{ count($items) }})</span></button>
    <button type="button" class="pa-tab {{ $tab === 'teks' ? 'active' : '' }}" data-pa-tab="teks"><i class="fas fa-pen-ruler"></i> Teks Halaman</button>
  </div>

  {{-- ===================================================== TAB: DAFTAR PRESTASI ===================================================== --}}
  <div class="pa-pane {{ $tab === 'daftar' ? 'active' : '' }}" id="pa-pane-daftar">
    <div class="db-panel">
      <div class="db-panel-head">
        <div>
          <h2 style="font-size:.95rem">Arsip Prestasi</h2>
          <p style="font-size:.78rem;color:var(--text-muted);margin-top:.2rem">Setiap baris tampil sebagai kartu di halaman publik, diurutkan dari tahun dan tanggal terbaru.</p>
        </div>
        <div class="db-panel-actions">
          <button class="db-btn db-btn-gold" onclick="openCreateAchvModal()"><i class="fas fa-plus"></i> Tambah Prestasi Baru</button>
        </div>
      </div>

      <div style="display:flex;align-items:center;justify-content:space-between;gap:1rem;margin:1.2rem 1.4rem;flex-wrap:wrap;background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.08);padding:.8rem 1.2rem;border-radius:14px">
        <div style="position:relative;flex:1;min-width:240px">
          <i class="fas fa-search" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);color:var(--text-muted);font-size:.85rem"></i>
          <input type="text" id="achvSearchInput" value="{{ request('search') }}" placeholder="Cari judul, pemenang, kategori, atau deskripsi..." onkeyup="filterAdminAchievements()" style="width:100%;padding:.55rem .9rem .55rem 2.4rem;border-radius:10px;background:var(--navy-bg);border:1px solid rgba(255,255,255,.14);color:#fff;font-size:.82rem">
        </div>
        <div style="display:flex;align-items:center;gap:.6rem">
          <label style="font-size:.78rem;color:var(--text-muted);font-weight:700">Tingkat Lomba:</label>
          <select id="achvLevelFilter" onchange="filterAdminAchievements()" style="padding:.55rem .85rem;border-radius:10px;background:var(--navy-bg);border:1px solid rgba(255,255,255,.14);color:#fff;font-size:.82rem">
            <option value="">Semua Tingkat</option>
            <option value="Kota/Kabupaten" {{ request('level') == 'Kota/Kabupaten' ? 'selected' : '' }}>Kota / Kabupaten</option>
            <option value="Provinsi" {{ request('level') == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
            <option value="Nasional" {{ request('level') == 'Nasional' ? 'selected' : '' }}>Nasional</option>
            <option value="Internasional" {{ request('level') == 'Internasional' ? 'selected' : '' }}>Internasional</option>
          </select>
        </div>
      </div>

      <div class="db-table-wrap">
        <table class="db-table">
          <thead>
            <tr>
              <th>Foto</th>
              <th>Judul Prestasi</th>
              <th>Tingkat</th>
              <th>Tahun</th>
              <th>Peringkat · Kategori</th>
              <th style="text-align:right">Aksi</th>
            </tr>
          </thead>
          <tbody id="achvTableBody">
            @forelse($items as $item)
              @php
                $img = $item->image_url;
                $hasValidImg = $img && file_exists(public_path($img));
                $rowData = array_merge($item->toArray(), ['event_date' => $item->event_date ? $item->event_date->format('Y-m-d') : '']);
              @endphp
              <tr data-title="{{ strtolower($item->title ?? '') }}" data-winner="{{ strtolower(($item->winner_name ?? '') . ' ' . ($item->tag ?? '')) }}" data-level="{{ strtolower($item->level ?? '') }}">
                <td style="width:65px">
                  @if($hasValidImg)
                    <img src="{{ asset($img) }}" alt="" style="width:48px;height:48px;border-radius:12px;object-fit:cover">
                  @else
                    <div style="width:48px;height:48px;border-radius:12px;background:rgba(255,179,0,.15);color:var(--gold);display:flex;align-items:center;justify-content:center"><i class="fas fa-trophy" style="font-size:1.2rem"></i></div>
                  @endif
                </td>
                <td>
                  <strong>{{ $item->title }}</strong>
                  @if($item->is_featured)<span class="pa-badge pa-badge-feat"><i class="fas fa-crown"></i> UTAMA</span>@endif
                  @if(!$item->is_active)<span class="pa-badge pa-badge-off">DISEMBUNYIKAN</span>@endif
                  <div style="font-size:.72rem;color:var(--text-muted)">{{ \Illuminate\Support\Str::limit($item->description ?? '', 60) }}</div>
                </td>
                <td>
                  <span style="font-size:.75rem;padding:.25rem .55rem;border-radius:99px;background:rgba(255,179,0,.2);color:var(--gold-light);font-weight:700;text-transform:uppercase">{{ $item->level ?? 'Provinsi' }}</span>
                  @if($item->level_label && $item->level_label !== $item->level)
                    <div style="font-size:.7rem;color:var(--text-muted);margin-top:.25rem">{{ $item->level_label }}</div>
                  @endif
                </td>
                <td><span style="font-size:.78rem;color:var(--gold-light)">{{ $item->year }}</span></td>
                <td>
                  <span style="font-size:.78rem;color:#fff">{{ $item->rank ?: '-' }}</span>
                  <div style="font-size:.7rem;color:var(--text-muted)">{{ $item->tag ?: ($item->winner_name ?: '-') }}</div>
                </td>
                <td style="text-align:right;white-space:nowrap">
                  <button class="db-btn db-btn-ghost" style="padding:.35rem .65rem;font-size:.75rem" onclick="openEditAchvModal({{ json_encode($rowData) }})"><i class="fas fa-pen-to-square"></i> Edit</button>
                  <button class="db-btn db-btn-danger" style="padding:.35rem .65rem;font-size:.75rem" onclick="deleteAchv('{{ $item->id }}')"><i class="fas fa-trash"></i> Hapus</button>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" style="text-align:center;padding:2.5rem;color:var(--text-muted)">
                  <i class="fas fa-trophy" style="font-size:2.2rem;color:var(--gold);margin-bottom:.8rem;display:block"></i>
                  <p style="margin:0;font-size:.9rem">Belum ada data prestasi.</p>
                  <p style="font-size:.78rem;margin-top:.3rem">Klik <strong>"Tambah Prestasi Baru"</strong>, atau isi data awal lewat terminal: <code>php artisan db:seed --class=AchievementSeeder</code></p>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  {{-- ===================================================== TAB: TEKS HALAMAN ===================================================== --}}
  @php
    $pageSections = [
      ['icon' => 'fa-magnifying-glass', 'title' => 'Judul Tab Browser &amp; SEO', 'note' => '', 'fields' => [
        ['seo_title', 'Judul halaman (tab browser)', 'text'],
        ['seo_description', 'Deskripsi untuk mesin pencari', 'textarea'],
      ]],
      ['icon' => 'fa-flag', 'title' => '1. Hero (bagian paling atas)', 'note' => 'Judul besar terdiri dari dua bagian: kata putih lalu kata emas.', 'fields' => [
        ['hero_kicker', 'Teks kecil di atas judul', 'text'],
        ['hero_title_white', 'Judul — bagian putih', 'text'],
        ['hero_title_gold', 'Judul — bagian emas', 'text'],
        ['hero_lead', 'Paragraf pengantar', 'textarea'],
        ['hero_pill1', 'Label 1', 'text'],
        ['hero_pill2', 'Label 2', 'text'],
        ['hero_pill3', 'Label 3 (kosongkan = otomatis rentang tahun, mis. 2022 — 2026)', 'text'],
      ]],
      ['icon' => 'fa-book-open', 'title' => '2. Pembuka &amp; Etalase Kehormatan', 'note' => 'Angka "Artikel Prestasi" dan "Tahun Tercatat" dihitung otomatis dari data.', 'fields' => [
        ['opening_eyebrow', 'Teks kecil di atas judul', 'text'],
        ['opening_title_white', 'Judul — bagian putih', 'text'],
        ['opening_title_gold', 'Judul — bagian emas', 'text'],
        ['opening_desc', 'Paragraf deskripsi (gunakan **teks** untuk tebal)', 'textarea'],
        ['opening_meta1_label', 'Keterangan angka 1 (jumlah artikel)', 'text'],
        ['opening_meta2_value', 'Angka/teks 2 — nilai', 'text'],
        ['opening_meta2_label', 'Angka/teks 2 — keterangan', 'text'],
        ['opening_meta3_label', 'Keterangan angka 3 (jumlah tahun)', 'text'],
        ['cabinet_tag', 'Kotak etalase — label', 'text'],
        ['cabinet_title', 'Kotak etalase — judul (Enter = baris baru)', 'textarea', 2],
        ['cabinet_text', 'Kotak etalase — deskripsi', 'textarea'],
        ['cabinet_foot_levels', 'Kotak etalase — teks tingkat', 'text'],
        ['cabinet_foot_count_label', 'Kotak etalase — keterangan jumlah', 'text'],
      ]],
      ['icon' => 'fa-crown', 'title' => '3. Capaian Utama (Featured)', 'note' => 'Foto, judul, deskripsi, tingkat, dan peringkat diambil dari prestasi yang ditandai "Capaian Utama" di tab Daftar Prestasi. Di sini hanya label-labelnya.', 'fields' => [
        ['featured_eyebrow', 'Teks kecil di atas', 'text'],
        ['featured_badge', 'Label di foto', 'text'],
        ['featured_year_label', 'Keterangan tahun', 'text'],
        ['featured_button', 'Tombol baca', 'text'],
      ]],
      ['icon' => 'fa-award', 'title' => '4. Pencapaian Prestasi (kartu &amp; filter)', 'note' => '', 'fields' => [
        ['achv_eyebrow', 'Teks kecil di atas judul', 'text'],
        ['achv_title_white', 'Judul — bagian putih', 'text'],
        ['achv_title_gold', 'Judul — bagian emas', 'text'],
        ['achv_subtitle', 'Subjudul', 'textarea'],
        ['achv_more_button', 'Tombol "muat lainnya"', 'text'],
        ['achv_empty', 'Pesan jika kategori kosong', 'text'],
      ]],
      ['icon' => 'fa-images', 'title' => '5. Momen Kejayaan (teks)', 'note' => 'Foto dan keterangan empat momen ada di bagian "Foto Momen Kejayaan" di bawah.', 'fields' => [
        ['moment_eyebrow', 'Teks kecil di atas judul', 'text'],
        ['moment_title_white', 'Judul — bagian putih', 'text'],
        ['moment_title_gold', 'Judul — bagian emas', 'text'],
        ['moment_subtitle', 'Subjudul', 'textarea'],
      ]],
      ['icon' => 'fa-quote-left', 'title' => '7. Kutipan / Moto', 'note' => 'Gunakan __teks__ untuk bagian yang dimiringkan dan berwarna emas.', 'fields' => [
        ['quote_text', 'Kalimat kutipan', 'textarea', 3],
        ['quote_source', 'Sumber kutipan', 'text'],
      ]],
      ['icon' => 'fa-timeline', 'title' => '8. Perjalanan Prestasi (timeline)', 'note' => 'Isi timeline otomatis dari tahun pada Daftar Prestasi.', 'fields' => [
        ['archive_eyebrow', 'Teks kecil di atas judul', 'text'],
        ['archive_title_white', 'Judul — bagian putih', 'text'],
        ['archive_title_gold', 'Judul — bagian emas', 'text'],
        ['archive_subtitle', 'Subjudul', 'textarea'],
        ['archive_badge', 'Label arsip (kosongkan = otomatis, mis. Arsip 2022 — 2026)', 'text'],
      ]],
      ['icon' => 'fa-handshake', 'title' => '9. Ajakan (CTA, bagian paling bawah)', 'note' => 'Tombol mengarah ke halaman Kontak.', 'fields' => [
        ['cta_eyebrow', 'Teks kecil di atas judul', 'text'],
        ['cta_title', 'Judul', 'text'],
        ['cta_text', 'Paragraf', 'textarea'],
        ['cta_button', 'Teks tombol', 'text'],
      ]],
    ];
  @endphp

  <div class="pa-pane {{ $tab === 'teks' ? 'active' : '' }}" id="pa-pane-teks">
    <form action="{{ route('admin.achievements.page.update') }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="db-panel" style="margin-bottom:1.2rem">
        <p class="pa-section-note" style="margin:0">
          Teks di bawah tampil di halaman publik <strong>/prestasi</strong>. Format: <code>**tebal**</code> dan <code>__miring emas__</code>.
          Kalau semua bagian ini dikembalikan ke bawaan, halaman kembali persis seperti semula.
        </p>
      </div>

      @foreach($pageSections as $sec)
        <div class="db-panel" style="margin-bottom:1.2rem">
          <div class="db-panel-head"><h2 style="font-size:.9rem"><i class="fas {{ $sec['icon'] }}" style="color:var(--gold);margin-right:.5rem"></i> {!! $sec['title'] !!}</h2></div>
          @if($sec['note'])<p class="pa-section-note">{{ $sec['note'] }}</p>@endif
          <div class="ad-grid-2">
            @foreach($sec['fields'] as $f)
              @php [$key, $label, $type] = $f; $rows = $f[3] ?? 3; $wide = $type === 'textarea'; @endphp
              <div class="db-form-group" @if($wide) style="grid-column:1 / -1" @endif>
                <label>{{ $label }}</label>
                @if($type === 'textarea')
                  <textarea name="{{ $key }}" rows="{{ $rows }}" class="db-form-control" maxlength="1500">{{ old($key, $content[$key] ?? '') }}</textarea>
                @else
                  <input type="text" name="{{ $key }}" class="db-form-control" maxlength="1500" value="{{ old($key, $content[$key] ?? '') }}">
                @endif
              </div>
            @endforeach
          </div>
        </div>
      @endforeach

      <div class="db-panel" style="margin-bottom:1.2rem">
        <div class="db-panel-head"><h2 style="font-size:.9rem"><i class="fas fa-camera-retro" style="color:var(--gold);margin-right:.5rem"></i> Foto Momen Kejayaan (4 foto)</h2></div>
        <p class="pa-section-note">Empat foto bento di bagian "Momen Kejayaan". Pilih file baru hanya kalau ingin mengganti fotonya.</p>
        <div class="ad-grid-2">
          @for($n = 1; $n <= 4; $n++)
            @php $imgKey = "moment{$n}_image"; $imgPath = $content[$imgKey] ?? ''; @endphp
            <div class="pa-moment">
              <strong style="font-size:.8rem;color:var(--gold-light);display:block;margin-bottom:.6rem">Foto {{ $n }}</strong>
              @if($imgPath && file_exists(public_path($imgPath)))
                <img class="pa-photo-prev" src="{{ asset($imgPath) }}" alt="">
              @else
                <div class="pa-photo-prev" style="display:flex;align-items:center;justify-content:center;color:var(--text-muted);font-size:.75rem">Belum ada foto</div>
              @endif
              <div class="db-form-group">
                <label>Ganti foto</label>
                <input type="file" name="{{ $imgKey }}" accept="image/*" class="db-form-control" style="padding:.45rem .9rem">
              </div>
              <div class="db-form-group">
                <label>Judul keterangan</label>
                <input type="text" name="moment{{ $n }}_title" class="db-form-control" maxlength="255" value="{{ old("moment{$n}_title", $content["moment{$n}_title"] ?? '') }}">
              </div>
              <div class="db-form-group" style="margin-bottom:0">
                <label>Tingkat · Tahun</label>
                <input type="text" name="moment{{ $n }}_meta" class="db-form-control" maxlength="255" placeholder="Provinsi · 2025" value="{{ old("moment{$n}_meta", $content["moment{$n}_meta"] ?? '') }}">
              </div>
            </div>
          @endfor
        </div>
      </div>

      <div class="db-panel" style="margin-bottom:1.2rem">
        <div class="db-panel-head"><h2 style="font-size:.9rem"><i class="fas fa-image" style="color:var(--gold);margin-right:.5rem"></i> Foto Latar Kutipan</h2></div>
        @php $qPath = $content['quote_image'] ?? ''; @endphp
        <div style="max-width:360px">
          @if($qPath && file_exists(public_path($qPath)))
            <img class="pa-photo-prev" src="{{ asset($qPath) }}" alt="">
          @endif
          <div class="db-form-group" style="margin-bottom:0">
            <label>Ganti foto latar</label>
            <input type="file" name="quote_image" accept="image/*" class="db-form-control" style="padding:.45rem .9rem">
          </div>
        </div>
      </div>

      <div class="ad-save-bar">
        <span><i class="fas fa-circle-info"></i> Perubahan tampil di halaman publik setelah klik Simpan.</span>
        <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Teks Halaman</button>
      </div>
    </form>

    <form action="{{ route('admin.achievements.page.reset') }}" method="POST" style="margin-top:1rem"
          onsubmit="return confirm('Kembalikan SEMUA teks halaman Prestasi ke bawaan? Daftar prestasi tidak ikut berubah.')">
      @csrf
      <button type="submit" class="db-btn db-btn-ghost" style="font-size:.78rem"><i class="fas fa-rotate-left"></i> Kembalikan semua teks ke bawaan</button>
    </form>
  </div>

  <form id="deleteAchvForm" method="POST" action="" style="display:none">
    @csrf
    @method('DELETE')
  </form>

  {{-- ===================================================== MODAL TAMBAH / EDIT PRESTASI ===================================================== --}}
  <div id="achvModal" class="pa-modal">
    <div class="pa-modal-box">
      <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.2rem">
        <h3 id="achvModalTitle" style="font-size:1.15rem;margin:0"><i class="fas fa-trophy" style="color:var(--gold);margin-right:.5rem"></i> Tambah Prestasi Sekolah</h3>
        <button type="button" style="background:none;border:none;color:var(--text-muted);font-size:1.4rem;cursor:pointer" onclick="closeAchvModal()">&times;</button>
      </div>

      <form id="achvForm" action="{{ route('admin.achievements.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div id="achvFormMethod"></div>

        <div class="db-form-group">
          <label>Judul Prestasi / Berita *</label>
          <input type="text" name="title" id="achvTitle" class="db-form-control" placeholder="Contoh: Juara 1 LKS Web Technologies" required maxlength="255">
        </div>

        <div class="ad-grid-2">
          <div class="db-form-group">
            <label>Tingkat Lomba * <small style="font-weight:400;color:var(--text-muted)">(untuk filter)</small></label>
            <select name="level" id="achvLevel" class="db-form-control">
              <option value="Kota/Kabupaten">Kota / Kabupaten</option>
              <option value="Provinsi">Provinsi</option>
              <option value="Nasional">Nasional</option>
              <option value="Internasional">Internasional</option>
            </select>
          </div>
          <div class="db-form-group">
            <label>Tingkat spesifik <small style="font-weight:400;color:var(--text-muted)">(tampil di kartu)</small></label>
            <input type="text" name="level_label" id="achvLevelLabel" class="db-form-control" placeholder="Contoh: Kota Mojokerto / Jawa Timur" maxlength="255">
          </div>
        </div>

        <div class="ad-grid-2">
          <div class="db-form-group">
            <label>Tahun *</label>
            <input type="number" name="year" id="achvYear" value="{{ date('Y') }}" class="db-form-control" min="2000" max="2100" required>
          </div>
          <div class="db-form-group">
            <label>Tanggal <small style="font-weight:400;color:var(--text-muted)">(opsional, untuk urutan)</small></label>
            <input type="date" name="event_date" id="achvDate" class="db-form-control">
          </div>
        </div>

        <div class="ad-grid-2">
          <div class="db-form-group">
            <label>Peringkat <small style="font-weight:400;color:var(--text-muted)">(label di foto)</small></label>
            <input type="text" name="rank" id="achvRank" class="db-form-control" placeholder="Contoh: Juara 1" maxlength="255">
          </div>
          <div class="db-form-group">
            <label>Kategori / Bidang</label>
            <input type="text" name="tag" id="achvTag" class="db-form-control" placeholder="Contoh: RPL, Olahraga, Seni" maxlength="255">
          </div>
        </div>

        <div class="db-form-group">
          <label>Nama Siswa / Pemenang / Tim <small style="font-weight:400;color:var(--text-muted)">(opsional)</small></label>
          <input type="text" name="winner_name" id="achvWinner" class="db-form-control" placeholder="Contoh: Rovino Ramadhani (XII RPL 1)" maxlength="255">
        </div>

        <div class="db-form-group">
          <label>Foto Dokumentasi</label>
          <img id="achvPhotoPrev" class="pa-photo-prev" src="" alt="" style="display:none;height:110px">
          <input type="file" name="image" id="achvImage" accept="image/*" class="db-form-control" style="padding:.45rem .9rem">
          <small class="ad-hint" id="achvImageHint">Maksimal 5 MB. Kosongkan kalau tidak ingin mengganti foto.</small>
        </div>

        <div class="db-form-group">
          <label>Deskripsi / Isi Berita</label>
          <textarea name="description" id="achvDesc" rows="4" class="db-form-control" placeholder="Rincian mengenai prestasi..."></textarea>
        </div>

        <div style="display:flex;flex-direction:column;gap:.7rem;margin-bottom:1.4rem">
          <label class="pa-check"><input type="checkbox" name="is_active" id="achvActive" value="1" checked> Tampilkan di halaman publik</label>
          <label class="pa-check"><input type="checkbox" name="is_featured" id="achvFeatured" value="1"> Jadikan <strong>Capaian Utama</strong> (tampil besar di bagian Featured; hanya satu yang bisa dipilih)</label>
        </div>

        <div style="display:flex;justify-content:flex-end;gap:.7rem">
          <button type="button" class="db-btn db-btn-ghost" onclick="closeAchvModal()">Batal</button>
          <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-save"></i> Simpan Prestasi</button>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  var ASSET_BASE = "{{ asset('') }}";

  // ---------- Tab ----------
  document.querySelectorAll('[data-pa-tab]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var tab = btn.getAttribute('data-pa-tab');
      document.querySelectorAll('[data-pa-tab]').forEach(function (b) { b.classList.toggle('active', b === btn); });
      document.querySelectorAll('.pa-pane').forEach(function (p) { p.classList.toggle('active', p.id === 'pa-pane-' + tab); });
    });
  });

  // ---------- Modal tambah / edit ----------
  function setPhotoPreview(path) {
    var img = document.getElementById('achvPhotoPrev');
    if (path) {
      img.src = /^https?:/.test(path) ? path : ASSET_BASE + path.replace(/^\/+/, '');
      img.style.display = 'block';
    } else {
      img.removeAttribute('src');
      img.style.display = 'none';
    }
  }

  function openCreateAchvModal() {
    document.getElementById('achvModalTitle').innerHTML = '<i class="fas fa-trophy" style="color:var(--gold);margin-right:.5rem"></i> Tambah Prestasi Sekolah';
    document.getElementById('achvForm').action = "{{ route('admin.achievements.store') }}";
    document.getElementById('achvFormMethod').innerHTML = '';
    document.getElementById('achvForm').reset();
    document.getElementById('achvYear').value = new Date().getFullYear();
    document.getElementById('achvActive').checked = true;
    document.getElementById('achvFeatured').checked = false;
    setPhotoPreview('');
    document.getElementById('achvModal').style.display = 'flex';
  }

  function openEditAchvModal(item) {
    document.getElementById('achvModalTitle').innerHTML = '<i class="fas fa-pen-to-square" style="color:var(--gold);margin-right:.5rem"></i> Edit Prestasi Sekolah';
    document.getElementById('achvForm').action = "{{ url('admin/achievements') }}/" + item.id;
    document.getElementById('achvFormMethod').innerHTML = '<input type="hidden" name="_method" value="PUT">';
    document.getElementById('achvForm').reset();
    document.getElementById('achvTitle').value = item.title || '';
    document.getElementById('achvLevel').value = item.level || 'Provinsi';
    document.getElementById('achvLevelLabel').value = item.level_label || '';
    document.getElementById('achvYear').value = item.year || new Date().getFullYear();
    document.getElementById('achvDate').value = item.event_date || '';
    document.getElementById('achvRank').value = item.rank || '';
    document.getElementById('achvTag').value = item.tag || '';
    document.getElementById('achvWinner').value = item.winner_name || '';
    document.getElementById('achvDesc').value = item.description || '';
    document.getElementById('achvActive').checked = !!item.is_active;
    document.getElementById('achvFeatured').checked = !!item.is_featured;
    setPhotoPreview(item.image_url || '');
    document.getElementById('achvModal').style.display = 'flex';
  }

  function closeAchvModal() {
    document.getElementById('achvModal').style.display = 'none';
  }

  document.getElementById('achvImage').addEventListener('change', function () {
    if (this.files && this.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        var img = document.getElementById('achvPhotoPrev');
        img.src = e.target.result;
        img.style.display = 'block';
      };
      reader.readAsDataURL(this.files[0]);
    }
  });

  function deleteAchv(id) {
    if (confirm('Apakah Anda yakin ingin menghapus data prestasi ini?')) {
      var form = document.getElementById('deleteAchvForm');
      form.action = "{{ url('admin/achievements') }}/" + id;
      form.submit();
    }
  }

  // ---------- Cari & filter ----------
  function filterAdminAchievements() {
    var query = (document.getElementById('achvSearchInput').value || '').toLowerCase().trim();
    var level = (document.getElementById('achvLevelFilter').value || '').toLowerCase().trim();
    var rows = document.querySelectorAll('#achvTableBody tr');

    rows.forEach(function (row) {
      if (row.cells.length <= 1) return;

      var titleText  = row.getAttribute('data-title') || '';
      var winnerText = row.getAttribute('data-winner') || '';
      var levelText  = row.getAttribute('data-level') || '';

      var matchesQuery = !query || titleText.includes(query) || winnerText.includes(query);
      var matchesLevel = !level || levelText === level;

      row.style.display = (matchesQuery && matchesLevel) ? '' : 'none';
    });
  }
</script>
@endpush