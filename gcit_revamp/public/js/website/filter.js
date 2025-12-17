

// document.addEventListener("DOMContentLoaded", () => {
//     const filterWrapper = document.querySelector(".filterWrapper");
//     const filterToggle  = document.querySelector(".filterToggle");
//     const filterClose   = document.querySelector(".filterClose");
    
//     const FILTER_BREAKPOINT = 1024;
    
//     function shouldUseDrawer() {
//       return window.innerWidth <= 1024;
//     }
    
//     function resetForDesktop() {
//       gsap.killTweensOf(filterWrapper);
    
//       // remove ALL GSAP inline styles
//       gsap.set(filterWrapper, {
//         clearProps: "all"
//       });
    
//       filterWrapper.classList.remove("active");
//       filterWrapper.style.pointerEvents = "auto";
//     }
//   if (!filterWrapper) return;

//   const BP = 1024;

//  function forceClosed() {
//   gsap.killTweensOf(filterWrapper);

//   if (!shouldUseDrawer()) {
//     // desktop: sidebar visible normally
//     gsap.set(filterWrapper, { clearProps: "transform" });
//     filterWrapper.style.pointerEvents = "auto";
//     return;
//   }

//   // mobile/tablet: off-canvas
//   filterWrapper.classList.remove("active");
//   gsap.set(filterWrapper, { xPercent: 100 });
//   filterWrapper.style.pointerEvents = "none";
//   safeUnlockScroll();
// }

//   function openDrawer() {
//       if (!shouldUseDrawer()) return;

//     filterWrapper.classList.add("active");
//     filterWrapper.style.pointerEvents = "auto";
//     lockScroll?.();

//     // animate panel in
//     gsap.to(filterWrapper, {
//       xPercent: 0,
//       duration: 0.35,
//       ease: "power2.out"
//     });

//     // animate content in (stagger)
//     gsap.fromTo(
//       filterWrapper.querySelectorAll(".filterCloseWrapper, .headerWrapper h1, .filterHeader h1, .filter"),
//       { x: 20, opacity: 0 },
//       { x: 0, opacity: 1, duration: 0.25, stagger: 0.06, ease: "power2.out", delay: 0.1 }
//     );
//   }

//   function closeDrawer() {
//     gsap.to(filterWrapper, {
//       xPercent: 100,
//       duration: 0.25,
//       ease: "power2.in",
//       onComplete: () => {
//         filterWrapper.classList.remove("active");
//         filterWrapper.style.pointerEvents = "none";
//         unlockScroll?.();
//       }
//     });
//   }

//   // ✅ Always closed on refresh/page restore (including bfcache)
//   window.addEventListener("load", () => {
//     if (window.innerWidth <= BP) forceClosed();
//      if (window.innerWidth > FILTER_BREAKPOINT) {
//     resetForDesktop();
//   }
//   });

//   window.addEventListener("pageshow", (e) => {
//     // pageshow fires on normal load AND bfcache restore
//     if (window.innerWidth <= BP) forceClosed();
//   });

//   // open / close
//   filterToggle?.addEventListener("click", openDrawer);
//   filterClose?.addEventListener("click", closeDrawer);

//   // ESC to close
//   document.addEventListener("keydown", (e) => {
//     if (e.key === "Escape" && filterWrapper.classList.contains("active")) {
//       closeDrawer();
//     }
//   });

//   // click outside to close
//   document.addEventListener("click", (e) => {
//     if (!filterWrapper.classList.contains("active")) return;
//     if (filterWrapper.contains(e.target)) return;
//     if (filterToggle && filterToggle.contains(e.target)) return;
//     closeDrawer();
//   });

//   // resize safety
//   window.addEventListener("resize", () => {
//     if (window.innerWidth > BP) {
//       // on desktop, force it closed (since sidebar shows normally)
//       forceClosed();
//     } else {
//       // keep closed by default when returning to small screens
//       forceClosed();
//     }
//      if (window.innerWidth > FILTER_BREAKPOINT) {
//     resetForDesktop();
//   }
//   });
// });
document.addEventListener("DOMContentLoaded", () => {

    /* =========================================================
       CONFIG
    ========================================================= */
    const DESKTOP_BREAKPOINT = 1024;
    const NAV_HEIGHT = 86; // real nav height

    /* =========================================================
       ELEMENTS
    ========================================================= */
    const nav = document.querySelector("nav.fullSize");
    const filter = document.querySelector(".filterWrapper");
    const column = document.querySelector(".filterColumn");

    const filterToggle = document.querySelector(".filterToggle");
    const filterClose = document.querySelector(".filterClose");
    const filterOverlay = document.querySelector(".filterOverlay");

    if (!filter || !column) return;

    /* =========================================================
       NAV VISIBILITY TRACKING (CRITICAL FIX)
    ========================================================= */

    // CSS var reflects *visible* nav height
    document.documentElement.style.setProperty(
        "--nav-visible-height",
        NAV_HEIGHT + "px"
    );

    let navHidden = false;

    function setNavVisibleHeight(value) {
        document.documentElement.style.setProperty(
            "--nav-visible-height",
            value + "px"
        );
    }

    function showNav() {
        if (!nav || !navHidden) return;

        gsap.to(nav, {
            y: 0,
            duration: 0.35,
            ease: "power2.out",
            onStart: () => setNavVisibleHeight(NAV_HEIGHT)
        });

        navHidden = false;
    }

    function hideNav() {
        if (!nav || navHidden) return;

        gsap.to(nav, {
            y: "-100%",
            duration: 0.35,
            ease: "power2.out",
            onStart: () => setNavVisibleHeight(0)
        });

        navHidden = true;
    }

    /* =========================================================
       DESKTOP NAV HIDE / SHOW ON SCROLL
    ========================================================= */

    let lastScrollY = window.scrollY;

    window.addEventListener("scroll", () => {
        if (window.innerWidth < DESKTOP_BREAKPOINT) return;

        const currentScrollY = window.scrollY;

        if (Math.abs(currentScrollY - lastScrollY) < 10) return;

        if (currentScrollY > lastScrollY && currentScrollY > 120) {
            hideNav();
        } else {
            showNav();
        }

        lastScrollY = currentScrollY;
    });

    /* =========================================================
       STICKY FILTER LOGIC (DESKTOP ONLY)
    ========================================================= */

    function getNavOffset() {
        return (
            parseInt(
                getComputedStyle(document.documentElement)
                    .getPropertyValue("--nav-visible-height")
            ) || 0
        );
    }

    function updateStickyFilter() {
        if (window.innerWidth < DESKTOP_BREAKPOINT) return;

        const OFFSET = getNavOffset();

        const colRect = column.getBoundingClientRect();
        const filterHeight = filter.offsetHeight;

        const startFix = colRect.top <= OFFSET;
        const endFix = colRect.bottom <= filterHeight + OFFSET;

        if (startFix && !endFix) {
            filter.style.position = "fixed";
            filter.style.top = OFFSET + "px";
            filter.style.left = colRect.left + "px";
            filter.style.width = column.offsetWidth + "px";
        }
        else if (endFix) {
            filter.style.position = "absolute";
            filter.style.top = (column.offsetHeight - filterHeight) + "px";
            filter.style.left = "0";
            filter.style.width = "100%";
        }
        else {
            resetFilter();
        }
    }

    function resetFilter() {
        filter.style.position = "relative";
        filter.style.top = "auto";
        filter.style.left = "auto";
        filter.style.width = "100%";
    }

    window.addEventListener("scroll", updateStickyFilter);
    window.addEventListener("resize", () => {
        if (window.innerWidth < DESKTOP_BREAKPOINT) {
            resetFilter();
        }
        updateStickyFilter();
    });

    /* =========================================================
       MOBILE FILTER DRAWER
    ========================================================= */

    function openFilter() {
        column.classList.add("active");
        document.body.classList.add("filter-open");
    }

    function closeFilter() {
        column.classList.remove("active");
        document.body.classList.remove("filter-open");
    }

    filterToggle?.addEventListener("click", openFilter);
    filterClose?.addEventListener("click", closeFilter);
    filterOverlay?.addEventListener("click", closeFilter);

    /* =========================================================
       SAFETY: RESET WHEN SWITCHING BREAKPOINTS
    ========================================================= */

    let wasDesktop = window.innerWidth >= DESKTOP_BREAKPOINT;

    window.addEventListener("resize", () => {
        const isDesktop = window.innerWidth >= DESKTOP_BREAKPOINT;

        if (isDesktop !== wasDesktop) {
            closeFilter();
            resetFilter();
        }

        wasDesktop = isDesktop;
    });

});
