const form = document.getElementById("guess-form");

const input = document.getElementById("guess-input");

const feedback = document.getElementById("feedback");

const scoreEl = document.getElementById("score");

const mapContainer = document.getElementById("map-container");

const giveUpBtn = document.getElementById("give-up-btn");

const restartBtn = document.getElementById("restart-btn");

const endScreen = document.getElementById("end-screen");

const endTitle = document.getElementById("end-title");

const missedList = document.getElementById("missed-list");

const TOTAL_STATES = STATES.length;

let guessedStates = [];
let scoreSaved = false;

form.addEventListener("submit", function(event) {
    event.preventDefault();
    const guess = input.value.trim();
    input.value = "";
    input.focus();
    if (guess === "") return;
    const match = STATES.find(state => state.name.toLowerCase() === guess.toLowerCase());
    if (!match) {
        showFeedback(`"${guess}" isn't a state I know about. Try again!`, false);
        return;
    }
    if (guessedStates.includes(match.name)) {
        showFeedback(`You already found ${match.name}.`, false);
        return;
    }
    guessedStates.push(match.name);
    placeLabel(match);
    showFeedback(`Correct — ${match.name}.`, true);
    updateScore();
    if (guessedStates.length === TOTAL_STATES) {
        endGame(true);
    }
});

giveUpBtn.addEventListener("click", function() {
    endGame(false);
});

restartBtn.addEventListener("click", function() {
    guessedStates = [];
    scoreSaved = false;
    updateScore();
    showFeedback("", true);
    document.querySelectorAll(".state-label").forEach(el => el.remove());
    endScreen.classList.add("hidden");
    restartBtn.classList.add("hidden");
    giveUpBtn.classList.remove("hidden");
    form.classList.remove("hidden");
    input.disabled = false;
    input.focus();
});

function placeLabel(state) {
    const label = document.createElement("span");
    label.classList.add("state-label");
    label.textContent = state.name;
    label.style.left = state.left + "%";
    label.style.top = state.top + "%";
    mapContainer.appendChild(label);
}

function showFeedback(message, isGood) {
    feedback.textContent = message;
    feedback.classList.toggle("good", isGood);
    feedback.classList.toggle("bad", !isGood);
}

function updateScore() {
    scoreEl.textContent = `${guessedStates.length} / ${TOTAL_STATES}`;
}

function endGame(won) {
    if (!scoreSaved) {
        scoreSaved = true;
        if (typeof EduQuestData !== "undefined") EduQuestData.saveScore("states", guessedStates.length);
    }
    const missed = STATES.filter(s => !guessedStates.includes(s.name));
    endTitle.textContent = won ? "All 28 states, correctly named." : `Game over — you found ${guessedStates.length} out of ${TOTAL_STATES}`;
    missedList.innerHTML = "";
    missed.forEach(state => {
        const li = document.createElement("li");
        li.textContent = state.name;
        missedList.appendChild(li);
    });
    endScreen.classList.remove("hidden");
    form.classList.add("hidden");
    giveUpBtn.classList.add("hidden");
    restartBtn.classList.remove("hidden");
    input.disabled = true;
}