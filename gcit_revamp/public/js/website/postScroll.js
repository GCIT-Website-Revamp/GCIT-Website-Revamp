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

      // Lock width to prevent layout shift when pinned
      function lockWidth(el) {
        const rect = el.getBoundingClientRect();
        el.style.width = rect.width + "px";
        el.style.height = "fit-content";
      }

      lockWidth(suggestion);

      // Create pin for suggestion sidebar
      const suggestionPin = ScrollTrigger.create({
        trigger: container,
        start: `-${TOP_OFFSET}px top`,
        end: () => `bottom-=${suggestion.offsetHeight + TOP_OFFSET} top`,
        pin: suggestion,
        pinSpacing: false,
        pinType: "fixed",
        invalidateOnRefresh: true,
        onRefresh: () => lockWidth(suggestion)
      });

      // Handle resize
      const onResize = () => {
        lockWidth(suggestion);
        ScrollTrigger.refresh();
      };
      window.addEventListener("resize", onResize);

      // Cleanup when leaving desktop
      return () => {
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
