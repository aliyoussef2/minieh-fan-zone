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

nav {
    position: fixed;
    top: 0; left: 0; right: 0;
    z-index: 100;
    padding: 20px 60px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: rgba(11,18,32,0.95);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(30,136,255,0.15);
}

.nav-logo {
    font-family: 'Bebas Neue', cursive;
    font-size: 1.5rem;
    letter-spacing: 3px;
    color: var(--white);
    text-decoration: none;
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

.nav-links a:hover, .nav-links a.active { color: var(--gold); }

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
}

.nav-btn:hover { background: var(--gold); color: var(--navy); }

.page-header {
    padding: 140px 60px 60px;
    text-align: center;
    background: linear-gradient(180deg, rgba(255,215,0,0.06) 0%, transparent 100%);
    border-bottom: 1px solid rgba(255,215,0,0.1);
}

.page-header h1 {
    font-family: 'Bebas Neue', cursive;
    font-size: clamp(3rem, 8vw, 6rem);
    letter-spacing: 3px;
    margin-bottom: 15px;
}

.page-header h1 span { color: var(--gold); }
.page-header p { color: rgba(255,255,255,0.5); font-size: 1rem; }

/* MAIN LAYOUT */
.venue-layout {
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 40px;
    padding: 60px;
    max-width: 1400px;
    margin: 0 auto;
}

/* MAP */
.map-container {
    background: rgba(255,255,255,0.02);
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 20px;
    padding: 40px;
}

.map-title {
    font-family: 'Bebas Neue', cursive;
    font-size: 1.3rem;
    letter-spacing: 3px;
    color: rgba(255,255,255,0.5);
    text-align: center;
    margin-bottom: 30px;
}

.screen-label {
    background: linear-gradient(90deg, var(--blue), #1565d8);
    color: white;
    text-align: center;
    padding: 12px;
    border-radius: 8px;
    font-family: 'Bebas Neue', cursive;
    font-size: 1.1rem;
    letter-spacing: 4px;
    margin-bottom: 25px;
    box-shadow: 0 0 30px rgba(30,136,255,0.4);
}

/* SECTIONS */
.venue-map {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.map-row {
    display: flex;
    gap: 12px;
    justify-content: center;
}

.section {
    border-radius: 10px;
    padding: 15px 10px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s;
    border: 2px solid transparent;
    position: relative;
    user-select: none;
}

.section:hover {
    transform: scale(1.05);
    z-index: 10;
}

.section.selected {
    transform: scale(1.05);
    z-index: 10;
}

.section-label {
    font-family: 'Bebas Neue', cursive;
    font-size: 1.4rem;
    letter-spacing: 2px;
    display: block;
}

.section-type {
    font-size: 0.6rem;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    opacity: 0.8;
    display: block;
    margin-top: 3px;
}

.section-cap {
    font-size: 0.65rem;
    opacity: 0.6;
    display: block;
    margin-top: 2px;
}

/* VIP sections */
.vip-section {
    background: rgba(255,215,0,0.1);
    border-color: rgba(255,215,0,0.3);
    color: var(--gold);
}

.vip-section:hover, .vip-section.selected {
    background: rgba(255,215,0,0.25);
    border-color: var(--gold);
    box-shadow: 0 0 20px rgba(255,215,0,0.3);
}

/* High table sections */
.high-section {
    background: rgba(30,136,255,0.1);
    border-color: rgba(30,136,255,0.3);
    color: var(--blue);
}

.high-section:hover, .high-section.selected {
    background: rgba(30,136,255,0.25);
    border-color: var(--blue);
    box-shadow: 0 0 20px rgba(30,136,255,0.3);
}

/* Standard sections */
.standard-section {
    background: rgba(34,197,94,0.1);
    border-color: rgba(34,197,94,0.3);
    color: #22c55e;
}

.standard-section:hover, .standard-section.selected {
    background: rgba(34,197,94,0.25);
    border-color: #22c55e;
    box-shadow: 0 0 20px rgba(34,197,94,0.3);
}

/* Single seats */
.single-section {
    background: rgba(168,85,247,0.1);
    border-color: rgba(168,85,247,0.3);
    color: #a855f7;
}

.single-section:hover, .single-section.selected {
    background: rgba(168,85,247,0.25);
    border-color: #a855f7;
    box-shadow: 0 0 20px rgba(168,85,247,0.3);
}

.catwalk {
    background: rgba(255,255,255,0.03);
    border: 1px dashed rgba(255,255,255,0.1);
    border-radius: 6px;
    padding: 8px;
    text-align: center;
    font-size: 0.65rem;
    letter-spacing: 3px;
    color: rgba(255,255,255,0.2);
    text-transform: uppercase;
    margin: 5px 0;
}

.stage-box {
    background: rgba(30,136,255,0.05);
    border: 1px solid rgba(30,136,255,0.15);
    border-radius: 8px;
    padding: 15px;
    text-align: center;
    font-family: 'Bebas Neue', cursive;
    font-size: 1rem;
    letter-spacing: 3px;
    color: rgba(30,136,255,0.5);
    margin-top: 5px;
}

/* LEGEND */
.map-legend {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
    margin-top: 25px;
    padding-top: 20px;
    border-top: 1px solid rgba(255,255,255,0.05);
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.75rem;
    color: rgba(255,255,255,0.5);
}

.legend-dot {
    width: 12px; height: 12px;
    border-radius: 3px;
}

/* SIDEBAR */
.sidebar {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.section-info {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 16px;
    padding: 30px;
    transition: all 0.3s;
}

.section-info.active {
    border-color: var(--gold);
    background: rgba(255,215,0,0.05);
}

.info-placeholder {
    text-align: center;
    padding: 40px 20px;
    color: rgba(255,255,255,0.3);
}

.info-placeholder .icon { font-size: 3rem; margin-bottom: 15px; display: block; }
.info-placeholder p { font-size: 0.9rem; line-height: 1.6; }

.info-section-name {
    font-family: 'Bebas Neue', cursive;
    font-size: 3rem;
    letter-spacing: 4px;
    line-height: 1;
    margin-bottom: 5px;
}

.info-type-badge {
    display: inline-block;
    font-size: 0.65rem;
    font-weight: 700;
    letter-spacing: 3px;
    text-transform: uppercase;
    padding: 4px 12px;
    border-radius: 50px;
    margin-bottom: 20px;
}

.info-desc {
    font-size: 0.88rem;
    color: rgba(255,255,255,0.55);
    line-height: 1.7;
    margin-bottom: 20px;
}

.info-features {
    list-style: none;
    margin-bottom: 25px;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.info-features li {
    font-size: 0.85rem;
    color: rgba(255,255,255,0.7);
    display: flex;
    align-items: center;
    gap: 8px;
}

.info-features li::before {
    content: '✓';
    font-weight: 700;
    font-size: 0.75rem;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    background: rgba(255,215,0,0.2);
    color: var(--gold);
}

.info-capacity {
    display: flex;
    justify-content: space-between;
    padding: 15px;
    background: rgba(255,255,255,0.03);
    border-radius: 10px;
    margin-bottom: 20px;
}

.cap-stat span:first-child {
    font-family: 'Bebas Neue', cursive;
    font-size: 1.8rem;
    color: var(--gold);
    display: block;
    line-height: 1;
}

.cap-stat span:last-child {
    font-size: 0.6rem;
    font-weight: 600;
    letter-spacing: 2px;
    color: rgba(255,255,255,0.3);
    text-transform: uppercase;
}

.btn-book-section {
    width: 100%;
    padding: 15px;
    border-radius: 10px;
    font-family: 'Bebas Neue', cursive;
    font-size: 1rem;
    letter-spacing: 3px;
    text-decoration: none;
    text-align: center;
    display: block;
    background: var(--gold);
    color: var(--navy);
    transition: all 0.3s;
}

.btn-book-section:hover { background: white; }

/* ALL TICKETS */
.all-tickets {
    background: rgba(255,255,255,0.02);
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 16px;
    padding: 25px;
}

.all-tickets h3 {
    font-family: 'Bebas Neue', cursive;
    font-size: 1.2rem;
    letter-spacing: 2px;
    margin-bottom: 15px;
    color: rgba(255,255,255,0.6);
}

.ticket-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.ticket-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 15px;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s;
    border: 1px solid transparent;
}

.ticket-item:hover { background: rgba(255,255,255,0.05); }

.ticket-item-name {
    font-weight: 600;
    font-size: 0.88rem;
}

.ticket-item-cap {
    font-size: 0.75rem;
    color: rgba(255,255,255,0.4);
}
</style>

<nav>
    <a href="/" class="nav-logo">MINIEH <span>FAN ZONE</span></a>
    <ul class="nav-links">
        <li><a href="/">Home</a></li>
        <li><a href="/matches">Matches</a></li>
        <li><a href="/tickets" class="active">Tickets</a></li>
        <li><a href="/venue">Venue</a></li>
    </ul>
    <a href="/reserve" class="nav-btn">🎟️ Reserve Now</a>
</nav>

<div class="page-header">
    <h1>SELECT YOUR <span>SECTION</span></h1>
    <p>Click on a section to view details and reserve your spot</p>
</div>

<div class="venue-layout">
    <!-- MAP -->
    <div class="map-container">
        <div class="map-title">🏟️ MINIEH FAN ZONE — VENUE MAP</div>
        <div class="screen-label">📺 GIANT LED SCREEN — ABOVE THE SEA</div>

        <div class="venue-map">
            <!-- VIP ROW -->
            <div class="map-row">
                <div class="section vip-section" style="flex:1;" onclick="selectSection('A')" id="sec-A">
                    <span class="section-label">A</span>
                    <span class="section-type">VIP Lounge</span>
                    <span class="section-cap">18 tables · 108 pax</span>
                </div>
                <div class="section vip-section" style="flex:1.5;" onclick="selectSection('B')" id="sec-B">
                    <span class="section-label">B</span>
                    <span class="section-type">VIP Lounge</span>
                    <span class="section-cap">16 tables · 96 pax</span>
                </div>
                <div class="section vip-section" style="flex:1;" onclick="selectSection('C')" id="sec-C">
                    <span class="section-label">C</span>
                    <span class="section-type">VIP Lounge</span>
                    <span class="section-cap">18 tables · 108 pax</span>
                </div>
            </div>

            <!-- HIGH TABLES ROW -->
            <div class="map-row">
                <div class="section high-section" style="flex:1;" onclick="selectSection('D')" id="sec-D">
                    <span class="section-label">D</span>
                    <span class="section-type">High Tables</span>
                    <span class="section-cap">24 tables · 96 pax</span>
                </div>
                <div class="section high-section" style="flex:1.5;" onclick="selectSection('E')" id="sec-E">
                    <span class="section-label">E</span>
                    <span class="section-type">High Tables</span>
                    <span class="section-cap">22 tables · 88 pax</span>
                </div>
                <div class="section high-section" style="flex:1;" onclick="selectSection('F')" id="sec-F">
                    <span class="section-label">F</span>
                    <span class="section-type">High Tables</span>
                    <span class="section-cap">24 tables · 96 pax</span>
                </div>
            </div>

            <!-- STANDARD TABLES ROW -->
            <div class="map-row">
                <div class="section standard-section" style="flex:1;" onclick="selectSection('G')" id="sec-G">
                    <span class="section-label">G</span>
                    <span class="section-type">Standard Tables</span>
                    <span class="section-cap">36 tables · 144 pax</span>
                </div>
                <div class="section standard-section" style="flex:1;" onclick="selectSection('H')" id="sec-H">
                    <span class="section-label">H</span>
                    <span class="section-type">Standard Tables</span>
                    <span class="section-cap">36 tables · 144 pax</span>
                </div>
            </div>

            <!-- SINGLE SEATS -->
            <div class="catwalk">Catwalk</div>
            <div class="map-row">
                <div class="section single-section" style="flex:2;" onclick="selectSection('I')" id="sec-I">
                    <span class="section-label">I</span>
                    <span class="section-type">Single Seats</span>
                    <span class="section-cap">162 individual seats</span>
                </div>
            </div>

            <div class="stage-box">🎬 STAGE & SCAFFOLD</div>
        </div>

        <div class="map-legend">
            <div class="legend-item">
                <div class="legend-dot" style="background:#FFD700;"></div>
                VIP Lounge (A, B, C)
            </div>
            <div class="legend-item">
                <div class="legend-dot" style="background:#1E88FF;"></div>
                High Tables (D, E, F)
            </div>
            <div class="legend-item">
                <div class="legend-dot" style="background:#22c55e;"></div>
                Standard Tables (G, H)
            </div>
            <div class="legend-item">
                <div class="legend-dot" style="background:#a855f7;"></div>
                Single Seats (I)
            </div>
        </div>
    </div>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="section-info" id="sectionInfo">
            <div class="info-placeholder">
                <span class="icon">👆</span>
                <p>Click on any section on the map to view details, pricing, and availability</p>
            </div>
        </div>

        <div class="all-tickets">
            <h3>All Sections</h3>
            <div class="ticket-list">
                <div class="ticket-item" onclick="selectSection('A')" style="border-color:rgba(255,215,0,0.2);">
                    <span class="ticket-item-name" style="color:#FFD700;">Section A — VIP Lounge</span>
                    <span class="ticket-item-cap">108 pax</span>
                </div>
                <div class="ticket-item" onclick="selectSection('B')" style="border-color:rgba(255,215,0,0.2);">
                    <span class="ticket-item-name" style="color:#FFD700;">Section B — VIP Lounge</span>
                    <span class="ticket-item-cap">96 pax</span>
                </div>
                <div class="ticket-item" onclick="selectSection('C')" style="border-color:rgba(255,215,0,0.2);">
                    <span class="ticket-item-name" style="color:#FFD700;">Section C — VIP Lounge</span>
                    <span class="ticket-item-cap">108 pax</span>
                </div>
                <div class="ticket-item" onclick="selectSection('D')" style="border-color:rgba(30,136,255,0.2);">
                    <span class="ticket-item-name" style="color:#1E88FF;">Section D — High Tables</span>
                    <span class="ticket-item-cap">96 pax</span>
                </div>
                <div class="ticket-item" onclick="selectSection('E')" style="border-color:rgba(30,136,255,0.2);">
                    <span class="ticket-item-name" style="color:#1E88FF;">Section E — High Tables</span>
                    <span class="ticket-item-cap">88 pax</span>
                </div>
                <div class="ticket-item" onclick="selectSection('F')" style="border-color:rgba(30,136,255,0.2);">
                    <span class="ticket-item-name" style="color:#1E88FF;">Section F — High Tables</span>
                    <span class="ticket-item-cap">96 pax</span>
                </div>
                <div class="ticket-item" onclick="selectSection('G')" style="border-color:rgba(34,197,94,0.2);">
                    <span class="ticket-item-name" style="color:#22c55e;">Section G — Standard Tables</span>
                    <span class="ticket-item-cap">144 pax</span>
                </div>
                <div class="ticket-item" onclick="selectSection('H')" style="border-color:rgba(34,197,94,0.2);">
                    <span class="ticket-item-name" style="color:#22c55e;">Section H — Standard Tables</span>
                    <span class="ticket-item-cap">144 pax</span>
                </div>
                <div class="ticket-item" onclick="selectSection('I')" style="border-color:rgba(168,85,247,0.2);">
                    <span class="ticket-item-name" style="color:#a855f7;">Section I — Single Seats</span>
                    <span class="ticket-item-cap">162 pax</span>
                </div>
            </div>
        </div>
    </div>
</div>

<footer style="padding:40px 60px;text-align:center;border-top:1px solid rgba(255,255,255,0.05);color:rgba(255,255,255,0.3);font-size:0.85rem;">
    <p>© 2026 Minieh Fan Zone. All rights reserved. 🇱🇧</p>
</footer>

<script>
const sectionData = {
    A: {
        name: 'Section A',
        type: 'VIP Lounge',
        color: '#FFD700',
        bgColor: 'rgba(255,215,0,0.05)',
        borderColor: '#FFD700',
        icon: '👑',
        badge: 'VIP',
        badgeBg: 'rgba(255,215,0,0.15)',
        desc: 'Premium VIP lounge section on the left side of the venue. Luxury couch seating with the best elevated views.',
        features: ['Luxury couch seating for 6', 'Elevated view of the screen', 'Premium table service', 'Dedicated VIP entrance', 'Welcome drinks included'],
        tables: 18,
        perTable: 6,
        total: 108,
    },
    B: {
        name: 'Section B',
        type: 'VIP Lounge',
        color: '#FFD700',
        bgColor: 'rgba(255,215,0,0.05)',
        borderColor: '#FFD700',
        icon: '👑',
        badge: 'VIP',
        badgeBg: 'rgba(255,215,0,0.15)',
        desc: 'Premium VIP lounge center section. Best central view of the giant screen with luxury couch seating.',
        features: ['Luxury couch seating for 6', 'Best central screen view', 'Premium table service', 'Dedicated VIP entrance', 'Welcome drinks included'],
        tables: 16,
        perTable: 6,
        total: 96,
    },
    C: {
        name: 'Section C',
        type: 'VIP Lounge',
        color: '#FFD700',
        bgColor: 'rgba(255,215,0,0.05)',
        borderColor: '#FFD700',
        icon: '👑',
        badge: 'VIP',
        badgeBg: 'rgba(255,215,0,0.15)',
        desc: 'Premium VIP lounge section on the right side. Luxury couch seating with elevated views.',
        features: ['Luxury couch seating for 6', 'Elevated view of the screen', 'Premium table service', 'Dedicated VIP entrance', 'Welcome drinks included'],
        tables: 18,
        perTable: 6,
        total: 108,
    },
    D: {
        name: 'Section D',
        type: 'High Tables',
        color: '#1E88FF',
        bgColor: 'rgba(30,136,255,0.05)',
        borderColor: '#1E88FF',
        icon: '🍺',
        badge: 'Popular',
        badgeBg: 'rgba(30,136,255,0.15)',
        desc: 'High tables on the left side with great elevated viewing angle and social atmosphere.',
        features: ['High table for 4', 'High chairs included', 'Great viewing angle', 'Food & drinks service', 'Social atmosphere'],
        tables: 24,
        perTable: 4,
        total: 96,
    },
    E: {
        name: 'Section E',
        type: 'High Tables',
        color: '#1E88FF',
        bgColor: 'rgba(30,136,255,0.05)',
        borderColor: '#1E88FF',
        icon: '🍺',
        badge: 'Popular',
        badgeBg: 'rgba(30,136,255,0.15)',
        desc: 'Center high tables with the best central view of the giant screen.',
        features: ['High table for 4', 'High chairs included', 'Central screen view', 'Food & drinks service', 'Prime location'],
        tables: 22,
        perTable: 4,
        total: 88,
    },
    F: {
        name: 'Section F',
        type: 'High Tables',
        color: '#1E88FF',
        bgColor: 'rgba(30,136,255,0.05)',
        borderColor: '#1E88FF',
        icon: '🍺',
        badge: 'Popular',
        badgeBg: 'rgba(30,136,255,0.15)',
        desc: 'High tables on the right side with great elevated viewing angle.',
        features: ['High table for 4', 'High chairs included', 'Great viewing angle', 'Food & drinks service', 'Social atmosphere'],
        tables: 24,
        perTable: 4,
        total: 96,
    },
    G: {
        name: 'Section G',
        type: 'Standard Tables',
        color: '#22c55e',
        bgColor: 'rgba(34,197,94,0.05)',
        borderColor: '#22c55e',
        icon: '🪑',
        badge: 'Standard',
        badgeBg: 'rgba(34,197,94,0.15)',
        desc: 'Standard tables on the left side. Comfortable seating with great value.',
        features: ['Standard table for 4', 'Regular chairs', 'Good screen view', 'Food & drinks available', 'Great value'],
        tables: 36,
        perTable: 4,
        total: 144,
    },
    H: {
        name: 'Section H',
        type: 'Standard Tables',
        color: '#22c55e',
        bgColor: 'rgba(34,197,94,0.05)',
        borderColor: '#22c55e',
        icon: '🪑',
        badge: 'Standard',
        badgeBg: 'rgba(34,197,94,0.15)',
        desc: 'Standard tables on the right side. Comfortable seating with great value.',
        features: ['Standard table for 4', 'Regular chairs', 'Good screen view', 'Food & drinks available', 'Great value'],
        tables: 36,
        perTable: 4,
        total: 144,
    },
    I: {
        name: 'Section I',
        type: 'Single Seats',
        color: '#a855f7',
        bgColor: 'rgba(168,85,247,0.05)',
        borderColor: '#a855f7',
        icon: '🎯',
        badge: 'Individual',
        badgeBg: 'rgba(168,85,247,0.15)',
        desc: 'Individual seats at the front, closest to the giant screen. Best immersion experience.',
        features: ['Individual seat', 'Closest to the screen', 'Best immersion', 'Access to food court', 'Perfect for solo fans'],
        tables: 162,
        perTable: 1,
        total: 162,
    },
};

let selectedSection = null;

function selectSection(id) {
    // Remove previous selection
    if (selectedSection) {
        document.getElementById('sec-' + selectedSection).classList.remove('selected');
    }

    selectedSection = id;
    document.getElementById('sec-' + id).classList.add('selected');

    const s = sectionData[id];
    const info = document.getElementById('sectionInfo');
    info.classList.add('active');
    info.style.borderColor = s.borderColor;
    info.style.background = s.bgColor;

    info.innerHTML = `
        <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:15px;">
            <span style="font-size:2.5rem;">${s.icon}</span>
            <span style="font-size:0.65rem;font-weight:700;letter-spacing:3px;text-transform:uppercase;padding:4px 12px;border-radius:50px;background:${s.badgeBg};color:${s.color};">${s.badge}</span>
        </div>
        <div class="info-section-name" style="color:${s.color};">${s.name}</div>
        <div style="font-size:0.8rem;color:rgba(255,255,255,0.4);letter-spacing:2px;text-transform:uppercase;margin-bottom:15px;">${s.type}</div>
        <p class="info-desc">${s.desc}</p>
        <ul class="info-features">
            ${s.features.map(f => `<li style="::before{background:rgba(${s.color},0.2);}">${f}</li>`).join('')}
        </ul>
        <div class="info-capacity">
            <div class="cap-stat">
                <span style="color:${s.color};">${s.total}</span>
                <span>Total Seats</span>
            </div>
            <div class="cap-stat">
                <span style="color:${s.color};">${s.tables}</span>
                <span>${s.type === 'Single Seats' ? 'Seats' : 'Tables'}</span>
            </div>
            <div class="cap-stat">
                <span style="color:${s.color};">${s.perTable}</span>
                <span>Per Table</span>
            </div>
        </div>
        <a href="/reserve?section=${id}" class="btn-book-section" style="background:${s.color};color:#0B1220;">
            🎟️ Book ${s.name}
        </a>
    `;
}
</script>

@endsection