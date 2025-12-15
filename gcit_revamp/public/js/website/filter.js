

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
