@extends('layout.app')

@section('title', 'Home')

@section('content')
<div class="pageBannerWrapper">
    <div class="backgroundWrapper">
        <div class="overlay"></div>
        <img src="{{ asset('images/pageBanner.png') }}" alt="">
    </div>
    <div class="bannerContent">
        <div class="breadCrumbs">
            <a href="">Home</a>
            <span class="material-symbols-outlined">keyboard_arrow_right</span>
            <a href="">Academics</a>
            <span class="material-symbols-outlined">keyboard_arrow_right</span>
            <a href="">AI Development & Data Science</a>
        </div>
        <div class="contentWrapper">
            <h2>Bachelors of Computer Science:</h2>
            <h1>AI Development & Data Science</h1>
        </div>
    </div>
</div>

<div class="pageContentWrapper">
    <div class="section">
        <div class="courseDetailsContainer">

            <!-- ------------------------------
                 LEFT SIDE MENU (linked)
            ------------------------------- -->
            <div class="sideMenu">
                <div class="menuSection">
                    <div class="header">
                        <div class="circle"></div>
                        <h1>About Course</h1>
                    </div>
                    <a href="#why-this-program">Why This Program?</a>
                    <a href="#what-would-i-learn">What Would I Learn?</a>
                    <a href="#program-structure">Program Structure</a>
                    <a href="#career-prospects">Your Career Prospects</a>
                </div>

                <div class="menuSection">
                    <div class="header">
                        <div class="circle"></div>
                        <h1>Course Modules</h1>
                    </div>

                    <a href="#year1-sem1">Year I Sem I</a>
                    <a href="#year1-sem2">Year I Sem II</a>
                    <a href="#year2-sem1">Year II Sem I</a>
                    <a href="#year2-sem2">Year II Sem II</a>
                    <a href="#year3-sem1">Year III Sem I</a>
                    <a href="#year3-sem2">Year III Sem II</a>
                    <a href="#year4-sem1">Year IV Sem I</a>
                    <a href="#year4-sem2">Year IV Sem II</a>
                </div>
            </div>

            <!-- ------------------------------
                 RIGHT CONTENT SECTION
            ------------------------------- -->
            <div class="courseDetails">

                <div class="courseDetailsWrapper">

                    <div class="courseHeaderWrapper">
                        <h1>Ready to become a Full-Stack Development Wizard?</h1>
                        <p>This program offers a comprehensive education ...</p>
                    </div>

                    <!-- ABOUT COURSE SECTIONS (anchor targets) -->
                    <div class="courseDetailContent whythisprogram" id="why-this-program">
                        <input type="checkbox" id="whyProgram">
                        <label for="whyProgram"><h1>Why This Program? <span class="material-symbols-outlined">keyboard_arrow_right</span></h1></label>
                        <p>You will gain the expertise required...</p>
                    </div>

                    <div class="courseDetailContent whatwouldilearn" id="what-would-i-learn">
                        <input type="checkbox" id="learn">
                        <label for="learn"><h1>What Would I Learn? <span class="material-symbols-outlined">keyboard_arrow_right</span></h1></label>
                        <p>You will gain the expertise required...</p>
                    </div>

                    <div class="courseDetailContent programstructure" id="program-structure">
                        <input type="checkbox" id="structure">
                        <label for="structure"><h1>Program Structure <span class="material-symbols-outlined">keyboard_arrow_right</span></h1></label>
                        <p>You will gain the expertise required...</p>
                    </div>

                    <div class="courseDetailContent careerprospects" id="career-prospects">
                        <input type="checkbox" id="career">
                        <label for="career"><h1>Your Career Prospects <span class="material-symbols-outlined">keyboard_arrow_right</span></h1></label>
                        <p>You will gain the expertise required...</p>
                    </div>
                </div>


                <!-- ------------------------------
                     MODULES SECTION
                ------------------------------- -->
                <div class="courseDetailsWrapper mt-3">

                    <div class="courseHeaderWrapper">
                        <h1>Course Modules</h1>
                        <p>Students will have to complete 60 credits ...</p>
                    </div>

                    <!-- YEAR I — SEM I -->
                    <div class="courseDetailContent moduleDropdown" id="year1-sem1">
                        <input type="checkbox" id="year1sem1">
                        <label for="year1sem1">
                            <h1>Year I, Sem I <span class="material-symbols-outlined">keyboard_arrow_right</span></h1>
                        </label>
                        <p>...</p>
                    </div>

                    <!-- YEAR I — SEM II -->
                    <div class="courseDetailContent moduleDropdown" id="year1-sem2">
                        <input type="checkbox" id="year1sem2">
                        <label for="year1sem2">
                            <h1>Year I, Sem II <span class="material-symbols-outlined">keyboard_arrow_right</span></h1>
                        </label>
                        <p>...</p>
                    </div>

                    <!-- YEAR II — SEM I -->
                    <div class="courseDetailContent moduleDropdown" id="year2-sem1">
                        <input type="checkbox" id="year2sem1">
                        <label for="year2sem1">
                            <h1>Year II, Sem I <span class="material-symbols-outlined">keyboard_arrow_right</span></h1>
                        </label>
                        <p>...</p>
                    </div>

                    <!-- YEAR II — SEM II -->
                    <div class="courseDetailContent moduleDropdown" id="year2-sem2">
                        <input type="checkbox" id="year2sem2">
                        <label for="year2sem2">
                            <h1>Year II, Sem II <span class="material-symbols-outlined">keyboard_arrow_right</span></h1>
                        </label>
                        <p>...</p>
                    </div>

                    <!-- YEAR III — SEM I -->
                    <div class="courseDetailContent moduleDropdown" id="year3-sem1">
                        <input type="checkbox" id="year3sem1">
                        <label for="year3sem1">
                            <h1>Year III, Sem I <span class="material-symbols-outlined">keyboard_arrow_right</span></h1>
                        </label>
                        <p>...</p>
                    </div>

                    <!-- YEAR III — SEM II -->
                    <div class="courseDetailContent moduleDropdown" id="year3-sem2">
                        <input type="checkbox" id="year3sem2">
                        <label for="year3sem2">
                            <h1>Year III, Sem II <span class="material-symbols-outlined">keyboard_arrow_right</span></h1>
                        </label>
                        <p>...</p>
                    </div>

                    <!-- YEAR IV — SEM I -->
                    <div class="courseDetailContent moduleDropdown" id="year4-sem1">
                        <input type="checkbox" id="year4sem1">
                        <label for="year4sem1">
                            <h1>Year IV, Sem I <span class="material-symbols-outlined">keyboard_arrow_right</span></h1>
                        </label>
                        <p>...</p>
                    </div>

                    <!-- YEAR IV — SEM II -->
                    <div class="courseDetailContent moduleDropdown" id="year4-sem2">
                        <input type="checkbox" id="year4sem2">
                        <label for="year4sem2">
                            <h1>Year IV, Sem II <span class="material-symbols-outlined">keyboard_arrow_right</span></h1>
                        </label>
                        <p>...</p>
                    </div>

                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="otherCourseContainer">
                <div class="header">
                    <h1>More on Academics</h1>
                </div>
                <div class="otherContent">
                    <h1>Other Courses</h1>
                    <a href="">Full Stack Development</a>
                    <a href="">Blockchain Development</a>
                    <a href="">Cybersecurity</a>
                    <a href="">Interactive Design & Development</a>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
