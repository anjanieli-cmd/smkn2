@extends('layouts.app')

@section('title', 'Ekstra Matchmaker — Temukan Ekstrakurikuler yang Cocok | SMK Negeri 2 Mojokerto')
@section('description', 'Ikuti kuis kepribadian singkat dan dapatkan rekomendasi Top 3 ekstrakurikuler SMK Negeri 2 Mojokerto yang paling cocok denganmu, lengkap dengan penjelasan, jadwal, dan cara bergabung.')

@push('styles')
<style>
/* =========================================================
   EKSTRA MATCHMAKER — LIGHT MODE
   Alur: Kuis (20 soal kepribadian) -> AI Processing -> Podium
   Top 3 Ekstrakurikuler (ala reveal juara kuis) -> Detail
   ekskul (deskripsi, jadwal, cara gabung) -> Ranking lengkap
   13 ekskul. Frontend-only (state machine JS, data ekskul &
   bobot skoring didefinisikan di script, gampang disambungkan
   ke backend nanti).
   Palet & shell visual DIPERTAHANKAN sama seperti versi jurusan:
   kertas terang (#f6f9fd / #ffffff), navy Skaneda (#0d3a66),
   gold (#ffd54a/#ffb300), teal (#0ea5b7) aksen "AI".
   Semua ikon Font Awesome 5-safe, tanpa emoji.
   ========================================================= */
.am-page{
  --am-bg:#f3f7fc; --am-card:#ffffff; --am-navy:#0d3a66; --am-navy-dark:#082846;
  --am-ink:#193a5c; --am-muted:#5c7590; --am-line:rgba(13,58,102,.12);
  --am-teal:#0ea5b7; --am-teal-ink:#0a7583; --am-gold:#ffd54a; --am-gold-deep:#ffb300;
  background:var(--am-bg);color:var(--am-ink);min-height:70vh;position:relative;overflow:hidden}
.am-page *{box-sizing:border-box}
.am-wrap{width:min(1480px,96%);margin:0 auto;padding:44px 0 100px;position:relative;z-index:3}

/* ---------- background: soft AI tech field on light paper ---------- */
.am-bgfield{position:absolute;inset:0;z-index:0;background:
  radial-gradient(1200px 620px at 12% -10%,rgba(14,165,183,.10),transparent 60%),
  radial-gradient(1000px 600px at 92% 6%,rgba(255,179,0,.10),transparent 60%),
  radial-gradient(1000px 760px at 50% 120%,rgba(13,58,102,.06),transparent 60%),
  var(--am-bg)}
.am-bgdots{position:absolute;inset:0;z-index:1;opacity:.55;pointer-events:none;
  background-image:radial-gradient(rgba(13,58,102,.09) 1.2px,transparent 1.3px);background-size:26px 26px}
.am-glow{position:absolute;border-radius:50%;filter:blur(80px);z-index:1;pointer-events:none}
.am-glow-a{width:420px;height:420px;top:-140px;right:6%;background:radial-gradient(circle,rgba(14,165,183,.16),transparent 70%)}
.am-glow-b{width:460px;height:460px;bottom:-180px;left:-120px;background:radial-gradient(circle,rgba(255,213,74,.20),transparent 70%)}

/* ---------- code-rain reveal overlay ---------- */
.am-coderain{position:fixed;inset:0;z-index:60;pointer-events:none;opacity:0;transition:opacity .6s ease}

/* ---------- top banner: premium AI hero ---------- */
.am-hero{position:relative;margin-bottom:2.6rem;padding:clamp(1.9rem,4vw,2.7rem) clamp(1.5rem,3.4vw,2.7rem);
  border-radius:28px;overflow:hidden;z-index:3;
  background:linear-gradient(120deg,#082846 0%,#0d3a66 48%,#0a3155 100%);color:#fff;
  box-shadow:0 30px 64px rgba(8,40,70,.36)}
.am-hero::before{content:"";position:absolute;inset:0;pointer-events:none;z-index:0;
  background-image:radial-gradient(rgba(255,255,255,.08) 1.3px,transparent 1.4px);background-size:20px 20px;opacity:.6}
.am-hero-glow-a{position:absolute;top:-90px;right:-50px;width:280px;height:280px;border-radius:50%;z-index:0;pointer-events:none;
  background:radial-gradient(circle,rgba(14,165,183,.38),rgba(14,165,183,0) 70%)}
.am-hero-glow-b{position:absolute;bottom:-100px;left:-70px;width:240px;height:240px;border-radius:50%;z-index:0;pointer-events:none;
  background:radial-gradient(circle,rgba(255,213,74,.22),rgba(255,213,74,0) 70%)}
.am-hero canvas.am-hero-net{display:block;position:absolute;inset:0;width:100%;height:100%;z-index:0;pointer-events:none;opacity:.5}
.am-hero-main{position:relative;z-index:2;flex:1 1 480px;min-width:0;max-width:760px;text-align:left}
/* ---- layout 2 kolom: kiri teks & CTA, kanan kartu preview.
   Sebelumnya am-hero-main dibatasi max-width 820px jadi di layar
   lebar sisi kanan hero kosong. Sekarang dibungkus flex row biar
   kartu preview ngisi ruang kosong itu. ---- */
.am-hero-inner{position:relative;z-index:2;display:flex;align-items:center;justify-content:space-between;gap:clamp(1.5rem,4vw,3rem)}
.am-hero-preview{flex:0 0 clamp(280px,26vw,340px);max-width:340px;background:rgba(255,255,255,.07);
  border:1px solid rgba(255,255,255,.16);border-radius:22px;padding:1.35rem 1.4rem 1.5rem;
  box-shadow:0 20px 44px rgba(4,14,28,.22)}
.am-hero h1{font-family:var(--font-display);font-weight:900;font-size:clamp(2rem,3.6vw,3rem);line-height:1.1;
  margin:0;color:#fff;letter-spacing:-.015em;text-align:left}
.am-hero h1 .am-title-line{display:block}
.am-hero h1 .am-title-gold{color:#ffd54a}
.am-hero p{margin:1.1rem 0 0;font-size:.85rem;color:rgba(230,242,253,.8);line-height:1.75;max-width:480px;text-align:left}
/* ---- kartu kanan: "cara kerja" (3 langkah vertikal, disambung garis)
   + chip info kuis, dipindah semua ke sisi kanan biar kolom kiri
   fokus ke judul & tombol aja, gak numpuk. ---- */
.am-hero-side{flex:0 0 clamp(280px,28vw,360px);max-width:360px;background:rgba(255,255,255,.07);
  border:1px solid rgba(255,255,255,.16);border-radius:22px;padding:1.5rem 1.5rem 1.6rem;
  box-shadow:0 20px 44px rgba(4,14,28,.22)}
.am-hero-side-head{display:flex;align-items:center;gap:.5rem;font-size:.66rem;font-weight:900;
  letter-spacing:.12em;text-transform:uppercase;color:#ffd54a;margin-bottom:1.25rem}
.am-hero-steps{display:flex;flex-direction:column}
.am-hero-step{position:relative;display:flex;align-items:flex-start;gap:.85rem;padding-bottom:1.25rem}
.am-hero-step:last-child{padding-bottom:0}
.am-hero-step::before{content:"";position:absolute;left:15px;top:32px;bottom:2px;width:2px;
  background:rgba(255,255,255,.16)}
.am-hero-step:last-child::before{display:none}
.am-hero-step-num{position:relative;z-index:1;width:31px;height:31px;border-radius:50%;flex:0 0 31px;
  display:flex;align-items:center;justify-content:center;font-weight:900;font-size:.82rem;color:#0d3a66;
  background:linear-gradient(135deg,#ffd54a,#ff8a00);box-shadow:0 4px 12px rgba(255,179,0,.4)}
.am-hero-step-info{padding-top:.15rem}
.am-hero-step-info strong{display:block;font-size:.85rem;font-weight:900;color:#fff;line-height:1.25}
.am-hero-step-info small{display:block;margin-top:.25rem;font-size:.72rem;font-weight:600;
  color:rgba(230,242,253,.68);line-height:1.4}
.am-hero-side-meta{display:grid;grid-template-columns:1fr 1fr;gap:.6rem;margin-top:1.4rem;
  padding-top:1.3rem;border-top:1px solid rgba(255,255,255,.14)}
.am-hero-side-meta .am-meta-chip{justify-content:flex-start;width:100%}
@media(max-width:900px){.am-hero-inner{flex-wrap:wrap}.am-hero-side{flex:1 1 100%;max-width:none;margin-top:1.8rem}}
.am-badge-ai{display:inline-flex;align-items:center;gap:.55rem;font-size:.68rem;font-weight:900;letter-spacing:.16em;
  text-transform:uppercase;color:var(--am-teal-ink);margin-bottom:1.1rem;padding:.55rem .95rem;border-radius:999px;
  border:1px solid rgba(14,165,183,.3);background:rgba(14,165,183,.08)}
.am-hero .am-badge-ai{color:#fff}
.am-badge-ai i{font-size:.75rem;animation:amPulseIcon 2.4s ease-in-out infinite}
@keyframes amPulseIcon{0%,100%{opacity:1}50%{opacity:.4}}
.am-hero-meta{display:flex;align-items:center;gap:.7rem;margin-top:1.1rem;flex-wrap:wrap;justify-content:flex-start}
.am-meta-chip{display:inline-flex;align-items:center;gap:.5rem;padding:.55rem .85rem;border-radius:999px;
  background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.14);
  font-size:.72rem;font-weight:800;color:rgba(230,242,253,.9)}
.am-meta-chip i{color:#ffd54a;font-size:.7rem}
/* ---- CTA utama: gede & nyala, biar langsung ketangkep mata sebagai
   tombol yang harus diklik, gak ketelen sama background navy. ---- */
.am-hero-cta{display:inline-flex;align-items:center;gap:1rem;margin-top:2rem;padding:1.05rem 1.6rem 1.05rem 1.05rem;
  border-radius:18px;text-decoration:none;color:#0d3a66;
  background:linear-gradient(135deg,#ffd54a 0%,#ffb300 100%);border:none;
  box-shadow:0 16px 34px rgba(255,179,0,.35),0 6px 14px rgba(4,14,28,.25);
  transition:transform .3s ease,box-shadow .3s ease}
.am-hero-cta:hover{transform:translateY(-4px) scale(1.015);
  box-shadow:0 22px 44px rgba(255,179,0,.45),0 8px 18px rgba(4,14,28,.3)}
.am-hero-cta-icon{width:50px;height:50px;border-radius:14px;display:grid;place-items:center;flex:0 0 50px;
  background:rgba(13,58,102,.14);color:#0d3a66;font-size:1.05rem}
.am-hero-cta strong{display:block;font-size:1.05rem;line-height:1.15;font-weight:900;letter-spacing:.01em;color:#0d3a66}
.am-hero-cta small{display:block;margin-top:.25rem;color:rgba(13,58,102,.72);font-size:.76rem;font-weight:700}
.am-hero-cta-arrow{margin-left:.3rem;color:#0d3a66;font-size:1.1rem;transition:transform .3s ease}
.am-hero-cta:hover .am-hero-cta-arrow{transform:translateX(4px)}
.am-hero-live{position:absolute;top:clamp(1.5rem,3vw,2.1rem);right:clamp(1.5rem,3vw,2.1rem);z-index:3;
  display:inline-flex;align-items:center;gap:.65rem;font-size:.74rem;font-weight:800;color:#0d3a66;
  background:#fff;border-radius:999px;padding:.55rem .95rem;white-space:nowrap;box-shadow:0 16px 34px rgba(4,14,28,.32)}
.am-hero-live-dot{width:8px;height:8px;border-radius:50%;background:#22c55e;flex:0 0 8px;animation:amLiveDot 2s infinite}
@keyframes amLiveDot{0%{box-shadow:0 0 0 0 rgba(34,197,94,.55)}70%{box-shadow:0 0 0 8px rgba(34,197,94,0)}100%{box-shadow:0 0 0 0 rgba(34,197,94,0)}}
@media(max-width:640px){
  .am-hero-live{position:static;display:inline-flex;margin-top:1.2rem}
  .am-hero h1{font-size:clamp(1.8rem,8vw,2.5rem)}
  .am-hero-cta{width:100%}
}



/* ---------- shared panel/card shell ---------- */
.am-panel{display:none}
.am-panel.active{display:block;animation:amFadeIn .5s var(--ease,ease) both}
@keyframes amFadeIn{from{opacity:0;transform:translateY(16px)}to{opacity:1;transform:none}}
.am-card{position:relative;background:var(--am-card);border:1px solid var(--am-line);border-radius:26px;
  padding:clamp(1.6rem,4vw,2.8rem);box-shadow:0 26px 60px rgba(13,58,102,.08)}
.am-card::before{content:"";position:absolute;inset:0;border-radius:26px;padding:1px;pointer-events:none;
  background:linear-gradient(135deg,rgba(14,165,183,.35),rgba(255,255,255,0) 30%,rgba(255,179,0,.25) 100%);
  -webkit-mask:linear-gradient(#000 0 0) content-box,linear-gradient(#000 0 0);
  -webkit-mask-composite:xor;mask-composite:exclude}

/* ---------- QUIZ — QUIZIZZ-STYLE STAGE ---------- */
.qz-stage{position:relative;background:#fff;border:1px solid var(--am-line);border-radius:26px;
  scroll-margin-top:clamp(90px,14vw,140px);
  padding:clamp(1.4rem,3.6vw,2.3rem);box-shadow:0 26px 60px rgba(13,58,102,.08);overflow:hidden}
.qz-topbar{display:flex;align-items:center;justify-content:space-between;gap:1rem;margin-bottom:1rem}
.qz-qcounter{display:inline-flex;align-items:center;gap:.5rem;background:#f2eefb;border-radius:999px;
  padding:.5rem 1rem;font-size:.76rem;font-weight:800;color:#46178f}
.qz-qcounter i{font-size:.7rem;color:#8854d0}
.qz-timer{position:relative;width:46px;height:46px;flex:0 0 46px}
.qz-timer svg{width:100%;height:100%;transform:rotate(-90deg)}
.qz-timer circle{fill:none;stroke-width:5}
.qz-timer-track{stroke:#eef0f5}
.qz-timer-fill{stroke:#8854d0;stroke-linecap:round;stroke-dasharray:176;stroke-dashoffset:0;transition:stroke-dashoffset 1s linear}
.qz-timer span{position:absolute;inset:0;display:flex;align-items:center;justify-content:center;font-size:.78rem;font-weight:900;color:#46178f}
.qz-timer.qz-timer-low .qz-timer-fill{stroke:#e21b3c}
.qz-timer.qz-timer-low span{color:#e21b3c}
.qz-progressbar{height:8px;border-radius:99px;background:#eef1f6;overflow:hidden;margin-bottom:1.8rem}
.qz-progressbar-fill{height:100%;border-radius:99px;background:linear-gradient(90deg,#8854d0,#e21b3c,#ffa602,#26890c);
  width:0%;transition:width .5s var(--ease,ease)}
.qz-question-wrap{text-align:center;margin-bottom:1.8rem}
.qz-question-tag{display:inline-flex;align-items:center;gap:.5rem;font-size:.66rem;font-weight:900;letter-spacing:.16em;
  text-transform:uppercase;color:#8854d0;background:rgba(136,84,208,.1);border-radius:999px;padding:.4rem .9rem;margin-bottom:1.1rem}
.qz-question{font-family:var(--font-display);font-size:clamp(1.4rem,3.2vw,2.15rem);font-weight:900;color:#1a1a2e;
  line-height:1.28;margin:0 auto;max-width:720px;letter-spacing:-.01em}
.qz-options{display:grid;grid-template-columns:1fr 1fr;gap:1rem;max-width:840px;margin:0 auto}
.qz-opt{position:relative;display:flex;align-items:center;gap:.9rem;text-align:left;padding:1.1rem 1.3rem;
  border-radius:16px;border:none;cursor:pointer;color:#fff;font-size:.92rem;font-weight:800;line-height:1.35;
  transition:transform .18s ease,filter .18s ease,box-shadow .18s ease,opacity .25s ease;
  box-shadow:0 8px 0 rgba(0,0,0,.15),0 14px 26px rgba(0,0,0,.12)}
.qz-opt:hover{filter:brightness(1.06);transform:translateY(-2px)}
.qz-opt:active{transform:translateY(3px);box-shadow:0 4px 0 rgba(0,0,0,.15),0 8px 16px rgba(0,0,0,.1)}
.qz-opt-0{background:#e21b3c}
.qz-opt-1{background:#1368ce}
.qz-opt-2{background:#d89e00}
.qz-opt-3{background:#26890c}
.qz-opt-shape{width:32px;height:32px;flex:0 0 32px;display:flex;align-items:center;justify-content:center}
.qz-opt-shape span{display:block;background:#fff}
.qz-shape-triangle{width:0!important;height:0!important;background:none!important;
  border-left:13px solid transparent;border-right:13px solid transparent;border-bottom:22px solid #fff}
.qz-shape-diamond{width:19px;height:19px;transform:rotate(45deg);border-radius:3px}
.qz-shape-circle{width:22px;height:22px;border-radius:50%}
.qz-shape-square{width:19px;height:19px;border-radius:4px}
.qz-opt-text{flex:1}
/* ---- state: satu opsi dipilih ---- */
/* opsi yang DIPILIH: naik dikit, outline putih tebal + cincin glow warna
   opsi itu sendiri (biar keliatan "nyala") + sedikit membesar biar
   jelas beda dari kondisi normal, bukan cuma outline tipis. */
.qz-opt.selected{outline:4px solid #fff;outline-offset:-4px;
  transform:translateY(-3px) scale(1.035);z-index:2;
  box-shadow:0 0 0 5px rgba(255,255,255,.55),0 14px 0 rgba(0,0,0,.15),0 22px 34px rgba(0,0,0,.28);
  animation:qzSelectPop .34s cubic-bezier(.4,1.6,.4,1)}
@keyframes qzSelectPop{0%{transform:translateY(-3px) scale(1)}55%{transform:translateY(-3px) scale(1.09)}100%{transform:translateY(-3px) scale(1.035)}}
/* opsi LAIN yang gak dipilih: diredupin biar mata langsung ketarik
   ke opsi yang barusan diklik, bukan sama-sama terang semua. */
.qz-opt.dimmed{opacity:.38;filter:grayscale(.25) brightness(.9);transform:scale(.96);
  pointer-events:none;box-shadow:0 8px 0 rgba(0,0,0,.1),0 10px 18px rgba(0,0,0,.08)}
.qz-opt-check{position:absolute;top:-11px;right:-11px;width:32px;height:32px;border-radius:50%;background:#fff;
  color:#26890c;display:flex;align-items:center;justify-content:center;font-size:.9rem;
  box-shadow:0 6px 16px rgba(0,0,0,.3),0 0 0 3px rgba(255,255,255,.9);
  transform:scale(0);transition:transform .35s cubic-bezier(.4,1.8,.4,1)}
.qz-opt.selected .qz-opt-check{transform:scale(1)}
.qz-foot{display:flex;justify-content:flex-start;margin-top:1.7rem}
.qz-back{display:inline-flex;align-items:center;gap:.5rem;background:none;border:1.5px solid var(--am-line);
  color:var(--am-muted);padding:.6rem 1.1rem;border-radius:999px;font-size:.76rem;font-weight:700;cursor:pointer;
  transition:all .25s var(--ease,ease)}
.qz-back:hover{border-color:#8854d0;color:#8854d0}
.qz-back:disabled{opacity:.35;cursor:not-allowed}
@media(max-width:640px){
  .qz-options{grid-template-columns:1fr}
  .qz-question{font-size:1.25rem}
  .qz-topbar{gap:.6rem}
}

/* ---------- PROCESSING (AI thinking) ---------- */
.am-proc{text-align:center;padding:1.4rem 0}
.am-proc-ring{width:110px;height:110px;margin:0 auto 1.6rem;position:relative}
.am-proc-ring svg{width:100%;height:100%;transform:rotate(-90deg)}
.am-proc-ring circle{fill:none;stroke-width:5}
.am-proc-ring .track{stroke:var(--am-line)}
.am-proc-ring .fill{stroke:url(#amGradient);stroke-linecap:round;stroke-dasharray:305;stroke-dashoffset:305;
  transition:stroke-dashoffset .3s linear}
.am-proc-ring-icon{position:absolute;inset:0;display:flex;align-items:center;justify-content:center;color:var(--am-teal-ink);font-size:1.5rem;
  animation:amPulseIcon 1.6s ease-in-out infinite}
.am-proc h2{font-family:var(--font-display);font-size:1.25rem;font-weight:800;color:var(--am-navy-dark);margin:0 0 1.4rem}
.am-proc-log{max-width:420px;margin:0 auto;text-align:left;display:grid;gap:.65rem;min-height:132px}
.am-proc-line{display:flex;align-items:center;gap:.65rem;font-size:.8rem;color:rgba(25,58,92,.35);opacity:0;
  transform:translateX(-8px);transition:all .4s var(--ease,ease)}
.am-proc-line.is-shown{opacity:1;transform:none;color:var(--am-ink)}
.am-proc-line.is-done i{color:var(--am-teal-ink)}
.am-proc-line i{width:16px;text-align:center;font-size:.75rem;color:rgba(25,58,92,.3)}



.am-narrative{display:flex;gap:.9rem;background:rgba(14,165,183,.06);border:1px solid rgba(14,165,183,.22);
  border-radius:16px;padding:1.1rem 1.2rem;margin-top:1.8rem}
.am-narrative i{color:var(--am-teal-ink);font-size:1rem;margin-top:.15rem;flex:0 0 18px}
.am-narrative p{margin:0;font-size:.82rem;color:var(--am-ink);line-height:1.8}


.am-result-actions{display:flex;justify-content:center;gap:.8rem;margin-top:2rem;flex-wrap:wrap}
.am-btn{display:inline-flex;align-items:center;gap:.55rem;padding:.85rem 1.7rem;border-radius:999px;border:none;
  background:linear-gradient(135deg,var(--am-gold),var(--am-gold-deep));color:var(--am-navy-dark);font-weight:800;font-size:.85rem;cursor:pointer;
  text-decoration:none;box-shadow:0 14px 32px rgba(255,179,0,.28);transition:transform .25s var(--ease,ease),box-shadow .25s var(--ease,ease)}
.am-btn:hover{transform:translateY(-2px);box-shadow:0 18px 40px rgba(255,179,0,.38)}
.am-btn i{font-size:.74rem}

/* ---------- EXPLORE tabs + detail ---------- */
.am-section-head{text-align:left;max-width:680px;margin:0 0 2.2rem}
.am-section-head span.tag{display:inline-flex;align-items:center;gap:.6rem;font-size:.7rem;font-weight:800;letter-spacing:.2em;
  text-transform:uppercase;color:var(--am-teal-ink);margin-bottom:1rem}
.am-section-head span.tag::before{content:"";width:24px;height:3px;border-radius:99px;background:linear-gradient(90deg,var(--am-teal),var(--am-gold-deep))}
.am-section-head h2{font-family:var(--font-display);font-size:clamp(2.1rem,4.6vw,3.6rem);font-weight:900;
  color:var(--am-navy-dark);margin:0;line-height:1.02;letter-spacing:-.015em;text-transform:uppercase}
.am-section-head h2 span{background:linear-gradient(135deg,var(--am-gold) 0%,var(--am-gold-deep) 45%,var(--am-teal) 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent}
.am-section-head p{font-size:.85rem;color:var(--am-muted);margin:1rem 0 0;line-height:1.75;max-width:520px}



/* ---------- CARA GABUNG ---------- */
.am-join-box{display:flex;align-items:center;justify-content:space-between;gap:1.6rem;flex-wrap:wrap;
  background:linear-gradient(120deg,rgba(13,58,102,.05),rgba(255,179,0,.07));
  border:1px solid var(--am-line);border-radius:22px;padding:1.7rem 1.9rem}
.am-join-left{display:flex;align-items:center;gap:1.1rem;flex:1 1 320px;min-width:0}
.am-join-icon{width:52px;height:52px;border-radius:16px;flex:0 0 52px;display:flex;align-items:center;justify-content:center;
  background:linear-gradient(135deg,var(--am-gold),var(--am-gold-deep));color:var(--am-navy-dark);font-size:1.2rem;
  box-shadow:0 12px 26px rgba(255,179,0,.28)}
.am-join-text h3{font-family:var(--font-display);font-size:1.15rem;font-weight:800;color:var(--am-navy-dark);margin:0 0 .5rem}
.am-join-text p{font-size:.82rem;color:var(--am-muted);margin:0;max-width:460px;line-height:1.75}
.am-join-quota{display:flex;align-items:center;gap:.6rem;margin-top:1rem;font-size:.74rem;font-weight:700;color:var(--am-gold-deep)}
.am-join-box .am-btn{flex:0 0 auto}
@media(max-width:640px){.am-join-box{padding:1.4rem}.am-join-box .am-btn{width:100%;justify-content:center}}

/* ---------- PODIUM: Top 3 hasil ala leaderboard kuis ---------- */
.am-podium-block{padding-bottom:1.6rem}
.am-podium-tag{text-align:center;display:flex;justify-content:center}
.am-podium-title{font-family:var(--font-display);font-size:clamp(1.7rem,3.6vw,2.5rem);font-weight:900;
  color:var(--am-navy-dark);text-align:center;margin:.6rem 0 .3rem;letter-spacing:-.01em}
.am-podium-title span{color:var(--am-gold-deep)}
.am-podium-sub{text-align:center;font-size:.84rem;color:var(--am-muted);max-width:480px;margin:0 auto 2rem;line-height:1.7}
.am-podium{display:flex;align-items:flex-end;justify-content:center;gap:clamp(.6rem,2vw,1.4rem);
  max-width:720px;margin:0 auto;min-height:290px}
.am-podium-spot{display:flex;flex-direction:column;align-items:center;width:clamp(96px,26vw,170px);
  opacity:0;transform:translateY(30px) scale(.92);transition:all .6s cubic-bezier(.22,.9,.3,1)}
.am-podium-spot.show{opacity:1;transform:translateY(0) scale(1)}
.am-podium-trophy{font-size:1.6rem;margin-bottom:.5rem;color:var(--am-gold-deep);
  transform:scale(0);transition:transform .5s cubic-bezier(.4,1.8,.4,1) .15s}
.am-podium-spot.show .am-podium-trophy{transform:scale(1)}
.am-podium-rank2 .am-podium-trophy,.am-podium-rank3 .am-podium-trophy{color:#9db3c7}
.am-podium-icon{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;
  background:linear-gradient(135deg,var(--am-gold),var(--am-gold-deep));color:var(--am-navy-dark);font-size:1.3rem;
  margin-bottom:.7rem;box-shadow:0 12px 26px rgba(255,179,0,.28)}
.am-podium-rank2 .am-podium-icon,.am-podium-rank3 .am-podium-icon{background:linear-gradient(135deg,#dbe6f0,#aebdcb);box-shadow:0 10px 20px rgba(13,58,102,.14)}
.am-podium-name{font-family:var(--font-display);font-size:.95rem;font-weight:900;color:var(--am-navy-dark);text-align:center;margin-bottom:.2rem}
.am-podium-pct{font-size:.78rem;font-weight:800;color:var(--am-teal-ink);margin-bottom:.7rem}
.am-podium-base{width:100%;border-radius:14px 14px 0 0;background:linear-gradient(180deg,#fff,#f7fafd);
  border:1.5px solid var(--am-line);border-bottom:none;display:flex;align-items:flex-start;justify-content:center;
  padding-top:.6rem;font-family:var(--font-display);font-weight:900;color:var(--am-navy-dark)}
.am-podium-rank1{order:2}.am-podium-rank2{order:1}.am-podium-rank3{order:3}
.am-podium-rank1 .am-podium-base{height:118px;font-size:2.4rem;background:linear-gradient(180deg,#fff8e4,#ffe9ad);border-color:rgba(255,179,0,.5)}
.am-podium-rank2 .am-podium-base{height:82px;font-size:1.9rem}
.am-podium-rank3 .am-podium-base{height:58px;font-size:1.9rem}
.am-podium-rank1 .am-podium-icon{width:66px;height:66px;font-size:1.5rem}
.am-podium-rank1 .am-podium-name{font-size:1.05rem}
@media(max-width:560px){.am-podium{gap:.5rem}.am-podium-spot{width:30vw}}

/* ---------- daftar lengkap ranking 13 ekskul ---------- */
.am-ekslist-title{font-size:.72rem;font-weight:800;letter-spacing:.08em;text-transform:uppercase;color:var(--am-muted);margin:2.2rem 0 .9rem;text-align:center}
.am-ekslist{display:grid;gap:.7rem;max-width:640px;margin:0 auto}
.am-eksrow{display:grid;grid-template-columns:28px 1fr 120px 44px;align-items:center;gap:.8rem}
.am-eksrow-rank{font-size:.72rem;font-weight:900;color:var(--am-muted);text-align:center}
.am-eksrow-name{font-size:.8rem;font-weight:800;color:var(--am-ink)}
.am-eksrow-bar{height:7px;border-radius:99px;background:var(--am-line);overflow:hidden}
.am-eksrow-bar-fill{height:100%;border-radius:99px;background:linear-gradient(90deg,var(--am-navy),var(--am-teal));width:0%;transition:width 1s var(--ease,ease)}
.am-eksrow-pct{font-size:.76rem;font-weight:800;color:var(--am-teal-ink);text-align:right}
@media(max-width:560px){.am-eksrow{grid-template-columns:22px 1fr 74px 36px;gap:.5rem}}

/* ---------- detail tab utk top 3 ---------- */
.am-eks-tabs{display:flex;justify-content:center;gap:.6rem;flex-wrap:wrap;margin-bottom:1.8rem}
.am-eks-tab{display:inline-flex;align-items:center;gap:.5rem;padding:.6rem 1.1rem;border-radius:999px;
  border:1.5px solid var(--am-line);background:#fff;color:var(--am-muted);
  font-size:.76rem;font-weight:800;cursor:pointer;transition:all .25s var(--ease,ease)}
.am-eks-tab i{font-size:.72rem}
.am-eks-tab .am-eks-tab-pct{font-size:.65rem;font-weight:900;color:var(--am-teal-ink);background:rgba(14,165,183,.12);
  padding:.15rem .45rem;border-radius:999px}
.am-eks-tab:hover{border-color:rgba(255,179,0,.55)}
.am-eks-tab.active{background:linear-gradient(135deg,var(--am-gold),var(--am-gold-deep));border-color:var(--am-gold-deep);color:var(--am-navy-dark)}
.am-eks-tab.active .am-eks-tab-pct{background:rgba(13,58,102,.14);color:var(--am-navy-dark)}

.am-eks-detail{display:grid;grid-template-columns:1fr 1fr;gap:1.6rem}
.am-eks-block h4{display:flex;align-items:center;gap:.5rem;font-size:.72rem;font-weight:900;letter-spacing:.08em;
  text-transform:uppercase;color:var(--am-teal-ink);margin:0 0 .9rem}
.am-eks-desc{font-size:.84rem;color:var(--am-ink);line-height:1.85;margin:0 0 1.4rem}
.am-eks-info-list{list-style:none;margin:0 0 1.4rem;padding:0;display:grid;gap:.6rem}
.am-eks-info-list li{display:flex;align-items:flex-start;gap:.6rem;font-size:.8rem;color:var(--am-ink);line-height:1.6}
.am-eks-info-list li i{color:var(--am-gold-deep);margin-top:.2rem;font-size:.78rem;flex:0 0 16px}
.am-eks-info-list b{color:var(--am-navy-dark)}
.am-eks-act-list{list-style:none;margin:0;padding:0;display:grid;gap:.65rem}
.am-eks-act-list li{display:flex;align-items:flex-start;gap:.6rem;font-size:.8rem;color:var(--am-ink);line-height:1.6}
.am-eks-act-list li i{color:var(--am-teal-ink);margin-top:.2rem;font-size:.72rem;flex:0 0 14px}
@media(max-width:820px){.am-eks-detail{grid-template-columns:1fr}}

/* section spacing between stacked reveal blocks */
.am-stack > * + *{margin-top:1.6rem}
.am-restart-row{text-align:center;margin-top:2.2rem}
.am-restart-row button{display:inline-flex;align-items:center;gap:.5rem;background:none;border:none;color:var(--am-muted);
  font-size:.78rem;font-weight:700;cursor:pointer}
.am-restart-row button:hover{color:var(--am-teal-ink)}

/* responsive */
@media(max-width:820px){
  .am-eks-detail{grid-template-columns:1fr}
  .am-runner{grid-template-columns:110px 1fr 40px;gap:.7rem}
  .am-join-box{flex-direction:column;align-items:flex-start;text-align:left}
}
@media(max-width:560px){
  .am-wrap{padding:32px 0 70px}
  .am-card{border-radius:20px}
}
</style>
@endpush

@section('content')
<div class="am-page">
  <div class="am-bgfield" aria-hidden="true"></div>
  <div class="am-bgdots" aria-hidden="true"></div>
  <span class="am-glow am-glow-a" aria-hidden="true"></span>
  <span class="am-glow am-glow-b" aria-hidden="true"></span>
  <canvas class="am-coderain" id="amCodeRain" aria-hidden="true"></canvas>

  <svg width="0" height="0" style="position:absolute">
    <defs>
      <linearGradient id="amGradient" x1="0%" y1="0%" x2="100%" y2="100%">
        <stop offset="0%" stop-color="#0ea5b7"/>
        <stop offset="100%" stop-color="#ffb300"/>
      </linearGradient>
      <linearGradient id="amGradient2" x1="0%" y1="0%" x2="100%" y2="100%">
        <stop offset="0%" stop-color="#0ea5b7"/>
        <stop offset="55%" stop-color="#ffd54a"/>
        <stop offset="100%" stop-color="#ffb300"/>
      </linearGradient>
    </defs>
  </svg>

  <div class="am-wrap">

    <!-- ================= PANEL: INTRO (hero + ajakan mulai kuis jadi satu) ================= -->
    <div class="am-panel active" data-panel="intro" id="amQuizStart">
      <div class="am-hero">
        <span class="am-hero-glow-a" aria-hidden="true"></span>
        <span class="am-hero-glow-b" aria-hidden="true"></span>
        <canvas class="am-hero-net" id="amHeroNet" style="position:absolute;inset:0;width:100%;height:100%" aria-hidden="true"></canvas>
        <div class="am-hero-inner">
        <div class="am-hero-main">
          <span class="am-badge-ai"><i class="fas fa-robot"></i> Ekstra Matchmaker</span>
          <h1>
            <span class="am-title-line">TEMUKAN EKSTRAKURIKULER</span>
            <span class="am-title-line am-title-gold">PALING COCOK BUATMU</span>
          </h1>
          <p>Jawab 20 pertanyaan singkat tentang keseharian & kepribadianmu, terus lihat Top 3 ekstrakurikuler yang paling cocok buatmu.</p>
          <button type="button" class="am-hero-cta" id="amStartQuizBtn" style="appearance:none;border:none;font:inherit;cursor:pointer">
            <span class="am-hero-cta-icon"><i class="fas fa-wand-magic-sparkles"></i></span>
            <span><strong>Mulai Kuis Sekarang</strong><small>Cari tahu ekskul yang paling cocok buatmu</small></span>
            <i class="fas fa-arrow-right am-hero-cta-arrow"></i>
          </button>
        </div>
        <div class="am-hero-side">
          <div class="am-hero-side-head"><i class="fas fa-diagram-project" aria-hidden="true"></i> Cara Kerjanya</div>
          <div class="am-hero-steps">
            <div class="am-hero-step">
              <span class="am-hero-step-num">1</span>
              <div class="am-hero-step-info"><strong>Jawab 20 Soal</strong><small>Tentang keseharian & kepribadianmu</small></div>
            </div>
            <div class="am-hero-step">
              <span class="am-hero-step-num">2</span>
              <div class="am-hero-step-info"><strong>AI Cocokkan</strong><small>Pola jawabanmu ke 13 ekskul</small></div>
            </div>
            <div class="am-hero-step">
              <span class="am-hero-step-num">3</span>
              <div class="am-hero-step-info"><strong>Lihat Top 3</strong><small>Rekomendasi + alasannya</small></div>
            </div>
          </div>
          <div class="am-hero-side-meta">
            <span class="am-meta-chip"><i class="fas fa-list-ol"></i> 20 Pertanyaan</span>
            <span class="am-meta-chip"><i class="fas fa-hourglass-half"></i> ~5 Menit</span>
            <span class="am-meta-chip"><i class="fas fa-people-group"></i> 13 Ekskul</span>
            <span class="am-meta-chip"><i class="fas fa-stopwatch"></i> 20 Detik/Soal</span>
          </div>
        </div>
        </div>
        <span class="am-hero-live"><span class="am-hero-live-dot"></span> Skaneda AI Aktif</span>
      </div>
    </div>

    <!-- ================= PANEL: KUIS (ala Quizizz) ================= -->
    <div class="am-panel" data-panel="quiz">
      <div class="qz-stage" id="qzStage">
        <div class="qz-topbar">
          <span class="qz-qcounter"><i class="fas fa-list-ol"></i> <span id="amQProgressText">Soal 1 / 20</span></span>
          <div class="qz-timer" id="qzTimer">
            <svg viewBox="0 0 64 64">
              <circle class="qz-timer-track" cx="32" cy="32" r="28"></circle>
              <circle class="qz-timer-fill" id="qzTimerFill" cx="32" cy="32" r="28"></circle>
            </svg>
            <span id="qzTimerNum">20</span>
          </div>
        </div>
        <div class="qz-progressbar"><div class="qz-progressbar-fill" id="amQBarFill"></div></div>

        <div class="qz-question-wrap">
          <span class="qz-question-tag"><i class="fas fa-bolt"></i> Pertanyaan Kuis</span>
          <h2 class="qz-question" id="amQuestionText">Memuat pertanyaan...</h2>
        </div>

        <div class="qz-options" id="amOptionsWrap"></div>

        <div class="qz-foot">
          <button type="button" class="qz-back" id="amBackBtn" disabled><i class="fas fa-arrow-left"></i> Sebelumnya</button>
        </div>
      </div>
    </div>

    <!-- ================= PANEL: PROCESSING ================= -->
    <div class="am-panel" data-panel="processing">
      <div class="am-card am-proc">
        <div class="am-proc-ring">
          <svg viewBox="0 0 110 110">
            <circle class="track" cx="55" cy="55" r="48.5"></circle>
            <circle class="fill" id="amProcRingFill" cx="55" cy="55" r="48.5"></circle>
          </svg>
          <div class="am-proc-ring-icon"><i class="fas fa-brain"></i></div>
        </div>
        <h2>NARA SKANEDA sedang menganalisis...</h2>
        <div class="am-proc-log" id="amProcLog"></div>
      </div>
    </div>

    <!-- ================= PANEL: HASIL (PODIUM) + DETAIL + RANKING ================= -->
    <div class="am-panel" data-panel="result">
      <div class="am-stack">

        <!-- PODIUM TOP 3 -->
        <div class="am-card am-podium-block">
          <div class="am-podium-tag"><span class="am-result-tag"><i class="fas fa-trophy"></i> <span>Hasil Kecocokan Personal</span></span></div>
          <h3 class="am-podium-title">Top 3 Ekstrakurikuler <span>Buat Kamu</span></h3>
          <p class="am-podium-sub">Ini bukan tebak-tebakan — hasil ini dihitung dari pola jawabanmu selama 20 pertanyaan tadi.</p>

          <div class="am-podium" id="amPodium">
            <div class="am-podium-spot am-podium-rank2" data-rank="2">
              <span class="am-podium-trophy"><i class="fas fa-medal"></i></span>
              <span class="am-podium-icon"><i class="fas"></i></span>
              <span class="am-podium-name">—</span>
              <span class="am-podium-pct">0%</span>
              <div class="am-podium-base">2</div>
            </div>
            <div class="am-podium-spot am-podium-rank1" data-rank="1">
              <span class="am-podium-trophy"><i class="fas fa-trophy"></i></span>
              <span class="am-podium-icon"><i class="fas"></i></span>
              <span class="am-podium-name">—</span>
              <span class="am-podium-pct">0%</span>
              <div class="am-podium-base">1</div>
            </div>
            <div class="am-podium-spot am-podium-rank3" data-rank="3">
              <span class="am-podium-trophy"><i class="fas fa-medal"></i></span>
              <span class="am-podium-icon"><i class="fas"></i></span>
              <span class="am-podium-name">—</span>
              <span class="am-podium-pct">0%</span>
              <div class="am-podium-base">3</div>
            </div>
          </div>

          <div class="am-narrative">
            <i class="fas fa-robot"></i>
            <p id="amResultNarrative">—</p>
          </div>

          <div class="am-ekslist-title">Peringkat Kecocokan Semua Ekstrakurikuler</div>
          <div class="am-ekslist" id="amEksList"></div>
        </div>

        <!-- DETAIL TOP 3 -->
        <div class="am-card" id="amExploreAnchor">
          <div class="am-section-head">
            <span class="tag"><i class="fas fa-compass"></i> Kenali Lebih Dalam</span>
            <h2>Detail <span>Top 3 Ekskul-mu</span></h2>
            <p>Klik salah satu buat lihat deskripsi, kegiatan rutin, jadwal, dan cara gabungnya.</p>
          </div>
          <div class="am-eks-tabs" id="amEksTabs"></div>
          <div class="am-eks-detail" id="amEksDetail"></div>
        </div>

        <!-- CARA GABUNG -->
        <div class="am-card">
          <div class="am-section-head">
            <span class="tag"><i class="fas fa-handshake"></i> Langkah Selanjutnya</span>
            <h2>Siap <span>Gabung?</span></h2>
          </div>
          <div class="am-join-box">
            <div class="am-join-left">
              <span class="am-join-icon"><i class="fas fa-users"></i></span>
              <div class="am-join-text">
                <h3 id="amJoinTitle">Cara Gabung Ekskul —</h3>
                <p id="amJoinDesc">Datang langsung pas jadwal latihan, atau hubungi pengurus OSIS/pembina ekskul buat daftar.</p>
              </div>
            </div>
            <a href="{{ url('/siswa/ekstrakurikuler') }}" class="am-btn"><i class="fas fa-arrow-right"></i> Lihat Semua Ekskul</a>
          </div>
        </div>

        <div class="am-restart-row">
          <button type="button" id="amRestartBtn"><i class="fas fa-redo"></i> Ulangi Kuis dari Awal</button>
        </div>

      </div>
    </div>

  </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
  /* ---------------- data ekstrakurikuler ----------------
     Frontend-only: gampang diganti data asli / hasil model AI
     kalau backend udah ada. 13 ekskul aktif Skaneda. */
  var EKSKUL = {
    BASKET: {
      nama: "Basket", kategori: "Olahraga Tim", icon: "fa-basketball",
      tagline: "Kompak di lapangan, gesit ngejar kemenangan.",
      deskripsi: "Ekskul Basket mengasah kekompakan tim, kecepatan mengambil keputusan, dan stamina lewat latihan rutin dan sparring antar sekolah.",
      kegiatan: ["Latihan teknik dasar & strategi tim", "Sparring/latihan tanding rutin", "Ikut turnamen antar sekolah", "Latihan fisik & stamina"],
      jadwal: "Selasa & Jumat", pembina: "Pembina olahraga sekolah", tempat: "Lapangan Basket Sekolah",
      kekuatan: [{ t: "Kerja Sama Tim", d: "Kamu terbiasa gerak bareng tim & saling ngandelin buat menang bareng." }, { t: "Kompetitif Sehat", d: "Tantangan bikin kamu makin semangat, bukan malah down." }, { t: "Reaksi Cepat", d: "Kamu cepat ambil keputusan di situasi yang serba cepat." }],
      caraGabung: "Datang langsung pas jadwal latihan, atau hubungi pengurus OSIS/pembina ekskul buat daftar."
    },
    VOLI: {
      nama: "Voli", kategori: "Olahraga Tim", icon: "fa-volleyball",
      tagline: "Satu bola, satu tujuan — menang bareng-bareng.",
      deskripsi: "Ekskul Voli melatih kekompakan, komunikasi cepat antar pemain, dan refleks dalam permainan tim.",
      kegiatan: ["Latihan passing, servis & smash", "Latihan formasi & rotasi tim", "Sparring antar kelas/sekolah", "Persiapan turnamen voli"],
      jadwal: "Kamis & Sabtu", pembina: "Pembina olahraga sekolah", tempat: "Lapangan Voli Sekolah",
      kekuatan: [{ t: "Komunikasi Tim", d: "Kamu terbiasa koordinasi cepat biar bola gak jatuh sia-sia." }, { t: "Kompak & Saling Nutupin", d: "Kamu paham arti saling backup posisi sama tim." }, { t: "Tahan Tekanan", d: "Kamu tetap tenang meski skor lagi ketat." }],
      caraGabung: "Datang langsung pas jadwal latihan, atau hubungi pengurus OSIS/pembina ekskul buat daftar."
    },
    FUTSAL: {
      nama: "Futsal", kategori: "Olahraga Tim", icon: "fa-futbol",
      tagline: "Lapangan kecil, strategi besar.",
      deskripsi: "Ekskul Futsal mengasah strategi cepat, kerja sama tim dalam ruang terbatas, dan ketahanan fisik.",
      kegiatan: ["Latihan teknik dasar & taktik", "Small-sided game/latihan strategi", "Sparring & turnamen antar sekolah", "Latihan fisik & stamina"],
      jadwal: "Senin & Rabu", pembina: "Pembina olahraga sekolah", tempat: "Lapangan Futsal Sekolah",
      kekuatan: [{ t: "Mikir Cepat di Lapangan", d: "Kamu terbiasa ambil keputusan taktis dalam hitungan detik." }, { t: "Fleksibel Posisi", d: "Kamu bisa nyesuain peran, gak kaku di satu posisi doang." }, { t: "Semangat Tim", d: "Kamu suka dorong semangat temen setim biar gak nyerah." }],
      caraGabung: "Datang langsung pas jadwal latihan, atau hubungi pengurus OSIS/pembina ekskul buat daftar."
    },
    SILAT: {
      nama: "Pencak Silat", kategori: "Olahraga Beladiri", icon: "fa-hand-fist",
      tagline: "Disiplin diri lewat seni bela diri warisan bangsa.",
      deskripsi: "Pencak Silat melatih disiplin, kontrol diri, dan teknik bela diri, sekaligus melestarikan budaya asli Indonesia.",
      kegiatan: ["Latihan jurus & teknik dasar", "Latihan fisik & pernapasan", "Sparring terkontrol", "Ikut kejuaraan pencak silat"],
      jadwal: "Selasa & Kamis", pembina: "Pembina bela diri sekolah", tempat: "Aula/Lapangan Sekolah",
      kekuatan: [{ t: "Disiplin Tinggi", d: "Kamu terbiasa latihan rutin & mengikuti aturan dengan konsisten." }, { t: "Kontrol Diri", d: "Kamu bisa tetap tenang & fokus meski dalam tekanan." }, { t: "Menghargai Tradisi", d: "Kamu tertarik dengan nilai budaya di balik gerakan silat." }],
      caraGabung: "Datang langsung pas jadwal latihan, atau hubungi pengurus OSIS/pembina ekskul buat daftar."
    },
    PASKIB: {
      nama: "Paskib", kategori: "Kedisiplinan", icon: "fa-flag",
      tagline: "Rapi, tegas, siap jadi contoh lewat formasi baris-berbaris.",
      deskripsi: "Paskib melatih kedisiplinan, kekompakan formasi, dan kepemimpinan lewat baris-berbaris dan upacara bendera.",
      kegiatan: ["Latihan baris-berbaris (PBB)", "Latihan formasi & pengibaran bendera", "Persiapan upacara & acara sekolah", "Latihan fisik & mental"],
      jadwal: "Rabu & Sabtu", pembina: "Pembina Paskib sekolah", tempat: "Lapangan Upacara Sekolah",
      kekuatan: [{ t: "Presisi & Kekompakan", d: "Kamu suka gerakan yang serempak & terukur." }, { t: "Jiwa Kepemimpinan", d: "Kamu nyaman ambil peran komando/pengarah." }, { t: "Percaya Diri Tampil", d: "Kamu gak minder jadi sorotan pas formasi/upacara." }],
      caraGabung: "Datang langsung pas jadwal latihan, atau hubungi pengurus OSIS/pembina ekskul buat daftar."
    },
    PRAMUKA: {
      nama: "Pramuka", kategori: "Kepanduan", icon: "fa-campground",
      tagline: "Mandiri, siap petualangan, siap bantu sesama.",
      deskripsi: "Pramuka mengasah kemandirian, kerja sama tim di alam terbuka, dan berbagai keterampilan hidup — dari survival sampai kepemimpinan.",
      kegiatan: ["Latihan keterampilan kepramukaan", "Kegiatan alam terbuka & camping", "Permainan kelompok & simulasi", "Bakti sosial & kegiatan lingkungan"],
      jadwal: "Jumat", pembina: "Pembina Pramuka sekolah", tempat: "Lapangan/Area Terbuka Sekolah",
      kekuatan: [{ t: "Mandiri & Tangguh", d: "Kamu gak gampang nyerah walau situasinya gak nyaman." }, { t: "Suka Eksplorasi", d: "Kamu penasaran & senang coba hal/tempat baru." }, { t: "Jiwa Sosial", d: "Kamu senang kerja bareng & bantu orang lain di lapangan." }],
      caraGabung: "Datang langsung pas jadwal latihan, atau hubungi pengurus OSIS/pembina ekskul buat daftar."
    },
    TARI: {
      nama: "Tari", kategori: "Seni & Budaya", icon: "fa-masks-theater",
      tagline: "Ekspresikan cerita lewat gerak yang indah.",
      deskripsi: "Ekskul Tari mengasah ekspresi gerak, rasa seni, dan kepercayaan diri tampil di depan publik lewat tarian tradisional & modern.",
      kegiatan: ["Latihan koreografi & teknik dasar tari", "Latihan tari tradisional & modern", "Persiapan pentas seni sekolah", "Tampil di acara/lomba tari"],
      jadwal: "Rabu & Sabtu", pembina: "Pembina seni sekolah", tempat: "Aula/Studio Tari Sekolah",
      kekuatan: [{ t: "Ekspresif", d: "Kamu bisa nyampein perasaan/cerita cuma lewat gerakan." }, { t: "Percaya Diri di Panggung", d: "Kamu justru makin hidup kalau lagi dilihatin orang banyak." }, { t: "Peka Ritme & Estetika", d: "Kamu cepat menangkap pola gerak & keindahan visual." }],
      caraGabung: "Datang langsung pas jadwal latihan, atau hubungi pengurus OSIS/pembina ekskul buat daftar."
    },
    BANJARI: {
      nama: "Banjari", kategori: "Seni & Religi", icon: "fa-music",
      tagline: "Kompak bersuara, lantunkan shalawat penuh makna.",
      deskripsi: "Ekskul Banjari (rebana/hadrah) mengasah kekompakan vokal grup dan musik islami lewat lantunan shalawat penuh kebersamaan.",
      kegiatan: ["Latihan vokal & harmoni grup", "Latihan alat musik rebana/hadrah", "Tampil di acara sekolah/keagamaan", "Ikut lomba banjari/hadrah"],
      jadwal: "Jumat", pembina: "Pembina kegiatan keagamaan", tempat: "Aula/Musala Sekolah",
      kekuatan: [{ t: "Selaras dalam Tim", d: "Kamu peka buat nyelarasin suara/nada bareng orang lain." }, { t: "Nuansa Spiritual", d: "Kamu nyaman dengan kegiatan yang membawa suasana religius." }, { t: "Berani Tampil", d: "Kamu enjoy nunjukin karya di depan orang banyak." }],
      caraGabung: "Datang langsung pas jadwal latihan, atau hubungi pengurus OSIS/pembina ekskul buat daftar."
    },
    BTQ: {
      nama: "BTQ", kategori: "Keagamaan", icon: "fa-book-quran",
      tagline: "Mendalami Al-Quran dengan tenang dan konsisten.",
      deskripsi: "BTQ (Baca Tulis Al-Quran) membina kemampuan membaca & menulis Al-Quran dengan baik dan benar, sekaligus memperdalam pemahaman keagamaan.",
      kegiatan: ["Latihan tahsin/tajwid bacaan", "Praktik menulis huruf Al-Quran", "Kajian & hafalan surat pendek", "Lomba tilawah/BTQ"],
      jadwal: "Jumat", pembina: "Pembina kegiatan keagamaan", tempat: "Musala Sekolah",
      kekuatan: [{ t: "Tekun & Konsisten", d: "Kamu sabar mengulang latihan sampai benar-benar lancar." }, { t: "Suasana Tenang", d: "Kamu nyaman dengan kegiatan yang kalem & reflektif." }, { t: "Ketertarikan Spiritual", d: "Kamu senang mendalami hal-hal keagamaan." }],
      caraGabung: "Datang langsung pas jadwal kegiatan, atau hubungi pengurus OSIS/pembina ekskul buat daftar."
    },
    JURNAL: {
      nama: "Jurnalistik", kategori: "Literasi & Media", icon: "fa-newspaper",
      tagline: "Cari fakta, susun cerita, sebarkan informasi.",
      deskripsi: "Ekskul Jurnalistik melatih menulis berita, riset, wawancara, dan dokumentasi kegiatan sekolah lewat media sekolah.",
      kegiatan: ["Latihan menulis berita & artikel", "Liputan & wawancara narasumber", "Dokumentasi kegiatan sekolah", "Publikasi lewat mading/media sekolah"],
      jadwal: "Rabu", pembina: "Pembina jurnalistik sekolah", tempat: "Ruang Media/Kelas",
      kekuatan: [{ t: "Kritis & Ingin Tahu", d: "Kamu suka gali informasi sampai ke akar masalahnya." }, { t: "Komunikatif Lewat Tulisan", d: "Kamu bisa nyampein info kompleks jadi gampang dipahami." }, { t: "Teliti pada Fakta", d: "Kamu hati-hati mastiin info yang kamu sebar itu akurat." }],
      caraGabung: "Datang langsung pas jadwal kegiatan, atau hubungi pengurus OSIS/pembina ekskul buat daftar."
    },
    PENA: {
      nama: "Pena", kategori: "Literasi & Sastra", icon: "fa-pen-nib",
      tagline: "Menulis untuk merangkai rasa jadi kata.",
      deskripsi: "Ekskul Pena mengasah kemampuan menulis kreatif — puisi, cerpen, esai — sebagai media ekspresi diri lewat kata-kata.",
      kegiatan: ["Latihan menulis puisi & cerpen", "Diskusi & apresiasi karya sastra", "Penerbitan antologi karya siswa", "Ikut lomba menulis/sastra"],
      jadwal: "Kamis", pembina: "Pembina seni dan teater sekolah", tempat: "Ruang Kelas/Perpustakaan",
      kekuatan: [{ t: "Imajinatif", d: "Kamu gampang nemuin ide & cerita dari hal-hal kecil di sekitar." }, { t: "Peka Perasaan", d: "Kamu bisa menangkap & menuangkan emosi jadi tulisan yang related." }, { t: "Suka Merenung", d: "Kamu senang waktu sendiri buat mikir & nulis." }],
      caraGabung: "Datang langsung pas jadwal kegiatan, atau hubungi pengurus OSIS/pembina ekskul buat daftar."
    },
    PMR: {
      nama: "PMR", kategori: "Sosial & Kesehatan", icon: "fa-heart-pulse",
      tagline: "Siap sedia bantu, peduli kesehatan sesama.",
      deskripsi: "PMR (Palang Merah Remaja) membina keterampilan pertolongan pertama, kepedulian kesehatan, dan sikap siap siaga membantu warga sekolah.",
      kegiatan: ["Latihan pertolongan pertama (P3K)", "Simulasi tanggap darurat", "Piket kesehatan sekolah (UKS)", "Kegiatan donor darah & bakti sosial"],
      jadwal: "Sabtu", pembina: "Pembina PMR sekolah", tempat: "Ruang UKS Sekolah",
      kekuatan: [{ t: "Sigap & Tenang", d: "Kamu tetap tenang & cepat bertindak saat ada yang butuh bantuan." }, { t: "Empati Tinggi", d: "Kamu peka sama kondisi fisik & perasaan orang lain." }, { t: "Bertanggung Jawab", d: "Kamu serius kalau udah pegang tugas yang berkaitan sama keselamatan orang." }],
      caraGabung: "Datang langsung pas jadwal kegiatan, atau hubungi pengurus OSIS/pembina ekskul buat daftar."
    },
    PIKR: {
      nama: "PIK-R", kategori: "Sosial & Konseling", icon: "fa-comments",
      tagline: "Ruang aman buat curhat & sebar edukasi remaja.",
      deskripsi: "PIK-R jadi wadah edukasi kesehatan reproduksi, konseling teman sebaya, dan kampanye isu-isu remaja yang sering dianggap tabu.",
      kegiatan: ["Pelatihan konseling teman sebaya", "Kampanye & edukasi kesehatan remaja", "Diskusi isu-isu remaja", "Kolaborasi dengan PMR & BK sekolah"],
      jadwal: "Kamis", pembina: "Pembina PIK-R sekolah", tempat: "Ruang BK/Kelas",
      kekuatan: [{ t: "Pendengar yang Baik", d: "Temen-temen ngerasa nyaman cerita ke kamu." }, { t: "Peduli Isu Sosial", d: "Kamu perhatian sama masalah yang sering diabaikan orang lain." }, { t: "Bisa Dipercaya", d: "Kamu jaga rahasia & gak asal nge-judge orang." }],
      caraGabung: "Datang langsung pas jadwal kegiatan, atau hubungi pengurus OSIS/pembina ekskul buat daftar."
    },
  };
  var TAG_ICON = {
    TIM: "fa-people-group",
    KOMPETITIF: "fa-bolt",
    DISIPLIN: "fa-list-check",
    TAMPIL: "fa-star",
    SENI: "fa-palette",
    RELIGI: "fa-book-quran",
    MUSIK: "fa-music",
    NULIS: "fa-pen-nib",
    PEDULI: "fa-heart",
    PIMPIN: "fa-flag",
    ALAM: "fa-campground",
  };
  var TAG_WEIGHTS = {
    /* Rebalanced: Pramuka/Paskib/Silat sebelumnya nyambung ke 5-6 tag
       sekaligus (termasuk KOMPETITIF & DISIPLIN, dua tag paling sering
       muncul di 20 soal) jadi mereka nyaris selalu menang meski jawaban
       acak. Sekarang tiap ekskul cuma pegang tag yang benar² jadi
       identitas khasnya, dan bobotnya diskalain biar "expected score"
       tiap ekskul (dihitung dari frekuensi tag di soal) mendekati rata².
       Divalidasi simulasi 30.000x jawaban acak: sebelumnya Pramuka/
       Paskib/Silat muncul di Top 3 60%/49%/40% (ekskul lain nyaris 0%),
       sekarang rentangnya jauh lebih rata (~5%-34%, gak ada yang dominan). */
    TIM: { BASKET: 3, VOLI: 3, FUTSAL: 3, BANJARI: 1, PRAMUKA: 1 },
    KOMPETITIF: { BASKET: 2, VOLI: 2, FUTSAL: 2 },
    DISIPLIN: { PASKIB: 2, SILAT: 2, BTQ: 2 },
    TAMPIL: { TARI: 3, BANJARI: 3, PASKIB: 1 },
    SENI: { TARI: 3, BANJARI: 1, PENA: 2, JURNAL: 1 },
    RELIGI: { BTQ: 4, PIKR: 1 },
    MUSIK: { BANJARI: 4, TARI: 1 },
    NULIS: { JURNAL: 3, PENA: 3, PIKR: 1 },
    PEDULI: { PMR: 4, PIKR: 3, PRAMUKA: 1 },
    PIMPIN: { PASKIB: 2, PRAMUKA: 1, JURNAL: 1 },
    ALAM: { PRAMUKA: 4, SILAT: 1 },
  };
  var QUESTIONS = [
    {
      q: "Kalau ada tugas kelompok gede, kamu paling seneng ambil peran...",
      options: [{ text: "Yang gerak duluan & semangatin biar tim menang", tag: "KOMPETITIF" }, { text: "Yang jagain kekompakan biar semua kebagian tugas", tag: "TIM" }, { text: "Yang atur jadwal & pastiin semua rapi sesuai rencana", tag: "DISIPLIN" }, { text: "Yang nyari ide paling unik & beda dari yang lain", tag: "SENI" }]
    },
    {
      q: "Waktu luang, kamu lebih milih...",
      options: [{ text: "Latihan fisik atau main bareng temen di lapangan", tag: "KOMPETITIF" }, { text: "Baca hal yang bikin hati tenang (buku rohani/kajian)", tag: "RELIGI" }, { text: "Corat-coret / nulis apa aja yang kepikiran", tag: "NULIS" }, { text: "Jalan-jalan/eksplor tempat baru di luar rumah", tag: "ALAM" }]
    },
    {
      q: "Kalau ngeliat orang lain lagi kesusahan, reaksi pertamamu...",
      options: [{ text: "Langsung samperin & bantu apa yang bisa dibantu", tag: "PEDULI" }, { text: "Dengerin dulu curhatannya sampai tuntas", tag: "PEDULI" }, { text: "Koordinir orang-orang sekitar biar bantuannya efektif", tag: "PIMPIN" }, { text: "Cari tahu solusi paling tepat dulu baru bertindak", tag: "DISIPLIN" }]
    },
    {
      q: "Pas ada acara sekolah / lomba antar kelas, kamu paling excited di bagian...",
      options: [{ text: "Tanding / adu kemampuan langsung", tag: "KOMPETITIF" }, { text: "Nyiapin formasi/barisan biar keliatan kompak & rapi", tag: "DISIPLIN" }, { text: "Tampil di depan panggung", tag: "TAMPIL" }, { text: "Liput & dokumentasiin acaranya", tag: "NULIS" }]
    },
    {
      q: "Kalau harus milih tantangan baru, kamu lebih tertarik yang...",
      options: [{ text: "Butuh tenaga & stamina", tag: "KOMPETITIF" }, { text: "Butuh ketelitian & kesabaran tinggi", tag: "DISIPLIN" }, { text: "Butuh kreativitas & rasa seni", tag: "SENI" }, { text: "Butuh keberanian jelajah tempat asing", tag: "ALAM" }]
    },
    {
      q: "Kamu lebih nyaman kalau lagi...",
      options: [{ text: "Rame-rame di lapangan / outdoor", tag: "TIM" }, { text: "Di tempat tenang buat mikir/renung", tag: "RELIGI" }, { text: "Di depan orang banyak, jadi pusat perhatian", tag: "TAMPIL" }, { text: "Nulis atau baca sendirian", tag: "NULIS" }]
    },
    {
      q: "Menurut temen-temen, kamu itu orangnya...",
      options: [{ text: "Kompetitif, gampang semangat kalau ada tantangan", tag: "KOMPETITIF" }, { text: "Rapi & disiplin, gasuka yang berantakan", tag: "DISIPLIN" }, { text: "Empatik, gampang perhatian sama orang lain", tag: "PEDULI" }, { text: "Kreatif, suka hal-hal yang estetik", tag: "SENI" }]
    },
    {
      q: "Kalau dikasih waktu 1 jam bebas di sekolah, kamu bakal...",
      options: [{ text: "Main bola/olahraga bareng temen", tag: "TIM" }, { text: "Latihan gerakan/formasi sendirian biar makin jago", tag: "DISIPLIN" }, { text: "Ngobrol santai + dengerin cerita temen", tag: "PEDULI" }, { text: "Nulis diary/cerita/puisi random", tag: "NULIS" }]
    },
    {
      q: "Kalau ikut kegiatan kelompok, kamu paling males kalau...",
      options: [{ text: "Timnya lamban & gak niat menang", tag: "KOMPETITIF" }, { text: "Gak ada aturan jelas, jadi berantakan", tag: "DISIPLIN" }, { text: "Gak ada yang perhatian ke perasaan anggota lain", tag: "PEDULI" }, { text: "Semuanya kaku, gak ada ruang buat berekspresi", tag: "SENI" }]
    },
    {
      q: "Hal yang bikin kamu paling bangga sama diri sendiri...",
      options: [{ text: "Menang lomba/pertandingan", tag: "KOMPETITIF" }, { text: "Bisa jaga komitmen & disiplin walau capek", tag: "DISIPLIN" }, { text: "Bisa bantu orang lain ngerasa lebih baik", tag: "PEDULI" }, { text: "Hasil karya sendiri diapresiasi orang", tag: "SENI" }]
    },
    {
      q: "Soal urusan ibadah/agama, kamu termasuk yang...",
      options: [{ text: "Suka banget dalemin & rutin belajar sampai tenang", tag: "RELIGI" }, { text: "Suka juga kalau nuansanya dibalut musik/vokal bareng-bareng", tag: "MUSIK" }, { text: "Lebih suka gerak fisik dulu baru pikiran tenang", tag: "ALAM" }, { text: "Lebih suka nulis refleksi/renungan pribadi", tag: "NULIS" }]
    },
    {
      q: "Kalau nonton pertunjukan, kamu paling suka yang ada...",
      options: [{ text: "Aksi & pertandingan seru", tag: "KOMPETITIF" }, { text: "Tarian/gerakan panggung yang estetik", tag: "TAMPIL" }, { text: "Musik & vokal yang bikin merinding", tag: "MUSIK" }, { text: "Cerita/plot yang dalem & related sama kehidupan", tag: "NULIS" }]
    },
    {
      q: "Kamu lebih suka dipuji karena...",
      options: [{ text: "Jago & gesit di lapangan", tag: "KOMPETITIF" }, { text: "Bisa dipercaya & selalu on-time", tag: "DISIPLIN" }, { text: "Baik hati & perhatian ke orang lain", tag: "PEDULI" }, { text: "Punya selera seni/estetika yang bagus", tag: "SENI" }]
    },
    {
      q: "Kalau lagi liburan sekolah, kegiatan favoritmu...",
      options: [{ text: "Ikut turnamen/latihan fisik", tag: "KOMPETITIF" }, { text: "Ikut camping/kegiatan alam terbuka", tag: "ALAM" }, { text: "Bikin konten/tulisan/vlog", tag: "NULIS" }, { text: "Latihan nari/nyanyi buat persiapan tampil", tag: "TAMPIL" }]
    },
    {
      q: "Menurutmu, kelebihan terbesarmu ada di...",
      options: [{ text: "Fisik & stamina", tag: "KOMPETITIF" }, { text: "Ketelitian & tanggung jawab", tag: "DISIPLIN" }, { text: "Rasa peka sama perasaan orang", tag: "PEDULI" }, { text: "Kreativitas & imajinasi", tag: "SENI" }]
    },
    {
      q: "Kalau jadi ketua kelompok, gaya kepemimpinanmu...",
      options: [{ text: "Tegas & disiplin, semua harus on-time", tag: "PIMPIN" }, { text: "Ngajak semua kompak jalan bareng", tag: "TIM" }, { text: "Kasih ruang tiap orang buat berekspresi", tag: "SENI" }, { text: "Dengerin dulu semua pendapat sebelum mutusin", tag: "PEDULI" }]
    },
    {
      q: "Pelajaran/kegiatan yang paling gampang bikin kamu 'masuk zona'...",
      options: [{ text: "Yang ada gerak fisik & tantangan", tag: "KOMPETITIF" }, { text: "Yang butuh hafalan/bacaan tenang", tag: "RELIGI" }, { text: "Yang butuh nulis panjang/riset", tag: "NULIS" }, { text: "Yang butuh koordinasi formasi/barisan", tag: "DISIPLIN" }]
    },
    {
      q: "Kalau ada masalah sosial/kesehatan di lingkungan sekitar, kamu bakal...",
      options: [{ text: "Turun tangan langsung bantu", tag: "PEDULI" }, { text: "Bikin tulisan/kampanye buat nyadarin orang", tag: "NULIS" }, { text: "Ajak temen-temen gerak bareng nanganin", tag: "TIM" }, { text: "Atur & rencanain solusinya step-by-step", tag: "DISIPLIN" }]
    },
    {
      q: "Kalau harus milih 'panggung' buat unjuk kemampuan, kamu pilih...",
      options: [{ text: "Lapangan pertandingan", tag: "KOMPETITIF" }, { text: "Panggung tampil (nari/nyanyi/vokal)", tag: "TAMPIL" }, { text: "Podium upacara/formasi barisan", tag: "PIMPIN" }, { text: "Majalah dinding/media sekolah", tag: "NULIS" }]
    },
    {
      q: "Yang bikin kamu paling puas setelah ngelakuin sesuatu...",
      options: [{ text: "Menang atau berhasil ngalahin tantangan", tag: "KOMPETITIF" }, { text: "Semua rapi & sesuai rencana dari awal sampai akhir", tag: "DISIPLIN" }, { text: "Ada orang yang jadi lebih baik gara-gara bantuanmu", tag: "PEDULI" }, { text: "Hasil karya/tampilanmu diapresiasi banyak orang", tag: "TAMPIL" }]
    },
  ];

  var EKSKUL_ORDER = Object.keys(EKSKUL);

  /* MAX_PER_EKS: skor maksimum teoretis yang bisa didapat tiap ekskul,
     dihitung dari bobot TERBAIK yang tersedia buat ekskul itu di tiap soal
     (bukan cuma satu opsi = satu ekskul, karena sekarang scoring-nya
     "menyamar" lewat trait, satu opsi bisa nyumbang skor ke beberapa
     ekskul sekaligus). */
  var MAX_PER_EKS = {};
  EKSKUL_ORDER.forEach(function (k) { MAX_PER_EKS[k] = 0; });
  QUESTIONS.forEach(function (q) {
    var bestPerEks = {};
    q.options.forEach(function (opt) {
      var w = TAG_WEIGHTS[opt.tag] || {};
      Object.keys(w).forEach(function (k) {
        if (!bestPerEks[k] || w[k] > bestPerEks[k]) bestPerEks[k] = w[k];
      });
    });
    Object.keys(bestPerEks).forEach(function (k) { MAX_PER_EKS[k] += bestPerEks[k]; });
  });

  /* ---------------- shuffle helpers ---------------- */
  function shuffle(arr) {
    var a = arr.slice();
    for (var i = a.length - 1; i > 0; i--) {
      var j = Math.floor(Math.random() * (i + 1));
      var tmp = a[i]; a[i] = a[j]; a[j] = tmp;
    }
    return a;
  }

  function buildSessionQuestions() {
    return shuffle(QUESTIONS).map(function (q) {
      return { q: q.q, options: shuffle(q.options) };
    });
  }

  var state = {
    current: 0,
    questions: buildSessionQuestions(),
    answers: new Array(QUESTIONS.length).fill(null),
    scores: null,
    ranked: null,
    selectedTab: null
  };

  function showPanel(name) {
    document.querySelectorAll('.am-panel').forEach(function (p) {
      p.classList.toggle('active', p.getAttribute('data-panel') === name);
    });
  }

  /* ---------------- quiz render (ala Quizizz) ---------------- */
  var qText = document.getElementById('amQuestionText');
  var optWrap = document.getElementById('amOptionsWrap');
  var progressText = document.getElementById('amQProgressText');
  var barFill = document.getElementById('amQBarFill');
  var backBtn = document.getElementById('amBackBtn');
  var qzTimerEl = document.getElementById('qzTimer');
  var qzTimerFill = document.getElementById('qzTimerFill');
  var qzTimerNum = document.getElementById('qzTimerNum');

  var QZ_TIME = 20;      // detik per soal, ubah sesuai kebutuhan
  var QZ_CIRC = 176;     // keliling lingkaran timer (r=28)
  var qzTimerInterval = null;
  var qzTimeLeft = QZ_TIME;
  var SHAPE_CLASS = ['qz-shape-triangle', 'qz-shape-diamond', 'qz-shape-circle', 'qz-shape-square'];

  function stopQzTimer() {
    if (qzTimerInterval) { clearInterval(qzTimerInterval); qzTimerInterval = null; }
  }

  function startQzTimer() {
    stopQzTimer();
    qzTimeLeft = QZ_TIME;
    qzTimerEl.classList.remove('qz-timer-low');
    qzTimerNum.textContent = qzTimeLeft;
    qzTimerFill.style.strokeDashoffset = 0;
    qzTimerInterval = setInterval(function () {
      qzTimeLeft--;
      if (qzTimeLeft < 0) qzTimeLeft = 0;
      qzTimerNum.textContent = qzTimeLeft;
      qzTimerFill.style.strokeDashoffset = Math.round(QZ_CIRC * (1 - qzTimeLeft / QZ_TIME));
      if (qzTimeLeft <= 5) qzTimerEl.classList.add('qz-timer-low');
      if (qzTimeLeft <= 0) { stopQzTimer(); goNextQuestion(); }
    }, 1000);
  }

  function goNextQuestion() {
    if (state.current < state.questions.length - 1) {
      state.current++;
      renderQuestion();
    } else {
      barFill.style.width = '100%';
      startProcessing();
    }
  }

  function renderQuestion() {
    var q = state.questions[state.current];
    progressText.textContent = 'Soal ' + (state.current + 1) + ' / ' + state.questions.length;
    barFill.style.width = Math.round(((state.current) / state.questions.length) * 100) + '%';
    qText.textContent = q.q;
    backBtn.disabled = state.current === 0;

    optWrap.innerHTML = q.options.map(function (opt, i) {
      var selected = state.answers[state.current] === i ? ' selected' : '';
      var shapeCls = SHAPE_CLASS[i % SHAPE_CLASS.length];
      return '<button type="button" class="qz-opt qz-opt-' + (i % 4) + selected + '" data-idx="' + i + '">' +
        '<span class="qz-opt-shape"><span class="' + shapeCls + '"></span></span>' +
        '<span class="qz-opt-text">' + opt.text + '</span>' +
        '<span class="qz-opt-check"><i class="fas fa-check"></i></span>' +
      '</button>';
    }).join('');

    optWrap.querySelectorAll('.qz-opt').forEach(function (btn) {
      btn.addEventListener('click', function () {
        stopQzTimer();
        var idx = parseInt(btn.getAttribute('data-idx'), 10);
        state.answers[state.current] = idx;
        /* opsi yang diklik dapet class "selected" (nyala + membesar),
           semua opsi lain dapet class "dimmed" (meredup) supaya
           kontrasnya jelas keliatan mana yang barusan dipilih. */
        optWrap.querySelectorAll('.qz-opt').forEach(function (b) {
          if (b === btn) {
            b.classList.remove('dimmed');
            b.classList.add('selected');
          } else {
            b.classList.remove('selected');
            b.classList.add('dimmed');
          }
        });
        setTimeout(function () { goNextQuestion(); }, 600);
      });
    });

    startQzTimer();
  }

  backBtn.addEventListener('click', function () {
    if (state.current > 0) { stopQzTimer(); state.current--; renderQuestion(); }
  });

  /* ---------------- processing (AI thinking) ---------------- */
  var procLog = document.getElementById('amProcLog');
  var procRingFill = document.getElementById('amProcRingFill');
  var PROC_STEPS = [
    { icon: 'fa-circle-notch', text: 'Menganalisis pola jawabanmu...' },
    { icon: 'fa-circle-notch', text: 'Mencocokkan dengan profil 13 ekstrakurikuler...' },
    { icon: 'fa-circle-notch', text: 'Menghitung skor kecocokan personal...' },
    { icon: 'fa-circle-notch', text: 'Menyusun Top 3 rekomendasi...' }
  ];

  function startProcessing() {
    showPanel('processing');
    procLog.innerHTML = PROC_STEPS.map(function (s) {
      return '<div class="am-proc-line"><i class="fas ' + s.icon + '"></i><span>' + s.text + '</span></div>';
    }).join('');
    var lines = procLog.querySelectorAll('.am-proc-line');
    var circumference = 2 * Math.PI * 48.5;
    procRingFill.style.strokeDasharray = circumference;
    procRingFill.style.strokeDashoffset = circumference;

    var total = lines.length;
    lines.forEach(function (line, i) {
      setTimeout(function () {
        line.classList.add('is-shown');
        var pct = ((i + 1) / total) * circumference;
        procRingFill.style.strokeDashoffset = circumference - pct;
        if (i > 0) lines[i - 1].classList.add('is-done');
        if (i === total - 1) {
          setTimeout(function () {
            line.classList.add('is-done');
            computeResult();
            showPanel('result');
            revealResult();
          }, 550);
        }
      }, i * 620);
    });
  }

  /* ---------------- scoring ---------------- */
  function computeResult() {
    var scores = {};
    EKSKUL_ORDER.forEach(function (k) { scores[k] = 0; });
    state.answers.forEach(function (ansIdx, qIdx) {
      if (ansIdx === null) return;
      var opt = state.questions[qIdx].options[ansIdx];
      var w = TAG_WEIGHTS[opt.tag] || {};
      Object.keys(w).forEach(function (k) { scores[k] += w[k]; });
    });
    /* acak urutan dulu sebelum di-sort: kalau ada 2+ ekskul skornya
       persis sama, Array.sort itu stable, jadi tanpa ini yang selalu
       "menang" adalah yang duluan didefinisikan di EKSKUL (mis. Basket
       selalu ngalahin Futsal). Dengan shuffle dulu, hasil tie jadi acak
       tiap kali dihitung, bukan berat sebelah ke urutan data. */
    /* PENTING: sort berdasarkan pct (persentase yang ditampilkan ke
       user), BUKAN skor mentah. MAX_PER_EKS beda-beda tiap ekskul
       (karena skala bobot tag beda), jadi kalau di-sort pakai skor
       mentah, urutan ranking bisa gak nyambung sama urutan persennya
       (mis. #1 nongol 50% padahal #2 di bawahnya malah 62%). Sort
       pakai pct bikin ranking selalu konsisten sama angka % yang
       keliatan di layar. Kalau pct-nya persis sama, baru fallback ke
       skor mentah biar urutannya tetap stabil & masuk akal. */
    var ranked = shuffle(EKSKUL_ORDER).map(function (k) {
      var max = MAX_PER_EKS[k] || 1;
      var pct = Math.round((scores[k] / max) * 100);
      return { key: k, score: scores[k], pct: Math.min(100, pct) };
    }).sort(function (a, b) {
      if (b.pct !== a.pct) return b.pct - a.pct;
      return b.score - a.score;
    });
    state.scores = scores;
    state.ranked = ranked;
    state.selectedTab = ranked[0].key;
  }

  /* ---------------- reveal hasil: podium + ranking + narrative ---------------- */
  var NARRATIVE_TEMPLATES = [
    'Dari pola jawabanmu, kamu paling nyambung sama {a}, disusul {b} dan {c}. Ini bukan tebakan asal — tiga ekskul ini yang paling sering "kepanggil" dari kecenderungan gaya kamu selama 20 soal tadi.',
    'Ternyata kecenderunganmu paling kuat ke arah {a}. {b} dan {c} juga lumayan dekat di posisi berikutnya — boleh banget dicoba juga kalau masih bimbang.',
    'Hasil analisisnya nunjukin {a} sebagai yang paling cocok buat kamu, dengan {b} dan {c} jadi alternatif kuat berikutnya. Coba dateng langsung pas latihan buat ngerasain vibe-nya!'
  ];

  function revealResult() {
    playResultBurst();
    var ranked = state.ranked;
    var top3 = ranked.slice(0, 3);

    // isi podium
    ['1', '2', '3'].forEach(function (rankStr, i) {
      var r = top3[i];
      var eks = EKSKUL[r.key];
      var spot = document.querySelector('.am-podium-rank' + rankStr);
      spot.querySelector('.am-podium-icon i').className = 'fas ' + eks.icon;
      spot.querySelector('.am-podium-name').textContent = eks.nama;
      spot.querySelector('.am-podium-pct').textContent = r.pct + '% cocok';
      spot.classList.remove('show');
    });

    var narrative = NARRATIVE_TEMPLATES[Math.floor(Math.random() * NARRATIVE_TEMPLATES.length)]
      .replace('{a}', EKSKUL[top3[0].key].nama)
      .replace('{b}', EKSKUL[top3[1].key].nama)
      .replace('{c}', EKSKUL[top3[2].key].nama);
    document.getElementById('amResultNarrative').textContent = narrative;

    // reveal berurutan: juara 3 -> juara 2 -> juara 1 (dramatis ala Quizizz)
    var order = [
      document.querySelector('.am-podium-rank3'),
      document.querySelector('.am-podium-rank2'),
      document.querySelector('.am-podium-rank1')
    ];
    order.forEach(function (el, i) {
      setTimeout(function () { el.classList.add('show'); }, 260 + i * 480);
    });

    setTimeout(function () {
      renderEksList();
      renderTabs(top3);
      renderEksDetail(top3[0].key);
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }, 260 + order.length * 480);
  }

  /* ---------------- ranking lengkap 13 ekskul ---------------- */
  function renderEksList() {
    var wrap = document.getElementById('amEksList');
    wrap.innerHTML = state.ranked.map(function (r, i) {
      var eks = EKSKUL[r.key];
      return '<div class="am-eksrow">' +
        '<span class="am-eksrow-rank">#' + (i + 1) + '</span>' +
        '<span class="am-eksrow-name">' + eks.nama + '</span>' +
        '<span class="am-eksrow-bar"><span class="am-eksrow-bar-fill" data-pct="' + r.pct + '"></span></span>' +
        '<span class="am-eksrow-pct">' + r.pct + '%</span>' +
      '</div>';
    }).join('');
    requestAnimationFrame(function () {
      wrap.querySelectorAll('.am-eksrow-bar-fill').forEach(function (bar) {
        bar.style.width = bar.getAttribute('data-pct') + '%';
      });
    });
  }

  /* ---------------- tab & detail top 3 ---------------- */
  function renderTabs(top3) {
    var wrap = document.getElementById('amEksTabs');
    wrap.innerHTML = top3.map(function (r) {
      var eks = EKSKUL[r.key];
      var active = state.selectedTab === r.key ? ' active' : '';
      return '<button type="button" class="am-eks-tab' + active + '" data-key="' + r.key + '">' +
        '<i class="fas ' + eks.icon + '"></i> ' + eks.nama +
        '<span class="am-eks-tab-pct">' + r.pct + '%</span>' +
      '</button>';
    }).join('');
    wrap.querySelectorAll('.am-eks-tab').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var key = btn.getAttribute('data-key');
        state.selectedTab = key;
        wrap.querySelectorAll('.am-eks-tab').forEach(function (b) { b.classList.remove('active'); });
        btn.classList.add('active');
        renderEksDetail(key);
      });
    });
  }

  function renderEksDetail(key) {
    var eks = EKSKUL[key];
    document.getElementById('amEksDetail').innerHTML =
      '<div class="am-eks-block">' +
        '<h4><i class="fas fa-align-left"></i> Tentang Ekskul</h4>' +
        '<p class="am-eks-desc">' + eks.deskripsi + '</p>' +
        '<h4><i class="fas fa-star"></i> Kenapa Cocok Buat Kamu</h4>' +
        '<ul class="am-eks-info-list">' + eks.kekuatan.map(function (k) {
          return '<li><i class="fas fa-check"></i><span><b>' + k.t + '.</b> ' + k.d + '</span></li>';
        }).join('') + '</ul>' +
      '</div>' +
      '<div class="am-eks-block">' +
        '<h4><i class="fas fa-list-check"></i> Kegiatan Rutin</h4>' +
        '<ul class="am-eks-act-list">' + eks.kegiatan.map(function (k) {
          return '<li><i class="fas fa-caret-right"></i>' + k + '</li>';
        }).join('') + '</ul>' +
        '<h4 style="margin-top:1.4rem"><i class="fas fa-clock"></i> Info Praktis</h4>' +
        '<ul class="am-eks-info-list">' +
          '<li><i class="fas fa-calendar-days"></i><span><b>Jadwal:</b> ' + eks.jadwal + '</span></li>' +
          '<li><i class="fas fa-chalkboard-user"></i><span><b>Pembina:</b> ' + eks.pembina + '</span></li>' +
          '<li><i class="fas fa-location-dot"></i><span><b>Tempat:</b> ' + eks.tempat + '</span></li>' +
        '</ul>' +
      '</div>';

    document.getElementById('amJoinTitle').textContent = 'Cara Gabung ' + eks.nama;
    document.getElementById('amJoinDesc').textContent = eks.caraGabung;
  }

  /* ---------------- restart ---------------- */
  document.getElementById('amRestartBtn').addEventListener('click', function () {
    state.current = 0;
    state.questions = buildSessionQuestions();
    state.answers = new Array(QUESTIONS.length).fill(null);
    state.scores = null;
    state.ranked = null;
    renderQuestion();
    showPanel('quiz');
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });


  /* ---------------- efek "duar": kertas confetti meledak + berhamburan jatuh ---------------- */
  function playResultBurst() {
    var canvas = document.getElementById('amCodeRain');
    if (!canvas || !canvas.getContext) return;
    var ctx = canvas.getContext('2d');
    var dpr = window.devicePixelRatio || 1;
    var w = window.innerWidth, h = window.innerHeight;
    canvas.width = w * dpr;
    canvas.height = h * dpr;
    canvas.style.width = w + 'px';
    canvas.style.height = h + 'px';
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

    var colors = ['#0ea5b7', '#ffd54a', '#ffb300', '#0d3a66', '#e21b3c', '#ffffff'];
    var count = Math.max(80, Math.min(160, Math.floor(w / 8)));
    var cx = w / 2, cy = h * 0.3; // titik ledakan, kira² area podium
    var pieces = [];
    for (var i = 0; i < count; i++) {
      var angle = Math.random() * Math.PI * 2;
      var speed = 3 + Math.random() * 8;
      pieces.push({
        x: cx, y: cy,
        vx: Math.cos(angle) * speed,
        vy: Math.sin(angle) * speed - 3,
        rot: Math.random() * Math.PI * 2,
        vrot: (Math.random() - 0.5) * 0.35,
        w: 6 + Math.random() * 7,
        h: 9 + Math.random() * 10,
        color: colors[Math.floor(Math.random() * colors.length)],
        gravity: 0.16 + Math.random() * 0.08,
        drag: 0.985,
        opacity: 1
      });
    }

    canvas.style.opacity = '1';
    var start = null;
    var duration = 2600;

    function frame(ts) {
      if (!start) start = ts;
      var elapsed = ts - start;
      ctx.clearRect(0, 0, w, h);
      pieces.forEach(function (p) {
        p.vx *= p.drag;
        p.vy += p.gravity;
        p.x += p.vx;
        p.y += p.vy;
        p.rot += p.vrot;
        if (elapsed > duration * 0.55) {
          p.opacity = Math.max(0, 1 - (elapsed - duration * 0.55) / (duration * 0.45));
        }
        ctx.save();
        ctx.globalAlpha = p.opacity;
        ctx.translate(p.x, p.y);
        ctx.rotate(p.rot);
        ctx.fillStyle = p.color;
        ctx.fillRect(-p.w / 2, -p.h / 2, p.w, p.h);
        ctx.restore();
      });
      if (elapsed < duration) {
        requestAnimationFrame(frame);
      } else {
        canvas.style.opacity = '0';
        setTimeout(function () { ctx.clearRect(0, 0, w, h); }, 650);
      }
    }
    requestAnimationFrame(frame);
  }

  /* ---------------- hero neural-network background ---------------- */
  function initHeroNet() {
    var canvas = document.getElementById('amHeroNet');
    if (!canvas || !canvas.getContext) return;
    var ctx = canvas.getContext('2d');
    var dpr = Math.min(window.devicePixelRatio || 1, 2);
    var hero = canvas.closest('.am-hero');
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
    window.addEventListener('resize', function () {
      size();
    });
  }

  /* ---------------- tombol "Mulai Kuis" di panel intro ---------------- */
  var startQuizBtn = document.getElementById('amStartQuizBtn');
  if (startQuizBtn) {
    startQuizBtn.addEventListener('click', function () {
      showPanel('quiz');
      renderQuestion();
      document.getElementById('qzStage').scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
  }

  /* ---------------- init ---------------- */
  initHeroNet();
})();
</script>
@endpush