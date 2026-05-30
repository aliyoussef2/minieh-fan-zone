@extends('layouts.app')

@section('title', 'Venue Map — Minieh Fan Zone 2026')

@section('styles')
<style>
:root {
    --navy: #0B1220;
    --navy-light: #111827;
    --blue: #1E88FF;
    --gold: #FFD700;
    --white: #FFFFFF;
}

* { box-sizing: border-box; margin: 0; padding: 0; }

body { background: var(--navy); color: var(--white); font-family: 'Instrument Sans', sans-serif; }

.venue-header {
    text-align: center;
    padding: 6rem 1rem 2rem;
    background: linear-gradient(180deg, #060c17 0%, var(--navy) 100%);
    position: relative;
    overflow: hidden;
}
.venue-header::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 60% 50% at 50% 0%, rgba(30,136,255,0.12) 0%, transparent 70%);
    pointer-events: none;
}
.venue-header .eyebrow {
    font-family: 'Bebas Neue', sans-serif;
    letter-spacing: 0.3em;
    font-size: 0.85rem;
    color: var(--gold);
    margin-bottom: 0.75rem;
}
.venue-header h1 {
    font-family: 'Bebas Neue', sans-serif;
    font-size: clamp(2.8rem, 6vw, 5rem);
    letter-spacing: 0.05em;
    line-height: 1;
    margin-bottom: 1rem;
}
.venue-header p {
    color: rgba(255,255,255,0.6);
    font-size: 1rem;
    max-width: 540px;
    margin: 0 auto;
    line-height: 1.6;
}

.venue-wrap {
    max-width: 1300px;
    margin: 0 auto;
    padding: 3rem 1.5rem 6rem;
    display: grid;
    grid-template-columns: 1fr 340px;
    gap: 2rem;
    align-items: start;
}

.map-container {
    background: #0d1728;
    border: 1px solid rgba(255,215,0,0.15);
    border-radius: 16px;
    padding: 2rem;
    position: sticky;
    top: 1.5rem;
}
.map-container svg { width: 100%; height: auto; display: block; }

.venue-section { cursor: pointer; transition: opacity 0.2s, filter 0.2s; }
.venue-section:hover { opacity: 0.85; filter: brightness(1.15); }
.venue-section.active { filter: brightness(1.3) drop-shadow(0 0 8px var(--gold)); }

.sec-label { font-family: 'Bebas Neue', sans-serif; font-size: 14px; fill: #fff; text-anchor: middle; dominant-baseline: middle; pointer-events: none; letter-spacing: 0.05em; }
.sec-sublabel { font-family: 'Instrument Sans', sans-serif; font-size: 9px; fill: rgba(255,255,255,0.7); text-anchor: middle; dominant-baseline: middle; pointer-events: none; }

.legend { display: flex; gap: 1rem; flex-wrap: wrap; margin-top: 1.25rem; justify-content: center; }
.legend-item { display: flex; align-items: center; gap: 6px; font-size: 0.75rem; color: rgba(255,255,255,0.6); }
.legend-dot { width: 12px; height: 12px; border-radius: 3px; flex-shrink: 0; }

.sidebar { display: flex; flex-direction: column; gap: 1.25rem; }

.section-card { background: #111827; border: 1px solid rgba(255,215,0,0.2); border-radius: 14px; overflow: hidden; transition: border-color 0.3s; }
.section-card.highlighted { border-color: var(--gold); }

.section-card-header { padding: 1.25rem 1.5rem 1rem; border-bottom: 1px solid rgba(255,255,255,0.06); display: flex; align-items: center; gap: 1rem; }
.section-badge { width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-family: 'Bebas Neue', sans-serif; font-size: 1.5rem; flex-shrink: 0; transition: background 0.3s; }
.section-card-header h2 { font-family: 'Bebas Neue', sans-serif; font-size: 1.2rem; letter-spacing: 0.05em; line-height: 1.2; }
.section-card-header p { font-size: 0.78rem; color: rgba(255,255,255,0.5); margin-top: 2px; }

.section-card-body { padding: 1.25rem 1.5rem; }
.stat-row { display: flex; justify-content: space-between; align-items: center; padding: 0.55rem 0; border-bottom: 1px solid rgba(255,255,255,0.05); font-size: 0.82rem; }
.stat-row:last-child { border-bottom: none; }
.stat-label { color: rgba(255,255,255,0.5); }
.stat-value { font-weight: 600; }

.book-btn { display: block; width: 100%; margin-top: 1rem; padding: 0.9rem; background: var(--gold); color: #0B1220; font-family: 'Bebas Neue', sans-serif; font-size: 1.1rem; letter-spacing: 0.1em; border: none; border-radius: 10px; cursor: pointer; text-align: center; text-decoration: none; transition: opacity 0.2s, transform 0.15s; }
.book-btn:hover { opacity: 0.9; transform: translateY(-1px); }

.summary-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; }
.summary-card { background: #111827; border: 1px solid rgba(255,255,255,0.06); border-radius: 12px; padding: 1rem; text-align: center; }
.summary-card .num { font-family: 'Bebas Neue', sans-serif; font-size: 1.8rem; color: var(--gold); line-height: 1; }
.summary-card .lbl { font-size: 0.7rem; color: rgba(255,255,255,0.45); margin-top: 4px; text-transform: uppercase; letter-spacing: 0.08em; }

.map-prompt { text-align: center; padding: 2.5rem; color: rgba(255,255,255,0.35); font-size: 0.85rem; line-height: 1.6; }
.map-prompt .icon { font-size: 2rem; margin-bottom: 0.75rem; display: block; color: rgba(255,215,0,0.3); }

@media (max-width: 900px) {
    .venue-wrap { grid-template-columns: 1fr; }
    .map-container { position: static; }
}
</style>
@endsection

@section('content')
<nav style="background:#111827;padding:15px 30px;border-bottom:1px solid rgba(255,215,0,0.2);">
    <ul style="display:flex;gap:30px;list-style:none;margin:0;padding:0;justify-content:center;">
        <li><a href="/" style="color:white;text-decoration:none;">Home</a></li>
        <li><a href="/matches" style="color:white;text-decoration:none;">Matches</a></li>
        <li><a href="/tickets" style="color:white;text-decoration:none;">Tickets</a></li>
        <li><a href="/venue" style="color:#FFD700;text-decoration:none;">Venue</a></li>
        <li><a href="/about" style="color:white;text-decoration:none;">About</a></li>
    </ul>
</nav>

<div class="venue-header">
    <p class="eyebrow">Minieh Fan Zone 2026</p>
    <h1>Venue Map</h1>
    <p>Click any section on the map to explore seating details and capacity. 1,042 seats across 4 seating categories.</p>
</div>

<div class="venue-wrap">
    <div class="map-container">
        <svg viewBox="0 0 700 520" xmlns="http://www.w3.org/2000/svg">
            <rect width="700" height="520" fill="#0a1020" rx="8"/>
            <rect x="230" y="16" width="240" height="28" rx="4" fill="#1E88FF" opacity="0.9"/>
            <text x="350" y="30" font-family="'Bebas Neue',sans-serif" font-size="11" fill="#fff" text-anchor="middle" dominant-baseline="middle" letter-spacing="0.2em">▶ BIG SCREEN</text>
            <rect x="225" y="52" width="250" height="36" rx="4" fill="#1a1f3a" stroke="#FFD700" stroke-width="1.5"/>
            <text x="350" y="70" font-family="'Bebas Neue',sans-serif" font-size="11" fill="#FFD700" text-anchor="middle" dominant-baseline="middle" letter-spacing="0.2em">STAGE + CATWALK</text>

            <g class="venue-section" id="sec-A" onclick="selectSection('A')">
                <rect x="24" y="52" width="192" height="140" rx="8" fill="#9B4DCA" opacity="0.85"/>
                <text x="120" y="114" class="sec-label">A</text>
                <text x="120" y="130" class="sec-sublabel">VIP LOUNGE</text>
                <text x="120" y="142" class="sec-sublabel">18 tables · 108 pax</text>
            </g>
            <g class="venue-section" id="sec-B" onclick="selectSection('B')">
                <rect x="225" y="96" width="250" height="96" rx="8" fill="#7B3BB0" opacity="0.85"/>
                <text x="350" y="136" class="sec-label">B</text>
                <text x="350" y="152" class="sec-sublabel">VIP LOUNGE · 16 tables · 96 pax</text>
            </g>
            <g class="venue-section" id="sec-C" onclick="selectSection('C')">
                <rect x="484" y="52" width="192" height="140" rx="8" fill="#9B4DCA" opacity="0.85"/>
                <text x="580" y="114" class="sec-label">C</text>
                <text x="580" y="130" class="sec-sublabel">VIP LOUNGE</text>
                <text x="580" y="142" class="sec-sublabel">18 tables · 108 pax</text>
            </g>

            <g class="venue-section" id="sec-D" onclick="selectSection('D')">
                <rect x="24" y="204" width="192" height="110" rx="8" fill="#1565C0" opacity="0.88"/>
                <text x="120" y="251" class="sec-label">D</text>
                <text x="120" y="267" class="sec-sublabel">HIGH TABLES</text>
                <text x="120" y="279" class="sec-sublabel">24 tables · 96 pax</text>
            </g>
            <g class="venue-section" id="sec-E" onclick="selectSection('E')">
                <rect x="225" y="204" width="250" height="110" rx="8" fill="#1565C0" opacity="0.88"/>
                <text x="350" y="251" class="sec-label">E</text>
                <text x="350" y="267" class="sec-sublabel">HIGH TABLES · 22 tables · 88 pax</text>
            </g>
            <g class="venue-section" id="sec-F" onclick="selectSection('F')">
                <rect x="484" y="204" width="192" height="110" rx="8" fill="#1565C0" opacity="0.88"/>
                <text x="580" y="251" class="sec-label">F</text>
                <text x="580" y="267" class="sec-sublabel">HIGH TABLES</text>
                <text x="580" y="279" class="sec-sublabel">24 tables · 96 pax</text>
            </g>

            <g class="venue-section" id="sec-G" onclick="selectSection('G')">
                <rect x="24" y="326" width="300" height="110" rx="8" fill="#1B5E20" opacity="0.88"/>
                <text x="174" y="373" class="sec-label">G</text>
                <text x="174" y="389" class="sec-sublabel">STANDARD TABLES · 36 tables · 144 pax</text>
            </g>
            <g class="venue-section" id="sec-H" onclick="selectSection('H')">
                <rect x="376" y="326" width="300" height="110" rx="8" fill="#1B5E20" opacity="0.88"/>
                <text x="526" y="373" class="sec-label">H</text>
                <text x="526" y="389" class="sec-sublabel">STANDARD TABLES · 36 tables · 144 pax</text>
            </g>

            <g class="venue-section" id="sec-I" onclick="selectSection('I')">
                <rect x="24" y="448" width="652" height="60" rx="8" fill="#B45309" opacity="0.85"/>
                <text x="350" y="475" class="sec-label">I — SINGLE SEATS</text>
                <text x="350" y="491" class="sec-sublabel">162 individual seats · Back rows</text>
            </g>

            <text x="350" y="510" font-family="'Instrument Sans',sans-serif" font-size="8" fill="rgba(255,255,255,0.2)" text-anchor="middle" letter-spacing="0.15em">MINIEH CORNICHE · NORTH LEBANON</text>
        </svg>

        <div class="legend">
            <div class="legend-item"><div class="legend-dot" style="background:#9B4DCA"></div>VIP Lounge (A, B, C)</div>
            <div class="legend-item"><div class="legend-dot" style="background:#1565C0"></div>High Tables (D, E, F)</div>
            <div class="legend-item"><div class="legend-dot" style="background:#1B5E20"></div>Standard Tables (G, H)</div>
            <div class="legend-item"><div class="legend-dot" style="background:#B45309"></div>Single Seats (I)</div>
        </div>
    </div>

    <div class="sidebar">
        <div class="summary-grid">
            <div class="summary-card"><div class="num">1,042</div><div class="lbl">Total Seats</div></div>
            <div class="summary-card"><div class="num">9</div><div class="lbl">Sections</div></div>
            <div class="summary-card"><div class="num">64</div><div class="lbl">Matches</div></div>
            <div class="summary-card"><div class="num">39</div><div class="lbl">Days</div></div>
        </div>

        <div class="section-card" id="section-detail">
            <div class="map-prompt" id="map-prompt">
                <span class="icon">👆</span>
                Click any section on the map<br>to see details and book your spot.
            </div>
            <div id="section-info" style="display:none">
                <div class="section-card-header">
                    <div class="section-badge" id="info-badge"></div>
                    <div>
                        <h2 id="info-title"></h2>
                        <p id="info-type"></p>
                    </div>
                </div>
                <div class="section-card-body">
                    <div class="stat-row"><span class="stat-label">Tables / Seats</span><span class="stat-value" id="info-tables"></span></div>
                    <div class="stat-row"><span class="stat-label">Per Table</span><span class="stat-value" id="info-per"></span></div>
                    <div class="stat-row"><span class="stat-label">Total Capacity</span><span class="stat-value" id="info-capacity"></span></div>
                    <div class="stat-row"><span class="stat-label">Seating Style</span><span class="stat-value" id="info-style"></span></div>
                    <div class="stat-row"><span class="stat-label">Location</span><span class="stat-value" id="info-location"></span></div>
                    <a href="/reserve" class="book-btn" id="book-link">Reserve Section <span id="book-section-label"></span> →</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const sections = {
    A:{title:'Section A',type:'VIP Lounge',tables:'18 tables',per:'6 pax per table',capacity:'108 pax',style:'Couch / Sofa Seating',location:'Left Wing — Front',color:'#9B4DCA'},
    B:{title:'Section B',type:'VIP Lounge',tables:'16 tables',per:'6 pax per table',capacity:'96 pax',style:'Couch / Sofa Seating',location:'Center — Front Row',color:'#7B3BB0'},
    C:{title:'Section C',type:'VIP Lounge',tables:'18 tables',per:'6 pax per table',capacity:'108 pax',style:'Couch / Sofa Seating',location:'Right Wing — Front',color:'#9B4DCA'},
    D:{title:'Section D',type:'High Tables',tables:'24 tables',per:'4 pax per table',capacity:'96 pax',style:'High Chairs',location:'Left Wing — Mid',color:'#1565C0'},
    E:{title:'Section E',type:'High Tables',tables:'22 tables',per:'4 pax per table',capacity:'88 pax',style:'High Chairs',location:'Center — Mid',color:'#1565C0'},
    F:{title:'Section F',type:'High Tables',tables:'24 tables',per:'4 pax per table',capacity:'96 pax',style:'High Chairs',location:'Right Wing — Mid',color:'#1565C0'},
    G:{title:'Section G',type:'Standard Tables',tables:'36 tables',per:'4 pax per table',capacity:'144 pax',style:'Regular Chairs',location:'Left Side — Back',color:'#1B5E20'},
    H:{title:'Section H',type:'Standard Tables',tables:'36 tables',per:'4 pax per table',capacity:'144 pax',style:'Regular Chairs',location:'Right Side — Back',color:'#1B5E20'},
    I:{title:'Section I',type:'Single Seats',tables:'162 seats',per:'1 pax per seat',capacity:'162 pax',style:'Individual Chair',location:'Back Rows',color:'#B45309'},
};

let active = null;

function selectSection(key) {
    if (active) document.getElementById('sec-' + active)?.classList.remove('active');
    active = key;
    const s = sections[key];
    document.getElementById('sec-' + key).classList.add('active');
    document.getElementById('map-prompt').style.display = 'none';
    document.getElementById('section-info').style.display = 'block';
    const badge = document.getElementById('info-badge');
    badge.textContent = key;
    badge.style.background = s.color + '33';
    badge.style.color = s.color;
    badge.style.border = '1px solid ' + s.color + '55';
    document.getElementById('info-title').textContent = s.title;
    document.getElementById('info-type').textContent = s.type;
    document.getElementById('info-tables').textContent = s.tables;
    document.getElementById('info-per').textContent = s.per;
    document.getElementById('info-capacity').textContent = s.capacity;
    document.getElementById('info-style').textContent = s.style;
    document.getElementById('info-location').textContent = s.location;
    document.getElementById('book-section-label').textContent = key;
    document.getElementById('book-link').href = '/reserve?section=' + key;
    document.getElementById('section-detail').classList.add('highlighted');
}
</script>

@endsection