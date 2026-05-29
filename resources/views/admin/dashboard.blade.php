<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Admin — Minieh Fan Zone 2026</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Instrument+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<style>
:root {
    --navy:#0B1220;--navy2:#111827;--navy3:#0d1728;
    --blue:#1E88FF;--gold:#FFD700;--white:#FFFFFF;
    --muted:rgba(255,255,255,0.45);--border:rgba(255,255,255,0.07);
    --green:#22c55e;--red:#ef4444;--yellow:#facc15;--sidebar-w:240px;
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
body{background:var(--navy);color:var(--white);font-family:'Instrument Sans',sans-serif;display:flex;min-height:100vh;font-size:14px;}
.sidebar{width:var(--sidebar-w);background:var(--navy2);border-right:1px solid var(--border);display:flex;flex-direction:column;position:fixed;top:0;left:0;height:100vh;z-index:100;}
.sidebar-logo{padding:1.5rem 1.25rem 1rem;border-bottom:1px solid var(--border);}
.sidebar-logo .brand{font-family:'Bebas Neue',sans-serif;font-size:1.2rem;letter-spacing:.08em;color:var(--gold);line-height:1;}
.sidebar-logo .sub{font-size:.68rem;color:var(--muted);margin-top:2px;}
.sidebar-badge{display:inline-block;background:rgba(255,215,0,0.15);color:var(--gold);font-size:.6rem;padding:2px 6px;border-radius:4px;margin-top:4px;letter-spacing:.08em;font-family:'Bebas Neue',sans-serif;}
.nav-section{padding:.75rem 1rem .35rem;font-size:.6rem;color:var(--muted);letter-spacing:.1em;text-transform:uppercase;}
.nav-item{display:flex;align-items:center;gap:.65rem;padding:.6rem 1.25rem;color:var(--muted);cursor:pointer;transition:all .2s;border-left:2px solid transparent;font-size:.85rem;}
.nav-item:hover{color:var(--white);background:rgba(255,255,255,0.04);}
.nav-item.active{color:var(--gold);border-left-color:var(--gold);background:rgba(255,215,0,0.06);}
.nav-item .ico{font-size:1rem;width:18px;text-align:center;flex-shrink:0;}
.nav-badge{margin-left:auto;background:var(--red);color:#fff;font-size:.6rem;padding:1px 5px;border-radius:10px;font-weight:600;}
.sidebar-footer{margin-top:auto;padding:1rem 1.25rem;border-top:1px solid var(--border);font-size:.75rem;color:var(--muted);}
.main{margin-left:var(--sidebar-w);flex:1;display:flex;flex-direction:column;min-height:100vh;}
.topbar{display:flex;align-items:center;justify-content:space-between;padding:1rem 1.75rem;border-bottom:1px solid var(--border);background:var(--navy2);position:sticky;top:0;z-index:50;}
.topbar h1{font-family:'Bebas Neue',sans-serif;font-size:1.4rem;letter-spacing:.05em;}
.topbar-right{display:flex;align-items:center;gap:1rem;}
.topbar-date{font-size:.75rem;color:var(--muted);}
.logout-btn{padding:.4rem .9rem;border:1px solid var(--border);background:transparent;color:var(--muted);border-radius:6px;cursor:pointer;font-size:.75rem;font-family:'Instrument Sans',sans-serif;transition:all .2s;}
.logout-btn:hover{border-color:var(--red);color:var(--red);}
.content{padding:1.75rem;flex:1;}
.panel{display:none;}
.panel.active{display:block;}
.stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.75rem;}
.stat-card{background:var(--navy2);border:1px solid var(--border);border-radius:12px;padding:1.1rem 1.25rem;}
.stat-card .label{font-size:.7rem;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;margin-bottom:.5rem;}
.stat-card .value{font-family:'Bebas Neue',sans-serif;font-size:2rem;line-height:1;}
.stat-card .sub{font-size:.72rem;color:var(--muted);margin-top:.25rem;}
.stat-card.gold .value{color:var(--gold);}
.stat-card.green .value{color:var(--green);}
.stat-card.blue .value{color:var(--blue);}
.stat-card.yellow .value{color:var(--yellow);}
.sec-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;}
.sec-head h2{font-family:'Bebas Neue',sans-serif;font-size:1.15rem;letter-spacing:.05em;}
.sec-head .actions{display:flex;gap:.5rem;}
.btn{padding:.45rem .9rem;border-radius:7px;font-size:.78rem;cursor:pointer;font-family:'Instrument Sans',sans-serif;font-weight:500;transition:all .2s;border:none;}
.btn-gold{background:var(--gold);color:#0B1220;}
.btn-gold:hover{opacity:.85;}
.btn-outline{background:transparent;border:1px solid var(--border);color:var(--muted);}
.btn-outline:hover{border-color:rgba(255,255,255,0.25);color:var(--white);}
.btn-green{background:rgba(34,197,94,0.15);color:var(--green);border:1px solid rgba(34,197,94,0.3);}
.btn-green:hover{background:rgba(34,197,94,0.25);}
.btn-red{background:rgba(239,68,68,0.15);color:var(--red);border:1px solid rgba(239,68,68,0.3);}
.btn-red:hover{background:rgba(239,68,68,0.25);}
.btn-sm{padding:.3rem .65rem;font-size:.72rem;}
.table-wrap{background:var(--navy2);border:1px solid var(--border);border-radius:12px;overflow:hidden;}
.table-toolbar{padding:.85rem 1.1rem;border-bottom:1px solid var(--border);display:flex;gap:.75rem;align-items:center;flex-wrap:wrap;}
.search-input{padding:.45rem .85rem;background:var(--navy3);border:1px solid var(--border);border-radius:7px;color:var(--white);font-family:'Instrument Sans',sans-serif;font-size:.8rem;outline:none;width:220px;transition:border-color .2s;}
.search-input::placeholder{color:var(--muted);}
.search-input:focus{border-color:rgba(255,215,0,0.35);}
.filter-select{padding:.45rem .75rem;background:var(--navy3);border:1px solid var(--border);border-radius:7px;color:var(--white);font-family:'Instrument Sans',sans-serif;font-size:.8rem;outline:none;cursor:pointer;}
.filter-select option{background:#111827;}
table{width:100%;border-collapse:collapse;}
th{padding:.65rem 1rem;text-align:left;font-size:.68rem;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;border-bottom:1px solid var(--border);font-weight:500;}
td{padding:.7rem 1rem;border-bottom:1px solid var(--border);font-size:.82rem;vertical-align:middle;}
tr:last-child td{border-bottom:none;}
tr:hover td{background:rgba(255,255,255,0.02);}
.badge{display:inline-flex;align-items:center;gap:4px;padding:.2rem .55rem;border-radius:20px;font-size:.68rem;font-weight:500;}
.badge-pending{background:rgba(250,204,21,0.12);color:var(--yellow);border:1px solid rgba(250,204,21,0.25);}
.badge-verified{background:rgba(34,197,94,0.12);color:var(--green);border:1px solid rgba(34,197,94,0.25);}
.badge-rejected{background:rgba(239,68,68,0.12);color:var(--red);border:1px solid rgba(239,68,68,0.25);}
.badge-entered{background:rgba(30,136,255,0.12);color:var(--blue);border:1px solid rgba(30,136,255,0.25);}
.badge-not-entered{background:rgba(255,255,255,0.05);color:var(--muted);border:1px solid var(--border);}
.modal-overlay{position:fixed;inset:0;background:rgba(0,0,0,0.7);align-items:center;justify-content:center;z-index:200;padding:1rem;display:none;}
.modal-overlay.open{display:flex;}
.modal{background:var(--navy2);border:1px solid rgba(255,215,0,0.2);border-radius:16px;width:100%;max-width:520px;max-height:90vh;overflow-y:auto;}
.modal-header{padding:1.25rem 1.5rem 1rem;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;}
.modal-header h3{font-family:'Bebas Neue',sans-serif;font-size:1.2rem;letter-spacing:.05em;}
.modal-close{background:none;border:none;color:var(--muted);font-size:1.2rem;cursor:pointer;padding:.2rem .5rem;}
.modal-close:hover{color:var(--white);}
.modal-body{padding:1.25rem 1.5rem;}
.modal-footer{padding:1rem 1.5rem;border-top:1px solid var(--border);display:flex;gap:.75rem;justify-content:flex-end;}
.form-group{display:flex;flex-direction:column;gap:.4rem;margin-bottom:.85rem;}
.form-group label{font-size:.72rem;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;}
.form-group input,.form-group select,.form-group textarea{padding:.6rem .85rem;background:var(--navy3);border:1px solid var(--border);border-radius:8px;color:var(--white);font-family:'Instrument Sans',sans-serif;font-size:.85rem;outline:none;transition:border-color .2s;width:100%;}
.form-group input:focus,.form-group select:focus{border-color:rgba(255,215,0,0.4);}
.form-group select option{background:#111827;}
.form-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:.75rem;}
.scanner-wrap{background:var(--navy2);border:1px solid var(--border);border-radius:12px;padding:2rem;text-align:center;max-width:480px;margin:0 auto;}
.scanner-input-wrap{display:flex;gap:.75rem;margin:1.5rem 0;}
.scanner-input-wrap input{flex:1;padding:.7rem 1rem;background:var(--navy3);border:1px solid var(--border);border-radius:8px;color:var(--white);font-family:'Instrument Sans',sans-serif;font-size:.9rem;outline:none;text-transform:uppercase;letter-spacing:.1em;}
.scanner-input-wrap input:focus{border-color:rgba(255,215,0,0.4);}
.scanner-result{background:var(--navy3);border:1px solid var(--border);border-radius:10px;padding:1.25rem;text-align:left;margin-top:1rem;display:none;}
.scanner-result.show{display:block;}
.sr-row{display:flex;justify-content:space-between;padding:.4rem 0;border-bottom:1px solid var(--border);font-size:.82rem;}
.sr-row:last-child{border-bottom:none;}
.sr-row .k{color:var(--muted);}
.empty-state{text-align:center;padding:3rem 1rem;color:var(--muted);}
.empty-state .ico{font-size:2.5rem;margin-bottom:.75rem;display:block;}
.toast{position:fixed;bottom:1.5rem;right:1.5rem;z-index:300;background:var(--navy2);border:1px solid var(--border);border-radius:10px;padding:.85rem 1.25rem;font-size:.82rem;display:flex;align-items:center;gap:.65rem;transform:translateY(100px);opacity:0;transition:all .3s;pointer-events:none;max-width:320px;}
.toast.show{transform:translateY(0);opacity:1;}
.toast.success{border-color:rgba(34,197,94,0.4);}
.toast.error{border-color:rgba(239,68,68,0.4);}
</style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-logo">
        <div class="brand">Minieh Fan Zone</div>
        <div class="sub">Admin Dashboard</div>
        <div class="sidebar-badge">2026 FIFA World Cup</div>
    </div>
    <div class="nav-section">Overview</div>
    <div class="nav-item active" onclick="showPanel('overview',this)"><span class="ico">📊</span> Dashboard</div>
    <div class="nav-section">Management</div>
    <div class="nav-item" onclick="showPanel('reservations',this)"><span class="ico">🎟️</span> Reservations <span class="nav-badge" id="pending-badge">0</span></div>
    <div class="nav-item" onclick="showPanel('matches',this)"><span class="ico">⚽</span> Matches</div>
    <div class="nav-item" onclick="showPanel('customers',this)"><span class="ico">👥</span> Customers</div>
    <div class="nav-item" onclick="showPanel('sections',this)"><span class="ico">🗺️</span> Sections & Pricing</div>
    <div class="nav-section">Operations</div>
    <div class="nav-item" onclick="showPanel('scanner',this)"><span class="ico">📷</span> QR Scanner</div>
    <div class="sidebar-footer">Logged in as <strong>Admin</strong></div>
</div>

<div class="main">
    <div class="topbar">
        <h1 id="topbar-title">Dashboard</h1>
        <div class="topbar-right">
            <span class="topbar-date" id="topbar-date"></span>
            <form method="POST" action="/admin/logout">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>

    <div class="content">

    {{-- OVERVIEW --}}
    <div class="panel active" id="panel-overview">
        <div class="stats-grid">
            <div class="stat-card gold"><div class="label">Total Reservations</div><div class="value">{{ $stats['total'] ?? 0 }}</div><div class="sub">All time</div></div>
            <div class="stat-card yellow"><div class="label">Pending Verification</div><div class="value" style="color:var(--yellow)">{{ $stats['pending'] ?? 0 }}</div><div class="sub">Awaiting payment check</div></div>
            <div class="stat-card green"><div class="label">Verified</div><div class="value">{{ $stats['verified'] ?? 0 }}</div><div class="sub">Confirmed reservations</div></div>
            <div class="stat-card blue"><div class="label">Total Seats Booked</div><div class="value">{{ $stats['seats'] ?? 0 }}</div><div class="sub">Out of 1,042</div></div>
        </div>
        <div class="sec-head"><h2>Recent Reservations</h2></div>
        <div class="table-wrap">
            <table>
                <thead><tr><th>Booking Code</th><th>Customer</th><th>Match</th><th>Section</th><th>Qty</th><th>Status</th><th>Date</th></tr></thead>
                <tbody>
                    @forelse($recentReservations ?? [] as $r)
                    <tr>
                        <td><code style="color:var(--gold);font-size:.78rem;">{{ $r->booking_code }}</code></td>
                        <td>{{ $r->customer->full_name }}</td>
                        <td style="font-size:.75rem;">{{ $r->footballMatch->label }}</td>
                        <td>Section {{ $r->ticketCategory->section }}</td>
                        <td>{{ $r->quantity }}</td>
                        <td><span class="badge badge-{{ $r->payment_status }}">{{ ucfirst($r->payment_status) }}</span></td>
                        <td style="color:var(--muted);">{{ $r->created_at->format('M j, H:i') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="7"><div class="empty-state"><span class="ico">🎟️</span>No reservations yet</div></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- RESERVATIONS --}}
    <div class="panel" id="panel-reservations">
        <div class="sec-head"><h2>All Reservations</h2></div>
        <div class="table-wrap">
            <div class="table-toolbar">
                <input type="text" class="search-input" placeholder="Search name, code, email…" oninput="filterReservations(this.value)">
                <select class="filter-select" onchange="filterReservationsByStatus(this.value)">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="verified">Verified</option>
                    <option value="rejected">Rejected</option>
                </select>
                <select class="filter-select" onchange="filterReservationsBySection(this.value)">
                    <option value="">All Sections</option>
                    <option>A</option><option>B</option><option>C</option>
                    <option>D</option><option>E</option><option>F</option>
                    <option>G</option><option>H</option><option>I</option>
                </select>
            </div>
            <table>
                <thead><tr><th>Booking Code</th><th>Customer</th><th>Phone</th><th>Match</th><th>Section</th><th>Qty</th><th>Payment Ref</th><th>Status</th><th>Entry</th><th>Actions</th></tr></thead>
                <tbody id="res-tbody">
                    @forelse($reservations ?? [] as $r)
                    <tr data-status="{{ $r->payment_status }}" data-section="{{ $r->ticketCategory->section }}" data-search="{{ strtolower($r->customer->full_name . ' ' . $r->booking_code . ' ' . $r->customer->email) }}">
                        <td><code style="color:var(--gold);font-size:.75rem;">{{ $r->booking_code }}</code></td>
                        <td><div style="font-weight:500;">{{ $r->customer->full_name }}</div><div style="font-size:.72rem;color:var(--muted);">{{ $r->customer->email }}</div></td>
                        <td style="color:var(--muted);font-size:.78rem;">{{ $r->customer->phone }}</td>
                        <td style="font-size:.75rem;">{{ $r->footballMatch->label }}<br><span style="color:var(--muted);">{{ $r->footballMatch->match_date->format('M j') }}</span></td>
                        <td><strong>{{ $r->ticketCategory->section }}</strong><br><span style="font-size:.7rem;color:var(--muted);">{{ $r->ticketCategory->name }}</span></td>
                        <td>{{ $r->quantity }}</td>
                        <td style="font-size:.72rem;color:var(--muted);">{{ $r->payment_reference ?? '—' }}</td>
                        <td><span class="badge badge-{{ $r->payment_status }}">{{ ucfirst($r->payment_status) }}</span></td>
                        <td><span class="badge {{ $r->entry_status === 'entered' ? 'badge-entered' : 'badge-not-entered' }}">{{ $r->entry_status === 'entered' ? 'Entered' : 'Not Yet' }}</span></td>
                        <td>
                            <div style="display:flex;gap:.4rem;">
                                @if($r->payment_status === 'pending')
                                <button class="btn btn-green btn-sm" onclick="updateStatus({{ $r->id }},'verified',this)">✓</button>
                                <button class="btn btn-red btn-sm" onclick="updateStatus({{ $r->id }},'rejected',this)">✗</button>
                                @endif
                                <button class="btn btn-outline btn-sm" onclick="viewReservation({{ $r->id }})">View</button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="10"><div class="empty-state"><span class="ico">🎟️</span>No reservations yet</div></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- MATCHES --}}
    <div class="panel" id="panel-matches">
        <div class="sec-head"><h2>Matches</h2><div class="actions"><button class="btn btn-gold" onclick="openMatchModal()">+ Add Match</button></div></div>
        <div class="table-wrap">
            <table>
                <thead><tr><th>#</th><th>Teams</th><th>Date</th><th>Time</th><th>Stage</th><th>Group</th><th>Status</th><th>Reservations</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($matches ?? [] as $m)
                    <tr>
                        <td style="color:var(--muted);">{{ $m->id }}</td>
                        <td>
                            <div style="display:flex;align-items:center;gap:.5rem;">
                                @if($m->flag_code_a)<img src="https://flagcdn.com/w20/{{ $m->flag_code_a }}.png" style="width:20px;height:14px;object-fit:cover;border-radius:2px;">@endif
                                <strong>{{ $m->team_a }}</strong>
                                <span style="color:var(--muted);font-size:.72rem;">vs</span>
                                <strong>{{ $m->team_b }}</strong>
                                @if($m->flag_code_b)<img src="https://flagcdn.com/w20/{{ $m->flag_code_b }}.png" style="width:20px;height:14px;object-fit:cover;border-radius:2px;">@endif
                            </div>
                        </td>
                        <td>{{ $m->match_date->format('M j, Y') }}</td>
                        <td>{{ $m->match_time }}</td>
                        <td><span class="badge badge-not-entered">{{ $m->stage }}</span></td>
                        <td style="color:var(--muted);">{{ $m->group ?? '—' }}</td>
                        <td><span class="badge {{ $m->status==='live'?'badge-verified':($m->status==='finished'?'badge-not-entered':'badge-pending') }}">{{ ucfirst($m->status) }}</span></td>
                        <td>{{ $m->reservations_count ?? 0 }}</td>
                        <td><button class="btn btn-outline btn-sm" onclick="editMatch({{ $m->id }})">Edit</button></td>
                    </tr>
                    @empty
                    <tr><td colspan="9"><div class="empty-state"><span class="ico">⚽</span>No matches. Run the seeder.</div></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- CUSTOMERS --}}
    <div class="panel" id="panel-customers">
        <div class="sec-head"><h2>Customers</h2></div>
        <div class="table-wrap">
            <table>
                <thead><tr><th>#</th><th>Name</th><th>Email</th><th>Phone</th><th>Reservations</th><th>Joined</th></tr></thead>
                <tbody>
                    @forelse($customers ?? [] as $c)
                    <tr>
                        <td style="color:var(--muted);">{{ $c->id }}</td>
                        <td><strong>{{ $c->full_name }}</strong></td>
                        <td style="color:var(--muted);">{{ $c->email }}</td>
                        <td style="color:var(--muted);">{{ $c->phone }}</td>
                        <td>{{ $c->reservations_count ?? 0 }}</td>
                        <td style="color:var(--muted);">{{ $c->created_at->format('M j, Y') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="6"><div class="empty-state"><span class="ico">👥</span>No customers yet</div></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- SECTIONS & PRICING --}}
    <div class="panel" id="panel-sections">
        <div class="sec-head"><h2>Sections & Pricing</h2><button class="btn btn-gold" onclick="savePrices()">Save Prices</button></div>
        <div class="table-wrap">
            <table>
                <thead><tr><th>Section</th><th>Type</th><th>Seating Style</th><th>Tables</th><th>Per Table</th><th>Capacity</th><th>Price (USD/person)</th><th>Available</th></tr></thead>
                <tbody>
                    @forelse($categories ?? [] as $cat)
                    <tr>
                        <td><strong style="font-family:'Bebas Neue',sans-serif;font-size:1.1rem;">{{ $cat->section }}</strong></td>
                        <td>{{ $cat->name }}</td>
                        <td style="color:var(--muted);">{{ $cat->seating_style }}</td>
                        <td>{{ $cat->tables_count }}</td>
                        <td>{{ $cat->per_table }}</td>
                        <td>{{ $cat->total_capacity }}</td>
                        <td><input type="number" class="search-input" style="width:100px;" value="{{ $cat->price ?? '' }}" placeholder="Set price" data-category-id="{{ $cat->id }}" min="0" step="0.01"></td>
                        <td><input type="checkbox" {{ $cat->is_available ? 'checked' : '' }} data-category-id="{{ $cat->id }}" onchange="toggleAvailability({{ $cat->id }},this.checked)" style="width:16px;height:16px;cursor:pointer;"></td>
                    </tr>
                    @empty
                    <tr><td colspan="8"><div class="empty-state"><span class="ico">🗺️</span>No sections. Run the seeder.</div></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- QR SCANNER --}}
    <div class="panel" id="panel-scanner">
        <div class="sec-head"><h2>QR Entry Scanner</h2></div>
        <div class="scanner-wrap">
            <div style="font-size:3rem;margin-bottom:.75rem;">📷</div>
            <p style="color:var(--muted);font-size:.85rem;line-height:1.6;">Enter a booking code to look up a reservation and mark entry.</p>
            <div class="scanner-input-wrap">
                <input type="text" id="scanner-input" placeholder="MFZ-XXXXXX" maxlength="10" oninput="this.value=this.value.toUpperCase()" onkeydown="if(event.key==='Enter')scanCode()">
                <button class="btn btn-gold" onclick="scanCode()">Look Up</button>
            </div>
            <div class="scanner-result" id="scanner-result">
                <div class="sr-row"><span class="k">Booking Code</span><span id="sr-code" style="color:var(--gold);font-family:'Bebas Neue',sans-serif;font-size:1rem;"></span></div>
                <div class="sr-row"><span class="k">Customer</span><span id="sr-customer"></span></div>
                <div class="sr-row"><span class="k">Match</span><span id="sr-match"></span></div>
                <div class="sr-row"><span class="k">Section</span><span id="sr-section"></span></div>
                <div class="sr-row"><span class="k">Quantity</span><span id="sr-qty"></span></div>
                <div class="sr-row"><span class="k">Payment</span><span id="sr-payment"></span></div>
                <div class="sr-row"><span class="k">Entry</span><span id="sr-entry"></span></div>
                <div style="margin-top:1rem;"><button class="btn btn-green" style="width:100%;" id="mark-entered-btn" onclick="markEntered()">✓ Mark as Entered</button></div>
            </div>
        </div>
    </div>

    </div>
</div>

{{-- MODALS --}}
<div class="modal-overlay" id="modal-view">
    <div class="modal">
        <div class="modal-header"><h3>Reservation Details</h3><button class="modal-close" onclick="closeModal('modal-view')">✕</button></div>
        <div class="modal-body" id="modal-view-body">Loading…</div>
        <div class="modal-footer"><button class="btn btn-outline" onclick="closeModal('modal-view')">Close</button></div>
    </div>
</div>

<div class="modal-overlay" id="modal-match">
    <div class="modal">
        <div class="modal-header"><h3 id="match-modal-title">Add Match</h3><button class="modal-close" onclick="closeModal('modal-match')">✕</button></div>
        <div class="modal-body">
            <input type="hidden" id="match-id">
            <div class="form-grid-2">
                <div class="form-group"><label>Team A</label><input type="text" id="m-team-a" placeholder="e.g. France"></div>
                <div class="form-group"><label>Team B</label><input type="text" id="m-team-b" placeholder="e.g. Argentina"></div>
            </div>
            <div class="form-grid-2">
                <div class="form-group"><label>Flag Code A</label><input type="text" id="m-flag-a" placeholder="e.g. fr"></div>
                <div class="form-group"><label>Flag Code B</label><input type="text" id="m-flag-b" placeholder="e.g. ar"></div>
            </div>
            <div class="form-grid-2">
                <div class="form-group"><label>Date</label><input type="date" id="m-date"></div>
                <div class="form-group"><label>Time</label><input type="time" id="m-time"></div>
            </div>
            <div class="form-grid-2">
                <div class="form-group"><label>Stage</label>
                    <select id="m-stage">
                        <option>Group Stage</option><option>Round of 32</option><option>Round of 16</option>
                        <option>Quarter Final</option><option>Semi Final</option><option>Third Place</option><option>Final</option>
                    </select>
                </div>
                <div class="form-group"><label>Group</label><input type="text" id="m-group" placeholder="A, B… (optional)"></div>
            </div>
            <div class="form-group"><label>Status</label>
                <select id="m-status"><option value="upcoming">Upcoming</option><option value="live">Live</option><option value="finished">Finished</option></select>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" onclick="closeModal('modal-match')">Cancel</button>
            <button class="btn btn-gold" onclick="saveMatch()">Save Match</button>
        </div>
    </div>
</div>

<div class="toast" id="toast"></div>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]').content;

function showPanel(name, el) {
    document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
    document.getElementById('panel-' + name).classList.add('active');
    if (el) el.classList.add('active');
    const titles = {overview:'Dashboard',reservations:'Reservations',matches:'Matches',customers:'Customers',sections:'Sections & Pricing',scanner:'QR Scanner'};
    document.getElementById('topbar-title').textContent = titles[name] || name;
}

document.getElementById('topbar-date').textContent = new Date().toLocaleDateString('en-GB',{weekday:'short',day:'numeric',month:'short',year:'numeric'});

function filterReservations(q) {
    q = q.toLowerCase();
    document.querySelectorAll('#res-tbody tr').forEach(row => {
        row.style.display = (row.dataset.search||'').includes(q) ? '' : 'none';
    });
}
function filterReservationsByStatus(val) {
    document.querySelectorAll('#res-tbody tr').forEach(row => {
        row.style.display = (!val || row.dataset.status === val) ? '' : 'none';
    });
}
function filterReservationsBySection(val) {
    document.querySelectorAll('#res-tbody tr').forEach(row => {
        row.style.display = (!val || row.dataset.section === val) ? '' : 'none';
    });
}

function updateStatus(id, status, btn) {
    btn.disabled = true; btn.textContent = '…';
    fetch(`/admin/reservations/${id}/status`, {
        method:'PATCH', headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF},
        body: JSON.stringify({status})
    })
    .then(r => r.json())
    .then(d => { if(d.success){ showToast(status==='verified'?'✓ Verified':'✗ Rejected', status==='verified'?'success':'error'); setTimeout(()=>location.reload(),800); }});
}

function viewReservation(id) {
    document.getElementById('modal-view-body').innerHTML = '<div style="text-align:center;padding:2rem;color:var(--muted);">Loading…</div>';
    openModal('modal-view');
    fetch(`/admin/reservations/${id}`).then(r=>r.json()).then(d => {
        document.getElementById('modal-view-body').innerHTML = `
            <div style="display:flex;flex-direction:column;gap:.5rem;">
                <div class="sr-row"><span class="k">Booking Code</span><span style="color:var(--gold);font-family:'Bebas Neue',sans-serif;">${d.booking_code}</span></div>
                <div class="sr-row"><span class="k">Customer</span><span>${d.customer_name}</span></div>
                <div class="sr-row"><span class="k">Email</span><span style="color:var(--muted);">${d.email}</span></div>
                <div class="sr-row"><span class="k">Phone</span><span style="color:var(--muted);">${d.phone}</span></div>
                <div class="sr-row"><span class="k">Match</span><span>${d.match}</span></div>
                <div class="sr-row"><span class="k">Date</span><span style="color:var(--muted);">${d.match_date}</span></div>
                <div class="sr-row"><span class="k">Section</span><span>Section ${d.section} — ${d.section_name}</span></div>
                <div class="sr-row"><span class="k">Quantity</span><span>${d.quantity}</span></div>
                <div class="sr-row"><span class="k">Payment Ref</span><span style="color:var(--muted);">${d.payment_reference||'—'}</span></div>
                <div class="sr-row"><span class="k">Payment</span><span class="badge badge-${d.payment_status}">${d.payment_status}</span></div>
                <div class="sr-row"><span class="k">Entry</span><span class="badge ${d.entry_status==='entered'?'badge-entered':'badge-not-entered'}">${d.entry_status}</span></div>
                <div class="sr-row"><span class="k">Reserved At</span><span style="color:var(--muted);">${d.created_at}</span></div>
            </div>`;
    });
}

let editingMatchId = null;
function openMatchModal() {
    editingMatchId = null;
    document.getElementById('match-modal-title').textContent = 'Add Match';
    ['m-team-a','m-team-b','m-flag-a','m-flag-b','m-date','m-time','m-group'].forEach(id => document.getElementById(id).value = '');
    openModal('modal-match');
}
function editMatch(id) {
    editingMatchId = id;
    document.getElementById('match-modal-title').textContent = 'Edit Match';
    fetch(`/admin/matches/${id}`).then(r=>r.json()).then(d => {
        document.getElementById('m-team-a').value = d.team_a;
        document.getElementById('m-team-b').value = d.team_b;
        document.getElementById('m-flag-a').value = d.flag_code_a||'';
        document.getElementById('m-flag-b').value = d.flag_code_b||'';
        document.getElementById('m-date').value   = d.match_date;
        document.getElementById('m-time').value   = d.match_time;
        document.getElementById('m-stage').value  = d.stage;
        document.getElementById('m-group').value  = d.group||'';
        document.getElementById('m-status').value = d.status;
    });
    openModal('modal-match');
}
function saveMatch() {
    const payload = {
        team_a:d('m-team-a'),team_b:d('m-team-b'),flag_code_a:d('m-flag-a'),flag_code_b:d('m-flag-b'),
        match_date:d('m-date'),match_time:d('m-time'),stage:d('m-stage'),group:d('m-group'),status:d('m-status')
    };
    const url = editingMatchId ? `/admin/matches/${editingMatchId}` : '/admin/matches';
    const method = editingMatchId ? 'PUT' : 'POST';
    fetch(url,{method,headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF},body:JSON.stringify(payload)})
        .then(r=>r.json()).then(data=>{ if(data.success){ showToast('Match saved!','success'); closeModal('modal-match'); setTimeout(()=>location.reload(),600); }});
}
function d(id){ return document.getElementById(id).value; }

function savePrices() {
    const prices = [];
    document.querySelectorAll('input[data-category-id][type="number"]').forEach(inp => {
        if(inp.value !== '') prices.push({id:inp.dataset.categoryId, price:inp.value});
    });
    fetch('/admin/categories/prices',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF},body:JSON.stringify({prices})})
        .then(r=>r.json()).then(data=>{ if(data.success) showToast('Prices saved!','success'); });
}
function toggleAvailability(id, val) {
    fetch(`/admin/categories/${id}/availability`,{method:'PATCH',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF},body:JSON.stringify({is_available:val})})
        .then(r=>r.json()).then(data=>{ if(data.success) showToast(val?'Section enabled':'Section disabled','success'); });
}

let scannedCode = null;
function scanCode() {
    const code = document.getElementById('scanner-input').value.trim();
    if(!code) return;
    scannedCode = code;
    fetch(`/admin/scan/${code}`).then(r=>r.json()).then(d => {
        if(d.error){ showToast('Booking code not found','error'); return; }
        document.getElementById('sr-code').textContent     = d.booking_code;
        document.getElementById('sr-customer').textContent = d.customer;
        document.getElementById('sr-match').textContent    = d.match+' · '+d.match_date;
        document.getElementById('sr-section').textContent  = 'Section '+d.section+' — '+d.section_name;
        document.getElementById('sr-qty').textContent      = d.quantity;
        document.getElementById('sr-payment').innerHTML    = `<span class="badge badge-${d.payment_status}">${d.payment_status}</span>`;
        document.getElementById('sr-entry').innerHTML      = `<span class="badge ${d.entry_status==='entered'?'badge-entered':'badge-not-entered'}">${d.entry_status}</span>`;
        const btn = document.getElementById('mark-entered-btn');
        btn.disabled = d.entry_status==='entered'||d.payment_status!=='verified';
        btn.textContent = d.entry_status==='entered'?'✓ Already Entered':'✓ Mark as Entered';
        document.getElementById('scanner-result').classList.add('show');
    }).catch(()=>showToast('Error looking up code','error'));
}
function markEntered() {
    if(!scannedCode) return;
    fetch(`/admin/scan/${scannedCode}/enter`,{method:'POST',headers:{'X-CSRF-TOKEN':CSRF}})
        .then(r=>r.json()).then(d=>{
            if(d.success){
                showToast('✓ Entry recorded!','success');
                document.getElementById('mark-entered-btn').disabled = true;
                document.getElementById('mark-entered-btn').textContent = '✓ Already Entered';
                document.getElementById('sr-entry').innerHTML = '<span class="badge badge-entered">entered</span>';
            } else { showToast(d.message||'Error','error'); }
        });
}

function openModal(id)  { document.getElementById(id).classList.add('open'); }
function closeModal(id) { document.getElementById(id).classList.remove('open'); }
document.querySelectorAll('.modal-overlay').forEach(o => {
    o.addEventListener('click', e => { if(e.target===o) o.classList.remove('open'); });
});

function showToast(msg, type='success') {
    const t = document.getElementById('toast');
    t.textContent = msg; t.className = `toast ${type} show`;
    setTimeout(()=>t.classList.remove('show'), 3000);
}

const pendingCount = document.querySelectorAll('[data-status="pending"]').length;
document.getElementById('pending-badge').textContent = pendingCount;
if(pendingCount === 0) document.getElementById('pending-badge').style.display = 'none';
</script>
</body>
</html>