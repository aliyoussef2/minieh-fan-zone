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
    border-bottom: 1px solid rgba(30,136,255,0.15);
}
.nav-logo { font-family: 'Bebas Neue', cursive; font-size: 1.5rem; letter-spacing: 3px; color: var(--white); text-decoration: none; white-space: nowrap; }
.nav-logo span { color: var(--gold); }
.nav-links { display: flex; gap: 35px; list-style: none; }
.nav-links a { color: rgba(255,255,255,0.7); text-decoration: none; font-size: 0.85rem; font-weight: 600; letter-spacing: 2px; text-transform: uppercase; transition: color 0.3s; position: relative; }
.nav-links a::after { content:''; position:absolute; bottom:-4px; left:0; width:0; height:2px; background:var(--gold); transition:width 0.3s; }
.nav-links a:hover::after { width:100%; }
.nav-links a:hover { color: var(--gold); }
.nav-btn { background: var(--blue); color: white; padding: 10px 25px; border-radius: 6px; font-size: 0.8rem; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; text-decoration: none; transition: all 0.3s; white-space: nowrap; }
.nav-btn:hover { background: var(--gold); color: var(--navy); }
.nav-hamburger { display: none; background: none; border: 1px solid rgba(255,255,255,0.2); color: var(--white); font-size: 1.3rem; cursor: pointer; padding: 6px 12px; border-radius: 6px; }
 
/* AD SLIDER */
.ad-slider-wrap { width:100%; overflow:hidden; position:relative; background:#000; }
.ad-slider-track { display:flex; transition:transform 0.6s ease; }
.ad-slide { min-width:100%; }
.ad-slide img { width:100%; height:220px; object-fit:cover; display:block; }
.ad-dots { position:absolute; bottom:10px; left:50%; transform:translateX(-50%); display:flex; gap:6px; z-index:10; }
.ad-dot { width:8px; height:8px; border-radius:50%; background:rgba(255,255,255,0.4); cursor:pointer; transition:background 0.3s; }
.ad-dot.active { background:#FFD700; }
 
.hero { min-height:100vh; position:relative; display:flex; align-items:center; justify-content:center; text-align:center; overflow:hidden; }
.hero-bg { position:absolute; inset:0; background:linear-gradient(rgba(11,18,32,0.7),rgba(11,18,32,0.85)),url('/images/minieh-bg.webp') center/cover no-repeat; }
.hero-bg::after { content:''; position:absolute; inset:0; background:linear-gradient(135deg,rgba(30,136,255,0.05),rgba(255,215,0,0.03),rgba(30,136,255,0.05)); background-size:400% 400%; animation:gradientShift 8s ease infinite; }
.hero-content { position:relative; z-index:10; max-width:900px; padding:0 20px; }
 
.hero-badge { display:inline-flex; align-items:center; gap:10px; background:rgba(30,136,255,0.15); border:1px solid rgba(30,136,255,0.4); padding:8px 20px; border-radius:50px; font-size:0.75rem; font-weight:700; letter-spacing:3px; text-transform:uppercase; color:var(--blue); margin-bottom:30px; animation:fadeIn 0.8s ease forwards; opacity:0; }
.hero-badge-dot { width:8px; height:8px; background:var(--blue); border-radius:50%; animation:blink 1s infinite; }
.hero-title { font-family:'Bebas Neue',cursive; font-size:clamp(3rem,8vw,5.5rem); line-height:0.9; letter-spacing:3px; margin-bottom:25px; animation:scaleIn 1s ease 0.3s forwards; opacity:0; }
.hero-title .gold { color:var(--gold); }
.hero-subtitle { font-size:1rem; color:rgba(255,255,255,0.65); line-height:1.8; max-width:600px; margin:0 auto 40px; padding:0 10px; animation:fadeUp 0.8s ease 0.7s forwards; opacity:0; }
.hero-btns { display:flex; gap:15px; justify-content:center; flex-wrap:wrap; margin-bottom:50px; animation:fadeUp 0.8s ease 0.9s forwards; opacity:0; }
.countdown { display:flex; gap:15px; justify-content:center; flex-wrap:wrap; animation:fadeUp 0.8s ease 1.1s forwards; opacity:0; }
 
.btn-primary { background:var(--gold); color:var(--navy); padding:16px 35px; border-radius:6px; font-family:'Bebas Neue',cursive; font-size:1rem; letter-spacing:3px; text-decoration:none; transition:all 0.3s; display:inline-block; position:relative; overflow:hidden; }
.btn-primary::after { content:''; position:absolute; inset:0; background:rgba(255,255,255,0.15); transform:translateX(-100%); transition:transform 0.3s; }
.btn-primary:hover { background:white; transform:translateY(-2px); }
.btn-primary:hover::after { transform:translateX(0); }
.btn-secondary { background:transparent; color:white; padding:16px 35px; border-radius:6px; font-family:'Bebas Neue',cursive; font-size:1rem; letter-spacing:3px; text-decoration:none; border:1px solid rgba(255,255,255,0.3); transition:all 0.3s; display:inline-block; }
.btn-secondary:hover { border-color:var(--gold); color:var(--gold); }
 
.countdown-box { background:rgba(255,255,255,0.05); border:1px solid rgba(30,136,255,0.2); border-radius:12px; padding:18px 20px; min-width:75px; text-align:center; animation:float 3s ease-in-out infinite; }
.countdown-box:nth-child(2) { animation-delay:0.3s; }
.countdown-box:nth-child(3) { animation-delay:0.6s; }
.countdown-box:nth-child(4) { animation-delay:0.9s; }
.countdown-num { font-family:'Bebas Neue',cursive; font-size:2.5rem; color:var(--gold); line-height:1; display:block; transition:color 0.3s; }
.countdown-box:hover .countdown-num { color:white; text-shadow:0 0 20px var(--gold); }
.countdown-lbl { font-size:0.6rem; font-weight:700; letter-spacing:2px; color:rgba(255,255,255,0.4); text-transform:uppercase; margin-top:5px; display:block; }
 
.stats-section { padding:60px 20px; background:rgba(30,136,255,0.05); border-top:1px solid rgba(30,136,255,0.1); border-bottom:1px solid rgba(30,136,255,0.1); }
.stats-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:20px; max-width:900px; margin:0 auto; text-align:center; }
.stat-num { font-family:'Bebas Neue',cursive; font-size:3rem; color:var(--gold); display:block; line-height:1; animation:countUp 0.6s ease forwards; opacity:0; }
.stats-grid > div:nth-child(1) .stat-num { animation-delay:0.1s; }
.stats-grid > div:nth-child(2) .stat-num { animation-delay:0.25s; }
.stats-grid > div:nth-child(3) .stat-num { animation-delay:0.4s; }
.stats-grid > div:nth-child(4) .stat-num { animation-delay:0.55s; }
.stat-lbl { font-size:0.7rem; font-weight:600; letter-spacing:2px; color:rgba(255,255,255,0.4); text-transform:uppercase; margin-top:8px; display:block; }
 
.features-section { padding:80px 20px; max-width:1200px; margin:0 auto; }
.section-label { font-size:0.7rem; font-weight:700; letter-spacing:4px; color:var(--blue); text-transform:uppercase; display:block; text-align:center; margin-bottom:15px; }
.section-title { font-family:'Bebas Neue',cursive; font-size:clamp(2.5rem,6vw,5rem); letter-spacing:2px; text-align:center; margin-bottom:50px; color:var(--white); }
.section-title span { color:var(--gold); }
.features-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:20px; }
.feature-card { background:rgba(255,255,255,0.03); border:1px solid rgba(30,136,255,0.1); border-radius:16px; padding:30px 20px; text-align:center; opacity:0; transform:translateY(30px); transition:opacity 0.6s ease,transform 0.6s ease,background 0.4s,border-color 0.4s,box-shadow 0.4s; }
.feature-card.visible { opacity:1; transform:translateY(0); }
.feature-card:hover { background:rgba(30,136,255,0.08); border-color:rgba(30,136,255,0.3); transform:translateY(-8px); box-shadow:0 0 30px rgba(30,136,255,0.2); }
.feature-icon { font-size:2.5rem; margin-bottom:15px; display:block; }
.feature-title { font-family:'Bebas Neue',cursive; font-size:1.4rem; letter-spacing:2px; color:var(--white); margin-bottom:10px; }
.feature-desc { font-size:0.85rem; color:rgba(255,255,255,0.5); line-height:1.8; }
 
/* FAQ */
.faq-section { padding:80px 20px; max-width:800px; margin:0 auto; }
.faq-list { display:flex; flex-direction:column; gap:12px; }
.faq-item { background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.08); border-radius:12px; overflow:hidden; transition:border-color 0.3s; }
.faq-item:hover { border-color:rgba(255,215,0,0.25); }
.faq-q { display:flex; justify-content:space-between; align-items:center; padding:20px 24px; cursor:pointer; font-size:0.95rem; font-weight:600; color:var(--white); gap:15px; }
.faq-icon { font-size:1.4rem; color:var(--gold); flex-shrink:0; transition:transform 0.3s; font-weight:300; }
.faq-item.open .faq-icon { transform:rotate(45deg); }
.faq-a { max-height:0; overflow:hidden; transition:max-height 0.4s ease,padding 0.3s; font-size:0.88rem; color:rgba(255,255,255,0.6); line-height:1.8; padding:0 24px; }
.faq-item.open .faq-a { max-height:200px; padding:0 24px 20px; }
 
.cta-section { padding:80px 20px; text-align:center; background:linear-gradient(135deg,rgba(30,136,255,0.1),rgba(255,215,0,0.05)); border-top:1px solid rgba(30,136,255,0.1); }
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
@keyframes float { 0%,100%{transform:translateY(0);} 50%{transform:translateY(-8px);} }
@keyframes glow { 0%,100%{box-shadow:0 0 20px rgba(255,215,0,0.2);} 50%{box-shadow:0 0 40px rgba(255,215,0,0.5);} }
@keyframes gradientShift { 0%{background-position:0% 50%;} 50%{background-position:100% 50%;} 100%{background-position:0% 50%;} }
@keyframes countUp { from{opacity:0;transform:translateY(20px) scale(0.8);} to{opacity:1;transform:translateY(0) scale(1);} }
 
@media (max-width:768px) {
    nav { padding:15px 20px; flex-wrap:wrap; gap:8px; }
    .nav-hamburger { display:block; }
    .nav-btn { display:none; }
    .nav-links { display:none; flex-direction:column; width:100%; gap:12px; padding:15px 0 5px; border-top:1px solid rgba(255,255,255,0.08); }
    .nav-links.open { display:flex; }
    .nav-links a { font-size:1rem; letter-spacing:1px; }
    .features-grid { grid-template-columns:repeat(2,1fr); }
    .stats-grid { grid-template-columns:repeat(2,1fr); }
    .ad-slide img { height:140px; }
}
@media (max-width:480px) {
    .features-grid { grid-template-columns:1fr; }
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
        <div class="countdown" id="countdown">
            <div class="countdown-box"><span class="countdown-num" id="days">00</span><span class="countdown-lbl">Days</span></div>
            <div class="countdown-box"><span class="countdown-num" id="hours">00</span><span class="countdown-lbl">Hours</span></div>
            <div class="countdown-box"><span class="countdown-num" id="minutes">00</span><span class="countdown-lbl">Minutes</span></div>
            <div class="countdown-box"><span class="countdown-num" id="seconds">00</span><span class="countdown-lbl">Seconds</span></div>
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
        <div class="feature-card"><span class="feature-icon">📺</span><h3 class="feature-title">Giant LED Screen</h3><p class="feature-desc">A massive screen over the Mediterranean sea. Experience every goal like you're in the stadium.</p></div>
        <div class="feature-card"><span class="feature-icon">🎟️</span><h3 class="feature-title">Online Booking</h3><p class="feature-desc">Reserve your seat in minutes. Get a digital ticket with QR code sent directly to your email.</p></div>
        <div class="feature-card"><span class="feature-icon">👑</span><h3 class="feature-title">VIP Experience</h3><p class="feature-desc">Luxury tables, premium service, and the best views. The ultimate World Cup experience in Lebanon.</p></div>
        <div class="feature-card"><span class="feature-icon">🍔</span><h3 class="feature-title">Food & Drinks</h3><p class="feature-desc">Best local and international food and drinks. Everything you need for the perfect match night.</p></div>
        <div class="feature-card"><span class="feature-icon">🎵</span><h3 class="feature-title">Live Entertainment</h3><p class="feature-desc">Top DJs and live music every night. The party doesn't stop even at half time.</p></div>
        <div class="feature-card"><span class="feature-icon">🌊</span><h3 class="feature-title">Seaside Location</h3><p class="feature-desc">Right on the Minieh Corniche. Sea breeze, stunning views, and thousands of passionate fans.</p></div>
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
 
function updateCountdown(){
    const target=new Date('2026-06-11T19:00:00');
    const now=new Date();
    const diff=target-now;
    if(diff<=0)return;
    document.getElementById('days').textContent=String(Math.floor(diff/(1000*60*60*24))).padStart(2,'0');
    document.getElementById('hours').textContent=String(Math.floor((diff%(1000*60*60*24))/(1000*60*60))).padStart(2,'0');
    document.getElementById('minutes').textContent=String(Math.floor((diff%(1000*60*60))/(1000*60))).padStart(2,'0');
    document.getElementById('seconds').textContent=String(Math.floor((diff%(1000*60))/1000)).padStart(2,'0');
}
setInterval(updateCountdown,1000);
updateCountdown();
 
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