<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Coastal Care - Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <style>
    *{
      margin:0;
      padding:0;
      box-sizing:border-box;
      font-family:Segoe UI, sans-serif;
    }

    /* TOP BAR */
    .top-strip{
      background:#ffbf00;
      padding:8px;
      text-align:center;
      font-size:14px;
    }

    /* NAVBAR */
    nav{
      display:flex;
      align-items:center;
      padding:15px 60px;
      background:white;
      box-shadow:0 2px 10px rgba(0,0,0,.1);
    }

    .logo{
      font-size:22px;
      font-weight:bold;
      color:#2c5364;
    }

    .menu{
      display:flex;
      gap:25px;
      align-items:center;
      margin-left:auto;
    }

    .menu a{
      text-decoration:none;
      color:#333;
      font-weight:500;
    }

    .dropdown{
      position:relative;
    }

    .dropdown-content{
      display:none;
      position:absolute;
      top:35px;
      background:white;
      padding:10px;
      width:220px;
      box-shadow:0 10px 20px rgba(0,0,0,.2);
      border-radius:8px;
      z-index:10;
    }

    .dropdown-content a{
      display:block;
      padding:8px;
      color:#333;
      text-decoration:none;
    }

    .dropdown:hover .dropdown-content{
      display:block;
    }

    .login-btn{
      background:#2c5364;
      color:white;
      padding:8px 16px;
      border-radius:6px;
      text-decoration:none;
    }

    /* HERO SECTION */
    .hero{
      height:80vh;
      background:
        linear-gradient(rgba(0,0,0,.5),rgba(0,0,0,.5)),
        url("https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1400&q=80");
      background-size:cover;
      background-position:center;
      display:flex;
      align-items:center;
      padding:0 80px;
      color:white;
    }

    .hero-content{
      max-width:600px;
    }

    .hero-content h1{
      font-size:50px;
      margin-bottom:15px;
    }

    .hero-content p{
      font-size:20px;
      margin-bottom:25px;
    }

    .hero-btn{
      background:#ffbf00;
      padding:12px 25px;
      border-radius:8px;
      text-decoration:none;
      color:black;
      font-weight:bold;
    }

    /* INFO CARDS */
    .info-section{
      padding:60px 80px;
      display:grid;
      grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
      gap:30px;
      background:#f5f7fa;
    }

    .info-card{
      background:white;
      padding:25px;
      border-radius:15px;
      box-shadow:0 10px 20px rgba(0,0,0,.15);
      text-align:center;
    }

    .info-card h3{
      color:#2c5364;
      margin-bottom:10px;
    }

    /* ABOUT SECTION */
    .about{
      padding:60px 80px;
      display:flex;
      gap:40px;
      align-items:center;
    }

    .about img{
      width:50%;
      border-radius:15px;
    }

    .about-text h2{
      color:#2c5364;
      margin-bottom:15px;
    }

    .about-text p{
      font-size:18px;
      line-height:1.6;
    }

    /* FOOTER */
    footer{
      background:#0f2027;
      color:white;
      padding:30px;
      text-align:center;
    }
  </style>
</head>

<body>

  <!-- TOP STRIP -->
  <div class="top-strip">
    🌊 Disaster Helpline: 108 | Control Room: 1077 | Contact: 7708468027
  </div>

  <!-- NAVBAR -->
  <nav>
    <div class="logo">Coastal Care</div>

    <div class="menu">
      <a href="index.php">Home</a>

      <div class="dropdown">
        <a href="#">About Us ▾</a>
        <div class="dropdown-content">
          <a href="#">Introduction</a>
          <a href="#">Members</a>
        </div>
      </div>

      <div class="dropdown">
        <a href="#">Programs ▾</a>
        <div class="dropdown-content">
          <a href="#">Disaster Relief</a>
          <a href="#">Health Support</a>
          <a href="#">Environment Care</a>
          <a href="#">Community Development</a>
        </div>
      </div>

      <div class="dropdown">
        <a href="#">Partners ▾</a>
        <div class="dropdown-content">
          <a href="#">NSS</a>
          <a href="#">Young India (YI)</a>
        </div>
      </div>

      <div class="dropdown">
        <a href="#">Contact Us ▾</a>
        <div class="dropdown-content">
          <a href="#">Govt Disaster Helpline: 108</a>
          <a href="#">Emergency Control Room: 1077</a>
          <a href="#">Contact: 7708468027</a>
        </div>
      </div>

      <a href="login.php" class="login-btn">Login</a>
    </div>
  </nav>

  <!-- HERO -->
  <section class="hero">
    <div class="hero-content">
      <h1>Restoring Lives, Rebuilding Hope</h1>
      <p>Coastal Care helps communities prepare for disasters and recover stronger.</p>
      <a href="login.php" class="hero-btn">Get Started</a>
    </div>
  </section>

  <!-- INFO -->
  <section class="info-section">
    <div class="info-card">
      <h3>🌦 Weather Monitoring</h3>
      <p>Live weather updates to prepare for disasters.</p>
    </div>

    <div class="info-card">
      <h3>🌀 Cyclone Tracking</h3>
      <p>Track cyclone movement in real time.</p>
    </div>

    <div class="info-card">
      <h3>🏕 Shelter Camps</h3>
      <p>Safe locations for affected families.</p>
    </div>

    <div class="info-card">
      <h3>🚨 Emergency Alerts</h3>
      <p>Instant alerts during disasters.</p>
    </div>
  </section>

  <!-- ABOUT -->
  <section class="about">
    <img src="https://images.unsplash.com/photo-1509099836639-18ba1795216d?auto=format&fit=crop&w=800&q=80" alt="About Coastal Care">
    <div class="about-text">
      <h2>About Coastal Care</h2>
      <p>
        Coastal Care is a disaster management platform designed to protect coastal communities
        by providing real-time monitoring, relief coordination, and emergency response services.
      </p>
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    © 2026 Coastal Care | Disaster Management System
  </footer>
  <?php if(isset($_GET['reset'])){ ?>
<div class="login-card">

<h2>Reset Password</h2>

<form action="process.php" method="post">

<input type="text" name="reset_user" placeholder="Enter Username" required>

<input type="password" name="new_password" placeholder="Enter New Password" required>

<button name="reset">Reset Password</button>

</form>

<a href="login.php">Back to Login</a>

</div>
<?php } ?>


</body>
</html>
