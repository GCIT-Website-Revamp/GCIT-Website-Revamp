gsap.registerPlugin(ScrollTrigger);
    gsap.config({ nullTargetWarn: false });


/* ----------------------------------------
   PAGE BANNER TEXT
-----------------------------------------*/
gsap.fromTo(
    ".pageBannerWrapper .bannerContent",
    { opacity: 0, y: 30 },
    {
        scrollTrigger: {
            trigger: ".pageBannerWrapper",
            start: "top 100%",
        },
        opacity: 1,
        y: 0,
        duration: 0.45,
        ease: "power1.inOut"
    }
);

/* ----------------------------------------
   POST CONTENT (main paragraph fade-up)
-----------------------------------------*/
gsap.fromTo(
    ".postWrapper .post p",
    { opacity: 0, y: 30 },
    {
        scrollTrigger: {
            trigger: ".postWrapper .post",
            start: "top 95%",
        },
        opacity: 1,
        y: 0,
        duration: 0.4,
        ease: "power1.inOut"
    }
);

/* ----------------------------------------
   POST <span> TITLES INSIDE PARAGRAPH
   (Internet / ICT Labs / Maintenance)
-----------------------------------------*/
gsap.fromTo(
    ".postWrapper .post p span",
    { opacity: 0, y: 20 },
    {
        scrollTrigger: {
            trigger: ".postWrapper .post",
            start: "top 90%",
        },
        opacity: 1,
        y: 0,
        duration: 0.35,
        stagger: 0.12,
        ease: "power1.inOut"
    }
);

/* ----------------------------------------
   STAFF CARDS STAGGER
-----------------------------------------*/
gsap.fromTo(
    ".staffProfileWrapper .staff",
    { opacity: 0, y: 30 },
    {
        scrollTrigger: {
            trigger: ".staffProfileWrapper",
            start: "top 92%",
        },
        opacity: 1,
        y: 0,
        duration: 0.45,
        stagger: 0.15,
        ease: "power1.inOut"
    }
);

/* ----------------------------------------
   RIGHT SIDEBAR – OTHER DEPARTMENT
-----------------------------------------*/
gsap.fromTo(
    ".otherDepartment",
    { opacity: 0, y: 25 },
    {
        scrollTrigger: {
            trigger: ".otherDepartment",
            start: "top 95%",
        },
        opacity: 1,
        y: 0,
        duration: 0.4,
        ease: "power1.inOut"
    }
);
