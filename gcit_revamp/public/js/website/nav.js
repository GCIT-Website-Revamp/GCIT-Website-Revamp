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


// Search js
const searchWrapper = document.querySelector(".searchWrapper");
const searchInput = document.querySelector(".searchInput");

// Open search
searchWrapper.addEventListener("click", (e) => {
    searchWrapper.classList.add("active");
    searchInput.focus();
    e.stopPropagation();
});

// Close on outside click
document.addEventListener("click", () => {
    searchWrapper.classList.remove("active");
    searchInput.value = "";
});

// Close when pressing ESC
document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
        searchWrapper.classList.remove("active");
        searchInput.value = "";
    }
});

document.addEventListener("DOMContentLoaded", () => {

    const topNav = document.getElementById("miniTopNav");
    const toggle = document.getElementById("miniNavToggle");

    const menuItems = document.querySelectorAll(
        "#miniTopNav label, #miniTopNav a, #miniTopNav h1"
    );

    const openTL = gsap.timeline({ paused: true });
    openTL.timeScale(1);   // normal speed for opening
    openTL
        .to(topNav, {
            top: 0,
            duration: 0.3,
            ease: "power2.out"
        })
        .from(menuItems, {
            y: -10,
            opacity: 0,
            stagger: 0.06,
            duration: 0.35,
            ease: "power2.out"
        }, "-=0.1");

    toggle.addEventListener("change", () => {
        if (toggle.checked) {
            openTL.restart();
        } else {
            openTL.vars.defaults = { ease: "power1.inOut" };

            // openTL.timeScale(1.8); // 1.8x faster exit animation
            openTL.reverse();     
   }
    });
});


// SUBMENU ANIMATIONS ----------------------------------------
// 1️⃣ SUBMENU ELEMENT MAP
const subMenus = {
    miniAcademics: document.querySelector(".miniAcademicsWrapper"),
    miniAbout: document.querySelector(".miniAboutWrapper"),
    miniStudents: document.querySelector(".miniStudentWrapper"),
    miniTechImpact: document.querySelector(".miniTechImpactWrapper"),
    miniUpdates: document.querySelector(".miniUpdatesWrapper")
};

// 2️⃣ STORAGE FOR INDIVIDUAL TIMELINES
const submenuTL = {};

// 3️⃣ SUBMENU LOOP (RIGHT → CENTER → RIGHT)
for (let id in subMenus) {

    const submenu = subMenus[id];
    const checkbox = document.getElementById(id);

    if (!submenu) {
        console.warn(`⚠ Submenu wrapper not found for ID: ${id}`);
        continue;
    }
    if (!checkbox) {
        console.warn(`⚠ Checkbox not found for submenu ID: ${id}`);
        continue;
    }

    submenuTL[id] = gsap.timeline({ paused: true });

    submenuTL[id]
        .to(submenu, {
            left: 0,
            duration: 0.35,
            ease: "power2.out"
        })
        .from(submenu.querySelectorAll("h1, a, label"), {
            x: 20,
            opacity: 0,
            duration: 0.25,
            stagger: 0.05,
            ease: "power2.out"
        }, "-=0.15");

    checkbox.addEventListener("change", () => {
        if (checkbox.checked) {
            submenuTL[id].timeScale(1);
            submenuTL[id].restart();
        } else {
            submenuTL[id].timeScale(2);
            gsap.to(submenu, {
                left: "100%",
                duration: 0.25,
                ease: "power2.in"
            });
        }
    });
}

// const navToggle = document.getElementById("miniNavToggle");

// navToggle.addEventListener("change", () => {
//     if (navToggle.checked) {
//         document.body.classList.add("no-scroll");
//     } else {
//         document.body.classList.remove("no-scroll");
//     }
// });
let scrollPosition = 0;

function lockScroll() {
    scrollPosition = window.scrollY;
    document.body.style.position = 'fixed';
    document.body.style.top = `-${scrollPosition}px`;
    document.body.style.width = '100%';
}

function unlockScroll() {
    document.body.style.position = '';
    document.body.style.top = '';
    window.scrollTo(0, scrollPosition);
}


const MOBILE_BREAKPOINT = 780;

const navToggle = document.getElementById("miniNavToggle");
const submenuCheckboxes = [
    document.getElementById("miniAcademics"),
    document.getElementById("miniAbout"),
    document.getElementById("miniStudents"),
    document.getElementById("miniTechImpact"),
    document.getElementById("miniUpdates")
];

// ---- MAIN UPDATE FUNCTION ----
function updateScrollLock() {
    const anySubmenuOpen = submenuCheckboxes.some(cb => cb?.checked);
    const mainNavOpen = navToggle?.checked;

    if (anySubmenuOpen || mainNavOpen) lockScroll();
    else unlockScroll();
}

// Attach checkbox listeners
if (navToggle) navToggle.addEventListener("change", updateScrollLock);
submenuCheckboxes.forEach(cb => cb?.addEventListener("change", updateScrollLock));


window.addEventListener("resize", () => {
    const isDesktop = window.innerWidth >= MOBILE_BREAKPOINT;

    if (isDesktop) {
        // Close all menus when switching to desktop
        if (navToggle) navToggle.checked = false;
        submenuCheckboxes.forEach(cb => cb.checked = false);

        unlockScroll();
    } else {
        // Back to mobile view. Re-evaluate scroll state.
        updateScrollLock();
    }
});
