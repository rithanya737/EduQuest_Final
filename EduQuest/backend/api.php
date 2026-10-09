<?php
session_start();
header("Content-Type: application/json; charset=utf-8");
require_once __DIR__ . "/config/db.php";

function respond($data, $status = 200) {
    http_response_code($status);
    echo json_encode($data);
    exit;
}

function input_data() {
    $raw = file_get_contents("php://input");
    $data = json_decode($raw, true);
    return is_array($data) ? $data : $_POST;
}

function email_normalize($email) {
    return strtolower(trim((string)$email));
}

function current_user() {
    global $pdo;
    if (empty($_SESSION["user_id"])) return null;
    $stmt = $pdo->prepare("SELECT id, name, email, joined_at, current_streak, longest_streak, last_active_date FROM users WHERE id = ?");
    $stmt->execute(array((int)$_SESSION["user_id"]));
    return $stmt->fetch() ?: null;
}

function touch_activity($user_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT current_streak, longest_streak, last_active_date FROM users WHERE id = ?");
    $stmt->execute(array($user_id));
    $user = $stmt->fetch();
    if (!$user) return;

    $today = new DateTime("today");
    $todayKey = $today->format("Y-m-d");
    $last = $user["last_active_date"];
    $current = (int)$user["current_streak"];
    $longest = (int)$user["longest_streak"];

    if ($last === $todayKey) return;
    if ($last) {
        $lastDate = new DateTime($last);
        $difference = (int)$lastDate->diff($today)->format("%r%a");
        $current = ($difference === 1) ? $current + 1 : 1;
    } else {
        $current = 1;
    }

    $longest = max($longest, $current);
    $update = $pdo->prepare("UPDATE users SET current_streak = ?, longest_streak = ?, last_active_date = ? WHERE id = ?");
    $update->execute(array($current, $longest, $todayKey, $user_id));
}

$action = isset($_GET["action"]) ? $_GET["action"] : "";

if ($action === "session") {
    $user = current_user();
    if (!$user) respond(array("ok" => true, "loggedIn" => false, "user" => null));
    respond(array("ok" => true, "loggedIn" => true, "user" => $user));
}

if ($action === "register") {
    $data = input_data();
    $name = trim(isset($data["name"]) ? $data["name"] : "");
    $email = email_normalize(isset($data["email"]) ? $data["email"] : "");
    $password = isset($data["password"]) ? (string)$data["password"] : "";

    if (strlen($name) < 2 || strlen($name) > 100) respond(array("ok"=>false,"error"=>"Enter a valid full name."),400);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) respond(array("ok"=>false,"error"=>"Enter a valid email address."),400);
    if (strlen($password) < 8 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/\d/', $password)) respond(array("ok"=>false,"error"=>"At least 8 characters, with a letter and a number."),400);

    $check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $check->execute(array($email));
    if ($check->fetch()) respond(array("ok"=>false,"error"=>"An account with this email already exists."),409);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->execute(array($name, $email, password_hash($password, PASSWORD_DEFAULT)));
        $id = (int)$pdo->lastInsertId();
        session_regenerate_id(true);
        $_SESSION["user_id"] = $id;
        touch_activity($id);
        respond(array("ok"=>true,"user"=>current_user()));
    } catch (PDOException $e) {
        respond(array("ok"=>false,"error"=>"Unable to create the account right now."),500);
    }
}

if ($action === "login") {
    $data = input_data();
    $email = email_normalize(isset($data["email"]) ? $data["email"] : "");
    $password = isset($data["password"]) ? (string)$data["password"] : "";
    $stmt = $pdo->prepare("SELECT id, name, email, password FROM users WHERE email = ?");
    $stmt->execute(array($email));
    $user = $stmt->fetch();
    if (!$user || !password_verify($password, $user["password"])) respond(array("ok"=>false,"error"=>"Incorrect email or password."),401);
    session_regenerate_id(true);
    $_SESSION["user_id"] = (int)$user["id"];
    touch_activity((int)$user["id"]);
    respond(array("ok"=>true,"user"=>current_user()));
}

if ($action === "logout") {
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), "", time()-42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    }
    session_destroy();
    respond(array("ok"=>true));
}

if ($action === "save_score") {
    $user = current_user();
    if (!$user) respond(array("ok"=>false,"error"=>"Please log in first."),401);
    $data = input_data();
    $game = trim((string)(isset($data["game"]) ? $data["game"] : ""));
    $score = (int)(isset($data["score"]) ? $data["score"] : 0);
    $allowed = array("states","crossword","quiz","scramble","hangman","monuments");
    if (!in_array($game, $allowed, true)) respond(array("ok"=>false,"error"=>"Invalid game."),400);
    if ($score < 0) $score = 0;
    if ($score > 1000) $score = 1000;

    $pdo->beginTransaction();
    try {
        $stmt = $pdo->prepare("INSERT INTO game_scores (user_id, game_name, score) VALUES (?, ?, ?)");
        $stmt->execute(array($user["id"], $game, $score));
        $progress = $pdo->prepare("INSERT INTO game_progress (user_id, game_name, games_played, best_score, last_played) VALUES (?, ?, 1, ?, NOW()) ON DUPLICATE KEY UPDATE games_played = games_played + 1, best_score = GREATEST(best_score, VALUES(best_score)), last_played = NOW()");
        $progress->execute(array($user["id"], $game, $score));
        $pdo->commit();
        touch_activity((int)$user["id"]);
        respond(array("ok"=>true,"message"=>"Score saved.","score"=>$score));
    } catch (Exception $e) {
        if ($pdo->inTransaction()) $pdo->rollBack();
        respond(array("ok"=>false,"error"=>"Could not save the score."),500);
    }
}

if ($action === "dashboard") {
    $user = current_user();
    if (!$user) respond(array("ok"=>false,"error"=>"Please log in first."),401);
    touch_activity((int)$user["id"]);
    $user = current_user();
    $games = array("states","crossword","quiz","scramble","hangman","monuments");
    $stmt = $pdo->prepare("SELECT game_name, games_played, best_score FROM game_progress WHERE user_id = ?");
    $stmt->execute(array($user["id"]));
    $rows = $stmt->fetchAll();
    $stats = array();
    foreach ($games as $game) $stats[$game] = array("plays"=>0,"bestScore"=>0);
    foreach ($rows as $row) $stats[$row["game_name"]] = array("plays"=>(int)$row["games_played"],"bestScore"=>(int)$row["best_score"]);
    $total = $pdo->prepare("SELECT COUNT(*) FROM game_scores WHERE user_id = ?");
    $total->execute(array($user["id"]));
    $totalPlays = (int)$total->fetchColumn();
    respond(array("ok"=>true,"user"=>$user,"stats"=>array("gamesPlayed"=>$stats,"totalPlays"=>$totalPlays,"streak"=>array("current"=>(int)$user["current_streak"],"longest"=>(int)$user["longest_streak"]))));
}

if ($action === "leaderboard") {
    $stmt = $pdo->query("SELECT u.id, u.name, COALESCE(SUM(gs.score),0) AS total_score, COUNT(gs.id) AS games_played FROM users u LEFT JOIN game_scores gs ON gs.user_id = u.id GROUP BY u.id, u.name ORDER BY total_score DESC, games_played DESC, u.name ASC LIMIT 20");
    respond(array("ok"=>true,"leaderboard"=>$stmt->fetchAll()));
}

respond(array("ok"=>false,"error"=>"Unknown action."),400);
?>
