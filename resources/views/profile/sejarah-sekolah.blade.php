@extends('layouts.app')

@section('title', 'Sejarah Sekolah — SMK Negeri 2 Mojokerto')
@section('description', 'Sejarah SMK Negeri 2 Mojokerto sejak berdiri pada 24 Juni 2013 hingga berkembang menjadi sekolah vokasi di Kota Mojokerto.')

@push('styles')
<style>
/* =========================================================
   SEJARAH SEKOLAH — PREMIUM EDITION
   ========================================================= */
.history-page{background:#f7f9fc;color:#0d3a66;overflow:hidden;position:relative}
.history-page *{box-sizing:border-box}

/* ---------- HERO ---------- */
.history-hero{position:relative;min-height:clamp(620px,78vh,790px)!important;display:flex!important;align-items:center!important;justify-content:center!important;overflow:hidden!important;background:#fff!important;color:#0d3a66;isolation:isolate}
.history-hero::before{display:none}
.history-hero::after{content:"SEJARAH"!important;position:absolute;z-index:0!important;left:2%!important;top:58%!important;transform:translateY(-50%);
  font-family:var(--font-display);font-size:clamp(9rem,23vw,23rem)!important;font-weight:900;line-height:.78;
  letter-spacing:.015em;color:rgba(13,58,102,.035)!important;
  -webkit-text-stroke:1px rgba(255,122,0,.09)!important;
  pointer-events:none;white-space:nowrap;user-select:none}

.history-ref-ornaments{position:absolute!important;inset:0!important;z-index:1!important;overflow:hidden!important;pointer-events:none!important;opacity:1!important}
.history-ref-ornament-image{position:absolute!important;inset:0!important;width:100%!important;height:100%!important;display:block!important;object-fit:cover!important;object-position:center center!important;max-width:none!important;opacity:1!important}

.history-hero-inner{position:relative!important;z-index:4!important;width:100%;max-width:1500px!important;margin:0 auto;
  padding:clamp(4rem,10vh,7rem) clamp(1.25rem,4.2vw,4.5rem) clamp(4rem,9vh,6rem)!important;
  padding-right:44%!important;
  display:flex!important;flex-direction:column!important;justify-content:center!important;align-items:flex-start}

.history-kicker{position:relative!important;z-index:5!important;display:inline-flex;align-items:center;gap:.65rem;font-size:.72rem;font-weight:900;
  letter-spacing:.18em;text-transform:uppercase;color:#ff6f00;margin-bottom:1.2rem!important;
  padding:.55rem .85rem;border:1px solid rgba(255,111,0,.18);border-radius:999px;background:#fffaf5}
.history-kicker::before{content:"";width:9px;height:9px;border-radius:50%;background:#ff6f00;box-shadow:0 0 0 6px rgba(255,111,0,.10)}

.history-title{position:relative!important;z-index:5!important;font-family:var(--font-display);font-size:clamp(4.4rem,9.8vw,9.3rem)!important;line-height:.82!important;
  letter-spacing:-.045em!important;margin:0;max-width:900px!important;text-transform:uppercase;
  text-shadow:none;animation:hdFadeUp .7s .1s var(--ease, ease) both}
.history-title .sejarah-white{color:#0d3a66!important;display:block}
.history-title .skaneda-gold{display:block;
  background:linear-gradient(135deg,#ffd54a 0%,#ffb300 48%,#ff7a00 100%)!important;
  -webkit-background-clip:text!important;background-clip:text!important;-webkit-text-fill-color:transparent!important;color:transparent!important;
  text-shadow:none;letter-spacing:-.025em}
@keyframes hdFadeUp{from{opacity:0;transform:translateY(26px)}to{opacity:1;transform:none}}

.history-vt-cta{position:relative!important;z-index:5!important;
  display:inline-flex;align-items:center;gap:.8rem;margin-top:2rem!important;
  padding:.8rem 1rem;border-radius:16px;text-decoration:none;color:#0d3a66;
  background:#fff;border:1px solid rgba(13,58,102,.12);
  box-shadow:0 12px 30px rgba(13,58,102,.08);
  transition:transform .3s ease,background .3s ease,border-color .3s ease,box-shadow .3s ease}
.history-vt-cta:hover{transform:translateY(-4px);background:#fffaf5;border-color:rgba(255,122,0,.28);box-shadow:0 18px 38px rgba(13,58,102,.12)}
.history-vt-icon{width:46px;height:46px;border-radius:14px;display:grid;place-items:center;background:linear-gradient(135deg,#ffd54a,#ff7a00);color:#0d3a66;font-size:.9rem}
.history-vt-cta strong{display:block;font-size:1rem;line-height:1.15;font-weight:900;letter-spacing:.01em}
.history-vt-cta small{display:block;margin-top:.25rem;color:#718096;font-size:.72rem;font-weight:600}
.history-vt-arrow{margin-left:.3rem;color:#ffd54a;font-size:1rem}

/* ---------- SECTION COMMON ---------- */
.history-wide{width:min(1380px,92%);margin:auto}
.eyebrow{display:inline-flex;align-items:center;gap:.5rem;font-size:.74rem;font-weight:800;
  letter-spacing:.18em;text-transform:uppercase;color:#0d3a66;margin-bottom:.85rem}
.story-content .eyebrow{color:#ffb300;}
.story-content .eyebrow::before{background:linear-gradient(90deg,#ffd54a,#ff9800);}
.eyebrow::before{content:"";width:26px;height:3px;border-radius:99px;background:linear-gradient(90deg,#0d3a66,#2f6fa8)}
.big-heading{font-family:var(--font-display);font-size:clamp(2.1rem,4.4vw,4.2rem);line-height:1.02;
  letter-spacing:.01em;margin:0;color:#0d3a66;text-shadow:0 2px 10px rgba(13,58,102,.06)}
.big-heading span{background:linear-gradient(135deg,#ffd54a 0%,#ffb300 45%,#ff7a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}

/* ---------- INTRO / STATS ---------- */
.history-intro{position:relative;padding:96px 0 110px;background:#fff}
.intro-grid{display:grid;grid-template-columns:1.1fr .9fr;gap:5rem;align-items:center}
.intro-copy{font-size:1rem;line-height:1.95;color:#5f7186;margin-top:1.25rem;max-width:720px}
.stat-strip{display:grid;grid-template-columns:repeat(2,1fr);gap:1rem}
.stat-box{position:relative;padding:1.4rem;border-radius:22px;overflow:hidden;min-height:150px;
  background:rgba(255,255,255,.72);border:1px solid rgba(13,58,102,.16);
  box-shadow:0 18px 44px rgba(13,58,102,.08);backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);
  transition:transform .35s ease,box-shadow .35s ease}
.stat-box:hover{transform:translateY(-5px);box-shadow:0 24px 52px rgba(13,58,102,.14)}
.stat-box::after{content:"";position:absolute;right:-25px;bottom:-30px;width:90px;height:90px;border:2px solid rgba(13,58,102,.22);transform:rotate(45deg)}
.stat-box::before{content:"";position:absolute;top:0;left:0;width:100%;height:4px;background:linear-gradient(90deg,#0d3a66,#2f6fa8)}
.stat-num{font-family:var(--font-display);font-size:2.8rem;line-height:1;color:#0d3a66;font-weight:900}
.stat-num.gold{background:linear-gradient(135deg,#ffd54a,#ffb300 50%,#ff7a00);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}
.stat-label{font-size:.74rem;font-weight:800;color:#6d7f91;margin-top:.55rem;text-transform:uppercase;letter-spacing:.08em}

/* ---------- BOOK SECTION BACKGROUND (.timeline-section) ---------- */
.timeline-section{position:relative;padding:110px 0 130px;overflow:hidden;isolation:isolate;
  background:
    radial-gradient(circle at 8% 18%,rgba(47,111,168,.12) 0 2px,transparent 3px),
    radial-gradient(circle at 91% 27%,rgba(255,179,0,.16) 0 3px,transparent 4px),
    radial-gradient(circle at 13% 78%,rgba(47,111,168,.10) 0 2px,transparent 3px),
    linear-gradient(180deg,#f8fbfe 0%,#eef5fa 100%)}
.timeline-section::after{content:"";position:absolute;left:-35px;top:180px;width:185px;height:185px;
  background-image:radial-gradient(circle,rgba(31,100,170,.45) 2.2px,transparent 3px);background-size:20px 20px;opacity:.65;pointer-events:none;z-index:0}
.timeline-section::before{content:"";position:absolute;right:-20px;bottom:90px;width:175px;height:175px;
  background-image:radial-gradient(circle,rgba(255,179,0,.55) 2px,transparent 3px);background-size:19px 19px;opacity:.5;pointer-events:none;z-index:0}

/* ---------- STORY BAND ---------- */
.story-band{position:relative;min-height:520px;display:grid;grid-template-columns:1fr 1fr;background:#082744;color:#fff;overflow:hidden}
.story-image{position:relative;min-height:520px;overflow:hidden}
.story-image img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .8s ease}
.story-band:hover .story-image img{transform:scale(1.04)}
.story-image::after{content:"";position:absolute;inset:0;background:linear-gradient(90deg,transparent 45%,#082744 100%)}
.story-content{position:relative;display:flex;align-items:center;padding:70px clamp(2rem,7vw,7rem) 70px 4rem;overflow:hidden}
.story-content::before{content:"2013";position:absolute;right:-20px;bottom:-45px;font-family:var(--font-display);font-size:12rem;line-height:1;font-weight:900;color:rgba(255,255,255,.04);-webkit-text-stroke:1px rgba(255,255,255,.05)}
.story-content-inner{position:relative;z-index:2;max-width:560px}
.story-content h2{font-family:var(--font-display);font-size:clamp(2.2rem,4vw,4rem);line-height:.98;margin:0 0 1rem}
.story-content h2 span{background:linear-gradient(135deg,#ffd54a,#ffb300 50%,#ff7a00);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}
.story-content p{color:rgba(255,255,255,.76);line-height:1.9;font-size:.92rem}
.story-list{display:grid;grid-template-columns:1fr 1fr;gap:.8rem;margin-top:1.5rem}
.story-chip{padding:.8rem;border:1px solid rgba(255,255,255,.12);border-radius:14px;background:rgba(255,255,255,.05);font-size:.74rem;font-weight:800;backdrop-filter:blur(6px);-webkit-backdrop-filter:blur(6px)}
.story-chip i{color:#ffd54a;margin-right:.4rem}

/* ---------- MOSAIC ---------- */
.mosaic-section{padding:110px 0;background:#fff}
.mosaic-head{width:min(1380px,92%);margin:0 auto 45px}
.mosaic{width:min(1380px,92%);margin:auto;display:grid;grid-template-columns:1.3fr .7fr .7fr;grid-template-rows:280px 280px;gap:14px}
.mosaic-card{position:relative;overflow:hidden;border-radius:22px;background:#0d3a66;box-shadow:0 18px 44px rgba(13,58,102,.12)}
.mosaic-card.big{grid-row:span 2}
.mosaic-card img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .7s ease}
.mosaic-card:hover img{transform:scale(1.06)}
.mosaic-card::after{content:"";position:absolute;inset:0;background:linear-gradient(180deg,transparent 35%,rgba(4,22,40,.88) 100%)}
.mosaic-label{position:absolute;z-index:2;left:1.2rem;right:1.2rem;bottom:1.1rem;color:#fff}
.mosaic-label small{display:block;color:#ffd54a;font-size:.64rem;font-weight:900;letter-spacing:.18em;text-transform:uppercase}
.mosaic-label strong{display:block;font-family:var(--font-display);font-size:1.22rem;margin-top:.25rem}

/* ---------- SCROLL REVEAL ---------- */
[data-reveal]{opacity:0;transform:translateY(36px);
  transition:opacity .85s cubic-bezier(.22,.61,.36,1),transform .85s cubic-bezier(.22,.61,.36,1);will-change:opacity,transform}
[data-reveal="left"]{transform:translateX(-46px)}
[data-reveal="right"]{transform:translateX(46px)}
[data-reveal].revealed{opacity:1;transform:none}
[data-reveal]{transition-delay:calc(var(--d,0)*90ms)}

/* ---------- ORNAMEN HOME-ORN ---------- */
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

.history-intro .home-orn .ho-chevron{right:-130px;top:70px}
.history-intro .home-orn .ho-line{left:-55px;bottom:75px}
.history-intro .home-orn .ho-dots{right:18%;bottom:55px}
.history-intro .home-orn .ho-ring{left:-80px;top:35%}
.history-intro .home-orn .ho-gold{right:12%;top:26%}
.history-intro .home-orn .ho-square{left:13%;bottom:18%}

.timeline-section .home-orn .ho-chevron{right:-145px;top:45px}
.timeline-section .home-orn .ho-line{left:-80px;top:170px}
.timeline-section .home-orn .ho-dots{left:3%;bottom:100px}
.timeline-section .home-orn .ho-ring{right:8%;bottom:90px}
.timeline-section .home-orn .ho-gold{right:16%;top:22%}
.timeline-section .home-orn .ho-square{left:11%;top:15%}
.timeline-section .home-orn .ho-corner{right:3%;bottom:8%;transform:rotate(180deg)}

.story-band .home-orn .ho-chevron{left:-150px;top:35px;border-color:rgba(255,255,255,.10)}
.story-band .home-orn .ho-chevron::after{border-color:rgba(255,213,74,.09)}
.story-band .home-orn .ho-line{right:-80px;bottom:95px}
.story-band .home-orn .ho-dots{right:6%;top:90px;opacity:.25}
.story-band .home-orn .ho-ring{left:43%;bottom:-90px;border-color:rgba(255,255,255,.12)}
.story-band .home-orn .ho-gold{right:14%;top:28%}

.mosaic-section .home-orn .ho-chevron{right:-150px;top:20px}
.mosaic-section .home-orn .ho-line{left:-80px;bottom:100px}
.mosaic-section .home-orn .ho-dots{left:4%;top:125px}
.mosaic-section .home-orn .ho-ring{right:3%;bottom:70px}
.mosaic-section .home-orn .ho-gold{left:10%;top:24%}
.mosaic-section .home-orn .ho-square{right:15%;top:20%}

.history-hero,.history-intro,.timeline-section,.story-band,.mosaic-section{position:relative;z-index:1}
.history-intro>*:not(.home-orn),
.timeline-section>*:not(.home-orn),
.story-band>*:not(.home-orn),
.mosaic-section>*:not(.home-orn){position:relative;z-index:2}

/* ornamen fixed di tepi halaman + hover */
.history-page::before{content:"";position:fixed;right:-110px;top:18%;width:230px;height:230px;border:2px solid rgba(13,58,102,.14);transform:rotate(45deg);z-index:0;pointer-events:none}
.history-page::after{content:"";position:fixed;left:-95px;bottom:10%;width:190px;height:190px;border:2px solid rgba(47,111,168,.14);border-radius:28px;transform:rotate(25deg);z-index:0;pointer-events:none}
.mosaic-section::before{content:"";position:absolute;left:4%;top:70px;width:46px;height:46px;border-radius:50%;background:radial-gradient(circle,#ffd54a 0 4px,transparent 5px);background-size:15px 15px;opacity:.7}
.story-band::before{content:"";position:absolute;left:50%;top:22px;width:120px;height:4px;background:linear-gradient(90deg,transparent,#ffd54a,transparent);z-index:3;opacity:.8}

.history-page .history-kicker,.history-page .eyebrow,.history-page .stat-box,.history-page .story-chip,
.history-page .mosaic-card,.history-page .big-heading,.history-page .history-title{
  transition:transform .35s ease,box-shadow .35s ease,filter .35s ease,border-color .35s ease,background .35s ease}
.history-page .history-kicker:hover{transform:translateX(7px);filter:drop-shadow(0 5px 12px rgba(255,213,74,.2))}
.history-page .eyebrow:hover{transform:translateX(6px)}
.history-page .stat-box:hover{transform:translateY(-9px) rotate(-.5deg);border-color:rgba(13,58,102,.32);box-shadow:0 28px 58px rgba(13,58,102,.18)}
.history-page .story-chip:hover{transform:translateY(-5px);border-color:rgba(255,213,74,.4);background:rgba(255,255,255,.11)}
.history-page .mosaic-card:hover{transform:translateY(-7px);box-shadow:0 28px 58px rgba(13,58,102,.22)}
.history-page .big-heading:hover{transform:translateX(4px)}

/* ---------- RESPONSIVE UMUM ---------- */
@media(max-width:1050px){
  .history-hero-inner{padding-right:1.25rem!important}
  .history-ref-ornaments{opacity:.72!important}
}
@media(max-width:950px){
  .intro-grid{grid-template-columns:1fr;gap:2.5rem}
  .story-band{grid-template-columns:1fr}
  .story-image{min-height:360px}
  .story-image::after{background:linear-gradient(180deg,transparent 35%,#082744 100%)}
  .story-content{padding:55px 7% 70px}
  .mosaic{grid-template-columns:1fr 1fr;grid-template-rows:260px 260px}
  .mosaic-card.big{grid-row:auto;grid-column:span 2}
}
@media(max-width:900px){
  .history-title{font-size:clamp(4rem,11vw,7rem)!important}
  .history-ref-ornament-image{opacity:.88!important}
  .intro-grid{grid-template-columns:1fr!important;gap:2rem!important}
  .story-band{grid-template-columns:1fr!important;min-height:auto!important}
  .story-image{min-height:260px!important}
  .story-content{padding:2.5rem 1.5rem!important}
  .mosaic{grid-template-columns:1fr!important;grid-template-rows:auto!important;gap:1rem!important}
  .mosaic-card.big{grid-row:auto!important;height:240px!important}
  .mosaic-card{height:200px!important}
}
@media(max-width:768px){
  .history-hero{min-height:480px}
  .history-hero-inner{padding:3.5rem 1.25rem 4rem;width:100%}
  .history-hero::after{font-size:clamp(5rem,24vw,9rem);left:-4%;max-width:100%;overflow:hidden}
  .story-list{grid-template-columns:1fr!important}
  .stat-strip{grid-template-columns:1fr!important}
}
@media(max-width:700px){
  .history-hero{min-height:420px}
  .history-hero-inner{padding:3.2rem 1.25rem 3.5rem;width:100%;margin:0 auto}
  .history-hero::after{font-size:clamp(4.5rem,26vw,7rem);opacity:.6}
  .history-ref-ornaments{opacity:.45!important}
  .history-title{font-size:clamp(3rem,14vw,5rem)!important}
  .history-vt-cta{width:min(100%,340px)}
  .history-vt-cta .history-vt-arrow{margin-left:auto}
  .history-page::before,.history-page::after{opacity:.45}
  .home-orn .ho-chevron{width:220px;height:220px}
  .home-orn .ho-dots{width:80px;height:80px;background-size:14px 14px}
  .home-orn .ho-ring{width:110px;height:110px}
  .home-orn .ho-line{width:190px}
  .home-orn .ho-square{width:42px;height:42px}
  .home-orn .ho-corner{width:70px;height:70px}
  .timeline-section::after{width:105px;height:105px;left:-45px;top:190px}
  .timeline-section::before{width:105px;height:105px;right:-45px;bottom:70px}
  .stat-strip{grid-template-columns:1fr 1fr}
  .story-image{min-height:280px}
  .story-content{padding:45px 7% 60px}
  .story-list{grid-template-columns:1fr}
  .mosaic{grid-template-columns:1fr;grid-template-rows:230px 230px 230px}
  .mosaic-card.big{grid-column:auto}
  [data-reveal]{opacity:1;transform:none}
}
@media(max-width:560px){
  .history-ref-ornament-image{opacity:.62!important}
  .history-hero::after{font-size:clamp(7rem,31vw,11rem);opacity:.8}
}

/* ---------- KEPEMIMPINAN ---------- */
.principal-section{position:relative;overflow:hidden;isolation:isolate;padding:120px 0 135px;
  background:
    radial-gradient(circle at 7% 20%,rgba(13,58,102,.10) 0 2px,transparent 3px),
    radial-gradient(circle at 93% 28%,rgba(255,179,0,.14) 0 3px,transparent 4px),
    linear-gradient(180deg,#ffffff 0%,#f5f8fc 55%,#edf3f8 100%);z-index:1}
.principal-section::before{content:"";position:absolute;left:-90px;bottom:70px;width:280px;height:280px;background-image:radial-gradient(circle,rgba(13,58,102,.25) 2px,transparent 3px);background-size:22px 22px;opacity:.42;pointer-events:none;z-index:0}
.principal-section::after{content:"";position:absolute;right:-80px;top:105px;width:260px;height:260px;border:1px solid rgba(13,58,102,.12);border-radius:50%;box-shadow:0 0 0 26px rgba(13,58,102,.025),0 0 0 56px rgba(255,179,0,.025);pointer-events:none;z-index:0}
.principal-section .home-orn .ho-chevron{left:-170px;top:20px;width:410px;height:410px}
.principal-section .home-orn .ho-chevron::after{inset:46px}
.principal-section .home-orn .ho-ring{right:-100px;top:22%;width:240px;height:240px}
.principal-section .home-orn .ho-dots{right:8%;bottom:55px;width:145px;height:145px;opacity:.46}
.principal-section .home-orn .ho-gold{left:15%;top:25%}
.principal-section .home-orn .ho-square{right:17%;top:31%}
.principal-section .home-orn .ho-corner{left:4%;bottom:7%;transform:rotate(180deg);width:125px;height:125px}
.principal-head{width:min(1080px,92%);margin:0 auto 3.8rem;text-align:center;position:relative;z-index:2}
.principal-head .eyebrow{justify-content:center}
.principal-head .eyebrow::after{content:"• • •";color:#ffb300;letter-spacing:5px;font-size:12px;margin-left:.35rem}
.principal-head .big-heading{margin:0 auto;font-size:clamp(2.8rem,5.2vw,5rem);letter-spacing:-.035em;text-shadow:0 10px 28px rgba(13,58,102,.08)}
.principal-head .big-heading span{background:linear-gradient(135deg,#ffd54a 0%,#ffb300 48%,#ff7a00 100%);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}
.principal-desc{max-width:660px;margin:1rem auto 0;color:#687c90;font-size:.95rem;line-height:1.85}
.principal-stage{position:relative;z-index:2;width:min(1050px,94%);margin:0 auto;display:flex;align-items:center;gap:1rem}
.principal-viewport{flex:1;min-width:0;overflow:hidden;border-radius:30px;padding:10px 8px 22px}
.principal-track{display:flex;gap:1.5rem;transition:transform .65s cubic-bezier(.22,.61,.36,1);will-change:transform}
.principal-post{flex:0 0 min(430px,82vw);background:#fff;border:1px solid rgba(13,58,102,.13);border-radius:24px;overflow:hidden;
  box-shadow:0 22px 58px rgba(13,58,102,.13),0 4px 12px rgba(13,58,102,.05);transition:transform .4s ease,box-shadow .4s ease,border-color .3s ease}
.principal-post:hover{transform:translateY(-8px);box-shadow:0 32px 75px rgba(13,58,102,.19);border-color:rgba(255,179,0,.42)}
.principal-post-head{height:64px;padding:.75rem .9rem;display:flex;align-items:center;justify-content:space-between;gap:.8rem;border-bottom:1px solid #edf2f6;background:#fff}
.principal-profile{display:flex;align-items:center;gap:.65rem;min-width:0}
.principal-avatar{width:38px;height:38px;flex:0 0 38px;border-radius:0;display:grid;place-items:center;color:#ffd54a;background:none;box-shadow:none}
.principal-avatar img{width:36px;height:36px;object-fit:contain;display:block}
.principal-profile strong{display:block;color:#0d3a66;font-size:.78rem;font-weight:900;line-height:1.15}
.principal-profile span{display:block;color:#8293a4;font-size:.64rem;margin-top:.15rem}
.principal-more{color:#7d8fa1;font-size:1rem}
.principal-photo{position:relative;width:100%;aspect-ratio:3/4;min-height:430px;max-height:620px;overflow:hidden;background:linear-gradient(160deg,#eef5fb 0%,#dce9f4 58%,#c9d9e7 100%);display:flex;align-items:flex-end;justify-content:center}
.principal-photo img{width:100%;height:100%;object-fit:contain;object-position:center bottom;display:block;padding:0 1.2rem 0;filter:drop-shadow(0 18px 20px rgba(13,58,102,.18));transition:transform .65s cubic-bezier(.22,.61,.36,1)}
.principal-post:hover .principal-photo img{transform:scale(1.035) translateY(-3px)}
.principal-photo::after{content:"";position:absolute;inset:0;pointer-events:none;background:linear-gradient(180deg,transparent 62%,rgba(7,28,52,.18) 100%)}
.principal-current{position:absolute;right:1rem;top:1rem;z-index:3;display:inline-flex;align-items:center;gap:.4rem;padding:.45rem .72rem;border-radius:999px;color:#fff;background:linear-gradient(135deg,#ffd54a,#ff8a00);font-size:.66rem;font-weight:900;letter-spacing:.08em;text-transform:uppercase;box-shadow:0 9px 22px rgba(255,138,0,.32)}
.principal-current::before{content:"";width:7px;height:7px;border-radius:50%;background:#0d3a66;box-shadow:0 0 0 5px rgba(13,58,102,.08)}
.principal-post-actions{display:flex;align-items:center;gap:1rem;padding:.8rem 1rem .45rem;color:#173f64;font-size:1.05rem}
.principal-post-actions .spacer{margin-left:auto}
.principal-post-body{padding:0 1rem 1.15rem}
.principal-like{color:#0d3a66;font-size:.72rem;font-weight:900;margin-bottom:.45rem}
.principal-caption{color:#5f7186;font-size:.78rem;line-height:1.65;margin:0}
.principal-caption strong{color:#0d3a66}
.principal-period{display:inline-flex;align-items:center;gap:.5rem;margin-top:.75rem;padding:.42rem .68rem;border-radius:999px;color:#ff8a00;background:#fff7e8;border:1px solid rgba(255,179,0,.25);font-size:.68rem;font-weight:900;letter-spacing:.06em}
.principal-period::before{content:"";width:20px;height:2px;border-radius:99px;background:linear-gradient(90deg,#ffd54a,#ff8a00)}
.principal-arrow{flex:0 0 50px;width:50px;height:50px;border:0;border-radius:50%;cursor:pointer;display:grid;place-items:center;background:linear-gradient(135deg,#0d3a66,#173f64);color:#fff;font-size:1rem;box-shadow:0 12px 28px rgba(13,58,102,.28);transition:transform .3s ease,box-shadow .3s ease,background .3s ease}
.principal-arrow:hover{transform:translateY(-3px) scale(1.06);background:linear-gradient(135deg,#ffb300,#ff8a00);box-shadow:0 18px 38px rgba(13,58,102,.3)}
.principal-arrow:disabled{opacity:.35;cursor:default;transform:none}
.principal-dots{display:flex;justify-content:center;gap:.55rem;margin-top:1.35rem;position:relative;z-index:2}
.principal-dots button{width:9px;height:9px;border:0;border-radius:99px;padding:0;cursor:pointer;background:rgba(13,58,102,.22);transition:all .3s ease}
.principal-dots button.is-active{width:28px;background:linear-gradient(90deg,#ffd54a,#ff8a00)}
.principal-section > .principal-head,.principal-section > .principal-stage,.principal-section > .principal-dots{position:relative;z-index:2}
@media(max-width:700px){
  .principal-section{padding:85px 0 100px}
  .principal-head{margin-bottom:2.8rem}
  .principal-stage{width:100%;gap:.35rem}
  .principal-viewport{padding:8px 4px 18px}
  .principal-post{flex-basis:86vw;max-width:430px}
  .principal-photo{min-height:390px}
  .principal-arrow{flex-basis:42px;width:42px;height:42px;font-size:.9rem}
  .principal-section::before{width:150px;height:150px;left:-45px;bottom:70px}
  .principal-section::after{width:140px;height:140px;right:-45px;top:150px}
  .principal-section .home-orn .ho-chevron{width:260px;height:260px;left:-110px;top:30px}
  .principal-section .home-orn .ho-ring{width:150px;height:150px;right:-60px}
  .principal-section .home-orn .ho-dots{width:90px;height:90px;background-size:14px 14px}
}

/* ---------- VIRTUAL TOUR 360 ---------- */
.vt-section{position:relative;overflow:hidden;isolation:isolate;padding:120px 0 130px;scroll-margin-top:90px;
  background:linear-gradient(180deg,#eef5fb 0%,#ffffff 48%,#f3f7fb 100%)}
.vt-section::before{content:"";position:absolute;inset:0;pointer-events:none;opacity:.42;background-image:radial-gradient(circle,rgba(13,58,102,.18) 1.5px,transparent 2px);background-size:22px 22px;mask-image:linear-gradient(90deg,transparent 0%,#000 15%,#000 85%,transparent 100%)}
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
.vt-play{position:absolute;z-index:4;left:50%;top:50%;transform:translate(-50%,-50%);width:78px;height:78px;border-radius:50%;border:7px solid rgba(255,255,255,.22);background:linear-gradient(135deg,#ffd54a,#ff8a00);color:#0d3a66;font-size:1.35rem;display:grid;place-items:center;cursor:pointer;box-shadow:0 18px 45px rgba(255,138,0,.38);transition:transform .3s ease,box-shadow .3s ease}
.vt-frame:hover .vt-play,.vt-play:hover{transform:translate(-50%,-50%) scale(1.08);box-shadow:0 24px 55px rgba(255,138,0,.5)}
.vt-caption{position:absolute;left:1.4rem;right:1.4rem;bottom:1.25rem;z-index:3;display:flex;align-items:flex-end;justify-content:space-between;gap:1rem;color:#fff}
.vt-caption strong{display:block;font-size:1.2rem;font-weight:900}
.vt-caption span{display:block;margin-top:.22rem;color:rgba(255,255,255,.76);font-size:.78rem}
.vt-cam{display:inline-flex!important;align-items:center;gap:.4rem;padding:.48rem .7rem;border:1px solid rgba(255,255,255,.28);border-radius:999px!important;background:rgba(0,0,0,.18);white-space:nowrap}
.vt-chip{display:inline-flex;align-items:center;gap:.75rem;margin-top:1rem;padding:.75rem 1rem;border-radius:16px;background:#fff;border:1px solid rgba(13,58,102,.1);box-shadow:0 12px 30px rgba(13,58,102,.08)}
.vt-chip>i{width:40px;height:40px;border-radius:12px;display:grid;place-items:center;background:linear-gradient(135deg,#ffd54a,#ff9f00);color:#0d3a66}
.vt-chip strong{display:block;color:#0d3a66;font-size:.85rem}
.vt-chip span{display:block;color:#71839a;font-size:.68rem;margin-top:.15rem}
.vt-copy{position:relative;padding-top:.25rem}
.vt-kicker{display:inline-flex;align-items:center;gap:.55rem;color:#0d3a66;font-size:.75rem;font-weight:900;letter-spacing:.16em;text-transform:uppercase}
.vt-kicker::before{content:"";width:34px;height:3px;border-radius:99px;background:linear-gradient(90deg,#ffd54a,#ff8a00)}
.vt-title{margin:.8rem 0 1.1rem;max-width:620px;color:#0d3a66;font-family:var(--font-display);font-size:clamp(2.8rem,5vw,4.8rem);font-weight:900;line-height:.98;letter-spacing:-.045em}
.vt-desc{max-width:590px;margin-top:.2rem;color:#667b90;line-height:1.9;font-size:.98rem}
.vt-feats{display:flex;flex-wrap:wrap;gap:.55rem;margin:1.25rem 0}
.vt-feat{display:inline-flex;align-items:center;gap:.4rem;padding:.55rem .75rem;border-radius:999px;background:#fff;border:1px solid rgba(13,58,102,.1);color:#315b80;font-size:.74rem;font-weight:800}
.vt-feat i{color:#ff9f00}
.vt-btn{display:inline-flex;align-items:center;justify-content:center;gap:.65rem;padding:.9rem 1.2rem;border-radius:14px;background:linear-gradient(135deg,#0d3a66,#164e80);color:#fff;text-decoration:none;font-weight:900;box-shadow:0 14px 32px rgba(13,58,102,.2);transition:transform .3s ease,box-shadow .3s ease}
.vt-btn:hover{transform:translateY(-4px);box-shadow:0 20px 40px rgba(13,58,102,.28)}
@media(max-width:900px){.vt-inner{grid-template-columns:1fr;gap:2.5rem}.vt-copy{max-width:700px}.vt-title{font-size:clamp(2.6rem,10vw,4rem)}}
@media(max-width:600px){.vt-section{padding:85px 0 95px}.vt-inner{width:92%;gap:2rem}.vt-frame{aspect-ratio:4/3;border-radius:22px}.vt-play{width:64px;height:64px}.vt-caption{left:1rem;right:1rem;bottom:1rem}.vt-caption strong{font-size:1rem}.vt-caption span{font-size:.7rem}.vt-cam{display:none!important}.vt-title{font-size:clamp(2.35rem,12vw,3.3rem)}.vt-decor-ring{width:190px;height:190px;right:-80px}.vt-decor-dots{width:90px;height:90px;background-size:14px 14px}}

/* ================= HISTORY BOOK ================= */
.history-book-section{padding:96px 0 112px;overflow:hidden}
.history-book-stage{display:flex;flex-direction:column;align-items:center;position:relative}
.history-book-stage{position:relative;isolation:isolate;padding:34px 0 28px}
.history-book-stage::before{content:"";position:absolute;z-index:0;width:250px;height:250px;left:-70px;top:70px;border:1px solid rgba(13,58,102,.16);border-radius:50%;
  box-shadow:0 0 0 20px rgba(13,58,102,.035),0 0 0 42px rgba(13,58,102,.025),0 0 0 64px rgba(255,179,0,.035);pointer-events:none}
.history-book-stage::after{content:"";position:absolute;z-index:0;width:190px;height:190px;right:-45px;bottom:35px;border:1px solid rgba(255,179,0,.26);border-radius:50%;
  box-shadow:0 0 0 18px rgba(255,179,0,.035),0 0 0 38px rgba(13,58,102,.025);pointer-events:none}
.history-book-stage .history-book::before{content:"";position:absolute;z-index:0;width:125px;height:125px;left:-175px;top:75px;opacity:.9;background-image:radial-gradient(circle,rgba(13,58,102,.28) 2px,transparent 2.4px);background-size:14px 14px;pointer-events:none}
.history-book-stage .history-book::after{content:"";position:absolute;z-index:0;width:125px;height:125px;right:-175px;bottom:75px;opacity:.85;background-image:radial-gradient(circle,rgba(255,179,0,.42) 2px,transparent 2.4px);background-size:15px 15px;pointer-events:none}
.history-book-stage .book-actions::before{content:"";position:absolute;z-index:0;width:58px;height:58px;left:-125px;top:-260px;border:1px solid rgba(255,179,0,.38);transform:rotate(45deg);border-radius:3px;pointer-events:none}
.history-book-stage .book-actions::after{content:"";position:absolute;z-index:0;width:110px;height:1px;right:-155px;top:-225px;background:linear-gradient(90deg,transparent,rgba(13,58,102,.22),rgba(255,179,0,.5));transform:rotate(-38deg);transform-origin:left center;box-shadow:0 18px 0 rgba(13,58,102,.09);pointer-events:none}
.history-book-stage > .history-book{position:relative;z-index:3}
.history-book-stage > .book-actions{position:relative;z-index:4}
@media(max-width:820px){
  .history-book-stage::before{left:-125px;width:210px;height:210px}
  .history-book-stage::after{right:-90px;width:160px;height:160px}
  .history-book-stage .history-book::before{left:-105px}
  .history-book-stage .history-book::after{right:-105px}
}
@media(max-width:600px){
  .history-book-stage{padding-left:8px;padding-right:8px}
  .history-book-stage::before{left:-135px;width:170px;height:170px}
  .history-book-stage::after{right:-120px;width:140px;height:140px}
  .history-book-stage .history-book::before{left:-82px;opacity:.55}
  .history-book-stage .history-book::after{right:-82px;opacity:.5}
}
.history-book-stage::before{z-index:-3;width:270px;height:270px;left:clamp(-170px,-13vw,-75px);top:18%;border:1px solid rgba(13,58,102,.10);
  box-shadow:0 0 0 22px rgba(13,58,102,.025),0 0 0 44px rgba(13,58,102,.018),0 0 0 66px rgba(255,179,0,.025)}
.history-book-stage::after{z-index:-2;width:170px;height:170px;right:clamp(-105px,-9vw,-45px);bottom:8%;border:1px solid rgba(255,179,0,.20);
  box-shadow:0 0 0 18px rgba(255,179,0,.025),0 0 0 36px rgba(13,58,102,.018)}
.history-book-stage .history-book{position:relative;z-index:2}
.history-book-stage .history-book::before{z-index:-2;width:145px;height:145px;left:-185px;top:20px;opacity:.72;background-image:radial-gradient(circle,rgba(13,58,102,.23) 1.4px,transparent 1.7px);background-size:14px 14px;mask-image:linear-gradient(135deg,black,transparent 78%);-webkit-mask-image:linear-gradient(135deg,black,transparent 78%)}
.history-book-stage .history-book::after{z-index:-2;width:150px;height:150px;right:-190px;bottom:20px;opacity:.62;background-image:radial-gradient(circle,rgba(255,179,0,.32) 1.4px,transparent 1.8px);background-size:15px 15px;mask-image:linear-gradient(315deg,black,transparent 78%);-webkit-mask-image:linear-gradient(315deg,black,transparent 78%)}
.history-book-stage .book-actions{position:relative;z-index:4}
.history-book-stage .history-book + .book-actions::before{content:"";position:absolute;width:42px;height:42px;left:-105px;top:-4px;border:1px solid rgba(255,179,0,.34);transform:rotate(45deg);border-radius:3px;pointer-events:none}
.history-book-stage .history-book + .book-actions::after{content:"";position:absolute;width:8px;height:8px;right:-92px;top:7px;border-radius:50%;background:#ffd04a;box-shadow:22px 13px 0 rgba(13,58,102,.18),44px -7px 0 rgba(255,179,0,.22);pointer-events:none}
@media(max-width:820px){
  .history-book-stage::before{left:-120px;width:210px;height:210px}
  .history-book-stage::after{right:-85px;width:130px;height:130px}
  .history-book-stage .history-book::before{left:-115px}
  .history-book-stage .history-book::after{right:-120px}
}
@media(max-width:600px){
  .history-book-stage::before{left:-135px;top:25%;width:180px;height:180px}
  .history-book-stage::after{right:-115px;bottom:12%;width:110px;height:110px}
  .history-book-stage .history-book::before{left:-95px;opacity:.48}
  .history-book-stage .history-book::after{right:-100px;opacity:.45}
  .history-book-stage .history-book + .book-actions::before{display:none}
}

.history-book{position:relative;width:590px;height:678px;max-width:calc(100vw - 48px);perspective:1800px;filter:drop-shadow(0 22px 30px rgba(13,58,102,.16));transition:width .72s cubic-bezier(.22,.75,.16,1)}
.book-cover{position:absolute;left:0;top:0;width:590px;height:678px;transform:none;transform-origin:left center;z-index:20;border:0;border-radius:8px 15px 15px 8px;padding:0;overflow:hidden;cursor:pointer;color:#fff;background:linear-gradient(145deg,#0b477b,#0d3a66 65%,#092e50);box-shadow:inset 9px 0 18px rgba(0,0,0,.18),0 16px 30px rgba(13,58,102,.18);transition:transform .9s cubic-bezier(.2,.8,.15,1),opacity .45s ease}
.book-cover::before{content:"";position:absolute;inset:12px;border:1px solid rgba(255,213,74,.48);border-radius:5px;z-index:2}
.cover-frame{position:absolute;inset:22px;border:1px solid rgba(255,255,255,.11);border-radius:4px;z-index:2;pointer-events:none}
.cover-topline{position:absolute;top:30px;left:0;right:0;text-align:center;font-size:8px;font-weight:900;letter-spacing:.22em;color:#ffd54a;z-index:3}
.cover-photo{position:absolute;left:56px;right:56px;top:98px;height:294px;border-radius:7px;overflow:hidden;border:2px solid rgba(255,255,255,.35);z-index:1}
.cover-photo img{width:100%;height:100%;object-fit:cover;display:block;filter:saturate(.92)}
.cover-est{position:absolute;left:57px;top:414px;font-size:8px;font-weight:900;letter-spacing:.2em;color:#ffd54a;z-index:3}
.cover-title{position:absolute;left:56px;right:56px;top:447px;text-align:left;font-family:var(--font-display);font-size:35px;line-height:.93;font-weight:900;letter-spacing:-.02em;z-index:3}
.cover-title b{color:#ffd04a}
.cover-foot{position:absolute;left:56px;right:56px;bottom:26px;display:flex;justify-content:space-between;font-size:5.5px;font-weight:800;letter-spacing:.1em;color:rgba(255,255,255,.45);z-index:3}

.book-spread{position:absolute;left:0;top:0;width:1180px;height:678px;display:grid;grid-template-columns:1fr 1fr;border-radius:10px;overflow:hidden;background:#f4ecda;box-shadow:inset 0 0 0 1px rgba(76,58,35,.13);opacity:0;visibility:hidden;pointer-events:none;transform:scale(.985);transform-origin:center;transition:opacity .3s ease .42s,transform .72s cubic-bezier(.22,.75,.16,1) .08s,visibility 0s linear .78s}
.book-spread::before{content:"";position:absolute;left:50%;top:0;bottom:0;width:18px;transform:translateX(-50%);z-index:8;background:linear-gradient(90deg,rgba(0,0,0,.06),rgba(255,255,255,.5) 42%,rgba(0,0,0,.07));opacity:.55;pointer-events:none}
.book-spread::after{content:"";position:absolute;inset:0;z-index:9;pointer-events:none;background:linear-gradient(90deg,rgba(255,255,255,.08),transparent 14%,transparent 86%,rgba(0,0,0,.025))}
.book-page{position:absolute;top:0;bottom:0;width:50%;padding:50px 50px 42px;display:none;color:#536474;background:repeating-linear-gradient(0deg,transparent 0 28px,rgba(91,72,44,.045) 29px,transparent 30px),linear-gradient(105deg,#f1e7d3,#fbf8ed 55%,#eee4d1);overflow:hidden}
.book-page.is-active{display:block}
.page-left{left:0;text-align:left;border-right:1px solid rgba(80,60,35,.09)}
.page-right{right:0}
.book-page::after{content:"";position:absolute;right:28px;bottom:24px;width:58px;height:58px;border:1px solid rgba(13,58,102,.07);border-radius:50%;box-shadow:0 0 0 10px rgba(255,179,0,.035),0 0 0 20px rgba(13,58,102,.025)}
.page-corner{position:absolute;top:22px;right:28px;font-size:8px;font-weight:900;color:#a49783;letter-spacing:.08em}
.page-kicker{font-size:7px;font-weight:900;letter-spacing:.2em;color:#0d3a66;margin-bottom:7px}
.page-year{font-family:var(--font-display);font-size:30px;line-height:1;color:#0d3a66;font-weight:900;letter-spacing:-.04em}
.page-rule{width:42px;height:2px;background:#ffb300;margin:10px 0 17px}
.page-icon{width:34px;height:34px;border-radius:50%;display:grid;place-items:center;background:#0d3a66;color:#ffd04a;font-size:12px;margin-bottom:13px;box-shadow:0 7px 14px rgba(13,58,102,.13)}
.book-page h3{margin:0 0 12px;font-family:var(--font-display);font-size:25px;line-height:.98;letter-spacing:-.025em;color:#0d3a66;font-weight:900}
.book-page h4{position:relative;margin:6px 0 12px;max-width:280px;font-family:var(--font-display);font-size:28px;line-height:.98;letter-spacing:-.03em;color:#0d3a66;font-weight:900}
.book-page p{position:relative;z-index:1;margin:0;max-width:280px;font-size:10px;line-height:1.75;color:#687888}
.book-page .lead{font-size:12px;line-height:1.55;color:#3f5568;font-weight:700;margin-bottom:11px}
.page-number-big{position:absolute;right:29px;top:47px;font-family:var(--font-display);font-size:68px;line-height:.8;font-weight:900;color:rgba(13,58,102,.08);letter-spacing:-.05em}
.quote-mark{font-family:Georgia,serif;font-size:54px;line-height:.6;color:#ffb300;margin:22px 0 4px}
.page-note{position:absolute;left:42px;right:40px;bottom:61px;padding:9px 10px 9px 12px;border-left:2px solid #ffb300;background:rgba(255,255,255,.55);font-size:8px;line-height:1.55;color:#4d6377;font-weight:700;z-index:2}
.page-tag{display:inline-block;margin-top:14px;padding:5px 8px;border-radius:99px;background:rgba(255,179,0,.13);color:#a77700;font-size:6px;font-weight:900;letter-spacing:.12em;text-transform:uppercase}
.page-footer{position:absolute;left:42px;right:42px;bottom:19px;padding-top:7px;border-top:1px solid rgba(80,60,35,.1);display:flex;justify-content:space-between;font-size:5.5px;font-weight:900;letter-spacing:.1em;color:#a49a8b;z-index:3}
.page-footer span:last-child{color:#0d3a66}

.history-book.is-open{width:1180px}
.history-book.is-open .book-spread{opacity:1;visibility:visible;pointer-events:auto;transform:scale(1);transition:opacity .32s ease .1s,transform .72s cubic-bezier(.22,.75,.16,1),visibility 0s linear 0s}
.history-book.is-open .book-cover{transform:rotateY(-165deg);opacity:0;pointer-events:none;box-shadow:inset 9px 0 18px rgba(0,0,0,.08),0 8px 16px rgba(13,58,102,.08)}

.book-actions{display:flex;align-items:center;justify-content:center;gap:14px;margin-top:17px}
.book-nav{width:34px;height:34px;border-radius:50%;border:0;background:#0d3a66;color:#fff;cursor:pointer;display:grid;place-items:center;font-size:10px;box-shadow:0 8px 16px rgba(13,58,102,.13);transition:.2s ease}
.book-nav:hover{transform:translateY(-2px);background:#125084}
.book-nav:disabled{opacity:.28;cursor:default;transform:none}
.book-open{height:34px;padding:0 15px;border:0;border-radius:99px;background:#ffb300;color:#fff;font-size:8px;font-weight:900;letter-spacing:.06em;text-transform:uppercase;display:flex;gap:7px;align-items:center;cursor:pointer;box-shadow:0 8px 16px rgba(255,179,0,.18)}
.book-count{font-size:9px;color:#8994a0;font-weight:800;min-width:48px;text-align:center}
.book-count b{font-size:14px;color:#0d3a66}

@media(max-width:820px){
  .history-book{width:calc(50vw - 12px);height:590px}
  .history-book.is-open{width:calc(100vw - 36px)}
  .book-cover{width:100%;height:590px}
  .book-spread{width:calc(100vw - 36px);height:590px}
  .cover-photo{left:25px;right:25px;height:170px}
  .cover-title{left:25px;right:25px;top:267px;font-size:20px}
  .cover-est{left:25px;top:240px}
  .cover-foot{left:25px;right:25px}
  .book-page{padding:42px 38px 34px}.book-page h3{font-size:22px}.book-page h4{font-size:24px}
  .page-note{left:30px;right:28px}.page-footer{left:30px;right:30px}
}
@media(max-width:600px){
  .history-book-section{padding-top:70px}
  .history-book{width:calc(100vw - 52px);height:390px}
  .history-book.is-open{width:calc(100vw - 24px)}
  .book-cover{width:100%;height:390px}
  .book-spread{width:calc(100vw - 24px);height:390px}
  .cover-photo{top:57px;height:145px}
  .cover-title{top:226px;font-size:17px}.cover-est{top:210px}
  .cover-foot{display:none}
  .book-page{padding:34px 25px 28px}.page-year{font-size:25px}
  .book-page h3{font-size:18px}.book-page h4{font-size:20px}
  .book-page p{font-size:8px;line-height:1.6}.book-page .lead{font-size:9px}
  .page-number-big{font-size:52px;right:20px}.page-note{left:22px;right:20px;bottom:50px;font-size:7px}
  .page-footer{left:22px;right:20px}.page-corner{right:18px}
  .page-icon{width:30px;height:30px;font-size:10px}
}

/* FINAL BOOK LAYOUT — TITLE BESIDE BOOK */
.history-book-stage{width:min(1180px,94%);margin:0 auto;display:grid!important;grid-template-columns:280px 800px;grid-template-rows:auto auto;column-gap:68px;align-items:center;justify-content:center;justify-items:start;padding:54px 0 34px!important}
.history-book-side-title{grid-column:1;grid-row:1;align-self:center;position:relative;z-index:5;width:280px;max-width:280px;padding:8px 0;text-align:left;transform:translateX(-34px)}
.side-title-kicker{display:inline-block;font-size:9px;font-weight:900;letter-spacing:.2em;color:#ff9f00;text-transform:uppercase;margin-bottom:14px}
.history-book-side-title h2{margin:0;font-family:var(--font-display);font-size:clamp(3.25rem,4.15vw,4.15rem);line-height:.86;letter-spacing:-.04em;color:#0d3a66}
.history-book-side-title h2 b{display:block;color:#0d3a66!important;background:none!important;-webkit-text-fill-color:#0d3a66!important}
.history-book-side-title p{margin:18px 0 0;max-width:250px;color:#718396;font-size:.78rem;line-height:1.75}
.side-title-line{display:block;width:54px;height:3px;margin-top:20px;border-radius:99px;background:linear-gradient(90deg,#0d3a66,#ffb300)}
.history-book{grid-column:2;grid-row:1;position:relative;width:400px!important;height:540px!important;justify-self:start;transition:width .65s cubic-bezier(.22,.75,.16,1),height .45s ease}
.history-book.is-open{width:800px!important;height:540px!important;justify-self:start}
.book-cover{width:400px!important;height:540px!important}
.cover-photo{left:38px!important;right:38px!important;top:82px!important;height:230px!important}
.cover-topline{top:25px!important}
.cover-est{left:39px!important;top:329px!important}
.cover-title{left:38px!important;right:38px!important;top:360px!important;font-size:27px!important}
.cover-foot{left:38px!important;right:38px!important;bottom:21px!important}
.book-spread{width:800px!important;height:540px!important;grid-template-columns:400px 400px!important;border-radius:10px!important}
.book-spread::before{display:none!important}
.book-page{width:400px!important;padding:46px 46px 38px!important}
.book-page.page-left{display:none!important}
.book-page.page-right.is-active{display:block!important;left:400px!important;right:auto!important;width:400px!important}
.book-page h4{max-width:305px!important;font-size:28px!important}
.book-page p{max-width:305px!important;font-size:10px!important;line-height:1.75!important}
.book-page .lead{max-width:305px!important;font-size:11px!important}
.page-note{left:46px!important;right:46px!important;max-width:none!important}
.page-footer{left:46px!important;right:46px!important}
.book-actions{grid-column:2;grid-row:2;justify-self:start;margin-top:18px!important;margin-left:180px!important}
@media(min-width:1200px){
  .history-book-stage{grid-template-columns:280px 800px;column-gap:68px}
  .history-book-side-title{width:280px;max-width:280px;transform:translateX(-34px)}
  .history-book-side-title h2{font-size:4.15rem}
}
@media(max-width:1180px){
  .history-book-stage{grid-template-columns:270px minmax(0,1fr);column-gap:28px;width:96%}
  .history-book-side-title{width:270px;max-width:270px;transform:translateX(-22px)}
  .history-book-side-title h2{font-size:clamp(3rem,5vw,3.8rem)}
  .history-book{width:380px!important;height:520px!important}
  .history-book.is-open{width:760px!important;height:520px!important}
  .book-cover{width:380px!important;height:520px!important}
  .book-spread{width:760px!important;height:520px!important;grid-template-columns:380px 380px!important}
  .book-page{width:380px!important;padding:42px 40px 34px!important}
  .book-page.page-right.is-active{left:380px!important;width:380px!important}
  .cover-photo{left:36px!important;right:36px!important;top:78px!important;height:220px!important}
  .cover-est{left:37px!important;top:315px!important}
  .cover-title{left:36px!important;right:36px!important;top:344px!important;font-size:25px!important}
  .cover-foot{left:36px!important;right:36px!important}
  .book-page h4{font-size:26px!important;max-width:295px!important}
  .book-page p,.book-page .lead{max-width:295px!important}
  .book-actions{margin-left:160px!important}
}
@media(max-width:820px){
  .history-book-stage{width:94%!important;display:flex!important;flex-direction:column!important;align-items:center!important;gap:20px!important;padding:50px 0 28px!important}
  .history-book-side-title{order:0;width:100%;max-width:520px;text-align:center;padding:0}
  .history-book-side-title h2{font-size:clamp(2.2rem,9vw,3.4rem)}
  .history-book-side-title p{max-width:480px;margin:14px auto 0;font-size:.76rem}
  .side-title-line{margin:16px auto 0}
  .history-book{order:1;width:330px!important;height:440px!important}
  .history-book.is-open{width:660px!important;height:440px!important;max-width:94vw}
  .book-cover{width:330px!important;height:440px!important}
  .book-spread{width:660px!important;height:440px!important;grid-template-columns:330px 330px!important}
  .book-page{width:330px!important;padding:34px 30px 28px!important}
  .book-page.page-right.is-active{left:330px!important;width:330px!important}
  .cover-photo{left:30px!important;right:30px!important;top:64px!important;height:150px!important}
  .cover-topline{top:19px!important;font-size:6px!important}
  .cover-est{left:31px!important;top:226px!important;font-size:6px!important}
  .cover-title{left:30px!important;right:30px!important;top:250px!important;font-size:20px!important}
  .cover-foot{left:30px!important;right:30px!important;bottom:16px!important;font-size:4.5px!important}
  .book-page h4{font-size:22px!important;max-width:270px!important}
  .book-page p{font-size:8px!important;line-height:1.65!important;max-width:270px!important}
  .book-page .lead{font-size:9px!important;max-width:270px!important}
  .page-note{left:30px!important;right:30px!important;font-size:8px!important}
  .page-footer{left:30px!important;right:30px!important}
  .book-actions{order:2;grid-column:auto;grid-row:auto;margin:2px 0 0!important}
}
@media(max-width:700px){
  .history-book{width:300px!important;height:400px!important}
  .history-book.is-open{width:600px!important;height:400px!important;max-width:92vw}
  .book-cover{width:300px!important;height:400px!important}
  .book-spread{width:600px!important;height:400px!important;grid-template-columns:300px 300px!important}
  .book-page{width:300px!important;padding:29px 26px 25px!important}
  .book-page.page-right.is-active{left:300px!important;width:300px!important}
  .cover-photo{left:27px!important;right:27px!important;top:57px!important;height:135px!important}
  .cover-est{left:28px!important;top:202px!important}
  .cover-title{left:27px!important;right:27px!important;top:224px!important;font-size:18px!important}
  .book-page h4{font-size:19px!important;max-width:245px!important}
  .book-page p{font-size:7px!important;max-width:245px!important}
  .book-page .lead{font-size:8px!important;max-width:245px!important}
  .page-note{left:26px!important;right:26px!important;font-size:7px!important}
  .page-footer{left:26px!important;right:26px!important}
}
@media(max-width:430px){
  .history-book{width:280px!important;height:375px!important}
  .history-book.is-open{width:560px!important;height:375px!important;max-width:92vw}
  .book-cover{width:280px!important;height:375px!important}
  .book-spread{width:560px!important;height:375px!important;grid-template-columns:280px 280px!important}
  .book-page{width:280px!important;padding:27px 23px 23px!important}
  .book-page.page-right.is-active{left:280px!important;width:280px!important}
  .cover-photo{left:25px!important;right:25px!important;top:53px!important;height:126px!important}
  .cover-est{left:26px!important;top:190px!important}
  .cover-title{left:25px!important;right:25px!important;top:210px!important;font-size:17px!important}
}
</style>
<style>
/* ===== FINAL BOOK FIX — COVER + ONE PAGE ===== */
.history-book-stage{width:min(1180px,94%)!important;display:grid!important;grid-template-columns:minmax(300px,360px) minmax(0,720px)!important;grid-template-rows:auto auto!important;column-gap:44px!important;align-items:center!important;justify-content:center!important;padding:48px 0 30px!important}
.history-book-side-title{grid-column:1!important;grid-row:1!important;max-width:360px!important;align-self:center!important;text-align:left!important;padding:0!important}
.side-title-kicker{font-size:10px!important;letter-spacing:.2em!important;margin-bottom:16px!important}
.history-book-side-title h2{font-size:clamp(3rem,4.5vw,4.25rem)!important;line-height:.86!important;letter-spacing:-.045em!important}
.history-book-side-title p{max-width:310px!important;margin-top:20px!important;font-size:.82rem!important;line-height:1.75!important}
.side-title-line{width:62px!important;height:4px!important;margin-top:20px!important}
.history-book{grid-column:2!important;grid-row:1!important;width:360px!important;height:540px!important;max-width:none!important;justify-self:center!important;transition:width .65s cubic-bezier(.22,.75,.16,1)!important}
.book-cover{width:360px!important;height:540px!important;opacity:1!important;transform:none!important}
.book-spread{left:360px!important;top:0!important;width:360px!important;height:540px!important;grid-template-columns:1fr!important;border-radius:0 10px 10px 0!important}
.book-page{width:100%!important;left:0!important;right:auto!important;padding:44px 48px 36px!important;border-right:0!important}
.book-page.page-left{display:none!important}
.book-page.page-right.is-active{display:block!important}
.book-page h4{max-width:260px!important;font-size:28px!important;line-height:.98!important}
.book-page p{max-width:270px!important;font-size:9.5px!important;line-height:1.75!important}
.book-page .lead{max-width:275px!important;font-size:11px!important}
.page-number-big{font-size:62px!important}
.page-note{left:48px!important;right:48px!important;max-width:264px!important;font-size:8px!important}
.page-footer{left:48px!important;right:48px!important}
.history-book.is-open{width:720px!important;height:540px!important}
.history-book.is-open .book-cover{transform:none!important;opacity:1!important;pointer-events:none!important;z-index:20!important}
.history-book.is-open .book-spread{opacity:1!important;visibility:visible!important;pointer-events:auto!important;transform:none!important;transition:opacity .35s ease,transform .5s ease!important}
.book-actions{grid-column:2!important;grid-row:2!important;justify-self:center!important;margin-top:16px!important}
@media(max-width:1080px){
  .history-book-stage{grid-template-columns:280px 640px!important;column-gap:28px!important;width:96%!important}
  .history-book,.book-cover{width:320px!important;height:500px!important}
  .history-book.is-open{width:640px!important;height:500px!important}
  .book-spread{left:320px!important;width:320px!important;height:500px!important}
  .history-book-side-title h2{font-size:3.25rem!important}
  .cover-photo{left:38px!important;right:38px!important;top:72px!important;height:205px!important}
  .cover-est{left:39px!important;top:293px!important}
  .cover-title{left:38px!important;right:38px!important;top:320px!important;font-size:25px!important}
  .cover-foot{left:38px!important;right:38px!important}
  .book-page{padding:40px 42px 34px!important}
  .page-note{left:42px!important;right:42px!important}
  .page-footer{left:42px!important;right:42px!important}
}
@media(max-width:700px){
  .history-book-stage{width:92%!important;display:flex!important;flex-direction:column!important;align-items:center!important;gap:20px!important;padding:48px 0 28px!important}
  .history-book-side-title{order:0;width:100%!important;max-width:500px!important;text-align:center!important}
  .history-book-side-title h2{font-size:clamp(2.5rem,10vw,3.6rem)!important}
  .history-book-side-title p{max-width:480px!important;margin:14px auto 0!important}
  .side-title-line{margin:17px auto 0!important}
  .history-book{order:1;width:330px!important;height:420px!important}
  .history-book.is-open{width:330px!important;height:420px!important}
  .book-cover{width:330px!important;height:420px!important}
  .history-book.is-open .book-cover{opacity:0!important}
  .book-spread{left:0!important;width:330px!important;height:420px!important;border-radius:10px!important}
  .book-page{padding:34px 34px 30px!important}
  .book-page h4{font-size:24px!important}
  .book-page p{font-size:9px!important;line-height:1.65!important}
  .book-page .lead{font-size:10px!important}
  .page-note{left:34px!important;right:34px!important;max-width:none!important;font-size:8px!important}
  .page-footer{left:34px!important;right:34px!important}
  .book-actions{order:2!important;grid-column:auto!important;grid-row:auto!important;margin-top:0!important}
}
@media(max-width:430px){
  .history-book{width:300px!important;height:390px!important}
  .history-book.is-open{width:300px!important;height:390px!important}
  .book-cover{width:300px!important;height:390px!important}
  .book-spread{left:0!important;width:300px!important;height:390px!important}
  .history-book-side-title h2{font-size:clamp(2.3rem,11vw,3.2rem)!important}
  .cover-photo{left:27px!important;right:27px!important;top:56px!important;height:132px!important}
  .cover-est{left:28px!important;top:200px!important}
  .cover-title{left:27px!important;right:27px!important;top:222px!important;font-size:18px!important}
  .book-page{padding:28px 27px 25px!important}
  .page-note{left:27px!important;right:27px!important}
  .page-footer{left:27px!important;right:27px!important}
}
</style>

<style>
/* ===== EXACT MOCKUP OVERRIDE ===== */
.history-book-stage{width:min(1070px,96vw)!important;margin:0 auto!important;display:grid!important;grid-template-columns:310px 720px!important;grid-template-rows:auto auto!important;column-gap:40px!important;align-items:center!important;justify-content:center!important;justify-items:start!important;padding:42px 0 28px!important;overflow:visible!important}
.history-book-side-title{grid-column:1!important;grid-row:1!important;width:310px!important;max-width:310px!important;min-width:310px!important;padding:0!important;margin:0!important;text-align:left!important;align-self:center!important;z-index:10!important;overflow:visible!important}
.history-book-side-title h2{width:310px!important;max-width:310px!important;margin:0!important;font-size:3.35rem!important;line-height:.86!important;letter-spacing:-.045em!important;white-space:normal!important}
.history-book-side-title h2 b{display:block!important;white-space:nowrap!important}
.history-book-side-title p{width:255px!important;max-width:255px!important;margin:18px 0 0!important}
.history-book{grid-column:2!important;grid-row:1!important;width:360px!important;height:540px!important;min-width:360px!important;max-width:none!important;justify-self:start!important;margin:0!important;position:relative!important;z-index:6!important}
.history-book.is-open{width:720px!important;height:540px!important}
.book-cover{width:360px!important;height:540px!important;z-index:20!important}
.book-spread{left:0!important;top:0!important;width:720px!important;height:540px!important;display:block!important;border-radius:10px!important;overflow:hidden!important;grid-template-columns:none!important}
.book-page.page-left{display:none!important}
.book-page.page-right.is-active{display:block!important;position:absolute!important;left:360px!important;top:0!important;width:360px!important;height:540px!important;right:auto!important;padding:44px 40px 34px!important;box-sizing:border-box!important}
.book-page h4{font-size:26px!important;max-width:280px!important}
.book-page p{font-size:9px!important;max-width:280px!important;line-height:1.7!important}
.book-page .lead{font-size:10px!important;max-width:280px!important}
.page-note{left:40px!important;right:40px!important;max-width:280px!important}
.page-footer{left:40px!important;right:40px!important}
.book-actions{grid-column:2!important;grid-row:2!important;justify-self:start!important;margin:16px 0 0 150px!important}
@media(max-width:1120px){
  .history-book-stage{width:96vw!important;grid-template-columns:280px 680px!important;column-gap:28px!important}
  .history-book-side-title{width:280px!important;min-width:280px!important;max-width:280px!important}
  .history-book-side-title h2{width:280px!important;max-width:280px!important;font-size:3rem!important}
  .history-book{width:340px!important;height:510px!important}
  .history-book.is-open{width:680px!important;height:510px!important}
  .book-cover{width:340px!important;height:510px!important}
  .book-spread{width:680px!important;height:510px!important}
  .book-page.page-right.is-active{left:340px!important;width:340px!important;height:510px!important}
}
@media(max-width:900px){
  .history-book-stage{width:94vw!important;display:flex!important;flex-direction:column!important;align-items:flex-start!important;gap:24px!important}
  .history-book-side-title{width:100%!important;min-width:0!important;max-width:330px!important;margin-left:0!important}
  .history-book-side-title h2{width:100%!important;max-width:330px!important;font-size:3.1rem!important}
  .history-book{align-self:center!important;width:340px!important;height:510px!important}
  .history-book.is-open{width:680px!important;height:510px!important;align-self:flex-start!important}
  .book-cover{width:340px!important;height:510px!important}
  .book-spread{width:680px!important;height:510px!important}
  .book-page.page-right.is-active{left:340px!important;width:340px!important;height:510px!important}
  .book-actions{align-self:center!important;margin:0!important}
}
@media(max-width:700px){
  .history-book-side-title h2{font-size:clamp(2.6rem,11vw,3.4rem)!important}
  .history-book,.history-book.is-open{width:310px!important;height:430px!important;align-self:center!important}
  .book-cover{width:310px!important;height:430px!important}
  .book-spread{width:310px!important;height:430px!important}
  .history-book.is-open .book-cover{opacity:0!important}
  .book-page.page-right.is-active{left:0!important;width:310px!important;height:430px!important;padding:34px 30px 28px!important}
  .book-page h4{font-size:23px!important}
  .book-page p{font-size:8.5px!important}
}
</style>

<style>
/* FINAL POSITION FIX */
@media (min-width:1121px){
  .history-book-stage{width:min(1300px,96vw)!important;margin-left:auto!important;margin-right:auto!important;grid-template-columns:470px 720px!important;column-gap:30px!important;justify-content:start!important;justify-items:start!important;padding:42px 0 28px!important}
  .history-book-side-title{width:470px!important;min-width:470px!important;max-width:470px!important;margin-left:0!important;padding:0!important}
  .history-book-side-title h2{width:470px!important;max-width:470px!important;font-size:4.5rem!important;line-height:.82!important;letter-spacing:-.055em!important;margin:0!important}
  .history-book-side-title p{width:330px!important;max-width:330px!important;margin-left:0!important;font-size:1rem!important;line-height:1.7!important}
  .history-book{width:360px!important;height:540px!important;min-width:360px!important;justify-self:start!important;margin:0!important}
  .history-book.is-open{width:720px!important;height:540px!important}
  .book-cover{width:360px!important;height:540px!important}
  .book-spread{width:720px!important;height:540px!important}
  .book-page.page-right.is-active{left:360px!important;width:360px!important;height:540px!important}
}
</style>

<style>
/* V4 */
@media (min-width:1121px){
  .history-book-stage{width:min(1300px,96vw)!important;grid-template-columns:470px 720px!important;column-gap:30px!important;justify-content:start!important;justify-items:start!important;padding:42px 0 28px!important}
  .history-book-side-title{grid-column:1!important;grid-row:1!important;width:470px!important;min-width:470px!important;max-width:470px!important;margin:0!important;padding:0!important;transform:none!important;text-align:left!important}
  .history-book-side-title h2{width:470px!important;max-width:470px!important;font-size:4.5rem!important;line-height:.82!important;letter-spacing:-.055em!important;margin:0!important}
  .history-book-side-title p{width:330px!important;max-width:330px!important;margin:18px 0 0!important;font-size:1rem!important;line-height:1.7!important}
  .history-book{grid-column:2!important;grid-row:1!important;width:360px!important;height:540px!important;min-width:360px!important;max-width:none!important;justify-self:center!important;margin:0!important;transform:translateX(0)!important;transition:width .72s cubic-bezier(.22,.75,.16,1),transform .72s cubic-bezier(.22,.75,.16,1)!important}
  .history-book.is-open{width:720px!important;height:540px!important;justify-self:start!important;transform:translateX(-180px)!important}
  .book-cover{width:360px!important;height:540px!important;transform:none!important;opacity:1!important;transition:none!important;pointer-events:auto!important}
  .book-spread{left:0!important;top:0!important;width:720px!important;height:540px!important;display:block!important;grid-template-columns:none!important;border-radius:10px!important}
  .book-page.page-left{display:none!important}
  .book-page.page-right.is-active{display:block!important;position:absolute!important;left:360px!important;top:0!important;width:360px!important;height:540px!important;right:auto!important;padding:44px 40px 34px!important;box-sizing:border-box!important}
  .book-actions{grid-column:2!important;grid-row:2!important;justify-self:center!important;margin:16px 0 0!important;transform:translateX(-180px)!important}
}
</style>

<style>
/* FINAL V5 */
@media (min-width: 821px){
  .history-book-stage{position:relative!important;display:grid!important;width:100%!important;max-width:none!important;grid-template-columns:1fr 400px 1fr!important;grid-template-rows:auto auto!important;column-gap:0!important;justify-content:stretch!important;align-items:center!important;padding:54px 0 34px!important;overflow:visible!important}
  .history-book-side-title{grid-column:1!important;grid-row:1!important;justify-self:start!important;align-self:center!important;width:min(390px,31vw)!important;max-width:min(390px,31vw)!important;margin-left:clamp(28px,5vw,72px)!important;padding:8px 0!important;transform:none!important;z-index:20!important}
  .history-book-side-title h2{font-size:clamp(3.8rem,5vw,5.15rem)!important;line-height:.82!important;letter-spacing:-.055em!important}
  .history-book-side-title p{max-width:300px!important;font-size:.82rem!important}
  .history-book{grid-column:2!important;grid-row:1!important;justify-self:center!important;align-self:center!important;width:400px!important;height:540px!important;transform:translateX(0)!important;transition:transform .72s cubic-bezier(.22,.75,.16,1)!important;z-index:10!important}
  .history-book.is-open{width:800px!important;height:540px!important;justify-self:center!important;transform:translateX(-125px)!important}
  .book-cover{width:400px!important;height:540px!important}
  .book-spread{width:800px!important;height:540px!important;grid-template-columns:400px 400px!important}
  .book-page{width:400px!important}
  .book-page.page-left{display:none!important}
  .book-page.page-right.is-active{display:block!important;left:400px!important;width:400px!important}
  .history-book-stage > .book-actions{grid-column:2!important;grid-row:2!important;justify-self:center!important;margin:18px 0 0!important;transform:translateX(0)!important}
  .history-book.is-open ~ .book-actions{transform:translateX(-125px)!important;transition:transform .72s cubic-bezier(.22,.75,.16,1)!important}
}
@media (min-width:821px) and (max-width:1100px){
  .history-book-side-title{margin-left:28px!important;width:330px!important;max-width:330px!important}
  .history-book-side-title h2{font-size:4rem!important}
  .history-book{transform:translateX(20px)!important}
  .history-book.is-open{transform:translateX(-90px)!important}
  .history-book.is-open ~ .book-actions{transform:translateX(-90px)!important}
}
@media (max-width:820px){
  .history-book-stage{display:flex!important;flex-direction:column!important;align-items:center!important}
  .history-book-side-title{width:100%!important;max-width:520px!important;margin:0 auto!important;transform:none!important;text-align:center!important}
  .history-book-side-title h2{font-size:clamp(2.2rem,9vw,3.4rem)!important}
  .history-book{transform:none!important}
  .history-book.is-open{transform:none!important}
  .history-book.is-open ~ .book-actions{transform:none!important}
}
</style>

<style>
/* V6 */
@media (min-width:821px){
  .history-book{--book-shift:0px;transform:translateX(var(--book-shift))!important;transition:transform .72s cubic-bezier(.22,.75,.16,1)!important}
  .history-book.is-open{transform:translateX(var(--book-shift))!important}
  .history-book-stage > .book-actions{--actions-shift:0px;transform:translateX(var(--actions-shift))!important;transition:transform .72s cubic-bezier(.22,.75,.16,1)!important}
  .history-book.is-open ~ .book-actions{transform:translateX(var(--actions-shift))!important}
}
</style>

<style>
/* V9 + V10 — judul buku & story */
.history-book-side-title h2{line-height:0.98!important}
.story-band{min-height:500px;grid-template-columns:minmax(0,1.02fr) minmax(0,.98fr);background:#082744;isolation:isolate}
.story-image{min-height:500px;position:relative}
.story-image img{object-position:center center;filter:saturate(.98) contrast(1.02)}
.story-image::before{content:"";position:absolute;inset:0;z-index:1;background:linear-gradient(90deg,rgba(8,39,68,0) 50%,rgba(8,39,68,.18) 72%,rgba(8,39,68,.72) 100%),linear-gradient(0deg,rgba(8,39,68,.16),transparent 35%);pointer-events:none}
.story-image::after{background:linear-gradient(90deg,transparent 48%,#082744 100%)}
.story-content{padding:58px clamp(2.5rem,5.5vw,6rem) 58px clamp(2.5rem,5vw,5.5rem);background:linear-gradient(135deg,#082744 0%,#0b3154 58%,#0d3a66 100%)}
.story-content::after{content:"";position:absolute;left:0;top:12%;width:4px;height:76%;background:linear-gradient(#ffd54a,#ff9800,transparent);border-radius:99px;opacity:.9}
.story-content-inner{max-width:590px}
.story-content .eyebrow{display:inline-flex;align-items:center;gap:.65rem;margin-bottom:1.05rem;letter-spacing:.16em}
.story-content h2{font-size:clamp(2.5rem,4.15vw,4.35rem);line-height:.93;letter-spacing:-.045em;margin-bottom:1.25rem;text-wrap:balance}
.story-content h2 span{display:inline-block;padding-right:.12em}
.story-content p{max-width:610px;margin-bottom:1.45rem;color:rgba(255,255,255,.78);line-height:1.75;font-size:.96rem}
.story-list{gap:.8rem}
.story-chip{min-height:52px;display:flex;align-items:center;padding:.85rem 1rem;border-radius:13px;background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.14);box-shadow:inset 0 1px 0 rgba(255,255,255,.05),0 8px 24px rgba(0,0,0,.08);transition:transform .25s ease,background .25s ease,border-color .25s ease}
.story-chip:hover{transform:translateY(-3px);background:rgba(255,255,255,.095);border-color:rgba(255,213,74,.42)}
.story-chip i{width:20px;height:20px;display:inline-flex;align-items:center;justify-content:center;margin-right:.55rem;border-radius:50%;background:rgba(255,213,74,.12)}
.story-content::before{right:-15px;bottom:-70px;opacity:.5}
@media(max-width:900px){
  .story-band{grid-template-columns:1fr;min-height:0}
  .story-image{min-height:380px}
  .story-content{padding:52px 7% 62px}
  .story-content::after{left:7%;top:0;width:74%;height:3px}
}
@media(max-width:560px){
  .story-image{min-height:300px}
  .story-content{padding:42px 7% 52px}
  .story-content h2{font-size:clamp(2.25rem,11vw,3.4rem)}
  .story-content p{font-size:.9rem;line-height:1.7}
  .story-list{grid-template-columns:1fr}
}
</style>

<style>
/* V11 — BUKU SELALU TERBUKA */
.book-open{display:none!important}
.history-book{width:800px!important;height:540px!important}
.history-book.is-open{width:800px!important;height:540px!important}
.history-book .book-cover{width:400px!important;height:540px!important;opacity:1!important;display:block!important}
.history-book .book-spread{width:800px!important;height:540px!important;display:block!important;overflow:hidden!important}
.history-book .book-page.page-left{display:none!important}
.history-book .book-page.page-right.is-active{display:block!important;position:absolute!important;left:400px!important;top:0!important;width:400px!important;height:540px!important}
@media (min-width:821px){
  .history-book{transform:translateX(var(--book-shift,0px))!important}
  .history-book.is-open{transform:translateX(var(--book-shift,0px))!important}
  .history-book.is-open ~ .book-actions{transform:translateX(var(--actions-shift,0px))!important}
}
@media (max-width:820px){
  .history-book,.history-book.is-open{width:680px!important;height:510px!important;transform:none!important}
  .history-book .book-cover{width:340px!important;height:510px!important}
  .history-book .book-spread{width:680px!important;height:510px!important}
  .history-book .book-page.page-right.is-active{left:340px!important;width:340px!important;height:510px!important}
  .history-book.is-open ~ .book-actions{transform:none!important}
}
@media (max-width:768px){
  .history-book-stage{width:100%!important;max-width:100%!important;padding:20px 0!important;overflow:hidden!important}
  .history-book-side-title{width:100%!important;max-width:100%!important;margin:0 0 20px 0!important;transform:none!important}
  .history-book-side-title h2{width:100%!important;max-width:100%!important;font-size:clamp(2.2rem,8.5vw,3.2rem)!important}
  .history-book-side-title p{width:100%!important;max-width:100%!important}
  .history-book,#historyBook,.history-book.is-open,#historyBook.history-book,#historyBook.history-book.is-open{width:min(100%, 340px)!important;height:auto!important;min-height:450px!important;max-width:100%!important;transform:none!important;margin:0 auto!important;align-self:center!important}
  .history-book .book-cover{display:none!important}
  .history-book .book-spread{width:100%!important;height:100%!important;min-height:450px!important;position:relative!important;left:0!important;top:0!important}
  .history-book .book-page.page-right.is-active{left:0!important;top:0!important;width:100%!important;height:100%!important;min-height:450px!important;position:relative!important;padding:24px 20px 20px!important}
  .history-book .book-page h4{font-size:1.35rem!important;max-width:100%!important;line-height:1.2!important}
  .history-book .book-page p{font-size:0.85rem!important;max-width:100%!important;line-height:1.65!important}
  .history-book .book-page .lead{font-size:0.92rem!important;max-width:100%!important}
  .history-book .page-note{left:20px!important;right:20px!important;max-width:100%!important}
  .history-book .page-footer{left:20px!important;right:20px!important}
  .book-actions{align-self:center!important;margin:16px auto 0!important;transform:none!important}
  .history-page::before,.history-page::after,
  .history-hero::after,
  .timeline-section::before,.timeline-section::after,
  .story-content::before,.story-band::before{display:none!important}
}
</style>

<style id="principal-feed-height-fix">
.principal-photo{aspect-ratio:4/3!important;height:320px!important;min-height:0!important;max-height:320px!important}
.principal-photo img{width:100%!important;height:100%!important;object-fit:contain!important;object-position:center bottom!important}
@media (max-width:700px){.principal-photo{aspect-ratio:4/3!important;height:260px!important;min-height:0!important;max-height:260px!important}}
</style>

<style id="final-book-position">
/* V14 + V17 + V23 — posisi buku & judul */
@media (min-width:1121px){
  .history-book{margin-left:140px!important}
  .history-book-side-title{transform:translateX(-18px)!important}
}
@media (min-width:821px) and (max-width:1120px){
  .history-book{margin-left:90px!important}
  .history-book-side-title{transform:translateX(12px)!important}
}
@media (min-width:821px){
  #historyBook.history-book,#historyBook.history-book.is-open{transform:translateX(200px)!important}
  #historyBook.history-book.is-open ~ .book-actions{transform:translateX(200px)!important}
}
.history-book-side-title h2 b:nth-of-type(2){color:#f5c542!important;background:transparent!important;-webkit-text-fill-color:#f5c542!important;text-shadow:none!important}
</style>
<style id="sejarah-dark-mode">
/* SEJARAH — DARK MODE */
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .history-page{background:#08131f;color:#e6eef7;color-scheme:dark}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .history-page::before{border-color:rgba(143,189,235,.14)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .history-page::after{border-color:rgba(143,189,235,.12)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .history-hero{background:linear-gradient(180deg,#0b1d31 0%,#08131f 100%)!important;color:#e6eef7}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .history-hero::after{color:rgba(255,255,255,.035)!important;-webkit-text-stroke:1px rgba(255,179,0,.14)!important}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .history-ref-ornament-image{filter:invert(1) hue-rotate(180deg);mix-blend-mode:screen;opacity:.6!important}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .history-title .sejarah-white{color:#fff!important}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .history-kicker{background:rgba(255,111,0,.1);border-color:rgba(255,179,0,.3);color:#ffb347}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .history-vt-cta{background:rgba(255,255,255,.06);border-color:rgba(255,255,255,.14);color:#fff;box-shadow:0 12px 30px rgba(0,0,0,.4)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .history-vt-cta:hover{background:rgba(255,179,0,.1);border-color:rgba(255,179,0,.45);box-shadow:0 18px 38px rgba(0,0,0,.5)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .history-vt-cta small{color:#9fb2c6}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .history-vt-arrow{color:#ffd54a}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .eyebrow{color:#cfe3f7}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .eyebrow::before{background:linear-gradient(90deg,#ffd54a,#ff9800)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .story-content .eyebrow{color:#ffb300}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .big-heading{color:#fff;text-shadow:none}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .history-intro{background:#0a1928}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .intro-copy{color:#a9bbcd}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .stat-box{background:rgba(255,255,255,.05);border-color:rgba(255,255,255,.12);box-shadow:0 18px 44px rgba(0,0,0,.35)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .stat-box:hover{border-color:rgba(255,213,74,.35);box-shadow:0 24px 52px rgba(0,0,0,.5)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .stat-box::before{background:linear-gradient(90deg,#ffd54a,#ff8a00)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .stat-box::after{border-color:rgba(143,189,235,.18)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .stat-num:not(.gold){color:#fff}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .stat-label{color:#9fb2c6}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .timeline-section{background:radial-gradient(circle at 8% 18%,rgba(143,189,235,.14) 0 2px,transparent 3px),radial-gradient(circle at 91% 27%,rgba(255,179,0,.16) 0 3px,transparent 4px),linear-gradient(180deg,#0b1b2d 0%,#091522 100%)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .timeline-section::before{background-image:radial-gradient(circle,rgba(255,179,0,.45) 2px,transparent 3px)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .timeline-section::after{background-image:radial-gradient(circle,rgba(143,189,235,.4) 2.2px,transparent 3px)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .history-book-stage::before{border-color:rgba(143,189,235,.14)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .history-book-stage .history-book::before{background-image:radial-gradient(circle,rgba(143,189,235,.3) 1.4px,transparent 1.7px)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .history-book-side-title h2{color:#fff!important}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .history-book-side-title h2 b{color:#fff!important;-webkit-text-fill-color:#fff!important}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .history-book-side-title h2 b:nth-of-type(2){color:#f5c542!important;-webkit-text-fill-color:#f5c542!important}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .history-book-side-title p{color:#a9bbcd}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .side-title-kicker{color:#ffb300}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .side-title-line{background:linear-gradient(90deg,#ffd54a,#ff8a00)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .history-book{filter:drop-shadow(0 24px 36px rgba(0,0,0,.6))}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .book-cover{box-shadow:inset 9px 0 18px rgba(0,0,0,.25),0 0 0 1px rgba(255,255,255,.1),0 16px 30px rgba(0,0,0,.4)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .book-spread{background:#122638;box-shadow:inset 0 0 0 1px rgba(255,255,255,.08)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .book-spread::after{background:linear-gradient(90deg,rgba(255,255,255,.04),transparent 14%,transparent 86%,rgba(0,0,0,.12))}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .book-page{color:#a9bbcd;background:repeating-linear-gradient(0deg,transparent 0 28px,rgba(255,255,255,.035) 29px,transparent 30px),linear-gradient(105deg,#10243a,#16304a 55%,#112238)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .book-page::after{border-color:rgba(255,255,255,.08);box-shadow:0 0 0 10px rgba(255,179,0,.04),0 0 0 20px rgba(255,255,255,.025)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .page-corner{color:#7f93a8}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .page-kicker{color:#ffd54a}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .page-year{color:#fff}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .page-icon{background:#1d4a75;color:#ffd54a;box-shadow:0 7px 14px rgba(0,0,0,.35)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .book-page h3{color:#fff}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .book-page h4{color:#fff}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .book-page p{color:#a9bbcd}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .book-page .lead{color:#dbe7f3}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .page-number-big{color:rgba(255,255,255,.07)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .page-note{background:rgba(255,255,255,.06);color:#cbd9e7}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .page-tag{background:rgba(255,179,0,.14);color:#ffcf5a}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .page-footer{border-top-color:rgba(255,255,255,.1);color:#7f93a8}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .page-footer span:last-child{color:#ffd54a}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .book-nav{background:#1d4a75;box-shadow:0 8px 16px rgba(0,0,0,.4)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .book-nav:hover{background:#2a6199}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .book-count{color:#8fa3b8}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .book-count b{color:#fff}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .story-band{background:#061c33}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .mosaic-section{background:#08131f}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .mosaic-card{background:#0f2236;box-shadow:0 18px 44px rgba(0,0,0,.45)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .mosaic-card:hover{box-shadow:0 28px 58px rgba(0,0,0,.6)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .principal-section{background:radial-gradient(circle at 7% 20%,rgba(143,189,235,.12) 0 2px,transparent 3px),radial-gradient(circle at 93% 28%,rgba(255,179,0,.16) 0 3px,transparent 4px),linear-gradient(180deg,#0a1928 0%,#0b1c2f 55%,#08131f 100%)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .principal-section::before{background-image:radial-gradient(circle,rgba(143,189,235,.3) 2px,transparent 3px)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .principal-section::after{border-color:rgba(143,189,235,.14);box-shadow:0 0 0 26px rgba(143,189,235,.03),0 0 0 56px rgba(255,179,0,.03)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .principal-head .big-heading{text-shadow:none}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .principal-desc{color:#a9bbcd}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .principal-post{background:#0f2236;border-color:rgba(255,255,255,.1);box-shadow:0 22px 58px rgba(0,0,0,.45),0 4px 12px rgba(0,0,0,.25)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .principal-post:hover{border-color:rgba(255,179,0,.45);box-shadow:0 32px 75px rgba(0,0,0,.6)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .principal-post-head{background:#0f2236;border-bottom-color:rgba(255,255,255,.08)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .principal-avatar{background:rgba(255,255,255,.95);border-radius:50%}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .principal-avatar img{width:30px;height:30px}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .principal-profile strong{color:#fff}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .principal-profile span{color:#8fa3b8}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .principal-more{color:#8fa3b8}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .principal-photo{background:linear-gradient(160deg,#1a3752 0%,#12283f 58%,#0e2036 100%)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .principal-photo img{filter:drop-shadow(0 18px 20px rgba(0,0,0,.4))}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .principal-post-actions{color:#dbe7f3}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .principal-like{color:#fff}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .principal-caption{color:#a9bbcd}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .principal-caption strong{color:#fff}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .principal-period{background:rgba(255,179,0,.1);border-color:rgba(255,179,0,.3);color:#ffc233}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .principal-arrow{background:linear-gradient(135deg,#1d4a75,#245a8f);box-shadow:0 12px 28px rgba(0,0,0,.45)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .principal-arrow:hover{background:linear-gradient(135deg,#ffb300,#ff8a00)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .principal-dots button{background:rgba(255,255,255,.22)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .principal-dots button.is-active{background:linear-gradient(90deg,#ffd54a,#ff8a00)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .vt-section{background:linear-gradient(180deg,#0a1928 0%,#08131f 50%,#0a1726 100%)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .vt-section::before{background-image:radial-gradient(circle,rgba(143,189,235,.2) 1.5px,transparent 2px);opacity:.35}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .vt-watermark{color:rgba(255,255,255,.04)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .vt-decor-ring{border-color:rgba(143,189,235,.16)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .vt-frame{box-shadow:0 30px 75px rgba(0,0,0,.55);border-color:rgba(255,255,255,.12)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .vt-chip{background:#0f2236;border-color:rgba(255,255,255,.1);box-shadow:0 12px 30px rgba(0,0,0,.4)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .vt-chip strong{color:#fff}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .vt-chip span{color:#8fa3b8}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .vt-kicker{color:#dbe7f3}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .vt-title{color:#fff}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .vt-desc{color:#a9bbcd}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .vt-feat{background:rgba(255,255,255,.06);border-color:rgba(255,255,255,.12);color:#cfe3f7}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .vt-btn{background:linear-gradient(135deg,#ffd54a,#ff8a00);color:#0d3a66;box-shadow:0 14px 32px rgba(0,0,0,.4)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .vt-btn:hover{box-shadow:0 20px 40px rgba(255,138,0,.3)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .home-orn .ho-chevron{border-top-color:rgba(143,189,235,.14);border-right-color:rgba(143,189,235,.14)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .home-orn .ho-chevron::after{border-top-color:rgba(255,213,74,.08);border-right-color:rgba(255,213,74,.08)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .home-orn .ho-ring{border-color:rgba(143,189,235,.16);box-shadow:0 0 0 20px rgba(143,189,235,.03),0 0 0 42px rgba(255,213,74,.025)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .home-orn .ho-corner{border-left-color:rgba(143,189,235,.16);border-bottom-color:rgba(143,189,235,.16)}
:is([data-theme="dark"],[data-bs-theme="dark"],.dark,.dark-mode,.dark-theme,.theme-dark) .home-orn .ho-square::before{border-color:rgba(143,189,235,.22)}
</style>

@endpush

@section('content')
<div class="history-page">
  @php
    $tourUrl = Route::has('profil.tour') ? route('profil.tour') : url('/profile/tour');
  @endphp

  <!-- HERO -->
  <section class="history-hero">
    <div class="history-ref-ornaments" aria-hidden="true">
      <img src="{{ asset('images/wide_minimalist_abstract_technology_background_des.png') }}" alt="" class="history-ref-ornament-image" aria-hidden="true">
    </div>
    <div class="history-hero-inner">
      <div>
        @if($history->hero_kicker)
          <div class="history-kicker">{{ $history->hero_kicker }}</div>
        @endif
        <h1 class="history-title">
          <span class="sejarah-white">SEJARAH</span>
          <span class="skaneda-gold">SKANEDA</span>
        </h1>
        <a class="history-vt-cta" href="{{ $tourUrl }}">
          <span class="history-vt-icon"><i class="fas fa-street-view"></i></span>
          <span><strong>Lihat Virtual Tour 360°</strong><small>Jelajahi SMK Negeri 2 Mojokerto</small></span>
          <i class="fas fa-arrow-right history-vt-arrow"></i>
        </a>
      </div>
    </div>
  </section>

  <!-- INTRO -->
  <section class="history-intro">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span><span class="ho-line"></span><span class="ho-dots"></span>
      <span class="ho-ring"></span><span class="ho-gold"></span><span class="ho-square"></span><span class="ho-corner"></span>
    </div>

    <div class="history-wide intro-grid">
      <div data-reveal>
        <div class="eyebrow">{{ $history->intro_eyebrow }}</div>
        <h2 class="big-heading">{{ $history->intro_title }}</h2>
        <p class="intro-copy">{{ $history->intro_desc }}</p>
      </div>
      <div class="stat-strip" data-reveal="right">
        <div class="stat-box"><div class="stat-num gold">{{ $history->stat1_value }}</div><div class="stat-label">{{ $history->stat1_label }}</div></div>
        <div class="stat-box"><div class="stat-num">{{ $history->stat2_value }}</div><div class="stat-label">{{ $history->stat2_label }}</div></div>
        <div class="stat-box"><div class="stat-num gold">{{ $history->stat3_value }}</div><div class="stat-label">{{ $history->stat3_label }}</div></div>
        <div class="stat-box"><div class="stat-num">{{ $history->stat4_value }}</div><div class="stat-label">{{ $history->stat4_label }}</div></div>
      </div>
    </div>
  </section>

  <!-- BAB-BAB YANG MEMBENTUK KAMI — BUKU INTERAKTIF -->
  <section class="timeline-section history-book-section">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span><span class="ho-line"></span><span class="ho-dots"></span>
      <span class="ho-ring"></span><span class="ho-gold"></span><span class="ho-square"></span><span class="ho-corner"></span>
    </div>
    <div class="history-book-stage" data-reveal>
      <div class="history-book-side-title">
        <span class="side-title-kicker">ARSIP PERJALANAN</span>
        <h2>PERJALANAN<br><b>SEJARAH</b><b>SKANEDA</b></h2>
        <p>Telusuri perjalanan SMK Negeri 2 Mojokerto sejak berdiri pada 2013, berpindah ke gedung baru, hingga berkembang dengan lima bidang keahlian.</p>
        <span class="side-title-line"></span>
      </div>

      <div class="history-book is-open" id="historyBook">
        <button class="book-cover" id="bookCover" type="button" aria-label="Buka buku sejarah">
          <span class="cover-frame"></span>
          <span class="cover-topline">SEJARAH &nbsp;•&nbsp; SKANEDA</span>
          <span class="cover-photo"><img src="{{ asset('images/hero-sekolah.jpg') }}" alt="Gedung SMK Negeri 2 Mojokerto"></span>
          <span class="cover-est">EST. 2013</span>
          <span class="cover-title">BAB-BAB YANG<br><b>MEMBENTUK KAMI</b></span>
          <span class="cover-foot">SMK NEGERI 2 MOJOKERTO <i>2013 — HARI INI</i></span>
        </button>

        <div class="book-spread" aria-live="polite">
          @foreach($history->chapters as $i => $chapter)
            <article class="book-page page-left" data-page="{{ $i }}">
              <div class="page-corner">{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}</div>
              <div class="page-kicker">{{ $chapter->kicker }}</div>
              <div class="page-year">{{ $chapter->year_label }}</div>
              <div class="page-rule"></div>
              <div class="page-icon"><i class="fas {{ $chapter->icon ?: 'fa-flag' }}"></i></div>
              <h3>{!! nl2br(e($chapter->short_title)) !!}</h3>
              <p>{{ $chapter->short_desc }}</p>
              @if($chapter->tag)<span class="page-tag">{{ $chapter->tag }}</span>@endif
              <div class="page-footer"><span>SKANEDA · SEJARAH</span><span>{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}</span></div>
            </article>

            <article class="book-page page-right" data-page="{{ $i }}">
              <div class="page-corner">{{ $chapter->year_label }}</div>
              <div class="page-kicker">{{ $chapter->kicker }}</div>
              <div class="page-number-big">{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}</div>
              <h4>{{ $chapter->long_title }}</h4>
              @if($chapter->lead)<p class="lead">{{ $chapter->lead }}</p>@endif
              <p>{{ $chapter->body }}</p>
              @if($chapter->note)<div class="page-note">{{ $chapter->note }}</div>@endif
              <div class="page-footer"><span>SMK NEGERI 2 MOJOKERTO</span><span>{{ $chapter->year_label }}</span></div>
            </article>
          @endforeach
        </div>
      </div>

      <div class="book-actions">
        <button type="button" class="book-nav book-prev" id="bookPrev"><i class="fas fa-chevron-left"></i></button>
        <button type="button" class="book-open" id="bookOpen"><i class="fas fa-book-open"></i><span>Buka buku</span></button>
        <div class="book-count"><b id="bookCount">01</b><span>/ {{ str_pad($history->chapters->count(), 2, '0', STR_PAD_LEFT) }}</span></div>
        <button type="button" class="book-nav book-next" id="bookNext"><i class="fas fa-chevron-right"></i></button>
      </div>
    </div>
  </section>

  <!-- VISUAL STORY -->
  <section class="story-band">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span><span class="ho-line"></span><span class="ho-dots"></span>
      <span class="ho-ring"></span><span class="ho-gold"></span><span class="ho-square"></span><span class="ho-corner"></span>
    </div>

    <div class="story-image" data-reveal="left"><img src="{{ asset('images/smkn-guru.jpg') }}" alt="Keluarga besar SMKN 2 Mojokerto" loading="lazy"></div>
    <div class="story-content" data-reveal="right">
      <div class="story-content-inner">
        <div class="eyebrow">Yang tidak berubah</div>
        <h2>MANUSIANYA.<br><span>SEMANGATNYA.</span></h2>
        <p>Teknologi dan fasilitas boleh berubah. Program keahlian terus berkembang. Namun inti perjalanan sekolah tetap sama: membentuk siswa yang siap berkarya, berkarakter, dan punya keberanian untuk melangkah lebih jauh.</p>
        <div class="story-list">
          <div class="story-chip"><i class="fas fa-check"></i> Berkarakter</div>
          <div class="story-chip"><i class="fas fa-check"></i> Kompeten</div>
          <div class="story-chip"><i class="fas fa-check"></i> Adaptif</div>
          <div class="story-chip"><i class="fas fa-check"></i> Berdaya saing</div>
        </div>
      </div>
    </div>
  </section>

  <!-- MOSAIC -->
  <section class="mosaic-section">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span><span class="ho-line"></span><span class="ho-dots"></span>
      <span class="ho-ring"></span><span class="ho-gold"></span><span class="ho-square"></span><span class="ho-corner"></span>
    </div>

    <div class="mosaic-head" data-reveal><div class="eyebrow">Wajah vokasi hari ini</div><h2 class="big-heading">DARI SEJARAH, LAHIR <span>KARYA BARU.</span></h2></div>
    <div class="mosaic">
      @foreach($history->galleries as $i => $item)
        <div class="mosaic-card {{ $item->is_featured ? 'big' : '' }}" data-reveal @if($i > 0) style="--d:{{ $i }}" @endif>
          <img src="{{ $item->image_url }}" alt="{{ $item->big_label }}" loading="lazy">
          <div class="mosaic-label">
            <small>{{ $item->small_label }}</small>
            <strong>{{ $item->big_label }}</strong>
          </div>
        </div>
      @endforeach
    </div>
  </section>

  <!-- KEPEMIMPINAN -->
  <section class="principal-section">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span><span class="ho-line"></span><span class="ho-dots"></span>
      <span class="ho-ring"></span><span class="ho-gold"></span><span class="ho-square"></span><span class="ho-corner"></span>
    </div>

    <div class="principal-head" data-reveal>
      <div class="eyebrow">Kepemimpinan</div>
      <h2 class="big-heading">KEPALA SEKOLAH<br><span>DARI MASA KE MASA </span></h2>
      <p class="principal-desc">Jejak kepemimpinan SKANEDA dalam satu rangkaian cerita — setiap periode membawa warna, perubahan, dan semangat yang berbeda.</p>
    </div>

    <div class="principal-stage" id="principalSlider">
      <button class="principal-arrow principal-prev" type="button" aria-label="Kepala sekolah sebelumnya"><i class="fas fa-chevron-left"></i></button>

      <div class="principal-viewport">
        <div class="principal-track" id="principalTrack">
          @foreach($history->principals as $i => $p)
            <article class="principal-post" data-principal @if($p->is_current) data-current @endif data-reveal @if($i > 0) style="--d:{{ $i }}" @endif>
              <div class="principal-post-head">
                <div class="principal-profile">
                  <span class="principal-avatar"><img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SMKN 2 Mojokerto" loading="lazy"></span>
                  <div><strong>SMKN 2 Mojokerto</strong><span>Kepemimpinan · {{ $p->period_label }}</span></div>
                </div>
                <span class="principal-more"><i class="fas fa-ellipsis-h"></i></span>
              </div>
              <div class="principal-photo">
                <img src="{{ $p->photo_url }}" alt="{{ $p->name }}" loading="lazy">
                @if($p->is_current)<span class="principal-current">Saat Ini</span>@endif
              </div>
              <div class="principal-post-actions">
                <i class="far fa-heart"></i><i class="far fa-comment"></i><i class="far fa-paper-plane"></i>
                <i class="far fa-bookmark spacer"></i>
              </div>
              <div class="principal-post-body">
                <div class="principal-like">{{ $p->name }}</div>
                <p class="principal-caption">{!! nl2br(e($p->caption)) !!}</p>
                <span class="principal-period">{{ $p->period_label }}</span>
              </div>
            </article>
          @endforeach
        </div>
      </div>

      <button class="principal-arrow principal-next" type="button" aria-label="Kepala sekolah berikutnya"><i class="fas fa-chevron-right"></i></button>
    </div>

    <div class="principal-dots" id="principalDots" role="tablist" aria-label="Navigasi kepala sekolah"></div>
  </section>

  <!-- VIRTUAL TOUR 360 -->
  <section class="vt-section" id="virtual-tour" aria-label="Virtual Tour 360 SMK Negeri 2 Mojokerto">
    <span class="vt-watermark" aria-hidden="true">360°</span>
    <div class="vt-decor-ring" aria-hidden="true"></div>
    <div class="vt-decor-dots" aria-hidden="true"></div>

    <div class="vt-inner">
      <div class="vt-media" data-reveal="left">
        <a class="vt-frame" href="{{ $tourUrl }}" aria-label="Mulai Virtual Tour 360 derajat" style="display:block;text-decoration:none;color:inherit">
          <img src="{{ $history->vt_image_url ?: asset('images/hero-sekolah.jpg') }}" alt="Virtual Tour 360° SMK Negeri 2 Mojokerto">
          <span class="vt-badge"><i class="fa-solid fa-street-view"></i> 360° Tour</span>
          <span class="vt-play"><i class="fa-solid fa-play"></i></span>
          <div class="vt-caption">
            <div><strong>Jelajahi Sekolah</strong><span>SMK Negeri 2 Mojokerto</span></div>
            <span class="vt-cam"><i class="fa-solid fa-camera"></i> 360°</span>
          </div>
        </a>
        <div class="vt-chip"><i class="fa-solid fa-compass"></i><div><strong>Virtual Tour 360°</strong><span>Interactive Campus Experience</span></div></div>
      </div>

      <div class="vt-copy">
        <div class="vt-kicker" data-reveal>Virtual Experience</div>
        <h2 class="vt-title" data-reveal>{{ $history->vt_title }}</h2>
        <p class="vt-desc" data-reveal>{{ $history->vt_desc }}</p>
        <div class="vt-feats" data-reveal>
          <span class="vt-feat"><i class="fa-solid fa-check"></i> Interaktif</span>
          <span class="vt-feat"><i class="fa-solid fa-check"></i> Panorama 360°</span>
          <span class="vt-feat"><i class="fa-solid fa-check"></i> Akses Mudah</span>
        </div>
        <a href="{{ $tourUrl }}" id="vtTourLink" class="vt-btn" data-reveal>Mulai Virtual Tour <i class="fa-solid fa-arrow-right"></i></a>
      </div>
    </div>
  </section>
</div>
@endsection

@push('scripts')
<script>
  /* ---- Slider Kepala Sekolah ---- */
  (function () {
    var slider = document.getElementById('principalSlider');
    if (!slider) return;
    var track = document.getElementById('principalTrack');
    var cards = track.querySelectorAll('.principal-post');
    var dotsWrap = document.getElementById('principalDots');
    var prevBtn = slider.querySelector('.principal-prev');
    var nextBtn = slider.querySelector('.principal-next');
    var idx = 0, n = cards.length, locked = false;
    if (!n) return;

    for (var i = 0; i < n; i++) {
      var b = document.createElement('button');
      b.type = 'button';
      b.setAttribute('aria-label', 'Ke kepala sekolah ' + (i + 1));
      (function (k) { b.addEventListener('click', function () { go(k); }); })(i);
      dotsWrap.appendChild(b);
    }
    var dots = dotsWrap.querySelectorAll('button');

    function metrics() {
      var wrap = track.parentElement;
      var cw = cards[0].getBoundingClientRect().width;
      var gap = parseFloat(getComputedStyle(track).columnGap || getComputedStyle(track).gap) || 0;
      var visible = Math.max(1, Math.round(wrap.clientWidth / (cw + gap)));
      return { cw: cw, gap: gap, maxShift: Math.max(0, n - visible) };
    }

    function update() {
      var m = metrics();
      var offset = Math.min(idx, m.maxShift) * (m.cw + m.gap);
      track.style.transform = 'translateX(' + (-offset) + 'px)';
      dots.forEach(function (d, k) {
        d.classList.toggle('is-active', k === idx);
        d.setAttribute('aria-selected', k === idx ? 'true' : 'false');
      });
      prevBtn.disabled = idx <= 0;
      nextBtn.disabled = idx >= m.maxShift;
    }

    function go(k) {
      if (locked) return;
      idx = Math.max(0, Math.min(n - 1, k));
      update();
    }
    function step(dir) {
      var m = metrics();
      go(Math.max(0, Math.min(m.maxShift, idx + dir)));
      locked = true;
      setTimeout(function () { locked = false; }, 640);
    }

    prevBtn.addEventListener('click', function () { step(-1); });
    nextBtn.addEventListener('click', function () { step(1); });

    document.addEventListener('keydown', function (e) {
      var r = slider.getBoundingClientRect();
      if (r.top < window.innerHeight && r.bottom > 0 && (e.key === 'ArrowLeft' || e.key === 'ArrowRight')) {
        e.preventDefault();
        step(e.key === 'ArrowLeft' ? -1 : 1);
      }
    });

    var startX = 0, startY = 0, dragging = false, moved = 0;
    track.addEventListener('pointerdown', function (e) { dragging = true; moved = 0; startX = e.clientX; startY = e.clientY; });
    window.addEventListener('pointermove', function (e) { if (!dragging) return; moved = Math.max(moved, Math.abs(e.clientX - startX)); });
    window.addEventListener('pointerup', function (e) {
      if (!dragging) return;
      dragging = false;
      var dx = e.clientX - startX, dy = e.clientY - startY;
      if (Math.abs(dx) > 42 && Math.abs(dx) > Math.abs(dy)) step(dx < 0 ? 1 : -1);
    });
    track.addEventListener('click', function (e) { if (moved > 8) { e.preventDefault(); e.stopPropagation(); } });

    window.addEventListener('resize', function () { update(); });
    update();
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

  /* ---- Buku sejarah (selalu terbuka, hanya geser halaman) ---- */
  (function () {
    var book = document.getElementById('historyBook'); if (!book) return;
    var open = document.getElementById('bookOpen');
    var prev = document.getElementById('bookPrev'), next = document.getElementById('bookNext'), count = document.getElementById('bookCount');
    var pages = Array.prototype.slice.call(book.querySelectorAll('.book-page[data-page]'));
    var total = pages.length ? (Math.max.apply(null, pages.map(function (p) { return Number(p.getAttribute('data-page')); })) + 1) : 1;
    var idx = 0;
    book.classList.add('is-open');
    if (open) open.style.display = 'none';
    function render() {
      pages.forEach(function (p) { p.classList.toggle('is-active', Number(p.getAttribute('data-page')) === idx); });
      count.textContent = String(idx + 1).padStart(2, '0');
      prev.disabled = idx === 0; next.disabled = idx === total - 1;
    }
    function go(n) { idx = Math.max(0, Math.min(total - 1, idx + n)); render(); }
    prev.addEventListener('click', function () { go(-1); });
    next.addEventListener('click', function () { go(1); });
    document.addEventListener('keydown', function (e) { if (e.key === 'ArrowLeft') go(-1); if (e.key === 'ArrowRight') go(1); });
    var sx = 0;
    book.addEventListener('touchstart', function (e) { sx = e.changedTouches[0].clientX; }, { passive: true });
    book.addEventListener('touchend', function (e) { var dx = e.changedTouches[0].clientX - sx; if (Math.abs(dx) > 45) go(dx < 0 ? 1 : -1); }, { passive: true });
    render();
  })();
</script>
@endpush