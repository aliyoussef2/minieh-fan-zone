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

body {
    background: var(--navy);
    font-family: 'Instrument Sans', sans-serif;
    color: var(--white);
}

/* NAV */
nav {
    position: fixed;
    top: 0; left: 0; right: 0;
    z-index: 100;
    padding: 20px 60px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: rgba(11,18,32,0.8);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(30,136,255,0.15);
}

.nav-logo {
    font-family: 'Bebas Neue', cursive;
    font-size: 1.5rem;
    letter-spacing: 3px;
    color: var(--white);
    text-decoration: none;
    white-space: nowrap;
}

.nav-logo span { color: var(--gold); }

.nav-links {
    display: flex;
    gap: 35px;
    list-style: none;
}

.nav-links a {
    color: rgba(255,255,255,0.7);
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 600;
    letter-spacing: 2px;
    text-transform: uppercase;
    transition: color 0.3s;
}

.nav-links a:hover { color: var(--gold); }

.nav-btn {
    background: var(--blue);
    color: white;
    padding: 10px 25px;
    border-radius: 6px;
    font-size: 0.8rem;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    text-decoration: none;
    transition: all 0.3s;
    white-space: nowrap;
}

.nav-btn:hover { background: var(--gold); color: var(--navy); }

.nav-hamburger {
    display: none;
    background: none;
    border: 1px solid rgba(255,255,255,0.2);
    color: var(--white);
    font-size: 1.3rem;
    cursor: pointer;
    padding: 6px 12px;
    border-radius: 6px;
}

@media (max-width: 768px) {
    nav {
        padding: 15px 20px;
        flex-wrap: wrap;
        gap: 8px;
    }
    .nav-hamburger { display: block; }
    .nav-btn { display: none; }
    .nav-links {
        display: none;
        flex-direction: column;
        width: 100%;
        gap: 12px;
        padding: 15px 0 5px;
        border-top: 1px solid rgba(255,255,255,0.08);
    }
    .nav-links.open { display: flex; }
    .nav-links a { font-size: 1rem; letter-spacing: 1px; }
}

/* HERO */
.hero {
    min-height: 100vh;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    overflow: hidden;
}

.hero-bg {
    position: absolute;
    inset: 0;
    background:
        linear-gradient(rgba(11,18,32,0.7), rgba(11,18,32,0.85)),
        url('/images/minieh-bg.webp') center/cover no-repeat;
}

.hero-content {
    position: relative;
    z-index: 10;
    max-width: 900px;
    padding: 0 20px;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: rgba(30,136,255,0.15);
    border: 1px solid rgba(30,136,255,0.4);
    padding: 8px 20px;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--blue);
    margin-bottom: 30px;
}

.hero-badge-dot {
    width: 8px; height: 8px;
    background: var(--blue);
    border-radius: 50%;
    animation: blink 1s infinite;
}

@keyframes blink { 0%,100%{opacity:1;} 50%{opacity:0;} }

.hero-title {
    font-family: 'Bebas Neue', cursive;
    font-size: clamp(3rem, 8vw, 5.5rem);
    line-height: 0.9;
    letter-spacing: 3px;
    margin-bottom: 25px;
}

.hero-title .gold { color: var(--gold); }

.hero-subtitle {
    font-size: 1rem;
    color: rgba(255,255,255,0.65);
    line-height: 1.8;
    max-width: 600px;
    margin: 0 auto 40px;
    padding: 0 10px;
}

.hero-btns {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: 50px;
}

.btn-primary {
    background: var(--gold);
    color: var(--navy);
    padding: 16px 35px;
    border-radius: 6px;
    font-family: 'Bebas Neue', cursive;
    font-size: 1rem;
    letter-spacing: 3px;
    text-decoration: none;
    transition: all 0.3s;
    display: inline-block;
}

.btn-primary:hover { background: white; transform: translateY(-2px); }

.btn-secondary {
    background: transparent;
    color: white;
    padding: 16px 35px;
    border-radius: 6px;
    font-family: 'Bebas Neue', cursive;
    font-size: 1rem;
    letter-spacing: 3px;
    text-decoration: none;
    border: 1px solid rgba(255,255,255,0.3);
    transition: all 0.3s;
    display: inline-block;
}

.btn-secondary:hover { border-color: var(--gold); color: var(--gold); }

/* COUNTDOWN */
.countdown {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
}

.countdown-box {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(30,136,255,0.2);
    border-radius: 12px;
    padding: 18px 20px;
    min-width: 75px;
    text-align: center;
}

.countdown-num {
    font-family: 'Bebas Neue', cursive;
    font-size: 2.5rem;
    color: var(--gold);
    line-height: 1;
    display: block;
}

.countdown-lbl {
    font-size: 0.6rem;
    font-weight: 700;
    letter-spacing: 2px;
    color: rgba(255,255,255,0.4);
    text-transform: uppercase;
    margin-top: 5px;
    display: block;
}

/* STATS */
.stats-section {
    padding: 60px 20px;
    background: rgba(30,136,255,0.05);
    border-top: 1px solid rgba(30,136,255,0.1);
    border-bottom: 1px solid rgba(30,136,255,0.1);
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    max-width: 900px;
    margin: 0 auto;
    text-align: center;
}

@media (max-width: 600px) {
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
}

.stat-num {
    font-family: 'Bebas Neue', cursive;
    font-size: 3rem;
    color: var(--gold);
    display: block;
    line-height: 1;
}

.stat-lbl {
    font-size: 0.7rem;
    font-weight: 600;
    letter-spacing: 2px;
    color: rgba(255,255,255,0.4);
    text-transform: uppercase;
    margin-top: 8px;
    display: block;
}

/* FEATURES */
.features-section {
    padding: 80px 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.section-label {
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 4px;
    color: var(--blue);
    text-transform: uppercase;
    display: block;
    text-align: center;
    margin-bottom: 15px;
}

.section-title {
    font-family: 'Bebas Neue', cursive;
    font-size: clamp(2.5rem, 6vw, 5rem);
    letter-spacing: 2px;
    text-align: center;
    margin-bottom: 50px;
    color: var(--white);
}

.section-title span { color: var(--gold); }

.features-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

@media (max-width: 768px) {
    .features-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 480px) {
    .features-grid { grid-template-columns: 1fr; }
}

.feature-card {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(30,136,255,0.1);
    border-radius: 16px;
    padding: 30px 20px;
    text-align: center;
    transition: all 0.4s;
}

.feature-card:hover {
    background: rgba(30,136,255,0.08);
    border-color: rgba(30,136,255,0.3);
    transform: translateY(-8px);
}

.feature-icon { font-size: 2.5rem; margin-bottom: 15px; display: block; }

.feature-title {
    font-family: 'Bebas Neue', cursive;
    font-size: 1.4rem;
    letter-spacing: 2px;
    color: var(--white);
    margin-bottom: 10px;
}

.feature-desc {
    font-size: 0.85rem;
    color: rgba(255,255,255,0.5);
    line-height: 1.8;
}

/* CTA */
.cta-section {
    padding: 80px 20px;
    text-align: center;
    background: linear-gradient(135deg, rgba(30,136,255,0.1), rgba(255,215,0,0.05));
    border-top: 1px solid rgba(30,136,255,0.1);
}

.cta-title {
    font-family: 'Bebas Neue', cursive;
    font-size: clamp(2.5rem, 8vw, 7rem);
    letter-spacing: 2px;
    line-height: 0.9;
    margin-bottom: 25px;
}

/* FOOTER */
footer {
    padding: 30px 20px;
    text-align: center;
    border-top: 1px solid rgba(255,255,255,0.05);
    color: rgba(255,255,255,0.3);
    font-size: 0.85rem;
}
</style>

{{-- NAV --}}
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

{{-- HERO --}}
<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-content">
        <div class="hero-badge">
            <span class="hero-badge-dot"></span>
            Official FIFA World Cup 2026 Viewing Experience
        </div>
        <h1 class="hero-title">
            MINIEH<br>
            <span class="gold">FAN ZONE</span><br>
            2026
        </h1>
        <p class="hero-subtitle">Watch every FIFA World Cup match live on a giant screen with thousands of football fans on the beautiful Minieh Corniche.</p>
        <div class="hero-btns">
            <a href="/reserve" class="btn-primary">🎟️ Reserve Tickets</a>
            <a href="/matches" class="btn-secondary">📅 View Matches</a>
        </div>
        <div class="countdown" id="countdown">
            <div class="countdown-box">
                <span class="countdown-num" id="days">00</span>
                <span class="countdown-lbl">Days</span>
            </div>
            <div class="countdown-box">
                <span class="countdown-num" id="hours">00</span>
                <span class="countdown-lbl">Hours</span>
            </div>
            <div class="countdown-box">
                <span class="countdown-num" id="minutes">00</span>
                <span class="countdown-lbl">Minutes</span>
            </div>
            <div class="countdown-box">
                <span class="countdown-num" id="seconds">00</span>
                <span class="countdown-lbl">Seconds</span>
            </div>
        </div>
    </div>
</section>

{{-- STATS --}}
<section class="stats-section">
    <div class="stats-grid">
        <div>
            <span class="stat-num">70K+</span>
            <span class="stat-lbl">Expected Visitors</span>
        </div>
        <div>
            <span class="stat-num">39</span>
            <span class="stat-lbl">Days of Football</span>
        </div>
        <div>
            <span class="stat-num">64</span>
            <span class="stat-lbl">World Cup Matches</span>
        </div>
        <div>
            <span class="stat-num">4</span>
            <span class="stat-lbl">Seating Levels</span>
        </div>
    </div>
</section>

{{-- FEATURES --}}
<section class="features-section">
    <span class="section-label">The Experience</span>
    <h2 class="section-title">Everything You <span>Need</span></h2>
    <div class="features-grid">
        <div class="feature-card">
            <span class="feature-icon">📺</span>
            <h3 class="feature-title">Giant LED Screen</h3>
            <p class="feature-desc">A massive screen over the Mediterranean sea. Experience every goal like you're in the stadium.</p>
        </div>
        <div class="feature-card">
            <span class="feature-icon">🎟️</span>
            <h3 class="feature-title">Online Booking</h3>
            <p class="feature-desc">Reserve your seat in minutes. Get a digital ticket with QR code sent directly to your email.</p>
        </div>
        <div class="feature-card">
            <span class="feature-icon">👑</span>
            <h3 class="feature-title">VIP Experience</h3>
            <p class="feature-desc">Luxury tables, premium service, and the best views. The ultimate World Cup experience in Lebanon.</p>
        </div>
        <div class="feature-card">
            <span class="feature-icon">🍔</span>
            <h3 class="feature-title">Food & Drinks</h3>
            <p class="feature-desc">Best local and international food and drinks. Everything you need for the perfect match night.</p>
        </div>
        <div class="feature-card">
            <span class="feature-icon">🎵</span>
            <h3 class="feature-title">Live Entertainment</h3>
            <p class="feature-desc">Top DJs and live music every night. The party doesn't stop even at half time.</p>
        </div>
        <div class="feature-card">
            <span class="feature-icon">🌊</span>
            <h3 class="feature-title">Seaside Location</h3>
            <p class="feature-desc">Right on the Minieh Corniche. Sea breeze, stunning views, and thousands of passionate fans.</p>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="cta-section">
    <h2 class="cta-title">DON'T MISS<br><span style="color:var(--gold);">THE FESTIVAL</span></h2>
    <p style="color:rgba(255,255,255,0.5);font-size:1rem;max-width:500px;margin:0 auto 40px;line-height:1.9;">Limited seats available. Book now to secure your spot at the biggest event in North Lebanon.</p>
    <div class="hero-btns">
        <a href="/reserve" class="btn-primary">🎟️ Book Now</a>
        <a href="/matches" class="btn-secondary">View Matches</a>
    </div>
</section>

{{-- FOOTER --}}
<footer>
    <p>© 2026 Minieh Fan Zone. All rights reserved. 🇱🇧</p>
</footer>

<script>
function toggleNav() {
    document.getElementById('nav-links').classList.toggle('open');
}

function updateCountdown() {
    const target = new Date('2026-06-11T19:00:00');
    const now = new Date();
    const diff = target - now;
    if (diff <= 0) return;
    const days = Math.floor(diff / (1000*60*60*24));
    const hours = Math.floor((diff % (1000*60*60*24)) / (1000*60*60));
    const minutes = Math.floor((diff % (1000*60*60)) / (1000*60));
    const seconds = Math.floor((diff % (1000*60)) / 1000);
    document.getElementById('days').textContent = String(days).padStart(2,'0');
    document.getElementById('hours').textContent = String(hours).padStart(2,'0');
    document.getElementById('minutes').textContent = String(minutes).padStart(2,'0');
    document.getElementById('seconds').textContent = String(seconds).padStart(2,'0');
}
setInterval(updateCountdown, 1000);
updateCountdown();
</script>

@endsection