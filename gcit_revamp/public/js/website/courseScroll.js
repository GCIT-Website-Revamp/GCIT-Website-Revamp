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

    autoOpenDropdown(target);

    requestAnimationFrame(() => {
      const OFFSET = 170;

      const targetY =
        target.getBoundingClientRect().top +
        window.pageYOffset -
        OFFSET;

      window.scrollTo({
        top: targetY,
        behavior: "smooth"
      });

      setActive(targetId);
    });
  });
});


   function autoOpenDropdown(section) {
  const checkbox = section.querySelector("input[type='checkbox']");
  if (!checkbox) return;

  document
    .querySelectorAll(".courseDetailContent input[type='checkbox']")
    .forEach(cb => {
      if (cb !== checkbox) cb.checked = false;
    });

  checkbox.checked = true;
  checkbox.blur(); // 🔑 stop mobile auto-scroll
}

});



// const DESKTOP_BREAKPOINT = 1025;
// if(window.innerWidth >= DESKTOP_BREAKPOINT){
// console.log("RUNNING THIS ")
// document.addEventListener("DOMContentLoaded", () => {
//   const DESKTOP_BREAKPOINT = 1025;

//   const container = document.querySelector(".courseDetailsContainer");
//   const sideMenu = document.querySelector(".courseDetailsContainer .sideMenu");

//   if (!container || !sideMenu) return;

//   // Optional: if you already have this CSS var in your project (like your filter code),
//   // we’ll use it. Otherwise fallback.
//   function getNavOffset() {
//     const v = parseInt(
//       getComputedStyle(document.documentElement)
//         .getPropertyValue("--nav-visible-height")
//     );
//     return Number.isFinite(v) ? v : 86; // fallback
//   }

//   // --- Spacer to keep layout from collapsing when sideMenu becomes fixed ---
//   let spacer = container.querySelector(".sideMenuSpacer");
//   if (!spacer) {
//     spacer = document.createElement("div");
//     spacer.className = "sideMenuSpacer";
//     sideMenu.parentNode.insertBefore(spacer, sideMenu);
//   }

//   let lockedLeft = 0;
//   let lockedWidth = 0;

//   function measure() {
//     // Reset to natural flow first to measure correctly
//     sideMenu.style.position = "relative";
//     sideMenu.style.top = "auto";
//     sideMenu.style.left = "auto";
//     sideMenu.style.width = "";

//     // Spacer should match sidebar width in flow
//     const rect = sideMenu.getBoundingClientRect();
// const containerRect = container.getBoundingClientRect();
// lockedLeft = containerRect.left + window.scrollX;    lockedWidth = rect.width;

//     spacer.style.width = rect.width + "px";
//     spacer.style.height = rect.height + "px";
//   }

//   function resetDesktop() {
//     sideMenu.style.position = "relative";
//     sideMenu.style.top = "auto";
//     sideMenu.style.left = "auto";
//     sideMenu.style.width = "";
//     spacer.style.width = "";
//     spacer.style.height = "";
//   }

//   function clamp() {
//     if (window.innerWidth < DESKTOP_BREAKPOINT) {
//       resetDesktop();
//       return;
//     }

//     const OFFSET = getNavOffset();
//     const containerRect = container.getBoundingClientRect();
//     const menuHeight = sideMenu.offsetHeight;

//     // Start fixing when container hits nav offset
//     const startFix = containerRect.top <= OFFSET;

//     // Stop fixing when container bottom is above the menu bottom
//     const endFix = containerRect.bottom <= OFFSET + menuHeight;

//     if (!startFix) {
//       // BEFORE section: sit at top of container
//       sideMenu.style.position = "absolute";
//       sideMenu.style.top = "0px";
//       sideMenu.style.left = "0px";
//       sideMenu.style.width = "100%";
//       return;
//     }

//     if (endFix) {
//       // AFTER section: clamp to bottom of container
//       sideMenu.style.position = "absolute";
//       sideMenu.style.top = (container.offsetHeight - menuHeight) + "px";
//       sideMenu.style.left = "0px";
//       sideMenu.style.width = "100%";
//       return;
//     }

//     // ACTIVE: fixed to viewport, locked to its column
//     sideMenu.style.position = "fixed";
//     sideMenu.style.top = OFFSET + "px";
//     sideMenu.style.left = lockedLeft + "px";
//     sideMenu.style.width = lockedWidth + "px";
//   }

//   // Initial pass
//   measure();
//   clamp();

//   // Scroll only clamps (no re-measure = no jumping)
//   window.addEventListener("scroll", clamp, { passive: true });

//   // Resize: re-measure + clamp
//   window.addEventListener("resize", () => {
//     measure();
//     clamp();
//   });
// });

// }


document.addEventListener("DOMContentLoaded", () => {
    /* =========================================================
       UNIFIED STICKY SIDEBAR LOGIC (SPACER PATTERN)
       Fixes layout shifts and width issues by creating a physical spacer
       in the DOM that holds the space when the sidebar becomes fixed.
    ========================================================= */

    const DESKTOP_BREAKPOINT = 1024;
    const NAV_OFFSET = 120; 

    /**
     * Applies sticky behavior using a spacer element
     * @param {string} sidebarSelector Selector for the sidebar
     * @param {string} containerSelector Selector for the parent/wrapper
     */
    function initStickySidebar(sidebarSelector, containerSelector) {
        const sidebar = document.querySelector(sidebarSelector);
        const container = document.querySelector(containerSelector);

        if (!sidebar || !container) return;
        if (!container.contains(sidebar)) return;

        // 🔒 Lock the original position ONCE when sidebar is in natural flow
        let lockedLeft = null;
        let lockedWidth = null;

        function lockPosition() {
            // Only lock when sidebar is in natural flow (not fixed/absolute)
            if (sidebar.style.position === "" || sidebar.style.position === "relative" || sidebar.style.position === "static") {
                const rect = sidebar.getBoundingClientRect();
                lockedLeft = rect.left;
                lockedWidth = rect.width;
            }
        }

        // Capture initial position
        lockPosition();

        // Create spacer if not exists
        let spacer = sidebar.previousElementSibling;
        if (!spacer || !spacer.classList.contains('sticky-spacer')) {
            spacer = document.createElement('div');
            // Copy classes to match layout rules (grid/flex)
            spacer.className = sidebar.className + ' sticky-spacer';
            spacer.style.display = 'none'; // Hidden by default
            spacer.style.pointerEvents = 'none';
            spacer.style.visibility = 'hidden';
            spacer.innerHTML = '&nbsp;'; 
             
            // IMPORTANT: Copy critical layout styles once
            const computed = window.getComputedStyle(sidebar);
            spacer.style.flex = computed.flex;
            spacer.style.flexGrow = computed.flexGrow;
            spacer.style.flexShrink = computed.flexShrink;
            spacer.style.flexBasis = computed.flexBasis;
            spacer.style.margin = computed.margin;
            spacer.style.padding = computed.padding;
            
            sidebar.parentNode.insertBefore(spacer, sidebar);
        }

        function reset() {
            sidebar.style.position = "";
            sidebar.style.top = "";
            sidebar.style.left = "";
            sidebar.style.width = "";
            sidebar.style.height = "";
            
            spacer.style.display = "none";
        }

        function clamp() {
            if (window.innerWidth < DESKTOP_BREAKPOINT) {
                reset();
                return;
            }

            // 1. MEASURE PHASE
            const isFixed = sidebar.style.position === "fixed" || sidebar.style.position === "absolute";
            
            // If not fixed yet, continuously update the locked position
            if (!isFixed) {
                lockPosition();
            }
            
            // Ensure spacer is visible for measurement so it holds the flex slot
            if (isFixed) {
                spacer.style.display = ""; 
                if (window.getComputedStyle(spacer).display === 'none') spacer.style.display = 'block';
            }
            
            const containerRect = container.getBoundingClientRect();
            
            // Calculate boundaries
            const sidebarHeight = sidebar.offsetHeight;
            const start = containerRect.top <= NAV_OFFSET;
            // Stop point: when sidebar bottom hits container bottom
            const end = containerRect.bottom <= sidebarHeight + NAV_OFFSET;

            if (!start) {
                // CASE: TOP (Default)
                reset();
            } 
            else if (end) {
                // CASE: BOTTOM (Absolute at bottom)
                spacer.style.display = "";
                if (window.getComputedStyle(spacer).display === 'none') spacer.style.display = 'block';
                spacer.style.width = lockedWidth + "px";
                spacer.style.height = sidebarHeight + "px";
                
                sidebar.style.position = "absolute";
                sidebar.style.top = (container.offsetHeight - sidebarHeight) + "px";
                
                // Ensure container is positioned
                const style = window.getComputedStyle(container);
                if (style.position === 'static') container.style.position = 'relative';

                // Use spacer's offsetLeft for absolute positioning
                sidebar.style.left = spacer.offsetLeft + "px";
                sidebar.style.width = lockedWidth + "px";
            } 
            else {
                // CASE: FIXED (Sticky)
                spacer.style.display = "";
                if (window.getComputedStyle(spacer).display === 'none') spacer.style.display = 'block';
                spacer.style.width = lockedWidth + "px";
                spacer.style.height = sidebarHeight + "px";
                
                // Copy computed styles that affect layout
                const computed = window.getComputedStyle(spacer);
                spacer.style.marginTop = computed.marginTop;
                spacer.style.marginBottom = computed.marginBottom;
                spacer.style.marginLeft = computed.marginLeft;
                spacer.style.marginRight = computed.marginRight;

                sidebar.style.position = "fixed";
                sidebar.style.top = NAV_OFFSET + "px";
                // 🔑 Use the LOCKED left position to prevent jumping
                sidebar.style.left = lockedLeft + "px";
                sidebar.style.width = lockedWidth + "px";
            }
        }

        window.addEventListener("scroll", clamp, { passive: true });
        window.addEventListener("resize", () => {
             reset(); // Force reset to re-measure natural layout
             lockedLeft = null; // Reset locked position on resize
             lockedWidth = null;
             setTimeout(() => {
                 lockPosition();
                 clamp();
             }, 50);
        });
        
        // Initial run
        clamp();
    }

    // 1. Admissions & Course Details (Left Sidebar)
    initStickySidebar(".sideMenu", ".courseDetailsContainer");

    // 2. Admissions & Course Details (Right Sidebar)
    initStickySidebar(".otherCourseContainer", ".courseDetailsContainer");

    // 3. Institutional Overview (Right Sidebar)
    initStickySidebar(".otherCourseContainer", ".aboutContentWrapper");
});

