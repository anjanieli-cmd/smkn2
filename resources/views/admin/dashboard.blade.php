@extends('layouts.app')

@section('title', 'Dashboard Admin — Validasi E-Voice & School FactCheck | SMK Negeri 2 Mojokerto')
@section('description', 'Panel resmi admin SMK Negeri 2 Mojokerto untuk memvalidasi pengaduan E-Voice, memberikan balasan resmi, serta memverifikasi informasi hoaks di School FactCheck.')

@push('styles')
<style>
/* =========================================================
   ADMIN DASHBOARD — SMKN 2 MOJOKERTO
   Desain presisi, cepat, dan responsif mengikuti identitas situs:
   navy #0d3a66, gold #ffd54a/#ffb300, cyan #0ea5b7, font-display.
   ========================================================= */
.adm-page { background: #f4f8fc; color: #0d3a66; min-height: 80vh; position: relative; overflow: hidden; }
.adm-page * { box-sizing: border-box; }
.adm-wrap { width: min(1440px, 94%); margin: 0 auto; padding: 40px 0 100px; position: relative; z-index: 2; }

/* ---------- hero header ---------- */
.adm-hero {
  position: relative; margin-bottom: 2rem; padding: clamp(1.8rem, 3.5vw, 2.5rem);
  border-radius: 24px; overflow: hidden; z-index: 3;
  background: linear-gradient(120deg, #082846 0%, #0d3a66 50%, #0a3155 100%); color: #fff;
  box-shadow: 0 24px 50px rgba(8, 40, 70, 0.32);
}
.adm-hero::before {
  content: ""; position: absolute; inset: 0; pointer-events: none; z-index: 0; opacity: .5;
  background-image: radial-gradient(rgba(255, 255, 255, .1) 1.2px, transparent 1.3px); background-size: 18px 18px;
}
.adm-hero-main { position: relative; z-index: 2; display: flex; justify-content: space-between; align-items: center; gap: 1.5rem; flex-wrap: wrap; }
.adm-badge {
  display: inline-flex; align-items: center; gap: .55rem; font-size: .7rem; font-weight: 900; letter-spacing: .15em;
  text-transform: uppercase; color: #ffd54a; margin-bottom: .8rem; padding: .45rem .85rem; border-radius: 999px;
  border: 1px solid rgba(255, 213, 74, .35); background: rgba(255, 213, 74, .1);
}
.adm-hero h1 {
  font-family: var(--font-display); font-weight: 900; font-size: clamp(1.8rem, 3.8vw, 2.8rem); line-height: 1.1;
  margin: 0; color: #fff; letter-spacing: -.01em;
}
.adm-hero p { margin: .6rem 0 0; font-size: .86rem; color: rgba(230, 242, 253, .85); max-width: 620px; line-height: 1.6; }
.adm-quick-actions { display: flex; gap: .75rem; flex-wrap: wrap; }
.adm-btn-action {
  display: inline-flex; align-items: center; gap: .55rem; padding: .75rem 1.4rem; border-radius: 14px;
  font-weight: 800; font-size: .82rem; text-decoration: none; cursor: pointer; border: none; transition: all .25s ease;
}
.adm-btn-gold { background: linear-gradient(135deg, #ffd54a, #ffb300); color: #0a2d52; box-shadow: 0 10px 24px rgba(255, 179, 0, .3); }
.adm-btn-gold:hover { transform: translateY(-2px); box-shadow: 0 14px 30px rgba(255, 179, 0, .4); }
.adm-btn-ghost { background: rgba(255, 255, 255, .1); color: #fff; border: 1px solid rgba(255, 255, 255, .2); }
.adm-btn-ghost:hover { background: rgba(255, 255, 255, .18); transform: translateY(-2px); }

/* ---------- stat counters ---------- */
.adm-stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 2rem; }
.adm-stat-card {
  background: #fff; border: 1px solid #eef2f6; border-radius: 20px; padding: 1.2rem 1.3rem;
  display: flex; align-items: center; gap: 1rem; box-shadow: 0 10px 28px rgba(13, 58, 102, .05);
  transition: transform .25s ease, box-shadow .25s ease;
}
.adm-stat-card:hover { transform: translateY(-3px); box-shadow: 0 16px 36px rgba(13, 58, 102, .09); }
.adm-stat-icon {
  width: 48px; height: 48px; border-radius: 14px; flex: 0 0 48px; display: flex; align-items: center; justify-content: center;
  font-size: 1.2rem; background: #eef3f8; color: #0d3a66;
}
.adm-stat-card.blue .adm-stat-icon { background: rgba(13, 58, 102, .1); color: #0d3a66; }
.adm-stat-card.amber .adm-stat-icon { background: rgba(255, 179, 0, .15); color: #b98a12; }
.adm-stat-card.green .adm-stat-icon { background: rgba(31, 138, 76, .12); color: #1f8a4c; }
.adm-stat-card.red .adm-stat-icon { background: rgba(224, 72, 59, .12); color: #e0483b; }
.adm-stat-info b { display: block; font-family: var(--font-display); font-size: 1.6rem; font-weight: 900; line-height: 1; color: #0d3a66; }
.adm-stat-info span { display: block; font-size: .72rem; font-weight: 800; color: #718396; margin-top: .35rem; text-transform: uppercase; letter-spacing: .03em; }

/* ---------- tab bar ---------- */
.adm-tabs { display: flex; gap: .5rem; background: #eef3f8; border-radius: 16px; padding: .4rem; margin-bottom: 1.8rem; }
.adm-tab-btn {
  flex: 1; border: none; background: transparent; padding: .8rem 1rem; border-radius: 12px; font-size: .85rem;
  font-weight: 800; color: #5a7086; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; gap: .6rem;
  transition: all .25s ease;
}
.adm-tab-btn.active { background: #0d3a66; color: #fff; box-shadow: 0 10px 24px rgba(13, 58, 102, .25); }
.adm-tab-btn i { font-size: .9rem; }
.adm-panel { display: none; }
.adm-panel.active { display: block; animation: admFadeIn .35s ease both; }
@keyframes admFadeIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: none; } }

/* ---------- card shell & tables ---------- */
.adm-card {
  background: #fff; border: 1px solid #eef2f6; border-radius: 22px; padding: clamp(1.4rem, 2.5vw, 2rem);
  box-shadow: 0 16px 40px rgba(13, 58, 102, .06); margin-bottom: 1.8rem;
}
.adm-toolbar { display: flex; align-items: center; justify-content: space-between; gap: 1rem; flex-wrap: wrap; margin-bottom: 1.4rem; }
.adm-filter-group { display: flex; gap: .75rem; flex-wrap: wrap; flex: 1; }
.adm-input-search {
  border: 1.5px solid #e3edf0; border-radius: 12px; padding: .65rem 1rem .65rem 2.3rem; font-size: .82rem;
  color: #0d3a66; background: #fbfdff; width: min(320px, 100%); transition: border-color .2s ease;
}
.adm-input-search:focus { outline: none; border-color: #ffb300; box-shadow: 0 0 0 3px rgba(255, 179, 0, .14); }
.adm-search-wrap { position: relative; }
.adm-search-wrap i { position: absolute; left: .85rem; top: 50%; transform: translateY(-50%); color: #a7b6c4; font-size: .8rem; }

.adm-select {
  border: 1.5px solid #e3edf0; border-radius: 12px; padding: .65rem 1rem; font-size: .82rem;
  color: #0d3a66; background: #fbfdff; cursor: pointer; transition: border-color .2s ease;
}
.adm-select:focus { outline: none; border-color: #ffb300; }

.adm-table-wrap { overflow-x: auto; border-radius: 14px; border: 1px solid #eef2f6; }
.adm-table { width: 100%; border-collapse: collapse; text-align: left; font-size: .82rem; }
.adm-table th { background: #f7fafd; color: #0d3a66; font-weight: 800; padding: .85rem 1rem; border-bottom: 1px solid #eef2f6; white-space: nowrap; }
.adm-table td { padding: stroke; padding: 1rem; border-bottom: 1px solid #f2f6f9; color: #33475a; vertical-align: middle; }
.adm-table tr:hover td { background: #fafcff; }

/* badges */
.adm-badge-status {
  display: inline-flex; align-items: center; gap: .4rem; font-size: .68rem; font-weight: 800;
  padding: .35rem .75rem; border-radius: 999px; text-transform: uppercase; letter-spacing: .02em;
}
.adm-badge-status.SUBMITTED { background: #eef3f8; color: #5a7086; }
.adm-badge-status.REVIEWING { background: #fff6e0; color: #b98a12; }
.adm-badge-status.IN_PROGRESS { background: #e3f2fd; color: #1976d2; }
.adm-badge-status.RESOLVED { background: #e8f5ee; color: #1f8a4c; }
.adm-badge-status.CLOSED { background: #f5f5f5; color: #616161; }
.adm-badge-status.VERIFIED { background: #e8f5ee; color: #1f8a4c; }
.adm-badge-status.FALSE { background: #fdeceb; color: #e0483b; }
.adm-badge-status.UNCONFIRMED { background: #fff6e0; color: #b98a12; }

/* ---------- action buttons ---------- */
.adm-btn-sm {
  display: inline-flex; align-items: center; gap: .4rem; padding: .45rem .85rem; border-radius: 10px;
  font-size: .75rem; font-weight: 800; border: none; cursor: pointer; transition: all .2s ease; text-decoration: none;
}
.adm-btn-primary { background: #0d3a66; color: #fff; }
.adm-btn-primary:hover { background: #12477c; }
.adm-btn-edit { background: rgba(255, 179, 0, .15); color: #b98a12; border: 1px solid rgba(255, 179, 0, .3); }
.adm-btn-edit:hover { background: #ffb300; color: #0d3a66; }
.adm-btn-danger { background: rgba(224, 72, 59, .12); color: #e0483b; border: 1px solid rgba(224, 72, 59, .25); }
.adm-btn-danger:hover { background: #e0483b; color: #fff; }

/* ---------- modal styles ---------- */
.adm-modal-overlay {
  position: fixed; inset: 0; z-index: 9999; display: flex; align-items: center; justify-content: center;
  padding: 1.2rem; background: rgba(8, 32, 58, .6); backdrop-filter: blur(4px); opacity: 0; pointer-events: none;
  transition: opacity .25s ease;
}
.adm-modal-overlay.active { opacity: 1; pointer-events: auto; }
.adm-modal {
  width: 100%; max-width: 580px; background: #fff; border-radius: 24px; padding: 2rem;
  box-shadow: 0 30px 70px rgba(4, 14, 28, .4); transform: translateY(16px) scale(.97);
  transition: transform .25s ease, opacity .25s ease; max-height: 90vh; overflow-y: auto;
}
.adm-modal-overlay.active .adm-modal { transform: translateY(0) scale(1); }
.adm-modal-head { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.4rem; padding-bottom: 1rem; border-bottom: 1px solid #eef2f6; }
.adm-modal-head h3 { font-family: var(--font-display); font-size: 1.2rem; font-weight: 900; color: #0d3a66; margin: 0; }
.adm-modal-close { border: none; background: #eef3f8; color: #5a7086; width: 32px; height: 32px; border-radius: 50%; display: grid; place-items: center; cursor: pointer; }
.adm-modal-close:hover { background: #e0e8f0; color: #0d3a66; }

.adm-form-field { margin-bottom: 1.2rem; }
.adm-form-field label { display: block; font-size: .8rem; font-weight: 800; color: #0d3a66; margin-bottom: .45rem; }
.adm-form-field input, .adm-form-field textarea, .adm-form-field select {
  width: 100%; border: 1.5px solid #e3edf0; border-radius: 12px; padding: .75rem 1rem; font-size: .85rem;
  color: #0d3a66; background: #fbfdff; font-family: inherit; transition: border-color .2s ease;
}
.adm-form-field input:focus, .adm-form-field textarea:focus, .adm-form-field select:focus {
  outline: none; border-color: #ffb300; box-shadow: 0 0 0 3px rgba(255, 179, 0, .14);
}
.adm-form-field textarea { min-height: 100px; resize: vertical; }

.adm-detail-box { background: #f7fafd; border: 1px solid #eef2f6; border-radius: 14px; padding: 1rem; margin-bottom: 1.2rem; font-size: .82rem; }
.adm-detail-box strong { display: block; color: #0d3a66; margin-bottom: .25rem; font-weight: 800; }
.adm-detail-box p { margin: 0; color: #5a7086; line-height: 1.6; }

@media (max-width: 980px) {
  .adm-stats-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 600px) {
  .adm-stats-grid { grid-template-columns: 1fr; }
  .adm-tabs { flex-direction: column; }
}
</style>
@endpush

@section('content')
<div class="adm-page">
  <div class="adm-wrap">

    <!-- HERO HEADER -->
    <div class="adm-hero">
      <div class="adm-hero-main">
        <div>
          <span class="adm-badge"><i class="fas fa-shield-halved"></i> Panel Validasi Resmi</span>
          <h1>DASHBOARD ADMIN SMKN 2 MOJOKERTO</h1>
          <p>Kelola dan tanggapi pengaduan siswa E-Voice secara resmi, serta verifikasi klaim hoaks di School FactCheck.</p>
        </div>
        <div class="adm-quick-actions">
          <a href="{{ route('voice') }}" class="adm-btn-action adm-btn-ghost"><i class="fas fa-bullhorn"></i> Halaman E-Voice</a>
          <a href="{{ route('factcheck') }}" class="adm-btn-action adm-btn-ghost"><i class="fas fa-check-double"></i> FactCheck Publik</a>
        </div>
      </div>
    </div>

    <!-- STAT COUNTERS -->
    <div class="adm-stats-grid">
      <div class="adm-stat-card blue">
        <div class="adm-stat-icon"><i class="fas fa-comments"></i></div>
        <div class="adm-stat-info">
          <b id="statEvoiceTotal">0</b>
          <span>Total Aspirasi E-Voice</span>
        </div>
      </div>
      <div class="adm-stat-card amber">
        <div class="adm-stat-icon"><i class="fas fa-clock"></i></div>
        <div class="adm-stat-info">
          <b id="statEvoicePending">0</b>
          <span>Menunggu / Diproses</span>
        </div>
      </div>
      <div class="adm-stat-card green">
        <div class="adm-stat-icon"><i class="fas fa-circle-check"></i></div>
        <div class="adm-stat-info">
          <b id="statEvoiceResolved">0</b>
          <span>Aspirasi Selesai</span>
        </div>
      </div>
      <div class="adm-stat-card red">
        <div class="adm-stat-icon"><i class="fas fa-triangle-exclamation"></i></div>
        <div class="adm-stat-info">
          <b id="statFactcheckPending">0</b>
          <span>FactCheck Belum Di-cek</span>
        </div>
      </div>
    </div>

    <!-- TAB SWITCHER -->
    <div class="adm-tabs" role="tablist">
      <button class="adm-tab-btn active" data-tab="evoice" type="button">
        <i class="fas fa-comment-medical"></i> Validasi &amp; Tanggapan E-Voice
      </button>
      <button class="adm-tab-btn" data-tab="factcheck" type="button">
        <i class="fas fa-fact-check"></i> Verifikasi School FactCheck
      </button>
    </div>

    <!-- ================= TAB 1: E-VOICE ================= -->
    <div class="adm-panel active" id="panelEvoice">
      <div class="adm-card">
        <div class="adm-toolbar">
          <div class="adm-filter-group">
            <div class="adm-search-wrap">
              <i class="fas fa-search"></i>
              <input type="text" id="evoiceSearch" class="adm-input-search" placeholder="Cari Ticket ID, judul, atau kata...">
            </div>
            <select id="evoiceStatusFilter" class="adm-select">
              <option value="all">Semua Status E-Voice</option>
              <option value="SUBMITTED">SUBMITTED (Diterima)</option>
              <option value="REVIEWING">REVIEWING (Diproses)</option>
              <option value="IN_PROGRESS">IN_PROGRESS (Ditindaklanjuti)</option>
              <option value="RESOLVED">RESOLVED (Selesai)</option>
            </select>
          </div>
          <button class="adm-btn-action adm-btn-gold" id="refreshEvoiceBtn"><i class="fas fa-sync-alt"></i> Refresh Data</button>
        </div>

        <div class="adm-table-wrap">
          <table class="adm-table" id="evoiceTable">
            <thead>
              <tr>
                <th>Ticket ID</th>
                <th>Kategori</th>
                <th>Judul Laporan</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Tanggapan Admin</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody id="evoiceTbody">
              <tr>
                <td colspan="7" style="text-align: center; color: #a7b6c4; padding: 2rem;">Memuat data pengaduan...</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- ================= TAB 2: FACTCHECK ================= -->
    <div class="adm-panel" id="panelFactcheck">
      <div class="adm-card">
        <div class="adm-toolbar">
          <div class="adm-filter-group">
            <div class="adm-search-wrap">
              <i class="fas fa-search"></i>
              <input type="text" id="fcSearch" class="adm-input-search" placeholder="Cari klaim atau judul hoaks...">
            </div>
            <select id="fcStatusFilter" class="adm-select">
              <option value="all">Semua Status FactCheck</option>
              <option value="UNCONFIRMED">UNCONFIRMED (Belum Di-cek)</option>
              <option value="VERIFIED">VERIFIED (Fakta Benar)</option>
              <option value="FALSE">FALSE (Hoaks / Palsu)</option>
            </select>
          </div>
          <button class="adm-btn-action adm-btn-gold" id="btnAddFactcheck"><i class="fas fa-plus-circle"></i> + Tambah Klarifikasi Baru</button>
        </div>

        <div class="adm-table-wrap">
          <table class="adm-table" id="fcTable">
            <thead>
              <tr>
                <th>Judul Klarifikasi</th>
                <th>Status Verifikasi</th>
                <th>Penjelasan Fakta Sekolah</th>
                <th>Link Sumber Rujukan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody id="fcTbody">
              <tr>
                <td colspan="5" style="text-align: center; color: #a7b6c4; padding: 2rem;">Memuat data FactCheck...</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- ================= MODAL EDIT/BALAS E-VOICE ================= -->
<div class="adm-modal-overlay" id="modalEvoice">
  <div class="adm-modal">
    <div class="adm-modal-head">
      <h3>Validasi &amp; Balas Aspirasi E-Voice</h3>
      <button class="adm-modal-close" id="closeEvoiceModal">&times;</button>
    </div>
    <form id="formEvoiceModal">
      <input type="hidden" id="evModalId">
      <div class="adm-detail-box">
        <span id="evModalTicket" style="color: #ffb300; font-weight: 800; display: block; margin-bottom: .2rem;">TICKET ID</span>
        <strong id="evModalTitle">Judul Aspirasi</strong>
        <p id="evModalDesc">Deskripsi laporan...</p>
      </div>

      <div class="adm-form-field">
        <label for="evModalStatus">Status Penanganan</label>
        <select id="evModalStatus" class="adm-select" required>
          <option value="SUBMITTED">SUBMITTED — 1. Diterima</option>
          <option value="REVIEWING">REVIEWING — 2. Diproses</option>
          <option value="IN_PROGRESS">IN_PROGRESS — 3. Ditindaklanjuti</option>
          <option value="RESOLVED">RESOLVED — 4. Selesai</option>
        </select>
      </div>

      <div class="adm-form-field">
        <label for="evModalResponse">Tulis Balasan / Tanggapan Resmi Admin</label>
        <textarea id="evModalResponse" placeholder="Contoh: Terima kasih atas laporannya.kran air toilet lt. 2 sudah selesai diperbaiki hari ini oleh tim sarpras."></textarea>
      </div>

      <div style="display: flex; gap: .75rem; justify-content: flex-end; margin-top: 1.5rem;">
        <button type="button" class="adm-btn-action adm-btn-ghost" id="cancelEvoiceModal" style="color: #0d3a66; border-color: #d0dbe5;">Batal</button>
        <button type="submit" class="adm-btn-action adm-btn-gold"><i class="fas fa-save"></i> Simpan Balasan &amp; Status</button>
      </div>
    </form>
  </div>
</div>

<!-- ================= MODAL VERIFIKASI / EDIT FACTCHECK ================= -->
<div class="adm-modal-overlay" id="modalFactcheck">
  <div class="adm-modal">
    <div class="adm-modal-head">
      <h3 id="fcModalHeading">Verifikasi &amp; Klarifikasi FactCheck</h3>
      <button class="adm-modal-close" id="closeFcModal">&times;</button>
    </div>
    <form id="formFcModal">
      <input type="hidden" id="fcModalId">

      <div class="adm-form-field">
        <label for="fcModalTitle">Judul Klarifikasi</label>
        <input type="text" id="fcModalTitle" placeholder="Contoh: Klarifikasi Isu Biaya Pendaftaran PPDB" required>
      </div>

      <div class="adm-form-field">
        <label for="fcModalClaim">Isu / Klaim yang Beredar di Masyarakat</label>
        <textarea id="fcModalClaim" placeholder="Contoh: Beredar info bahwa pendaftaran PPDB dipungut biaya Rp 500.000" required style="min-height: 70px;"></textarea>
      </div>

      <div class="adm-form-field">
        <label for="fcModalStatus">Status Keputusan Verifikasi</label>
        <select id="fcModalStatus" class="adm-select" required>
          <option value="FALSE">FALSE (Hoaks / Berita Tidak Benar)</option>
          <option value="VERIFIED">VERIFIED (Fakta Benar)</option>
          <option value="UNCONFIRMED">UNCONFIRMED (Masih Belum Di-cek)</option>
        </select>
      </div>

      <div class="adm-form-field">
        <label for="fcModalExplanation">Penjelasan Resmi Fakta Sekolah</label>
        <textarea id="fcModalExplanation" placeholder="Jelaskan fakta resmi sekolah secara jelas dan tegas..." required style="min-height: 100px;"></textarea>
      </div>

      <div class="adm-form-field">
        <label for="fcModalSourceUrl">Link Sumber Resmi Rujukan (Opsional)</label>
        <input type="url" id="fcModalSourceUrl" placeholder="https://smkn2mojokerto.sch.id/surat-edaran">
      </div>

      <div style="display: flex; gap: .75rem; justify-content: flex-end; margin-top: 1.5rem;">
        <button type="button" class="adm-btn-action adm-btn-ghost" id="cancelFcModal" style="color: #0d3a66; border-color: #d0dbe5;">Batal</button>
        <button type="submit" class="adm-btn-action adm-btn-gold"><i class="fas fa-save"></i> Simpan Klarifikasi</button>
      </div>
    </form>
  </div>
</div>

@endsection

@push('scripts')
<script>
(function() {
  /* ---------------- Tab Switcher ---------------- */
  document.querySelectorAll('.adm-tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.adm-tab-btn').forEach(b => b.classList.remove('active'));
      document.querySelectorAll('.adm-panel').forEach(p => p.classList.remove('active'));
      btn.classList.add('active');
      const target = btn.dataset.tab;
      if (target === 'evoice') document.getElementById('panelEvoice').classList.add('active');
      if (target === 'factcheck') document.getElementById('panelFactcheck').classList.active ? null : document.getElementById('panelFactcheck').classList.add('active');
    });
  });

  /* ---------------- E-Voice Admin Functions ---------------- */
  let evoiceData = [];

  function fetchEvoice() {
    const search = document.getElementById('evoiceSearch').value;
    const status = document.getElementById('evoiceStatusFilter').value;

    let url = '/api/admin/e-voice?page=1';
    if (search) url += '&search=' + encodeURIComponent(search);
    if (status && status !== 'all') url += '&status=' + encodeURIComponent(status);

    fetch(url)
      .then(res => res.json())
      .then(data => {
        if (data.success && data.data) {
          evoiceData = data.data.data || [];
          renderEvoiceTable(evoiceData);
          updateEvoiceStats();
        }
      })
      .catch(err => console.error('Error fetching E-Voice data:', err));
  }

  function renderEvoiceTable(items) {
    const tbody = document.getElementById('evoiceTbody');
    if (!items || items.length === 0) {
      tbody.innerHTML = '<tr><td colspan="7" style="text-align: center; color: #a7b6c4; padding: 2rem;">Tidak ada pengaduan E-Voice ditemukan.</td></tr>';
      return;
    }

    tbody.innerHTML = items.map(item => `
      <tr>
        <td style="font-weight: 800; color: #0d3a66;">${item.ticket_code}</td>
        <td><span style="background: #eef3f8; padding: .25rem .6rem; border-radius: 6px; font-weight: 700; font-size: .72rem;">${item.category || 'ASPIRASI'}</span></td>
        <td style="font-weight: 700; max-width: 220px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${escapeHtml(item.title)}</td>
        <td style="font-size: .75rem; color: #718396;">${formatDate(item.created_at)}</td>
        <td><span class="adm-badge-status ${item.status}">${item.status}</span></td>
        <td style="font-size: .75rem; max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: ${item.admin_response ? '#1f8a4c' : '#a7b6c4'}; font-style: ${item.admin_response ? 'normal' : 'italic'};">
          ${item.admin_response ? escapeHtml(item.admin_response) : 'Belum ada balasan'}
        </td>
        <td>
          <button class="adm-btn-sm adm-btn-edit" onclick="openEvoiceModal('${item.id}')"><i class="fas fa-edit"></i> Tanggapi</button>
        </td>
      </tr>
    `).join('');
  }

  function updateEvoiceStats() {
    document.getElementById('statEvoiceTotal').textContent = evoiceData.length;
    document.getElementById('statEvoicePending').textContent = evoiceData.filter(i => i.status === 'SUBMITTED' || i.status === 'REVIEWING' || i.status === 'IN_PROGRESS').length;
    document.getElementById('statEvoiceResolved').textContent = evoiceData.filter(i => i.status === 'RESOLVED').length;
  }

  window.openEvoiceModal = function(id) {
    const item = evoiceData.find(i => i.id === id);
    if (!item) return;
    document.getElementById('evModalId').value = item.id;
    document.getElementById('evModalTicket').textContent = 'TICKET ID: ' + item.ticket_code;
    document.getElementById('evModalTitle').textContent = item.title;
    document.getElementById('evModalDesc').textContent = item.description;
    document.getElementById('evModalStatus').value = item.status;
    document.getElementById('evModalResponse').value = item.admin_response || '';
    document.getElementById('modalEvoice').classList.add('active');
  };

  document.getElementById('closeEvoiceModal').addEventListener('click', () => document.getElementById('modalEvoice').classList.remove('active'));
  document.getElementById('cancelEvoiceModal').addEventListener('click', () => document.getElementById('modalEvoice').classList.remove('active'));

  document.getElementById('formEvoiceModal').addEventListener('submit', (e) => {
    e.preventDefault();
    const id = document.getElementById('evModalId').value;
    const status = document.getElementById('evModalStatus').value;
    const response = document.getElementById('evModalResponse').value;

    fetch(`/api/admin/e-voice/${id}/status`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
      },
      body: JSON.stringify({ status: status, admin_response: response })
    })
    .then(res => res.json())
    .then(res => {
      document.getElementById('modalEvoice').classList.remove('active');
      fetchEvoice();
    })
    .catch(err => console.error('Error updating E-Voice:', err));
  });

  document.getElementById('evoiceSearch').addEventListener('input', fetchEvoice);
  document.getElementById('evoiceStatusFilter').addEventListener('change', fetchEvoice);
  document.getElementById('refreshEvoiceBtn').addEventListener('click', fetchEvoice);

  /* ---------------- FactCheck Admin Functions ---------------- */
  let fcData = [];

  function fetchFactcheck() {
    const search = document.getElementById('fcSearch').value;
    const status = document.getElementById('fcStatusFilter').value;

    let url = '/api/admin/fact-check?page=1';
    if (search) url += '&search=' + encodeURIComponent(search);
    if (status && status !== 'all') url += '&status=' + encodeURIComponent(status);

    fetch(url)
      .then(res => res.json())
      .then(data => {
        if (data.success && data.data) {
          fcData = data.data.data || [];
          renderFcTable(fcData);
          updateFcStats();
        }
      })
      .catch(err => console.error('Error fetching FactCheck data:', err));
  }

  function renderFcTable(items) {
    const tbody = document.getElementById('fcTbody');
    if (!items || items.length === 0) {
      tbody.innerHTML = '<tr><td colspan="5" style="text-align: center; color: #a7b6c4; padding: 2rem;">Tidak ada klarifikasi FactCheck ditemukan.</td></tr>';
      return;
    }

    tbody.innerHTML = items.map(item => `
      <tr>
        <td style="font-weight: 800; color: #0d3a66; max-width: 220px;">${escapeHtml(item.title)}</td>
        <td><span class="adm-badge-status ${item.status}">${item.status}</span></td>
        <td style="font-size: .78rem; max-width: 260px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${escapeHtml(item.verdict_explanation)}</td>
        <td style="font-size: .75rem; max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
          ${item.source_url ? `<a href="${item.source_url}" target="_blank" style="color: #0ea5b7; font-weight: 700;">${item.source_url}</a>` : '<span style="color: #a7b6c4;">-</span>'}
        </td>
        <td>
          <div style="display: flex; gap: .4rem;">
            <button class="adm-btn-sm adm-btn-edit" onclick="openFcModal('${item.id}')"><i class="fas fa-edit"></i> Edit</button>
            <button class="adm-btn-sm adm-btn-danger" onclick="deleteFactcheck('${item.id}')"><i class="fas fa-trash"></i> Hapus</button>
          </div>
        </td>
      </tr>
    `).join('');
  }

  function updateFcStats() {
    document.getElementById('statFactcheckPending').textContent = fcData.filter(i => i.status === 'UNCONFIRMED').length;
  }

  document.getElementById('btnAddFactcheck').addEventListener('click', () => {
    document.getElementById('fcModalId').value = '';
    document.getElementById('fcModalHeading').textContent = 'Tambah Klarifikasi FactCheck Baru';
    document.getElementById('fcModalTitle').value = '';
    document.getElementById('fcModalClaim').value = '';
    document.getElementById('fcModalStatus').value = 'FALSE';
    document.getElementById('fcModalExplanation').value = '';
    document.getElementById('fcModalSourceUrl').value = '';
    document.getElementById('modalFactcheck').classList.add('active');
  });

  window.openFcModal = function(id) {
    const item = fcData.find(i => i.id === id);
    if (!item) return;
    document.getElementById('fcModalId').value = item.id;
    document.getElementById('fcModalHeading').textContent = 'Edit / Verifikasi FactCheck';
    document.getElementById('fcModalTitle').value = item.title;
    document.getElementById('fcModalClaim').value = item.claim;
    document.getElementById('fcModalStatus').value = item.status;
    document.getElementById('fcModalExplanation').value = item.verdict_explanation;
    document.getElementById('fcModalSourceUrl').value = item.source_url || '';
    document.getElementById('modalFactcheck').classList.add('active');
  };

  document.getElementById('closeFcModal').addEventListener('click', () => document.getElementById('modalFactcheck').classList.remove('active'));
  document.getElementById('cancelFcModal').addEventListener('click', () => document.getElementById('modalFactcheck').classList.remove('active'));

  document.getElementById('formFcModal').addEventListener('submit', (e) => {
    e.preventDefault();
    const id = document.getElementById('fcModalId').value;
    const payload = {
      title: document.getElementById('fcModalTitle').value,
      claim: document.getElementById('fcModalClaim').value,
      status: document.getElementById('fcModalStatus').value,
      verdict_explanation: document.getElementById('fcModalExplanation').value,
      source_url: document.getElementById('fcModalSourceUrl').value || null
    };

    const method = id ? 'PUT' : 'POST';
    const url = id ? `/api/admin/fact-check/${id}` : '/api/admin/fact-check';

    fetch(url, {
      method: method,
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
      },
      body: JSON.stringify(payload)
    })
    .then(res => res.json())
    .then(res => {
      document.getElementById('modalFactcheck').classList.remove('active');
      fetchFactcheck();
    })
    .catch(err => console.error('Error saving FactCheck:', err));
  });

  window.deleteFactcheck = function(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus data klarifikasi FactCheck ini?')) return;

    fetch(`/api/admin/fact-check/${id}`, {
      method: 'DELETE',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
      }
    })
    .then(res => res.json())
    .then(() => fetchFactcheck())
    .catch(err => console.error('Error deleting FactCheck:', err));
  };

  document.getElementById('fcSearch').addEventListener('input', fetchFactcheck);
  document.getElementById('fcStatusFilter').addEventListener('change', fetchFactcheck);

  /* Helper Utils */
  function formatDate(iso) {
    if (!iso) return '-';
    const d = new Date(iso);
    return d.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
  }

  function escapeHtml(str) {
    return String(str || '').replace(/[&<>"']/g, function (c) {
      return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
    });
  }

  // Initial Data Load
  fetchEvoice();
  fetchFactcheck();

})();
</script>
@endpush
