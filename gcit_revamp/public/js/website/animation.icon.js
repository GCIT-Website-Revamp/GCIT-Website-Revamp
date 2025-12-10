   document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll(".card");

    cards.forEach(card => {
        const icon = card.querySelector(".globe-icon");

        if (!icon) return;

        // smooth color transition
        icon.style.transition = "color 0.3s ease";

        // Hover on card → animate icon + color
        card.addEventListener("mouseenter", () => {
            gsap.to(icon, {
                rotation: 180,
                duration: 1.4,
                transformOrigin: "50% 50%",
                ease: "power2.out"
            });

            icon.style.color = "rgba(245,131,33,0.85) !important";
        });

        // Reset
        card.addEventListener("mouseleave", () => {
            gsap.to(icon, {
                rotation: 0,
                duration: 1,
                ease: "power2.inOut"
            });

            icon.style.color = "#D4D4D4";
        });
    });
});

    document.addEventListener("DOMContentLoaded", () => {
        const cards = document.querySelectorAll(".card");

        cards.forEach(card => {
            const icon = card.querySelector(".circuit-icon");
            const pulseLine = card.querySelector(".pulse-line");

            if (!icon || !pulseLine) return;

            // hover → pulse animation
            card.addEventListener("mouseenter", () => {
                gsap.fromTo(pulseLine, 
                    {
                        opacity: 0.4,
                        scale: 0.95,
                        transformOrigin: "50% 50%",
                    },
                    
                    {
                        opacity: 1,
                        scale: 1.05,
                        duration: 0.5,
                        ease: "power2.out",
                        repeat: 1,
                        yoyo: true,
                    }
                );
                icon.style.color = "rgba(245,131,33,0.85) !important";

            });

            // leave → reset icon glow
            card.addEventListener("mouseleave", () => {
                gsap.to(pulseLine, {
                    opacity: 0.6,
                    scale: 1,
                    duration: 0.4,
                    ease: "power1.out",
                    filter: "drop-shadow(0 0 0px rgba(0,0,0,0))"
                });
            icon.style.color = "#D4D4D4";

            });
        });
    });


  document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll(".card");

    cards.forEach(card => {
        const icon = card.querySelector(".handshake-icon");

        if (!icon) return;

        icon.style.transition = "color 0.3s ease";

        // Hover → tilt left + tint
        card.addEventListener("mouseenter", () => {
            gsap.to(icon, {
                rotate: 70,     // ← tilted the other direction
                duration: 0.4,
                transformOrigin: "50% 50%",
                ease: "power2.out"
            });

            icon.style.color = "rgba(245,131,33,0.85)";
        });

        // Reset
        card.addEventListener("mouseleave", () => {
            gsap.to(icon, {
                rotate: 0,
                duration: 0.4,
                ease: "power2.inOut"
            });

            icon.style.color = "#D4D4D4";
        });
    });
});
