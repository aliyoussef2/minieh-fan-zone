@extends('layouts.app')

@section('content')

<style>
/* ===== HERO ===== */
.hero {
    min-height: 100vh;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    background: linear-gradient(160deg, #043527 0%, #07B9ED 60%, #36BA9C 100%);
}

.hero-bg-animated {
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse 70% 60% at 10% 50%, rgba(7,185,237,0.4) 0%, transparent 60%),
        radial-gradient(ellipse 50% 70% at 90% 30%, rgba(54,186,156,0.3) 0%, transparent 60%),
        radial-gradient(ellipse 60% 40% at 50% 90%, rgba(4,53,39,0.6) 0%, transparent 60%);
    animation: heroBgPulse 10s ease-in-out infinite alternate;
}

@keyframes heroBgPulse {
    0% { opacity: 1; }
    100% { opacity: 0.7; filter: hue-rotate(10deg); }
}

.hero-waves {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    overflow: hidden;
    line-height: 0;
}

.hero-waves svg {
    display: block;
    width: calc(100% + 1.3px);
    height: 80px;
}

.particles {
    position: absolute;
    inset: 0;
    overflow: hidden;
    pointer-events: none;
}

.p-dot {
    position: absolute;
    border-radius: 50%;
    animation: floatUp linear infinite;
    opacity: 0;
}

@keyframes floatUp {
    0% { transform: translateY(100vh) scale(0); opacity: 0; }
    10% { opacity: 1; }
    90% { opacity: 0.6; }
    100% { transform: translateY(-100px) scale(1) translateX(var(--dx)); opacity: 0; }
}

.hero-grid {
    position: absolute;
    inset: 0;
    background-image:
        linear-gradient(rgba(255,255,255,0.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.04) 1px, transparent 1px);
    background-size: 80px 80px;
}

.hero-content {
    position: relative;
    z-index: 10;
    width: 100%;
    padding: 140px 0 120px;
}

.live-badge {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: rgba(255,255,255,0.12);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.25);
    color: white;
    padding: 10px 22px;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 3px;
    text-transform: uppercase;
    margin-bottom: 35px;
}

.live-dot {
    width: 8px; height: 8px;
    background: #E7E640;
    border-radius: 50%;
    animation: blink 1s infinite;
}

@keyframes blink { 0%,100%{opacity:1;} 50%{opacity:0;} }

.hero-title {
    font-family: 'Bebas Neue', cursive;
    font-size: clamp(3.5rem, 11vw, 9rem);
    line-height: 0.9;
    letter-spacing: 2px;
    margin-bottom: 30px;
}

.hero-title .line-white { color: white; display: block; }
.hero-title .line-yellow { display: block; color: #E7E640; }
.hero-title .line-outline {
    display: block;
    color: transparent;
    -webkit-text-stroke: 2px rgba(255,255,255,0.6);
}

.container-festival {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 30px;
}

* { margin: 0; padding: 0; box-sizing: border-box; }
body { font-family: 'Instrument Sans', sans-serif; }
a { text-decoration: none; }

.btn-festival {
    font-family: 'Bebas Neue', cursive;
    letter-spacing: 3px;
    background: #E7E640;
    color: #043527;
    padding: 16px 45px;
    border-radius: 4px;
    font-size: 0.9rem;
    display: inline-block;
    transition: all 0.3s;
}

.btn-festival:hover { background: white; }

.btn-outline {
    font-family: 'Bebas Neue', cursive;
    letter-spacing: 3px;
    background: transparent;
    color: white;
    padding: 16px 45px;
    border-radius: 4px;
    font-size: 0.9rem;
    border: 1px solid rgba(255,255,255,0.4);
    display: inline-block;
    transition: all 0.3s;
}

.hero-btns {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
    margin-bottom: 60px;
}

.hero-stats {
    display: flex;
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(255,255,255,0.15);
    border-radius: 12px;
    overflow: hidden;
    max-width: 520px;
}

.stat-box {
    flex: 1;
    padding: 20px 25px;
    text-align: center;
    border-right: 1px solid rgba(255,255,255,0.1);
}

.stat-box:last-child { border-right: none; }

.stat-num {
    font-family: 'Bebas Neue', cursive;
    font-size: 2.2rem;
    color: #E7E640;
    line-height: 1;
    display: block;
}

.stat-lbl {
    font-size: 0.62rem;
    font-weight: 600;
    letter-spacing: 2px;
    color: rgba(255,255,255,0.5);
    text-transform: uppercase;
    margin-top: 5px;
    display: block;
}

.date-strip {
    display: inline-flex;
    align-items: center;
    gap: 20px;
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
    padding: 12px 25px;
    border-radius: 8px;
    margin-bottom: 45px;
}

.date-strip span {
    font-size: 0.78rem;
    font-weight: 600;
    letter-spacing: 2px;
    color: rgba(255,255,255,0.85);
    text-transform: uppercase;
}

.date-strip .sep {
    width: 4px; height: 4px;
    background: #E7E640;
    border-radius: 50%;
}

.hero-desc {
    font-size: 1.1rem;
    color: rgba(255,255,255,0.75);
    line-height: 1.9;
    max-width: 540px;
    margin-bottom: 45px;
}
</style>

{{-- HERO --}}
<section class="hero">
    <div class="hero-bg-animated"></div>
    <div class="hero-grid"></div>
    <div class="particles" id="particles"></div>

    <div class="container-festival hero-content">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:60px;align-items:center;">
            <div>
                <div class="live-badge">
                    <span class="live-dot"></span>
                    June 11 — July 19, 2026
                </div>

                <h1 class="hero-title">
                    <span class="line-white">MINIEH</span>
                    <span class="line-yellow">WORLD CUP</span>
                    <span class="line-outline">CORNICHE</span>
                    <span class="line-white" style="font-size:0.55em;letter-spacing:8px;color:rgba(255,255,255,0.7);">FESTIVAL</span>
                </h1>

                <div class="date-strip">
                    <span>📍 Minieh Corniche</span>
                    <span class="sep"></span>
                    <span>🇱🇧 Lebanon</span>
                    <span class="sep"></span>
                    <span>⚽ 39 Days</span>
                </div>

                <p class="hero-desc">
                    Where Football Meets the Sea. Lebanon's first large-scale World Cup fan destination — giant screen over the water, live shows, and an atmosphere unlike anything you've ever experienced.
                </p>

                <div class="hero-btns">
                    <a href="/book-now" class="btn-festival">🎟️ Book Tickets</a>
                    <a href="#experience" class="btn-outline">Explore Experience</a>
                </div>

                <div class="hero-stats">
                    <div class="stat-box">
                        <span class="stat-num">70K+</span>
                        <span class="stat-lbl">Visitors</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-num">39</span>
                        <span class="stat-lbl">Days</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-num">64</span>
                        <span class="stat-lbl">Matches</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-num">1</span>
                        <span class="stat-lbl">Epic Venue</span>
                    </div>
                </div>
            </div>

            <div style="display:flex;align-items:center;justify-content:center;">
                <div style="font-size:10rem;animation:ballFloat 4s ease-in-out infinite;">⚽</div>
            </div>
        </div>
    </div>

    <div class="hero-waves">
        <svg viewBox="0 0 1200 80" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,40 C200,80 400,0 600,40 C800,80 1000,0 1200,40 L1200,80 L0,80 Z" fill="#ffffff"/>
        </svg>
    </div>
</section>

<script>
const pc = document.getElementById('particles');
for(let i=0;i<50;i++){
    const p=document.createElement('div');
    p.className='p-dot';
    const size=Math.random()*5+2;
    p.style.cssText=`
        left:${Math.random()*100}%;
        width:${size}px;height:${size}px;
        background:${['rgba(255,255,255,0.6)','rgba(231,230,64,0.6)','rgba(160,218,219,0.6)'][Math.floor(Math.random()*3)]};
        animation-duration:${Math.random()*15+8}s;
        animation-delay:${Math.random()*10}s;
        --dx:${(Math.random()-0.5)*150}px;
    `;
    pc.appendChild(p);
}
</script>

@endsection