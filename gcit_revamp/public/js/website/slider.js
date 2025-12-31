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
  let VISIBLE = 0;

  /* -----------------------------------------------------------
     FETCH MEDIA
  ----------------------------------------------------------- */
  Promise.all([
    fetch("/api/media").then(res => res.json()),
    fetch("/api/event").then(res => res.json())
  ])
  .then(([mediaRes, eventRes]) => {

    heroSlides = [];

    // =====================
    // MEDIA
    // =====================
    if (mediaRes.success) {
      heroSlides.push(
        ...mediaRes.data
          .sort((a, b) => a.position - b.position)
          .map(item => ({
            title: item.title,
            subtitle: "",
            media: `/storage/${item.media}`,
            label: item.title,
            type: "media"
          }))
      );
    }

    // =====================
    // HIGHLIGHTED EVENTS
    // =====================
    if (eventRes.success) {
      const highlightedEvents = eventRes.data
        .filter(e => e.highlight === true || e.highlight === "true")
        .map(event => ({
          title: event.name,
          subtitle: "",
          media: `/storage/${event.image}`,
          label: event.name,
          type: "event"
        }));

      heroSlides.push(...highlightedEvents);
    }

    // Optional: control final order
    heroSlides.sort((a, b) => {
      if (a.type === "media" && b.type === "event") return -1;
      if (a.type === "event" && b.type === "media") return 1;
      return 0;
    });

    initializeSlider();
  });

  /* -----------------------------------------------------------
     INIT
  ----------------------------------------------------------- */
  function initializeSlider() {
    function getVisibleCount() {
      return window.innerWidth <= 800 ? 1 : 3;
    }

    VISIBLE = getVisibleCount();
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

  clearTimeout(autoTimer);
  heroVideo.onended = null;

  if (s.media.endsWith(".mp4")) {
    heroVideo.style.display = "block";
    heroImage.style.display = "none";

    heroVideo.src = s.media;
    heroVideo.muted = isMuted;
    heroVideo.load();

    // 🔁 Always advance when video ends
    heroVideo.onended = nextSlide;

    // ▶️ Try autoplay safely
    heroVideo.play().catch(() => {
      // Autoplay blocked — fallback handled below
    });

    // 🛟 Fallback auto-advance (video duration + buffer)
    heroVideo.onloadedmetadata = () => {
      autoTimer = setTimeout(
        nextSlide,
        Math.max(heroVideo.duration * 1000, 3000)
      );
    };

  } else {
    heroVideo.pause();
    heroVideo.style.display = "none";
    heroImage.style.display = "block";

    heroImage.src = s.media;

    // ⏱ Image auto-slide → 5 seconds
    autoTimer = setTimeout(nextSlide, 5000);
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

  const heroModal = document.querySelector(".heroVideoModal");
  const heroPlayer = document.querySelector(".heroVideoPlayer");
  const closeHeroBtn = document.querySelector(".closeHeroVideo");

  function openHeroVideo(src) {
    heroPlayer.src = src;
    heroPlayer.currentTime = 0;
    heroPlayer.play();

    heroModal.classList.add("active");
    document.body.style.overflow = "hidden";
  }

  function closeHeroVideo() {
    heroPlayer.pause();
    heroPlayer.src = "";
    heroModal.classList.remove("active");
    document.body.style.overflow = "";
  }

  closeHeroBtn.addEventListener("click", closeHeroVideo);
  heroModal.querySelector(".heroVideoBackdrop")
    .addEventListener("click", closeHeroVideo);

      const contentContainer = document.querySelector(".contentContainr");

contentContainer.addEventListener("click", (e) => {
  const s = heroSlides[activeIndex];

  if (!s || !s.media.endsWith(".mp4")) return;

  openHeroVideo(s.media);
});

  heroImage.addEventListener("click", () => {
    const s = heroSlides[activeIndex];
    if (s.media.endsWith(".mp4")) {
      openHeroVideo(s.media);
    }
  });

  heroTitle.style.cursor = "pointer";

heroTitle.addEventListener("click", () => {
  const s = heroSlides[activeIndex];
  if (s.media.endsWith(".mp4")) {
    openHeroVideo(s.media);
  }
});

// Optional JS enhancement (recommended)
document.querySelectorAll(".course").forEach(course => {
  const checkbox = course.querySelector("input[type='checkbox']");
  if (!checkbox) return;

  course.addEventListener("click", () => {
    checkbox.checked = !checkbox.checked;
  });
});

document.querySelectorAll(".course").forEach(course => {
  const checkbox = course.querySelector("input[type='checkbox']");
  if (!checkbox) return;

  course.addEventListener("click", (e) => {
    if (e.target.closest("a, button")) return;

    if (window.matchMedia("(hover: hover) and (pointer: fine)").matches) {
      return;
    }

    checkbox.checked = !checkbox.checked;
  });
});
});
