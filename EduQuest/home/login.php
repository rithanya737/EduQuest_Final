<?php
session_start();
if (!empty($_SESSION["user_id"])) { header("Location: dashboard.php"); exit; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EduQuest &mdash; Login</title>
<link rel="icon" type="image/png" href="images/logo.png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/auth.css">
<link rel="stylesheet" href="../assets/css/site-theme.css">
</head>
<body class="landing-page auth-page">

<header class="site-header">
    <a class="logo" href="index.html">
        <img src="images/logo.png" alt="EduQuest logo">
        <span class="logo-word">EduQuest</span>
    </a>

    <nav>
        <a href="index.html#home">Home</a>
        <a href="index.html#about">About</a>
        <a href="index.html#games">Games</a>
        <a href="instructions.html">Game Guide</a>
    </nav>

    <div class="account" id="account-area">
        <span class="account-hint">New here?</span>
        <a href="register.php" class="account-register">Register</a>
    </div>
</header>

<main class="auth-main">
    <section class="auth-card-wrap">
        <div class="auth-card">
            <div class="auth-flag-bar" aria-hidden="true"></div>

            <p class="eyebrow">Welcome back</p>
            <h1>Log in to EduQuest</h1>
            <p class="auth-subtitle">Pick up where you left off across all six India games.</p>

            <form id="login-form" novalidate>

                <div class="form-group">
                    <label for="login-email">Email address</label>
                    <input type="email" id="login-email" name="email" placeholder="you@example.com" autocomplete="email" required>
                    <span class="field-error" id="login-email-error" role="alert"></span>
                </div>

                <div class="form-group">
                    <label for="login-password">Password</label>
                    <div class="password-field">
                        <input type="password" id="login-password" name="password" placeholder="Enter your password" autocomplete="current-password" required minlength="6">
                        <button type="button" class="toggle-password" data-target="login-password" aria-label="Show password">&#128065;&#65039;</button>
                    </div>
                    <span class="field-error" id="login-password-error" role="alert"></span>
                </div>

                <div class="form-row">
                    <label class="checkbox-row">
                        <input type="checkbox" id="remember-me">
                        <span>Remember me</span>
                    </label>
                    <a href="#" class="inline-link" id="forgot-link">Forgot password?</a>
                </div>

                <p class="form-status" id="login-status" role="status" aria-live="polite"></p>

                <button type="submit" class="btn btn-primary auth-submit">
                    Log in
                    <span aria-hidden="true">&rarr;</span>
                </button>
            </form>

            <p class="auth-switch">New to EduQuest? <a href="register.php">Create an account</a></p>
        </div>
    </section>
</main>

<footer>
    <div class="footer-logo">EduQuest</div>
    <p>Learn. Play. Discover.</p>
    <p class="footer-fine">&copy; 2026 EduQuest. All rights reserved.</p>
</footer>

<script src="js/eduquest-data.js"></script>
<script src="js/auth.js"></script>
</body>
</html>
