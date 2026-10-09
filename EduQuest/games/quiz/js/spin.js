const wheel = document.getElementById("wheel");

const spinbutton = document.getElementById("spinbutton");

const result = document.getElementById("result");

const topics = [ "Indian Geography", "Indian History", "Indian Polity & Constitution", "Indian Culture & Heritage", "Indian Sports", "India General Knowledge" ];

const topicKeys = [ "geography", "history", "polity", "culture", "sports", "gk" ];

let rotation = 0;

spinbutton.addEventListener("click", function() {
    let randomindex = Math.floor(Math.random() * topics.length);
    let selectedtopic = topics[randomindex];
    let selectedkey = topicKeys[randomindex];
    let centerAngle = randomindex * 60 + 30;
    let currentRotation = rotation % 360;
    let requiredRotation = (360 - (currentRotation + centerAngle) % 360) % 360;
    rotation += 1800 + requiredRotation;
    wheel.style.transform = `rotate(${rotation}deg)`;
    const refreshbutton = document.getElementById("refreshbutton");
    refreshbutton.addEventListener("click", function() {
        location.reload();
    });
    setTimeout(function() {
        result.innerHTML = "Heyyy!! You got " + selectedtopic;
    }, 4e3);
    setTimeout(function() {
        window.location.href = "quiz.html?topic=" + selectedkey;
    }, 6e3);
});