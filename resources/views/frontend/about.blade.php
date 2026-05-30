@extends('layouts.app')
 
@section('title', 'About Us — Minieh Fan Zone 2026')
 
@section('content')
<style>
* { margin: 0; padding: 0; box-sizing: border-box; }
:root { --navy: #0B1220; --blue: #1E88FF; --gold: #FFD700; --white: #FFFFFF; }
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
 
.hero {
    padding: 140px 60px 80px;
    text-align: center;
    background: linear-gradient(180deg, rgba(30,136,255,0.08) 0%, transparent 100%);
    border-bottom: 1px solid rgba(30,136,255,0.1);
}
.eyebrow { font-size: 0.7rem; font-weight: 700; letter-spacing: 4px; color: var(--blue); text-transform: uppercase; display: block; margin-bottom: 15px; }
.hero h1 { font-family: 'Bebas Neue', cursive; font-size: clamp(2.5rem, 6vw, 5rem); letter-spacing: 3px; margin-bottom: 20px; line-height: 1; }
.hero h1 span { color: var(--gold); }
.hero-sub { font-size: 1.1rem; color: rgba(255,255,255,0.6); font-style: italic; letter-spacing: 1px; }
 
.about-body { max-width: 900px; margin: 0 auto; padding: 80px 40px; }
 
.about-text { font-size: 1rem; color: rgba(255,255,255,0.75); line-height: 1.9; margin-bottom: 40px; }
.about-text strong { color: var(--white); }
.about-text .gold { color: var(--gold); font-weight: 600; }
 
.highlight-box {
    background: rgba(30,136,255,0.06);
    border: 1px solid rgba(30,136,255,0.15);
    border-left: 3px solid var(--blue);
    border-radius: 12px;
    padding: 30px 35px;
    margin: 40px 0;
    font-size: 1.05rem;
    color: rgba(255,255,255,0.8);
    line-height: 1.8;
    font-style: italic;
}
 
.features-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
    margin: 35px 0;
}
.feature-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 18px 20px;
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.07);
    border-radius: 10px;
}
.feature-icon { font-size: 1.4rem; flex-shrink: 0; }
.feature-text { font-size: 0.88rem; color: rgba(255,255,255,0.7); line-height: 1.5; }
.feature-text strong { color: var(--white); display: block; margin-bottom: 2px; }
 
.stat-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin: 50px 0;
    text-align: center;
}
.stat-box {
    background: rgba(255,215,0,0.06);
    border: 1px solid rgba(255,215,0,0.15);
    border-radius: 14px;
    padding: 30px 20px;
}
.stat-num { font-family: 'Bebas Neue', cursive; font-size: 3rem; color: var(--gold); line-height: 1; display: block; }
.stat-lbl { font-size: 0.72rem; color: rgba(255,255,255,0.45); letter-spacing: 2px; text-transform: uppercase; margin-top: 6px; display: block; }
 
.closing-quote {
    text-align: center;
    padding: 50px 0 20px;
    border-top: 1px solid rgba(255,255,255,0.06);
}
.closing-quote p { font-family: 'Bebas Neue', cursive; font-size: clamp(1.5rem, 4vw, 2.5rem); letter-spacing: 2px; line-height: 1.3; color: rgba(255,255,255,0.85); }
.closing-quote p span { color: var(--gold); }
 
/* CONTACT */
.contact-section {
    background: rgba(255,255,255,0.02);
    border-top: 1px solid rgba(255,255,255,0.06);
    padding: 80px 40px;
}
.contact-inner { max-width: 900px; margin: 0 auto; }
.section-title { font-family: 'Bebas Neue', cursive; font-size: clamp(2rem, 5vw, 3.5rem); letter-spacing: 3px; margin-bottom: 50px; text-align: center; }
.section-title span { color: var(--gold); }
 
.contact-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-bottom: 40px;
}
.contact-card {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 16px;
    padding: 30px;
    display: flex;
    align-items: center;
    gap: 20px;
    text-decoration: none;
    transition: all 0.3s;
}
.contact-card:hover { border-color: var(--gold); background: rgba(255,215,0,0.05); transform: translateY(-3px); }
.contact-card .icon { font-size: 2rem; flex-shrink: 0; width: 52px; height: 52px; border-radius: 12px; display: flex; align-items: center; justify-content: center; }
.contact-card .icon.wa { background: rgba(37,211,102,0.15); }
.contact-card .icon.em { background: rgba(30,136,255,0.15); }
.contact-card .icon.lo { background: rgba(255,215,0,0.12); }
.contact-card .icon.web { background: rgba(168,85,247,0.15); }
.contact-card .info { flex: 1; }
.contact-card .info .label { font-size: 0.65rem; color: rgba(255,255,255,0.35); letter-spacing: 3px; text-transform: uppercase; margin-bottom: 5px; display: block; }
.contact-card .info .value { font-size: 0.95rem; color: var(--white); font-weight: 600; }
.contact-card .info .sub { font-size: 0.78rem; color: rgba(255,255,255,0.4); margin-top: 3px; display: block; }
 
/* MAP */
.map-wrap {
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid rgba(255,255,255,0.08);
    margin-top: 10px;
}
.map-wrap iframe { width: 100%; height: 380px; display: block; border: none; }
 
/* CTA */
.cta-bar {
    text-align: center;
    padding: 80px 40px;
    background: linear-gradient(135deg, rgba(30,136,255,0.08), rgba(255,215,0,0.05));
    border-top: 1px solid rgba(30,136,255,0.1);
}
.cta-bar h2 { font-family: 'Bebas Neue', cursive; font-size: clamp(2rem, 5vw, 4rem); letter-spacing: 2px; margin-bottom: 15px; }
.cta-bar p { color: rgba(255,255,255,0.5); margin-bottom: 35px; font-size: 0.95rem; }
.btn-primary { background: var(--gold); color: var(--navy); padding: 16px 45px; border-radius: 6px; font-family: 'Bebas Neue', cursive; font-size: 1rem; letter-spacing: 3px; text-decoration: none; transition: all 0.3s; display: inline-block; }
.btn-primary:hover { background: white; transform: translateY(-2px); }
 
footer { padding: 30px 20px; text-align: center; border-top: 1px solid rgba(255,255,255,0.05); color: rgba(255,255,255,0.3); font-size: 0.85rem; }
 
@media (max-width: 768px) {
    nav { padding: 15px 20px; flex-wrap: wrap; gap: 8px; }
    .nav-hamburger { display: block; }
    .nav-btn { display: none; }
    .nav-links { display: none; flex-direction: column; width: 100%; gap: 12px; padding: 15px 0 5px; border-top: 1px solid rgba(255,255,255,0.08); }
    .nav-links.open { display: flex; }
    .hero { padding: 120px 20px 60px; }
    .about-body { padding: 50px 20px; }
    .features-grid { grid-template-columns: 1fr; }
    .stat-row { grid-template-columns: repeat(3, 1fr); gap: 10px; }
    .stat-num { font-size: 2rem; }
    .contact-section { padding: 60px 20px; }
    .contact-grid { grid-template-columns: 1fr; }
    .cta-bar { padding: 60px 20px; }
}
</style>
 
<nav>
    <a href="/" class="nav-logo">MINIEH <span>FAN ZONE</span></a>
    <ul class="nav-links" id="nav-links">
        <li><a href="/">Home</a></li>
        <li><a href="/matches">Matches</a></li>
        <li><a href="/tickets">Tickets</a></li>
        <li><a href="/venue">Venue</a></li>
        <li><a href="/about" class="active">About</a></li>
    </ul>
    <a href="/reserve" class="nav-btn">🎟️ Reserve Now</a>
    <button class="nav-hamburger" onclick="toggleNav()">☰</button>
</nav>
 
<div class="hero">
    <span class="eyebrow">Minieh · Lebanon · 2026</span>
    <h1>MINIEH WORLD CUP<br><span>CORNICHE FESTIVAL</span></h1>
    <p class="hero-sub">Where Football Meets Experience</p>
</div>
 
<div class="about-body">
 
    <p class="about-text">
        The <strong>Minieh World Cup Corniche Festival 2026</strong> is a first-of-its-kind large-scale fan experience in Lebanon, where football, entertainment, and seaside lifestyle come together in one dynamic destination.
    </p>
 
    <p class="about-text">
        Taking place from <span class="gold">June 11 to July 19</span> along the Minieh Corniche, the festival redefines how the FIFA World Cup is experienced — transforming match viewing into a fully immersive, social, and live environment.
    </p>
 
    <div class="highlight-box">
        At the heart of the event stands a bold and iconic concept: a <strong>giant LED screen installed over the sea</strong>, where thousands gather daily along the shore to watch, react, and celebrate the game together in an unforgettable setting.
    </div>
 
    <p class="about-text"><strong>But this is more than football…</strong><br>
    It is a complete lifestyle destination that blends:</p>
 
    <div class="features-grid">
        <div class="feature-item"><div class="feature-icon">📺</div><div class="feature-text"><strong>Live Match Screenings</strong>All 64 FIFA World Cup matches on giant screen</div></div>
        <div class="feature-item"><div class="feature-icon">🎵</div><div class="feature-text"><strong>Music, Shows & Nightlife</strong>Top DJs and live entertainment every night</div></div>
        <div class="feature-item"><div class="feature-icon">🍔</div><div class="feature-text"><strong>Food & Beverage Experiences</strong>Local and international food and drinks</div></div>
        <div class="feature-item"><div class="feature-icon">⚽</div><div class="feature-text"><strong>Daily Sports Activations</strong>Footnet, Teqball, Football challenges and more</div></div>
        <div class="feature-item"><div class="feature-icon">🏆</div><div class="feature-text"><strong>Interactive Competitions</strong>Audience engagement and live prizes</div></div>
        <div class="feature-item"><div class="feature-icon">🌊</div><div class="feature-text"><strong>Seaside Location</strong>Right on the beautiful Minieh Corniche</div></div>
    </div>
 
    <p class="about-text">
        Designed as a full fan journey, the festival transforms visitors from spectators into active participants — encouraging longer stays, deeper engagement, and stronger emotional connection.
    </p>
 
    <div class="stat-row">
        <div class="stat-box"><span class="stat-num">70K+</span><span class="stat-lbl">Expected Visitors</span></div>
        <div class="stat-box"><span class="stat-num">39</span><span class="stat-lbl">Days of Football</span></div>
        <div class="stat-box"><span class="stat-num">64</span><span class="stat-lbl">World Cup Matches</span></div>
    </div>
 
    <div class="closing-quote">
        <p>We don't just show matches…<br><span>We create experiences, build destinations,<br>and turn moments into memories.</span></p>
    </div>
 
</div>
 
<div class="contact-section">
    <div class="contact-inner">
        <h2 class="section-title">GET IN <span>TOUCH</span></h2>
        <div class="contact-grid">
            <a href="https://wa.me/96103527382" target="_blank" class="contact-card">
                <div class="icon wa">📱</div>
                <div class="info">
                    <span class="label">WhatsApp</span>
                    <span class="value">+961 03 527 382</span>
                    <span class="sub">Chat with us directly</span>
                </div>
            </a>
            <a href="mailto:tickets@miniehfanzone.com" class="contact-card">
                <div class="icon em">✉️</div>
                <div class="info">
                    <span class="label">Email</span>
                    <span class="value">tickets@miniehfanzone.com</span>
                    <span class="sub">For reservations & inquiries</span>
                </div>
            </a>
            <a href="https://miniehfanzone.com" target="_blank" class="contact-card">
                <div class="icon web">🌐</div>
                <div class="info">
                    <span class="label">Website</span>
                    <span class="value">miniehfanzone.com</span>
                    <span class="sub">Book your spot online</span>
                </div>
            </a>
            <a href="https://maps.app.goo.gl/S5BUFmoZ4L8v1W2Q8" target="_blank" class="contact-card">
                <div class="icon lo">📍</div>
                <div class="info">
                    <span class="label">Location</span>
                    <span class="value">Minieh Corniche, North Lebanon</span>
                    <span class="sub">Open directions in Google Maps</span>
                </div>
            </a>
        </div>
 
        <div class="map-wrap">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3315.0!2d35.982!3d34.448!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzTCsDI2JzUyLjgiTiAzNcKwNTgnNTUuMiJF!5e0!3m2!1sen!2slb!4v1"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</div>
 
<div class="cta-bar">
    <h2>READY TO JOIN THE <span style="color:var(--gold)">FESTIVAL?</span></h2>
    <p>Limited spots available. Book now to secure your place at the biggest event in North Lebanon.</p>
    <a href="/reserve" class="btn-primary">🎟️ Reserve Your Spot</a>
</div>
 
<footer>
    <p>© 2026 Minieh Fan Zone. All rights reserved. 🇱🇧</p>
</footer>
 
<script>
function toggleNav(){document.getElementById('nav-links').classList.toggle('open');}
</script>
 
@endsection