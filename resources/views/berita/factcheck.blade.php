@extends('layouts.app')

@section('title', 'School FactCheck — Klarifikasi Informasi & Hoaks | SMK Negeri 2 Mojokerto')
@section('description', 'Periksa kebenaran informasi yang beredar tentang SMK Negeri 2 Mojokerto — PPDB, jadwal kegiatan, pengumuman, dan kebijakan sekolah — lengkap dengan status verifikasi, sumber resmi, dan tanggal pembaruan.')

@push('styles')
<style>
/* =========================================================
   SCHOOL FACTCHECK — Klarifikasi Informasi & Hoaks
   Langsung ke inti fungsi: cari/filter klaim yang beredar,
   lihat status verifikasinya (Terverifikasi / Tidak Benar /
   Belum Terkonfirmasi), sumber resmi, dan tanggal pembaruan.
   Frontend-only — data klarifikasi didefinisikan di JS agar
   mudah disambungkan ke backend/CMS nanti.
   Warna & tipografi mengikuti identitas situs: navy #0d3a66,
   gold #ffd54a/#ffb300, font-display, --ease. Tambahan warna
   status: hijau (benar), merah (tidak benar), amber (belum
   terkonfirmasi) — semua ikon dari Font Awesome, tanpa emoji.
   ========================================================= */
.fc-page{background:#f4f8fc;color:#0d3a66;min-height:60vh;position:relative;overflow:hidden}
.fc-page *{box-sizing:border-box}
.fc-wrap{width:min(1440px,94%);margin:0 auto;padding:44px 0 100px;position:relative;z-index:2}

/* decorative background */
.fc-blob{position:absolute;border-radius:50%;filter:blur(60px);z-index:0;pointer-events:none}
.fc-blob-a{width:520px;height:520px;top:-220px;right:-140px;
  background:radial-gradient(circle,rgba(255,213,74,.26),rgba(255,213,74,0) 70%)}
.fc-blob-b{width:460px;height:460px;top:340px;left:-220px;
  background:radial-gradient(circle,rgba(13,58,102,.10),rgba(13,58,102,0) 70%)}
.fc-blob-c{width:380px;height:380px;bottom:-160px;right:10%;
  background:radial-gradient(circle,rgba(31,138,76,.10),rgba(31,138,76,0) 70%)}
.fc-dotfield{position:absolute;inset:0;z-index:1;pointer-events:none;opacity:.5;
  background-image:radial-gradient(rgba(13,58,102,.06) 1.3px,transparent 1.4px);background-size:20px 20px;
  -webkit-mask-image:linear-gradient(180deg,#000 0,#000 340px,transparent 480px);
  mask-image:linear-gradient(180deg,#000 0,#000 340px,transparent 480px)}

/* ---------- hero (senada dengan AI Major Matchmaker) ---------- */
.fc-hero{position:relative;margin-bottom:2.2rem;padding:clamp(1.9rem,4vw,2.7rem) clamp(1.5rem,3.4vw,2.7rem);
  border-radius:28px;overflow:hidden;z-index:3;
  background:linear-gradient(120deg,#082846 0%,#0d3a66 48%,#0a3155 100%);color:#fff;
  box-shadow:0 30px 64px rgba(8,40,70,.36)}
.fc-hero::before{content:"";position:absolute;inset:0;pointer-events:none;z-index:0;
  background-image:radial-gradient(rgba(255,255,255,.08) 1.3px,transparent 1.4px);background-size:20px 20px;opacity:.6}
.fc-hero-glow-a{position:absolute;top:-90px;right:-50px;width:280px;height:280px;border-radius:50%;z-index:0;pointer-events:none;
  background:radial-gradient(circle,rgba(14,165,183,.32),rgba(14,165,183,0) 70%)}
.fc-hero-glow-b{position:absolute;bottom:-100px;left:-70px;width:240px;height:240px;border-radius:50%;z-index:0;pointer-events:none;
  background:radial-gradient(circle,rgba(255,213,74,.22),rgba(255,213,74,0) 70%)}
.fc-hero canvas.fc-hero-net{display:block;position:absolute;inset:0;width:100%;height:100%;z-index:0;pointer-events:none;opacity:.5}
.fc-hero-main{position:relative;z-index:2;max-width:820px;text-align:left}
.fc-badge-ai{display:inline-flex;align-items:center;gap:.55rem;font-size:.68rem;font-weight:900;letter-spacing:.16em;
  text-transform:uppercase;color:#8be9f2;margin-bottom:1.1rem;padding:.55rem .95rem;border-radius:999px;
  border:1px solid rgba(139,233,242,.35);background:rgba(139,233,242,.1)}
.fc-badge-ai i{font-size:.75rem;animation:fcPulseIcon 2.4s ease-in-out infinite}
@keyframes fcPulseIcon{0%,100%{opacity:1}50%{opacity:.4}}
.fc-hero h1{font-family:var(--font-display);font-weight:900;font-size:clamp(2.1rem,4.6vw,3.6rem);line-height:1.08;
  margin:0;color:#fff;letter-spacing:-.015em;text-align:left}
.fc-hero h1 .fc-title-line{display:block}
.fc-hero h1 .fc-title-gold{color:#ffd54a}
.fc-hero p{margin:1.3rem 0 0;font-size:.87rem;color:rgba(230,242,253,.82);line-height:1.85;max-width:520px;text-align:left}
.fc-hero-cta{display:inline-flex;align-items:center;gap:.8rem;margin-top:1.7rem;padding:.8rem 1rem;border-radius:16px;
  text-decoration:none;color:#fff;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.16);
  box-shadow:0 12px 30px rgba(4,14,28,.22);transition:transform .3s ease,background .3s ease,border-color .3s ease,box-shadow .3s ease}
.fc-hero-cta:hover{transform:translateY(-4px);background:rgba(255,255,255,.1);
  border-color:rgba(255,213,74,.4);box-shadow:0 18px 38px rgba(4,14,28,.3)}
.fc-hero-cta-icon{width:46px;height:46px;border-radius:14px;display:grid;place-items:center;flex:0 0 46px;
  background:linear-gradient(135deg,#ffd54a,#ff8a00);color:#0d3a66;font-size:.9rem}
.fc-hero-cta strong{display:block;font-size:.92rem;line-height:1.15;font-weight:900;letter-spacing:.01em}
.fc-hero-cta small{display:block;margin-top:.25rem;color:rgba(230,242,253,.65);font-size:.72rem;font-weight:600}
.fc-hero-cta-arrow{margin-left:.3rem;color:#ffd54a;font-size:1rem;transition:transform .3s ease}
.fc-hero-cta:hover .fc-hero-cta-arrow{transform:translateX(4px)}
.fc-hero-live{position:absolute;top:clamp(1.5rem,3vw,2.1rem);right:clamp(1.5rem,3vw,2.1rem);z-index:3;
  display:inline-flex;align-items:center;gap:.65rem;font-size:.74rem;font-weight:800;color:#0d3a66;
  background:#fff;border-radius:999px;padding:.55rem .95rem;white-space:nowrap;box-shadow:0 16px 34px rgba(4,14,28,.32)}
.fc-hero-live i{color:#ffb300}
@media(max-width:640px){
  .fc-hero-live{position:static;display:inline-flex;margin-top:1.2rem}
  .fc-hero h1{font-size:clamp(1.8rem,8vw,2.5rem)}
  .fc-hero-cta{width:100%}
}

/* ---------- section head (senada dengan AI Major Matchmaker) ---------- */
.fc-section-head{text-align:left;max-width:680px;margin:0 0 1.8rem}
.fc-section-head span.tag{display:inline-flex;align-items:center;gap:.6rem;font-size:.7rem;font-weight:800;letter-spacing:.2em;
  text-transform:uppercase;color:#0a7583;margin-bottom:1rem}
.fc-section-head span.tag::before{content:"";width:24px;height:3px;border-radius:99px;background:linear-gradient(90deg,#0ea5b7,#ffb300)}
.fc-section-head h2{font-family:var(--font-display);font-size:clamp(1.7rem,3.6vw,2.4rem);font-weight:900;
  color:#0d3a66;margin:0;line-height:1.08;letter-spacing:-.015em;text-transform:uppercase}
.fc-section-head h2 span{background:linear-gradient(135deg,#ffd54a 0%,#ffb300 45%,#0ea5b7 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent}
.fc-section-head p{font-size:.85rem;color:#5a7086;margin:.9rem 0 0;line-height:1.75;max-width:520px}

/* ---------- report box: user lapor link dugaan hoax ---------- */
.fc-report{position:relative;margin-bottom:2.2rem;background:#fff;border:1px solid #eef2f6;border-radius:28px;
  padding:clamp(1.8rem,3.6vw,2.6rem);box-shadow:0 24px 56px rgba(13,58,102,.08);overflow:hidden}
.fc-report::before{content:"";position:absolute;inset:0;border-radius:28px;padding:1.5px;pointer-events:none;
  background:linear-gradient(135deg,rgba(14,165,183,.35),rgba(255,255,255,0) 35%,rgba(255,179,0,.26) 100%);
  -webkit-mask:linear-gradient(#000 0 0) content-box,linear-gradient(#000 0 0);-webkit-mask-composite:xor;mask-composite:exclude}
.fc-report-grid{display:grid;grid-template-columns:1.05fr 1fr;gap:2.6rem;align-items:stretch;position:relative;z-index:1}
.fc-report-info{position:relative;background:linear-gradient(160deg,rgba(14,165,183,.07),rgba(255,179,0,.06));
  border:1px solid rgba(14,165,183,.16);border-radius:22px;padding:2rem 2.1rem;overflow:hidden}
.fc-report-info::after{content:"\f3ed";font-family:"Font Awesome 5 Free";font-weight:900;position:absolute;
  right:-18px;bottom:-26px;font-size:9rem;color:rgba(13,58,102,.05);pointer-events:none;line-height:1}
.fc-report-tag{position:relative;display:inline-flex;align-items:center;gap:.6rem;font-size:.8rem;font-weight:900;
  letter-spacing:.14em;text-transform:uppercase;color:#0a7583}
.fc-report-tag::before{content:"";width:26px;height:3px;border-radius:99px;background:linear-gradient(90deg,#0ea5b7,#ffb300)}
.fc-report-heading{position:relative;font-family:var(--font-display);font-size:clamp(1.5rem,2.4vw,1.8rem);font-weight:900;color:#0d3a66;
  margin:1rem 0 0;line-height:1.25}
.fc-report-lead{position:relative;font-size:.98rem;color:#4a6178;margin:.85rem 0 0;line-height:1.8;max-width:460px}
.fc-report-info ul{position:relative;list-style:none;margin:1.6rem 0 0;padding:0;display:grid;gap:1.1rem}
.fc-report-info li{display:flex;align-items:flex-start;gap:.9rem;font-size:.92rem;color:#33475a;line-height:1.65}
.fc-report-info li i{width:38px;height:38px;border-radius:12px;flex:0 0 38px;display:flex;align-items:center;justify-content:center;
  font-size:.92rem;margin-top:.05rem;box-shadow:0 8px 16px rgba(13,58,102,.1)}
.fc-report-info li:nth-child(1) i{background:linear-gradient(135deg,#0ea5b7,#0a7583);color:#fff}
.fc-report-info li:nth-child(2) i{background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0d3a66}
.fc-report-info li:nth-child(3) i{background:linear-gradient(135deg,#123f6e,#0d3a66);color:#fff}
.fc-report-form{display:grid;gap:1.25rem;background:#f7fafd;border:1px solid #eef2f6;border-radius:20px;padding:1.9rem}
.fc-field label{display:block;font-size:.85rem;font-weight:800;color:#0d3a66;margin-bottom:.5rem;letter-spacing:.02em}
.fc-field input,.fc-field select,.fc-field textarea{width:100%;border:1.5px solid #e3edf0;border-radius:14px;
  padding:.95rem 1.1rem;font-size:.95rem;color:#0d3a66;background:#fff;font-family:inherit;
  transition:border-color .25s var(--ease,ease),box-shadow .25s var(--ease,ease)}
.fc-field input:focus,.fc-field select:focus,.fc-field textarea:focus{outline:none;border-color:#ffb300;box-shadow:0 0 0 4px rgba(255,179,0,.16)}
.fc-field textarea{resize:vertical;min-height:100px}
.fc-field-hint{font-size:.78rem;color:#a7b6c4;margin-top:.4rem}
.fc-field-icon{position:relative;display:flex;align-items:center}
.fc-field-icon input{padding-left:2.9rem}
.fc-field-icon > i{position:absolute;left:1rem;top:50%;transform:translateY(-50%);display:flex;align-items:center;color:#a7b6c4;font-size:.95rem;pointer-events:none}
.fc-field-select{position:relative}
.fc-field-select select{appearance:none;-webkit-appearance:none;padding-right:2.6rem;cursor:pointer}
.fc-field-select::after{content:"\f078";font-family:"Font Awesome 5 Free";font-weight:900;position:absolute;
  right:1.1rem;top:2.6rem;font-size:.72rem;color:#a7b6c4;pointer-events:none}
.fc-report-submit{display:flex;align-items:center;justify-content:center;gap:.7rem;padding:1.1rem 1.6rem;border-radius:14px;
  width:100%;border:none;background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0a2d52;font-weight:900;font-size:1rem;cursor:pointer;
  box-shadow:0 16px 34px rgba(255,179,0,.3);transition:transform .25s var(--ease,ease),box-shadow .25s var(--ease,ease)}
.fc-report-submit:hover{transform:translateY(-2px);box-shadow:0 20px 42px rgba(255,179,0,.4)}
.fc-report-submit i{font-size:.9rem}
.fc-report-status{display:none;align-items:flex-start;gap:.7rem;font-size:.88rem;line-height:1.65;padding:1rem 1.15rem;
  border-radius:14px;background:#e8f5ee;color:#1f8a4c;border:1px solid rgba(31,138,76,.18)}
.fc-report-status.show{display:flex}
.fc-report-status.is-error{background:#fdeceb;color:#e0483b;border-color:rgba(224,72,59,.2)}
.fc-report-status i{margin-top:.15rem;font-size:.95rem}
@media(max-width:900px){.fc-report-grid{grid-template-columns:1fr;gap:1.8rem}}

/* stats strip */
.fc-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:.9rem;margin-bottom:1.8rem}
.fc-stat{background:#fff;border:1px solid #eef2f6;border-radius:18px;padding:1.5rem 1.1rem;
  display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;gap:.6rem;
  box-shadow:0 10px 26px rgba(13,58,102,.05);transition:transform .25s var(--ease,ease),box-shadow .25s var(--ease,ease)}
.fc-stat:hover{transform:translateY(-3px);box-shadow:0 16px 34px rgba(13,58,102,.09)}
.fc-stat b{display:block;font-family:var(--font-display);font-size:1.8rem;font-weight:900;line-height:1;color:#0d3a66}
.fc-stat span{display:block;font-size:.7rem;font-weight:800;letter-spacing:.04em;color:#8698a9;margin-top:.3rem;text-transform:uppercase}
.fc-stat.verified b{color:#1f8a4c}
.fc-stat.false b{color:#e0483b}
.fc-stat.pending b{color:#b98a12}

/* layout */
.fc-layout{display:grid;grid-template-columns:290px minmax(0,1fr);gap:1.8rem;align-items:start}
.fc-side{position:sticky;top:24px;display:flex;flex-direction:column;gap:1.1rem}
.fc-side-card{background:#fff;border:1px solid #eef2f6;border-radius:20px;padding:1.3rem 1.2rem;
  box-shadow:0 14px 34px rgba(13,58,102,.06)}
.fc-side-card h3{display:flex;align-items:center;gap:.55rem;font-family:var(--font-display);font-size:.88rem;
  font-weight:800;color:#0d3a66;margin:0 0 1rem}
.fc-side-card h3 i{width:26px;height:26px;border-radius:8px;display:flex;align-items:center;justify-content:center;
  background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0d3a66;font-size:.66rem;flex:0 0 26px}

.fc-search{position:relative;margin-bottom:.2rem}
.fc-search input{width:100%;border:1.5px solid #e3edf0;border-radius:12px;padding:.7rem .9rem .7rem 2.4rem;
  font-size:.82rem;color:#0d3a66;background:#fbfdff;transition:border-color .25s var(--ease,ease),box-shadow .25s var(--ease,ease)}
.fc-search input:focus{outline:none;border-color:#ffb300;box-shadow:0 0 0 4px rgba(255,179,0,.14)}
.fc-search i{position:absolute;left:.85rem;top:50%;transform:translateY(-50%);color:#a7b6c4;font-size:.8rem}

.fc-cat-list{list-style:none;margin:0;padding:0;display:grid;gap:.35rem}
.fc-cat-btn{width:100%;display:flex;align-items:center;justify-content:space-between;gap:.6rem;border:none;background:transparent;
  padding:.6rem .65rem;border-radius:10px;cursor:pointer;font-size:.78rem;font-weight:700;color:#5a7086;text-align:left;
  transition:background .25s var(--ease,ease),color .25s var(--ease,ease)}
.fc-cat-btn i{width:16px;text-align:center;color:#a7b6c4;font-size:.76rem;transition:color .25s var(--ease,ease)}
.fc-cat-btn .fc-cat-count{font-size:.66rem;font-weight:800;color:#a7b6c4;background:#eef3f8;border-radius:999px;padding:.15rem .5rem}
.fc-cat-btn:hover{background:#f3f7fb;color:#0d3a66}
.fc-cat-btn.active{background:#0d3a66;color:#fff}
.fc-cat-btn.active i{color:#ffd54a}
.fc-cat-btn.active .fc-cat-count{background:rgba(255,213,74,.22);color:#ffd54a}

.fc-legend{list-style:none;margin:0;padding:0;display:grid;gap:.7rem}
.fc-legend li{display:flex;align-items:flex-start;gap:.6rem;font-size:.74rem;color:#33475a;line-height:1.55}
.fc-legend-dot{width:20px;height:20px;border-radius:50%;flex:0 0 20px;display:flex;align-items:center;justify-content:center;font-size:.6rem;margin-top:.05rem}
.fc-legend-dot.verified{background:#e8f5ee;color:#1f8a4c}
.fc-legend-dot.false{background:#fdeceb;color:#e0483b}
.fc-legend-dot.pending{background:#fff6e0;color:#b98a12}
.fc-legend b{display:block;color:#0d3a66;font-weight:800;margin-bottom:.1rem}

.fc-side-note{background:linear-gradient(135deg,#0d3a66,#123f6e);color:#fff;border-radius:20px;padding:1.3rem 1.2rem;
  box-shadow:0 18px 40px rgba(13,58,102,.24)}
.fc-side-note h3{color:#fff}
.fc-side-note h3 i{background:rgba(255,255,255,.15);color:#ffd54a}
.fc-side-note p{font-size:.76rem;color:rgba(235,245,253,.82);line-height:1.65;margin:0 0 .9rem}
.fc-side-note a{display:inline-flex;align-items:center;gap:.45rem;font-size:.76rem;font-weight:800;color:#ffd54a;text-decoration:none}
.fc-side-note a i{font-size:.66rem;transition:transform .3s var(--ease,ease)}
.fc-side-note a:hover i{transform:translateX(4px)}

/* main */
.fc-main{min-width:0}
.fc-toolbar{display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;margin-bottom:1.3rem}
.fc-status-pills{display:flex;gap:.5rem;flex-wrap:wrap}
.fc-pill{display:inline-flex;align-items:center;gap:.4rem;padding:.5rem .85rem;border-radius:999px;border:1.5px solid #e3edf0;
  background:#fff;font-size:.72rem;font-weight:800;color:#5a7086;cursor:pointer;transition:all .25s var(--ease,ease)}
.fc-pill i{font-size:.7rem}
.fc-pill:hover{border-color:#ffd98a;transform:translateY(-1px)}
.fc-pill.active{color:#fff}
.fc-pill[data-status="semua"].active{background:#0d3a66;border-color:#0d3a66}
.fc-pill[data-status="Terverifikasi"].active{background:#1f8a4c;border-color:#1f8a4c}
.fc-pill[data-status="Tidak Benar"].active{background:#e0483b;border-color:#e0483b}
.fc-pill[data-status="Belum Terkonfirmasi"].active{background:#b98a12;border-color:#b98a12}
.fc-result-count{font-size:.76rem;color:#8698a9;font-weight:700;white-space:nowrap}
.fc-result-count b{color:#0d3a66}

/* card grid */
.fc-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:1.2rem}
.fc-card{background:#fff;border:1px solid #eef2f6;border-radius:18px;padding:1.3rem;position:relative;overflow:hidden;
  box-shadow:0 12px 30px rgba(13,58,102,.06);transition:transform .3s var(--ease,ease),box-shadow .3s var(--ease,ease)}
.fc-card:hover{transform:translateY(-4px);box-shadow:0 20px 42px rgba(13,58,102,.1)}
.fc-card::before{content:"";position:absolute;top:0;left:0;bottom:0;width:4px}
.fc-card.status-verified::before{background:#1f8a4c}
.fc-card.status-false::before{background:#e0483b}
.fc-card.status-pending::before{background:#ffb300}

.fc-card-head{display:flex;align-items:center;justify-content:space-between;gap:.6rem;flex-wrap:wrap;margin-bottom:.9rem}
.fc-badge{display:inline-flex;align-items:center;gap:.4rem;font-size:.66rem;font-weight:900;letter-spacing:.03em;
  text-transform:uppercase;padding:.36rem .7rem;border-radius:999px}
.fc-badge.status-verified{background:#e8f5ee;color:#1f8a4c}
.fc-badge.status-false{background:#fdeceb;color:#e0483b}
.fc-badge.status-pending{background:#fff6e0;color:#b98a12}
.fc-cat-tag{font-size:.66rem;font-weight:800;color:#5a7086;background:#eef3f8;border-radius:999px;padding:.34rem .68rem}

.fc-claim{display:flex;gap:.55rem;font-size:.86rem;font-weight:700;color:#0d3a66;line-height:1.55;margin-bottom:.7rem}
.fc-claim i{color:#dbe6ee;font-size:.9rem;margin-top:.15rem;flex:0 0 14px}

.fc-explain{font-size:.78rem;color:#5a7086;line-height:1.7;margin:0 0 .3rem;
  display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden}
.fc-card.open .fc-explain{-webkit-line-clamp:unset;overflow:visible}

.fc-more{display:inline-flex;align-items:center;gap:.35rem;background:none;border:none;padding:0;margin-top:.15rem;
  font-size:.72rem;font-weight:800;color:#0d3a66;cursor:pointer}
.fc-more i{font-size:.6rem;transition:transform .3s var(--ease,ease)}
.fc-more:hover{color:#ff7a00}
.fc-card.open .fc-more i{transform:rotate(180deg)}

.fc-card-foot{display:flex;align-items:center;justify-content:space-between;gap:.7rem;flex-wrap:wrap;
  margin-top:1rem;padding-top:.85rem;border-top:1px solid #eef2f6}
.fc-source{display:inline-flex;align-items:center;gap:.4rem;font-size:.7rem;font-weight:700;color:#2f6fa8;text-decoration:none;
  max-width:60%;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
.fc-source i{font-size:.7rem;flex:0 0 auto}
.fc-source:hover{color:#0d3a66;text-decoration:underline}
.fc-source.is-empty{color:#a7b6c4;pointer-events:none}
.fc-date{display:inline-flex;align-items:center;gap:.35rem;font-size:.68rem;color:#a7b6c4;font-weight:700;white-space:nowrap}
.fc-date i{font-size:.66rem}

/* link yang dilaporkan warga/user (tiktok/yt/berita) */
.fc-report-link-row{display:flex;align-items:center;gap:.5rem;margin-bottom:.75rem;padding:.55rem .75rem;
  border-radius:10px;background:#f7fafd;border:1px solid #eef2f6}
.fc-report-link-row .plat-icon{width:24px;height:24px;border-radius:7px;flex:0 0 24px;display:flex;align-items:center;
  justify-content:center;font-size:.7rem;color:#fff}
.fc-report-link-row .plat-icon.tiktok{background:#010101}
.fc-report-link-row .plat-icon.youtube{background:#ff0000}
.fc-report-link-row .plat-icon.berita{background:#2f6fa8}
.fc-report-link-row .plat-icon.lainnya{background:#5a7086}
.fc-report-link-row a{font-size:.72rem;font-weight:700;color:#0d3a66;text-decoration:none;overflow:hidden;
  text-overflow:ellipsis;white-space:nowrap}
.fc-report-link-row a:hover{text-decoration:underline}
.fc-report-link-row span.lbl{font-size:.62rem;font-weight:800;letter-spacing:.04em;text-transform:uppercase;color:#a7b6c4;
  display:block;margin-bottom:.1rem}

/* empty state */
.fc-empty{display:none;text-align:center;padding:3.5rem 1rem;background:#fff;border:1px dashed #dbe6ee;border-radius:20px}
.fc-empty.is-shown{display:block}
.fc-empty i{font-size:2rem;color:#dbe6ee;margin-bottom:.9rem}
.fc-empty p{margin:0;font-size:.85rem;color:#8698a9}
.fc-empty span{display:block;font-size:.76rem;color:#a7b6c4;margin-top:.3rem}

/* CTA */
.fc-cta{margin-top:2.2rem;background:#fff;border:1px solid #eef2f6;border-radius:22px;padding:1.8rem 2rem;
  display:flex;align-items:center;justify-content:space-between;gap:1.5rem;flex-wrap:wrap;
  box-shadow:0 16px 38px rgba(13,58,102,.06)}
.fc-cta-text h3{font-family:var(--font-display);font-size:1.05rem;font-weight:800;color:#0d3a66;margin:0 0 .35rem}
.fc-cta-text p{font-size:.8rem;color:#718396;margin:0;max-width:460px;line-height:1.6}
.fc-cta-btn{display:inline-flex;align-items:center;gap:.55rem;padding:.85rem 1.6rem;border-radius:999px;border:none;
  background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0a2d52;font-weight:800;font-size:.83rem;text-decoration:none;
  white-space:nowrap;box-shadow:0 14px 30px rgba(255,179,0,.3);transition:transform .25s var(--ease,ease),box-shadow .25s var(--ease,ease)}
.fc-cta-btn:hover{transform:translateY(-2px);box-shadow:0 18px 38px rgba(255,179,0,.4)}
.fc-cta-btn i{font-size:.72rem}

/* responsive */
@media(max-width:1180px){
  .fc-layout{grid-template-columns:260px minmax(0,1fr);gap:1.4rem}
}
@media(max-width:980px){
  .fc-layout{grid-template-columns:1fr}
  .fc-side{position:static;flex-direction:row;flex-wrap:wrap}
  .fc-side-card,.fc-side-note{flex:1 1 260px}
  .fc-stats{grid-template-columns:repeat(2,1fr)}
}
@media(max-width:700px){
  .fc-wrap{padding:32px 0 70px}
  .fc-hero{padding:1.5rem 1.1rem;border-radius:20px}
  .fc-side{flex-direction:column}
  .fc-grid{grid-template-columns:1fr}
  .fc-toolbar{align-items:flex-start}
  .fc-cta{flex-direction:column;align-items:stretch;text-align:center}
  .fc-cta-btn{justify-content:center}
  .fc-report{padding:1.4rem 1.1rem;border-radius:22px}
  .fc-report-info{padding:1.5rem 1.3rem}
  .fc-report-form{padding:1.3rem}
}
@media(max-width:480px){
  .fc-stats{grid-template-columns:1fr 1fr}
}
</style>
@endpush

@section('content')
<div class="fc-page">
  <span class="fc-blob fc-blob-a" aria-hidden="true"></span>
  <span class="fc-blob fc-blob-b" aria-hidden="true"></span>
  <span class="fc-blob fc-blob-c" aria-hidden="true"></span>
  <span class="fc-dotfield" aria-hidden="true"></span>

  <div class="fc-wrap">

    <div class="fc-hero">
      <span class="fc-hero-glow-a" aria-hidden="true"></span>
      <span class="fc-hero-glow-b" aria-hidden="true"></span>
      <canvas class="fc-hero-net" id="fcHeroNet" style="position:absolute;inset:0;width:100%;height:100%" aria-hidden="true"></canvas>
      <div class="fc-hero-main">
        <span class="fc-badge-ai"><i class="fas fa-shield-halved"></i> School FactCheck</span>
        <h1>
          <span class="fc-title-line">KLARIFIKASI INFORMASI</span>
          <span class="fc-title-line fc-title-gold">&amp; HOAKS</span>
        </h1>
        <p>Cek kebenaran informasi yang beredar seputar PPDB, jadwal kegiatan, pengumuman, dan kebijakan SMK Negeri 2 Mojokerto sebelum kamu percaya atau menyebarkannya.</p>
        <a class="fc-hero-cta" href="#fcReportAnchor">
          <span class="fc-hero-cta-icon"><i class="fas fa-link"></i></span>
          <span><strong>Laporkan Link Dugaan Hoax</strong><small>Kirim link TikTok, YouTube, atau berita ke admin</small></span>
          <i class="fas fa-arrow-right fc-hero-cta-arrow"></i>
        </a>
      </div>
      <span class="fc-hero-live"><i class="fas fa-certificate"></i> Diverifikasi Sumber Resmi</span>
    </div>

    <!-- ================= BOX LAPORAN: user submit link dugaan hoax ================= -->
    <div class="fc-report" id="fcReportAnchor">
      <div class="fc-report-grid">
        <div class="fc-report-info">
          <span class="fc-report-tag"><i class="fas fa-paper-plane"></i> Laporkan Klarifikasi</span>
          <h3 class="fc-report-heading">Nemu berita atau video mencurigakan?</h3>
          <p class="fc-report-lead">Tempel link berita, TikTok, atau YouTube yang kamu temukan. Tim admin sekolah akan menelusuri kebenarannya, lalu hasilnya (benar/hoax) akan tampil di halaman ini lengkap dengan link aslinya.</p>
          <ul>
            <li><i class="fas fa-link"></i> Cukup satu link — TikTok, YouTube, atau artikel berita.</li>
            <li><i class="fas fa-user-shield"></i> Diperiksa langsung oleh admin sekolah, bukan otomatis.</li>
            <li><i class="fas fa-eye"></i> Hasil verifikasi tampil publik beserta link sumbernya.</li>
          </ul>
        </div>
        <form class="fc-report-form" id="fcReportForm" novalidate>
          <div class="fc-field">
            <label for="fcReportLink">Link yang kamu temukan <span style="color:#e0483b">*</span></label>
            <div class="fc-field-icon">
              <i class="fas fa-link"></i>
              <input type="url" id="fcReportLink" name="link" placeholder="https://tiktok.com/... atau https://youtube.com/..." required>
            </div>
            <span class="fc-field-hint">Bisa link TikTok, YouTube, Instagram, atau berita online.</span>
          </div>
          <div class="fc-field fc-field-select">
            <label for="fcReportKategori">Terkait apa?</label>
            <select id="fcReportKategori" name="kategori">
              <option value="PPDB">PPDB</option>
              <option value="Jadwal">Jadwal Kegiatan</option>
              <option value="Pengumuman">Pengumuman</option>
              <option value="Kebijakan">Kebijakan Sekolah</option>
              <option value="Lainnya">Lainnya</option>
            </select>
          </div>
          <div class="fc-field">
            <label for="fcReportCatatan">Ceritakan singkat (opsional)</label>
            <textarea id="fcReportCatatan" name="catatan" placeholder="Contoh: video ini bilang PPDB dibuka Januari, itu bener nggak sih?"></textarea>
          </div>
          <button type="submit" class="fc-report-submit"><i class="fas fa-paper-plane"></i> Kirim ke Admin</button>
          <div class="fc-report-status" id="fcReportStatus"><i class="fas fa-circle-check"></i><span></span></div>
        </form>
      </div>
    </div>

    <div class="fc-stats" id="fcStats">
      <div class="fc-stat total"><div><b id="fcStatTotal">0</b><span>Total Klarifikasi</span></div></div>
      <div class="fc-stat verified"><div><b id="fcStatVerified">0</b><span>Terverifikasi</span></div></div>
      <div class="fc-stat false"><div><b id="fcStatFalse">0</b><span>Tidak Benar</span></div></div>
      <div class="fc-stat pending"><div><b id="fcStatPending">0</b><span>Belum Terkonfirmasi</span></div></div>
    </div>

    <div class="fc-layout">

      <aside class="fc-side">
        <div class="fc-side-card">
          <h3><i class="fas fa-filter"></i> Cari &amp; Saring</h3>
          <div class="fc-search">
            <i class="fas fa-search"></i>
            <input type="text" id="fcSearchInput" placeholder="Cari kata kunci, mis. PPDB, MPLS...">
          </div>
        </div>

        <div class="fc-side-card">
          <h3><i class="fas fa-list-ul"></i> Kategori</h3>
          <ul class="fc-cat-list" id="fcCatList">
            <li><button class="fc-cat-btn active" type="button" data-cat="semua"><span><i class="fas fa-th"></i> Semua Kategori</span><span class="fc-cat-count" data-count-cat="semua">0</span></button></li>
            <li><button class="fc-cat-btn" type="button" data-cat="PPDB"><span><i class="fas fa-graduation-cap"></i> PPDB</span><span class="fc-cat-count" data-count-cat="PPDB">0</span></button></li>
            <li><button class="fc-cat-btn" type="button" data-cat="Jadwal"><span><i class="fas fa-calendar-alt"></i> Jadwal Kegiatan</span><span class="fc-cat-count" data-count-cat="Jadwal">0</span></button></li>
            <li><button class="fc-cat-btn" type="button" data-cat="Pengumuman"><span><i class="fas fa-bullhorn"></i> Pengumuman</span><span class="fc-cat-count" data-count-cat="Pengumuman">0</span></button></li>
            <li><button class="fc-cat-btn" type="button" data-cat="Kebijakan"><span><i class="fas fa-balance-scale"></i> Kebijakan Sekolah</span><span class="fc-cat-count" data-count-cat="Kebijakan">0</span></button></li>
          </ul>
        </div>

        <div class="fc-side-card">
          <h3><i class="fas fa-info-circle"></i> Arti Status</h3>
          <ul class="fc-legend">
            <li><span class="fc-legend-dot verified"><i class="fas fa-check"></i></span><span><b>Terverifikasi</b>Informasi sudah dikonfirmasi kebenarannya oleh pihak sekolah.</span></li>
            <li><span class="fc-legend-dot false"><i class="fas fa-times"></i></span><span><b>Tidak Benar</b>Informasi terbukti keliru atau menyesatkan.</span></li>
            <li><span class="fc-legend-dot pending"><i class="fas fa-question"></i></span><span><b>Belum Terkonfirmasi</b>Masih dalam proses pengecekan pihak sekolah.</span></li>
          </ul>
        </div>

        <div class="fc-side-note">
          <h3><i class="fas fa-exclamation-triangle"></i> Menemukan Info Meragukan?</h3>
          <p>Punya link TikTok, YouTube, atau berita yang perlu dicek kebenarannya? Kirim ke admin lewat form laporan.</p>
          <a href="#fcReportAnchor">Laporkan Sekarang <i class="fas fa-arrow-right"></i></a>
        </div>
      </aside>

      <div class="fc-main">

        <div class="fc-section-head">
          <span class="tag"><i class="fas fa-list-check"></i> Daftar Klarifikasi</span>
          <h2>Sudah <span>Diverifikasi</span></h2>
          <p>Hasil penelusuran admin atas laporan dari warga sekolah maupun temuan tim FactCheck sendiri.</p>
        </div>

        <div class="fc-toolbar">
          <div class="fc-status-pills" id="fcStatusPills">
            <button class="fc-pill active" type="button" data-status="semua"><i class="fas fa-th"></i> Semua Status</button>
            <button class="fc-pill" type="button" data-status="Terverifikasi"><i class="fas fa-check-circle"></i> Terverifikasi</button>
            <button class="fc-pill" type="button" data-status="Tidak Benar"><i class="fas fa-times-circle"></i> Tidak Benar</button>
            <button class="fc-pill" type="button" data-status="Belum Terkonfirmasi"><i class="fas fa-question-circle"></i> Belum Terkonfirmasi</button>
          </div>
          <span class="fc-result-count"><b id="fcResultNum">0</b> klarifikasi ditemukan</span>
        </div>

        <div class="fc-grid" id="fcGrid"></div>

        <div class="fc-empty" id="fcEmpty">
          <i class="fas fa-folder-open"></i>
          <p>Tidak ada klarifikasi yang cocok dengan pencarianmu.</p>
          <span>Coba kata kunci lain atau ubah filter kategori/status.</span>
        </div>

        <div class="fc-cta">
          <div class="fc-cta-text">
            <h3>Belum menemukan klarifikasi yang kamu cari?</h3>
            <p>Sampaikan isu atau kabar yang beredar dan tim sekolah akan segera menelusuri kebenarannya.</p>
          </div>
          <a href="#fcReportAnchor" class="fc-cta-btn"><i class="fas fa-paper-plane"></i> Ajukan Klarifikasi</a>
        </div>

      </div>
    </div>

  </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
  /* ---------------- data klarifikasi ----------------
     Frontend-only: mudah diganti menjadi hasil fetch API
     saat backend/CMS sudah tersedia. Nantinya tiap item ini
     idealnya datang dari tabel "laporan_klarifikasi" di DB:
       status, kategori, klaim, penjelasan  -> diisi admin
       linkLaporan, platformLaporan          -> link yang dikirim pelapor
                                                 (tiktok/youtube/berita/lainnya)
       sumber, sumberUrl                     -> rujukan resmi dari admin
       tanggal                                -> tanggal admin publish status
     TODO backend: ganti array statis ini dengan
       fetch('/berita/factcheck/data').then(r => r.json())
  */
  var FACTS = [
    {
      status: 'Tidak Benar',
      kategori: 'PPDB',
      klaim: 'PPDB SMK Negeri 2 Mojokerto tahun ajaran baru dibuka mulai Januari.',
      penjelasan: 'Jadwal resmi PPDB ditentukan oleh Dinas Pendidikan Provinsi Jawa Timur dan biasanya diumumkan pertengahan tahun, bukan Januari. Calon peserta didik diimbau hanya merujuk pada jadwal resmi PPDB Jatim dan pengumuman sekolah, bukan pesan berantai.',
      linkLaporan: 'https://www.tiktok.com/@contoh/video/000000',
      platformLaporan: 'tiktok',
      sumber: 'ppdbjatim.net',
      sumberUrl: 'https://ppdbjatim.net',
      tanggal: '2026-08-15'
    },
    {
      status: 'Terverifikasi',
      kategori: 'Jadwal',
      klaim: 'Kegiatan MPLS (Masa Pengenalan Lingkungan Sekolah) tahun ajaran baru dilaksanakan tanggal 14–16 Juli.',
      penjelasan: 'Jadwal ini sesuai dengan Surat Edaran resmi Kepala Sekolah tentang kalender pendidikan tahun ajaran berjalan yang telah dibagikan ke wali kelas dan orang tua/wali peserta didik baru.',
      sumber: 'Surat Edaran Kepala Sekolah No. 421/1032',
      sumberUrl: '',
      tanggal: '2026-07-01'
    },
    {
      status: 'Belum Terkonfirmasi',
      kategori: 'Kebijakan',
      klaim: 'Sekolah akan menerapkan sistem full day school mulai semester depan.',
      penjelasan: 'Wacana ini masih dalam tahap kajian internal dan belum ada Surat Keputusan resmi yang diterbitkan. Informasi akan diperbarui begitu ada keputusan final dari pihak sekolah.',
      linkLaporan: 'https://www.youtube.com/watch?v=contoh000',
      platformLaporan: 'youtube',
      sumber: '',
      sumberUrl: '',
      tanggal: '2026-08-10'
    },
    {
      status: 'Tidak Benar',
      kategori: 'Pengumuman',
      klaim: 'Ujian Praktik Kejuruan ditiadakan pada tahun ajaran ini.',
      penjelasan: 'Ujian Praktik Kejuruan tetap dilaksanakan sesuai kalender akademik dan menjadi salah satu syarat kelulusan sesuai ketentuan kurikulum. Jadwal lengkap dapat dilihat pada pengumuman resmi sekolah.',
      sumber: 'Pengumuman Akademik Sekolah',
      sumberUrl: '',
      tanggal: '2026-08-05'
    },
    {
      status: 'Tidak Benar',
      kategori: 'Kebijakan',
      klaim: 'Seragam pramuka wajib dibeli di koperasi sekolah dengan harga yang ditentukan sekolah.',
      penjelasan: 'Peserta didik diperbolehkan membeli perlengkapan pramuka di tempat mana pun selama memenuhi standar atribut yang berlaku. Sekolah tidak mewajibkan pembelian di koperasi tertentu.',
      sumber: 'Klarifikasi Kesiswaan',
      sumberUrl: '',
      tanggal: '2026-07-20'
    },
    {
      status: 'Terverifikasi',
      kategori: 'Jadwal',
      klaim: 'Libur semester ganjil dimulai tanggal 20 Desember.',
      penjelasan: 'Sesuai kalender pendidikan resmi yang diterbitkan Dinas Pendidikan Provinsi Jawa Timur dan telah disesuaikan dengan kalender akademik sekolah.',
      sumber: 'Kalender Pendidikan Jatim 2026/2027',
      sumberUrl: '',
      tanggal: '2026-08-01'
    },
    {
      status: 'Terverifikasi',
      kategori: 'PPDB',
      klaim: 'SMK Negeri 2 Mojokerto membuka jalur afirmasi khusus bagi calon peserta didik penyandang disabilitas.',
      penjelasan: 'Jalur afirmasi ini merupakan bagian dari kebijakan PPDB inklusif yang berlaku sesuai petunjuk teknis PPDB Jatim dan telah diterapkan sekolah pada penerimaan tahun ajaran berjalan.',
      sumber: 'Juknis PPDB Jatim',
      sumberUrl: 'https://ppdbjatim.net',
      tanggal: '2026-06-18'
    },
    {
      status: 'Tidak Benar',
      kategori: 'Pengumuman',
      klaim: 'Setiap peserta didik dikenakan sumbangan wajib Rp500.000 untuk kegiatan MPLS.',
      penjelasan: 'Sekolah tidak memungut biaya wajib untuk kegiatan MPLS. Jika ada pihak yang meminta sejumlah uang dengan mengatasnamakan sekolah, peserta didik dan orang tua diimbau segera melapor ke pihak sekolah.',
      linkLaporan: 'https://contohberita.com/mplsmojokerto-viral',
      platformLaporan: 'berita',
      sumber: 'Klarifikasi Humas Sekolah',
      sumberUrl: '',
      tanggal: '2026-07-10'
    },
    {
      status: 'Belum Terkonfirmasi',
      kategori: 'Pengumuman',
      klaim: 'Pembagian rapor semester ini ditunda dari jadwal semula.',
      penjelasan: 'Isu ini masih ditelusuri kebenarannya. Jadwal resmi pembagian rapor akan diinformasikan melalui wali kelas dan kanal resmi sekolah begitu dikonfirmasi.',
      sumber: '',
      sumberUrl: '',
      tanggal: '2026-08-18'
    },
    {
      status: 'Terverifikasi',
      kategori: 'PPDB',
      klaim: 'SMK Negeri 2 Mojokerto menambah kuota jurusan Rekayasa Perangkat Lunak (RPL) pada PPDB tahun ajaran baru.',
      penjelasan: 'Penambahan kuota ini telah disetujui dan tercantum dalam daftar rombongan belajar resmi yang diumumkan pada laman PPDB Jatim menjelang pembukaan pendaftaran.',
      sumber: 'ppdbjatim.net',
      sumberUrl: 'https://ppdbjatim.net',
      tanggal: '2026-05-22'
    }
  ];

  var STATUS_CLASS = {
    'Terverifikasi': 'status-verified',
    'Tidak Benar': 'status-false',
    'Belum Terkonfirmasi': 'status-pending'
  };
  var STATUS_ICON = {
    'Terverifikasi': 'fa-check-circle',
    'Tidak Benar': 'fa-times-circle',
    'Belum Terkonfirmasi': 'fa-question-circle'
  };

  var state = { search: '', kategori: 'semua', status: 'semua' };

  var grid = document.getElementById('fcGrid');
  var empty = document.getElementById('fcEmpty');
  var resultNum = document.getElementById('fcResultNum');

  function formatDate(iso) {
    var d = new Date(iso);
    return d.toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' });
  }

  function escapeHtml(str) {
    return String(str).replace(/[&<>"']/g, function (c) {
      return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
    });
  }

  var PLATFORM_META = {
    tiktok: { icon: 'fas fa-music', label: 'Dilaporkan dari TikTok' },
    youtube: { icon: 'fas fa-play', label: 'Dilaporkan dari YouTube' },
    berita: { icon: 'fas fa-newspaper', label: 'Dilaporkan dari berita' },
    lainnya: { icon: 'fas fa-link', label: 'Dilaporkan dari link' }
  };

  function reportLinkHtml(item) {
    if (!item.linkLaporan) return '';
    var meta = PLATFORM_META[item.platformLaporan] || PLATFORM_META.lainnya;
    var platCls = item.platformLaporan && PLATFORM_META[item.platformLaporan] ? item.platformLaporan : 'lainnya';
    return (
      '<div class="fc-report-link-row">' +
        '<span class="plat-icon ' + platCls + '"><i class="' + meta.icon + '"></i></span>' +
        '<span><span class="lbl">' + meta.label + '</span>' +
        '<a href="' + item.linkLaporan + '" target="_blank" rel="noopener">' + escapeHtml(item.linkLaporan) + '</a></span>' +
      '</div>'
    );
  }

  function cardHtml(item, idx) {
    var cls = STATUS_CLASS[item.status];
    var icon = STATUS_ICON[item.status];
    var sourceHtml = item.sumber
      ? (item.sumberUrl
          ? '<a class="fc-source" href="' + item.sumberUrl + '" target="_blank" rel="noopener"><i class="fas fa-link"></i>' + escapeHtml(item.sumber) + '</a>'
          : '<span class="fc-source is-empty"><i class="fas fa-university"></i>' + escapeHtml(item.sumber) + '</span>')
      : '<span class="fc-source is-empty"><i class="fas fa-hourglass-half"></i>Sumber menyusul</span>';

    return (
      '<article class="fc-card ' + cls + '" data-idx="' + idx + '">' +
        '<div class="fc-card-head">' +
          '<span class="fc-badge ' + cls + '"><i class="fas ' + icon + '"></i>' + item.status + '</span>' +
          '<span class="fc-cat-tag">' + item.kategori + '</span>' +
        '</div>' +
        reportLinkHtml(item) +
        '<p class="fc-claim"><i class="fas fa-quote-left"></i><span>' + escapeHtml(item.klaim) + '</span></p>' +
        '<p class="fc-explain">' + escapeHtml(item.penjelasan) + '</p>' +
        '<button class="fc-more" type="button" data-toggle-explain>' +
          '<span class="fc-more-label">Baca Selengkapnya</span><i class="fas fa-chevron-down"></i>' +
        '</button>' +
        '<div class="fc-card-foot">' +
          sourceHtml +
          '<span class="fc-date"><i class="fas fa-calendar"></i>' + formatDate(item.tanggal) + '</span>' +
        '</div>' +
      '</article>'
    );
  }

  function updateCounts(list) {
    var total = FACTS.length;
    var vCount = 0, fCount = 0, pCount = 0;
    var catCounts = { semua: total, PPDB: 0, Jadwal: 0, Pengumuman: 0, Kebijakan: 0 };
    FACTS.forEach(function (item) {
      if (item.status === 'Terverifikasi') vCount++;
      else if (item.status === 'Tidak Benar') fCount++;
      else pCount++;
      if (catCounts.hasOwnProperty(item.kategori)) catCounts[item.kategori]++;
    });
    document.getElementById('fcStatTotal').textContent = total;
    document.getElementById('fcStatVerified').textContent = vCount;
    document.getElementById('fcStatFalse').textContent = fCount;
    document.getElementById('fcStatPending').textContent = pCount;
    Object.keys(catCounts).forEach(function (key) {
      var el = document.querySelector('[data-count-cat="' + key + '"]');
      if (el) el.textContent = catCounts[key];
    });
    resultNum.textContent = list.length;
  }

  function render() {
    var q = state.search.trim().toLowerCase();
    var filtered = FACTS.filter(function (item) {
      var matchCat = state.kategori === 'semua' || item.kategori === state.kategori;
      var matchStatus = state.status === 'semua' || item.status === state.status;
      var matchSearch = !q ||
        item.klaim.toLowerCase().indexOf(q) !== -1 ||
        item.penjelasan.toLowerCase().indexOf(q) !== -1 ||
        item.kategori.toLowerCase().indexOf(q) !== -1;
      return matchCat && matchStatus && matchSearch;
    });

    grid.innerHTML = filtered.map(function (item) {
      var realIdx = FACTS.indexOf(item);
      return cardHtml(item, realIdx);
    }).join('');

    empty.classList.toggle('is-shown', filtered.length === 0);
    grid.style.display = filtered.length === 0 ? 'none' : '';
    updateCounts(filtered);
    bindCardEvents();
  }

  function bindCardEvents() {
    grid.querySelectorAll('[data-toggle-explain]').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var card = btn.closest('.fc-card');
        var isOpen = card.classList.toggle('open');
        btn.querySelector('.fc-more-label').textContent = isOpen ? 'Tutup' : 'Baca Selengkapnya';
      });
    });
  }

  /* ---- events: search, kategori, status ---- */
  document.getElementById('fcSearchInput').addEventListener('input', function (e) {
    state.search = e.target.value;
    render();
  });

  document.querySelectorAll('#fcCatList .fc-cat-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      document.querySelectorAll('#fcCatList .fc-cat-btn').forEach(function (b) { b.classList.remove('active'); });
      btn.classList.add('active');
      state.kategori = btn.getAttribute('data-cat');
      render();
    });
  });

  document.querySelectorAll('#fcStatusPills .fc-pill').forEach(function (btn) {
    btn.addEventListener('click', function () {
      document.querySelectorAll('#fcStatusPills .fc-pill').forEach(function (b) { b.classList.remove('active'); });
      btn.classList.add('active');
      state.status = btn.getAttribute('data-status');
      render();
    });
  });

  /* ---------------- form laporan: user kirim link dugaan hoax ----------------
     FRONTEND-ONLY untuk sekarang: submit langsung ditolak dari reload,
     divalidasi ringan, lalu (sebagai simulasi) ditambahkan sebagai kartu
     berstatus "Belum Terkonfirmasi" di grid supaya alurnya kelihatan utuh.
     TODO backend: ganti blok "SIMULASI" di bawah dengan fetch POST asli, mis.
       fetch('/berita/factcheck/store', {
         method: 'POST',
         headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content },
         body: JSON.stringify({ link, kategori, catatan })
       })
       lalu admin yang login akan mengubah status & mengisi penjelasan resmi
       lewat halaman admin, baru tampil final di sini (bukan auto Belum Terkonfirmasi). */
  function detectPlatform(url) {
    var u = url.toLowerCase();
    if (u.indexOf('tiktok.com') !== -1) return 'tiktok';
    if (u.indexOf('youtube.com') !== -1 || u.indexOf('youtu.be') !== -1) return 'youtube';
    if (u.indexOf('instagram.com') !== -1 || u.indexOf('facebook.com') !== -1 || u.indexOf('x.com') !== -1 || u.indexOf('twitter.com') !== -1) return 'lainnya';
    return 'berita';
  }

  function showReportStatus(message, isError) {
    var box = document.getElementById('fcReportStatus');
    box.classList.toggle('is-error', !!isError);
    box.querySelector('i').className = isError ? 'fas fa-circle-exclamation' : 'fas fa-circle-check';
    box.querySelector('span').textContent = message;
    box.classList.add('show');
  }

  var reportForm = document.getElementById('fcReportForm');
  reportForm.addEventListener('submit', function (e) {
    e.preventDefault();
    var link = document.getElementById('fcReportLink').value.trim();
    var kategori = document.getElementById('fcReportKategori').value;
    var catatan = document.getElementById('fcReportCatatan').value.trim();

    var isValidUrl = /^https?:\/\/.+\..+/i.test(link);
    if (!isValidUrl) {
      showReportStatus('Link belum valid. Pastikan diawali https:// dan lengkap ya.', true);
      return;
    }

    /* ---- SIMULASI: tampilkan sebagai "Belum Terkonfirmasi" sampai admin memverifikasi ---- */
    FACTS.unshift({
      status: 'Belum Terkonfirmasi',
      kategori: kategori,
      klaim: catatan || 'Laporan baru menunggu verifikasi admin.',
      penjelasan: 'Laporan ini baru saja dikirim dan sedang ditelusuri oleh tim admin sekolah. Status dan penjelasan resmi akan diperbarui begitu proses verifikasi selesai.',
      linkLaporan: link,
      platformLaporan: detectPlatform(link),
      sumber: '',
      sumberUrl: '',
      tanggal: new Date().toISOString().slice(0, 10)
    });

    showReportStatus('Terkirim! Laporanmu sudah masuk ke daftar dan menunggu diverifikasi admin.', false);
    reportForm.reset();
    render();
  });

  /* ---------------- hero neural-network background ---------------- */
  function initHeroNet() {
    var canvas = document.getElementById('fcHeroNet');
    if (!canvas || !canvas.getContext) return;
    var ctx = canvas.getContext('2d');
    var dpr = Math.min(window.devicePixelRatio || 1, 2);
    var hero = canvas.closest('.fc-hero');
    var nodes = [];
    var raf = null;

    function size() {
      var w = hero.clientWidth, h = hero.clientHeight;
      canvas.width = w * dpr;
      canvas.height = h * dpr;
      canvas.style.width = w + 'px';
      canvas.style.height = h + 'px';
      ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
      var count = Math.max(14, Math.min(34, Math.floor((w * h) / 16000)));
      nodes = [];
      for (var i = 0; i < count; i++) {
        nodes.push({
          x: Math.random() * w,
          y: Math.random() * h,
          vx: (Math.random() - 0.5) * 0.18,
          vy: (Math.random() - 0.5) * 0.18,
          r: 1.4 + Math.random() * 1.6
        });
      }
    }

    function frame() {
      var w = hero.clientWidth, h = hero.clientHeight;
      ctx.clearRect(0, 0, w, h);
      nodes.forEach(function (n) {
        n.x += n.vx; n.y += n.vy;
        if (n.x < 0 || n.x > w) n.vx *= -1;
        if (n.y < 0 || n.y > h) n.vy *= -1;
      });
      for (var i = 0; i < nodes.length; i++) {
        for (var j = i + 1; j < nodes.length; j++) {
          var dx = nodes[i].x - nodes[j].x, dy = nodes[i].y - nodes[j].y;
          var dist = Math.sqrt(dx * dx + dy * dy);
          if (dist < 130) {
            ctx.strokeStyle = 'rgba(255,255,255,' + (0.14 * (1 - dist / 130)) + ')';
            ctx.lineWidth = 1;
            ctx.beginPath();
            ctx.moveTo(nodes[i].x, nodes[i].y);
            ctx.lineTo(nodes[j].x, nodes[j].y);
            ctx.stroke();
          }
        }
      }
      nodes.forEach(function (n) {
        ctx.beginPath();
        ctx.arc(n.x, n.y, n.r, 0, Math.PI * 2);
        ctx.fillStyle = 'rgba(255,213,74,.55)';
        ctx.fill();
      });
      raf = requestAnimationFrame(frame);
    }

    size();
    if (raf) cancelAnimationFrame(raf);
    raf = requestAnimationFrame(frame);
    window.addEventListener('resize', function () { size(); });
  }

  initHeroNet();
  render();
})();
</script>
@endpush