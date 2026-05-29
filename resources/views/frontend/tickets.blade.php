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

/* TOTAL CAPACITY */
.capacity-bar {
    padding: 30px 60px;
    text-align: center;
    background: rgba(255,215,0,0.04);
    border-bottom: 1px solid rgba(255,215,0,0.08);
}

.capacity-bar p {
    font-size: 0.8rem;
    font-weight: 700;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: rgba(255,255,255,0.4);
    margin-bottom: 10px;
}

.capacity-nums {
    display: flex;
    justify-content: center;
    gap: 50px;
}

.cap-item span:first-child {
    font-family: 'Bebas Neue', cursive;
    font-size: 2.5rem;
    color: var(--gold);
    display: block;
    line-height: 1;
}

.cap-item span:last-child {
    font-size: 0.7rem;
    font-weight: 600;
    letter-spacing: 2px;
    color: rgba(255,255,255,0.4);
    text-transform: uppercase;
}

/* TICKET CARDS */
.tickets-container {
    padding: 60px;
    max-width: 1200px;
    margin: 0 auto;
}

.tickets-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
}

.ticket-card {
    border-radius: 20px;
    padding: 40px;
    position: relative;
    overflow: hidden;
    transition: all 0.4s;
    border: 1px solid transparent;
}

.ticket-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 30px 80px rgba(0,0,0,0.4);
}

.ticket-card.vip {
    background: linear-gradient(135deg, rgba(255,215,0,0.08), rgba(255,215,0,0.03));
    border-color: rgba(255,215,0,0.3);
}

.ticket-card.vip:hover { border-color: var(--gold); }

.ticket-card.high {
    background: linear-gradient(135deg, rgba(30,136,255,0.08), rgba(30,136,255,0.03));
    border-color: rgba(30,136,255,0.3);
}

.ticket-card.high:hover { border-color: var(--blue); }

.ticket-card.standard {
    background: linear-gradient(135deg, rgba(34,197,94,0.08), rgba(34,197,94,0.03));
    border-color: rgba(34,197,94,0.3);
}

.ticket-card.standard:hover { border-color: #22c55e; }

.ticket-card.single {
    background: linear-gradient(135deg, rgba(168,85,247,0.08), rgba(168,85,247,0.03));
    border-color: rgba(168,85,247,0.3);
}

.ticket-card.single:hover { border-color: #a855f7; }

.ticket-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 25px;
}

.ticket-icon {
    font-size: 2.5rem;
}

.ticket-badge {
    font-size: 0.65rem;
    font-weight: 700;
    letter-spacing: 3px;
    text-transform: uppercase;
    padding: 5px 12px;
    border-radius: 50px;
}

.vip .ticket-badge { background: rgba(255,215,0,0.15); color: var(--gold); }
.high .ticket-badge { background: rgba(30,136,255,0.15); color: var(--blue); }
.standard .ticket-badge { background: rgba(34,197,94,0.15); color: #22c55e; }
.single .ticket-badge { background: rgba(168,85,247,0.15); color: #a855f7; }

.ticket-name {
    font-family: 'Bebas Neue', cursive;
    font-size: 2rem;
    letter-spacing: 3px;
    margin-bottom: 8px;
}

.ticket-subtitle {
    font-size: 0.85rem;
    color: rgba(255,255,255,0.5);
    margin-bottom: 25px;
    line-height: 1.6;
}

.ticket-features {
    list-style: none;
    margin-bottom: 30px;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.ticket-features li {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.88rem;
    color: rgba(255,255,255,0.7);
}

.ticket-features li::before {
    content: '✓';
    font-weight: 700;
    font-size: 0.8rem;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.vip .ticket-features li::before { background: rgba(255,215,0,0.2); color: var(--gold); }
.high .ticket-features li::before { background: rgba(30,136,255,0.2); color: var(--blue); }
.standard .ticket-features li::before { background: rgba(34,197,94,0.2); color: #22c55e; }
.single .ticket-features li::before { background: rgba(168,85,247,0.2); color: #a855f7; }

.ticket-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 25px;
    border-top: 1px solid rgba(255,255,255,0.06);
}

.ticket-capacity {
    font-size: 0.75rem;
    color: rgba(255,255,255,0.4);
}

.ticket-capacity strong {
    display: block;
    font-size: 1.1rem;
    color: rgba(255,255,255,0.8);
    font-weight: 700;
}

.btn-book {
    padding: 12px 28px;
    border-radius: 8px;
    font-family: 'Bebas Neue', cursive;
    font-size: 0.9rem;
    letter-spacing: 2px;
    text-decoration: none;
    transition: all 0.3s;
    display: inline-block;
}

.vip .btn-book { background: var(--gold); color: var(--navy); }
.vip .btn-book:hover { background: white; }
.high .btn-book { background: var(--blue); color: white; }
.high .btn-book:hover { background: #1565d8; }
.standard .btn-book { background: #22c55e; color: white; }
.standard .btn-book:hover { background: #16a34a; }
.single .btn-book { background: #a855f7; color: white; }
.single .btn-book:hover { background: #9333ea; }

/* VENUE MAP */
.venue-section {
    padding: 80px 60px;
    background: rgba(255,255,255,0.02);
    border-top: 1px solid rgba(255,255,255,0.05);
}

.venue-title {
    font-family: 'Bebas Neue', cursive;
    font-size: 2.5rem;
    letter-spacing: 3px;
    text-align: center;
    margin-bottom: 50px;
    color: var(--white);
}

.venue-title span { color: var(--gold); }

.venue-map {
    max-width: 700px;
    margin: 0 auto;
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 20px;
    padding: 40px;
    text-align: center;
}

.venue-legend {
    display: flex;
    justify-content: center;
    gap: 30px;
    flex-wrap: wrap;
    margin-top: 30px;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.8rem;
    color: rgba(255,255,255,0.6);
}

.legend-dot {
    width: 14px;
    height: 14px;
    border-radius: 3px;
}

/* SVG VENUE */
.venue-svg {
    width: 100%;
    max-width: 600px;
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
    <h1>CHOOSE YOUR <span>SEAT</span></h1>
    <p>Select your seating category and reserve your spot at Minieh Fan Zone 2026</p>
</div>

<div class="capacity-bar">
    <p>Total Venue Capacity</p>
    <div class="capacity-nums">
        <div class="cap-item">
            <span>1,042</span>
            <span>Total Seats</span>
        </div>
        <div class="cap-item">
            <span>52</span>
            <span>VIP Lounges</span>
        </div>
        <div class="cap-item">
            <span>142</span>
            <span>Tables of 4</span>
        </div>
        <div class="cap-item">
            <span>162</span>
            <span>Single Seats</span>
        </div>
    </div>
</div>

<div class="tickets-container">
    <div class="tickets-grid">

        {{-- VIP LOUNGE --}}
        <div class="ticket-card vip">
            <div class="ticket-top">
                <span class="ticket-icon">👑</span>
                <span class="ticket-badge">Premium</span>
            </div>
            <h3 class="ticket-name">VIP Lounge</h3>
            <p class="ticket-subtitle">52 lounge tables · 6 seats per table · Couch seating · 312 total pax</p>
            <ul class="ticket-features">
                <li>Luxury couch seating for 6</li>
                <li>Best elevated view of the screen</li>
                <li>Premium table service</li>
                <li>Dedicated VIP entrance</li>
                <li>Complimentary welcome drinks</li>
            </ul>
            <div class="ticket-bottom">
                <div class="ticket-capacity">
                    <strong>312 seats</strong>
                    52 tables × 6 pax
                </div>
                <a href="/reserve" class="btn-book">Book Now</a>
            </div>
        </div>

        {{-- HIGH TABLES --}}
        <div class="ticket-card high">
            <div class="ticket-top">
                <span class="ticket-icon">🍺</span>
                <span class="ticket-badge">Popular</span>
            </div>
            <h3 class="ticket-name">High Tables</h3>
            <p class="ticket-subtitle">70 high tables · 4 seats per table · High chairs · 280 total pax</p>
            <ul class="ticket-features">
                <li>High table with 4 high chairs</li>
                <li>Great elevated viewing angle</li>
                <li>Social atmosphere</li>
                <li>Full food & drinks service</li>
                <li>Central location in the venue</li>
            </ul>
            <div class="ticket-bottom">
                <div class="ticket-capacity">
                    <strong>280 seats</strong>
                    70 tables × 4 pax
                </div>
                <a href="/reserve" class="btn-book">Book Now</a>
            </div>
        </div>

        {{-- STANDARD TABLES --}}
        <div class="ticket-card standard">
            <div class="ticket-top">
                <span class="ticket-icon">🪑</span>
                <span class="ticket-badge">Standard</span>
            </div>
            <h3 class="ticket-name">Standard Tables</h3>
            <p class="ticket-subtitle">72 standard tables · 4 seats per table · Regular chairs · 288 total pax</p>
            <ul class="ticket-features">
                <li>Standard table for 4</li>
                <li>Comfortable regular chairs</li>
                <li>Good screen visibility</li>
                <li>Food & drinks available</li>
                <li>Great value experience</li>
            </ul>
            <div class="ticket-bottom">
                <div class="ticket-capacity">
                    <strong>288 seats</strong>
                    72 tables × 4 pax
                </div>
                <a href="/reserve" class="btn-book">Book Now</a>
            </div>
        </div>

        {{-- SINGLE SEATS --}}
        <div class="ticket-card single">
            <div class="ticket-top">
                <span class="ticket-icon">🎯</span>
                <span class="ticket-badge">Individual</span>
            </div>
            <h3 class="ticket-name">Single Seats</h3>
            <p class="ticket-subtitle">162 individual seats · Front area · Closest to the screen</p>
            <ul class="ticket-features">
                <li>Individual seat closest to screen</li>
                <li>Best immersion experience</li>
                <li>Front row atmosphere</li>
                <li>Access to food court</li>
                <li>Perfect for solo fans</li>
            </ul>
            <div class="ticket-bottom">
                <div class="ticket-capacity">
                    <strong>162 seats</strong>
                    Individual seats
                </div>
                <a href="/reserve" class="btn-book">Book Now</a>
            </div>
        </div>

    </div>
</div>

{{-- VENUE MAP --}}
<div class="venue-section">
    <h2 class="venue-title">VENUE <span>MAP</span></h2>
    <div class="venue-map">
        <svg class="venue-svg" viewBox="0 0 600 500" xmlns="http://www.w3.org/2000/svg">
            <!-- Screen -->
            <rect x="200" y="20" width="200" height="40" rx="6" fill="#1E88FF" opacity="0.8"/>
            <text x="300" y="46" text-anchor="middle" fill="white" font-size="14" font-weight="bold">GIANT SCREEN</text>

            <!-- VIP Lounge (yellow) -->
            <rect x="50" y="80" width="500" height="100" rx="8" fill="rgba(255,215,0,0.15)" stroke="#FFD700" stroke-width="1.5"/>
            <text x="300" y="125" text-anchor="middle" fill="#FFD700" font-size="13" font-weight="bold">VIP LOUNGE — 52 Tables × 6 pax</text>
            <text x="300" y="145" text-anchor="middle" fill="rgba(255,215,0,0.6)" font-size="11">Couch Seating · 312 pax</text>

            <!-- High Tables (blue) -->
            <rect x="50" y="195" width="500" height="90" rx="8" fill="rgba(30,136,255,0.12)" stroke="#1E88FF" stroke-width="1.5"/>
            <text x="300" y="235" text-anchor="middle" fill="#1E88FF" font-size="13" font-weight="bold">HIGH TABLES — 70 Tables × 4 pax</text>
            <text x="300" y="255" text-anchor="middle" fill="rgba(30,136,255,0.6)" font-size="11">High Chairs · 280 pax</text>

            <!-- Standard Tables (green) -->
            <rect x="50" y="300" width="500" height="90" rx="8" fill="rgba(34,197,94,0.12)" stroke="#22c55e" stroke-width="1.5"/>
            <text x="300" y="340" text-anchor="middle" fill="#22c55e" font-size="13" font-weight="bold">STANDARD TABLES — 72 Tables × 4 pax</text>
            <text x="300" y="360" text-anchor="middle" fill="rgba(34,197,94,0.6)" font-size="11">Regular Chairs · 288 pax</text>

            <!-- Single Seats (purple) -->
            <rect x="150" y="405" width="300" height="70" rx="8" fill="rgba(168,85,247,0.12)" stroke="#a855f7" stroke-width="1.5"/>
            <text x="300" y="436" text-anchor="middle" fill="#a855f7" font-size="13" font-weight="bold">SINGLE SEATS — 162 pax</text>
            <text x="300" y="456" text-anchor="middle" fill="rgba(168,85,247,0.6)" font-size="11">Closest to Screen</text>

            <!-- Catwalk -->
            <rect x="270" y="480" width="60" height="15" rx="3" fill="rgba(255,255,255,0.1)" stroke="rgba(255,255,255,0.2)" stroke-width="1"/>
            <text x="300" y="492" text-anchor="middle" fill="rgba(255,255,255,0.3)" font-size="9">CATWALK</text>
        </svg>

        <div class="venue-legend">
            <div class="legend-item">
                <div class="legend-dot" style="background:#FFD700;"></div>
                VIP Lounge
            </div>
            <div class="legend-item">
                <div class="legend-dot" style="background:#1E88FF;"></div>
                High Tables
            </div>
            <div class="legend-item">
                <div class="legend-dot" style="background:#22c55e;"></div>
                Standard Tables
            </div>
            <div class="legend-item">
                <div class="legend-dot" style="background:#a855f7;"></div>
                Single Seats
            </div>
        </div>
    </div>
</div>

<footer style="padding:40px 60px;text-align:center;border-top:1px solid rgba(255,255,255,0.05);color:rgba(255,255,255,0.3);font-size:0.85rem;">
    <p>© 2026 Minieh Fan Zone. All rights reserved. 🇱🇧</p>
</footer>

@endsection