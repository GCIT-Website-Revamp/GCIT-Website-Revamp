document.addEventListener("DOMContentLoaded", () => {

    let heroSlides = [];
    let slides = [];

    const sliderTrack = document.querySelector(".sliderTrack");
    const heroTitle = document.querySelector(".hero-header");
    const heroSubtitle = document.querySelector(".subtitle");
    const heroVideo = document.querySelector(".hero-video");
    const heroImage = document.querySelector(".hero-image");

    const leftBtn = document.querySelector(".leftBtn");
    const rightBtn = document.querySelector(".rightBtn");

    let activeIndex = 0;
    let viewStart = 0;
    const VISIBLE = 3;

    // -----------------------------------------------------------
    // FETCH MEDIA FROM LARAVEL
    // -----------------------------------------------------------
    fetch("/api/media")
        .then(res => res.json())
        .then(json => {

            if (!json.success) return;

            heroSlides = json.data.map(item => ({
                title: item.title,
                subtitle: "",
                media: `/storage/${item.media}`,
                label: item.title
            }));

            initializeSlider();
        })
        .catch(err => console.error("Failed to load media:", err));



    // -----------------------------------------------------------
    // INITIALIZE SLIDER ONLY AFTER DATA ARRIVES
    // -----------------------------------------------------------
    function initializeSlider() {
        renderSlides();
        slides = Array.from(document.querySelectorAll(".sliderTrack .slide"));

        generateThumbnails();
        applyWidths();

        updateHero(0);
        updateActive();
        updateSliderPosition();
    }


    // -----------------------------------------------------------
    // RENDER SLIDE LABELS
    // -----------------------------------------------------------
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


    // -----------------------------------------------------------
    // GENERATE THUMBNAILS
    // -----------------------------------------------------------
    function generateThumbnails() {
        heroSlides.forEach((slide, i) => {
            const el = slides[i];
            if (!el) return;

            if (slide.media.endsWith(".mp4")) {
                generateVideoThumbnail(slide.media, thumb => {
                    el.style.backgroundImage = `url(${thumb})`;
                });
            } else {
                el.style.backgroundImage = `url(${slide.media})`;
            }
        });
    }

    function generateVideoThumbnail(videoUrl, callback) {
        const video = document.createElement("video");
        video.src = videoUrl;
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


    // -----------------------------------------------------------
    // UPDATE HERO BANNER
    // -----------------------------------------------------------
    function updateHero(i) {
        const s = heroSlides[i];

        heroTitle.textContent = s.title;
        heroSubtitle.textContent = s.subtitle;

        if (s.media.endsWith(".mp4")) {
            heroVideo.style.display = "block";
            heroImage.style.display = "none";

            heroVideo.src = s.media;
            heroVideo.load();
            heroVideo.play();
        } else {
            heroVideo.style.display = "none";
            heroImage.style.display = "block";

            heroImage.src = s.media;
        }
    }


    // -----------------------------------------------------------
    // ACTIVE SLIDE STATE
    // -----------------------------------------------------------
    function updateActive() {
        slides.forEach(s => s.classList.remove("active"));

        if (slides[activeIndex]) {
            slides[activeIndex].classList.add("active");
            slides[activeIndex].textContent = "Playing";
        }
    }


    // -----------------------------------------------------------
    // SLIDER WIDTHS
    // -----------------------------------------------------------
    function applyWidths() {
        slides.forEach(s => s.style.flex = `0 0 calc(100% / ${VISIBLE})`);
    }


    // -----------------------------------------------------------
    // MOVE VIEWPORT
    // -----------------------------------------------------------
    function updateSliderPosition() {
        const shift = -(viewStart * (100 / VISIBLE));
        sliderTrack.style.transform = `translateX(${shift}%)`;
    }


    // -----------------------------------------------------------
    // BUTTON CONTROLS
    // -----------------------------------------------------------
    rightBtn.onclick = () => {
        if (activeIndex < heroSlides.length - 1) {
            activeIndex++;
            updateHero(activeIndex);
            updateActive();

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


    // -----------------------------------------------------------
    // JUMP TO CLICKED SLIDE
    // -----------------------------------------------------------
    function jumpToSlide(i) {
        activeIndex = i;
        updateHero(i);
        updateActive();

        if (i < viewStart) {
            viewStart = i;
        } else if (i >= viewStart + VISIBLE) {
            viewStart = i - (VISIBLE - 1);
        }

        updateSliderPosition();
    }

});
