@extends('layouts.admin')

@section('title', 'Kelola & Balas Aspirasi #' . $item->ticket_code . ' — SMK Negeri 2 Mojokerto')

@push('styles')
<style>
  .evoice-detail-box {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 14px;
    padding: 1.2rem;
    margin-bottom: 1.5rem;
  }
  .quick-reply-btn {
    padding: 0.35rem 0.7rem;
    border-radius: 8px;
    background: rgba(255, 179, 0, 0.12);
    border: 1px solid rgba(255, 179, 0, 0.25);
    color: var(--gold-light);
    font-size: 0.72rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s ease;
    margin-right: 0.4rem;
    margin-bottom: 0.4rem;
  }
  .quick-reply-btn:hover {
    background: var(--gold);
    color: var(--navy-bg);
  }
</style>
@endpush

@section('content')
<div style="max-width:820px;margin:0 auto">
  <!-- HEADER MATCHING SCHOOL-HISTORY PATTERN -->
  <div class="db-panel-head">
    <div>
      <h2><i class="fas fa-comment-dots" style="color:var(--gold);margin-right:.5rem"></i> Kelola &amp; Balas Aspirasi #{{ $item->ticket_code }}</h2>
      <p style="font-size:.8rem;color:var(--text-muted);margin-top:.25rem">Tanggapi laporan siswa, perbarui status penanganan, dan sampaikan hasil resmi sekolah.</p>
    </div>
    <div class="db-panel-actions">
      <a href="{{ route('admin.e-voices.index') }}" class="db-btn db-btn-ghost">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar
      </a>
    </div>
  </div>

  @php
    $currentStatus = is_object($item->status) ? $item->status->value : $item->status;
    $categoryName = is_object($item->category) ? $item->category->value : ($item->category ?? 'ASPIRASI');
  @endphp

  <!-- RINCIAN ASPIRASI SISWA -->
  <div class="evoice-detail-box">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.6rem;flex-wrap:wrap;gap:.5rem">
      <div style="display:flex;align-items:center;gap:.5rem">
        <span style="font-family:monospace;font-weight:800;color:var(--gold-light);font-size:.95rem">#{{ $item->ticket_code }}</span>
        <span style="font-size:.75rem;padding:.2rem .6rem;border-radius:999px;background:rgba(255,255,255,.06);color:rgba(255,255,255,.85)">
          <i class="fas fa-tag" style="color:var(--gold);margin-right:.25rem"></i> {{ $categoryName }}
        </span>
      </div>
      <span style="font-size:.8rem;color:var(--gold);font-weight:700"><i class="fas fa-thumbs-up"></i> {{ $item->upvotes_count }} Upvotes</span>
    </div>
    <h4 style="font-size:1rem;color:#fff;margin-bottom:.5rem">{{ $item->title }}</h4>
    <p style="font-size:.84rem;color:var(--text-muted);line-height:1.6;margin:0">{{ $item->description }}</p>
  </div>

  <div class="db-panel" style="padding:1.8rem">
    <form id="editEVoiceForm" onsubmit="updateEVoice(event)">
      <input type="hidden" id="evoiceId" value="{{ $item->id }}">
      
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.2rem">
        <div class="db-form-group">
          <label><i class="fas fa-heading" style="color:var(--gold)"></i> Judul Aspirasi *</label>
          <input type="text" id="title" class="db-form-control" value="{{ $item->title }}" required>
        </div>

        <div class="db-form-group">
          <label><i class="fas fa-bars-staggered" style="color:var(--gold)"></i> Status Penanganan *</label>
          <select id="status" class="db-form-control">
            <option value="SUBMITTED" {{ $currentStatus === 'SUBMITTED' ? 'selected' : '' }}>SUBMITTED (Baru Masuk)</option>
            <option value="REVIEWING" {{ $currentStatus === 'REVIEWING' ? 'selected' : '' }}>REVIEWING (Ditinjau Admin)</option>
            <option value="IN_PROGRESS" {{ $currentStatus === 'IN_PROGRESS' ? 'selected' : '' }}>IN_PROGRESS (Sedang Diproses)</option>
            <option value="RESOLVED" {{ $currentStatus === 'RESOLVED' ? 'selected' : '' }}>RESOLVED (Selesai Ditindaklanjuti)</option>
          </select>
        </div>
      </div>

      <div class="db-form-group" style="margin-top:1rem">
        <label><i class="fas fa-reply-all" style="color:var(--gold)"></i> Tanggapan / Balasan Resmi Sekolah (Tampil di Website Publik)</label>
        
        <div style="margin-bottom:.5rem;margin-top:.3rem">
          <span style="font-size:.72rem;color:var(--text-muted);display:block;margin-bottom:.3rem">Template Balasan Cepat:</span>
          <button type="button" class="quick-reply-btn" onclick="applyTemplate(1)">1. Terima Kasih &amp; Peninjauan</button>
          <button type="button" class="quick-reply-btn" onclick="applyTemplate(2)">2. Sedang Diproses Tim Sarana</button>
          <button type="button" class="quick-reply-btn" onclick="applyTemplate(3)">3. Selesai Ditindaklanjuti</button>
        </div>

        <textarea id="admin_response" class="db-form-control" rows="4" placeholder="Tuliskan balasan resmi sekolah...">{{ $item->admin_response }}</textarea>
      </div>

      <div style="display:flex;justify-content:flex-end;gap:.8rem;margin-top:2rem;padding-top:1.2rem;border-top:1px solid rgba(255,255,255,.08)">
        <a href="{{ route('admin.e-voices.index') }}" class="db-btn db-btn-ghost">Batal</a>
        <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-paper-plane"></i> Simpan Balasan &amp; Status</button>
      </div>

    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
  function applyTemplate(type) {
    const responseField = document.getElementById('admin_response');
    const statusField = document.getElementById('status');
    if (type === 1) {
      responseField.value = "Halo! 👋 Terima kasih atas masukan yang disampaikan. Laporan aspirasi Anda telah kami terima dan saat ini sedang ditinjau oleh pihak manajemen sekolah.";
      statusField.value = 'REVIEWING';
    } else if (type === 2) {
      responseField.value = "Terima kasih atas laporan Anda. Aspirasi ini sedang dalam proses tindak lanjut oleh tim penanggung jawab unit terkait.";
      statusField.value = 'IN_PROGRESS';
    } else if (type === 3) {
      responseField.value = "Terima kasih banyak atas perhatian dan kepedulian Anda. Laporan ini telah selesai ditindaklanjuti dan diselesaikan oleh pihak sekolah. 😊";
      statusField.value = 'RESOLVED';
    }
  }

  async function updateEVoice(e) {
    e.preventDefault();
    const id = document.getElementById('evoiceId').value;

    const payload = {
      status: document.getElementById('status').value,
      admin_response: document.getElementById('admin_response').value || null
    };

    try {
      const res = await fetch(`/api/admin/e-voice/${id}/status`, {
        method: 'PATCH',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        },
        body: JSON.stringify(payload)
      });
      const data = await res.json();
      if (res.ok && data.success) {
        showToast('Balasan & Status E-Voice berhasil diperbarui!');
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
