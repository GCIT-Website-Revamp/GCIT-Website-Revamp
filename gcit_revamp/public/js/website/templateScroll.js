
   document.addEventListener("DOMContentLoaded", () => {
    gsap.config({ nullTargetWarn: false });

    gsap.fromTo(
        ".pageBannerWrapper .bannerContent",
        { opacity: 0, y: 40 },
        {
            scrollTrigger: {
                trigger: ".pageBannerWrapper",
                start: "top 95%",
            },
            opacity: 1,
            y: 0,
            duration: 0.6,
            ease: "power3.out"
        }
    );

    gsap.fromTo(
        ".pageBannerWrapper .breadCrumbs",
        { opacity: 0, y: 30 },
        {
            scrollTrigger: {
                trigger: ".pageBannerWrapper",
                start: "top 90%",
            },
            opacity: 1,
            y: 0,
            duration: 0.45,
            ease: "power2.out"
        }
    );

    gsap.fromTo(
        ".pageBannerWrapper .contentWrapper h1",
        { opacity: 0, y: 35 },
        {
            scrollTrigger: {
                trigger: ".pageBannerWrapper",
                start: "top 88%",
            },
            opacity: 1,
            y: 0,
            duration: 0.55,
            ease: "power3.out"
        }
    );

    gsap.fromTo(
        ".pageBannerWrapper .contentWrapper p",
        { opacity: 0, y: 25 },
        {
            scrollTrigger: {
                trigger: ".pageBannerWrapper",
                start: "top 85%",
            },
            opacity: 1,
            y: 0,
            duration: 0.5,
            ease: "power2.out"
        }
    );
   gsap.registerPlugin(ScrollTrigger);

    /* ----------------------------------
        EVENTS PAGE — EVENT CARDS
    ----------------------------------*/
    gsap.fromTo(
        ".eventsWrapper .mainContent .card",
        { opacity: 0, y: 40 },
        {
            scrollTrigger: {
                trigger: ".eventsWrapper",
                start: "top 90%",
            },
            opacity: 1,
            y: 0,
            duration: 0.45,
            ease: "power2.out",
            stagger: 0.12
        }
    );

    /* ----------------------------------
        FILTER SIDEBAR — SLIDE IN
    ----------------------------------*/
    gsap.fromTo(
        ".eventsWrapper .filterWrapper",
        { opacity: 0, x: 40 },
        {
            scrollTrigger: {
                trigger: ".eventsWrapper",
                start: "top 88%",
            },
            opacity: 1,
            x: 0,
            duration: 0.5,
            ease: "power3.out"
        }
    );

    /* ----------------------------------
        FILTER CHECKBOXES — SMALL STAGGER
    ----------------------------------*/
    gsap.fromTo(
        ".filterContainer .filter",
        { opacity: 0, x: 15 },
        {
            scrollTrigger: {
                trigger: ".filterWrapper",
                start: "top 92%",
            },
            opacity: 1,
            x: 0,
            duration: 0.35,
            ease: "power2.out",
            stagger: 0.1
        }
    );

});