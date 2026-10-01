@extends('layouts.admin')

@section('title', 'Edit School FactCheck — ' . $item->title . ' — SMK Negeri 2 Mojokerto')

@section('content')
<div style="max-width:820px;margin:0 auto">
  <!-- HEADER MATCHING SCHOOL-HISTORY PATTERN -->
  <div class="db-panel-head">
    <div>
      <h2><i class="fas fa-pen-to-square" style="color:var(--gold);margin-right:.5rem"></i> Edit School FactCheck: {{ $item->title }}</h2>
      <p style="font-size:.8rem;color:var(--text-muted);margin-top:.25rem">Perbarui informasi klaim, status hasil verifikasi, atau klarifikasi resmi sekolah.</p>
    </div>
    <div class="db-panel-actions">
      <a href="{{ route('admin.fact-checks.index') }}" class="db-btn db-btn-ghost">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar
      </a>
    </div>
  </div>

  @php
    $currentStatus = is_object($item->status) ? $item->status->value : $item->status;
  @endphp

  <div class="db-panel" style="padding:1.8rem">
    <form id="editFactForm" onsubmit="updateFactCheck(event)">
      <input type="hidden" id="factId" value="{{ $item->id }}">
      
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.2rem">
        <div class="db-form-group">
          <label><i class="fas fa-heading" style="color:var(--gold)"></i> Judul Klarifikasi *</label>
          <input type="text" id="title" class="db-form-control" value="{{ $item->title }}" required>
        </div>

        <div class="db-form-group">
          <label><i class="fas fa-shield-cat" style="color:var(--gold)"></i> Status Hasil Verifikasi *</label>
          <select id="status" class="db-form-control">
            <option value="FALSE" {{ $currentStatus === 'FALSE' ? 'selected' : '' }}>FALSE (Informasi Tidak Benar / Hoaks)</option>
            <option value="VERIFIED" {{ $currentStatus === 'VERIFIED' ? 'selected' : '' }}>VERIFIED (Informasi Benar / Fakta Resmi)</option>
            <option value="UNCONFIRMED" {{ $currentStatus === 'UNCONFIRMED' ? 'selected' : '' }}>UNCONFIRMED (Informasi Belum Terkonfirmasi)</option>
          </select>
        </div>
      </div>

      <div class="db-form-group" style="margin-top:1rem">
        <label><i class="fas fa-link" style="color:var(--gold)"></i> URL Sumber Berita / Rujukan (Opsional)</label>
        <input type="url" id="source_url" class="db-form-control" value="{{ $item->source_url }}">
      </div>

      <div class="db-form-group" style="margin-top:1rem">
        <label><i class="fas fa-quote-left" style="color:var(--gold)"></i> Isu / Klaim Hoaks yang Beredar *</label>
        <textarea id="claim" class="db-form-control" rows="4" required>{{ $item->claim }}</textarea>
      </div>

      <div class="db-form-group" style="margin-top:1rem">
        <label><i class="fas fa-file-contract" style="color:var(--gold)"></i> Penjelasan Verifikasi Resmi Sekolah *</label>
        <textarea id="verdict_explanation" class="db-form-control" rows="4" required>{{ $item->verdict_explanation }}</textarea>
      </div>

      <div style="display:flex;justify-content:flex-end;gap:.8rem;margin-top:2rem;padding-top:1.2rem;border-top:1px solid rgba(255,255,255,.08)">
        <a href="{{ route('admin.fact-checks.index') }}" class="db-btn db-btn-ghost">Batal</a>
        <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Perubahan</button>
      </div>

    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
  async function updateFactCheck(e) {
    e.preventDefault();
    const id = document.getElementById('factId').value;

    const payload = {
      title: document.getElementById('title').value,
      status: document.getElementById('status').value,
      source_url: document.getElementById('source_url').value || null,
      claim: document.getElementById('claim').value,
      verdict_explanation: document.getElementById('verdict_explanation').value
    };

    try {
      const res = await fetch(`/api/admin/fact-check/${id}`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        },
        body: JSON.stringify(payload)
      });
      const data = await res.json();
      if (res.ok && data.success) {
        showToast('Data FactCheck berhasil diperbarui!');
        setTimeout(() => window.location.href = "{{ route('admin.fact-checks.index') }}", 800);
      } else {
        showToast(data.message || 'Gagal menyimpan data.', 'error');
      }
    } catch (err) {
      showToast('Terjadi kesalahan koneksi server.', 'error');
    }
  }
</script>
@endpush
