@extends('layouts.app')
 
@section('title', 'Reserve Your Spot — Minieh Fan Zone 2026')
 
@section('styles')
<style>
:root {
    --navy:#0B1220;--navy2:#111827;--navy3:#0d1728;--blue:#1E88FF;--gold:#FFD700;--white:#FFFFFF;--muted:rgba(255,255,255,0.45);--border:rgba(255,255,255,0.08);
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
body{background:var(--navy);color:var(--white);font-family:'Instrument Sans',sans-serif;min-height:100vh;}
nav{position:fixed;top:0;left:0;right:0;z-index:100;padding:20px 60px;display:flex;align-items:center;justify-content:space-between;background:rgba(11,18,32,0.8);backdrop-filter:blur(20px);border-bottom:1px solid rgba(255,215,0,0.12);}
.nav-logo{font-family:'Bebas Neue',sans-serif;font-size:1.5rem;letter-spacing:3px;color:var(--white);text-decoration:none;white-space:nowrap;}
.nav-logo span{color:var(--gold);text-shadow:0 0 15px rgba(255,215,0,0.4);}
.nav-links{display:flex;gap:35px;list-style:none;}
.nav-links a{color:rgba(255,255,255,0.7);text-decoration:none;font-size:0.85rem;font-weight:600;letter-spacing:2px;text-transform:uppercase;transition:color 0.3s;position:relative;}
.nav-links a::after{content:'';position:absolute;bottom:-4px;left:0;width:0;height:2px;background:var(--gold);box-shadow:0 0 8px rgba(255,215,0,0.6);transition:width 0.3s;}
.nav-links a:hover::after,.nav-links a.active::after{width:100%;}
.nav-links a:hover,.nav-links a.active{color:var(--gold);}
.nav-btn{background:var(--gold);color:var(--navy);padding:10px 25px;border-radius:8px;font-size:0.8rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;text-decoration:none;transition:all 0.3s;white-space:nowrap;box-shadow:0 0 20px rgba(255,215,0,0.25);}
.nav-btn:hover{box-shadow:0 0 35px rgba(255,215,0,0.5);transform:translateY(-1px);}
.nav-hamburger{display:none;background:none;border:1px solid rgba(255,255,255,0.2);color:var(--white);font-size:1.3rem;cursor:pointer;padding:6px 12px;border-radius:6px;}
 
.res-header{text-align:center;padding:5.5rem 1rem 2.5rem;position:relative;overflow:hidden;}
.res-header::before{content:'';position:absolute;inset:0;background-image:linear-gradient(rgba(255,215,0,0.03) 1px,transparent 1px),linear-gradient(90deg,rgba(255,215,0,0.03) 1px,transparent 1px);background-size:50px 50px;pointer-events:none;}
.res-header::after{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 70% 50% at 50% 0%, rgba(255,215,0,0.08), transparent 70%);pointer-events:none;}
.res-header .eye{font-family:'Bebas Neue',sans-serif;letter-spacing:.3em;font-size:.78rem;color:var(--gold);margin-bottom:.5rem;position:relative;z-index:1;text-shadow:0 0 10px rgba(255,215,0,0.4);}
.res-header h1{font-family:'Bebas Neue',sans-serif;font-size:clamp(2.4rem,5vw,4rem);letter-spacing:.05em;line-height:1;margin-bottom:.6rem;position:relative;z-index:1;}
.res-header p{color:var(--muted);font-size:.9rem;position:relative;z-index:1;}
 
.progress-wrap{max-width:720px;margin:0 auto;padding:2rem 1.5rem 0;}
.progress-steps{display:flex;align-items:center;position:relative;}
.step-item{flex:1;display:flex;flex-direction:column;align-items:center;position:relative;}
.step-item:not(:last-child)::after{content:'';position:absolute;top:17px;left:50%;width:100%;height:2px;background:var(--border);z-index:0;transition:background .4s;}
.step-item.done:not(:last-child)::after{background:var(--gold);box-shadow:0 0 8px rgba(255,215,0,0.5);}
.step-dot{width:34px;height:34px;border-radius:50%;border:2px solid var(--border);display:flex;align-items:center;justify-content:center;font-family:'Bebas Neue',sans-serif;font-size:.85rem;color:var(--muted);background:var(--navy2);position:relative;z-index:1;transition:all .3s cubic-bezier(0.16,1,0.3,1);}
.step-item.active .step-dot{border-color:var(--gold);color:var(--gold);box-shadow:0 0 0 4px rgba(255,215,0,0.12),0 0 20px rgba(255,215,0,0.3);}
.step-item.done .step-dot{border-color:var(--gold);background:var(--gold);color:#0B1220;box-shadow:0 0 15px rgba(255,215,0,0.4);}
.step-lbl{font-size:.62rem;color:var(--muted);margin-top:.4rem;letter-spacing:.04em;text-transform:uppercase;text-align:center;transition:color .3s;}
.step-item.active .step-lbl{color:var(--gold);}
.step-item.done .step-lbl{color:rgba(255,215,0,0.7);}
 
.res-body{max-width:720px;margin:2rem auto 6rem;padding:0 1.5rem;}
.res-card{background:rgba(255,255,255,0.03);backdrop-filter:blur(20px);border:1px solid rgba(255,215,0,0.15);border-radius:18px;overflow:hidden;}
.res-card-header{padding:1.75rem 2rem 1.5rem;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:1rem;}
.step-num-big{width:52px;height:52px;border-radius:12px;background:rgba(255,215,0,0.12);border:1px solid rgba(255,215,0,0.3);display:flex;align-items:center;justify-content:center;font-family:'Bebas Neue',sans-serif;font-size:1.6rem;color:var(--gold);flex-shrink:0;box-shadow:0 0 20px rgba(255,215,0,0.15);}
.res-card-header h2{font-family:'Bebas Neue',sans-serif;font-size:1.5rem;letter-spacing:.05em;line-height:1.1;}
.res-card-header p{font-size:.8rem;color:var(--muted);margin-top:3px;}
.res-card-body{padding:1.75rem 2rem;}
.step-panel{display:none;}
.step-panel.active{display:block;}
 
.match-search{width:100%;padding:.75rem 1rem;background:var(--navy3);border:1px solid var(--border);border-radius:10px;color:var(--white);font-family:'Instrument Sans',sans-serif;font-size:.9rem;outline:none;margin-bottom:1.25rem;transition:border-color .2s;}
.match-search::placeholder{color:var(--muted);}
.match-search:focus{border-color:rgba(255,215,0,0.4);box-shadow:0 0 20px rgba(255,215,0,0.1);}
.filter-tabs{display:flex;gap:.5rem;flex-wrap:wrap;margin-bottom:1.25rem;}
.ftab{padding:.35rem .85rem;border-radius:20px;border:1px solid var(--border);background:transparent;color:var(--muted);font-size:.75rem;cursor:pointer;font-family:'Instrument Sans',sans-serif;transition:all .2s;}
.ftab.active,.ftab:hover{border-color:var(--gold);color:var(--gold);background:rgba(255,215,0,0.12);box-shadow:0 0 15px rgba(255,215,0,0.15);}
.match-list{display:flex;flex-direction:column;gap:.65rem;max-height:380px;overflow-y:auto;padding-right:4px;}
.match-list::-webkit-scrollbar{width:4px;}
.match-list::-webkit-scrollbar-thumb{background:rgba(255,215,0,0.3);border-radius:2px;}
.match-item{display:flex;align-items:center;gap:1rem;padding:.9rem 1rem;background:var(--navy3);border:1px solid var(--border);border-radius:10px;cursor:pointer;transition:all .2s cubic-bezier(0.16,1,0.3,1);}
.match-item:hover{border-color:rgba(255,215,0,0.3);box-shadow:0 0 20px rgba(255,215,0,0.1);}
.match-item.selected{border-color:var(--gold);background:rgba(255,215,0,0.08);box-shadow:0 0 25px rgba(255,215,0,0.15);}
.match-item .teams{flex:1;}
.match-item .teams strong{font-size:.95rem;display:block;}
.match-item .teams span{font-size:.72rem;color:var(--muted);margin-top:2px;display:block;}
.match-item .stage-badge{font-size:.65rem;padding:.25rem .6rem;border-radius:20px;border:1px solid var(--border);color:var(--muted);white-space:nowrap;}
.match-item .flag-pair{display:flex;align-items:center;gap:4px;}
.match-item .flag-pair img{width:28px;height:20px;object-fit:cover;border-radius:2px;}
.match-item .vs{font-size:.65rem;color:var(--muted);}
 
/* Map zone styles */
.r2zone{border-radius:8px;padding:6px;display:flex;flex-direction:column;gap:3px;flex:1;}
.r2zname{font-size:6.5px;letter-spacing:1px;text-align:center;font-weight:500;text-transform:uppercase;margin-bottom:2px;}
.r2grid{display:flex;flex-direction:column;gap:3px;}
.r2row{display:flex;flex-direction:row;gap:3px;justify-content:center;}
.z-vip{background:rgba(220,38,38,0.07);border:1px solid rgba(220,38,38,0.2);}
.z-vip .r2zname{color:#f87171;}
.z-vipc{background:rgba(234,179,8,0.07);border:1px solid rgba(234,179,8,0.25);}
.z-vipc .r2zname{color:#fcd34d;}
.z-high{background:rgba(20,184,166,0.07);border:1px solid rgba(20,184,166,0.2);}
.z-high .r2zname{color:#2dd4bf;}
.z-seat{background:rgba(59,130,246,0.07);border:1px solid rgba(59,130,246,0.2);}
.z-seat .r2zname{color:#60a5fa;}
.z-midseat{background:rgba(168,85,247,0.07);border:1px solid rgba(168,85,247,0.2);}
.z-midseat .r2zname{color:#c084fc;}
 
/* Couch & table styles */
.cu{display:inline-flex;align-items:center;gap:1px;cursor:pointer;padding:2px;border-radius:4px;transition:transform 0.12s;}
.cu:hover,.cu.sel{transform:scale(1.12);z-index:10;filter:brightness(1.3);}
.sofa-big{width:6px;height:22px;border-radius:3px;border:1.5px solid;overflow:hidden;display:flex;flex-direction:column;padding:1px;gap:1px;}
.sofa-big-back{width:100%;height:5px;border-radius:1px;opacity:0.8;}
.sofa-big-seat{width:100%;flex:1;border-radius:1px;opacity:0.4;}
.ctbl-wrap{display:flex;flex-direction:column;align-items:center;gap:1px;}
.sofa-small{width:11px;height:4px;border-radius:2px 2px 1px 1px;border:1.5px solid;opacity:0.75;}
.ctbl{width:11px;height:15px;border-radius:2px;border:1.5px solid;}
.tu{display:inline-flex;align-items:center;gap:1px;cursor:pointer;padding:1px;border-radius:3px;transition:transform 0.12s;}
.tu:hover,.tu.sel{transform:scale(1.15);z-index:10;filter:brightness(1.3);}
.chairs-side{display:flex;flex-direction:column;gap:2px;}
.chair{width:5px;height:6px;border-radius:1.5px;border:1.5px solid;opacity:0.7;}
.tbl-top{width:13px;height:17px;border-radius:2px;border:1.5px solid;}
.su{width:10px;height:10px;border-radius:2px;border:1.5px solid;cursor:pointer;transition:transform 0.12s;}
.su:hover,.su.sel{transform:scale(1.25);filter:brightness(1.3);}
.tech-cell{width:13px;height:17px;border-radius:2px;background:rgba(100,116,139,0.08);border:1px dashed rgba(100,116,139,0.2);}
 
.qty-wrap{display:flex;flex-direction:column;gap:1.25rem;}
.qty-info-card{background:var(--navy3);border:1px solid var(--border);border-radius:12px;padding:1.1rem 1.25rem;display:flex;gap:1rem;align-items:center;}
.qty-control{display:flex;align-items:center;gap:1.5rem;justify-content:center;padding:1.5rem 0;}
.qty-btn{width:48px;height:48px;border-radius:50%;border:1.5px solid rgba(255,215,0,0.4);background:rgba(255,215,0,0.12);color:var(--gold);font-size:1.4rem;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .2s;}
.qty-btn:hover{background:rgba(255,215,0,0.2);box-shadow:0 0 20px rgba(255,215,0,0.2);}
.qty-btn:disabled{opacity:.3;cursor:not-allowed;}
.qty-num{font-family:'Bebas Neue',sans-serif;font-size:3.5rem;color:var(--gold);min-width:80px;text-align:center;line-height:1;text-shadow:0 0 25px rgba(255,215,0,0.4);}
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:1rem;}
.form-group{display:flex;flex-direction:column;gap:.45rem;}
.form-group label{font-size:.78rem;color:var(--muted);letter-spacing:.04em;text-transform:uppercase;}
.form-group input{padding:.75rem 1rem;background:var(--navy3);border:1px solid var(--border);border-radius:10px;color:var(--white);font-family:'Instrument Sans',sans-serif;font-size:.9rem;outline:none;transition:border-color .2s;width:100%;}
.form-group input::placeholder{color:var(--muted);}
.form-group input:focus{border-color:rgba(255,215,0,0.45);box-shadow:0 0 20px rgba(255,215,0,0.1);}
.payment-info{background:var(--navy3);border:1px solid rgba(255,215,0,0.2);border-radius:14px;padding:1.4rem 1.5rem;margin-bottom:1.25rem;}
.payment-info h3{font-family:'Bebas Neue',sans-serif;font-size:1.1rem;letter-spacing:.05em;margin-bottom:.75rem;color:var(--gold);text-shadow:0 0 15px rgba(255,215,0,0.3);}
.pay-step{display:flex;gap:.85rem;padding:.6rem 0;border-bottom:1px solid var(--border);font-size:.85rem;align-items:flex-start;}
.pay-step:last-child{border-bottom:none;}
.pay-step .n{font-family:'Bebas Neue',sans-serif;font-size:1.1rem;color:var(--gold);flex-shrink:0;width:20px;}
.pay-step .t{line-height:1.5;}
.pay-step .t span{color:var(--muted);font-size:.8rem;display:block;}
.whish-logo{display:flex;align-items:center;gap:.6rem;padding:1rem 1.25rem;background:rgba(255,215,0,0.06);border:1px solid rgba(255,215,0,0.2);border-radius:10px;margin-bottom:1rem;}
.whish-logo .wico{font-size:1.8rem;}
.whish-logo p{font-size:.8rem;color:var(--muted);line-height:1.4;}
.whish-logo p strong{color:var(--white);font-size:.95rem;display:block;}
.ref-input-wrap{display:flex;flex-direction:column;gap:.45rem;}
.ref-input-wrap label{font-size:.78rem;color:var(--muted);letter-spacing:.04em;text-transform:uppercase;}
.ref-input-wrap input{padding:.75rem 1rem;background:var(--navy3);border:1px solid var(--border);border-radius:10px;color:var(--white);font-family:'Instrument Sans',sans-serif;font-size:.9rem;outline:none;transition:border-color .2s;}
.ref-input-wrap input:focus{border-color:rgba(255,215,0,0.45);box-shadow:0 0 20px rgba(255,215,0,0.1);}
.order-summary{background:var(--navy3);border:1px solid rgba(255,215,0,0.15);border-radius:12px;padding:1.1rem 1.25rem;margin-bottom:1.25rem;}
.order-summary h4{font-family:'Bebas Neue',sans-serif;font-size:1rem;letter-spacing:.05em;color:var(--gold);margin-bottom:.85rem;text-shadow:0 0 15px rgba(255,215,0,0.3);}
.os-row{display:flex;justify-content:space-between;font-size:.82rem;padding:.35rem 0;border-bottom:1px solid var(--border);}
.os-row:last-child{border-bottom:none;}
.os-row .k{color:var(--muted);}
.os-row .v{font-weight:600;}
.confirm-wrap{text-align:center;padding:1rem 0;}
.confirm-icon{font-size:3.5rem;margin-bottom:1rem;display:block;}
.confirm-wrap h2{font-family:'Bebas Neue',sans-serif;font-size:2rem;letter-spacing:.05em;color:var(--gold);margin-bottom:.5rem;text-shadow:0 0 30px rgba(255,215,0,0.4);}
.confirm-wrap p{color:var(--muted);font-size:.88rem;line-height:1.6;max-width:400px;margin:0 auto 1.5rem;}
.qr-placeholder{width:160px;height:160px;background:var(--white);border-radius:12px;margin:0 auto 1.5rem;display:flex;align-items:center;justify-content:center;font-size:.7rem;color:#111;text-align:center;padding:.5rem;}
.booking-code{font-family:'Bebas Neue',sans-serif;font-size:1.8rem;letter-spacing:.2em;color:var(--gold);background:rgba(255,215,0,0.08);border:1px solid rgba(255,215,0,0.3);border-radius:10px;padding:.6rem 1.5rem;display:inline-block;margin-bottom:1.5rem;box-shadow:0 0 30px rgba(255,215,0,0.15);}
.confirm-details{background:var(--navy3);border:1px solid var(--border);border-radius:12px;padding:1rem 1.25rem;text-align:left;margin-bottom:1.5rem;}
.confirm-details .cd-row{display:flex;justify-content:space-between;font-size:.82rem;padding:.35rem 0;border-bottom:1px solid var(--border);}
.confirm-details .cd-row:last-child{border-bottom:none;}
.confirm-details .cd-row .k{color:var(--muted);}
.confirm-details .cd-row .v{font-weight:600;}
.step-nav{display:flex;gap:.75rem;margin-top:1.75rem;}
.btn-back{padding:.8rem 1.5rem;border:1px solid var(--border);background:transparent;color:var(--muted);border-radius:10px;font-family:'Instrument Sans',sans-serif;font-size:.9rem;cursor:pointer;transition:all .2s;}
.btn-back:hover{border-color:rgba(255,255,255,0.25);color:var(--white);}
.btn-next{flex:1;padding:.85rem;background:var(--gold);color:#0B1220;border:none;border-radius:10px;font-family:'Bebas Neue',sans-serif;font-size:1.05rem;letter-spacing:.1em;cursor:pointer;transition:all .2s cubic-bezier(0.16,1,0.3,1);box-shadow:0 0 25px rgba(255,215,0,0.3);}
.btn-next:hover{box-shadow:0 0 40px rgba(255,215,0,0.55);transform:translateY(-1px);}
.btn-next:active{transform:scale(0.98);}
.btn-next:disabled{opacity:.4;cursor:not-allowed;transform:none;box-shadow:none;}
.alert-err{background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);border-radius:8px;padding:.7rem 1rem;font-size:.8rem;color:#f87171;margin-top:.75rem;display:none;}
.tt{position:fixed;background:#1a2535;color:#fff;font-size:9px;padding:3px 8px;border-radius:4px;pointer-events:none;z-index:9999;display:none;white-space:nowrap;border:1px solid rgba(255,255,255,0.1);}
 
@media(max-width:768px){
    nav{padding:15px 20px;flex-wrap:wrap;gap:8px;}
    .nav-hamburger{display:block;}
    .nav-btn{display:none;}
    .nav-links{display:none;flex-direction:column;width:100%;gap:12px;padding:15px 0 5px;border-top:1px solid rgba(255,255,255,0.08);}
    .nav-links.open{display:flex;}
    .form-grid{grid-template-columns:1fr;}
    .res-card-header,.res-card-body{padding:1.25rem;}
}
</style>
@endsection
 
@section('content')
 
<nav>
    <a href="/" class="nav-logo">MINIEH <span>FAN ZONE</span></a>
    <ul class="nav-links" id="nav-links">
        <li><a href="/">Home</a></li>
        <li><a href="/matches">Matches</a></li>
        <li><a href="/tickets">Tickets</a></li>
        <li><a href="/venue">Venue</a></li>
        <li><a href="/about">About</a></li>
    </ul>
    <a href="/reserve" class="nav-btn">🎟️ Reserve Now</a>
    <button class="nav-hamburger" onclick="toggleNav()">☰</button>
</nav>
 
<div class="res-header">
    <p class="eye">Minieh Fan Zone 2026</p>
    <h1>Reserve Your Spot</h1>
    <p>Secure your seat in 6 easy steps. Takes less than 3 minutes.</p>
</div>
 
<div class="progress-wrap">
    <div class="progress-steps">
        <div class="step-item active" id="prog-1"><div class="step-dot">1</div><div class="step-lbl">Match</div></div>
        <div class="step-item" id="prog-2"><div class="step-dot">2</div><div class="step-lbl">Spot</div></div>
        <div class="step-item" id="prog-3"><div class="step-dot">3</div><div class="step-lbl">Quantity</div></div>
        <div class="step-item" id="prog-4"><div class="step-dot">4</div><div class="step-lbl">Your Info</div></div>
        <div class="step-item" id="prog-5"><div class="step-dot">5</div><div class="step-lbl">Payment</div></div>
        <div class="step-item" id="prog-6"><div class="step-dot">✓</div><div class="step-lbl">Confirmed</div></div>
    </div>
</div>
 
<div class="res-body">
<div class="res-card">
 
<!-- STEP 1: Match -->
<div class="step-panel active" id="step-1">
    <div class="res-card-header">
        <div class="step-num-big">1</div>
        <div><h2>Select a Match</h2><p>Choose the match you want to attend</p></div>
    </div>
    <div class="res-card-body">
        <input type="text" class="match-search" id="match-search" placeholder="Search by team name or date…" oninput="filterMatches()">
        <div class="filter-tabs">
            <button class="ftab active" onclick="setStageFilter('all',this)">All</button>
            <button class="ftab" onclick="setStageFilter('Group Stage',this)">Group Stage</button>
            <button class="ftab" onclick="setStageFilter('Round of 32',this)">R32</button>
            <button class="ftab" onclick="setStageFilter('Round of 16',this)">R16</button>
            <button class="ftab" onclick="setStageFilter('Quarter Final',this)">QF</button>
            <button class="ftab" onclick="setStageFilter('Semi Final',this)">SF</button>
            <button class="ftab" onclick="setStageFilter('Final',this)">Final</button>
        </div>
        <div class="match-list" id="match-list"></div>
        <div class="alert-err" id="err-1">Please select a match to continue.</div>
        <div class="step-nav">
            <button class="btn-next" onclick="goStep(2)">Continue → Choose Your Spot</button>
        </div>
    </div>
</div>
 
<!-- STEP 2: Interactive Map -->
<div class="step-panel" id="step-2">
    <div class="res-card-header">
        <div class="step-num-big">2</div>
        <div><h2>Choose Your Spot</h2><p>Click your exact table or seat on the map</p></div>
    </div>
    <div class="res-card-body" style="padding:1rem;">
        <div style="display:flex;flex-direction:column;gap:5px;">
            <div style="background:linear-gradient(90deg,#1565C0,#1E88FF);color:#fff;text-align:center;padding:8px;border-radius:7px;font-size:9px;letter-spacing:3px;font-weight:500;">▶ GIANT LED SCREEN — ABOVE THE SEA</div>
            <div style="background:#0d1520;border:1px solid rgba(255,215,0,0.35);text-align:center;padding:5px;border-radius:5px;font-size:8px;color:#FFD700;letter-spacing:2px;">🎬 STAGE & CATWALK</div>
            <div style="display:flex;gap:0;align-items:stretch;">
                <div style="writing-mode:vertical-rl;transform:rotate(180deg);font-size:7px;color:rgba(255,255,255,0.3);letter-spacing:2px;text-transform:uppercase;padding:4px 3px;display:flex;align-items:center;justify-content:center;min-width:16px;">VIP L4</div>
                <div style="flex:1;display:flex;gap:4px;">
                    <div class="r2zone z-vip"><div class="r2zname">VIP Left (15)</div><div class="r2grid" id="r2-vtl"></div></div>
                    <div class="r2zone z-vipc"><div class="r2zname">VIP Mid Left (11)</div><div class="r2grid" id="r2-vml"></div></div>
                    <div class="r2zone z-vipc"><div class="r2zname">VIP Mid Right (11)</div><div class="r2grid" id="r2-vmr"></div></div>
                    <div class="r2zone z-vip"><div class="r2zname">VIP Right (15)</div><div class="r2grid" id="r2-vtr"></div></div>
                </div>
            </div>
            <div style="display:flex;gap:0;align-items:stretch;">
                <div style="writing-mode:vertical-rl;transform:rotate(180deg);font-size:7px;color:rgba(255,255,255,0.3);letter-spacing:2px;text-transform:uppercase;padding:4px 3px;display:flex;align-items:center;justify-content:center;min-width:16px;">Tables L3</div>
                <div style="flex:1;display:flex;gap:4px;">
                    <div class="r2zone z-high"><div class="r2zname">Left (42)</div><div class="r2grid" id="r2-tl"></div></div>
                    <div class="r2zone z-high"><div class="r2zname">Mid Left (28)</div><div class="r2grid" id="r2-tml"></div></div>
                    <div class="r2zone z-high"><div class="r2zname">Mid Right (30)</div><div class="r2grid" id="r2-tmr"></div></div>
                    <div class="r2zone z-high"><div class="r2zname">Right (42)</div><div class="r2grid" id="r2-tr"></div></div>
                </div>
            </div>
            <div style="display:flex;gap:0;align-items:stretch;">
                <div style="writing-mode:vertical-rl;transform:rotate(180deg);font-size:7px;color:rgba(255,255,255,0.3);letter-spacing:2px;text-transform:uppercase;padding:4px 3px;display:flex;align-items:center;justify-content:center;min-width:16px;">Seats L1</div>
                <div style="flex:1;display:flex;gap:4px;">
                    <div class="r2zone z-seat"><div class="r2zname">Left (60)</div><div class="r2grid" id="r2-sl"></div></div>
                    <div class="r2zone z-midseat"><div class="r2zname">Mid Left (21)</div><div class="r2grid" id="r2-sml"></div></div>
                    <div class="r2zone z-midseat"><div class="r2zname">Mid Right (21)</div><div class="r2grid" id="r2-smr"></div></div>
                    <div class="r2zone z-seat"><div class="r2zname">Right (60)</div><div class="r2grid" id="r2-sr"></div></div>
                </div>
            </div>
            <div style="background:#0a1018;border:1.5px solid rgba(255,215,0,0.5);text-align:center;padding:8px;border-radius:7px;font-size:9px;color:#FFD700;letter-spacing:2px;">STAGE 14 × 3.6m</div>
        </div>
        <div id="r2-selected-info" style="display:none;margin-top:10px;padding:10px 14px;background:rgba(255,215,0,0.08);border:1px solid rgba(255,215,0,0.3);border-radius:8px;font-size:13px;">
            ✅ Selected: <strong id="r2-selected-label" style="color:#FFD700;"></strong>
        </div>
        <div class="alert-err" id="err-2">Please select a table or seat to continue.</div>
        <div class="step-nav">
            <button class="btn-back" onclick="goStep(1)">← Back</button>
            <button class="btn-next" onclick="goStep(3)">Continue → Choose Quantity</button>
        </div>
    </div>
</div>
 
<!-- STEP 3: Quantity -->
<div class="step-panel" id="step-3">
    <div class="res-card-header">
        <div class="step-num-big">3</div>
        <div><h2>How Many?</h2><p>Select the number of people attending</p></div>
    </div>
    <div class="res-card-body">
        <div class="qty-wrap">
            <div class="qty-info-card">
                <div style="font-size:1.5rem;flex-shrink:0">ℹ️</div>
                <p id="qty-section-note" style="font-size:.82rem;color:var(--muted);line-height:1.5">Select quantity below.</p>
            </div>
            <div class="qty-control">
                <button class="qty-btn" id="qty-minus" onclick="changeQty(-1)">−</button>
                <div class="qty-num" id="qty-display">1</div>
                <button class="qty-btn" id="qty-plus" onclick="changeQty(1)">+</button>
            </div>
            <div class="order-summary">
                <h4>Summary</h4>
                <div class="os-row"><span class="k">Match</span><span class="v" id="os-match">—</span></div>
                <div class="os-row"><span class="k">Spot</span><span class="v" id="os-section">—</span></div>
                <div class="os-row"><span class="k">Quantity</span><span class="v" id="os-qty">—</span></div>
            </div>
        </div>
        <div class="step-nav">
            <button class="btn-back" onclick="goStep(2)">← Back</button>
            <button class="btn-next" onclick="goStep(4)">Continue → Your Info</button>
        </div>
    </div>
</div>
 
<!-- STEP 4: Info -->
<div class="step-panel" id="step-4">
    <div class="res-card-header">
        <div class="step-num-big">4</div>
        <div><h2>Your Information</h2><p>We'll use this to send your ticket</p></div>
    </div>
    <div class="res-card-body">
        <div style="display:flex;flex-direction:column;gap:1rem;">
            <div class="form-grid">
                <div class="form-group"><label>First Name</label><input type="text" id="f-fname" placeholder="Ali"></div>
                <div class="form-group"><label>Last Name</label><input type="text" id="f-lname" placeholder="Youssef"></div>
            </div>
            <div class="form-group"><label>Phone Number</label><input type="tel" id="f-phone" placeholder="+961 71 000 000"></div>
            <div class="form-group"><label>Email Address</label><input type="email" id="f-email" placeholder="ali@example.com"></div>
        </div>
        <div class="alert-err" id="err-4">Please fill in all fields correctly.</div>
        <div class="step-nav">
            <button class="btn-back" onclick="goStep(3)">← Back</button>
            <button class="btn-next" onclick="goStep(5)">Continue → Payment</button>
        </div>
    </div>
</div>
 
<!-- STEP 5: Payment -->
<div class="step-panel" id="step-5">
    <div class="res-card-header">
        <div class="step-num-big">5</div>
        <div><h2>Payment</h2><p>Pay securely via WhishMoney</p></div>
    </div>
    <div class="res-card-body">
        <div class="order-summary" style="margin-bottom:1.25rem;">
            <h4>Order Summary</h4>
            <div class="os-row"><span class="k">Match</span><span class="v" id="pay-match">—</span></div>
            <div class="os-row"><span class="k">Spot</span><span class="v" id="pay-section">—</span></div>
            <div class="os-row"><span class="k">Quantity</span><span class="v" id="pay-qty">—</span></div>
            <div class="os-row"><span class="k">Name</span><span class="v" id="pay-name">—</span></div>
        </div>
        <div class="whish-logo">
            <div class="wico">💳</div>
            <div><p><strong>WhishMoney</strong>Lebanon's trusted mobile payment platform</p><p>Transfer to the account shown below, then paste your reference number.</p></div>
        </div>
        <div class="payment-info">
            <h3>How to Pay</h3>
            <div class="pay-step"><div class="n">1</div><div class="t">Open your <strong>WhishMoney</strong> app and tap <em>Send Money</em><span>Make sure you have sufficient balance</span></div></div>
            <div class="pay-step"><div class="n">2</div><div class="t">Send the exact amount to: <strong>+961 XX XXX XXX</strong><span>Account name: Minieh Fan Zone 2026</span></div></div>
            <div class="pay-step"><div class="n">3</div><div class="t">Copy the <strong>Transaction Reference Number</strong> from the app<span>It looks like: WM-2026-XXXXXXXX</span></div></div>
            <div class="pay-step"><div class="n">4</div><div class="t">Paste it below and click <strong>Confirm Reservation</strong><span>Our team will verify and send your QR ticket within 30 minutes</span></div></div>
        </div>
        <div class="ref-input-wrap">
            <label>WhishMoney Transaction Reference</label>
            <input type="text" id="f-ref" placeholder="e.g. WM-2026-12345678">
        </div>
        <div class="alert-err" id="err-5">Please enter your WhishMoney transaction reference.</div>
        <div class="step-nav">
            <button class="btn-back" onclick="goStep(4)">← Back</button>
            <button class="btn-next" id="confirm-btn" onclick="submitReservation()">Confirm Reservation →</button>
        </div>
    </div>
</div>
 
<!-- STEP 6: Confirmation -->
<div class="step-panel" id="step-6">
    <div class="res-card-header">
        <div class="step-num-big" style="background:rgba(34,197,94,0.12);border-color:rgba(34,197,94,0.3);color:#4ade80;">✓</div>
        <div><h2>Reservation Received!</h2><p>We'll verify your payment and send your ticket</p></div>
    </div>
    <div class="res-card-body">
        <div class="confirm-wrap">
            <span class="confirm-icon">🎉</span>
            <h2>You're All Set!</h2>
            <p>Your reservation has been submitted. Once we verify your WhishMoney payment, your digital QR ticket will be sent to your email and phone.</p>
            <div class="qr-placeholder"><span>QR ticket will appear here after payment verification</span></div>
            <div class="booking-code" id="conf-booking-code">MFZ-000000</div>
            <div class="confirm-details">
                <div class="cd-row"><span class="k">Match</span><span class="v" id="conf-match">—</span></div>
                <div class="cd-row"><span class="k">Spot</span><span class="v" id="conf-section">—</span></div>
                <div class="cd-row"><span class="k">Quantity</span><span class="v" id="conf-qty">—</span></div>
                <div class="cd-row"><span class="k">Name</span><span class="v" id="conf-name">—</span></div>
                <div class="cd-row"><span class="k">Email</span><span class="v" id="conf-email">—</span></div>
                <div class="cd-row"><span class="k">Phone</span><span class="v" id="conf-phone">—</span></div>
                <div class="cd-row"><span class="k">Payment Ref</span><span class="v" id="conf-ref">—</span></div>
                <div class="cd-row"><span class="k">Status</span><span class="v" style="color:#facc15;">⏳ Pending Verification</span></div>
            </div>
            <p style="font-size:.78rem;color:var(--muted);line-height:1.6;">Questions? WhatsApp us at <strong style="color:var(--white);">+961 XX XXX XXX</strong></p>
        </div>
    </div>
</div>
 
</div>
</div>
 
<div class="tt" id="tt"></div>
 
<script>
function toggleNav(){document.getElementById('nav-links').classList.toggle('open');}
 
const MATCHES=[
    {id:1,teamA:'Mexico',teamB:'Ecuador',codeA:'mx',codeB:'ec',date:'Jun 11',time:'19:00',stage:'Group Stage'},
    {id:2,teamA:'USA',teamB:'Canada',codeA:'us',codeB:'ca',date:'Jun 12',time:'22:00',stage:'Group Stage'},
    {id:3,teamA:'Argentina',teamB:'TBD',codeA:'ar',codeB:'',date:'Jun 12',time:'13:00',stage:'Group Stage'},
    {id:4,teamA:'Brazil',teamB:'TBD',codeA:'br',codeB:'',date:'Jun 13',time:'13:00',stage:'Group Stage'},
    {id:5,teamA:'France',teamB:'TBD',codeA:'fr',codeB:'',date:'Jun 13',time:'19:00',stage:'Group Stage'},
    {id:6,teamA:'Spain',teamB:'TBD',codeA:'es',codeB:'',date:'Jun 14',time:'13:00',stage:'Group Stage'},
    {id:7,teamA:'Germany',teamB:'TBD',codeA:'de',codeB:'',date:'Jun 14',time:'19:00',stage:'Group Stage'},
    {id:8,teamA:'England',teamB:'TBD',codeA:'gb-eng',codeB:'',date:'Jun 15',time:'22:00',stage:'Group Stage'},
    {id:9,teamA:'Portugal',teamB:'TBD',codeA:'pt',codeB:'',date:'Jun 15',time:'13:00',stage:'Group Stage'},
    {id:10,teamA:'Netherlands',teamB:'TBD',codeA:'nl',codeB:'',date:'Jun 16',time:'19:00',stage:'Group Stage'},
    {id:50,teamA:'TBD',teamB:'TBD',codeA:'',codeB:'',date:'Jul 01',time:'19:00',stage:'Round of 32'},
    {id:51,teamA:'TBD',teamB:'TBD',codeA:'',codeB:'',date:'Jul 02',time:'19:00',stage:'Round of 32'},
    {id:60,teamA:'TBD',teamB:'TBD',codeA:'',codeB:'',date:'Jul 08',time:'19:00',stage:'Round of 16'},
    {id:61,teamA:'TBD',teamB:'TBD',codeA:'',codeB:'',date:'Jul 09',time:'19:00',stage:'Round of 16'},
    {id:62,teamA:'TBD',teamB:'TBD',codeA:'',codeB:'',date:'Jul 14',time:'21:00',stage:'Quarter Final'},
    {id:63,teamA:'TBD',teamB:'TBD',codeA:'',codeB:'',date:'Jul 18',time:'21:00',stage:'Semi Final'},
    {id:64,teamA:'TBD',teamB:'TBD',codeA:'',codeB:'',date:'Jul 22',time:'21:00',stage:'Final'},
];
 
const SECTION_MAX={'VIP Left':6,'VIP Right':6,'VIP Mid Left':6,'VIP Mid Right':6,'Tables Left':4,'Tables Right':4,'Mid Left Tables':4,'Mid Right Tables':4,'Left Seats':1,'Right Seats':1,'Mid Left Seats':1,'Mid Right Seats':1};
let state={step:1,matchId:null,matchLabel:'',section:null,sectionType:'',sectionCap:'',qty:1,fname:'',lname:'',phone:'',email:'',ref:''};
let stageFilter='all';
 
function goStep(n){
    if(n>state.step){
        if(state.step===1&&!state.matchId){showErr('err-1');return;}
        if(state.step===2&&!state.section){showErr('err-2');return;}
        if(state.step===4&&!validateInfo()){showErr('err-4');return;}
    }
    hideAllErrs();
    for(let i=1;i<=6;i++){
        const el=document.getElementById('prog-'+i);
        el.classList.remove('active','done');
        if(i<n)el.classList.add('done');
        if(i===n)el.classList.add('active');
    }
    document.querySelectorAll('.step-panel').forEach(p=>p.classList.remove('active'));
    document.getElementById('step-'+n).classList.add('active');
    state.step=n;
    if(n===3)updateQtySummary();
    if(n===5)updatePaySummary();
    window.scrollTo({top:0,behavior:'smooth'});
}
 
function renderMatches(){
    const q=document.getElementById('match-search').value.toLowerCase();
    const list=document.getElementById('match-list');
    const filtered=MATCHES.filter(m=>{
        const ms=stageFilter==='all'||m.stage===stageFilter;
        const mq=!q||m.teamA.toLowerCase().includes(q)||m.teamB.toLowerCase().includes(q)||m.date.toLowerCase().includes(q);
        return ms&&mq;
    });
    if(!filtered.length){list.innerHTML='<div style="text-align:center;padding:2rem;color:var(--muted);font-size:.85rem;">No matches found</div>';return;}
    list.innerHTML=filtered.map(m=>`
        <div class="match-item ${state.matchId===m.id?'selected':''}" onclick="pickMatch(${m.id},'${m.teamA} vs ${m.teamB} · ${m.date}')">
            <div class="flag-pair">
                ${m.codeA?`<img src="https://flagcdn.com/w40/${m.codeA}.png" alt="${m.teamA}">`:'<div style="width:28px;height:20px;background:#1a2540;border-radius:2px;"></div>'}
                <span class="vs">vs</span>
                ${m.codeB?`<img src="https://flagcdn.com/w40/${m.codeB}.png" alt="${m.teamB}">`:'<div style="width:28px;height:20px;background:#1a2540;border-radius:2px;"></div>'}
            </div>
            <div class="teams">
                <strong>${m.teamA} <span style="color:var(--muted);font-weight:400;">vs</span> ${m.teamB}</strong>
                <span>${m.date} · ${m.time} · ${m.stage}</span>
            </div>
            <div class="stage-badge">${m.stage}</div>
        </div>
    `).join('');
}
 
function pickMatch(id,label){state.matchId=id;state.matchLabel=label;renderMatches();}
function filterMatches(){renderMatches();}
function setStageFilter(val,el){
    stageFilter=val;
    document.querySelectorAll('.ftab').forEach(t=>t.classList.remove('active'));
    el.classList.add('active');
    renderMatches();
}
 
function changeQty(d){
    const isSeat=state.sectionType&&state.sectionType.includes('Seats');
    const max=isSeat?1:6;
    const newQty=state.qty+d;
    if(newQty<1||newQty>max)return;
    state.qty=newQty;
    document.getElementById('qty-display').textContent=state.qty;
    document.getElementById('qty-minus').disabled=state.qty<=1;
    document.getElementById('qty-plus').disabled=state.qty>=max;
    updateQtySummary();
}
 
function updateQtySummary(){
    document.getElementById('os-match').textContent=state.matchLabel||'—';
    document.getElementById('os-section').textContent=state.section||'—';
    document.getElementById('os-qty').textContent=state.qty+' person(s)';
    document.getElementById('qty-minus').disabled=state.qty<=1;
    const isSeat=state.sectionType&&state.sectionType.includes('Seats');
    document.getElementById('qty-plus').disabled=state.qty>=(isSeat?1:6);
}
 
function validateInfo(){
    const fn=document.getElementById('f-fname').value.trim();
    const ln=document.getElementById('f-lname').value.trim();
    const ph=document.getElementById('f-phone').value.trim();
    const em=document.getElementById('f-email').value.trim();
    if(!fn||!ln||!ph||!em)return false;
    if(!em.includes('@'))return false;
    state.fname=fn;state.lname=ln;state.phone=ph;state.email=em;
    return true;
}
 
function updatePaySummary(){
    document.getElementById('pay-match').textContent=state.matchLabel;
    document.getElementById('pay-section').textContent=state.section;
    document.getElementById('pay-qty').textContent=state.qty+' person(s)';
    document.getElementById('pay-name').textContent=`${state.fname} ${state.lname}`;
}
 
function submitReservation(){
    const ref=document.getElementById('f-ref').value.trim();
    if(!ref){showErr('err-5');return;}
    state.ref=ref;
    hideAllErrs();
    const btn=document.getElementById('confirm-btn');
    btn.textContent='Submitting…';btn.disabled=true;
    fetch('/reserve/submit',{
        method:'POST',
        headers:{'Content-Type':'application/json','X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content},
        body:JSON.stringify({match_id:state.matchId,section:state.section,section_type:state.sectionType,quantity:state.qty,first_name:state.fname,last_name:state.lname,phone:state.phone,email:state.email,payment_ref:state.ref})
    })
    .then(r=>r.json())
    .then(data=>{
        if(data.success){showConfirmation(data.booking_code||'MFZ-'+Math.random().toString(36).substr(2,6).toUpperCase());}
        else{btn.textContent='Confirm Reservation →';btn.disabled=false;showErr('err-5');}
    })
    .catch(()=>{showConfirmation('MFZ-'+Math.random().toString(36).substr(2,6).toUpperCase());});
}
 
function showConfirmation(code){
    document.getElementById('conf-booking-code').textContent=code;
    document.getElementById('conf-match').textContent=state.matchLabel;
    document.getElementById('conf-section').textContent=state.section;
    document.getElementById('conf-qty').textContent=state.qty+' person(s)';
    document.getElementById('conf-name').textContent=`${state.fname} ${state.lname}`;
    document.getElementById('conf-email').textContent=state.email;
    document.getElementById('conf-phone').textContent=state.phone;
    document.getElementById('conf-ref').textContent=state.ref;
    goStep(6);
}
 
function showErr(id){document.getElementById(id).style.display='block';}
function hideAllErrs(){document.querySelectorAll('.alert-err').forEach(e=>e.style.display='none');}
 
// Step 2 map
const r2tt=document.getElementById('tt');
let r2sel=null;
function r2tip(e,t){r2tt.style.display='block';r2tt.textContent=t;r2tt.style.left=(e.clientX+10)+'px';r2tt.style.top=(e.clientY-20)+'px';}
function r2hide(){r2tt.style.display='none';}
 
function r2toggle(id,pax,label,color,el,sType){
    if(r2sel&&r2sel.el!==el){r2sel.el.classList.remove('sel');}
    if(r2sel&&r2sel.el===el){r2sel=null;el.classList.remove('sel');document.getElementById('r2-selected-info').style.display='none';state.section=null;state.sectionType='';return;}
    r2sel={id,pax,label,color,el,sType};
    el.classList.add('sel');
    state.section=id;
    state.sectionType=sType;
    state.sectionCap=pax+' pax';
    document.getElementById('r2-selected-label').textContent=label+' · '+pax+' pax';
    document.getElementById('r2-selected-info').style.display='block';
}
 
function r2makeCouch(id,sofaC,sofaS,tblC,tblS,sType){
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
    u.addEventListener('mouseenter',e=>r2tip(e,id+' · 6 pax'));
    u.addEventListener('mousemove',e=>{r2tt.style.left=(e.clientX+10)+'px';r2tt.style.top=(e.clientY-20)+'px';});
    u.addEventListener('mouseleave',r2hide);
    u.addEventListener('click',()=>r2toggle(id,6,id,sofaS,u,sType));
    return u;
}
 
const TC='rgba(20,184,166,0.25)',TS='#14b8a6',CC='rgba(20,184,166,0.5)',CS='#0d9488';
const VC1='rgba(220,38,38,0.35)',VS1='#dc2626',VT1='rgba(90,10,10,0.4)',VTS1='#991b1b';
const VC2='rgba(234,179,8,0.35)',VS2='#eab308',VT2='rgba(90,60,0,0.4)',VTS2='#ca8a04';
 
function r2makeTable(id,tblC,tblS,chairC,chairS,sType){
    const u=document.createElement('div');u.className='tu';
    const cl=document.createElement('div');cl.className='chairs-side';
    for(let j=0;j<2;j++){const c=document.createElement('div');c.className='chair';c.style.cssText='background:'+chairC+';border-color:'+chairS;cl.appendChild(c);}
    const tb=document.createElement('div');tb.className='tbl-top';tb.style.cssText='background:'+tblC+';border-color:'+tblS;
    const cr=document.createElement('div');cr.className='chairs-side';
    for(let j=0;j<2;j++){const c=document.createElement('div');c.className='chair';c.style.cssText='background:'+chairC+';border-color:'+chairS;cr.appendChild(c);}
    u.appendChild(cl);u.appendChild(tb);u.appendChild(cr);
    u.addEventListener('mouseenter',e=>r2tip(e,id+' · 4 pax'));
    u.addEventListener('mousemove',e=>{r2tt.style.left=(e.clientX+10)+'px';r2tt.style.top=(e.clientY-20)+'px';});
    u.addEventListener('mouseleave',r2hide);
    u.addEventListener('click',()=>r2toggle(id,4,id,tblS,u,sType));
    return u;
}
 
function r2makeSeat(id,color,stroke,sType){
    const u=document.createElement('div');u.className='su';
    u.style.cssText='background:'+color+';border-color:'+stroke;
    u.addEventListener('mouseenter',e=>r2tip(e,id+' · 1 pax'));
    u.addEventListener('mousemove',e=>{r2tt.style.left=(e.clientX+10)+'px';r2tt.style.top=(e.clientY-20)+'px';});
    u.addEventListener('mouseleave',r2hide);
    u.addEventListener('click',()=>r2toggle(id,1,id,stroke,u,sType));
    return u;
}
 
function r2techCell(){const d=document.createElement('div');d.className='tech-cell';return d;}
 
function r2buildRowGrid(gridId,rows){
    const g=document.getElementById(gridId);if(!g)return;
    rows.forEach(rowItems=>{
        const r=document.createElement('div');r.className='r2row';
        rowItems.forEach(el=>{if(el)r.appendChild(el);});
        g.appendChild(r);
    });
}
 
let r2cn=0,r2tn=0,r2sn=0;
function R2C(p,sc,ss,tc,ts,st){r2cn++;return r2makeCouch(p+r2cn,sc,ss,tc,ts,st);}
function R2T(p,st){r2tn++;return r2makeTable(p+r2tn,TC,TS,CC,CS,st);}
function R2S(p,c,s,st){r2sn++;return r2makeSeat(p+r2sn,c,s,st);}
function nR2C(n,p,sc,ss,tc,ts,st){return Array.from({length:n},()=>R2C(p,sc,ss,tc,ts,st));}
function nR2T(n,p,st){return Array.from({length:n},()=>R2T(p,st));}
function nR2S(n,p,c,s,st){return Array.from({length:n},()=>R2S(p,c,s,st));}
 
function initR2Map(){
    r2cn=0;r2buildRowGrid('r2-vtl',[nR2C(5,'R2VTL',VC1,VS1,VT1,VTS1,'VIP Left'),nR2C(5,'R2VTL',VC1,VS1,VT1,VTS1,'VIP Left'),nR2C(5,'R2VTL',VC1,VS1,VT1,VTS1,'VIP Left')]);
    r2cn=0;r2buildRowGrid('r2-vtr',[nR2C(5,'R2VTR',VC1,VS1,VT1,VTS1,'VIP Right'),nR2C(5,'R2VTR',VC1,VS1,VT1,VTS1,'VIP Right'),nR2C(5,'R2VTR',VC1,VS1,VT1,VTS1,'VIP Right')]);
    r2cn=0;r2buildRowGrid('r2-vml',[nR2C(4,'R2VML',VC2,VS2,VT2,VTS2,'VIP Mid Left'),nR2C(4,'R2VML',VC2,VS2,VT2,VTS2,'VIP Mid Left'),nR2C(3,'R2VML',VC2,VS2,VT2,VTS2,'VIP Mid Left')]);
    r2cn=0;r2buildRowGrid('r2-vmr',[nR2C(4,'R2VMR',VC2,VS2,VT2,VTS2,'VIP Mid Right'),nR2C(4,'R2VMR',VC2,VS2,VT2,VTS2,'VIP Mid Right'),nR2C(3,'R2VMR',VC2,VS2,VT2,VTS2,'VIP Mid Right')]);
    r2tn=0;r2buildRowGrid('r2-tl',[nR2T(6,'R2TL','Tables Left'),nR2T(6,'R2TL','Tables Left'),nR2T(5,'R2TL','Tables Left'),nR2T(5,'R2TL','Tables Left'),nR2T(5,'R2TL','Tables Left'),nR2T(5,'R2TL','Tables Left'),nR2T(5,'R2TL','Tables Left'),nR2T(5,'R2TL','Tables Left')]);
    r2tn=0;r2buildRowGrid('r2-tr',[nR2T(6,'R2TR','Tables Right'),nR2T(6,'R2TR','Tables Right'),nR2T(5,'R2TR','Tables Right'),nR2T(5,'R2TR','Tables Right'),nR2T(5,'R2TR','Tables Right'),nR2T(5,'R2TR','Tables Right'),nR2T(5,'R2TR','Tables Right'),nR2T(5,'R2TR','Tables Right')]);
    r2tn=0;r2buildRowGrid('r2-tml',[nR2T(4,'R2TML','Mid Left Tables'),nR2T(4,'R2TML','Mid Left Tables'),nR2T(4,'R2TML','Mid Left Tables'),nR2T(4,'R2TML','Mid Left Tables'),nR2T(4,'R2TML','Mid Left Tables'),nR2T(4,'R2TML','Mid Left Tables'),[R2T('R2TML','Mid Left Tables'),r2techCell(),r2techCell()],[R2T('R2TML','Mid Left Tables'),R2T('R2TML','Mid Left Tables'),R2T('R2TML','Mid Left Tables')]]);
    r2tn=0;r2buildRowGrid('r2-tmr',[nR2T(4,'R2TMR','Mid Right Tables'),nR2T(4,'R2TMR','Mid Right Tables'),nR2T(4,'R2TMR','Mid Right Tables'),nR2T(4,'R2TMR','Mid Right Tables'),nR2T(4,'R2TMR','Mid Right Tables'),nR2T(4,'R2TMR','Mid Right Tables'),nR2T(3,'R2TMR','Mid Right Tables'),nR2T(3,'R2TMR','Mid Right Tables')]);
    r2sn=0;r2buildRowGrid('r2-sl',[nR2S(20,'R2SL','rgba(59,130,246,0.25)','#3b82f6','Left Seats'),nR2S(20,'R2SL','rgba(59,130,246,0.25)','#3b82f6','Left Seats'),nR2S(20,'R2SL','rgba(59,130,246,0.25)','#3b82f6','Left Seats')]);
    r2sn=0;r2buildRowGrid('r2-sr',[nR2S(20,'R2SR','rgba(59,130,246,0.25)','#3b82f6','Right Seats'),nR2S(20,'R2SR','rgba(59,130,246,0.25)','#3b82f6','Right Seats'),nR2S(20,'R2SR','rgba(59,130,246,0.25)','#3b82f6','Right Seats')]);
    r2sn=0;r2buildRowGrid('r2-sml',[nR2S(7,'R2SML','rgba(168,85,247,0.25)','#a855f7','Mid Left Seats'),nR2S(7,'R2SML','rgba(168,85,247,0.25)','#a855f7','Mid Left Seats'),nR2S(7,'R2SML','rgba(168,85,247,0.25)','#a855f7','Mid Left Seats')]);
    r2sn=0;r2buildRowGrid('r2-smr',[nR2S(7,'R2SMR','rgba(168,85,247,0.25)','#a855f7','Mid Right Seats'),nR2S(7,'R2SMR','rgba(168,85,247,0.25)','#a855f7','Mid Right Seats'),nR2S(7,'R2SMR','rgba(168,85,247,0.25)','#a855f7','Mid Right Seats')]);
}
 
document.addEventListener('DOMContentLoaded',()=>{
    renderMatches();
    initR2Map();
});
</script>
 
@endsection
 