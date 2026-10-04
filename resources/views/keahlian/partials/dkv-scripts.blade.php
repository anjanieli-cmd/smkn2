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
/* ---- Slider Karya Siswa + Filter ---- */
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
    var offset=0,visIdx=0,i=0;
    for(;i<cards().length;i++){if(cards()[i].style.display==='none')continue;if(visIdx===index*per)break;offset+=cards()[i].offsetWidth+19;visIdx++}
    track.style.transform='translateX(-'+offset+'px)';
    prevBtn.disabled=index<=0;nextBtn.disabled=index>=maxIndex;
    Array.prototype.forEach.call(dotsWrap.children,function(d,di){d.classList.toggle('active',di===index)})
  }
  function goTo(i){var maxIndex=Math.max(0,Math.ceil(visible().length/pageSize())-1);index=Math.min(Math.max(i,0),maxIndex);update()}
  prevBtn.addEventListener('click',function(){goTo(index-1)});
  nextBtn.addEventListener('click',function(){goTo(index+1)});
  var startX=0,currentX=0,isSwiping=false;
  track.addEventListener('touchstart',function(e){if(e.touches&&e.touches.length){startX=e.touches[0].clientX;isSwiping=true;currentX=startX}},{passive:true});
  track.addEventListener('touchmove',function(e){if(!isSwiping||!e.touches||!e.touches.length)return;currentX=e.touches[0].clientX},{passive:true});
  track.addEventListener('touchend',function(){if(!isSwiping)return;var diffX=startX-currentX;if(Math.abs(diffX)>35){if(diffX>0)goTo(index+1);else goTo(index-1)}startX=0;currentX=0;isSwiping=false});
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
