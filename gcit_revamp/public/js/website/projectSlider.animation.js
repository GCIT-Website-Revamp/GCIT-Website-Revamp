document.addEventListener("DOMContentLoaded", () => {
    const wrapper = document.querySelector(".homeProjectWrapper");
    if (!wrapper) return;

    const projectBanner = wrapper.querySelector("#projectBanner");
    const activeBanner = wrapper.querySelector("#activeBanner");

    // Collect ALL title elements (desktop + mobile)
    const titleEls = wrapper.querySelectorAll(".homeSliderTrack .homeSlide");

    // Collect ALL arrow buttons (desktop + mobile)
    const leftBtns = wrapper.querySelectorAll(".prjSlider .left");
    const rightBtns = wrapper.querySelectorAll(".prjSlider .right");

    if (!projectBanner || !activeBanner || !titleEls.length) return;

    // Load projects from Blade
    const projectData = JSON.parse(projectBanner.dataset.projects);

    const backgrounds = projectData.map(p => `/storage/${p.image}`);
    const titles = projectData.map(p => p.name);

    let index = 0;

    /* -----------------------------
       Update background image
    ----------------------------- */
    function updateSlideBackground() {
        activeBanner.style.opacity = 0;

        setTimeout(() => {
            activeBanner.src = backgrounds[index];
            activeBanner.style.opacity = 1;
        }, 200);
    }

    /* -----------------------------
       Update ALL titles (desktop + mobile)
    ----------------------------- */
    function updateText() {
        titleEls.forEach(titleEl => {
            titleEl.style.opacity = 0;

            setTimeout(() => {
                titleEl.textContent = titles[index];
                titleEl.style.opacity = 1;
            }, 150);
        });
    }

    /* -----------------------------
       Navigation
    ----------------------------- */
    function nextSlide() {
        index = (index + 1) % titles.length;
        updateText();
        updateSlideBackground();
    }

    function prevSlide() {
        index = (index - 1 + titles.length) % titles.length;
        updateText();
        updateSlideBackground();
    }

    rightBtns.forEach(btn => btn.addEventListener("click", nextSlide));
    leftBtns.forEach(btn => btn.addEventListener("click", prevSlide));

    /* -----------------------------
       INITIAL LOAD
    ----------------------------- */
    updateText();
    updateSlideBackground();
});
