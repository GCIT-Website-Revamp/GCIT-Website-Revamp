document.addEventListener("DOMContentLoaded", ()=> {
    const dropdowns = document.querySelectorAll(".dropDownWrapper");
const extender = document.querySelector(".dropDownExtender");

let activeDropdown = null;
let activeWrapper = null;

dropdowns.forEach(wrapper => {
    const link = wrapper.querySelector(".dropDownLink");
    const menu = wrapper.querySelector(".dropDownContent");

    if (!link || !menu) return;

    link.addEventListener("click", (e) => {
        e.stopPropagation();

        // If clicking the same open dropdown → close it
        if (activeDropdown === menu) {
            closeDropdown(menu, wrapper);
            return;
        }

        // Close previous dropdown
        if (activeDropdown) {
            closeDropdown(activeDropdown, activeWrapper);
        }

        // Open new dropdown
        openDropdown(menu, wrapper);
    });
});

document.addEventListener("click", () => {
    if (activeDropdown) {
        closeDropdown(activeDropdown, activeWrapper);
    }
});

// ------------------ Helper Functions ------------------ //
function openDropdown(menu, wrapper) {
    wrapper.classList.add("activeNav");

    menu.style.visibility = "visible";
    menu.style.pointerEvents = "auto";
    menu.style.opacity = "0";

    menu.getBoundingClientRect(); // forces layout update

    const dropdownHeight = menu.offsetHeight;

    const rem = parseFloat(getComputedStyle(document.documentElement).fontSize);
    const adjustedHeight = dropdownHeight - (2 * rem);

    extender.style.height = adjustedHeight + "px";

    requestAnimationFrame(() => {
        menu.style.opacity = "1";
    });

    activeDropdown = menu;
    activeWrapper = wrapper;
}


function closeDropdown(menu, wrapper) {
    wrapper.classList.remove("activeNav");
    extender.style.height = "0px";

    menu.style.opacity = "0";
    menu.style.pointerEvents = "none";

    // Hide after fade-out
    setTimeout(() => {
        menu.style.visibility = "hidden";
    }, 200);

    activeDropdown = null;
    activeWrapper = null;
}

})