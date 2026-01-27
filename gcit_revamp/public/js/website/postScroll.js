/**
 * Post Detail Page - Unified Sticky Suggestion Sidebar
 * Uses GSAP ScrollTrigger pin for consistent behavior with other pages
 */
document.addEventListener("DOMContentLoaded", () => {
  gsap.registerPlugin(ScrollTrigger);

  ScrollTrigger.matchMedia({

    // DESKTOP ONLY (≥1024px)
    "(min-width: 1024px)": () => {
      const suggestion = document.querySelector(".postWrapper .suggestionWrapper");
      const container = document.querySelector(".postWrapper");

      if (!suggestion || !container) return;

      const TOP_OFFSET = 100; // Offset from top when sticky

      // Lock width more precisely to prevent layout shift
      function lockWidth(el) {
        const rect = el.getBoundingClientRect();
        const computedStyle = window.getComputedStyle(el);
        
        // Get the exact width
        const width = rect.width;
        
        // Apply locked dimensions and prevent any flex changes
        el.style.width = width + "px";
        el.style.minWidth = width + "px";
        el.style.maxWidth = width + "px";
        el.style.flexShrink = "0";
        el.style.flexGrow = "0";
        el.style.height = "fit-content";
      }

      lockWidth(suggestion);

      // Create pin for suggestion sidebar
      const suggestionPin = ScrollTrigger.create({
        trigger: container,
        start: `top-=${TOP_OFFSET}px top`,
        end: () => `bottom-=${suggestion.offsetHeight + TOP_OFFSET} top`,
        pin: suggestion,
        pinSpacing: false,
        pinType: "fixed",
        invalidateOnRefresh: true,
        anticipatePin: 1, // Prevents jumping by anticipating the pin
        onRefresh: () => {
          // Only re-measure if not currently pinned
          if (!suggestionPin.isActive) {
            lockWidth(suggestion);
          }
        }
      });

      // Handle resize with debounce
      let resizeTimer;
      const onResize = () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
          // Temporarily clear styles to get accurate measurements
          const wasActive = suggestionPin.isActive;
          if (wasActive) {
            gsap.set(suggestion, { clearProps: "position,top,left,width,minWidth,maxWidth" });
          }
          
          lockWidth(suggestion);
          ScrollTrigger.refresh();
        }, 100);
      };
      window.addEventListener("resize", onResize);

      // Cleanup when leaving desktop
      return () => {
        clearTimeout(resizeTimer);
        suggestionPin.kill();
        window.removeEventListener("resize", onResize);
        gsap.set(suggestion, { clearProps: "all" });
      };
    },

    // MOBILE / TABLET (<1024px)
    "(max-width: 1023px)": () => {
      const suggestion = document.querySelector(".postWrapper .suggestionWrapper");
      if (suggestion) {
        gsap.set(suggestion, { clearProps: "all" });
      }
    }

  });

});