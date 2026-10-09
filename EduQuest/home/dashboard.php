<?php
require_once __DIR__ . "/../backend/session_guard.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EduQuest &mdash; Dashboard</title>
<link rel="icon" type="image/png" href="images/logo.png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/dashboard.css">
<link rel="stylesheet" href="../assets/css/site-theme.css">
</head>
<body class="landing-page">

<header class="site-header">
    <a class="logo" href="index.html">
        <img src="images/logo.png" alt="EduQuest logo">
        <span class="logo-word">EduQuest</span>
    </a>

    <nav>
        <a href="index.html#home">Home</a>
        <a href="index.html#games">Games</a>
        <a href="instructions.html">Game Guide</a>
        <a href="dashboard.php" class="active" aria-current="page">Dashboard</a>
    </nav>

    <div class="account" id="account-area">
        <a href="#" class="account-register" id="logout-link">Logout</a>
    </div>
</header>

<main class="dashboard-main">

    <section class="dashboard-welcome">
        <div class="dash-avatar" id="dash-avatar">?</div>
        <div>
            <p class="eyebrow">Your progress</p>
            <h1 id="dash-welcome">Welcome back!</h1>
            <p class="dashboard-sub" id="dash-joined"></p>
        </div>
    </section>

    <section class="dashboard-stats" aria-label="Your stats">
        <div class="stat-card">
            <span class="stat-icon">🔥</span>
            <span class="stat-value" id="stat-current-streak">0</span>
            <span class="stat-label">Day streak</span>
        </div>
        <div class="stat-card">
            <span class="stat-icon">🏆</span>
            <span class="stat-value" id="stat-longest-streak">0</span>
            <span class="stat-label">Longest streak</span>
        </div>
        <div class="stat-card">
            <span class="stat-icon">🎮</span>
            <span class="stat-value" id="stat-total-plays">0</span>
            <span class="stat-label">Games played</span>
        </div>
        <div class="stat-card">
            <span class="stat-icon">🗂️</span>
            <span class="stat-value" id="stat-games-tried">0/6</span>
            <span class="stat-label">Games tried</span>
        </div>
    </section>

    <section class="dashboard-games">
        <p class="eyebrow center">Play count by game</p>
        <h2>Your six games</h2>
        <div class="dash-game-grid" id="dash-game-grid"></div>
    </section>

    <section class="dashboard-badges">
        <p class="eyebrow center">Milestones</p>
        <h2>Badges</h2>
        <div class="badge-row" id="badge-row"></div>
    </section>

    <section class="dashboard-games" id="leaderboard-section">
        <p class="eyebrow center">Top players</p>
        <h2>Leaderboard</h2>
        <div id="leaderboard" class="dash-game-grid"></div>
    </section>

</main>

<footer>
    <div class="footer-logo">EduQuest</div>
    <p>Learn. Play. Discover.</p>
    <p class="footer-fine">&copy; 2026 EduQuest. All rights reserved.</p>
</footer>

<script src="js/eduquest-data.js"></script>
<script src="js/dashboard.js"></script>
</body>
</html>
