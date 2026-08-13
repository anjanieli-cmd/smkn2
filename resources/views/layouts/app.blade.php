{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/png" href="{{ asset('images/logo_smkn2.png') }}">
    <title>@yield('title', 'SMK Negeri 2 Mojokerto — Beranda')</title>
    <meta name="description" content="@yield('description', 'Website resmi SMK Negeri 2 Mojokerto — Sekolah Menengah Kejuruan unggulan di Kota Mojokerto, Jawa Timur.')">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root{
            --teal:#1d6fb8;
            --teal-dark:#13518c;
            --teal-deep:#0d3a66;
            --teal-light:#28a9e1;
            --teal-glow:rgba(29,111,184,.35);
            --mint:#28a9e1;
            --mint-soft:#9bd3f5;
            --gold:#f9a825;
            --gold-dark:#c67d00;
            --orange:#ff6d00;
            --ink:#17324d;
            --text:#33475c;
            --text-muted:#5d7288;
            --bg:#f5f9fd;
            --card:#ffffff;
            --border:#dce8f2;
            --font-display:'Poppins',sans-serif;
            --font-body:'Plus Jakarta Sans',sans-serif;
            --radius:20px;
            --ease:cubic-bezier(.22,.61,.36,1);
        }

        *{margin:0;padding:0;box-sizing:border-box}
        html{scroll-behavior:smooth}
        body{
            font-family:var(--font-body);
            color:var(--text);
            background:var(--bg);
            line-height:1.7;
            overflow-x:hidden;
            -webkit-font-smoothing:antialiased;
            position:relative;
            isolation:isolate;
            transition:background .35s ease,color .35s ease;
        }

        body.a11y-text-lg{font-size:1.1rem}
        body.a11y-text-xl{font-size:1.22rem}
        body.a11y-line-wide p,
        body.a11y-line-wide .section-desc,
        body.a11y-line-wide .vm-text{line-height:2}
        body.a11y-line-xwide p,
        body.a11y-line-xwide .section-desc,
        body.a11y-line-xwide .vm-text{line-height:2.3}

        img{max-width:100%;display:block}
        a{text-decoration:none;color:inherit}
        button,input{font-family:inherit}
        button{cursor:pointer}
        .container{width:min(1180px,92%);margin:0 auto}
        .section-py{padding:96px 0}

        /* ================= PRELOADER ================= */
        #preloader{
            position:fixed;
            inset:0;
            z-index:9999;
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
            gap:22px;
            background:radial-gradient(1200px 600px at 50% 40%,#1d6fb8,#13518c 60%,#0d3a66);
            transition:opacity .7s ease,visibility .7s ease;
        }
        #preloader.done{opacity:0;visibility:hidden;pointer-events:none}
        .preloader-logo{
            width:92px;height:92px;border-radius:24px;
            display:flex;align-items:center;justify-content:center;
            background:transparent;
            animation:pulse-ring 1.6s infinite;
        }
        .preloader-logo img{width:100%;height:100%;object-fit:contain}
        @keyframes pulse-ring{
            0%{box-shadow:0 0 0 0 rgba(40,169,225,.55)}
            70%{box-shadow:0 0 0 26px rgba(40,169,225,0)}
            100%{box-shadow:0 0 0 0 rgba(40,169,225,0)}
        }
        .preloader-text{
            color:#d7efff;
            font-weight:600;
            letter-spacing:.12em;
            text-transform:uppercase;
            font-size:.75rem;
        }

        /* ================= BACKGROUND ================= */
        .bg-fx{
            position:fixed;inset:0;z-index:-2;
            overflow:hidden;pointer-events:none;
        }
        .bg-blob{
            position:absolute;border-radius:50%;
            filter:blur(90px);opacity:.35;
            animation:blobFloat 22s ease-in-out infinite;
        }
        .bg-blob-1{width:520px;height:520px;background:var(--teal-glow);top:-140px;left:-120px}
        .bg-blob-2{width:460px;height:460px;background:rgba(40,169,225,.22);top:32%;right:-160px;animation-delay:-7s}
        .bg-blob-3{width:420px;height:420px;background:rgba(29,111,184,.25);bottom:-140px;left:30%;animation-delay:-14s}
        @keyframes blobFloat{
            0%,100%{transform:translate(0,0) scale(1)}
            33%{transform:translate(60px,-40px) scale(1.12)}
            66%{transform:translate(-40px,50px) scale(.94)}
        }

        /* ================= ANNOUNCEMENT BAR ================= */
        .announce-bar{
            background:linear-gradient(90deg,#0d3a66,#1d6fb8,#0d3a66);
            color:#fff;
            font-size:.82rem;
            position:relative;
            z-index:120;
            overflow:hidden;
            border-bottom:1px solid rgba(255,255,255,.14);
            text-shadow:0 1px 3px rgba(0,0,0,.35);
            width:100%;
        }
        .announce-bar .container{
            width:100%;
            max-width:100%;
            padding:0 2rem;
            margin:0;
        }
        .announce-ticker{
            display:flex;
            gap:3rem;
            white-space:nowrap;
            padding:.52rem 0;
            animation:ticker 28s linear infinite;
            width:max-content;
        }
        .announce-ticker:hover{animation-play-state:paused}
        @keyframes ticker{
            0%{transform:translateX(0)}
            100%{transform:translateX(-50%)}
        }
        .announce-item{
            display:flex;
            align-items:center;
            gap:.55rem;
            font-weight:500;
        }
        .announce-item i{color:#ffb300}

        /* ================= NAVBAR ================= */
        #navbar{
            position:sticky;
            top:0;
            left:0;
            z-index:110;
            width:100%;
            margin:0;
            padding:0;
            background:transparent;
            transition:all .35s ease;
        }

        .nav-inner{
            width:100%;
            max-width:100%;
            margin:0;
            min-height:92px;
            padding:.85rem 2.25rem;
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:1.25rem;
            background:linear-gradient(135deg,#0d3a66,#1d6fb8);
            border:0;
            border-bottom:1px solid rgba(255,255,255,.18);
            box-shadow:0 10px 34px rgba(13,58,102,.32);
            transition:all .35s ease;
        }

        #navbar.scrolled .nav-inner{
            min-height:82px;
            padding:.65rem 2.25rem;
            background:linear-gradient(135deg,#0a2f57,#13518c);
            box-shadow:0 14px 44px rgba(13,58,102,.45);
        }

        .nav-brand{
            display:flex;
            align-items:center;
            gap:.85rem;
            flex-shrink:0;
        }
        .nav-logo{
            display:flex;
            align-items:center;
            justify-content:center;
            background:transparent;
            border:0;
            padding:0;
        }
        .nav-logo img{
            width:58px;
            height:58px;
            object-fit:contain;
        }

        .nav-brand-text strong{
            display:block;
            font-family:'Poppins',sans-serif;
            font-size:1.62rem;
            line-height:1.1;
            color:#fff;
            font-weight:800;
            letter-spacing:-.025em;
            white-space:nowrap;
            text-shadow:0 1px 2px rgba(0,0,0,.25);
        }
        .nav-brand-text strong .num-2{
            color:#ffd54f;
            font-style:normal;
        }
        .nav-brand-text span{display:none}

        .nav-menu{
            display:flex;
            align-items:center;
            justify-content:flex-end;
            gap:.18rem;
            list-style:none;
            margin:0;
            padding:0;
        }

        .nav-item{position:relative}

        .nav-link{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:.42rem;
            min-height:50px;
            padding:.62rem .78rem;
            border-radius:11px;
            font-size:.94rem;
            font-weight:600;
            color:rgba(255,255,255,.96);
            transition:all .25s var(--ease);
            position:relative;
            white-space:nowrap;
        }
        .nav-link i{
            font-size:.66rem;
            transition:transform .25s ease;
        }
        .nav-item.dropdown-open > .nav-link i{transform:rotate(180deg)}
        .nav-link:hover,
        .nav-link.active{
            color:#fff;
            background:rgba(255,255,255,.13);
        }
        .nav-link.active::after{
            content:"";
            position:absolute;
            bottom:4px;
            left:50%;
            transform:translateX(-50%);
            width:28px;
            height:3px;
            border-radius:99px;
            background:#fff;
        }

        /* ================= DROPDOWN ================= */
        .dropdown-menu{
            position:absolute;
            top:calc(100% + 7px);
            left:0;
            min-width:260px;
            max-width:340px;
            padding:.55rem;
            border-radius:14px;
            background:rgba(255,255,255,.98);
            backdrop-filter:blur(16px);
            -webkit-backdrop-filter:blur(16px);
            border:1px solid rgba(29,111,184,.22);
            box-shadow:0 20px 50px rgba(13,58,102,.2);
            opacity:0;
            visibility:hidden;
            pointer-events:none;
            transform:translateY(8px);
            transition:opacity .2s ease,transform .2s ease,visibility .2s ease;
            z-index:300;
        }

        /* Hover = muncul sementara */
        @media (min-width:901px){
            .nav-item.has-dropdown:hover > .dropdown-menu{
                opacity:1;
                visibility:visible;
                pointer-events:auto;
                transform:translateY(0);
            }
        }

        /* Klik = tetap terbuka */
        .nav-item.dropdown-open > .dropdown-menu{
            opacity:1;
            visibility:visible;
            pointer-events:auto;
            transform:translateY(0);
        }

        .dropdown-menu a{
            display:flex;
            align-items:center;
            gap:.65rem;
            padding:.68rem .75rem;
            border-radius:9px;
            font-size:.83rem;
            font-weight:500;
            color:var(--ink);
            transition:all .2s ease;
        }
        .dropdown-menu a i{
            width:19px;
            color:#1d6fb8;
            flex-shrink:0;
        }
        .dropdown-menu a:hover{
            background:rgba(29,111,184,.1);
            color:#0d3a66;
            transform:translateX(4px);
        }

        /* ================= PPDB BUTTON ================= */
        .nav-cta{
            background:linear-gradient(135deg,#ff6d00,#f4511e);
            color:#fff!important;
            padding-left:1.15rem!important;
            padding-right:1.15rem!important;
            min-height:50px;
            border-radius:12px!important;
            box-shadow:0 5px 18px rgba(244,81,30,.32),inset 0 0 0 1.5px rgba(255,255,255,.4);
        }
        .nav-cta:hover{
            background:linear-gradient(135deg,#ff8f00,#ff5722);
            transform:translateY(-2px);
            box-shadow:0 9px 26px rgba(244,81,30,.45),inset 0 0 0 1.5px rgba(255,255,255,.6);
        }

        /* ================= MOBILE MENU ================= */
        .nav-toggle{
            display:none;
            flex-direction:column;
            gap:5px;
            background:none;
            border:0;
            padding:.5rem;
        }
        .nav-toggle span{
            width:25px;
            height:2.7px;
            border-radius:99px;
            background:#fff;
            transition:all .3s;
        }

        /* ================= THEME CONTROL ================= */
        .theme-control{
            position:fixed;
            right:0;
            top:29vh;
            z-index:9990;
            display:flex;
            align-items:stretch;
            filter:drop-shadow(0 8px 18px rgba(0,0,0,.24));
        }

        .theme-trigger{
            width:76px;
            height:70px;
            border:1px solid rgba(255,255,255,.18);
            border-right:0;
            border-radius:17px 0 0 17px;
            background:#5b6570;
            color:#fff;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:25px;
            transition:all .25s ease;
            position:relative;
            box-shadow:inset 0 1px 0 rgba(255,255,255,.12);
        }

        .theme-trigger::before{
            content:"";
            position:absolute;
            left:-12px;
            top:50%;
            transform:translateY(-50%);
            border-top:12px solid transparent;
            border-bottom:12px solid transparent;
            border-right:12px solid #5b6570;
            transition:border-right-color .25s ease;
        }

        .theme-trigger:hover,
        .theme-control.open .theme-trigger{
            background:#1976d2;
            color:#fff;
            box-shadow:0 8px 22px rgba(25,118,210,.4),inset 0 1px 0 rgba(255,255,255,.2);
        }
        .theme-trigger:hover::before,
        .theme-control.open .theme-trigger::before{
            border-right-color:#1976d2;
        }

        .theme-panel{
            position:absolute;
            right:76px;
            top:78px;
            width:244px;
            padding:.6rem;
            border-radius:16px;
            background:rgba(35,35,35,.96);
            border:1px solid rgba(255,255,255,.28);
            box-shadow:0 18px 50px rgba(0,0,0,.35);
            backdrop-filter:blur(16px);
            -webkit-backdrop-filter:blur(16px);
            opacity:0;
            visibility:hidden;
            pointer-events:none;
            transform:translateY(-8px);
            transition:all .22s ease;
        }

        .theme-control.open .theme-panel{
            opacity:1;
            visibility:visible;
            pointer-events:auto;
            transform:translateY(0);
        }

        .theme-title{
            color:#fff;
            font-size:.86rem;
            font-weight:700;
            padding:.4rem .65rem .55rem;
        }

        .theme-section{
            border-top:1px solid rgba(255,255,255,.16);
            padding:.45rem 0;
        }

        .theme-option{
            width:100%;
            border:0;
            background:transparent;
            color:#f3f3f3;
            display:flex;
            align-items:center;
            gap:.7rem;
            padding:.68rem .7rem;
            border-radius:9px;
            font-size:.86rem;
            text-align:left;
            transition:all .2s ease;
        }
        .theme-option:hover{
            background:rgba(255,255,255,.09);
        }
        .theme-option.active{
            background:#286fd1;
            color:#fff;
        }
        .theme-option .theme-icon{
            width:21px;
            text-align:center;
        }
        .theme-option .check{
            margin-left:auto;
            opacity:0;
        }
        .theme-option.active .check{opacity:1}

        .theme-label{
            color:#fff;
            font-size:.78rem;
            font-weight:700;
            padding:.35rem .7rem .55rem;
        }

        .theme-colors{
            display:flex;
            gap:.62rem;
            padding:.25rem .7rem .55rem;
        }
        .theme-color{
            width:29px;
            height:29px;
            border-radius:50%;
            border:2px solid rgba(255,255,255,.35);
            box-shadow:0 2px 7px rgba(0,0,0,.25);
            transition:transform .2s ease,border-color .2s ease;
        }
        .theme-color:hover{
            transform:scale(1.12);
            border-color:#fff;
        }
        .theme-color.active{
            outline:3px solid rgba(255,255,255,.3);
            outline-offset:2px;
        }
        .theme-blue{background:#2878dc}
        .theme-purple{background:#9650df}
        .theme-green{background:#51b982}
        .theme-red{background:#f15b66}
        .theme-orange{background:#f7a52c}

        /* ================= CHATBOT ================= */
        .sibot-fab{
            position:fixed;
            right:42px;
            bottom:145px;
            z-index:9985;
            width:76px;
            height:76px;
            border:0;
            padding:0;
            background:transparent;
            filter:drop-shadow(0 8px 16px rgba(0,0,0,.24));
            transition:transform .25s ease,filter .25s ease;
        }
        .sibot-fab:hover{
            transform:translateY(-4px) scale(1.04);
            filter:drop-shadow(0 12px 22px rgba(29,111,184,.38));
        }
        .sibot-bubble{
            width:76px;
            height:76px;
            border-radius:50% 50% 50% 12px;
            background:#1976d2;
            border:2px solid rgba(255,255,255,.8);
            display:flex;
            align-items:center;
            justify-content:center;
            color:#fff;
            font-size:30px;
            position:relative;
            box-shadow:0 8px 20px rgba(25,118,210,.35);
            transform:rotate(-2deg);
        }
        .sibot-bubble::after{
            content:"";
            position:absolute;
            bottom:-2px;
            left:8px;
            width:20px;
            height:20px;
            background:#1976d2;
            border-left:2px solid rgba(255,255,255,.8);
            border-bottom:2px solid rgba(255,255,255,.8);
            clip-path:polygon(0 0,100% 0,0 100%);
        }
        .sibot-badge{
            position:absolute;
            top:-4px;
            right:-3px;
            min-width:20px;
            height:20px;
            padding:0 5px;
            border-radius:99px;
            display:flex;
            align-items:center;
            justify-content:center;
            background:#ffad1f;
            color:#fff;
            border:2px solid #fff;
            font-size:.62rem;
            font-weight:800;
            z-index:2;
        }

        .sibot-panel{
            position:fixed;
            right:34px;
            bottom:230px;
            z-index:9984;
            width:min(360px,calc(100vw - 30px));
            border-radius:18px;
            overflow:hidden;
            background:#fff;
            border:1px solid rgba(29,111,184,.18);
            box-shadow:0 20px 60px rgba(13,58,102,.28);
            opacity:0;
            visibility:hidden;
            pointer-events:none;
            transform:translateY(12px) scale(.98);
            transition:all .22s ease;
        }
        .sibot-panel.open{
            opacity:1;
            visibility:visible;
            pointer-events:auto;
            transform:translateY(0) scale(1);
        }
        .sibot-head{
            padding:.9rem 1rem;
            display:flex;
            align-items:center;
            justify-content:space-between;
            background:linear-gradient(135deg,#0d3a66,#1d6fb8);
            color:#fff;
        }
        .sibot-head strong{font-size:.9rem}
        .sibot-close{
            width:30px;height:30px;border:0;border-radius:8px;
            color:#fff;background:rgba(255,255,255,.12);
        }
        .sibot-body{
            padding:1rem;
            color:#33475c;
            background:#fff;
            font-size:.83rem;
        }
        .sibot-message{
            padding:.75rem .85rem;
            border-radius:12px 12px 12px 4px;
            background:#eef6ff;
            margin-bottom:.8rem;
        }
        .sibot-note{
            color:#6b7d8d;
            font-size:.74rem;
        }

        /* ================= BACK TO TOP ================= */
        #backToTop{
            position:fixed;
            right:22px;
            bottom:24px;
            width:44px;
            height:44px;
            border:0;
            border-radius:12px;
            background:#1d6fb8;
            color:#fff;
            z-index:9970;
            box-shadow:0 8px 20px rgba(13,58,102,.22);
            opacity:0;
            visibility:hidden;
            transform:translateY(10px);
            transition:all .25s ease;
        }
        #backToTop.show{
            opacity:1;
            visibility:visible;
            transform:translateY(0);
        }

        /* ================= DARK MODE ================= */
        body.theme-dark{
            --bg:#0b1624;
            --card:#142437;
            --border:#263c52;
            --ink:#eef7ff;
            --text:#d8e5f1;
            --text-muted:#a9bdcf;
            background:#0b1624;
            color:#d8e5f1;
        }
        body.theme-dark .dropdown-menu{
            background:rgba(20,36,55,.98);
            border-color:rgba(120,180,240,.18);
        }
        body.theme-dark .dropdown-menu a{color:#eaf5ff}
        body.theme-dark .dropdown-menu a:hover{
            background:rgba(65,140,220,.18);
            color:#fff;
        }
        body.theme-dark .sibot-panel{
            background:#142437;
            border-color:#29445e;
        }
        body.theme-dark .sibot-body{
            background:#142437;
            color:#d8e5f1;
        }
        body.theme-dark .sibot-message{background:#193a5b}
        body.theme-dark .sibot-note{color:#9fb5c9}

        /* ================= LIGHT MODE ================= */
        body.theme-light{
            --bg:#f8fbff;
            --card:#fff;
            --border:#d9e6f2;
            background:#f8fbff;
        }

        /* ================= SCROLL REVEAL ================= */
        [data-reveal]{
            opacity:0;
            transform:translateY(36px);
            transition:opacity .85s var(--ease),transform .85s var(--ease);
        }
        [data-reveal="left"]{transform:translateX(-46px)}
        [data-reveal="right"]{transform:translateX(46px)}
        [data-reveal].revealed{opacity:1;transform:none}

        /* ================= RESPONSIVE ================= */
        @media(max-width:1200px){
            .nav-inner{padding-left:1.5rem;padding-right:1.5rem}
            .nav-brand-text strong{font-size:1.45rem}
            .nav-logo img{width:54px;height:54px}
            .nav-link{font-size:.86rem;padding-left:.58rem;padding-right:.58rem}
            .nav-cta{padding-left:.85rem!important;padding-right:.85rem!important}
        }

        @media(max-width:900px){
            .nav-inner{min-height:78px;padding:.65rem 1rem}
            #navbar.scrolled .nav-inner{min-height:72px;padding:.55rem 1rem}

            .nav-menu{
                position:fixed;
                top:0;
                right:-330px;
                width:310px;
                height:100vh;
                flex-direction:column;
                align-items:flex-start;
                justify-content:flex-start;
                gap:.25rem;
                background:rgba(13,58,102,.98);
                padding:5.4rem 1rem 2rem;
                box-shadow:-20px 0 60px rgba(0,0,0,.45);
                transition:right .4s var(--ease);
                overflow-y:auto;
                z-index:400;
            }
            .nav-menu.open{right:0}
            .nav-toggle{display:flex}
            .nav-item{width:100%}
            .nav-link{
                width:100%;
                justify-content:flex-start;
                min-height:48px;
            }

            .dropdown-menu{
                position:static;
                display:none;
                width:100%;
                max-width:none;
                min-width:0;
                opacity:1;
                visibility:visible;
                pointer-events:auto;
                transform:none;
                box-shadow:none;
                border:0;
                border-radius:10px;
                background:rgba(255,255,255,.06);
                margin:.15rem 0 .3rem;
            }
            .nav-item.dropdown-open > .dropdown-menu{display:block}
            .dropdown-menu a{color:#fff}
            .dropdown-menu a:hover{
                color:#fff;
                background:rgba(255,255,255,.09);
            }

            .theme-control{top:26vh}
            .theme-trigger{width:64px;height:60px}
            .theme-panel{right:64px;top:68px}

            .sibot-fab{
                right:20px;
                bottom:135px;
                width:64px;
                height:64px;
            }
            .sibot-bubble{width:64px;height:64px;font-size:25px}
            .sibot-panel{right:15px;bottom:210px}
            #backToTop{right:15px;bottom:20px}
        }

        @media(max-width:600px){
            .announce-bar{font-size:.72rem}
            .announce-bar .container{padding:0 .8rem}
            .nav-brand{gap:.55rem}
            .nav-logo img{width:48px;height:48px}
            .nav-brand-text strong{font-size:1.18rem}
            .nav-inner{padding:.55rem .8rem}

            .theme-control{top:24vh}
            .theme-trigger{width:58px;height:54px;border-radius:14px 0 0 14px;font-size:21px}
            .theme-panel{
                right:58px;
                width:220px;
                top:62px;
            }

            .sibot-fab{
                right:15px;
                bottom:125px;
                width:58px;
                height:58px;
            }
            .sibot-bubble{width:58px;height:58px;font-size:23px}
            .sibot-panel{
                right:10px;
                bottom:195px;
                width:calc(100vw - 20px);
            }
        }

        @media(prefers-reduced-motion:reduce){
            *,*::before,*::after{
                animation-duration:.01ms!important;
                animation-iteration-count:1!important;
                transition-duration:.01ms!important;
            }
            [data-reveal]{opacity:1;transform:none}
            html{scroll-behavior:auto}
        }
    </style>

    @stack('styles')
</head>

<body>

    {{-- ================= PRELOADER ================= --}}
    <div id="preloader">
        <div class="preloader-logo">
            <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SMK Negeri 2">
        </div>
        <div class="preloader-text">
            SMK Negeri <em class="num-2">2</em> Mojokerto
        </div>
    </div>

    {{-- ================= BACKGROUND ================= --}}
    <div class="bg-fx" aria-hidden="true">
        <div class="bg-blob bg-blob-1"></div>
        <div class="bg-blob bg-blob-2"></div>
        <div class="bg-blob bg-blob-3"></div>
    </div>

    {{-- ================= ANNOUNCEMENT BAR ================= --}}
    <div class="announce-bar">
        <div class="container">
            <div class="announce-ticker" id="announceTicker">
                <div class="announce-item"><i class="fas fa-bullhorn"></i> PPDB 2025/2026 Dibuka — Daftar Sekarang!</div>
                <div class="announce-item"><i class="fas fa-trophy"></i> Juara 1 LKS Provinsi Jawa Timur 2024 — Selamat!</div>
                <div class="announce-item"><i class="fas fa-calendar"></i> Ujian Akhir Semester: 10–20 Juni 2025</div>
                <div class="announce-item"><i class="fas fa-star"></i> Akreditasi A — SMK Negeri 2 Mojokerto</div>
                <div class="announce-item"><i class="fas fa-bullhorn"></i> Informasi Resmi Hanya di Website SMK Negeri 2</div>

                {{-- duplikasi agar ticker terus berjalan --}}
                <div class="announce-item"><i class="fas fa-bullhorn"></i> PPDB 2025/2026 Dibuka — Daftar Sekarang!</div>
                <div class="announce-item"><i class="fas fa-trophy"></i> Juara 1 LKS Provinsi Jawa Timur 2024 — Selamat!</div>
                <div class="announce-item"><i class="fas fa-calendar"></i> Ujian Akhir Semester: 10–20 Juni 2025</div>
                <div class="announce-item"><i class="fas fa-star"></i> Akreditasi A — SMK Negeri 2 Mojokerto</div>
                <div class="announce-item"><i class="fas fa-bullhorn"></i> Informasi Resmi Hanya di Website SMK Negeri 2</div>
            </div>
        </div>
    </div>

    {{-- ================= NAVBAR ================= --}}
    <nav id="navbar">
        <div class="nav-inner">

            <a href="{{ route('home') }}" class="nav-brand">
                <div class="nav-logo">
                    <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SMK Negeri 2">
                </div>

                <div class="nav-brand-text">
                    {{-- HANYA SMK NEGERI 2, TANPA KOTA MOJOKERTO --}}
                    <strong>SMK Negeri <em class="num-2">2</em></strong>
                </div>
            </a>

            <ul class="nav-menu" id="navMenu">

                <li class="nav-item">
                    <a href="{{ route('home') }}"
                       class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        Beranda
                    </a>
                </li>

                <li class="nav-item has-dropdown">
                    <a href="#"
                       class="nav-link dropdown-trigger">
                        Profil <i class="fas fa-chevron-down"></i>
                    </a>

                    <div class="dropdown-menu">
                        <a href="#"><i class="fas fa-history"></i> Sejarah Sekolah</a>
                        <a href="#"><i class="fas fa-eye"></i> Visi &amp; Misi</a>
                        <a href="#"><i class="fas fa-sitemap"></i> Struktur Organisasi</a>
                        <a href="#"><i class="fas fa-chalkboard-user"></i> Guru &amp; Staf</a>
                        <a href="#"><i class="fas fa-road"></i> Roadmap Pengembangan</a>
                    </div>
                </li>

                <li class="nav-item has-dropdown">
                    <a href="#"
                       class="nav-link dropdown-trigger">
                        Program Keahlian <i class="fas fa-chevron-down"></i>
                    </a>

                    <div class="dropdown-menu">
                        <a href="#"><i class="fas fa-seedling"></i> Agribisnis Pengolahan Hasil Pertanian</a>
                        <a href="#"><i class="fas fa-palette"></i> Desain Komunikasi Visual</a>
                        <a href="#"><i class="fas fa-utensils"></i> Kuliner</a>
                        <a href="#"><i class="fas fa-calculator"></i> Lembaga Perbankan Syariah</a>
                        <a href="#"><i class="fas fa-code"></i> Rekayasa Perangkat Lunak</a>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="{{ route('ppdb') }}"
                       class="nav-link {{ request()->routeIs('ppdb') ? 'active' : '' }}">
                        PPDB
                    </a>
                </li>

                <li class="nav-item has-dropdown">
                    <a href="#"
                       class="nav-link dropdown-trigger">
                        Siswa <i class="fas fa-chevron-down"></i>
                    </a>

                    <div class="dropdown-menu">
                        <a href="{{ route('karya-siswa') }}"><i class="fas fa-lightbulb"></i> Karya Siswa</a>
                        <a href="#"><i class="fas fa-trophy"></i> Prestasi Siswa</a>
                        <a href="#"><i class="fas fa-people-group"></i> Ekstrakurikuler</a>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="#berita" class="nav-link">Berita</a>
                </li>

                <li class="nav-item has-dropdown">
                    <a href="#"
                       class="nav-link dropdown-trigger">
                        Galeri <i class="fas fa-chevron-down"></i>
                    </a>

                    <div class="dropdown-menu">
                        <a href="#galeri"><i class="fas fa-school"></i> Kegiatan Sekolah</a>
                        <a href="#galeri"><i class="fas fa-medal"></i> Prestasi Sekolah</a>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="{{ route('pkl-alumni') }}"
                       class="nav-link {{ request()->routeIs('pkl-alumni') ? 'active' : '' }}">
                        PKL &amp; Alumni
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('ppdb') }}" class="nav-link nav-cta">
                        Daftar PPDB
                    </a>
                </li>

            </ul>

            <button class="nav-toggle" id="navToggle" aria-label="Buka menu" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
        </div>
    </nav>

    {{-- ================= KONTEN ================= --}}
    @yield('content')

    {{-- ================= FOOTER ================= --}}
    @include('partials.footer')

    {{-- ================= THEME CONTROL ================= --}}
    <div class="theme-control" id="themeControl">

        <button class="theme-trigger"
                id="themeTrigger"
                type="button"
                aria-label="Pengaturan tema"
                aria-expanded="false"
                title="Pengaturan tema">
            <i class="fas fa-palette"></i>
        </button>

        <div class="theme-panel" id="themePanel">

            <div class="theme-title">Pilih Tema</div>

            <div class="theme-section">
                <button type="button" class="theme-option active" data-mode="default">
                    <span class="theme-icon"><i class="fas fa-sun"></i></span>
                    <span>Default</span>
                    <span class="check"><i class="fas fa-check"></i></span>
                </button>

                <button type="button" class="theme-option" data-mode="light">
                    <span class="theme-icon"><i class="fas fa-sun"></i></span>
                    <span>Light</span>
                    <span class="check"><i class="fas fa-check"></i></span>
                </button>

                <button type="button" class="theme-option" data-mode="dark">
                    <span class="theme-icon"><i class="fas fa-adjust"></i></span>
                    <span>Dark</span>
                    <span class="check"><i class="fas fa-check"></i></span>
                </button>
            </div>

            <div class="theme-section">
                <div class="theme-label">Warna Tema</div>

                <div class="theme-colors">
                    <button type="button" class="theme-color theme-blue active" data-color="blue" aria-label="Biru"></button>
                    <button type="button" class="theme-color theme-purple" data-color="purple" aria-label="Ungu"></button>
                    <button type="button" class="theme-color theme-green" data-color="green" aria-label="Hijau"></button>
                    <button type="button" class="theme-color theme-red" data-color="red" aria-label="Merah"></button>
                    <button type="button" class="theme-color theme-orange" data-color="orange" aria-label="Oranye"></button>
                </div>
            </div>

        </div>
    </div>

    {{-- ================= SIBOT ================= --}}
    <button type="button" class="sibot-fab" id="sibotFab" aria-label="Buka SIBOT" aria-expanded="false">
        <span class="sibot-bubble">
            <i class="fas fa-robot"></i>
        </span>
        <span class="sibot-badge">1</span>
    </button>

    <div class="sibot-panel" id="sibotPanel" aria-hidden="true">
        <div class="sibot-head">
            <strong>SIBOT — Asisten SMKN 2</strong>
            <button type="button" class="sibot-close" id="sibotClose" aria-label="Tutup SIBOT">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="sibot-body">
            <div class="sibot-message">
                Halo! 👋 Saya SIBOT. Ada yang ingin kamu cari di website SMK Negeri 2?
            </div>
            <div class="sibot-note">
                Panel ini sudah dibuat agar tombol bot benar-benar bisa dibuka dan ditutup.
                Jika kamu sudah memiliki sistem chatbot sendiri, bagian ini bisa disambungkan ke sistem tersebut.
            </div>
        </div>
    </div>

    {{-- ================= BACK TO TOP ================= --}}
    <button id="backToTop" aria-label="Kembali ke atas">
        <i class="fas fa-arrow-up"></i>
    </button>

    {{-- ================= SCRIPT GLOBAL ================= --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            /* ================= PRELOADER ================= */
            window.addEventListener('load', function () {
                document.getElementById('preloader')?.classList.add('done');
            });

            setTimeout(function () {
                document.getElementById('preloader')?.classList.add('done');
            }, 1800);

            /* ================= NAVBAR SCROLL ================= */
            const navbar = document.getElementById('navbar');

            window.addEventListener('scroll', function () {
                if (!navbar) return;

                if (window.pageYOffset > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });

            /* ================= MOBILE MENU ================= */
            const navToggle = document.getElementById('navToggle');
            const navMenu = document.getElementById('navMenu');

            if (navToggle && navMenu) {
                navToggle.addEventListener('click', function (e) {
                    e.stopPropagation();

                    const opened = navMenu.classList.toggle('open');
                    navToggle.setAttribute('aria-expanded', opened ? 'true' : 'false');
                });
            }

            /* ================= DROPDOWN ================= */
            const dropdownTriggers = document.querySelectorAll('.dropdown-trigger');

            dropdownTriggers.forEach(function (trigger) {
                trigger.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    const parent = trigger.closest('.nav-item');

                    document.querySelectorAll('.nav-item.dropdown-open').forEach(function (item) {
                        if (item !== parent) {
                            item.classList.remove('dropdown-open');
                        }
                    });

                    parent.classList.toggle('dropdown-open');
                });
            });

            document.addEventListener('click', function (e) {
                if (!e.target.closest('#navbar')) {
                    document.querySelectorAll('.nav-item.dropdown-open').forEach(function (item) {
                        item.classList.remove('dropdown-open');
                    });
                }

                if (!e.target.closest('#themeControl')) {
                    document.getElementById('themeControl')?.classList.remove('open');
                    document.getElementById('themeTrigger')?.setAttribute('aria-expanded', 'false');
                }
            });

            /* ================= THEME PANEL ================= */
            const themeControl = document.getElementById('themeControl');
            const themeTrigger = document.getElementById('themeTrigger');
            const themeOptions = document.querySelectorAll('.theme-option');
            const colorOptions = document.querySelectorAll('.theme-color');

            const colorMap = {
                blue: {
                    teal: '#1d6fb8',
                    tealDark: '#13518c',
                    tealDeep: '#0d3a66',
                    tealLight: '#28a9e1',
                    glow: 'rgba(29,111,184,.35)'
                },
                purple: {
                    teal: '#7650c8',
                    tealDark: '#53329a',
                    tealDeep: '#38216f',
                    tealLight: '#9a72e6',
                    glow: 'rgba(118,80,200,.32)'
                },
                green: {
                    teal: '#26966c',
                    tealDark: '#176d4e',
                    tealDeep: '#0f4c38',
                    tealLight: '#50bf91',
                    glow: 'rgba(38,150,108,.32)'
                },
                red: {
                    teal: '#d64b5a',
                    tealDark: '#a93240',
                    tealDeep: '#77252f',
                    tealLight: '#f06b78',
                    glow: 'rgba(214,75,90,.30)'
                },
                orange: {
                    teal: '#d88918',
                    tealDark: '#a8630e',
                    tealDeep: '#70420a',
                    tealLight: '#f3ad3d',
                    glow: 'rgba(216,137,24,.30)'
                }
            };

            function applyColor(colorName) {
                const c = colorMap[colorName] || colorMap.blue;

                document.documentElement.style.setProperty('--teal', c.teal);
                document.documentElement.style.setProperty('--teal-dark', c.tealDark);
                document.documentElement.style.setProperty('--teal-deep', c.tealDeep);
                document.documentElement.style.setProperty('--teal-light', c.tealLight);
                document.documentElement.style.setProperty('--teal-glow', c.glow);

                colorOptions.forEach(function (btn) {
                    btn.classList.toggle('active', btn.dataset.color === colorName);
                });

                localStorage.setItem('smkn2-theme-color', colorName);
            }

            function applyMode(mode) {
                document.body.classList.remove('theme-dark', 'theme-light');

                if (mode === 'dark') {
                    document.body.classList.add('theme-dark');
                }

                if (mode === 'light') {
                    document.body.classList.add('theme-light');
                }

                themeOptions.forEach(function (btn) {
                    btn.classList.toggle('active', btn.dataset.mode === mode);
                });

                localStorage.setItem('smkn2-theme-mode', mode);
            }

            const savedMode = localStorage.getItem('smkn2-theme-mode') || 'default';
            const savedColor = localStorage.getItem('smkn2-theme-color') || 'blue';

            applyMode(savedMode);
            applyColor(savedColor);

            if (themeTrigger && themeControl) {
                themeTrigger.addEventListener('click', function (e) {
                    e.stopPropagation();

                    const opened = themeControl.classList.toggle('open');
                    themeTrigger.setAttribute('aria-expanded', opened ? 'true' : 'false');
                });
            }

            themeOptions.forEach(function (option) {
                option.addEventListener('click', function (e) {
                    e.stopPropagation();
                    applyMode(option.dataset.mode);
                });
            });

            colorOptions.forEach(function (option) {
                option.addEventListener('click', function (e) {
                    e.stopPropagation();
                    applyColor(option.dataset.color);
                });
            });

            /* ================= SIBOT ================= */
            const sibotFab = document.getElementById('sibotFab');
            const sibotPanel = document.getElementById('sibotPanel');
            const sibotClose = document.getElementById('sibotClose');

            function openSibot() {
                sibotPanel?.classList.add('open');
                sibotPanel?.setAttribute('aria-hidden', 'false');
                sibotFab?.setAttribute('aria-expanded', 'true');

                const badge = sibotFab?.querySelector('.sibot-badge');
                if (badge) badge.style.display = 'none';
            }

            function closeSibot() {
                sibotPanel?.classList.remove('open');
                sibotPanel?.setAttribute('aria-hidden', 'true');
                sibotFab?.setAttribute('aria-expanded', 'false');
            }

            sibotFab?.addEventListener('click', function (e) {
                e.stopPropagation();

                if (sibotPanel?.classList.contains('open')) {
                    closeSibot();
                } else {
                    openSibot();
                }
            });

            sibotClose?.addEventListener('click', function (e) {
                e.stopPropagation();
                closeSibot();
            });

            /* ================= BACK TO TOP ================= */
            const backToTop = document.getElementById('backToTop');

            window.addEventListener('scroll', function () {
                if (!backToTop) return;

                if (window.pageYOffset > 400) {
                    backToTop.classList.add('show');
                } else {
                    backToTop.classList.remove('show');
                }
            });

            backToTop?.addEventListener('click', function () {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            /* ================= SCROLL REVEAL ================= */
            const revealElements = document.querySelectorAll('[data-reveal]');

            if ('IntersectionObserver' in window) {
                const revealObserver = new IntersectionObserver(function (entries) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('revealed');
                        }
                    });
                }, {
                    threshold: .15,
                    rootMargin: '0px 0px -30px 0px'
                });

                revealElements.forEach(function (el) {
                    revealObserver.observe(el);
                });
            } else {
                revealElements.forEach(function (el) {
                    el.classList.add('revealed');
                });
            }

        });
    </script>

    @stack('scripts')
</body>
</html>