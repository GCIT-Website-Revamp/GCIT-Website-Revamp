document.addEventListener("DOMContentLoaded", () => {

    // -------------------------------------------------------------------------
    // SLIDE DATA (only one media file; thumbnail auto-generated)
    // -------------------------------------------------------------------------
    const heroSlides = [
        {
            title: "Empowering the Next Generation of Innovators",
            subtitle: "Driving Bhutan’s digital transformation.",
            media: "/videos/gcit-MPH.mp4",
            label: "Playing"
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
        },
        {
            title: "A Fourth Slide Example",
            subtitle: "This shows how the peek works.",
            media: "/images/sample-image.jpg",
            label: "More"
        }
    ];

    // -------------------------------------------------------------------------
    // ELEMENTS
    // -------------------------------------------------------------------------
    const sliderTrack = document.querySelector(".sliderTrack");
    const heroTitle = document.querySelector(".hero-header");
    const heroSubtitle = document.querySelector(".subtitle");
    const heroVideo = document.querySelector(".hero-video");
    const leftBtn = document.querySelector(".leftBtn");
    const rightBtn = document.querySelector(".rightBtn");

    let logicalIndex = 0;                  // ALWAYS controls hero banner
    let loopMode = heroSlides.length > 3;  // >3 = loop mode
    let slideWidth = 0;


    // -------------------------------------------------------------------------
    // STEP 1: Render Slider Items
    // -------------------------------------------------------------------------
    function renderSlides() {
        sliderTrack.innerHTML = "";

        heroSlides.forEach(s => {
            const div = document.createElement("div");
            div.className = "slide";

            const text = document.createElement("span");
            text.innerText = s.label;

            div.appendChild(text);
            sliderTrack.appendChild(div);
        });
    }

    renderSlides();

    let slides = document.querySelectorAll(".slide");


    // -------------------------------------------------------------------------
    // STEP 2: Auto-generate preview images from media (image or video)
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

            const ctx = canvas.getContext("2d");
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

            callback(canvas.toDataURL("image/jpeg"));
        });
    }


    function loadSlidePreviews() {
        heroSlides.forEach((slide, i) => {
            const el = slides[i];

            if (!slide.media) return;

            if (slide.media.endsWith(".mp4")) {
                generateVideoThumbnail(slide.media, (thumb) => {
                    el.style.backgroundImage = `url(${thumb})`;
                });
            } else {
                el.style.backgroundImage = `url(${slide.media})`;
            }
        });
    }

    loadSlidePreviews();


    // -------------------------------------------------------------------------
    // STEP 3: Apply Width Logic
    // -------------------------------------------------------------------------
    function applyWidths() {
        if (!loopMode) {
            const w = 100 / heroSlides.length;
            slides.forEach(s => s.style.width = `${w}%`);
        } else {
            slides.forEach(s => s.style.width = "30%");
        }

        slideWidth = slides[0].offsetWidth + 16; // gap = 1rem
    }

    applyWidths();


    // -------------------------------------------------------------------------
    // STEP 4: Hero Banner Update
    // -------------------------------------------------------------------------
    function updateHeroBanner(i) {
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


    // -------------------------------------------------------------------------
    // STEP 5: Update Active Nav Highlight
    // -------------------------------------------------------------------------
    function updateActiveNav(i) {
        slides.forEach(s => s.classList.remove("active"));
        slides[i].classList.add("active");
    }

    updateActiveNav(0);
    updateHeroBanner(0);


    // -------------------------------------------------------------------------
    // STEP 6: TRUE Circular Looping (DOM Reordering)
    // -------------------------------------------------------------------------

    // Move first → end
    function moveRight() {
        sliderTrack.style.transition = "transform .35s ease";
        sliderTrack.style.transform = `translateX(-${slideWidth}px)`;

        sliderTrack.addEventListener("transitionend", function handler() {
            sliderTrack.style.transition = "none";
            sliderTrack.appendChild(sliderTrack.firstElementChild);
            sliderTrack.style.transform = "translateX(0)";
            sliderTrack.removeEventListener("transitionend", handler);
            slides = document.querySelectorAll(".slide");
        });
    }

    // Move last → start
    function moveLeft() {
        sliderTrack.style.transition = "none";
        sliderTrack.prepend(sliderTrack.lastElementChild);
        sliderTrack.style.transform = `translateX(-${slideWidth}px)`;

        requestAnimationFrame(() => {
            sliderTrack.style.transition = "transform .35s ease";
            sliderTrack.style.transform = "translateX(0)";
            slides = document.querySelectorAll(".slide");
        });
    }


    // -------------------------------------------------------------------------
    // STEP 7: BUTTON CONTROLS
    // -------------------------------------------------------------------------
    rightBtn.onclick = () => {
        logicalIndex = (logicalIndex + 1) % heroSlides.length;
        updateHeroBanner(logicalIndex);
        updateActiveNav(logicalIndex);

        if (loopMode) moveRight();
    };

    leftBtn.onclick = () => {
        logicalIndex = (logicalIndex - 1 + heroSlides.length) % heroSlides.length;
        updateHeroBanner(logicalIndex);
        updateActiveNav(logicalIndex);

        if (loopMode) moveLeft();
    };


    // -------------------------------------------------------------------------
    // STEP 8: CLICK ANY SLIDE
    // -------------------------------------------------------------------------
    slides.forEach((slide, i) => {
        slide.addEventListener("click", () => {

            if (!loopMode) {
                logicalIndex = i;
                updateHeroBanner(i);
                updateActiveNav(i);
                return;
            }

            const currentLabel = slides[0].innerText;
            const clickedLabel = slide.innerText;

            if (currentLabel === clickedLabel) return;

            // clicking one to the RIGHT
            if (slide === slides[1]) {
                logicalIndex = (logicalIndex + 1) % heroSlides.length;
                updateHeroBanner(logicalIndex);
                updateActiveNav(logicalIndex);
                moveRight();
            }

            // clicking one to the LEFT (peek last)
            if (slide === slides[slides.length - 1]) {
                logicalIndex = (logicalIndex - 1 + heroSlides.length) % heroSlides.length;
                updateHeroBanner(logicalIndex);
                updateActiveNav(logicalIndex);
                moveLeft();
            }
        });
    });


    // -------------------------------------------------------------------------
    // STEP 9: Resize Handler
    // -------------------------------------------------------------------------
    window.addEventListener("resize", applyWidths);

});
