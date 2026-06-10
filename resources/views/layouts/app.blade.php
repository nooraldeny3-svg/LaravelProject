<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'TechShop — Premium Electronics')</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<script>(function(){var t=localStorage.getItem('ts-theme')||'light';document.documentElement.setAttribute('data-theme',t);})();</script>
<style>
/* ============================================================
   TECHSHOP — DESIGN SYSTEM  (pure CSS, no frameworks)
   ============================================================ */

/* 1 · TOKENS ------------------------------------------------- */
:root {
  --p:        #5F5CF5;
  --p-h:      #4341D8;
  --p-l:      #818CF8;
  --p-glow:   rgba(95,92,245,.18);
  --p-tint:   rgba(95,92,245,.08);
  --cyan:     #22D3EE;
  --accent:   #F43F5E;

  --bg:       #F7F7FF;
  --sf:       #FFFFFF;
  --sf2:      #EEEEFB;
  --bd:       #E2E2F0;
  --bd2:      rgba(95,92,245,.14);

  --tx:       #0C0C18;
  --tx2:      #4A4A6C;
  --tx3:      #9090B2;

  --ok:       #10B981;
  --ok-bg:    rgba(16,185,129,.1);
  --warn:     #F59E0B;
  --warn-bg:  rgba(245,158,11,.1);
  --err:      #EF4444;
  --err-bg:   rgba(239,68,68,.1);

  --r1: 6px; --r2: 10px; --r3: 14px; --r4: 20px; --r5: 28px; --rf: 9999px;

  --s1: 0 1px 4px rgba(12,12,24,.06);
  --s2: 0 3px 12px rgba(12,12,24,.09);
  --s3: 0 8px 32px rgba(95,92,245,.14);
  --s4: 0 16px 56px rgba(95,92,245,.20);

  --ease: cubic-bezier(.4,0,.2,1);
  --t1: 140ms; --t2: 220ms; --t3: 360ms;
  --nav-h: 70px;
  --max: 1200px;
}

[data-theme="dark"] {
  --bg:  #07070F;
  --sf:  #0F0F1C;
  --sf2: #161624;
  --bd:  #202030;
  --bd2: rgba(95,92,245,.18);
  --tx:  #EEEEFF;
  --tx2: #9090B4;
  --tx3: #505068;
  --s1: 0 1px 4px rgba(0,0,0,.5);
  --s2: 0 3px 12px rgba(0,0,0,.55);
  --s3: 0 8px 32px rgba(95,92,245,.22);
  --s4: 0 16px 56px rgba(95,92,245,.30);
  --ok-bg:   rgba(16,185,129,.12);
  --warn-bg: rgba(245,158,11,.12);
  --err-bg:  rgba(239,68,68,.12);
}

/* 2 · RESET -------------------------------------------------- */
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth;-webkit-text-size-adjust:100%}
body{
  font-family:'Inter',system-ui,-apple-system,'Segoe UI',sans-serif;
  background:var(--bg);color:var(--tx);font-size:1rem;line-height:1.65;
  min-height:100vh;display:flex;flex-direction:column;
  transition:background var(--t3) var(--ease),color var(--t3) var(--ease);
  -webkit-font-smoothing:antialiased;
}
img{display:block;max-width:100%;height:auto}
a{color:inherit;text-decoration:none}
button{cursor:pointer;font-family:inherit;border:none;background:none}
input,select,textarea{font-family:inherit;font-size:inherit}
ul,ol{list-style:none}

/* 3 · TYPOGRAPHY --------------------------------------------- */
h1{font-size:clamp(1.9rem,5vw,3.4rem);font-weight:800;line-height:1.1;letter-spacing:-.035em}
h2{font-size:clamp(1.4rem,3vw,2.2rem);font-weight:700;line-height:1.2;letter-spacing:-.025em}
h3{font-size:clamp(1.05rem,2vw,1.45rem);font-weight:600;line-height:1.3}
h4{font-size:1.1rem;font-weight:600;line-height:1.4}
h5{font-size:.9375rem;font-weight:600}
p{color:var(--tx2)}
.text-grad{
  background:linear-gradient(135deg,var(--p),#9B85FF,var(--cyan));
  -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;
}
.text-sm{font-size:.875rem} .text-xs{font-size:.8125rem} .text-muted{color:var(--tx3);font-size:.875rem}

/* 4 · LAYOUT ------------------------------------------------- */
.container{max-width:var(--max);margin:0 auto;padding:0 20px}
@media(min-width:768px){.container{padding:0 32px}}
@media(min-width:1280px){.container{padding:0 40px}}
main{flex:1}
.section{padding:80px 0}.section-sm{padding:48px 0}
.sec-head{margin-bottom:48px}
.sec-head h2{margin-bottom:10px}
.sec-head p{font-size:1.05rem;max-width:580px}
.sec-head.center{text-align:center}
.sec-head.center p{margin:0 auto}

/* 5 · GRID --------------------------------------------------- */
.g2{display:grid;grid-template-columns:1fr;gap:24px}
.g3{display:grid;grid-template-columns:1fr;gap:24px}
.g4{display:grid;grid-template-columns:1fr 1fr;gap:20px}
@media(min-width:600px){.g2{grid-template-columns:1fr 1fr}}
@media(min-width:768px){.g3{grid-template-columns:1fr 1fr};.g4{grid-template-columns:repeat(2,1fr)}}
@media(min-width:1024px){.g3{grid-template-columns:repeat(3,1fr)};.g4{grid-template-columns:repeat(4,1fr)}}

/* 6 · BUTTONS ------------------------------------------------ */
.btn{
  display:inline-flex;align-items:center;gap:8px;
  padding:10px 22px;border-radius:var(--rf);
  font-weight:600;font-size:.9375rem;white-space:nowrap;
  min-height:44px;cursor:pointer;
  transition:transform var(--t2) var(--ease),box-shadow var(--t2) var(--ease),
             background var(--t2) var(--ease),color var(--t1) var(--ease),border-color var(--t1) var(--ease);
}
.btn:active{transform:scale(.97)!important}
.btn-p{background:var(--p);color:#fff;box-shadow:0 4px 16px var(--p-glow)}
.btn-p:hover{background:var(--p-h);box-shadow:0 6px 24px rgba(95,92,245,.32);transform:translateY(-2px);color:#fff}
.btn-o{background:transparent;color:var(--tx);border:1.5px solid var(--bd)}
.btn-o:hover{border-color:var(--p);color:var(--p);transform:translateY(-2px)}
.btn-s{background:var(--sf2);color:var(--tx);border:1.5px solid var(--bd)}
.btn-s:hover{background:var(--bd);transform:translateY(-2px)}
.btn-d{background:var(--err);color:#fff}
.btn-d:hover{background:#DC2626;transform:translateY(-2px)}
.btn-i{
  display:inline-flex;align-items:center;justify-content:center;
  width:44px;height:44px;border-radius:var(--r2);
  border:1.5px solid var(--bd);background:var(--sf);color:var(--tx2);
  transition:border-color var(--t2),color var(--t2),background var(--t2);
  flex-shrink:0;
}
.btn-i:hover{border-color:var(--p);color:var(--p);background:var(--p-tint)}
.btn-sm{padding:7px 16px;font-size:.875rem;min-height:36px}
.btn-lg{padding:13px 30px;font-size:1.0625rem}
.btn-fw{width:100%;justify-content:center}
.btn-ghost-white{background:rgba(255,255,255,.1);color:#fff;border:1.5px solid rgba(255,255,255,.25)}
.btn-ghost-white:hover{background:rgba(255,255,255,.2);color:#fff;transform:translateY(-2px)}

/* 7 · NAV ---------------------------------------------------- */
.nav{
  position:sticky;top:0;z-index:1000;
  height:var(--nav-h);
  background:rgba(247,247,255,.88);
  backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);
  border-bottom:1px solid var(--bd);
  transition:background var(--t3),border-color var(--t3);
}
[data-theme="dark"] .nav{background:rgba(7,7,15,.88)}
.nav-inner{display:flex;align-items:center;gap:8px;height:100%}
.nav-logo{
  display:flex;align-items:center;gap:10px;
  font-size:1.25rem;font-weight:800;letter-spacing:-.025em;color:var(--tx);flex-shrink:0;
}
.nav-logo span{color:var(--p)}
.nav-links{display:none;align-items:center;gap:2px;margin:0 auto}
@media(min-width:768px){.nav-links{display:flex}}
.nav-link{
  padding:8px 14px;border-radius:var(--r2);
  font-weight:500;font-size:.9375rem;color:var(--tx2);
  transition:color var(--t1) var(--ease),background var(--t1) var(--ease);
}
.nav-link:hover,.nav-link.active{color:var(--p);background:var(--p-tint)}
.nav-right{display:flex;align-items:center;gap:8px;margin-left:auto}
@media(min-width:768px){.nav-right{margin-left:0}}
.cart-btn{
  position:relative;display:inline-flex;align-items:center;justify-content:center;
  width:44px;height:44px;border-radius:var(--r2);
  border:1.5px solid var(--bd);background:var(--sf);color:var(--tx2);
  transition:border-color var(--t2),color var(--t2),background var(--t2);
}
.cart-btn:hover{border-color:var(--p);color:var(--p);background:var(--p-tint)}
.c-badge{
  position:absolute;top:-6px;right:-6px;min-width:18px;height:18px;
  padding:0 4px;background:var(--p);color:#fff;border-radius:var(--rf);
  font-size:.68rem;font-weight:700;display:flex;align-items:center;justify-content:center;
}
.drop{position:relative}
.drop-menu{
  display:none;position:absolute;top:calc(100% + 8px);right:0;
  min-width:196px;background:var(--sf);border:1.5px solid var(--bd);
  border-radius:var(--r3);box-shadow:var(--s3);padding:6px;z-index:200;
  animation:fadeDown var(--t2) var(--ease);
}
.drop.open .drop-menu{display:block}
.drop-item{
  display:flex;align-items:center;gap:10px;width:100%;
  padding:10px 12px;border-radius:var(--r2);
  font-weight:500;font-size:.9375rem;color:var(--tx2);
  text-align:left;background:none;border:none;cursor:pointer;
  transition:background var(--t1),color var(--t1);
}
.drop-item:hover{background:var(--sf2);color:var(--p)}
.drop-sep{border:none;border-top:1px solid var(--bd);margin:4px 0}
.ham{
  display:flex;flex-direction:column;gap:5px;width:44px;height:44px;
  align-items:center;justify-content:center;
  border-radius:var(--r2);border:1.5px solid var(--bd);background:var(--sf);cursor:pointer;
  transition:border-color var(--t2);
}
@media(min-width:768px){.ham{display:none}}
.ham:hover{border-color:var(--p)}
.ham span{display:block;width:18px;height:2px;background:var(--tx2);border-radius:2px;transition:var(--t2)}
.mob-menu{
  display:none;position:fixed;top:var(--nav-h);left:0;right:0;bottom:0;
  background:var(--bg);z-index:999;padding:24px 20px;overflow-y:auto;
}
.mob-menu.open{display:block}
.mob-link{
  display:flex;align-items:center;gap:12px;
  padding:14px 16px;border-radius:var(--r3);
  font-weight:600;font-size:1.05rem;color:var(--tx);
  margin-bottom:4px;transition:background var(--t1),color var(--t1);
}
.mob-link:hover{background:var(--sf2);color:var(--p)}
.mob-sep{border:none;border-top:1px solid var(--bd);margin:12px 0}

/* 8 · ALERTS ------------------------------------------------- */
.alerts{
  position:fixed;top:calc(var(--nav-h) + 14px);right:18px;z-index:1100;
  display:flex;flex-direction:column;gap:9px;max-width:380px;width:calc(100vw - 36px);
}
.alert{
  display:flex;align-items:center;gap:12px;
  padding:13px 16px;border-radius:var(--r3);
  font-weight:500;font-size:.9375rem;
  box-shadow:var(--s3);cursor:pointer;
  animation:slideR var(--t2) var(--ease);
}
.alert-ok {background:var(--ok-bg);color:var(--ok);border:1px solid rgba(16,185,129,.22)}
.alert-err{background:var(--err-bg);color:var(--err);border:1px solid rgba(239,68,68,.22)}
.alert-warn{background:var(--warn-bg);color:var(--warn);border:1px solid rgba(245,158,11,.22)}
.alert-icon{flex-shrink:0;width:20px;height:20px}
.alert-x{margin-left:auto;opacity:.6;font-size:1rem;line-height:1;padding:2px;flex-shrink:0}
.alert-x:hover{opacity:1}

/* 9 · CARDS -------------------------------------------------- */
.card{
  background:var(--sf);border:1px solid var(--bd);border-radius:var(--r4);
  box-shadow:var(--s1);overflow:hidden;
  transition:transform var(--t2) var(--ease),box-shadow var(--t2) var(--ease),border-color var(--t2) var(--ease);
}
.card:hover{transform:translateY(-5px);box-shadow:var(--s3);border-color:var(--bd2)}
.card-img{width:100%;aspect-ratio:16/10;object-fit:cover;display:block}
.card-ph{
  width:100%;aspect-ratio:16/10;
  background:linear-gradient(135deg,var(--sf2),var(--bd));
  display:flex;align-items:center;justify-content:center;color:var(--tx3);
}
.card-body{padding:20px}
.card-badge{
  display:inline-flex;align-items:center;
  padding:3px 10px;border-radius:var(--rf);
  font-size:.73rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;
  background:var(--p-tint);color:var(--p);margin-bottom:10px;
}
.card-brand{font-size:.78rem;font-weight:700;color:var(--tx3);text-transform:uppercase;letter-spacing:.07em;margin-bottom:5px}
.card-title{font-size:1rem;font-weight:700;color:var(--tx);margin-bottom:8px;line-height:1.3;
  display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
.card-price{font-size:1.35rem;font-weight:800;color:var(--p);margin-bottom:14px;letter-spacing:-.02em}
.card-stock{font-size:.78rem;color:var(--tx3);margin-bottom:12px}
.card-stock.low{color:var(--warn)}.card-stock.out{color:var(--err)}

/* 10 · PRODUCT GRID ----------------------------------------- */
.prod-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(248px,1fr));gap:22px}

/* 11 · HERO -------------------------------------------------- */
.hero{
  position:relative;min-height:580px;
  display:flex;align-items:center;overflow:hidden;
  background:var(--sf);border-bottom:1px solid var(--bd);
}
.hero::before{
  content:'';position:absolute;inset:0;pointer-events:none;
  background:
    radial-gradient(ellipse 80% 60% at 72% 50%,rgba(95,92,245,.1) 0%,transparent 70%),
    radial-gradient(ellipse 50% 40% at 20% 80%,rgba(34,211,238,.07) 0%,transparent 60%);
}
[data-theme="dark"] .hero::before{
  background:
    radial-gradient(ellipse 80% 60% at 72% 50%,rgba(95,92,245,.16) 0%,transparent 70%),
    radial-gradient(ellipse 50% 40% at 20% 80%,rgba(34,211,238,.10) 0%,transparent 60%);
}
.hero-grid{
  position:relative;z-index:1;
  display:grid;grid-template-columns:1fr;gap:40px;align-items:center;padding:80px 0;
}
@media(min-width:900px){.hero-grid{grid-template-columns:1fr 1fr}}
.hero-eye{
  display:inline-flex;align-items:center;gap:6px;
  padding:5px 13px;border-radius:var(--rf);
  background:var(--p-tint);border:1px solid var(--bd2);
  font-size:.78rem;font-weight:700;color:var(--p);
  letter-spacing:.04em;text-transform:uppercase;margin-bottom:18px;
}
.hero-dot{width:6px;height:6px;border-radius:50%;background:var(--p);animation:pulse 2s infinite}
.hero-title{margin-bottom:18px}
.hero-desc{font-size:1.1rem;margin-bottom:28px;max-width:500px}
.hero-ctas{display:flex;flex-wrap:wrap;gap:12px;align-items:center}
.hero-stats{display:flex;gap:28px;margin-top:36px;padding-top:28px;border-top:1px solid var(--bd);flex-wrap:wrap}
.stat-val{font-size:1.65rem;font-weight:800;color:var(--tx)}
.stat-lbl{font-size:.78rem;color:var(--tx3);margin-top:2px}
.hero-vis{display:none;position:relative}
@media(min-width:900px){.hero-vis{display:block}}
.hero-vis-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}
.hero-vc{border-radius:var(--r4);overflow:hidden;box-shadow:var(--s3);transition:transform var(--t3)}
.hero-vc:hover{transform:scale(1.03) rotate(-1deg)}
.hero-vc:nth-child(2){margin-top:22px}.hero-vc:nth-child(3){margin-top:-10px}
.hero-vc img{width:100%;aspect-ratio:4/3;object-fit:cover;display:block}

/* 12 · CAT CARDS --------------------------------------------- */
.cat-card{
  position:relative;border-radius:var(--r4);overflow:hidden;
  aspect-ratio:4/3;cursor:pointer;display:block;
  box-shadow:var(--s1);
  transition:transform var(--t2) var(--ease),box-shadow var(--t2) var(--ease);
}
.cat-card:hover{transform:translateY(-6px) scale(1.01);box-shadow:var(--s4)}
.cat-card img{width:100%;height:100%;object-fit:cover;transition:transform var(--t3) var(--ease)}
.cat-card:hover img{transform:scale(1.07)}
.cat-ov{position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,.72) 0%,rgba(0,0,0,.08) 55%,transparent 100%)}
.cat-body{position:absolute;bottom:0;left:0;right:0;padding:22px;color:#fff}
.cat-cnt{font-size:.72rem;font-weight:600;opacity:.8;letter-spacing:.04em;text-transform:uppercase;margin-bottom:5px}
.cat-name{font-size:1.2rem;font-weight:700;line-height:1.2}
.cat-arr{
  position:absolute;top:50%;right:18px;transform:translateY(-50%) scale(0);
  width:34px;height:34px;border-radius:50%;background:rgba(255,255,255,.18);
  backdrop-filter:blur(8px);display:flex;align-items:center;justify-content:center;
  transition:transform var(--t2) var(--ease);color:#fff;
}
.cat-card:hover .cat-arr{transform:translateY(-50%) scale(1)}

/* 13 · FEATURES --------------------------------------------- */
.feat-card{
  padding:28px;border-radius:var(--r4);
  background:var(--sf);border:1px solid var(--bd);text-align:center;
  transition:transform var(--t2),box-shadow var(--t2);
}
.feat-card:hover{transform:translateY(-4px);box-shadow:var(--s2)}
.feat-icon{
  width:56px;height:56px;border-radius:var(--r3);
  background:var(--p-tint);border:1px solid var(--bd2);
  display:flex;align-items:center;justify-content:center;
  margin:0 auto 16px;color:var(--p);
}
.feat-card h4{margin-bottom:8px}

/* 14 · FORMS ------------------------------------------------- */
.fg{margin-bottom:20px}
.fl{display:block;font-weight:600;font-size:.9375rem;margin-bottom:7px;color:var(--tx)}
.fl span{color:var(--err);margin-left:2px}
.fi,.fs,.ft{
  width:100%;padding:11px 15px;
  border:1.5px solid var(--bd);border-radius:var(--r2);
  background:var(--sf);color:var(--tx);font-size:.9375rem;outline:none;
  transition:border-color var(--t1),box-shadow var(--t1),background var(--t3);
}
.fi:focus,.fs:focus,.ft:focus{border-color:var(--p);box-shadow:0 0 0 3px var(--p-tint)}
.fi::placeholder{color:var(--tx3)}
.ft{resize:vertical;min-height:110px}
.fe{color:var(--err);font-size:.8rem;margin-top:4px}
.fh{color:var(--tx3);font-size:.8rem;margin-top:4px}
.fr{display:grid;grid-template-columns:1fr;gap:20px}
@media(min-width:600px){.fr{grid-template-columns:1fr 1fr}}
.tog-label{display:flex;align-items:center;gap:12px;cursor:pointer}
.tog-track{position:relative;width:46px;height:26px;background:var(--bd);border-radius:var(--rf);transition:background var(--t2) var(--ease);flex-shrink:0}
.tog-track::after{content:'';position:absolute;top:3px;left:3px;width:20px;height:20px;border-radius:50%;background:#fff;box-shadow:var(--s1);transition:transform var(--t2) var(--ease)}
input[type="checkbox"]:checked+.tog-track{background:var(--p)}
input[type="checkbox"]:checked+.tog-track::after{transform:translateX(20px)}
input[type="checkbox"].sr-only{position:absolute;opacity:0;width:0;height:0}

/* 15 · TABLE ------------------------------------------------- */
.tw{overflow-x:auto;border-radius:var(--r4);border:1px solid var(--bd)}
.table{width:100%;border-collapse:collapse;background:var(--sf)}
.table th{padding:13px 18px;text-align:left;font-size:.76rem;font-weight:700;color:var(--tx3);text-transform:uppercase;letter-spacing:.07em;background:var(--sf2);border-bottom:1px solid var(--bd)}
.table td{padding:15px 18px;border-bottom:1px solid var(--bd);color:var(--tx2);font-size:.9375rem}
.table tr:last-child td{border-bottom:none}
.table tr:hover td{background:var(--sf2)}
.tthumb{width:46px;height:46px;border-radius:var(--r2);object-fit:cover;border:1px solid var(--bd)}

/* 16 · BADGES ----------------------------------------------- */
.badge{
  display:inline-flex;align-items:center;gap:5px;
  padding:4px 10px;border-radius:var(--rf);
  font-size:.72rem;font-weight:700;letter-spacing:.03em;text-transform:uppercase;
}
.badge::before{content:'';width:6px;height:6px;border-radius:50%;background:currentColor;flex-shrink:0}
.badge-pend{background:var(--warn-bg);color:var(--warn)}
.badge-conf{background:var(--ok-bg);color:var(--ok)}
.badge-canc{background:var(--err-bg);color:var(--err)}
.badge-p{background:var(--p-tint);color:var(--p)}

/* 17 · PAGE HEADER ------------------------------------------ */
.pg-head{
  padding:52px 0 36px;border-bottom:1px solid var(--bd);margin-bottom:44px;
  background:var(--sf);position:relative;overflow:hidden;
}
.pg-head::before{
  content:'';position:absolute;inset:0;pointer-events:none;
  background:radial-gradient(ellipse 55% 100% at 82% 50%,rgba(95,92,245,.07) 0%,transparent 70%);
}
.pg-head-inner{position:relative}
.pg-back{display:inline-flex;align-items:center;gap:6px;color:var(--tx3);font-size:.875rem;margin-bottom:14px;transition:color var(--t1)}
.pg-back:hover{color:var(--p)}
.pg-sub{margin-top:8px;font-size:1.0625rem}

/* 18 · ADMIN ------------------------------------------------- */
.adm-layout{display:flex;min-height:calc(100vh - var(--nav-h))}
.adm-side{width:256px;background:var(--sf);border-right:1px solid var(--bd);padding:24px 14px;flex-shrink:0;display:none}
@media(min-width:1024px){.adm-side{display:block}}
.adm-content{flex:1;padding:32px 20px;min-width:0}
@media(min-width:768px){.adm-content{padding:40px 32px}}
.adm-nav-lbl{font-size:.68rem;font-weight:700;color:var(--tx3);text-transform:uppercase;letter-spacing:.1em;padding:0 10px;margin-bottom:6px;margin-top:16px}
.adm-nav-lbl:first-child{margin-top:0}
.adm-nav-item{
  display:flex;align-items:center;gap:9px;
  padding:9px 10px;border-radius:var(--r2);
  font-weight:500;font-size:.9375rem;color:var(--tx2);
  transition:background var(--t1),color var(--t1);margin-bottom:2px;
}
.adm-nav-item:hover,.adm-nav-item.on{background:var(--p-tint);color:var(--p)}
.adm-nav-item svg{width:17px;height:17px;flex-shrink:0}

/* 19 · STAT CARDS -------------------------------------------- */
.stat-card{background:var(--sf);border:1px solid var(--bd);border-radius:var(--r4);padding:22px 26px;display:flex;align-items:flex-start;gap:14px;transition:transform var(--t2),box-shadow var(--t2)}
.stat-card:hover{transform:translateY(-2px);box-shadow:var(--s2)}
.stat-ico{width:50px;height:50px;border-radius:var(--r3);display:flex;align-items:center;justify-content:center;flex-shrink:0}
.ico-blue{background:var(--p-tint);color:var(--p)}
.ico-cyan{background:rgba(34,211,238,.1);color:var(--cyan)}
.ico-green{background:var(--ok-bg);color:var(--ok)}
.ico-amber{background:var(--warn-bg);color:var(--warn)}
.stat-num{font-size:1.8rem;font-weight:800;color:var(--tx);line-height:1;margin-bottom:5px}
.stat-txt{font-size:.84rem;color:var(--tx3);font-weight:500}

/* 20 · PRODUCT DETAIL --------------------------------------- */
.pd-grid{display:grid;grid-template-columns:1fr;gap:44px;padding:44px 0}
@media(min-width:768px){.pd-grid{grid-template-columns:1fr 1fr;gap:60px}}
.pd-img{border-radius:var(--r5);overflow:hidden;aspect-ratio:1;border:1px solid var(--bd);background:var(--sf2);box-shadow:var(--s2)}
.pd-img img{width:100%;height:100%;object-fit:cover;display:block}
.pd-brand{font-size:.78rem;font-weight:700;color:var(--tx3);text-transform:uppercase;letter-spacing:.09em;margin-bottom:9px}
.pd-title{font-size:clamp(1.4rem,3vw,2rem);font-weight:800;letter-spacing:-.025em;line-height:1.2;margin-bottom:14px}
.pd-price{font-size:2.1rem;font-weight:900;color:var(--p);letter-spacing:-.03em;margin-bottom:5px}
.pd-stock{font-size:.875rem;color:var(--ok);font-weight:600;margin-bottom:22px}
.pd-desc{font-size:.9375rem;line-height:1.8;color:var(--tx2);margin-bottom:28px;padding-bottom:28px;border-bottom:1px solid var(--bd)}
.pd-meta{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:28px}
.pd-meta-i{background:var(--sf2);border:1px solid var(--bd);border-radius:var(--r2);padding:12px 14px}
.pd-meta-i small{display:block;color:var(--tx3);font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.04em;margin-bottom:4px}
.pd-meta-i span{font-weight:600;font-size:.9375rem}

/* 21 · CART -------------------------------------------------- */
.cart-layout{display:grid;grid-template-columns:1fr;gap:28px;padding:44px 0}
@media(min-width:900px){.cart-layout{grid-template-columns:1fr 340px}}
.cart-item{display:flex;align-items:center;gap:14px;padding:18px;border-bottom:1px solid var(--bd)}
.cart-item:last-child{border-bottom:none}
.ci-img{width:76px;height:76px;border-radius:var(--r2);object-fit:cover;flex-shrink:0;border:1px solid var(--bd);background:var(--sf2)}
.ci-info{flex:1;min-width:0}
.ci-name{font-weight:600;color:var(--tx);margin-bottom:3px;font-size:.9375rem}
.ci-price{font-size:.875rem;color:var(--tx3)}
.ci-acts{display:flex;align-items:center;gap:10px;flex-shrink:0}
.qty{width:58px;text-align:center;padding:7px 8px;border:1.5px solid var(--bd);border-radius:var(--r2);font-weight:600;background:var(--sf);color:var(--tx);outline:none;transition:border-color var(--t1)}
.qty:focus{border-color:var(--p)}
.cart-sum{background:var(--sf);border:1px solid var(--bd);border-radius:var(--r4);padding:26px;position:sticky;top:calc(var(--nav-h) + 18px);height:fit-content}
.cart-sum h3{margin-bottom:18px}
.sum-row{display:flex;justify-content:space-between;align-items:center;padding:9px 0;border-bottom:1px solid var(--bd);font-size:.9375rem}
.sum-row:last-of-type{border-bottom:none}
.sum-tot{display:flex;justify-content:space-between;align-items:center;padding:14px 0;font-size:1.1rem;font-weight:800}
.sum-tot span:last-child{color:var(--p)}

/* 22 · CHECKOUT --------------------------------------------- */
.co-layout{display:grid;grid-template-columns:1fr;gap:28px;padding:44px 0}
@media(min-width:900px){.co-layout{grid-template-columns:1fr 360px}}
.co-card{background:var(--sf);border:1px solid var(--bd);border-radius:var(--r4);padding:30px}
.co-sec{font-size:1.05rem;font-weight:700;margin-bottom:18px;padding-bottom:14px;border-bottom:1px solid var(--bd);display:flex;align-items:center;gap:10px}
.co-num{width:27px;height:27px;border-radius:50%;background:var(--p);color:#fff;font-size:.78rem;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.pay-note{background:var(--p-tint);border:1px solid var(--bd2);border-radius:var(--r3);padding:14px 16px;display:flex;gap:11px;margin-top:18px}
.pay-note svg{flex-shrink:0;color:var(--p);margin-top:2px}
.pay-note p{font-size:.875rem;margin:0}

/* 23 · CONFIRMATION ----------------------------------------- */
.conf{max-width:660px;margin:56px auto;text-align:center;padding:0 20px}
.conf-ico{width:76px;height:76px;border-radius:50%;background:var(--ok-bg);border:2px solid rgba(16,185,129,.28);display:flex;align-items:center;justify-content:center;margin:0 auto 22px;color:var(--ok);animation:popIn var(--t3) var(--ease)}
.conf h1{font-size:2.1rem;margin-bottom:10px}
.conf-order{background:var(--sf);border:1px solid var(--bd);border-radius:var(--r4);padding:26px;text-align:left;margin:28px 0}
.conf-row{display:flex;justify-content:space-between;align-items:center;padding:9px 0;border-bottom:1px solid var(--bd);font-size:.9375rem}
.conf-row:last-child{border-bottom:none}

/* 24 · FOOTER ----------------------------------------------- */
.footer{background:var(--sf);border-top:1px solid var(--bd);padding:52px 0 26px;margin-top:auto}
.footer-grid{display:grid;grid-template-columns:1fr;gap:28px;margin-bottom:36px}
@media(min-width:640px){.footer-grid{grid-template-columns:2fr 1fr 1fr}}
.footer-logo{font-size:1.2rem;font-weight:800;color:var(--tx);margin-bottom:9px;display:block}
.footer-logo span{color:var(--p)}
.footer-grid>div>p{font-size:.9rem;margin-bottom:0}
.footer-links{margin-top:12px}
.footer-links a{display:block;color:var(--tx3);font-size:.9rem;padding:3px 0;transition:color var(--t1)}
.footer-links a:hover{color:var(--p)}
.footer-col h5{font-size:.9375rem;font-weight:700;margin-bottom:12px}
.footer-bottom{display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:8px;padding-top:22px;border-top:1px solid var(--bd)}
.footer-bottom p{font-size:.84rem}

/* 25 · FILTER BAR ------------------------------------------- */
.filter-bar{display:flex;flex-wrap:wrap;align-items:center;gap:9px;margin-bottom:28px;padding:14px 18px;background:var(--sf);border:1px solid var(--bd);border-radius:var(--r4)}
.filter-lbl{font-size:.76rem;font-weight:700;color:var(--tx3);text-transform:uppercase;letter-spacing:.07em;flex-shrink:0;margin-right:4px}
.chip{
  padding:6px 14px;border-radius:var(--rf);font-size:.875rem;font-weight:600;
  border:1.5px solid var(--bd);background:var(--sf2);color:var(--tx2);
  cursor:pointer;transition:background var(--t1),border-color var(--t1),color var(--t1);
  white-space:nowrap;
}
.chip:hover,.chip.on{background:var(--p);border-color:var(--p);color:#fff}

/* 26 · AUTH -------------------------------------------------- */
.auth-wrap{
  min-height:calc(100vh - var(--nav-h));display:flex;align-items:center;justify-content:center;
  padding:40px 20px;background:var(--bg);position:relative;overflow:hidden;
}
.auth-wrap::before{
  content:'';position:absolute;inset:0;pointer-events:none;
  background:radial-gradient(ellipse 60% 60% at 50% 0%,rgba(95,92,245,.09) 0%,transparent 60%);
}
.auth-card{width:100%;max-width:428px;background:var(--sf);border:1px solid var(--bd);border-radius:var(--r5);padding:40px;box-shadow:var(--s4);position:relative;z-index:1}
.auth-logo{text-align:center;margin-bottom:26px}
.auth-logo a{font-size:1.45rem;font-weight:900;color:var(--tx)}
.auth-logo a span{color:var(--p)}
.auth-ttl{text-align:center;margin-bottom:26px}
.auth-ttl h2{font-size:1.45rem;margin-bottom:5px}
.auth-foot{text-align:center;margin-top:18px;font-size:.9375rem;color:var(--tx3)}
.auth-foot a{color:var(--p);font-weight:600}
.auth-foot a:hover{text-decoration:underline}

/* 27 · EMPTY STATE ------------------------------------------ */
.empty{text-align:center;padding:70px 20px}
.empty svg{margin:0 auto 18px;color:var(--tx3)}
.empty h3{margin-bottom:10px}
.empty p{margin-bottom:22px;max-width:380px;margin-left:auto;margin-right:auto}

/* 28 · ANIMATIONS ------------------------------------------- */
@keyframes fadeDown{from{opacity:0;transform:translateY(-8px)}to{opacity:1;transform:translateY(0)}}
@keyframes slideR{from{opacity:0;transform:translateX(18px)}to{opacity:1;transform:translateX(0)}}
@keyframes popIn{from{opacity:0;transform:scale(.7)}to{opacity:1;transform:scale(1)}}
@keyframes pulse{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.5;transform:scale(1.4)}}
@keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-10px)}}

/* 29 · UTILS ------------------------------------------------- */
.d-flex{display:flex}.flex-center{display:flex;align-items:center;justify-content:center}
.flex-bet{display:flex;align-items:center;justify-content:space-between}
.flex-wrap{flex-wrap:wrap}
.gap-1{gap:6px}.gap-2{gap:10px}.gap-3{gap:16px}.gap-4{gap:24px}
.mt-1{margin-top:6px}.mt-2{margin-top:12px}.mt-3{margin-top:18px}.mt-4{margin-top:28px}
.mb-1{margin-bottom:6px}.mb-2{margin-bottom:12px}.mb-3{margin-bottom:18px}.mb-4{margin-bottom:28px}
.w-full{width:100%}.text-center{text-align:center}.text-right{text-align:right}
.sr-only{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);border:0}
.divider{border:none;border-top:1px solid var(--bd);margin:20px 0}

/* 30 · SCROLLBAR -------------------------------------------- */
::-webkit-scrollbar{width:5px;height:5px}
::-webkit-scrollbar-track{background:transparent}
::-webkit-scrollbar-thumb{background:var(--bd);border-radius:var(--rf)}
::-webkit-scrollbar-thumb:hover{background:var(--tx3)}

@media(prefers-reduced-motion:reduce){*,*::before,*::after{animation-duration:.001ms!important;transition-duration:.001ms!important}}
</style>
@yield('styles')
</head>
<body>

{{-- NAV --}}
<nav class="nav">
  <div class="container">
    <div class="nav-inner">

      {{-- Logo --}}
      <a href="{{ route('home') }}" class="nav-logo">
        <svg width="28" height="28" viewBox="0 0 28 28" fill="none" aria-hidden="true">
          <rect width="28" height="28" rx="8" fill="var(--p)"/>
          <path d="M8 14h12M14 8l6 6-6 6" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Tech<span>Shop</span>
      </a>

      {{-- Desktop links --}}
      <div class="nav-links">
        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
        <a href="{{ route('products') }}" class="nav-link {{ request()->routeIs('products*') ? 'active' : '' }}">Products</a>
        <a href="{{ route('categories') }}" class="nav-link {{ request()->routeIs('categories') ? 'active' : '' }}">Categories</a>
      </div>

      {{-- Right actions --}}
      <div class="nav-right">

        {{-- Theme toggle --}}
        <button class="btn-i" onclick="toggleTheme()" id="themeBtn" aria-label="Toggle dark mode">
          <svg id="iconSun" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
          <svg id="iconMoon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
        </button>

        {{-- Cart --}}
        @php $cartCount = collect(session()->get('cart',[]))->sum('quantity') @endphp
        <a href="{{ route('cart.index') }}" class="cart-btn" aria-label="Cart">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
          @if($cartCount > 0)<span class="c-badge">{{ $cartCount }}</span>@endif
        </a>

        {{-- Auth --}}
        @auth
          <div class="drop hide-mobile">
            <button class="btn btn-o btn-sm drop-trg" aria-label="Account menu">
              {{ Str::limit(auth()->user()->name, 12) }}
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
            </button>
            <div class="drop-menu">
              <a href="{{ route('orders.index') }}" class="drop-item">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                My Orders
              </a>
              @if(auth()->user()->is_admin)
                <a href="{{ route('admin.home') }}" class="drop-item">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                  Admin Panel
                </a>
              @endif
              <a href="{{ route('profile.edit') }}" class="drop-item">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                Profile
              </a>
              <hr class="drop-sep">
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="drop-item" style="color:var(--err)">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                  Logout
                </button>
              </form>
            </div>
          </div>
        @else
          <a href="{{ route('login') }}" class="btn btn-o btn-sm hide-mobile">Login</a>
          <a href="{{ route('register') }}" class="btn btn-p btn-sm hide-mobile">Sign Up</a>
        @endauth

        {{-- Mobile hamburger --}}
        <button class="ham" id="hamBtn" aria-label="Open menu">
          <span></span><span></span><span></span>
        </button>
      </div>
    </div>
  </div>
</nav>

{{-- MOBILE MENU --}}
<div class="mob-menu" id="mobMenu">
  <a href="{{ route('home') }}" class="mob-link">Home</a>
  <a href="{{ route('products') }}" class="mob-link">Products</a>
  <a href="{{ route('categories') }}" class="mob-link">Categories</a>
  <a href="{{ route('cart.index') }}" class="mob-link">Cart @if($cartCount > 0)({{ $cartCount }})@endif</a>
  <hr class="mob-sep">
  @auth
    <a href="{{ route('orders.index') }}" class="mob-link">My Orders</a>
    <a href="{{ route('profile.edit') }}" class="mob-link">Profile</a>
    @if(auth()->user()->is_admin)
      <a href="{{ route('admin.home') }}" class="mob-link">Admin Panel</a>
    @endif
    <form method="POST" action="{{ route('logout') }}" style="margin-top:8px">
      @csrf
      <button type="submit" class="btn btn-d btn-fw">Logout</button>
    </form>
  @else
    <a href="{{ route('login') }}" class="btn btn-o btn-fw mb-2">Login</a>
    <a href="{{ route('register') }}" class="btn btn-p btn-fw">Sign Up</a>
  @endauth
</div>

{{-- ALERTS --}}
<div class="alerts">
  @if(session('success'))
    <div class="alert alert-ok" onclick="this.remove()">
      <svg class="alert-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
      <span>{{ session('success') }}</span>
      <button class="alert-x" onclick="this.parentElement.remove()" aria-label="Dismiss">&times;</button>
    </div>
  @endif
  @if(session('error'))
    <div class="alert alert-err" onclick="this.remove()">
      <svg class="alert-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
      <span>{{ session('error') }}</span>
      <button class="alert-x" onclick="this.parentElement.remove()" aria-label="Dismiss">&times;</button>
    </div>
  @endif
</div>

{{-- CONTENT --}}
<main>@yield('content')</main>

{{-- FOOTER --}}
<footer class="footer">
  <div class="container">
    <div class="footer-grid">
      <div>
        <a href="{{ route('home') }}" class="footer-logo">Tech<span>Shop</span></a>
        <p>Your premium destination for the latest electronics, gadgets, and tech accessories.</p>
        <div class="footer-links">
          <a href="{{ route('products') }}">Browse All Products</a>
          <a href="{{ route('categories') }}">Shop by Category</a>
        </div>
      </div>
      <div class="footer-col">
        <h5>Shop</h5>
        <div class="footer-links">
          <a href="{{ route('products', ['category' => '']) }}">All Products</a>
          <a href="{{ route('categories') }}">Categories</a>
          <a href="{{ route('cart.index') }}">My Cart</a>
        </div>
      </div>
      <div class="footer-col">
        <h5>Account</h5>
        <div class="footer-links">
          @auth
            <a href="{{ route('orders.index') }}">My Orders</a>
            <a href="{{ route('profile.edit') }}">Profile</a>
          @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Create Account</a>
          @endauth
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; {{ date('Y') }} TechShop. All rights reserved.</p>
      <p style="color:var(--tx3)">Premium Electronics Store</p>
    </div>
  </div>
</footer>

<style>
.hide-mobile{display:none!important}
@media(min-width:768px){.hide-mobile{display:inline-flex!important}}
</style>

<script>
/* ── Theme ── */
var html=document.documentElement;
function syncIcons(){
  var d=html.getAttribute('data-theme')==='dark';
  document.getElementById('iconSun').style.display=d?'block':'none';
  document.getElementById('iconMoon').style.display=d?'none':'block';
}
syncIcons();
function toggleTheme(){
  var n=html.getAttribute('data-theme')==='dark'?'light':'dark';
  html.setAttribute('data-theme',n);
  localStorage.setItem('ts-theme',n);
  syncIcons();
}

/* ── Dropdown ── */
document.querySelectorAll('.drop').forEach(function(d){
  var btn=d.querySelector('.drop-trg');
  if(btn) btn.addEventListener('click',function(e){e.stopPropagation();d.classList.toggle('open')});
});
document.addEventListener('click',function(){document.querySelectorAll('.drop.open').forEach(function(d){d.classList.remove('open')})});

/* ── Mobile menu ── */
var ham=document.getElementById('hamBtn'),mob=document.getElementById('mobMenu');
ham.addEventListener('click',function(){
  mob.classList.toggle('open');
  ham.setAttribute('aria-expanded',mob.classList.contains('open'));
});

/* ── Auto-dismiss alerts ── */
setTimeout(function(){
  document.querySelectorAll('.alert').forEach(function(a){
    a.style.transition='opacity .45s';a.style.opacity='0';
    setTimeout(function(){a.remove()},460);
  });
},4200);
</script>
@yield('scripts')
</body>
</html>
