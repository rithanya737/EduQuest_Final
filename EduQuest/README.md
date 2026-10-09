# 🇮🇳 EduQuest — Gamified Learning Platform

EduQuest is an interactive educational gaming platform that helps students explore India's geography, history, monuments, culture and general knowledge through six engaging browser games.

Originally developed as a frontend project for the **Web Technology Design (WTD) coursework at Velammal College of Engineering and Technology**, EduQuest has been extended with a PHP backend and a MySQL/MariaDB database to support user authentication, persistent game scores, progress tracking and a leaderboard.

## 📌 Project Information

- **Project Title:** EduQuest — A Gamified Learning Platform for Exploring India
- **Application Domain:** Educational Gaming / E-Learning
- **Frontend:** HTML5, CSS3, Vanilla JavaScript
- **Backend:** PHP
- **Database:** MySQL
- **Local Development Environment:** XAMPP (Apache and PHP)
- **Version Control:** Git and GitHub

## 🎮 The Six Educational Games

| Game | Folder | Description |
|---|---|---|
| 🗺️ Map Challenge | `games/states/` | Identify the 28 states of India using an interactive map. |
| 📝 Crossword Challenge | `games/crossword/` | Solve crossword clues related to India's geography, history and culture. |
| 🎡 Quiz Challenge | `games/quiz/` | Spin a topic wheel and answer questions about India. |
| 🔤 Word Scramble | `games/scramble/` | Unscramble words across different Indian knowledge topics. |
| 🕵️ Personality Guess | `games/hangman/` | Identify historical personalities by revealing letters. |
| 🃏 Flip Card Match | `games/monuments/` | Match pairs of cards featuring India's iconic monuments. |

## ⚙️ Backend Features

### 1. User Registration and Login
- Users can create accounts and log in.
- PHP performs server-side validation of submitted data.
- Passwords are hashed before being stored in the database.
- Password verification is performed during login.
- PHP sessions maintain the authenticated user's identity.

### 2. Database Integration
- PHP connects to MySQL
- Prepared statements are used for database queries involving user input.
- User information, game attempts and summarized game progress are stored in related database tables.

### 3. Game Score Management
- Game scores are submitted to the PHP backend.
- Each score is associated with the logged-in user.
- Individual game attempts are stored for later retrieval.
- Game progress is updated with the number of plays, best score and last-played information.

### 4. User Dashboard
The dashboard retrieves information from the backend and displays:

- Current day streak and longest streak
- Total games played
- Number of games tried out of six
- Play count and best score for each game
- Achievement badges based on milestones
- Leaderboard rankings

### 5. Streak Tracking
Streak tracking encourages consistent participation. The application uses the user's activity date and stored streak values to calculate consecutive active days and maintain the longest streak.

### 6. Leaderboard
The leaderboard compares users based on their accumulated game scores. PHP retrieves the relevant database records, calculates total scores and game counts, and returns ranked results.

### 7. Server-Side Architecture
The frontend communicates with the PHP API, which processes requests and interacts with the database. Responses are returned to the frontend for display.

## 🗄️ Database Design

The main database is named `eduquest`.

| Table | Purpose |
|---|---|
| `users` | Stores user account information and streak-related fields. |
| `game_scores` | Stores individual game attempts, scores, user IDs and play timestamps. |
| `game_progress` | Stores per-user, per-game play counts, best scores and last-played information. |

### Table Relationships

The `user_id` column in `game_scores` and `game_progress` references the `id` column in `users`.

This relationship connects each game attempt and progress record to the appropriate user.

## 🧰 Technologies Used

- **HTML5:** Page structure, forms and semantic elements.
- **CSS3:** Layout, styling, responsive design and visual effects.
- **JavaScript:** Game logic, event handling, DOM manipulation and dashboard rendering.
- **PHP:** Server-side processing, authentication, sessions and API operations.
- **MySQL/MariaDB:** Persistent storage of user information, scores and progress.
- **PDO:** Database connectivity and prepared statements.
- **JSON:** Data exchange between the frontend JavaScript and PHP API.
- **Apache / XAMPP:** Local web server for running the PHP application.
- **Git / GitHub:** Source-code version control and project hosting.

## 📁 Project Structure

```text
EduQuest/
│
├── assets/
│   └── css/
│       └── site-theme.css
│
├── home/
│   ├── index.html
│   ├── instructions.html
│   ├── login.php
│   ├── register.php
│   ├── dashboard.php
│   ├── css/
│   └── js/
│       ├── dashboard.js
│       └── eduquest-data.js
│
├── games/
│   ├── states/
│   ├── crossword/
│   ├── quiz/
│   ├── scramble/
│   ├── hangman/
│   └── monuments/
│
└── backend/
    ├── config/
    │   └── db.php
    ├── api.php
    ├── session_guard.php
    └── database/
        └── eduquest.sql
```

*The structure above describes the main project files; retain the actual filenames and folders from your final project directory.*

## ▶️ How to Run the Project Locally

### Prerequisites
- XAMPP installed on Windows
- Apache running
- MySQL/MariaDB running
- The EduQuest database and tables created using the supplied SQL script

### Step 1 — Place the project in XAMPP

Copy the project folder into:

```text
C:\xampp\htdocs\EduQuest_Final\EduQuest
```

### Step 2 — Start Apache

Open XAMPP Control Panel and start Apache.

Keep your existing MySQL/MariaDB server running. If another database service is already using port `3306`, configure the connection to use the correct server and port.

### Step 3 — Configure the database

Open:

```text
backend/config/db.php
```

Verify the host, port, database name, username and password match your actual MySQL/MariaDB configuration.

### Step 4 — Create the database

Open your database management tool and execute the supplied SQL setup script:

```text
backend/database/eduquest.sql
```

Ensure the `eduquest` database and required tables are created successfully.

### Step 5 — Test the database connection

If your project contains `backend/test_db.php`, open:

```text
http://localhost/EduQuest_Final/EduQuest/backend/test_db.php
```

A successful connection message confirms that PHP can connect to the database.

### Step 6 — Open EduQuest

Visit:

```text
http://localhost/EduQuest_Final/EduQuest/home/index.html
```

Register an account, log in, play a game and check whether the score and progress appear on the dashboard.

## 🔐 Security Considerations

- Passwords are hashed rather than stored as plain text.
- Prepared statements help prevent SQL injection.
- PHP sessions maintain the authenticated user's identity.
- Server-side validation checks submitted data.
- Database credentials should be configured locally and should not be published with sensitive passwords in a public repository.

## 🎯 Project Objectives

1. Make learning about India interactive and engaging.
2. Combine six educational games within a single application.
3. Implement server-side user authentication.
4. Store and retrieve scores and game progress using a relational database.
5. Encourage consistent participation through streaks and milestone badges.
6. Promote healthy competition through a multi-user leaderboard.

## 🚀 Future Enhancements

- Additional educational games and topics
- More detailed progress analytics
- Improved achievement and reward systems
- Deployment to an online server with a shared database
- Additional administrative and data-management features

## 👩‍💻 Team Members

- Eesha R S
- Keertana Priya A
- Rithanya R



---

*EduQuest — Learn. Play. Discover India.*