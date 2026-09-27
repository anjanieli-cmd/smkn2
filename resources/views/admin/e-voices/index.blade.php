@extends('layouts.admin')

@section('title', 'Manajemen E-Voice — Suara & Aspirasi Siswa — SMK Negeri 2 Mojokerto')

@push('styles')
<style>
  .ev-stat-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1.2rem;
    margin-bottom: 1.8rem;
  }
  .ev-stat-card {
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(255, 255, 255, 0.09);
    border-radius: 18px;
    padding: 1.3rem;
    position: relative;
    overflow: hidden;
    transition: all 0.3s var(--ease, ease);
  }
  .ev-stat-card:hover {
    transform: translateY(-3px);
    border-color: rgba(255, 179, 0, 0.3);
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.3);
  }
  .ev-stat-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 0.9rem;
  }
  .ev-stat-icon {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
  }
  .ev-stat-number {
    font-family: var(--font-display);
    font-size: 2rem;
    color: #fff;
    margin-bottom: 0.2rem;
    line-height: 1;
  }
  .ev-stat-label {
    font-size: 0.78rem;
    color: var(--text-muted);
    font-weight: 600;
  }

  /* Status Badges */
  .tag-submitted {
    background: rgba(79, 195, 247, 0.16);
    color: #4fc3f7;
    border: 1px solid rgba(79, 195, 247, 0.3);
  }
  .tag-reviewing {
    background: rgba(255, 179, 0, 0.16);
    color: #ffd54a;
    border: 1px solid rgba(255, 179, 0, 0.3);
  }
  .tag-progress {
    background: rgba(255, 111, 0, 0.16);
    color: #ff9d42;
    border: 1px solid rgba(255, 111, 0, 0.3);
  }
  .tag-resolved {
    background: rgba(76, 201, 141, 0.16);
    color: #5ce0a3;
    border: 1px solid rgba(76, 201, 141, 0.3);
  }

  .ev-status-pill {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.32rem 0.75rem;
    border-radius: 999px;
    font-size: 0.68rem;
    font-weight: 800;
    letter-spacing: 0.05em;
    text-transform: uppercase;
  }

  /* 4-Stage Pipeline Progress Tracker */
  .pipeline-tracker {
    display: flex;
    align-items: center;
    gap: 0.3rem;
    margin-top: 0.4rem;
  }
  .pipeline-step {
    height: 4px;
    flex: 1;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.12);
  }
  .pipeline-step.active {
    background: var(--gold);
  }
  .pipeline-step.completed {
    background: #5ce0a3;
  }

  /* Filter Bar & Tabs */
  .ev-filter-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 1.4rem;
    padding: 1rem 1.2rem;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.07);
    border-radius: 14px;
  }
  .ev-filter-tabs {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
  }
  .ev-filter-btn {
    padding: 0.45rem 0.9rem;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: var(--text-muted);
    font-size: 0.76rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s ease;
  }
  .ev-filter-btn:hover, .ev-filter-btn.active {
    background: var(--gold);
    color: var(--navy-bg);
    border-color: var(--gold);
  }

  .ev-search-box {
    position: relative;
    min-width: 250px;
  }
  .ev-search-box input {
    width: 100%;
    padding: 0.45rem 0.8rem 0.45rem 2.2rem;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.12);
    color: #fff;
    font-size: 0.78rem;
    outline: none;
  }
  .ev-search-box i {
    position: absolute;
    left: 0.8rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
    font-size: 0.75rem;
  }

  /* Student Submission Detail Box inside Modal */
  .evoice-detail-box {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 14px;
    padding: 1.2rem;
    margin-bottom: 1.2rem;
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

  @media (max-width: 900px) {
    .ev-stat-grid {
      grid-template-columns: repeat(2, 1fr);
    }
  }
  @media (max-width: 560px) {
    .ev-stat-grid {
      grid-template-columns: 1fr;
    }
    .ev-filter-bar {
      flex-direction: column;
      align-items: stretch;
    }
  }
</style>
@endpush

@section('content')
  @php
    $totalEVoices = $items->count();
    $submittedCount = $items->filter(fn($i) => ($i->status->value ?? $i->status) === 'SUBMITTED')->count();
    $reviewingCount = $items->filter(fn($i) => ($i->status->value ?? $i->status) === 'REVIEWING')->count();
    $progressCount = $items->filter(fn($i) => ($i->status->value ?? $i->status) === 'IN_PROGRESS')->count();
    $resolvedCount = $items->filter(fn($i) => ($i->status->value ?? $i->status) === 'RESOLVED')->count();
  @endphp

  <!-- STAT CARDS (SESUAI PROGRESS PIPELINE E-VOICE) -->
  <div class="ev-stat-grid">
    <div class="ev-stat-card">
      <div class="ev-stat-head">
        <div class="ev-stat-icon" style="background:rgba(79,195,247,.14);color:#4fc3f7">
          <i class="fas fa-inbox"></i>
        </div>
        <span class="ev-status-pill tag-submitted">SUBMITTED</span>
      </div>
      <div class="ev-stat-number">{{ $submittedCount }}</div>
      <div class="ev-stat-label">Laporan / Aspirasi Baru Masuk</div>
    </div>

    <div class="ev-stat-card">
      <div class="ev-stat-head">
        <div class="ev-stat-icon" style="background:rgba(255,179,0,.14);color:#ffd54a">
          <i class="fas fa-magnifying-glass"></i>
        </div>
        <span class="ev-status-pill tag-reviewing">REVIEWING</span>
      </div>
      <div class="ev-stat-number">{{ $reviewingCount }}</div>
      <div class="ev-stat-label">Dalam Peninjauan Admin</div>
    </div>

    <div class="ev-stat-card">
      <div class="ev-stat-head">
        <div class="ev-stat-icon" style="background:rgba(255,111,0,.14);color:#ff9d42">
          <i class="fas fa-gears"></i>
        </div>
        <span class="ev-status-pill tag-progress">IN PROGRESS</span>
      </div>
      <div class="ev-stat-number">{{ $progressCount }}</div>
      <div class="ev-stat-label">Sedang Dalam Proses Tindak Lanjut</div>
    </div>

    <div class="ev-stat-card">
      <div class="ev-stat-head">
        <div class="ev-stat-icon" style="background:rgba(76,201,141,.14);color:#5ce0a3">
          <i class="fas fa-circle-check"></i>
        </div>
        <span class="ev-status-pill tag-resolved">RESOLVED</span>
      </div>
      <div class="ev-stat-number">{{ $resolvedCount }}</div>
      <div class="ev-stat-label">Telah Selesai Ditindaklanjuti</div>
    </div>
  </div>

  <!-- MAIN PANEL TABLE -->
  <div class="db-panel">
    <div class="db-panel-head">
      <div>
        <h2 style="font-family:var(--font-display);font-size:1.15rem;color:#fff"><i class="fas fa-comments" style="color:var(--gold);margin-right:.4rem"></i> E-Voice Suara Siswa &amp; Aspirasi Digital</h2>
        <p style="font-size:.78rem;color:var(--text-muted);margin-top:.2rem">Tinjau, moderasi, tindak lanjuti, dan berikan balasan resmi sekolah terhadap laporan siswa.</p>
      </div>
      <div class="db-panel-actions">
        <button class="db-btn db-btn-gold" onclick="openCreateModal()"><i class="fas fa-plus"></i> Tambah Aspirasi Baru</button>
      </div>
    </div>

    <!-- FILTER BAR & SEARCH -->
    <div class="ev-filter-bar">
      <div class="ev-filter-tabs">
        <button class="ev-filter-btn active" onclick="filterStatus('ALL', this)">Semua ({{ $totalEVoices }})</button>
        <button class="ev-filter-btn" onclick="filterStatus('SUBMITTED', this)">📥 SUBMITTED ({{ $submittedCount }})</button>
        <button class="ev-filter-btn" onclick="filterStatus('REVIEWING', this)">🔍 REVIEWING ({{ $reviewingCount }})</button>
        <button class="ev-filter-btn" onclick="filterStatus('IN_PROGRESS', this)">⚙️ IN PROGRESS ({{ $progressCount }})</button>
        <button class="ev-filter-btn" onclick="filterStatus('RESOLVED', this)">✅ RESOLVED ({{ $resolvedCount }})</button>
      </div>
      <div class="ev-search-box">
        <i class="fas fa-magnifying-glass"></i>
        <input type="text" id="evoiceSearch" placeholder="Cari kode tiket, judul, isi..." onkeyup="searchEVoices()">
      </div>
    </div>

    <!-- TABLE -->
    <div class="db-table-wrap">
      <table class="db-table">
        <thead>
          <tr>
            <th>Kode Tiket</th>
            <th>Judul &amp; Detail Aspirasi</th>
            <th>Kategori</th>
            <th>Upvotes</th>
            <th>Status Progress</th>
            <th>Balasan Admin</th>
            <th style="text-align:right">Aksi Management</th>
          </tr>
        </thead>
        <tbody id="evoiceTableBody">
          @forelse($items as $item)
            @php
              $st = is_object($item->status) ? $item->status->value : $item->status;
              $cat = is_object($item->category) ? $item->category->value : ($item->category ?? 'Aspirasi');
              
              $badgeClass = match($st) {
                'SUBMITTED' => 'tag-submitted',
                'REVIEWING' => 'tag-reviewing',
                'IN_PROGRESS' => 'tag-progress',
                'RESOLVED' => 'tag-resolved',
                default => 'tag-submitted'
              };
              
              $stLabel = match($st) {
                'SUBMITTED' => 'Baru Masuk',
                'REVIEWING' => 'Ditinjau',
                'IN_PROGRESS' => 'Diproses',
                'RESOLVED' => 'Selesai',
                default => $st
              };
            @endphp
            <tr class="evoice-row" data-status="{{ $st }}" data-search="{{ mb_strtolower($item->ticket_code . ' ' . $item->title . ' ' . $item->description . ' ' . $cat) }}">
              <td>
                <div style="font-family:monospace;font-weight:700;color:var(--gold-light);font-size:.88rem;background:rgba(255,179,0,.1);padding:.25rem .5rem;border-radius:6px;display:inline-block">
                  #{{ $item->ticket_code }}
                </div>
              </td>
              <td>
                <strong style="font-size:.9rem;color:#fff;display:block">{{ $item->title }}</strong>
                <p style="font-size:.76rem;color:var(--text-muted);margin-top:.2rem;line-height:1.4">{{ Str::limit($item->description, 80) }}</p>
              </td>
              <td>
                <span style="font-size:.75rem;padding:.2rem .6rem;border-radius:999px;background:rgba(255,255,255,.06);color:rgba(255,255,255,.85)">
                  <i class="fas fa-tag" style="color:var(--gold);margin-right:.25rem"></i> {{ $cat }}
                </span>
              </td>
              <td>
                <span style="font-weight:700;color:var(--gold);font-size:.85rem"><i class="fas fa-thumbs-up"></i> {{ $item->upvotes_count }}</span>
              </td>
              <td>
                <span class="ev-status-pill {{ $badgeClass }}">
                  {{ $st }} ({{ $stLabel }})
                </span>
                <div class="pipeline-tracker" title="Tahap: {{ $stLabel }}">
                  <div class="pipeline-step {{ in_array($st, ['SUBMITTED', 'REVIEWING', 'IN_PROGRESS', 'RESOLVED']) ? 'active' : '' }}"></div>
                  <div class="pipeline-step {{ in_array($st, ['REVIEWING', 'IN_PROGRESS', 'RESOLVED']) ? 'active' : '' }}"></div>
                  <div class="pipeline-step {{ in_array($st, ['IN_PROGRESS', 'RESOLVED']) ? 'active' : '' }}"></div>
                  <div class="pipeline-step {{ $st === 'RESOLVED' ? 'completed' : '' }}"></div>
                </div>
              </td>
              <td>
                @if($item->admin_response)
                  <span style="font-size:.75rem;color:#5ce0a3;font-weight:700"><i class="fas fa-circle-check"></i> Sudah Dibalas</span>
                @else
                  <span style="font-size:.75rem;color:var(--text-muted)"><i class="far fa-clock"></i> Belum Dibalas</span>
                @endif
              </td>
              <td style="text-align:right">
                <button class="db-btn db-btn-ghost" style="padding:.35rem .65rem;font-size:.75rem" onclick="openEditModal({{ json_encode($item) }})"><i class="fas fa-comment-dots"></i> Kelola / Balas</button>
                <button class="db-btn db-btn-danger" style="padding:.35rem .65rem;font-size:.75rem" onclick="deleteEVoice('{{ $item->id }}')"><i class="fas fa-trash"></i> Hapus</button>
              </td>
            </tr>
          @empty
            <tr><td colspan="7" style="text-align:center;color:var(--text-muted);padding:2.5rem">Belum ada data pengaduan / aspirasi E-Voice.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- MODAL CREATE / EDIT / BALAS (PREMIUM REFINED UI) -->
  <div class="db-modal-overlay" id="evoiceModal">
    <div class="db-modal" style="max-width:680px">
      <div style="display:flex;align-items:center;gap:.85rem;padding:1.25rem 1.5rem;background:linear-gradient(135deg,rgba(79,195,247,.18),rgba(12,40,70,.9));border-bottom:1px solid rgba(255,255,255,.1)">
        <div style="width:42px;height:42px;border-radius:12px;background:linear-gradient(135deg,#4fc3f7,#0288d1);color:#0c2846;display:flex;align-items:center;justify-content:center;font-size:1.15rem;box-shadow:0 6px 16px rgba(79,195,247,.3)">
          <i class="fas fa-comments"></i>
        </div>
        <div style="flex:1">
          <h3 id="modalTitle" style="font-family:var(--font-display);font-size:1.15rem;color:#fff;margin:0">Buat Aspirasi E-Voice</h3>
          <p style="font-size:.76rem;color:var(--text-muted);margin:.15rem 0 0">Kelola dan berikan balasan resmi sekolah untuk laporan siswa.</p>
        </div>
        <button class="db-modal-close" onclick="closeModal()">&times;</button>
      </div>
      <div class="db-modal-body">
        <!-- Rincian Aspirasi Siswa (Tampil Saat Edit / Balas) -->
        <div class="evoice-detail-box" id="studentDetailBox" style="display:none">
          <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.6rem">
            <span style="font-family:monospace;font-weight:800;color:var(--gold-light);font-size:.9rem" id="detailTicketCode">#EV-000</span>
            <span style="font-size:.78rem;color:var(--gold)" id="detailUpvotes"><i class="fas fa-thumbs-up"></i> 0 Upvotes</span>
          </div>
          <h4 style="font-size:.95rem;color:#fff;margin-bottom:.4rem" id="detailTitle">Judul Aspirasi</h4>
          <p style="font-size:.82rem;color:var(--text-muted);line-height:1.6;margin:0" id="detailDescription">Deskripsi aspirasi siswa...</p>
        </div>

        <form id="evoiceForm" onsubmit="saveEVoice(event)">
          <input type="hidden" id="evoiceId">

          <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.1rem">
            <div class="db-form-group">
              <label><i class="fas fa-heading" style="color:var(--gold)"></i> Judul Aspirasi / Keluhan *</label>
              <input type="text" id="evoiceTitle" class="db-form-control" placeholder="Judul pengaduan atau ide perbaikan" required>
            </div>

            <div class="db-form-group">
              <label><i class="fas fa-tags" style="color:var(--gold)"></i> Kategori Aspirasi *</label>
              <select id="evoiceCategory" class="db-form-control">
                <option value="ASPIRASI">💡 Aspirasi Umum</option>
                <option value="Fasilitas">🏢 Fasilitas &amp; Sarana Sekolah</option>
                <option value="Akademik">📚 Akademik &amp; KBM</option>
                <option value="Kedisiplinan">🛡️ Kedisiplinan &amp; Tata Tertib</option>
                <option value="Perundungan">🤝 Perundungan (Anti-Bullying)</option>
                <option value="Layanan Sekolah">🏫 Layanan Administrasi</option>
                <option value="Lainnya">📌 Lainnya</option>
              </select>
            </div>
          </div>

          <div class="db-form-group" style="margin-top:.4rem">
            <label><i class="fas fa-align-left" style="color:var(--gold)"></i> Rincian Deskripsi *</label>
            <textarea id="evoiceDescription" class="db-form-control" rows="3" placeholder="Tuliskan rincian aspirasi atau tanggapan..." required></textarea>
          </div>

          <div class="db-form-group" style="margin-top:.4rem">
            <label><i class="fas fa-bars-staggered" style="color:var(--gold)"></i> Tahap Status Penanganan (Pipeline Process) *</label>
            <select id="evoiceStatus" class="db-form-control">
              <option value="SUBMITTED">📥 SUBMITTED (Baru Masuk - Belum Ditinjau)</option>
              <option value="REVIEWING">🔍 REVIEWING (Dalam Peninjauan Pihak Sekolah)</option>
              <option value="IN_PROGRESS">⚙️ IN_PROGRESS (Sedang Dalam Proses Tindak Lanjut)</option>
              <option value="RESOLVED">✅ RESOLVED (Selesai Ditindaklanjuti &amp; Dibalas)</option>
            </select>
          </div>

          <div class="db-form-group" id="adminResponseGroup" style="margin-top:.4rem">
            <label><i class="fas fa-reply-all" style="color:var(--gold)"></i> Tanggapan / Balasan Resmi Sekolah (Tampil di Website Publik)</label>
            
            <div style="margin-bottom:.5rem;margin-top:.3rem">
              <span style="font-size:.72rem;color:var(--text-muted);display:block;margin-bottom:.3rem">Template Balasan Cepat:</span>
              <button type="button" class="quick-reply-btn" onclick="applyTemplate(1)">1. Terima Kasih &amp; Peninjauan</button>
              <button type="button" class="quick-reply-btn" onclick="applyTemplate(2)">2. Sedang Diproses Sarana/Tim</button>
              <button type="button" class="quick-reply-btn" onclick="applyTemplate(3)">3. Selesai Ditindaklanjuti</button>
            </div>

            <textarea id="adminResponse" class="db-form-control" rows="3" placeholder="Tuliskan tanggapan resmi sekolah terhadap laporan ini..."></textarea>
          </div>

          <div style="display:flex;justify-content:flex-end;gap:.75rem;margin-top:1.5rem;padding-top:1rem;border-top:1px solid rgba(255,255,255,.08)">
            <button type="button" class="db-btn db-btn-ghost" onclick="closeModal()">Batal</button>
            <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-paper-plane"></i> Simpan &amp; Balas Aspirasi</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  let currentFilter = 'ALL';

  function filterStatus(status, btn) {
    currentFilter = status;
    document.querySelectorAll('.ev-filter-btn').forEach(b => b.classList.remove('active'));
    if (btn) btn.classList.add('active');
    applyFilters();
  }

  function searchEVoices() {
    applyFilters();
  }

  function applyFilters() {
    const q = document.getElementById('evoiceSearch').value.toLowerCase().trim();
    const rows = document.querySelectorAll('.evoice-row');

    rows.forEach(row => {
      const rowStatus = row.getAttribute('data-status');
      const rowSearch = row.getAttribute('data-search');

      const matchStatus = (currentFilter === 'ALL' || rowStatus === currentFilter);
      const matchSearch = (!q || rowSearch.includes(q));

      if (matchStatus && matchSearch) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  }

  function applyTemplate(type) {
    const responseField = document.getElementById('adminResponse');
    if (type === 1) {
      responseField.value = "Halo! 👋 Terima kasih atas masukan yang disampaikan. Laporan aspirasi Anda telah kami terima dan saat ini sedang ditinjau oleh pihak manajemen sekolah.";
      document.getElementById('evoiceStatus').value = 'REVIEWING';
    } else if (type === 2) {
      responseField.value = "Terima kasih atas laporan Anda. Aspirasi ini sedang dalam proses tindak lanjut oleh tim penanggung jawab unit terkait.";
      document.getElementById('evoiceStatus').value = 'IN_PROGRESS';
    } else if (type === 3) {
      responseField.value = "Terima kasih banyak atas perhatian dan kepedulian Anda. Laporan ini telah selesai ditindaklanjuti dan diselesaikan oleh pihak sekolah. 😊";
      document.getElementById('evoiceStatus').value = 'RESOLVED';
    }
  }

  function openCreateModal() {
    document.getElementById('modalTitle').textContent = 'Buat Aspirasi / Pengaduan E-Voice Baru';
    document.getElementById('studentDetailBox').style.display = 'none';
    document.getElementById('evoiceId').value = '';
    document.getElementById('evoiceTitle').value = '';
    document.getElementById('evoiceCategory').value = 'ASPIRASI';
    document.getElementById('evoiceDescription').value = '';
    document.getElementById('evoiceStatus').value = 'REVIEWING';
    document.getElementById('adminResponse').value = '';
    document.getElementById('evoiceModal').classList.add('active');
  }

  function openEditModal(item) {
    document.getElementById('modalTitle').textContent = 'Kelola & Balas Aspirasi Siswa (' + item.ticket_code + ')';
    document.getElementById('studentDetailBox').style.display = 'block';
    document.getElementById('detailTicketCode').textContent = '#' + item.ticket_code;
    document.getElementById('detailUpvotes').innerHTML = '<i class="fas fa-thumbs-up"></i> ' + (item.upvotes_count || 0) + ' Upvotes';
    document.getElementById('detailTitle').textContent = item.title;
    document.getElementById('detailDescription').textContent = item.description || '';

    document.getElementById('evoiceId').value = item.id;
    document.getElementById('evoiceTitle').value = item.title;
    document.getElementById('evoiceCategory').value = item.category || 'ASPIRASI';
    document.getElementById('evoiceDescription').value = item.description || '';
    document.getElementById('evoiceStatus').value = item.status.value || item.status;
    document.getElementById('adminResponse').value = item.admin_response || '';
    document.getElementById('evoiceModal').classList.add('active');
  }

  function closeModal() {
    document.getElementById('evoiceModal').classList.remove('active');
  }

  async function saveEVoice(e) {
    e.preventDefault();
    const id = document.getElementById('evoiceId').value;
    const isEdit = !!id;

    if (isEdit) {
      try {
        const res = await fetch(`/api/admin/e-voice/${id}/status`, {
          method: 'PATCH',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
          },
          body: JSON.stringify({
            status: document.getElementById('evoiceStatus').value,
            admin_response: document.getElementById('adminResponse').value
          })
        });
        const data = await res.json();
        if (res.ok && data.success) {
          showToast('Status & Balasan E-Voice berhasil diperbarui!');
          closeModal();
          setTimeout(() => location.reload(), 800);
        } else {
          showToast(data.message || 'Gagal memperbarui data.', 'error');
        }
      } catch (err) {
        showToast('Terjadi kesalahan koneksi server.', 'error');
      }
    } else {
      try {
        const res = await fetch('/api/admin/e-voice', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
          },
          body: JSON.stringify({
            title: document.getElementById('evoiceTitle').value,
            category: document.getElementById('evoiceCategory').value,
            description: document.getElementById('evoiceDescription').value,
            status: document.getElementById('evoiceStatus').value,
            admin_response: document.getElementById('adminResponse').value
          })
        });
        const data = await res.json();
        if (res.ok && data.success) {
          showToast('Aspirasi baru berhasil ditambahkan!');
          closeModal();
          setTimeout(() => location.reload(), 800);
        } else {
          showToast(data.message || 'Gagal menambahkan data.', 'error');
        }
      } catch (err) {
        showToast('Terjadi kesalahan koneksi server.', 'error');
      }
    }
  }

  async function deleteEVoice(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus data pengaduan/aspirasi E-Voice ini?')) return;
    try {
      const res = await fetch(`/api/admin/e-voice/${id}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        }
      });
      const data = await res.json();
      if (res.ok && data.success) {
        showToast('Aspirasi berhasil dihapus!');
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
