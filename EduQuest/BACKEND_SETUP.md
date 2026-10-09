# EduQuest - PHP + MySQL Backend

## 1. Folder
Copy `EduQuest_Php` into `C:\xampp\htdocs\`.

The project will be at:
`C:\xampp\htdocs\EduQuest_Php\eduquest\frontend_eduquest`

## 2. Server
Start **Apache** in XAMPP.
Do NOT start XAMPP MySQL because an existing MySQL/MariaDB server is already using port 3306.

## 3. Database
Open MySQL Workbench and run:
`eduquest\frontend_eduquest\backend\database\eduquest.sql`

This creates the `eduquest` database, the `eduquest` MySQL user, and the `users`, `game_scores`, and `game_progress` tables.

The included PHP connection uses:
- Host: `127.0.0.1`
- Port: `3306`
- Database: `eduquest`
- Username: `eduquest`
- Password: `eduquest`

If you chose a different password, edit `frontend_eduquest/backend/config/db.php`.

## 4. Run
Open:
`http://localhost/EduQuest_Php/`

## 5. Backend features
- Registration and password hashing
- Login and PHP sessions
- Logout
- Game score storage for all 6 games
- Per-game play count and best score
- Streak tracking
- Dashboard from MySQL
- Leaderboard from MySQL

Use the site through `http://localhost/...`; do not open the pages with `file:///`.
