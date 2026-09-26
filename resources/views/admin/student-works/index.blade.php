@extends('layouts.admin')

@section('title', 'Manajemen Karya Siswa — SMK Negeri 2 Mojokerto')

@section('content')
  <div class="db-panel">
    <div class="db-panel-head">
      <div>
        <h2>Karya &amp; Inovasi Siswa</h2>
        <p style="font-size:.78rem;color:var(--text-muted);margin-top:.2rem">Tampilkan portofolio, karya aplikasi, desain, &amp; hasil praktek siswa SKANEDA.</p>
      </div>
      <div class="db-panel-actions">
        <button class="db-btn db-btn-gold" onclick="openCreateModal()"><i class="fas fa-plus"></i> Tambah Karya Siswa</button>
      </div>
    </div>

    <!-- TABLE -->
    <div class="db-table-wrap">
      <table class="db-table">
        <thead>
          <tr>
            <th>Gambar</th>
            <th>Judul Karya</th>
            <th>Nama Siswa / Pembuat</th>
            <th>Jurusan</th>
            <th>Deskripsi</th>
            <th style="text-align:right">Aksi</th>
          </tr>
        </thead>
        <tbody id="workTableBody">
          @forelse($items as $item)
            <tr>
              <td style="width:60px">
                @if($item->image_url)
                  <img src="{{ asset($item->image_url) }}" alt="" style="width:40px;height:40px;border-radius:10px;object-fit:cover">
                @else
                  <div style="width:40px;height:40px;border-radius:10px;background:rgba(255,179,0,.15);color:var(--gold);display:flex;align-items:center;justify-content:center"><i class="fas fa-palette"></i></div>
                @endif
              </td>
              <td><strong>{{ $item->title }}</strong></td>
              <td><span style="font-size:.78rem;color:var(--gold-light)">{{ $item->student_name }}</span></td>
              <td><span style="font-size:.78rem;color:var(--text-muted)">{{ $item->major->code ?? '-' }}</span></td>
              <td><span style="font-size:.78rem;color:rgba(255,255,255,.8)">{{ Str::limit($item->description, 50) }}</span></td>
              <td style="text-align:right">
                <button class="db-btn db-btn-ghost" style="padding:.35rem .65rem;font-size:.75rem" onclick="openEditModal({{ json_encode($item) }})"><i class="fas fa-pen-to-square"></i> Edit</button>
                <button class="db-btn db-btn-danger" style="padding:.35rem .65rem;font-size:.75rem" onclick="deleteWork('{{ $item->id }}')"><i class="fas fa-trash"></i> Hapus</button>
              </td>
            </tr>
          @empty
            <tr><td colspan="6" style="text-align:center;color:var(--text-muted);padding:2rem">Belum ada data karya siswa.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- MODAL CREATE / EDIT -->
  <div class="db-modal-overlay" id="workModal">
    <div class="db-modal">
      <div class="db-modal-head">
        <h3 id="modalTitle">Tambah Karya Siswa Baru</h3>
        <button class="db-modal-close" onclick="closeModal()">&times;</button>
      </div>
      <div class="db-modal-body">
        <form id="workForm" onsubmit="saveWork(event)">
          <input type="hidden" id="workId">

          <div class="db-form-group">
            <label>Judul Karya *</label>
            <input type="text" id="workTitle" class="db-form-control" placeholder="Contoh: Aplikasi Smart System SMKN 2" required>
          </div>

          <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            <div class="db-form-group">
              <label>Nama Siswa Pembuat *</label>
              <input type="text" id="studentName" class="db-form-control" placeholder="Contoh: Ahmad Rizky XI RPL" required>
            </div>
            <div class="db-form-group">
              <label>Jurusan</label>
              <select id="workMajorId" class="db-form-control">
                @foreach(\App\Models\Major::all() as $m)
                  <option value="{{ $m->id }}">{{ $m->name }} ({{ $m->code }})</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="db-form-group">
            <label>Image / Banner URL Path</label>
            <input type="text" id="workImage" class="db-form-control" placeholder="images/karya/smart-app.jpg">
          </div>

          <div class="db-form-group">
            <label>Deskripsi Karya *</label>
            <textarea id="workDescription" class="db-form-control" placeholder="Penjelasan fitur, konsep &amp; keunggulan karya..." required></textarea>
          </div>

          <div style="display:flex;justify-content:flex-end;gap:.75rem;margin-top:1.5rem">
            <button type="button" class="db-btn db-btn-ghost" onclick="closeModal()">Batal</button>
            <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Karya</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  function openCreateModal() {
    document.getElementById('modalTitle').textContent = 'Tambah Karya Siswa Baru';
    document.getElementById('workId').value = '';
    document.getElementById('workTitle').value = '';
    document.getElementById('studentName').value = '';
    document.getElementById('workImage').value = '';
    document.getElementById('workDescription').value = '';
    document.getElementById('workModal').classList.add('active');
  }

  function openEditModal(item) {
    document.getElementById('modalTitle').textContent = 'Edit Karya Siswa';
    document.getElementById('workId').value = item.id;
    document.getElementById('workTitle').value = item.title;
    document.getElementById('studentName').value = item.student_name;
    document.getElementById('workMajorId').value = item.major_id || '';
    document.getElementById('workImage').value = item.image_url || '';
    document.getElementById('workDescription').value = item.description || '';
    document.getElementById('workModal').classList.add('active');
  }

  function closeModal() {
    document.getElementById('workModal').classList.remove('active');
  }

  async function saveWork(e) {
    e.preventDefault();
    const id = document.getElementById('workId').value;
    const payload = {
      title: document.getElementById('workTitle').value,
      student_name: document.getElementById('studentName').value,
      major_id: document.getElementById('workMajorId').value,
      image_url: document.getElementById('workImage').value,
      description: document.getElementById('workDescription').value
    };

    const url = id ? `/api/admin/student-works/${id}` : '/api/admin/student-works';
    const method = id ? 'PUT' : 'POST';

    try {
      const res = await fetch(url, {
        method: method,
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        },
        body: JSON.stringify(payload)
      });
      const data = await res.json();
      if (res.ok && data.success) {
        showToast(id ? 'Karya berhasil diperbarui!' : 'Karya baru berhasil ditambahkan!');
        closeModal();
        setTimeout(() => location.reload(), 800);
      } else {
        showToast(data.message || 'Gagal menyimpan karya.', 'error');
      }
    } catch (err) {
      showToast('Terjadi kesalahan koneksi server.', 'error');
    }
  }

  async function deleteWork(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus data karya ini?')) return;
    try {
      const res = await fetch(`/api/admin/student-works/${id}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        }
      });
      const data = await res.json();
      if (res.ok && data.success) {
        showToast('Karya berhasil dihapus!');
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
