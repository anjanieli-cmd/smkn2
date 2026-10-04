@extends('layouts.app')

@section('title', 'Program Keahlian RPL (Rekayasa Perangkat Lunak) — SMK Negeri 2 Mojokerto')
@section('description', 'Program Keahlian RPL (Rekayasa Perangkat Lunak) SMK Negeri 2 Mojokerto: profil, kompetensi, proyek aplikasi siswa, dan fasilitas laboratorium komputer.')

@push('styles')
<style>
/* =========================================================
   RPL — REKAYASA PERANGKAT LUNAK
   Mini website premium khusus RPL di dalam website sekolah.
   Konsep: LOGIKA → CODING → APLIKASI → INDUSTRI TEKNOLOGI → KARIER
   Palet: navy #0d3a66, blue #0B5FA5, bright blue #28A9E1,
          gold #FFD54A, orange #FF8A00, purple RPL #7C4DFF, white #F8FBFF
   ========================================================= */
.aphp-page{background:#f8fbff;color:#0d3a66;overflow:hidden;font-family:var(--font-body,system-ui,-apple-system,sans-serif)}
.aphp-page *{box-sizing:border-box}
.aphp-wide{width:min(1320px,92%);margin:auto;position:relative;z-index:2}
.section-pad{padding:100px 0 110px;position:relative;isolation:isolate}
.eyebrow{display:inline-flex;align-items:center;gap:.5rem;font-size:.7rem;font-weight:800;letter-spacing:.2em;text-transform:uppercase;color:#0d3a66;margin-bottom:.8rem}
.eyebrow::before{content:"";width:24px;height:3px;border-radius:99px;background:linear-gradient(90deg,#0d3a66,#0B5FA5)}
.eyebrow.gold{color:#FF8A00}
.eyebrow.gold::before{background:linear-gradient(90deg,#FFD54A,#FF8A00)}
.big-heading{font-family:var(--font-display);font-size:clamp(2rem,4.2vw,3.8rem);line-height:1.02;letter-spacing:.01em;margin:0;color:#0d3a66}
.big-heading span{background:linear-gradient(135deg,#FFD54A 0%,#FFB300 45%,#FF8A00 100%);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}
.big-heading.white{color:#fff}
.big-heading.white span{-webkit-text-fill-color:#FFD54A;color:#FFD54A}

/* ===== ORNAMENT SYSTEM ===== */
.orn{position:absolute;inset:0;z-index:0;pointer-events:none;overflow:hidden}
.orn .o-chevron{position:absolute;width:300px;height:300px;border-top:2px solid rgba(7,27,51,.1);border-right:2px solid rgba(7,27,51,.1);transform:rotate(45deg)}
.orn .o-chevron::after{content:"";position:absolute;inset:30px;border-top:2px solid rgba(11,95,165,.08);border-right:2px solid rgba(11,95,165,.08)}
.orn .o-line{position:absolute;width:280px;height:2px;background:linear-gradient(90deg,transparent,#0B5FA5,transparent);opacity:.2;transform:rotate(-38deg)}
.orn .o-line::after{content:"";position:absolute;left:60px;top:10px;width:160px;height:1px;background:linear-gradient(90deg,transparent,#FFD54A,transparent)}
.orn .o-dots{position:absolute;width:110px;height:110px;background-image:radial-gradient(circle,#0B5FA5 1.8px,transparent 2.5px);background-size:16px 16px;opacity:.35}
.orn .o-ring{position:absolute;width:150px;height:150px;border:1px solid rgba(7,27,51,.12);border-radius:50%;box-shadow:0 0 0 18px rgba(7,27,51,.02),0 0 0 38px rgba(255,213,74,.02)}
.orn .o-ring::before{content:"";position:absolute;inset:20px;border:1px dashed rgba(11,95,165,.16);border-radius:50%}
.orn .o-gold{position:absolute;width:48px;height:7px;border-radius:99px;background:linear-gradient(90deg,#FFD54A,#FFB300,#FF8A00);box-shadow:0 6px 18px rgba(255,179,0,.15);transform:rotate(-30deg)}
.orn .o-square{position:absolute;width:50px;height:50px;border:2px solid rgba(255,179,0,.28);transform:rotate(45deg)}
.orn .o-square::before{content:"";position:absolute;inset:8px;border:1px solid rgba(7,27,51,.15)}
.orn .o-corner{position:absolute;width:100px;height:100px;border-left:3px solid rgba(7,27,51,.1);border-bottom:3px solid rgba(7,27,51,.1)}
.orn .o-corner::after{content:"";position:absolute;left:16px;bottom:16px;width:40px;height:3px;background:#FFD54A;border-radius:99px}
.orn .o-wheat{position:absolute;font-size:clamp(4rem,12vw,10rem);color:rgba(111,175,69,.08);line-height:1;user-select:none;pointer-events:none}
.orn .o-hex{position:absolute;width:80px;height:80px;border:1.5px solid rgba(11,95,165,.12);clip-path:polygon(50% 0%,100% 25%,100% 75%,50% 100%,0% 75%,0% 25%)}
.orn .o-hex::after{content:"";position:absolute;inset:10px;border:1px solid rgba(255,213,74,.15);clip-path:polygon(50% 0%,100% 25%,100% 75%,50% 100%,0% 75%,0% 25%)}

/* ===== HERO ===== */
.history-page{background:#f7f9fc;color:#0d3a66;overflow:hidden}
.history-page *{box-sizing:border-box}
.history-shell{width:100%}
.history-hero{position:relative;min-height:78vh;display:flex;align-items:center;overflow:hidden;background:#fff;color:#0d3a66}
.history-hero::before{display:none}
.history-hero::after{content:"SEJARAH";position:absolute;z-index:0;left:-2%;top:50%;transform:translateY(-50%);font-family:var(--font-display);font-size:clamp(8rem,24vw,24rem);font-weight:900;line-height:.78;letter-spacing:.015em;color:rgba(13,58,102,.035);-webkit-text-stroke:1px rgba(255,122,0,.12);pointer-events:none;white-space:nowrap;user-select:none}
.history-hero-geometry{position:absolute;inset:0;z-index:1;pointer-events:none;overflow:hidden}
.history-hero-geometry svg{position:absolute;width:100%;height:100%;inset:0;display:block}
.history-hero-inner{position:relative;z-index:3;width:100%;max-width:1500px;margin:0 auto;padding:clamp(4rem,10vh,7rem) clamp(1.25rem,4vw,4.5rem) clamp(4rem,9vh,6rem);display:block}
.history-kicker{display:inline-flex;align-items:center;gap:.65rem;font-size:.72rem;font-weight:900;letter-spacing:.18em;text-transform:uppercase;color:#ff6f00;margin-bottom:1.05rem;padding:.55rem .85rem;border:1px solid rgba(255,111,0,.18);border-radius:999px;background:#fffaf5}
.history-kicker::before{content:"";width:9px;height:9px;border-radius:50%;background:#ff6f00;box-shadow:0 0 0 6px rgba(255,111,0,.10)}
.history-title{font-family:var(--font-display);font-size:clamp(4rem,10vw,9.2rem);line-height:.84;letter-spacing:-.035em;margin:0;max-width:1250px;text-transform:uppercase;text-shadow:none;animation:hdFadeUp .7s .1s var(--ease, ease) both}
.history-title .sejarah-white{color:#0d3a66;display:block}
.history-title .skaneda-gold{display:block;background:linear-gradient(135deg,#ff7a00 0%,#ff6a00 55%,#f4511e 100%);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:#ff6f00;text-shadow:none;letter-spacing:-.025em}
.history-lead{font-size:1rem;line-height:1.75;color:#52657a;max-width:720px;margin:1.7rem 0 0;animation:hdFadeUp .7s .26s var(--ease, ease) both}
.history-hero-meta{display:flex;gap:.7rem;flex-wrap:wrap;margin-top:1.6rem;animation:hdFadeUp .7s .4s var(--ease, ease) both}
.history-pill{display:inline-flex;align-items:center;gap:.5rem;padding:.55rem .85rem;border:1px solid rgba(13,58,102,.12);background:#fff;border-radius:999px;color:#0d3a66;font-size:.72rem;font-weight:800;box-shadow:0 8px 24px rgba(13,58,102,.06)}
.history-pill i{color:#ff7a00}
.hero-photo{display:none}
.hero-photo::before,.hero-photo img,.hero-photo-caption{display:none}
@keyframes hdFadeUp{from{opacity:0;transform:translateY(26px)}to{opacity:1;transform:none}}
.history-vt-cta{display:inline-flex;align-items:center;gap:.8rem;margin-top:1.7rem;padding:.8rem 1rem;border-radius:16px;text-decoration:none;color:#0d3a66;background:#fff;border:1px solid rgba(13,58,102,.12);box-shadow:0 12px 30px rgba(13,58,102,.08);transition:transform .3s ease,background .3s ease,border-color .3s ease,box-shadow .3s ease}
.history-vt-cta:hover{transform:translateY(-4px);background:#fffaf5;border-color:rgba(255,122,0,.28);box-shadow:0 18px 38px rgba(13,58,102,.12)}
.history-vt-icon{width:46px;height:46px;border-radius:14px;display:grid;place-items:center;background:linear-gradient(135deg,#ffd54a,#ff7a00);color:#0d3a66;font-size:.9rem}
.history-vt-cta strong{display:block;font-size:1rem;line-height:1.15;font-weight:900;letter-spacing:.01em}
.history-vt-cta small{display:block;margin-top:.25rem;color:#718096;font-size:.72rem;font-weight:600}
.history-vt-arrow{margin-left:.3rem;color:#ffd54a;font-size:1rem}
.history-wide{width:min(1380px,92%);margin:auto}
.history-intro{position:relative;padding:96px 0 110px;background:#fff}
.history-hero-inner{width:100%;max-width:1500px}
.history-title{max-width:1250px}
@media(max-width:700px){.history-hero{min-height:70vh}.history-hero-inner{padding-top:3.5rem;padding-bottom:4rem}.history-title{font-size:clamp(3.5rem,16vw,6rem);line-height:.88}.history-hero::after{font-size:clamp(7rem,32vw,12rem);left:-8%}}
.history-page{position:relative}
.history-hero,.history-intro,.timeline-section,.story-band,.mosaic-section,.future{position:relative;z-index:1}
.history-page{overflow:hidden}
.history-intro>*:not(.home-orn),
.timeline-section>*:not(.home-orn),
.story-band>*:not(.home-orn),
.mosaic-section>*:not(.home-orn),
.future>*:not(.home-orn){position:relative;z-index:2}
.history-hero > .home-orn{display:none}
.history-hero > .history-ref-ornaments{position:absolute!important;inset:0!important;z-index:1!important;overflow:hidden!important;pointer-events:none!important;opacity:1!important}
.history-ref-ornament-image{position:absolute!important;inset:0!important;width:100%!important;height:100%!important;display:block!important;object-fit:cover!important;object-position:center center!important;max-width:none!important;opacity:1!important}
.history-hero-inner{position:relative!important;z-index:4!important}
.history-title,.history-kicker,.history-vt-cta{position:relative!important;z-index:5!important}
@media(max-width:900px){.history-ref-ornament-image{object-position:center center!important;opacity:.88!important}}
@media(max-width:560px){.history-ref-ornament-image{object-position:center center!important;opacity:.62!important}}

/* Override khusus: watermark judul besar di background hero -> RPL (bukan SEJARAH) */
.aphp-page .history-hero::after{content:"RPL"!important}

/* ===== SECTION 1 — VIDEO PENGENALAN (HERO MINI) ===== */
.vid-section{position:relative;padding:80px 0 90px;isolation:isolate;background:linear-gradient(180deg,#F8FBFF 0%,#EEF5FB 100%);overflow:hidden}
.vid-section .orn{z-index:0}
.vid-section .orn .o-dots{left:3%;top:12%;opacity:.4}
.vid-section .orn .o-line{right:2%;top:18%;opacity:.5}
.vid-section .orn .o-ring{left:-40px;bottom:-30px;border-color:rgba(11,95,165,.14)}
.vid-section .orn .o-hex{right:6%;bottom:10%;border-color:rgba(255,179,0,.2)}
.vid-section .orn .o-wheat{left:2%;bottom:4%;font-size:clamp(4rem,10vw,8rem);color:rgba(111,175,69,.07);transform:rotate(-12deg)}
.vid-section .orn .o-flask{position:absolute;right:3%;top:8%;font-size:clamp(3rem,7vw,5.5rem);color:rgba(11,95,165,.06)}
.vid-section .orn .o-gold{left:38%;top:6%;width:34px;height:5px;opacity:.8}
.vid-wrap{width:min(1240px,92%);margin:auto;position:relative;z-index:2;display:grid;grid-template-columns:2fr 3fr;gap:clamp(2rem,4.5vw,4rem);align-items:center}
.vid-copy{position:relative}
.vid-copy .vc-eyebrow{display:flex;align-items:center;gap:.65rem;margin-bottom:1.1rem}
.vid-copy .vc-eyebrow .vc-num{font-family:var(--font-display);font-size:.85rem;font-weight:900;letter-spacing:.18em;color:#FF8A00}
.vid-copy .vc-eyebrow .vc-line{width:28px;height:3px;border-radius:99px;background:linear-gradient(90deg,#FFD54A,#FF8A00)}
.vid-copy .vc-eyebrow .vc-label{font-size:.68rem;font-weight:800;letter-spacing:.18em;text-transform:uppercase;color:#5f7186}
.vid-copy h2{font-family:var(--font-display);font-size:clamp(2.2rem,4.6vw,3.9rem);line-height:1.02;font-weight:900;color:#0d3a66;margin:0 0 1rem;letter-spacing:.01em}
.vid-copy h2 .t-gold{background:linear-gradient(135deg,#FFD54A 0%,#FFB300 45%,#FF8A00 100%);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}
.vid-copy .vc-desc{color:#5f7186;line-height:1.8;font-size:.95rem;max-width:520px;margin:0 0 1.4rem}
.vid-cards{display:grid;grid-template-columns:repeat(3,1fr);gap:.7rem}
.vid-card{display:flex;flex-direction:column;gap:.45rem;background:rgba(255,255,255,.8);border:1px solid rgba(7,27,51,.08);border-radius:14px;padding:.85rem;transition:transform .3s ease,border-color .3s ease,box-shadow .3s ease}
.vid-card:hover{transform:translateY(-4px);border-color:rgba(255,138,0,.35);box-shadow:0 14px 30px rgba(7,27,51,.08)}
.vid-card .vc-ic{width:40px;height:40px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:.95rem;color:#fff;background:linear-gradient(135deg,#0d3a66,#0B5FA5);transition:transform .3s ease}
.vid-card:hover .vc-ic{transform:scale(1.08)}
.vid-card .vc-ic.green{background:linear-gradient(135deg,#6FAF45,#8BC34A)}
.vid-card .vc-ic.gold{background:linear-gradient(135deg,#FFD54A,#FF8A00);color:#0d3a66}
.vid-card b{font-size:.72rem;font-weight:800;color:#0d3a66;line-height:1.25}
.vid-card span{font-size:.62rem;line-height:1.5;color:#718396}
.vid-stage{position:relative}
.vid-stage::before{content:"";position:absolute;top:-12px;left:-12px;width:52px;height:2px;background:linear-gradient(90deg,#FFD54A,#FF8A00);border-radius:99px;z-index:3}
.vid-stage::after{content:"";position:absolute;bottom:-12px;right:-12px;width:34px;height:2px;background:linear-gradient(90deg,#0B5FA5,#28A9E1);border-radius:99px;z-index:3}
.vid-side{position:absolute;right:-34px;top:50%;transform:translateY(-50%);writing-mode:vertical-rl;font-size:.6rem;font-weight:800;letter-spacing:.32em;text-transform:uppercase;color:rgba(7,27,51,.35);z-index:3;pointer-events:none}
.vid-player{position:relative;border-radius:28px;overflow:hidden;box-shadow:0 30px 80px rgba(7,27,51,.2);background:linear-gradient(135deg,#0d3a66,#0B5FA5);aspect-ratio:16/9;display:flex;align-items:center;justify-content:center;cursor:pointer;border:1px solid rgba(255,255,255,.15);transition:transform .35s ease,box-shadow .35s ease}
.vid-player:hover{transform:translateY(-6px);box-shadow:0 40px 90px rgba(7,27,51,.28)}
.vid-bg{position:absolute;inset:0;background:radial-gradient(circle at 78% 22%,rgba(40,169,225,.28) 0%,transparent 42%),radial-gradient(circle at 20% 82%,rgba(111,175,69,.16) 0%,transparent 40%),linear-gradient(135deg,#0d3a66 0%,#0a2a4e 55%,#0B5FA5 100%)}
.vid-bg::before{content:"";position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,.045) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.045) 1px,transparent 1px);background-size:34px 34px;opacity:.55}
.vid-bg::after{content:"";position:absolute;inset:0;background-image:radial-gradient(circle,rgba(255,213,74,.14) 1.5px,transparent 2px);background-size:26px 26px;opacity:.5}
.vid-ring{position:absolute;right:-30px;top:-30px;width:150px;height:150px;border:1px solid rgba(255,213,74,.18);border-radius:50%;z-index:1}
.vid-ring::before{content:"";position:absolute;inset:18px;border:1px dashed rgba(255,255,255,.14);border-radius:50%}
.vid-ring::after{content:"";position:absolute;inset:40px;border:1px solid rgba(40,169,225,.22);border-radius:50%}
.vid-hex{position:absolute;left:-22px;bottom:26%;width:74px;height:74px;border:1px solid rgba(255,255,255,.14);clip-path:polygon(50% 0%,100% 25%,100% 75%,50% 100%,0% 75%,0% 25%);opacity:.6;z-index:1}
.vid-hex::after{content:"";position:absolute;inset:8px;border:1px solid rgba(255,213,74,.22);clip-path:polygon(50% 0%,100% 25%,100% 75%,50% 100%,0% 75%,0% 25%)}
.vid-diag{position:absolute;right:12%;bottom:14%;width:120px;height:1px;background:linear-gradient(90deg,transparent,rgba(255,213,74,.5));transform:rotate(-24deg);z-index:1}
.vid-player::after{content:"";position:absolute;inset:0;background:linear-gradient(180deg,transparent 45%,rgba(7,27,51,.72));z-index:1}
.vid-play{position:relative;z-index:2;width:82px;height:82px;border-radius:50%;background:linear-gradient(135deg,#FFD54A,#FFB300 50%,#FF8A00);display:flex;align-items:center;justify-content:center;font-size:1.7rem;color:#0d3a66;box-shadow:0 15px 40px rgba(255,138,0,.35),inset 0 0 0 6px rgba(7,27,51,.08);transition:transform .35s ease,box-shadow .35s ease}
.vid-player:hover .vid-play{transform:scale(1.08);box-shadow:0 20px 46px rgba(255,138,0,.45)}
.vid-player .vid-label{position:absolute;bottom:14px;left:14px;z-index:2;display:inline-flex;align-items:center;gap:.4rem;font-size:.58rem;font-weight:900;letter-spacing:.14em;text-transform:uppercase;color:#FFD54A;background:rgba(7,27,51,.75);padding:.42rem .75rem;border-radius:999px;backdrop-filter:blur(8px);border:1px solid rgba(255,213,74,.25)}
.vid-player .vid-brand{position:absolute;top:12px;right:14px;z-index:2;text-align:right;line-height:1.15}
.vid-player .vid-brand b{display:block;font-family:var(--font-display);font-size:.78rem;font-weight:900;letter-spacing:.1em;color:#FFD54A}
.vid-player .vid-brand span{font-size:.5rem;font-weight:800;letter-spacing:.22em;color:rgba(248,251,255,.65);text-transform:uppercase}
.vid-player .vid-preview{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center center;z-index:0;background:#071b33}
.vid-player .vid-preview::-webkit-media-controls{display:none!important}
.vid-player .vid-bg{z-index:0;opacity:.08}
.vid-player .vid-preview + .vid-bg{pointer-events:none}
.dkv-kicker i{font-size:.8rem;color:#6FAF45}
.fcta-copy h3 i{color:#FFD54A;margin-right:.4rem;font-size:1.1em;vertical-align:-2px}
@media(max-width:1050px){.vid-wrap{grid-template-columns:1fr;gap:2.6rem}.vid-cards{grid-template-columns:repeat(3,1fr)}.vid-side{display:none}.vid-stage::before,.vid-stage::after{display:none}}
@media(max-width:760px){.vid-cards{grid-template-columns:1fr}.vid-copy h2{font-size:clamp(1.9rem,7vw,2.6rem)}.vid-play{width:66px;height:66px;font-size:1.35rem}.vid-ring{width:110px;height:110px;right:-18px;top:-18px}.vid-section{padding:64px 0 72px}}

/* ===== SECTION 2 — TENTANG RPL ===== */
.tentang-section{position:relative;overflow:hidden;background:linear-gradient(135deg,#f8fbff 0%,#eef5fb 55%,#e7f1f8 100%);padding-top:88px;padding-bottom:100px}
.tentang-section::before{content:"";position:absolute;inset:0;pointer-events:none;background-image:linear-gradient(rgba(11,95,165,.035) 1px,transparent 1px),linear-gradient(90deg,rgba(11,95,165,.035) 1px,transparent 1px);background-size:54px 54px;mask-image:linear-gradient(90deg,black,transparent 82%)}
.tentang-section::after{content:"RPL";position:absolute;right:-5%;bottom:-10%;font-family:var(--font-display);font-size:clamp(10rem,25vw,22rem);font-weight:900;line-height:.8;letter-spacing:-.04em;color:rgba(7,27,51,.025);pointer-events:none}
.tentang-section .orn{z-index:0}
.tentang-section .orn .o-chevron{right:-100px;top:-110px;transform:rotate(45deg);border-color:rgba(11,95,165,.08)}
.tentang-section .orn .o-dots{left:2%;bottom:9%;opacity:.28}
.tentang-section .orn .o-line{right:5%;top:9%;opacity:.35}
.tentang-section .orn .o-ring{left:-45px;top:30%;border-color:rgba(11,95,165,.09)}
.tentang-section .orn .o-square{right:10%;bottom:7%;border-color:rgba(255,179,0,.16)}
.tentang-section .orn .o-gold{left:48%;top:8%;width:34px;height:5px}
.tentang-grid{display:grid;grid-template-columns:minmax(0,1.02fr) minmax(440px,.98fr);gap:clamp(3rem,5vw,5.5rem);align-items:center}
.tentang-copy{position:relative;z-index:3;max-width:650px}
.tentang-copy .tc-top{display:flex;align-items:center;gap:.75rem;margin-bottom:1.05rem}
.tentang-copy .tc-num{font-family:var(--font-display);font-size:.78rem;font-weight:900;letter-spacing:.2em;color:#FF8A00;line-height:1}
.tentang-copy .tc-line{width:30px;height:3px;border-radius:99px;background:linear-gradient(90deg,#FFD54A,#FF8A00)}
.tentang-copy .tc-label{font-size:.68rem;font-weight:850;letter-spacing:.18em;text-transform:uppercase;color:#60748a}
.tentang-copy h2{font-size:clamp(2.5rem,4.5vw,4.45rem);line-height:.96;letter-spacing:-.025em;margin:0 0 1.35rem;max-width:720px}
.tentang-copy h2 span{display:inline;background:linear-gradient(135deg,#FFD54A 0%,#FFB300 48%,#FF8A00 100%);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}
.tentang-copy .tc-lead{font-size:1.02rem;line-height:1.85;color:#526a82;margin:0;max-width:620px}
.tentang-copy .tc-lead strong{color:#0d3a66;font-weight:850}
.tentang-copy .tc-sub{font-size:.91rem;line-height:1.78;color:#718399;margin:.9rem 0 0;max-width:620px}
.tentang-mini{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:.8rem;margin-top:1.7rem;max-width:650px}
.tentang-mini-card{position:relative;display:flex;align-items:center;gap:.72rem;padding:.78rem .9rem;border-radius:15px;background:rgba(255,255,255,.86);border:1px solid rgba(7,27,51,.08);box-shadow:0 10px 25px rgba(7,27,51,.045);transition:transform .3s ease,border-color .3s ease,box-shadow .3s ease;background-clip:padding-box}
.tentang-mini-card::after{content:"";position:absolute;left:0;bottom:0;width:0;height:2px;border-radius:99px;background:linear-gradient(90deg,#FFD54A,#FF8A00);transition:width .3s ease}
.tentang-mini-card:hover{transform:translateY(-5px);border-color:rgba(11,95,165,.18);box-shadow:0 18px 34px rgba(7,27,51,.09)}
.tentang-mini-card:hover::after{width:100%}
.tentang-mini-card .tm-ic{flex:0 0 38px;width:38px;height:38px;border-radius:11px;display:flex;align-items:center;justify-content:center;font-size:.82rem;color:#fff;background:linear-gradient(135deg,#0d3a66,#0B5FA5);box-shadow:0 8px 18px rgba(11,95,165,.16);transition:transform .3s ease}
.tentang-mini-card:hover .tm-ic{transform:scale(1.08) rotate(-4deg)}
.tentang-mini-card .tm-ic.green{background:linear-gradient(135deg,#6FAF45,#8BC34A)}
.tentang-mini-card .tm-ic.gold{background:linear-gradient(135deg,#FFD54A,#FF8A00);color:#0d3a66}
.tentang-mini-card span{font-size:.7rem;font-weight:750;color:#102941;line-height:1.35}
.tentang-visual{position:relative;min-height:500px;display:flex;align-items:center;justify-content:center;z-index:3}
.tentang-visual::before{content:"";position:absolute;width:88%;height:88%;right:-3%;top:6%;border:1px solid rgba(255,179,0,.2);border-radius:30px;transform:rotate(2deg);pointer-events:none}
.tentang-visual::after{content:"";position:absolute;width:82%;height:82%;right:3%;top:9%;border:1px dashed rgba(11,95,165,.16);border-radius:30px;transform:rotate(-2deg);pointer-events:none}
.tv-panel{position:relative;width:min(100%,560px);min-height:470px;border-radius:30px;overflow:hidden;background:radial-gradient(circle at 78% 18%,rgba(40,169,225,.28),transparent 28%),radial-gradient(circle at 20% 85%,rgba(255,213,74,.13),transparent 30%),linear-gradient(145deg,#06192e 0%,#092f56 52%,#0b5fa5 100%);box-shadow:0 30px 70px rgba(7,27,51,.22);border:1px solid rgba(255,255,255,.13)}
.tv-panel::before{content:"";position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,.045) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.045) 1px,transparent 1px);background-size:34px 34px;opacity:.45}
.tv-panel::after{content:"";position:absolute;width:260px;height:260px;right:-95px;top:-95px;border:1px solid rgba(255,213,74,.2);border-radius:50%;box-shadow:0 0 0 22px rgba(255,213,74,.025),0 0 0 48px rgba(255,255,255,.018)}
.tv-top{position:relative;z-index:2;display:flex;align-items:center;justify-content:space-between;padding:1.25rem 1.35rem;border-bottom:1px solid rgba(255,255,255,.1)}
.tv-top-label{display:flex;align-items:center;gap:.6rem;color:#fff;font-size:.68rem;font-weight:850;letter-spacing:.16em;text-transform:uppercase}
.tv-top-label i{color:#FFD54A}
.tv-top-code{font-family:var(--font-display);font-size:.72rem;font-weight:900;letter-spacing:.16em;color:rgba(255,255,255,.42)}
.tv-center{position:relative;z-index:2;display:flex;justify-content:center;align-items:center;padding:1.2rem 1.4rem .8rem}
.tv-core{position:relative;width:160px;height:160px;border-radius:50%;display:flex;flex-direction:column;align-items:center;justify-content:center;background:radial-gradient(circle,#0d477b 0%,#092744 70%);border:1px solid rgba(255,255,255,.18);box-shadow:0 0 0 14px rgba(255,255,255,.025),0 0 0 30px rgba(255,213,74,.025)}
.tv-core::before{content:"";position:absolute;inset:-16px;border:1px dashed rgba(255,213,74,.3);border-radius:50%;animation:tvSpin 22s linear infinite}
.tv-core::after{content:"";position:absolute;inset:-31px;border:1px solid rgba(40,169,225,.15);border-radius:50%}
.tv-core i{font-size:1.45rem;color:#FFD54A;margin-bottom:.35rem}
.tv-core strong{font-family:var(--font-display);font-size:1.8rem;line-height:1;color:#fff;letter-spacing:.04em}
.tv-core small{margin-top:.35rem;color:rgba(255,255,255,.55);font-size:.52rem;letter-spacing:.2em;text-transform:uppercase}
@keyframes tvSpin{to{transform:rotate(360deg)}}
.tv-flow{position:relative;z-index:3;display:grid;grid-template-columns:1fr 1fr;gap:.75rem;padding:1.25rem 1.35rem 1.45rem}
.tv-step{position:relative;display:flex;align-items:center;gap:.75rem;min-height:67px;padding:.7rem .8rem;border:1px solid rgba(255,255,255,.13);border-radius:15px;background:rgba(255,255,255,.065);backdrop-filter:blur(10px);transition:transform .3s ease,background .3s ease,border-color .3s ease}
.tv-step:hover{transform:translateY(-5px);background:rgba(255,255,255,.11);border-color:rgba(255,213,74,.32)}
.tv-step .ts-ic{flex:0 0 36px;width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:.8rem;color:#0d3a66;background:linear-gradient(135deg,#FFD54A,#FFB300);box-shadow:0 7px 16px rgba(255,179,0,.2)}
.tv-step .ts-ic.green{background:linear-gradient(135deg,#6FAF45,#8BC34A);color:#fff}
.tv-step .ts-ic.blue{background:linear-gradient(135deg,#0B5FA5,#28A9E1);color:#fff}
.tv-step .ts-ic.gold{background:linear-gradient(135deg,#FFD54A,#FF8A00);color:#0d3a66}
.tv-step .ts-copy{display:flex;flex-direction:column;gap:.18rem;min-width:0}
.tv-step .ts-copy strong{font-size:.72rem;color:#fff;font-weight:800;line-height:1.2}
.tv-step .ts-copy small{font-size:.57rem;color:rgba(255,255,255,.48);line-height:1.25}
.tv-step .tv-arrow{margin-left:auto;color:rgba(255,213,74,.7);font-size:.72rem;transition:transform .3s ease}
.tv-step:hover .tv-arrow{transform:translateX(4px);color:#FFD54A}
.tv-bottom{position:absolute;left:1.35rem;right:1.35rem;bottom:1rem;z-index:3;display:flex;align-items:center;justify-content:space-between;gap:1rem}
.tv-bottom span{font-size:.58rem;letter-spacing:.14em;text-transform:uppercase;color:rgba(255,255,255,.38)}
.tv-status{display:inline-flex;align-items:center;gap:.45rem;color:#fff;font-size:.58rem;letter-spacing:.12em;text-transform:uppercase}
.tv-status i{font-size:.45rem;color:#6FAF45}
@media(max-width:1050px){.tentang-grid{grid-template-columns:1fr;gap:2.8rem}.tentang-copy{max-width:760px}.tentang-visual{min-height:460px}.tv-panel{width:min(100%,680px)}}
@media(max-width:760px){.tentang-section{padding-top:72px;padding-bottom:80px}.tentang-copy .tc-top{margin-bottom:.9rem}.tentang-copy h2{font-size:clamp(2.25rem,10vw,3.2rem)}.tentang-copy .tc-lead{font-size:.94rem}.tentang-mini{grid-template-columns:1fr}.tentang-visual{min-height:430px}.tentang-visual::before,.tentang-visual::after{display:none}.tv-panel{min-height:420px;border-radius:24px}.tv-core{width:130px;height:130px}.tv-core strong{font-size:1.55rem}.tv-flow{grid-template-columns:1fr;padding:1rem}.tv-step{min-height:58px}.tv-bottom{left:1rem;right:1rem}.tv-top{padding:1rem}.tentang-section::after{font-size:8rem;right:-8%;bottom:0}}

/* ===== SECTION 4 — PEMBELAJARAN 6 KARTU ===== */
.belajar-section{background:linear-gradient(180deg,#eef5fb 0%,#f8fbff 100%)}
.belajar-head{width:min(860px,92%);margin:0 auto 56px;text-align:center}
.belajar-head .eyebrow{justify-content:center}
.belajar-head .eyebrow::before{display:none}
.belajar-head .eyebrow::after{content:"";width:24px;height:3px;border-radius:99px;background:linear-gradient(90deg,#FFD54A,#FF8A00)}
.belajar-head p{margin:.8rem auto 0;max-width:600px;color:#5f7186;font-size:.95rem;line-height:1.85}
.belajar-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.2rem;width:min(1200px,94%);margin:auto}
.belajar-card{position:relative;padding:1.8rem 1.5rem;border-radius:22px;background:#fff;border:1px solid rgba(7,27,51,.1);overflow:hidden;transition:transform .35s ease,border-color .35s ease,box-shadow .35s ease}
.belajar-card:hover{transform:translateY(-8px);border-color:rgba(255,179,0,.35);box-shadow:0 24px 50px rgba(7,27,51,.1)}
.belajar-card::after{content:attr(data-num);position:absolute;right:10px;bottom:-16px;font-family:var(--font-display);font-size:4.2rem;font-weight:900;line-height:1;color:rgba(7,27,51,.04);pointer-events:none}
.belajar-card .bc-ic{width:50px;height:50px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.1rem;color:#fff;background:linear-gradient(135deg,#0d3a66,#0B5FA5);margin-bottom:.8rem;transition:transform .35s ease}
.belajar-card:hover .bc-ic{transform:rotate(-6deg) scale(1.08)}
.belajar-card .bc-ic.green{background:linear-gradient(135deg,#6FAF45,#8BC34A)}
.belajar-card .bc-ic.gold{background:linear-gradient(135deg,#FFD54A,#FF8A00);color:#0d3a66}
.belajar-card .bc-ic.blue{background:linear-gradient(135deg,#0B5FA5,#28A9E1)}
.belajar-card h4{font-family:var(--font-display);font-size:1rem;font-weight:800;color:#0d3a66;margin:0 0 .35rem}
.belajar-card p{font-size:.78rem;line-height:1.7;color:#718396;margin:0}
.belajar-card .bc-arrow{display:inline-flex;align-items:center;gap:.35rem;margin-top:.7rem;font-size:.7rem;font-weight:800;color:#FF8A00;text-transform:uppercase;letter-spacing:.08em}
.belajar-card .bc-arrow i{transition:transform .25s ease}
.belajar-card:hover .bc-arrow i{transform:translateX(5px)}
@media(max-width:1050px){.belajar-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:640px){.belajar-grid{grid-template-columns:1fr}}

/* ===== SECTION 5 — PRAKTIK ===== */
.praktik-section{background:#fff}
.praktik-head{width:min(860px,92%);margin:0 auto 56px;text-align:center}
.praktik-head .eyebrow{justify-content:center}
.praktik-head .eyebrow::before{display:none}
.praktik-head .eyebrow::after{content:"";width:24px;height:3px;border-radius:99px;background:linear-gradient(90deg,#FFD54A,#FF8A00)}
.praktik-head p{margin:.8rem auto 0;max-width:600px;color:#5f7186;font-size:.95rem;line-height:1.85}
.praktik-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.4rem;width:min(1200px,94%);margin:auto}
.praktik-card{position:relative;border-radius:22px;overflow:hidden;min-height:380px;display:flex;align-items:flex-end;isolation:isolate;transition:transform .35s ease,box-shadow .35s ease}
.praktik-card:hover{transform:translateY(-8px);box-shadow:0 30px 66px rgba(7,27,51,.25)}
.praktik-card img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0;transition:transform .6s ease}
.praktik-card:hover img{transform:scale(1.06)}
.praktik-card::after{content:"";position:absolute;inset:0;z-index:1;background:linear-gradient(190deg,rgba(7,27,51,0) 30%,rgba(7,27,51,.92) 100%)}
.praktik-card .pc-badge{position:absolute;top:14px;left:14px;z-index:3;display:inline-flex;align-items:center;gap:.4rem;font-size:.6rem;font-weight:900;letter-spacing:.12em;text-transform:uppercase;color:#0d3a66;background:linear-gradient(135deg,#FFD54A,#FFB300);padding:.35rem .7rem;border-radius:999px}
.praktik-card .pc-body{position:relative;z-index:2;padding:1.4rem}
.praktik-card .pc-body h4{font-family:var(--font-display);font-size:1.2rem;font-weight:800;color:#fff;margin:0 0 .25rem}
.praktik-card .pc-body p{font-size:.78rem;line-height:1.7;color:rgba(248,251,255,.85);margin:0;max-width:380px}
@media(max-width:1050px){.praktik-grid{grid-template-columns:1fr 1fr}}
@media(max-width:640px){.praktik-grid{grid-template-columns:1fr}}

/* ===== SECTION 6 — FASILITAS ===== */
.fasilitas-section{background:linear-gradient(180deg,#f8fbff 0%,#eef5fb 100%)}
.fasilitas-head{width:min(860px,92%);margin:0 auto 56px;text-align:center}
.fasilitas-head .eyebrow{justify-content:center}
.fasilitas-head .eyebrow::before{display:none}
.fasilitas-head .eyebrow::after{content:"";width:24px;height:3px;border-radius:99px;background:linear-gradient(90deg,#FFD54A,#FF8A00)}
.fasilitas-head p{margin:.8rem auto 0;max-width:600px;color:#5f7186;font-size:.95rem;line-height:1.85}
.fasilitas-grid{display:grid;grid-template-columns:1fr;gap:1.2rem;width:min(520px,92%);margin:0 auto 2rem}
.fasilitas-card{position:relative;padding:2.4rem 2rem;border-radius:22px;background:#fff;border:1px solid rgba(7,27,51,.1);text-align:center;transition:transform .35s ease,border-color .35s ease,box-shadow .35s ease}
.fasilitas-card:hover{transform:translateY(-6px);border-color:rgba(11,95,165,.35);box-shadow:0 20px 44px rgba(7,27,51,.08)}
.fasilitas-card .fc-ic{width:54px;height:54px;margin:0 auto .7rem;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.15rem;color:#fff;background:linear-gradient(135deg,#0d3a66,#0B5FA5);transition:transform .35s ease}
.fasilitas-card:hover .fc-ic{transform:scale(1.1) rotate(-5deg)}
.fasilitas-card .fc-ic.green{background:linear-gradient(135deg,#6FAF45,#8BC34A)}
.fasilitas-card .fc-ic.gold{background:linear-gradient(135deg,#FFD54A,#FF8A00);color:#0d3a66}
.fasilitas-card h4{font-family:var(--font-display);font-size:.95rem;font-weight:800;color:#0d3a66;margin:0 0 .25rem}
.fasilitas-card p{font-size:.75rem;line-height:1.65;color:#718396;margin:0}
.fasilitas-cta{width:min(1200px,94%);margin:0 auto;border-radius:24px;overflow:hidden;background:linear-gradient(135deg,#0d3a66 0%,#0B5FA5 100%);padding:2.4rem 2.8rem;display:flex;align-items:center;justify-content:space-between;gap:2rem;transition:transform .35s ease,box-shadow .35s ease}
.fasilitas-cta:hover{transform:translateY(-5px);box-shadow:0 30px 66px rgba(7,27,51,.3)}
.fasilitas-cta .fcta-copy h3{font-family:var(--font-display);font-size:clamp(1.2rem,2.4vw,1.8rem);font-weight:800;color:#fff;margin:0 0 .3rem}
.fasilitas-cta .fcta-copy h3 span{color:#FFD54A}
.fasilitas-cta .fcta-copy p{color:rgba(248,251,255,.75);font-size:.85rem;margin:0;line-height:1.7}
.fasilitas-cta .fcta-btn{display:inline-flex;align-items:center;gap:.55rem;padding:.85rem 1.6rem;border-radius:999px;background:linear-gradient(135deg,#FFD54A,#FFB300,#FF8A00);color:#0d3a66;font-weight:800;font-size:.85rem;text-decoration:none;white-space:nowrap;box-shadow:0 16px 34px rgba(255,138,0,.35);transition:transform .3s ease,box-shadow .3s ease}
.fasilitas-cta .fcta-btn:hover{transform:translateY(-4px);box-shadow:0 20px 40px rgba(255,138,0,.5)}
.fasilitas-cta .fcta-btn i{transition:transform .3s ease}
.fasilitas-cta .fcta-btn:hover i{transform:translateX(5px)}
@media(max-width:1050px){.fasilitas-cta{flex-direction:column;text-align:center;padding:2rem}}

/* ===== SECTION 7 — KARYA SISWA ===== */
.produk-section{background:#fff}
.produk-head{width:min(1320px,92%);margin:0 auto 48px;display:flex;justify-content:space-between;align-items:end;gap:2rem}
.produk-note{max-width:320px;color:#718396;font-size:.78rem;line-height:1.7;text-align:right}
.produk-slider{position:relative;width:min(1320px,94%);margin:auto}
.produk-viewport{overflow:hidden;border-radius:24px}
.produk-track{display:flex;gap:1.2rem;transition:transform .5s cubic-bezier(.4,0,.2,1)}
.produk-card{position:relative;flex:0 0 calc(33.333% - .8rem);background:#fff;border:1px solid rgba(7,27,51,.1);border-radius:22px;overflow:hidden;box-shadow:0 20px 44px rgba(7,27,51,.08);transition:transform .3s ease,box-shadow .3s ease}
.produk-card:hover{transform:translateY(-8px);box-shadow:0 28px 60px rgba(7,27,51,.15)}
.produk-photo{position:relative;aspect-ratio:4/3;overflow:hidden;background:linear-gradient(135deg,#0d3a66,#0B5FA5)}
.produk-photo img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .55s ease}
.produk-card:hover .produk-photo img{transform:scale(1.07)}
.produk-photo::after{content:"";position:absolute;inset:0;background:linear-gradient(180deg,transparent 45%,rgba(7,27,51,.75))}
.produk-badge{position:absolute;top:12px;left:12px;z-index:2;font-size:.58rem;font-weight:900;letter-spacing:.08em;text-transform:uppercase;color:#b26a00;background:linear-gradient(135deg,#fff7e0,#ffe9b8);border:1px solid rgba(255,179,0,.35);padding:.35rem .7rem;border-radius:999px}
.produk-card .pc-body{padding:1.1rem 1.2rem 1.2rem}
.produk-card .pc-body h3{font-family:var(--font-display);font-size:1.05rem;font-weight:800;color:#0d3a66;margin:0 0 .2rem}
.produk-card .pc-body p{font-size:.75rem;line-height:1.65;color:#718396;margin:0 0 .5rem}
.produk-card .pc-foot{display:flex;align-items:center;justify-content:space-between;font-size:.65rem;font-weight:800;color:#FF8A00;text-transform:uppercase;letter-spacing:.08em}
.produk-arrow{position:absolute;top:50%;translate:0 -50%;width:48px;height:48px;border-radius:50%;background:#0d3a66;border:none;display:flex;align-items:center;justify-content:center;color:#fff;font-size:1rem;cursor:pointer;z-index:6;box-shadow:0 10px 22px rgba(7,27,51,.35);transition:background .25s ease,transform .25s ease,opacity .25s ease}
.produk-arrow:hover{background:#FFB300;transform:translateY(-50%) scale(1.08)}
.produk-arrow.prev{left:-24px}
.produk-arrow.next{right:-24px}
.produk-arrow:disabled{opacity:.3;cursor:default;pointer-events:none}
.produk-dots{display:flex;justify-content:center;gap:.45rem;margin-top:1.6rem}
.produk-dots button{width:8px;height:8px;border-radius:50%;border:none;background:rgba(7,27,51,.18);cursor:pointer;padding:0;transition:background .25s ease,width .25s ease}
.produk-dots button.active{background:#FFB300;width:24px;border-radius:5px}
.produk-dots.hidden{display:none}
@media(max-width:1050px){.produk-card{flex-basis:calc(50% - .6rem)}}
@media(max-width:640px){.produk-card{flex-basis:100%}}

/* ===== SECTION 8 — KEGIATAN & PRESTASI ===== */
.kegiatan-section{background:linear-gradient(180deg,#eef5fb 0%,#f8fbff 100%)}
.kegiatan-head{width:min(860px,92%);margin:0 auto 56px;text-align:center}
.kegiatan-head .eyebrow{justify-content:center}
.kegiatan-head .eyebrow::before{display:none}
.kegiatan-head .eyebrow::after{content:"";width:24px;height:3px;border-radius:99px;background:linear-gradient(90deg,#FFD54A,#FF8A00)}
.kegiatan-head p{margin:.8rem auto 0;max-width:600px;color:#5f7186;font-size:.95rem;line-height:1.85}
.kegiatan-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.2rem;width:min(1200px,94%);margin:auto}
.kegiatan-card{position:relative;border-radius:20px;overflow:hidden;min-height:280px;display:flex;align-items:flex-end;isolation:isolate;transition:transform .35s ease,box-shadow .35s ease}
.kegiatan-card:hover{transform:translateY(-6px);box-shadow:0 24px 50px rgba(7,27,51,.2)}
.kegiatan-card img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0;transition:transform .6s ease}
.kegiatan-card:hover img{transform:scale(1.06)}
.kegiatan-card::after{content:"";position:absolute;inset:0;z-index:1;background:linear-gradient(190deg,rgba(7,27,51,0) 20%,rgba(7,27,51,.88) 100%)}
.kegiatan-card .kg-badge{position:absolute;top:12px;left:12px;z-index:3;display:inline-flex;align-items:center;gap:.35rem;font-size:.55rem;font-weight:900;letter-spacing:.1em;text-transform:uppercase;color:#fff;background:rgba(7,27,51,.5);border:1px solid rgba(255,255,255,.2);padding:.3rem .6rem;border-radius:999px;backdrop-filter:blur(4px)}
.kegiatan-card .kg-badge i{color:#FFD54A}
.kegiatan-card .kg-body{position:relative;z-index:2;padding:1.2rem}
.kegiatan-card .kg-body h4{font-family:var(--font-display);font-size:.95rem;font-weight:800;color:#fff;margin:0 0 .15rem}
.kegiatan-card .kg-body span{font-size:.65rem;color:rgba(248,251,255,.7)}
.kegiatan-card.tall{grid-row:span 2;min-height:580px}
.kegiatan-card.tall .kg-body h4{font-size:1.2rem}
@media(max-width:1050px){.kegiatan-grid{grid-template-columns:1fr 1fr}.kegiatan-card.tall{min-height:360px}}
@media(max-width:640px){.kegiatan-grid{grid-template-columns:1fr}}

/* ===== SECTION 9 — PROSPEK LULUSAN ===== */
.prospek-section{background:#fff}
.prospek-head{width:min(860px,92%);margin:0 auto 56px;text-align:center}
.prospek-head .eyebrow{justify-content:center}
.prospek-head .eyebrow::before{display:none}
.prospek-head .eyebrow::after{content:"";width:24px;height:3px;border-radius:99px;background:linear-gradient(90deg,#FFD54A,#FF8A00)}
.prospek-head p{margin:.8rem auto 0;max-width:600px;color:#5f7186;font-size:.95rem;line-height:1.85}
.prospek-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.4rem;width:min(1160px,92%);margin:auto}
.prospek-card{position:relative;border-radius:24px;overflow:hidden;background:#f8fbff;border:1px solid rgba(7,27,51,.1);min-height:400px;display:flex;flex-direction:column;transition:transform .35s ease,box-shadow .35s ease}
.prospek-card:hover{transform:translateY(-10px);box-shadow:0 30px 66px rgba(7,27,51,.14)}
.prospek-card .ps-photo{position:relative;height:180px;overflow:hidden}
.prospek-card .ps-photo img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .6s ease}
.prospek-card:hover .ps-photo img{transform:scale(1.08)}
.prospek-card .ps-photo::after{content:"";position:absolute;inset:0;background:linear-gradient(180deg,transparent 40%,rgba(7,27,51,.6))}
.prospek-card .ps-photo .ps-num{position:absolute;right:12px;top:10px;z-index:2;font-family:var(--font-display);font-size:.72rem;font-weight:900;letter-spacing:.08em;color:#fff;background:rgba(7,27,51,.55);padding:.3rem .55rem;border-radius:8px;backdrop-filter:blur(6px)}
.prospek-card .ps-photo i{position:absolute;left:14px;bottom:10px;z-index:2;width:42px;height:42px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:.95rem;color:#0d3a66;background:linear-gradient(135deg,#FFD54A,#FFB300);box-shadow:0 8px 20px rgba(7,27,51,.3)}
.prospek-card .ps-photo i.green{background:linear-gradient(135deg,#6FAF45,#8BC34A);color:#fff}
.prospek-card .ps-photo i.blue{background:linear-gradient(135deg,#0B5FA5,#28A9E1);color:#fff}
.prospek-card .ps-body{padding:1.3rem 1.4rem 1.5rem;flex:1;display:flex;flex-direction:column}
.prospek-card .ps-body h4{font-family:var(--font-display);font-size:1.25rem;font-weight:900;color:#0d3a66;margin:0 0 .4rem}
.prospek-card .ps-body p{font-size:.8rem;line-height:1.7;color:#718396;margin:0 0 .8rem;flex:1}
.prospek-card .ps-body .ps-tags{display:flex;flex-wrap:wrap;gap:.4rem}
.prospek-card .ps-body .ps-tags span{font-size:.62rem;font-weight:700;color:#0d3a66;background:rgba(11,95,165,.1);padding:.25rem .6rem;border-radius:999px}
@media(max-width:1050px){.prospek-grid{grid-template-columns:1fr 1fr}}
@media(max-width:640px){.prospek-grid{grid-template-columns:1fr}}

/* ===== SECTION 11 — FINAL CTA ===== */
.aphp-cta{position:relative;width:min(1180px,94%);margin:20px auto 80px;padding:58px 2.5rem 62px;border-radius:28px;overflow:hidden;text-align:center;isolation:isolate;background:linear-gradient(135deg,#0d3a66 0%,#0a2a4e 50%,#0B5FA5 100%);box-shadow:0 30px 70px rgba(7,27,51,.28)}
.aphp-cta .cta-bg{position:absolute;inset:0;z-index:0;opacity:.12}
.aphp-cta .cta-bg img{width:100%;height:100%;object-fit:cover;display:block}
.aphp-cta::after{content:"#RPL";position:absolute;left:50%;bottom:-30px;transform:translateX(-50%);font-family:var(--font-display);font-size:clamp(5rem,16vw,14rem);font-weight:900;line-height:1;color:rgba(255,255,255,.035);pointer-events:none;white-space:nowrap;user-select:none}
.aphp-cta-inner{position:relative;z-index:2;width:min(800px,92%);margin:auto}
@media(max-width:700px){.aphp-cta{margin:14px auto 56px;padding:46px 1.4rem 50px;border-radius:22px}}
.aphp-cta h2{font-family:var(--font-display);font-size:clamp(1.8rem,3.8vw,3.2rem);line-height:1.05;margin:0 0 .8rem;color:#fff}
.aphp-cta h2 span{background:linear-gradient(135deg,#FFD54A,#FFB300 50%,#FF8A00);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}
.aphp-cta p{color:rgba(248,251,255,.78);line-height:1.8;max-width:600px;margin:0 auto 2rem;font-size:.95rem}
.aphp-cta-actions{display:flex;flex-wrap:wrap;justify-content:center;gap:.8rem}
.aphp-cta-btn{display:inline-flex;align-items:center;gap:.55rem;padding:.9rem 1.9rem;border-radius:999px;background:linear-gradient(135deg,#FFD54A,#FFB300,#FF8A00);color:#0d3a66;font-weight:800;font-size:.9rem;text-decoration:none;box-shadow:0 16px 36px rgba(255,138,0,.32);transition:transform .3s ease,box-shadow .3s ease}
.aphp-cta-btn:hover{transform:translateY(-4px);box-shadow:0 20px 42px rgba(255,138,0,.46)}
.aphp-cta-btn i{transition:transform .3s ease}
.aphp-cta-btn:hover i{transform:translateX(5px)}
.aphp-cta-ghost{display:inline-flex;align-items:center;gap:.55rem;padding:.9rem 1.7rem;border-radius:999px;background:rgba(255,255,255,.06);border:1.5px solid rgba(255,255,255,.28);color:#fff;font-weight:800;font-size:.85rem;text-decoration:none;cursor:pointer;transition:background .3s ease,border-color .3s ease,transform .3s ease}
.aphp-cta-ghost:hover{background:rgba(255,255,255,.12);border-color:#FFD54A;transform:translateY(-3px)}
.aphp-cta .orn .o-chevron{left:-100px;bottom:-60px;border-color:rgba(255,255,255,.08)}
.aphp-cta .orn .o-chevron::after{border-color:rgba(255,213,74,.06)}
.aphp-cta .orn .o-dots{left:6%;top:25%;opacity:.18}
.aphp-cta .orn .o-ring{right:-60px;top:18%;border-color:rgba(255,255,255,.08)}
.aphp-cta .orn .o-gold{left:18%;bottom:22%}
.aphp-cta .orn .o-wheat{left:4%;bottom:8%;color:rgba(111,175,69,.08);transform:rotate(10deg)}

/* ===== SCROLL REVEAL ===== */
[data-reveal]{opacity:0;transform:translateY(32px);transition:opacity .7s cubic-bezier(.22,.61,.36,1),transform .7s cubic-bezier(.22,.61,.36,1)}
[data-reveal=left]{transform:translateX(-42px)}
[data-reveal=right]{transform:translateX(42px)}
[data-reveal].revealed{opacity:1;transform:none}
[data-reveal]{transition-delay:calc(var(--d,0)*80ms)}

/* ===== RESPONSIVE ===== */
@media(max-width:1050px){
  .tentang-grid{grid-template-columns:1fr;gap:2.4rem}
  .tentang-visual{min-height:380px}
}
@media(max-width:760px){
  .tentang-mini{grid-template-columns:1fr}
  .tentang-visual{min-height:340px}
  .tentang-visual .tv-step{width:100%}
  .orn .o-chevron{width:200px;height:200px}
  .orn .o-dots{width:70px;height:70px;background-size:12px 12px}
  .orn .o-ring{width:100px;height:100px}
  .orn .o-line{width:160px}
  .orn .o-square{width:38px;height:38px}
  .orn .o-corner{width:60px;height:60px}
  [data-reveal]{opacity:1;transform:none}
}

/* ===== RPL INDUSTRY PARTNERS — CLEAN LOGO MARQUEE ===== */
.industry-collab{position:relative;overflow:hidden;isolation:isolate;background:linear-gradient(180deg,#ffffff 0%,#f8fbff 100%);padding-top:5.5rem;padding-bottom:4.2rem}
.industry-collab::before{content:"";position:absolute;inset:0;pointer-events:none;opacity:.55;background-image:radial-gradient(circle at 15% 20%,rgba(11,95,165,.08) 0 2px,transparent 2.5px),linear-gradient(90deg,transparent 49.8%,rgba(11,95,165,.035) 50%,transparent 50.2%);background-size:22px 22px,90px 90px}
.industry-collab .orn{z-index:0;opacity:.55}
.industry-collab .ic-head,.industry-collab .ic-marquee-wrap,.industry-collab .ic-footer{position:relative;z-index:2}
.industry-collab .ic-head{text-align:center;max-width:940px;margin:0 auto}
.industry-collab .ic-head .eyebrow{display:inline-flex;align-items:center;gap:10px;color:#ff8a00;font-weight:900;letter-spacing:.16em;font-size:.72rem;text-transform:uppercase}
.industry-collab .ic-head .eyebrow::before,.industry-collab .ic-head .eyebrow::after{content:"";width:34px;height:2px;background:#ffb51b;border-radius:999px}
.industry-collab .ic-head .big-heading{margin:.8rem 0 .65rem;color:#0d3a66;font-size:clamp(2.25rem,4.5vw,4.25rem);line-height:1.02;font-weight:950;letter-spacing:-.045em}
.industry-collab .ic-head .big-heading span{color:#ff9f00}
.industry-collab .ic-head p{max-width:760px;margin:0 auto;color:#687d95;font-size:.98rem;line-height:1.8}
.industry-collab .ic-marquee-wrap{position:relative;width:100%;overflow:hidden;margin-top:3.1rem;padding:1rem 0}
.industry-collab .ic-marquee-wrap::before,.industry-collab .ic-marquee-wrap::after{content:"";position:absolute;z-index:3;top:0;bottom:0;width:120px;pointer-events:none}
.industry-collab .ic-marquee-wrap::before{left:0;background:linear-gradient(90deg,#fff,transparent)}
.industry-collab .ic-marquee-wrap::after{right:0;background:linear-gradient(270deg,#fff,transparent)}
.industry-collab .ic-marquee{display:flex;width:max-content;animation:aphpIndustryMarquee 28s linear infinite}
.industry-collab .ic-marquee-wrap:hover .ic-marquee{animation-play-state:paused}
.industry-collab .ic-logo-group{display:flex;gap:1.1rem;padding-right:1.1rem}
.industry-collab .ic-logo{width:190px;height:120px;border-radius:0;background:transparent!important;border:0!important;box-shadow:none!important;display:flex;align-items:center;justify-content:center;flex:0 0 auto;transition:transform .3s ease,filter .3s ease;padding:0;margin:0}
.industry-collab .ic-logo:hover{transform:translateY(-6px);filter:drop-shadow(0 14px 20px rgba(23,32,79,.18))}
.industry-collab .ic-logo-only{width:150px;height:96px;object-fit:contain;display:block}
.industry-collab .ic-footer{text-align:center;margin-top:1.2rem;color:#7a8ca1;font-size:.76rem;font-weight:800;letter-spacing:.03em}
.industry-collab .ic-footer::before{content:"";display:inline-block;width:34px;height:2px;background:#ffb51b;vertical-align:middle;margin-right:10px;border-radius:999px}
@keyframes aphpIndustryMarquee{from{transform:translateX(0)}to{transform:translateX(-50%)}}
@media(max-width:700px){
 .industry-collab{padding-top:4.2rem;padding-bottom:3rem}
 .industry-collab .ic-head .big-heading{font-size:2.25rem}
 .industry-collab .ic-head p{padding:0 1rem;font-size:.88rem}
 .industry-collab .ic-marquee-wrap::before,.industry-collab .ic-marquee-wrap::after{width:55px}
 .industry-collab .ic-logo{width:132px;height:100px}
 .industry-collab .ic-logo-only{width:110px;height:80px}
}

/* =========================================================
   LAB TOUR — SAMA PERSIS DENGAN VIRTUAL TOUR DI HALAMAN SEJARAH
   ========================================================= */
.aphp-page .vt-section{position:relative;overflow:hidden;isolation:isolate;padding:120px 0 130px;background:linear-gradient(180deg,#eef5fb 0%,#ffffff 48%,#f3f7fb 100%);scroll-margin-top:90px}
.aphp-page .vt-section::before{content:"";position:absolute;inset:0;pointer-events:none;opacity:.42;background-image:radial-gradient(circle,rgba(13,58,102,.18) 1.5px,transparent 2px);background-size:22px 22px;mask-image:linear-gradient(90deg,transparent 0%,#000 15%,#000 85%,transparent 100%)}
.aphp-page .vt-watermark{position:absolute;right:-20px;top:40px;font-size:clamp(9rem,18vw,16rem);font-weight:900;line-height:.8;color:rgba(13,58,102,.035);letter-spacing:-.08em;z-index:0;user-select:none}
.aphp-page .vt-decor-ring{position:absolute;right:-70px;top:80px;width:300px;height:300px;border:1px solid rgba(13,58,102,.12);border-radius:50%;z-index:0}
.aphp-page .vt-decor-ring::before{content:"";position:absolute;inset:35px;border:1px dashed rgba(255,179,0,.3);border-radius:50%}
.aphp-page .vt-decor-dots{position:absolute;left:4%;bottom:65px;width:125px;height:125px;opacity:.42;background-image:radial-gradient(circle,#ffb300 2px,transparent 2.5px);background-size:18px 18px;z-index:0}
.aphp-page .vt-inner{position:relative;z-index:2;width:min(1180px,92%);margin:0 auto;display:grid;grid-template-columns:minmax(0,1.05fr) minmax(360px,.95fr);gap:clamp(2.5rem,5vw,4.5rem);align-items:center}
.aphp-page .vt-frame{position:relative;overflow:hidden;border-radius:30px;background:#0d3a66;box-shadow:0 30px 75px rgba(13,58,102,.2);aspect-ratio:16/10;border:1px solid rgba(255,255,255,.65)}
.aphp-page .vt-frame::after{content:"";position:absolute;inset:0;background:linear-gradient(180deg,transparent 42%,rgba(5,25,48,.78) 100%);pointer-events:none}
.aphp-page .vt-frame img{width:100%;height:100%;display:block;object-fit:cover;transition:transform .7s cubic-bezier(.22,.61,.36,1)}
.aphp-page .vt-frame:hover img{transform:scale(1.045)}
.aphp-page .vt-badge{position:absolute;left:1.2rem;top:1.2rem;z-index:3;display:inline-flex;align-items:center;gap:.5rem;padding:.58rem .85rem;border-radius:999px;background:rgba(13,58,102,.86);color:#fff;font-size:.74rem;font-weight:800;letter-spacing:.08em;text-transform:uppercase;backdrop-filter:blur(8px)}
.aphp-page .vt-play{position:absolute;z-index:4;left:50%;top:50%;transform:translate(-50%,-50%);width:78px;height:78px;border-radius:50%;border:7px solid rgba(255,255,255,.22);background:linear-gradient(135deg,#ffd54a,#ff8a00);color:#0d3a66;font-size:1.35rem;display:grid;place-items:center;cursor:pointer;box-shadow:0 18px 45px rgba(255,138,0,.38);transition:transform .3s ease,box-shadow .3s ease}
.aphp-page .vt-play:hover{transform:translate(-50%,-50%) scale(1.08);box-shadow:0 24px 55px rgba(255,138,0,.5)}
.aphp-page .vt-caption{position:absolute;left:1.4rem;right:1.4rem;bottom:1.25rem;z-index:3;display:flex;align-items:flex-end;justify-content:space-between;gap:1rem;color:#fff}
.aphp-page .vt-caption strong{display:block;font-size:1.2rem;font-weight:900}.aphp-page .vt-caption span{display:block;margin-top:.22rem;color:rgba(255,255,255,.76);font-size:.78rem}
.aphp-page .vt-cam{display:inline-flex!important;align-items:center;gap:.4rem;padding:.48rem .7rem;border:1px solid rgba(255,255,255,.28);border-radius:999px!important;background:rgba(0,0,0,.18);white-space:nowrap}
.aphp-page .vt-chip{display:inline-flex;align-items:center;gap:.75rem;margin-top:1rem;padding:.75rem 1rem;border-radius:16px;background:#fff;border:1px solid rgba(13,58,102,.1);box-shadow:0 12px 30px rgba(13,58,102,.08)}
.aphp-page .vt-chip>i{width:40px;height:40px;border-radius:12px;display:grid;place-items:center;background:linear-gradient(135deg,#ffd54a,#ff9f00);color:#0d3a66}.aphp-page .vt-chip strong{display:block;color:#0d3a66;font-size:.85rem}.aphp-page .vt-chip span{display:block;color:#71839a;font-size:.68rem;margin-top:.15rem}
.aphp-page .vt-copy{position:relative;padding-top:.25rem}.aphp-page .vt-kicker{display:inline-flex;align-items:center;gap:.55rem;color:#0d3a66;font-size:.75rem;font-weight:900;letter-spacing:.16em;text-transform:uppercase}.aphp-page .vt-kicker::before{content:"";width:34px;height:3px;border-radius:99px;background:linear-gradient(90deg,#ffd54a,#ff8a00)}
.aphp-page .vt-title{margin:.8rem 0 1.1rem;color:#0d3a66;font-family:var(--font-display);font-size:clamp(2.8rem,5vw,4.8rem);font-weight:900;line-height:.98;letter-spacing:-.045em;max-width:620px}.aphp-page .vt-gold{display:block;background:linear-gradient(90deg,#ffd54a,#ff8a00);-webkit-background-clip:text;background-clip:text;color:transparent}.aphp-page .vt-sub{display:block;margin-top:.55rem;font-size:.38em;line-height:1.1;letter-spacing:.02em;color:#315b80;font-weight:800}
.aphp-page .vt-desc{max-width:590px;color:#667b90;line-height:1.9;font-size:.98rem;margin-top:.2rem}.aphp-page .vt-feats{display:flex;flex-wrap:wrap;gap:.55rem;margin:1.25rem 0}.aphp-page .vt-feat{display:inline-flex;align-items:center;gap:.4rem;padding:.55rem .75rem;border-radius:999px;background:#fff;border:1px solid rgba(13,58,102,.1);color:#315b80;font-size:.74rem;font-weight:800}.aphp-page .vt-feat i{color:#ff9f00}.aphp-page .vt-btn{display:inline-flex;align-items:center;justify-content:center;gap:.65rem;padding:.9rem 1.2rem;border-radius:14px;background:linear-gradient(135deg,#0d3a66,#164e80);color:#fff;text-decoration:none;font-weight:900;box-shadow:0 14px 32px rgba(13,58,102,.2);transition:transform .3s ease,box-shadow .3s ease}.aphp-page .vt-btn:hover{transform:translateY(-4px);box-shadow:0 20px 40px rgba(13,58,102,.28)}
@media(max-width:900px){.aphp-page .vt-inner{grid-template-columns:1fr;gap:2.5rem}.aphp-page .vt-copy{max-width:700px}.aphp-page .vt-title{font-size:clamp(2.6rem,10vw,4rem)}}
@media(max-width:600px){.aphp-page .vt-section{padding:85px 0 95px}.aphp-page .vt-inner{width:92%;gap:2rem}.aphp-page .vt-frame{aspect-ratio:4/3;border-radius:22px}.aphp-page .vt-play{width:64px;height:64px}.aphp-page .vt-caption{left:1rem;right:1rem;bottom:1rem}.aphp-page .vt-caption strong{font-size:1rem}.aphp-page .vt-caption span{font-size:.7rem}.aphp-page .vt-cam{display:none!important}.aphp-page .vt-title{font-size:clamp(2.35rem,12vw,3.3rem)}.aphp-page .vt-decor-ring{width:190px;height:190px;right:-80px}.aphp-page .vt-decor-dots{width:90px;height:90px;background-size:14px 14px}}
</style>

<style id="rpl-dark-mode">
/* =========================================================
   RPL — DARK MODE
   ========================================================= */
html body.theme-dark .aphp-page{background:#08131f;color:#e6eef7;color-scheme:dark}

html body.theme-dark .aphp-page .eyebrow{color:#cfe3f7}
html body.theme-dark .aphp-page .eyebrow.gold{color:#ffb347}
html body.theme-dark .aphp-page .big-heading{color:#fff}
html body.theme-dark .aphp-page .orn .o-chevron{border-top-color:rgba(143,189,235,.14);border-right-color:rgba(143,189,235,.14)}
html body.theme-dark .aphp-page .orn .o-chevron::after{border-top-color:rgba(255,213,74,.08);border-right-color:rgba(255,213,74,.08)}
html body.theme-dark .aphp-page .orn .o-ring{border-color:rgba(143,189,235,.16);box-shadow:0 0 0 18px rgba(143,189,235,.03),0 0 0 38px rgba(255,213,74,.025)}
html body.theme-dark .aphp-page .orn .o-dots{background-image:radial-gradient(circle,#8fbdeb 1.8px,transparent 2.5px);opacity:.22}
html body.theme-dark .aphp-page .orn .o-corner{border-left-color:rgba(143,189,235,.16);border-bottom-color:rgba(143,189,235,.16)}
html body.theme-dark .aphp-page .orn .o-square::before{border-color:rgba(143,189,235,.22)}
html body.theme-dark .aphp-page .orn .o-hex{border-color:rgba(143,189,235,.18)}

html body.theme-dark .aphp-page .history-hero{background:linear-gradient(180deg,#0b1d31 0%,#08131f 100%)!important;color:#e6eef7}
html body.theme-dark .aphp-page .history-hero::after{color:rgba(255,255,255,.035)!important;-webkit-text-stroke:1px rgba(255,179,0,.14)!important}
html body.theme-dark .aphp-page .history-ref-ornament-image{filter:invert(1) hue-rotate(180deg);mix-blend-mode:screen;opacity:.6!important}
html body.theme-dark .aphp-page .history-title .sejarah-white{color:#fff!important}
html body.theme-dark .aphp-page .history-kicker{background:rgba(255,111,0,.1);border-color:rgba(255,179,0,.3);color:#ffb347}
html body.theme-dark .aphp-page .history-vt-cta{background:rgba(255,255,255,.06)!important;border-color:rgba(255,255,255,.14)!important;color:#fff!important;box-shadow:0 12px 30px rgba(0,0,0,.4)}
html body.theme-dark .aphp-page .history-vt-cta:hover{background:rgba(255,179,0,.1)!important;border-color:rgba(255,179,0,.45)!important}
html body.theme-dark .aphp-page .history-vt-cta strong{color:#fff!important}
html body.theme-dark .aphp-page .history-vt-cta small{color:#9fb2c6}

html body.theme-dark .aphp-page .vid-section{background:linear-gradient(180deg,#0a1928 0%,#08131f 100%)}
html body.theme-dark .aphp-page .vid-copy h2{color:#fff}
html body.theme-dark .aphp-page .vid-copy .vc-label{color:#8fa3b8}
html body.theme-dark .aphp-page .vid-copy .vc-desc{color:#a9bbcd}
html body.theme-dark .aphp-page .vid-card{background:rgba(255,255,255,.05);border-color:rgba(255,255,255,.1)}
html body.theme-dark .aphp-page .vid-card:hover{border-color:rgba(255,179,0,.4);box-shadow:0 14px 30px rgba(0,0,0,.4)}
html body.theme-dark .aphp-page .vid-card b{color:#fff}
html body.theme-dark .aphp-page .vid-card span:not(.vc-ic){color:#9fb2c6}
html body.theme-dark .aphp-page .vid-side{color:rgba(255,255,255,.3)}
html body.theme-dark .aphp-page .vid-player{box-shadow:0 30px 80px rgba(0,0,0,.55);border-color:rgba(255,255,255,.12)}

html body.theme-dark .aphp-page .tentang-section{background:linear-gradient(135deg,#0a1928 0%,#0b1d31 55%,#0a1726 100%)}
html body.theme-dark .aphp-page .tentang-section::before{background-image:linear-gradient(rgba(143,189,235,.05) 1px,transparent 1px),linear-gradient(90deg,rgba(143,189,235,.05) 1px,transparent 1px)}
html body.theme-dark .aphp-page .tentang-section::after{color:rgba(255,255,255,.03)}
html body.theme-dark .aphp-page .tentang-copy .tc-label{color:#8fa3b8}
html body.theme-dark .aphp-page .tentang-copy .tc-lead{color:#b7c8d9}
html body.theme-dark .aphp-page .tentang-copy .tc-lead strong{color:#fff}
html body.theme-dark .aphp-page .tentang-copy .tc-sub{color:#9fb2c6}
html body.theme-dark .aphp-page .tentang-mini-card{background:rgba(255,255,255,.05);border-color:rgba(255,255,255,.1);box-shadow:0 10px 25px rgba(0,0,0,.3)}
html body.theme-dark .aphp-page .tentang-mini-card:hover{border-color:rgba(255,213,74,.3);box-shadow:0 18px 34px rgba(0,0,0,.45)}
html body.theme-dark .aphp-page .tentang-mini-card span{color:#e6eef7}
html body.theme-dark .aphp-page .tentang-mini-card .tm-ic{color:#fff}
html body.theme-dark .aphp-page .tentang-mini-card .tm-ic.gold{color:#0d3a66}
html body.theme-dark .aphp-page .tentang-visual::before{border-color:rgba(255,179,0,.22)}
html body.theme-dark .aphp-page .tentang-visual::after{border-color:rgba(143,189,235,.18)}
html body.theme-dark .aphp-page .tv-panel{box-shadow:0 30px 70px rgba(0,0,0,.55);border-color:rgba(255,255,255,.1)}

html body.theme-dark .aphp-page .industry-collab{background:linear-gradient(180deg,#08131f 0%,#0a1928 100%)}
html body.theme-dark .aphp-page .industry-collab::before{opacity:.3}
html body.theme-dark .aphp-page .industry-collab .ic-head .big-heading{color:#fff}
html body.theme-dark .aphp-page .industry-collab .ic-head .big-heading span{color:#ffb300}
html body.theme-dark .aphp-page .industry-collab .ic-head p{color:#a9bbcd}
html body.theme-dark .aphp-page .industry-collab .ic-marquee-wrap::before{background:linear-gradient(90deg,#08131f,transparent)}
html body.theme-dark .aphp-page .industry-collab .ic-marquee-wrap::after{background:linear-gradient(270deg,#08131f,transparent)}
html body.theme-dark .aphp-page .industry-collab .ic-footer{color:#8fa3b8}

html body.theme-dark .aphp-page .belajar-section{background:linear-gradient(180deg,#0a1928 0%,#08131f 100%)}
html body.theme-dark .aphp-page .belajar-head p{color:#a9bbcd}
html body.theme-dark .aphp-page .belajar-card{background:#0f2236;border-color:rgba(255,255,255,.1)}
html body.theme-dark .aphp-page .belajar-card:hover{border-color:rgba(255,179,0,.4);box-shadow:0 24px 50px rgba(0,0,0,.5)}
html body.theme-dark .aphp-page .belajar-card::after{color:rgba(255,255,255,.04)}
html body.theme-dark .aphp-page .belajar-card h4{color:#fff}
html body.theme-dark .aphp-page .belajar-card p{color:#9fb2c6}

html body.theme-dark .aphp-page .praktik-section{background:#08131f}
html body.theme-dark .aphp-page .praktik-head p{color:#a9bbcd}
html body.theme-dark .aphp-page .praktik-card:hover{box-shadow:0 30px 66px rgba(0,0,0,.6)}

html body.theme-dark .aphp-page .fasilitas-section{background:linear-gradient(180deg,#08131f 0%,#0a1928 100%)}
html body.theme-dark .aphp-page .fasilitas-head p{color:#a9bbcd}
html body.theme-dark .aphp-page .fasilitas-card{background:#0f2236;border-color:rgba(255,255,255,.1)}
html body.theme-dark .aphp-page .fasilitas-card:hover{border-color:rgba(255,213,74,.35);box-shadow:0 20px 44px rgba(0,0,0,.5)}
html body.theme-dark .aphp-page .fasilitas-card h4{color:#fff}
html body.theme-dark .aphp-page .fasilitas-card p{color:#9fb2c6}
html body.theme-dark .aphp-page .fasilitas-cta{background:linear-gradient(135deg,#0a1a2c 0%,#0c2038 50%,#0e2542 100%);border:1px solid rgba(255,255,255,.08)}

html body.theme-dark .aphp-page .produk-section{background:#08131f}
html body.theme-dark .aphp-page .produk-note{color:#9fb2c6}
html body.theme-dark .aphp-page .produk-card{background:#0f2236;border-color:rgba(255,255,255,.1);box-shadow:0 20px 44px rgba(0,0,0,.4)}
html body.theme-dark .aphp-page .produk-card:hover{box-shadow:0 28px 60px rgba(0,0,0,.6)}
html body.theme-dark .aphp-page .produk-card .pc-body h3{color:#fff}
html body.theme-dark .aphp-page .produk-card .pc-body p{color:#9fb2c6}

html body.theme-dark .aphp-page .kegiatan-section{background:linear-gradient(180deg,#0a1928 0%,#08131f 100%)}
html body.theme-dark .aphp-page .kegiatan-head p{color:#a9bbcd}
html body.theme-dark .aphp-page .kegiatan-card:hover{box-shadow:0 24px 50px rgba(0,0,0,.55)}

html body.theme-dark .aphp-page .prospek-section{background:#08131f}
html body.theme-dark .aphp-page .prospek-head p{color:#a9bbcd}
html body.theme-dark .aphp-page .prospek-card{background:#0f2236;border-color:rgba(255,255,255,.1)}
html body.theme-dark .aphp-page .prospek-card:hover{box-shadow:0 30px 66px rgba(0,0,0,.55)}
html body.theme-dark .aphp-page .prospek-card .ps-body h4{color:#fff}
html body.theme-dark .aphp-page .prospek-card .ps-body p{color:#9fb2c6}
html body.theme-dark .aphp-page .prospek-card .ps-body .ps-tags span{color:#cfe3f7;background:rgba(143,189,235,.14)}

html body.theme-dark .aphp-page .vt-section{background:linear-gradient(180deg,#0a1928 0%,#08131f 50%,#0a1726 100%)}
html body.theme-dark .aphp-page .vt-section::before{background-image:radial-gradient(circle,rgba(143,189,235,.2) 1.5px,transparent 2px);opacity:.35}
html body.theme-dark .aphp-page .vt-watermark{color:rgba(255,255,255,.04)}
html body.theme-dark .aphp-page .vt-decor-ring{border-color:rgba(143,189,235,.16)}
html body.theme-dark .aphp-page .vt-frame{box-shadow:0 30px 75px rgba(0,0,0,.55);border-color:rgba(255,255,255,.12)}
html body.theme-dark .aphp-page .vt-chip{background:#0f2236;border-color:rgba(255,255,255,.1);box-shadow:0 12px 30px rgba(0,0,0,.4)}
html body.theme-dark .aphp-page .vt-chip strong{color:#fff}
html body.theme-dark .aphp-page .vt-chip span{color:#8fa3b8}
html body.theme-dark .aphp-page .vt-kicker{color:#dbe7f3}
html body.theme-dark .aphp-page .vt-title{color:#fff}
html body.theme-dark .aphp-page .vt-sub{color:#9fc4e6}
html body.theme-dark .aphp-page .vt-desc{color:#a9bbcd}
html body.theme-dark .aphp-page .vt-feat{background:rgba(255,255,255,.06);border-color:rgba(255,255,255,.12);color:#cfe3f7}
html body.theme-dark .aphp-page .vt-btn{background:linear-gradient(135deg,#ffd54a,#ff8a00);color:#0d3a66;box-shadow:0 14px 32px rgba(0,0,0,.4)}

html body.theme-dark .aphp-page .aphp-cta{background:linear-gradient(135deg,#0a1a2c 0%,#0c2038 50%,#0e2542 100%);border:1px solid rgba(255,255,255,.08);box-shadow:0 24px 55px rgba(0,0,0,.55)}
html body.theme-dark .aphp-page .aphp-cta::after{color:rgba(255,255,255,.03)}
</style>
@endpush

{{-- =====================================================================
     ISI HALAMAN & SCRIPT diambil dari partial (data dari Admin > RPL):
       resources/views/keahlian/partials/rpl-content.blade.php
       resources/views/keahlian/partials/rpl-scripts.blade.php
     ===================================================================== --}}
@section('content')
@include('keahlian.partials.rpl-content')
@endsection

@push('scripts')
@include('keahlian.partials.rpl-scripts')
@endpush