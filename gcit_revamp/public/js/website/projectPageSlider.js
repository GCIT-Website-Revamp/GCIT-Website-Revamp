document.addEventListener("DOMContentLoaded", () => {
    const wrapper = document.getElementById("projectHighlight");
    if (!wrapper) return;

    const projects = JSON.parse(wrapper.dataset.projects || "[]");
    if (!projects.length) return;

    // Elements
    const imgLink = document.getElementById('homeImgProjectLink')
    const img = document.getElementById("heroImage");
    const title = document.getElementById("heroTitle");
    const desc = document.getElementById("heroDesc");
    const link = document.getElementById("heroLink");

    const leftBtn = wrapper.querySelector(".highlightBtn.left");
    const rightBtn = wrapper.querySelector(".highlightBtn.right");

    let index = 0;

    function render() {
        const project = projects[index];

        // Fade out
        img.style.opacity = 0;
        title.style.opacity = 0;
        desc.style.opacity = 0;

        setTimeout(() => {
            console.log(imgLink)
            imgLink.href = `/post/project/${project.id}`
            img.src = project.image
                ? `/storage/${project.image}`
                : img.src;

            title.textContent = project.name || "";
            desc.innerHTML = project.description
                ? project.description.substring(0, 150) + "…"
                : "";

            link.href = `/post/project/${project.id}`;

            // Fade in
            img.style.opacity = 1;
            title.style.opacity = 1;
            desc.style.opacity = 1;
        }, 250);
    }

    function next() {
        index = (index + 1) % projects.length;
        render();
    }

    function prev() {
        index = (index - 1 + projects.length) % projects.length;
        render();
    }

    rightBtn?.addEventListener("click", next);
    leftBtn?.addEventListener("click", prev);

    // Auto slide
    setInterval(next, 10000);

    render();
});
