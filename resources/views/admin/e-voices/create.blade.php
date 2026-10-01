@extends('layouts.admin')

@section('title', 'Tambah Aspirasi E-Voice — SMK Negeri 2 Mojokerto')

@section('content')
<div style="max-width:820px;margin:0 auto">
  <!-- HEADER MATCHING SCHOOL-HISTORY PATTERN -->
  <div class="db-panel-head">
    <div>
      <h2><i class="fas fa-comments" style="color:var(--gold);margin-right:.5rem"></i> Buat Aspirasi / Pengaduan E-Voice Baru</h2>
      <p style="font-size:.8rem;color:var(--text-muted);margin-top:.25rem">Formulir penginputan aspirasi siswa atau laporan internal sekolah secara manual.</p>
    </div>
    <div class="db-panel-actions">
      <a href="{{ route('admin.e-voices.index') }}" class="db-btn db-btn-ghost">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar
      </a>
    </div>
  </div>

  <div class="db-panel" style="padding:1.8rem">
    <form id="createEVoiceForm" onsubmit="saveEVoice(event)">
      
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.2rem">
        <div class="db-form-group">
          <label><i class="fas fa-heading" style="color:var(--gold)"></i> Judul Aspirasi / Keluhan *</label>
          <input type="text" id="title" class="db-form-control" placeholder="Contoh: Usulan Penambahan Rak Buku Perpustakaan" required>
        </div>

        <div class="db-form-group">
          <label><i class="fas fa-tags" style="color:var(--gold)"></i> Kategori Aspirasi *</label>
          <select id="category" class="db-form-control">
            <option value="ASPIRASI">Aspirasi Umum</option>
            <option value="Fasilitas">Fasilitas &amp; Sarana Sekolah</option>
            <option value="Akademik">Akademik &amp; KBM</option>
            <option value="Kedisiplinan">Kedisiplinan &amp; Tata Tertib</option>
            <option value="Perundungan">Perundungan (Anti-Bullying)</option>
            <option value="Layanan Sekolah">Layanan Administrasi</option>
            <option value="Lainnya">Lainnya</option>
          </select>
        </div>
      </div>

      <div class="db-form-group" style="margin-top:1rem">
        <label><i class="fas fa-bars-staggered" style="color:var(--gold)"></i> Status Penanganan (Pipeline) *</label>
        <select id="status" class="db-form-control">
          <option value="SUBMITTED">SUBMITTED (Baru Masuk)</option>
          <option value="REVIEWING" selected>REVIEWING (Ditinjau)</option>
          <option value="IN_PROGRESS">IN_PROGRESS (Diproses)</option>
          <option value="RESOLVED">RESOLVED (Selesai Ditindaklanjuti)</option>
        </select>
      </div>

      <div class="db-form-group" style="margin-top:1rem">
        <label><i class="fas fa-align-left" style="color:var(--gold)"></i> Rincian Deskripsi Aspirasi *</label>
        <textarea id="description" class="db-form-control" rows="4" placeholder="Tuliskan rincian aspirasi, ide, atau pengaduan secara lengkap..." required></textarea>
      </div>

      <div class="db-form-group" style="margin-top:1rem">
        <label><i class="fas fa-reply-all" style="color:var(--gold)"></i> Tanggapan / Balasan Resmi Sekolah (Opsional)</label>
        <textarea id="admin_response" class="db-form-control" rows="3" placeholder="Tuliskan jawaban resmi sekolah apabila sudah ada tanggapan..."></textarea>
      </div>

      <div style="display:flex;justify-content:flex-end;gap:.8rem;margin-top:2rem;padding-top:1.2rem;border-top:1px solid rgba(255,255,255,.08)">
        <a href="{{ route('admin.e-voices.index') }}" class="db-btn db-btn-ghost">Batal</a>
        <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Aspirasi</button>
      </div>

    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
  async function saveEVoice(e) {
    e.preventDefault();

    const payload = {
      title: document.getElementById('title').value,
      category: document.getElementById('category').value,
      status: document.getElementById('status').value,
      description: document.getElementById('description').value,
      admin_response: document.getElementById('admin_response').value || null
    };

    try {
      const res = await fetch('/api/admin/e-voice', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        },
        body: JSON.stringify(payload)
      });
      const data = await res.json();
      if (res.ok && data.success) {
        showToast('Aspirasi baru berhasil ditambahkan!');
        setTimeout(() => window.location.href = "{{ route('admin.e-voices.index') }}", 800);
      } else {
        showToast(data.message || 'Gagal menyimpan data.', 'error');
      }
    } catch (err) {
      showToast('Terjadi kesalahan koneksi server.', 'error');
    }
  }
</script>
@endpush
