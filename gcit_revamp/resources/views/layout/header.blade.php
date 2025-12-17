<!-- ===================== DESKTOP NAV ===================== -->
<nav class="fullSize">
    <div class="navContent wrapper">
        <div class="logoWrapper">
            <a href="/">
                <img src="{{ asset('images/logo/logo2.png') }}" alt="GCIT Logo">
            </a>
        </div>

        <div class="linkWrapper">
            <!-- ABOUT GCIT -->
            <div class="dropDownWrapper">
                <label class="dropDownLink">
                    About GCIT <span class="material-symbols-outlined">arrow_drop_down</span>
                </label>
                <div class="dropDownContent">
                    <a href="/about">Institutional Overview</a>
                    <label>Support & Services</label>
                    <a class = "subLink" href="/department/Finance">Finance</a>
                    <a class = "subLink" href="/department/Human Resources & Administration">Human Resources & Administration</a>
                    <a class = "subLink" href="/department/Information & Communication Technology">Information & Communication Technology</a>
                    <a class = "subLink" href="/department/School Affairs">School Affairs</a>
                    <a class = "subLink" href="/department/Student Affairs">Student Affairs</a>
                </div>
            </div>

            <!-- INITIATIVE -->
            <div class="dropDownWrapper">
                <label class="dropDownLink">
                    Initiative <span class="material-symbols-outlined">arrow_drop_down</span>
                </label>
                <div class="dropDownContent">
                    <a href="/announcements">Announcements</a>
                    <a href="/news&events">News & Events</a>
                    <a href="/project">Industry Projects</a>
                </div>
            </div>

            <!-- STUDY -->
            <div class="dropDownWrapper">
                <label class="dropDownLink">
                    Study <span class="material-symbols-outlined">arrow_drop_down</span>
                </label>
                <div class="dropDownContent">
                    <a href="/resources/Admission">Admissions</a>
                    <a href="/course">Courses</a>
                    <a href="/resources/Student-Welfare">Student Services</a>
                </div>
            </div>

            <!-- SEARCH -->
            <div class="searchWrapper">
                <input type="text" class="searchInput" placeholder="Search..." data-search-input>
                <span class="material-symbols-outlined searchIcon">search</span>
            </div>

        </div>
    </div>

    <!-- Dropdown extender -->
    <div class="dropDownExtender"></div>

    <!-- Sub navigation -->
    <div class="wrapper subNav">
        <div class="subLinkWrapper font-xs">
            <!-- <a href="">Alumni</a> -->
            <a href="">CETA</a>
            <a href="">Contact Us</a>
            <a href="/faculty">Faculty</a>
        </div>
    </div>
</nav>

<!-- ===================== MOBILE NAV ===================== -->
<input type="checkbox" id="miniNavToggle">

<nav class="mini">
    <div class="miniMainBar wrapper">
        <div class="miniLogoWrapper">
            <a href="/">
                <img src="{{ asset('images/logo/logo2.png') }}" alt="GCIT Logo">
            </a>
        </div>
        <div class="miniNavContent">
            <label for="miniNavToggle" class="toggleSpan">
                <span class="material-symbols-outlined">menu</span>
            </label>
        </div>
    </div>
</nav>

<!-- ===================== MOBILE OVERLAY ===================== -->
<div class="miniTopNav" id="miniTopNav">

    <div class="closeWrapper">
        <label for="miniNavToggle" class="toggleSpan">
            <span class="material-symbols-outlined">close</span>
        </label>
    </div>

    <!-- Search -->
    <div class="searchContainer">
        <div class="searchWrapper">
            <input type="text" class="searchInput" placeholder="Search..." data-search-input>
            <span class="material-symbols-outlined searchIcon">search</span>
        </div>
    </div>

    <!-- Main mobile links -->
    <div class="miniNavBody">
        <div class="miniLinkWrapper">
            <label for="miniAbout">About GCIT <span class="material-symbols-outlined">chevron_right</span></label>
            <label for="miniInitiative">Initiative <span class="material-symbols-outlined">chevron_right</span></label>
            <label for="miniStudy">Study <span class="material-symbols-outlined">chevron_right</span></label>
        </div>

        <div class="miniQuickLinkWrapper">
            <!-- <a href="">Alumni</a> -->
            <a href="">CETA</a>
            <a href="">Contact Us</a>
            <a href="/faculty">Faculty</a>
        </div>
    </div>
</div>

<!-- ===================== MOBILE SUBMENUS ===================== -->
<input type="checkbox" id="miniStudy" hidden>
<input type="checkbox" id="miniAbout" hidden>
<input type="checkbox" id="miniInitiative" hidden>

<!-- STUDY -->
<div class="miniStudyWrapper miniSubLinkContainer">
    <div class="backWrapper">
        <label for="miniStudy">
            <span class="material-symbols-outlined">chevron_right</span>
        </label>
    </div>
    <div class="subMiniLinkWrapper">
        <h1>Study</h1>
        <a href="/resources/Admission">Admissions<span class="material-symbols-outlined">chevron_right</span></a>
        <a href="/course">Courses<span class="material-symbols-outlined">chevron_right</span></a>
        <a href="/resources/Student-Welfare">Student Services<span class="material-symbols-outlined">chevron_right</span></a>
    </div>
</div>

<!-- ABOUT GCIT -->
<div class="miniAboutWrapper miniSubLinkContainer">
    <div class="backWrapper">
        <label for="miniAbout">
            <span class="material-symbols-outlined">chevron_right</span>
        </label>
    </div>
    <div class="subMiniLinkWrapper">
        <h1>About GCIT</h1>
        <a href="/about">Institutional Overview<span class="material-symbols-outlined">chevron_right</span></a>
        <label>Support & Services</label>
        <a href="/department/Finance">Finance<span class="material-symbols-outlined">chevron_right</span></a>
        <a href="/department/Human Resources & Administration">Human Resources & Administration<span class="material-symbols-outlined">chevron_right</span></a>
        <a href="/department/Information & Communication Technology">Information & Communication Technology<span class="material-symbols-outlined">chevron_right</span></a>
        <a href="/department/School Affairs">School Affairs<span class="material-symbols-outlined">chevron_right</span></a>
        <a href="/department/Student Affairs">Student Affairs<span class="material-symbols-outlined">chevron_right</span></a>    </div>
</div>

<!-- INITIATIVE -->
<div class="miniInitiativeWrapper miniSubLinkContainer">
    <div class="backWrapper">
        <label for="miniInitiative">
            <span class="material-symbols-outlined">chevron_right</span>
        </label>
    </div>
    <div class="subMiniLinkWrapper">
        <h1>Initiative</h1>
        <a href="/announcements">Announcements<span class="material-symbols-outlined">chevron_right</span></a>
        <a href="/news&events">News & Events<span class="material-symbols-outlined">chevron_right</span></a>
        <a href="/project">Industry Projects<span class="material-symbols-outlined">chevron_right</span></a>
    </div>
</div>
