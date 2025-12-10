document.addEventListener("DOMContentLoaded", () => {
    const wrapper = document.querySelector(".homeProjectWrapper");
    if (!wrapper) return;

    const projectBanner = wrapper.querySelector("#projectBanner");
    const activeBanner = wrapper.querySelector("#activeBanner");
    const titleEl = wrapper.querySelector(".homeSliderTrack .homeSlide");

    const leftBtn = wrapper.querySelector(".prjSlider .left");
    const rightBtn = wrapper.querySelector(".prjSlider .right");

    if (!projectBanner || !titleEl || !activeBanner) return;

    // Load highlight projects from Blade
    const projectData = JSON.parse(projectBanner.dataset.projects);

    // Build arrays
    const backgrounds = projectData.map(p => `/storage/${p.image}`);
    const titles = projectData.map(p => p.name);

    let index = 0;

    // -----------------------------
    // Update background image
    // -----------------------------
    function updateSlideBackground() {
        activeBanner.style.opacity = 0;

        setTimeout(() => {
            activeBanner.src = backgrounds[index];
            activeBanner.style.opacity = 1;
        }, 200);
    }

    // -----------------------------
    // Update title text
    // -----------------------------
    function updateText() {
        titleEl.style.opacity = 0;
        setTimeout(() => {
            titleEl.textContent = titles[index];
            titleEl.style.opacity = 1;
        }, 150);
    }

    // -----------------------------
    // Buttons
    // -----------------------------
    rightBtn.addEventListener("click", () => {
        index = (index + 1) % titles.length;
        updateText();
        updateSlideBackground();
    });

    leftBtn.addEventListener("click", () => {
        index = (index - 1 + titles.length) % titles.length;
        updateText();
        updateSlideBackground();
    });

    // -----------------------------
    // INITIAL LOAD — FIX
    // -----------------------------
    updateText();             // first title shows immediately
    updateSlideBackground();  // first image shows immediately
});
