document.addEventListener("DOMContentLoaded", () => {
let lockedLeft = null;
let lockedWidth = null;

function lockHorizontalPosition() {
  const rect = column.getBoundingClientRect();
  lockedLeft = rect.left + window.scrollX;
  lockedWidth = rect.width;
}

lockHorizontalPosition();

window.addEventListener("resize", () => {
  lockHorizontalPosition();
});
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

  function updateStickyFilter() {
    if (window.innerWidth < DESKTOP_BREAKPOINT) return;

    const OFFSET = getNavOffset();

    const boundaryRect = stickyBoundary.getBoundingClientRect();
    const filterHeight = filter.offsetHeight;

    const startFix = boundaryRect.top <= OFFSET;
    const endFix = boundaryRect.bottom <= filterHeight + OFFSET;

    if (startFix && !endFix) {
      // 🔒 Fixed
      filter.style.position = "fixed";
      filter.style.top = OFFSET + "px";
      filter.style.left = lockedLeft + "px";
      filter.style.width = lockedWidth + "px";
    }
    else if (endFix) {
      // 🛑 Stop at bottom
      filter.style.position = "absolute";
      filter.style.top =
        stickyBoundary.offsetHeight - filterHeight + "px";
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

  console.log("Cards found:", cards.length);

  if (!filterWrapper || !cards.length) {
    console.warn("Filter or cards not found");
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
