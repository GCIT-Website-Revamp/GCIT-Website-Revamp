document.addEventListener("DOMContentLoaded", () => {
gsap.config({ nullTargetWarn: false });


    // gsap.fromTo(
    //     ".hero-header",
    //     { opacity: 0, y: 35 },
    //     {
    //         opacity: 1,
    //         y: 0,
    //         duration: 0.55,
    //         delay: 0.25,
    //         ease: "power3.out"
    //     }
    // );

    // gsap.fromTo(
    //     ".subtitle",
    //     { opacity: 0, y: 30 },
    //     {
    //         opacity: 1,
    //         y: 0,
    //         duration: 0.5,
    //         delay: 0.35,
    //         ease: "power3.out"
    //     }
    // );
    /* -----------------------------
        ABOUT GCIT - HEADER LINES
    ------------------------------*/
    gsap.fromTo(
        ".aboutGCIT .heading-row",
        { opacity: 0, y: 40 },
        {
            scrollTrigger: {
                trigger: ".aboutGCIT",
                start: "top 90%",
            },
            opacity: 1,
            y: 0,
            duration: 0.55,
            stagger: 0.15,
            ease: "power1.inOut"
        }
    );

    gsap.fromTo(
        ".aboutGCIT .lightText",
        { opacity: 0, y: 30 },
        {
            scrollTrigger: {
                trigger: ".aboutGCIT",
                start: "top 88%",
            },
            opacity: 1,
            y: 0,
            duration: 0.6,
            ease: "power1.inOut"
        }
    );

    gsap.fromTo(
        ".aboutGCIT .ctaWrapper",
        { opacity: 0, y: 20 },
        {
            scrollTrigger: {
                trigger: ".aboutGCIT",
                start: "top 86%",
            },
            opacity: 1,
            y: 0,
            duration: 0.55,
            ease: "power1.inOut"
        }
    );

    /* -----------------------------
        CARDS SECTION
    ------------------------------*/
    gsap.fromTo(
        ".cardWrapper .card",
        { opacity: 0, y: 50 },
        {
            scrollTrigger: {
                trigger: ".cardWrapper",
                start: "top 90%",
            },
            opacity: 1,
            y: 0,
            duration: 0.5,
            stagger: 0.15,
            ease: "power1.inOut"
        }
    );

    /* -----------------------------
        COURSE SECTION
    ------------------------------*/
    gsap.fromTo(
        ".courseWrapper .header",
        { opacity: 0, y: 40 },
        {
            scrollTrigger: {
                trigger: ".courseWrapper",
                start: "top 90%",
            },
            opacity: 1,
            y: 0,
            duration: 0.6,
            ease: "power1.inOut"
        }
    );

    gsap.fromTo(
        ".courseContent .course",
        { opacity: 0, y: 60 },
        {
            scrollTrigger: {
                trigger: ".courseWrapper",
                start: "top 88%",
            },
            opacity: 1,
            y: 0,
            duration: 0.7,
            stagger: 0.2,
            ease: "power1.inOut"
        }
    );

    gsap.fromTo(
        ".courseLinkWrapper a",
        { opacity: 0, x: -20 },
        {
            scrollTrigger: {
                trigger: ".courseLinkContainer",
                start: "top 92%",
            },
            opacity: 1,
            x: 0,
            duration: 0.4,
            stagger: 0.08,
            ease: "power1.inOut"
        }
    );

    /* -----------------------------
        PRESIDENT MESSAGE
    ------------------------------*/
    gsap.fromTo(
        ".messageContent",
        { opacity: 0, x: -50 },
        {
            scrollTrigger: {
                trigger: ".messageWrapper",
                start: "top 90%",
            },
            opacity: 1,
            x: 0,
            duration: 0.6,
            ease: "power1.inOut"
        }
    );

    gsap.fromTo(
        ".presidentImg img",
        { opacity: 0, x: 50 },
        {
            scrollTrigger: {
                trigger: ".messageWrapper",
                start: "top 88%",
            },
            opacity: 1,
            x: 0,
            duration: 0.6,
            ease: "power1.inOut"
        }
    );

    /* -----------------------------
        PROJECT SLIDER SECTION
    ------------------------------*/
    gsap.fromTo(
        ".homeProjectDetails",
        { opacity: 0, x: -40 },
        {
            scrollTrigger: {
                trigger: ".homeProjectWrapper",
                start: "top 90%",
            },
            opacity: 1,
            x: 0,
            duration: 0.6,
            ease: "power1.inOut"
        }
    );

    gsap.fromTo(
        ".projectBanner img",
        { opacity: 0, x: 40 },
        {
            scrollTrigger: {
                trigger: ".homeProjectWrapper",
                start: "top 88%",
            },
            opacity: 1,
            x: 0,
            duration: 0.7,
            stagger: 0.15,
            ease: "power1.inOut"
        }
    );

    /* -----------------------------
        ANNOUNCEMENT CARDS
    ------------------------------*/
    gsap.fromTo(
        ".homeAnnouncementContent .card",
        { opacity: 0, y: 40 },
        {
            scrollTrigger: {
                trigger: ".homeAnnouncementWrapper",
                start: "top 90%",
            },
            opacity: 1,
            y: 0,
            duration: 0.5,
            stagger: 0.15,
            ease: "power1.inOut"
        }
    );

    gsap.fromTo(
        ".suggestion",
        { opacity: 0, x: 30 },
        {
            scrollTrigger: {
                trigger: ".homeAnnouncementWrapper",
                start: "top 88%",
            },
            opacity: 1,
            x: 0,
            duration: 0.45,
            stagger: 0.08,
            ease: "power1.inOut"
        }
    );

    /* -----------------------------
        EVENTS GRID
    ------------------------------*/
    gsap.fromTo(
        ".homeEventWrapper .eventMessage",
        { opacity: 0, y: 40 },
        {
            scrollTrigger: {
                trigger: ".homeEventWrapper",
                start: "top 90%",
            },
            opacity: 1,
            y: 0,
            duration: 0.6,
            ease: "power1.inOut"
        }
    );

    gsap.fromTo(
        ".homeEventWrapper .event",
        { opacity: 0, scale: 0.95 },
        {
            scrollTrigger: {
                trigger: ".homeEventWrapper",
                start: "top 88%",
            },
            opacity: 1,
            scale: 1,
            duration: 0.55,
            stagger: 0.12,
            ease: "power1.inOut"
        }
    );

if (document.querySelector(".courseWrapper")) {
  const startBg = "#ffffff";
  const endBg = "#000f09ff";

  gsap.timeline({
    scrollTrigger: {
      trigger: ".courseWrapper",
      endTrigger: ".messageWrapper",
      start: "top 30%",
      end: "bottom 90%",
      scrub: 0,
    }
  })
  // background goes dark
  .to("body", {
    backgroundColor: endBg,
    ease: "none"
  }, 0)

  // header turns white
  .to(".courseWrapper .main-header", {
    color: "#ffffff",
    ease: "none"
  }, 0)
  
  // Message section text turns white
  .to([".messageWrapper .main-header", ".messageWrapper .presidentName", ".messageWrapper p", ".messageWrapper span"], {
    color: "#ffffff",
    ease: "none"
  }, 0)
  
  // Message section background becomes transparent to show dark body
  .to(".messageWrapper", {
    backgroundColor: "transparent",
    ease: "none"
  }, 0)

  // background returns to white
  .to("body", {
    backgroundColor: startBg,
    ease: "none"
  })

  // header returns to original color
  .to(".courseWrapper .main-header", {
    color: "",
    ease: "none"
  })
  
  // Message section text returns to original
  .to([".messageWrapper .main-header", ".messageWrapper .presidentName", ".messageWrapper p", ".messageWrapper span"], {
    color: "", // clear inline style to revert to CSS
    ease: "none"
  })
  
  // Message section background reverts
  .to(".messageWrapper", {
    backgroundColor: "",
    ease: "none"
  });
}


});
