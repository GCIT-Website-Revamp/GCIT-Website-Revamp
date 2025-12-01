document.addEventListener("DOMContentLoaded", () => {
    const wrapper = document.querySelector(".homeProjectWrapper");
    if (!wrapper) return;
    
    const leftBtn = wrapper.querySelector(".prjSlider .left");
    const rightBtn = wrapper.querySelector(".prjSlider .right");

    // Updated selectors (your new classnames)
    const titleEl = wrapper.querySelector(".homeSliderTrack .homeSlide");

    const activeBanner = wrapper.querySelector("#activeBanner");
    const bgBanner = wrapper.querySelector(".projectBanner .background");
    const projectBanner = wrapper.querySelector(".projectBanner");

    if (!leftBtn || !rightBtn || !titleEl || !projectBanner) return;

    // Backgrounds stay untouched
    const backgrounds = [
        projectBanner.dataset.bg0,
        projectBanner.dataset.bg1,
        projectBanner.dataset.bg2
    ];

    // Titles array
    const titles = [
        "Start Up Investment",
        "Gyalsung Allocation System",
        "Parking.bt"
    ];

    let index = 0;

    // -------------------------
    // BACKGROUND ONLY UPDATE (unchanged)
    // -------------------------
    function updateSlideBackground() {
        activeBanner.style.opacity = 0;
        bgBanner.style.opacity = 0;

        setTimeout(() => {
            activeBanner.src = backgrounds[index];
            bgBanner.src = backgrounds[index];

            activeBanner.style.opacity = 1;
            bgBanner.style.opacity = 1;
        }, 200);
    }

    // -------------------------
    // TEXT UPDATE ONLY
    // -------------------------
    function updateText() {
        titleEl.style.opacity = 0;

        setTimeout(() => {
            titleEl.textContent = titles[index];
            titleEl.style.opacity = 1;
        }, 150);
    }

    // -------------------------
    // CONTROLS
    // -------------------------
    rightBtn.addEventListener("click", () => {
        index = (index + 1) % titles.length;
        updateText();
        updateSlideBackground(); // keep your img logic intact
    });

    leftBtn.addEventListener("click", () => {
        index = (index - 1 + titles.length) % titles.length;
        updateText();
        updateSlideBackground();
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const highlightWrapper = document.querySelector(".highlightWrapper");
    if (!highlightWrapper) return;

    const mainHighlightImg = highlightWrapper.querySelector(".highlight.backgroundWrapper > img");
    const highlightSlides = highlightWrapper.querySelectorAll(".highlightSlider");
    const titleEl = highlightWrapper.querySelector(".content h1");
    const descEl = highlightWrapper.querySelector(".content p");

    if (!mainHighlightImg || !highlightSlides.length || !titleEl || !descEl) return;

    // NORMALIZE initial state
    highlightSlides.forEach((slider, idx) => {
        const overlay = slider.querySelector("div");
        if (!overlay) return;

        overlay.classList.remove("activeHighlight", "sliderImgOverlay");
        overlay.classList.add(idx === 0 ? "activeHighlight" : "sliderImgOverlay");
    });

    function setActiveSlide(slider) {
        // reset all
        highlightSlides.forEach(s => {
            const overlay = s.querySelector("div");
            overlay.classList.remove("activeHighlight", "sliderImgOverlay");
            overlay.classList.add("sliderImgOverlay");
        });

        // activate clicked one
        const overlay = slider.querySelector("div");
        overlay.classList.remove("sliderImgOverlay");
        overlay.classList.add("activeHighlight");

        // update image
        const newSrc = slider.querySelector("img").src;

        mainHighlightImg.style.opacity = 0;
        titleEl.style.opacity = 0;
        descEl.style.opacity = 0;

        setTimeout(() => {
            // image
            mainHighlightImg.src = newSrc;
            mainHighlightImg.style.opacity = 1;

            // text content from data-attrs
            titleEl.textContent = slider.dataset.title;
            descEl.textContent = slider.dataset.desc;

            titleEl.style.opacity = 1;
            descEl.style.opacity = 1;
        }, 150);
    }

    highlightSlides.forEach(slider => {
        slider.style.cursor = "pointer";
        slider.addEventListener("click", () => setActiveSlide(slider));
    });
});
