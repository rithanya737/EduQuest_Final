-- =========================================================
-- EDUQUEST DATABASE + BACKEND TABLES
-- MySQL / MariaDB 10.4+
-- =========================================================

CREATE DATABASE IF NOT EXISTS eduquest
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

CREATE USER IF NOT EXISTS 'eduquest'@'localhost' IDENTIFIED BY 'eduquest';
ALTER USER 'eduquest'@'localhost' IDENTIFIED BY 'eduquest';
GRANT ALL PRIVILEGES ON eduquest.* TO 'eduquest'@'localhost';
FLUSH PRIVILEGES;

USE eduquest;

CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(190) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    joined_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    current_streak INT NOT NULL DEFAULT 0,
    longest_streak INT NOT NULL DEFAULT 0,
    last_active_date DATE NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS game_scores (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    game_name VARCHAR(30) NOT NULL,
    score INT NOT NULL DEFAULT 0,
    played_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_scores_user (user_id),
    INDEX idx_scores_game (game_name),
    CONSTRAINT fk_scores_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS game_progress (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    game_name VARCHAR(30) NOT NULL,
    games_played INT NOT NULL DEFAULT 0,
    best_score INT NOT NULL DEFAULT 0,
    last_played TIMESTAMP NULL DEFAULT NULL,
    UNIQUE KEY unique_user_game (user_id, game_name),
    CONSTRAINT fk_progress_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

SHOW TABLES;
