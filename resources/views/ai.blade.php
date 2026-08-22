@extends('layouts.app')

@section('title', 'AI Major Matchmaker — Temukan Jurusan yang Cocok | SMK Negeri 2 Mojokerto')
@section('description', 'Ikuti kuis minat singkat dan dapatkan rekomendasi jurusan SMK Negeri 2 Mojokerto yang paling cocok denganmu, lengkap dengan penjelasan mendalam, eksplorasi jurusan, prospek karier, dan info PPDB.')

@push('styles')
<style>
/* =========================================================
   AI MAJOR MATCHMAKER — LIGHT MODE
   Alur: Kuis -> AI Processing -> Hasil Personal (ala laporan
   tes kepribadian) -> Eksplorasi Jurusan -> Prospek Karier ->
   PPDB. Frontend-only (state machine JS, data jurusan
   didefinisikan di script agar mudah disambungkan ke
   backend/model rekomendasi asli nanti).
   Palet: kertas terang (#f6f9fd / #ffffff), navy Skaneda
   (#0d3a66) sebagai warna utama, gold (#ffd54a/#ffb300) sebagai
   aksen kelulusan, teal (#0ea5b7) sebagai aksen "AI" yang tetap
   kontras di atas latar terang.
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

/* ---------- top banner ---------- */
.am-top{position:relative;text-align:center;max-width:760px;margin:0 auto 2.4rem;z-index:3}
.am-badge-ai{display:inline-flex;align-items:center;gap:.55rem;font-size:.68rem;font-weight:900;letter-spacing:.16em;
  text-transform:uppercase;color:var(--am-teal-ink);margin-bottom:1.1rem;padding:.55rem .95rem;border-radius:999px;
  border:1px solid rgba(14,165,183,.3);background:rgba(14,165,183,.08)}
.am-badge-ai i{font-size:.75rem;animation:amPulseIcon 2.4s ease-in-out infinite}
@keyframes amPulseIcon{0%,100%{opacity:1}50%{opacity:.4}}
.am-top h1{font-family:var(--font-display);font-weight:900;font-size:clamp(1.9rem,4.4vw,3rem);line-height:1.14;
  margin:0;color:var(--am-navy-dark);letter-spacing:-.01em}
.am-top h1 span{background:linear-gradient(120deg,var(--am-gold-deep) 0%,var(--am-teal) 55%,var(--am-navy) 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent}
.am-top p{margin:1rem auto 0;font-size:.92rem;color:var(--am-muted);max-width:560px;line-height:1.8}
.am-top-meta{display:flex;align-items:center;justify-content:center;gap:1.1rem;margin-top:1.2rem;flex-wrap:wrap}
.am-meta-chip{display:inline-flex;align-items:center;gap:.45rem;font-size:.72rem;font-weight:700;color:var(--am-muted)}
.am-meta-chip i{color:var(--am-gold-deep);font-size:.7rem}

/* ---------- stepper ---------- */
.am-stepper{display:flex;align-items:flex-start;justify-content:space-between;max-width:960px;margin:0 auto 2.6rem;
  position:relative;z-index:3}
.am-step{flex:1;text-align:center;position:relative}
.am-step-line{position:absolute;top:19px;left:-50%;width:100%;height:2px;background:var(--am-line);z-index:1}
.am-step:first-child .am-step-line{display:none}
.am-step-dot{width:40px;height:40px;border-radius:50%;background:#fff;border:1.5px solid var(--am-line);
  color:var(--am-muted);display:flex;align-items:center;justify-content:center;margin:0 auto .55rem;font-size:.9rem;
  position:relative;z-index:2;transition:all .4s var(--ease,ease);box-shadow:0 2px 8px rgba(13,58,102,.06)}
.am-step-label{font-size:.66rem;font-weight:800;color:var(--am-muted);letter-spacing:.02em}
.am-step.done .am-step-dot{background:var(--am-navy);border-color:var(--am-teal);color:#fff}
.am-step.done .am-step-line{background:linear-gradient(90deg,var(--am-teal),var(--am-gold-deep))}
.am-step.done .am-step-label{color:var(--am-ink)}
.am-step.current .am-step-dot{background:linear-gradient(135deg,var(--am-gold),var(--am-gold-deep));border-color:var(--am-gold-deep);color:var(--am-navy-dark);
  box-shadow:0 0 0 6px rgba(255,179,0,.14),0 0 26px rgba(255,179,0,.32)}
.am-step.current .am-step-label{color:var(--am-gold-deep)}
@media(max-width:760px){.am-step-label{font-size:.58rem}.am-step-dot{width:32px;height:32px;font-size:.75rem}.am-step-line{top:15px}}

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

/* ---------- QUIZ ---------- */
.am-quiz-head{display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;margin-bottom:1.6rem}
.am-quiz-progress-text{font-size:.72rem;font-weight:800;color:var(--am-teal-ink);letter-spacing:.06em;text-transform:uppercase}
.am-quiz-bar{flex:1;height:6px;border-radius:99px;background:var(--am-line);margin:0 1.2rem;overflow:hidden;min-width:120px}
.am-quiz-bar-fill{height:100%;border-radius:99px;background:linear-gradient(90deg,var(--am-teal),var(--am-gold-deep));width:0%;transition:width .5s var(--ease,ease)}
.am-quiz-question{font-family:var(--font-display);font-size:clamp(1.2rem,2.6vw,1.7rem);font-weight:800;color:var(--am-navy-dark);
  line-height:1.35;margin:0 0 1.7rem}
.am-quiz-options{display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:1rem}
.am-opt{display:flex;align-items:center;gap:.9rem;text-align:left;padding:1.1rem 1.2rem;border-radius:16px;
  background:#f7fafd;border:1.5px solid var(--am-line);color:var(--am-ink);cursor:pointer;
  font-size:.86rem;font-weight:600;line-height:1.5;transition:all .25s var(--ease,ease)}
.am-opt-icon{width:42px;height:42px;border-radius:12px;flex:0 0 42px;display:flex;align-items:center;justify-content:center;
  background:rgba(14,165,183,.1);color:var(--am-teal-ink);font-size:1rem;transition:all .25s var(--ease,ease)}
.am-opt:hover{border-color:rgba(255,179,0,.55);background:#fff;transform:translateY(-2px);box-shadow:0 12px 24px rgba(13,58,102,.08)}
.am-opt:hover .am-opt-icon{background:linear-gradient(135deg,var(--am-gold),var(--am-gold-deep));color:var(--am-navy-dark)}
.am-opt.selected{border-color:var(--am-gold-deep);background:rgba(255,213,74,.14)}
.am-opt.selected .am-opt-icon{background:linear-gradient(135deg,var(--am-gold),var(--am-gold-deep));color:var(--am-navy-dark)}
.am-quiz-foot{display:flex;justify-content:space-between;align-items:center;margin-top:1.8rem}
.am-btn-ghost-dark{display:inline-flex;align-items:center;gap:.5rem;background:none;border:1.5px solid var(--am-line);
  color:var(--am-muted);padding:.6rem 1.1rem;border-radius:999px;font-size:.76rem;font-weight:700;cursor:pointer;
  transition:all .25s var(--ease,ease)}
.am-btn-ghost-dark:hover{border-color:var(--am-teal);color:var(--am-teal-ink)}
.am-btn-ghost-dark:disabled{opacity:.35;cursor:not-allowed}

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

/* ---------- RESULT ---------- */
.am-result-top{text-align:center;padding-bottom:1.8rem;margin-bottom:1.8rem;border-bottom:1px solid var(--am-line)}
.am-result-tag{display:inline-flex;align-items:center;gap:.5rem;font-size:.68rem;font-weight:900;letter-spacing:.14em;
  text-transform:uppercase;color:var(--am-teal-ink);margin-bottom:1.1rem}
.am-ring-big{width:180px;height:180px;margin:0 auto 1.3rem;position:relative}
.am-ring-big svg{width:100%;height:100%;transform:rotate(-90deg)}
.am-ring-big circle{fill:none;stroke-width:9}
.am-ring-big .track{stroke:var(--am-line)}
.am-ring-big .fill{stroke:url(#amGradient2);stroke-linecap:round;stroke-dasharray:502;stroke-dashoffset:502;
  transition:stroke-dashoffset 1.4s cubic-bezier(.22,.9,.3,1)}
.am-ring-big-label{position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center}
.am-ring-big-label b{font-family:var(--font-display);font-size:2.1rem;font-weight:900;color:var(--am-navy-dark);line-height:1}
.am-ring-big-label span{font-size:.62rem;font-weight:800;letter-spacing:.08em;text-transform:uppercase;color:var(--am-teal-ink);margin-top:.3rem}
.am-result-name{font-family:var(--font-display);font-size:clamp(1.5rem,3vw,2.1rem);font-weight:900;color:var(--am-navy-dark);margin:0 0 .5rem}
.am-result-tagline{font-size:.85rem;color:var(--am-muted);max-width:520px;margin:0 auto 1.2rem;line-height:1.75}
.am-trait-row{display:flex;justify-content:center;gap:.55rem;flex-wrap:wrap}
.am-trait{font-size:.68rem;font-weight:800;color:var(--am-navy-dark);background:linear-gradient(135deg,#ffe9b0,var(--am-gold));
  padding:.4rem .8rem;border-radius:999px}

/* ---------- per-major visual showcase ---------- */
.am-visual{max-width:440px;margin:1.8rem auto 0}
.am-visual-code{background:var(--am-navy-dark);border-radius:16px;overflow:hidden;box-shadow:0 24px 48px rgba(13,58,102,.24);text-align:left}
.am-visual-code-bar{display:flex;align-items:center;gap:.4rem;padding:.65rem .95rem;background:#061d38}
.am-visual-dot{width:9px;height:9px;border-radius:50%}
.am-visual-dot.r{background:#ff5f56}.am-visual-dot.y{background:#ffbd2e}.am-visual-dot.g{background:#27c93f}
.am-visual-code-tab{margin-left:.6rem;font-size:.68rem;font-weight:700;color:rgba(255,255,255,.55);font-family:'Courier New',monospace}
.am-visual-code-body{padding:1.1rem 1.2rem;font-family:'Courier New',monospace;font-size:.76rem;line-height:2;color:#d7ecfb;text-align:left}
.am-visual-code-body .ln{color:rgba(215,236,251,.28);display:inline-block;width:18px}
.am-visual-code-body .kw{color:#67e8f9}.am-visual-code-body .fn{color:#ffd54a}.am-visual-code-body .str{color:#a8e6a1}.am-visual-code-body .cm{color:rgba(215,236,251,.4)}
.am-visual-generic{background:#f7fafd;border:1px solid var(--am-line);border-radius:18px;padding:1.8rem 1.6rem;
  display:flex;flex-direction:column;align-items:center;gap:1rem;text-align:center}
.am-visual-generic .am-visual-icon{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;
  font-size:1.6rem;color:#fff;background:linear-gradient(135deg,var(--am-teal),var(--am-navy));box-shadow:0 14px 26px rgba(13,58,102,.2)}
.am-visual-generic p{margin:0;font-size:.78rem;color:var(--am-muted);max-width:320px;line-height:1.7}
.am-visual-chips{display:flex;gap:.5rem;flex-wrap:wrap;justify-content:center}

.am-narrative{display:flex;gap:.9rem;background:rgba(14,165,183,.06);border:1px solid rgba(14,165,183,.22);
  border-radius:16px;padding:1.1rem 1.2rem;margin-top:1.8rem}
.am-narrative i{color:var(--am-teal-ink);font-size:1rem;margin-top:.15rem;flex:0 0 18px}
.am-narrative p{margin:0;font-size:.82rem;color:var(--am-ink);line-height:1.8}

/* ---------- MBTI-style insight breakdown ---------- */
.am-insight-intro{text-align:center;max-width:560px;margin:2.2rem auto 1.4rem}
.am-insight-intro span.tag{display:inline-flex;align-items:center;gap:.5rem;font-size:.68rem;font-weight:900;letter-spacing:.14em;
  text-transform:uppercase;color:var(--am-teal-ink);margin-bottom:.6rem}
.am-insight-intro h3{font-family:var(--font-display);font-size:clamp(1.15rem,2.2vw,1.4rem);font-weight:800;color:var(--am-navy-dark);margin:0}
.am-insight-intro p{font-size:.82rem;color:var(--am-muted);margin:.6rem 0 0;line-height:1.75}
.am-insight-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.1rem}
.am-insight-card{background:#f7fafd;border:1px solid var(--am-line);border-radius:18px;padding:1.4rem 1.3rem}
.am-insight-card h4{display:flex;align-items:center;gap:.55rem;font-size:.78rem;font-weight:900;letter-spacing:.03em;
  color:var(--am-navy-dark);margin:0 0 1rem}
.am-insight-card h4 i{width:30px;height:30px;border-radius:9px;display:flex;align-items:center;justify-content:center;
  background:linear-gradient(135deg,rgba(14,165,183,.16),rgba(255,179,0,.14));color:var(--am-teal-ink);font-size:.78rem;flex:0 0 30px}
.am-insight-strength{display:grid;gap:.85rem}
.am-insight-strength li{list-style:none}
.am-insight-strength b{display:block;font-size:.78rem;font-weight:800;color:var(--am-navy-dark);margin-bottom:.2rem}
.am-insight-strength span{font-size:.76rem;color:var(--am-muted);line-height:1.6}
.am-insight-card p{margin:0;font-size:.8rem;color:var(--am-ink);line-height:1.8}
@media(max-width:900px){.am-insight-grid{grid-template-columns:1fr}}

.am-runner-title{font-size:.72rem;font-weight:800;letter-spacing:.08em;text-transform:uppercase;color:var(--am-muted);margin:2rem 0 .9rem}
.am-runner-list{display:grid;gap:.9rem}
.am-runner{display:grid;grid-template-columns:150px 1fr 48px;align-items:center;gap:1rem}
.am-runner-name{font-size:.8rem;font-weight:800;color:var(--am-ink)}
.am-runner-bar{height:8px;border-radius:99px;background:var(--am-line);overflow:hidden}
.am-runner-bar-fill{height:100%;border-radius:99px;background:linear-gradient(90deg,var(--am-navy),var(--am-teal));width:0%;transition:width 1s var(--ease,ease)}
.am-runner-pct{font-size:.78rem;font-weight:800;color:var(--am-teal-ink);text-align:right}

.am-result-actions{display:flex;justify-content:center;gap:.8rem;margin-top:2rem;flex-wrap:wrap}
.am-btn{display:inline-flex;align-items:center;gap:.55rem;padding:.85rem 1.7rem;border-radius:999px;border:none;
  background:linear-gradient(135deg,var(--am-gold),var(--am-gold-deep));color:var(--am-navy-dark);font-weight:800;font-size:.85rem;cursor:pointer;
  text-decoration:none;box-shadow:0 14px 32px rgba(255,179,0,.28);transition:transform .25s var(--ease,ease),box-shadow .25s var(--ease,ease)}
.am-btn:hover{transform:translateY(-2px);box-shadow:0 18px 40px rgba(255,179,0,.38)}
.am-btn i{font-size:.74rem}

/* ---------- EXPLORE tabs + detail ---------- */
.am-section-head{text-align:center;max-width:600px;margin:0 auto 1.8rem}
.am-section-head span.tag{display:inline-flex;align-items:center;gap:.5rem;font-size:.68rem;font-weight:900;letter-spacing:.14em;
  text-transform:uppercase;color:var(--am-teal-ink);margin-bottom:.7rem}
.am-section-head h2{font-family:var(--font-display);font-size:clamp(1.3rem,2.6vw,1.8rem);font-weight:800;color:var(--am-navy-dark);margin:0}
.am-section-head p{font-size:.82rem;color:var(--am-muted);margin:.6rem 0 0;line-height:1.75}

.am-jur-tabs{display:flex;justify-content:center;gap:.6rem;flex-wrap:wrap;margin-bottom:1.8rem}
.am-jur-tab{display:inline-flex;align-items:center;gap:.5rem;padding:.6rem 1.1rem;border-radius:999px;
  border:1.5px solid var(--am-line);background:#fff;color:var(--am-muted);
  font-size:.76rem;font-weight:800;cursor:pointer;transition:all .25s var(--ease,ease)}
.am-jur-tab i{font-size:.72rem}
.am-jur-tab .am-jur-tab-pct{font-size:.65rem;font-weight:900;color:var(--am-teal-ink);background:rgba(14,165,183,.12);
  padding:.15rem .45rem;border-radius:999px}
.am-jur-tab:hover{border-color:rgba(255,179,0,.55)}
.am-jur-tab.active{background:linear-gradient(135deg,var(--am-gold),var(--am-gold-deep));border-color:var(--am-gold-deep);color:var(--am-navy-dark)}
.am-jur-tab.active .am-jur-tab-pct{background:rgba(13,58,102,.14);color:var(--am-navy-dark)}

.am-jur-detail{display:grid;grid-template-columns:1fr 1fr;gap:1.6rem}
.am-jur-block h4{display:flex;align-items:center;gap:.5rem;font-size:.72rem;font-weight:900;letter-spacing:.08em;
  text-transform:uppercase;color:var(--am-teal-ink);margin:0 0 .9rem}
.am-jur-desc{font-size:.84rem;color:var(--am-ink);line-height:1.85;margin:0 0 1.4rem}
.am-chip-row{display:flex;flex-wrap:wrap;gap:.5rem}
.am-chip{font-size:.72rem;font-weight:700;color:var(--am-ink);background:#f7fafd;border:1px solid var(--am-line);
  padding:.4rem .8rem;border-radius:999px}
.am-fac-list{list-style:none;margin:0;padding:0;display:grid;gap:.65rem}
.am-fac-list li{display:flex;align-items:flex-start;gap:.6rem;font-size:.8rem;color:var(--am-ink);line-height:1.6}
.am-fac-list li i{color:var(--am-gold-deep);margin-top:.2rem;font-size:.72rem;flex:0 0 14px}

/* ---------- CAREER ---------- */
.am-career-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(230px,1fr));gap:1rem}
.am-career-card{background:#f7fafd;border:1px solid var(--am-line);border-radius:16px;
  padding:1.2rem 1.1rem;transition:all .3s var(--ease,ease)}
.am-career-card:hover{transform:translateY(-4px);border-color:rgba(255,179,0,.45);background:#fff;box-shadow:0 14px 28px rgba(13,58,102,.08)}
.am-career-icon{width:40px;height:40px;border-radius:11px;background:linear-gradient(135deg,rgba(14,165,183,.16),rgba(255,179,0,.14));
  color:var(--am-teal-ink);display:flex;align-items:center;justify-content:center;font-size:.95rem;margin-bottom:.8rem}
.am-career-card h5{font-size:.85rem;font-weight:800;color:var(--am-navy-dark);margin:0 0 .35rem}
.am-career-card p{font-size:.74rem;color:var(--am-muted);margin:0;line-height:1.6}

/* ---------- PPDB ---------- */
.am-ppdb-box{display:flex;align-items:center;justify-content:space-between;gap:1.6rem;flex-wrap:wrap}
.am-ppdb-text h3{font-family:var(--font-display);font-size:1.15rem;font-weight:800;color:var(--am-navy-dark);margin:0 0 .5rem}
.am-ppdb-text p{font-size:.82rem;color:var(--am-muted);margin:0;max-width:460px;line-height:1.75}
.am-ppdb-quota{display:flex;align-items:center;gap:.6rem;margin-top:1rem;font-size:.74rem;font-weight:700;color:var(--am-gold-deep)}

/* section spacing between stacked reveal blocks */
.am-stack > * + *{margin-top:1.6rem}
.am-restart-row{text-align:center;margin-top:2.2rem}
.am-restart-row button{display:inline-flex;align-items:center;gap:.5rem;background:none;border:none;color:var(--am-muted);
  font-size:.78rem;font-weight:700;cursor:pointer}
.am-restart-row button:hover{color:var(--am-teal-ink)}

/* responsive */
@media(max-width:820px){
  .am-jur-detail{grid-template-columns:1fr}
  .am-runner{grid-template-columns:110px 1fr 40px;gap:.7rem}
  .am-ppdb-box{flex-direction:column;align-items:flex-start;text-align:left}
}
@media(max-width:560px){
  .am-wrap{padding:32px 0 70px}
  .am-card{border-radius:20px}
  .am-stepper{overflow-x:auto}
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

    <div class="am-top">
      <span class="am-badge-ai"><i class="fas fa-robot"></i> AI Major Matchmaker</span>
      <h1>Temukan Jurusan yang <span>Paling Cocok</span> Buatmu</h1>
      <p>Jawab beberapa pertanyaan singkat, biar Skaneda AI menganalisis pola minatmu dan memberi rekomendasi jurusan yang personal — lengkap dengan penjelasan mendalam ala hasil tes kepribadian.</p>
      <div class="am-top-meta">
        <span class="am-meta-chip"><i class="fas fa-list-ol"></i> 8 Pertanyaan</span>
        <span class="am-meta-chip"><i class="fas fa-clock"></i> ± 2 Menit</span>
        <span class="am-meta-chip"><i class="fas fa-shield-alt"></i> Tanpa Data Pribadi</span>
      </div>
    </div>

    <div class="am-stepper" id="amStepper">
      <div class="am-step current" data-step="quiz">
        <div class="am-step-line"></div>
        <div class="am-step-dot"><i class="fas fa-list-ol"></i></div>
        <div class="am-step-label">Kuis</div>
      </div>
      <div class="am-step" data-step="result">
        <div class="am-step-line"></div>
        <div class="am-step-dot"><i class="fas fa-bullseye"></i></div>
        <div class="am-step-label">Hasil Personal</div>
      </div>
      <div class="am-step" data-step="explore">
        <div class="am-step-line"></div>
        <div class="am-step-dot"><i class="fas fa-compass"></i></div>
        <div class="am-step-label">Eksplorasi Jurusan</div>
      </div>
      <div class="am-step" data-step="career">
        <div class="am-step-line"></div>
        <div class="am-step-dot"><i class="fas fa-briefcase"></i></div>
        <div class="am-step-label">Prospek Karier</div>
      </div>
      <div class="am-step" data-step="ppdb">
        <div class="am-step-line"></div>
        <div class="am-step-dot"><i class="fas fa-graduation-cap"></i></div>
        <div class="am-step-label">PPDB</div>
      </div>
    </div>

    <!-- ================= PANEL: KUIS ================= -->
    <div class="am-panel active" data-panel="quiz">
      <div class="am-card">
        <div class="am-quiz-head">
          <span class="am-quiz-progress-text" id="amQProgressText">Soal 1 / 8</span>
          <div class="am-quiz-bar"><div class="am-quiz-bar-fill" id="amQBarFill"></div></div>
        </div>
        <h2 class="am-quiz-question" id="amQuestionText">Memuat pertanyaan...</h2>
        <div class="am-quiz-options" id="amOptionsWrap"></div>
        <div class="am-quiz-foot">
          <button type="button" class="am-btn-ghost-dark" id="amBackBtn" disabled><i class="fas fa-arrow-left"></i> Sebelumnya</button>
          <span></span>
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
        <h2>Skaneda AI sedang menganalisis...</h2>
        <div class="am-proc-log" id="amProcLog"></div>
      </div>
    </div>

    <!-- ================= PANEL: HASIL + EKSPLORASI + KARIER + PPDB ================= -->
    <div class="am-panel" data-panel="result">
      <div class="am-stack">

        <!-- HASIL PERSONAL -->
        <div class="am-card">
          <div class="am-result-top">
            <span class="am-result-tag"><i class="fas fa-magic"></i> Hasil Kecocokan Personal</span>
            <div class="am-ring-big">
              <svg viewBox="0 0 180 180">
                <circle class="track" cx="90" cy="90" r="80"></circle>
                <circle class="fill" id="amResultRingFill" cx="90" cy="90" r="80"></circle>
              </svg>
              <div class="am-ring-big-label"><b id="amResultPct">0%</b><span>Match Score</span></div>
            </div>
            <h3 class="am-result-name" id="amResultName">—</h3>
            <p class="am-result-tagline" id="amResultTagline">—</p>
            <div class="am-trait-row" id="amResultTraits"></div>

            <div class="am-visual" id="amResultVisual"></div>

            <div class="am-narrative">
              <i class="fas fa-robot"></i>
              <p id="amResultNarrative">—</p>
            </div>
          </div>

          <div class="am-insight-intro">
            <span class="tag"><i class="fas fa-chart-pie"></i> Analisis Mendalam</span>
            <h3>Kenapa Jurusan Ini Cocok Buatmu?</h3>
            <p>Sama seperti laporan hasil tes kepribadian, ini rincian kekuatan alami, gaya belajar, dan area yang perlu terus kamu asah.</p>
          </div>
          <div class="am-insight-grid">
            <div class="am-insight-card">
              <h4><i class="fas fa-star"></i> Kekuatanmu</h4>
              <ul class="am-insight-strength" id="amInsightStrength"></ul>
            </div>
            <div class="am-insight-card">
              <h4><i class="fas fa-graduation-cap"></i> Gaya Belajar & Kerja</h4>
              <p id="amInsightGaya">—</p>
            </div>
            <div class="am-insight-card">
              <h4><i class="fas fa-seedling"></i> Area Pengembangan</h4>
              <p id="amInsightKembang">—</p>
            </div>
          </div>

          <div class="am-runner-title">Kecocokan dengan jurusan lain</div>
          <div class="am-runner-list" id="amRunnerList"></div>

          <div class="am-result-actions">
            <a href="#amExploreAnchor" class="am-btn" id="amExploreBtn"><i class="fas fa-compass"></i> Eksplorasi Jurusan Ini</a>
          </div>
        </div>

        <!-- EKSPLORASI JURUSAN -->
        <div class="am-card" id="amExploreAnchor">
          <div class="am-section-head">
            <span class="tag"><i class="fas fa-compass"></i> Eksplorasi Jurusan</span>
            <h2>Kenali Lebih Dalam</h2>
            <p>Bandingkan tiga jurusan dengan skor kecocokan tertinggi versimu.</p>
          </div>
          <div class="am-jur-tabs" id="amJurTabs"></div>
          <div class="am-jur-detail" id="amJurDetail"></div>
        </div>

        <!-- PROSPEK KARIER -->
        <div class="am-card">
          <div class="am-section-head">
            <span class="tag"><i class="fas fa-briefcase"></i> Prospek Karier</span>
            <h2 id="amCareerHeading">Peluang Setelah Lulus</h2>
            <p>Gambaran profesi yang bisa kamu tuju dari jurusan yang sedang kamu lihat.</p>
          </div>
          <div class="am-career-grid" id="amCareerGrid"></div>
        </div>

        <!-- PPDB -->
        <div class="am-card">
          <div class="am-section-head">
            <span class="tag"><i class="fas fa-graduation-cap"></i> Langkah Selanjutnya</span>
            <h2>Siap Daftar?</h2>
          </div>
          <div class="am-ppdb-box">
            <div class="am-ppdb-text">
              <h3 id="amPpdbTitle">Info PPDB Jurusan —</h3>
              <p id="amPpdbDesc">Pelajari alur pendaftaran, jadwal, dan persyaratan PPDB untuk jurusan pilihanmu.</p>
              <div class="am-ppdb-quota"><i class="fas fa-users"></i> <span id="amPpdbQuota">Kuota tersedia setiap tahun ajaran</span></div>
            </div>
            <a href="{{ route('kontak') }}" class="am-btn"><i class="fas fa-paper-plane"></i> Info PPDB Sekarang</a>
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
  /* ---------------- data jurusan ----------------
     Frontend-only: mudah diganti data asli / hasil model AI
     saat backend sudah tersedia. Lima jurusan aktif Skaneda:
     APHP, DKV, Kuliner, Layanan Perbankan Syariah, RPL. */
  var JURUSAN = {
    RPL: {
      nama: 'Rekayasa Perangkat Lunak', singkatan: 'RPL', icon: 'fa-laptop-code',
      tagline: 'Merancang logika, membangun aplikasi, dan menghidupkan ide lewat kode.',
      traits: ['Logis', 'Detail-Oriented', 'Problem Solver', 'Suka Tantangan'],
      deskripsi: 'RPL membekali kamu merancang, membangun, dan menguji aplikasi maupun website dari nol — mulai dari logika program, basis data, sampai tampilan yang siap dipakai pengguna.',
      mapel: ['Pemrograman Web', 'Pemrograman Berorientasi Objek', 'Basis Data', 'Pengembangan Perangkat Lunak'],
      fasilitas: ['Lab Komputer RPL dengan spesifikasi tinggi', 'Akses internet & tools development lengkap', 'Ruang praktik project-based learning'],
      karier: [
        { role: 'Software Developer', desc: 'Membangun aplikasi desktop, web, atau mobile.' },
        { role: 'Web Developer', desc: 'Merancang & mengembangkan situs web.' },
        { role: 'Mobile App Developer', desc: 'Membuat aplikasi Android/iOS.' },
        { role: 'UI/UX Engineer', desc: 'Merancang antarmuka yang mudah dipakai.' }
      ],
      ppdb: 'Jurusan RPL menjadi salah satu jurusan dengan peminat tinggi setiap tahunnya. Siapkan nilai rapor dan minat di bidang logika/teknologi untuk seleksi PPDB.',
      kekuatan: [
        { t: 'Berpikir Terstruktur', d: 'Kamu terbiasa memecah masalah besar jadi langkah-langkah kecil yang logis.' },
        { t: 'Sabar dengan Detail', d: 'Error kecil tidak membuatmu menyerah, malah jadi pemicu untuk menemukan solusinya.' },
        { t: 'Selalu Mau Belajar', d: 'Kamu senang mempelajari hal baru, penting sekali di dunia coding yang terus berubah.' }
      ],
      gaya: 'Kamu paling nyaman belajar lewat praktik langsung: mencoba, menemukan error, memperbaiki, lalu mengulang. Proyek nyata jauh lebih efektif buatmu dibanding teori panjang.',
      kembang: 'Latih juga kemampuan komunikasi teknis, supaya hasil kerjamu makin mudah dipahami oleh tim atau klien.'
    },
    DKV: {
      nama: 'Desain Komunikasi Visual', singkatan: 'DKV', icon: 'fa-palette',
      tagline: 'Mengubah ide jadi visual yang enak dilihat dan mudah dimengerti.',
      traits: ['Kreatif', 'Estetik', 'Ekspresif', 'Suka Eksperimen'],
      deskripsi: 'DKV mengasah kreativitasmu lewat desain grafis, ilustrasi, fotografi, videografi, hingga produksi konten digital untuk kebutuhan industri kreatif.',
      mapel: ['Desain Grafis Percetakan', 'Videografi & Fotografi', 'Animasi 2D/3D', 'Produksi Konten Digital'],
      fasilitas: ['Studio desain & fotografi', 'Lab komputer grafis', 'Peralatan videografi profesional'],
      karier: [
        { role: 'Graphic Designer', desc: 'Merancang materi visual untuk brand/media.' },
        { role: 'Content Creator', desc: 'Memproduksi konten digital kreatif.' },
        { role: 'Videographer', desc: 'Mengambil & mengedit video profesional.' },
        { role: 'Animator', desc: 'Membuat animasi 2D/3D untuk berbagai media.' }
      ],
      ppdb: 'Jurusan DKV cocok bagi kamu yang gemar berkarya visual. Portofolio sederhana bisa jadi nilai tambah saat mendaftar PPDB.',
      kekuatan: [
        { t: 'Peka Estetika', d: 'Kamu cepat menangkap mana komposisi yang enak dilihat dan mana yang belum pas.' },
        { t: 'Berani Bereksperimen', d: 'Kamu tidak takut mencoba gaya visual baru sampai menemukan yang paling kuat.' },
        { t: 'Bercerita Lewat Visual', d: 'Kamu bisa menyampaikan pesan hanya lewat warna, bentuk, dan layout.' }
      ],
      gaya: 'Kamu belajar paling baik dengan melihat referensi lalu langsung praktik mendesain — mood board dan sketsa cepat adalah caramu berpikir.',
      kembang: 'Latih konsistensi menyelesaikan revisi sampai tuntas, karena industri kreatif menuntut kerja rapi dan tepat waktu.'
    },
    KULINER: {
      nama: 'Kuliner', singkatan: 'Kuliner', icon: 'fa-utensils',
      tagline: 'Mengolah bahan jadi hidangan yang punya rasa dan cerita.',
      traits: ['Kreatif Rasa', 'Cekatan', 'Detail Penyajian', 'Suka Mencoba Hal Baru'],
      deskripsi: 'Kuliner mengasah kemampuanmu mengolah, menyajikan, dan mengembangkan produk makanan & minuman — dari teknik memasak dasar, plating, sampai dasar-dasar mengelola usaha boga.',
      mapel: ['Boga Dasar', 'Produk Cake & Bakery', 'Tata Hidang', 'Pengelolaan Usaha Boga'],
      fasilitas: ['Dapur praktik standar industri', 'Ruang tata hidang & restoran mini', 'Peralatan bakery & pastry lengkap'],
      karier: [
        { role: 'Chef / Juru Masak', desc: 'Mengolah hidangan di restoran atau hotel.' },
        { role: 'Pastry & Bakery Specialist', desc: 'Membuat kue & roti berkualitas.' },
        { role: 'Food Stylist', desc: 'Menata tampilan makanan agar menarik.' },
        { role: 'Wirausaha Kuliner', desc: 'Membangun bisnis makanan sendiri.' }
      ],
      ppdb: 'Jurusan Kuliner cocok bagi kamu yang senang bereksperimen dengan rasa. Ketertarikan pada memasak jadi nilai tambah saat seleksi PPDB.',
      kekuatan: [
        { t: 'Indra Rasa Tajam', d: 'Kamu cepat mengenali kombinasi rasa yang pas dan yang masih perlu diperbaiki.' },
        { t: 'Cekatan di Bawah Tekanan', d: 'Kamu tetap rapi bekerja walau harus multitasking dalam waktu terbatas.' },
        { t: 'Perhatian pada Penyajian', d: 'Buatmu, rasa enak harus dibarengi tampilan yang menggugah selera.' }
      ],
      gaya: 'Kamu paling cepat menyerap ilmu lewat praktik langsung di dapur — mencoba resep, mencicipi, lalu menyempurnakan hasilnya.',
      kembang: 'Latih manajemen waktu dan kebersihan kerja (higiene), dua hal yang sangat dinilai di industri kuliner profesional.'
    },
    LPS: {
      nama: 'Layanan Perbankan Syariah', singkatan: 'LPS', icon: 'fa-landmark',
      tagline: 'Mengelola layanan keuangan dengan prinsip yang jujur dan terukur.',
      traits: ['Jujur', 'Teliti', 'Komunikatif', 'Suka Angka'],
      deskripsi: 'LPS membekalimu memahami operasional dan layanan perbankan berbasis prinsip syariah — mulai dari produk simpanan, pembiayaan, sampai pelayanan nasabah secara profesional.',
      mapel: ['Dasar-Dasar Perbankan', 'Akad & Produk Bank Syariah', 'Pelayanan Prima Nasabah', 'Praktikum Perbankan Mini'],
      fasilitas: ['Bank mini untuk simulasi transaksi', 'Lab komputer perbankan', 'Ruang pelayanan nasabah simulasi'],
      karier: [
        { role: 'Teller Bank Syariah', desc: 'Melayani transaksi keuangan nasabah.' },
        { role: 'Customer Service Bank', desc: 'Melayani kebutuhan & keluhan nasabah.' },
        { role: 'Staff Pembiayaan', desc: 'Menangani proses pembiayaan nasabah.' },
        { role: 'Financial Advisor Syariah', desc: 'Memberi saran produk keuangan syariah.' }
      ],
      ppdb: 'Jurusan LPS cocok untukmu yang suka pelayanan dan pengelolaan keuangan. Nilai matematika & kemampuan komunikasi jadi salah satu pertimbangan seleksi.',
      kekuatan: [
        { t: 'Jujur & Bisa Dipercaya', d: 'Kamu memegang teguh integritas, penting sekali saat mengelola keuangan orang lain.' },
        { t: 'Komunikatif', d: 'Kamu nyaman menjelaskan hal teknis seperti produk keuangan dengan bahasa yang mudah dipahami.' },
        { t: 'Rapi dengan Angka', d: 'Kamu teliti mencocokkan data supaya tidak ada selisih sedikit pun.' }
      ],
      gaya: 'Kamu belajar paling baik lewat simulasi pelayanan nasabah dan praktik transaksi langsung di bank mini, bukan cuma teori di kelas.',
      kembang: 'Latih ketahanan menghadapi tekanan kerja dan keluhan nasabah dengan tetap tenang dan profesional.'
    },
    APHP: {
      nama: 'Agribisnis Pengolahan Hasil Pertanian', singkatan: 'APHP', icon: 'fa-seedling',
      tagline: 'Mengubah hasil bumi jadi produk bernilai lewat proses yang terukur.',
      traits: ['Teliti', 'Suka Eksperimen', 'Peduli Kualitas', 'Higienis'],
      deskripsi: 'APHP mempelajari cara mengolah hasil pertanian dan perkebunan menjadi produk pangan maupun non-pangan bernilai jual, mulai dari teknik pengolahan, pengawetan, sampai pengendalian mutu produk.',
      mapel: ['Dasar Pengolahan Hasil Pertanian', 'Mikrobiologi Pangan', 'Pengendalian Mutu', 'Pengemasan Produk'],
      fasilitas: ['Laboratorium pengolahan pangan', 'Ruang produksi & pengemasan', 'Alat uji mutu produk'],
      karier: [
        { role: 'Quality Control Pangan', desc: 'Mengecek standar mutu produk olahan.' },
        { role: 'Wirausaha Produk Olahan', desc: 'Membangun usaha makanan/minuman olahan sendiri.' },
        { role: 'Staff Produksi Pabrik Pangan', desc: 'Mengelola proses produksi di industri pangan.' },
        { role: 'Food Technologist', desc: 'Mengembangkan produk pangan baru.' }
      ],
      ppdb: 'Jurusan APHP cocok untukmu yang suka eksperimen dan menjaga kualitas produk. Ketertarikan pada sains & kebersihan jadi nilai plus saat seleksi PPDB.',
      kekuatan: [
        { t: 'Teliti pada Proses', d: 'Kamu memperhatikan setiap tahap pengolahan supaya hasil akhirnya konsisten.' },
        { t: 'Suka Coba-Coba Formula', d: 'Kamu senang bereksperimen mengubah bahan mentah jadi produk baru.' },
        { t: 'Peduli Standar & Kebersihan', d: 'Kamu paham kualitas produk pangan dimulai dari proses yang bersih dan terukur.' }
      ],
      gaya: 'Kamu belajar paling efektif lewat praktik laboratorium dan produksi langsung, bukan hanya teori di kelas.',
      kembang: 'Latih kebiasaan mendokumentasikan proses (mencatat takaran & hasil uji) supaya produkmu bisa direplikasi dengan hasil yang sama.'
    }
  };

  var QUESTIONS = [
    {
      q: 'Waktu luang, kamu paling suka ngapain?',
      options: [
        { text: 'Ngoding atau bikin project kecil-kecilan', icon: 'fa-code', jur: 'RPL' },
        { text: 'Desain poster atau edit video/gambar digital', icon: 'fa-palette', jur: 'DKV' },
        { text: 'Coba-coba resep masakan atau dessert baru', icon: 'fa-utensils', jur: 'KULINER' },
        { text: 'Itung-itung nabung atau atur rencana keuangan', icon: 'fa-piggy-bank', jur: 'LPS' },
        { text: 'Eksperimen kecil, contohnya bikin sirup atau manisan sendiri', icon: 'fa-flask', jur: 'APHP' }
      ]
    },
    {
      q: 'Pelajaran yang bikin kamu paling semangat?',
      options: [
        { text: 'Pemrograman / Informatika', icon: 'fa-laptop-code', jur: 'RPL' },
        { text: 'Seni Budaya / Desain Multimedia', icon: 'fa-image', jur: 'DKV' },
        { text: 'Prakarya & Kewirausahaan bidang boga', icon: 'fa-cookie-bite', jur: 'KULINER' },
        { text: 'Ekonomi / Matematika', icon: 'fa-coins', jur: 'LPS' },
        { text: 'Biologi / Kimia terapan', icon: 'fa-vial', jur: 'APHP' }
      ]
    },
    {
      q: 'Kalau ada tugas kelompok, kamu paling jago di bagian...',
      options: [
        { text: 'Nyusun alur logika / sistem kerja', icon: 'fa-sitemap', jur: 'RPL' },
        { text: 'Bikin desain visual & tampilan yang menarik', icon: 'fa-pen-nib', jur: 'DKV' },
        { text: 'Nyiapin & nyajiin konsumsi/snack', icon: 'fa-utensils', jur: 'KULINER' },
        { text: 'Ngitung anggaran & bikin laporan keuangan', icon: 'fa-file-invoice-dollar', jur: 'LPS' },
        { text: 'Ngecek kualitas & kebersihan bahan', icon: 'fa-check-circle', jur: 'APHP' }
      ]
    },
    {
      q: 'Konten yang paling sering kamu tonton?',
      options: [
        { text: 'Tutorial bikin aplikasi / website', icon: 'fa-play-circle', jur: 'RPL' },
        { text: 'Konsep visual, animasi, atau desain grafis', icon: 'fa-film', jur: 'DKV' },
        { text: 'Video masak atau review makanan', icon: 'fa-video', jur: 'KULINER' },
        { text: 'Tips bisnis & investasi', icon: 'fa-chart-line', jur: 'LPS' },
        { text: 'Konten sains, eksperimen dapur, atau pertanian', icon: 'fa-microscope', jur: 'APHP' }
      ]
    },
    {
      q: 'Kalau diminta bantu acara sekolah, kamu pilih tugas...',
      options: [
        { text: 'Bikin sistem absensi atau website acara', icon: 'fa-laptop-code', jur: 'RPL' },
        { text: 'Desain banner & dekorasi visual acara', icon: 'fa-image', jur: 'DKV' },
        { text: 'Nyiapin & jual konsumsi acara', icon: 'fa-utensils', jur: 'KULINER' },
        { text: 'Atur kas & catat pemasukan acara', icon: 'fa-wallet', jur: 'LPS' },
        { text: 'Ngolah & kemas snack buat dijual', icon: 'fa-box', jur: 'APHP' }
      ]
    },
    {
      q: 'Lomba yang paling pengen kamu ikutin?',
      options: [
        { text: 'Hackathon / Coding Competition', icon: 'fa-code', jur: 'RPL' },
        { text: 'Lomba Desain Grafis / Fotografi', icon: 'fa-camera-retro', jur: 'DKV' },
        { text: 'Lomba Memasak / Cooking Competition', icon: 'fa-utensils', jur: 'KULINER' },
        { text: 'Lomba Akuntansi / Perbankan', icon: 'fa-coins', jur: 'LPS' },
        { text: 'Lomba Karya Ilmiah / Produk Olahan Pangan', icon: 'fa-award', jur: 'APHP' }
      ]
    },
    {
      q: 'Skill yang menurutmu paling keren buat dikuasai?',
      options: [
        { text: 'Bikin aplikasi atau website dari nol', icon: 'fa-laptop-code', jur: 'RPL' },
        { text: 'Bikin karya visual yang estetik', icon: 'fa-palette', jur: 'DKV' },
        { text: 'Bikin makanan enak & tampilannya menarik', icon: 'fa-utensils', jur: 'KULINER' },
        { text: 'Ngatur & kembangin uang biar terus untung', icon: 'fa-money-bill', jur: 'LPS' },
        { text: 'Bikin produk olahan dari bahan mentah', icon: 'fa-seedling', jur: 'APHP' }
      ]
    },
    {
      q: 'Cita-cita pekerjaan impianmu paling deket ke...',
      options: [
        { text: 'Software Developer / Programmer', icon: 'fa-laptop-code', jur: 'RPL' },
        { text: 'Graphic Designer / Content Creator', icon: 'fa-palette', jur: 'DKV' },
        { text: 'Chef / Pengusaha Kuliner', icon: 'fa-utensils', jur: 'KULINER' },
        { text: 'Staff Bank / Financial Advisor', icon: 'fa-landmark', jur: 'LPS' },
        { text: 'Food Technologist / Wirausaha Produk Olahan', icon: 'fa-flask', jur: 'APHP' }
      ]
    }
  ];

  var MAX_PER_JUR = {};
  QUESTIONS.forEach(function (q) {
    q.options.forEach(function (opt) {
      MAX_PER_JUR[opt.jur] = (MAX_PER_JUR[opt.jur] || 0) + 3;
    });
  });

  var state = { current: 0, answers: new Array(QUESTIONS.length).fill(null), scores: null, ranked: null, selectedTab: null };

  /* ---------------- stepper ---------------- */
  function setStepper(name) {
    var order = ['quiz', 'result', 'explore', 'career', 'ppdb'];
    var idx = order.indexOf(name);
    document.querySelectorAll('#amStepper .am-step').forEach(function (el) {
      var elIdx = order.indexOf(el.getAttribute('data-step'));
      el.classList.remove('current', 'done');
      if (elIdx < idx) el.classList.add('done');
      else if (elIdx === idx) el.classList.add('current');
    });
  }

  function showPanel(name) {
    document.querySelectorAll('.am-panel').forEach(function (p) {
      p.classList.toggle('active', p.getAttribute('data-panel') === name);
    });
  }

  /* ---------------- quiz render ---------------- */
  var qText = document.getElementById('amQuestionText');
  var optWrap = document.getElementById('amOptionsWrap');
  var progressText = document.getElementById('amQProgressText');
  var barFill = document.getElementById('amQBarFill');
  var backBtn = document.getElementById('amBackBtn');

  function renderQuestion() {
    var q = QUESTIONS[state.current];
    progressText.textContent = 'Soal ' + (state.current + 1) + ' / ' + QUESTIONS.length;
    barFill.style.width = Math.round(((state.current) / QUESTIONS.length) * 100) + '%';
    qText.textContent = q.q;
    backBtn.disabled = state.current === 0;

    optWrap.innerHTML = q.options.map(function (opt, i) {
      var selected = state.answers[state.current] === i ? ' selected' : '';
      return '<button type="button" class="am-opt' + selected + '" data-idx="' + i + '">' +
        '<span class="am-opt-icon"><i class="fas ' + opt.icon + '"></i></span>' +
        '<span>' + opt.text + '</span>' +
      '</button>';
    }).join('');

    optWrap.querySelectorAll('.am-opt').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var idx = parseInt(btn.getAttribute('data-idx'), 10);
        state.answers[state.current] = idx;
        optWrap.querySelectorAll('.am-opt').forEach(function (b) { b.classList.remove('selected'); });
        btn.classList.add('selected');
        setTimeout(function () {
          if (state.current < QUESTIONS.length - 1) {
            state.current++;
            renderQuestion();
          } else {
            barFill.style.width = '100%';
            startProcessing();
          }
        }, 320);
      });
    });
  }

  backBtn.addEventListener('click', function () {
    if (state.current > 0) { state.current--; renderQuestion(); }
  });

  /* ---------------- processing (AI thinking) ---------------- */
  var procLog = document.getElementById('amProcLog');
  var procRingFill = document.getElementById('amProcRingFill');
  var PROC_STEPS = [
    { icon: 'fa-circle-notch', text: 'Menganalisis pola jawabanmu...' },
    { icon: 'fa-circle-notch', text: 'Mencocokkan dengan profil 5 jurusan...' },
    { icon: 'fa-circle-notch', text: 'Menghitung skor kecocokan personal...' },
    { icon: 'fa-circle-notch', text: 'Menyusun penjelasan & rekomendasi...' }
  ];

  function startProcessing() {
    showPanel('processing');
    setStepper('quiz');
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
            setStepper('result');
            revealResult();
          }, 550);
        }
      }, i * 620);
    });
  }

  /* ---------------- scoring ---------------- */
  function computeResult() {
    var scores = {};
    Object.keys(JURUSAN).forEach(function (k) { scores[k] = 0; });
    state.answers.forEach(function (ansIdx, qIdx) {
      if (ansIdx === null) return;
      var jur = QUESTIONS[qIdx].options[ansIdx].jur;
      scores[jur] += 3;
    });
    var ranked = Object.keys(scores).map(function (k) {
      var max = MAX_PER_JUR[k] || 1;
      return { key: k, score: scores[k], pct: Math.round((scores[k] / max) * 100) };
    }).sort(function (a, b) { return b.pct - a.pct || b.score - a.score; });
    state.scores = scores;
    state.ranked = ranked;
    state.selectedTab = ranked[0].key;
  }

  /* ---------------- code-rain reveal animation ---------------- */
  function playCodeRain() {
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

    var tokens = ['{ }', '</>', '01', '10', 'fn()', '=>', '[ ]', '&&', 'if', 'var', '...', '#!', '< />', '{;}', 'x++'];
    var colors = ['#0ea5b7', '#ffb300', '#0d3a66'];
    var count = Math.max(28, Math.min(80, Math.floor(w / 22)));
    var drops = [];
    for (var i = 0; i < count; i++) {
      drops.push({
        x: Math.random() * w,
        y: -Math.random() * h,
        speed: 2.2 + Math.random() * 3.4,
        text: tokens[Math.floor(Math.random() * tokens.length)],
        color: colors[Math.floor(Math.random() * colors.length)],
        size: 11 + Math.random() * 7,
        opacity: 0.32 + Math.random() * 0.48
      });
    }

    canvas.style.opacity = '1';
    var start = null;
    var duration = 2200;

    function frame(ts) {
      if (!start) start = ts;
      var elapsed = ts - start;
      ctx.clearRect(0, 0, w, h);
      drops.forEach(function (d) {
        d.y += d.speed;
        if (d.y > h + 20) d.y = -20;
        ctx.globalAlpha = d.opacity;
        ctx.fillStyle = d.color;
        ctx.font = '700 ' + d.size + 'px "Courier New", monospace';
        ctx.fillText(d.text, d.x, d.y);
      });
      ctx.globalAlpha = 1;
      if (elapsed < duration) {
        requestAnimationFrame(frame);
      } else {
        canvas.style.opacity = '0';
        setTimeout(function () { ctx.clearRect(0, 0, w, h); }, 650);
      }
    }
    requestAnimationFrame(frame);
  }

  /* ---------------- per-major visual showcase ---------------- */
  function renderVisual(key) {
    var wrap = document.getElementById('amResultVisual');
    if (key === 'RPL') {
      wrap.innerHTML =
        '<div class="am-visual-code">' +
          '<div class="am-visual-code-bar">' +
            '<span class="am-visual-dot r"></span><span class="am-visual-dot y"></span><span class="am-visual-dot g"></span>' +
            '<span class="am-visual-code-tab">jurusanmu.js</span>' +
          '</div>' +
          '<div class="am-visual-code-body">' +
            '<span class="ln">1</span><span class="kw">const</span> kamu = { logis: <span class="fn">true</span>, telaten: <span class="fn">true</span> };<br>' +
            '<span class="ln">2</span><span class="kw">function</span> <span class="fn">jurusanCocok</span>(minat) {<br>' +
            '<span class="ln">3</span>&nbsp;&nbsp;<span class="kw">return</span> minat.includes(<span class="str">"logika"</span>) ? <span class="str">"RPL"</span> : <span class="kw">null</span>;<br>' +
            '<span class="ln">4</span>}<br>' +
            '<span class="ln">5</span><span class="cm">// hasil: kamu cocok jadi developer</span>' +
          '</div>' +
        '</div>';
      return;
    }
    var visualMap = {
      DKV: { icon: 'fa-palette', text: 'Warna, layout, dan komposisi adalah bahasamu untuk bercerita.' },
      KULINER: { icon: 'fa-utensils', text: 'Rasa dan tampilan hidangan adalah karya yang kamu ciptakan setiap hari.' },
      LPS: { icon: 'fa-landmark', text: 'Ketelitian dan kepercayaan adalah modal utamamu mengelola layanan keuangan.' },
      APHP: { icon: 'fa-seedling', text: 'Dari bahan mentah jadi produk berkualitas — itu keahlianmu.' }
    };
    var v = visualMap[key] || visualMap.DKV;
    wrap.innerHTML =
      '<div class="am-visual-generic">' +
        '<span class="am-visual-icon"><i class="fas ' + v.icon + '"></i></span>' +
        '<p>' + v.text + '</p>' +
      '</div>';
  }

  /* ---------------- result reveal ---------------- */
  function revealResult() {
    playCodeRain();

    var top = state.ranked[0];
    var jur = JURUSAN[top.key];

    document.getElementById('amResultName').textContent = jur.nama;
    document.getElementById('amResultTagline').textContent = jur.tagline;
    document.getElementById('amResultTraits').innerHTML = jur.traits.map(function (t) {
      return '<span class="am-trait">' + t + '</span>';
    }).join('');
    document.getElementById('amResultNarrative').textContent =
      'Berdasarkan analisis dari ' + QUESTIONS.length + ' jawabanmu, kecenderungan minat dan gaya berpikirmu paling dekat dengan jurusan ' + jur.nama + '. ' +
      'Skor kecocokanmu ' + top.pct + '%, dihitung dari konsistensi jawaban yang mengarah ke bidang ini dibanding empat jurusan lainnya.';

    renderVisual(top.key);

    document.getElementById('amInsightStrength').innerHTML = jur.kekuatan.map(function (k) {
      return '<li><b>' + k.t + '</b><span>' + k.d + '</span></li>';
    }).join('');
    document.getElementById('amInsightGaya').textContent = jur.gaya;
    document.getElementById('amInsightKembang').textContent = jur.kembang;

    var circumference = 2 * Math.PI * 80;
    var ring = document.getElementById('amResultRingFill');
    ring.style.strokeDasharray = circumference;
    ring.style.strokeDashoffset = circumference;
    var pctLabel = document.getElementById('amResultPct');
    requestAnimationFrame(function () {
      ring.style.strokeDashoffset = circumference - (top.pct / 100) * circumference;
    });
    animateNumber(pctLabel, top.pct);

    var runners = state.ranked.slice(1, 4);
    document.getElementById('amRunnerList').innerHTML = runners.map(function (r) {
      var j = JURUSAN[r.key];
      return '<div class="am-runner">' +
        '<span class="am-runner-name">' + j.singkatan + '</span>' +
        '<div class="am-runner-bar"><div class="am-runner-bar-fill" data-pct="' + r.pct + '" style="width:0%"></div></div>' +
        '<span class="am-runner-pct">' + r.pct + '%</span>' +
      '</div>';
    }).join('');
    setTimeout(function () {
      document.querySelectorAll('.am-runner-bar-fill').forEach(function (el) {
        el.style.width = el.getAttribute('data-pct') + '%';
      });
    }, 150);

    renderJurTabs();
    renderJurDetail(state.selectedTab);
    renderCareer(state.selectedTab);
    renderPpdb(state.selectedTab);
  }

  function animateNumber(el, target) {
    var start = 0, dur = 1200, t0 = null;
    function step(ts) {
      if (!t0) t0 = ts;
      var p = Math.min((ts - t0) / dur, 1);
      el.textContent = Math.round(target * (1 - Math.pow(1 - p, 3))) + '%';
      if (p < 1) requestAnimationFrame(step);
    }
    requestAnimationFrame(step);
  }

  /* ---------------- explore tabs ---------------- */
  function renderJurTabs() {
    var top3 = state.ranked.slice(0, 3);
    var wrap = document.getElementById('amJurTabs');
    wrap.innerHTML = top3.map(function (r) {
      var j = JURUSAN[r.key];
      var active = r.key === state.selectedTab ? ' active' : '';
      return '<button type="button" class="am-jur-tab' + active + '" data-key="' + r.key + '">' +
        '<i class="fas ' + j.icon + '"></i> ' + j.singkatan +
        '<span class="am-jur-tab-pct">' + r.pct + '%</span>' +
      '</button>';
    }).join('');
    wrap.querySelectorAll('.am-jur-tab').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var key = btn.getAttribute('data-key');
        state.selectedTab = key;
        wrap.querySelectorAll('.am-jur-tab').forEach(function (b) { b.classList.remove('active'); });
        btn.classList.add('active');
        renderJurDetail(key);
        renderCareer(key);
        renderPpdb(key);
      });
    });
  }

  function renderJurDetail(key) {
    var j = JURUSAN[key];
    document.getElementById('amJurDetail').innerHTML =
      '<div class="am-jur-block">' +
        '<h4><i class="fas fa-align-left"></i> Tentang Jurusan</h4>' +
        '<p class="am-jur-desc">' + j.deskripsi + '</p>' +
        '<h4><i class="fas fa-book"></i> Mata Pelajaran Produktif</h4>' +
        '<div class="am-chip-row">' + j.mapel.map(function (m) { return '<span class="am-chip">' + m + '</span>'; }).join('') + '</div>' +
      '</div>' +
      '<div class="am-jur-block">' +
        '<h4><i class="fas fa-building"></i> Fasilitas Penunjang</h4>' +
        '<ul class="am-fac-list">' + j.fasilitas.map(function (f) { return '<li><i class="fas fa-check"></i>' + f + '</li>'; }).join('') + '</ul>' +
      '</div>';
  }

  function renderCareer(key) {
    var j = JURUSAN[key];
    document.getElementById('amCareerHeading').textContent = 'Peluang Karier Lulusan ' + j.singkatan;
    document.getElementById('amCareerGrid').innerHTML = j.karier.map(function (k) {
      return '<div class="am-career-card">' +
        '<span class="am-career-icon"><i class="fas fa-briefcase"></i></span>' +
        '<h5>' + k.role + '</h5>' +
        '<p>' + k.desc + '</p>' +
      '</div>';
    }).join('');
  }

  function renderPpdb(key) {
    var j = JURUSAN[key];
    document.getElementById('amPpdbTitle').textContent = 'Info PPDB Jurusan ' + j.singkatan;
    document.getElementById('amPpdbDesc').textContent = j.ppdb;
  }

  /* ---------------- restart ---------------- */
  document.getElementById('amRestartBtn').addEventListener('click', function () {
    state.current = 0;
    state.answers = new Array(QUESTIONS.length).fill(null);
    state.scores = null;
    state.ranked = null;
    renderQuestion();
    showPanel('quiz');
    setStepper('quiz');
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });

  /* ---------------- init ---------------- */
  renderQuestion();
})();
</script>
@endpush