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
    background: linear-gradient(180deg, rgba(30,136,255,0.08) 0%, transparent 100%);
    border-bottom: 1px solid rgba(30,136,255,0.1);
}

.page-header h1 {
    font-family: 'Bebas Neue', cursive;
    font-size: clamp(3rem, 8vw, 6rem);
    letter-spacing: 3px;
    margin-bottom: 15px;
}

.page-header h1 span { color: var(--gold); }

.page-header p {
    color: rgba(255,255,255,0.5);
    font-size: 1rem;
}

.filters {
    padding: 30px 60px;
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    justify-content: center;
    background: rgba(255,255,255,0.02);
    border-bottom: 1px solid rgba(255,255,255,0.05);
    position: sticky;
    top: 65px;
    z-index: 50;
    backdrop-filter: blur(20px);
}

.filter-btn {
    padding: 8px 20px;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    border: 1px solid rgba(255,255,255,0.15);
    background: transparent;
    color: rgba(255,255,255,0.6);
    cursor: pointer;
    transition: all 0.3s;
}

.filter-btn:hover, .filter-btn.active {
    background: var(--blue);
    border-color: var(--blue);
    color: white;
}

.search-bar {
    padding: 20px 60px;
    display: flex;
    justify-content: center;
}

.search-input {
    width: 100%;
    max-width: 500px;
    padding: 12px 20px;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(30,136,255,0.2);
    border-radius: 8px;
    color: white;
    font-size: 0.9rem;
    outline: none;
    transition: all 0.3s;
}

.search-input:focus {
    border-color: var(--blue);
    background: rgba(30,136,255,0.08);
}

.search-input::placeholder { color: rgba(255,255,255,0.3); }

.matches-container {
    padding: 30px 60px 80px;
    max-width: 1200px;
    margin: 0 auto;
}

.stage-title {
    font-family: 'Bebas Neue', cursive;
    font-size: 1.5rem;
    letter-spacing: 3px;
    color: var(--gold);
    margin: 40px 0 20px;
    padding-bottom: 10px;
    border-bottom: 1px solid rgba(255,215,0,0.2);
}

.matches-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 20px;
}

.match-card {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(30,136,255,0.1);
    border-radius: 16px;
    padding: 25px;
    transition: all 0.3s;
    cursor: pointer;
}

.match-card:hover {
    background: rgba(30,136,255,0.08);
    border-color: rgba(30,136,255,0.4);
    transform: translateY(-4px);
}

.match-stage {
    font-size: 0.65rem;
    font-weight: 700;
    letter-spacing: 3px;
    color: var(--blue);
    text-transform: uppercase;
    margin-bottom: 15px;
}

.match-teams {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
}

.team {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    flex: 1;
}

.team-flag {
    width: 60px;
    height: 40px;
    object-fit: cover;
    border-radius: 4px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.3);
}

.team-name {
    font-family: 'Bebas Neue', cursive;
    font-size: 1.1rem;
    letter-spacing: 2px;
    color: var(--white);
    text-align: center;
}

.vs {
    font-family: 'Bebas Neue', cursive;
    font-size: 1.5rem;
    color: rgba(255,255,255,0.2);
    padding: 0 15px;
}

.match-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 15px;
    border-top: 1px solid rgba(255,255,255,0.05);
}

.match-datetime {
    font-size: 0.8rem;
    color: rgba(255,255,255,0.5);
}

.match-datetime span {
    display: block;
    color: rgba(255,255,255,0.8);
    font-weight: 600;
}

.btn-reserve {
    background: var(--gold);
    color: var(--navy);
    padding: 8px 18px;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 2px;
    text-decoration: none;
    text-transform: uppercase;
    transition: all 0.3s;
    white-space: nowrap;
}

.btn-reserve:hover { background: white; }
</style>

<nav>
    <a href="/" class="nav-logo">MINIEH <span>FAN ZONE</span></a>
    <ul class="nav-links">
        <li><a href="/">Home</a></li>
        <li><a href="/matches" class="active">Matches</a></li>
        <li><a href="/tickets">Tickets</a></li>
        <li><a href="/venue">Venue</a></li>
    </ul>
    <a href="/reserve" class="nav-btn">🎟️ Reserve Now</a>
</nav>

<div class="page-header">
    <h1>MATCH <span>SCHEDULE</span></h1>
    <p>All 64 FIFA World Cup 2026 matches — live on the giant screen</p>
</div>

<div class="filters">
    <button class="filter-btn active" onclick="filterMatches('all', this)">All Matches</button>
    <button class="filter-btn" onclick="filterMatches('Group Stage', this)">Group Stage</button>
    <button class="filter-btn" onclick="filterMatches('Round of 32', this)">Round of 32</button>
    <button class="filter-btn" onclick="filterMatches('Round of 16', this)">Round of 16</button>
    <button class="filter-btn" onclick="filterMatches('Quarter Final', this)">Quarter Finals</button>
    <button class="filter-btn" onclick="filterMatches('Semi Final', this)">Semi Finals</button>
    <button class="filter-btn" onclick="filterMatches('Third Place', this)">Third Place</button>
    <button class="filter-btn" onclick="filterMatches('Final', this)">Final</button>
</div>

<div class="search-bar">
    <input type="text" class="search-input" placeholder="🔍 Search by team or date..." oninput="searchMatches(this.value)">
</div>

<div class="matches-container" id="matchesContainer"></div>

<script>
const matches = [
    { id:1, stage:'Group Stage', group:'Group A', teamA:'Mexico', flagA:'https://flagcdn.com/w80/mx.png', teamB:'Ecuador', flagB:'https://flagcdn.com/w80/ec.png', date:'Jun 11', time:'7:00 PM' },
    { id:2, stage:'Group Stage', group:'Group A', teamA:'United States', flagA:'https://flagcdn.com/w80/us.png', teamB:'Canada', flagB:'https://flagcdn.com/w80/ca.png', date:'Jun 12', time:'7:00 PM' },
    { id:3, stage:'Group Stage', group:'Group B', teamA:'Argentina', flagA:'https://flagcdn.com/w80/ar.png', teamB:'Morocco', flagB:'https://flagcdn.com/w80/ma.png', date:'Jun 12', time:'4:00 PM' },
    { id:4, stage:'Group Stage', group:'Group B', teamA:'France', flagA:'https://flagcdn.com/w80/fr.png', teamB:'Saudi Arabia', flagB:'https://flagcdn.com/w80/sa.png', date:'Jun 13', time:'7:00 PM' },
    { id:5, stage:'Group Stage', group:'Group C', teamA:'England', flagA:'https://flagcdn.com/w80/gb-eng.png', teamB:'Serbia', flagB:'https://flagcdn.com/w80/rs.png', date:'Jun 13', time:'4:00 PM' },
    { id:6, stage:'Group Stage', group:'Group C', teamA:'Spain', flagA:'https://flagcdn.com/w80/es.png', teamB:'Australia', flagB:'https://flagcdn.com/w80/au.png', date:'Jun 14', time:'7:00 PM' },
    { id:7, stage:'Group Stage', group:'Group D', teamA:'Germany', flagA:'https://flagcdn.com/w80/de.png', teamB:'Japan', flagB:'https://flagcdn.com/w80/jp.png', date:'Jun 14', time:'4:00 PM' },
    { id:8, stage:'Group Stage', group:'Group D', teamA:'Brazil', flagA:'https://flagcdn.com/w80/br.png', teamB:'Colombia', flagB:'https://flagcdn.com/w80/co.png', date:'Jun 15', time:'7:00 PM' },
    { id:9, stage:'Group Stage', group:'Group E', teamA:'Portugal', flagA:'https://flagcdn.com/w80/pt.png', teamB:'Nigeria', flagB:'https://flagcdn.com/w80/ng.png', date:'Jun 15', time:'4:00 PM' },
    { id:10, stage:'Group Stage', group:'Group E', teamA:'Netherlands', flagA:'https://flagcdn.com/w80/nl.png', teamB:'Senegal', flagB:'https://flagcdn.com/w80/sn.png', date:'Jun 16', time:'7:00 PM' },
    { id:11, stage:'Group Stage', group:'Group F', teamA:'Belgium', flagA:'https://flagcdn.com/w80/be.png', teamB:'Uruguay', flagB:'https://flagcdn.com/w80/uy.png', date:'Jun 16', time:'4:00 PM' },
    { id:12, stage:'Group Stage', group:'Group F', teamA:'Croatia', flagA:'https://flagcdn.com/w80/hr.png', teamB:'South Korea', flagB:'https://flagcdn.com/w80/kr.png', date:'Jun 17', time:'7:00 PM' },
    { id:13, stage:'Group Stage', group:'Group G', teamA:'Italy', flagA:'https://flagcdn.com/w80/it.png', teamB:'Ecuador', flagB:'https://flagcdn.com/w80/ec.png', date:'Jun 17', time:'4:00 PM' },
    { id:14, stage:'Group Stage', group:'Group G', teamA:'Switzerland', flagA:'https://flagcdn.com/w80/ch.png', teamB:'Cameroon', flagB:'https://flagcdn.com/w80/cm.png', date:'Jun 18', time:'7:00 PM' },
    { id:15, stage:'Group Stage', group:'Group H', teamA:'Denmark', flagA:'https://flagcdn.com/w80/dk.png', teamB:'Tunisia', flagB:'https://flagcdn.com/w80/tn.png', date:'Jun 18', time:'4:00 PM' },
    { id:16, stage:'Group Stage', group:'Group H', teamA:'Mexico', flagA:'https://flagcdn.com/w80/mx.png', teamB:'Poland', flagB:'https://flagcdn.com/w80/pl.png', date:'Jun 19', time:'7:00 PM' },
    { id:17, stage:'Group Stage', group:'Group I', teamA:'Argentina', flagA:'https://flagcdn.com/w80/ar.png', teamB:'Saudi Arabia', flagB:'https://flagcdn.com/w80/sa.png', date:'Jun 19', time:'4:00 PM' },
    { id:18, stage:'Group Stage', group:'Group I', teamA:'France', flagA:'https://flagcdn.com/w80/fr.png', teamB:'Morocco', flagB:'https://flagcdn.com/w80/ma.png', date:'Jun 20', time:'7:00 PM' },
    { id:19, stage:'Group Stage', group:'Group J', teamA:'England', flagA:'https://flagcdn.com/w80/gb-eng.png', teamB:'Australia', flagB:'https://flagcdn.com/w80/au.png', date:'Jun 20', time:'4:00 PM' },
    { id:20, stage:'Group Stage', group:'Group J', teamA:'Spain', flagA:'https://flagcdn.com/w80/es.png', teamB:'Serbia', flagB:'https://flagcdn.com/w80/rs.png', date:'Jun 21', time:'7:00 PM' },
    { id:21, stage:'Group Stage', group:'Group K', teamA:'Germany', flagA:'https://flagcdn.com/w80/de.png', teamB:'Colombia', flagB:'https://flagcdn.com/w80/co.png', date:'Jun 21', time:'4:00 PM' },
    { id:22, stage:'Group Stage', group:'Group K', teamA:'Brazil', flagA:'https://flagcdn.com/w80/br.png', teamB:'Japan', flagB:'https://flagcdn.com/w80/jp.png', date:'Jun 22', time:'7:00 PM' },
    { id:23, stage:'Group Stage', group:'Group L', teamA:'Portugal', flagA:'https://flagcdn.com/w80/pt.png', teamB:'Senegal', flagB:'https://flagcdn.com/w80/sn.png', date:'Jun 22', time:'4:00 PM' },
    { id:24, stage:'Group Stage', group:'Group L', teamA:'Netherlands', flagA:'https://flagcdn.com/w80/nl.png', teamB:'Nigeria', flagB:'https://flagcdn.com/w80/ng.png', date:'Jun 23', time:'7:00 PM' },
    { id:25, stage:'Round of 32', teamA:'TBD', flagA:'https://flagcdn.com/w80/un.png', teamB:'TBD', flagB:'https://flagcdn.com/w80/un.png', date:'Jul 1', time:'7:00 PM' },
    { id:26, stage:'Round of 32', teamA:'TBD', flagA:'https://flagcdn.com/w80/un.png', teamB:'TBD', flagB:'https://flagcdn.com/w80/un.png', date:'Jul 1', time:'4:00 PM' },
    { id:27, stage:'Round of 32', teamA:'TBD', flagA:'https://flagcdn.com/w80/un.png', teamB:'TBD', flagB:'https://flagcdn.com/w80/un.png', date:'Jul 2', time:'7:00 PM' },
    { id:28, stage:'Round of 32', teamA:'TBD', flagA:'https://flagcdn.com/w80/un.png', teamB:'TBD', flagB:'https://flagcdn.com/w80/un.png', date:'Jul 2', time:'4:00 PM' },
    { id:29, stage:'Round of 16', teamA:'TBD', flagA:'https://flagcdn.com/w80/un.png', teamB:'TBD', flagB:'https://flagcdn.com/w80/un.png', date:'Jul 4', time:'7:00 PM' },
    { id:30, stage:'Round of 16', teamA:'TBD', flagA:'https://flagcdn.com/w80/un.png', teamB:'TBD', flagB:'https://flagcdn.com/w80/un.png', date:'Jul 4', time:'4:00 PM' },
    { id:31, stage:'Round of 16', teamA:'TBD', flagA:'https://flagcdn.com/w80/un.png', teamB:'TBD', flagB:'https://flagcdn.com/w80/un.png', date:'Jul 5', time:'7:00 PM' },
    { id:32, stage:'Round of 16', teamA:'TBD', flagA:'https://flagcdn.com/w80/un.png', teamB:'TBD', flagB:'https://flagcdn.com/w80/un.png', date:'Jul 5', time:'4:00 PM' },
    { id:33, stage:'Quarter Final', teamA:'TBD', flagA:'https://flagcdn.com/w80/un.png', teamB:'TBD', flagB:'https://flagcdn.com/w80/un.png', date:'Jul 9', time:'7:00 PM' },
    { id:34, stage:'Quarter Final', teamA:'TBD', flagA:'https://flagcdn.com/w80/un.png', teamB:'TBD', flagB:'https://flagcdn.com/w80/un.png', date:'Jul 9', time:'4:00 PM' },
    { id:35, stage:'Quarter Final', teamA:'TBD', flagA:'https://flagcdn.com/w80/un.png', teamB:'TBD', flagB:'https://flagcdn.com/w80/un.png', date:'Jul 10', time:'7:00 PM' },
    { id:36, stage:'Quarter Final', teamA:'TBD', flagA:'https://flagcdn.com/w80/un.png', teamB:'TBD', flagB:'https://flagcdn.com/w80/un.png', date:'Jul 10', time:'4:00 PM' },
    { id:37, stage:'Semi Final', teamA:'TBD', flagA:'https://flagcdn.com/w80/un.png', teamB:'TBD', flagB:'https://flagcdn.com/w80/un.png', date:'Jul 14', time:'7:00 PM' },
    { id:38, stage:'Semi Final', teamA:'TBD', flagA:'https://flagcdn.com/w80/un.png', teamB:'TBD', flagB:'https://flagcdn.com/w80/un.png', date:'Jul 15', time:'7:00 PM' },
    { id:39, stage:'Third Place', teamA:'TBD', flagA:'https://flagcdn.com/w80/un.png', teamB:'TBD', flagB:'https://flagcdn.com/w80/un.png', date:'Jul 18', time:'5:00 PM' },
    { id:40, stage:'Final', teamA:'TBD', flagA:'https://flagcdn.com/w80/un.png', teamB:'TBD', flagB:'https://flagcdn.com/w80/un.png', date:'Jul 19', time:'7:00 PM' },
];

let currentFilter = 'all';
let currentSearch = '';

function renderMatches() {
    const container = document.getElementById('matchesContainer');
    let filtered = matches;
    if (currentFilter !== 'all') filtered = filtered.filter(m => m.stage === currentFilter);
    if (currentSearch) filtered = filtered.filter(m =>
        m.teamA.toLowerCase().includes(currentSearch) ||
        m.teamB.toLowerCase().includes(currentSearch) ||
        m.date.toLowerCase().includes(currentSearch)
    );
    const stages = [...new Set(filtered.map(m => m.stage))];
    container.innerHTML = '';
    stages.forEach(stage => {
        const stageMatches = filtered.filter(m => m.stage === stage);
        const stageDiv = document.createElement('div');
        stageDiv.innerHTML = `<div class="stage-title">${stage}</div><div class="matches-grid">${
            stageMatches.map(m => `
                <div class="match-card">
                    <div class="match-stage">${m.group || m.stage}</div>
                    <div class="match-teams">
                        <div class="team">
                            <img class="team-flag" src="${m.flagA}" alt="${m.teamA}">
                            <span class="team-name">${m.teamA}</span>
                        </div>
                        <span class="vs">VS</span>
                        <div class="team">
                            <img class="team-flag" src="${m.flagB}" alt="${m.teamB}">
                            <span class="team-name">${m.teamB}</span>
                        </div>
                    </div>
                    <div class="match-info">
                        <div class="match-datetime">
                            <span>${m.date}, 2026</span>
                            ${m.time}
                        </div>
                        <a href="/reserve" class="btn-reserve">Reserve Now</a>
                    </div>
                </div>
            `).join('')
        }</div>`;
        container.appendChild(stageDiv);
    });
}

function filterMatches(stage, btn) {
    currentFilter = stage;
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    renderMatches();
}

function searchMatches(val) {
    currentSearch = val.toLowerCase();
    renderMatches();
}

renderMatches();
</script>

@endsection