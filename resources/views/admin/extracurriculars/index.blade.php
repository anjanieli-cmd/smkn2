@extends('layouts.admin')

@section('title', 'Manajemen Ekstrakurikuler — SMK Negeri 2 Mojokerto')

@section('content')
  <div class="db-panel">
    <div class="db-panel-head">
      <div>
        <h2>Ekstrakurikuler &amp; Organisasi Siswa</h2>
        <p style="font-size:.78rem;color:var(--text-muted);margin-top:.2rem">Kelola kegiatan ekstrakurikuler &amp; organisasi siswa SMKN 2 Mojokerto.</p>
      </div>
      <div class="db-panel-actions">
        <button class="db-btn db-btn-gold" onclick="openCreateModal()"><i class="fas fa-plus"></i> Tambah Ekskul Baru</button>
      </div>
    </div>

    <!-- TABLE -->
    <div class="db-table-wrap">
      <table class="db-table">
        <thead>
          <tr>
            <th>Foto</th>
            <th>Nama Ekskul / Organisasi</th>
            <th>Kategori</th>
            <th>Pembina</th>
            <th>Jadwal</th>
            <th>Deskripsi</th>
            <th style="text-align:right">Aksi</th>
          </tr>
        </thead>
        <tbody id="extraTableBody">
          @forelse($items as $item)
            <tr>
              <td style="width:60px">
                @if($item->image_url)
                  <img src="{{ asset($item->image_url) }}" alt="{{ $item->name }}" style="width:44px;height:44px;object-fit:cover;border-radius:8px;border:1px solid rgba(255,255,255,.1)">
                @else
                  <div style="width:44px;height:44px;border-radius:8px;background:rgba(255,255,255,.05);display:flex;align-items:center;justify-content:center;color:var(--text-muted);font-size:.8rem"><i class="fas fa-icons"></i></div>
                @endif
              </td>
              <td><strong style="color:var(--gold-light)">{{ $item->name }}</strong></td>
              <td><span class="db-tag REVIEWING">{{ $item->category }}</span></td>
              <td><span style="font-size:.78rem;color:rgba(255,255,255,.85)">{{ $item->coach_name ?: '-' }}</span></td>
              <td><span style="font-size:.78rem;color:var(--gold-light)">{{ $item->attributes['schedule'] ?? '-' }}</span></td>
              <td><span style="font-size:.78rem;color:rgba(255,255,255,.8)">{{ Str::limit($item->description, 50) }}</span></td>
              <td style="text-align:right">
                <button class="db-btn db-btn-ghost" style="padding:.35rem .65rem;font-size:.75rem" onclick='openEditModal(@json($item))'><i class="fas fa-pen-to-square"></i> Edit</button>
                <button class="db-btn db-btn-danger" style="padding:.35rem .65rem;font-size:.75rem" onclick="deleteExtra('{{ $item->id }}')"><i class="fas fa-trash"></i> Hapus</button>
              </td>
            </tr>
          @empty
            <tr><td colspan="7" style="text-align:center;color:var(--text-muted);padding:2rem">Belum ada data Ekstrakurikuler.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- MODAL CREATE / EDIT -->
  <div class="db-modal-overlay" id="extraModal">
    <div class="db-modal" style="max-width:600px">
      <div class="db-modal-head">
        <h3 id="modalTitle">Tambah Ekstrakurikuler Baru</h3>
        <button class="db-modal-close" onclick="closeModal()">&times;</button>
      </div>
      <div class="db-modal-body">
        <form id="extraForm" onsubmit="saveExtra(event)">
          <input type="hidden" id="extraId">

          <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            <div class="db-form-group">
              <label>Nama Ekskul / Organisasi *</label>
              <input type="text" id="extraName" class="db-form-control" placeholder="Contoh: Robotik & Coding Club" required>
            </div>

            <div class="db-form-group">
              <label>Kategori *</label>
              <select id="extraCategory" class="db-form-control">
                <option value="Teknologi">Teknologi</option>
                <option value="Olahraga">Olahraga</option>
                <option value="Seni & Budaya">Seni &amp; Budaya</option>
                <option value="Keagamaan">Keagamaan</option>
                <option value="Kedisiplinan">Kedisiplinan</option>
                <option value="Kepanduan">Kepanduan</option>
                <option value="Kesehatan">Kesehatan</option>
                <option value="Media & Literasi">Media &amp; Literasi</option>
                <option value="Bela Diri">Bela Diri</option>
                <option value="Organisasi">Organisasi</option>
              </select>
            </div>
          </div>

          <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-top:.75rem">
            <div class="db-form-group">
              <label>Nama Pembina / Pelatih</label>
              <input type="text" id="extraCoach" class="db-form-control" placeholder="Contoh: Pembina Olahraga Sekolah">
            </div>

            <div class="db-form-group">
              <label>Jadwal Latihan / Pertemuan</label>
              <input type="text" id="extraSchedule" class="db-form-control" placeholder="Contoh: Setiap Hari Jumat / Selasa &amp; Kamis">
            </div>
          </div>

          <div class="db-form-group" style="margin-top:.75rem">
            <label>Kegiatan Utama (Dipisahkan Koma)</label>
            <input type="text" id="extraActivities" class="db-form-control" placeholder="Contoh: Latihan vokal, rebana, pementasan sekolah">
          </div>

          <div class="db-form-group" style="margin-top:.75rem">
            <label>Deskripsi *</label>
            <textarea id="extraDescription" class="db-form-control" rows="3" placeholder="Penjelasan singkat mengenai tujuan &amp; aktivitas..." required></textarea>
          </div>

          <div class="db-form-group" style="margin-top:.75rem">
            <label>Foto / Logo Ekskul</label>
            <input type="file" id="extraImageFile" class="db-form-control" accept="image/*" onchange="previewExtraImage(this)">
            <input type="hidden" id="extraImageUrl">
            <div id="extraImgPreviewWrap" style="margin-top:.5rem;display:none">
              <img id="extraImgPreview" src="" alt="Preview" style="max-height:100px;border-radius:8px;border:1px solid rgba(255,255,255,.2)">
            </div>
          </div>

          <div style="display:flex;justify-content:flex-end;gap:.75rem;margin-top:1.5rem">
            <button type="button" class="db-btn db-btn-ghost" onclick="closeModal()">Batal</button>
            <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Data</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  function openCreateModal() {
    document.getElementById('modalTitle').textContent = 'Tambah Ekstrakurikuler Baru';
    document.getElementById('extraId').value = '';
    document.getElementById('extraName').value = '';
    document.getElementById('extraCategory').value = 'Teknologi';
    document.getElementById('extraCoach').value = '';
    document.getElementById('extraSchedule').value = '';
    document.getElementById('extraActivities').value = '';
    document.getElementById('extraDescription').value = '';
    document.getElementById('extraImageFile').value = '';
    document.getElementById('extraImageUrl').value = '';
    document.getElementById('extraImgPreviewWrap').style.display = 'none';
    document.getElementById('extraModal').classList.add('active');
  }

  function openEditModal(item) {
    document.getElementById('modalTitle').textContent = 'Edit Data Ekstrakurikuler';
    document.getElementById('extraId').value = item.id;
    document.getElementById('extraName').value = item.name || '';
    document.getElementById('extraCategory').value = item.category || 'Teknologi';
    document.getElementById('extraCoach').value = item.coach_name || '';
    const attrs = item.attributes || {};
    document.getElementById('extraSchedule').value = attrs.schedule || '';
    document.getElementById('extraActivities').value = attrs.activities || '';
    document.getElementById('extraDescription').value = item.description || '';
    document.getElementById('extraImageFile').value = '';
    document.getElementById('extraImageUrl').value = item.image_url || '';
    
    if (item.image_url) {
      document.getElementById('extraImgPreview').src = '{{ asset("") }}' + item.image_url;
      document.getElementById('extraImgPreviewWrap').style.display = 'block';
    } else {
      document.getElementById('extraImgPreviewWrap').style.display = 'none';
    }
    
    document.getElementById('extraModal').classList.add('active');
  }

  function closeModal() {
    document.getElementById('extraModal').classList.remove('active');
  }

  function previewExtraImage(input) {
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById('extraImgPreview').src = e.target.result;
        document.getElementById('extraImgPreviewWrap').style.display = 'block';
      };
      reader.readAsDataURL(input.files[0]);
    }
  }

  async function saveExtra(e) {
    e.preventDefault();
    const id = document.getElementById('extraId').value;
    const fileInput = document.getElementById('extraImageFile');
    
    const formData = new FormData();
    formData.append('name', document.getElementById('extraName').value);
    formData.append('category', document.getElementById('extraCategory').value);
    formData.append('coach_name', document.getElementById('extraCoach').value);
    formData.append('schedule', document.getElementById('extraSchedule').value);
    formData.append('activities', document.getElementById('extraActivities').value);
    formData.append('description', document.getElementById('extraDescription').value);
    
    if (fileInput.files && fileInput.files[0]) {
      formData.append('image_file', fileInput.files[0]);
    } else if (document.getElementById('extraImageUrl').value) {
      formData.append('image_url', document.getElementById('extraImageUrl').value);
    }

    let url = id ? `/api/admin/extracurriculars/${id}` : '/api/admin/extracurriculars';
    if (id) {
      formData.append('_method', 'PUT');
    }

    try {
      const res = await fetch(url, {
        method: 'POST', // Use POST with _method=PUT for multipart FormData in Laravel
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        },
        body: formData
      });
      const data = await res.json();
      if (res.ok && data.success) {
        showToast(id ? 'Ekskul berhasil diperbarui!' : 'Ekskul baru berhasil ditambahkan!');
        closeModal();
        setTimeout(() => location.reload(), 800);
      } else {
        showToast(data.message || 'Gagal menyimpan data.', 'error');
      }
    } catch (err) {
      showToast('Terjadi kesalahan koneksi server.', 'error');
    }
  }

  async function deleteExtra(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus data ekstrakurikuler ini?')) return;
    try {
      const res = await fetch(`/api/admin/extracurriculars/${id}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        }
      });
      const data = await res.json();
      if (res.ok && data.success) {
        showToast('Ekskul berhasil dihapus!');
        setTimeout(() => location.reload(), 800);
      } else {
        showToast(data.message || 'Gagal menghapus data.', 'error');
      }
    } catch (err) {
      showToast('Terjadi kesalahan koneksi server.', 'error');
    }
  }
</script>
@endpush
