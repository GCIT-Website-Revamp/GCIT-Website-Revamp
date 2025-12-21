document.addEventListener("DOMContentLoaded", () => {
    gsap.config({ nullTargetWarn: false });

    gsap.registerPlugin(ScrollTrigger);

    const OFFSET = 170; // sticky header height

    const sections = document.querySelectorAll(
        "#why-this-program, #what-would-i-learn, #program-structure, #career-prospects, \
         #year1-sem1, #year1-sem2, #year2-sem1, #year2-sem2, \
         #year3-sem1, #year3-sem2, #year4-sem1, #year4-sem2"
    );

    const menuLinks = document.querySelectorAll(".sideMenu a[href^='#']");

    /* -------------------------------
       ScrollSpy (Highlight Sync)
    ------------------------------- */
    sections.forEach(section => {
        ScrollTrigger.create({
            trigger: section,
            start: `top top+=${OFFSET}`,
            end: `bottom top+=${OFFSET}`,
            onEnter: () => setActive(section.id),
            onEnterBack: () => setActive(section.id),
        });
    });

    function setActive(id) {
        menuLinks.forEach(link => {
            link.classList.toggle("active", link.getAttribute("href") === `#${id}`);
        });
    }

    /* -------------------------------
       Click Handler + Offset Scroll
       + Auto-open Dropdown
    ------------------------------- */
    menuLinks.forEach(link => {
        link.addEventListener("click", (e) => {
            e.preventDefault();

            const targetId = link.getAttribute("href").substring(1);
            const target = document.getElementById(targetId);
            if (!target) return;

            // Smooth scroll with offset
            const targetY =
                target.getBoundingClientRect().top +
                window.pageYOffset -
                OFFSET;

            window.scrollTo({
                top: targetY,
                behavior: "smooth"
            });

            // Highlight immediately
            setActive(targetId);

            // ---------- AUTO-OPEN DROPDOWN ----------
            autoOpenDropdown(target);
        });
    });

    /* -------------------------------
       Auto-Open Logic
    ------------------------------- */
    function autoOpenDropdown(section) {
        // Example section: <div id="year1-sem1" class="courseDetailContent moduleDropdown">

        // Find the checkbox inside this section, if it exists
        const checkbox = section.querySelector("input[type='checkbox']");

        if (checkbox) {
            // OPTIONAL — close all other dropdowns first
            document.querySelectorAll(".courseDetailContent input[type='checkbox']").forEach(cb => {
                if (cb !== checkbox) cb.checked = false;
            });

            // Open this one
            checkbox.checked = true;
        }
    }
});

document.addEventListener("DOMContentLoaded", () => {
  const DESKTOP_BREAKPOINT = 1025;

  const container = document.querySelector(".courseDetailsContainer");
  const sideMenu = document.querySelector(".courseDetailsContainer .sideMenu");

  if (!container || !sideMenu) return;

  // Optional: if you already have this CSS var in your project (like your filter code),
  // we’ll use it. Otherwise fallback.
  function getNavOffset() {
    const v = parseInt(
      getComputedStyle(document.documentElement)
        .getPropertyValue("--nav-visible-height")
    );
    return Number.isFinite(v) ? v : 86; // fallback
  }

  // --- Spacer to keep layout from collapsing when sideMenu becomes fixed ---
  let spacer = container.querySelector(".sideMenuSpacer");
  if (!spacer) {
    spacer = document.createElement("div");
    spacer.className = "sideMenuSpacer";
    sideMenu.parentNode.insertBefore(spacer, sideMenu);
  }

  let lockedLeft = 0;
  let lockedWidth = 0;

  function measure() {
    // Reset to natural flow first to measure correctly
    sideMenu.style.position = "relative";
    sideMenu.style.top = "auto";
    sideMenu.style.left = "auto";
    sideMenu.style.width = "";

    // Spacer should match sidebar width in flow
    const rect = sideMenu.getBoundingClientRect();
const containerRect = container.getBoundingClientRect();
lockedLeft = containerRect.left + window.scrollX;    lockedWidth = rect.width;

    spacer.style.width = rect.width + "px";
    spacer.style.height = rect.height + "px";
  }

  function resetDesktop() {
    sideMenu.style.position = "relative";
    sideMenu.style.top = "auto";
    sideMenu.style.left = "auto";
    sideMenu.style.width = "";
    spacer.style.width = "";
    spacer.style.height = "";
  }

  function clamp() {
    if (window.innerWidth < DESKTOP_BREAKPOINT) {
      resetDesktop();
      return;
    }

    const OFFSET = getNavOffset();
    const containerRect = container.getBoundingClientRect();
    const menuHeight = sideMenu.offsetHeight;

    // Start fixing when container hits nav offset
    const startFix = containerRect.top <= OFFSET;

    // Stop fixing when container bottom is above the menu bottom
    const endFix = containerRect.bottom <= OFFSET + menuHeight;

    if (!startFix) {
      // BEFORE section: sit at top of container
      sideMenu.style.position = "absolute";
      sideMenu.style.top = "0px";
      sideMenu.style.left = "0px";
      sideMenu.style.width = "100%";
      return;
    }

    if (endFix) {
      // AFTER section: clamp to bottom of container
      sideMenu.style.position = "absolute";
      sideMenu.style.top = (container.offsetHeight - menuHeight) + "px";
      sideMenu.style.left = "0px";
      sideMenu.style.width = "100%";
      return;
    }

    // ACTIVE: fixed to viewport, locked to its column
    sideMenu.style.position = "fixed";
    sideMenu.style.top = OFFSET + "px";
    sideMenu.style.left = lockedLeft + "px";
    sideMenu.style.width = lockedWidth + "px";
  }

  // Initial pass
  measure();
  clamp();

  // Scroll only clamps (no re-measure = no jumping)
  window.addEventListener("scroll", clamp, { passive: true });

  // Resize: re-measure + clamp
  window.addEventListener("resize", () => {
    measure();
    clamp();
  });
});
