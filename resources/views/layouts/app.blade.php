<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sinemaku Pictures')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <style>
        /* ========= Base ========= */
        * { box-sizing: border-box; }
        html, body {
            margin: 0; padding: 0; width: 100%;
            min-height: 100vh; overflow-x: hidden;
        }

        :root{
            --space-xs: 8px;
            --space-sm: 12px;
            --space-md: 20px;
            --space-lg: 32px;
            --space-xl: 48px;
            --space-2xl: 72px;
            --maxw: 1280px;

            /* breakpoints */
            --bp-lg: 1200px;
            --bp-md: 992px;
            --bp-sm: 768px;
            --bp-xs: 560px;
        }

        .homepage{
            min-width: 100vw;
            min-height: 100vh;
            margin: 0; padding: 0; position: relative;
            overflow-x: hidden;
        }

        /* ========= HERO ========= */
        .hero-slider{
        position: relative;
        min-height: 100vh;     /* your existing hero height */
        overflow: hidden;
        }

        /* 2) each slide is stacked, only the active is visible */
        .hero-slider .hero-section{
        position: absolute;
        inset: 0;
        opacity: 0;
        pointer-events: none;
        transition: opacity .6s ease;
        }
        .hero-slider .hero-section.is-active{
        opacity: 1;
        pointer-events: auto;
        }
        /* ==== Hero meta row (centered bottom) ==== */
.hero-meta{
  position: absolute;
  left: 50%;
  bottom: clamp(20px, 10vh, 120px);  /* jarak dari bawah responsif */
  transform: translateX(-50%);
  z-index: 3;

  display: inline-flex;
  align-items: center;
  gap: clamp(10px, 2.4vw, 28px);
  padding: 10px 16px;

  color: #f5f5f5;
  font-family: 'Inter', sans-serif;
  font-weight: 300;
  font-size: clamp(13px, 1.8vw, 20px);

}

.hero-meta .meta-dot{
  font-size: clamp(16px, 3vw, 28px);
  line-height: 1;
  margin: 0 2px;
}

.hero-meta .meta-year,
.hero-meta .meta-cast{
  white-space: nowrap; /* cegah patah di tengah frasa */
}

/* 01–04 tetap di kiri bawah */
._01-04{
  position: absolute;
  left: clamp(16px, 4vw, 40px);
  bottom: clamp(16px, 5vh, 80px);
  color: #f5f5f5;
  font-family: 'Inter', sans-serif;
  font-weight: 400;
  font-size: clamp(12px, 1.8vw, 20px);
  z-index: 3;
}

/* Jika kamu belum menghapus elemen lama, ini menyembunyikannya: */
._2023, .div, .starring-prilly-latuconsina{ display: none !important; }

        .hero-bg,
        .temp-imagehc-vht-6-1{
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        /* hapus ukuran fix & offset kiri */
        .temp-imagehc-vht-6-1{
            left: 0; top: 0; right: 0; bottom: 0;
            aspect-ratio: auto;
        }

        .hero-gradient{
            position: absolute;
            inset: 0;
            width: 100%; height: 100%;
            pointer-events: none;
            background: linear-gradient(to top, rgba(0,0,0,0.90) 0%, rgba(0,0,0,0.10) 65%);
            z-index: 1;
        }

        .rectangle-5{
            position: absolute;
            inset: 0;
            width: 100%; height: 100%;
            background: rgba(40,39,39,0.5);
        }

        .hero-content{
            position: absolute; inset: 0;
            z-index: 2;
            display: flex; flex-direction: column;
            justify-content: center; align-items: center;
            color: #fff; padding: var(--space-lg);
            text-align: center;
        }

        /* Header overlay (hamburger, title, search) */
        .menu-hamburger-md,
        .interface-search-magnifying-glass{
            position: absolute; top: clamp(16px, 3.5vw, 49px);
            width: clamp(28px, 4.5vw, 41px);
            height: clamp(28px, 4.5vw, 41px);
            overflow: visible; aspect-ratio: 1;
            z-index: 3;
        }
        .menu-hamburger-md{ left: clamp(16px, 3.5vw, 41px); }
        .interface-search-magnifying-glass{
            right: clamp(16px, 3.5vw, 41px);
            left: auto;
        }

        .sinemaku-pictures{
            position: absolute;
            top: clamp(18px, 4.5vw, 54px);
            left: 50%;
            transform: translateX(-50%);
            color: #f5f5f5;
            font-family: "Inter-ExtraBold", sans-serif;
            font-weight: 800;
            font-size: clamp(16px, 2.3vw, 24px);
            white-space: nowrap;
        }

        .bolehkah-sekali-saja-ku-menangis{
            position: absolute;
            left: 50%; transform: translateX(-50%);
            top: clamp(140px, 28vh, 293px);
            color: #f5f5f5;
            font-family: 'DM Serif Display', serif;
            font-weight: 400;
            letter-spacing: -0.02em; line-height: 0.95;
            /* 42px di mobile, 96px di desktop */
            font-size: clamp(42px, 9vw, 96px);
            text-align: center;
            padding: 0 var(--space-md);
            max-width: min(1200px, 92vw);
        }

        /* Elemen teks kecil di bawah judul */
        ._2023, ._01-04, .div, .starring-prilly-latuconsina{
            position: absolute;
            color: #f5f5f5;
            font-family: 'Inter', sans-serif;
            line-height: 1.5; letter-spacing: 0.01em;
        }
        ._2023{
            top: auto; bottom: clamp(88px, 12vh, 150px);
            left: 50%; transform: translateX(-140%);
            font-weight: 300;
            font-size: clamp(14px, 2.3vw, 24px);
        }
        .div{
            top: auto; bottom: clamp(120px, 15vh, 180px);
            left: 50%; transform: translateX(-50%);
            font-weight: 300;
            font-size: clamp(28px, 8vw, 64px);
        }
        .starring-prilly-latuconsina{
            top: auto; bottom: clamp(88px, 12vh, 150px);
            left: 50%; transform: translateX(20%);
            font-weight: 300;
            font-size: clamp(14px, 2.3vw, 24px);
            text-align: left;
        }
        ._01-04{
            top: auto; bottom: clamp(40px, 7vh, 80px);
            left: 6vw;
            font-weight: 400;
            font-size: clamp(13px, 2vw, 20px);
        }

        /* ========= Coming Soon ========= */
        .section-coming-soon{ margin: 40px 0 0 0; padding: 100px var(--space-lg); }
        .coming-soon-header{
            display:flex; align-items:center; justify-content:space-between;
            margin-bottom: 32px; gap: var(--space-md);
        }
        .coming-soon-title{
            font-family:'Inter', Arial, sans-serif;
            font-weight:800; letter-spacing:1px; margin:0;
            font-size: clamp(24px, 5vw, 50px);
            color:#232323;
        }
        .coming-soon-controls{ display:flex; gap: 12px; }
        .slider-btn{
            width: clamp(48px, 8vw, 80px);
            height: clamp(48px, 8vw, 80px);
            border: 2px solid #eee; background:#fff; border-radius:6px;
            font-size: clamp(18px, 5vw, 2.2rem);
            color:#332626; display:flex; align-items:center; justify-content:center;
            cursor:pointer; transition:border .2s, color .2s;
        }
        .slider-btn:hover{ border-color:#888; color:#111; }

        .coming-soon-slider{
            display:flex; gap:10px; flex-wrap:wrap;
        }
        .coming-soon-slide{
            flex: 1 1 28%; max-width: 32%; min-width: 300px;
            background:none; border-radius:20px; overflow:hidden;
            display:flex; flex-direction:column;
        }
        .coming-soon-image-wrapper{
            position: relative; border-radius:20px; overflow:hidden; aspect-ratio: 13/7;
        }
        .coming-soon-image{ width:100%; height:100%; object-fit: contain; display:block; }
        .coming-soon-date{
            position:absolute; left:20px; top:20px;
            font-family:'Inter', Arial, sans-serif;
            color:#fff; font-size:12px; font-weight:400; letter-spacing:.5px;
            background: rgba(0,0,0,0.15);
            padding: 2px 16px 2px 0; border-radius: 12px;
            text-shadow: 0 2px 8px rgba(0,0,0,0.3);
        }
        .coming-soon-caption{
            font-family:'Inter', Arial, sans-serif; font-size:16px; font-weight:400;
            color:#232323; margin-top:5px; text-align:left; padding: 0 10px 18px;
        }

        /* stack penuh pada layar kecil */
        @media (max-width: 992px){
            .section-coming-soon{ padding: 64px var(--space-md); }
            .coming-soon-slide{ flex: 1 1 48%; max-width: 48%; min-width: 260px; }
        }
        @media (max-width: 560px){
            .coming-soon-header{ flex-direction: column; align-items: flex-start; }
            .coming-soon-slide{ flex: 1 1 100%; max-width: 100%; min-width: 0; }
        }

        /* ========= Section Shop (feature) ========= */
        .feature-sidetext{ padding: 40px 56px 72px; }
        .feature-wrap{
            display:grid; grid-template-columns: 1fr 1.15fr;
            align-items:start; gap:48px; max-width:1600px; margin:0 auto;
        }
        .feature-eyebrow{
            font: 300 16px/1.2 'Inter', Arial, sans-serif; color:#9aa0a6;
            letter-spacing:.06em; text-transform:uppercase; margin-bottom:20px;
        }
        .feature-title{
            margin:0 0 36px; font-family:'Inter', Arial, sans-serif; font-weight:300; line-height:.95; color:#0d0d0d;
            font-size: clamp(40px, 6vw, 112px); letter-spacing:-0.5px;
        }
        .feature-cta{ display:inline-flex; align-items:center; gap:16px; color:#111; margin-top:36px; text-decoration:none; transition:color .2s; }
        .feature-cta .cta-line{ width:88px; height:2px; background: currentColor; position:relative; transition: width .25s cubic-bezier(.55,0,.25,1); }
        .feature-cta .cta-line::after{ content:""; position:absolute; right:-12px; top:50%; width:12px; height:12px; border-right:2px solid currentColor; border-top:2px solid currentColor; transform: translateY(-50%) rotate(45deg); }
        .feature-cta .cta-label{ font:300 20px/1.2 'Inter', Arial, sans-serif; letter-spacing:.02em; }
        .feature-cta:hover{ color:#000; }
        .feature-cta:hover .cta-line{ width:110px; }

        .feature-media{ position:relative; display:block; text-decoration:none; color:inherit; cursor:pointer; }
        .feature-media::before{
            content:""; position:absolute; inset:0; background:#ececec; border-radius:10px;
            transform: translate(12px,12px); z-index:0; transition: transform .45s cubic-bezier(.22,.61,.36,1);
        }
        .feature-media-frame{
            position:relative; background:#f1f1f1; border-radius:8px;
            box-shadow: 0 0 0 10px #fff inset, 0 1px 0 0 #e5e5e5 inset;
            padding:10px; z-index:1;
            transition: transform .45s cubic-bezier(.22,.61,.36,1), box-shadow .45s cubic-bezier(.22,.61,.36,1);
        }
        .feature-media-frame::before{ content:""; display:block; aspect-ratio: 16/9; }
        .feature-media-frame > img{
            position:absolute; inset:10px; width: calc(100% - 20px); height: calc(100% - 20px);
            object-fit: cover; border-radius:4px; transition: transform .55s cubic-bezier(.22,.61,.36,1); will-change: transform;
        }
        .feature-media:hover .feature-media-frame{ transform: translateY(-6px); box-shadow: 0 16px 40px rgba(0,0,0,.16), 0 6px 16px rgba(0,0,0,.08); }
        .feature-media:hover .feature-media-frame > img{ transform: scale(1.035); }
        .feature-media:hover::before{ transform: translate(16px,16px); }

        @media (max-width: 1200px){
            .feature-wrap{ grid-template-columns: 1fr; gap: 32px; }
            .feature-title{ margin-bottom: 24px; }
        }
        @media (max-width: 640px){
            .feature-sidetext{ padding: 28px 20px 52px; }
            .feature-cta .cta-label{ font-size: 18px; }
            .feature-cta .cta-line{ width: 64px; }
        }

        /* ========= Articles ========= */
        .articles-section{ padding: 60px 80px; }
        .articles-header{ display:flex; justify-content:space-between; align-items:center; gap: var(--space-md); margin-bottom: 32px; }
        .articles-header h2{
            font-size: clamp(22px, 4.2vw, 42px);
            font-family: 'Libre Baskerville', serif; font-weight: 600;
            margin: 0;
        }
        .view-all{ text-decoration:none; color:#111; font-weight:500; transition: .2s; }
        .view-all:hover{ transform: translateX(4px); }

        
        .article-featured{ position:relative; overflow:hidden; border-radius:10px; }
        .article-featured img{ width:100%; border-radius:10px; display:block; transition: transform .35s ease; }
        .article-featured:hover img{ transform: scale(1.03); }
        .article-featured::after{
            content:""; position:absolute; inset:0;
            background: linear-gradient(to top, rgba(21,21,21,0.94) 20%, rgba(0,0,0,0) 70%);
            z-index:1;
        }
        .article-featured-text{
            position:absolute; bottom:20px; left:20px; right:20px;
            color:#fff; z-index:2; font: 300 15px/1.2 'Inter', Arial, sans-serif;
        }
        .article-featured-text h3{ font: 700 28px/1.2 'Inter', Arial, sans-serif; margin: 0 0 6px; }

        .article-list{ display:flex; flex-direction:column; gap:20px; }
        
        .article-item img{ width:70px; height:70px; border-radius:6px; object-fit:cover; }
        .article-item h4{ font-size:16px; font-weight:600; margin:0; text-decoration: none;}
        .article-item h4 a {text-decoration: none;}
        .article-item .date{ font-size:13px; color:#666; }

        @media (max-width: 992px){
            .articles-section{ padding: 40px 24px; }
            .articles-grid{ grid-template-columns: 1fr; }
        }

        /* ========= Spotlight ========= */
        .spotlight{ padding: 24px 0; }
        .spotlight__frame{ position:relative; overflow:hidden; }
        .spotlight__image{
            width:100%; height: clamp(320px, 55vw, 700px);
            object-fit:cover; display:block; transform: scale(1);
            transition: transform .9s cubic-bezier(.2,.6,.2,1);
        }
        .spotlight__overlay{
            content:""; position:absolute; inset:0;
            background: linear-gradient(to top, rgba(0,0,0,0.75) 12%, rgba(0,0,0,0.45) 28%, rgba(0,0,0,0.08) 60%, rgba(0,0,0,0) 85%);
            pointer-events:none;
        }
        .spotlight__content{
            position:absolute;
            left: clamp(16px, 4vw, 48px);
            bottom: clamp(14px, 3.5vw, 46px);
            right: clamp(16px, 6vw, 72px);
            color:#fff; z-index:2;
        }
        .spotlight__eyebrow{
            display:inline-block; font: 300 12px/1.2 'Inter', system-ui, -apple-system, Arial, sans-serif;
            text-transform:uppercase; opacity:.9; margin-bottom: 10px;
        }
        .spotlight__title{
            margin:0; font-family:"Inter", Arial, serif; font-weight:500; letter-spacing:-0.5px; line-height:.95;
            font-size: clamp(28px, 7.2vw, 88px);
            text-shadow: 0 2px 18px rgba(0,0,0,.35);
        }
        .spotlight__frame:hover .spotlight__image{ transform: scale(1.03); }

        /* ========= Careers ========= */
        .careers-section{ padding: 64px 0 90px; }
        .careers-wrap{ max-width: 1430px; margin: 0 auto; padding: 0 24px; }
        .careers-title{
            font-family:"Inter", Arial, sans-serif; font-weight:300; letter-spacing:-0.5px; line-height:.95; text-align:center; margin:0 0 10px; color:#0f1115;
            font-size: clamp(28px, 6vw, 64px);
        }
        .careers-subtitle{
            text-align:center; max-width:860px; margin:0 auto 40px;
            font-family:'Inter', system-ui, -apple-system, Arial, sans-serif; color:#5d6b7a; letter-spacing:-0.5px; line-height:1.25;
            font-size: clamp(14px, 1.8vw, 22px);
        }
        .careers-grid{ display:grid; gap:28px; grid-template-columns: repeat(3, 1fr); }
        @media (max-width: 1050px){ .careers-grid{ grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 680px){ .careers-grid{ grid-template-columns: 1fr; } }

        .career-card{
            background:#fff; border-radius:10px; padding:26px 24px 22px;
            box-shadow: 0 10px 30px rgba(15,17,21,0.06), 0 1px 0 rgba(15,17,21,0.04);
            transition: transform .35s cubic-bezier(.22,.61,.36,1), box-shadow .35s cubic-bezier(.22,.61,.36,1);
        }
        .career-card:hover{ transform: translateY(-4px); box-shadow: 0 18px 50px rgba(15,17,21,0.10), 0 1px 0 rgba(15,17,21,0.04); }
        .career-role{ margin:0 0 8px; font: 500 22px/1.25 "Inter", system-ui, -apple-system, Arial, sans-serif; color:#0f1115; }
        .career-dept{ font: 500 14px/1.4 "Inter", system-ui, -apple-system, Arial, sans-serif; color:#6b7683; margin-bottom:14px; }
        .career-meta{ display:flex; align-items:center; gap:14px; margin-bottom:16px; }
        .career-loc{ display:inline-flex; align-items:center; gap:8px; color:#6b7683; font: 500 14px/1.4 "Inter", system-ui, -apple-system, Arial, sans-serif; }
        .loc-ic{ width:16px; height:16px; opacity:.9; }
        .career-apply{
            width:100%; height:48px; border-radius:4px; border:none; background:#0a0a0a; color:#fff;
            font: 700 15px/1 "Inter", system-ui, -apple-system, Arial, sans-serif; cursor:pointer;
            transition: transform .18s ease, background .18s ease, box-shadow .18s ease;
        }
        .career-apply:hover{ transform: translateY(-1px); background:#000; box-shadow:0 10px 18px rgba(0,0,0,.14); }
        .career-apply:active{ transform: translateY(0); box-shadow:none; }

        /* footer CTA posisi fleksibel */
        .careers-footer{ margin-top: clamp(40px, 10vw, 100px); display:flex; justify-content:center; }
        .careers-viewall{
            display:inline-flex; align-items:center; gap:10px; background:#000; color:#fff;
            padding: 16px 28px; font-weight:700; text-decoration:none; font-size:16px; border-radius:2px; transition: background .25s ease;
        }
        .careers-viewall:hover{ background:#333; }
        .careers-view{ margin:0 0 8px; font: 500 16px/1.25 "Inter", system-ui, -apple-system, Arial, sans-serif; color:#fff; }

        /* ========= Join Member ========= */
        .join-member{
            margin-top: -60px; background:#fff; color:#000; padding: clamp(64px, 10vw, 120px) 20px; text-align:center;
        }
        .join-member-inner{ max-width: 800px; margin: 0 auto; }
        .join-member-title{
            font-family:'Inter', sans-serif; font-weight:500; margin-bottom: 16px; letter-spacing:-0.5px; line-height:1;
            font-size: clamp(28px, 7vw, 60px);
        }
        .join-member-desc{
            font-family:'Inter', sans-serif; font-size: clamp(14px, 2.2vw, 18px);
            color:#444; margin-bottom: 28px; line-height:1.5;
        }
        .join-member-btn{
            background:#000; color:#fff; font-weight:600; border:none; padding: 16px 28px; font-size:16px; border-radius:4px; cursor:pointer; transition:.3s;
        }
        .join-member-btn:hover{ background:#333; transform: translateY(-2px); }

        /* ========= Footer ========= */
        .site-footer{ background:#0A0B0C; color:#cfd8e3; padding:72px 24px 28px; }
        .site-footer a{ color:#e6eef8; text-decoration:none; }
        .site-footer a:hover{ color:#ffffff; }
        .footer-inner{
            max-width:1280px; margin:0 auto 28px;
            display:grid; grid-template-columns: 1.2fr 1fr 1fr; gap:54px;
        }
        .footer-brand .brand-head{ display:flex; align-items:center; gap:12px; }
        .brand-icon{ flex:0 0 auto; }
        .brand-name{
            font-family:'Inter', Arial, sans-serif; font-size:28px; font-weight:800; letter-spacing:-0.5px; line-height:.95; color:#fff;
        }
        .brand-tagline{ margin-top:18px; line-height:1.7; color:#98a7b8; max-width:620px; }

        .footer-title{ font-family:'Inter', Arial, sans-serif; font-weight:700; color:#fff; margin:2px 0 16px; }
        .nav-cols{ display:grid; grid-template-columns: 1fr 1fr; gap:32px; }
        .footer-links{ list-style:none; margin:0; padding:0; }
        .footer-links li{ margin:12px 0; }
        .footer-links a{ font-size:16px; color:#cfd8e3; transition: transform .2s, color .2s; display:inline-block; }
        .footer-links a:hover{ color:#fff; transform: translateX(4px); }

        .contact-item{ display:flex; align-items:center; gap:10px; margin:12px 0; }
        .ci{ opacity:.85; }
        .follow-title{ margin-top:18px; font-weight:600; color:#fff; }
        .socials{ display:flex; gap:14px; margin-top:10px; }
        .social-btn{
            width:44px; height:44px; display:grid; place-items:center;
            background:#18202b; border-radius:6px; border:1px solid rgba(255,255,255,.06);
            transition: transform .18s, background .18s, box-shadow .18s;
        }
        .social-btn:hover{ background:#222c3a; transform: translateY(-2px); box-shadow:0 6px 20px rgba(0,0,0,.35); }

        .footer-divider{
            max-width:1280px; margin:18px auto 22px;
            height:1px; background: linear-gradient(90deg, rgba(255,255,255,.06), rgba(255,255,255,.08), rgba(255,255,255,.06));
        }
        .footer-bottom{
            max-width:1280px; margin:0 auto;
            display:grid; grid-template-columns: 1.2fr auto auto; align-items:center; gap:18px;
            font-size:14px; color:#9fb0c2;
        }
        .legal{ list-style:none; display:flex; gap:22px; margin:0; padding:0; flex-wrap: wrap; }
        .legal a{ color:#b9c7d6; } .legal a:hover{ color:#fff; }
        .copy,.est{ white-space:nowrap; }

        @media (max-width: 1024px){
            .footer-inner{ grid-template-columns: 1fr 1fr; }
            .footer-brand{ grid-column: 1 / -1; }
        }
        @media (max-width: 720px){
            .footer-inner{ grid-template-columns: 1fr; gap:36px; }
            .footer-bottom{ grid-template-columns: 1fr; gap:10px; text-align:center; }
            .legal{ justify-content:center; }
            .copy,.est{ justify-self:center; white-space: normal; }
        }

        /* ====== Articles – sidebar list like the reference ====== */

/* bungkus list jadi satu kartu besar membulat */
.article-list{
  background: #ffffff;
  border-radius: 18px;
  padding: 16px;
  box-shadow: 0 8px 28px rgba(0,0,0,.08);
  gap: 14px;                                 /* rapat tapi rapi */
}

/* setiap item: rata kiri, tanpa bayangan item (mengandalkan bayangan kartu besar) */


/* thumbnail kecil, membulat, sesuai referensi */
.article-item img{
  width: 64px; height: 64px;
  border-radius: 14px;
  object-fit: cover;
  flex: 0 0 64px;
}

/* tipografi judul & jarak */
.article-item h4{
  margin: 0 0 6px;
  font-size: 18px;
  line-height: 1.3;
  font-weight: 700;
  color: #1f2937; /* abu gelap */
}

/* “2 days ago” ditampilkan sebagai pill */
.article-item .date{
  display: inline-block;
  font-size: 12px;
  font-weight: 600;
  color: #64748b;
  background: #eef2f7;
  padding: 6px 10px;
  border-radius: 999px;
}

/* sudut besar untuk featured card agar konsisten */
.article-featured,
.article-featured img{ border-radius: 18px; }

a {
    text-decoration: none;
    color: inherit; /* Opsional: Ini mencegah warna biru default pada link, agar teks tetap sesuai warna asli */
}
/* pastikan grid hanya 2 kolom yang fleksibel */
.articles-grid{
  display:grid;
  grid-template-columns: minmax(0, 1.7fr) minmax(0, 1fr);
  gap:40px;
  align-items:start;
}

/* link membungkus isi item, bukan kontainer list */
.article-item-link{
  display:flex; gap:16px; align-items:center;
  text-decoration:none; color:inherit;
  width:100%;
}

/* cegah bayangan ganda karena list sudah punya shadow */
.article-item{ background:transparent; box-shadow:none; padding:10px 8px; border-radius:12px; }
.article-item:hover{ background:#f8fafc; transform:translateY(-2px); }

/* responsif */
@media (max-width: 992px){
  .articles-grid{ grid-template-columns:1fr; }
}

    </style>
</head>
<body>
    @yield('content')
    <!-- Tambah asset JS jika ada -->
</body>

<!-- ======================= FOOTER ======================= -->
<footer class="site-footer">
    <div class="footer-inner">
        <!-- Brand / About -->
        <div class="footer-brand">
            <div class="brand-head">
                <!-- Film icon -->
                <svg class="brand-icon" width="28" height="28" viewBox="0 0 24 24" fill="none">
                    <rect x="3" y="4" width="18" height="16" rx="2" stroke="white" stroke-width="2"/>
                    <rect x="6" y="7" width="3" height="3" rx="1" fill="white"/>
                    <rect x="6" y="14" width="3" height="3" rx="1" fill="white"/>
                    <rect x="15" y="7" width="3" height="3" rx="1" fill="white"/>
                    <rect x="15" y="14" width="3" height="3" rx="1" fill="white"/>
                </svg>
                <span class="brand-name">SINEMAKU PICTURES</span>
            </div>
            <p class="brand-tagline">
                Creating cinematic experiences that challenge conventions and inspire new perspectives.
                We are storytellers, dreamers, and rebels with cameras.
            </p>
        </div>

        <!-- Navigation -->
        <nav class="footer-nav">
            <h4 class="footer-title">Navigation</h4>
            <div class="nav-cols">
                <ul class="footer-links">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Series</a></li>
                    <li><a href="#">Articles</a></li>
                    <li><a href="#">Careers</a></li>
                </ul>
                <ul class="footer-links">
                    <li><a href="#">Films</a></li>
                    <li><a href="#">Shop</a></li>
                    <li><a href="#">Events</a></li>
                </ul>
            </div>
        </nav>

        <!-- Connect -->
        <div class="footer-connect">
            <h4 class="footer-title">Connect</h4>

            <div class="contact-item">
                <!-- mail -->
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" class="ci">
                    <path d="M4 6h16v12H4z" stroke="#cfd8e3" stroke-width="1.8" />
                    <path d="M4 6l8 6 8-6" stroke="#cfd8e3" stroke-width="1.8" fill="none"/>
                </svg>
                <a href="mailto:hello@sinemakupictures.com">hello@sinemakupictures.com</a>
            </div>

            <div class="contact-item">
                <!-- pin -->
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" class="ci">
                    <path d="M12 21s7-5.2 7-11a7 7 0 1 0-14 0c0 5.8 7 11 7 11z" stroke="#cfd8e3" stroke-width="1.8"/>
                    <circle cx="12" cy="10" r="2.4" fill="#cfd8e3"/>
                </svg>
                <span>Jakarta, Indonesia</span>
            </div>

            <div class="follow-title">Follow Us</div>
            <div class="socials">
                <a class="social-btn" href="#" aria-label="Instagram">
                    <!-- instagram -->
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                        <rect x="3" y="3" width="18" height="18" rx="5" stroke="#e6eef8" stroke-width="1.6"/>
                        <circle cx="12" cy="12" r="4" stroke="#e6eef8" stroke-width="1.6"/>
                        <circle cx="17.5" cy="6.5" r="1.2" fill="#e6eef8"/>
                    </svg>
                </a>
                <a class="social-btn" href="#" aria-label="YouTube">
                    <!-- youtube -->
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                        <rect x="2.5" y="6" width="19" height="12" rx="4" stroke="#e6eef8" stroke-width="1.6"/>
                        <path d="M10 9v6l5-3-5-3z" fill="#e6eef8"/>
                    </svg>
                </a>
                <a class="social-btn" href="#" aria-label="Twitter/X">
                    <!-- twitter/x (simple) -->
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                        <path d="M4 4l16 16M20 4L4 20" stroke="#e6eef8" stroke-width="1.6" stroke-linecap="round"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <div class="footer-divider"></div>

    <div class="footer-bottom">
        <div class="copy">© 2024 Sinemaku Pictures. All rights reserved.</div>
        <ul class="legal">
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms of Service</a></li>
            <li><a href="#">Cookies</a></li>
        </ul>
        <div class="est">EST. 2020&nbsp; • &nbsp;JAKARTA</div>
    </div>
</footer>
</html>
