document.addEventListener("DOMContentLoaded", () => {
    const wrapper = document.querySelector(".homeProjectWrapper");
    if (!wrapper) return;

    const projectBanner = wrapper.querySelector("#projectBanner");
    const activeBanner = wrapper.querySelector("#activeBanner");

    // Title text elements
    const titleEls = wrapper.querySelectorAll(".homeSliderTrack .homeSlide");

    // Title <a> wrappers
    const titleLinks = wrapper.querySelectorAll(".homeSliderTrack a");

    const imgLinks = wrapper.querySelectorAll('#homeImgProjectLink')
    // View Details links
    const viewDetailLinks = wrapper.querySelectorAll(".prjLink a");

    // Arrow buttons
    const leftBtns = wrapper.querySelectorAll(".prjSlider .left");
    const rightBtns = wrapper.querySelectorAll(".prjSlider .right");

    if (!projectBanner || !activeBanner || !titleEls.length) return;

    // Load projects from Blade
    const projectData = JSON.parse(projectBanner.dataset.projects);

    const backgrounds = projectData.map(p => `/storage/${p.image}`);
    const titles = projectData.map(p => p.name);
    const urls = projectData.map(p => `/post/project/${p.id}`);

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
       Update titles + links
    ----------------------------- */
    function updateTextAndLinks() {
        console.log("RUNINNG HERE")
        titleEls.forEach((titleEl, i) => {
            titleEl.style.opacity = 0;

            setTimeout(() => {
                titleEl.textContent = titles[index];
                titleEl.style.opacity = 1;
            }, 150);
        });

        // Update title links
        titleLinks.forEach(link => {
            link.href = urls[index];
        });

        imgLinks.forEach(link => {
            link.href = urls[index]
        })

        // Update View Details links
        viewDetailLinks.forEach(link => {
            link.href = urls[index];
        });
    }

    /* -----------------------------
       Navigation
    ----------------------------- */
    function nextSlide() {
        index = (index + 1) % projectData.length;
        updateTextAndLinks();
        updateSlideBackground();
    }

    function prevSlide() {
        index = (index - 1 + projectData.length) % projectData.length;
        updateTextAndLinks();
        updateSlideBackground();
    }

    rightBtns.forEach(btn => btn.addEventListener("click", nextSlide));
    leftBtns.forEach(btn => btn.addEventListener("click", prevSlide));

    /* -----------------------------
       INITIAL LOAD
    ----------------------------- */
    updateTextAndLinks();
    updateSlideBackground();
});
