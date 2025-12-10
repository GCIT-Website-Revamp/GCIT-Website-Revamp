document.addEventListener("DOMContentLoaded", () => {
    gsap.config({ nullTargetWarn: false });

    gsap.registerPlugin(ScrollTrigger);

    const OFFSET = 170; // sticky header height

    const sections = document.querySelectorAll(
        "#why-this-program, #what-would-i-learn, #program-structure, #career-prospects, \
         #year1-sem1, #year1-sem2, #year2-sem1, #year2-sem2, \
         #year3-sem1, #year3-sem2, #year4-sem1, #year4-sem2"
    );

    const menuLinks = document.querySelectorAll(".sideMenu a[href^='#']");

    /* -------------------------------
       ScrollSpy (Highlight Sync)
    ------------------------------- */
    sections.forEach(section => {
        ScrollTrigger.create({
            trigger: section,
            start: `top top+=${OFFSET}`,
            end: `bottom top+=${OFFSET}`,
            onEnter: () => setActive(section.id),
            onEnterBack: () => setActive(section.id),
        });
    });

    function setActive(id) {
        menuLinks.forEach(link => {
            link.classList.toggle("active", link.getAttribute("href") === `#${id}`);
        });
    }

    /* -------------------------------
       Click Handler + Offset Scroll
       + Auto-open Dropdown
    ------------------------------- */
    menuLinks.forEach(link => {
        link.addEventListener("click", (e) => {
            e.preventDefault();

            const targetId = link.getAttribute("href").substring(1);
            const target = document.getElementById(targetId);
            if (!target) return;

            // Smooth scroll with offset
            const targetY =
                target.getBoundingClientRect().top +
                window.pageYOffset -
                OFFSET;

            window.scrollTo({
                top: targetY,
                behavior: "smooth"
            });

            // Highlight immediately
            setActive(targetId);

            // ---------- AUTO-OPEN DROPDOWN ----------
            autoOpenDropdown(target);
        });
    });

    /* -------------------------------
       Auto-Open Logic
    ------------------------------- */
    function autoOpenDropdown(section) {
        // Example section: <div id="year1-sem1" class="courseDetailContent moduleDropdown">

        // Find the checkbox inside this section, if it exists
        const checkbox = section.querySelector("input[type='checkbox']");

        if (checkbox) {
            // OPTIONAL — close all other dropdowns first
            document.querySelectorAll(".courseDetailContent input[type='checkbox']").forEach(cb => {
                if (cb !== checkbox) cb.checked = false;
            });

            // Open this one
            checkbox.checked = true;
        }
    }
});
