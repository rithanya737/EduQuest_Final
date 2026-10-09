/* ===========================================================
   EduQuest — Game Guide page interactions
   =========================================================== */

document.addEventListener("DOMContentLoaded", function () {
    const detailsEls = document.querySelectorAll(".guide-details");
    const expandBtn = document.getElementById("expand-all");
    const collapseBtn = document.getElementById("collapse-all");

    if (expandBtn) {
        expandBtn.addEventListener("click", function () {
            detailsEls.forEach(function (d) { d.open = true; });
        });
    }

    if (collapseBtn) {
        collapseBtn.addEventListener("click", function () {
            detailsEls.forEach(function (d) { d.open = false; });
        });
    }
});
