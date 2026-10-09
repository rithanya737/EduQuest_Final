const GAME_INFO = [
    { key:"states", icon:"🗺️", name:"Map Challenge", href:"../games/states/index.html" },
    { key:"crossword", icon:"📝", name:"Crossword Challenge", href:"../games/crossword/index.html" },
    { key:"quiz", icon:"🎡", name:"Quiz Challenge", href:"../games/quiz/index.html" },
    { key:"scramble", icon:"🔤", name:"Word Scramble", href:"../games/scramble/index.html" },
    { key:"hangman", icon:"🕵️", name:"Personality Guess", href:"../games/hangman/index.html" },
    { key:"monuments", icon:"🃏", name:"Flip Card Match", href:"../games/monuments/index.html" }
];

document.addEventListener("DOMContentLoaded", async function(){
    try {
        const result=await EduQuestData.getDashboard();
        if(!result.ok){window.location.href="login.php";return;}
        renderWelcome(result.user);
        renderStats(result.stats);
        renderGameGrid(result.stats);
        renderBadges(result.stats);
        setupLogout();
        loadLeaderboard();
    } catch(e) {
        const el=document.getElementById("dash-welcome");
        if(el) el.textContent="Unable to load your dashboard.";
    }
});
function renderWelcome(user){
    const first=(user.name||"").split(" ")[0]||"there";
    document.getElementById("dash-welcome").textContent="Welcome back, "+first+"!";
    document.getElementById("dash-avatar").textContent=(user.name||"?").trim().charAt(0).toUpperCase();
    const joinedEl=document.getElementById("dash-joined");
    if(user.joined_at){const joined=new Date(user.joined_at.replace(" ","T"));if(!isNaN(joined)) joinedEl.textContent="Member since "+joined.toLocaleDateString(undefined,{year:"numeric",month:"long",day:"numeric"});}
}
function renderStats(data){
    document.getElementById("stat-current-streak").textContent=data.streak.current;
    document.getElementById("stat-longest-streak").textContent=data.streak.longest;
    document.getElementById("stat-total-plays").textContent=data.totalPlays;
    const tried=EduQuestData.GAME_KEYS.filter(k=>data.gamesPlayed[k]&&data.gamesPlayed[k].plays>0).length;
    document.getElementById("stat-games-tried").textContent=tried+"/"+EduQuestData.GAME_KEYS.length;
}
function renderGameGrid(data){
    const grid=document.getElementById("dash-game-grid"); grid.innerHTML="";
    GAME_INFO.forEach(function(game){
        const item=data.gamesPlayed[game.key]||{plays:0,bestScore:0};
        const card=document.createElement("a"); card.className="dash-game-card"; card.href=game.href;
        card.innerHTML='<span class="dash-game-icon">'+game.icon+'</span><span class="dash-game-name">'+game.name+'</span><span class="dash-game-count">'+(item.plays===0?"Not played yet":item.plays+(item.plays===1?" play":" plays"))+ ' · Best: '+item.bestScore+'</span><span class="dash-game-cta">Play <span aria-hidden="true">→</span></span>';
        grid.appendChild(card);
    });
}
function renderBadges(data){
    const row=document.getElementById("badge-row"); row.innerHTML="";
    const tried=EduQuestData.GAME_KEYS.filter(k=>data.gamesPlayed[k]&&data.gamesPlayed[k].plays>0).length;
    const badges=[{icon:"🌱",name:"Getting Started",earned:data.totalPlays>=1},{icon:"🧭",name:"Explorer",earned:tried>=3},{icon:"🗺️",name:"Completionist",earned:tried>=GAME_INFO.length},{icon:"🔥",name:"3-Day Streak",earned:data.streak.longest>=3},{icon:"🏆",name:"7-Day Streak",earned:data.streak.longest>=7},{icon:"💯",name:"Century Club",earned:data.totalPlays>=100}];
    badges.forEach(function(b){const el=document.createElement("div");el.className="badge"+(b.earned?" earned":" locked");el.innerHTML='<span class="badge-icon">'+b.icon+'</span><span class="badge-name">'+b.name+'</span>';row.appendChild(el);});
}
function setupLogout(){const link=document.getElementById("logout-link");if(!link)return;link.addEventListener("click",async function(e){e.preventDefault();try{await EduQuestData.logout();}catch(err){}window.location.href="index.html";});}

async function loadLeaderboard(){
    const box=document.getElementById("leaderboard"); if(!box)return;
    try {
        const result=await EduQuestData.getLeaderboard();
        if(!result.ok || !result.leaderboard.length){box.innerHTML='<p>No scores yet. Be the first to play!</p>';return;}
        box.innerHTML=result.leaderboard.map(function(row,index){
            return '<div class="dash-game-card"><span class="dash-game-icon">'+(index<3?["🥇","🥈","🥉"][index]:(index+1))+ '</span><span class="dash-game-name">'+row.name+'</span><span class="dash-game-count">Total score: '+row.total_score+' · Games: '+row.games_played+'</span></div>';
        }).join("");
    } catch(e) {}
}
