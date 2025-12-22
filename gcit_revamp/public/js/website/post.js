document.addEventListener("DOMContentLoaded", () => {

  const DESKTOP_BREAKPOINT = 1024;

  const sidebar = document.querySelector(".suggestionWrapper");
  const container = document.querySelector(".postWrapper");

  if (!sidebar || !container) return;

  let sidebarWidth = null;

  function getNavOffset() {
    return (
      parseInt(
        getComputedStyle(document.documentElement)
          .getPropertyValue("--nav-visible-height")
      ) || 0
    );
  }

  function cacheWidth() {
    if (!sidebarWidth) {
      sidebarWidth = sidebar.getBoundingClientRect().width;
    }
  }

 function updateStickySuggestion() {
  if (window.innerWidth < DESKTOP_BREAKPOINT) return;

  cacheWidth();

  const OFFSET = getNavOffset();
  const scrollY = window.scrollY;

  const containerTop = container.offsetTop;
  const containerBottom = containerTop + container.offsetHeight;
  const sidebarHeight = sidebar.offsetHeight;

  const startFix = scrollY + OFFSET >= containerTop;
  const endFix = scrollY + OFFSET + sidebarHeight >= containerBottom;

  if (startFix && !endFix) {
    sidebar.style.position = "fixed";
    sidebar.style.top = OFFSET + "px";
    sidebar.style.left =
      container.getBoundingClientRect().right - sidebarWidth + "px";
    sidebar.style.width = sidebarWidth + "px";
  }
  else if (endFix) {
    sidebar.style.position = "absolute";
    sidebar.style.top =
      container.offsetHeight - sidebarHeight + "px";
    sidebar.style.left = "auto";
    sidebar.style.right = "0";
    sidebar.style.width = sidebarWidth + "px"; // 🔒 keep width stable
  }
  else {
    resetSidebar();
  }
}


  function resetSidebar() {
    sidebar.style.position = "relative";
    sidebar.style.top = "auto";
    sidebar.style.left = "auto";
    sidebar.style.right = "auto";
    sidebar.style.width = "auto";
  }

  window.addEventListener("scroll", updateStickySuggestion);
  window.addEventListener("resize", () => {
    sidebarWidth = null; // 🔄 recalc on resize
    if (window.innerWidth < DESKTOP_BREAKPOINT) {
      resetSidebar();
    }
    updateStickySuggestion();
  });

});



