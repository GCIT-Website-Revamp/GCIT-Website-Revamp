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
  const muteBtn = document.querySelector(".muteBtn"); // 🔊 add button in HTML

  let activeIndex = 0;
  let viewStart = 0;
  let autoTimer = null;
  let isMuted = true;

  function getVisibleCount() {
    return window.innerWidth <= 800 ? 1 : 3;
  }

  let VISIBLE = getVisibleCount();

  /* -----------------------------------------------------------
     FETCH MEDIA
  ----------------------------------------------------------- */
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
    });

  /* -----------------------------------------------------------
     INIT
  ----------------------------------------------------------- */
  function initializeSlider() {
    renderSlides();
    slides = Array.from(document.querySelectorAll(".sliderTrack .slide"));

    generateThumbnails();
    applyWidths();

    goToSlide(0);
  }

  /* -----------------------------------------------------------
     RENDER SLIDES
  ----------------------------------------------------------- */
function renderSlides() {
  sliderTrack.innerHTML = "";
  heroSlides.forEach((s, i) => {
    const div = document.createElement("div");
    div.className = "slide";
    div.dataset.label = s.label;

    div.innerHTML = `
      <span class="slideLabel">${s.label}</span>
      <button class="muteToggle" aria-label="Toggle sound"><span class="material-symbols-outlined">
no_sound
</span></button>
    `;

    div.addEventListener("click", () => goToSlide(i));
    sliderTrack.appendChild(div);
  });
}

  /* -----------------------------------------------------------
     THUMBNAILS
  ----------------------------------------------------------- */
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

  /* -----------------------------------------------------------
     CORE SLIDE CHANGE
  ----------------------------------------------------------- */
  function goToSlide(index) {
    clearTimeout(autoTimer);
    activeIndex = index;

    updateHero(index);
    updateActive();
    updateViewport();
  }

  /* -----------------------------------------------------------
     HERO UPDATE
  ----------------------------------------------------------- */
  function updateHero(i) {
    const s = heroSlides[i];

    heroTitle.textContent = s.title;
    heroSubtitle.textContent = s.subtitle;

    heroVideo.onended = null;

    if (s.media.endsWith(".mp4")) {
      heroVideo.style.display = "block";
      heroImage.style.display = "none";

      heroVideo.src = s.media;
      heroVideo.muted = isMuted;
      heroVideo.load();
      heroVideo.play();

      heroVideo.onended = nextSlide; // 🎥 auto advance
    } else {
      heroVideo.pause();
      heroVideo.style.display = "none";
      heroImage.style.display = "block";

      heroImage.src = s.media;

      autoTimer = setTimeout(nextSlide, 15000); // 🖼 auto advance
    }
  }

  /* -----------------------------------------------------------
     ACTIVE STATE
  ----------------------------------------------------------- */
function updateActive() {
  slides.forEach((s, i) => {
    const label = s.querySelector(".slideLabel");
    const muteBtn = s.querySelector(".muteToggle");

    const isActive = i === activeIndex;
    const isVideo = heroSlides[i].media.endsWith(".mp4");

    s.classList.toggle("active", isActive);

    label.textContent = isActive ? "Now Playing" : s.dataset.label;

    // ✅ Show mute ONLY if active + video
    if (isActive && isVideo) {
      muteBtn.style.display = "inline-flex";
      muteBtn.innerHTML = isMuted
        ? `<span class="material-symbols-outlined">volume_off</span>`
        : `<span class="material-symbols-outlined">volume_up</span>`;
    } else {
      muteBtn.style.display = "none";
    }

    // Prevent slide click when toggling sound
    muteBtn.onclick = (e) => {
      e.stopPropagation();
      toggleMute();
    };
  });
}

function toggleMute() {
  isMuted = !isMuted;
  heroVideo.muted = isMuted;
  updateActive(); // refresh icon
}

  /* -----------------------------------------------------------
     VIEWPORT MOVE
  ----------------------------------------------------------- */
  function updateViewport() {
    if (activeIndex < viewStart) {
      viewStart = activeIndex;
    } else if (activeIndex >= viewStart + VISIBLE) {
      viewStart = activeIndex - (VISIBLE - 1);
    }

    const shift = -(viewStart * (100 / VISIBLE));
    sliderTrack.style.transform = `translateX(${shift}%)`;
  }

  /* -----------------------------------------------------------
     WIDTHS
  ----------------------------------------------------------- */
  function applyWidths() {
    slides.forEach(s => s.style.flex = `0 0 calc(100% / ${VISIBLE})`);
  }

  /* -----------------------------------------------------------
     NAV
  ----------------------------------------------------------- */
  function nextSlide() {
    if (activeIndex < heroSlides.length - 1) {
      goToSlide(activeIndex + 1);
    } else {
      goToSlide(0);
    }
  }

  rightBtn.onclick = nextSlide;
  leftBtn.onclick = () => {
    if (activeIndex > 0) goToSlide(activeIndex - 1);
  };

  /* -----------------------------------------------------------
     MUTE TOGGLE
  ----------------------------------------------------------- */
  muteBtn?.addEventListener("click", () => {
    isMuted = !isMuted;
    heroVideo.muted = isMuted;
    muteBtn.textContent = isMuted ? "🔇" : "🔊";
  });

  /* -----------------------------------------------------------
     RESIZE
  ----------------------------------------------------------- */
  window.addEventListener("resize", () => {
    VISIBLE = getVisibleCount();
    applyWidths();
    updateViewport();
  });

});
