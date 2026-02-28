<!DOCTYPE html>
<html lang="en">
<head>
<title>Hospital Resource Intelligence System</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
/* ================= ROOT COLORS ================= */
:root{
    --bg-black:#000000;
    --panel-black:#0B0B0B;
    --card-black:#121212;
    --red:#E10600;
    --red-soft:#FF4D4D;
    --white:#FFFFFF;
    --muted:#B3B3B3;
    --border:rgba(255,255,255,0.08);
}

/* ================= GLOBAL ================= */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Inter,Segoe UI,sans-serif;
}

body{
    color:var(--white);
    background:
        radial-gradient(circle at 10% 15%, rgba(225,6,0,0.28), transparent 40%),
        radial-gradient(circle at 90% 30%, rgba(225,6,0,0.22), transparent 45%),
        radial-gradient(circle at 50% 85%, rgba(255,255,255,0.04), transparent 55%),
        linear-gradient(135deg, #000000, #0B0B0B, #000000);
    background-attachment:fixed;
}

/* MEDICAL GRID OVERLAY */
body::before{
    content:"";
    position:fixed;
    inset:0;
    background:
        linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
    background-size:40px 40px;
    pointer-events:none;
    z-index:-1;
}

/* ================= HEADER ================= */
header{
    padding:22px 50px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    border-bottom:1px solid var(--border);
}

.logo{
    font-size:1.9rem;
    font-weight:900;
    color:var(--red);
    letter-spacing:1px;
}

nav a{
    margin-left:26px;
    text-decoration:none;
    font-weight:600;
    color:var(--muted);
    transition:.3s;
}

nav a:hover{
    color:var(--red);
}

/* ================= HERO ================= */
.hero{
    max-width:1100px;
    margin:auto;
    padding:110px 20px 90px;
    text-align:center;
    position:relative;
}

.hero::before{
    content:"";
    position:absolute;
    inset:-70px;
    background:radial-gradient(circle at center, rgba(225,6,0,0.35), transparent 65%);
    z-index:-1;
}

.hero h1{
    font-size:3.4rem;
    font-weight:900;
    line-height:1.15;
    margin-bottom:22px;
}

.hero h1 span{
    color:var(--red);
}

.hero p{
    font-size:1.15rem;
    color:var(--muted);
    max-width:780px;
    margin:auto;
    margin-bottom:45px;
    line-height:1.7;
}

.hero-actions{
    display:flex;
    justify-content:center;
    gap:22px;
    flex-wrap:wrap;
}

.hero-actions button{
    padding:16px 44px;
    font-size:1rem;
    font-weight:800;
    border-radius:12px;
    border:none;
    cursor:pointer;
    transition:.3s;
}

/* BUTTONS */
.btn-user{
    background:var(--red);
    color:#000;
}

.btn-admin{
    background:transparent;
    color:var(--red);
    border:2px solid var(--red);
}

.hero-actions button:hover{
    transform:translateY(-4px);
    box-shadow:0 18px 45px rgba(225,6,0,0.45);
}

/* ================= FEATURES ================= */
.features{
    max-width:1250px;
    margin:90px auto;
    padding:0 20px;
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(270px,1fr));
    gap:34px;
}

.feature{
    background:var(--card-black);
    border:1px solid var(--border);
    border-radius:22px;
    padding:38px;
    transition:.35s;
}

.feature:hover{
    transform:translateY(-10px);
    border-color:var(--red);
}

.feature h3{
    color:var(--red-soft);
    margin-bottom:14px;
    font-size:1.2rem;
}

.feature p{
    color:var(--muted);
    line-height:1.7;
}

/* ================= LIVE STATUS ================= */
.status{
    max-width:1200px;
    margin:110px auto;
    padding:0 20px;
}

.status h2{
    text-align:center;
    font-size:2.6rem;
    margin-bottom:60px;
}

.status-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
    gap:32px;
}

.status-card{
    background:var(--panel-black);
    border:1px solid var(--border);
    border-radius:22px;
    padding:45px 30px;
    text-align:center;
}

.status-number{
    font-size:3.2rem;
    font-weight:900;
    color:var(--red);
    margin-bottom:10px;
}

.status-label{
    color:var(--muted);
    letter-spacing:0.4px;
}

/* ================= FOOTER ================= */
footer{
    border-top:1px solid var(--border);
    padding:42px 20px;
    text-align:center;
    color:var(--muted);
    margin-top:100px;
}

/* ================= RESPONSIVE ================= */
@media(max-width:768px){
    .hero h1{
        font-size:2.4rem;
    }
}
</style>
</head>

<body>

<header>
    <div class="logo">🏥 HOSPITAL INTELLIGENCE</div>
    <nav>
        <a href="#">Home</a>
        <a href="#">Dashboard</a>
        <a href="#">Contact</a>
    </nav>
</header>

<section class="hero">
    <h1>
        Predict • Prepare • <span>Save Lives</span>
    </h1>
    <p>
        A predictive hospital resource and emergency load intelligence system
        that analyzes real-time and historical data to forecast ICU demand,
        emergency inflow, and medical staff workload.
    </p>

    <div class="hero-actions">
        <button class="btn-user" onclick="location.href='#status'">
            View Hospital Status
        </button>
        <button class="btn-admin" onclick="location.href='login.php'">
            Doctor / Admin Login
        </button>
    </div>
</section>

<section class="features">
    <div class="feature">
        <h3>Emergency Load Prediction</h3>
        <p>Forecast sudden surges in emergency patients before critical overload.</p>
    </div>

    <div class="feature">
        <h3>ICU Bed Availability</h3>
        <p>Monitor ICU capacity in real time to avoid last-minute shortages.</p>
    </div>

    <div class="feature">
        <h3>Staff Workload Intelligence</h3>
        <p>Analyze doctor and nurse workload to prevent burnout.</p>
    </div>

    <div class="feature">
        <h3>Patient History Analysis</h3>
        <p>Doctors access full treatment history for accurate decisions.</p>
    </div>
</section>

<section class="status" id="status">
    <h2>Live Hospital Overview</h2>

    <div class="status-grid">
        <div class="status-card">
            <div class="status-number">72</div>
            <div class="status-label">Emergency Patients</div>
        </div>

        <div class="status-card">
            <div class="status-number">18</div>
            <div class="status-label">Available ICU Beds</div>
        </div>

        <div class="status-card">
            <div class="status-number">126</div>
            <div class="status-label">Medical Staff On Duty</div>
        </div>
    </div>
</section>

<footer>
    © 2026 Predictive Hospital Resource & Emergency Load Intelligence System
</footer>

</body>
</html>