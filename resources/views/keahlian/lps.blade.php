@extends('layouts.app')

@section('title', 'Program Keahlian LPS (Layanan Perbankan Syariah) — SMK Negeri 2 Mojokerto')
@section('description', 'Program Keahlian LPS (Layanan Perbankan Syariah) SMK Negeri 2 Mojokerto: profil, kompetensi, praktik bank mini syariah, dan fasilitas pembelajaran perbankan.')

@push('styles')
<style>
/* =========================================================
   LPS — LAYANAN PERBANKAN SYARIAH
   Mini website premium khusus LPS di dalam website sekolah.
   Konsep: TEORI → PRAKTIK → BANK MINI → INDUSTRI PERBANKAN → KARIER
   Palet: navy #0d3a66, blue #0B5FA5, bright blue #28A9E1,
          gold #FFD54A, orange #FF8A00, purple LPS #7C4DFF, white #F8FBFF
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

/* ===== HERO — DISALIN 1:1 DARI HALAMAN SEJARAH, judul tetap LPS ===== */
.history-page{background:#f7f9fc;color:#0d3a66;overflow:hidden}

.history-page *{box-sizing:border-box}

.history-shell{width:100%}

.history-hero{position:relative;min-height:78vh;display:flex;align-items:center;overflow:hidden;
  background:#fff;color:#0d3a66}

.history-hero::before{display:none}

.history-hero::after{content:"SEJARAH";position:absolute;z-index:0;left:-2%;top:50%;transform:translateY(-50%);
  font-family:var(--font-display);font-size:clamp(8rem,24vw,24rem);font-weight:900;line-height:.78;
  letter-spacing:.015em;color:rgba(13,58,102,.035);
  -webkit-text-stroke:1px rgba(255,122,0,.12);
  pointer-events:none;white-space:nowrap;user-select:none}

.history-hero-geometry{position:absolute;inset:0;z-index:1;pointer-events:none;overflow:hidden}

.history-hero-geometry svg{position:absolute;width:100%;height:100%;inset:0;display:block}

.history-hero-geometry .geo-line{fill:none;stroke:#ff7a00;stroke-width:1.8;cookie-bite-effect:non-scaling-stroke;opacity:.42}

.history-hero-geometry .geo-line-navy{fill:none;stroke:#0d3a66;stroke-width:1.5;cookie-bite-effect:non-scaling-stroke;opacity:.24}

.history-hero-geometry .geo-node{fill:#fff;stroke:#ff7a00;stroke-width:2;cookie-bite-effect:non-scaling-stroke}

.history-hero-geometry .geo-node-navy{fill:#fff;stroke:#0d3a66;stroke-width:2;cookie-bite-effect:non-scaling-stroke}

.history-hero-geometry .geo-ring{fill:none;stroke:#0d3a66;stroke-width:1.2;opacity:.16}

.history-hero-geometry .geo-ring-orange{fill:none;stroke:#ff7a00;stroke-width:1.5;opacity:.28}

.history-hero-geometry .geo-diamond{fill:none;stroke:#ff7a00;stroke-width:1.4;opacity:.30}

.history-hero-geometry .geo-dot{fill:#ff7a00;opacity:.52}

.history-hero-geometry .geo-square{fill:#ff7a00;opacity:.9}

.history-hero-geometry .geo-square-navy{fill:#0d3a66;opacity:.9}

.history-hero-geometry .geo-soft{fill:#ff7a00;opacity:.055}

.history-hero-geometry .geo-cluster-left{position:absolute;left:-70px;top:-58px;width:330px;height:250px}

.history-hero-geometry .geo-cluster-right{position:absolute;right:-55px;top:18px;width:360px;height:270px}

.history-hero-geometry .geo-network-left{position:absolute;left:-35px;bottom:12px;width:500px;height:220px}

.history-hero-geometry .geo-modules{position:absolute;right:-25px;bottom:-8px;width:430px;height:210px;transform:rotate(-2deg)}

.history-hero::after{z-index:0}

.history-hero-inner{position:relative;z-index:3;width:100%;max-width:1500px;margin:0 auto;
  padding:clamp(4rem,10vh,7rem) clamp(1.25rem,4vw,4.5rem) clamp(4rem,9vh,6rem);
  display:block}

.history-kicker{display:inline-flex;align-items:center;gap:.65rem;font-size:.72rem;font-weight:900;
  letter-spacing:.18em;text-transform:uppercase;color:#ff6f00;margin-bottom:1.05rem;
  padding:.55rem .85rem;border:1px solid rgba(255,111,0,.18);border-radius:999px;
  background:#fffaf5}

.history-kicker::before{content:"";width:9px;height:9px;border-radius:50%;
  background:#ff6f00;box-shadow:0 0 0 6px rgba(255,111,0,.10)}

.history-title{font-family:var(--font-display);font-size:clamp(4rem,10vw,9.2rem);line-height:.84;
  letter-spacing:-.035em;margin:0;max-width:1250px;text-transform:uppercase;
  text-shadow:none;animation:hdFadeUp .7s .1s var(--ease, ease) both}

.history-title .sejarah-white{color:#0d3a66;display:block}

.history-title .skaneda-gold{display:block;
  background:linear-gradient(135deg,#ff7a00 0%,#ff6a00 55%,#f4511e 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:#ff6f00;
  text-shadow:none;letter-spacing:-.025em}

.history-lead{font-size:1rem;line-height:1.75;color:#52657a;max-width:720px;
  margin:1.7rem 0 0;animation:hdFadeUp .7s .26s var(--ease, ease) both}

.history-hero-meta{display:flex;gap:.7rem;flex-wrap:wrap;margin-top:1.6rem;animation:hdFadeUp .7s .4s var(--ease, ease) both}

.history-pill{display:inline-flex;align-items:center;gap:.5rem;padding:.55rem .85rem;
  border:1px solid rgba(13,58,102,.12);background:#fff;border-radius:999px;color:#0d3a66;
  font-size:.72rem;font-weight:800;box-shadow:0 8px 24px rgba(13,58,102,.06)}

.history-pill i{color:#ff7a00}

.hero-photo{display:none}

.hero-photo::before,.hero-photo img,.hero-photo-caption{display:none}

@keyframes hdFadeUp{from{opacity:0;transform:translateY(26px)}to{opacity:1;transform:none}}

.history-vt-cta{
    display:inline-flex;align-items:center;gap:.8rem;margin-top:1.7rem;
    padding:.8rem 1rem;border-radius:16px;text-decoration:none;color:#0d3a66;
    background:#fff;border:1px solid rgba(13,58,102,.12);
    box-shadow:0 12px 30px rgba(13,58,102,.08);
    transition:transform .3s ease,background .3s ease,border-color .3s ease,box-shadow .3s ease
  }

.history-vt-cta:hover{
    transform:translateY(-4px);background:#fffaf5;
    border-color:rgba(255,122,0,.28);box-shadow:0 18px 38px rgba(13,58,102,.12)
  }

.history-vt-icon{
    width:46px;height:46px;border-radius:14px;display:grid;place-items:center;
    background:linear-gradient(135deg,#ffd54a,#ff7a00);color:#0d3a66;font-size:.9rem
  }

.history-vt-cta strong{display:block;font-size:1rem;line-height:1.15;font-weight:900;letter-spacing:.01em}

.history-vt-cta small{display:block;margin-top:.25rem;color:#718096;font-size:.72rem;font-weight:600}

.history-vt-arrow{margin-left:.3rem;color:#ffd54a;font-size:1rem}

.history-wide{width:min(1380px,92%);margin:auto}

.history-intro{position:relative;padding:96px 0 110px;background:#fff}

.history-hero-inner{width:100%;max-width:1500px}

.history-title{max-width:1250px}

@media(max-width:700px) {
.history-hero{min-height:70vh}
.history-hero-inner{padding-top:3.5rem;padding-bottom:4rem}
.history-title{font-size:clamp(3.5rem,16vw,6rem);line-height:.88}
.history-hero::after{font-size:clamp(7rem,32vw,12rem);left:-8%}
}

.history-page{position:relative}

.history-page::before{content:"";position:fixed;right:-110px;top:18%;width:230px;height:230px;border:2px solid rgba(13,58,102,.14);transform:rotate(45deg);z-index:0;pointer-events:none}

.history-page::after{content:"";position:fixed;left:-95px;bottom:10%;width:190px;height:190px;border:2px solid rgba(47,111,168,.14);border-radius:28px;transform:rotate(25deg);z-index:0;pointer-events:none}

.history-hero,.history-intro,.timeline-section,.story-band,.mosaic-section,.future{position:relative;z-index:1}

.history-hero-inner::before{content:"";position:absolute;left:-28px;top:18%;width:12px;height:180px;border-left:3px solid #ffd54a;border-top:3px solid #ffd54a;opacity:.9}

.history-hero-inner::after{content:"";position:absolute;right:44%;top:8%;width:72px;height:72px;border:2px solid rgba(255,213,74,.55);transform:rotate(45deg);pointer-events:none}

.history-page .history-kicker,
.history-page .history-pill,
.history-page .eyebrow,
.history-page .stat-box,
.history-page .timeline-card,
.history-page .timeline-marker,
.history-page .story-chip,
.history-page .mosaic-card,
.history-page .future-point,
.history-page .hero-photo,
.history-page .big-heading,
.history-page .history-title{
  transition:transform .35s ease,box-shadow .35s ease,filter .35s ease,border-color .35s ease,background .35s ease;
}

.history-page .history-pill:hover{transform:translateY(-4px);background:rgba(13,58,102,.55);border-color:rgba(255,213,74,.5)}

.history-page .history-kicker:hover{transform:translateX(7px);filter:drop-shadow(0 5px 12px rgba(255,213,74,.2))}

.history-page .eyebrow:hover{transform:translateX(6px)}

.history-page .stat-box:hover{transform:translateY(-9px) rotate(-.5deg);border-color:rgba(13,58,102,.32);box-shadow:0 28px 58px rgba(13,58,102,.18)}

.history-page .timeline-card:hover{transform:translateY(-9px) scale(1.015);border-color:rgba(13,58,102,.22);box-shadow:0 30px 65px rgba(13,58,102,.2)}

.history-page .timeline-card:hover::before{width:8px}

.history-page .timeline-marker:hover{transform:rotate(45deg) scale(1.1);box-shadow:0 16px 35px rgba(13,58,102,.38)}

.history-page .hero-photo:hover{transform:translateY(-42px) rotate(0deg) scale(1.015);box-shadow:0 45px 95px rgba(13,58,102,.35),0 18px 35px rgba(0,0,0,.22)}

.history-page .hero-photo:hover img{transform:scale(1.07)}

.history-page .story-chip:hover{transform:translateY(-5px);border-color:rgba(255,213,74,.4);background:rgba(255,255,255,.11)}

.history-page .mosaic-card:hover{transform:translateY(-7px);box-shadow:0 28px 58px rgba(13,58,102,.22)}

.history-page .future-point:hover{transform:translateY(-5px) scale(1.02);box-shadow:0 10px 24px rgba(13,58,102,.12)}

.history-page .big-heading:hover{transform:translateX(4px)}

@media(max-width:700px) {
.history-hero-inner::before{left:0;top:14%;height:110px}
.history-hero-inner::after{right:5%;top:4%;width:48px;height:48px}
.history-page::before,.history-page::after{opacity:.45}
}

.history-page{overflow:hidden}

.history-intro .home-orn .ho-chevron{right:-130px;top:70px}

.history-intro .home-orn .ho-line{left:-55px;bottom:75px}

.history-intro .home-orn .ho-dots{right:18%;bottom:55px}

.history-intro .home-orn .ho-ring{left:-80px;top:35%}

.history-intro .home-orn .ho-gold{right:12%;top:26%}

.history-intro .home-orn .ho-square{left:13%;bottom:18%}

.history-intro>*:not(.home-orn),
.timeline-section>*:not(.home-orn),
.story-band>*:not(.home-orn),
.mosaic-section>*:not(.home-orn),
.future>*:not(.home-orn){position:relative;z-index:2}

@media(max-width:950px) {
.history-hero-inner{grid-template-columns:1fr;gap:2rem}
.hero-photo{height:360px}
}

@media(max-width:700px) {
.history-hero{min-height:0;align-items:flex-start}
.history-hero-inner{padding:clamp(3rem,8vh,4.5rem) 0 3.6rem;width:90%}
.history-hero::after{font-size:clamp(4.5rem,26vw,7rem);opacity:.6}
.history-title{font-size:clamp(2.5rem,12vw,4rem);margin-top:0}
.hero-photo{height:300px}
}

.history-hero-inner::before{display:none!important;content:none!important}

.history-vt-cta{position:relative;z-index:4}

@media(max-width:950px) {
.history-hero-inner{grid-template-columns:1fr;gap:2rem}
.history-hero-inner>div:first-child{max-width:900px}
}

@media(max-width:700px) {
.history-vt-cta{width:min(100%,340px)}
.history-vt-cta .history-vt-arrow{margin-left:auto}
}

@media (max-width: 900px) {
.history-hero-geometry .hhg-path-a{width:240px;left:-70px;top:22%}
.history-hero-geometry .hhg-path-b{width:280px;right:-110px;top:72%}
.history-hero-geometry .hhg-path-c{left:10%;width:210px}
.history-hero-geometry .hhg-diamond{width:52px;height:52px;right:8%;top:24%}
.history-hero-geometry .hhg-corner{right:3%;top:8%;width:66px;height:66px}
.history-hero-geometry .hhg-orbit{width:150px;height:66px;left:-48px;bottom:8%}
}

@media (max-width: 560px) {
.history-hero-geometry .hhg-node{width:9px;height:9px}
.history-hero-geometry .hhg-node-a{left:8%;top:20%}
.history-hero-geometry .hhg-node-b{left:18%;bottom:10%}
.history-hero-geometry .hhg-node-c{right:11%;top:18%}
.history-hero-geometry .hhg-node-d{right:5%;bottom:18%}
.history-hero-geometry .hhg-diamond{right:5%;top:31%;width:38px;height:38px}
.history-hero-geometry .hhg-dashes{left:4%;top:11%;width:60px;height:42px;background-size:10px 10px}
.history-hero-geometry .hhg-corner{display:none}
.history-hero-geometry .hhg-path-b{right:-145px}
}

.history-hero > .home-orn{display:none}

.history-hero-inner::before,.history-hero-inner::after{display:none!important}

.history-hero-geometry{z-index:1;opacity:1}

.history-hero-geometry::before{
  content:"";position:absolute;left:-70px;top:-35px;width:300px;height:300px;border-radius:50%;
  background-image:radial-gradient(circle,rgba(13,58,102,.16) 1.5px,transparent 1.7px);
  background-size:18px 18px;opacity:.62;
  -webkit-mask-image:radial-gradient(circle at 52% 52%,#000 0 48%,transparent 72%);mask-image:radial-gradient(circle at 52% 52%,#000 0 48%,transparent 72%);
}

.history-hero-geometry::after{
  content:"";position:absolute;right:-30px;bottom:-40px;width:420px;height:190px;
  background:
    linear-gradient(135deg,transparent 47%,rgba(255,122,0,.62) 48%,rgba(255,122,0,.62) 49%,transparent 50%),
    linear-gradient(35deg,transparent 48%,rgba(13,58,102,.22) 49%,rgba(13,58,102,.22) 50%,transparent 51%);
  opacity:.75;transform:rotate(-5deg);
}

.history-hero-geometry .hhg-path{height:1.5px;opacity:.55;box-shadow:none}

.history-hero-geometry .hhg-path-a{width:430px;left:-95px;top:48%;background:#ff7a00;transform:rotate(30deg);opacity:.38}

.history-hero-geometry .hhg-path-b{width:470px;right:-150px;top:38%;background:#0d3a66;transform:rotate(-36deg);opacity:.22}

.history-hero-geometry .hhg-path-c{width:310px;left:auto;right:3%;bottom:15%;background:#ff7a00;transform:rotate(-13deg);opacity:.42}

.history-hero-geometry .hhg-node{width:11px;height:11px;border:2px solid #ff7a00;background:#fff;box-shadow:0 0 0 5px rgba(255,122,0,.08)}

.history-hero-geometry .hhg-node-a{left:8%;top:18%}

.history-hero-geometry .hhg-node-b{left:31%;bottom:12%}

.history-hero-geometry .hhg-node-c{right:22%;top:23%;border-color:#0d3a66;box-shadow:0 0 0 5px rgba(13,58,102,.06)}

.history-hero-geometry .hhg-node-d{right:8%;bottom:18%}

.history-hero-geometry .hhg-diamond{width:58px;height:58px;right:21%;top:18%;border:1px solid rgba(255,122,0,.34);background:transparent;box-shadow:none}

.history-hero-geometry .hhg-orbit{width:230px;height:100px;left:-75px;bottom:5%;border:1px solid rgba(13,58,102,.18);background:transparent;transform:rotate(-16deg)}

.history-hero-geometry .hhg-orbit::after{width:7px;height:7px;right:22px;top:9px;background:#ff7a00}

.history-hero-geometry .hhg-corner{right:2.5%;top:12%;width:110px;height:110px;border-top:1px solid rgba(255,122,0,.28);border-right:1px solid rgba(13,58,102,.18);border-radius:0 26px 0 0}

.history-hero-geometry .hhg-corner::after{width:45px;height:1.5px;right:-2px;top:46px;background:#ff7a00}

.history-hero-geometry .hhg-dashes{left:7%;top:11%;width:82px;height:54px;background-image:radial-gradient(circle,rgba(255,122,0,.32) 1.2px,transparent 1.4px);background-size:12px 12px;opacity:.75}

.history-hero-geometry .hhg-node-a::after,.history-hero-geometry .hhg-node-b::after,.history-hero-geometry .hhg-node-c::after,.history-hero-geometry .hhg-node-d::after{content:"";position:absolute;width:72px;height:1px;background:rgba(255,122,0,.25);left:9px;top:5px;transform-origin:left center}

.history-hero-geometry .hhg-node-a::after{transform:rotate(28deg);width:95px}

.history-hero-geometry .hhg-node-b::after{transform:rotate(-18deg);width:110px}

.history-hero-geometry .hhg-node-c::after{transform:rotate(24deg);background:rgba(13,58,102,.20);width:90px}

.history-hero-geometry .hhg-node-d::after{transform:rotate(-34deg);width:70px}

@media(max-width:900px) {
.history-hero-geometry .hhg-path-a{width:250px;left:-90px;top:45%}
.history-hero-geometry .hhg-path-b{width:300px;right:-150px;top:34%}
.history-hero-geometry .hhg-diamond{right:8%;top:18%;width:42px;height:42px}
.history-hero-geometry .hhg-corner{right:0;top:10%;width:75px;height:75px}
.history-hero-geometry .hhg-orbit{width:160px;height:72px;left:-70px}
}

@media(max-width:560px) {
.history-hero-geometry::before{width:210px;height:210px;left:-70px;top:-25px;background-size:14px 14px}
.history-hero-geometry::after{width:250px;height:120px;right:-80px;bottom:-20px}
.history-hero-geometry .hhg-node-a{left:7%;top:16%}
.history-hero-geometry .hhg-node-b{left:18%;bottom:10%}
.history-hero-geometry .hhg-node-c{right:18%;top:20%}
.history-hero-geometry .hhg-node-d{right:5%;bottom:15%}
.history-hero-geometry .hhg-node::after{display:none}
.history-hero-geometry .hhg-corner{display:none}
}

.history-hero-geometry{
  z-index:1;
  pointer-events:none;
}

.history-hero-geometry .geo-cluster-left,
.history-hero-geometry .geo-network-left{
  display:none !important;
}

.history-hero-geometry .geo-cluster-right{
  display:block;
  left:auto;
  right:1.5%;
  top:7%;
  width:min(430px,38vw);
  height:min(320px,34vh);
  transform:none;
  opacity:.92;
}

.history-hero-geometry .geo-modules{
  display:block;
  left:auto;
  right:-1%;
  bottom:5%;
  width:min(420px,36vw);
  height:min(220px,24vh);
  transform:rotate(-2deg);
  opacity:.82;
}

.history-hero-geometry::before{
  left:auto;
  right:3%;
  top:31%;
  width:min(300px,25vw);
  height:min(300px,30vh);
  border-radius:50%;
  background-image:
    radial-gradient(circle,rgba(13,58,102,.18) 1.4px,transparent 1.7px);
  background-size:17px 17px;
  opacity:.42;
  -webkit-mask-image:radial-gradient(circle at 50% 50%,#000 0 43%,transparent 72%);
  mask-image:radial-gradient(circle at 50% 50%,#000 0 43%,transparent 72%);
}

.history-hero-geometry::after{
  right:-25px;
  left:auto;
  bottom:4%;
  width:min(520px,44vw);
  height:180px;
  background:
    linear-gradient(135deg,transparent 47.5%,rgba(255,122,0,.52) 48%,rgba(255,122,0,.52) 48.7%,transparent 49.2%),
    linear-gradient(25deg,transparent 49%,rgba(13,58,102,.20) 49.5%,rgba(13,58,102,.20) 50.2%,transparent 50.7%);
  opacity:.62;
  transform:none;
}

.history-hero-inner{
  z-index:4;
}

.history-title,
.history-kicker,
.history-vt-cta{
  position:relative;
  z-index:5;
}

@media (min-width:1100px) {
.history-hero-inner{
    padding-right:42%;
  }
.history-title{
    max-width:820px;
  }
}

@media (max-width:900px) {
.history-hero-inner{
    padding-right:1.25rem;
  }
.history-hero-geometry .geo-cluster-right{
    right:-45px;
    top:8%;
    width:330px;
    height:260px;
    opacity:.58;
  }
.history-hero-geometry .geo-modules{
    right:-55px;
    bottom:2%;
    width:330px;
    height:180px;
    opacity:.58;
  }
.history-hero-geometry::before{
    right:-35px;
    top:34%;
    width:240px;
    height:240px;
  }
}

@media (max-width:560px) {
.history-hero-geometry .geo-cluster-right{
    right:-115px;
    top:10%;
    width:270px;
    height:220px;
    opacity:.34;
  }
.history-hero-geometry .geo-modules{
    right:-120px;
    bottom:0;
    width:280px;
    height:150px;
    opacity:.30;
  }
.history-hero-geometry::before{
    right:-90px;
    top:38%;
    width:210px;
    height:210px;
    opacity:.24;
  }
.history-hero-geometry::after{
    right:-120px;
    width:300px;
    height:130px;
    opacity:.28;
  }
}

@media (max-width:900px) {
.history-hero-geometry .geo-cluster-left{left:-105px;top:-42px;transform:scale(.82);transform-origin:top left}
.history-hero-geometry .geo-cluster-right{right:-130px;top:20px;transform:scale(.78);transform-origin:top right}
.history-hero-geometry .geo-network-left{left:-120px;bottom:8px;transform:scale(.72);transform-origin:bottom left}
.history-hero-geometry .geo-modules{right:-135px;bottom:-8px;transform:scale(.68) rotate(-2deg);transform-origin:bottom right}
}

@media (max-width:560px) {
.history-hero-geometry .geo-cluster-left{left:-150px;top:-38px;transform:scale(.62);opacity:.72}
.history-hero-geometry .geo-cluster-right{right:-180px;top:14px;transform:scale(.58);opacity:.68}
.history-hero-geometry .geo-network-left{left:-180px;bottom:4px;transform:scale(.52);opacity:.65}
.history-hero-geometry .geo-modules{right:-205px;bottom:-12px;transform:scale(.50) rotate(-2deg);opacity:.72}
.history-hero::after{font-size:clamp(7rem,31vw,11rem);opacity:.8}
}

.history-jurusan-industry-decor{
  position:absolute;
  inset:0;
  z-index:1;
  pointer-events:none;
  overflow:hidden;
}

.history-jurusan-industry-decor svg{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}

.history-jurusan-industry-decor .jd-grid{
  stroke:#0d3a66;
  stroke-width:1.5px;
  opacity:.15;
}

.history-jurusan-industry-decor .jd-diag{
  fill:none;
  stroke:#ff9f00;
  stroke-width:3px;
  stroke-linecap:round;
  opacity:.48;
}

.history-jurusan-industry-decor .jd-diag-soft{
  fill:none;
  stroke:#0d3a66;
  stroke-width:1.9px;
  stroke-linecap:round;
  opacity:.24;
}

.history-jurusan-industry-decor .jd-square{
  fill:none;
  stroke:#ff9f00;
  stroke-width:2.8px;
  opacity:.68;
}

.history-jurusan-industry-decor .jd-square-fill{
  fill:#ffb300;
  opacity:.22;
}

.history-jurusan-industry-decor .jd-hex{
  fill:none;
  stroke:#0d3a66;
  stroke-width:2.8px;
  opacity:.34;
}

.history-jurusan-industry-decor .jd-node{
  fill:#ff9f00;
  opacity:.82;
}

.history-jurusan-industry-decor .jd-plus{
  stroke:#0d3a66;
  stroke-width:2.8px;
  stroke-linecap:round;
  opacity:.42;
}

.history-jurusan-industry-decor .jd-corner{
  fill:none;
  stroke:#ff9f00;
  stroke-width:4px;
  stroke-linecap:square;
  opacity:.52;
}

@media (min-width:1100px) {
.history-jurusan-industry-decor{
    left:28%;
  }
}

@media (max-width:1099px) {
.history-jurusan-industry-decor{
    left:18%;
    opacity:.82;
  }
}

@media (max-width:640px) {
.history-jurusan-industry-decor{
    left:5%;
    opacity:.68;
  }
}

.history-hero{
  min-height:clamp(620px,78vh,790px)!important;
  background:#fff!important;
  position:relative;
  isolation:isolate;
}

.history-hero>.home-orn,
.history-hero>.history-hero-geometry{
  display:none!important;
}

.history-ref-ornaments{
  position:absolute;
  inset:0;
  z-index:1;
  pointer-events:none;
  overflow:hidden;
}

.history-ref-ornaments svg{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}

.history-ref-ornaments path{
  fill:none;
  stroke:#0d3a66;
  stroke-width:1.8;
  cookie-bite-effect:non-scaling-stroke;
  opacity:.20;
}

.history-ref-ornaments .ref-soft path{
  stroke:#ff7a00;
  opacity:.28;
}

.history-ref-ornaments .ref-soft-bottom path{
  stroke:#0d3a66;
  opacity:.18;
}

.history-ref-ornaments .ref-left path{
  stroke:#0d3a66;
  opacity:.18;
}

.history-ref-ornaments .ref-right path,
.history-ref-ornaments .ref-bottom path{
  stroke:#0d3a66;
  opacity:.23;
}

.history-ref-ornaments .ref-diamond-orange{
  fill:none;
  stroke:#ff7a00;
  stroke-width:2;
  opacity:.52;
}

.history-ref-ornaments .ref-hex{
  fill:none;
  stroke:#0d3a66;
  stroke-width:2;
  opacity:.30;
}

.history-ref-ornaments .ref-fill-orange{
  fill:#ff7a00;
  opacity:.95;
}

.history-ref-ornaments .ref-fill-navy{
  fill:#0d3a66;
  opacity:.95;
}

.history-ref-ornaments .ref-node-orange{
  fill:#fff;
  stroke:#ff7a00;
  stroke-width:2;
}

.history-ref-ornaments .ref-node-navy{
  fill:#fff;
  stroke:#0d3a66;
  stroke-width:2;
}

.history-ref-ornaments .ref-orbit{
  fill:none;
  stroke:#0d3a66;
  stroke-width:1.6;
  opacity:.22;
}

.history-ref-ornaments .ref-orbit-orange{
  fill:none;
  stroke:#ff7a00;
  stroke-width:1.6;
  opacity:.30;
}

.history-ref-ornaments .ref-orbit-core{
  fill:none;
  stroke:#0d3a66;
  stroke-width:2.2;
  opacity:.50;
}

.history-ref-ornaments .ref-heavy-orange{
  fill:none;
  stroke:#ff7a00;
  stroke-width:7;
  opacity:.90;
}

.history-ref-ornaments .ref-heavy-navy{
  fill:none;
  stroke:#0d3a66;
  stroke-width:7;
  opacity:.90;
}

.history-ref-ornaments .ref-dots circle{
  fill:#0d3a66;
  opacity:.20;
}

.history-ref-ornaments .ref-soft rect,
.history-ref-ornaments .ref-soft-bottom rect{
  fill:none;
  stroke:#ff7a00;
  stroke-width:2;
  opacity:.45;
}

.history-hero::after{
  content:"SEJARAH"!important;
  left:2%!important;
  top:58%!important;
  font-size:clamp(9rem,23vw,23rem)!important;
  color:rgba(13,58,102,.035)!important;
  -webkit-text-stroke:1px rgba(255,122,0,.09)!important;
  z-index:0!important;
}

.history-hero-inner{
  z-index:4!important;
  max-width:1500px!important;
  padding:clamp(4rem,10vh,7rem) clamp(1.25rem,4.2vw,4.5rem) clamp(4rem,9vh,6rem)!important;
}

.history-title{
  font-size:clamp(4.4rem,9.8vw,9.3rem)!important;
  line-height:.82!important;
  max-width:900px!important;
  letter-spacing:-.045em!important;
}

.history-title .sejarah-white{
  color:#0d3a66!important;
}

.history-title .skaneda-gold{
  background:linear-gradient(135deg,#ffd54a 0%,#ffb300 48%,#ff7a00 100%)!important;
  -webkit-background-clip:text!important;
  background-clip:text!important;
  -webkit-text-fill-color:transparent!important;
  color:transparent!important;
}

.history-kicker{
  margin-bottom:1.2rem!important;
}

.history-vt-cta{
  margin-top:2rem!important;
}

@media(min-width:1050px) {
.history-hero-inner{
    padding-right:44%!important;
  }
}

@media(max-width:900px) {
.history-ref-ornaments{
    opacity:.72;
  }
.history-title{
    font-size:clamp(4rem,11vw,7rem)!important;
  }
}

@media(max-width:560px) {
.history-ref-ornaments{
    opacity:.40;
  }
.history-hero-inner{
    padding-right:1.25rem!important;
  }
.history-title{
    font-size:clamp(3.3rem,16vw,5.5rem)!important;
  }
}

.history-hero{
  background:#fff!important;
  overflow:hidden!important;
}

.history-hero>.history-ref-ornaments{
  display:block!important;
  position:absolute!important;
  inset:0!important;
  z-index:1!important;
  pointer-events:none!important;
}

.history-hero>.history-ref-ornaments svg{
  width:100%!important;
  height:100%!important;
}

.history-hero-inner{
  position:relative!important;
  z-index:4!important;
  padding-right:44%!important;
}

.history-title{
  position:relative!important;
  z-index:5!important;
  max-width:900px!important;
}

.history-kicker,.history-vt-cta{
  position:relative!important;
  z-index:5!important;
}

.history-ref-ornaments .ref-right path,
.history-ref-ornaments .ref-bottom path{
  opacity:.34!important;
}

.history-ref-ornaments .ref-diamond-orange{
  stroke-width:2.4!important;
  opacity:.72!important;
}

.history-ref-ornaments .ref-fill-orange,
.history-ref-ornaments .ref-fill-navy{
  opacity:.96!important;
}

.history-ref-ornaments .ref-hex{
  stroke-width:2.4!important;
  opacity:.48!important;
}

.history-ref-ornaments .ref-orbit{
  stroke-width:1.8!important;
  opacity:.30!important;
}

.history-ref-ornaments .ref-orbit-orange{
  stroke-width:1.8!important;
  opacity:.42!important;
}

.history-ref-ornaments .ref-heavy-orange,
.history-ref-ornaments .ref-heavy-navy{
  stroke-width:6!important;
  opacity:.72!important;
}

.history-ref-ornaments .ref-node-orange,
.history-ref-ornaments .ref-node-navy{
  stroke-width:2.2!important;
}

@media(max-width:1050px) {
.history-hero-inner{padding-right:1.25rem!important}
.history-ref-ornaments{opacity:.72!important}
}

@media(max-width:700px) {
.history-hero-inner{padding-right:1.25rem!important}
.history-ref-ornaments{opacity:.45!important}
.history-title{font-size:clamp(3rem,14vw,5rem)!important}
}

.history-hero > .history-ref-ornaments{
  position:absolute!important;
  inset:0!important;
  z-index:1!important;
  overflow:hidden!important;
  pointer-events:none!important;
  opacity:1!important;
}

.history-ref-ornament-image{
  position:absolute!important;
  inset:0!important;
  width:100%!important;
  height:100%!important;
  display:block!important;
  object-fit:cover!important;
  object-position:center center!important;
  max-width:none!important;
  opacity:1!important;
}

.history-hero-inner{
  position:relative!important;
  z-index:4!important;
}

.history-title,.history-kicker,.history-vt-cta{
  position:relative!important;
  z-index:5!important;
}

@media(max-width:900px) {
.history-ref-ornament-image{object-position:center center!important;opacity:.88!important}
}

@media(max-width:560px) {
.history-ref-ornament-image{object-position:center center!important;opacity:.62!important}
}
/* Override khusus: watermark judul besar di background hero -> LPS (bukan SEJARAH) */
.aphp-page .history-hero::after{
  content:"LPS"!important;
}


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
/* Video showcase */
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
/* icon helpers (emoji-free) */
.dkv-kicker i{font-size:.8rem;color:#6FAF45}
.cari-opt-ic i{font-size:1.5rem;color:#FF8A00;line-height:1}
.fcta-copy h3 i{color:#FFD54A;margin-right:.4rem;font-size:1.1em;vertical-align:-2px}
@media(max-width:1050px){.vid-wrap{grid-template-columns:1fr;gap:2.6rem}.vid-cards{grid-template-columns:repeat(3,1fr)}.vid-side{display:none}.vid-stage::before,.vid-stage::after{display:none}}
@media(max-width:760px){.vid-cards{grid-template-columns:1fr}.vid-copy h2{font-size:clamp(1.9rem,7vw,2.6rem)}.vid-play{width:66px;height:66px;font-size:1.35rem}.vid-ring{width:110px;height:110px;right:-18px;top:-18px}.vid-section{padding:64px 0 72px}}

/* ===== SECTION 2 — TENTANG LPS / FROM FARM TO PRODUCT ===== */
.tentang-section{position:relative;overflow:hidden;background:linear-gradient(135deg,#f8fbff 0%,#eef5fb 55%,#e7f1f8 100%);padding-top:88px;padding-bottom:100px}
.tentang-section::before{content:"";position:absolute;inset:0;pointer-events:none;background-image:linear-gradient(rgba(11,95,165,.035) 1px,transparent 1px),linear-gradient(90deg,rgba(11,95,165,.035) 1px,transparent 1px);background-size:54px 54px;mask-image:linear-gradient(90deg,black,transparent 82%)}
.tentang-section::after{content:"LPS";position:absolute;right:-5%;bottom:-10%;font-family:var(--font-display);font-size:clamp(10rem,25vw,22rem);font-weight:900;line-height:.8;letter-spacing:-.04em;color:rgba(7,27,51,.025);pointer-events:none}
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

/* visual: no external image dependency, no broken thumbnails */
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
.fasilitas-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.2rem;width:min(1200px,94%);margin:0 auto 2rem}
.fasilitas-card{position:relative;padding:1.6rem 1.4rem;border-radius:20px;background:#fff;border:1px solid rgba(7,27,51,.1);text-align:center;transition:transform .35s ease,border-color .35s ease,box-shadow .35s ease}
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
@media(max-width:1050px){.fasilitas-grid{grid-template-columns:repeat(2,1fr)}.fasilitas-cta{flex-direction:column;text-align:center;padding:2rem}}
@media(max-width:640px){.fasilitas-grid{grid-template-columns:1fr}}

/* ===== SECTION 7 — KARYA SISWA ===== */
.produk-section{background:#fff}
.produk-head{width:min(1320px,92%);margin:0 auto 48px;display:flex;justify-content:space-between;align-items:end;gap:2rem}
.produk-note{max-width:320px;color:#718396;font-size:.78rem;line-height:1.7;text-align:right}
.produk-filters{display:flex;flex-wrap:wrap;gap:.5rem;width:min(1320px,92%);margin:0 auto 1.6rem}
.pf-btn{padding:.45rem 1rem;border-radius:999px;border:1.5px solid rgba(7,27,51,.18);background:#fff;color:#0d3a66;font-size:.72rem;font-weight:800;cursor:pointer;transition:background .25s ease,color .25s ease,border-color .25s ease}
.pf-btn:hover{border-color:#FF8A00;color:#FF8A00}
.pf-btn.active{background:linear-gradient(135deg,#0d3a66,#0B5FA5);color:#fff;border-color:transparent}
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

/* ===== SECTION 10 — CARI JURUSANMU (QUIZ) ===== */
.cari-section{background:linear-gradient(180deg,#f8fbff 0%,#eef5fb 100%)}
.cari-head{width:min(860px,92%);margin:0 auto 52px;text-align:center}
.cari-head .eyebrow{justify-content:center}
.cari-head .eyebrow::before{display:none}
.cari-head .eyebrow::after{content:"";width:24px;height:3px;border-radius:99px;background:linear-gradient(90deg,#FFD54A,#FF8A00)}
.cari-head p{margin:.8rem auto 0;max-width:600px;color:#5f7186;font-size:.95rem;line-height:1.85}
.cari-card{position:relative;z-index:2;width:min(860px,92%);margin:0 auto;border-radius:28px;background:#fff;border:1px solid rgba(7,27,51,.1);box-shadow:0 36px 80px rgba(7,27,51,.08);overflow:hidden;padding:clamp(1.6rem,3.6vw,2.8rem)}
.cari-card::before{content:"";position:absolute;top:0;left:0;width:100%;height:5px;background:linear-gradient(90deg,#0d3a66,#0B5FA5,#FFD54A,#FF8A00,#6FAF45)}
.cari-deco{position:absolute;right:-60px;top:-60px;width:180px;height:180px;border:2px solid rgba(255,179,0,.14);border-radius:50%;pointer-events:none}
.cari-deco::before{content:"";position:absolute;inset:22px;border:1px dashed rgba(11,95,165,.2);border-radius:50%}
.cari-deco2{position:absolute;left:-40px;bottom:-40px;width:110px;height:110px;border:2px solid rgba(7,27,51,.08);transform:rotate(45deg);pointer-events:none}
.cari-top{display:flex;align-items:center;justify-content:space-between;gap:1rem;margin-bottom:1.2rem}
.cari-count{font-family:var(--font-display);font-size:.9rem;font-weight:900;letter-spacing:.12em;color:#FF8A00}
.cari-bar{height:5px;border-radius:99px;background:rgba(7,27,51,.08);overflow:hidden;margin-bottom:2rem}
.cari-bar-fill{height:100%;width:20%;border-radius:99px;background:linear-gradient(90deg,#FFD54A,#FF8A00);transition:width .5s cubic-bezier(.4,0,.2,1)}
.cari-ask{font-family:var(--font-display);font-size:clamp(1.2rem,2.4vw,1.8rem);font-weight:800;color:#0d3a66;line-height:1.3;margin:0 0 1.4rem;position:relative;z-index:2}
.cari-options{display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:.9rem;position:relative;z-index:2}
.cari-opt{position:relative;border:1.5px solid rgba(7,27,51,.12);border-radius:16px;background:#fbfcfe;padding:1.2rem .9rem 1rem;text-align:center;cursor:pointer;transition:transform .25s ease,border-color .25s ease,background .25s ease,box-shadow .25s ease}
.cari-opt:hover{transform:translateY(-4px);border-color:rgba(255,138,0,.35);box-shadow:0 14px 30px rgba(7,27,51,.08)}
.cari-opt.selected{border-color:#FF8A00;background:#fff7ef;box-shadow:0 0 0 3px rgba(255,138,0,.12)}
.cari-opt-ic{font-size:1.7rem;color:#FF8A00;margin-bottom:.45rem;display:block;line-height:1}
.cari-opt-lb{font-size:.75rem;font-weight:700;color:#0d3a66;line-height:1.4;display:block}
.cari-opt .cari-check{position:absolute;top:7px;right:7px;width:18px;height:18px;border-radius:50%;background:#FF8A00;color:#fff;font-size:.55rem;display:flex;align-items:center;justify-content:center;opacity:0;transform:scale(.5);transition:opacity .25s ease,transform .25s ease}
.cari-opt.selected .cari-check{opacity:1;transform:scale(1)}
.cari-nav{display:flex;align-items:center;justify-content:space-between;gap:1rem;margin-top:1.8rem;position:relative;z-index:2}
.cari-back{background:none;border:none;color:#8aa0b5;font-size:.8rem;font-weight:700;cursor:pointer;padding:.4rem .2rem;display:inline-flex;align-items:center;gap:.35rem;transition:color .25s ease}
.cari-back:hover{color:#0d3a66}
.cari-next{display:inline-flex;align-items:center;gap:.5rem;padding:.85rem 1.7rem;border-radius:999px;border:none;background:linear-gradient(135deg,#FFD54A,#FFB300,#FF8A00);color:#0d3a66;font-weight:800;font-size:.85rem;cursor:pointer;box-shadow:0 14px 30px rgba(255,138,0,.28);transition:transform .25s ease,box-shadow .25s ease}
.cari-next:hover{transform:translateY(-3px);box-shadow:0 18px 36px rgba(255,138,0,.38)}
.cari-next:disabled{opacity:.4;cursor:default;transform:none;box-shadow:none}
.cari-step{display:none}
.cari-step.active{display:block;animation:cariIn .45s cubic-bezier(.22,.61,.36,1) both}
@keyframes cariIn{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:none}}
.cari-result{display:none;text-align:center;position:relative;z-index:2}
.cari-result.show{display:block;animation:cariIn .5s cubic-bezier(.22,.61,.36,1) both}
.cari-score-ring-wrap{position:relative;width:160px;height:160px;margin:0 auto 1.2rem}
.cari-score-ring{position:absolute;inset:0;width:100%;height:100%;transform:rotate(-90deg)}
.cari-score-ring .ring-bg{fill:none;stroke:rgba(7,27,51,.08);stroke-width:12}
.cari-score-ring .ring-fg{fill:none;stroke:url(#cariGrad);stroke-width:12;stroke-linecap:round;stroke-dasharray:414;stroke-dashoffset:414;transition:stroke-dashoffset 1.4s cubic-bezier(.4,0,.2,1)}
.cari-score-num{position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center}
.cari-score-num b{font-family:var(--font-display);font-size:2.4rem;font-weight:900;line-height:1;color:#0d3a66}
.cari-score-num span{font-size:.62rem;font-weight:800;letter-spacing:.14em;color:#8aa0b5;text-transform:uppercase;margin-top:.15rem}
.cari-score-label{font-family:var(--font-display);font-size:clamp(1.3rem,2.8vw,1.9rem);font-weight:900;color:#0d3a66;margin:0 0 .3rem}
.cari-score-label em{font-style:normal;background:linear-gradient(135deg,#FFB300,#FF8A00);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent}
.cari-score-desc{color:#5f7186;font-size:.9rem;line-height:1.8;max-width:500px;margin:0 auto 1.6rem}
.cari-score-reasons{display:flex;flex-wrap:wrap;justify-content:center;gap:.5rem;margin-bottom:1.7rem}
.cari-reason{display:inline-flex;align-items:center;gap:.4rem;font-size:.7rem;font-weight:700;color:#0d3a66;background:#eef4fb;border:1px solid rgba(11,95,165,.2);padding:.4rem .8rem;border-radius:999px}
.cari-reason i{color:#FF8A00}
.cari-score-actions{display:flex;flex-wrap:wrap;justify-content:center;gap:.7rem}
.cari-cta-primary{display:inline-flex;align-items:center;gap:.5rem;padding:.9rem 1.9rem;border-radius:999px;text-decoration:none;background:linear-gradient(135deg,#0d3a66,#0B5FA5);color:#fff;font-weight:800;font-size:.88rem;box-shadow:0 16px 34px rgba(7,27,51,.3);transition:transform .25s ease,box-shadow .25s ease}
.cari-cta-primary:hover{transform:translateY(-3px);box-shadow:0 20px 40px rgba(7,27,51,.4)}
.cari-cta-primary i{transition:transform .25s ease}
.cari-cta-primary:hover i{transform:translateX(5px)}
.cari-cta-ghost{display:inline-flex;align-items:center;gap:.45rem;padding:.85rem 1.4rem;border-radius:999px;background:none;border:1.5px solid rgba(7,27,51,.22);color:#0d3a66;font-weight:700;font-size:.82rem;cursor:pointer;transition:border-color .25s ease,background .25s ease}
.cari-cta-ghost:hover{background:#fff;border-color:#0d3a66}

/* ===== SECTION 11 — FINAL CTA ===== */
.aphp-cta{position:relative;width:min(1180px,94%);margin:20px auto 80px;padding:58px 2.5rem 62px;border-radius:28px;overflow:hidden;text-align:center;isolation:isolate;background:linear-gradient(135deg,#0d3a66 0%,#0a2a4e 50%,#0B5FA5 100%);box-shadow:0 30px 70px rgba(7,27,51,.28)}
.aphp-cta .cta-bg{position:absolute;inset:0;z-index:0;opacity:.12}
.aphp-cta .cta-bg img{width:100%;height:100%;object-fit:cover;display:block}
.aphp-cta::after{content:"#LPS";position:absolute;left:50%;bottom:-30px;transform:translateX(-50%);font-family:var(--font-display);font-size:clamp(5rem,16vw,14rem);font-weight:900;line-height:1;color:rgba(255,255,255,.035);pointer-events:none;white-space:nowrap;user-select:none}
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
  .cari-options{grid-template-columns:repeat(2,1fr)}
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

/* ===== LPS INDUSTRY PARTNERS — CLEAN LOGO MARQUEE ===== */
.industry-collab{
  position:relative;
  overflow:hidden;
  isolation:isolate;
  background:linear-gradient(180deg,#ffffff 0%,#f8fbff 100%);
  padding-top:5.5rem;
  padding-bottom:4.2rem;
}
.industry-collab::before{
  content:"";
  position:absolute;
  inset:0;
  pointer-events:none;
  opacity:.55;
  background-image:radial-gradient(circle at 15% 20%,rgba(11,95,165,.08) 0 2px,transparent 2.5px),linear-gradient(90deg,transparent 49.8%,rgba(11,95,165,.035) 50%,transparent 50.2%);
  background-size:22px 22px,90px 90px;
}
.industry-collab .orn{z-index:0;opacity:.55}
.industry-collab .ic-head,.industry-collab .ic-marquee-wrap,.industry-collab .ic-footer{position:relative;z-index:2}
.industry-collab .ic-head{text-align:center;max-width:940px;margin:0 auto}
.industry-collab .ic-head .eyebrow{display:inline-flex;align-items:center;gap:10px;color:#ff8a00;font-weight:900;letter-spacing:.16em;font-size:.72rem;text-transform:uppercase}
.industry-collab .ic-head .eyebrow::before,.industry-collab .ic-head .eyebrow::after{content:"";width:34px;height:2px;background:#ffb51b;border-radius:999px}
.industry-collab .ic-head .big-heading{margin:.8rem 0 .65rem;color:#0d3a66;font-size:clamp(2.25rem,4.5vw,4.25rem);line-height:1.02;font-weight:950;letter-spacing:-.045em}
.industry-collab .ic-head .big-heading span{color:#ff9f00}
.industry-collab .ic-head p{max-width:760px;margin:0 auto;color:#687d95;font-size:.98rem;line-height:1.8}
.industry-collab .ic-marquee-wrap{
  width:100%;
  overflow:hidden;
  margin-top:3.1rem;
  padding:1rem 0 1.4rem;
  mask-image:linear-gradient(90deg,transparent 0,#000 7%,#000 93%,transparent 100%);
  -webkit-mask-image:linear-gradient(90deg,transparent 0,#000 7%,#000 93%,transparent 100%);
}
.industry-collab .ic-marquee{display:flex;width:max-content;align-items:flex-start;gap:62px;animation:aphpIndustryMarquee 38s linear infinite;will-change:transform}
.industry-collab .ic-marquee-wrap:hover .ic-marquee{animation-play-state:paused}
.industry-collab .ic-logo{
  width:190px;
  min-width:190px;
  min-height:155px;
  padding:8px 12px;
  display:flex;
  flex-direction:column;
  align-items:center;
  justify-content:flex-start;
  gap:13px;
  background:transparent;
  border:0;
  box-shadow:none;
  text-align:center;
  transition:transform .35s ease;
}
.industry-collab .ic-logo:hover{transform:translateY(-9px)}
.industry-collab .ic-mark{
  width:92px;
  height:92px;
  min-width:92px;
  border-radius:22px;
  display:flex;
  align-items:center;
  justify-content:center;
  background:#fff;
  border:1px solid rgba(7,27,51,.08);
  box-shadow:0 14px 32px rgba(7,27,51,.09);
  overflow:hidden;
  color:#0b5fa5;
  font-weight:950;
  font-size:.86rem;
  letter-spacing:.04em;
  transition:transform .35s ease,box-shadow .35s ease;border-color .35s ease;
}
.industry-collab .ic-mark img{width:100%;height:100%;object-fit:contain;padding:10px;display:block}
.industry-collab .ic-logo:hover .ic-mark{transform:scale(1.06);border-color:rgba(255,159,0,.55);box-shadow:0 18px 38px rgba(7,27,51,.14)}
.industry-collab .ic-name{font-size:.82rem;line-height:1.35;font-weight:900;color:#0d3a66;max-width:185px}
.industry-collab .ic-name::after{content:"";display:block;width:24px;height:2px;background:#ffb51b;margin:8px auto 0;border-radius:999px;transition:width .3s ease}
.industry-collab .ic-logo:hover .ic-name::after{width:44px}
.industry-collab .ic-footer{text-align:center;margin-top:1.2rem;color:#7a8ca1;font-size:.76rem;font-weight:800;letter-spacing:.03em}
.industry-collab .ic-footer::before{content:"";display:inline-block;width:34px;height:2px;background:#ffb51b;vertical-align:middle;margin-right:10px;border-radius:999px}
@keyframes aphpIndustryMarquee{from{transform:translate3d(0,0,0)}to{transform:translate3d(calc(-50% - 31px),0,0)}}
@media(max-width:700px){
 .industry-collab{padding-top:4.2rem;padding-bottom:3rem}
 .industry-collab .ic-head .big-heading{font-size:2.25rem}
 .industry-collab .ic-head p{padding:0 1rem;font-size:.88rem}
 .industry-collab .ic-marquee{gap:38px;animation-duration:30s}
 .industry-collab .ic-logo{width:145px;min-width:145px;min-height:135px}
 .industry-collab .ic-mark{width:76px;height:76px;min-width:76px;border-radius:18px}
 .industry-collab .ic-name{font-size:.7rem;max-width:145px}
}

.industry-collab .ic-mark.ic-fallback::after{content:attr(data-fallback);display:flex;align-items:center;justify-content:center;width:100%;height:100%;font-weight:950;color:#0b5fa5;font-size:.9rem}

/* =========================================================
   LAB TOUR — SAMA PERSIS DENGAN VIRTUAL TOUR DI HALAMAN SEJARAH
   Hanya konten, gambar, label, dan anchor yang disesuaikan untuk LPS.
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
@endpush

@section('content')
<div class="aphp-page">
  <!-- ===== HERO — sama persis dengan hero halaman Sejarah, judul LPS ===== -->
  <section class="history-hero">
    <div class="history-ref-ornaments" aria-hidden="true">
      <img src="{{ asset('images/wide_minimalist_abstract_technology_background_des.png') }}" alt="" class="history-ref-ornament-image" aria-hidden="true">
    </div>
    <div class="history-hero-inner">
      <div>
        <div class="history-kicker"><i class="fas fa-building-columns"></i> PROGRAM KEAHLIAN LPS</div>
        <h1 class="history-title">
          <span class="sejarah-white">LPS</span>
          <span class="skaneda-gold">SKANEDA</span>
        </h1>
        <a class="history-vt-cta" href="#lab-tour">
          <span class="history-vt-icon"><i class="fas fa-handshake"></i></span>
          <span><strong>Lihat LPS Tour</strong><small>Jelajahi Ruang Praktik Bank Mini Syariah</small></span>
          <i class="fas fa-arrow-right history-vt-arrow"></i>
        </a>
      </div>
    </div>
  </section>

  <!-- ===== SECTION 1 — VIDEO PENGENALAN (HERO MINI) ===== -->
  <section class="vid-section" id="video-aphp">
    <div class="orn" aria-hidden="true">
      <span class="o-dots"></span><span class="o-line"></span>
      <span class="o-ring"></span><span class="o-hex"></span>
      <span class="o-gold"></span><i class="fas fa-coins o-wheat"></i>
      <i class="fas fa-building-columns o-flask"></i>
    </div>
    <div class="vid-wrap">
      <div class="vid-copy" data-reveal="left">
        <div class="vc-eyebrow">
          <span class="vc-num">01</span>
          <span class="vc-line"></span>
          <span class="vc-label">Pengenalan Kompetensi Keahlian</span>
        </div>
        <h2><span class="sejarah-white">MENGENAL LEBIH DEKAT</span><span class="t-gold"> LPS</span></h2>
        <p class="vc-desc">Kenali Program Keahlian Layanan Perbankan Syariah (LPS), mulai dari pembelajaran, praktik perbankan, fasilitas bank mini, hingga berbagai pengalaman yang akan kamu dapatkan selama belajar di LPS.</p>
        <div class="vid-cards">
          <div class="vid-card">
            <span class="vc-ic green"><i class="fas fa-piggy-bank"></i></span>
            <b>Dasar Perbankan Syariah</b>
            <span>Memahami prinsip dan akad dalam perbankan syariah</span>
          </div>
          <div class="vid-card">
            <span class="vc-ic"><i class="fas fa-handshake"></i></span>
            <b>Produk & Layanan Syariah</b>
            <span>Mempelajari tabungan, deposito, dan pembiayaan syariah</span>
          </div>
          <div class="vid-card">
            <span class="vc-ic gold"><i class="fas fa-headset"></i></span>
            <b>Layanan Nasabah</b>
            <span>Melatih keterampilan sebagai teller dan customer service</span>
          </div>
        </div>
      </div>
      <div class="vid-stage" data-reveal="right">
        <span class="vid-side">LPS • SKANEDA</span>
        <div class="vid-player" role="button" tabindex="0" aria-label="Putar video pengenalan LPS" onclick="alert('Video pengenalan LPS akan diputar di sini.')">
          <div class="vid-bg" aria-hidden="true"></div>
          <span class="vid-ring" aria-hidden="true"></span>
          <span class="vid-hex" aria-hidden="true"></span>
          <span class="vid-diag" aria-hidden="true"></span>
          <span class="vid-play"><i class="fas fa-circle-play"></i></span>
          <span class="vid-brand"><b>LPS</b><span>Program Keahlian</span></span>
          <span class="vid-label"><i class="fas fa-play"></i> Video Pengenalan</span>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== SECTION 2 — TENTANG LPS ===== -->
  <section class="tentang-section section-pad" id="tentang-aphp">
    <div class="orn" aria-hidden="true">
      <span class="o-chevron"></span><span class="o-line"></span><span class="o-dots"></span>
      <span class="o-ring"></span><span class="o-gold"></span><span class="o-square"></span>
    </div>

    <div class="aphp-wide tentang-grid">
      <div class="tentang-copy" data-reveal="left">
        <div class="tc-top">
          <span class="tc-num">02</span>
          <span class="tc-line"></span>
          <span class="tc-label">Tentang Kompetensi Keahlian</span>
        </div>

        <div class="eyebrow gold">Apa Itu LPS?</div>
        <h2 class="big-heading">MELAYANI DENGAN <span>PRINSIP SYARIAH</span></h2>

        <p class="tc-lead">Program Keahlian <strong>Layanan Perbankan Syariah (LPS)</strong> membekali peserta didik dengan keterampilan mengelola transaksi, melayani nasabah, dan menjalankan operasional perbankan berdasarkan prinsip syariah — mulai dari teller, customer service, hingga administrasi back office.</p>
        <p class="tc-sub">Pembelajaran mencakup dasar-dasar perbankan syariah, akad-akad muamalah, produk simpanan dan pembiayaan syariah, administrasi transaksi, aplikasi core banking, hingga praktik langsung di bank mini syariah. Melalui simulasi dan praktik kerja, siswa belajar melayani nasabah secara profesional sekaligus memahami prinsip kejujuran dan keadilan dalam ekonomi syariah.</p>

        <div class="tentang-mini">
          <div class="tentang-mini-card">
            <span class="tm-ic"><i class="fas fa-piggy-bank"></i></span>
            <span>Produk Simpanan Syariah — Tabungan, giro, dan deposito syariah</span>
          </div>
          <div class="tentang-mini-card">
            <span class="tm-ic green"><i class="fas fa-handshake"></i></span>
            <span>Akad & Pembiayaan — Murabahah, mudharabah, dan musyarakah</span>
          </div>
          <div class="tentang-mini-card">
            <span class="tm-ic gold"><i class="fas fa-headset"></i></span>
            <span>Layanan Nasabah — Melayani transaksi sebagai teller &amp; customer service</span>
          </div>
          <div class="tentang-mini-card">
            <span class="tm-ic"><i class="fas fa-scale-balanced"></i></span>
            <span>Kepatuhan Syariah — Menjunjung prinsip kejujuran dan keadilan</span>
          </div>
        </div>
      </div>

      <div class="tentang-visual" data-reveal="right">
        <div class="tv-panel">
          <div class="tv-top">
            <div class="tv-top-label"><i class="fas fa-layer-group"></i> Alur LPS</div>
            <div class="tv-top-code">02 / LPS</div>
          </div>

          <div class="tv-center">
            <div class="tv-core">
              <i class="fas fa-building-columns"></i>
              <strong>LPS</strong>
              <small>Belajar hingga Bekerja</small>
            </div>
          </div>

          <div class="tv-flow">
            <div class="tv-step">
              <span class="ts-ic"><i class="fas fa-piggy-bank"></i></span>
              <span class="ts-copy"><strong>Produk Syariah</strong><small>Mengenal produk simpanan</small></span>
              <i class="fas fa-arrow-right tv-arrow"></i>
            </div>
            <div class="tv-step">
              <span class="ts-ic green"><i class="fas fa-handshake"></i></span>
              <span class="ts-copy"><strong>Transaksi Nasabah</strong><small>Praktik jadi teller & CS</small></span>
              <i class="fas fa-arrow-right tv-arrow"></i>
            </div>
            <div class="tv-step">
              <span class="ts-ic blue"><i class="fas fa-scale-balanced"></i></span>
              <span class="ts-copy"><strong>Uji Kepatuhan</strong><small>Ketelitian &amp; keakuratan</small></span>
              <i class="fas fa-arrow-right tv-arrow"></i>
            </div>
            <div class="tv-step">
              <span class="ts-ic gold"><i class="fas fa-user-tie"></i></span>
              <span class="ts-copy"><strong>Siap Bekerja</strong><small>Siap terjun industri</small></span>
              <i class="fas fa-arrow-right tv-arrow"></i>
            </div>
          </div>

          <div class="tv-bottom">
            <span>TELLER • CUSTOMER SERVICE • SYARIAH</span>
            <span class="tv-status"><i class="fas fa-circle"></i> Program Keahlian</span>
          </div>
        </div>
      </div>
    </div>
  </section>

      <!-- ===== SECTION 3 — INDUSTRY COLLABORATION MARQUEE ===== -->
    <section class="industry-collab section-pad" id="industri-aphp">
      <div class="orn" aria-hidden="true">
        <span class="o-chevron"></span><span class="o-dots"></span>
        <span class="o-ring"></span><span class="o-gold"></span>
        <span class="o-hex"></span>
      </div>
      <div class="ic-head" data-reveal>
        <div class="eyebrow">Kerja Sama &amp; Industri Perbankan</div>
        <h2 class="big-heading">BERKOLABORASI DENGAN <span>INDUSTRI PERBANKAN SYARIAH</span></h2>
      </div>
      <div class="ic-marquee-wrap" data-reveal aria-label="Mitra industri LPS">
        <div class="ic-marquee">
          <div class="ic-logo"><span class="ic-mark"><img src="{{ asset('images/mitra-lps/bsi.png') }}" alt="Logo Bank Syariah Indonesia" loading="lazy" onerror="this.style.display='none'; this.parentElement.classList.add('ic-fallback'); this.parentElement.setAttribute('data-fallback','BSI');"></span><span class="ic-name">Bank Syariah Indonesia</span></div>
          <div class="ic-logo"><span class="ic-mark"><img src="{{ asset('images/mitra-lps/muamalat.png') }}" alt="Logo Bank Muamalat Indonesia" loading="lazy" onerror="this.style.display='none'; this.parentElement.classList.add('ic-fallback'); this.parentElement.setAttribute('data-fallback','BMI');"></span><span class="ic-name">Bank Muamalat Indonesia</span></div>
          <div class="ic-logo"><span class="ic-mark"><img src="{{ asset('images/mitra-lps/btpn-syariah.png') }}" alt="Logo BTPN Syariah" loading="lazy" onerror="this.style.display='none'; this.parentElement.classList.add('ic-fallback'); this.parentElement.setAttribute('data-fallback','BTS');"></span><span class="ic-name">BTPN Syariah</span></div>
          <div class="ic-logo"><span class="ic-mark"><img src="{{ asset('images/mitra-lps/bank-jatim-syariah.png') }}" alt="Logo Bank Jatim Syariah" loading="lazy" onerror="this.style.display='none'; this.parentElement.classList.add('ic-fallback'); this.parentElement.setAttribute('data-fallback','BJS');"></span><span class="ic-name">Bank Jatim Syariah</span></div>
          <div class="ic-logo"><span class="ic-mark"><img src="{{ asset('images/mitra-lps/bprs-lantabur.png') }}" alt="Logo BPRS Lantabur Tebuireng" loading="lazy" onerror="this.style.display='none'; this.parentElement.classList.add('ic-fallback'); this.parentElement.setAttribute('data-fallback','BPRS');"></span><span class="ic-name">BPRS Lantabur Tebuireng</span></div>
          <div class="ic-logo"><span class="ic-mark"><img src="{{ asset('images/mitra-lps/bmt-nu.png') }}" alt="Logo BMT NU Jawa Timur" loading="lazy" onerror="this.style.display='none'; this.parentElement.classList.add('ic-fallback'); this.parentElement.setAttribute('data-fallback','BMT');"></span><span class="ic-name">BMT NU Jawa Timur</span></div>
          <div class="ic-logo"><span class="ic-mark"><img src="{{ asset('images/mitra-lps/koperasi-syariah.png') }}" alt="Logo Koperasi Simpan Pinjam Syariah" loading="lazy" onerror="this.style.display='none'; this.parentElement.classList.add('ic-fallback'); this.parentElement.setAttribute('data-fallback','KSPS');"></span><span class="ic-name">Koperasi Simpan Pinjam Syariah</span></div>
          <div class="ic-logo"><span class="ic-mark"><img src="{{ asset('images/mitra-lps/pegadaian-syariah.png') }}" alt="Logo Pegadaian Syariah" loading="lazy" onerror="this.style.display='none'; this.parentElement.classList.add('ic-fallback'); this.parentElement.setAttribute('data-fallback','PGS');"></span><span class="ic-name">Pegadaian Syariah</span></div>
          <div class="ic-logo"><span class="ic-mark"><img src="{{ asset('images/mitra-lps/bri-syariah.png') }}" alt="Logo Unit Usaha Syariah BRI" loading="lazy" onerror="this.style.display='none'; this.parentElement.classList.add('ic-fallback'); this.parentElement.setAttribute('data-fallback','UUS');"></span><span class="ic-name">Unit Usaha Syariah BRI</span></div>
          <div class="ic-logo"><span class="ic-mark"><img src="{{ asset('images/mitra-lps/ojk.png') }}" alt="Logo Otoritas Jasa Keuangan" loading="lazy" onerror="this.style.display='none'; this.parentElement.classList.add('ic-fallback'); this.parentElement.setAttribute('data-fallback','OJK');"></span><span class="ic-name">Otoritas Jasa Keuangan</span></div>
          <div class="ic-logo"><span class="ic-mark"><img src="{{ asset('images/mitra-lps/kjks.png') }}" alt="Logo Koperasi Jasa Keuangan Syariah" loading="lazy" onerror="this.style.display='none'; this.parentElement.classList.add('ic-fallback'); this.parentElement.setAttribute('data-fallback','KJKS');"></span><span class="ic-name">Koperasi Jasa Keuangan Syariah</span></div>
          <div class="ic-logo"><span class="ic-mark"><img src="{{ asset('images/mitra-lps/bsi.png') }}" alt="Logo Bank Syariah Indonesia" loading="lazy" onerror="this.style.display='none'; this.parentElement.classList.add('ic-fallback'); this.parentElement.setAttribute('data-fallback','BSI');"></span><span class="ic-name">Bank Syariah Indonesia</span></div>
          <div class="ic-logo"><span class="ic-mark"><img src="{{ asset('images/mitra-lps/muamalat.png') }}" alt="Logo Bank Muamalat Indonesia" loading="lazy" onerror="this.style.display='none'; this.parentElement.classList.add('ic-fallback'); this.parentElement.setAttribute('data-fallback','BMI');"></span><span class="ic-name">Bank Muamalat Indonesia</span></div>
          <div class="ic-logo"><span class="ic-mark"><img src="{{ asset('images/mitra-lps/btpn-syariah.png') }}" alt="Logo BTPN Syariah" loading="lazy" onerror="this.style.display='none'; this.parentElement.classList.add('ic-fallback'); this.parentElement.setAttribute('data-fallback','BTS');"></span><span class="ic-name">BTPN Syariah</span></div>
          <div class="ic-logo"><span class="ic-mark"><img src="{{ asset('images/mitra-lps/bank-jatim-syariah.png') }}" alt="Logo Bank Jatim Syariah" loading="lazy" onerror="this.style.display='none'; this.parentElement.classList.add('ic-fallback'); this.parentElement.setAttribute('data-fallback','BJS');"></span><span class="ic-name">Bank Jatim Syariah</span></div>
          <div class="ic-logo"><span class="ic-mark"><img src="{{ asset('images/mitra-lps/bprs-lantabur.png') }}" alt="Logo BPRS Lantabur Tebuireng" loading="lazy" onerror="this.style.display='none'; this.parentElement.classList.add('ic-fallback'); this.parentElement.setAttribute('data-fallback','BPRS');"></span><span class="ic-name">BPRS Lantabur Tebuireng</span></div>
          <div class="ic-logo"><span class="ic-mark"><img src="{{ asset('images/mitra-lps/bmt-nu.png') }}" alt="Logo BMT NU Jawa Timur" loading="lazy" onerror="this.style.display='none'; this.parentElement.classList.add('ic-fallback'); this.parentElement.setAttribute('data-fallback','BMT');"></span><span class="ic-name">BMT NU Jawa Timur</span></div>
          <div class="ic-logo"><span class="ic-mark"><img src="{{ asset('images/mitra-lps/koperasi-syariah.png') }}" alt="Logo Koperasi Simpan Pinjam Syariah" loading="lazy" onerror="this.style.display='none'; this.parentElement.classList.add('ic-fallback'); this.parentElement.setAttribute('data-fallback','KSPS');"></span><span class="ic-name">Koperasi Simpan Pinjam Syariah</span></div>
          <div class="ic-logo"><span class="ic-mark"><img src="{{ asset('images/mitra-lps/pegadaian-syariah.png') }}" alt="Logo Pegadaian Syariah" loading="lazy" onerror="this.style.display='none'; this.parentElement.classList.add('ic-fallback'); this.parentElement.setAttribute('data-fallback','PGS');"></span><span class="ic-name">Pegadaian Syariah</span></div>
        </div>
      </div>
      <div class="ic-footer" data-reveal><span>Belajar &bull; Praktik &bull; Berkolaborasi &bull; Siap Bekerja</span></div>
    </section>

<!-- ===== SECTION 4 — PEMBELAJARAN ===== -->
  <section class="belajar-section section-pad" id="pembelajaran">
    <div class="orn" aria-hidden="true">
      <span class="o-chevron"></span><span class="o-dots"></span>
      <span class="o-ring"></span><span class="o-gold"></span><span class="o-corner"></span>
    </div>
    <div class="belajar-head" data-reveal>
      <div class="eyebrow gold">APA YANG KAMU PELAJARI?</div>
      <h2 class="big-heading">APA YANG AKAN <span>KAMU PELAJARI?</span></h2>
    </div>
    <div class="belajar-grid">
      <div class="belajar-card" data-num="01" data-reveal>
        <div class="bc-ic"><i class="fas fa-piggy-bank"></i></div>
        <h4>Produk &amp; Layanan Syariah</h4>
        <p>Mempelajari produk tabungan, giro, deposito, serta layanan simpanan berbasis prinsip syariah.</p>
        <span class="bc-arrow">Pelajari <i class="fas fa-arrow-right"></i></span>
      </div>
      <div class="belajar-card" data-num="02" data-reveal style="--d:1">
        <div class="bc-ic green"><i class="fas fa-handshake"></i></div>
        <h4>Akad Muamalah</h4>
        <p>Memahami akad murabahah, mudharabah, musyarakah, ijarah, dan penerapannya dalam pembiayaan.</p>
        <span class="bc-arrow">Pelajari <i class="fas fa-arrow-right"></i></span>
      </div>
      <div class="belajar-card" data-num="03" data-reveal style="--d:2">
        <div class="bc-ic blue"><i class="fas fa-magnifying-glass"></i></div>
        <h4>Administrasi &amp; Kepatuhan</h4>
        <p>Mempelajari proses verifikasi dokumen, ketelitian transaksi, dan kepatuhan terhadap prinsip syariah.</p>
        <span class="bc-arrow">Pelajari <i class="fas fa-arrow-right"></i></span>
      </div>
      <div class="belajar-card" data-num="04" data-reveal style="--d:3">
        <div class="bc-ic gold"><i class="fas fa-headset"></i></div>
        <h4>Layanan Nasabah (Customer Service)</h4>
        <p>Melatih komunikasi, keramahan, dan penyelesaian keluhan nasabah secara profesional.</p>
        <span class="bc-arrow">Pelajari <i class="fas fa-arrow-right"></i></span>
      </div>
      <div class="belajar-card" data-num="05" data-reveal style="--d:4">
        <div class="bc-ic"><i class="fas fa-calculator"></i></div>
        <h4>Operasional Teller</h4>
        <p>Praktik menghitung, menerima, dan mengeluarkan uang tunai sesuai prosedur perbankan.</p>
        <span class="bc-arrow">Pelajari <i class="fas fa-arrow-right"></i></span>
      </div>
      <div class="belajar-card" data-num="06" data-reveal style="--d:5">
        <div class="bc-ic gold"><i class="fas fa-lightbulb"></i></div>
        <h4>Kewirausahaan Syariah</h4>
        <p>Mengembangkan jiwa usaha berbasis ekonomi syariah: menghitung kelayakan, memasarkan, dan membangun bisnis mandiri.</p>
        <span class="bc-arrow">Pelajari <i class="fas fa-arrow-right"></i></span>
      </div>
    </div>
  </section>

  <!-- ===== SECTION 5 — PRAKTIK ===== -->
  <section class="praktik-section section-pad" id="praktik-aphp">
    <div class="praktik-head" data-reveal>
      <div class="eyebrow gold">BELAJAR LEWAT SIMULASI PERBANKAN</div>
      <h2 class="big-heading">BELAJAR BUKAN <span>HANYA DI DALAM KELAS</span></h2>
    </div>
    <div class="praktik-grid">
      <div class="praktik-card" data-reveal>
        <img src="{{ asset('images/lps-bank-mini.jpg') }}" alt="Praktik simulasi bank mini syariah" loading="lazy">
        <span class="pc-badge"><i class="fas fa-handshake"></i> Praktik</span>
        <div class="pc-body">
          <h4>Praktik Bank Mini</h4>
          <p>Mengerjakan simulasi transaksi perbankan di bank mini syariah yang mendukung praktik langsung.</p>
        </div>
      </div>
      <div class="praktik-card" data-reveal style="--d:1">
        <img src="{{ asset('images/lps-praktik-teller.jpg') }}" alt="Praktik menjadi teller dan customer service" loading="lazy">
        <span class="pc-badge"><i class="fas fa-calculator"></i> Transaksi</span>
        <div class="pc-body">
          <h4>Simulasi Teller &amp; CS</h4>
          <p>Melayani transaksi simpanan, penarikan, dan pembukaan rekening sesuai standar operasional bank.</p>
        </div>
      </div>
      <div class="praktik-card" data-reveal style="--d:2">
        <img src="{{ asset('images/lps-evaluasi-praktik.jpg') }}" alt="Evaluasi dan penilaian praktik perbankan" loading="lazy">
        <span class="pc-badge"><i class="fas fa-circle-check"></i> Evaluasi</span>
        <div class="pc-body">
          <h4>Evaluasi &amp; Penilaian Praktik</h4>
          <p>Mengevaluasi ketepatan, ketelitian, dan pelayanan berdasarkan standar operasional perbankan syariah.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== SECTION 6 — FASILITAS ===== -->
  <section class="fasilitas-section section-pad" id="fasilitas-aphp">
    <div class="orn" aria-hidden="true">
      <span class="o-chevron"></span><span class="o-line"></span><span class="o-dots"></span>
      <span class="o-ring"></span><span class="o-gold"></span>
    </div>
    <div class="fasilitas-head" data-reveal>
      <div class="eyebrow gold">Praktik Nyata Perbankan</div>
      <h2 class="big-heading">RUANG UNTUK <span>PRAKTIK PERBANKAN</span></h2>
    </div>
    <div class="fasilitas-grid">
      <div class="fasilitas-card" data-reveal><div class="fc-ic"><i class="fas fa-building-columns"></i></div><h4>Bank Mini Syariah</h4><p>Ruang praktik lengkap dengan loket teller dan customer service layaknya bank sungguhan.</p></div>
      <div class="fasilitas-card" data-reveal style="--d:1"><div class="fc-ic green"><i class="fas fa-tools"></i></div><h4>Aplikasi Core Banking</h4><p>Perangkat komputer dan aplikasi simulasi perbankan untuk praktik transaksi digital.</p></div>
      <div class="fasilitas-card" data-reveal style="--d:2"><div class="fc-ic gold"><i class="fas fa-headset"></i></div><h4>Ruang Customer Service</h4><p>Ruang simulasi pelayanan nasabah untuk melatih komunikasi dan penyelesaian masalah.</p></div>
      <div class="fasilitas-card" data-reveal style="--d:3"><div class="fc-ic"><i class="fas fa-file-invoice-dollar"></i></div><h4>Ruang Administrasi &amp; Kas</h4><p>Area khusus untuk praktik administrasi dokumen dan pengelolaan kas dengan standar mutu perbankan.</p></div>
      <div class="fasilitas-card" data-reveal style="--d:4"><div class="fc-ic green"><i class="fas fa-users"></i></div><h4>Ruang Presentasi</h4><p>Area untuk presentasi materi, diskusi kasus, dan evaluasi praktik perbankan.</p></div>
      <div class="fasilitas-card" data-reveal style="--d:5"><div class="fc-ic gold"><i class="fas fa-laptop"></i></div><h4>Fasilitas Pendukung</h4><p>Ruang kelas, akses internet, referensi ekonomi syariah, dan perangkat digital untuk menunjang pembelajaran.</p></div>
    </div>
  </section>

  <!-- ===== SECTION 7 — DOKUMENTASI PRAKTIK SISWA ===== -->
  <section class="produk-section section-pad" id="produk-aphp">
    <div class="orn" aria-hidden="true">
      <span class="o-chevron"></span><span class="o-line"></span><span class="o-dots"></span>
      <span class="o-ring"></span><span class="o-gold"></span><span class="o-square"></span>
    </div>
    <div class="produk-head" data-reveal>
      <div>
        <div class="eyebrow">Dokumentasi Praktik Siswa</div>
        <h2 class="big-heading">DARI TEORI <span>MENJADI PRAKTIK</span></h2>
      </div>
      <div class="produk-note">Dokumentasi praktik siswa LPS — dirancang melalui simulasi transaksi, pelayanan nasabah, dan praktik administrasi perbankan.</div>
    </div>
    <div class="produk-filters" data-reveal>
      <button class="pf-btn active" data-f="all">SEMUA</button>
      <button class="pf-btn" data-f="teller">TELLER</button>
      <button class="pf-btn" data-f="cs">CUSTOMER SERVICE</button>
      <button class="pf-btn" data-f="administrasi">ADMINISTRASI</button>
    </div>
    <div class="produk-slider" data-reveal>
      <button class="produk-arrow prev" id="produkPrev" aria-label="Sebelumnya"><i class="fas fa-chevron-left"></i></button>
      <div class="produk-viewport">
        <div class="produk-track" id="produkTrack">
          <article class="produk-card" data-cat="teller">
            <div class="produk-photo"><img src="{{ asset('images/lps-praktik1.jpg') }}" alt="Praktik teller karya siswa LPS" loading="lazy"><span class="produk-badge">Operasional Teller</span></div>
            <div class="pc-body"><h3>Praktik Teller</h3><p>Simulasi menerima setoran, penarikan tunai, dan transfer sesuai prosedur bank syariah.</p><div class="pc-foot"><span>Bank Mini</span><span><i class="fas fa-arrow-right"></i></span></div></div>
          </article>
          <article class="produk-card" data-cat="cs">
            <div class="produk-photo"><img src="{{ asset('images/lps-praktik2.jpg') }}" alt="Simulasi customer service karya siswa LPS" loading="lazy"><span class="produk-badge">Customer Service</span></div>
            <div class="pc-body"><h3>Simulasi Customer Service</h3><p>Melayani pembukaan rekening, konsultasi produk, dan penanganan keluhan nasabah.</p><div class="pc-foot"><span>Bank Mini</span><span><i class="fas fa-arrow-right"></i></span></div></div>
          </article>
          <article class="produk-card" data-cat="administrasi">
            <div class="produk-photo"><img src="{{ asset('images/lps-praktik3.jpg') }}" alt="Praktik administrasi karya siswa LPS" loading="lazy"><span class="produk-badge">Administrasi</span></div>
            <div class="pc-body"><h3>Praktik Administrasi</h3><p>Menyusun dan memeriksa dokumen transaksi sesuai standar operasional perbankan syariah.</p><div class="pc-foot"><span>Bank Mini</span><span><i class="fas fa-arrow-right"></i></span></div></div>
          </article>
          <article class="produk-card" data-cat="teller">
            <div class="produk-photo"><img src="{{ asset('images/lps-praktik4.jpg') }}" alt="Presentasi laporan keuangan karya siswa LPS" loading="lazy"><span class="produk-badge">Operasional Teller</span></div>
            <div class="pc-body"><h3>Presentasi Laporan</h3><p>Menyusun dan mempresentasikan hasil rekap transaksi harian bank mini syariah.</p><div class="pc-foot"><span>Bank Mini</span><span><i class="fas fa-arrow-right"></i></span></div></div>
          </article>
        </div>
      </div>
      <button class="produk-arrow next" id="produkNext" aria-label="Selanjutnya"><i class="fas fa-chevron-right"></i></button>
    </div>
    <div class="produk-dots" id="produkDots"></div>
  </section>

  <!-- ===== SECTION 8 — KEGIATAN & PRESTASI ===== -->
  <section class="kegiatan-section section-pad" id="kegiatan-aphp">
    <div class="orn" aria-hidden="true">
      <span class="o-chevron"></span><span class="o-dots"></span>
      <span class="o-ring"></span><span class="o-gold"></span><span class="o-corner"></span>
    </div>
    <div class="kegiatan-head" data-reveal>
      <div class="eyebrow gold">BERKARYA & BERPRESTASI</div>
      <h2 class="big-heading">AKTIF BERLATIH, <span>BERANI BERPRESTASI</span></h2>
    </div>
    <div class="kegiatan-grid">
      <div class="kegiatan-card tall" data-reveal>
        <img src="{{ asset('images/lps-prestasi.jpg') }}" alt="Prestasi siswa LPS" loading="lazy">
        <span class="kg-badge"><i class="fas fa-trophy"></i> Prestasi</span>
        <div class="kg-body"><h4>Prestasi Siswa LPS</h4><span>Prestasi lomba perbankan syariah, akuntansi, dan ekonomi syariah tingkat kota hingga nasional</span></div>
      </div>
      <div class="kegiatan-card" data-reveal style="--d:1">
        <img src="{{ asset('images/lps-praktik-rutin.jpg') }}" alt="Praktik rutin LPS" loading="lazy">
        <span class="kg-badge"><i class="fas fa-handshake"></i> Praktik</span>
        <div class="kg-body"><h4>Praktik Rutin</h4><span>Kegiatan praktik rutin di bank mini syariah untuk melatih transaksi dan pelayanan</span></div>
      </div>
      <div class="kegiatan-card" data-reveal style="--d:2">
        <img src="{{ asset('images/lps-kunjungan-industri.jpg') }}" alt="Kunjungan industri LPS" loading="lazy">
        <span class="kg-badge"><i class="fas fa-building"></i> Industri</span>
        <div class="kg-body"><h4>Kunjungan Lembaga Keuangan</h4><span>Belajar langsung dari bank syariah, BPRS, dan lembaga keuangan syariah lainnya</span></div>
      </div>
      <div class="kegiatan-card" data-reveal>
        <img src="{{ asset('images/lps-expo.jpg') }}" alt="Expo perbankan LPS" loading="lazy">
        <span class="kg-badge"><i class="fas fa-users"></i> Expo</span>
        <div class="kg-body"><h4>Expo &amp; Simulasi Perbankan</h4><span>Menampilkan hasil praktik terbaik dalam berbagai ajang dan expo sekolah</span></div>
      </div>
      <div class="kegiatan-card" data-reveal style="--d:1">
        <img src="{{ asset('images/lps-pkl.jpg') }}" alt="PKL siswa LPS" loading="lazy">
        <span class="kg-badge"><i class="fas fa-user-tie"></i> PKL</span>
        <div class="kg-body"><h4>PKL &amp; Magang di Lembaga Keuangan</h4><span>Pengalaman kerja langsung di bank syariah, BPRS, dan koperasi syariah</span></div>
      </div>
    </div>
  </section>

  <!-- ===== SECTION 9 — PROSPEK LULUSAN ===== -->
  <section class="prospek-section section-pad" id="prospek-aphp">
    <div class="prospek-head" data-reveal>
      <div class="eyebrow gold">Mau Berkontribusi di Mana?</div>
      <h2 class="big-heading">SETELAH LULUS, <span>MAU BERKONTRIBUSI DI MANA?</span></h2>
    </div>
    <div class="prospek-grid">
      <div class="prospek-card" data-reveal>
        <div class="ps-photo"><span class="ps-num">01</span><img src="{{ asset('images/lps-kerja.jpg') }}" alt="Bekerja di industri perbankan syariah" loading="lazy"><i class="fas fa-user-tie blue"></i></div>
        <div class="ps-body"><h4>KERJA</h4><p>Teller, Customer Service, Back Office, Staff Administrasi, Frontliner, atau Marketing — siap bekerja di bank syariah maupun lembaga keuangan syariah lainnya.</p><div class="ps-tags"><span>Bank Syariah</span><span>BPRS</span><span>BMT / Koperasi Syariah</span><span>Lembaga Keuangan Mikro</span></div></div>
      </div>
      <div class="prospek-card" data-reveal style="--d:1">
        <div class="ps-photo"><span class="ps-num">02</span><img src="{{ asset('images/lps-kuliah.jpg') }}" alt="Melanjutkan kuliah di bidang perbankan syariah" loading="lazy"><i class="fas fa-graduation-cap"></i></div>
        <div class="ps-body"><h4>KULIAH</h4><p>Perbankan Syariah, Ekonomi Syariah, Akuntansi, Manajemen Keuangan, atau bidang ekonomi terkait — bekal LPS jadi modal kuat di perguruan tinggi.</p><div class="ps-tags"><span>Ekonomi Syariah</span><span>Akuntansi</span><span>Manajemen</span></div></div>
      </div>
      <div class="prospek-card" data-reveal style="--d:2">
        <div class="ps-photo"><span class="ps-num">03</span><img src="{{ asset('images/lps-usaha.jpg') }}" alt="Membangun usaha keuangan syariah sendiri" loading="lazy"><i class="fas fa-user-tie green"></i></div>
        <div class="ps-body"><h4>USAHA</h4><p>Jasa keuangan mikro syariah, koperasi syariah, konsultan keuangan syariah, dan bisnis mandiri berbasis prinsip syariah.</p><div class="ps-tags"><span>Koperasi Syariah</span><span>Jasa Keuangan</span><span>Bisnis Mandiri</span></div></div>
      </div>
    </div>
  </section>

  <!-- ===== SECTION 10 — CARI JURUSANMU (QUIZ) ===== -->
  <section class="cari-section section-pad" id="cari-jurusan">
    <div class="orn" aria-hidden="true">
      <span class="o-chevron"></span><span class="o-line"></span><span class="o-dots"></span>
      <span class="o-ring"></span><span class="o-gold"></span><span class="o-square"></span>
    </div>
    <div class="cari-head" data-reveal>
      <div class="eyebrow gold">SEBERAPA COCOK?</div>
      <h2 class="big-heading">LPS COCOK <span>BUAT KAMU?</span></h2>
    </div>
    <div class="cari-card" data-reveal>
      <span class="cari-deco" aria-hidden="true"></span>
      <span class="cari-deco2" aria-hidden="true"></span>
      <div id="cariQuiz" class="cari-quiz">
        <div class="cari-top">
          <span class="cari-count" id="cariCount">01 / 05</span>
          <span style="font-size:.65rem;font-weight:800;letter-spacing:.14em;text-transform:uppercase;color:#8aa0b5">Kenali minatmu</span>
        </div>
        <div class="cari-bar"><div class="cari-bar-fill" id="cariBar"></div></div>
        <div class="cari-step active" data-q="1">
          <h3 class="cari-ask">Kamu lebih suka aktivitas yang mana?</h3>
          <div class="cari-options">
            <div class="cari-opt" data-v="0"><span class="cari-opt-ic"><i class="fas fa-headset"></i></span><span class="cari-opt-lb">Melayani orang lain dengan ramah</span><span class="cari-check"><i class="fas fa-check"></i></span></div>
            <div class="cari-opt" data-v="1"><span class="cari-opt-ic"><i class="fas fa-calculator"></i></span><span class="cari-opt-lb">Menghitung dan mengelola uang</span><span class="cari-check"><i class="fas fa-check"></i></span></div>
            <div class="cari-opt" data-v="2"><span class="cari-opt-ic"><i class="fas fa-file-invoice-dollar"></i></span><span class="cari-opt-lb">Menyusun dan memeriksa dokumen</span><span class="cari-check"><i class="fas fa-check"></i></span></div>
            <div class="cari-opt" data-v="3"><span class="cari-opt-ic"><i class="fas fa-users"></i></span><span class="cari-opt-lb">Berkomunikasi dan bernegosiasi</span><span class="cari-check"><i class="fas fa-check"></i></span></div>
            <div class="cari-opt" data-v="4"><span class="cari-opt-ic"><i class="fas fa-lightbulb"></i></span><span class="cari-opt-lb">Belajar tentang ekonomi &amp; keuangan</span><span class="cari-check"><i class="fas fa-check"></i></span></div>
          </div>
        </div>
        <div class="cari-step" data-q="2">
          <h3 class="cari-ask">Mata pelajaran mana yang paling menarik?</h3>
          <div class="cari-options">
            <div class="cari-opt" data-v="2"><span class="cari-opt-ic"><i class="fas fa-magnifying-glass"></i></span><span class="cari-opt-lb">Matematika &amp; Ekonomi</span><span class="cari-check"><i class="fas fa-check"></i></span></div>
            <div class="cari-opt" data-v="1"><span class="cari-opt-ic"><i class="fas fa-flask"></i></span><span class="cari-opt-lb">IPA</span><span class="cari-check"><i class="fas fa-check"></i></span></div>
            <div class="cari-opt" data-v="0"><span class="cari-opt-ic"><i class="fas fa-headset"></i></span><span class="cari-opt-lb">Bahasa &amp; Komunikasi</span><span class="cari-check"><i class="fas fa-check"></i></span></div>
            <div class="cari-opt" data-v="3"><span class="cari-opt-ic"><i class="fas fa-lightbulb"></i></span><span class="cari-opt-lb">PPKn &amp; Sejarah</span><span class="cari-check"><i class="fas fa-check"></i></span></div>
            <div class="cari-opt" data-v="4"><span class="cari-opt-ic"><i class="fas fa-piggy-bank"></i></span><span class="cari-opt-lb">Ekonomi Syariah &amp; Akuntansi</span><span class="cari-check"><i class="fas fa-check"></i></span></div>
          </div>
        </div>
        <div class="cari-step" data-q="3">
          <h3 class="cari-ask">Kalau praktik kerja, kamu paling suka peran apa?</h3>
          <div class="cari-options">
            <div class="cari-opt" data-v="0"><span class="cari-opt-ic"><i class="fas fa-headset"></i></span><span class="cari-opt-lb">Melayani nasabah di depan (teller/CS)</span><span class="cari-check"><i class="fas fa-check"></i></span></div>
            <div class="cari-opt" data-v="1"><span class="cari-opt-ic"><i class="fas fa-calculator"></i></span><span class="cari-opt-lb">Menghitung dan mencatat transaksi</span><span class="cari-check"><i class="fas fa-check"></i></span></div>
            <div class="cari-opt" data-v="3"><span class="cari-opt-ic"><i class="fas fa-file-invoice-dollar"></i></span><span class="cari-opt-lb">Memeriksa &amp; merapikan dokumen</span><span class="cari-check"><i class="fas fa-check"></i></span></div>
            <div class="cari-opt" data-v="4"><span class="cari-opt-ic"><i class="fas fa-user-tie"></i></span><span class="cari-opt-lb">Memasarkan produk &amp; mencari nasabah</span><span class="cari-check"><i class="fas fa-check"></i></span></div>
            <div class="cari-opt" data-v="2"><span class="cari-opt-ic"><i class="fas fa-scale-balanced"></i></span><span class="cari-opt-lb">Mengecek kepatuhan &amp; keakuratan data</span><span class="cari-check"><i class="fas fa-check"></i></span></div>
          </div>
        </div>
        <div class="cari-step" data-q="4">
          <h3 class="cari-ask">Apa tujuanmu setelah lulus SMK?</h3>
          <div class="cari-options">
            <div class="cari-opt" data-v="2"><span class="cari-opt-ic"><i class="fas fa-building-columns"></i></span><span class="cari-opt-lb">Bekerja di bank atau lembaga keuangan</span><span class="cari-check"><i class="fas fa-check"></i></span></div>
            <div class="cari-opt" data-v="4"><span class="cari-opt-ic"><i class="fas fa-user-tie"></i></span><span class="cari-opt-lb">Membangun usaha keuangan mikro sendiri</span><span class="cari-check"><i class="fas fa-check"></i></span></div>
            <div class="cari-opt" data-v="0"><span class="cari-opt-ic"><i class="fas fa-graduation-cap"></i></span><span class="cari-opt-lb">Kuliah di bidang ekonomi/perbankan syariah</span><span class="cari-check"><i class="fas fa-check"></i></span></div>
            <div class="cari-opt" data-v="1"><span class="cari-opt-ic"><i class="fas fa-magnifying-glass"></i></span><span class="cari-opt-lb">Menjadi ahli keuangan profesional</span><span class="cari-check"><i class="fas fa-check"></i></span></div>
            <div class="cari-opt" data-v="3"><span class="cari-opt-ic"><i class="fas fa-lightbulb"></i></span><span class="cari-opt-lb">Menjadi wirausahawan syariah</span><span class="cari-check"><i class="fas fa-check"></i></span></div>
          </div>
        </div>
        <div class="cari-step" data-q="5">
          <h3 class="cari-ask">Saat bekerja dalam tim, kamu biasanya?</h3>
          <div class="cari-options">
            <div class="cari-opt" data-v="2"><span class="cari-opt-ic"><i class="fas fa-users"></i></span><span class="cari-opt-lb">Melayani langsung dengan komunikasi</span><span class="cari-check"><i class="fas fa-check"></i></span></div>
            <div class="cari-opt" data-v="3"><span class="cari-opt-ic"><i class="fas fa-calendar-days"></i></span><span class="cari-opt-lb">Mengatur alur &amp; jadwal transaksi</span><span class="cari-check"><i class="fas fa-check"></i></span></div>
            <div class="cari-opt" data-v="1"><span class="cari-opt-ic"><i class="fas fa-list-check"></i></span><span class="cari-opt-lb">Memeriksa &amp; memastikan keakuratan data</span><span class="cari-check"><i class="fas fa-check"></i></span></div>
            <div class="cari-opt" data-v="0"><span class="cari-opt-ic"><i class="fas fa-magnifying-glass"></i></span><span class="cari-opt-lb">Mencari peluang &amp; ide baru</span><span class="cari-check"><i class="fas fa-check"></i></span></div>
            <div class="cari-opt" data-v="4"><span class="cari-opt-ic"><i class="fas fa-lightbulb"></i></span><span class="cari-opt-lb">Memberi solusi &amp; pendekatan baru</span><span class="cari-check"><i class="fas fa-check"></i></span></div>
          </div>
        </div>
        <div class="cari-nav">
          <button type="button" class="cari-back" id="cariBack"><i class="fas fa-arrow-left"></i> Kembali</button>
          <button type="button" class="cari-next" id="cariNext">Lanjut <i class="fas fa-arrow-right"></i></button>
        </div>
      </div>
      <div class="cari-result" id="cariResult">
        <div class="cari-score-ring-wrap">
          <svg class="cari-score-ring" viewBox="0 0 160 160" aria-hidden="true">
            <defs><linearGradient id="cariGrad" x1="0" y1="0" x2="1" y2="1"><stop offset="0%" stop-color="#FFD54A"/><stop offset="100%" stop-color="#FF8A00"/></linearGradient></defs>
            <circle class="ring-bg" cx="80" cy="80" r="66"></circle>
            <circle class="ring-fg" id="cariRing" cx="80" cy="80" r="66"></circle>
          </svg>
          <div class="cari-score-num"><b id="cariScoreNum">0%</b><span>Kecocokan</span></div>
        </div>
        <h3 class="cari-score-label">TINGKAT KECOCOKANMU <em id="cariScoreLabel">—</em></h3>
        <p class="cari-score-desc" id="cariScoreDesc">Kamu punya minat yang kuat pada pelayanan, ketelitian, dan pengelolaan keuangan — semua itu ada di LPS.</p>
        <div class="cari-score-reasons" id="cariReasons"></div>
        <div class="cari-score-actions">
          <a href="#tentang-aphp" class="cari-cta-primary">Kenali LPS Lebih Dalam <i class="fas fa-arrow-right"></i></a>
          <button type="button" class="cari-cta-ghost" id="cariRestart"><i class="fas fa-redo"></i> Ulangi Tes</button>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== LAB TOUR — VISUAL IDENTIK DENGAN VIRTUAL TOUR SEJARAH ===== -->
  <section class="vt-section" id="lab-tour" aria-label="LPS Tour LPS SMK Negeri 2 Mojokerto">
    <span class="vt-watermark" aria-hidden="true">LPS</span>
    <div class="vt-decor-ring" aria-hidden="true"></div>
    <div class="vt-decor-dots" aria-hidden="true"></div>
    <div class="vt-inner">
      <div class="vt-media" data-reveal="left">
        <div class="vt-frame">
          <img src="{{ asset('images/lps-bank-mini.jpg') }}" alt="Ruang Praktik Bank Mini Syariah SMK Negeri 2 Mojokerto — LPS Tour" loading="lazy">
          <span class="vt-badge"><i class="fa-solid fa-handshake"></i> LPS Tour</span>
          <button class="vt-play" type="button" aria-label="Mulai LPS Tour LPS" onclick="document.getElementById('labTourLink')?.click()"><i class="fa-solid fa-play"></i></button>
          <div class="vt-caption">
            <div><strong>Jelajahi Ruang Praktik Bank Mini Syariah</strong><span>Fasilitas praktik Layanan Perbankan Syariah</span></div>
            <span class="vt-cam"><i class="fa-solid fa-camera"></i> LAB</span>
          </div>
        </div>
        <div class="vt-chip"><i class="fa-solid fa-compass"></i><div><strong>LPS Tour LPS</strong><span>Explore Bank Mini Syariah</span></div></div>
      </div>
      <div class="vt-copy">
        <div class="vt-kicker" data-reveal>Sharia Banking Practice Experience</div>
        <h2 class="vt-title" data-reveal>Jelajahi <span class="vt-gold">Ruang Praktik Bank Mini Syariah</span><span class="vt-sub">Lihat LPS Tour LPS</span></h2>
        <p class="vt-desc" data-reveal>Kenali lebih dekat bank mini syariah sebagai ruang belajar dan praktik untuk melayani nasabah, mengelola transaksi, serta memahami operasional perbankan berbasis prinsip syariah.</p>
        <div class="vt-feats" data-reveal><span class="vt-feat"><i class="fa-solid fa-check"></i> Fasilitas Bank Mini</span><span class="vt-feat"><i class="fa-solid fa-check"></i> Simulasi Teller &amp; CS</span><span class="vt-feat"><i class="fa-solid fa-check"></i> Praktik Administrasi</span></div>
        <a href="#" id="labTourLink" class="vt-btn" data-reveal>Mulai LPS Tour <i class="fa-solid fa-arrow-right"></i></a>
      </div>
    </div>
  </section>

  <!-- ===== SECTION 11 — FINAL CTA ===== -->
  <section class="aphp-cta">
    <div class="cta-bg" aria-hidden="true"><img src="{{ asset('images/aphp-upacara.jpg') }}" alt="" loading="lazy"></div>
    <div class="orn" aria-hidden="true">
      <span class="o-chevron"></span><span class="o-dots"></span>
      <span class="o-ring"></span><span class="o-gold"></span>
      <i class="fas fa-coins o-wheat"></i>
    </div>
    <div class="aphp-cta-inner" data-reveal>
      <h2>Siap Menjadi Bagian dari <span>LPS?</span></h2>
      <p>Kenali potensimu, temukan pengalaman belajar yang sesuai, dan mulai perjalananmu bersama LPS — dari teori menuju praktik dan karier di dunia perbankan syariah.</p>
      <div class="aphp-cta-actions">
        <a href="#cari-jurusan" class="aphp-cta-btn"><i class="fas fa-star"></i> Cari Jurusanmu</a>
        <a href="{{ route('home') }}#ppdb" class="aphp-cta-ghost"><i class="fas fa-pen"></i> Daftar PPDB</a>
      </div>
    </div>
  </section>
</div>
@endsection

@push('scripts')
<script>
/* ---- Scroll Reveal ---- */
(function(){
  var els=document.querySelectorAll('[data-reveal]');
  if(!('IntersectionObserver' in window)){els.forEach(function(e){e.classList.add('revealed')});return}
  var obs=new IntersectionObserver(function(entries){
    entries.forEach(function(e){if(e.isIntersecting){e.target.classList.add('revealed');obs.unobserve(e.target)}})
  },{threshold:0.1,rootMargin:'0px 0px -50px 0px'});
  els.forEach(function(e){obs.observe(e)});
  var pending=Array.prototype.slice.call(els),checks=0;
  var iv=setInterval(function(){
    checks++;var vh=window.innerHeight;
    pending=pending.filter(function(el){
      if(el.classList.contains('revealed'))return false;
      var r=el.getBoundingClientRect();
      if(r.top<vh+200&&r.bottom>-30){el.classList.add('revealed');return false}
      return true
    });
    if(checks>=8){pending.forEach(function(el){el.classList.add('revealed')});clearInterval(iv)}
    else if(pending.length===0)clearInterval(iv)
  },400)
})();
</script>

<script>
/* ---- CARI JURUSANMU (Quiz) ---- */
(function(){
  var quiz=document.getElementById('cariQuiz'),result=document.getElementById('cariResult');
  var steps=Array.prototype.slice.call(quiz.querySelectorAll('.cari-step'));
  var countEl=document.getElementById('cariCount'),barEl=document.getElementById('cariBar');
  var backBtn=document.getElementById('cariBack'),nextBtn=document.getElementById('cariNext');
  var current=0,answers=[];
  function selectOpt(opt){Array.prototype.forEach.call(opt.parentNode.children,function(c){c.classList.remove('selected')});opt.classList.add('selected')}
  quiz.querySelectorAll('.cari-opt').forEach(function(opt){opt.addEventListener('click',function(){selectOpt(opt)})});
  function goTo(i){
    current=Math.max(0,Math.min(i,steps.length-1));
    steps.forEach(function(s,idx){s.classList.toggle('active',idx===current)});
    countEl.textContent='0'+(current+1)+' / 05';
    barEl.style.width=((current+1)/steps.length*100)+'%';
    backBtn.style.visibility=current===0?'hidden':'visible';
    nextBtn.innerHTML=current===steps.length-1?'Lihat Hasil <i class="fas fa-star"></i>':'Lanjut <i class="fas fa-arrow-right"></i>'
  }
  backBtn.addEventListener('click',function(){if(current>0)goTo(current-1)});
  nextBtn.addEventListener('click',function(){
    var sel=steps[current].querySelector('.cari-opt.selected');
    if(!sel)return;
    answers[current]=parseInt(sel.getAttribute('data-v'),10);
    if(current<steps.length-1){goTo(current+1)}else{showResult()}
  });
  function showResult(){
    var sum=answers.reduce(function(a,b){return a+b},0);
    var score=62+Math.round(sum/4);score=Math.max(62,Math.min(92,score));
    quiz.style.display='none';result.classList.add('show');
    document.getElementById('cariScoreNum').textContent=score+'%';
    var label=document.getElementById('cariScoreLabel'),desc=document.getElementById('cariScoreDesc');
    if(score>=85){label.textContent='Sangat Cocok';desc.textContent='Minatmu sangat selaras dengan dunia LPS — pelayanan, ketelitian, dan pengelolaan keuangan adalah duniamu. Kamu akan berkembang pesat di sini!'}
    else if(score>=75){label.textContent='Cocok';desc.textContent='Kamu punya ketertarikan kuat pada pelayanan nasabah dan pengelolaan keuangan. Dengan semangat berlatih di LPS, potensimu akan terus terasah.'}
    else{label.textContent='Cukup Cocok';desc.textContent='Ada banyak sisi LPS yang bisa kamu eksplorasi — dari pelayanan nasabah hingga administrasi perbankan. Coba kenali lebih dalam lewat tur di bawah!'}
    document.getElementById('cariReasons').innerHTML=[
      {t:'Praktik bank mini setiap minggu',i:'fa-building-columns'},{t:'Belajar melayani nasabah langsung',i:'fa-headset'},{t:'Bekal wirausaha & industri keuangan',i:'fa-user-tie'}
    ].map(function(r){return '<span class="cari-reason"><i class="fas '+r.i+'"></i> '+r.t+'</span>'}).join('');
    requestAnimationFrame(function(){setTimeout(function(){document.getElementById('cariRing').style.strokeDashoffset=414-(414*score/100)},120)})
  }
  document.getElementById('cariRestart').addEventListener('click',restart);
  function restart(){
    answers=[];result.classList.remove('show');result.style.display='none';
    quiz.style.display='block';
    steps.forEach(function(s){s.classList.remove('active');Array.prototype.forEach.call(s.querySelectorAll('.cari-opt'),function(o){o.classList.remove('selected')})});
    goTo(0);document.getElementById('cariRing').style.strokeDashoffset=414
  }
  goTo(0)
})();
</script>

<script>
/* ---- Produk Slider + Filter ---- */
(function(){
  var track=document.getElementById('produkTrack'),prevBtn=document.getElementById('produkPrev'),nextBtn=document.getElementById('produkNext'),dotsWrap=document.getElementById('produkDots');
  var filterBtns=Array.prototype.slice.call(document.querySelectorAll('.pf-btn'));
  if(!track)return;
  var index=0;
  function cards(){return Array.prototype.slice.call(track.children)}
  function visible(){return cards().filter(function(c){return c.style.display!=='none'})}
  function pageSize(){if(window.innerWidth<=760)return 1;if(window.innerWidth<=1050)return 2;return 3}
  function buildDots(){
    dotsWrap.innerHTML='';var total=visible().length,pages=Math.max(1,Math.ceil(total/pageSize()));
    if(total<=pageSize()){dotsWrap.classList.add('hidden');return}
    dotsWrap.classList.remove('hidden');
    for(var i=0;i<pages;i++){var b=document.createElement('button');if(i===index)b.classList.add('active');b.setAttribute('aria-label','Slide '+(i+1));(function(idx){b.addEventListener('click',function(){goTo(idx)})})(i);dotsWrap.appendChild(b)}
  }
  function update(){
    var vis=visible(),per=pageSize(),maxIndex=Math.max(0,Math.ceil(vis.length/per)-1);
    if(index>maxIndex)index=maxIndex;
    var offset=0,i=0;
    for(;i<cards().length;i++){if(cards()[i].style.display==='none')continue;if(i===index*per)break;offset+=cards()[i].offsetWidth+19}
    track.style.transform='translateX(-'+offset+'px)';
    prevBtn.disabled=index<=0;nextBtn.disabled=index>=maxIndex;
    Array.prototype.forEach.call(dotsWrap.children,function(d,di){d.classList.toggle('active',di===index)})
  }
  function goTo(i){var maxIndex=Math.max(0,Math.ceil(visible().length/pageSize())-1);index=Math.min(Math.max(i,0),maxIndex);update()}
  prevBtn.addEventListener('click',function(){goTo(index-1)});
  nextBtn.addEventListener('click',function(){goTo(index+1)});
  filterBtns.forEach(function(btn){
    btn.addEventListener('click',function(){
      filterBtns.forEach(function(b){b.classList.remove('active')});btn.classList.add('active');
      var f=btn.getAttribute('data-f');
      cards().forEach(function(c){c.style.display=(f==='all'||c.getAttribute('data-cat')===f)?'':'none'});
      index=0;buildDots();update()
    })
  });
  window.addEventListener('resize',function(){buildDots();update()});
  buildDots();update()
})();
</script>
@endpush