<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'TechShop') }}</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<script>(function(){var t=localStorage.getItem('ts-theme')||'light';document.documentElement.setAttribute('data-theme',t);})();</script>
<style>
:root{--p:#5F5CF5;--p-h:#4341D8;--p-glow:rgba(95,92,245,.18);--p-tint:rgba(95,92,245,.08);--bg:#F7F7FF;--sf:#FFFFFF;--sf2:#EEEEFB;--bd:#E2E2F0;--bd2:rgba(95,92,245,.14);--tx:#0C0C18;--tx2:#4A4A6C;--tx3:#9090B2;--err:#EF4444;--err-bg:rgba(239,68,68,.1);--r2:10px;--r3:14px;--r4:20px;--r5:28px;--rf:9999px;--s4:0 16px 56px rgba(95,92,245,.20);--ease:cubic-bezier(.4,0,.2,1);--t1:140ms;--t2:220ms;--t3:360ms}
[data-theme="dark"]{--bg:#07070F;--sf:#0F0F1C;--sf2:#161624;--bd:#202030;--bd2:rgba(95,92,245,.18);--tx:#EEEEFF;--tx2:#9090B4;--tx3:#505068;--err-bg:rgba(239,68,68,.12);--s4:0 16px 56px rgba(95,92,245,.30)}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{font-family:'Inter',system-ui,-apple-system,'Segoe UI',sans-serif;background:var(--bg);color:var(--tx);font-size:1rem;line-height:1.65;-webkit-font-smoothing:antialiased;transition:background var(--t3),color var(--t3);min-height:100vh}
a{color:inherit;text-decoration:none}
button{cursor:pointer;font-family:inherit;border:none;background:none}
input,textarea{font-family:inherit;font-size:inherit}

.btn{display:inline-flex;align-items:center;gap:8px;padding:10px 22px;border-radius:var(--rf);font-weight:600;font-size:.9375rem;min-height:44px;cursor:pointer;transition:transform var(--t2) var(--ease),box-shadow var(--t2) var(--ease),background var(--t2),color var(--t1),border-color var(--t1)}
.btn:active{transform:scale(.97)!important}
.btn-p{background:var(--p);color:#fff;box-shadow:0 4px 16px var(--p-glow)}
.btn-p:hover{background:var(--p-h);transform:translateY(-2px);box-shadow:0 6px 24px rgba(95,92,245,.32);color:#fff}
.btn-fw{width:100%;justify-content:center}

.fg{margin-bottom:18px}
.fl{display:block;font-weight:600;font-size:.9375rem;margin-bottom:7px;color:var(--tx)}
.fl span{color:var(--err);margin-left:2px}
.fi{width:100%;padding:11px 15px;border:1.5px solid var(--bd);border-radius:var(--r2);background:var(--sf);color:var(--tx);font-size:.9375rem;outline:none;transition:border-color var(--t1),box-shadow var(--t1),background var(--t3)}
.fi:focus{border-color:var(--p);box-shadow:0 0 0 3px var(--p-tint)}
.fi::placeholder{color:var(--tx3)}
.fe{color:var(--err);font-size:.8rem;margin-top:4px}

.auth-wrap{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:40px 20px;background:var(--bg);position:relative;overflow:hidden}
.auth-wrap::before{content:'';position:absolute;inset:0;pointer-events:none;background:radial-gradient(ellipse 60% 60% at 50% 0%,rgba(95,92,245,.09) 0%,transparent 60%)}
.auth-card{width:100%;max-width:428px;background:var(--sf);border:1.5px solid var(--bd);border-radius:var(--r5);padding:40px;box-shadow:var(--s4);position:relative;z-index:1}
.auth-logo{text-align:center;margin-bottom:26px}
.auth-logo a{font-size:1.45rem;font-weight:900;color:var(--tx)}
.auth-logo a span{color:var(--p)}
.auth-ttl{text-align:center;margin-bottom:26px}
.auth-ttl h2{font-size:1.45rem;font-weight:800;margin-bottom:5px;letter-spacing:-.025em}
.auth-ttl p{color:var(--tx2);font-size:.9375rem}
.auth-foot{text-align:center;margin-top:18px;font-size:.9375rem;color:var(--tx3)}
.auth-foot a{color:var(--p);font-weight:600}
.auth-foot a:hover{text-decoration:underline}
.divider{border:none;border-top:1px solid var(--bd);margin:18px 0}
</style>
</head>
<body>
{{ $slot }}
<script>(function(){var t=localStorage.getItem('ts-theme')||'light';document.documentElement.setAttribute('data-theme',t)})();</script>
</body>
</html>
