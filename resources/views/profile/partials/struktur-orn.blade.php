{{-- Ornamen dekoratif bagan (tidak berisi teks yang bisa diedit). --}}
<div class="home-orn" aria-hidden="true">
  <span class="ho-chevron"></span>
  <span class="ho-line"></span>
  <span class="ho-dots"></span>
  <span class="ho-ring"></span>
  <span class="ho-gold"></span>
  <span class="ho-square"></span>
  <span class="ho-corner"></span>
</div>

<div class="so-feed-orn" aria-hidden="true">
  <svg viewBox="0 0 1440 1120" preserveAspectRatio="none" role="presentation">
    <defs>
      <radialGradient id="soOrnGlowNavy" cx="50%" cy="50%" r="50%">
        <stop offset="0%" stop-color="#0d3a66" stop-opacity=".10"/>
        <stop offset="100%" stop-color="#0d3a66" stop-opacity="0"/>
      </radialGradient>
      <radialGradient id="soOrnGlowGold" cx="50%" cy="50%" r="50%">
        <stop offset="0%" stop-color="#ff8a00" stop-opacity=".13"/>
        <stop offset="100%" stop-color="#ff8a00" stop-opacity="0"/>
      </radialGradient>
      <pattern id="soOrnDots" width="18" height="18" patternUnits="userSpaceOnUse">
        <circle cx="3" cy="3" r="1.5" class="orn-grid-dot"/>
      </pattern>
    </defs>

    <!-- KIRI ATAS: orbit + jalur jaringan -->
    <g class="orn-left-top">
      <circle cx="150" cy="170" r="112" class="orn-ring"/>
      <circle cx="150" cy="170" r="82" class="orn-ring-gold"/>
      <circle cx="150" cy="170" r="52" class="orn-ring"/>
      <circle cx="150" cy="170" r="22" class="orn-solid-gold"/>
      <circle cx="150" cy="170" r="72" class="orn-dash"/>
      <path d="M0 300 L92 208 L206 208 L286 126" class="orn-line"/>
      <path d="M18 332 L116 232 L238 232 L318 152" class="orn-line-gold"/>
      <path d="M45 80 L118 124 L184 76 L270 112" class="orn-dash"/>
      <circle cx="92" cy="208" r="5" class="orn-node-navy"/>
      <circle cx="206" cy="208" r="5" class="orn-node"/>
      <circle cx="286" cy="126" r="5" class="orn-dot"/>
      <circle cx="118" cy="124" r="4" class="orn-dot"/>
      <circle cx="184" cy="76" r="4" class="orn-node"/>
      <circle cx="270" cy="112" r="4" class="orn-dot-navy"/>
      <circle cx="150" cy="170" r="180" class="orn-soft"/>
    </g>

    <!-- KANAN ATAS: diamond modular + node -->
    <g class="orn-right-top">
      <rect x="1138" y="72" width="148" height="148" transform="rotate(45 1212 146)" class="orn-diamond"/>
      <rect x="1165" y="99" width="94" height="94" transform="rotate(45 1212 146)" class="orn-diamond-navy"/>
      <rect x="1192" y="119" width="54" height="54" transform="rotate(45 1219 146)" class="orn-solid-navy"/>
      <path d="M1060 242 L1130 172 L1212 242 L1290 164 L1380 238" class="orn-line"/>
      <path d="M1110 320 L1190 240 L1280 240 L1368 150" class="orn-line-gold"/>
      <circle cx="1060" cy="242" r="5" class="orn-node"/>
      <circle cx="1130" cy="172" r="4" class="orn-dot-navy"/>
      <circle cx="1290" cy="164" r="5" class="orn-node"/>
      <circle cx="1380" cy="238" r="6" class="orn-solid-gold"/>
      <circle cx="1110" cy="320" r="4" class="orn-dot"/>
      <circle cx="1368" cy="150" r="4" class="orn-node-navy"/>
      <rect x="1288" y="310" width="110" height="110" fill="url(#soOrnDots)" opacity=".75"/>
    </g>

    <!-- KIRI BAWAH: garis diagonal + diamond -->
    <g class="orn-left-bottom">
      <rect x="76" y="770" width="112" height="112" transform="rotate(45 132 826)" class="orn-diamond"/>
      <rect x="104" y="798" width="56" height="56" transform="rotate(45 132 826)" class="orn-diamond-navy"/>
      <path d="M0 960 L94 866 L184 866 L286 764 L376 764" class="orn-line"/>
      <path d="M0 1010 L126 884 L238 884 L338 784 L430 784" class="orn-line-gold"/>
      <path d="M64 1040 L164 940 L264 940 L364 840" class="orn-dash"/>
      <circle cx="94" cy="866" r="5" class="orn-node"/>
      <circle cx="184" cy="866" r="4" class="orn-dot-navy"/>
      <circle cx="286" cy="764" r="5" class="orn-node-navy"/>
      <circle cx="376" cy="764" r="4" class="orn-dot"/>
      <circle cx="126" cy="884" r="4" class="orn-dot"/>
      <circle cx="338" cy="784" r="5" class="orn-node"/>
      <circle cx="430" cy="784" r="4" class="orn-dot-navy"/>
      <rect x="-16" y="930" width="92" height="92" fill="url(#soOrnDots)" opacity=".62"/>
    </g>

    <!-- KANAN BAWAH: focal orbit + modular blocks -->
    <g class="orn-right-bottom">
      <circle cx="1225" cy="858" r="128" class="orn-ring"/>
      <circle cx="1225" cy="858" r="96" class="orn-ring-gold"/>
      <circle cx="1225" cy="858" r="62" class="orn-ring"/>
      <circle cx="1225" cy="858" r="28" class="orn-solid-gold"/>
      <path d="M1050 1012 L1148 914 L1234 914 L1320 828 L1428 828" class="orn-line"/>
      <path d="M1084 1056 L1184 956 L1268 956 L1360 864 L1440 864" class="orn-line-gold"/>
      <circle cx="1050" cy="1012" r="5" class="orn-node-navy"/>
      <circle cx="1148" cy="914" r="4" class="orn-dot"/>
      <circle cx="1234" cy="914" r="5" class="orn-node"/>
      <circle cx="1320" cy="828" r="4" class="orn-dot-navy"/>
      <circle cx="1428" cy="828" r="5" class="orn-solid-gold"/>
      <rect x="1280" y="950" width="126" height="126" transform="rotate(45 1343 1013)" class="orn-diamond-navy"/>
      <rect x="1306" y="976" width="74" height="74" transform="rotate(45 1343 1013)" class="orn-diamond"/>
      <circle cx="1225" cy="858" r="185" class="orn-glow"/>
    </g>

    <!-- titik aksen kecil di seluruh bidang -->
    <g class="hide-mobile">
      <circle cx="392" cy="144" r="4" class="orn-solid-gold"/>
      <circle cx="428" cy="182" r="3" class="orn-dot-navy"/>
      <circle cx="1010" cy="150" r="4" class="orn-dot"/>
      <circle cx="1050" cy="188" r="3" class="orn-dot-navy"/>
      <circle cx="334" cy="624" r="3" class="orn-dot"/>
      <circle cx="1090" cy="610" r="4" class="orn-solid-gold"/>
      <circle cx="1018" cy="690" r="3" class="orn-dot-navy"/>
      <circle cx="408" cy="920" r="4" class="orn-dot-navy"/>
    </g>
  </svg>
</div>
