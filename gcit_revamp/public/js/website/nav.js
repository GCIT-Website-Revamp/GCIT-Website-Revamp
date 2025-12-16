document.addEventListener("DOMContentLoaded", () => {

    /* =========================================================
       DESKTOP DROPDOWNS + EXTENDER
    ========================================================= */
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
        menu.style.opacity = "0";

        // Force layout so height is measurable
        menu.getBoundingClientRect();

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

        setTimeout(() => {
            menu.style.visibility = "hidden";
        }, 200);

        activeDropdown = null;
        activeWrapper = null;
    }

    /* =========================================================
       MOBILE MAIN NAV (TOP SLIDE – TRANSFORM ONLY)
    ========================================================= */
    const topNav = document.getElementById("miniTopNav");
    const toggle = document.getElementById("miniNavToggle");

    if (topNav && toggle) {
        const menuItems = topNav.querySelectorAll("label, a, h1");

        gsap.set(topNav, { y: "-100%" });

        const openTL = gsap.timeline({ paused: true })
            .to(topNav, {
                y: 0,
                duration: 0.35,
                ease: "power2.out"
            })
            .from(menuItems, {
                y: -10,
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

});
