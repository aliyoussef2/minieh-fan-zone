<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login — Minieh Fan Zone</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Instrument+Sans:wght@400;500&display=swap" rel="stylesheet">
<style>
* { box-sizing: border-box; margin: 0; padding: 0; }
body { background: #0B1220; color: #fff; font-family: 'Instrument Sans', sans-serif; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
.card { background: #111827; border: 1px solid rgba(255,215,0,0.2); border-radius: 18px; padding: 2.5rem 2rem; width: 100%; max-width: 380px; }
.logo { text-align: center; margin-bottom: 2rem; }
.logo h1 { font-family: 'Bebas Neue', sans-serif; font-size: 1.8rem; letter-spacing: .08em; color: #FFD700; }
.logo p  { font-size: .78rem; color: rgba(255,255,255,0.4); margin-top: 4px; }
.form-group { display: flex; flex-direction: column; gap: .4rem; margin-bottom: 1rem; }
.form-group label { font-size: .72rem; color: rgba(255,255,255,0.45); text-transform: uppercase; letter-spacing: .05em; }
.form-group input {
    padding: .7rem 1rem; background: #0d1728; border: 1px solid rgba(255,255,255,0.08);
    border-radius: 9px; color: #fff; font-family: 'Instrument Sans', sans-serif; font-size: .9rem; outline: none;
    transition: border-color .2s;
}
.form-group input:focus { border-color: rgba(255,215,0,0.4); }
.btn-login {
    width: 100%; padding: .8rem; background: #FFD700; color: #0B1220;
    font-family: 'Bebas Neue', sans-serif; font-size: 1.05rem; letter-spacing: .1em;
    border: none; border-radius: 9px; cursor: pointer; margin-top: .5rem; transition: opacity .2s;
}
.btn-login:hover { opacity: .88; }
.error-msg { background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3); border-radius: 8px; padding: .65rem .9rem; font-size: .8rem; color: #f87171; margin-bottom: 1rem; }
</style>
</head>
<body>
<div class="card">
    <div class="logo">
        <h1>Minieh Fan Zone</h1>
        <p>Admin Access Only</p>
    </div>

    @if(session('error'))
    <div class="error-msg">{{ session('error') }}</div>
    @endif

    <form method="POST" action="/admin/login">
        @csrf
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" placeholder="admin" required autofocus>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="••••••••" required>
        </div>
        <button type="submit" class="btn-login">Login to Dashboard</button>
    </form>
</div>
</body>
</html>