@extends('layouts.app')

@section('title', 'Reserve Your Spot — Minieh Fan Zone 2026')

@section('styles')
<style>
:root {
    --navy:   #0B1220;
    --navy2:  #111827;
    --navy3:  #0d1728;
    --blue:   #1E88FF;
    --gold:   #FFD700;
    --white:  #FFFFFF;
    --muted:  rgba(255,255,255,0.45);
    --border: rgba(255,255,255,0.08);
}
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
body { background: var(--navy); color: var(--white); font-family: 'Instrument Sans', sans-serif; min-height: 100vh; }

nav {
    position: fixed; top: 0; left: 0; right: 0; z-index: 100;
    padding: 20px 60px; display: flex; align-items: center; justify-content: space-between;
    background: rgba(11,18,32,0.95); backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(30,136,255,0.15);
}
.nav-logo { font-family: 'Bebas Neue', sans-serif; font-size: 1.5rem; letter-spacing: 3px; color: var(--white); text-decoration: none; white-space: nowrap; }
.nav-logo span { color: var(--gold); }
.nav-links { display: flex; gap: 35px; list-style: none; }
.nav-links a { color: rgba(255,255,255,0.7); text-decoration: none; font-size: 0.85rem; font-weight: 600; letter-spacing: 2px; text-transform: uppercase; transition: color 0.3s; }
.nav-links a:hover, .nav-links a.active { color: var(--gold); }
.nav-btn { background: var(--blue); color: white; padding: 10px 25px; border-radius: 6px; font-size: 0.8rem; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; text-decoration: none; transition: all 0.3s; white-space: nowrap; }
.nav-btn:hover { background: var(--gold); color: var(--navy); }
.nav-hamburger { display: none; background: none; border: 1px solid rgba(255,255,255,0.2); color: var(--white); font-size: 1.3rem; cursor: pointer; padding: 6px 12px; border-radius: 6px; }

.res-header { text-align: center; padding: 5.5rem 1rem 2.5rem; background: linear-gradient(180deg,#060c17 0%,var(--navy) 100%); }
.res-header .eye { font-family:'Bebas Neue',sans-serif; letter-spacing:.3em; font-size:.78rem; color:var(--gold); margin-bottom:.5rem; }
.res-header h1 { font-family:'Bebas Neue',sans-serif; font-size:clamp(2.4rem,5vw,4rem); letter-spacing:.05em; line-height:1; margin-bottom:.6rem; }
.res-header p { color:var(--muted); font-size:.9rem; }

.progress-wrap { max-width:720px; margin:0 auto; padding:2rem 1.5rem 0; }
.progress-steps { display:flex; align-items:center; position:relative; }
.step-item { flex:1; display:flex; flex-direction:column; align-items:center; position:relative; }
.step-item:not(:last-child)::after { content:''; position:absolute; top:17px; left:50%; width:100%; height:2px; background:var(--border); z-index:0; transition:background .4s; }
.step-item.done:not(:last-child)::after { background:var(--gold); }
.step-dot { width:34px; height:34px; border-radius:50%; border:2px solid var(--border); display:flex; align-items:center; justify-content:center; font-family:'Bebas Neue',sans-serif; font-size:.85rem; color:var(--muted); background:var(--navy2); position:relative; z-index:1; transition:all .3s; }
.step-item.active .step-dot { border-color:var(--gold); color:var(--gold); box-shadow:0 0 0 4px rgba(255,215,0,0.12); }
.step-item.done .step-dot { border-color:var(--gold); background:var(--gold); color:#0B1220; }
.step-lbl { font-size:.62rem; color:var(--muted); margin-top:.4rem; letter-spacing:.04em; text-transform:uppercase; text-align:center; transition:color .3s; }
.step-item.active .step-lbl { color:var(--gold); }
.step-item.done .step-lbl { color:rgba(255,215,0,0.7); }

.res-body { max-width:720px; margin:2rem auto 6rem; padding:0 1.5rem; }
.res-card { background:var(--navy2); border:1px solid rgba(255,215,0,0.15); border-radius:18px; overflow:hidden; }
.res-card-header { padding:1.75rem 2rem 1.5rem; border-bottom:1px solid var(--border); display:flex; align-items:center; gap:1rem; }
.step-num-big { width:52px; height:52px; border-radius:12px; background:rgba(255,215,0,0.12); border:1px solid rgba(255,215,0,0.3); display:flex; align-items:center; justify-content:center; font-family:'Bebas Neue',sans-serif; font-size:1.6rem; color:var(--gold); flex-shrink:0; }
.res-card-header h2 { font-family:'Bebas Neue',sans-serif; font-size:1.5rem; letter-spacing:.05em; line-height:1.1; }
.res-card-header p { font-size:.8rem; color:var(--muted); margin-top:3px; }
.res-card-body { padding:1.75rem 2rem; }

.step-panel { display:none; }
.step-panel.active { display:block; }

.match-search { width:100%; padding:.75rem 1rem; background:var(--navy3); border:1px solid var(--border); border-radius:10px; color:var(--white); font-family:'Instrument Sans',sans-serif; font-size:.9rem; outline:none; margin-bottom:1.25rem; transition:border-color .2s; }
.match-search::placeholder { color:var(--muted); }
.match-search:focus { border-color:rgba(255,215,0,0.4); }

.filter-tabs { display:flex; gap:.5rem; flex-wrap:wrap; margin-bottom:1.25rem; }
.ftab { padding:.35rem .85rem; border-radius:20px; border:1px solid var(--border); background:transparent; color:var(--muted); font-size:.75rem; cursor:pointer; font-family:'Instrument Sans',sans-serif; transition:all .2s; }
.ftab.active, .ftab:hover { border-color:var(--gold); color:var(--gold); background:rgba(255,215,0,0.12); }

.match-list { display:flex; flex-direction:column; gap:.65rem; max-height:380px; overflow-y:auto; padding-right:4px; }
.match-list::-webkit-scrollbar { width:4px; }
.match-list::-webkit-scrollbar-thumb { background:rgba(255,215,0,0.3); border-radius:2px; }

.match-item { display:flex; align-items:center; gap:1rem; padding:.9rem 1rem; background:var(--navy3); border:1px solid var(--border); border-radius:10px; cursor:pointer; transition:all .2s; }
.match-item:hover { border-color:rgba(255,215,0,0.3); }
.match-item.selected { border-color:var(--gold); background:rgba(255,215,0,0.08); }
.match-item .teams { flex:1; }
.match-item .teams strong { font-size:.95rem; display:block; }
.match-item .teams span { font-size:.72rem; color:var(--muted); margin-top:2px; display:block; }
.match-item .stage-badge { font-size:.65rem; padding:.25rem .6rem; border-radius:20px; border:1px solid var(--border); color:var(--muted); white-space:nowrap; }
.match-item .flag-pair { display:flex; align-items:center; gap:4px; }
.match-item .flag-pair img { width:28px; height:20px; object-fit:cover; border-radius:2px; }
.match-item .vs { font-size:.65rem; color:var(--muted); }

.section-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:.75rem; }
.section-opt { padding:1.1rem .75rem; border-radius:12px; border:1.5px solid var(--border); background:var(--navy3); cursor:pointer; text-align:center; transition:all .25s; }
.section-opt:hover { border-color:rgba(255,215,0,0.35); }
.section-opt.selected { border-color:var(--gold); background:rgba(255,215,0,0.08); }
.section-opt .sec-letter { font-family:'Bebas Neue',sans-serif; font-size:2rem; line-height:1; }
.section-opt .sec-type { font-size:.7rem; color:var(--muted); margin:.3rem 0 .15rem; }
.section-opt .sec-cap { font-size:.68rem; color:rgba(255,215,0,0.6); }
.section-opt.vip .sec-letter { color:#9B4DCA; }
.section-opt.high .sec-letter { color:#1E88FF; }
.section-opt.std .sec-letter { color:#4CAF50; }
.section-opt.single .sec-letter { color:#FF9800; }

.qty-wrap { display:flex; flex-direction:column; gap:1.25rem; }
.qty-info-card { background:var(--navy3); border:1px solid var(--border); border-radius:12px; padding:1.1rem 1.25rem; display:flex; gap:1rem; align-items:center; }
.qty-control { display:flex; align-items:center; gap:1.5rem; justify-content:center; padding:1.5rem 0; }
.qty-btn { width:48px; height:48px; border-radius:50%; border:1.5px solid rgba(255,215,0,0.4); background:rgba(255,215,0,0.12); color:var(--gold); font-size:1.4rem; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:all .2s; }
.qty-btn:hover { background:rgba(255,215,0,0.2); }
.qty-btn:disabled { opacity:.3; cursor:not-allowed; }
.qty-num { font-family:'Bebas Neue',sans-serif; font-size:3.5rem; color:var(--gold); min-width:80px; text-align:center; line-height:1; }

.form-grid { display:grid; grid-template-columns:1fr 1fr; gap:1rem; }
.form-group { display:flex; flex-direction:column; gap:.45rem; }
.form-group label { font-size:.78rem; color:var(--muted); letter-spacing:.04em; text-transform:uppercase; }
.form-group input { padding:.75rem 1rem; background:var(--navy3); border:1px solid var(--border); border-radius:10px; color:var(--white); font-family:'Instrument Sans',sans-serif; font-size:.9rem; outline:none; transition:border-color .2s; width:100%; }
.form-group input::placeholder { color:var(--muted); }
.form-group input:focus { border-color:rgba(255,215,0,0.45); }

.payment-info { background:var(--navy3); border:1px solid rgba(30,136,255,0.3); border-radius:14px; padding:1.4rem 1.5rem; margin-bottom:1.25rem; }
.payment-info h3 { font-family:'Bebas Neue',sans-serif; font-size:1.1rem; letter-spacing:.05em; margin-bottom:.75rem; color:var(--blue); }
.pay-step { display:flex; gap:.85rem; padding:.6rem 0; border-bottom:1px solid var(--border); font-size:.85rem; align-items:flex-start; }
.pay-step:last-child { border-bottom:none; }
.pay-step .n { font-family:'Bebas Neue',sans-serif; font-size:1.1rem; color:var(--blue); flex-shrink:0; width:20px; }
.pay-step .t { line-height:1.5; }
.pay-step .t span { color:var(--muted); font-size:.8rem; display:block; }
.whish-logo { display:flex; align-items:center; gap:.6rem; padding:1rem 1.25rem; background:rgba(30,136,255,0.08); border:1px solid rgba(30,136,255,0.25); border-radius:10px; margin-bottom:1rem; }
.whish-logo .wico { font-size:1.8rem; }
.whish-logo p { font-size:.8rem; color:var(--muted); line-height:1.4; }
.whish-logo p strong { color:var(--white); font-size:.95rem; display:block; }
.ref-input-wrap { display:flex; flex-direction:column; gap:.45rem; }
.ref-input-wrap label { font-size:.78rem; color:var(--muted); letter-spacing:.04em; text-transform:uppercase; }
.ref-input-wrap input { padding:.75rem 1rem; background:var(--navy3); border:1px solid var(--border); border-radius:10px; color:var(--white); font-family:'Instrument Sans',sans-serif; font-size:.9rem; outline:none; transition:border-color .2s; }
.ref-input-wrap input:focus { border-color:rgba(255,215,0,0.45); }

.order-summary { background:var(--navy3); border:1px solid rgba(255,215,0,0.15); border-radius:12px; padding:1.1rem 1.25rem; margin-bottom:1.25rem; }
.order-summary h4 { font-family:'Bebas Neue',sans-serif; font-size:1rem; letter-spacing:.05em; color:var(--gold); margin-bottom:.85rem; }
.os-row { display:flex; justify-content:space-between; font-size:.82rem; padding:.35rem 0; border-bottom:1px solid var(--border); }
.os-row:last-child { border-bottom:none; }
.os-row .k { color:var(--muted); }
.os-row .v { font-weight:600; }

.confirm-wrap { text-align:center; padding:1rem 0; }
.confirm-icon { font-size:3.5rem; margin-bottom:1rem; display:block; }
.confirm-wrap h2 { font-family:'Bebas Neue',sans-serif; font-size:2rem; letter-spacing:.05em; color:var(--gold); margin-bottom:.5rem; }
.confirm-wrap p { color:var(--muted); font-size:.88rem; line-height:1.6; max-width:400px; margin:0 auto 1.5rem; }
.qr-placeholder { width:160px; height:160px; background:var(--white); border-radius:12px; margin:0 auto 1.5rem; display:flex; align-items:center; justify-content:center; font-size:.7rem; color:#111; text-align:center; padding:.5rem; }
.booking-code { font-family:'Bebas Neue',sans-serif; font-size:1.8rem; letter-spacing:.2em; color:var(--gold); background:rgba(255,215,0,0.08); border:1px solid rgba(255,215,0,0.3); border-radius:10px; padding:.6rem 1.5rem; display:inline-block; margin-bottom:1.5rem; }
.confirm-details { background:var(--navy3); border:1px solid var(--border); border-radius:12px; padding:1rem 1.25rem; text-align:left; margin-bottom:1.5rem; }
.confirm-details .cd-row { display:flex; justify-content:space-between; font-size:.82rem; padding:.35rem 0; border-bottom:1px solid var(--border); }
.confirm-details .cd-row:last-child { border-bottom:none; }
.confirm-details .cd-row .k { color:var(--muted); }
.confirm-details .cd-row .v { font-weight:600; }

.step-nav { display:flex; gap:.75rem; margin-top:1.75rem; }
.btn-back { padding:.8rem 1.5rem; border:1px solid var(--border); background:transparent; color:var(--muted); border-radius:10px; font-family:'Instrument Sans',sans-serif; font-size:.9rem; cursor:pointer; transition:all .2s; }
.btn-back:hover { border-color:rgba(255,255,255,0.25); color:var(--white); }
.btn-next { flex:1; padding:.85rem; background:var(--gold); color:#0B1220; border:none; border-radius:10px; font-family:'Bebas Neue',sans-serif; font-size:1.05rem; letter-spacing:.1em; cursor:pointer; transition:all .2s; }
.btn-next:hover { opacity:.88; transform:translateY(-1px); }
.btn-next:disabled { opacity:.4; cursor:not-allowed; transform:none; }

.alert-err { background:rgba(239,68,68,0.1); border:1px solid rgba(239,68,68,0.3); border-radius:8px; padding:.7rem 1rem; font-size:.8rem; color:#f87171; margin-top:.75rem; display:none; }

@media(max-width:768px) {
    nav { padding: 15px 20px; flex-wrap: wrap; gap: 8px; }
    .nav-hamburger { display: block; }
    .nav-btn { display: none; }
    .nav-links { display: none; flex-direction: column; width: 100%; gap: 12px; padding: 15px 0 5px; border-top: 1px solid rgba(255,255,255,0.08); }
    .nav-links.open { display: flex; }
    .section-grid { grid-template-columns:repeat(2,1fr); }
    .form-grid { grid-template-columns:1fr; }
    .res-card-header, .res-card-body { padding:1.25rem; }
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
        <div class="step-item" id="prog-2"><div class="step-dot">2</div><div class="step-lbl">Section</div></div>
        <div class="step-item" id="prog-3"><div class="step-dot">3</div><div class="step-lbl">Quantity</div></div>
        <div class="step-item" id="prog-4"><div class="step-dot">4</div><div class="step-lbl">Your Info</div></div>
        <div class="step-item" id="prog-5"><div class="step-dot">5</div><div class="step-lbl">Payment</div></div>
        <div class="step-item" id="prog-6"><div class="step-dot">✓</div><div class="step-lbl">Confirmed</div></div>
    </div>
</div>

<div class="res-body">
<div class="res-card">

<div class="step-panel active" id="step-1">
    <div class="res-card-header">
        <div class="step-num-big">1</div>
        <div><h2>Select a Match</h2><p>Choose the match you want to attend</p></div>
    </div>
    <div class="res-card-body">
        <input type="text" class="match-search" id="match-search" placeholder="Search by team name or date…" oninput="filterMatches()">
        <div class="filter-tabs" id="stage-tabs">
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
            <button class="btn-next" onclick="goStep(2)">Continue → Select Section</button>
        </div>
    </div>
</div>

<div class="step-panel" id="step-2">
    <div class="res-card-header">
        <div class="step-num-big">2</div>
        <div><h2>Choose Your Section</h2><p>Pick a seating category that suits you</p></div>
    </div>
    <div class="res-card-body">
        <div class="section-grid">
            <div class="section-opt vip" onclick="selectSection('A','VIP Lounge','Couch / Sofa Seating','18 tables · 108 pax')"><div class="sec-letter">A</div><div class="sec-type">VIP Lounge</div><div class="sec-cap">Left Wing · 108 pax</div></div>
            <div class="section-opt vip" onclick="selectSection('B','VIP Lounge','Couch / Sofa Seating','16 tables · 96 pax')"><div class="sec-letter">B</div><div class="sec-type">VIP Lounge</div><div class="sec-cap">Center Front · 96 pax</div></div>
            <div class="section-opt vip" onclick="selectSection('C','VIP Lounge','Couch / Sofa Seating','18 tables · 108 pax')"><div class="sec-letter">C</div><div class="sec-type">VIP Lounge</div><div class="sec-cap">Right Wing · 108 pax</div></div>
            <div class="section-opt high" onclick="selectSection('D','High Tables','High Chair Seating','24 tables · 96 pax')"><div class="sec-letter">D</div><div class="sec-type">High Tables</div><div class="sec-cap">Left Wing · 96 pax</div></div>
            <div class="section-opt high" onclick="selectSection('E','High Tables','High Chair Seating','22 tables · 88 pax')"><div class="sec-letter">E</div><div class="sec-type">High Tables</div><div class="sec-cap">Center Mid · 88 pax</div></div>
            <div class="section-opt high" onclick="selectSection('F','High Tables','High Chair Seating','24 tables · 96 pax')"><div class="sec-letter">F</div><div class="sec-type">High Tables</div><div class="sec-cap">Right Wing · 96 pax</div></div>
            <div class="section-opt std" onclick="selectSection('G','Standard Tables','Regular Chair Seating','36 tables · 144 pax')"><div class="sec-letter">G</div><div class="sec-type">Standard Tables</div><div class="sec-cap">Left Back · 144 pax</div></div>
            <div class="section-opt std" onclick="selectSection('H','Standard Tables','Regular Chair Seating','36 tables · 144 pax')"><div class="sec-letter">H</div><div class="sec-type">Standard Tables</div><div class="sec-cap">Right Back · 144 pax</div></div>
            <div class="section-opt single" onclick="selectSection('I','Single Seats','Individual Chair','162 seats')"><div class="sec-letter">I</div><div class="sec-type">Single Seats</div><div class="sec-cap">Back Rows · 162 pax</div></div>
        </div>
        <div class="alert-err" id="err-2">Please select a section to continue.</div>
        <div class="step-nav">
            <button class="btn-back" onclick="goStep(1)">← Back</button>
            <button class="btn-next" onclick="goStep(3)">Continue → Choose Quantity</button>
        </div>
    </div>
</div>

<div class="step-panel" id="step-3">
    <div class="res-card-header">
        <div class="step-num-big">3</div>
        <div><h2>How Many Seats?</h2><p>Select the number of people attending</p></div>
    </div>
    <div class="res-card-body">
        <div class="qty-wrap">
            <div class="qty-info-card">
                <div style="font-size:1.5rem;flex-shrink:0">ℹ️</div>
                <p id="qty-section-note" style="font-size:.82rem;color:var(--muted);line-height:1.5">Select quantity below.</p>
            </div>
            <div>
                <div class="qty-control">
                    <button class="qty-btn" id="qty-minus" onclick="changeQty(-1)">−</button>
                    <div class="qty-num" id="qty-display">1</div>
                    <button class="qty-btn" id="qty-plus" onclick="changeQty(1)">+</button>
                </div>
            </div>
            <div class="order-summary" id="qty-summary">
                <h4>Summary</h4>
                <div class="os-row"><span class="k">Match</span><span class="v" id="os-match">—</span></div>
                <div class="os-row"><span class="k">Section</span><span class="v" id="os-section">—</span></div>
                <div class="os-row"><span class="k">Quantity</span><span class="v" id="os-qty">—</span></div>
            </div>
        </div>
        <div class="step-nav">
            <button class="btn-back" onclick="goStep(2)">← Back</button>
            <button class="btn-next" onclick="goStep(4)">Continue → Your Info</button>
        </div>
    </div>
</div>

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

<div class="step-panel" id="step-5">
    <div class="res-card-header">
        <div class="step-num-big">5</div>
        <div><h2>Payment</h2><p>Pay securely via Whish Money</p></div>
    </div>
    <div class="res-card-body">
        <div class="order-summary" style="margin-bottom:1.25rem;">
            <h4>Order Summary</h4>
            <div class="os-row"><span class="k">Match</span><span class="v" id="pay-match">—</span></div>
            <div class="os-row"><span class="k">Section</span><span class="v" id="pay-section">—</span></div>
            <div class="os-row"><span class="k">Quantity</span><span class="v" id="pay-qty">—</span></div>
            <div class="os-row"><span class="k">Name</span><span class="v" id="pay-name">—</span></div>
        </div>
        <div class="whish-logo">
            <div class="wico">💳</div>
            <div><p><strong>Whish Money</strong>Lebanon's trusted mobile payment platform</p><p>Transfer to the account shown below, then paste your reference number.</p></div>
        </div>
        <div class="payment-info">
            <h3>How to Pay</h3>
            <div class="pay-step"><div class="n">1</div><div class="t">Open your <strong>Whish Money</strong> app and tap <em>Send Money</em><span>Make sure you have sufficient balance</span></div></div>
            <div class="pay-step"><div class="n">2</div><div class="t">Send the exact amount to: <strong>+961 XX XXX XXX</strong><span>Account name: Minieh Fan Zone 2026</span></div></div>
            <div class="pay-step"><div class="n">3</div><div class="t">Copy the <strong>Transaction Reference Number</strong> from the app<span>It looks like: WM-2026-XXXXXXXX</span></div></div>
            <div class="pay-step"><div class="n">4</div><div class="t">Paste it below and click <strong>Confirm Reservation</strong><span>Our team will verify and send your QR ticket within 30 minutes</span></div></div>
        </div>
        <div class="ref-input-wrap">
            <label>Whish Money Transaction Reference</label>
            <input type="text" id="f-ref" placeholder="e.g. WM-2026-12345678">
        </div>
        <div class="alert-err" id="err-5">Please enter your Whish Money transaction reference.</div>
        <div class="step-nav">
            <button class="btn-back" onclick="goStep(4)">← Back</button>
            <button class="btn-next" id="confirm-btn" onclick="submitReservation()">Confirm Reservation →</button>
        </div>
    </div>
</div>

<div class="step-panel" id="step-6">
    <div class="res-card-header">
        <div class="step-num-big" style="background:rgba(34,197,94,0.12);border-color:rgba(34,197,94,0.3);color:#4ade80;">✓</div>
        <div><h2>Reservation Received!</h2><p>We'll verify your payment and send your ticket</p></div>
    </div>
    <div class="res-card-body">
        <div class="confirm-wrap">
            <span class="confirm-icon">🎉</span>
            <h2>You're All Set!</h2>
            <p>Your reservation has been submitted. Once we verify your Whish Money payment, your digital QR ticket will be sent to your email and phone.</p>
            <div class="qr-placeholder"><span>QR ticket will appear here after payment verification</span></div>
            <div class="booking-code" id="conf-booking-code">MFZ-000000</div>
            <div class="confirm-details">
                <div class="cd-row"><span class="k">Match</span><span class="v" id="conf-match">—</span></div>
                <div class="cd-row"><span class="k">Section</span><span class="v" id="conf-section">—</span></div>
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

<script>
function toggleNav(){document.getElementById('nav-links').classList.toggle('open');}

const MATCHES = [
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

const SECTION_MAX={A:6,B:6,C:6,D:4,E:4,F:4,G:4,H:4,I:1};
let state={step:1,matchId:null,matchLabel:'',section:null,sectionType:'',sectionStyle:'',sectionCap:'',qty:1,fname:'',lname:'',phone:'',email:'',ref:''};
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
        const matchStage=stageFilter==='all'||m.stage===stageFilter;
        const matchQ=!q||m.teamA.toLowerCase().includes(q)||m.teamB.toLowerCase().includes(q)||m.date.toLowerCase().includes(q);
        return matchStage&&matchQ;
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

function selectSection(key,type,style,cap){
    state.section=key;state.sectionType=type;state.sectionStyle=style;state.sectionCap=cap;
    state.qty=1;
    document.getElementById('qty-display').textContent=1;
    document.querySelectorAll('.section-opt').forEach(o=>o.classList.remove('selected'));
    event.currentTarget.classList.add('selected');
}

function changeQty(d){
    const max=SECTION_MAX[state.section]||6;
    const isSingle=state.section==='I';
    const newQty=state.qty+d;
    if(newQty<1||newQty>(isSingle?10:max))return;
    state.qty=newQty;
    document.getElementById('qty-display').textContent=state.qty;
    document.getElementById('qty-minus').disabled=state.qty<=1;
    document.getElementById('qty-plus').disabled=state.qty>=(isSingle?10:max);
    updateQtySummary();
}

function updateQtySummary(){
    document.getElementById('os-match').textContent=state.matchLabel||'—';
    document.getElementById('os-section').textContent=state.section?`Section ${state.section} — ${state.sectionType}`:'—';
    document.getElementById('os-qty').textContent=state.qty+(state.section==='I'?' seat(s)':' person(s)');
    document.getElementById('qty-minus').disabled=state.qty<=1;
    document.getElementById('qty-plus').disabled=state.qty>=(state.section==='I'?10:SECTION_MAX[state.section]||6);
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
    document.getElementById('pay-section').textContent=`Section ${state.section} — ${state.sectionType}`;
    document.getElementById('pay-qty').textContent=state.qty+(state.section==='I'?' seat(s)':' person(s)');
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
    document.getElementById('conf-section').textContent=`Section ${state.section} — ${state.sectionType}`;
    document.getElementById('conf-qty').textContent=state.qty+(state.section==='I'?' seat(s)':' person(s)');
    document.getElementById('conf-name').textContent=`${state.fname} ${state.lname}`;
    document.getElementById('conf-email').textContent=state.email;
    document.getElementById('conf-phone').textContent=state.phone;
    document.getElementById('conf-ref').textContent=state.ref;
    goStep(6);
}

function showErr(id){document.getElementById(id).style.display='block';}
function hideAllErrs(){document.querySelectorAll('.alert-err').forEach(e=>e.style.display='none');}

document.addEventListener('DOMContentLoaded',()=>{
    renderMatches();
    const params=new URLSearchParams(window.location.search);
    const preSection=params.get('section');
    if(preSection){
        const sectionMap={A:['VIP Lounge','Couch / Sofa Seating','18 tables · 108 pax'],B:['VIP Lounge','Couch / Sofa Seating','16 tables · 96 pax'],C:['VIP Lounge','Couch / Sofa Seating','18 tables · 108 pax'],D:['High Tables','High Chair Seating','24 tables · 96 pax'],E:['High Tables','High Chair Seating','22 tables · 88 pax'],F:['High Tables','High Chair Seating','24 tables · 96 pax'],G:['Standard Tables','Regular Chair Seating','36 tables · 144 pax'],H:['Standard Tables','Regular Chair Seating','36 tables · 144 pax'],I:['Single Seats','Individual Chair','162 seats']};
        if(sectionMap[preSection]){state.section=preSection;state.sectionType=sectionMap[preSection][0];state.sectionStyle=sectionMap[preSection][1];state.sectionCap=sectionMap[preSection][2];}
    }
});
</script>

@endsection