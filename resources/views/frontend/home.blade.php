@extends('layouts.app')

@section('content')
@php
$soldOut = \App\Models\TicketCategory::where('sold_out', true)->pluck('section')->toArray();
@endphp

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
    background: rgba(11,18,32,0.8); backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(255,215,0,0.12);
}
.nav-logo { font-family: 'Bebas Neue', cursive; font-size: 1.5rem; letter-spacing: 3px; color: var(--white); text-decoration: none; white-space: nowrap; }
.nav-logo span { color: var(--gold); text-shadow:0 0 15px rgba(255,215,0,0.4); }
.nav-links { display: flex; gap: 35px; list-style: none; }
.nav-links a { color: rgba(255,255,255,0.7); text-decoration: none; font-size: 0.85rem; font-weight: 600; letter-spacing: 2px; text-transform: uppercase; transition: color 0.3s; position: relative; }
.nav-links a::after { content:''; position:absolute; bottom:-4px; left:0; width:0; height:2px; background:var(--gold); box-shadow:0 0 8px rgba(255,215,0,0.6); transition:width 0.3s; }
.nav-links a:hover::after { width:100%; }
.nav-links a:hover { color: var(--gold); }
.nav-btn { background: var(--gold); color: var(--navy); padding: 10px 25px; border-radius: 8px; font-size: 0.8rem; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; text-decoration: none; transition: all 0.3s; white-space: nowrap; box-shadow:0 0 20px rgba(255,215,0,0.25); }
.nav-btn:hover { box-shadow:0 0 35px rgba(255,215,0,0.5); transform:translateY(-1px); }
.nav-hamburger { display: none; background: none; border: 1px solid rgba(255,255,255,0.2); color: var(--white); font-size: 1.3rem; cursor: pointer; padding: 6px 12px; border-radius: 6px; }

/* AD SLIDER */
.ad-slider-wrap { width:100%; overflow:hidden; position:relative; background:#000; }
.ad-slider-track { display:flex; transition:transform 0.6s ease; }
.ad-slide { min-width:100%; }
.ad-slide img { width:100%; height:220px; object-fit:cover; display:block; }
.ad-dots { position:absolute; bottom:10px; left:50%; transform:translateX(-50%); display:flex; gap:6px; z-index:10; }
.ad-dot { width:8px; height:8px; border-radius:50%; background:rgba(255,255,255,0.4); cursor:pointer; transition:background 0.3s; }
.ad-dot.active { background:#FFD700; box-shadow:0 0 8px rgba(255,215,0,0.6); }

.hero { min-height:100vh; position:relative; display:flex; align-items:center; justify-content:center; text-align:center; overflow:hidden; }
.hero-bg { position:absolute; inset:0; background:linear-gradient(rgba(10,14,23,0.75),rgba(10,14,23,0.9)),url('/images/minieh-bg.webp') center/cover no-repeat; }
.hero-bg::after { content:''; position:absolute; inset:0; background-image:linear-gradient(rgba(255,215,0,0.03) 1px,transparent 1px),linear-gradient(90deg,rgba(255,215,0,0.03) 1px,transparent 1px); background-size:50px 50px; }
.hero-content { position:relative; z-index:10; max-width:900px; padding:0 20px; }

.hero-badge { display:inline-flex; align-items:center; gap:10px; background:rgba(255,255,255,0.04); backdrop-filter:blur(20px); border:1px solid rgba(255,215,0,0.3); padding:8px 22px; border-radius:50px; font-size:0.72rem; font-weight:700; letter-spacing:3px; text-transform:uppercase; color:#FFD700; margin-bottom:30px; animation:fadeIn 0.8s ease forwards; opacity:0; text-shadow:0 0 12px rgba(255,215,0,0.5); }
.hero-badge-dot { width:7px; height:7px; background:#FFD700; border-radius:50%; animation:blink 1s infinite; box-shadow:0 0 8px #FFD700; }
.hero-title { font-family:'Bebas Neue',cursive; font-size:clamp(3rem,8vw,5.5rem); line-height:0.9; letter-spacing:3px; margin-bottom:25px; animation:scaleIn 1s ease 0.3s forwards; opacity:0; }
.hero-title .gold { color:var(--gold); text-shadow:0 0 40px rgba(255,215,0,0.5); }
.hero-subtitle { font-size:1rem; color:rgba(255,255,255,0.65); line-height:1.8; max-width:600px; margin:0 auto 40px; padding:0 10px; animation:fadeUp 0.8s ease 0.7s forwards; opacity:0; }
.hero-btns { display:flex; gap:15px; justify-content:center; flex-wrap:wrap; margin-bottom:50px; animation:fadeUp 0.8s ease 0.9s forwards; opacity:0; }

.btn-primary { background:var(--gold); color:var(--navy); padding:16px 35px; border-radius:8px; font-family:'Bebas Neue',cursive; font-size:1rem; letter-spacing:3px; text-decoration:none; transition:transform .2s cubic-bezier(0.16,1,0.3,1), box-shadow .3s; display:inline-block; position:relative; overflow:hidden; box-shadow:0 0 25px rgba(255,215,0,0.3); }
.btn-primary:hover { box-shadow:0 0 45px rgba(255,215,0,0.6); transform:translateY(-2px); }
.btn-primary:active { transform:scale(0.97); }
.btn-secondary { background:rgba(255,255,255,0.04); backdrop-filter:blur(10px); color:white; padding:16px 35px; border-radius:8px; font-family:'Bebas Neue',cursive; font-size:1rem; letter-spacing:3px; text-decoration:none; border:1px solid rgba(255,255,255,0.15); transition:all 0.3s; display:inline-block; }
.btn-secondary:hover { border-color:var(--gold); color:var(--gold); box-shadow:0 0 25px rgba(255,215,0,0.15); }

/* LIVE NOW BADGE (replaces countdown) */
.live-badge { display:inline-flex; align-items:center; gap:12px; background:rgba(34,197,94,0.1); backdrop-filter:blur(20px); border:1px solid rgba(34,197,94,0.4); padding:14px 32px; border-radius:50px; font-family:'Bebas Neue',cursive; font-size:1.1rem; letter-spacing:3px; color:#4ade80; animation:fadeUp 0.8s ease 1.1s forwards; opacity:0; box-shadow:0 0 30px rgba(34,197,94,0.2); }
.live-pulse { width:10px; height:10px; background:#22c55e; border-radius:50%; box-shadow:0 0 10px #22c55e; animation:livePulse 1.5s ease-in-out infinite; }
@keyframes livePulse { 0%,100%{opacity:1;box-shadow:0 0 0 0 rgba(34,197,94,0.6);} 50%{opacity:0.7;box-shadow:0 0 0 8px rgba(34,197,94,0);} }

.stats-section { padding:60px 20px; }
.stats-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:16px; max-width:900px; margin:0 auto; text-align:center; }
.stats-grid > div { background:rgba(255,255,255,0.03); backdrop-filter:blur(20px); border:1px solid rgba(255,215,0,0.15); border-radius:16px; padding:24px 16px; transition:transform .3s cubic-bezier(0.16,1,0.3,1),border-color .3s,box-shadow .3s; }
.stats-grid > div:hover { transform:translateY(-5px); border-color:rgba(255,215,0,0.5); box-shadow:0 0 30px rgba(255,215,0,0.15); }
.stat-num { font-family:'Bebas Neue',cursive; font-size:3rem; color:var(--gold); display:block; line-height:1; text-shadow:0 0 20px rgba(255,215,0,0.4); animation:countUp 0.6s ease forwards; opacity:0; }
.stats-grid > div:nth-child(1) .stat-num { animation-delay:0.1s; }
.stats-grid > div:nth-child(2) .stat-num { animation-delay:0.25s; }
.stats-grid > div:nth-child(3) .stat-num { animation-delay:0.4s; }
.stats-grid > div:nth-child(4) .stat-num { animation-delay:0.55s; }
.stat-lbl { font-size:0.7rem; font-weight:600; letter-spacing:2px; color:rgba(255,255,255,0.4); text-transform:uppercase; margin-top:8px; display:block; }

/* FEATURES - photo cards */
.features-section { padding:80px 20px; max-width:1200px; margin:0 auto; }
.section-label { font-size:0.7rem; font-weight:700; letter-spacing:4px; color:var(--gold); text-transform:uppercase; display:block; text-align:center; margin-bottom:15px; text-shadow:0 0 10px rgba(255,215,0,0.4); }
.section-title { font-family:'Bebas Neue',cursive; font-size:clamp(2.5rem,6vw,5rem); letter-spacing:2px; text-align:center; margin-bottom:50px; color:var(--white); }
.section-title span { color:var(--gold); text-shadow:0 0 30px rgba(255,215,0,0.4); }

.features-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:16px; }
.feature-card { border-radius:18px; overflow:hidden; position:relative; height:300px; cursor:default; transition:transform .4s cubic-bezier(0.16,1,0.3,1), box-shadow .4s; opacity:0; transform:translateY(24px); }
.feature-card.visible { opacity:1; transform:translateY(0); transition:opacity .6s ease, transform .6s ease; }
.feature-card:hover, .feature-card.visible:hover { transform:translateY(-8px); box-shadow:0 0 40px rgba(255,215,0,0.2); }
.fc-bg { position:absolute; inset:0; background-size:cover; background-position:center; transition:transform .5s; }
.feature-card:hover .fc-bg { transform:scale(1.08); }
.fc-overlay { position:absolute; inset:0; background:linear-gradient(to top, rgba(5,10,20,0.96) 0%, rgba(5,10,20,0.65) 55%, rgba(5,10,20,0.15) 100%); }
.fc-border { position:absolute; inset:0; border-radius:18px; border:1px solid rgba(255,215,0,0.15); transition:border-color .4s; pointer-events:none; }
.feature-card:hover .fc-border { border-color:rgba(255,215,0,0.5); }
.fc-content { position:absolute; inset:0; padding:26px; display:flex; flex-direction:column; justify-content:flex-end; }
.fc-icon-wrap { width:48px; height:48px; border-radius:13px; background:rgba(255,215,0,0.12); border:1px solid rgba(255,215,0,0.3); display:flex; align-items:center; justify-content:center; margin-bottom:16px; transition:transform .3s, box-shadow .3s; }
.feature-card:hover .fc-icon-wrap { transform:scale(1.1) rotate(-3deg); box-shadow:0 0 20px rgba(255,215,0,0.3); }
.fc-icon-wrap svg { stroke:#FFD700; fill:none; width:22px; height:22px; stroke-width:1.6; stroke-linecap:round; stroke-linejoin:round; }
.fc-num { font-size:.65rem; letter-spacing:3px; color:rgba(255,255,255,0.3); margin-bottom:6px; display:block; }
.fc-title { font-family:'Bebas Neue',cursive; font-size:1.35rem; letter-spacing:2px; color:#fff; margin-bottom:8px; }
.fc-desc { font-size:.8rem; color:rgba(255,255,255,0.55); line-height:1.65; max-height:0; overflow:hidden; transition:max-height .4s, opacity .4s; opacity:0; }
.feature-card:hover .fc-desc { max-height:80px; opacity:1; }
.fc-tag { display:inline-block; margin-top:12px; font-size:.62rem; font-weight:700; letter-spacing:2px; text-transform:uppercase; padding:3px 10px; border-radius:20px; background:rgba(255,215,0,0.18); color:#FFD700; }

/* FAQ */
.faq-section { padding:80px 20px; max-width:800px; margin:0 auto; }
.faq-list { display:flex; flex-direction:column; gap:12px; }
.faq-item { background:rgba(255,255,255,0.03); backdrop-filter:blur(20px); border:1px solid rgba(255,255,255,0.08); border-radius:14px; overflow:hidden; transition:border-color 0.3s, box-shadow 0.3s; }
.faq-item:hover { border-color:rgba(255,215,0,0.3); box-shadow:0 0 25px rgba(255,215,0,0.08); }
.faq-q { display:flex; justify-content:space-between; align-items:center; padding:20px 24px; cursor:pointer; font-size:0.95rem; font-weight:600; color:var(--white); gap:15px; }
.faq-icon { font-size:1.4rem; color:var(--gold); flex-shrink:0; transition:transform 0.3s; font-weight:300; }
.faq-item.open .faq-icon { transform:rotate(45deg); }
.faq-a { max-height:0; overflow:hidden; transition:max-height 0.4s ease,padding 0.3s; font-size:0.88rem; color:rgba(255,255,255,0.6); line-height:1.8; padding:0 24px; }
.faq-item.open .faq-a { max-height:200px; padding:0 24px 20px; }

.cta-section { padding:80px 20px; text-align:center; background:radial-gradient(ellipse 80% 60% at 50% 0%, rgba(255,215,0,0.08), transparent); border-top:1px solid rgba(255,215,0,0.1); }
.cta-title { font-family:'Bebas Neue',cursive; font-size:clamp(2.5rem,8vw,7rem); letter-spacing:2px; line-height:0.9; margin-bottom:25px; }
.cta-section .btn-primary { animation:glow 2s ease-in-out infinite; }

.sold-out-overlay { position:relative; }
.sold-out-overlay::after { content:'SOLD OUT'; position:absolute; inset:0; background:rgba(0,0,0,0.7); display:flex; align-items:center; justify-content:center; font-family:'Bebas Neue',cursive; font-size:11px; letter-spacing:2px; color:#f87171; border-radius:8px; pointer-events:none; }
.sold-out-overlay * { pointer-events:none !important; }

footer { padding:30px 20px; text-align:center; border-top:1px solid rgba(255,255,255,0.05); color:rgba(255,255,255,0.3); font-size:0.85rem; }

@keyframes blink { 0%,100%{opacity:1;} 50%{opacity:0;} }
@keyframes fadeUp { from{opacity:0;transform:translateY(30px);} to{opacity:1;transform:translateY(0);} }
@keyframes fadeIn { from{opacity:0;} to{opacity:1;} }
@keyframes scaleIn { from{opacity:0;transform:scale(0.85);} to{opacity:1;transform:scale(1);} }
@keyframes glow { 0%,100%{box-shadow:0 0 20px rgba(255,215,0,0.3);} 50%{box-shadow:0 0 45px rgba(255,215,0,0.6);} }
@keyframes countUp { from{opacity:0;transform:translateY(20px) scale(0.8);} to{opacity:1;transform:translateY(0) scale(1);} }

@media (max-width:768px) {
    nav { padding:15px 20px; flex-wrap:wrap; gap:8px; }
    .nav-hamburger { display:block; }
    .nav-btn { display:none; }
    .nav-links { display:none; flex-direction:column; width:100%; gap:12px; padding:15px 0 5px; border-top:1px solid rgba(255,255,255,0.08); }
    .nav-links.open { display:flex; }
    .nav-links a { font-size:1rem; letter-spacing:1px; }
    .features-grid { grid-template-columns:1fr; }
    .stats-grid { grid-template-columns:repeat(2,1fr); }
    .ad-slide img { height:140px; }
}
</style>

<!-- AD SLIDER -->
@php $ads = \App\Models\Ad::where('is_active', true)->orderBy('order')->get(); @endphp
@if($ads->count() > 0)
<div class="ad-slider-wrap" id="adSlider">
    <div class="ad-slider-track" id="adTrack">
        @foreach($ads as $ad)
        <div class="ad-slide">
            <img src="{{ asset('storage/' . $ad->file_path) }}" alt="Ad">
        </div>
        @endforeach
    </div>
    <div class="ad-dots" id="adDots"></div>
</div>
@endif

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

<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-content">
        <div class="hero-badge">
            <span class="hero-badge-dot"></span>
            Official FIFA World Cup 2026 Viewing Experience
        </div>
        <h1 class="hero-title">MINIEH<br><span class="gold">FAN ZONE</span><br>2026</h1>
        <p class="hero-subtitle">Watch every FIFA World Cup match live on a giant screen with thousands of football fans on the beautiful Minieh Corniche.</p>
        <div class="hero-btns">
            <a href="/reserve" class="btn-primary">🎟️ Reserve Tickets</a>
            <a href="/matches" class="btn-secondary">📅 View Matches</a>
        </div>
        <div class="live-badge">
            <span class="live-pulse"></span>
            FESTIVAL IS LIVE NOW
        </div>
    </div>
</section>

<section class="stats-section">
    <div class="stats-grid">
        <div><span class="stat-num">70K+</span><span class="stat-lbl">Expected Visitors</span></div>
        <div><span class="stat-num">39</span><span class="stat-lbl">Days of Football</span></div>
        <div><span class="stat-num">64</span><span class="stat-lbl">World Cup Matches</span></div>
        <div><span class="stat-num">4</span><span class="stat-lbl">Seating Levels</span></div>
    </div>
</section>

<section class="features-section">
    <span class="section-label">The Experience</span>
    <h2 class="section-title">Everything You <span>Need</span></h2>
    <div class="features-grid">

        <div class="feature-card">
            <div class="fc-bg" style="background-image:url('https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&q=80')"></div>
            <div class="fc-overlay"></div>
            <div class="fc-border"></div>
            <div class="fc-content">
                <div class="fc-icon-wrap"><svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg></div>
                <span class="fc-num">01</span>
                <div class="fc-title">Giant LED Screen</div>
                <p class="fc-desc">A massive screen over the Mediterranean sea. Experience every goal like you're in the stadium.</p>
                <span class="fc-tag">Above the Sea</span>
            </div>
        </div>

        <div class="feature-card">
            <div class="fc-bg" style="background-image:url('https://images.unsplash.com/photo-1611532736597-de2d4265fba3?w=800&q=80')"></div>
            <div class="fc-overlay"></div>
            <div class="fc-border"></div>
            <div class="fc-content">
                <div class="fc-icon-wrap"><svg viewBox="0 0 24 24"><path d="M3 7a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><path d="M9 11l2 2 4-4"/></svg></div>
                <span class="fc-num">02</span>
                <div class="fc-title">Online Booking</div>
                <p class="fc-desc">Reserve your spot in minutes. Get a QR ticket sent straight to your email — instantly.</p>
                <span class="fc-tag">Instant Confirmation</span>
            </div>
        </div>

        <div class="feature-card">
            <div class="fc-bg" style="background-image:url('https://images.unsplash.com/photo-1517457373958-b7bdd4587205?w=800&q=80')"></div>
            <div class="fc-overlay"></div>
            <div class="fc-border" style="border-color:rgba(255,215,0,0.4);"></div>
            <div class="fc-content">
                <div class="fc-icon-wrap"><svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
                <span class="fc-num">03</span>
                <div class="fc-title">VIP Experience</div>
                <p class="fc-desc">Luxury couch seating, premium service, and the best views in Lebanon.</p>
                <span class="fc-tag">Premium</span>
            </div>
        </div>

        <div class="feature-card">
            <div class="fc-bg" style="background-image:url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=800&q=80')"></div>
            <div class="fc-overlay"></div>
            <div class="fc-border"></div>
            <div class="fc-content">
                <div class="fc-icon-wrap"><svg viewBox="0 0 24 24"><path d="M18 8h1a4 4 0 010 8h-1"/><path d="M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg></div>
                <span class="fc-num">04</span>
                <div class="fc-title">Food & Drinks</div>
                <p class="fc-desc">The best local and international food and drinks for the perfect match night.</p>
                <span class="fc-tag">Full Service</span>
            </div>
        </div>

        <div class="feature-card">
            <div class="fc-bg" style="background-image:url('https://images.unsplash.com/photo-1470225620780-dba8ba36b745?w=800&q=80')"></div>
            <div class="fc-overlay"></div>
            <div class="fc-border"></div>
            <div class="fc-content">
                <div class="fc-icon-wrap"><svg viewBox="0 0 24 24"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg></div>
                <span class="fc-num">05</span>
                <div class="fc-title">Live Entertainment</div>
                <p class="fc-desc">Top DJs and live music every night. The party doesn't stop — not even at half time.</p>
                <span class="fc-tag">Every Night</span>
            </div>
        </div>

        <div class="feature-card">
            <div class="fc-bg" style="background-image:url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800&q=80')"></div>
            <div class="fc-overlay"></div>
            <div class="fc-border"></div>
            <div class="fc-content">
                <div class="fc-icon-wrap"><svg viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
                <span class="fc-num">06</span>
                <div class="fc-title">Seaside Location</div>
                <p class="fc-desc">Right on the Minieh Corniche. Sea breeze, stunning views, thousands of fans.</p>
                <span class="fc-tag">Minieh Corniche</span>
            </div>
        </div>

    </div>
</section>

<section class="faq-section">
    <span class="section-label">Got Questions?</span>
    <h2 class="section-title">Frequently Asked <span>Questions</span></h2>
    <div class="faq-list">
        <div class="faq-item">
            <div class="faq-q" onclick="toggleFaq(this)"><span>How do I reserve a seat?</span><span class="faq-icon">+</span></div>
            <div class="faq-a">Click "Reserve Now" or "Book Now" on any page. Choose your match, select your exact table or seat on the map, fill in your details, and pay via WhishMoney. You'll receive a confirmation with your booking code instantly.</div>
        </div>
        <div class="faq-item">
            <div class="faq-q" onclick="toggleFaq(this)"><span>What payment methods are accepted?</span><span class="faq-icon">+</span></div>
            <div class="faq-a">We currently accept payment via <strong>WhishMoney</strong> — Lebanon's trusted mobile payment platform. After transferring the amount, paste your transaction reference number to confirm your reservation.</div>
        </div>
        <div class="faq-item">
            <div class="faq-q" onclick="toggleFaq(this)"><span>Can I cancel or change my reservation?</span><span class="faq-icon">+</span></div>
            <div class="faq-a">For changes or cancellations, please contact us via WhatsApp at +961 03 527 382 as soon as possible. We'll do our best to accommodate your request depending on availability.</div>
        </div>
        <div class="faq-item">
            <div class="faq-q" onclick="toggleFaq(this)"><span>When does the festival start?</span><span class="faq-icon">+</span></div>
            <div class="faq-a">The Minieh World Cup Corniche Festival runs from <strong>June 11 to July 19, 2026</strong>, along the Minieh Corniche. Doors open before every match — check the Matches page for the full schedule.</div>
        </div>
        <div class="faq-item">
            <div class="faq-q" onclick="toggleFaq(this)"><span>Is there parking available?</span><span class="faq-icon">+</span></div>
            <div class="faq-a">Yes, parking is available near the Minieh Corniche. We recommend arriving early on match days as the area gets busy. You can also use the location on our About page for directions.</div>
        </div>
        <div class="faq-item">
            <div class="faq-q" onclick="toggleFaq(this)"><span>What's the difference between VIP and Standard?</span><span class="faq-icon">+</span></div>
            <div class="faq-a">VIP sections feature luxury couch seating for 6 people with premium table service and the best elevated views of the giant screen. Standard tables seat 4 people with regular chairs and great viewing angles. Single seats are individual spots at the front row.</div>
        </div>
    </div>
</section>

<section class="cta-section">
    <h2 class="cta-title">DON'T MISS<br><span style="color:var(--gold);">THE FESTIVAL</span></h2>
    <p style="color:rgba(255,255,255,0.5);font-size:1rem;max-width:500px;margin:0 auto 40px;line-height:1.9;">Limited seats available. Book now to secure your spot at the biggest event in North Lebanon.</p>
    <div class="hero-btns">
        <a href="/reserve" class="btn-primary">🎟️ Book Now</a>
        <a href="/matches" class="btn-secondary">View Matches</a>
    </div>
</section>

<footer><p>© 2026 Minieh Fan Zone. All rights reserved. 🇱🇧</p></footer>

<script>
function toggleNav(){document.getElementById('nav-links').classList.toggle('open');}

const observer=new IntersectionObserver((entries)=>{
    entries.forEach((entry,i)=>{
        if(entry.isIntersecting){
            setTimeout(()=>entry.target.classList.add('visible'),i*100);
            observer.unobserve(entry.target);
        }
    });
},{threshold:0.1});
document.querySelectorAll('.feature-card').forEach(card=>observer.observe(card));

function toggleFaq(el){
    const item=el.parentElement;
    const isOpen=item.classList.contains('open');
    document.querySelectorAll('.faq-item').forEach(i=>i.classList.remove('open'));
    if(!isOpen)item.classList.add('open');
}

(function(){
    const track=document.getElementById('adTrack');
    const dotsWrap=document.getElementById('adDots');
    if(!track)return;
    const slides=track.querySelectorAll('.ad-slide');
    if(slides.length<=1)return;
    let current=0,timer;
    slides.forEach((_,i)=>{
        const dot=document.createElement('div');
        dot.className='ad-dot'+(i===0?' active':'');
        dot.onclick=()=>goTo(i);
        dotsWrap.appendChild(dot);
    });
    function goTo(n){
        current=(n+slides.length)%slides.length;
        track.style.transform=`translateX(-${current*100}%)`;
        dotsWrap.querySelectorAll('.ad-dot').forEach((d,i)=>d.classList.toggle('active',i===current));
    }
    function start(){timer=setInterval(()=>goTo(current+1),4000);}
    function stop(){clearInterval(timer);}
    start();
    track.addEventListener('mouseenter',stop);
    track.addEventListener('mouseleave',start);
})();

const soldOutSections = @json($soldOut ?? []);
soldOutSections.forEach(section => {
    const map = {
        'A': 'g-vtl', 'B': 'g-vml',
        'C': 'g-vmr', 'D': 'g-vtr',
        'E': 'g-tl',  'F': 'g-tml',
        'G': 'g-tmr', 'H': 'g-tr',
        'I': 'g-sl'
    };
    const gridId = map[section];
    if(gridId) {
        const zone = document.getElementById(gridId);
        if(zone) {
            zone.closest('.zone').classList.add('sold-out-overlay');
        }
    }
});
</script>

@endsection
