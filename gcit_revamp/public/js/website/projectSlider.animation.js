document.addEventListener("DOMContentLoaded", () => {
    const highlight = document.querySelector(".highlight");
    if (!highlight) return;

    const bgImg  = highlight.querySelector("img");
    const title  = highlight.querySelector(".content h1");
    const desc   = highlight.querySelector(".content p");

    const leftBtn  = highlight.querySelector(".highlightBtn.left");
    const rightBtn = highlight.querySelector(".highlightBtn.right");

    // 🔥 Define your slides here (later this can come from Blade)
    const slides = [
        {
            image: "/images/projects/dummyImg.png",
            title: "Finance Application",
            desc: "Driving Bhutan’s digital transformation through excellence in education, research, and technology."
        },
        {
            image: "/images/projects/dummyImg.png",
            title: "Gyalsung Allocation System",
            desc: "Enabling rapid and smart allocation for all gyalsung related activities."
        },
        {
            image: "/images/projects/dummyImg.png",
            title: "Parking.bt",
            desc: "Transforming the parking sector of Bhutan, one city at a time."
        }
    ];

    let index = 0;

    function updateSlide(direction = 0) {
        index = (index + direction + slides.length) % slides.length;
        const slide = slides[index];

        gsap.to([bgImg, title, desc], {
            opacity: 0,
            duration: 0.2,
            onComplete: () => {
                bgImg.src = slide.image;
                title.textContent = slide.title;
                desc.textContent = slide.desc;

                gsap.to([bgImg, title, desc], {
                    opacity: 1,
                    duration: 0.3
                });
            }
        });
    }

    // Initial render
    updateSlide(0);

    rightBtn.addEventListener("click", () => updateSlide(1));
    leftBtn.addEventListener("click", () => updateSlide(-1));
});
