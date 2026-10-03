@extends('layouts.app')

@section('title', 'Struktur Organisasi — SMK Negeri 2 Mojokerto')

@push('styles')
<style>
/* =========================================================
   STRUKTUR ORGANISASI — PREMIUM EDITION
   (CSS yang tidak dipakai halaman ini sudah dirapikan;
    tampilan hero, feed, VT, peran, CTA tetap sama)
   ========================================================= */
.so-page{background:#f7f9fc;color:#0d3a66;overflow:hidden;position:relative}
.so-page *{box-sizing:border-box}
@keyframes hdFadeUp{from{opacity:0;transform:translateY(26px)}to{opacity:1;transform:none}}

/* ---------- HERO ---------- */
.history-hero{position:relative;display:flex;align-items:center;justify-content:center;min-height:640px;overflow:hidden;isolation:isolate;background:#fff;color:#0d3a66}
.history-hero::after{content:"STRUKTUR";position:absolute;z-index:0;left:2%;top:58%;transform:translateY(-50%);
  font-family:var(--font-display);font-size:clamp(10rem,25vw,25rem);font-weight:900;line-height:.78;letter-spacing:.015em;
  color:rgba(13,58,102,.035);-webkit-text-stroke:1px rgba(255,122,0,.09);pointer-events:none;white-space:nowrap;user-select:none}
.history-ref-ornaments{position:absolute;inset:0;z-index:1;overflow:hidden;pointer-events:none}
.history-ref-ornament-image{position:absolute;inset:0;width:100%;height:100%;display:block;object-fit:cover;object-position:center;max-width:none}
.history-hero-inner{position:relative;z-index:4;width:100%;max-width:1600px;margin:0 auto;
  padding:clamp(5.5rem,12vh,8.5rem) clamp(1.5rem,5vw,5rem) clamp(5rem,10vh,7.5rem);
  display:flex;flex-direction:column;justify-content:center;align-items:flex-start}
.history-kicker{position:relative;z-index:5;display:inline-flex;align-items:center;gap:.65rem;font-size:.72rem;font-weight:900;
  letter-spacing:.18em;text-transform:uppercase;color:#ff6f00;margin-bottom:1.2rem;padding:.55rem .85rem;
  border:1px solid rgba(255,111,0,.18);border-radius:999px;background:#fffaf5}
.history-kicker::before{content:"";width:9px;height:9px;border-radius:50%;background:#ff6f00;box-shadow:0 0 0 6px rgba(255,111,0,.10)}
.history-title{position:relative;z-index:5;font-family:var(--font-display);font-size:clamp(3rem,7.5vw,6.8rem);line-height:.94;
  letter-spacing:-.02em;margin:0;max-width:100%;text-transform:uppercase;word-break:normal;overflow-wrap:normal;
  animation:hdFadeUp .7s .1s var(--ease,ease) both}
.history-title .sejarah-white{display:block;color:#0d3a66}
.history-title .skaneda-gold{display:block;background:linear-gradient(135deg,#ffd54a 0%,#ffb300 45%,#ff7a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent;letter-spacing:-.025em}
.history-vt-cta{position:relative;z-index:5;display:inline-flex;align-items:center;gap:.8rem;margin-top:2rem;
  padding:.8rem 1rem;border-radius:16px;text-decoration:none;color:#0d3a66;background:#fff;border:1px solid rgba(13,58,102,.12);
  box-shadow:0 12px 30px rgba(13,58,102,.08);transition:transform .3s ease,background .3s ease,border-color .3s ease,box-shadow .3s ease}
.history-vt-cta:hover{transform:translateY(-4px);background:#fffaf5;border-color:rgba(255,122,0,.28);box-shadow:0 18px 38px rgba(13,58,102,.12)}
.history-vt-icon{width:46px;height:46px;border-radius:14px;display:grid;place-items:center;background:linear-gradient(135deg,#ffd54a,#ff7a00);color:#0d3a66;font-size:.9rem}
.history-vt-cta strong{display:block;font-size:1rem;line-height:1.15;font-weight:900;letter-spacing:.01em}
.history-vt-cta small{display:block;margin-top:.25rem;color:#718096;font-size:.72rem;font-weight:600}
.history-vt-arrow{margin-left:.3rem;color:#ffd54a;font-size:1rem}

/* ---------- COMMON ---------- */
.eyebrow{display:inline-flex;align-items:center;gap:.5rem;font-size:.74rem;font-weight:800;letter-spacing:.18em;text-transform:uppercase;color:#0d3a66;margin-bottom:.85rem}
.eyebrow::before{content:"";width:26px;height:3px;border-radius:99px;background:linear-gradient(90deg,#0d3a66,#2f6fa8)}
.big-heading{font-family:var(--font-display);font-size:clamp(2.1rem,4.4vw,4.2rem);line-height:1.02;letter-spacing:.01em;margin:0;color:#0d3a66;text-shadow:0 2px 10px rgba(13,58,102,.06)}
.big-heading span{background:linear-gradient(135deg,#ffd54a 0%,#ffb300 45%,#ff7a00 100%);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}

/* ---------- SECTION BAGAN ---------- */
.so-chart-section{position:relative;padding:110px 0 130px;overflow:hidden;isolation:isolate;
  background:radial-gradient(circle at 8% 18%,rgba(47,111,168,.12) 0 2px,transparent 3px),radial-gradient(circle at 91% 27%,rgba(255,179,0,.16) 0 3px,transparent 4px),
  radial-gradient(circle at 13% 78%,rgba(47,111,168,.10) 0 2px,transparent 3px),linear-gradient(180deg,#f8fbfe 0%,#eef5fa 100%)}
.so-chart-section::after{content:"";position:absolute;left:-35px;top:180px;width:185px;height:185px;background-image:radial-gradient(circle,rgba(31,100,170,.45) 2.2px,transparent 3px);background-size:20px 20px;opacity:.65;pointer-events:none;z-index:0}
.so-chart-section::before{content:"";position:absolute;right:-20px;bottom:90px;width:175px;height:175px;background-image:radial-gradient(circle,rgba(255,179,0,.55) 2px,transparent 3px);background-size:19px 19px;opacity:.5;pointer-events:none;z-index:0}
.so-wrap{width:min(1380px,94%);margin:0 auto;position:relative;z-index:2}
.so-sec-head{text-align:center;margin:0 auto 1.6rem;position:relative;z-index:2}
.so-sec-head .eyebrow{justify-content:center}
.so-sec-head .eyebrow::after{content:"\2022 \2022 \2022";color:#ffb300;letter-spacing:5px;font-size:12px;margin-left:.4rem}
.so-sec-head .big-heading{margin:0 auto}
.so-sec-desc{max-width:680px;margin:1rem auto 0;color:#5f7186;line-height:1.85}

/* ---------- TOOLBAR ---------- */
.so-toolbar{display:flex;align-items:center;gap:.9rem;flex-wrap:wrap;background:rgba(255,255,255,.85);border:1px solid rgba(13,58,102,.16);border-radius:22px;
  padding:1rem 1.2rem;margin:0 auto 2rem;max-width:1180px;box-shadow:0 18px 44px rgba(13,58,102,.08);backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px)}
.so-search{flex:1 1 100%;display:flex;align-items:center;gap:.7rem;background:#fff;border:1px solid rgba(13,58,102,.18);border-radius:16px;padding:.8rem 1.15rem}
.so-search i{color:#2f6fa8}
.so-search input{flex:1;border:none;outline:none;background:transparent;font-size:.86rem;color:#0d3a66;min-width:0}
.so-search input::placeholder{color:#8fa3b6}
.so-filter-label{font-size:.72rem;font-weight:800;text-transform:uppercase;letter-spacing:.1em;color:#6d7f91}
.so-filters{display:flex;gap:.5rem;flex-wrap:wrap}
.so-fchip{padding:.5rem .9rem;border-radius:999px;border:1px solid rgba(13,58,102,.18);background:#fff;color:#0d3a66;font-size:.72rem;font-weight:800;cursor:pointer;transition:all .3s ease}
.so-fchip:hover{border-color:rgba(255,179,0,.5);transform:translateY(-2px)}
.so-fchip.is-active{background:linear-gradient(135deg,#0d3a66,#2f6fa8);color:#fff;border-color:transparent;box-shadow:0 8px 20px rgba(13,58,102,.3)}
.so-empty{display:none;text-align:center;padding:3rem 1rem;color:#8fa3b6}
.so-empty.show{display:block}
.so-empty i{font-size:2rem;color:#c3d3e2;margin-bottom:.6rem;display:block}

/* ---------- LEVEL & GRID ---------- */
.so-chart{position:relative;z-index:2;display:flex;flex-direction:column;gap:3.2rem;margin-top:1rem}
.so-level{position:relative}
.so-level-head{display:flex;align-items:center;gap:1rem;margin-bottom:1.5rem}
.so-level-badge{display:inline-flex;align-items:center;gap:.5rem;padding:.5rem .95rem;border-radius:999px;background:linear-gradient(135deg,#0d3a66,#2f6fa8);color:#fff;font-size:.72rem;font-weight:800;letter-spacing:.06em;box-shadow:0 10px 24px rgba(13,58,102,.28)}
.so-level-badge i{color:#ffd54a}
.so-level-rule{flex:1;height:1px;background:linear-gradient(90deg,rgba(13,58,102,.22),transparent)}
.so-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1.3rem;align-items:start}
.so-grid.cols-5{grid-template-columns:repeat(5,1fr)}
.so-level:not(.so-level-root) .so-grid{gap:1.2rem}

/* ---------- KARTU FEED (gaya Instagram) ---------- */
.so-card{position:relative;background:#fff;border:1px solid rgba(13,58,102,.10);border-radius:22px;padding:0 0 1rem;text-align:left;cursor:pointer;overflow:hidden;
  box-shadow:0 14px 34px rgba(13,58,102,.09);transition:transform .4s cubic-bezier(.22,.61,.36,1),box-shadow .4s ease,border-color .3s ease;outline:none}
.so-card:hover,.so-card:focus-visible{transform:translateY(-7px);box-shadow:0 24px 48px rgba(13,58,102,.15);border-color:rgba(255,179,0,.45)}
.so-card::before{content:"";position:absolute;top:0;left:0;width:100%;height:3px;z-index:4;background:linear-gradient(90deg,#0d3a66,#2f6fa8,#ffb300);transform:scaleX(0);transform-origin:left;transition:transform .45s ease}
.so-card:hover::before,.so-card:focus-visible::before{transform:scaleX(1)}
.so-card::after{content:"";position:absolute;right:14px;bottom:14px;width:22px;height:22px;border:1px solid rgba(13,58,102,.18);opacity:.28;z-index:1;transform:rotate(45deg);pointer-events:none}
.so-card.is-hidden{display:none}
.so-card.is-match{outline:3px solid rgba(255,179,0,.5);outline-offset:2px}
.so-feed-head{display:flex;align-items:center;gap:.65rem;min-height:58px;margin:0;padding:.72rem .85rem;background:#fff}
.so-feed-head img{width:38px;height:38px;flex:0 0 38px;object-fit:contain;border-radius:50%;padding:2px;background:#fff;border:2px solid #ffb300;box-shadow:0 3px 10px rgba(13,58,102,.12)}
.so-feed-account{min-width:0;display:flex;flex-direction:column;line-height:1.1}
.so-feed-account strong{font-family:var(--font-display);font-size:.76rem;font-weight:900;letter-spacing:.035em;color:#0d3a66}
.so-feed-account span{margin-top:.2rem;font-size:.58rem;color:#8a9bad;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.so-feed-more{margin-left:auto;color:#718396;font-size:.82rem;padding:.2rem}
.so-photo-wrap{position:relative;isolation:isolate;width:100%;height:260px;margin:0;padding:0;background:linear-gradient(180deg,#edf5fb,#dce9f4);border-top:1px solid rgba(13,58,102,.06);border-bottom:1px solid rgba(13,58,102,.08)}
.so-photo{position:absolute;inset:0;width:100%;height:100%;border:0;border-radius:0;box-shadow:none;background:linear-gradient(180deg,#eef6fc 0%,#dbe9f5 100%);overflow:hidden}
.so-photo img{width:100%;height:100%;object-fit:cover;object-position:center top;display:block;transition:transform .55s ease,filter .35s ease}
.so-card:hover .so-photo img{transform:scale(1.035);filter:saturate(1.04)}
.so-photo-ring{position:absolute;inset:10px;border-radius:14px;border:1px solid rgba(255,255,255,.45);border-top-color:rgba(255,213,74,.8);z-index:2;pointer-events:none;transition:transform .55s ease}
.so-card:hover .so-photo-ring{transform:rotate(5deg)}
.so-photo-tag{position:absolute;right:14px;bottom:12px;width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,#0d3a66,#2f6fa8);color:#ffd54a;font-size:.68rem;
  display:flex;align-items:center;justify-content:center;border:2px solid #fff;box-shadow:0 6px 16px rgba(0,0,0,.18);z-index:4}
.so-photo-tag.is-gold{background:linear-gradient(135deg,#ffd54a,#ff8a00);color:#0d3a66}
.so-feed-actions{display:flex;align-items:center;gap:.9rem;padding:.65rem .85rem .25rem;color:#0d3a66;font-size:1rem}
.so-feed-actions i{transition:transform .2s ease,color .2s ease;cursor:pointer}
.so-feed-actions i:hover{transform:scale(1.16);color:#ff9f00}
.so-feed-actions .so-bookmark{margin-left:auto}
.so-card-name{font-family:var(--font-display);font-size:1rem;font-weight:800;color:#0d3a66;line-height:1.3;text-align:left;margin:.25rem .85rem .22rem}
.so-card-person{font-size:.7rem;font-weight:700;text-align:left;margin:0 .85rem .45rem;color:#6f8498}
.so-card-role{display:flex;align-items:center;justify-content:center;gap:.4rem;width:max-content;max-width:calc(100% - 1.7rem);margin:.15rem .85rem .5rem;font-size:.6rem;font-weight:800;
  color:#8a5a00;background:rgba(255,179,0,.14);border:1px solid rgba(255,179,0,.3);padding:.25rem .58rem;border-radius:999px}
.so-card-role i{color:#ffb300}
.so-card-unit{font-size:.68rem;line-height:1.55;text-align:left;margin:0 .85rem;color:#718396}

/* Kepala Sekolah = kartu tunggal terpusat */
.so-level-root .so-grid{display:flex;justify-content:center;grid-template-columns:1fr;width:100%;max-width:340px;margin:0 auto}
.so-level-root .so-card{width:100%;max-width:340px;padding-bottom:1.15rem;border-radius:24px}
.so-level-root .so-photo-wrap{height:225px;width:100%}
.so-level-root .so-card-name{font-size:1.05rem}

@media(min-width:951px){#level-3 .so-grid.cols-5{grid-template-columns:repeat(4,minmax(0,1fr));gap:1.3rem}}
@media(max-width:1100px){.so-photo-wrap{height:175px}.so-level-root .so-photo-wrap{height:215px}}
@media(max-width:950px){
  .so-level:not(.so-level-root) .so-grid{grid-template-columns:repeat(2,minmax(0,1fr))}
}
@media(max-width:700px){
  .so-toolbar{flex-direction:column;align-items:stretch}
  .so-search{width:100%}
  .so-filters{overflow-x:auto;white-space:nowrap;flex-wrap:nowrap;padding-bottom:.4rem}
  .so-photo-wrap{height:165px}
  .so-level-root .so-grid{max-width:300px}
  .so-level-root .so-photo-wrap{height:200px}
  .so-feed-head{min-height:52px;padding:.6rem .7rem}
  .so-feed-head img{width:34px;height:34px;flex-basis:34px}
}
@media(max-width:520px){
  .so-level:not(.so-level-root) .so-grid{grid-template-columns:repeat(2,minmax(0,1fr));gap:.75rem}
  .so-photo-wrap{height:155px}
  .so-level-root .so-grid{max-width:280px}
  .so-level-root .so-photo-wrap{height:190px}
}

/* ---------- VIRTUAL TOUR ---------- */
.vt-section{position:relative;overflow:hidden;isolation:isolate;padding:120px 0 130px;scroll-margin-top:90px;background:linear-gradient(180deg,#eef5fb 0%,#ffffff 48%,#f3f7fb 100%)}
.vt-section::before{content:"";position:absolute;inset:0;pointer-events:none;opacity:.42;background-image:radial-gradient(circle,rgba(13,58,102,.18) 1.5px,transparent 2px);background-size:22px 22px;
  -webkit-mask-image:linear-gradient(90deg,transparent 0%,#000 15%,#000 85%,transparent 100%);mask-image:linear-gradient(90deg,transparent 0%,#000 15%,#000 85%,transparent 100%)}
.vt-watermark{position:absolute;right:-20px;top:40px;font-size:clamp(9rem,18vw,16rem);font-weight:900;line-height:.8;color:rgba(13,58,102,.035);letter-spacing:-.08em;z-index:0;user-select:none}
.vt-decor-ring{position:absolute;right:-70px;top:80px;width:300px;height:300px;border:1px solid rgba(13,58,102,.12);border-radius:50%;z-index:0}
.vt-decor-ring::before{content:"";position:absolute;inset:35px;border:1px dashed rgba(255,179,0,.3);border-radius:50%}
.vt-decor-dots{position:absolute;left:4%;bottom:65px;width:125px;height:125px;opacity:.42;background-image:radial-gradient(circle,#ffb300 2px,transparent 2.5px);background-size:18px 18px;z-index:0}
.vt-inner{position:relative;z-index:2;width:min(1180px,92%);margin:0 auto;display:grid;grid-template-columns:minmax(0,1.05fr) minmax(360px,.95fr);gap:clamp(2.5rem,5vw,4.5rem);align-items:center}
.vt-media{min-width:0}
.vt-frame{position:relative;overflow:hidden;border-radius:30px;background:#0d3a66;box-shadow:0 30px 75px rgba(13,58,102,.2);aspect-ratio:16/10;border:1px solid rgba(255,255,255,.65)}
.vt-frame::after{content:"";position:absolute;inset:0;background:linear-gradient(180deg,transparent 42%,rgba(5,25,48,.78) 100%);pointer-events:none}
.vt-frame img{width:100%;height:100%;display:block;object-fit:cover;transition:transform .7s cubic-bezier(.22,.61,.36,1)}
.vt-frame:hover img{transform:scale(1.045)}
.vt-badge{position:absolute;left:1.2rem;top:1.2rem;z-index:3;display:inline-flex;align-items:center;gap:.5rem;padding:.58rem .85rem;border-radius:999px;background:rgba(13,58,102,.86);color:#fff;font-size:.74rem;font-weight:800;letter-spacing:.08em;text-transform:uppercase;backdrop-filter:blur(8px)}
.vt-play{position:absolute;z-index:4;left:50%;top:50%;transform:translate(-50%,-50%);width:78px;height:78px;border-radius:50%;border:7px solid rgba(255,255,255,.22);background:linear-gradient(135deg,#ffd54a,#ff8a00);color:#0d3a66;font-size:1.35rem;display:grid;place-items:center;cursor:pointer;text-decoration:none;box-shadow:0 18px 45px rgba(255,138,0,.38);transition:transform .3s ease,box-shadow .3s ease}
.vt-play:hover{transform:translate(-50%,-50%) scale(1.08);box-shadow:0 24px 55px rgba(255,138,0,.5)}
.vt-caption{position:absolute;left:1.4rem;right:1.4rem;bottom:1.25rem;z-index:3;display:flex;align-items:flex-end;justify-content:space-between;gap:1rem;color:#fff}
.vt-caption strong{display:block;font-size:1.2rem;font-weight:900}.vt-caption span{display:block;margin-top:.22rem;color:rgba(255,255,255,.76);font-size:.78rem}
.vt-cam{display:inline-flex!important;align-items:center;gap:.4rem;padding:.48rem .7rem;border:1px solid rgba(255,255,255,.28);border-radius:999px!important;background:rgba(0,0,0,.18);white-space:nowrap}
.vt-chip{display:inline-flex;align-items:center;gap:.75rem;margin-top:1rem;padding:.75rem 1rem;border-radius:16px;background:#fff;border:1px solid rgba(13,58,102,.1);box-shadow:0 12px 30px rgba(13,58,102,.08)}
.vt-chip>i{width:40px;height:40px;border-radius:12px;display:grid;place-items:center;background:linear-gradient(135deg,#ffd54a,#ff9f00);color:#0d3a66}.vt-chip strong{display:block;color:#0d3a66;font-size:.85rem}.vt-chip span{display:block;color:#71839a;font-size:.68rem;margin-top:.15rem}
.vt-copy{position:relative;padding-top:.25rem}.vt-kicker{display:inline-flex;align-items:center;gap:.55rem;color:#0d3a66;font-size:.75rem;font-weight:900;letter-spacing:.16em;text-transform:uppercase}.vt-kicker::before{content:"";width:34px;height:3px;border-radius:99px;background:linear-gradient(90deg,#ffd54a,#ff8a00)}
.vt-title{margin:.8rem 0 1.1rem;max-width:620px;color:#0d3a66;font-family:var(--font-display);font-size:clamp(2.8rem,5vw,4.8rem);font-weight:900;line-height:.98;letter-spacing:-.045em}.vt-gold{display:block;background:linear-gradient(90deg,#ffd54a,#ff8a00);-webkit-background-clip:text;background-clip:text;color:transparent}.vt-sub{display:block;margin-top:.55rem;font-size:.38em;line-height:1.1;letter-spacing:.02em;color:#315b80;font-weight:800}
.vt-desc{max-width:590px;margin-top:.2rem;color:#667b90;line-height:1.9;font-size:.98rem}.vt-feats{display:flex;flex-wrap:wrap;gap:.55rem;margin:1.25rem 0}.vt-feat{display:inline-flex;align-items:center;gap:.4rem;padding:.55rem .75rem;border-radius:999px;background:#fff;border:1px solid rgba(13,58,102,.1);color:#315b80;font-size:.74rem;font-weight:800}.vt-feat i{color:#ff9f00}.vt-btn{display:inline-flex;align-items:center;justify-content:center;gap:.65rem;padding:.9rem 1.2rem;border-radius:14px;background:linear-gradient(135deg,#0d3a66,#164e80);color:#fff;text-decoration:none;font-weight:900;box-shadow:0 14px 32px rgba(13,58,102,.2);transition:transform .3s ease,box-shadow .3s ease}.vt-btn:hover{transform:translateY(-4px);box-shadow:0 20px 40px rgba(13,58,102,.28)}
@media(max-width:900px){.vt-inner{grid-template-columns:1fr;gap:2.5rem}.vt-copy{max-width:700px}.vt-title{font-size:clamp(2.6rem,10vw,4rem)}}
@media(max-width:600px){.vt-section{padding:85px 0 95px}.vt-inner{width:92%;gap:2rem}.vt-frame{aspect-ratio:4/3;border-radius:22px}.vt-play{width:64px;height:64px}.vt-caption{left:1rem;right:1rem;bottom:1rem}.vt-caption strong{font-size:1rem}.vt-caption span{font-size:.7rem}.vt-cam{display:none!important}.vt-title{font-size:clamp(2.35rem,12vw,3.3rem)}.vt-decor-ring{width:190px;height:190px;right:-80px}.vt-decor-dots{width:90px;height:90px;background-size:14px 14px}}

/* ---------- PERAN & TUGAS ---------- */
.so-sec-head-mid{width:min(1100px,92%);margin:4.6rem auto 0;text-align:center}
.so-roles{display:grid;grid-template-columns:repeat(3,1fr);gap:1.6rem;width:min(1240px,92%);margin:2.5rem auto 0;align-items:stretch}
.so-role-card{position:relative;background:#fff;border:1px solid rgba(13,58,102,.12);border-radius:24px;padding:2.2rem 1.8rem 2rem;overflow:hidden;
  box-shadow:0 16px 40px rgba(13,58,102,.08);display:flex;flex-direction:column;justify-content:flex-start;transition:transform .35s ease,box-shadow .35s ease,border-color .35s ease}
.so-role-card:hover{transform:translateY(-9px);box-shadow:0 30px 62px rgba(13,58,102,.2);border-color:rgba(255,179,0,.45)}
.so-role-card::before{content:"";position:absolute;top:0;left:0;width:100%;height:4px;background:linear-gradient(90deg,#0d3a66,#2f6fa8,#ffb300)}
.so-role-step{position:absolute;top:1.2rem;right:1.4rem;font-family:var(--font-display);font-size:1.8rem;font-weight:900;color:rgba(13,58,102,.08);letter-spacing:.05em;pointer-events:none;line-height:1}
.so-role-icon{width:54px;height:54px;border-radius:16px;margin-bottom:1.2rem;background:linear-gradient(135deg,#0d3a66,#2f6fa8);color:#ffd54a;font-size:1.25rem;display:flex;align-items:center;justify-content:center;box-shadow:0 10px 24px rgba(13,58,102,.22);flex-shrink:0;transition:transform .35s ease}
.so-role-card:hover .so-role-icon{transform:rotate(-8deg) scale(1.08)}
.so-role-icon.is-gold{background:linear-gradient(135deg,#ffd54a,#ff8a00);color:#0d3a66}
.so-role-card h4{font-family:var(--font-display);font-size:1.15rem;font-weight:800;color:#0d3a66;line-height:1.35;margin:0 0 .65rem}
.so-role-card p{font-size:.88rem;line-height:1.75;color:#52657a;margin:0}
@media(max-width:900px){
  .so-roles{grid-template-columns:1fr;gap:1.2rem;width:100%;padding:0 1rem}
  .so-role-card{padding:1.6rem 1.4rem 1.5rem;border-radius:20px}
  .so-role-icon{width:48px;height:48px;font-size:1.1rem;margin-bottom:.9rem;border-radius:14px}
  .so-role-card h4{font-size:1.08rem}
  .so-role-card p{font-size:.85rem;line-height:1.65}
  .so-role-step{top:1rem;right:1.2rem;font-size:1.5rem}
}

/* ---------- CTA PENUTUP ---------- */
.so-cta{position:relative;width:min(1240px,90%);margin:4.6rem auto 7rem;padding:90px 0 100px;overflow:hidden;text-align:center;isolation:isolate;
  border-radius:28px;background:linear-gradient(135deg,#0b3558,#0d3a66 45%,#0d3a66);color:#fff}
.so-cta::after{content:"SKANEDA";position:absolute;left:50%;bottom:-34px;transform:translateX(-50%);font-family:var(--font-display);font-size:clamp(3.4rem,11vw,9rem);font-weight:900;line-height:1;
  letter-spacing:.05em;color:rgba(255,255,255,.045);-webkit-text-stroke:1px rgba(255,255,255,.06);pointer-events:none;white-space:nowrap;user-select:none}
.so-cta-inner{position:relative;z-index:2;width:min(800px,92%);margin:auto}
.so-cta h3{font-family:var(--font-display);font-size:clamp(1.9rem,4vw,3.2rem);line-height:1.08;margin:0 0 1rem;color:#fff}
.so-cta h3 span{background:linear-gradient(135deg,#ffd54a,#ffb300 50%,#ff7a00);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}
.so-cta p{color:rgba(235,245,253,.8);line-height:1.85;max-width:620px;margin:0 auto 2rem}
.so-cta-btn{display:inline-flex;align-items:center;gap:.6rem;padding:.95rem 2rem;border-radius:999px;background:linear-gradient(135deg,#ffd54a,#ff8a00);color:#0d3a66;font-size:.92rem;font-weight:900;text-decoration:none;box-shadow:0 16px 36px rgba(255,138,0,.4);transition:transform .3s ease,box-shadow .3s ease}
.so-cta-btn:hover{transform:translateY(-4px);box-shadow:0 22px 46px rgba(255,138,0,.5)}
.so-cta-btn i{transition:transform .3s ease}
.so-cta-btn:hover i{transform:translateX(5px)}

/* ---------- MODAL DETAIL ---------- */
.so-modal-overlay{position:fixed;inset:0;z-index:1000;display:flex;align-items:center;justify-content:center;background:rgba(6,18,34,.72);backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);opacity:0;visibility:hidden;transition:opacity .35s ease,visibility .35s ease;padding:1.2rem}
.so-modal-overlay.open{opacity:1;visibility:visible}
.so-modal{position:relative;width:min(640px,100%);max-height:90vh;overflow:auto;border-radius:24px;background:#fff;box-shadow:0 44px 110px rgba(4,14,28,.5);transform:translateY(26px) scale(.97);transition:transform .4s cubic-bezier(.22,.61,.36,1)}
.so-modal-overlay.open .so-modal{transform:none}
.so-modal-close{position:absolute;top:14px;right:14px;z-index:5;width:40px;height:40px;border-radius:50%;border:none;background:rgba(255,255,255,.16);color:#fff;font-size:1.05rem;cursor:pointer;transition:background .3s ease,transform .3s ease}
.so-modal-close:hover{background:rgba(255,255,255,.3);transform:rotate(90deg)}
.so-modal-head{position:relative;padding:2.4rem 2rem 2rem;text-align:center;overflow:hidden;background:linear-gradient(135deg,#0b3558,#0d3a66 60%,#2f6fa8);color:#fff}
.so-modal-head::after{content:"";position:absolute;right:-40px;top:-50px;width:180px;height:180px;border:2px solid rgba(255,213,74,.28);transform:rotate(45deg)}
.so-modal-head::before{content:"";position:absolute;left:-30px;bottom:-60px;width:150px;height:150px;border-radius:50%;border:1px dashed rgba(255,255,255,.18)}
.so-modal-avatar{position:relative;z-index:2;width:92px;height:92px;margin:0 auto 1rem;border-radius:26px;background:linear-gradient(135deg,#ffd54a,#ff8a00);color:#0d3a66;font-size:2.1rem;display:flex;align-items:center;justify-content:center;transform:rotate(45deg);box-shadow:0 18px 40px rgba(255,138,0,.4)}
.so-modal-avatar i{transform:rotate(-45deg)}
.so-modal-avatar.has-photo{width:112px;height:112px;border-radius:50%;transform:none;overflow:hidden;border:4px solid rgba(255,255,255,.85);background:#dbe9f5}
.so-modal-avatar.has-photo img{width:100%;height:100%;object-fit:cover;object-position:center top;display:block}
.so-modal-name{position:relative;z-index:2;font-family:var(--font-display);font-size:1.5rem;font-weight:800;line-height:1.25}
.so-modal-role{position:relative;z-index:2;display:inline-flex;align-items:center;gap:.45rem;margin-top:.5rem;font-size:.74rem;font-weight:800;color:#ffd54a;background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.22);padding:.4rem .9rem;border-radius:999px}
.so-modal-body{padding:1.8rem 2rem 2.2rem}
.so-modal-section{margin-bottom:1.4rem}
.so-modal-label{display:flex;align-items:center;gap:.5rem;font-size:.72rem;font-weight:800;text-transform:uppercase;letter-spacing:.12em;color:#2f6fa8;margin-bottom:.7rem}
.so-modal-label i{color:#ffb300}
.so-modal-tags{display:flex;gap:.5rem;flex-wrap:wrap}
.so-tag{padding:.4rem .85rem;border-radius:999px;font-size:.72rem;font-weight:800;background:rgba(47,111,168,.1);border:1px solid rgba(47,111,168,.25);color:#0d3a66}
.so-tag.is-gold{background:rgba(255,179,0,.14);border-color:rgba(255,179,0,.35);color:#8a5a00}
.so-modal-tasks{list-style:none;margin:0;padding:0;display:flex;flex-direction:column;gap:.55rem}
.so-modal-tasks li{display:flex;gap:.7rem;font-size:.86rem;line-height:1.6;color:#4a5f74}
.so-modal-tasks li i{color:#ffb300;margin-top:.3rem;flex:none}
.so-modal-note{display:flex;gap:.6rem;font-size:.8rem;line-height:1.65;color:#8fa3b6;background:rgba(47,111,168,.07);border:1px dashed rgba(47,111,168,.25);padding:.8rem 1rem;border-radius:14px}
.so-modal-note i{color:#2f6fa8;margin-top:.15rem}

/* ---------- SCROLL REVEAL ---------- */
[data-reveal]{opacity:0;transform:translateY(36px);transition:opacity .85s cubic-bezier(.22,.61,.36,1),transform .85s cubic-bezier(.22,.61,.36,1);will-change:opacity,transform}
[data-reveal="left"]{transform:translateX(-46px)}
[data-reveal="right"]{transform:translateX(46px)}
[data-reveal].revealed{opacity:1;transform:none}
[data-reveal]{transition-delay:calc(var(--d,0)*90ms)}

/* ---------- ORNAMEN GAYA BERANDA ---------- */
.home-orn{position:absolute;inset:0;z-index:0;pointer-events:none;overflow:hidden}
.home-orn .ho-chevron{position:absolute;width:360px;height:360px;border-top:2px solid rgba(13,58,102,.11);border-right:2px solid rgba(13,58,102,.11);transform:rotate(45deg)}
.home-orn .ho-chevron::after{content:"";position:absolute;inset:34px;border-top:2px solid rgba(47,111,168,.09);border-right:2px solid rgba(47,111,168,.09)}
.home-orn .ho-line{position:absolute;width:310px;height:2px;background:linear-gradient(90deg,transparent,#2f6fa8,transparent);opacity:.25;transform:rotate(-42deg)}
.home-orn .ho-line::after{content:"";position:absolute;left:70px;top:11px;width:190px;height:1px;background:linear-gradient(90deg,transparent,#ffd54a,transparent)}
.home-orn .ho-dots{position:absolute;width:125px;height:125px;background-image:radial-gradient(circle,#2f6fa8 2px,transparent 2.8px);background-size:18px 18px;opacity:.38}
.home-orn .ho-ring{position:absolute;width:170px;height:170px;border:1px solid rgba(13,58,102,.13);border-radius:50%;box-shadow:0 0 0 20px rgba(13,58,102,.025),0 0 0 42px rgba(255,213,74,.025)}
.home-orn .ho-ring::before{content:"";position:absolute;inset:22px;border:1px dashed rgba(47,111,168,.18);border-radius:50%}
.home-orn .ho-gold{position:absolute;width:52px;height:8px;border-radius:99px;background:linear-gradient(90deg,#ffd54a,#ffb300,#ff7a00);box-shadow:0 8px 22px rgba(255,179,0,.18);transform:rotate(-35deg)}
.home-orn .ho-square{position:absolute;width:58px;height:58px;border:2px solid rgba(255,179,0,.32);transform:rotate(45deg)}
.home-orn .ho-square::before{content:"";position:absolute;inset:10px;border:1px solid rgba(13,58,102,.18)}
.home-orn .ho-corner{position:absolute;width:110px;height:110px;border-left:3px solid rgba(13,58,102,.12);border-bottom:3px solid rgba(13,58,102,.12)}
.home-orn .ho-corner::after{content:"";position:absolute;left:18px;bottom:18px;width:46px;height:3px;background:#ffd54a;border-radius:99px}

.so-chart-section .home-orn .ho-chevron{right:-145px;top:45px}
.so-chart-section .home-orn .ho-line{left:-80px;top:170px}
.so-chart-section .home-orn .ho-dots{left:3%;bottom:100px}
.so-chart-section .home-orn .ho-ring{right:8%;bottom:90px}
.so-chart-section .home-orn .ho-gold{right:16%;top:22%}
.so-chart-section .home-orn .ho-square{left:11%;top:15%}
.so-chart-section .home-orn .ho-corner{right:3%;bottom:8%;transform:rotate(180deg)}

/* CTA: semua ornamen diberi posisi supaya tidak "nyasar" ke tepi atas kartu */
.so-cta .home-orn .ho-chevron{left:-120px;bottom:-80px;border-color:rgba(255,255,255,.10)}
.so-cta .home-orn .ho-chevron::after{border-color:rgba(255,213,74,.08)}
.so-cta .home-orn .ho-line{right:-70px;top:22%}
.so-cta .home-orn .ho-dots{left:8%;top:30%;opacity:.22}
.so-cta .home-orn .ho-ring{right:-70px;top:20%;border-color:rgba(255,255,255,.10)}
.so-cta .home-orn .ho-gold{left:20%;bottom:26%}
.so-cta .home-orn .ho-square{right:12%;bottom:16%;border-color:rgba(255,213,74,.25)}
.so-cta .home-orn .ho-corner{right:4%;bottom:7%;transform:rotate(180deg);border-color:rgba(255,255,255,.12)}

.so-chart-section>*:not(.home-orn),.so-cta>*:not(.home-orn){position:relative;z-index:2}

/* ---------- HOVER LANGUAGE ---------- */
.so-page .eyebrow,.so-page .so-card,.so-page .so-role-card,.so-page .big-heading{transition:transform .35s ease,box-shadow .35s ease,filter .35s ease,border-color .35s ease,background .35s ease}
.so-page .eyebrow:hover{transform:translateX(6px)}
.so-page .big-heading:hover{transform:translateX(4px)}

/* ---------- ORNAMEN HALAMAN ---------- */
.so-page::before{content:"";position:fixed;right:-110px;top:18%;width:230px;height:230px;border:2px solid rgba(13,58,102,.14);transform:rotate(45deg);z-index:0;pointer-events:none}
.so-page::after{content:"";position:fixed;left:-95px;bottom:10%;width:190px;height:190px;border:2px solid rgba(47,111,168,.14);border-radius:28px;transform:rotate(25deg);z-index:0;pointer-events:none}

/* ---------- FEED ORNAMENT (SVG) ---------- */
.so-feed-orn{position:absolute;inset:0;z-index:0;pointer-events:none;overflow:hidden}
.so-feed-orn svg{position:absolute;inset:0;width:100%;height:100%;display:block}
.so-feed-orn .orn-line{fill:none;stroke:#0d3a66;stroke-width:1.35;opacity:.20;vector-effect:non-scaling-stroke}
.so-feed-orn .orn-line-gold{fill:none;stroke:#ff8a00;stroke-width:1.25;opacity:.34;vector-effect:non-scaling-stroke}
.so-feed-orn .orn-dash{fill:none;stroke:#2f6fa8;stroke-width:1;stroke-dasharray:5 8;opacity:.22;vector-effect:non-scaling-stroke}
.so-feed-orn .orn-ring{fill:none;stroke:#0d3a66;stroke-width:1.15;opacity:.15;vector-effect:non-scaling-stroke}
.so-feed-orn .orn-ring-gold{fill:none;stroke:#ff9f00;stroke-width:1.35;opacity:.27;vector-effect:non-scaling-stroke}
.so-feed-orn .orn-diamond{fill:none;stroke:#ff8a00;stroke-width:1.45;opacity:.34;vector-effect:non-scaling-stroke}
.so-feed-orn .orn-diamond-navy{fill:none;stroke:#0d3a66;stroke-width:1.2;opacity:.17;vector-effect:non-scaling-stroke}
.so-feed-orn .orn-node{fill:#fff;stroke:#ff8a00;stroke-width:1.8;vector-effect:non-scaling-stroke}
.so-feed-orn .orn-node-navy{fill:#fff;stroke:#0d3a66;stroke-width:1.7;vector-effect:non-scaling-stroke}
.so-feed-orn .orn-dot{fill:#ff8a00;opacity:.65}
.so-feed-orn .orn-dot-navy{fill:#0d3a66;opacity:.72}
.so-feed-orn .orn-solid-gold{fill:#ff8a00;opacity:.88}
.so-feed-orn .orn-solid-navy{fill:#0d3a66;opacity:.92}
.so-feed-orn .orn-grid-dot{fill:#2f6fa8;opacity:.35}
.so-feed-orn .orn-soft{fill:#ff8a00;opacity:.045}
.so-feed-orn .orn-glow{fill:#0d3a66;opacity:.035}
.so-feed-orn .orn-left-top{transform:translate(-28px,-12px)}
.so-feed-orn .orn-right-top{transform:translate(28px,8px)}
.so-feed-orn .orn-left-bottom{transform:translate(-12px,28px)}
.so-feed-orn .orn-right-bottom{transform:translate(26px,34px)}
@media(min-width:951px){
  .so-chart::before{content:"";position:absolute;left:50%;top:2.4rem;bottom:2.6rem;width:1px;transform:translateX(-50%);
    background:linear-gradient(180deg,transparent 0%,rgba(255,138,0,.22) 8%,rgba(13,58,102,.16) 38%,rgba(255,138,0,.22) 68%,transparent 100%);z-index:-1;pointer-events:none}
  .so-chart::after{content:"";position:absolute;left:calc(50% - 5px);top:18%;width:9px;height:9px;border-radius:50%;background:#ff8a00;
    box-shadow:0 0 0 6px rgba(255,138,0,.08),0 0 0 12px rgba(255,138,0,.035);z-index:-1;pointer-events:none}
}
@media(max-width:950px){.so-feed-orn{opacity:.68}.so-feed-orn svg{transform:scale(1.08)}}
@media(max-width:600px){.so-feed-orn{opacity:.48}.so-feed-orn .hide-mobile{display:none}}

/* ---------- HERO RESPONSIVE ---------- */
@media(max-width:1050px){.history-hero-inner{padding-right:1.25rem}}
@media(max-width:900px){.history-ref-ornament-image{opacity:.88}}
@media(max-width:768px){.history-hero{min-height:440px}.history-title{font-size:clamp(2rem,10vw,3.6rem)}}
@media(max-width:700px){.history-vt-cta{width:min(100%,340px)}.history-vt-cta .history-vt-arrow{margin-left:auto}}
@media(max-width:560px){.history-ref-ornament-image{opacity:.62}}
</style>
@endpush

@section('content')
@php
  $tourUrl = \Illuminate\Support\Facades\Route::has('profil.tour') ? route('profil.tour') : url('/profile/tour');
@endphp
<div class="so-page">
  <!-- HERO -->
  <section class="history-hero">
    <div class="history-ref-ornaments" aria-hidden="true">
      <img src="{{ asset('images/wide_minimalist_abstract_technology_background_des.png') }}" alt="" class="history-ref-ornament-image" aria-hidden="true">
    </div>
    <div class="history-hero-inner">
      <div>
        <div class="history-kicker"></div>
        <h3 class="history-title">
          <span class="sejarah-white">STRUKTUR</span>
          <span class="skaneda-gold">ORGANISASI</span>
        </h3>
        <a class="history-vt-cta" href="{{ $tourUrl }}">
          <span class="history-vt-icon"><i class="fas fa-street-view"></i></span>
          <span><strong>Lihat Virtual Tour 360°</strong><small>Jelajahi SMK Negeri 2 Mojokerto</small></span>
          <i class="fas fa-arrow-right history-vt-arrow"></i>
        </a>
      </div>
    </div>
  </section>

  <!-- SECTION BAGAN -->
  <section class="so-chart-section">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span><span class="ho-line"></span><span class="ho-dots"></span><span class="ho-ring"></span>
      <span class="ho-gold"></span><span class="ho-square"></span><span class="ho-corner"></span>
    </div>

    <div class="so-feed-orn" aria-hidden="true">
      <svg viewBox="0 0 1440 1120" preserveAspectRatio="none" role="presentation">
        <defs>
          <radialGradient id="soOrnGlowNavy" cx="50%" cy="50%" r="50%"><stop offset="0%" stop-color="#0d3a66" stop-opacity=".10"/><stop offset="100%" stop-color="#0d3a66" stop-opacity="0"/></radialGradient>
          <radialGradient id="soOrnGlowGold" cx="50%" cy="50%" r="50%"><stop offset="0%" stop-color="#ff8a00" stop-opacity=".13"/><stop offset="100%" stop-color="#ff8a00" stop-opacity="0"/></radialGradient>
          <pattern id="soOrnDots" width="18" height="18" patternUnits="userSpaceOnUse"><circle cx="3" cy="3" r="1.5" class="orn-grid-dot"/></pattern>
        </defs>
        <g class="orn-left-top">
          <circle cx="150" cy="170" r="112" class="orn-ring"/><circle cx="150" cy="170" r="82" class="orn-ring-gold"/><circle cx="150" cy="170" r="52" class="orn-ring"/>
          <circle cx="150" cy="170" r="22" class="orn-solid-gold"/><circle cx="150" cy="170" r="72" class="orn-dash"/>
          <path d="M0 300 L92 208 L206 208 L286 126" class="orn-line"/><path d="M18 332 L116 232 L238 232 L318 152" class="orn-line-gold"/><path d="M45 80 L118 124 L184 76 L270 112" class="orn-dash"/>
          <circle cx="92" cy="208" r="5" class="orn-node-navy"/><circle cx="206" cy="208" r="5" class="orn-node"/><circle cx="286" cy="126" r="5" class="orn-dot"/>
          <circle cx="118" cy="124" r="4" class="orn-dot"/><circle cx="184" cy="76" r="4" class="orn-node"/><circle cx="270" cy="112" r="4" class="orn-dot-navy"/>
          <circle cx="150" cy="170" r="180" class="orn-soft"/>
        </g>
        <g class="orn-right-top">
          <rect x="1138" y="72" width="148" height="148" transform="rotate(45 1212 146)" class="orn-diamond"/>
          <rect x="1165" y="99" width="94" height="94" transform="rotate(45 1212 146)" class="orn-diamond-navy"/>
          <rect x="1192" y="119" width="54" height="54" transform="rotate(45 1219 146)" class="orn-solid-navy"/>
          <path d="M1060 242 L1130 172 L1212 242 L1290 164 L1380 238" class="orn-line"/><path d="M1110 320 L1190 240 L1280 240 L1368 150" class="orn-line-gold"/>
          <circle cx="1060" cy="242" r="5" class="orn-node"/><circle cx="1130" cy="172" r="4" class="orn-dot-navy"/><circle cx="1290" cy="164" r="5" class="orn-node"/>
          <circle cx="1380" cy="238" r="6" class="orn-solid-gold"/><circle cx="1110" cy="320" r="4" class="orn-dot"/><circle cx="1368" cy="150" r="4" class="orn-node-navy"/>
          <rect x="1288" y="310" width="110" height="110" fill="url(#soOrnDots)" opacity=".75"/>
        </g>
        <g class="orn-left-bottom">
          <rect x="76" y="770" width="112" height="112" transform="rotate(45 132 826)" class="orn-diamond"/>
          <rect x="104" y="798" width="56" height="56" transform="rotate(45 132 826)" class="orn-diamond-navy"/>
          <path d="M0 960 L94 866 L184 866 L286 764 L376 764" class="orn-line"/><path d="M0 1010 L126 884 L238 884 L338 784 L430 784" class="orn-line-gold"/><path d="M64 1040 L164 940 L264 940 L364 840" class="orn-dash"/>
          <circle cx="94" cy="866" r="5" class="orn-node"/><circle cx="184" cy="866" r="4" class="orn-dot-navy"/><circle cx="286" cy="764" r="5" class="orn-node-navy"/>
          <circle cx="376" cy="764" r="4" class="orn-dot"/><circle cx="126" cy="884" r="4" class="orn-dot"/><circle cx="338" cy="784" r="5" class="orn-node"/><circle cx="430" cy="784" r="4" class="orn-dot-navy"/>
          <rect x="-16" y="930" width="92" height="92" fill="url(#soOrnDots)" opacity=".62"/>
        </g>
        <g class="orn-right-bottom">
          <circle cx="1225" cy="858" r="128" class="orn-ring"/><circle cx="1225" cy="858" r="96" class="orn-ring-gold"/><circle cx="1225" cy="858" r="62" class="orn-ring"/><circle cx="1225" cy="858" r="28" class="orn-solid-gold"/>
          <path d="M1050 1012 L1148 914 L1234 914 L1320 828 L1428 828" class="orn-line"/><path d="M1084 1056 L1184 956 L1268 956 L1360 864 L1440 864" class="orn-line-gold"/>
          <circle cx="1050" cy="1012" r="5" class="orn-node-navy"/><circle cx="1148" cy="914" r="4" class="orn-dot"/><circle cx="1234" cy="914" r="5" class="orn-node"/>
          <circle cx="1320" cy="828" r="4" class="orn-dot-navy"/><circle cx="1428" cy="828" r="5" class="orn-solid-gold"/>
          <rect x="1280" y="950" width="126" height="126" transform="rotate(45 1343 1013)" class="orn-diamond-navy"/>
          <rect x="1306" y="976" width="74" height="74" transform="rotate(45 1343 1013)" class="orn-diamond"/>
          <circle cx="1225" cy="858" r="185" class="orn-glow"/>
        </g>
        <g class="hide-mobile">
          <circle cx="392" cy="144" r="4" class="orn-solid-gold"/><circle cx="428" cy="182" r="3" class="orn-dot-navy"/><circle cx="1010" cy="150" r="4" class="orn-dot"/><circle cx="1050" cy="188" r="3" class="orn-dot-navy"/>
          <circle cx="334" cy="624" r="3" class="orn-dot"/><circle cx="1090" cy="610" r="4" class="orn-solid-gold"/><circle cx="1018" cy="690" r="3" class="orn-dot-navy"/><circle cx="408" cy="920" r="4" class="orn-dot-navy"/>
        </g>
      </svg>
    </div>

    <div class="so-wrap">
      <div class="so-sec-head" data-reveal>
        <div class="eyebrow">Bagan Organisasi</div>
        <h2 class="big-heading">TIGA LAPISAN, <span>SATU KESATUAN.</span></h2>
      </div>

      <div class="so-toolbar" data-reveal>
        <div class="so-search">
          <i class="fas fa-magnifying-glass"></i>
          <input type="text" id="soSearchInput" placeholder="Cari nama, jabatan, atau bidang..." aria-label="Cari dalam struktur organisasi">
        </div>
        <span class="so-filter-label">Bidang</span>
        <div class="so-filters" id="soFilters">
          <button class="so-fchip is-active" data-filter="*">Semua</button>
          <button class="so-fchip" data-filter="pimpinan">Pimpinan</button>
          <button class="so-fchip" data-filter="kurikulum">Kurikulum</button>
          <button class="so-fchip" data-filter="kesiswaan">Kesiswaan</button>
          <button class="so-fchip" data-filter="sapras">Sarana &amp; Prasarana</button>
          <button class="so-fchip" data-filter="humas">Humas &amp; Industri</button>
          <button class="so-fchip" data-filter="keuangan">Keuangan</button>
          <button class="so-fchip" data-filter="keahlian">Kompetensi Keahlian</button>
        </div>
      </div>

      <div class="so-empty" id="soEmpty">
        <i class="fas fa-magnifying-glass"></i>
        <strong>Tidak ditemukan</strong><br>
        Coba kata kunci atau bidang lain.
      </div>

      <div class="so-chart" id="soChart" data-reveal>

        {{-- ===== LEVEL 1: PIMPINAN ===== --}}
        <div class="so-level so-level-root so-anchor" id="level-1" data-level="1">
          <div class="so-level-head">
            <span class="so-level-badge"><i class="fas fa-user-tie"></i> Level 1 &mdash; Pimpinan</span>
            <span class="so-level-rule"></span>
          </div>
          <div class="so-grid">
            <article class="so-card" tabindex="0" data-name="Kepala Sekolah" data-role="Pimpinan Sekolah" data-unit="Pimpinan" data-filter="pimpinan" data-detail="kepsek">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/pimpinan.png') }}" alt="Foto Kepala Sekolah" loading="lazy"></div>
                <span class="so-photo-tag is-gold"><i class="fas fa-star"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i><i class="far fa-comment" aria-hidden="true"></i><i class="far fa-paper-plane" aria-hidden="true"></i><i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Kepala Sekolah</h3>
              <div class="so-card-person">Iswahyudi S.ST. M.Pd.</div>
              <div class="so-card-role"><i class="fas fa-star"></i> Pimpinan</div>
              <p class="so-card-unit">Pemimpin tertinggi organisasi sekolah</p>
            </article>
          </div>
        </div>

        {{-- ===== LEVEL 2: WAKIL KEPALA SEKOLAH ===== --}}
        <div class="so-level so-anchor" id="level-2" data-level="2">
          <div class="so-level-head">
            <span class="so-level-badge"><i class="fas fa-users-gear"></i> Level 2 &mdash; Wakil Kepala Sekolah</span>
            <span class="so-level-rule"></span>
          </div>
          <div class="so-grid">
            <article class="so-card" tabindex="0" data-name="MELATI PUSPITA SARI, S.Pd." data-role="Waka Kurikulum" data-unit="Kurikulum" data-filter="kurikulum" data-detail="waka-kurikulum">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/melati.png') }}" alt="Foto MELATI PUSPITA SARI, S.Pd." loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-book-open"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i><i class="far fa-comment" aria-hidden="true"></i><i class="far fa-paper-plane" aria-hidden="true"></i><i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Waka Kurikulum</h3>
              <div class="so-card-person">MELATI PUSPITA SARI, S.Pd.</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Waka Kurikulum</div>
              <p class="so-card-unit">Perencanaan dan pengelolaan bidang kurikulum.</p>
            </article>
            <article class="so-card" tabindex="0" data-name="AINUR ROFIK, M. Pd, Si." data-role="Waka Kesiswaan" data-unit="Kesiswaan" data-filter="kesiswaan" data-detail="waka-kesiswaan">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/ainur.png') }}" alt="Foto AINUR ROFIK, M. Pd, Si." loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-users"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i><i class="far fa-comment" aria-hidden="true"></i><i class="far fa-paper-plane" aria-hidden="true"></i><i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Waka Kesiswaan</h3>
              <div class="so-card-person">AINUR ROFIK, M. Pd, Si.</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Waka Kesiswaan</div>
              <p class="so-card-unit">Pembinaan dan layanan peserta didik.</p>
            </article>
            <article class="so-card" tabindex="0" data-name="M. WIRA HENDY HIMAWAN, M.Pd" data-role="Waka Sarana & Prasarana" data-unit="Sarana & Prasarana" data-filter="sapras" data-detail="waka-sapras">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/wira.png') }}" alt="Foto M. WIRA HENDY HIMAWAN, M.Pd" loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-building"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i><i class="far fa-comment" aria-hidden="true"></i><i class="far fa-paper-plane" aria-hidden="true"></i><i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Waka Sarana & Prasarana</h3>
              <div class="so-card-person">M. WIRA HENDY HIMAWAN, M.Pd</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Waka Sarana & Prasarana</div>
              <p class="so-card-unit">Pengelolaan sarana, prasarana, dan fasilitas sekolah.</p>
            </article>
            <article class="so-card" tabindex="0" data-name="ARIKAWWEKU CKRISNA, S.Pd." data-role="Waka Humastri" data-unit="Humastri" data-filter="humas" data-detail="waka-humas">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/arikawweku.png') }}" alt="Foto ARIKAWWEKU CKRISNA, S.Pd." loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-handshake"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i><i class="far fa-comment" aria-hidden="true"></i><i class="far fa-paper-plane" aria-hidden="true"></i><i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Waka Humastri</h3>
              <div class="so-card-person">ARIKAWWEKU CKRISNA, S.Pd.</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Waka Humastri</div>
              <p class="so-card-unit">Hubungan sekolah dengan masyarakat dan dunia industri.</p>
            </article>
          </div>
        </div>

        {{-- ===== LEVEL 3: BENDAHARA, KETUA KOMPETENSI KEAHLIAN & KOORDINATOR ===== --}}
        <div class="so-level so-anchor" id="level-3" data-level="3">
          <div class="so-level-head">
            <span class="so-level-badge"><i class="fas fa-layer-group"></i> Level 3 &mdash; Unit Pelaksana &amp; Koordinator</span>
            <span class="so-level-rule"></span>
          </div>
          <div class="so-grid cols-5">
            <article class="so-card" tabindex="0" data-name="MEGA NOVINDA SARI, S.Pd." data-role="Bendahara BOS" data-unit="Keuangan" data-filter="keuangan" data-detail="bendahara-bos">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/mega.png') }}" alt="Foto MEGA NOVINDA SARI, S.Pd." loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-money-bill-wave"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i><i class="far fa-comment" aria-hidden="true"></i><i class="far fa-paper-plane" aria-hidden="true"></i><i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Bendahara BOS</h3>
              <div class="so-card-person">MEGA NOVINDA SARI, S.Pd.</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Bendahara BOS</div>
              <p class="so-card-unit">Pengelolaan administrasi dan keuangan BOS sekolah.</p>
            </article>
            <article class="so-card" tabindex="0" data-name="FAJAR DHILAMAYA, S.Pd." data-role="Bendahara BPOPP" data-unit="Keuangan" data-filter="keuangan" data-detail="bendahara-bpopp">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/fajar.png') }}" alt="Foto FAJAR DHILAMAYA, S.Pd." loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-wallet"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i><i class="far fa-comment" aria-hidden="true"></i><i class="far fa-paper-plane" aria-hidden="true"></i><i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Bendahara BPOPP</h3>
              <div class="so-card-person">FAJAR DHILAMAYA, S.Pd.</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Bendahara BPOPP</div>
              <p class="so-card-unit">Pengelolaan administrasi dan keuangan BPOPP.</p>
            </article>
            <article class="so-card" tabindex="0" data-name="DANANG TEGUH SANTOSO, S.Kom" data-role="Ketua Kompetensi Keahlian RPL" data-unit="Kompetensi Keahlian RPL" data-filter="keahlian" data-detail="kk-rpl">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/danang.png') }}" alt="Foto DANANG TEGUH SANTOSO, S.Kom" loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-code"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i><i class="far fa-comment" aria-hidden="true"></i><i class="far fa-paper-plane" aria-hidden="true"></i><i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Ketua Kompetensi Keahlian RPL</h3>
              <div class="so-card-person">DANANG TEGUH SANTOSO, S.Kom</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Ketua Kompetensi Keahlian RPL</div>
              <p class="so-card-unit">Koordinasi pembelajaran dan pengembangan kompetensi RPL.</p>
            </article>
            <article class="so-card" tabindex="0" data-name="DESY ANDINI DILIAWATI, S.T.P." data-role="Ketua Kompetensi Keahlian APHP" data-unit="Kompetensi Keahlian APHP" data-filter="keahlian" data-detail="kk-aphp">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/desy.png') }}" alt="Foto DESY ANDINI DILIAWATI, S.T.P." loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-seedling"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i><i class="far fa-comment" aria-hidden="true"></i><i class="far fa-paper-plane" aria-hidden="true"></i><i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Ketua Kompetensi Keahlian APHP</h3>
              <div class="so-card-person">DESY ANDINI DILIAWATI, S.T.P.</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Ketua Kompetensi Keahlian APHP</div>
              <p class="so-card-unit">Koordinasi pembelajaran dan pengembangan kompetensi APHP.</p>
            </article>
            <article class="so-card" tabindex="0" data-name="NURFALAH SEPTAYOGA S.Kom." data-role="Ketua Kompetensi Keahlian DKV" data-unit="Kompetensi Keahlian DKV" data-filter="keahlian" data-detail="kk-dkv">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/nurfalah.png') }}" alt="Foto NURFALAH SEPTAYOGA S.Kom." loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-palette"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i><i class="far fa-comment" aria-hidden="true"></i><i class="far fa-paper-plane" aria-hidden="true"></i><i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Ketua Kompetensi Keahlian DKV</h3>
              <div class="so-card-person">NURFALAH SEPTAYOGA S.Kom.</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Ketua Kompetensi Keahlian DKV</div>
              <p class="so-card-unit">Koordinasi pembelajaran dan pengembangan kompetensi DKV.</p>
            </article>
            <article class="so-card" tabindex="0" data-name="METIY ARIANA, S.Pd, M.Pd." data-role="Ketua Kompetensi Keahlian LPS" data-unit="Kompetensi Keahlian LPS" data-filter="keahlian" data-detail="kk-lps">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/metiy.png') }}" alt="Foto METIY ARIANA, S.Pd, M.Pd." loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-landmark"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i><i class="far fa-comment" aria-hidden="true"></i><i class="far fa-paper-plane" aria-hidden="true"></i><i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Ketua Kompetensi Keahlian LPS</h3>
              <div class="so-card-person">METIY ARIANA, S.Pd, M.Pd.</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Ketua Kompetensi Keahlian LPS</div>
              <p class="so-card-unit">Koordinasi pembelajaran dan pengembangan kompetensi LPS.</p>
            </article>
            <article class="so-card" tabindex="0" data-name="DHIYAH AMANATI KARTIKA SARI, S.Pd." data-role="Ketua Kompetensi Keahlian Kuliner" data-unit="Kompetensi Keahlian Kuliner" data-filter="keahlian" data-detail="kk-kuliner">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/dhiyah.png') }}" alt="Foto DHIYAH AMANATI KARTIKA SARI, S.Pd." loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-utensils"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i><i class="far fa-comment" aria-hidden="true"></i><i class="far fa-paper-plane" aria-hidden="true"></i><i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Ketua Kompetensi Keahlian Kuliner</h3>
              <div class="so-card-person">DHIYAH AMANATI KARTIKA SARI, S.Pd.</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Ketua Kompetensi Keahlian Kuliner</div>
              <p class="so-card-unit">Koordinasi pembelajaran dan pengembangan kompetensi kuliner.</p>
            </article>
            <article class="so-card" tabindex="0" data-name="MULAT ADITYAWIRANTI, S.Pd." data-role="Koordinator BKK" data-unit="BKK / Humastri" data-filter="humas" data-detail="koordinator-bkk">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/mulat.png') }}" alt="Foto MULAT ADITYAWIRANTI, S.Pd." loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-briefcase"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i><i class="far fa-comment" aria-hidden="true"></i><i class="far fa-paper-plane" aria-hidden="true"></i><i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Koordinator BKK</h3>
              <div class="so-card-person">MULAT ADITYAWIRANTI, S.Pd.</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Koordinator BKK</div>
              <p class="so-card-unit">Koordinasi layanan BKK dan penyaluran lulusan.</p>
            </article>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- VIRTUAL TOUR 360 -->
  <section class="vt-section" id="virtual-tour" aria-label="Virtual Tour 360 SMK Negeri 2 Mojokerto">
    <span class="vt-watermark" aria-hidden="true">360°</span>
    <div class="vt-decor-ring" aria-hidden="true"></div>
    <div class="vt-decor-dots" aria-hidden="true"></div>
    <div class="vt-inner">
      <div class="vt-media" data-reveal="left">
        <div class="vt-frame">
          <img src="{{ asset('images/hero-sekolah.jpg') }}" alt="Lingkungan SMK Negeri 2 Mojokerto — Virtual Tour 360 derajat" loading="lazy">
          <span class="vt-badge"><i class="fa-solid fa-street-view"></i> 360° Tour</span>
          <a class="vt-play" href="{{ $tourUrl }}" aria-label="Mulai Virtual Tour 360 derajat"><i class="fa-solid fa-play"></i></a>
          <div class="vt-caption">
            <div><strong>Jelajahi Sekolah</strong><span>SMK Negeri 2 Mojokerto</span></div>
            <span class="vt-cam"><i class="fa-solid fa-camera"></i> 360°</span>
          </div>
        </div>
        <div class="vt-chip"><i class="fa-solid fa-compass"></i><div><strong>Virtual Tour 360°</strong><span>Interactive Campus Experience</span></div></div>
      </div>
      <div class="vt-copy">
        <div class="vt-kicker" data-reveal>Virtual Experience</div>
        <h2 class="vt-title" data-reveal>Jelajahi <span class="vt-gold">SMKN 2 Mojokerto</span><span class="vt-sub">Lihat Virtual Tour 360°</span></h2>
        <p class="vt-desc" data-reveal>Jelajahi lingkungan SMK Negeri 2 Mojokerto secara interaktif melalui Virtual Tour 360°. Rasakan suasana sekolah dari sudut pandangmu dan lihat fasilitas sekolah secara lebih dekat.</p>
        <div class="vt-feats" data-reveal><span class="vt-feat"><i class="fa-solid fa-check"></i> Interaktif</span><span class="vt-feat"><i class="fa-solid fa-check"></i> Panorama 360°</span><span class="vt-feat"><i class="fa-solid fa-check"></i> Akses Mudah</span></div>
        <a href="{{ $tourUrl }}" id="vtTourLink" class="vt-btn" data-reveal>Mulai Virtual Tour <i class="fa-solid fa-arrow-right"></i></a>
      </div>
    </div>
  </section>

  <!-- PERAN & TUGAS -->
  <div class="so-sec-head so-sec-head-mid" data-reveal>
    <div class="eyebrow">Alur Kerja Sekolah</div>
    <h2 class="big-heading">BAGAIMANA <span>SEKOLAH BEKERJA.</span></h2>
    <p class="so-sec-desc">Setiap bagian memiliki peran yang saling melengkapi — dari perencanaan kebijakan hingga layanan langsung kepada siswa.</p>
  </div>

  <div class="so-roles" data-reveal>
    <div class="so-role-card">
      <span class="so-role-step">01</span>
      <div class="so-role-icon"><i class="fas fa-flag-checkered"></i></div>
      <h4>Pimpinan Menetapkan Arah</h4>
      <p>Kepala Sekolah merumuskan kebijakan, program, dan target mutu sekolah, serta memimpin seluruh sumber daya menuju visi “SMK unggul, berkarakter, dan berdaya saing”.</p>
    </div>
    <div class="so-role-card">
      <span class="so-role-step">02</span>
      <div class="so-role-icon"><i class="fas fa-diagram-project"></i></div>
      <h4>Wakil Kepala Mengelola</h4>
      <p>Empat wakil kepala sekolah menerjemahkan kebijakan menjadi program kerja nyata di bidang kurikulum, kesiswaan, sarana prasarana, serta humas &amp; industri.</p>
    </div>
    <div class="so-role-card">
      <span class="so-role-step">03</span>
      <div class="so-role-icon is-gold"><i class="fas fa-graduation-cap"></i></div>
      <h4>KK &amp; GTK Melayani Siswa</h4>
      <p>Kompetensi keahlian, guru, dan tenaga kependidikan berada di garda terdepan: mengajar, membimbing, dan melayani peserta didik setiap hari.</p>
    </div>
  </div>

  <!-- CTA PENUTUP -->
  <div class="so-cta" data-reveal>
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span><span class="ho-line"></span><span class="ho-dots"></span><span class="ho-ring"></span>
      <span class="ho-gold"></span><span class="ho-square"></span><span class="ho-corner"></span>
    </div>
    <div class="so-cta-inner">
      <h3>Ingin mengenal lebih dekat <span>keluarga besar sekolah?</span></h3>
      <p>Kenali para pendidik dan tenaga kependidikan yang membimbing siswa setiap harinya.</p>
      <a href="{{ route('profil.guru-staf') }}" class="so-cta-btn">Lihat Guru &amp; Staf <i class="fas fa-arrow-right"></i></a>
    </div>
  </div>

  <!-- MODAL DETAIL JABATAN -->
  <div class="so-modal-overlay" id="soModalOverlay" role="dialog" aria-modal="true" aria-labelledby="soModalTitle">
    <div class="so-modal" id="soModal">
      <button class="so-modal-close" id="soModalClose" aria-label="Tutup"><i class="fas fa-xmark"></i></button>
      <div class="so-modal-head">
        <div class="so-modal-avatar" id="soModalAvatar"><i class="fas fa-user-tie"></i></div>
        <div class="so-modal-name" id="soModalTitle">Kepala Sekolah</div>
        <div class="so-modal-role" id="soModalRole"><i class="fas fa-star"></i> Pimpinan Sekolah</div>
      </div>
      <div class="so-modal-body">
        <div class="so-modal-section">
          <div class="so-modal-label"><i class="fas fa-tags"></i> Bidang / Unit</div>
          <div class="so-modal-tags" id="soModalTags"></div>
        </div>
        <div class="so-modal-section">
          <div class="so-modal-label"><i class="fas fa-list-check"></i> Tugas &amp; Tanggung Jawab</div>
          <ul class="so-modal-tasks" id="soModalTasks"></ul>
        </div>
        <div class="so-modal-section">
          <div class="so-modal-label"><i class="fas fa-circle-info"></i> Catatan</div>
          <div class="so-modal-note" id="soModalNote"></div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

{{-- DARK MODE --}}
@push('styles')
<style id="struktur-dark-mode">
/* =========================================================
   STRUKTUR ORGANISASI — DARK MODE (navy gelap, serasi navbar)
   Class "theme-dark" dipasang ke <html> oleh layouts/app.blade.php.
   ========================================================= */
html.theme-dark body .so-page{background:#08131f!important;color:#e6eef7;color-scheme:dark}

/* HERO */
html.theme-dark body .history-hero{background:linear-gradient(180deg,#0a1a2c 0%,#07121f 100%)!important;color:#e6eef7}
html.theme-dark body .history-hero::after{color:rgba(255,255,255,.035)!important;-webkit-text-stroke:1px rgba(255,179,0,.14)!important}
html.theme-dark body .history-ref-ornament-image{filter:invert(1) hue-rotate(180deg);mix-blend-mode:screen;opacity:.5!important}
html.theme-dark body .history-title .sejarah-white{color:#fff!important}
html.theme-dark body .history-kicker{background:rgba(255,111,0,.1);border-color:rgba(255,179,0,.3);color:#ffb347}
html.theme-dark body .history-vt-cta{background:rgba(255,255,255,.06)!important;border-color:rgba(255,255,255,.14)!important;color:#fff!important;box-shadow:0 12px 30px rgba(0,0,0,.4)}
html.theme-dark body .history-vt-cta:hover{background:rgba(255,179,0,.1)!important;border-color:rgba(255,179,0,.45)!important}
html.theme-dark body .history-vt-cta small{color:#9fb2c6}

/* UMUM */
html.theme-dark body .so-page .eyebrow{color:#cfe3f7!important}
html.theme-dark body .so-page .eyebrow::before{background:linear-gradient(90deg,#ffd54a,#ff9800)!important}
html.theme-dark body .so-page .big-heading{color:#fff!important;text-shadow:none}
html.theme-dark body .so-sec-desc{color:#a9bbcd!important}

/* SECTION BAGAN */
html.theme-dark body .so-chart-section{background:linear-gradient(180deg,#0b1b2d 0%,#08131f 100%)!important}
html.theme-dark body .so-feed-orn .orn-ring{stroke:rgba(143,189,235,.22)}
html.theme-dark body .so-feed-orn .orn-line{stroke:rgba(143,189,235,.3)}
html.theme-dark body .so-feed-orn .orn-dash{stroke:rgba(143,189,235,.3)}
html.theme-dark body .so-feed-orn .orn-dot-navy{fill:#8fbdeb}
html.theme-dark body .so-feed-orn .orn-node{fill:#0b1b2d}
html.theme-dark body .so-feed-orn .orn-node-navy{fill:#0b1b2d;stroke:#8fbdeb}
html.theme-dark body .so-feed-orn .orn-solid-navy{fill:#2a6197}
html.theme-dark body .so-feed-orn .orn-diamond-navy{stroke:rgba(143,189,235,.3)}
html.theme-dark body .so-feed-orn .orn-grid-dot{fill:#8fbdeb}
html.theme-dark body .home-orn .ho-chevron{border-top-color:rgba(143,189,235,.14);border-right-color:rgba(143,189,235,.14)}
html.theme-dark body .home-orn .ho-ring{border-color:rgba(143,189,235,.16);box-shadow:0 0 0 20px rgba(143,189,235,.03),0 0 0 42px rgba(255,213,74,.025)}
html.theme-dark body .home-orn .ho-corner{border-left-color:rgba(143,189,235,.16);border-bottom-color:rgba(143,189,235,.16)}
html.theme-dark body .home-orn .ho-square::before{border-color:rgba(143,189,235,.22)}

/* TOOLBAR */
html.theme-dark body .so-toolbar{background:rgba(255,255,255,.05)!important;background-color:rgba(8,19,31,.85)!important;border:1px solid rgba(255,255,255,.12)!important;box-shadow:0 18px 44px rgba(0,0,0,.4)!important;backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px)}
html.theme-dark body .so-toolbar .so-search{background:rgba(255,255,255,.07)!important;background-color:rgba(255,255,255,.07)!important;border:1px solid rgba(255,255,255,.16)!important;box-shadow:none!important}
html.theme-dark body .so-toolbar .so-search:focus-within{border-color:rgba(255,213,74,.55)!important;box-shadow:0 0 0 4px rgba(255,213,74,.12)!important}
html.theme-dark body .so-toolbar .so-search input,
html.theme-dark body .so-toolbar .so-search input#soSearchInput{background:transparent!important;background-color:transparent!important;color:#e6eef7!important;border:none!important;box-shadow:none!important;outline:none!important}
html.theme-dark body .so-toolbar .so-search input::placeholder,
html.theme-dark body .so-toolbar .so-search input#soSearchInput::placeholder{color:#7f93a8!important}
html.theme-dark body .so-toolbar .so-search i{color:#ffd54a!important}
html.theme-dark body .so-filter-label{color:#8fa3b8!important}
html.theme-dark body .so-toolbar .so-fchip{background:rgba(255,255,255,.07)!important;background-color:rgba(255,255,255,.07)!important;border:1px solid rgba(255,255,255,.14)!important;color:#cfe3f7!important;box-shadow:none!important}
html.theme-dark body .so-toolbar .so-fchip:hover{background:rgba(255,255,255,.13)!important;border-color:rgba(255,213,74,.45)!important;color:#fff!important}
html.theme-dark body .so-toolbar .so-fchip.is-active{background:linear-gradient(135deg,#ffd54a,#ff8a00)!important;border-color:transparent!important;color:#0d3a66!important;box-shadow:0 8px 20px rgba(255,138,0,.3)!important}
html.theme-dark body .so-empty{background:rgba(255,255,255,.05)!important;border-color:rgba(255,255,255,.14)!important;color:#a9bbcd}
html.theme-dark body .so-empty strong{color:#fff!important}

/* LEVEL */
html.theme-dark body .so-level-badge{background:rgba(255,255,255,.07)!important;border:1px solid rgba(255,255,255,.14)!important;color:#e6eef7!important;box-shadow:none!important}
html.theme-dark body .so-level-badge i{color:#ffd54a}
html.theme-dark body .so-level-rule{background:linear-gradient(90deg,rgba(143,189,235,.3),transparent)}

/* KARTU FEED */
html.theme-dark body .so-card{background:#0f2236!important;background-color:#0f2236!important;border-color:rgba(255,255,255,.1)!important;box-shadow:0 18px 44px rgba(0,0,0,.4)!important}
html.theme-dark body .so-card:hover,
html.theme-dark body .so-card:focus-visible{border-color:rgba(255,179,0,.45)!important;box-shadow:0 30px 62px rgba(0,0,0,.55)!important}
html.theme-dark body .so-feed-head{background:transparent;border-bottom-color:rgba(255,255,255,.08)}
html.theme-dark body .so-feed-head>img{background:rgba(255,255,255,.95);border-radius:50%;padding:3px}
html.theme-dark body .so-feed-account strong{color:#fff!important}
html.theme-dark body .so-feed-account span{color:#8fa3b8}
html.theme-dark body .so-feed-more{color:#8fa3b8}
html.theme-dark body .so-photo-wrap{background:linear-gradient(160deg,#1a3752 0%,#12283f 58%,#0e2036 100%)}
html.theme-dark body .so-photo{background:linear-gradient(160deg,#1a3752 0%,#12283f 58%,#0e2036 100%);border-color:rgba(255,255,255,.14)}
html.theme-dark body .so-photo-ring{border-color:rgba(143,189,235,.25)}
html.theme-dark body .so-feed-actions{color:#dbe7f3}
html.theme-dark body .so-card-name{color:#fff!important}
html.theme-dark body .so-card-person{color:#ffd54a!important}
html.theme-dark body .so-card-role{background:rgba(255,179,0,.1);border-color:rgba(255,179,0,.3);color:#ffc233}
html.theme-dark body .so-card-unit{color:#a9bbcd!important}

/* VIRTUAL TOUR */
html.theme-dark body .vt-section{background:linear-gradient(180deg,#0a1928 0%,#08131f 50%,#0a1726 100%)!important}
html.theme-dark body .vt-section::before{background-image:radial-gradient(circle,rgba(143,189,235,.2) 1.5px,transparent 2px);opacity:.35}
html.theme-dark body .vt-watermark{color:rgba(255,255,255,.04)}
html.theme-dark body .vt-decor-ring{border-color:rgba(143,189,235,.16)}
html.theme-dark body .vt-frame{box-shadow:0 30px 75px rgba(0,0,0,.55);border-color:rgba(255,255,255,.12)}
html.theme-dark body .vt-chip{background:#0f2236!important;border-color:rgba(255,255,255,.1)!important;box-shadow:0 12px 30px rgba(0,0,0,.4)}
html.theme-dark body .vt-chip strong{color:#fff!important}
html.theme-dark body .vt-chip span{color:#8fa3b8}
html.theme-dark body .vt-kicker{color:#dbe7f3}
html.theme-dark body .vt-title{color:#fff!important}
html.theme-dark body .vt-sub{color:#9fc4e6}
html.theme-dark body .vt-desc{color:#a9bbcd!important}
html.theme-dark body .vt-feat{background:rgba(255,255,255,.06)!important;border-color:rgba(255,255,255,.12)!important;color:#cfe3f7!important}
html.theme-dark body .vt-btn{background:linear-gradient(135deg,#ffd54a,#ff8a00);color:#0d3a66;box-shadow:0 14px 32px rgba(0,0,0,.4)}

/* PERAN & TUGAS */
html.theme-dark body .so-role-card{background:#0f2236!important;border-color:rgba(255,255,255,.1)!important;box-shadow:0 18px 42px rgba(0,0,0,.4)!important}
html.theme-dark body .so-role-card:hover{border-color:rgba(255,179,0,.45)!important;box-shadow:0 30px 62px rgba(0,0,0,.55)!important}
html.theme-dark body .so-role-step{color:rgba(255,255,255,.07)!important}
html.theme-dark body .so-role-icon:not(.is-gold){background:linear-gradient(135deg,#12304f,#1b4a78);color:#ffd54a;box-shadow:0 10px 24px rgba(0,0,0,.45)}
html.theme-dark body .so-role-card h4{color:#fff!important}
html.theme-dark body .so-role-card p{color:#a9bbcd!important}

/* CTA PENUTUP — kartu navy gelap utuh (sebelumnya kotak biru terang bersudut tajam) */
html.theme-dark body .so-cta{background:linear-gradient(135deg,#0a1a2c 0%,#0c2038 48%,#0e2640 100%)!important;border:1px solid rgba(255,255,255,.09);box-shadow:0 24px 55px rgba(0,0,0,.55)}
html.theme-dark body .so-cta::after{color:rgba(255,255,255,.04);-webkit-text-stroke:1px rgba(255,255,255,.055)}
html.theme-dark body .so-cta-inner{background:transparent!important;border:0!important;box-shadow:none!important}
html.theme-dark body .so-cta p{color:rgba(214,228,242,.82)}

/* MODAL */
html.theme-dark body .so-modal-overlay{background:rgba(2,8,16,.78)}
html.theme-dark body .so-modal{background:#0f2236;border:1px solid rgba(255,255,255,.12);box-shadow:0 40px 90px rgba(0,0,0,.6);color:#e6eef7}
html.theme-dark body .so-modal-head{background:linear-gradient(135deg,#0a1a2c,#0c2038 60%,#173e66)}
html.theme-dark body .so-modal-close{background:rgba(255,255,255,.1);color:#fff}
html.theme-dark body .so-modal-close:hover{background:#ffb300;color:#0d3a66}
html.theme-dark body .so-modal-body{background:#0f2236}
html.theme-dark body .so-modal-label{color:#cfe3f7}
html.theme-dark body .so-modal-label i{color:#ffd54a}
html.theme-dark body .so-tag{background:rgba(143,189,235,.1);border-color:rgba(143,189,235,.25);color:#cfe3f7}
html.theme-dark body .so-tag.is-gold{background:rgba(255,179,0,.12);border-color:rgba(255,179,0,.35);color:#ffcf5a}
html.theme-dark body .so-modal-tasks li{color:#a9bbcd;border-color:rgba(255,255,255,.08)}
html.theme-dark body .so-modal-tasks li i{color:#ffd54a}
html.theme-dark body .so-modal-note{background:rgba(255,255,255,.05);border-color:rgba(255,179,0,.3);color:#a9bbcd}
html.theme-dark body .so-modal-note i{color:#ffd54a}
html.theme-dark body .so-modal-avatar.has-photo{border-color:rgba(255,255,255,.2);background:#17324d}
</style>
@endpush

@push('scripts')
<script>
(function(){
  'use strict';

  /* ================= DATA JABATAN =================
     Kalau paket admin menyediakan window.SO_DATA, itu yang dipakai. */
  var NOTE = 'Data disesuaikan dengan struktur organisasi resmi yang diberikan.';
  var FALLBACK_DATA = {
    'kepsek': {name:'Kepala Sekolah',role:'Pimpinan Sekolah',unit:'Pimpinan Sekolah',avatar:'fas fa-user-tie',gold:false,tags:['Pimpinan Sekolah'],
      tasks:['Memimpin dan mengarahkan penyelenggaraan pendidikan sekolah.','Menetapkan kebijakan, program kerja, dan target mutu sekolah.'],note:NOTE},
    'waka-kurikulum': {name:'MELATI PUSPITA SARI, S.Pd.',role:'Waka Kurikulum',unit:'Kurikulum',avatar:'fas fa-book-open',gold:false,tags:['Kurikulum'],
      tasks:['Mengelola dan mengoordinasikan pelaksanaan kurikulum sekolah.','Mengatur program pembelajaran dan administrasi kurikulum.'],note:NOTE},
    'waka-kesiswaan': {name:'AINUR ROFIK, M. Pd, Si.',role:'Waka Kesiswaan',unit:'Kesiswaan',avatar:'fas fa-users',gold:false,tags:['Kesiswaan'],
      tasks:['Mengoordinasikan pembinaan peserta didik dan kegiatan kesiswaan.','Mendukung pelaksanaan program pengembangan karakter siswa.'],note:NOTE},
    'waka-sapras': {name:'M. WIRA HENDY HIMAWAN, M.Pd',role:'Waka Sarana & Prasarana',unit:'Sarana & Prasarana',avatar:'fas fa-building',gold:false,tags:['Sarana & Prasarana'],
      tasks:['Mengoordinasikan pengelolaan sarana dan prasarana sekolah.','Memastikan fasilitas pendukung pembelajaran tersedia dan terawat.'],note:NOTE},
    'waka-humas': {name:'ARIKAWWEKU CKRISNA, S.Pd.',role:'Waka Humastri',unit:'Humastri',avatar:'fas fa-handshake',gold:false,tags:['Humastri'],
      tasks:['Mengoordinasikan hubungan sekolah dengan masyarakat dan dunia industri.','Mengembangkan kerja sama dan kemitraan sekolah.'],note:NOTE},
    'bendahara-bos': {name:'MEGA NOVINDA SARI, S.Pd.',role:'Bendahara BOS',unit:'Keuangan',avatar:'fas fa-money-bill-wave',gold:false,tags:['Keuangan'],
      tasks:['Mengelola administrasi dan pertanggungjawaban dana BOS.','Menyiapkan pencatatan serta laporan keuangan sesuai ketentuan.'],note:NOTE},
    'bendahara-bpopp': {name:'FAJAR DHILAMAYA, S.Pd.',role:'Bendahara BPOPP',unit:'Keuangan',avatar:'fas fa-wallet',gold:false,tags:['Keuangan'],
      tasks:['Mengelola administrasi dan pertanggungjawaban dana BPOPP.','Menyiapkan pencatatan serta laporan keuangan sesuai ketentuan.'],note:NOTE},
    'kk-rpl': {name:'DANANG TEGUH SANTOSO, S.Kom',role:'Ketua Kompetensi Keahlian RPL',unit:'Kompetensi Keahlian RPL',avatar:'fas fa-code',gold:false,tags:['Kompetensi Keahlian RPL'],
      tasks:['Mengoordinasikan pelaksanaan pembelajaran kompetensi keahlian RPL.','Mengembangkan kompetensi siswa sesuai kebutuhan bidang perangkat lunak.'],note:NOTE},
    'kk-aphp': {name:'DESY ANDINI DILIAWATI, S.T.P.',role:'Ketua Kompetensi Keahlian APHP',unit:'Kompetensi Keahlian APHP',avatar:'fas fa-seedling',gold:false,tags:['Kompetensi Keahlian APHP'],
      tasks:['Mengoordinasikan pelaksanaan pembelajaran kompetensi keahlian APHP.','Mengembangkan kompetensi siswa dalam pengolahan hasil pertanian.'],note:NOTE},
    'kk-dkv': {name:'NURFALAH SEPTAYOGA S.Kom.',role:'Ketua Kompetensi Keahlian DKV',unit:'Kompetensi Keahlian DKV',avatar:'fas fa-palette',gold:false,tags:['Kompetensi Keahlian DKV'],
      tasks:['Mengoordinasikan pelaksanaan pembelajaran kompetensi keahlian DKV.','Mengembangkan kompetensi siswa dalam bidang desain komunikasi visual.'],note:NOTE},
    'kk-lps': {name:'METIY ARIANA, S.Pd, M.Pd.',role:'Ketua Kompetensi Keahlian LPS',unit:'Kompetensi Keahlian LPS',avatar:'fas fa-landmark',gold:false,tags:['Kompetensi Keahlian LPS'],
      tasks:['Mengoordinasikan pelaksanaan pembelajaran kompetensi keahlian LPS.','Mengembangkan kompetensi siswa dalam layanan perbankan syariah.'],note:NOTE},
    'kk-kuliner': {name:'DHIYAH AMANATI KARTIKA SARI, S.Pd.',role:'Ketua Kompetensi Keahlian Kuliner',unit:'Kompetensi Keahlian Kuliner',avatar:'fas fa-utensils',gold:false,tags:['Kompetensi Keahlian Kuliner'],
      tasks:['Mengoordinasikan pelaksanaan pembelajaran kompetensi keahlian Kuliner.','Mengembangkan kompetensi siswa dalam bidang kuliner dan tata boga.'],note:NOTE},
    'koordinator-bkk': {name:'MULAT ADITYAWIRANTI, S.Pd.',role:'Koordinator BKK',unit:'BKK / Humastri',avatar:'fas fa-briefcase',gold:false,tags:['BKK / Humastri'],
      tasks:['Mengoordinasikan layanan Bursa Kerja Khusus (BKK).','Mendukung penyaluran lulusan dan hubungan dengan dunia kerja.'],note:NOTE}
  };
  var DATA = window.SO_DATA || FALLBACK_DATA;

  /* ================= ELEMEN ================= */
  var cards = Array.prototype.slice.call(document.querySelectorAll('.so-card'));
  var overlay = document.getElementById('soModalOverlay');
  var searchInput = document.getElementById('soSearchInput');
  var chips = Array.prototype.slice.call(document.querySelectorAll('.so-fchip'));
  var emptyBox = document.getElementById('soEmpty');

  /* ================= MODAL ================= */
  function toggleSection(el, show){
    var sec = el && el.closest ? el.closest('.so-modal-section') : null;
    if(sec) sec.style.display = show ? '' : 'none';
  }

  function openModal(key, card){
    var d = DATA[key];
    if(!d) return;
    var icon = d.avatar || 'fas fa-user-tie';

    var photo = d.photo || d.image || d.img || '';
    if(!photo && card){
      var cardImg = card.querySelector('.so-photo img');
      if(cardImg) photo = cardImg.getAttribute('src') || '';
    }

    document.getElementById('soModalTitle').textContent = d.name || '';
    var roleEl = document.getElementById('soModalRole');
    roleEl.innerHTML = '<i class="' + icon + '"></i> ';
    roleEl.appendChild(document.createTextNode(d.role || ''));

    var avatar = document.getElementById('soModalAvatar');
    avatar.innerHTML = '';
    if(photo){
      var img = document.createElement('img');
      img.src = photo;
      img.alt = 'Foto ' + (d.name || '');
      img.onerror = function(){
        avatar.classList.remove('has-photo');
        avatar.innerHTML = '<i class="' + icon + '"></i>';
      };
      avatar.appendChild(img);
      avatar.classList.add('has-photo');
    } else {
      avatar.classList.remove('has-photo');
      avatar.innerHTML = '<i class="' + icon + '"></i>';
    }
    avatar.classList.toggle('is-gold', !!d.gold);

    var tags = document.getElementById('soModalTags');
    tags.innerHTML = '';
    var tagList = Array.isArray(d.tags) ? d.tags.filter(Boolean) : [];
    tagList.forEach(function(t){
      var span = document.createElement('span');
      span.className = 'so-tag' + (d.gold ? ' is-gold' : '');
      span.textContent = t;
      tags.appendChild(span);
    });
    toggleSection(tags, tagList.length > 0);

    var tasks = document.getElementById('soModalTasks');
    tasks.innerHTML = '';
    var taskList = Array.isArray(d.tasks) ? d.tasks.filter(Boolean) : [];
    taskList.forEach(function(t){
      var li = document.createElement('li');
      li.innerHTML = '<i class="fas fa-check"></i><span></span>';
      li.querySelector('span').textContent = t;
      tasks.appendChild(li);
    });
    toggleSection(tasks, taskList.length > 0);

    var noteEl = document.getElementById('soModalNote');
    if(d.note){
      noteEl.innerHTML = '<i class="fas fa-circle-info"></i><span></span>';
      noteEl.querySelector('span').textContent = d.note;
    } else {
      noteEl.innerHTML = '';
    }
    toggleSection(noteEl, !!d.note);

    overlay.classList.add('open');
    document.body.style.overflow = 'hidden';
    document.querySelector('.so-modal-close').focus();
  }
  function closeModal(){
    overlay.classList.remove('open');
    document.body.style.overflow = '';
  }
  cards.forEach(function(card){
    card.addEventListener('click', function(){ openModal(card.getAttribute('data-detail'), card); });
    card.addEventListener('keydown', function(e){
      if(e.key === 'Enter' || e.key === ' '){ e.preventDefault(); openModal(card.getAttribute('data-detail'), card); }
    });
  });
  document.getElementById('soModalClose').addEventListener('click', closeModal);
  overlay.addEventListener('click', function(e){ if(e.target === overlay) closeModal(); });
  document.addEventListener('keydown', function(e){ if(e.key === 'Escape') closeModal(); });

  /* ================= SEARCH + FILTER ================= */
  function applyFilter(){
    var q = (searchInput.value || '').toLowerCase().trim();
    var activeFilter = '*';
    chips.forEach(function(c){ if(c.classList.contains('is-active')) activeFilter = c.getAttribute('data-filter'); });
    var visibleCount = 0;
    cards.forEach(function(card){
      var text = (card.getAttribute('data-name') + ' ' + card.getAttribute('data-role') + ' ' + card.getAttribute('data-unit')).toLowerCase();
      var matchFilter = (activeFilter === '*') || (card.getAttribute('data-filter') === activeFilter);
      var matchQuery = !q || text.indexOf(q) !== -1;
      if(matchFilter && matchQuery){
        card.classList.remove('is-hidden');
        card.classList.toggle('is-match', !!q);
        visibleCount++;
      } else {
        card.classList.add('is-hidden');
      }
    });
    emptyBox.classList.toggle('show', visibleCount === 0);
  }
  searchInput.addEventListener('input', applyFilter);
  chips.forEach(function(chip){
    chip.addEventListener('click', function(){
      chips.forEach(function(c){ c.classList.remove('is-active'); });
      chip.classList.add('is-active');
      applyFilter();
    });
  });
})();

/* ---- Scroll Reveal ---- */
(function () {
  var revealEls = document.querySelectorAll('[data-reveal]');
  if (!('IntersectionObserver' in window)) {
    revealEls.forEach(function (el) { el.classList.add('revealed'); });
    return;
  }
  var obs = new IntersectionObserver(function (entries) {
    entries.forEach(function (e) {
      if (e.isIntersecting) { e.target.classList.add('revealed'); obs.unobserve(e.target); }
    });
  }, { threshold: 0.12, rootMargin: '0px 0px -60px 0px' });
  revealEls.forEach(function (el) { obs.observe(el); });

  var pending = Array.prototype.slice.call(revealEls);
  var checks = 0;
  var iv = setInterval(function () {
    checks++;
    var vh = window.innerHeight;
    pending = pending.filter(function (el) {
      if (el.classList.contains('revealed')) return false;
      var r = el.getBoundingClientRect();
      if (r.top < vh + 220 && r.bottom > -40) { el.classList.add('revealed'); return false; }
      return true;
    });
    if (checks >= 8) {
      pending.forEach(function (el) { el.classList.add('revealed'); });
      clearInterval(iv);
    } else if (pending.length === 0) {
      clearInterval(iv);
    }
  }, 450);
})();
</script>

<style id="SO-RESPONSIVE-LARGE-DESKTOP-V26">
/* =========================================================
   STRUKTUR ORGANISASI — DESKTOP LARGE WEB & MOBILE RESPONSIVE
   Semua Level (Pimpinan, Level 2, Level 3): Ukuran Kartu,
   Foto (310px), dan Teks Dibuat Sama Sesuai Acuan Level Pimpinan.
   ========================================================= */

@media (min-width: 951px) {
  /* Container utama diperluas agar section judul & kartu lebih lebar & gagah */
  .so-wrap {
    width: min(1600px, 95%) !important;
  }
  
  /* Layout Grid 3-Kolom Besar & Lebar */
  .so-level:not(.so-level-root) .so-grid {
    grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
    gap: 2.4rem !important;
  }
  #level-3 .so-grid.cols-5 {
    grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
    gap: 2.4rem !important;
  }
  .so-grid.cols-4 {
    grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
    gap: 2.4rem !important;
  }

  /* Ukuran Kartu Organisasi Desktop SEMUA LEVEL (Sama dengan Level Pimpinan) */
  .so-card {
    border-radius: 28px !important;
    box-shadow: 0 24px 60px rgba(13, 58, 102, 0.16) !important;
  }
  .so-feed-head {
    min-height: 72px !important;
    padding: 1rem 1.35rem !important;
    gap: .85rem !important;
  }
  .so-feed-head img {
    width: 46px !important;
    height: 46px !important;
    flex: 0 0 46px !important;
  }
  .so-feed-account strong {
    font-size: .96rem !important;
    letter-spacing: .03em !important;
  }
  .so-feed-account span {
    font-size: .7rem !important;
    margin-top: .15rem !important;
  }

  /* Foto guru/pejabat SEMUA LEVEL (Disamakan 310px dengan Level Pimpinan) */
  .so-photo-wrap {
    height: 310px !important;
    aspect-ratio: auto !important;
  }
  .so-photo img {
    object-fit: cover !important;
    object-position: center top !important;
  }

  .so-card-name {
    font-size: 1.45rem !important;
    font-weight: 900 !important;
    margin: .75rem 1.35rem .4rem !important;
    line-height: 1.3 !important;
  }
  .so-card-person {
    font-size: 1.18rem !important;
    font-weight: 800 !important;
    color: #2f6fa8 !important;
    margin: 0 1.35rem .75rem !important;
  }
  .so-card-role {
    font-size: .84rem !important;
    padding: .38rem .92rem !important;
    margin: .2rem 1.35rem .75rem !important;
    border-radius: 999px !important;
  }
  .so-card-unit {
    font-size: .95rem !important;
    line-height: 1.6 !important;
    margin: 0 1.35rem !important;
    color: #5f7186 !important;
  }
  .so-feed-actions {
    padding: .85rem 1.35rem .45rem !important;
    font-size: 1.25rem !important;
  }

  /* Kartu Pimpinan (Kepala Sekolah) Desktop */
  .so-level-root .so-grid {
    display: flex !important;
    justify-content: center !important;
    max-width: 520px !important;
    margin: 0 auto 3rem !important;
  }
  .so-level-root .so-card {
    width: 100% !important;
    max-width: 520px !important;
    border: 1.5px solid rgba(255, 179, 0, 0.4) !important;
  }
}

/* Mobile & Tablet Adjustments (<= 950px) */
@media (max-width: 950px) {
  .so-level:not(.so-level-root) .so-grid {
    grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
    gap: 1rem !important;
  }
  .so-photo-wrap {
    height: 210px !important;
  }
  .so-card-name {
    font-size: 1.05rem !important;
    margin: .35rem .85rem .25rem !important;
  }
  .so-card-person {
    font-size: .88rem !important;
    margin: 0 .85rem .45rem !important;
  }
  .so-card-role {
    font-size: .68rem !important;
    padding: .25rem .6rem !important;
    margin: .18rem .85rem .5rem !important;
  }
  .so-card-unit {
    font-size: .78rem !important;
    line-height: 1.5 !important;
    margin: 0 .85rem !important;
  }
  .so-level-root .so-grid {
    max-width: 360px !important;
  }
  .so-level-root .so-photo-wrap {
    height: 220px !important;
  }
}

@media (max-width: 520px) {
  .so-level:not(.so-level-root) .so-grid {
    grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
    gap: .75rem !important;
  }
  .so-photo-wrap {
    height: 185px !important;
  }
  .so-level-root .so-grid {
    max-width: 320px !important;
  }
  .so-level-root .so-photo-wrap {
    height: 200px !important;
  }
}
</style>
@endpush