@extends('layouts.app')

@section('title', 'Alumni Career & Portfolio Hub — SMK Negeri 2 Mojokerto')
@section('description', 'Jelajahi persebaran alumni Skaneda lewat peta interaktif, ikuti perjalanan kariernya, dan lihat showcase portofolio terbaik siswa: proyek coding, desain, penelitian, dan karya lainnya.')

@push('styles')
<style>
/* =========================================================
   ALUMNI CAREER & PORTFOLIO HUB
   Langsung ke inti fungsi (tanpa hero besar): eksplorasi peta
   sebaran alumni -> pilih lokasi/alumni -> lihat perjalanan
   karier -> eksplorasi portofolio -> inspirasi/CTA.
   Frontend-only, data alumni & portofolio adalah contoh (dummy)
   yang disimpan di array JS — tinggal diganti fetch ke API/DB
   saat backend disambungkan.
   Warna & tipografi mengikuti identitas situs: navy #0d3a66,
   gold #ffd54a/#ffb300, orange #ff7a00, font-display, --ease.
   Aksen per jurusan: RPL biru, DKV oranye, TKJ hijau tua,
   Kuliner amber, APHP hijau, LPS ungu — konsisten dgn halaman
   jurusan masing-masing.
   ========================================================= */
.ac-page{background:#f4f8fc;color:#0d3a66;min-height:60vh;position:relative;overflow:hidden}
.ac-page *{box-sizing:border-box}
.ac-wrap{width:min(1440px,94%);margin:0 auto;padding:44px 0 100px;position:relative;z-index:2}

/* ---------- decorative background ---------- */
.ac-blob{position:absolute;border-radius:50%;filter:blur(60px);z-index:0;pointer-events:none}
.ac-blob-a{width:520px;height:520px;top:-220px;right:-140px;
  background:radial-gradient(circle,rgba(255,213,74,.28),rgba(255,213,74,0) 70%)}
.ac-blob-b{width:460px;height:460px;top:280px;left:-220px;
  background:radial-gradient(circle,rgba(13,58,102,.10),rgba(13,58,102,0) 70%)}
.ac-blob-c{width:380px;height:380px;bottom:-160px;right:12%;
  background:radial-gradient(circle,rgba(255,122,0,.14),rgba(255,122,0,0) 70%)}
.ac-dotfield{position:absolute;inset:0;z-index:1;pointer-events:none;opacity:.5;
  background-image:radial-gradient(rgba(13,58,102,.06) 1.3px,transparent 1.4px);background-size:20px 20px;
  -webkit-mask-image:linear-gradient(180deg,#000 0,#000 340px,transparent 480px);
  mask-image:linear-gradient(180deg,#000 0,#000 340px,transparent 480px)}

@keyframes acFadeIn{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:none}}
@keyframes acPulse{0%,100%{box-shadow:0 0 0 0 rgba(255,179,0,.35)}50%{box-shadow:0 0 0 8px rgba(255,179,0,0)}}

/* ---------- top banner (compact) ---------- */
.ac-top{position:relative;display:flex;align-items:center;justify-content:space-between;gap:1.5rem;flex-wrap:wrap;
  margin-bottom:2.4rem;padding:1.6rem clamp(1.2rem,3vw,2.2rem);border-radius:24px;overflow:hidden;
  background:linear-gradient(120deg,#0d3a66 0%,#123f6e 55%,#0d3a66 100%);color:#fff;
  box-shadow:0 24px 54px rgba(13,58,102,.22)}
.ac-top::before{content:"";position:absolute;inset:0;
  background-image:radial-gradient(rgba(255,255,255,.09) 1.3px,transparent 1.4px);background-size:18px 18px;opacity:.5}
.ac-top::after{content:"";position:absolute;top:-60px;right:-40px;width:220px;height:220px;border-radius:50%;
  background:radial-gradient(circle,rgba(255,213,74,.35),rgba(255,213,74,0) 70%)}
.ac-top>*{position:relative;z-index:2}
.ac-eyebrow{display:inline-flex;align-items:center;gap:.55rem;font-size:.7rem;font-weight:900;
  letter-spacing:.16em;text-transform:uppercase;color:#ffd54a;margin-bottom:.6rem}
.ac-eyebrow i{font-size:.68rem}
.ac-top h1{font-family:var(--font-display);font-weight:900;font-size:clamp(1.6rem,3.2vw,2.3rem);
  margin:0;color:#fff;letter-spacing:-.01em}
.ac-top p{margin:.5rem 0 0;font-size:.86rem;color:rgba(235,245,253,.8);max-width:540px;line-height:1.7}
.ac-stat{display:inline-flex;align-items:center;gap:.7rem;font-size:.72rem;font-weight:800;color:#0d3a66;
  background:#fff;border-radius:18px;padding:.7rem 1rem;white-space:nowrap;
  box-shadow:0 12px 26px rgba(4,14,28,.25)}
.ac-stat b{display:block;font-family:var(--font-display);font-size:1.15rem;line-height:1}
.ac-stat span{display:block;font-size:.6rem;font-weight:700;color:#8aa0b5;text-transform:uppercase;letter-spacing:.05em;margin-top:.15rem}
.ac-stat i{color:#ffb300;font-size:1rem}

/* ---------- layout dua kolom ---------- */
.ac-layout{display:grid;grid-template-columns:minmax(0,1fr) 340px;gap:1.8rem;align-items:start}
.ac-main{min-width:0}
.ac-side{position:sticky;top:24px;display:flex;flex-direction:column;gap:1.1rem}
.ac-side-card{background:#fff;border:1px solid #eef2f6;border-radius:20px;padding:1.4rem 1.3rem;
  box-shadow:0 14px 34px rgba(13,58,102,.06)}
.ac-side-card h3{display:flex;align-items:center;gap:.55rem;font-family:var(--font-display);font-size:.92rem;
  font-weight:800;color:#0d3a66;margin:0 0 1rem}
.ac-side-card h3 i{width:28px;height:28px;border-radius:9px;display:flex;align-items:center;justify-content:center;
  background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0d3a66;font-size:.7rem;flex:0 0 28px}
.ac-steps-list{list-style:none;margin:0;padding:0;display:grid;gap:0}
.ac-steps-list li{position:relative;display:flex;gap:.85rem;padding-bottom:1.1rem;padding-left:2px;cursor:default}
.ac-steps-list li:last-child{padding-bottom:0}
.ac-steps-list li::before{content:"";position:absolute;left:13px;top:28px;bottom:0;width:2px;background:#eef2f6}
.ac-steps-list li:last-child::before{display:none}
.ac-steps-num{flex:0 0 28px;width:28px;height:28px;border-radius:50%;background:#eef3f8;color:#5a7086;
  display:flex;align-items:center;justify-content:center;font-size:.72rem;font-weight:900;position:relative;z-index:2;
  transition:background .25s var(--ease,ease),color .25s var(--ease,ease)}
.ac-steps-list li.is-active .ac-steps-num{background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0d3a66}
.ac-steps-list li.is-done .ac-steps-num{background:#0d3a66;color:#ffd54a}
.ac-steps-text strong{display:block;font-size:.78rem;font-weight:800;color:#0d3a66;margin-bottom:.15rem}
.ac-steps-text span{display:block;font-size:.72rem;color:#718396;line-height:1.55}

.ac-quickstats{display:grid;grid-template-columns:1fr 1fr;gap:.7rem}
.ac-qs-item{background:#f7fafd;border:1px solid #eef2f6;border-radius:14px;padding:.85rem .7rem;text-align:center}
.ac-qs-item b{display:block;font-family:var(--font-display);font-size:1.15rem;color:#0d3a66;line-height:1}
.ac-qs-item span{display:block;font-size:.62rem;color:#8aa0b5;font-weight:700;text-transform:uppercase;letter-spacing:.03em;margin-top:.3rem}

.ac-side-note{background:linear-gradient(135deg,#0d3a66,#123f6e);color:#fff;border-radius:20px;padding:1.4rem 1.3rem;
  box-shadow:0 18px 40px rgba(13,58,102,.24)}
.ac-side-note h3{color:#fff}
.ac-side-note h3 i{background:rgba(255,255,255,.15);color:#ffd54a}
.ac-side-note p{font-size:.78rem;color:rgba(235,245,253,.82);line-height:1.65;margin:0}

/* ---------- tab switcher ---------- */
.ac-tabs{display:flex;gap:.5rem;background:#eef3f8;border-radius:14px;padding:.35rem;margin-bottom:1.8rem}
.ac-tab{flex:1;border:none;background:transparent;padding:.75rem 1rem;border-radius:10px;font-size:.82rem;
  font-weight:800;color:#5a7086;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;gap:.5rem;
  transition:background .25s var(--ease,ease),color .25s var(--ease,ease),box-shadow .25s var(--ease,ease)}
.ac-tab i{font-size:.82rem}
.ac-tab.active{background:#0d3a66;color:#fff;box-shadow:0 10px 24px rgba(13,58,102,.25)}
.ac-panel{display:none}
.ac-panel.active{display:block;animation:acFadeIn .4s var(--ease,ease) both}

/* ---------- card shell ---------- */
.ac-card{background:#fff;border:1px solid #eef2f6;border-radius:22px;padding:clamp(1.4rem,3vw,2.2rem);
  box-shadow:0 18px 46px rgba(13,58,102,.07)}
.ac-card + .ac-card{margin-top:1.4rem}
.ac-card-head{display:flex;align-items:flex-start;justify-content:space-between;gap:1rem;flex-wrap:wrap;margin-bottom:1.4rem}
.ac-card-head h2{font-family:var(--font-display);font-size:1.15rem;font-weight:800;margin:0 0 .3rem;color:#0d3a66}
.ac-card-head p{font-size:.8rem;color:#718396;margin:0;line-height:1.6;max-width:420px}

/* ---------- filter chips (dipakai di peta & portofolio) ---------- */
.ac-chip-row{display:flex;gap:.55rem;flex-wrap:wrap}
.ac-chip{border:1.5px solid #e3edf0;background:#fbfdff;color:#5a7086;font-size:.74rem;font-weight:800;
  padding:.55rem 1rem;border-radius:999px;cursor:pointer;display:inline-flex;align-items:center;gap:.4rem;
  transition:all .2s var(--ease,ease)}
.ac-chip i{font-size:.7rem}
.ac-chip:hover{border-color:#ffd98a;transform:translateY(-1px)}
.ac-chip.active{background:#0d3a66;border-color:#0d3a66;color:#fff}

/* ---------- peta interaktif ---------- */
.ac-map-stage{position:relative;width:100%;aspect-ratio:16/9;border-radius:22px;overflow:hidden;
  background:radial-gradient(120% 140% at 15% 0%,#eef7fd 0%,#dcedf9 55%,#cfe4f4 100%);
  border:1px solid #d9e7f2;margin-top:1.2rem;box-shadow:inset 0 2px 18px rgba(13,58,102,.06)}
.ac-map-sea{position:absolute;inset:0;z-index:0;opacity:.6;
  background-image:radial-gradient(rgba(13,58,102,.08) 1.3px,transparent 1.4px);background-size:22px 22px}
.ac-map-svg{position:absolute;inset:0;width:100%;height:100%;z-index:1}
.ac-map-svg path,.ac-map-svg ellipse{filter:drop-shadow(0 6px 10px rgba(13,58,102,.12))}
.ac-map-caption{position:absolute;left:16px;bottom:14px;font-size:.64rem;font-weight:700;color:#5a7086;
  background:rgba(255,255,255,.85);padding:.32rem .7rem;border-radius:999px;letter-spacing:.02em;z-index:3;
  display:inline-flex;align-items:center;gap:.4rem;backdrop-filter:blur(2px)}
.ac-pin{position:absolute;transform:translate(-50%,-100%);cursor:pointer;border:none;background:none;padding:0;
  display:flex;flex-direction:column;align-items:center;z-index:4}
.ac-pin-photo{position:relative;width:38px;height:38px;border-radius:50%;border:3px solid #fff;overflow:hidden;
  background:#0B5FA5;display:flex;align-items:center;justify-content:center;color:#fff;font-family:var(--font-display);
  font-weight:800;font-size:.8rem;box-shadow:0 8px 18px rgba(13,58,102,.32);transition:transform .2s var(--ease,ease)}
.ac-pin-photo img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover}
.ac-pin[data-tipe-dominan="kuliah"] .ac-pin-photo{background:#0B5FA5}
.ac-pin[data-tipe-dominan="kerja"] .ac-pin-photo{background:#ffb300}
.ac-pin-count{position:absolute;top:-4px;right:-4px;min-width:17px;height:17px;padding:0 4px;border-radius:999px;
  background:#ff7a00;color:#fff;font-size:.6rem;font-weight:800;display:flex;align-items:center;justify-content:center;
  border:2px solid #fff;z-index:2}
.ac-pin::after{content:"";width:2px;height:12px;background:#0d3a66;opacity:.3;margin-top:-1px}
.ac-pin-tag{margin-top:.32rem;font-size:.64rem;font-weight:800;color:#0d3a66;background:#fff;
  padding:.22rem .55rem;border-radius:999px;white-space:nowrap;box-shadow:0 4px 10px rgba(13,58,102,.16)}
.ac-pin:hover .ac-pin-photo,.ac-pin.is-active .ac-pin-photo{transform:scale(1.15)}
.ac-pin.is-active .ac-pin-photo{box-shadow:0 0 0 4px rgba(255,122,0,.28),0 8px 18px rgba(13,58,102,.32);animation:acPulse 1.6s ease infinite}
.ac-pin.is-active .ac-pin-tag{background:#0d3a66;color:#fff}
.ac-pin.is-abroad{transform:translate(-50%,0)}
.ac-pin.is-abroad::after{display:none}
.ac-map-link{position:absolute;border-top:2px dashed rgba(13,58,102,.25);pointer-events:none;z-index:2;
  transform-origin:0 0}

.ac-map-foot{display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;margin-top:1rem}
.ac-map-legend{display:flex;gap:1.1rem;flex-wrap:wrap;font-size:.7rem;color:#5a7086;font-weight:700}
.ac-map-legend span{display:inline-flex;align-items:center;gap:.4rem}
.ac-legend-dot{width:10px;height:10px;border-radius:50%;display:inline-block}
.ac-reset-filter{font-size:.72rem;font-weight:800;color:#0d3a66;background:#eef3f8;border:none;border-radius:999px;
  padding:.5rem .9rem;cursor:pointer;display:inline-flex;align-items:center;gap:.4rem;transition:background .2s var(--ease,ease)}
.ac-reset-filter:hover{background:#e0ecf5}
.ac-reset-filter[hidden]{display:none}

/* ---------- daftar alumni ---------- */
.ac-alumni-note{font-size:.78rem;color:#718396;margin:1.4rem 0 1rem;display:flex;align-items:center;gap:.5rem}
.ac-alumni-note i{color:#ffb300}
.ac-alumni-grid{display:grid;grid-template-columns:1fr;gap:.9rem}
.ac-alumni-card{border:1.5px solid #eef2f6;border-radius:18px;padding:1.1rem 1.2rem;background:#fbfdff;
  transition:border-color .2s var(--ease,ease),box-shadow .2s var(--ease,ease)}
.ac-alumni-card:hover{border-color:#ffd98a}
.ac-alumni-head{display:flex;align-items:center;gap:1.1rem;cursor:pointer}
.ac-avatar{position:relative;flex:0 0 68px;width:68px;height:68px;border-radius:18px;overflow:hidden;
  display:flex;align-items:center;justify-content:center;color:#fff;font-family:var(--font-display);
  font-weight:800;font-size:1.35rem;box-shadow:0 10px 22px rgba(13,58,102,.22)}
.ac-avatar img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center top}
.ac-avatar .ac-avatar-fallback{position:relative;z-index:1}
.ac-alumni-info{flex:1;min-width:0}
.ac-alumni-info h4{margin:0;font-size:.92rem;font-weight:800;color:#0d3a66}
.ac-alumni-info .ac-meta-row{display:flex;flex-wrap:wrap;gap:.4rem;margin-top:.35rem}
.ac-tagpill{font-size:.64rem;font-weight:800;padding:.22rem .55rem;border-radius:999px;background:#eef3f8;color:#5a7086;
  display:inline-flex;align-items:center;gap:.3rem}
.ac-tagpill.jurusan{color:#fff}
.ac-tagpill i{font-size:.6rem}
.ac-alumni-toggle{flex:0 0 auto;width:30px;height:30px;border-radius:50%;background:#eef3f8;color:#5a7086;
  display:flex;align-items:center;justify-content:center;font-size:.72rem;transition:transform .25s var(--ease,ease),background .2s var(--ease,ease)}
.ac-alumni-card.is-open .ac-alumni-toggle{transform:rotate(180deg);background:#0d3a66;color:#ffd54a}

.ac-journey{max-height:0;overflow:hidden;opacity:0;transition:max-height .45s var(--ease,ease),opacity .3s var(--ease,ease),margin-top .35s var(--ease,ease)}
.ac-alumni-card.is-open .ac-journey{max-height:760px;opacity:1;margin-top:1.1rem}
.ac-journey-inner{border-top:1px dashed #e3edf0;padding-top:1.2rem}
.ac-journey-profile{display:flex;align-items:center;gap:1.1rem;margin-bottom:1.2rem}
.ac-journey-photo{position:relative;flex:0 0 84px;width:84px;height:84px;border-radius:20px;overflow:hidden;
  display:flex;align-items:center;justify-content:center;color:#fff;font-family:var(--font-display);
  font-weight:800;font-size:1.6rem;box-shadow:0 14px 30px rgba(13,58,102,.26)}
.ac-journey-photo img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center top}
.ac-journey-photo .ac-avatar-fallback{position:relative;z-index:1}
.ac-journey-now{font-size:.8rem;color:#33475a;line-height:1.65;margin:0}
.ac-journey-now strong{display:block;color:#0d3a66;font-size:.95rem;margin-bottom:.15rem}
.ac-timeline{list-style:none;margin:0 0 1.1rem;padding:0}
.ac-timeline li{position:relative;padding-left:1.6rem;padding-bottom:.9rem;font-size:.76rem;color:#5a7086;line-height:1.55}
.ac-timeline li:last-child{padding-bottom:0}
.ac-timeline li::before{content:"";position:absolute;left:3px;top:4px;width:8px;height:8px;border-radius:50%;background:#dbe6ee}
.ac-timeline li::after{content:"";position:absolute;left:6px;top:14px;bottom:0;width:1.5px;background:#eef2f6}
.ac-timeline li:last-child::after{display:none}
.ac-timeline li:last-child::before{background:#ffb300;box-shadow:0 0 0 3px rgba(255,179,0,.2)}
.ac-timeline li b{display:block;color:#0d3a66;font-size:.78rem}
.ac-journey-actions{display:flex;gap:.6rem;flex-wrap:wrap}
.ac-mini-btn{font-size:.72rem;font-weight:800;border-radius:999px;padding:.55rem 1rem;border:1.5px solid #e3edf0;
  background:#fff;color:#0d3a66;cursor:pointer;display:inline-flex;align-items:center;gap:.4rem;
  transition:all .2s var(--ease,ease)}
.ac-mini-btn:hover{border-color:#ffb300;transform:translateY(-1px)}
.ac-mini-btn.primary{background:linear-gradient(135deg,#ffd54a,#ffb300);border-color:transparent;color:#0a2d52}

.ac-empty{text-align:center;padding:2.2rem 1rem;color:#a7b6c4}
.ac-empty i{font-size:1.8rem;margin-bottom:.8rem;color:#dbe6ee;display:block}
.ac-empty p{margin:0;font-size:.82rem}

/* ---------- portofolio ---------- */
.ac-portfolio-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:1.2rem;margin-top:1.2rem}
.ac-pf-card{border:1.5px solid #eef2f6;border-radius:20px;overflow:hidden;background:#fff;cursor:pointer;
  transition:border-color .2s var(--ease,ease),box-shadow .25s var(--ease,ease),transform .25s var(--ease,ease)}
.ac-pf-card:hover{border-color:#ffd98a;box-shadow:0 18px 36px rgba(13,58,102,.12);transform:translateY(-3px)}
.ac-pf-card.is-highlight{border-color:#ffb300;box-shadow:0 0 0 4px rgba(255,179,0,.18)}
.ac-pf-thumb{height:190px;position:relative;display:flex;align-items:center;justify-content:center;
  font-size:2.1rem;color:#fff;overflow:hidden}
.ac-pf-thumb img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;transition:transform .4s var(--ease,ease);z-index:0}
.ac-pf-card:hover .ac-pf-thumb img{transform:scale(1.06)}
.ac-pf-thumb-icon{position:relative;z-index:1}
.ac-pf-thumb[data-type="coding"]{background:linear-gradient(135deg,#0B5FA5,#123f6e)}
.ac-pf-thumb[data-type="desain"]{background:linear-gradient(135deg,#FF8A00,#e6631a)}
.ac-pf-thumb[data-type="penelitian"]{background:linear-gradient(135deg,#1f8a4c,#146238)}
.ac-pf-thumb[data-type="lainnya"]{background:linear-gradient(135deg,#7C4DFF,#5a32c9)}
.ac-pf-cat{position:absolute;top:.7rem;left:.7rem;z-index:2;font-size:.62rem;font-weight:800;text-transform:uppercase;
  letter-spacing:.04em;background:rgba(255,255,255,.95);color:#0d3a66;padding:.28rem .6rem;border-radius:999px}
.ac-pf-body{padding:1.05rem 1.15rem 1.2rem}
.ac-pf-body h4{margin:0 0 .4rem;font-size:.92rem;font-weight:800;color:#0d3a66;line-height:1.35}
.ac-pf-author{display:flex;align-items:center;gap:.5rem;font-size:.7rem;color:#8aa0b5;font-weight:700;margin-bottom:.6rem}
.ac-pf-author-photo{position:relative;flex:0 0 20px;width:20px;height:20px;border-radius:7px;overflow:hidden;
  display:flex;align-items:center;justify-content:center;color:#fff;font-size:.55rem;font-weight:800;
  font-family:var(--font-display)}
.ac-pf-author-photo img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center top}
.ac-pf-desc{font-size:.76rem;color:#718396;line-height:1.65;margin:0 0 .75rem;
  display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
.ac-pf-card.is-open .ac-pf-desc{-webkit-line-clamp:unset}
.ac-pf-tags{display:flex;flex-wrap:wrap;gap:.4rem}
.ac-pf-tags span{font-size:.64rem;font-weight:700;color:#5a7086;background:#f3f7fb;padding:.24rem .55rem;border-radius:999px}

/* ---------- inspirasi (penutup alur) ---------- */
.ac-inspire{position:relative;margin-top:2.2rem;border-radius:26px;overflow:hidden;
  background:linear-gradient(135deg,#0d3a66 0%,#123f6e 60%,#1a4a80 100%);color:#fff;
  padding:clamp(1.8rem,4vw,3rem);box-shadow:0 26px 58px rgba(13,58,102,.28)}
.ac-inspire::before{content:"";position:absolute;inset:0;
  background-image:radial-gradient(rgba(255,255,255,.08) 1.3px,transparent 1.4px);background-size:20px 20px;opacity:.6}
.ac-inspire::after{content:"";position:absolute;bottom:-70px;left:-40px;width:240px;height:240px;border-radius:50%;
  background:radial-gradient(circle,rgba(255,213,74,.22),rgba(255,213,74,0) 70%)}
.ac-inspire-inner{position:relative;z-index:2;display:grid;grid-template-columns:1fr auto;gap:2rem;align-items:center}
.ac-inspire-eyebrow{display:inline-flex;align-items:center;gap:.5rem;font-size:.68rem;font-weight:900;
  letter-spacing:.16em;text-transform:uppercase;color:#ffd54a;margin-bottom:1rem}
.ac-quote{font-family:var(--font-display);font-size:clamp(1.05rem,2vw,1.45rem);line-height:1.5;font-weight:700;
  margin:0 0 1.1rem;max-width:640px;min-height:6.5em}
.ac-quote-who{display:flex;align-items:center;gap:.8rem}
.ac-quote-avatar{width:42px;height:42px;border-radius:12px;display:flex;align-items:center;justify-content:center;
  font-family:var(--font-display);font-weight:800;color:#fff;background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0d3a66;flex:0 0 42px}
.ac-quote-who div strong{display:block;font-size:.84rem}
.ac-quote-who div span{display:block;font-size:.72rem;color:rgba(235,245,253,.75)}
.ac-quote-nav{display:flex;gap:.5rem;margin-top:1.3rem}
.ac-quote-nav button{width:34px;height:34px;border-radius:50%;border:1px solid rgba(255,255,255,.28);
  background:rgba(255,255,255,.08);color:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;
  transition:background .2s var(--ease,ease)}
.ac-quote-nav button:hover{background:rgba(255,255,255,.2)}
.ac-inspire-cta{text-align:center;display:flex;flex-direction:column;gap:.8rem;align-items:center}
.ac-inspire-cta .ac-btn{background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0a2d52;font-weight:800;
  font-size:.85rem;padding:.9rem 1.7rem;border-radius:999px;border:none;cursor:pointer;white-space:nowrap;
  box-shadow:0 14px 30px rgba(255,179,0,.3);display:inline-flex;align-items:center;gap:.5rem;
  transition:transform .2s var(--ease,ease),box-shadow .2s var(--ease,ease)}
.ac-inspire-cta .ac-btn:hover{transform:translateY(-2px);box-shadow:0 18px 38px rgba(255,179,0,.4)}
.ac-inspire-cta small{font-size:.68rem;color:rgba(235,245,253,.7);max-width:180px;line-height:1.5}

/* ---------- responsive ---------- */
@media(max-width:1180px){
  .ac-layout{grid-template-columns:minmax(0,1fr) 300px;gap:1.4rem}
  .ac-portfolio-grid{grid-template-columns:1fr}
}
@media(max-width:980px){
  .ac-layout{grid-template-columns:1fr}
  .ac-side{position:static;flex-direction:row;flex-wrap:wrap}
  .ac-side-card,.ac-side-note{flex:1 1 260px}
  .ac-inspire-inner{grid-template-columns:1fr;text-align:center}
  .ac-quote-who{justify-content:center}
  .ac-quote{margin-left:auto;margin-right:auto;min-height:0}
}
@media(max-width:700px){
  .ac-wrap{padding:32px 0 70px}
  .ac-top{padding:1.3rem 1.1rem;border-radius:20px}
  .ac-map-stage{aspect-ratio:16/13}
  .ac-side{flex-direction:column}
  .ac-quickstats{grid-template-columns:1fr 1fr}
}
@media(max-width:480px){
  .ac-map-stage{aspect-ratio:1/1}
  .ac-alumni-head{flex-wrap:wrap}
}
</style>
@endpush

@section('content')
<div class="ac-page">
  <span class="ac-blob ac-blob-a" aria-hidden="true"></span>
  <span class="ac-blob ac-blob-b" aria-hidden="true"></span>
  <span class="ac-blob ac-blob-c" aria-hidden="true"></span>
  <span class="ac-dotfield" aria-hidden="true"></span>

  <div class="ac-wrap">

    <div class="ac-top">
      <div>
        <span class="ac-eyebrow"><i class="fas fa-route"></i> Alumni Career &amp; Portfolio Hub</span>
        <h1>Jejak Karier &amp; Karya Alumni Skaneda</h1>
        <p>Lihat ke mana alumni Skaneda melangkah — kuliah, kerja, sampai usaha sendiri — lalu jelajahi karya nyata yang mereka hasilkan selama sekolah.</p>
      </div>
      <span class="ac-stat"><i class="fas fa-user-graduate"></i><span><b id="acStatTotal">0</b><span>Alumni Terdata</span></span></span>
    </div>

    <div class="ac-layout">
    <div class="ac-main">

      <div class="ac-tabs" role="tablist">
        <button class="ac-tab active" type="button" data-tab="peta" role="tab" aria-selected="true">
          <i class="fas fa-map-location-dot"></i> Peta Sebaran Alumni
        </button>
        <button class="ac-tab" type="button" data-tab="portofolio" role="tab" aria-selected="false">
          <i class="fas fa-layer-group"></i> Portofolio Karya
        </button>
      </div>

      <!-- ================= PANEL 1: PETA SEBARAN ================= -->
      <div class="ac-panel active" data-panel="peta">

        <div class="ac-card">
          <div class="ac-card-head">
            <div>
              <h2>Eksplorasi Peta Sebaran</h2>
              <p>Klik titik lokasi untuk melihat alumni yang kuliah atau bekerja di sana.</p>
            </div>
            <div class="ac-chip-row" id="acTipeFilter">
              <button class="ac-chip active" type="button" data-tipe="all"><i class="fas fa-globe"></i> Semua</button>
              <button class="ac-chip" type="button" data-tipe="kuliah"><i class="fas fa-graduation-cap"></i> Kuliah</button>
              <button class="ac-chip" type="button" data-tipe="kerja"><i class="fas fa-briefcase"></i> Kerja</button>
            </div>
          </div>

          <div class="ac-map-stage" id="acMapStage">
            <span class="ac-map-sea" aria-hidden="true"></span>
            <svg class="ac-map-svg" viewBox="0 0 1000 500" preserveAspectRatio="xMidYMid slice" aria-hidden="true">
              <defs>
                <linearGradient id="acIslandGrad" x1="0" y1="0" x2="1" y2="1">
                  <stop offset="0%" stop-color="#123f6e" stop-opacity=".16"/>
                  <stop offset="100%" stop-color="#0d3a66" stop-opacity=".09"/>
                </linearGradient>
                <linearGradient id="acIslandGradAlt" x1="0" y1="0" x2="1" y2="1">
                  <stop offset="0%" stop-color="#ff8a00" stop-opacity=".14"/>
                  <stop offset="100%" stop-color="#ff7a00" stop-opacity=".07"/>
                </linearGradient>
              </defs>
              <!-- Sumatra -->
              <path fill="url(#acIslandGrad)" d="M120,70 C170,55 205,95 218,150 C232,210 215,290 185,350 C160,400 110,395 85,345 C60,295 55,220 65,160 C72,120 85,85 120,70 Z"/>
              <!-- Kalimantan -->
              <path fill="url(#acIslandGradAlt)" d="M300,60 C380,42 470,80 490,150 C508,215 465,270 400,282 C335,294 275,262 258,205 C242,150 245,90 300,60 Z"/>
              <!-- Sulawesi -->
              <path fill="url(#acIslandGrad)" d="M610,130 C655,112 695,142 685,195 C678,225 705,255 692,295 C680,330 630,322 608,290 C588,262 598,232 578,212 C558,192 565,155 610,130 Z"/>
              <!-- Jawa -->
              <path fill="url(#acIslandGradAlt)" d="M225,345 C300,320 390,335 470,340 C530,343 585,348 618,362 C600,382 520,388 445,386 C365,384 285,378 230,368 C218,362 218,350 225,345 Z"/>
              <!-- Bali & Nusa Tenggara -->
              <ellipse fill="url(#acIslandGrad)" cx="632" cy="378" rx="20" ry="14"/>
              <ellipse fill="url(#acIslandGrad)" cx="670" cy="382" rx="13" ry="9"/>
              <!-- Papua -->
              <path fill="url(#acIslandGradAlt)" d="M790,150 C860,128 935,162 948,225 C960,285 900,328 838,318 C788,310 758,270 768,220 C773,190 770,168 790,150 Z"/>
            </svg>
            <span class="ac-map-caption"><i class="fas fa-map"></i> Ilustrasi sebaran, bukan peta presisi</span>
            <div id="acPinsLayer"></div>
          </div>

          <div class="ac-map-foot">
            <div class="ac-map-legend">
              <span><span class="ac-legend-dot" style="background:#0B5FA5"></span> Dominan Kuliah</span>
              <span><span class="ac-legend-dot" style="background:#ffb300"></span> Dominan Kerja</span>
            </div>
            <button class="ac-reset-filter" id="acResetLoc" type="button" hidden><i class="fas fa-xmark"></i> <span id="acResetLabel">Reset lokasi</span></button>
          </div>
        </div>

        <div class="ac-alumni-note"><i class="fas fa-hand-pointer"></i> <span id="acAlumniNote">Menampilkan semua alumni — pilih titik di peta untuk mempersempit, lalu klik namanya untuk melihat perjalanan kariernya.</span></div>
        <div class="ac-alumni-grid" id="acAlumniGrid"></div>
      </div>

      <!-- ================= PANEL 2: PORTOFOLIO ================= -->
      <div class="ac-panel" data-panel="portofolio">
        <div class="ac-card">
          <div class="ac-card-head">
            <div>
              <h2>Showcase Portofolio Siswa</h2>
              <p>Karya nyata dari proses belajar: proyek coding, desain, penelitian, hingga karya lintas jurusan lainnya.</p>
            </div>
            <div class="ac-chip-row" id="acKategoriFilter">
              <button class="ac-chip active" type="button" data-kat="all"><i class="fas fa-shapes"></i> Semua</button>
              <button class="ac-chip" type="button" data-kat="coding"><i class="fas fa-code"></i> Coding</button>
              <button class="ac-chip" type="button" data-kat="desain"><i class="fas fa-palette"></i> Desain</button>
              <button class="ac-chip" type="button" data-kat="penelitian"><i class="fas fa-flask"></i> Penelitian</button>
              <button class="ac-chip" type="button" data-kat="lainnya"><i class="fas fa-star"></i> Lainnya</button>
            </div>
          </div>
          <div class="ac-portfolio-grid" id="acPortfolioGrid"></div>
        </div>
      </div>

    </div>
    <!-- /.ac-main -->

    <aside class="ac-side">
      <div class="ac-side-card">
        <h3><i class="fas fa-route"></i> Alur Eksplorasi</h3>
        <ul class="ac-steps-list" id="acFlowSteps">
          <li class="is-active" data-flow="peta">
            <span class="ac-steps-num">1</span>
            <span class="ac-steps-text"><strong>Eksplorasi Peta</strong><span>Lihat sebaran alumni di berbagai kota.</span></span>
          </li>
          <li data-flow="pilih">
            <span class="ac-steps-num">2</span>
            <span class="ac-steps-text"><strong>Pilih Lokasi / Alumni</strong><span>Klik titik peta, lalu pilih nama alumninya.</span></span>
          </li>
          <li data-flow="karier">
            <span class="ac-steps-num">3</span>
            <span class="ac-steps-text"><strong>Lihat Perjalanan Karier</strong><span>Ikuti jejaknya dari lulus sampai sekarang.</span></span>
          </li>
          <li data-flow="portofolio">
            <span class="ac-steps-num">4</span>
            <span class="ac-steps-text"><strong>Eksplorasi Portofolio</strong><span>Lihat karya nyata yang dihasilkan.</span></span>
          </li>
          <li data-flow="inspirasi">
            <span class="ac-steps-num">5</span>
            <span class="ac-steps-text"><strong>Inspirasi</strong><span>Bawa pulang gambaran nyata untuk langkahmu.</span></span>
          </li>
        </ul>
      </div>

      <div class="ac-side-card">
        <h3><i class="fas fa-chart-simple"></i> Sekilas Data</h3>
        <div class="ac-quickstats">
          <div class="ac-qs-item"><b id="acQsKota">0</b><span>Kota &amp; Negara</span></div>
          <div class="ac-qs-item"><b id="acQsJurusan">0</b><span>Program Keahlian</span></div>
          <div class="ac-qs-item"><b id="acQsKuliah">0</b><span>Lanjut Kuliah</span></div>
          <div class="ac-qs-item"><b id="acQsKerja">0</b><span>Sudah Bekerja</span></div>
        </div>
      </div>

      <div class="ac-side-note">
        <h3><i class="fas fa-circle-info"></i> Ingin Ceritamu Ditampilkan?</h3>
        <p>Alumni Skaneda bisa mengirim update karier dan portofolio lewat Guru BKK / Hubin sekolah untuk ditambahkan ke halaman ini.</p>
      </div>
    </aside>
    </div>
    <!-- /.ac-layout -->

    <!-- ================= INSPIRASI (penutup alur) ================= -->
    <div class="ac-inspire" id="acInspire">
      <div class="ac-inspire-inner">
        <div>
          <span class="ac-inspire-eyebrow"><i class="fas fa-sparkles"></i> Inspirasi dari Alumni</span>
          <p class="ac-quote" id="acQuoteText">Memuat kata alumni…</p>
          <div class="ac-quote-who">
            <span class="ac-quote-avatar" id="acQuoteAvatar">•</span>
            <div>
              <strong id="acQuoteName">—</strong>
              <span id="acQuoteMeta">—</span>
            </div>
          </div>
          <div class="ac-quote-nav">
            <button type="button" id="acQuotePrev" aria-label="Kata alumni sebelumnya"><i class="fas fa-arrow-left"></i></button>
            <button type="button" id="acQuoteNext" aria-label="Kata alumni berikutnya"><i class="fas fa-arrow-right"></i></button>
          </div>
        </div>
        <div class="ac-inspire-cta">
          <a href="{{ route('home') }}#ppdb" class="ac-btn"><i class="fas fa-pen"></i> Mulai Jejakmu, Daftar PPDB</a>
          <small>Langkah alumni di atas dimulai dari kelas yang sama dengan kelasmu sekarang.</small>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
  /* =========================================================
     DATA CONTOH (dummy) — ganti dengan fetch ke API/database
     saat backend Alumni Hub sudah tersedia. Struktur field
     dibuat agar mudah dipetakan 1:1 ke tabel `alumni` &
     `alumni_portfolios`.
     ========================================================= */
  var JURUSAN_COLOR = {
    'RPL': '#0B5FA5', 'DKV': '#FF8A00', 'TKJ': '#1f8a4c',
    'Kuliner': '#e6a100', 'APHP': '#6FAF45', 'LPS': '#7C4DFF'
  };

  var LOCATIONS = {
    surabaya:   { label: 'Surabaya',    left: 55, top: 68 },
    malang:     { label: 'Malang',      left: 57, top: 78 },
    mojokerto:  { label: 'Mojokerto',   left: 50, top: 72 },
    yogyakarta: { label: 'Yogyakarta',  left: 45, top: 76 },
    jakarta:    { label: 'Jakarta',     left: 29, top: 66 },
    bandung:    { label: 'Bandung',     left: 35, top: 70 },
    denpasar:   { label: 'Denpasar',    left: 63, top: 78 },
    makassar:   { label: 'Makassar',    left: 65, top: 45 },
    luarnegeri: { label: 'Luar Negeri', left: 90, top: 10, abroad: true }
  };

  var ALUMNI = [
    { id:'a1', nama:'Naufal Ardiansyah', jurusan:'RPL', angkatan:2022, lokasi:'surabaya', tipe:'kerja',
      posisi:'Software Engineer', institusi:'PT Telkom Digital Indonesia',
      timeline:[
        {label:'Lulus SMK Negeri 2 Mojokerto', ket:'2022 · Jurusan RPL'},
        {label:'Magang Frontend Developer', ket:'Startup lokal Surabaya, 6 bulan'},
        {label:'Software Engineer Junior', ket:'Vendor IT Surabaya'},
        {label:'Software Engineer — sekarang', ket:'PT Telkom Digital Indonesia'}
      ], portofolio:'p1' },
    { id:'a2', nama:'Dinda Ayu Pratiwi', jurusan:'DKV', angkatan:2021, lokasi:'yogyakarta', tipe:'kuliah',
      posisi:'Mahasiswa S1 DKV', institusi:'ISI Yogyakarta',
      timeline:[
        {label:'Lulus SMK Negeri 2 Mojokerto', ket:'2021 · Jurusan DKV'},
        {label:'Freelance desain untuk UMKM', ket:'Logo & kemasan produk lokal'},
        {label:'Diterima di ISI Yogyakarta', ket:'S1 Desain Komunikasi Visual'},
        {label:'Aktif di studio kampus — sekarang', ket:'Semester 6, fokus branding'}
      ], portofolio:'p4' },
    { id:'a3', nama:'M. Rizky Ramadhan', jurusan:'TKJ', angkatan:2020, lokasi:'jakarta', tipe:'kerja',
      posisi:'Network Engineer', institusi:'ISP Nasional',
      timeline:[
        {label:'Lulus SMK Negeri 2 Mojokerto', ket:'2020 · Jurusan TKJ'},
        {label:'Teknisi jaringan lapangan', ket:'Vendor ISP daerah'},
        {label:'Network Engineer — sekarang', ket:'ISP nasional, cabang Jakarta'}
      ], portofolio:null },
    { id:'a4', nama:'Salsabila Putri', jurusan:'Kuliner', angkatan:2022, lokasi:'denpasar', tipe:'kerja',
      posisi:'Commis Chef', institusi:'Hotel bintang 5, Denpasar',
      timeline:[
        {label:'Lulus SMK Negeri 2 Mojokerto', ket:'2022 · Jurusan Kuliner'},
        {label:'PKL di resto lokal', ket:'Pengalaman dapur profesional pertama'},
        {label:'Commis Chef — sekarang', ket:'Hotel bintang 5 di Denpasar, Bali'}
      ], portofolio:'p9' },
    { id:'a5', nama:'Bagus Setiawan', jurusan:'APHP', angkatan:2021, lokasi:'malang', tipe:'kuliah',
      posisi:'Mahasiswa S1 Teknologi Pangan', institusi:'Universitas Brawijaya',
      timeline:[
        {label:'Lulus SMK Negeri 2 Mojokerto', ket:'2021 · Jurusan APHP'},
        {label:'Magang di UMKM olahan pangan', ket:'Quality control produk lokal'},
        {label:'Diterima di Universitas Brawijaya', ket:'S1 Teknologi Hasil Pertanian'},
        {label:'Riset kampus — sekarang', ket:'Fokus fermentasi pangan lokal'}
      ], portofolio:'p8' },
    { id:'a6', nama:'Nadia Rahmawati', jurusan:'LPS', angkatan:2020, lokasi:'surabaya', tipe:'kerja',
      posisi:'Staff Frontliner', institusi:'Bank Syariah, cabang Surabaya',
      timeline:[
        {label:'Lulus SMK Negeri 2 Mojokerto', ket:'2020 · Jurusan LPS'},
        {label:'Training frontliner perbankan', ket:'Program pelatihan bank syariah'},
        {label:'Staff Frontliner — sekarang', ket:'Cabang Surabaya'}
      ], portofolio:null },
    { id:'a7', nama:'Yusuf Al Fatih', jurusan:'RPL', angkatan:2019, lokasi:'bandung', tipe:'kuliah',
      posisi:'Asisten Lab AI', institusi:'Telkom University',
      timeline:[
        {label:'Lulus SMK Negeri 2 Mojokerto', ket:'2019 · Jurusan RPL'},
        {label:'Diterima di Telkom University', ket:'S1 Informatika'},
        {label:'Asisten Laboratorium AI — sekarang', ket:'Riset machine learning terapan'}
      ], portofolio:'p2' },
    { id:'a8', nama:'Clara Amanda', jurusan:'DKV', angkatan:2022, lokasi:'jakarta', tipe:'kerja',
      posisi:'Graphic Designer', institusi:'Agensi kreatif, Jakarta',
      timeline:[
        {label:'Lulus SMK Negeri 2 Mojokerto', ket:'2022 · Jurusan DKV'},
        {label:'Freelance desainer sosial media', ket:'UMKM & campaign komunitas'},
        {label:'Graphic Designer — sekarang', ket:'Agensi kreatif di Jakarta'}
      ], portofolio:'p5' },
    { id:'a9', nama:'Farhan Maulana', jurusan:'TKJ', angkatan:2021, lokasi:'luarnegeri', tipe:'kerja',
      posisi:'Technical Support Engineer', institusi:'Program magang kerja, Jepang',
      timeline:[
        {label:'Lulus SMK Negeri 2 Mojokerto', ket:'2021 · Jurusan TKJ'},
        {label:'Pelatihan program magang Jepang', ket:'Persiapan bahasa & keterampilan'},
        {label:'Technical Support Engineer — sekarang', ket:'Perusahaan elektronik di Jepang'}
      ], portofolio:'p10' },
    { id:'a10', nama:'Alya Zahra', jurusan:'Kuliner', angkatan:2020, lokasi:'mojokerto', tipe:'kerja',
      posisi:'Founder Usaha Bakery', institusi:'Usaha mandiri, Mojokerto',
      timeline:[
        {label:'Lulus SMK Negeri 2 Mojokerto', ket:'2020 · Jurusan Kuliner'},
        {label:'Jualan kue rumahan', ket:'Modal awal dari tabungan praktik'},
        {label:'Membuka usaha bakery sendiri — sekarang', ket:'Melayani Mojokerto & sekitarnya'}
      ], portofolio:'p11' },
    { id:'a11', nama:'Bima Prakoso', jurusan:'RPL', angkatan:2023, lokasi:'malang', tipe:'kuliah',
      posisi:'Mahasiswa S1 Sistem Informasi', institusi:'Universitas Negeri Malang',
      timeline:[
        {label:'Lulus SMK Negeri 2 Mojokerto', ket:'2023 · Jurusan RPL'},
        {label:'Diterima di Universitas Negeri Malang', ket:'S1 Sistem Informasi'},
        {label:'Aktif organisasi riset kampus — sekarang', ket:'Fokus sistem informasi sekolah'}
      ], portofolio:'p3' },
    { id:'a12', nama:'Intan Permatasari', jurusan:'LPS', angkatan:2022, lokasi:'makassar', tipe:'kerja',
      posisi:'Teller', institusi:'Bank Syariah, cabang Makassar',
      timeline:[
        {label:'Lulus SMK Negeri 2 Mojokerto', ket:'2022 · Jurusan LPS'},
        {label:'Training operasional perbankan', ket:'Program pelatihan bank syariah'},
        {label:'Teller — sekarang', ket:'Cabang Makassar'}
      ], portofolio:null },
    { id:'a13', nama:'Reza Firmansyah', jurusan:'APHP', angkatan:2019, lokasi:'surabaya', tipe:'kerja',
      posisi:'Staff Quality Control', institusi:'Perusahaan olahan pangan, Surabaya',
      timeline:[
        {label:'Lulus SMK Negeri 2 Mojokerto', ket:'2019 · Jurusan APHP'},
        {label:'Staff produksi', ket:'Perusahaan olahan pangan lokal'},
        {label:'Staff Quality Control — sekarang', ket:'Menangani uji mutu produk'}
      ], portofolio:'p7' },
    { id:'a14', nama:'Kirana Ayu', jurusan:'DKV', angkatan:2023, lokasi:'bandung', tipe:'kuliah',
      posisi:'Mahasiswa S1 DKV', institusi:'Institut Teknologi Bandung',
      timeline:[
        {label:'Lulus SMK Negeri 2 Mojokerto', ket:'2023 · Jurusan DKV'},
        {label:'Diterima di ITB', ket:'S1 Desain Komunikasi Visual'},
        {label:'Proyek ilustrasi kampus — sekarang', ket:'Fokus ilustrasi edukatif'}
      ], portofolio:'p6' }
  ];

  var PORTFOLIO = [
    { id:'p1', tipe:'coding', judul:'Sistem Presensi QR Realtime', authorId:'a1',
      desc:'Aplikasi presensi berbasis QR code dengan dashboard realtime, dibangun sebagai proyek akhir kelas RPL untuk mempermudah rekap kehadiran siswa.',
      tags:['Laravel','QR Code','Dashboard'] },
    { id:'p2', tipe:'coding', judul:'Aplikasi Prediksi Nilai Siswa (ML)', authorId:'a7',
      desc:'Model machine learning sederhana untuk memprediksi kecenderungan nilai siswa berdasarkan pola kehadiran dan tugas, dikembangkan lanjut saat kuliah.',
      tags:['Python','Machine Learning','Data'] },
    { id:'p3', tipe:'coding', judul:'Prototipe Sistem Informasi Akademik', authorId:'a11',
      desc:'Prototipe sistem informasi akademik sederhana untuk manajemen jadwal dan nilai, dikerjakan sebagai latihan pengembangan sistem berbasis web.',
      tags:['PHP','MySQL','Prototype'] },
    { id:'p4', tipe:'desain', judul:'Rebranding Kemasan Kopi Lokal', authorId:'a2',
      desc:'Perancangan ulang identitas visual dan kemasan untuk UMKM kopi lokal Mojokerto, mencakup logo, palet warna, dan desain kemasan siap cetak.',
      tags:['Branding','Kemasan','Ilustrasi'] },
    { id:'p5', tipe:'desain', judul:'Kampanye Visual Anti-Perundungan', authorId:'a8',
      desc:'Serial poster kampanye sosial anti-perundungan untuk lingkungan sekolah, dirancang dengan gaya visual yang ramah dan mudah dipahami siswa.',
      tags:['Poster','Kampanye Sosial'] },
    { id:'p6', tipe:'desain', judul:'Ilustrasi Board Game Edukasi Budaya Jawa', authorId:'a14',
      desc:'Ilustrasi karakter dan papan permainan edukatif bertema budaya Jawa, dibuat untuk memperkenalkan cerita rakyat kepada anak-anak.',
      tags:['Ilustrasi','Board Game','Budaya'] },
    { id:'p7', tipe:'penelitian', judul:'Uji Mutu & Umur Simpan Keripik Buah Lokal', authorId:'a13',
      desc:'Penelitian sederhana mengenai daya simpan dan standar mutu keripik buah olahan UMKM, digunakan sebagai bahan rekomendasi perbaikan kemasan.',
      tags:['Uji Mutu','Pangan','Riset'] },
    { id:'p8', tipe:'penelitian', judul:'Potensi Fermentasi Tempe untuk Produk Ekspor', authorId:'a5',
      desc:'Kajian awal tentang peningkatan kualitas fermentasi tempe agar memenuhi standar produk olahan untuk pasar yang lebih luas.',
      tags:['Fermentasi','Pangan Lokal'] },
    { id:'p9', tipe:'lainnya', judul:'Plating Kreatif Nusantara Fusion', authorId:'a4',
      desc:'Rangkaian karya plating hidangan bertema fusion Nusantara, menggabungkan cita rasa lokal dengan teknik penyajian modern ala hotel.',
      tags:['Plating','Food Styling'] },
    { id:'p10', tipe:'lainnya', judul:'Dokumentasi Instalasi Jaringan Sekolah', authorId:'a9',
      desc:'Dokumentasi proyek instalasi dan konfigurasi jaringan LAN untuk lab komputer sekolah, dikerjakan bersama tim saat kelas XII.',
      tags:['Jaringan','Dokumentasi'] },
    { id:'p11', tipe:'lainnya', judul:'Branding & Kemasan Usaha Bakery Mandiri', authorId:'a10',
      desc:'Identitas visual dan kemasan untuk usaha bakery pribadi, dirancang sendiri mulai dari logo, stiker kemasan, hingga katalog produk.',
      tags:['Wirausaha','Kemasan'] }
  ];

  var QUOTES = [
    { alumniId:'a1', text:'Yang paling kepakai dari sekolah bukan cuma coding-nya, tapi kebiasaan nyelesain masalah sampai tuntas. Itu yang dibawa terus sampai kerja.' },
    { alumniId:'a4', text:'Praktik dapur di sekolah itu keras, tapi karena itu juga aku nggak kaget waktu masuk dapur hotel beneran.' },
    { alumniId:'a2', text:'Portofolio yang dibuat waktu sekolah jadi modal utama pas daftar kuliah desain — dosen malah nanya proses bikinnya, bukan cuma hasilnya.' },
    { alumniId:'a10', text:'Nggak nyangka usaha kecil-kecilan waktu sekolah bisa jadi usaha beneran. Yang penting mulai dulu, sekecil apa pun.' },
    { alumniId:'a9', text:'Belajar jaringan di sekolah itu pondasi. Waktu ikut program kerja ke luar negeri, dasar itu yang bikin lebih percaya diri.' }
  ];

  /* ---------------- helpers ---------------- */
  function alumniById(id) { return ALUMNI.filter(function (a) { return a.id === id; })[0]; }
  function portfolioById(id) { return PORTFOLIO.filter(function (p) { return p.id === id; })[0]; }
  function initials(name) {
    var parts = name.trim().split(/\s+/);
    return (parts[0][0] + (parts[1] ? parts[1][0] : '')).toUpperCase();
  }
  function jurusanColor(j) { return JURUSAN_COLOR[j] || '#0d3a66'; }
  /* Foto alumni: cari di images/alumni/{id}.jpg — kalau belum diupload,
     otomatis jatuh ke lingkaran inisial berwarna (tidak pernah tampil rusak). */
  function avatarHTML(a, altText) {
    return '<img src="{{ asset("images/alumni") }}/' + a.id + '.jpg" alt="' + altText + '" loading="lazy" ' +
      'onerror="this.remove()">' +
      '<span class="ac-avatar-fallback">' + initials(a.nama) + '</span>';
  }

  /* ---------------- tab switching ---------------- */
  var tabs = document.querySelectorAll('.ac-tab');
  var panels = document.querySelectorAll('.ac-panel');
  function activateTab(name) {
    tabs.forEach(function (t) {
      var on = t.getAttribute('data-tab') === name;
      t.classList.toggle('active', on);
      t.setAttribute('aria-selected', on ? 'true' : 'false');
    });
    panels.forEach(function (p) { p.classList.toggle('active', p.getAttribute('data-panel') === name); });
    setFlowStep(name === 'peta' ? 'peta' : 'portofolio');
  }
  tabs.forEach(function (t) {
    t.addEventListener('click', function () { activateTab(t.getAttribute('data-tab')); });
  });

  /* ---------------- alur / flow steps sidebar ---------------- */
  var flowSteps = Array.prototype.slice.call(document.querySelectorAll('#acFlowSteps li'));
  var flowOrder = ['peta', 'pilih', 'karier', 'portofolio', 'inspirasi'];
  function setFlowStep(name) {
    var idx = flowOrder.indexOf(name);
    if (idx === -1) return;
    flowSteps.forEach(function (li) {
      var liIdx = flowOrder.indexOf(li.getAttribute('data-flow'));
      li.classList.toggle('is-active', liIdx === idx);
      li.classList.toggle('is-done', liIdx < idx);
    });
  }

  /* ---------------- render peta pins ---------------- */
  var pinsLayer = document.getElementById('acPinsLayer');
  var activeLocation = null;
  var activeTipe = 'all';

  function countByLocation(loc) {
    return ALUMNI.filter(function (a) {
      return a.lokasi === loc && (activeTipe === 'all' || a.tipe === activeTipe);
    }).length;
  }
  function dominantTipe(loc) {
    var list = ALUMNI.filter(function (a) { return a.lokasi === loc; });
    var kuliah = list.filter(function (a) { return a.tipe === 'kuliah'; }).length;
    var kerja = list.length - kuliah;
    return kuliah > kerja ? 'kuliah' : 'kerja';
  }

  function renderPins() {
    pinsLayer.innerHTML = '';
    Object.keys(LOCATIONS).forEach(function (key) {
      var loc = LOCATIONS[key];
      var count = countByLocation(key);
      var repAlumni = ALUMNI.filter(function (a) { return a.lokasi === key; })[0];
      var btn = document.createElement('button');
      btn.type = 'button';
      btn.className = 'ac-pin' + (loc.abroad ? ' is-abroad' : '') + (activeLocation === key ? ' is-active' : '');
      btn.setAttribute('data-loc', key);
      btn.setAttribute('data-tipe-dominan', dominantTipe(key));
      btn.style.left = loc.left + '%';
      btn.style.top = loc.top + '%';
      var photoHtml = repAlumni ? avatarHTML(repAlumni, 'Alumni di ' + loc.label) : '<span class="ac-avatar-fallback">' + loc.label[0] + '</span>';
      var countBadge = count > 1 ? '<span class="ac-pin-count">' + count + '</span>' : '';
      btn.innerHTML =
        '<span class="ac-pin-photo">' + photoHtml + countBadge + '</span>' +
        '<span class="ac-pin-tag">' + loc.label + '</span>';
      btn.addEventListener('click', function () { selectLocation(key); });
      pinsLayer.appendChild(btn);
    });
  }

  var resetBtn = document.getElementById('acResetLoc');
  var alumniNote = document.getElementById('acAlumniNote');

  function selectLocation(key) {
    activeLocation = (activeLocation === key) ? null : key;
    renderPins();
    renderAlumniList();
    resetBtn.hidden = !activeLocation;
    if (activeLocation) {
      alumniNote.textContent = 'Menampilkan alumni di ' + LOCATIONS[activeLocation].label + ' — klik namanya untuk melihat perjalanan kariernya.';
      setFlowStep('pilih');
    } else {
      alumniNote.textContent = 'Menampilkan semua alumni — pilih titik di peta untuk mempersempit, lalu klik namanya untuk melihat perjalanan kariernya.';
    }
  }
  resetBtn.addEventListener('click', function () { selectLocation(activeLocation); });

  /* ---------------- filter tipe (kuliah/kerja) ---------------- */
  document.getElementById('acTipeFilter').addEventListener('click', function (e) {
    var chip = e.target.closest('.ac-chip');
    if (!chip) return;
    document.querySelectorAll('#acTipeFilter .ac-chip').forEach(function (c) { c.classList.remove('active'); });
    chip.classList.add('active');
    activeTipe = chip.getAttribute('data-tipe');
    renderPins();
    renderAlumniList();
  });

  /* ---------------- render daftar alumni ---------------- */
  var alumniGrid = document.getElementById('acAlumniGrid');

  function filteredAlumni() {
    return ALUMNI.filter(function (a) {
      var locOk = !activeLocation || a.lokasi === activeLocation;
      var tipeOk = activeTipe === 'all' || a.tipe === activeTipe;
      return locOk && tipeOk;
    });
  }

  function renderAlumniList() {
    var list = filteredAlumni();
    alumniGrid.innerHTML = '';
    if (!list.length) {
      alumniGrid.innerHTML = '<div class="ac-empty"><i class="fas fa-user-slash"></i><p>Belum ada alumni pada filter ini. Coba pilih lokasi atau tipe lain.</p></div>';
      return;
    }
    list.forEach(function (a) {
      var card = document.createElement('div');
      card.className = 'ac-alumni-card';
      card.setAttribute('data-alumni-id', a.id);

      var tipeIcon = a.tipe === 'kuliah' ? 'fa-graduation-cap' : 'fa-briefcase';
      var color = jurusanColor(a.jurusan);

      var timelineHtml = a.timeline.map(function (t) {
        return '<li><b>' + t.label + '</b>' + t.ket + '</li>';
      }).join('');

      var portfolioBtn = '';
      if (a.portofolio) {
        portfolioBtn = '<button type="button" class="ac-mini-btn primary" data-goto-portfolio="' + a.portofolio + '"><i class="fas fa-layer-group"></i> Lihat Portofolio</button>';
      }

      card.innerHTML =
        '<div class="ac-alumni-head">' +
          '<span class="ac-avatar" style="background:' + color + '">' + avatarHTML(a, 'Foto ' + a.nama) + '</span>' +
          '<div class="ac-alumni-info">' +
            '<h4>' + a.nama + '</h4>' +
            '<div class="ac-meta-row">' +
              '<span class="ac-tagpill jurusan" style="background:' + color + '">' + a.jurusan + '</span>' +
              '<span class="ac-tagpill"><i class="fas ' + tipeIcon + '"></i> ' + (a.tipe === 'kuliah' ? 'Kuliah' : 'Kerja') + '</span>' +
              '<span class="ac-tagpill"><i class="fas fa-location-dot"></i> ' + LOCATIONS[a.lokasi].label + '</span>' +
              '<span class="ac-tagpill"><i class="fas fa-calendar"></i> Angkatan ' + a.angkatan + '</span>' +
            '</div>' +
          '</div>' +
          '<span class="ac-alumni-toggle"><i class="fas fa-chevron-down"></i></span>' +
        '</div>' +
        '<div class="ac-journey">' +
          '<div class="ac-journey-inner">' +
            '<div class="ac-journey-profile">' +
              '<span class="ac-journey-photo" style="background:' + color + '">' + avatarHTML(a, 'Foto ' + a.nama) + '</span>' +
              '<p class="ac-journey-now"><strong>' + a.posisi + '</strong>' + a.institusi + '</p>' +
            '</div>' +
            '<ul class="ac-timeline">' + timelineHtml + '</ul>' +
            '<div class="ac-journey-actions">' + portfolioBtn + '</div>' +
          '</div>' +
        '</div>';

      card.querySelector('.ac-alumni-head').addEventListener('click', function () {
        var wasOpen = card.classList.contains('is-open');
        alumniGrid.querySelectorAll('.ac-alumni-card.is-open').forEach(function (c) { c.classList.remove('is-open'); });
        if (!wasOpen) {
          card.classList.add('is-open');
          setFlowStep('karier');
          card.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
      });

      var pfBtn = card.querySelector('[data-goto-portfolio]');
      if (pfBtn) {
        pfBtn.addEventListener('click', function (e) {
          e.stopPropagation();
          goToPortfolio(pfBtn.getAttribute('data-goto-portfolio'));
        });
      }

      alumniGrid.appendChild(card);
    });
  }

  /* ---------------- render portofolio ---------------- */
  var pfGrid = document.getElementById('acPortfolioGrid');
  var activeKategori = 'all';

  function renderPortfolio() {
    var list = PORTFOLIO.filter(function (p) { return activeKategori === 'all' || p.tipe === activeKategori; });
    pfGrid.innerHTML = '';
    if (!list.length) {
      pfGrid.innerHTML = '<div class="ac-empty"><i class="fas fa-box-open"></i><p>Belum ada karya pada kategori ini.</p></div>';
      return;
    }
    var iconMap = { coding: 'fa-code', desain: 'fa-palette', penelitian: 'fa-flask', lainnya: 'fa-star' };
    var labelMap = { coding: 'Coding', desain: 'Desain', penelitian: 'Penelitian', lainnya: 'Lainnya' };

    list.forEach(function (p) {
      var author = alumniById(p.authorId);
      var authorAvatar = author
        ? '<span class="ac-pf-author-photo" style="background:' + jurusanColor(author.jurusan) + '">' + avatarHTML(author, 'Foto ' + author.nama) + '</span>'
        : '<i class="fas fa-user"></i>';
      var card = document.createElement('div');
      card.className = 'ac-pf-card';
      card.setAttribute('data-portfolio-id', p.id);
      card.innerHTML =
        '<div class="ac-pf-thumb" data-type="' + p.tipe + '">' +
          '<span class="ac-pf-cat">' + labelMap[p.tipe] + '</span>' +
          '<img src="{{ asset("images/portfolio") }}/' + p.id + '.jpg" alt="' + p.judul + '" loading="lazy" onerror="this.remove()">' +
          '<i class="fas ' + iconMap[p.tipe] + ' ac-pf-thumb-icon"></i>' +
        '</div>' +
        '<div class="ac-pf-body">' +
          '<h4>' + p.judul + '</h4>' +
          '<div class="ac-pf-author">' + authorAvatar + ' ' + (author ? author.nama + ' · ' + author.jurusan : 'Alumni Skaneda') + '</div>' +
          '<p class="ac-pf-desc">' + p.desc + '</p>' +
          '<div class="ac-pf-tags">' + p.tags.map(function (t) { return '<span>' + t + '</span>'; }).join('') + '</div>' +
        '</div>';

      card.addEventListener('click', function () {
        card.classList.toggle('is-open');
      });

      pfGrid.appendChild(card);
    });
  }

  document.getElementById('acKategoriFilter').addEventListener('click', function (e) {
    var chip = e.target.closest('.ac-chip');
    if (!chip) return;
    document.querySelectorAll('#acKategoriFilter .ac-chip').forEach(function (c) { c.classList.remove('active'); });
    chip.classList.add('active');
    activeKategori = chip.getAttribute('data-kat');
    renderPortfolio();
  });

  /* ---------------- lompat dari alumni -> portofolio ---------------- */
  function goToPortfolio(portfolioId) {
    activateTab('portofolio');
    activeKategori = 'all';
    document.querySelectorAll('#acKategoriFilter .ac-chip').forEach(function (c) {
      c.classList.toggle('active', c.getAttribute('data-kat') === 'all');
    });
    renderPortfolio();
    setFlowStep('portofolio');
    requestAnimationFrame(function () {
      var el = pfGrid.querySelector('[data-portfolio-id="' + portfolioId + '"]');
      if (!el) return;
      el.scrollIntoView({ behavior: 'smooth', block: 'center' });
      el.classList.add('is-highlight', 'is-open');
      setTimeout(function () { el.classList.remove('is-highlight'); }, 2200);
    });
  }

  /* ---------------- kata alumni (inspirasi) ---------------- */
  var quoteIndex = 0;
  var quoteText = document.getElementById('acQuoteText');
  var quoteAvatar = document.getElementById('acQuoteAvatar');
  var quoteName = document.getElementById('acQuoteName');
  var quoteMeta = document.getElementById('acQuoteMeta');
  var quoteTimer = null;

  function renderQuote() {
    var q = QUOTES[quoteIndex];
    var a = alumniById(q.alumniId);
    quoteText.textContent = '\u201C' + q.text + '\u201D';
    quoteAvatar.textContent = a ? initials(a.nama) : '•';
    quoteAvatar.style.background = a ? jurusanColor(a.jurusan) : '';
    quoteName.textContent = a ? a.nama : 'Alumni Skaneda';
    quoteMeta.textContent = a ? (a.jurusan + ' · Angkatan ' + a.angkatan + ' · ' + a.posisi) : '';
  }
  function nextQuote(dir) {
    quoteIndex = (quoteIndex + dir + QUOTES.length) % QUOTES.length;
    renderQuote();
    resetQuoteTimer();
  }
  function resetQuoteTimer() {
    if (quoteTimer) clearInterval(quoteTimer);
    quoteTimer = setInterval(function () { nextQuote(1); }, 7000);
  }
  document.getElementById('acQuoteNext').addEventListener('click', function () { nextQuote(1); });
  document.getElementById('acQuotePrev').addEventListener('click', function () { nextQuote(-1); });

  /* ---------------- reveal inspirasi step saat discroll ---------------- */
  var inspireEl = document.getElementById('acInspire');
  if ('IntersectionObserver' in window) {
    new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) setFlowStep('inspirasi');
      });
    }, { threshold: 0.4 }).observe(inspireEl);
  }

  /* ---------------- sekilas data (sidebar stats) ---------------- */
  function renderStats() {
    document.getElementById('acStatTotal').textContent = ALUMNI.length;
    var kota = {};
    ALUMNI.forEach(function (a) { kota[a.lokasi] = true; });
    document.getElementById('acQsKota').textContent = Object.keys(kota).length;
    var jurusan = {};
    ALUMNI.forEach(function (a) { jurusan[a.jurusan] = true; });
    document.getElementById('acQsJurusan').textContent = Object.keys(jurusan).length;
    document.getElementById('acQsKuliah').textContent = ALUMNI.filter(function (a) { return a.tipe === 'kuliah'; }).length;
    document.getElementById('acQsKerja').textContent = ALUMNI.filter(function (a) { return a.tipe === 'kerja'; }).length;
  }

  /* ---------------- init ---------------- */
  renderPins();
  renderAlumniList();
  renderPortfolio();
  renderQuote();
  resetQuoteTimer();
  renderStats();
})();
</script>
@endpush