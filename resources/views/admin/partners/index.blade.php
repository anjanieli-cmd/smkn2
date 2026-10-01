@extends('layouts.admin')

@section('title', 'Logo Partner / Mitra — Admin')

@push('styles')
  @include('admin.partials.form-kit')
@endpush

@section('content')
<div class="db-panel-head">
  <div>
    <h2><i class="fas fa-building" style="color:var(--gold);margin-right:.5rem"></i> Logo Partner / Mitra</h2>
    <p style="font-size:.8rem;color:var(--text-muted);margin-top:.25rem">Logo yang tampil di bagian "Didukung Oleh" pada footer website publik.</p>
  </div>
</div>

@include('admin.partials.flash')

<form action="{{ route('admin.partners.update') }}" method="POST" enctype="multipart/form-data" id="ptnForm">
  @csrf
  @method('PUT')

  <div class="db-panel">
    <div id="ptnList"></div>

    <button type="button" class="ad-add-btn" id="ptnAdd"><i class="fas fa-plus"></i> Tambah Logo Partner</button>
    <small class="ad-hint" style="margin-top:.8rem">
      Format PNG, JPG, WEBP, atau SVG, maksimal 4 MB. Sebaiknya logo berlatar transparan dan berbentuk melebar.
      Baris tanpa logo akan dihapus saat disimpan.
    </small>
  </div>

  <div class="ad-save-bar">
    <span><i class="fas fa-circle-info"></i> Perubahan baru tampil di footer website setelah kamu klik Simpan.</span>
    <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Logo Partner</button>
  </div>
</form>

<template id="tpl-ptn">
  <div class="ad-repeater-item" data-item>
    <div class="ad-repeater-head">
      <strong data-label="Partner">Partner</strong>
      <div class="ad-repeater-controls">
        <button type="button" class="ad-icon-mini" data-move="up" title="Naikkan"><i class="fas fa-arrow-up"></i></button>
        <button type="button" class="ad-icon-mini" data-move="down" title="Turunkan"><i class="fas fa-arrow-down"></i></button>
        <button type="button" class="ad-icon-mini danger" data-remove title="Hapus"><i class="fas fa-trash"></i></button>
      </div>
    </div>
    <div class="ad-grid-2">
      <div class="db-form-group">
        <label>Nama Partner</label>
        <input type="text" class="db-form-control" name="items[__I__][name]" placeholder="Contoh: Telkom Indonesia">
      </div>
      <div class="db-form-group">
        <label>Link Website (opsional)</label>
        <input type="text" class="db-form-control" name="items[__I__][url]" placeholder="https://...">
      </div>
    </div>
    <div class="db-form-group">
      <label>Logo *</label>
      <input type="file" class="db-form-control" name="items[__I__][logo]" accept="image/png,image/jpeg,image/webp,image/svg+xml">
      <input type="hidden" name="items[__I__][existing_logo]" value="" data-existing-logo>
      <div class="ad-logo-current" data-preview style="display:none">
        <div class="box"><img src="" alt=""></div>
        <span>Logo saat ini — pilih file baru untuk mengganti</span>
      </div>
    </div>
    <label class="ad-check-row">
      <input type="checkbox" name="items[__I__][is_active]" value="1" checked> Tampilkan di website
    </label>
  </div>
</template>
@endsection

@push('scripts')
  @php
    $seedItems = $items->map(function ($p) {
        return [
            'name' => $p->name, 'url' => $p->url, 'is_active' => $p->is_active,
            'existing_logo' => $p->logo, 'logo_url' => $p->logo_url,
        ];
    })->values();
  @endphp
  @include('admin.partials.repeater-js')
<script>
(function () {
  const rep = adSetupRepeater({
    listSelector: '#ptnList',
    templateId: 'tpl-ptn',
    onFill(node, data) {
      if (!data.existing_logo) return;
      node.querySelector('[data-existing-logo]').value = data.existing_logo;
      const preview = node.querySelector('[data-preview]');
      preview.style.display = 'flex';
      preview.querySelector('img').src = data.logo_url;
    },
  });
  document.getElementById('ptnAdd').addEventListener('click', () => rep.addItem());

  const seed = @json($seedItems);

  if (seed.length) seed.forEach(row => rep.addItem(row));
  else rep.addItem();
})();
</script>
@endpush
