@extends('layouts.app')

@section('title', 'Manage Ads — Admin')

@section('content')
<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { background:#0a0f1a; color:#fff; font-family:'Instrument Sans',sans-serif; }
.topbar { background:#0d1420; border-bottom:1px solid rgba(255,255,255,0.08); padding:16px 30px; display:flex; align-items:center; justify-content:space-between; }
.topbar-logo { font-family:'Bebas Neue',sans-serif; font-size:1.3rem; letter-spacing:3px; color:#fff; text-decoration:none; }
.topbar-logo span { color:#FFD700; }
.topbar-nav { display:flex; gap:10px; }
.topbar-nav a { padding:7px 16px; border-radius:6px; font-size:0.8rem; font-weight:600; letter-spacing:1px; text-decoration:none; background:rgba(255,255,255,0.05); color:rgba(255,255,255,0.6); transition:all 0.2s; }
.topbar-nav a:hover, .topbar-nav a.active { background:#1E88FF; color:#fff; }
.page { max-width:1000px; margin:0 auto; padding:40px 20px; }
.page-title { font-family:'Bebas Neue',sans-serif; font-size:2rem; letter-spacing:3px; margin-bottom:8px; }
.page-sub { color:rgba(255,255,255,0.4); font-size:0.85rem; margin-bottom:35px; }

.upload-card { background:#111827; border:2px dashed rgba(255,215,0,0.3); border-radius:16px; padding:35px; margin-bottom:35px; text-align:center; }
.upload-card h3 { font-family:'Bebas Neue',sans-serif; font-size:1.3rem; letter-spacing:2px; color:#FFD700; margin-bottom:8px; }
.upload-card p { color:rgba(255,255,255,0.4); font-size:0.85rem; margin-bottom:20px; }
.upload-form { display:flex; gap:12px; justify-content:center; align-items:center; flex-wrap:wrap; }
.file-input { padding:10px 16px; background:#0d1728; border:1px solid rgba(255,255,255,0.1); border-radius:8px; color:#fff; font-family:'Instrument Sans',sans-serif; font-size:0.85rem; cursor:pointer; }
.file-input::file-selector-button { background:#1E88FF; color:#fff; border:none; padding:6px 14px; border-radius:5px; cursor:pointer; font-family:'Instrument Sans',sans-serif; font-size:0.8rem; margin-right:10px; }
.btn-upload { padding:10px 24px; background:#FFD700; color:#0B1220; border:none; border-radius:8px; font-family:'Bebas Neue',sans-serif; font-size:0.95rem; letter-spacing:2px; cursor:pointer; transition:opacity 0.2s; }
.btn-upload:hover { opacity:0.85; }

.ads-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(220px,1fr)); gap:20px; }
.ad-card { background:#111827; border:1px solid rgba(255,255,255,0.08); border-radius:14px; overflow:hidden; transition:border-color 0.3s; }
.ad-card.inactive { opacity:0.5; }
.ad-card img { width:100%; height:160px; object-fit:cover; display:block; }
.ad-card-body { padding:14px; }
.ad-name { font-size:0.78rem; color:rgba(255,255,255,0.5); margin-bottom:10px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.ad-actions { display:flex; gap:8px; }
.btn-toggle { flex:1; padding:7px; border:none; border-radius:7px; font-size:0.78rem; font-weight:600; cursor:pointer; transition:all 0.2s; }
.btn-toggle.active { background:rgba(34,197,94,0.15); color:#22c55e; border:1px solid rgba(34,197,94,0.3); }
.btn-toggle.inactive { background:rgba(239,68,68,0.15); color:#f87171; border:1px solid rgba(239,68,68,0.3); }
.btn-delete { padding:7px 12px; background:rgba(239,68,68,0.1); border:1px solid rgba(239,68,68,0.2); border-radius:7px; color:#f87171; font-size:0.78rem; cursor:pointer; transition:all 0.2s; }
.btn-delete:hover { background:rgba(239,68,68,0.25); }

.status-badge { display:inline-block; padding:3px 10px; border-radius:20px; font-size:0.7rem; font-weight:600; margin-bottom:8px; }
.status-badge.on { background:rgba(34,197,94,0.15); color:#22c55e; }
.status-badge.off { background:rgba(239,68,68,0.15); color:#f87171; }

.empty { text-align:center; padding:60px 20px; color:rgba(255,255,255,0.3); }
.empty .icon { font-size:3rem; margin-bottom:15px; display:block; }
</style>

<div class="topbar">
    <a href="/admin" class="topbar-logo">MINIEH <span>ADMIN</span></a>
    <div class="topbar-nav">
        <a href="/admin">Dashboard</a>
        <a href="/admin/ads" class="active">Ads</a>
        <form method="POST" action="/admin/logout" style="display:inline;">
            @csrf
            <button type="submit" style="padding:7px 16px;border-radius:6px;font-size:0.8rem;font-weight:600;background:rgba(239,68,68,0.15);color:#f87171;border:1px solid rgba(239,68,68,0.2);cursor:pointer;">Logout</button>
        </form>
    </div>
</div>

<div class="page">
    <div class="page-title">📸 Manage Ads</div>
    <p class="page-sub">Upload images to display in the slider on the home page. Toggle to pause/resume each ad.</p>

    @if(session('success'))
        <div style="background:rgba(34,197,94,0.1);border:1px solid rgba(34,197,94,0.3);border-radius:8px;padding:12px 16px;margin-bottom:20px;color:#22c55e;font-size:0.85rem;">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="upload-card">
        <h3>Upload New Ad</h3>
        <p>Supported formats: JPG, PNG, GIF, WebP — Max 5MB</p>
        <form action="/admin/ads" method="POST" enctype="multipart/form-data" class="upload-form">
            @csrf
            <input type="file" name="image" class="file-input" accept="image/*" required>
            <button type="submit" class="btn-upload">Upload Ad</button>
        </form>
        @error('image')
            <p style="color:#f87171;font-size:0.8rem;margin-top:10px;">{{ $message }}</p>
        @enderror
    </div>

    @if($ads->count() > 0)
        <div class="ads-grid">
            @foreach($ads as $ad)
            <div class="ad-card {{ $ad->is_active ? '' : 'inactive' }}" id="ad-{{ $ad->id }}">
                <img src="{{ asset('storage/' . $ad->file_path) }}" alt="{{ $ad->original_name }}">
                <div class="ad-card-body">
                    <div class="status-badge {{ $ad->is_active ? 'on' : 'off' }}" id="badge-{{ $ad->id }}">
                        {{ $ad->is_active ? '▶ Active' : '⏸ Paused' }}
                    </div>
                    <div class="ad-name">{{ $ad->original_name }}</div>
                    <div class="ad-actions">
                        <button class="btn-toggle {{ $ad->is_active ? 'active' : 'inactive' }}" id="toggle-{{ $ad->id }}" onclick="toggleAd({{ $ad->id }}, {{ $ad->is_active ? 'true' : 'false' }})">
                            {{ $ad->is_active ? '⏸ Pause' : '▶ Resume' }}
                        </button>
                        <button class="btn-delete" onclick="deleteAd({{ $ad->id }})">🗑</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="empty">
            <span class="icon">📭</span>
            <p>No ads uploaded yet. Upload your first ad above.</p>
        </div>
    @endif
</div>

<script>
function toggleAd(id, isActive) {
    fetch(`/admin/ads/${id}/toggle`, {
        method: 'PATCH',
        headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Content-Type': 'application/json'}
    })
    .then(r => r.json())
    .then(data => {
        const card = document.getElementById('ad-' + id);
        const badge = document.getElementById('badge-' + id);
        const btn = document.getElementById('toggle-' + id);
        if (data.is_active) {
            card.classList.remove('inactive');
            badge.className = 'status-badge on';
            badge.textContent = '▶ Active';
            btn.className = 'btn-toggle active';
            btn.textContent = '⏸ Pause';
            btn.onclick = () => toggleAd(id, true);
        } else {
            card.classList.add('inactive');
            badge.className = 'status-badge off';
            badge.textContent = '⏸ Paused';
            btn.className = 'btn-toggle inactive';
            btn.textContent = '▶ Resume';
            btn.onclick = () => toggleAd(id, false);
        }
    });
}

function deleteAd(id) {
    if (!confirm('Delete this ad?')) return;
    fetch(`/admin/ads/${id}`, {
        method: 'DELETE',
        headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content}
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            document.getElementById('ad-' + id).remove();
        }
    });
}
</script>
@endsection