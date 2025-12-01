document.addEventListener("DOMContentLoaded", () => {

    // -------------------------------------------------------------------------
    // SLIDE DATA
    // -------------------------------------------------------------------------
    const heroSlides = [
        {
            title: "Empowering the Next Generation of Innovators",
            subtitle: "Driving Bhutan’s digital transformation.",
            media: "/videos/gcit-MPH.mp4",
            label: "Learn"
        },
        {
            title: "Where Ideas Evolve into Innovation",
            subtitle: "Fostering creativity and experimentation.",
            media: "/videos/corporateVideo-GCIT.mp4",
            label: "Innovation"
        },
        {
            title: "Inspiring Excellence Through Knowledge",
            subtitle: "Strong foundations for future leaders.",
            media: "/videos/gcit-MPH.mp4",
            label: "Excellence"
        }
    ];

    // DOM references
    const sliderTrack = document.querySelector(".sliderTrack");
    const heroTitle = document.querySelector(".hero-header");
    const heroSubtitle = document.querySelector(".subtitle");
    const heroVideo = document.querySelector(".hero-video");

    const leftBtn = document.querySelector(".leftBtn");
    const rightBtn = document.querySelector(".rightBtn");

    let activeIndex = 0;  // controls hero
    let viewStart = 0;    // controls slider position (0,1)

    const VISIBLE = 3;    // exactly 3 items visible


    // -------------------------------------------------------------------------
    // Render slider tabs
    // -------------------------------------------------------------------------
    function renderSlides() {
        sliderTrack.innerHTML = "";
        heroSlides.forEach((s, i) => {
            const div = document.createElement("div");
            div.className = "slide";
            div.textContent = s.label;
            div.addEventListener("click", () => jumpToSlide(i));
            sliderTrack.appendChild(div);
        });
    }
    renderSlides();

    let slides = Array.from(document.querySelectorAll(".sliderTrack .slide"));


    // -------------------------------------------------------------------------
    // Generate video thumbnails
    // -------------------------------------------------------------------------
    function generateVideoThumbnail(videoUrl, callback) {
        const video = document.createElement("video");
        video.src = videoUrl;
        video.crossOrigin = "anonymous";
        video.muted = true;

        video.addEventListener("loadeddata", () => {
            video.currentTime = 0.1;
        });

        video.addEventListener("seeked", () => {
            const canvas = document.createElement("canvas");
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext("2d").drawImage(video, 0, 0);
            callback(canvas.toDataURL("image/jpeg"));
        });
    }

    heroSlides.forEach((slide, i) => {
        const el = slides[i];

        if (slide.media.endsWith(".mp4")) {
            generateVideoThumbnail(slide.media, thumb => {
                el.style.backgroundImage = `url(${thumb})`;
            });
        } else {
            el.style.backgroundImage = `url(${slide.media})`;
        }
    });


    // -------------------------------------------------------------------------
    // Apply width (3 visible)
    // -------------------------------------------------------------------------
function applyWidths() {
    slides.forEach(s => {
        s.style.flex = `0 0 calc(100% / ${VISIBLE})`;
    });
}
applyWidths();
function updateActive() {
    // reset only the first 3 slides
    for (let i = 0; i < 3; i++) {
        if (slides[i]) {
            slides[i].classList.remove("active");
            slides[i].textContent = heroSlides[i].label;
        }
    }

    // set active state
    if (slides[activeIndex]) {
        slides[activeIndex].classList.add("active");
        slides[activeIndex].textContent = "Playing";
    }
}

updateActive();


    // -------------------------------------------------------------------------
    // Update Hero Banner
    // -------------------------------------------------------------------------
    function updateHero(i) {

        const s = heroSlides[i];
        heroTitle.textContent = s.title;
        heroSubtitle.textContent = s.subtitle;

        heroVideo.classList.add("fade");
        setTimeout(() => {
            heroVideo.src = s.media;
            heroVideo.load();
            heroVideo.play();
            heroVideo.classList.remove("fade");
        }, 150);
    }
    updateHero(0);


    // -------------------------------------------------------------------------
    // Active state
    // -------------------------------------------------------------------------



    // -------------------------------------------------------------------------
    // Move viewport of slider (non-loop)
    // -------------------------------------------------------------------------
    function updateSliderPosition() {
        const shift = -(viewStart * (100 / VISIBLE));
        sliderTrack.style.transform = `translateX(${shift}%)`;
    }
    updateSliderPosition();


    // -------------------------------------------------------------------------
    // Button Controls
    // -------------------------------------------------------------------------
    rightBtn.onclick = () => {
        if (activeIndex < heroSlides.length - 1) {
            activeIndex++;
            updateHero(activeIndex);
            updateActive();

            // shift slider if needed
            if (activeIndex >= viewStart + VISIBLE) {
                viewStart++;
                updateSliderPosition();
            }
        }
    };

    leftBtn.onclick = () => {
        if (activeIndex > 0) {
            activeIndex--;
            updateHero(activeIndex);
            updateActive();

            if (activeIndex < viewStart) {
                viewStart--;
                updateSliderPosition();
            }
        }
    };


    // -------------------------------------------------------------------------
    // Clicking any slide tab
    // -------------------------------------------------------------------------
    function jumpToSlide(i) {
        activeIndex = i;
        updateHero(i);
        updateActive();

        // adjust viewport to keep clicked item visible
        if (i < viewStart) {
            viewStart = i;
        } else if (i >= viewStart + VISIBLE) {
            viewStart = i - (VISIBLE - 1);
        }
        updateSliderPosition();
    }

    // -------------------------------------------------------------------------
    // Resize
    // -------------------------------------------------------------------------
    window.addEventListener("resize", applyWidths);

});
