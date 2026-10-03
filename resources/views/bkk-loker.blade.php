@extends('layouts.app')

@section('title', 'BKK & Loker — SMK Negeri 2 Mojokerto')
@section('description', 'Pusat informasi Bursa Kerja Khusus dan lowongan kerja SMK Negeri 2 Mojokerto untuk siswa dan alumni.')

@push('styles')
<style>
/* =========================================================
   TOKEN — semua warna lewat variabel supaya dark mode
   cukup mengganti nilai variabel di bagian paling bawah
   ========================================================= */
.bkk-page{
  --navy:#0d3a66;--navy-2:#0a2d52;--navy-3:#071a31;
  --gold:#ffb300;--gold-2:#ffd54a;--orange:#ff6f00;
  --bg:#f6f8fb;--bg-alt:#edf2f8;--surf:#fff;--surf-2:#f4f7fb;
  --head:#0d3a66;--text:#52657a;--link:#2f6fa8;
  --line:rgba(13,58,102,.11);--line-2:rgba(13,58,102,.24);
  --shadow:0 18px 44px rgba(13,58,102,.09);
  --hl:rgba(255,213,74,.62);
  --ok:#1e9e55;--soon:#e0a100;--end:#d93025;--arc:#8393a6;
  background:var(--bg);color:var(--head);position:relative;overflow:hidden
}
.bkk-page *,.bkk-page *::before,.bkk-page *::after{box-sizing:border-box}
.bkk-page a:focus-visible{outline:3px solid var(--gold);outline-offset:3px;border-radius:999px}

/* =========================================================
   HERO
   ========================================================= */
.bkk-hero{position:relative;isolation:isolate;display:flex;align-items:center;overflow:hidden;min-height:clamp(520px,72vh,720px);background:#fff;color:var(--head)}
.bkk-hero::after{content:"BKK";position:absolute;z-index:0;left:1.5%;bottom:-6%;font-family:var(--font-display);font-size:clamp(5rem,22vw,20rem);font-weight:900;line-height:.75;letter-spacing:-.02em;color:rgba(13,58,102,.035);-webkit-text-stroke:1px rgba(255,122,0,.10);white-space:nowrap;pointer-events:none;user-select:none}
.bkk-ref-ornaments{position:absolute!important;inset:0;z-index:1;overflow:hidden;pointer-events:none;-webkit-mask-image:linear-gradient(90deg,transparent 0%,rgba(0,0,0,.35) 38%,#000 75%);mask-image:linear-gradient(90deg,transparent 0%,rgba(0,0,0,.35) 38%,#000 75%)}
.bkk-ref-ornament-image{position:absolute!important;inset:0;width:100%;height:100%;display:block;object-fit:cover;object-position:center;max-width:none}
.bkk-orn{position:absolute;inset:0;z-index:2;pointer-events:none;overflow:hidden}
.bkk-ring{position:absolute;width:380px;height:380px;right:-110px;top:-130px;border:1px solid rgba(13,58,102,.13);border-radius:50%}
.bkk-ring::before{content:"";position:absolute;inset:36px;border:1px dashed rgba(255,179,0,.38);border-radius:50%}
.bkk-dots{position:absolute;width:120px;height:120px;left:44%;bottom:8%;opacity:.4;background-image:radial-gradient(rgba(13,58,102,.4) 1.5px,transparent 1.6px);background-size:16px 16px}

.bkk-hero-inner{position:relative;z-index:4;width:100%;max-width:1360px;margin:0 auto;padding:clamp(3.5rem,9vh,6rem) clamp(1.25rem,4vw,4rem);display:grid;grid-template-columns:minmax(0,1.5fr) minmax(280px,.62fr);gap:clamp(2rem,5vw,4.5rem);align-items:center}
.bkk-kicker{display:inline-flex;align-items:center;gap:.65rem;margin-bottom:1.3rem;padding:.5rem .95rem .5rem .8rem;border:1px solid rgba(255,111,0,.22);border-radius:999px;background:#fff8f0;color:#d85f00;font-size:.82rem;font-weight:800}
.bkk-kicker::before{content:"";width:9px;height:9px;border-radius:50%;background:var(--orange);box-shadow:0 0 0 5px rgba(255,111,0,.13)}
.bkk-title{margin:0;max-width:880px;font-family:var(--font-display);font-size:clamp(3.4rem,9vw,7.6rem);line-height:.88;letter-spacing:-.035em;text-transform:uppercase}
.bkk-title .navy{display:block;color:var(--head)}
.bkk-title .gold{display:block;position:relative;width:fit-content;color:transparent;background:linear-gradient(135deg,#ffd54a 0%,#ffb300 48%,#ff7a00 100%);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent}
.bkk-title .gold::after{content:"";position:absolute;left:.03em;right:0;bottom:-.1em;height:.085em;border-radius:99px;background:linear-gradient(90deg,#ffb300,rgba(255,179,0,0));-webkit-text-fill-color:initial}
.bkk-lead{max-width:600px;margin:2rem 0 0;color:var(--text);font-size:1.04rem;line-height:1.85}

/* pills -> panel samping */
.bkk-pills{position:relative;display:flex;flex-direction:column;border-radius:22px;background:rgba(255,255,255,.88);-webkit-backdrop-filter:blur(10px);backdrop-filter:blur(10px);border:1px solid var(--line);box-shadow:0 26px 60px rgba(13,58,102,.14);overflow:hidden}
.bkk-pills::before{content:"";height:5px;background:linear-gradient(90deg,#ffd54a,#ffb300,#ff7a00)}
.bkk-pill{display:flex;align-items:center;gap:.95rem;padding:1.1rem 1.4rem;font-size:.92rem;font-weight:800;color:var(--head)}
.bkk-pill + .bkk-pill{border-top:1px dashed var(--line-2)}
.bkk-pill i{flex:none;width:42px;height:42px;display:grid;place-items:center;border-radius:13px 13px 13px 4px;background:var(--navy);color:var(--gold-2);font-size:1rem}

/* satu momen animasi saat halaman dibuka */
@keyframes bkk-rise{from{opacity:0;transform:translateY(22px)}to{opacity:1;transform:none}}
.bkk-title .navy,.bkk-title .gold{animation:bkk-rise .8s cubic-bezier(.2,.7,.2,1) both}
.bkk-title .gold{animation-delay:.12s}

/* =========================================================
   STRIP
   ========================================================= */
.bkk-strip{background:var(--navy);color:#fff;border-bottom:3px solid var(--gold-2)}
.bkk-strip-inner{max-width:1360px;margin:0 auto;display:flex;align-items:center;gap:1rem;padding:.9rem clamp(1.25rem,4vw,4rem)}
.bkk-strip-label{flex:none;display:inline-flex;align-items:center;gap:.4rem;padding:.42rem .85rem;border-radius:999px;background:linear-gradient(135deg,#ffd54a,#ffb300);color:var(--navy);font-size:.74rem;font-weight:900;white-space:nowrap}
.bkk-strip-text{min-width:0;font-size:.84rem;color:rgba(255,255,255,.88);white-space:nowrap;overflow:hidden;text-overflow:ellipsis}

/* =========================================================
   SECTION UMUM
   ========================================================= */
.bkk-section{position:relative;padding:clamp(3.5rem,7vw,6rem) clamp(1.25rem,5vw,5.5rem)}
.bkk-container{position:relative;z-index:2;max-width:1240px;margin:0 auto}
.bkk-head{display:flex;align-items:flex-end;justify-content:space-between;gap:2rem;margin-bottom:2.6rem}
.bkk-eyebrow{display:inline-flex;align-items:center;gap:.6rem;margin-bottom:.8rem;color:var(--link);font-size:.86rem;font-weight:800}
.bkk-eyebrow::before{content:"";width:28px;height:3px;border-radius:9px;background:linear-gradient(90deg,#ffd54a,#ffb300)}
.bkk-heading{margin:0;font-family:var(--font-display);font-size:clamp(2.1rem,4.4vw,3.5rem);line-height:1.04;letter-spacing:-.028em;color:var(--head)}
.bkk-heading em{font-style:normal;color:inherit;padding:0 .12em;margin:0 -.12em;background:linear-gradient(transparent 60%,var(--hl) 60%,var(--hl) 92%,transparent 92%);-webkit-box-decoration-break:clone;box-decoration-break:clone}
.bkk-sub{max-width:580px;margin:1rem 0 0;color:var(--text);font-size:.96rem;line-height:1.8}
.bkk-num{display:none}

/* =========================================================
   TENTANG BKK
   ========================================================= */
.bkk-intro{display:grid;grid-template-columns:repeat(12,minmax(0,1fr));gap:1.25rem}
.bkk-card{grid-column:span 7;background:var(--surf);border:1px solid var(--line);border-radius:26px;box-shadow:var(--shadow);padding:clamp(1.6rem,3vw,2.4rem)}
.bkk-card h3{margin:0 0 1rem;font-family:var(--font-display);font-size:clamp(1.3rem,2.2vw,1.7rem);line-height:1.2;letter-spacing:-.015em;color:var(--head)}
.bkk-card p{margin:0;max-width:62ch;color:var(--text);font-size:.92rem;line-height:1.9}
.bkk-vision{grid-column:span 5;position:relative;overflow:hidden;background:var(--navy);border-color:transparent;color:#fff}
.bkk-vision::before{content:"";position:absolute;right:-60px;top:-60px;width:220px;height:220px;border-radius:50%;border:1px dashed rgba(255,213,74,.4)}
.bkk-vision::after{content:"";position:absolute;left:1.4rem;bottom:1.2rem;width:90px;height:60px;opacity:.35;background-image:radial-gradient(rgba(255,255,255,.7) 1.4px,transparent 1.5px);background-size:14px 14px}
.bkk-vision h3{color:#fff;position:relative}
.bkk-vision p{color:rgba(235,245,253,.84);position:relative}
.bkk-quote{position:relative;margin-top:1.3rem;margin-bottom:2.2rem;padding:1.1rem 1.2rem;border-left:4px solid var(--gold-2);border-radius:0 14px 14px 0;background:rgba(255,255,255,.07);color:#fff;font-size:1rem;line-height:1.7;font-weight:700}

.bkk-photo-row{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:1.1rem;margin-top:1.4rem;align-items:start}
.bkk-photo-row img{display:block;width:100%;height:230px;object-fit:cover;border-radius:24px 24px 24px 6px;box-shadow:0 16px 38px rgba(13,58,102,.14)}
.bkk-photo-row img:nth-child(2){margin-top:2rem;border-radius:24px}
.bkk-photo-row img:nth-child(3){border-radius:6px 24px 24px 24px}

/* =========================================================
   MITRA INDUSTRI
   ========================================================= */
.bkk-partners{padding-top:1rem}
.ind-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:1.2rem}
.ind-card{display:flex;flex-direction:column;gap:.55rem;padding:1.5rem;background:var(--surf);border:1px solid var(--line);border-radius:22px;transition:border-color .2s ease,box-shadow .2s ease}
.ind-card:hover{border-color:var(--gold);box-shadow:var(--shadow)}
.ind-icon{width:54px;height:54px;display:grid;place-items:center;margin-bottom:.7rem;border-radius:17px 17px 17px 4px;background:var(--navy);color:var(--gold-2);font-family:var(--font-display);font-size:1.45rem;font-weight:900;line-height:1}
.ind-card h4{margin:0;font-family:var(--font-display);font-size:1.1rem;line-height:1.3;color:var(--head)}
.ind-field{align-self:flex-start;display:inline-flex;align-items:center;gap:.4rem;padding:.3rem .65rem;border-radius:999px;background:rgba(255,111,0,.09);color:#c85500;font-size:.76rem;font-weight:800}
.ind-scope{margin:auto 0 0;padding-top:.95rem;border-top:1px dashed var(--line-2);color:var(--text);font-size:.84rem;line-height:1.65}
.ind-card h4 + .ind-field + .ind-scope{margin-top:.6rem}

/* =========================================================
   LOWONGAN — kartu bergaya tiket
   ========================================================= */
.bkk-jobs{--jobs-bg:var(--bg-alt);background:var(--jobs-bg)}
.bkk-jobs::before{content:"";position:absolute;inset:0;pointer-events:none;background-image:linear-gradient(var(--line) 1px,transparent 1px),linear-gradient(90deg,var(--line) 1px,transparent 1px);background-size:44px 44px;opacity:.55;-webkit-mask-image:linear-gradient(180deg,#000,transparent 70%);mask-image:linear-gradient(180deg,#000,transparent 70%)}
.bkk-job-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:1.3rem}
.bkk-job{--st:var(--ok);position:relative;display:flex;flex-direction:column;gap:.8rem;padding:1.5rem 1.5rem 1.4rem 1.85rem;background:var(--surf);border:1px solid var(--line);border-radius:20px;box-shadow:0 10px 30px rgba(13,58,102,.06);overflow:hidden;transition:box-shadow .2s ease,border-color .2s ease}
.bkk-job::before{content:"";position:absolute;left:0;top:0;bottom:0;width:6px;background:var(--st)}
.bkk-job:hover{box-shadow:var(--shadow);border-color:var(--line-2)}
.bkk-job.is-open{--st:var(--ok)}
.bkk-job.is-upcoming{--st:var(--soon)}
.bkk-job.is-selesai{--st:var(--end)}
.bkk-job.is-archive{--st:var(--arc)}
.bkk-job-top{display:flex;align-items:center;justify-content:space-between;gap:.7rem;flex-wrap:wrap}
.bkk-status{display:inline-flex;align-items:center;gap:.45rem;padding:.38rem .8rem;border-radius:999px;font-size:.68rem;font-weight:900;letter-spacing:.03em}
.bkk-status.open{background:#e6f4ea;color:#1e7e43;border:1px solid #b7e1cd}
.bkk-status.upcoming{background:#fff6dc;color:#9a6b00;border:1px solid #ffe082}
.bkk-status.selesai{background:#fce8e6;color:#c5221f;border:1px solid #f6aea9}
.bkk-status.archive{background:#eef1f4;color:#64778b;border:1px solid #cbd5e1}
.bkk-date{display:inline-flex;align-items:center;gap:.35rem;color:var(--text);font-size:.76rem;font-weight:700}
.bkk-job h3{margin:.15rem 0 0;font-family:var(--font-display);font-size:1.3rem;line-height:1.25;letter-spacing:-.01em;color:var(--head)}
.bkk-job-co{color:var(--link);font-size:.88rem;font-weight:700;line-height:1.6}
.bkk-job-co i{margin-right:.25rem;color:var(--orange)}
.bkk-job p{margin:0;color:var(--text);font-size:.86rem;line-height:1.75}

/* sobekan tiket */
.bkk-job-meta{position:relative;display:flex;flex-wrap:wrap;align-items:center;gap:.5rem;margin-top:auto;padding-top:1.05rem;border-top:2px dashed var(--line-2)}
.bkk-job-meta::before,.bkk-job-meta::after{content:"";position:absolute;top:-9px;width:16px;height:16px;border-radius:50%;background:var(--jobs-bg);border:1px solid var(--line)}
.bkk-job-meta::before{left:calc(-1.85rem - 8px)}
.bkk-job-meta::after{right:calc(-1.5rem - 8px)}
.bkk-tag{display:inline-flex;align-items:center;gap:.4rem;padding:.45rem .8rem;border-radius:999px;background:var(--surf-2);border:1px solid var(--line);color:var(--head);font-size:.72rem;font-weight:700}
.bkk-tag.bkk-tag-apply{margin-left:auto;padding:.55rem 1.05rem;background:var(--navy);border-color:var(--navy);color:#fff;font-size:.78rem;font-weight:800;text-decoration:none;transition:background-color .2s ease,color .2s ease,border-color .2s ease}
.bkk-tag.bkk-tag-apply:hover{background:var(--gold);border-color:var(--gold);color:var(--navy)}

.bkk-empty{grid-column:1/-1;text-align:center;padding:3.2rem 1.5rem;background:var(--surf);border:2px dashed var(--line-2);border-radius:22px}
.bkk-empty p{margin:0;color:var(--text);font-size:.95rem}

.bkk-notice{position:relative;z-index:2;margin-top:1.6rem;padding:1.1rem 1.3rem;border-radius:0 16px 16px 0;background:#fffaf0;border:1px solid rgba(255,179,0,.3);border-left:5px solid var(--gold);color:#765d24;font-size:.84rem;line-height:1.7}
.bkk-notice i{margin-right:.4rem;color:var(--gold)}
.bkk-status-key{position:relative;z-index:2;display:flex;flex-wrap:wrap;gap:.6rem;margin-top:1.2rem}
.bkk-key{--c:var(--ok);display:inline-flex;align-items:center;gap:.5rem;padding:.5rem .85rem;border-radius:999px;background:var(--surf);border:1px solid var(--line);color:var(--text);font-size:.74rem;font-weight:700}
.bkk-key::before{content:"";width:9px;height:9px;border-radius:50%;background:var(--c)}
.bkk-key:nth-child(2){--c:var(--soon)}
.bkk-key:nth-child(3){--c:var(--end)}
.bkk-key:nth-child(4){--c:var(--arc)}
.bkk-key b{color:var(--head)}

/* =========================================================
   CTA
   ========================================================= */
.bkk-cta{padding:0 clamp(1.25rem,5vw,5.5rem) clamp(3.5rem,7vw,5.5rem)}
.bkk-cta-box{position:relative;isolation:isolate;overflow:hidden;max-width:1180px;margin:0 auto;padding:clamp(2.8rem,6vw,5rem) clamp(1.5rem,5vw,4rem);border-radius:30px;text-align:center;color:#fff;background:radial-gradient(circle at 85% 0%,rgba(255,179,0,.22),transparent 45%),linear-gradient(135deg,#0a2d52 0%,#0d3a66 60%,#12497f 100%);box-shadow:0 30px 70px rgba(13,58,102,.25)}
.bkk-cta-box::before{content:"";position:absolute;z-index:-1;width:420px;height:420px;left:-140px;bottom:-220px;border-radius:50%;border:1px solid rgba(255,255,255,.14)}
.bkk-cta-box::after{content:"";position:absolute;z-index:-1;width:260px;height:260px;right:-70px;top:-90px;border-radius:50%;border:1px dashed rgba(255,213,74,.35)}
.bkk-cta-box h2{margin:0 auto;max-width:760px;font-family:var(--font-display);font-size:clamp(2rem,4.4vw,3.4rem);line-height:1.08;letter-spacing:-.025em}
.bkk-cta-box h2 em{font-style:normal;color:var(--gold-2)}
.bkk-cta-box p{max-width:640px;margin:1.2rem auto 0;color:rgba(235,245,253,.8);font-size:.95rem;line-height:1.85}

/* =========================================================
   RESPONSIVE
   ========================================================= */
@media(max-width:1000px){
  .bkk-hero-inner{grid-template-columns:1fr}
  .bkk-pills{max-width:460px}
  .bkk-card,.bkk-vision{grid-column:1/-1}
}
@media(max-width:960px){.ind-grid{grid-template-columns:repeat(2,minmax(0,1fr))}}
@media(max-width:860px){
  .bkk-head{flex-direction:column;align-items:flex-start;gap:.5rem;margin-bottom:1.9rem}
  .bkk-ref-ornaments{-webkit-mask-image:linear-gradient(180deg,transparent 0%,rgba(0,0,0,.4) 45%,#000 100%);mask-image:linear-gradient(180deg,transparent 0%,rgba(0,0,0,.4) 45%,#000 100%)}
}
@media(max-width:720px){
  .bkk-job-grid{grid-template-columns:1fr}
  .bkk-photo-row{grid-template-columns:1fr;gap:.8rem}
  .bkk-photo-row img,.bkk-photo-row img:nth-child(2){height:190px;margin-top:0;border-radius:20px}
}
@media(max-width:640px){
  .bkk-hero{min-height:0;align-items:flex-start}
  .bkk-hero-inner{padding:2.8rem 1.25rem 2.6rem;gap:1.8rem}
  .bkk-hero::after{font-size:clamp(4rem,30vw,7rem);left:-2%}
  .bkk-title{font-size:clamp(2.7rem,14vw,4rem)}
  .bkk-lead{font-size:.92rem;line-height:1.75;margin-top:1.5rem}
  .bkk-pills{max-width:none}
  .bkk-pill{padding:.9rem 1.1rem;font-size:.86rem}
  .bkk-strip-inner{flex-direction:column;align-items:flex-start;gap:.5rem;padding:.8rem 1rem}
  .bkk-strip-text{white-space:normal;font-size:.8rem;line-height:1.55}
  .bkk-section{padding:2.6rem 1rem}
  .bkk-partners{padding-top:.5rem}
  .bkk-heading{font-size:clamp(1.8rem,8vw,2.4rem)}
  .bkk-sub{font-size:.88rem;line-height:1.7}
  .bkk-card{padding:1.4rem 1.2rem;border-radius:20px}
  .bkk-card p{font-size:.88rem;line-height:1.8}
  .ind-grid{grid-template-columns:1fr;gap:.9rem}
  .ind-card{padding:1.2rem;border-radius:18px}
  .bkk-job{padding:1.2rem 1.1rem 1.2rem 1.5rem;border-radius:18px;gap:.65rem}
  .bkk-job-top{flex-direction:column;align-items:flex-start;gap:.45rem}
  .bkk-job h3{font-size:1.15rem}
  .bkk-job-meta::before{left:calc(-1.5rem - 8px)}
  .bkk-job-meta::after{right:calc(-1.1rem - 8px)}
  .bkk-tag.bkk-tag-apply{margin-left:0;width:100%;justify-content:center}
  .bkk-notice{font-size:.8rem;padding:.9rem 1rem}
  .bkk-key{font-size:.7rem;padding:.4rem .7rem}
  .bkk-cta{padding:0 1rem 2.4rem}
  .bkk-cta-box{border-radius:22px;padding:2.4rem 1.2rem}
}

@media(prefers-reduced-motion:reduce){
  .bkk-title .navy,.bkk-title .gold{animation:none}
  .bkk-page *{transition:none!important}
}

/* =========================================================
   DARK MODE — aktif jika <html>/<body> punya data-theme="dark"
   atau class: dark | dark-mode | theme-dark
   Palet biru sama dengan halaman Prestasi Sekolah.
   ========================================================= */
:is([data-theme="dark"],.dark,.dark-mode,.theme-dark) .bkk-page{
  --bg:#081423;--bg-alt:#0b1b2f;--surf:#0f2340;--surf-2:#12294a;
  --head:#fff;--text:#9db0c6;--link:#8fb8e6;
  --line:rgba(255,255,255,.09);--line-2:rgba(255,255,255,.2);
  --shadow:0 18px 44px rgba(0,0,0,.5);
  --hl:rgba(255,179,0,.34);
  color-scheme:dark
}
:is([data-theme="dark"],.dark,.dark-mode,.theme-dark) .bkk-hero{background:#0a1a2e;color:#e6eef8}
:is([data-theme="dark"],.dark,.dark-mode,.theme-dark) .bkk-hero::after{color:rgba(255,255,255,.04);-webkit-text-stroke:1px rgba(255,179,0,.14)}
:is([data-theme="dark"],.dark,.dark-mode,.theme-dark) .bkk-ref-ornaments{opacity:.45;filter:invert(.92) hue-rotate(180deg) brightness(.9)}
:is([data-theme="dark"],.dark,.dark-mode,.theme-dark) .bkk-ring{border-color:rgba(255,255,255,.1)}
:is([data-theme="dark"],.dark,.dark-mode,.theme-dark) .bkk-ring::before{border-color:rgba(255,213,74,.25)}
:is([data-theme="dark"],.dark,.dark-mode,.theme-dark) .bkk-dots{background-image:radial-gradient(rgba(255,255,255,.35) 1.5px,transparent 1.6px);opacity:.3}
:is([data-theme="dark"],.dark,.dark-mode,.theme-dark) .bkk-kicker{background:rgba(255,111,0,.1);border-color:rgba(255,111,0,.35);color:#ff9a3d}
:is([data-theme="dark"],.dark,.dark-mode,.theme-dark) .bkk-pills{background:rgba(18,41,74,.82);border-color:rgba(255,255,255,.12);box-shadow:0 26px 60px rgba(0,0,0,.5)}
:is([data-theme="dark"],.dark,.dark-mode,.theme-dark) .bkk-pill{color:#e6eef8}
:is([data-theme="dark"],.dark,.dark-mode,.theme-dark) .bkk-pill i,
:is([data-theme="dark"],.dark,.dark-mode,.theme-dark) .ind-icon{background:var(--gold-2);color:var(--navy-2)}
:is([data-theme="dark"],.dark,.dark-mode,.theme-dark) .bkk-strip{background:var(--navy-3)}
:is([data-theme="dark"],.dark,.dark-mode,.theme-dark) .bkk-eyebrow{color:var(--gold-2)}
:is([data-theme="dark"],.dark,.dark-mode,.theme-dark) .bkk-vision{background:var(--surf-2);border-color:rgba(255,213,74,.2)}
:is([data-theme="dark"],.dark,.dark-mode,.theme-dark) .bkk-photo-row img{box-shadow:0 16px 38px rgba(0,0,0,.5)}
:is([data-theme="dark"],.dark,.dark-mode,.theme-dark) .ind-card:hover{border-color:rgba(255,213,74,.5)}
:is([data-theme="dark"],.dark,.dark-mode,.theme-dark) .ind-field{background:rgba(255,154,61,.12);color:#ff9a3d}
:is([data-theme="dark"],.dark,.dark-mode,.theme-dark) .bkk-job{box-shadow:0 10px 30px rgba(0,0,0,.35)}
:is([data-theme="dark"],.dark,.dark-mode,.theme-dark) .bkk-job-co i{color:#ff9a3d}
:is([data-theme="dark"],.dark,.dark-mode,.theme-dark) .bkk-status.open{background:rgba(52,168,83,.16);color:#7fdca0;border-color:rgba(127,220,160,.3)}
:is([data-theme="dark"],.dark,.dark-mode,.theme-dark) .bkk-status.upcoming{background:rgba(255,213,74,.14);color:#ffd54a;border-color:rgba(255,213,74,.35)}
:is([data-theme="dark"],.dark,.dark-mode,.theme-dark) .bkk-status.selesai{background:rgba(234,67,53,.16);color:#f59a93;border-color:rgba(245,154,147,.3)}
:is([data-theme="dark"],.dark,.dark-mode,.theme-dark) .bkk-status.archive{background:rgba(255,255,255,.07);color:var(--text);border-color:rgba(255,255,255,.14)}
:is([data-theme="dark"],.dark,.dark-mode,.theme-dark) .bkk-tag{color:#e6eef8;border-color:rgba(255,255,255,.1)}
:is([data-theme="dark"],.dark,.dark-mode,.theme-dark) .bkk-tag.bkk-tag-apply{background:linear-gradient(135deg,#ffd54a,#ffb300);border-color:transparent;color:#0a2d52}
:is([data-theme="dark"],.dark,.dark-mode,.theme-dark) .bkk-tag.bkk-tag-apply:hover{background:#fff;color:#0a2d52}
:is([data-theme="dark"],.dark,.dark-mode,.theme-dark) .bkk-notice{background:rgba(255,179,0,.08);border-color:rgba(255,213,74,.28);border-left-color:var(--gold);color:#e8d28f}
:is([data-theme="dark"],.dark,.dark-mode,.theme-dark) .bkk-cta{background:var(--bg-alt)}
:is([data-theme="dark"],.dark,.dark-mode,.theme-dark) .bkk-cta-box{background:radial-gradient(circle at 85% 0%,rgba(255,179,0,.14),transparent 45%),linear-gradient(135deg,#040c18 0%,#071a31 55%,#0a2340 100%);border:1px solid rgba(255,213,74,.16);box-shadow:0 34px 80px rgba(0,0,0,.6)}
:is([data-theme="dark"],.dark,.dark-mode,.theme-dark) .bkk-cta-box p{color:#a9bbd0}

/* transisi halus saat ganti tema */
.bkk-page,.bkk-hero,.bkk-jobs,.bkk-cta,.bkk-card,.ind-card,.bkk-job,.bkk-pills,.bkk-tag,.bkk-key{transition:background-color .35s ease,color .35s ease,border-color .35s ease,box-shadow .2s ease}
</style>
@endpush

@section('content')
<div class="bkk-page">
  <!-- HERO SECTION -->
  <section class="bkk-hero">
    <div class="bkk-ref-ornaments" aria-hidden="true">
      <img src="{{ asset('images/wide_minimalist_abstract_technology_background_des.png') }}" alt="" class="bkk-ref-ornament-image" aria-hidden="true">
    </div>
    <div class="bkk-orn" aria-hidden="true"><span class="bkk-ring"></span><span class="bkk-dots"></span></div>
    <div class="bkk-hero-inner">
      <div>
        <div class="bkk-kicker">Pusat Informasi Karier Skaneda</div>
        <h1 class="bkk-title"><span class="navy">BKK &amp;</span><span class="gold">Loker</span></h1>
        <p class="bkk-lead">Bursa Kerja Khusus SMK Negeri 2 Mojokerto — membantu siswa dan alumni menuju dunia kerja lewat informasi karier, rekrutmen industri, persiapan kerja, dan jejaring dengan dunia usaha.</p>
      </div>
      <div class="bkk-pills">
        <span class="bkk-pill"><i class="fas fa-briefcase"></i> Informasi Karier</span>
        <span class="bkk-pill"><i class="fas fa-building"></i> Rekrutmen Industri</span>
        <span class="bkk-pill"><i class="fas fa-user-graduate"></i> Siswa &amp; Alumni</span>
      </div>
    </div>
  </section>

  <div class="bkk-strip">
    <div class="bkk-strip-inner">
      <span class="bkk-strip-label"><i class="fas fa-bolt"></i> BKK Skaneda</span>
      <span class="bkk-strip-text">Informasi lowongan, kegiatan BKK, rekrutmen industri, persiapan karier, dan penelusuran lulusan.</span>
    </div>
  </div>

  <!-- SECTION: TENTANG BKK -->
  <section class="bkk-section">
    <div class="bkk-container">
      <div class="bkk-head">
        <div>
          <span class="bkk-eyebrow">Tentang BKK</span>
          <h2 class="bkk-heading">Mengenal <em>BKK Skaneda</em></h2>
          <p class="bkk-sub">BKK merupakan layanan sekolah yang menghubungkan kompetensi siswa dan alumni dengan kebutuhan dunia kerja.</p>
        </div>
        <div class="bkk-num">01</div>
      </div>
      <div class="bkk-intro">
        <article class="bkk-card">
          <h3>Bursa Kerja Khusus SMK Negeri 2 Mojokerto</h3>
          <p>BKK membantu siswa dan alumni memperoleh informasi, akses, serta pendampingan menuju dunia kerja. Kegiatannya mencakup pelayanan informasi kerja, penempatan dan penyaluran tenaga kerja, kerja sama dengan dunia kerja/dunia industri, administrasi pencari kerja, bimbingan industri dan jabatan, serta pemantauan perkembangan karier lulusan.</p>
          <p style="margin-top:.8rem">Layanan BKK juga berkembang melalui rekrutmen industri, workshop dan seminar karier, simulasi psikotes, job fair/job matching, kegiatan Alumni Berbagi, penelusuran alumni, dan tracer vokasi.</p>
        </article>
        <article class="bkk-card bkk-vision">
          <h3>Visi BKK</h3>
          <p>Komitmen BKK dalam memberikan pelayanan karier bagi masyarakat pendidikan.</p>
          <div class="bkk-quote">“Kami siap melayani masyarakat pendidikan dan pembelajaran berbasis budaya Kerja, Disiplin dan Berprestasi.”</div>
        </article>
      </div>
      <div class="bkk-photo-row">
        <img src="{{ asset('images/bkk/rekruitment-tongtji.png') }}" alt="Dokumentasi kegiatan BKK 1" loading="lazy">
        <img src="{{ asset('images/bkk/rekruitment-deabakery.png') }}" alt="Dokumentasi kegiatan BKK 2" loading="lazy">
        <img src="{{ asset('images/bkk/rekruitment-btpn.png') }}" alt="Dokumentasi kegiatan BKK 3" loading="lazy">
      </div>
    </div>
  </section>

  <!-- SECTION: DYNAMIC DUDI & MITRA INDUSTRI -->
  <section class="bkk-section bkk-partners">
    <div class="bkk-container">
      <div class="bkk-head">
        <div>
          <span class="bkk-eyebrow">DUDI &amp; Kemitraan</span>
          <h2 class="bkk-heading">Mitra <em>Industri</em></h2>
          <p class="bkk-sub">Kerja sama strategis SMKN 2 Mojokerto dengan perusahaan mitra untuk PKL, Kelas Industri, &amp; Rekrutmen Lulusan.</p>
        </div>
        <div class="bkk-num">02</div>
      </div>

      <div class="ind-grid">
        @forelse($industries as $ind)
          <article class="ind-card">
            <div class="ind-icon" aria-hidden="true">{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr(preg_replace('/^(PT|CV|UD)\.?\s+/i', '', $ind->company_name), 0, 1)) }}</div>
            <h4>{{ $ind->company_name }}</h4>
            <span class="ind-field"><i class="fas fa-layer-group"></i> {{ $ind->field_of_work ?? 'Industri Umum' }}</span>
            <p class="ind-scope">{{ $ind->partnership_scope ?? 'PKL & Rekrutmen Lulusan' }}</p>
          </article>
        @empty
          <article class="ind-card"><div class="ind-icon" aria-hidden="true">T</div><h4>PT Telkom Indonesia (Persero) Tbk</h4><span class="ind-field"><i class="fas fa-layer-group"></i> IT &amp; Telekomunikasi</span><p class="ind-scope">PKL, Kelas Industri &amp; Rekrutmen Lulusan</p></article>
          <article class="ind-card"><div class="ind-icon" aria-hidden="true">B</div><h4>Bank Syariah Indonesia (BSI)</h4><span class="ind-field"><i class="fas fa-layer-group"></i> Keuangan &amp; Perbankan</span><p class="ind-scope">Magang Industri &amp; Rekrutmen Alumni</p></article>
          <article class="ind-card"><div class="ind-icon" aria-hidden="true">H</div><h4>Hotel Vasa Surabaya</h4><span class="ind-field"><i class="fas fa-layer-group"></i> Hospitality &amp; Kuliner</span><p class="ind-scope">Praktik Kerja Lapangan Kuliner</p></article>
          <article class="ind-card"><div class="ind-icon" aria-hidden="true">C</div><h4>PT Cheil Jedang Indonesia</h4><span class="ind-field"><i class="fas fa-layer-group"></i> Manufaktur &amp; Olahan Pangan</span><p class="ind-scope">Kemitraan Rekrutmen &amp; Kunjungan Industri</p></article>
          <article class="ind-card"><div class="ind-icon" aria-hidden="true">P</div><h4>PT Perhutani Anugerah Kimia</h4><span class="ind-field"><i class="fas fa-layer-group"></i> Industri Hasil Hutan &amp; Kimia</span><p class="ind-scope">Kerja Sama Penyerapan Lulusan Vokasi</p></article>
        @endforelse
      </div>
    </div>
  </section>

  <!-- SECTION: DYNAMIC LOWONGAN KERJA -->
  <section class="bkk-section bkk-jobs">
    <div class="bkk-container">
      <div class="bkk-head">
        <div>
          <span class="bkk-eyebrow">Informasi Rekrutmen</span>
          <h2 class="bkk-heading">Loker &amp; <em>Rekrutmen</em></h2>
          <p class="bkk-sub">Daftar lowongan pekerjaan &amp; rekrutmen resmi BKK SMKN 2 Mojokerto.</p>
        </div>
        <div class="bkk-num">03</div>
      </div>

      <div class="bkk-job-grid">
        @forelse($jobVacancies as $job)
          @php
            $st = $job->status->value ?? $job->status;
            $statusClass = match($st) {
              'OPEN' => 'open',
              'UPCOMING' => 'upcoming',
              'SELESAI' => 'selesai',
              'ARSIP' => 'archive',
              default => 'open'
            };
            $statusIcon = match($st) {
              'OPEN' => 'fa-door-open',
              'UPCOMING' => 'fa-clock',
              'SELESAI' => 'fa-circle-check',
              'ARSIP' => 'fa-archive',
              default => 'fa-briefcase'
            };
            $statusLabel = match($st) {
              'OPEN' => 'OPEN (Pendaftaran Berlangsung)',
              'UPCOMING' => 'UPCOMING (Akan Datang)',
              'SELESAI' => 'SELESAI (Berakhir)',
              'ARSIP' => 'ARSIP (Dokumentasi)',
              default => $st
            };
          @endphp
          <article class="bkk-job is-{{ $statusClass }}">
            <div class="bkk-job-top">
              <span class="bkk-status {{ $statusClass }}">
                <i class="fas {{ $statusIcon }}"></i> {{ $statusLabel }}
              </span>
              @if($job->deadline)
                <span class="bkk-date"><i class="far fa-calendar-alt"></i> Batas: {{ \Carbon\Carbon::parse($job->deadline)->format('d M Y') }}</span>
              @endif
            </div>
            <h3>{{ $job->title }}</h3>
            <div class="bkk-job-co">
              <i class="fas fa-building"></i> {{ $job->company_name }}
              @if($job->location)
                &bull; <i class="fas fa-location-dot"></i> {{ $job->location }}
              @endif
            </div>
            <p>{{ Str::limit($job->description, 170) }}</p>
            <div class="bkk-job-meta">
              <span class="bkk-tag"><i class="fas fa-user-clock"></i> {{ $job->employment_type ?? 'Full-Time' }}</span>
              @if($job->apply_url)
                <a href="{{ $job->apply_url }}" target="_blank" rel="noopener" class="bkk-tag bkk-tag-apply">
                  Lamar Sekarang <i class="fas fa-arrow-up-right-from-square"></i>
                </a>
              @endif
            </div>
          </article>
        @empty
          <div class="bkk-empty">
            <p>Belum ada lowongan pekerjaan yang dipublikasikan saat ini.</p>
          </div>
        @endforelse
      </div>

      <div class="bkk-notice">
        <i class="fas fa-circle-info"></i> Informasi rekrutmen BKK dipublikasikan secara resmi. Seluruh proses pendaftaran dan seleksi BKK SMKN 2 Mojokerto <strong>TIDAK DIPUNGUT BIAYA (GRATIS)</strong>.
      </div>
      <div class="bkk-status-key">
        <span class="bkk-key"><b>OPEN</b> pendaftaran masih berlangsung</span>
        <span class="bkk-key"><b>UPCOMING</b> rekrutmen akan datang</span>
        <span class="bkk-key"><b>SELESAI</b> pendaftaran telah berakhir</span>
        <span class="bkk-key"><b>ARSIP</b> dokumentasi rekrutmen/kegiatan</span>
      </div>
    </div>
  </section>

  <!-- CTA SECTION -->
  <section class="bkk-cta">
    <div class="bkk-cta-box">
      <h2>Siap melangkah menuju <em>dunia kerja?</em></h2>
      <p>Pantau informasi rekrutmen, kegiatan BKK, pembekalan karier, dan berbagai kesempatan yang dipublikasikan oleh SMK Negeri 2 Mojokerto.</p>
    </div>
  </section>
</div>
@endsection