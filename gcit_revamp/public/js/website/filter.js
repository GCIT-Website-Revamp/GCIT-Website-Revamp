document.addEventListener("DOMContentLoaded", () => {

  /* =========================================================
     CONFIG
  ========================================================= */
  const DESKTOP_BREAKPOINT = 1024;
  const NAV_HEIGHT = 86; // actual nav height in px

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

  let lockedLeft = null;
let lockedWidth = null;

function lockHorizontalPosition() {
  const rect = column.getBoundingClientRect();
  lockedLeft = rect.left + window.scrollX;
  lockedWidth = rect.width;
}

// lockHorizontalPosition();

window.addEventListener("resize", () => {
  lockHorizontalPosition();
});
  /* =========================================================
     INLINE-PARENT SAFETY (ROGUE <i> FIX)
  ========================================================= */

  function getStickyBoundary(el) {
    let parent = el.parentElement;

    // Skip inline elements (e.g. injected <i>)
    while (parent && getComputedStyle(parent).display === "inline") {
      parent = parent.parentElement;
    }

    return parent || el.parentElement;
  }

  // True visual boundary for sticky math
  const stickyBoundary = getStickyBoundary(column);

  /* =========================================================
     NAV VISIBILITY TRACKING (CRITICAL)
  ========================================================= */

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
     STICKY FILTER (DESKTOP ONLY, <i> SAFE)
  ========================================================= */

  function getNavOffset() {
    return (
      parseInt(
        getComputedStyle(document.documentElement)
          .getPropertyValue("--nav-visible-height")
      ) || 0
    );
  }

  // function updateStickyFilter() {
  //   if (window.innerWidth < DESKTOP_BREAKPOINT) return;

  //   const OFFSET = getNavOffset();

  //   const boundaryRect = stickyBoundary.getBoundingClientRect();
  //   const filterHeight = filter.offsetHeight;

  //   const startFix = boundaryRect.top <= OFFSET;
  //   const endFix = boundaryRect.bottom <= filterHeight + OFFSET;

  //   if (startFix && !endFix) {
  //     // 🔒 Fixed
  //     filter.style.position = "fixed";
  //     filter.style.top = OFFSET + "px";
  //     filter.style.left = lockedLeft + "px";
  //     filter.style.width = lockedWidth + "px";
  //   }
  //   else if (endFix) {
  //     // 🛑 Stop at bottom
  //     filter.style.position = "absolute";
  //     filter.style.top =
  //       stickyBoundary.offsetHeight - filterHeight + "px";
  //     filter.style.left = "0";
  //     filter.style.width = "100%";
  //   }
  //   else {
  //     // resetFilter();
  //   }
  // }

  function resetFilter() {
    filter.style.position = "relative";
    filter.style.top = "auto";
    filter.style.left = "auto";
    filter.style.width = "100%";
  }

  // window.addEventListener("scroll", updateStickyFilter);
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
    filter.classList.add("active");
    document.body.classList.add("filter-open");
  }

  function closeFilter() {
    column.classList.remove("active");
    filter.classList.remove("active");
    document.body.classList.remove("filter-open");
  }

  filterToggle?.addEventListener("click", openFilter);
  filterClose?.addEventListener("click", closeFilter);
  filterOverlay?.addEventListener("click", closeFilter);

  /* =========================================================
     SAFETY: BREAKPOINT SWITCH RESET
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



document.addEventListener("DOMContentLoaded", () => {

  const filterWrapper = document.querySelector(".filterWrapper");
  const cards = document.querySelectorAll(".mainContent .card");


  if (!filterWrapper || !cards.length) {
    return;
  }

  const checkboxes = filterWrapper.querySelectorAll(
    'input[type="checkbox"]'
  );

  const noResultsEl = document.querySelector(".noResults");

function applyFilters() {
  const active = Array.from(checkboxes)
    .filter(cb => cb.checked)
    .map(cb => cb.value.toLowerCase());

  let visibleCount = 0;

  cards.forEach(card => {
    const tag = card.dataset.tag?.toLowerCase();

    const show =
      active.length === 0 || active.includes(tag);

    card.style.display = show ? "flex" : "none";

    if (show) visibleCount++;
  });

  // ✅ No results handling
  if (noResultsEl) {
    noResultsEl.style.display =
      active.length > 0 && visibleCount === 0
        ? "block"
        : "none";
  }
}


  function show(card) {
    card.style.display = "flex";   // important
    card.style.opacity = "1";
    card.style.pointerEvents = "auto";
  }

  function hide(card) {
    card.style.display = "none";
    card.style.pointerEvents = "none";
  }

  checkboxes.forEach(cb => {
    cb.addEventListener("change", () => {

      // Handle "All"
      if (cb.value === "All" && cb.checked) {
        checkboxes.forEach(other => {
          if (other !== cb) other.checked = false;
        });
      }

      if (cb.value !== "All" && cb.checked) {
        const allCb = Array.from(checkboxes)
          .find(c => c.value === "All");
        if (allCb) allCb.checked = false;
      }

      applyFilters();
    });
  });

});
/**
 * Events Page - Sticky Filter Sidebar
 * Uses custom positioning to maintain layout integrity within flex container
 * Note: GSAP pin not used here as it breaks the flex layout structure
 */
document.addEventListener("DOMContentLoaded", () => {
  const DESKTOP_BREAKPOINT = 1024;
  const filter = document.querySelector(".filterWrapper");
  const column = document.querySelector(".filterColumn");
  const section = document.querySelector(".eventsWrapper") || document.querySelector(".facultyWrapper");

  if (!filter || !section || !column) return;

  const NAV_OFFSET = 86;

  function resetFilter() {
    filter.style.position = "";
    filter.style.top = "";
    filter.style.left = "";
    filter.style.width = "";
  }

  function clampFilter() {
    // Only apply on desktop
    if (window.innerWidth < DESKTOP_BREAKPOINT) {
      resetFilter();
      return;
    }

    const sectionRect = section.getBoundingClientRect();
    const filterHeight = filter.offsetHeight;
    const columnRect = column.getBoundingClientRect();

    const start = sectionRect.top <= NAV_OFFSET;
    const end = sectionRect.bottom <= filterHeight + NAV_OFFSET;

    if (!start) {
      // Before sticky starts - relative position
      filter.style.position = "relative";
      filter.style.top = "0";
      filter.style.width = "";
      
      // Unlock parent dimensions
      column.style.minWidth = "";
      column.style.minHeight = "";
    }
    else {
      // Active sticky state (either fixed or absolute at bottom)
      
      // 🔒 Lock parent dimensions ONLY if not already locked
      // This prevents the "collapse" shift when child becomes fixed
      if (!column.style.minWidth) {
         column.style.minWidth = columnRect.width + "px";
         column.style.minHeight = columnRect.height + "px";
      }

      // Ensure filter keeps the same width as its parent
      filter.style.width = columnRect.width + "px";

      if (end) {
        // Stop at section bottom - absolute position
        filter.style.position = "absolute";
        filter.style.top = section.offsetHeight - filterHeight + "px";
      }
      else {
        // Sticky state - fixed position
        filter.style.position = "fixed";
        filter.style.top = NAV_OFFSET + "px";
      }
    }
  }

  window.addEventListener("scroll", clampFilter, { passive: true });
  window.addEventListener("resize", () => {
    if (window.innerWidth < DESKTOP_BREAKPOINT) {
      resetFilter();
    } else {
      clampFilter();
    }
  });
  
  // Initial run
  clampFilter();
});

document.addEventListener("DOMContentLoaded", () => {
  const cards = document.querySelectorAll(".staffProfileWrapper .staff");
  const checkboxes = document.querySelectorAll(".filterWrapper input[type='checkbox']");

  if (!cards.length || !checkboxes.length) return;

  function applyFilters() {
    const active = Array.from(checkboxes)
      .filter(cb => cb.checked)
      .map(cb => cb.value.toLowerCase());

    let visibleCount = 0;

    cards.forEach(card => {
      const tags = JSON.parse(card.dataset.tags || "[]").map(t => t.toLowerCase());

      const show = active.length === 0 || active.some(a => tags.includes(a));

      card.style.display = show ? "flex" : "none";
      if (show) visibleCount++;
    });
  }

  checkboxes.forEach(cb => {
    cb.addEventListener("change", applyFilters);
  });
});
