document.addEventListener("DOMContentLoaded", () => {

    /* =========================================================
       DESKTOP DROPDOWNS + EXTENDER
    ========================================================= */

    const DESKTOP_BREAKPOINT = 1000;

    const dropdowns = document.querySelectorAll(".dropDownWrapper");
    const extender = document.querySelector(".dropDownExtender");

    let activeDropdown = null;
    let activeWrapper = null;

   dropdowns.forEach(wrapper => {
    const link = wrapper.querySelector(".dropDownLink");
    const menu = wrapper.querySelector(".dropDownContent");
    if (!link || !menu) return;

    /* =========================
       DESKTOP → HOVER
    ========================= */
    wrapper.addEventListener("mouseenter", () => {
        if (window.innerWidth < DESKTOP_BREAKPOINT) return;

        if (activeDropdown && activeDropdown !== menu) {
            closeDropdown(activeDropdown, activeWrapper);
        }

        openDropdown(menu, wrapper);
    });

    wrapper.addEventListener("mouseleave", () => {
        if (window.innerWidth < DESKTOP_BREAKPOINT) return;

        closeDropdown(menu, wrapper);
    });

    /* =========================
       MOBILE → CLICK
    ========================= */
    link.addEventListener("click", (e) => {
        if (window.innerWidth >= DESKTOP_BREAKPOINT) return;

        e.stopPropagation();

        if (activeDropdown === menu) {
            closeDropdown(menu, wrapper);
            return;
        }

        if (activeDropdown) {
            closeDropdown(activeDropdown, activeWrapper);
        }

        openDropdown(menu, wrapper);
    });
});

    document.addEventListener("click", () => {
        if (activeDropdown) closeDropdown(activeDropdown, activeWrapper);
    });

function openDropdown(menu, wrapper) {
    wrapper.classList.add("activeNav");

    menu.style.visibility = "visible";
    menu.style.pointerEvents = "auto";

    // Reset
    gsap.set(menu, { opacity: 1 });

    const items = getDropdownItems(menu);

    // Height logic (keep yours)
    menu.getBoundingClientRect();
    const dropdownHeight = menu.offsetHeight;
    const rem = parseFloat(getComputedStyle(document.documentElement).fontSize);
    extender.style.height = (dropdownHeight - rem) + "px";

    // ✨ Slower, smoother ENTER
    gsap.fromTo(
        items,
        { y: 8, opacity: 0 },
        {
            y: 0,
            opacity: 1,
            duration: 0.35,          // 👈 slower enter
            ease: "power2.out",
            stagger: 0.04
        }
    );

    activeDropdown = menu;
    activeWrapper = wrapper;
}

   function closeDropdown(menu, wrapper) {
    wrapper.classList.remove("activeNav");
    extender.style.height = "0px";

    const items = getDropdownItems(menu);

    // ⚡ Faster EXIT
    gsap.to(items, {
        y: 4,
        opacity: 0,
        duration: 0.05,            // 👈 faster exit
        ease: "power2.in",
        stagger: {
            each: 0.02,
            from: "end"
        }
    });

    gsap.to(menu, {
        opacity: 0,
        duration: 0.15,
        onComplete: () => {
            menu.style.visibility = "hidden";
            menu.style.pointerEvents = "none";
        }
    });

    activeDropdown = null;
    activeWrapper = null;
}
function getDropdownItems(menu) {
    return menu.querySelectorAll("a, li, span, label");
}


    /* =========================================================
       MOBILE MAIN NAV (TOP SLIDE – TRANSFORM ONLY)
    ========================================================= */
    const topNav = document.getElementById("miniTopNav");
    const toggle = document.getElementById("miniNavToggle");

    if (topNav && toggle) {
        const menuItems = topNav.querySelectorAll("label, a, h1");

        gsap.set(topNav, { x: "100%" });

       const openTL = gsap.timeline({ paused: true })
        .to(topNav, {
            x: 0,
            duration: 0.35,
            ease: "power2.out"
        })
        .from(menuItems, {
            x: 20,
            opacity: 0,
            stagger: 0.06,
            duration: 0.25,
            ease: "power2.out"
        }, "-=0.1");

        toggle.addEventListener("change", () => {
            toggle.checked ? openTL.restart() : openTL.reverse();
            updateScrollLock();
        });
    }

   /* =========================================================
   SUBMENUS (RIGHT → CENTER USING TRANSFORMS)
   UPDATED FOR NEW MOBILE TABS
========================================================= */
const subMenus = {
    miniStudy: document.querySelector(".miniStudyWrapper"),
    miniAbout: document.querySelector(".miniAboutWrapper"),
    miniInitiative: document.querySelector(".miniInitiativeWrapper")
};

const submenuTL = {};

Object.keys(subMenus).forEach(id => {
    const submenu = subMenus[id];
    const checkbox = document.getElementById(id);

    if (!submenu || !checkbox) {
        console.warn(`Missing submenu or checkbox for ${id}`);
        return;
    }

    // Start off-screen
    gsap.set(submenu, { x: "100%" });

    submenuTL[id] = gsap.timeline({ paused: true })
        .to(submenu, {
            x: 0,
            duration: 0.35,
            ease: "power2.out"
        })
        .from(submenu.querySelectorAll("h1, a, label"), {
            x: 20,
            opacity: 0,
            stagger: 0.05,
            duration: 0.25,
            ease: "power2.out"
        }, "-=0.15");

    checkbox.addEventListener("change", () => {
        if (checkbox.checked) {
            submenuTL[id].restart();
        } else {
            gsap.to(submenu, {
                x: "100%",
                duration: 0.25,
                ease: "power2.in"
            });
        }
        updateScrollLock();
    });
});

    /* =========================================================
       SCROLL LOCK (GLOBAL)
    ========================================================= */
    let scrollPosition = 0;

    function lockScroll() {
        scrollPosition = window.scrollY;
        document.body.style.position = "fixed";
        document.body.style.top = `-${scrollPosition}px`;
        document.body.style.width = "100%";
    }

    function unlockScroll() {
        document.body.style.position = "";
        document.body.style.top = "";
        document.body.style.width = "";
        window.scrollTo(0, scrollPosition);
    }

    function updateScrollLock() {
    const anySubmenuOpen = Object.keys(subMenus)
        .some(id => document.getElementById(id)?.checked);

    const mainNavOpen = document.getElementById("miniNavToggle")?.checked;

    (anySubmenuOpen || mainNavOpen) ? lockScroll() : unlockScroll();
}


    /* =========================================================
       BREAKPOINT SAFETY
    ========================================================= */
    const MOBILE_BREAKPOINT = 780;

    window.addEventListener("resize", () => {
        if (window.innerWidth >= MOBILE_BREAKPOINT) {
            if (toggle) toggle.checked = false;
            Object.keys(subMenus).forEach(id => {
                const cb = document.getElementById(id);
                if (cb) cb.checked = false;
            });
            unlockScroll();
        }
    });

    /* =========================================================
       SEARCH UI
    ========================================================= */
    const searchWrapper = document.querySelector(".searchWrapper");
    const searchInput = document.querySelector(".searchInput");

    if (searchWrapper && searchInput) {
        searchWrapper.addEventListener("click", (e) => {
            searchWrapper.classList.add("active");
            searchInput.focus();
            e.stopPropagation();
        });

        document.addEventListener("click", () => {
            searchWrapper.classList.remove("active");
            searchInput.value = "";
        });

        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") {
                searchWrapper.classList.remove("active");
                searchInput.value = "";
            }
        });
    }

    /* =========================================================
   NAV HIDE ON SCROLL (DESKTOP ONLY)
========================================================= */

const nav = document.querySelector("nav.fullSize");

if (nav) {
    let lastScrollY = window.scrollY;
    let isHidden = false;

    const showNav = () => {
        gsap.to(nav, {
            y: 0,
            duration: 0.3,
            ease: "power2.out"
        });
        isHidden = false;
    };

    const hideNav = () => {
        gsap.to(nav, {
            y: "-100%",
            duration: 0.3,
            ease: "power2.out"
        });
        isHidden = true;
    };


    window.addEventListener("scroll", () => {
        if (window.innerWidth < DESKTOP_BREAKPOINT) return;

        const currentScrollY = window.scrollY;

        if (Math.abs(currentScrollY - lastScrollY) < 10) return;

        if (currentScrollY > lastScrollY && currentScrollY > 120) {
            if (!isHidden) {
                gsap.to(nav, {
                    y: "-100%",
                    duration: 0.2,
                    ease: "power2.out"
                });
                isHidden = true;
            }
        } else {
            if (isHidden) {
                gsap.to(nav, {
                    y: 0,
                    duration: 0.2,
                    ease: "power2.out"
                });
                isHidden = false;
            }
        }

        lastScrollY = currentScrollY;
    });
    }


    /* =========================================================
   MOBILE NAV HIDE / SHOW ON SCROLL
========================================================= */
const miniNav = document.querySelector("nav.mini");
const miniToggle = document.getElementById("miniNavToggle");

let lastScrollYMobile = window.scrollY;
let mobileHidden = false;

function showMiniNav() {
    gsap.to(miniNav, {
        y: 0,
        duration: 0.2,
        ease: "power2.out"
    });
    mobileHidden = false;
}

function hideMiniNav() {
    gsap.to(miniNav, {
        y: "-100%",
        duration: 0.2,
        ease: "power2.out"
    });
    mobileHidden = true;
}

window.addEventListener("scroll", () => {
    // Only mobile/tablet
    if (window.innerWidth >= DESKTOP_BREAKPOINT) return;

    // If menu overlay is open → do nothing
    if (miniToggle?.checked) return;

    const currentScrollY = window.scrollY;

    if (Math.abs(currentScrollY - lastScrollYMobile) < 8) return;

    // Scroll down → hide
    if (currentScrollY > lastScrollYMobile && currentScrollY > 80) {
        if (!mobileHidden) hideMiniNav();
    }
    // Scroll up → show
    else {
        if (mobileHidden) showMiniNav();
    }

    lastScrollYMobile = currentScrollY;
});
});


document.addEventListener("DOMContentLoaded", () => {
    const menuToggle = document.getElementById("courseMenuToggle");
    const menuLinks = document.querySelectorAll(".sideMenu a");

    menuLinks.forEach(link => {
        link.addEventListener("click", () => {
            if (menuToggle.checked) {
                menuToggle.checked = false;
            }
        });
    });
});