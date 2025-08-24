<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sinemaku Pictures')</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
   <style>
        * {
            box-sizing: border-box;
        }
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            min-height: 100vh;
            overflow-x: hidden;
        }
        .homepage {
            min-width: 100vw;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            position: relative;
            overflow-x: hidden;
        }

        .hero-section {
        position: relative;
        width: 100vw;
        height: 100vh; /* atau height gambar hero kamu */
        overflow: hidden;
        }

        .hero-bg {
        width: 100vw;
        height: 100vh;
        object-fit: cover;
        display: block;
        }

        .hero-gradient {
        position: absolute;
        left: 0; right: 0; bottom: 0; top: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        /* Gradasi hitam ke transparan dari bawah */
        background: linear-gradient(to top, rgba(0,0,0,0.90) 0%, rgba(0,0,0,0.10) 65%);
        z-index: 1;
        }

        .hero-content {
        position: absolute;
        z-index: 2;
        top: 0; left: 0; right: 0; bottom: 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        /* Sesuaikan isi */
        color: #fff;
        }

        .temp-imagehc-vht-6-1 {
        width: 1751px;
        height: 900px;
        position: absolute;
        left: -119px;
        top: 0px;
        object-fit: cover;
        aspect-ratio: 1751/985;
        }
        .rectangle-5 {
        background: rgba(40, 39, 39, 0.5);
        width: 1512px;
        height: 900px;
        position: absolute;
        left: 0px;
        top: 0px;
        }
        .menu-hamburger-md {
        width: 41px;
        height: 41px;
        position: absolute;
        left: 41px;
        top: 49px;
        overflow: visible;
        aspect-ratio: 1;
        }
        .sinemaku-pictures {
        color: #f5f5f5;
        text-align: left;
        font-family: "Inter-ExtraBold", sans-serif;
        font-size: 24px;
        font-weight: 800;
        position: absolute;
        left: calc(50% - 124px);
        top: 54px;
        }
        ._2023 {
        color: #f5f5f5;
        text-align: left;
        font-family: 'Inter', sans-serif;
        font-size: 24px;
        font-weight: 300;
        position: absolute;
        left: calc(50% - 237px);
        top: 658px;
        line-height: 1.7;
        letter-spacing: 0.01em;
        }
        ._01-04 {
        color: #f5f5f5;
        text-align: left;
        font-family: "Inter-Regular", sans-serif;
        font-size: 20px;
        font-weight: 400;
        position: absolute;
        left: calc(50% - 694px);
        top: 760px;
        }
        .div {
        color: #f5f5f5;
        text-align: left;
        font-family: 'Inter', sans-serif;
        font-size: 64px;
        font-weight: 300;
        position: absolute;
        left: calc(50% - 131px);
        top: 605px;
        line-height: 1.7;
        letter-spacing: 0.01em;
        }
        .starring-prilly-latuconsina {
        color: #f5f5f5;
        text-align: left;
        font-family: 'Inter', sans-serif;
        font-size: 24px;
        font-weight: 300;
        position: absolute;
        left: calc(50% - 67px);
        top: 658px;
        line-height: 1.7;
        letter-spacing: 0.01em;
        }
        .interface-search-magnifying-glass {
        width: 39px;
        height: 39px;
        position: absolute;
        left: 1432px;
        top: 49px;
        overflow: visible;
        aspect-ratio: 1;
        }
        .bolehkah-sekali-saja-ku-menangis {
        color: #f5f5f5;
        text-align: center;
        font-family: 'DM Serif Display', serif;
        font-size: 96px;
        font-weight: 400;
        position: absolute;
        left: 50%;
        translate: -50%;
        top: 293px;
        letter-spacing: -0.02em;
        line-height: 0.9;
        }
        .section-coming-soon {
        margin: 40px 0 0 0;
        padding: 100 32px;
        }

        .coming-soon-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 32px;
        }

        .coming-soon-title {
        font-family: 'Inter', Arial, sans-serif;
        font-weight: 800;
        font-size: 50px;
        color: #232323;
        letter-spacing: 1px;
        margin: 0;
        }

        .coming-soon-controls {
        display: flex;
        gap: 12px;
        }

        .slider-btn {
        width: 80px;
        height: 80px;
        border: 2px solid #eee;
        background: #fff;
        border-radius: 6px;
        font-size: 2.2rem;
        color: #332626;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: border 0.2s, color 0.2s;
        }

        .slider-btn:hover {
        border-color: #888;
        color: #111;
        }

        .coming-soon-slider {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        }

        .coming-soon-slide {
        flex: 1 1 28%;
        max-width: 32%;
        min-width: 320px;
        background: none;
        border-radius: 20px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        }

        .coming-soon-image-wrapper {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        aspect-ratio: 13 / 7;
        }

        .coming-soon-image {
        width: 100%;
        height: 100%;
        object-fit: contain;
        display: block;
        }

        .coming-soon-date {
        position: absolute;
        left: 20px;
        top: 20px;
        font-family: 'Inter', Arial, sans-serif;
        color: #fff;
        font-size: 12px;
        font-weight: 400;
        letter-spacing: 0.5px;
        background: rgba(0,0,0,0.15);
        padding: 2px 16px 2px 0;
        border-radius: 12px;
        text-shadow: 0 2px 8px rgba(0,0,0,0.3);
        }

        .coming-soon-caption {
        font-family: 'Inter', Arial, sans-serif;
        font-size: 16px;
        font-weight: 400;
        color: #232323;
        margin-top: 5px;
        text-align: left;
        padding-left: 10px;
        padding-bottom: 18px;
        }

        /* ====== Section Shop ====== */
        /* ====== Layout container ====== */
        .feature-sidetext{
        padding: 40px 56px 72px;            /* kiri/kanan agak lega */
        }
        .feature-wrap{
        display: grid;
        grid-template-columns: 1fr 1.15fr;  /* teks : media */
        align-items: start;
        gap: 48px;
        max-width: 1600px;
        margin: 0 auto;
        }

        /* ====== Left column (text) ====== */
        .feature-eyebrow{
        font: 300 16px/1.2 'Inter', Arial, sans-serif;
        color: #9aa0a6;                     /* abu-abu halus */
        letter-spacing: .06em;
        text-transform: uppercase;
        margin-bottom: 20px;
        }
        .feature-title{
        margin: 0 0 36px;
        font-family: 'Inter', Arial, sans-serif;
        font-weight: 300;
        line-height: .95;
        color: #0d0d0d;
        /* ukuran fleksibel: kecil di mobile, besar di desktop */
        font-size: clamp(40px, 6vw, 112px);
        letter-spacing: -0.5px;
        }

        /* CTA "Listen now" dengan garis-panah */
        .feature-cta{
        display: inline-flex;
        align-items: center;
        gap: 16px;
        text-decoration: none;
        color: #111;
        margin-top: 36px;
        transition: color .2s ease;
        }
        .feature-cta .cta-line{
        width: 88px;
        height: 2px;
        background: currentColor;
        position: relative;
        transition: width .25s cubic-bezier(.55,0,.25,1);
        }
        .feature-cta .cta-line::after{
        content: "";
        position: absolute;
        right: -12px;
        top: 50%;
        width: 12px;
        height: 12px;
        border-right: 2px solid currentColor;
        border-top: 2px solid currentColor;
        transform: translateY(-50%) rotate(45deg);
        }
        .feature-cta .cta-label{
        font: 300 20px/1.2 'Inter', Arial, sans-serif;
        letter-spacing: .02em;
        }
        .feature-cta:hover{ color: #000; }
        .feature-cta:hover .cta-line{ width: 110px; }

        /* ====== Right column (media) ====== */
        .feature-media{
        display: block;
        text-decoration: none;
        color: inherit;
        }
        .feature-media-frame{
        position: relative;
        background: #f1f1f1;
        border-radius: 8px;
        /* bingkai tipis seperti mockup */
        box-shadow:
            0 0 0 10px #fff inset,      /* inner white mat */
            0 1px 0 0 #e5e5e5 inset;    /* garis tipis abu-abu */
        padding: 10px;                /* jarak ke gambar */
        }
        .feature-media-frame::before{
        /* memberi proporsi landscape stabil mirip screenshot */
        content:"";
        display:block;
        aspect-ratio: 16/9;
        }
        .feature-media-frame > img{
        position: absolute;
        inset: 10px;                  /* sejajar dengan padding container */
        width: calc(100% - 20px);
        height: calc(100% - 20px);
        object-fit: cover;            /* penuh, seperti contoh */
        border-radius: 4px;
        }

        /* === Tambahan untuk blok feature-media yang sudah ada === */

        /* jadikan wrapper bisa menaruh pseudo-element di belakang */
        .feature-media{
        position: relative;
        display: block;
        cursor: pointer;
        }

        /* “kertas” abu-abu di belakang frame gambar */
        .feature-media::before{
        content: "";
        position: absolute;
        inset: 0;                         /* selimuti area feature-media */
        background: #ececec;              /* abu-abu lembut */
        border-radius: 10px;              /* sedikit lebih besar dari frame di dalam */
        transform: translate(12px,12px);  /* terlihat offset ke kanan-bawah */
        z-index: 0;                       /* DI BELAKANG frame */
        transition: transform .45s cubic-bezier(.22,.61,.36,1);
        }

        /* pastikan frame di atas “kertas” abu-abu */
        .feature-media-frame{
        position: relative;
        z-index: 1;
        transition: transform .45s cubic-bezier(.22,.61,.36,1),
                    box-shadow .45s cubic-bezier(.22,.61,.36,1);
        /* box-shadow inset yg sudah kamu punya tetap jalan;
            ini menambah drop shadow lembut saat hover */
        }

        /* animasi gambar di dalam frame */
        .feature-media-frame > img{
        transition: transform .55s cubic-bezier(.22,.61,.36,1);
        will-change: transform;
        }

        /* efek saat hover: frame sedikit terangkat + gambar zoom ringan,
        “kertas” abu-abu ikut bergeser untuk memberi rasa depth */
        .feature-media:hover .feature-media-frame{
        transform: translateY(-6px);
        box-shadow: 0 16px 40px rgba(0,0,0,.16), 0 6px 16px rgba(0,0,0,.08);
        }

        .feature-media:hover .feature-media-frame > img{
        transform: scale(1.035);
        }

        .feature-media:hover::before{
        transform: translate(16px,16px); /* offset abu-abu sedikit bertambah */
        }


        /* ====== Responsive ====== */
        @media (max-width: 1200px){
        .feature-wrap{
            grid-template-columns: 1fr; /* stack */
            gap: 32px;
        }
        .feature-title{ margin-bottom: 24px; }
        .feature-media-frame::before{ aspect-ratio: 16/9; }
        }
        @media (max-width: 640px){
        .feature-sidetext{ padding: 28px 20px 52px; }
        .feature-cta .cta-label{ font-size: 18px; }
        .feature-cta .cta-line{ width: 64px; }
        }

        /* ====== END Section Shop ====== */

        /* ====== Section Article ====== */
        .articles-section {
        padding: 60px 80px;
        }

        .articles-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 32px;
        }

        .articles-header h2 {
        font-size: 42px;
        font-family: 'Libre Baskerville', serif;
        font-weight: 100px;
        }

        .view-all {
        text-decoration: none;
        color: #111;
        font-weight: 500;
        transition: all 0.2s;
        }
        .view-all:hover { transform: translateX(4px); }

        .articles-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 40px;
        }

        .article-featured {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        }
        .article-featured img {
        width: 100%;
        border-radius: 10px;
        display: block;
        transition: transform .35s ease;
        }
        .article-featured:hover img { transform: scale(1.03); }

        .article-featured::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(21, 21, 21, 0.938) 20%, rgba(0,0,0,0) 70%);
        z-index: 1;
        }

        /* Supaya teks di atas gradient */
        .article-featured-text {
        font: 300 15px/1.2 'Inter', Arial, sans-serif;
        position: absolute;
        bottom: 20px;
        left: 20px;
        right: 20px;
        color: #fff;
        z-index: 2;
        }
        .article-featured-text h3 {
        font: 300 20px/1.2 'Inter', Arial, sans-serif;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 6px;
        }

        .article-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
        }

        .article-item {
        display: flex;
        gap: 16px;
        padding: 12px;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 3px 16px rgba(0,0,0,0.08);
        cursor: pointer;
        transition: transform .25s ease, box-shadow .25s ease;
        }
        .article-item:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }

        .article-item img {
        width: 70px;
        height: 70px;
        border-radius: 6px;
        object-fit: cover;
        }

        .article-item h4 {
        font-size: 16px;
        font-weight: 600;
        margin: 0;
        }
        .article-item .date {
        font-size: 13px;
        color: #666;
        }

        /* ====== END Section Article ====== */

        /* ====== Section Spotlight ====== */
        .spotlight {
        padding: 24px 0;
        }

        /* Kartu besar yang membungkus gambar */
        .spotlight__frame {
        position: relative;
        overflow: hidden;
        }

        /* Gambar hero */
        .spotlight__image {
        width: 100%;
        height: clamp(380px, 55vw, 700px);
        object-fit: cover;
        display: block;
        transform: scale(1);                 /* buat hover subtle */
        transition: transform .9s cubic-bezier(.2,.6,.2,1);
        }

        /* Gradient gelap dari bawah ke atas agar teks jelas */
        .spotlight__overlay {
        content: "";
        position: absolute;
        inset: 0;
        background:
            linear-gradient(
            to top,
            rgba(0,0,0,0.75) 12%,
            rgba(0,0,0,0.45) 28%,
            rgba(0,0,0,0.08) 60%,
            rgba(0,0,0,0) 85%
            );
        pointer-events: none;
        }

        /* Teks kiri-bawah */
        .spotlight__content {
        position: absolute;
        left: clamp(20px, 4vw, 48px);
        bottom: clamp(18px, 3.5vw, 46px);
        right: clamp(20px, 6vw, 72px);
        color: #fff;
        z-index: 2;
        }

        .spotlight__eyebrow {
        display: inline-block;
        font: 300 12px/1.2 'Inter', system-ui, -apple-system, Arial, sans-serif;
        letter-spacing: -0.5px;
        line-height: .95;
        text-transform: uppercase;
        opacity: .9;
        margin-bottom: 10px;
        }

        .spotlight__title {
        margin: 0;
        font-family: "Inter", Arial, serif;
        font-weight: 500;
        letter-spacing: -0.5px;
        line-height: .95;
        /* besar & responsif */
        font-size: clamp(34px, 7.2vw, 88px);
        text-shadow: 0 2px 18px rgba(0,0,0,.35);
        }

        /* Interaksi halus saat hover */
        .spotlight__frame:hover .spotlight__image {
        transform: scale(1.03);
        }
        /* ====== END Section Spotlight ====== */

        /* ====== Section Careers ====== */
        .careers-section {  
        padding: 64px 0 90px;
        }

        .careers-wrap {
        max-width: 1430px;
        margin: 0 auto;
        padding: 0 24px;
        }

        /* Header */
        .careers-title {
        font-family: "Inter", Arial, sans-serif;
        font-weight: 300;
        font-size: clamp(36px, 6vw, 64px);
        letter-spacing: -0.5px;
        line-height: .95;
        text-align: center;
        margin: 0 0 10px;
        color: #0f1115;
        }
        .careers-subtitle {
        text-align: center;
        max-width: 860px;
        margin: 0 auto 40px;
        font-family: 'Inter', system-ui, -apple-system, Arial, sans-serif;
        font-size: clamp(15px, 1.8vw, 22px);
        color: #5d6b7a;
        letter-spacing: -0.5px;
        line-height: .95;
        }

        /* Grid */
        .careers-grid {
        display: grid;
        gap: 28px;
        grid-template-columns: repeat(3, 1fr);
        }
        @media (max-width: 1050px) {
        .careers-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 680px) {
        .careers-grid { grid-template-columns: 1fr; }
        }

        /* Card */
        .career-card {
        background: #fff;
        border-radius: 10px;
        padding: 26px 24px 22px;
        box-shadow:
            0 10px 30px rgba(15,17,21,0.06),
            0 1px 0 rgba(15,17,21,0.04);
        transition: transform .35s cubic-bezier(.22,.61,.36,1),
                    box-shadow .35s cubic-bezier(.22,.61,.36,1);
        }
        .career-card:hover {
        transform: translateY(-4px);
        box-shadow:
            0 18px 50px rgba(15,17,21,0.10),
            0 1px 0 rgba(15,17,21,0.04);
        }

        /* Text inside card */
        .career-role {
        margin: 0 0 8px;
        font: 500 22px/1.25 "Inter", system-ui, -apple-system, Arial, sans-serif;
        color: #0f1115;
        letter-spacing: -0.5px;
        line-height: .95;
        }
        .career-dept {
        font: 500 14px/1.4 "Inter", system-ui, -apple-system, Arial, sans-serif;
        color: #6b7683;
        margin-bottom: 14px;
        letter-spacing: -0.5px;
        line-height: .95;
        }

        .career-meta {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 16px;
        }
        .career-loc {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #6b7683;
        font: 500 14px/1.4 "Inter", system-ui, -apple-system, Arial, sans-serif;
        letter-spacing: -0.5px;
        line-height: .95;
        }
        .loc-ic { width: 16px; height: 16px; opacity: .9; }

        /* Apply button */
        .career-apply {
        width: 100%;
        height: 48px;
        border-radius: 4px;
        border: none;
        background: #0a0a0a;
        color: #fff;
        font: 700 15px/1 "Inter", system-ui, -apple-system, Arial, sans-serif;
        letter-spacing: -0.5px;
        line-height: .95;
        cursor: pointer;
        transition: transform .18s ease, background .18s ease, box-shadow .18s ease;
        }
        .career-apply:hover {
        transform: translateY(-1px);
        background: #000;
        box-shadow: 0 10px 18px rgba(0,0,0,.14);
        }
        .career-apply:active {
        transform: translateY(0);
        box-shadow: none;
        }
        .careers-footer {
        margin-top: 100px;
        margin-left: 650px;
        }
        .careers-viewall {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: #000;
        color: #fff;
        padding: 18px 34px;
        font-weight: 700;
        text-decoration: none;
        font-size: 16px;
        border-radius: 2px;
        transition: background .25s ease;
        }
        .careers-viewall:hover {
        background: #333;
        }
        .careers-viewall .icon {
        font-size: 18px;
        }
        .careers-view {
        margin: 0 0 8px;
        font: 500 22px/1.25 "Inter", system-ui, -apple-system, Arial, sans-serif;
        color: #333;
        letter-spacing: -0.5px;
        line-height: .95;
        }

        /* ====== END Section Careers ====== */

        /* ====== Section Join Member ====== */

        .join-member {
        margin-top: -100px;
        background: #fff;              /* Putih */
        color: #000;                   /* Teks hitam */
        padding: 120px 20px;
        text-align: center;
        }

        .join-member-inner {
        max-width: 800px;
        margin: 0 auto;
        }

        .join-member-title {
        font-family: 'Inter', sans-serif;
        font-size: 60px;
        font-weight: 500;
        margin-bottom: 20px;
        letter-spacing: -0.5px;
        line-height: .95;
        }

        .join-member-desc {
        font-family: 'Inter', sans-serif;
        font-size: 18px;
        color: #444;
        margin-bottom: 40px;
        letter-spacing: -0.5px;
        line-height: .95;
        }

        .join-member-btn {
        background: #000;          /* Tombol hitam */
        color: #fff;               /* Teks putih */
        font-weight: 600;
        border: none;
        padding: 18px 40px;
        font-size: 16px;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s ease;
        }

        .join-member-btn:hover {
        background: #333;
        transform: translateY(-2px);
        }
        /* ====== END Section Join Member ====== */

        /* ====== Footer ====== */
        .site-footer{
        background:#0A0B0C;             /* very dark */
        color:#cfd8e3;                  /* soft gray-blue */
        padding:72px 24px 28px;
        }

        .site-footer a{ color:#e6eef8; text-decoration:none; }
        .site-footer a:hover{ color:#ffffff; }

        .footer-inner{
        max-width:1280px;
        margin:0 auto 28px;
        display:grid;
        grid-template-columns: 1.2fr 1fr 1fr;
        gap:54px;
        }

        /* Brand */
        .footer-brand .brand-head{ display:flex; align-items:center; gap:12px; }
        .brand-icon{ flex:0 0 auto; }
        .brand-name{
        font-family: 'Inter', Arial, sans-serif;
        font-size:28px; 
        font-weight:800; 
        letter-spacing: -0.5px;
        line-height: .95; 
        color:#fff;
        }
        .brand-tagline{
        margin-top:18px;
        line-height:1.7;
        color:#98a7b8;
        max-width:620px;
        }

        /* Navigation */
        .footer-title{
        font-family:'Inter', Arial, sans-serif;
        font-weight:700; 
        letter-spacing: -0.5px;
        line-height: .95;
        color:#fff; 
        margin:2px 0 16px;
        }
        .nav-cols{
        display:grid;
        grid-template-columns: 1fr 1fr;
        gap:32px;
        }
        .footer-links{ list-style:none; margin:0; padding:0; }
        .footer-links li{ margin:12px 0; }
        .footer-links a{
        font-size:16px; color:#cfd8e3;
        transition:transform .2s ease, color .2s ease;
        display:inline-block;
        }
        .footer-links a:hover{ color:#fff; transform: translateX(4px); }

        /* Connect */
        .contact-item{ display:flex; align-items:center; gap:10px; margin:12px 0; }
        .ci{ opacity:.85; }
        .follow-title{ margin-top:18px; font-weight:600; color:#fff; }
        .socials{ display:flex; gap:14px; margin-top:10px; }
        .social-btn{
        width:44px; height:44px; display:grid; place-items:center;
        background:#18202b; border-radius:6px;
        border:1px solid rgba(255,255,255,.06);
        transition: transform .18s ease, background .18s ease, box-shadow .18s ease;
        }
        .social-btn:hover{
        background:#222c3a;
        transform: translateY(-2px);
        box-shadow:0 6px 20px rgba(0,0,0,.35);
        }

        /* Divider */
        .footer-divider{
        max-width:1280px; margin:18px auto 22px;
        height:1px; background: linear-gradient(90deg, rgba(255,255,255,.06), rgba(255,255,255,.08), rgba(255,255,255,.06));
        }

        /* Bottom bar */
        .footer-bottom{
        max-width:1280px;
        margin:0 auto;
        display:grid;
        grid-template-columns: 1.2fr auto auto;
        align-items:center;
        gap:18px;
        font-size:14px;
        color:#9fb0c2;
        }
        .legal{ list-style:none; display:flex; gap:22px; margin:0; padding:0; }
        .legal a{ color:#b9c7d6; }
        .legal a:hover{ color:#fff; }
        .copy{ white-space:nowrap; }
        .est{ white-space:nowrap; color:#b9c7d6; }

        /* Responsive */
        @media (max-width: 1024px){
        .footer-inner{ grid-template-columns: 1fr 1fr; }
        .footer-brand{ grid-column: 1 / -1; }
        }
        @media (max-width: 720px){
        .footer-inner{ grid-template-columns: 1fr; gap:36px; }
        .footer-bottom{
            grid-template-columns: 1fr; gap:10px; text-align:center;
        }
        .legal{ justify-content:center; flex-wrap:wrap; }
        .copy,.est{ justify-self:center; }
        }

        /* ====== END Footer ====== */

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
