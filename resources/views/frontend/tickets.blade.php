@extends('layouts.app')

@section('content')

<style>
* { margin: 0; padding: 0; box-sizing: border-box; }

:root {
    --navy: #0B1220;
    --blue: #1E88FF;
    --gold: #FFD700;
    --white: #FFFFFF;
}

body { background: var(--navy); font-family: 'Instrument Sans', sans-serif; color: var(--white); }

nav {
    position: fixed; top: 0; left: 0; right: 0; z-index: 100;
    padding: 20px 60px; display: flex; align-items: center; justify-content: space-between;
    background: rgba(11,18,32,0.95); backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(30,136,255,0.15);
}
.nav-logo { font-family: 'Bebas Neue', cursive; font-size: 1.5rem; letter-spacing: 3px; color: var(--white); text-decoration: none; white-space: nowrap; }
.nav-logo span { color: var(--gold); }
.nav-links { display: flex; gap: 35px; list-style: none; }
.nav-links a { color: rgba(255,255,255,0.7); text-decoration: none; font-size: 0.85rem; font-weight: 600; letter-spacing: 2px; text-transform: uppercase; transition: color 0.3s; }
.nav-links a:hover, .nav-links a.active { color: var(--gold); }
.nav-btn { background: var(--blue); color: white; padding: 10px 25px; border-radius: 6px; font-size: 0.8rem; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; text-decoration: none; transition: all 0.3s; white-space: nowrap; }
.nav-btn:hover { background: var(--gold); color: var(--navy); }
.nav-hamburger { display: none; background: none; border: 1px solid rgba(255,255,255,0.2); color: var(--white); font-size: 1.3rem; cursor: pointer; padding: 6px 12px; border-radius: 6px; }

.page-header { padding: 140px 60px 40px; text-align: center; background: linear-gradient(180deg, rgba(255,215,0,0.06) 0%, transparent 100%); border-bottom: 1px solid rgba(255,215,0,0.1); }
.page-header h1 { font-family: 'Bebas Neue', cursive; font-size: clamp(3rem, 8vw, 6rem); letter-spacing: 3px; margin-bottom: 15px; }
.page-header h1 span { color: var(--gold); }
.page-header p { color: rgba(255,255,255,0.5); font-size: 1rem; }

.venue-layout { display: grid; grid-template-columns: 1fr 220px; gap: 20px; padding: 30px 40px 60px; max-width: 1400px; margin: 0 auto; }

.map-outer { display: flex; flex-direction: column; gap: 5px; }
.screen-bar { background: linear-gradient(90deg,#1565C0,#1E88FF); color:#fff; text-align:center; padding:8px; border-radius:7px; font-size:9px; letter-spacing:3px; font-weight:500; }
.catwalk-bar { background:#0d1520; border:1px solid rgba(255,215,0,0.35); text-align:center; padding:5px; border-radius:5px; font-size:8px; color:#FFD700; letter-spacing:2px; }
.stage-bar { background:#0a1018; border:1.5px solid rgba(255,215,0,0.5); text-align:center; padding:8px; border-radius:7px; font-size:9px; color:#FFD700; letter-spacing:2px; }
.level-row { display:flex; gap:0; align-items:stretch; }
.level-tag { writing-mode:vertical-rl; transform:rotate(180deg); font-size:7px; color:rgba(255,255,255,0.3); letter-spacing:2px; text-transform:uppercase; padding:4px 3px; display:flex; align-items:center; justify-content:center; min-width:16px; }
.zones { flex:1; display:flex; gap:4px; }
.zone { border-radius:8px; padding:6px; display:flex; flex-direction:column; gap:3px; flex:1; }
.zone-name { font-size:6.5px; letter-spacing:1px; text-align:center; font-weight:500; text-transform:uppercase; margin-bottom:2px; }
.row-grid { display:flex; flex-direction:column; gap:3px; }
.row-line { display:flex; flex-direction:row; gap:3px; justify-content:center; }

.cu { display:inline-flex; align-items:center; gap:1px; cursor:pointer; padding:2px; border-radius:4px; transition:transform 0.12s; transform:rotate(90deg); }..cu:hover { transform:rotate(90deg) scale(1.12); z-index:10; filter:brightness(1.3); }
.cu.sel { transform:rotate(90deg) scale(1.12); z-index:10; filter:brightness(1.3); }
.sofa-big { width:6px; height:22px; border-radius:3px; border:1.5px solid; overflow:hidden; display:flex; flex-direction:column; padding:1px; gap:1px; }
.sofa-big-back { width:100%; height:5px; border-radius:1px; opacity:0.8; }
.sofa-big-seat { width:100%; flex:1; border-radius:1px; opacity:0.4; }
.ctbl-wrap { display:flex; flex-direction:column; align-items:center; gap:1px; }
.sofa-small { width:11px; height:4px; border-radius:2px 2px 1px 1px; border:1.5px solid; opacity:0.75; }
.ctbl { width:11px; height:15px; border-radius:2px; border:1.5px solid; }

.tu { display:inline-flex; align-items:center; gap:1px; cursor:pointer; padding:1px; border-radius:3px; transition:transform 0.12s; }
.tu:hover,.tu.sel { transform:scale(1.15); z-index:10; filter:brightness(1.3); }
.chairs-side { display:flex; flex-direction:column; gap:2px; }
.chair { width:5px; height:6px; border-radius:1.5px; border:1.5px solid; opacity:0.7; }
.tbl-top { width:13px; height:17px; border-radius:2px; border:1.5px solid; }

.su { width:10px; height:10px; border-radius:2px; border:1.5px solid; cursor:pointer; transition:transform 0.12s; }
.su:hover,.su.sel { transform:scale(1.25); filter:brightness(1.3); }
.tech-cell { width:13px; height:17px; border-radius:2px; background:rgba(100,116,139,0.08); border:1px dashed rgba(100,116,139,0.2); }

.z-vip { background:rgba(220,38,38,0.07); border:1px solid rgba(220,38,38,0.2); }
.z-vip .zone-name { color:#f87171; }
.z-vipc { background:rgba(234,179,8,0.07); border:1px solid rgba(234,179,8,0.25); }
.z-vipc .zone-name { color:#fcd34d; }
.z-high { background:rgba(20,184,166,0.07); border:1px solid rgba(20,184,166,0.2); }
.z-high .zone-name { color:#2dd4bf; }
.z-seat { background:rgba(59,130,246,0.07); border:1px solid rgba(59,130,246,0.2); }
.z-seat .zone-name { color:#60a5fa; }
.z-midseat { background:rgba(168,85,247,0.07); border:1px solid rgba(168,85,247,0.2); }
.z-midseat .zone-name { color:#c084fc; }

.map-sidebar { display:flex; flex-direction:column; gap:12px; position:sticky; top:90px; align-self:flex-start; }
.sel-card { background:#111827; border:1px solid rgba(255,215,0,0.2); border-radius:12px; padding:14px; }
.sel-title { font-size:8px; color:rgba(255,255,255,0.4); letter-spacing:2px; margin-bottom:4px; }
.sel-count { font-family:'Bebas Neue',cursive; font-size:32px; color:#FFD700; line-height:1; }
.sel-pax { font-size:10px; color:rgba(255,255,255,0.4); margin-top:2px; }
.sel-tags { display:flex; flex-wrap:wrap; gap:2px; margin-top:6px; max-height:100px; overflow-y:auto; }
.tag { font-size:8px; padding:2px 6px; border-radius:3px; cursor:pointer; display:flex; align-items:center; gap:3px; }
.book-btn { width:100%; padding:12px; background:#FFD700; color:#0B1220; border:none; border-radius:9px; font-family:'Bebas Neue',cursive; font-size:1rem; letter-spacing:.15em; cursor:pointer; transition:opacity .2s; }
.book-btn:hover { opacity:.88; }
.book-btn:disabled { opacity:.3; cursor:not-allowed; }
.clear-btn { width:100%; padding:7px; background:transparent; border:1px solid rgba(255,255,255,0.1); border-radius:7px; font-size:10px; color:rgba(255,255,255,0.4); cursor:pointer; font-family:'Instrument Sans',sans-serif; }
.clear-btn:hover { border-color:rgba(255,255,255,0.25); color:#fff; }
.leg { padding:8px; background:#111827; border-radius:8px; display:flex; flex-direction:column; gap:4px; }
.li { display:flex; align-items:center; gap:6px; font-size:8px; color:rgba(255,255,255,0.5); }
.ld { width:9px; height:9px; border-radius:1px; flex-shrink:0; }
.tt { position:fixed; background:#1a2535; color:#fff; font-size:9px; padding:3px 8px; border-radius:4px; pointer-events:none; z-index:9999; display:none; white-space:nowrap; border:1px solid rgba(255,255,255,0.1); }

/* MOBILE */
@media (max-width: 768px) {
    nav { padding: 15px 20px; flex-wrap: wrap; gap: 8px; }
    .nav-hamburger { display: block; }
    .nav-btn { display: none; }
    .nav-links { display: none; flex-direction: column; width: 100%; gap: 12px; padding: 15px 0 5px; border-top: 1px solid rgba(255,255,255,0.08); }
    .nav-links.open { display: flex; }
    .page-header { padding: 100px 20px 30px; }
    .venue-layout { grid-template-columns: 1fr; padding: 15px; gap: 15px; }
    .map-sidebar { position: static; }
    .sel-card { display: flex; flex-wrap: wrap; gap: 10px; align-items: center; }
    .sel-title { width: 100%; }
}
</style>

<nav>
    <a href="/" class="nav-logo">MINIEH <span>FAN ZONE</span></a>
    <ul class="nav-links" id="nav-links">
        <li><a href="/">Home</a></li>
        <li><a href="/matches">Matches</a></li>
        <li><a href="/tickets" class="active">Tickets</a></li>
        <li><a href="/venue">Venue</a></li>
    </ul>
    <a href="/reserve" class="nav-btn">🎟️ Reserve Now</a>
    <button class="nav-hamburger" onclick="toggleNav()">☰</button>
</nav>

<div class="page-header">
    <h1>SELECT YOUR <span>SPOT</span></h1>
    <p>Click any table or seat to select it — then book your spot</p>
</div>

<div class="venue-layout">
    <div class="map-outer">
        <div class="screen-bar">▶ GIANT LED SCREEN — ABOVE THE SEA</div>
        <div class="catwalk-bar">🎬 STAGE & CATWALK</div>

        <div class="level-row">
            <div class="level-tag">VIP L4</div>
            <div class="zones">
                <div class="zone z-vip"><div class="zone-name">VIP Left (15)</div><div class="row-grid" id="g-vtl"></div></div>
                <div class="zone z-vipc"><div class="zone-name">VIP Mid Left (11)</div><div class="row-grid" id="g-vml"></div></div>
                <div class="zone z-vipc"><div class="zone-name">VIP Mid Right (11)</div><div class="row-grid" id="g-vmr"></div></div>
                <div class="zone z-vip"><div class="zone-name">VIP Right (15)</div><div class="row-grid" id="g-vtr"></div></div>
            </div>
        </div>

        <div class="level-row">
            <div class="level-tag">Tables L3</div>
            <div class="zones">
                <div class="zone z-high"><div class="zone-name">Left (42)</div><div class="row-grid" id="g-tl"></div></div>
                <div class="zone z-high"><div class="zone-name">Mid Left (28)</div><div class="row-grid" id="g-tml"></div></div>
                <div class="zone z-high"><div class="zone-name">Mid Right (30)</div><div class="row-grid" id="g-tmr"></div></div>
                <div class="zone z-high"><div class="zone-name">Right (42)</div><div class="row-grid" id="g-tr"></div></div>
            </div>
        </div>

        <div class="level-row">
            <div class="level-tag">Seats L1</div>
            <div class="zones">
                <div class="zone z-seat"><div class="zone-name">Left (60)</div><div class="row-grid" id="g-sl"></div></div>
                <div class="zone z-midseat"><div class="zone-name">Mid Left (21)</div><div class="row-grid" id="g-sml"></div></div>
                <div class="zone z-midseat"><div class="zone-name">Mid Right (21)</div><div class="row-grid" id="g-smr"></div></div>
                <div class="zone z-seat"><div class="zone-name">Right (60)</div><div class="row-grid" id="g-sr"></div></div>
            </div>
        </div>

        <div class="stage-bar">STAGE 14 × 3.6m</div>
    </div>

    <div class="map-sidebar">
        <div class="sel-card">
            <div class="sel-title">YOUR SELECTION</div>
            <div class="sel-count" id="sc">0</div>
            <div class="sel-pax" id="sp">items · 0 pax</div>
            <div class="sel-tags" id="st"></div>
        </div>
        <button class="book-btn" id="bb" disabled onclick="bookNow()">BOOK NOW</button>
        <button class="clear-btn" onclick="clearAll()">Clear all</button>
        <div class="leg">
            <div class="li"><div class="ld" style="background:#dc2626"></div>VIP couch — 6 pax</div>
            <div class="li"><div class="ld" style="background:#eab308"></div>VIP Mid — 6 pax</div>
            <div class="li"><div class="ld" style="background:#14b8a6"></div>Table — 4 pax</div>
            <div class="li"><div class="ld" style="background:#a855f7;border-radius:50%"></div>Mid seat — 1 pax</div>
            <div class="li"><div class="ld" style="background:#3b82f6;border-radius:2px"></div>Seat — 1 pax</div>
        </div>
    </div>
</div>

<footer style="padding:30px 20px;text-align:center;border-top:1px solid rgba(255,255,255,0.05);color:rgba(255,255,255,0.3);font-size:0.85rem;">
    <p>© 2026 Minieh Fan Zone. All rights reserved. 🇱🇧</p>
</footer>

<div class="tt" id="tt"></div>

<script>
function toggleNav(){document.getElementById('nav-links').classList.toggle('open');}

const sel={};
const tt=document.getElementById('tt');
function tip(e,t){tt.style.display='block';tt.textContent=t;tt.style.left=(e.clientX+10)+'px';tt.style.top=(e.clientY-20)+'px';}
function hideTip(){tt.style.display='none';}
function toggle(id,pax,label,color,el){
  if(sel[id]){delete sel[id];el.classList.remove('sel');}
  else{sel[id]={pax,label,color,el};el.classList.add('sel');}
  upd();
}
function upd(){
  const keys=Object.keys(sel);
  const tp=keys.reduce((a,k)=>a+sel[k].pax,0);
  document.getElementById('sc').textContent=keys.length;
  document.getElementById('sp').textContent='items · '+tp+' pax';
  const st=document.getElementById('st');st.innerHTML='';
  keys.slice(-12).forEach(k=>{
    const t=document.createElement('div');t.className='tag';
    t.style.cssText='background:'+sel[k].color+'22;color:'+sel[k].color+';border:0.5px solid '+sel[k].color;
    t.innerHTML=sel[k].label+' <span onclick="rm(\''+k+'\')" style="cursor:pointer;opacity:0.6">✕</span>';
    st.appendChild(t);
  });
  document.getElementById('bb').disabled=keys.length===0;
}
window.rm=function(id){if(!sel[id])return;sel[id].el.classList.remove('sel');delete sel[id];upd();};
function clearAll(){Object.keys(sel).forEach(k=>rm(k));}
function bookNow(){
  const keys=Object.keys(sel);
  if(!keys.length)return;
  window.location.href='/reserve';
}

let _cn=0,_tn=0,_sn=0;

function makeCouch(id,sofaC,sofaS,tblC,tblS){
  const u=document.createElement('div');u.className='cu';
  const sl=document.createElement('div');sl.className='sofa-big';sl.style.cssText='background:'+sofaC+';border-color:'+sofaS;
  const slb=document.createElement('div');slb.className='sofa-big-back';slb.style.background=sofaS;
  const sls=document.createElement('div');sls.className='sofa-big-seat';sls.style.background=sofaS;
  sl.appendChild(slb);sl.appendChild(sls);
  const cw=document.createElement('div');cw.className='ctbl-wrap';
  const ss=document.createElement('div');ss.className='sofa-small';ss.style.cssText='background:'+sofaC+';border-color:'+sofaS;
  const ct=document.createElement('div');ct.className='ctbl';ct.style.cssText='background:'+tblC+';border-color:'+tblS;
  cw.appendChild(ss);cw.appendChild(ct);
  const sr=document.createElement('div');sr.className='sofa-big';sr.style.cssText='background:'+sofaC+';border-color:'+sofaS;
  const srb=document.createElement('div');srb.className='sofa-big-back';srb.style.background=sofaS;
  const srs=document.createElement('div');srs.className='sofa-big-seat';srs.style.background=sofaS;
  sr.appendChild(srb);sr.appendChild(srs);
  u.appendChild(sl);u.appendChild(cw);u.appendChild(sr);
  u.addEventListener('mouseenter',e=>tip(e,id+' · 6 pax'));
  u.addEventListener('mousemove',e=>{tt.style.left=(e.clientX+10)+'px';tt.style.top=(e.clientY-20)+'px';});
  u.addEventListener('mouseleave',hideTip);
  u.addEventListener('click',()=>toggle(id,6,id,sofaS,u));
  return u;
}

function makeTable(id,tblC,tblS,chairC,chairS){
  const u=document.createElement('div');u.className='tu';
  const cl=document.createElement('div');cl.className='chairs-side';
  for(let j=0;j<2;j++){const c=document.createElement('div');c.className='chair';c.style.cssText='background:'+chairC+';border-color:'+chairS;cl.appendChild(c);}
  const tb=document.createElement('div');tb.className='tbl-top';tb.style.cssText='background:'+tblC+';border-color:'+tblS;
  const cr=document.createElement('div');cr.className='chairs-side';
  for(let j=0;j<2;j++){const c=document.createElement('div');c.className='chair';c.style.cssText='background:'+chairC+';border-color:'+chairS;cr.appendChild(c);}
  u.appendChild(cl);u.appendChild(tb);u.appendChild(cr);
  u.addEventListener('mouseenter',e=>tip(e,id+' · 4 pax'));
  u.addEventListener('mousemove',e=>{tt.style.left=(e.clientX+10)+'px';tt.style.top=(e.clientY-20)+'px';});
  u.addEventListener('mouseleave',hideTip);
  u.addEventListener('click',()=>toggle(id,4,id,tblS,u));
  return u;
}

function makeSeat(id,color,stroke){
  const u=document.createElement('div');u.className='su';
  u.style.cssText='background:'+color+';border-color:'+stroke;
  u.addEventListener('mouseenter',e=>tip(e,id+' · 1 pax'));
  u.addEventListener('mousemove',e=>{tt.style.left=(e.clientX+10)+'px';tt.style.top=(e.clientY-20)+'px';});
  u.addEventListener('mouseleave',hideTip);
  u.addEventListener('click',()=>toggle(id,1,id,stroke,u));
  return u;
}

function techCell(){const d=document.createElement('div');d.className='tech-cell';return d;}

function buildRowGrid(gridId,rows){
  const g=document.getElementById(gridId);
  rows.forEach(rowItems=>{
    const r=document.createElement('div');r.className='row-line';
    rowItems.forEach(el=>{if(el)r.appendChild(el);});
    g.appendChild(r);
  });
}

const VC1='rgba(220,38,38,0.35)',VS1='#dc2626',VT1='rgba(90,10,10,0.4)',VTS1='#991b1b';
const VC2='rgba(234,179,8,0.35)',VS2='#eab308',VT2='rgba(90,60,0,0.4)',VTS2='#ca8a04';
const TC='rgba(20,184,166,0.25)',TS='#14b8a6',CC='rgba(20,184,166,0.5)',CS='#0d9488';

function C(p,sc,ss,tc,ts){_cn++;return makeCouch(p+_cn,sc,ss,tc,ts);}
function T(p){_tn++;return makeTable(p+_tn,TC,TS,CC,CS);}
function S(p,c,s){_sn++;return makeSeat(p+_sn,c,s);}
function nC(n,p,sc,ss,tc,ts){return Array.from({length:n},()=>C(p,sc,ss,tc,ts));}
function nT(n,p){return Array.from({length:n},()=>T(p));}
function nS(n,p,c,s){return Array.from({length:n},()=>S(p,c,s));}

_cn=0;buildRowGrid('g-vtl',[nC(3,'VTL',VC1,VS1,VT1,VTS1),nC(3,'VTL',VC1,VS1,VT1,VTS1),nC(3,'VTL',VC1,VS1,VT1,VTS1),nC(3,'VTL',VC1,VS1,VT1,VTS1),nC(3,'VTL',VC1,VS1,VT1,VTS1)]);
_cn=0;buildRowGrid('g-vtr',[nC(3,'VTR',VC1,VS1,VT1,VTS1),nC(3,'VTR',VC1,VS1,VT1,VTS1),nC(3,'VTR',VC1,VS1,VT1,VTS1),nC(3,'VTR',VC1,VS1,VT1,VTS1),nC(3,'VTR',VC1,VS1,VT1,VTS1)]);
_cn=0;buildRowGrid('g-vml',[nC(3,'VML',VC2,VS2,VT2,VTS2),nC(3,'VML',VC2,VS2,VT2,VTS2),nC(3,'VML',VC2,VS2,VT2,VTS2),nC(2,'VML',VC2,VS2,VT2,VTS2)]);
_cn=0;buildRowGrid('g-vmr',[nC(3,'VMR',VC2,VS2,VT2,VTS2),nC(3,'VMR',VC2,VS2,VT2,VTS2),nC(3,'VMR',VC2,VS2,VT2,VTS2),nC(2,'VMR',VC2,VS2,VT2,VTS2)]);
_tn=0;buildRowGrid('g-tl',[nT(6,'TL'),nT(6,'TL'),nT(5,'TL'),nT(5,'TL'),nT(5,'TL'),nT(5,'TL'),nT(5,'TL'),nT(5,'TL')]);
_tn=0;buildRowGrid('g-tr',[nT(6,'TR'),nT(6,'TR'),nT(5,'TR'),nT(5,'TR'),nT(5,'TR'),nT(5,'TR'),nT(5,'TR'),nT(5,'TR')]);
_tn=0;buildRowGrid('g-tml',[nT(4,'TML'),nT(4,'TML'),nT(4,'TML'),nT(4,'TML'),nT(4,'TML'),nT(4,'TML'),[T('TML'),techCell(),techCell()],[T('TML'),T('TML'),T('TML')]]);
_tn=0;buildRowGrid('g-tmr',[nT(4,'TMR'),nT(4,'TMR'),nT(4,'TMR'),nT(4,'TMR'),nT(4,'TMR'),nT(4,'TMR'),nT(3,'TMR'),nT(3,'TMR')]);
_sn=0;buildRowGrid('g-sl',[nS(20,'SL','rgba(59,130,246,0.25)','#3b82f6'),nS(20,'SL','rgba(59,130,246,0.25)','#3b82f6'),nS(20,'SL','rgba(59,130,246,0.25)','#3b82f6')]);
_sn=0;buildRowGrid('g-sr',[nS(20,'SR','rgba(59,130,246,0.25)','#3b82f6'),nS(20,'SR','rgba(59,130,246,0.25)','#3b82f6'),nS(20,'SR','rgba(59,130,246,0.25)','#3b82f6')]);
_sn=0;buildRowGrid('g-sml',[nS(7,'SML','rgba(168,85,247,0.25)','#a855f7'),nS(7,'SML','rgba(168,85,247,0.25)','#a855f7'),nS(7,'SML','rgba(168,85,247,0.25)','#a855f7')]);
_sn=0;buildRowGrid('g-smr',[nS(7,'SMR','rgba(168,85,247,0.25)','#a855f7'),nS(7,'SMR','rgba(168,85,247,0.25)','#a855f7'),nS(7,'SMR','rgba(168,85,247,0.25)','#a855f7')]);
</script>

@endsection