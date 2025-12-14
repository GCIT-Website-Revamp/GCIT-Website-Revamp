<nav class = "fullSize">
    <div class="navContent wrapper">
        <div class="logoWrapper">
            <a href="/">
                <img src="{{ asset('images/logo/logo2.png') }}" alt="">
            </a>
        </div>
        <div class="linkWrapper">
            <div class="dropDownWrapper">
                <label class = "dropDownLink" for="academicToggle">Academics<span class="material-symbols-outlined">arrow_drop_down</span></label>
                <div class="dropDownContent">
                    <a href="/course">Courses</a>
                    
                </div>
            </div>
            <div class="dropDownWrapper">
                <label class = "dropDownLink" for="academicToggle">About GCIT<span class="material-symbols-outlined">arrow_drop_down</span></label>
                <div class="dropDownContent">
                    <a href="/about">Institutional Overview</a>
                    <label>Non Academics</label>
                    <a class = "subLink" href="/department/Finance">Finance</a>
                    <a class = "subLink" href="/department/Human Resources & Administration">Human Resources & Administration</a>
                    <a class = "subLink" href="/department/Information & Communication Technology">Information & Communication Technology</a>
                    <a class = "subLink" href="/department/School Affairs">School Affairs</a>
                    <a class = "subLink" href="/department/Student Affairs">Student Affairs</a>
                </div>
            </div>
            <div class="dropDownWrapper">
                <label class = "dropDownLink" for="academicToggle">Students<span class="material-symbols-outlined">arrow_drop_down</span></label>
                 <div class="dropDownContent">
                    <a href="/resources/Admission">Admissions</a>
                    <label>Student Services</label>
                    <a class = "subLink" href="/clubs">Clubs</a>
                    <a class = "subLink" href="/resources/ICT">ICT</a>
                    <a class = "subLink" href="/resources/Student-Welfare">Student Welfare</a>
                </div>
            </div>
            <div class="dropDownWrapper">
                <label class = "dropDownLink" for="academicToggle">Tech Impact<span class="material-symbols-outlined">arrow_drop_down</span></label>
                <div class="dropDownContent">
                    <a href="/project">Industry Projects</a>
                    <!-- <a href="">Partners & Collaboration</a>
                    <a href="">Research</a> -->
                </div>
            </div>
            <div class="dropDownWrapper">
                <label class = "dropDownLink" for="academicToggle">Updates<span class="material-symbols-outlined">arrow_drop_down</span></label>
                <div class="dropDownContent">
                    <a href="/news&events">News & Events</a>
                    <a href="/announcements">Announcements</a>
                </div>
                    
            </div>
            <div class="searchWrapper">
                <input type="text" class="searchInput" placeholder="Search..." />
                <span class="material-symbols-outlined searchIcon">search</span>
            </div>        
        </div> 
    </div>
    <div class="dropDownExtender"></div>
    <div class="wrapper subNav">
    <div class="subLinkWrapper font-xs">
        <a href="">Alumini</a>
        <a href="">CETA</a>
        <a href="">Contact Us</a>
        <a href="/faculty">Faculty</a>
    </div>
    </div>

</nav>

<input type="checkbox" id="miniNavToggle">
<nav class="mini">
    <div class="miniMainBar wrapper">
        <div class="miniLogoWrapper">
            <img src="{{ asset('images/logo/logo2.png') }}" alt="">
        </div>
        <div class="miniNavContent">
            <div class="searchWrapper">
                <input type="text" class="searchInput" placeholder="Search..." />
                <span class="material-symbols-outlined searchIcon">search</span>
            </div>      
            <label for="miniNavToggle" class = "toggleSpan">
                <span class="material-symbols-outlined">menu</span>
            </label>
        </div>
    </div>
</nav>
<div class="miniTopNav" id = "miniTopNav">
    <div class="closeWrapper">
        <label for="miniNavToggle" class = "toggleSpan">
            <span class="material-symbols-outlined">close</span>
        </label>
    </div>
    <div class="miniNavBody">
        <div class="miniLinkWrapper">
            <label for="miniAcademics">Academics <span class="material-symbols-outlined">chevron_right</span></label>
            <label for="miniAbout">About GCIT<span class="material-symbols-outlined">chevron_right</span></label>
            <label for="miniStudents">Students <span class="material-symbols-outlined">chevron_right</span></label>
            <label for="miniTechImpact">Tech Impact<span class="material-symbols-outlined">chevron_right</span></label>
            <label for="miniUpdates">Updates <span class="material-symbols-outlined">chevron_right</span></label>
        </div>
        <div class="miniQuickLinkWrapper">
            <h1>Quick Links</h1>
            <a href="">Alumini</a>
            <a href="">CETA</a>
            <a href="">Contact Us</a>
            <a href="/faculty">Faculty</a>
        </div>
    </div>
</div>
<input type="checkbox" id="miniAcademics" hidden>
<input type="checkbox" id="miniAbout" hidden>
<input type="checkbox" id="miniStudents" hidden>
<input type="checkbox" id="miniTechImpact" hidden>
<input type="checkbox" id="miniUpdates" hidden>

<div class="miniAcademicsWrapper miniSubLinkContainer">
    <div class="backWrapper">
        <label for="miniAcademics"><span class="material-symbols-outlined">chevron_right</span></label>
    </div>
    <div class="subMiniLinkWrapper">
        <h1>Academics</h1>
        <a href="/course">Courses<span class="material-symbols-outlined">chevron_right</span></a>
    </div>
</div>
<div class="miniAboutWrapper miniSubLinkContainer">
    <div class="backWrapper">
        <label for="miniAbout"><span class="material-symbols-outlined">chevron_right</span></label>
    </div>
    <div class="subMiniLinkWrapper">
        <h1>About GCIT</h1>
        <a href="/about">Institutional Overview</a>
        <label>Non Academics</label>
        <a href="/department/Finance">Finance<span class="material-symbols-outlined">chevron_right</span></a>
        <a href="/department/Human Resources & Administration">Human Resources & Administration<span class="material-symbols-outlined">chevron_right</span></a>
        <a href="/department/Information & Communication Technology">Information & Communication Technology<span class="material-symbols-outlined">chevron_right</span></a>
        <a href="/department/School Affairs">School Affairs<span class="material-symbols-outlined">chevron_right</span></a>
        <a href="/department/Student Affairs">Student Affairs<span class="material-symbols-outlined">chevron_right</span></a>
    </div>
</div>
<div class="miniStudentWrapper miniSubLinkContainer">
    <div class="backWrapper">
        <label for="miniStudents"><span class="material-symbols-outlined">chevron_right</span></label>
    </div>
    <div class="subMiniLinkWrapper">
        <h1>Students</h1>
        <a href="/resources/Admission">Admissions<span class="material-symbols-outlined">chevron_right</span></a>
        <label>Student Services</label>
        <a href="/clubs">Clubs<span class="material-symbols-outlined">chevron_right</span></a>
        <a href="/resources/ICT">ICT<span class="material-symbols-outlined">chevron_right</span></a>
        <a href="/resources/Student-Welfare">Student Welfare<span class="material-symbols-outlined">chevron_right</span></a>
    </div>
</div>
<div class="miniTechImpactWrapper  miniSubLinkContainer">
    <div class="backWrapper">
        <label for="miniTechImpact"><span class="material-symbols-outlined">chevron_right</span></label>
    </div>
    <div class="subMiniLinkWrapper">
        <h1>Tech Impact</h1>
        <a href="/project">Industry Projects<span class="material-symbols-outlined">chevron_right</span></a>
    </div>
</div>
<div class="miniUpdatesWrapper miniSubLinkContainer">
    <div class="backWrapper">
        <label for="miniUpdates"><span class="material-symbols-outlined">chevron_right</span></label>
    </div>
    <div class="subMiniLinkWrapper">
        <h1>Updates</h1>
        <a href="/news&events">News & Events<span class="material-symbols-outlined">chevron_right</span></a>
        <a href="/announcements">Announcements<span class="material-symbols-outlined">chevron_right</span></a>    </div>
</div>