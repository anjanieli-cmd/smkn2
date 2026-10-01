@extends('layouts.admin')

@section('title', 'Announcement Bar — Admin')

@push('styles')
  @include('admin.partials.form-kit')
@endpush

@section('content')
<div class="db-panel-head">
  <div>
    <h2><i class="fas fa-bullhorn" style="color:var(--gold);margin-right:.5rem"></i> Announcement Bar</h2>
    <p style="font-size:.8rem;color:var(--text-muted);margin-top:.25rem">Teks berjalan di bagian paling atas website publik. Atur isi, urutan, dan mana yang ditampilkan.</p>
  </div>
</div>

@include('admin.partials.flash')

<form action="{{ route('admin.announcement.update') }}" method="POST" id="annForm">
  @csrf
  @method('PUT')

  <div class="db-panel">
    <div id="annList"></div>

    <button type="button" class="ad-add-btn" id="annAdd"><i class="fas fa-plus"></i> Tambah Pengumuman</button>
    <small class="ad-hint" style="margin-top:.8rem">
      Ikon memakai nama FontAwesome, misalnya <code>fa-bullhorn</code>, <code>fa-trophy</code>, <code>fa-calendar</code>, <code>fa-star</code>.
      Cari ikon lain di <a href="https://fontawesome.com/search?o=r&m=free" target="_blank" rel="noopener">fontawesome.com/icons</a>.
      Baris yang teksnya kosong akan dihapus saat disimpan. Kalau tidak ada pengumuman aktif, bar tidak ditampilkan di website.
    </small>
  </div>

  <div class="ad-save-bar">
    <span><i class="fas fa-circle-info"></i> Perubahan baru tampil di website setelah kamu klik Simpan.</span>
    <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Pengumuman</button>
  </div>
</form>

<template id="tpl-ann">
  <div class="ad-repeater-item" data-item>
    <div class="ad-repeater-head">
      <strong data-label="Pengumuman">Pengumuman</strong>
      <div class="ad-repeater-controls">
        <button type="button" class="ad-icon-mini" data-move="up" title="Naikkan"><i class="fas fa-arrow-up"></i></button>
        <button type="button" class="ad-icon-mini" data-move="down" title="Turunkan"><i class="fas fa-arrow-down"></i></button>
        <button type="button" class="ad-icon-mini danger" data-remove title="Hapus"><i class="fas fa-trash"></i></button>
      </div>
    </div>
    <div style="display:grid;grid-template-columns:170px 1fr;gap:1.1rem">
      <div class="db-form-group">
        <label>Ikon</label>
        <input type="text" class="db-form-control" name="items[__I__][icon]" placeholder="fa-bullhorn">
      </div>
      <div class="db-form-group">
        <label>Teks Pengumuman *</label>
        <input type="text" class="db-form-control" name="items[__I__][text]" maxlength="255" placeholder="PPDB 2026/2027 Dibuka — Daftar Sekarang!">
      </div>
    </div>
    <div class="db-form-group">
      <label>Link (opsional)</label>
      <input type="text" class="db-form-control" name="items[__I__][url]" placeholder="/ppdb atau https://...">
    </div>
    <label class="ad-check-row">
      <input type="checkbox" name="items[__I__][is_active]" value="1" checked> Tampilkan di website
    </label>
  </div>
</template>
@endsection

@push('scripts')
  @php
    $seedItems = $items->map(function ($a) {
        return ['icon' => $a->icon, 'text' => $a->text, 'url' => $a->url, 'is_active' => $a->is_active];
    })->values();
  @endphp
  @include('admin.partials.repeater-js')
<script>
(function () {
  const rep = adSetupRepeater({ listSelector: '#annList', templateId: 'tpl-ann' });
  document.getElementById('annAdd').addEventListener('click', () => rep.addItem());

  const seed = @json($seedItems);

  if (seed.length) seed.forEach(row => rep.addItem(row));
  else rep.addItem();
})();
</script>
@endpush
