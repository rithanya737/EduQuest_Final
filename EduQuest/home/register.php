<?php
session_start();
if (!empty($_SESSION["user_id"])) { header("Location: dashboard.php"); exit; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EduQuest &mdash; Register</title>
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
        <span class="account-hint">Already have an account?</span>
        <a href="login.php" class="account-login">Login</a>
    </div>
</header>

<main class="auth-main">
    <section class="auth-card-wrap">
        <div class="auth-card">
            <div class="auth-flag-bar" aria-hidden="true"></div>

            <p class="eyebrow">Join EduQuest</p>
            <h1>Create your account</h1>
            <p class="auth-subtitle">Set up an account to keep exploring India's states, history, monuments and culture.</p>

            <form id="register-form" novalidate>

                <div class="form-group">
                    <label for="reg-name">Full name</label>
                    <input type="text" id="reg-name" name="name" placeholder="e.g. Aarav Sharma" autocomplete="name" required>
                    <span class="field-error" id="reg-name-error" role="alert"></span>
                </div>

                <div class="form-group">
                    <label for="reg-email">Email address</label>
                    <input type="email" id="reg-email" name="email" placeholder="you@example.com" autocomplete="email" required>
                    <span class="field-error" id="reg-email-error" role="alert"></span>
                </div>

                <div class="form-group">
                    <label for="reg-password">Password</label>
                    <div class="password-field">
                        <input type="password" id="reg-password" name="password" placeholder="At least 8 characters" autocomplete="new-password" required minlength="8">
                        <button type="button" class="toggle-password" data-target="reg-password" aria-label="Show password">&#128065;&#65039;</button>
                    </div>
                    <span class="field-error" id="reg-password-error" role="alert"></span>
                </div>

                <div class="form-group">
                    <label for="reg-confirm">Confirm password</label>
                    <div class="password-field">
                        <input type="password" id="reg-confirm" name="confirm-password" placeholder="Re-enter your password" autocomplete="new-password" required>
                        <button type="button" class="toggle-password" data-target="reg-confirm" aria-label="Show password">&#128065;&#65039;</button>
                    </div>
                    <span class="field-error" id="reg-confirm-error" role="alert"></span>
                </div>

                <div class="form-row terms-row">
                    <label class="checkbox-row">
                        <input type="checkbox" id="reg-terms">
                        <span>I agree to play fair and have fun</span>
                    </label>
                </div>
                <span class="field-error" id="reg-terms-error" role="alert"></span>

                <p class="form-status" id="register-status" role="status" aria-live="polite"></p>

                <button type="submit" class="btn btn-primary auth-submit">
                    Create account
                    <span aria-hidden="true">&rarr;</span>
                </button>
            </form>

            <p class="auth-switch">Already have an account? <a href="login.php">Log in</a></p>
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
