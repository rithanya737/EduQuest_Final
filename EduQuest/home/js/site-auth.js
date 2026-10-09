document.addEventListener("DOMContentLoaded", async function () {
    try {
        const user = await EduQuestData.getCurrentUser();
        if (!user) return;
        const account = document.getElementById("account-area") || document.querySelector(".account");
        if (!account) return;
        const firstName = (user.name || "").split(" ")[0] || "there";
        account.innerHTML = '<span class="account-hint">Hi, ' + firstName + '</span>' +
            '<a href="dashboard.php" class="account-login">Dashboard</a>' +
            '<a href="#" class="account-register" id="logout-link">Logout</a>';
        document.getElementById("logout-link").addEventListener("click", async function(e){
            e.preventDefault();
            try { await EduQuestData.logout(); } catch(err) {}
            window.location.href = "index.html";
        });
    } catch (e) {}
});
