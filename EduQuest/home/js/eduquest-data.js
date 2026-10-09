/* EduQuest - server-backed data layer. PHP session + MySQL. */
const EduQuestData = (function () {
    const GAME_KEYS = ["states", "crossword", "quiz", "scramble", "hangman", "monuments"];
    const API_URL = window.location.pathname.includes("/home/") ? "../backend/api.php" : "../../backend/api.php";

    async function api(action, data) {
        const options = {
            method: data ? "POST" : "GET",
            credentials: "same-origin",
            headers: data ? { "Content-Type": "application/json" } : {}
        };
        if (data) options.body = JSON.stringify(data);
        const response = await fetch(API_URL + "?action=" + encodeURIComponent(action), options);
        let result;
        try { result = await response.json(); }
        catch (e) { throw new Error("Server returned an invalid response."); }
        return result;
    }

    async function getCurrentUser() {
        const result = await api("session");
        return result.loggedIn ? result.user : null;
    }

    async function isLoggedIn() {
        return !!(await getCurrentUser());
    }

    async function registerUser(data) { return await api("register", data); }
    async function login(email, password) { return await api("login", { email: email, password: password }); }
    async function logout() { return await api("logout"); }
    async function saveScore(game, score) { return await api("save_score", { game: game, score: Number(score) || 0 }); }
    async function getDashboard() { return await api("dashboard"); }
    async function getLeaderboard() { return await api("leaderboard"); }

    return { GAME_KEYS, getCurrentUser, isLoggedIn, registerUser, login, logout, saveScore, getDashboard, getLeaderboard };
})();
