@extends('layouts.admin')

@section('title', 'Manajemen Program Keahlian — SMK Negeri 2 Mojokerto')

@section('content')
  <style>
    input[type="file"]::file-selector-button {
      background: rgba(255, 255, 255, 0.15) !important;
      color: #fff !important;
      border: 1px solid rgba(255, 255, 255, 0.2) !important;
      border-radius: 6px !important;
      padding: .3rem .6rem !important;
      cursor: pointer !important;
      margin-right: .6rem !important;
    }
    input[type="file"]::file-selector-button:hover {
      background: var(--gold) !important;
      color: var(--ink) !important;
    }
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
    .major-icon-box {
      width: 46px;
      height: 46px;
      border-radius: 12px;
      background: linear-gradient(135deg, rgba(29, 111, 184, 0.25), rgba(40, 169, 225, 0.15));
      border: 1px solid rgba(40, 169, 225, 0.3);
      color: var(--gold);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.25rem;
      box-shadow: 0 4px 14px rgba(0, 0, 0, 0.25);
    }
  </style>

  @if(session('success'))
    <div style="background:rgba(16,185,129,.15);border:1px solid rgba(16,185,129,.4);color:#10b981;padding:.75rem 1.2rem;border-radius:12px;margin-bottom:1.2rem;font-size:.85rem;display:flex;align-items:center;gap:.6rem">
      <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
  @endif

  @if(session('error'))
    <div style="background:rgba(239,68,68,.15);border:1px solid rgba(239,68,68,.4);color:#ef4444;padding:.75rem 1.2rem;border-radius:12px;margin-bottom:1.2rem;font-size:.85rem;display:flex;align-items:center;gap:.6rem">
      <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
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

  <!-- STAT CARDS JURUSAN -->
  <div style="display:grid;grid-template-columns:repeat(3, 1fr);gap:1.2rem;margin-bottom:1.6rem">
    <div style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.09);border-radius:16px;padding:1.2rem 1.4rem">
      <div style="font-size:.72rem;color:var(--text-muted);font-weight:700;text-transform:uppercase;letter-spacing:.08em;margin-bottom:.4rem">Total Program Keahlian</div>
      <div style="font-family:var(--font-display);font-size:1.8rem;color:#fff;font-weight:800">{{ $stats['total'] ?? count($items) }} <small style="font-size:.8rem;color:var(--gold-light)">Jurusan</small></div>
    </div>
    <div style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.09);border-radius:16px;padding:1.2rem 1.4rem">
      <div style="font-size:.72rem;color:#5ce0a3;font-weight:700;text-transform:uppercase;letter-spacing:.08em;margin-bottom:.4rem">Jurusan Aktif</div>
      <div style="font-family:var(--font-display);font-size:1.8rem;color:#5ce0a3;font-weight:800">{{ $stats['active'] ?? 0 }} <small style="font-size:.8rem;color:rgba(92,224,163,.7)">Publik</small></div>
    </div>
    <div style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.09);border-radius:16px;padding:1.2rem 1.4rem">
      <div style="font-size:.72rem;color:#ff7875;font-weight:700;text-transform:uppercase;letter-spacing:.08em;margin-bottom:.4rem">Nonaktif / Draf</div>
      <div style="font-family:var(--font-display);font-size:1.8rem;color:#ff7875;font-weight:800">{{ $stats['inactive'] ?? 0 }} <small style="font-size:.8rem;color:rgba(255,120,117,.7)">Jurusan</small></div>
    </div>
  </div>

  <!-- MAIN PANEL -->
  <div class="db-panel">
    <div class="db-panel-head">
      <div>
        <h2><i class="fas fa-graduation-cap" style="color:var(--gold);margin-right:.5rem"></i> Program Keahlian (Jurusan)</h2>
        <p style="font-size:.78rem;color:var(--text-muted);margin-top:.2rem">Kelola profil kompetensi keahlian, ikon, deskripsi, dan status aktif jurusan di SMK Negeri 2 Mojokerto.</p>
      </div>
      <div class="db-panel-actions">
        <button class="db-btn db-btn-gold" onclick="openCreateMajorModal()"><i class="fas fa-plus"></i> Tambah Jurusan Baru</button>
      </div>
    </div>

    <!-- TOOLBAR SEARCH & FILTER -->
    <div style="display:flex;align-items:center;justify-content:space-between;gap:1rem;margin:1.2rem 1.4rem;flex-wrap:wrap;background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.08);padding:.8rem 1.2rem;border-radius:14px">
      <form action="{{ route('admin.majors.index') }}" method="GET" id="majorSearchForm" style="display:flex;align-items:center;gap:.75rem;width:100%;flex-wrap:wrap">
        <div style="position:relative;flex:1;min-width:240px">
          <i class="fas fa-search" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);color:var(--text-muted);font-size:.85rem"></i>
          <input type="text" name="search" id="majorSearchInput" value="{{ request('search') }}" placeholder="Cari nama jurusan, kode (RPL, DKV, SIJA, dll)..." style="width:100%;padding:.55rem .9rem .55rem 2.4rem;border-radius:10px;background:var(--navy-bg);border:1px solid rgba(255,255,255,.14);color:#fff;font-size:.82rem">
        </div>
        <button type="submit" class="db-btn db-btn-gold" style="padding:.5rem 1rem;font-size:.8rem"><i class="fas fa-search"></i> Cari</button>
        <div style="display:flex;align-items:center;gap:.6rem;margin-left:auto">
          <label style="font-size:.78rem;color:var(--text-muted);font-weight:700">Status:</label>
          <select name="status" onchange="this.form.submit()" style="padding:.55rem .85rem;border-radius:10px;background:var(--navy-bg);border:1px solid rgba(255,255,255,.14);color:#fff;font-size:.82rem">
            <option value="">Semua Status</option>
            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Nonaktif</option>
          </select>
        </div>
        @if(request()->filled('search') || (request()->has('status') && request('status') !== ''))
          <a href="{{ route('admin.majors.index') }}" class="db-btn db-btn-ghost" style="padding:.5rem .85rem;font-size:.78rem"><i class="fas fa-rotate-left"></i> Reset Filter</a>
        @endif
      </form>
    </div>

    <!-- TABLE JURUSAN -->
    <div class="db-table-wrap">
      <table class="db-table">
        <thead>
          <tr>
            <th>Foto / Visual</th>
            <th>Kode</th>
            <th>Nama Program Keahlian</th>
            <th>Slug &amp; Halaman Publik</th>
            <th>Deskripsi</th>
            <th>Status</th>
            <th style="text-align:right">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($items as $item)
            <tr>
              <td style="width:65px">
                @php
                  $icon = $item->icon_url ?? 'fas fa-graduation-cap';
                  $isImg = Str::startsWith($icon, 'images/') || Str::startsWith($icon, 'http') || Str::contains($icon, '.png') || Str::contains($icon, '.jpg') || Str::contains($icon, '.jpeg') || Str::contains($icon, '.webp') || Str::contains($icon, '.svg');
                @endphp
                @if($isImg)
                  <img src="{{ asset($icon) }}" alt="{{ $item->code }}" style="width:46px;height:46px;border-radius:12px;object-fit:cover;border:1px solid rgba(255,255,255,.15);background:rgba(255,255,255,.05);padding:2px">
                @else
                  <div class="major-icon-box">
                    <i class="{{ $icon }}"></i>
                  </div>
                @endif
              </td>
              <td><span class="major-code-badge">{{ $item->code }}</span></td>
              <td>
                <strong style="color:#fff;font-size:.92rem">{{ $item->name }}</strong>
              </td>
              <td>
                <span style="font-size:.75rem;color:var(--text-muted);display:block">/keahlian/{{ $item->slug }}</span>
                @php
                  $hasRoute = Route::has(strtolower($item->code));
                @endphp
                @if($hasRoute)
                  <a href="{{ route(strtolower($item->code)) }}" target="_blank" style="font-size:.7rem;color:var(--gold-light);font-weight:700;display:inline-flex;align-items:center;gap:.25rem;margin-top:.15rem">
                    <i class="fas fa-external-link-alt" style="font-size:.62rem"></i> Lihat Halaman
                  </a>
                @endif
              </td>
              <td>
                <div style="font-size:.78rem;color:var(--text-muted);max-width:320px;line-height:1.5">
                  {{ Str::limit($item->description ?? 'Belum ada deskripsi singkat.', 80) }}
                </div>
              </td>
              <td>
                <form action="{{ route('admin.majors.toggle', $item->id) }}" method="POST" style="display:inline">
                  @csrf
                  <button type="submit" class="db-tag {{ $item->is_active ? 'active' : 'inactive' }}" style="border:none;cursor:pointer" title="Klik untuk mengubah status">
                    <i class="fas {{ $item->is_active ? 'fa-check-circle' : 'fa-times-circle' }}" style="margin-right:.25rem"></i>
                    {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                  </button>
                </form>
              </td>
              <td style="text-align:right;white-space:nowrap">
                <button class="db-btn db-btn-ghost" style="padding:.38rem .7rem;font-size:.76rem" onclick="openEditMajorModal({{ json_encode($item) }})"><i class="fas fa-pen-to-square"></i> Edit</button>
                <button class="db-btn db-btn-danger" style="padding:.38rem .7rem;font-size:.76rem" onclick="deleteMajor('{{ $item->id }}', '{{ $item->name }}')"><i class="fas fa-trash"></i> Hapus</button>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" style="text-align:center;padding:2.8rem;color:var(--text-muted)">
                <i class="fas fa-graduation-cap" style="font-size:2.5rem;color:var(--gold);margin-bottom:.8rem;display:block"></i>
                <p style="margin:0;font-size:.9rem">Belum ada data Program Keahlian.</p>
                <p style="font-size:.78rem;margin-top:.3rem">Klik tombol <strong>"Tambah Jurusan Baru"</strong> di atas untuk menambahkan data.</p>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- HIDDEN DELETE FORM -->
  <form id="deleteMajorForm" method="POST" action="" style="display:none">
    @csrf
    @method('DELETE')
  </form>

  <!-- MODAL CREATE / EDIT PROGRAM KEAHLIAN -->
  <div id="majorModal" style="display:none;position:fixed;inset:0;z-index:999;background:rgba(3,10,20,.82);backdrop-filter:blur(8px);align-items:center;justify-content:center">
    <div style="width:min(580px,94vw);background:var(--navy-panel);border:1px solid rgba(255,255,255,.14);border-radius:20px;padding:1.8rem;box-shadow:0 24px 60px rgba(0,0,0,.55);color:#fff">
      <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.2rem;border-bottom:1px solid rgba(255,255,255,.08);padding-bottom:.8rem">
        <h3 id="majorModalTitle" style="font-size:1.15rem;margin:0"><i class="fas fa-graduation-cap" style="color:var(--gold);margin-right:.5rem"></i> Tambah Program Keahlian Baru</h3>
        <button style="background:none;border:none;color:var(--text-muted);font-size:1.3rem;cursor:pointer" onclick="closeMajorModal()">&times;</button>
      </div>

      <form id="majorForm" action="{{ route('admin.majors.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div id="majorFormMethod"></div>

        <div style="display:grid;grid-template-columns:1fr 2.2fr;gap:1rem;margin-bottom:1rem">
          <div>
            <label style="display:block;font-size:.78rem;font-weight:700;color:var(--text-muted);margin-bottom:.4rem">Kode Jurusan <span style="color:#ff7875">*</span></label>
            <input type="text" name="code" id="majorCode" class="form-control" placeholder="Contoh: RPL" required style="width:100%;padding:.65rem .85rem;border-radius:10px;background:var(--navy-bg);border:1px solid rgba(255,255,255,.15);color:#fff;text-transform:uppercase;font-weight:800">
          </div>
          <div>
            <label style="display:block;font-size:.78rem;font-weight:700;color:var(--text-muted);margin-bottom:.4rem">Nama Program Keahlian <span style="color:#ff7875">*</span></label>
            <input type="text" name="name" id="majorName" class="form-control" placeholder="Contoh: Rekayasa Perangkat Lunak" required style="width:100%;padding:.65rem .85rem;border-radius:10px;background:var(--navy-bg);border:1px solid rgba(255,255,255,.15);color:#fff">
          </div>
        </div>

        <div style="margin-bottom:1rem">
          <label style="display:block;font-size:.78rem;font-weight:700;color:var(--text-muted);margin-bottom:.4rem">Slug URL</label>
          <input type="text" name="slug" id="majorSlug" class="form-control" placeholder="Contoh: rekayasa-perangkat-lunak (Otomatis jika dikosongkan)" style="width:100%;padding:.65rem .85rem;border-radius:10px;background:var(--navy-bg);border:1px solid rgba(255,255,255,.15);color:#fff">
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem">
          <div>
            <label style="display:block;font-size:.78rem;font-weight:700;color:var(--text-muted);margin-bottom:.4rem">Ikon FontAwesome (Class)</label>
            <input type="text" name="icon_url" id="majorIconUrl" class="form-control" placeholder="Contoh: fas fa-code" style="width:100%;padding:.65rem .85rem;border-radius:10px;background:var(--navy-bg);border:1px solid rgba(255,255,255,.15);color:#fff">
          </div>
          <div>
            <label style="display:block;font-size:.78rem;font-weight:700;color:var(--text-muted);margin-bottom:.4rem">Upload Gambar / Logo (Opsional)</label>
            <input type="file" name="image" accept="image/*" class="form-control" style="width:100%;padding:.5rem;border-radius:10px;background:var(--navy-bg);border:1px solid rgba(255,255,255,.15);color:#fff">
          </div>
        </div>

        <div style="margin-bottom:1rem">
          <label style="display:block;font-size:.78rem;font-weight:700;color:var(--text-muted);margin-bottom:.4rem">Deskripsi Singkat Jurusan</label>
          <textarea name="description" id="majorDescription" rows="3" class="form-control" placeholder="Rincian singkat mengenai konsentrasi keahlian dan keunggulan jurusan..." style="width:100%;padding:.65rem .85rem;border-radius:10px;background:var(--navy-bg);border:1px solid rgba(255,255,255,.15);color:#fff"></textarea>
        </div>

        <div style="margin-bottom:1.4rem;display:flex;align-items:center;gap:.6rem">
          <input type="checkbox" name="is_active" id="majorIsActive" value="1" checked style="width:18px;height:18px;accent-color:var(--gold);cursor:pointer">
          <label for="majorIsActive" style="font-size:.82rem;color:#fff;font-weight:700;cursor:pointer">Aktifkan Program Keahlian (Tampilkan di Website Publik)</label>
        </div>

        <div style="display:flex;justify-content:flex-end;gap:.7rem;border-top:1px solid rgba(255,255,255,.08);padding-top:1rem">
          <button type="button" class="db-btn db-btn-ghost" onclick="closeMajorModal()">Batal</button>
          <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-save"></i> Simpan Data Jurusan</button>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  function openCreateMajorModal() {
    document.getElementById('majorModalTitle').innerHTML = '<i class="fas fa-graduation-cap" style="color:var(--gold);margin-right:.5rem"></i> Tambah Program Keahlian Baru';
    document.getElementById('majorForm').action = "{{ route('admin.majors.store') }}";
    document.getElementById('majorFormMethod').innerHTML = '';
    document.getElementById('majorForm').reset();
    document.getElementById('majorIsActive').checked = true;
    document.getElementById('majorModal').style.display = 'flex';
  }

  function openEditMajorModal(item) {
    document.getElementById('majorModalTitle').innerHTML = '<i class="fas fa-pen-to-square" style="color:var(--gold);margin-right:.5rem"></i> Edit Program Keahlian (' + item.code + ')';
    document.getElementById('majorForm').action = "{{ url('/admin/majors') }}/" + item.id;
    document.getElementById('majorFormMethod').innerHTML = '@method("PUT")';
    
    document.getElementById('majorCode').value = item.code || '';
    document.getElementById('majorName').value = item.name || '';
    document.getElementById('majorSlug').value = item.slug || '';
    document.getElementById('majorIconUrl').value = item.icon_url || '';
    document.getElementById('majorDescription').value = item.description || '';
    document.getElementById('majorIsActive').checked = item.is_active ? true : false;

    document.getElementById('majorModal').style.display = 'flex';
  }

  function closeMajorModal() {
    document.getElementById('majorModal').style.display = 'none';
  }

  function deleteMajor(id, name) {
    if (confirm('Apakah Anda yakin ingin menghapus Program Keahlian "' + name + '"?')) {
      var form = document.getElementById('deleteMajorForm');
      form.action = "{{ url('/admin/majors') }}/" + id;
      form.submit();
    }
  }

  // Auto-fill slug from name if creating new
  document.getElementById('majorName').addEventListener('input', function() {
    var slugInput = document.getElementById('majorSlug');
    if (!document.getElementById('majorFormMethod').innerHTML) {
      slugInput.value = this.value.toLowerCase()
        .replace(/[^a-z0-9 -]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-');
    }
  });

  // Live Instant Search Filter for Table
  function filterMajorTable(term) {
    const filter = term.toLowerCase().trim();
    const rows = document.querySelectorAll('.db-table tbody tr');
    rows.forEach(row => {
      if (row.cells.length < 5) return;
      const text = row.textContent.toLowerCase();
      if (text.includes(filter)) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  }

  const pageSearchInput = document.getElementById('majorSearchInput');
  const globalSearchInput = document.getElementById('dbSearchGlobal');

  if (pageSearchInput) {
    pageSearchInput.addEventListener('input', function() {
      filterMajorTable(this.value);
    });
  }

  if (globalSearchInput) {
    globalSearchInput.addEventListener('input', function() {
      if (pageSearchInput) pageSearchInput.value = this.value;
      filterMajorTable(this.value);
    });
  }
</script>
@endpush
