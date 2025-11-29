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
            <div class="sideMenu">
                <div class="menuSection">
                    <div class="header">
                        <div class="circle"></div>
                        <h1>About Course</h1>
                    </div>
                    <a href="">Why This Program?</a>
                    <a href="">What Would I Learn?</a>
                    <a href="">Program Structure</a>
                    <a href="">Your Career Prospects</a>
                </div>
                <div class="menuSection">
                    <div class="header">
                        <div class="circle"></div>
                        <h1>Course Modules</h1>
                    </div>
                    <a href="">Year I Sem I</a>
                    <a href="">Year I Sem II</a>
                    <a href="">Year II Sem I</a>
                    <a href="">Year II Sem II</a>
                    <a href="">Year III Sem I</a>
                    <a href="">Year III Sem II</a>
                    <a href="">Year IV Sem I</a>
                    <a href="">Year IV Sem II</a>
                </div>
            </div>
            <div class="courseDetails">
                <div class="courseDetailsWrapper">

                    <div class="courseHeaderWrapper">
                        <h1>Ready to become 
                            a Full-Stack 
                            Development Wizard? </h1>
                            <p>This program offers a comprehensive education in the latest tools and technologies for advanced web, mobile and API application development, covering 3-tier architecture. You will be able to use your wizard skills to develop modern front-end and back-end applications with knowledge in HTML, CSS, Javascript, NodeJS, React Native, Go-Lang along with popular frameworks.</p>

                    </div>
                    <div class="courseDetailContent whythisprogram">
                        <input type="checkbox" id = "whyProgram">
                        <label for="whyProgram"><h1>Why This Program? <span class="material-symbols-outlined">keyboard_arrow_right</span></h1></label>
                        <p>You will gain the expertise required to build engaging web and/or mobile applications.
                            You can implement the underlying cloud infrastructure and technologies necessary for rapid deployment of these applications to the world.
                            You have the opportunity to use DevOps techniques to improve and automate the software development and delivery process, streamlining the development cycle and ensuring the timely release of high-quality products.</p>
                    </div>
                    <div class="courseDetailContent whatwouldilearn">
                        <input type="checkbox" id = "learn">
                                <label for="learn"><h1>What Would I Learn? <span class="material-symbols-outlined">keyboard_arrow_right</span></h1></label>

                                <p>You will gain the expertise required to build engaging web and/or mobile applications.
                                    You can implement the underlying cloud infrastructure and technologies necessary for rapid deployment of these applications to the world.
                                    You have the opportunity to use DevOps techniques to improve and automate the software development and delivery process, streamlining the development cycle and ensuring the timely release of high-quality products.</p>
                    </div>
                    <div class="courseDetailContent programstructure">
                        <input type="checkbox" id = "structure">
                        <label for="structure"><h1>Program Structure <span class="material-symbols-outlined">keyboard_arrow_right</span></h1></label>

                        <p>You will gain the expertise required to build engaging web and/or mobile applications.
                        You can implement the underlying cloud infrastructure and technologies necessary for rapid deployment of these applications to the world.
                        You have the opportunity to use DevOps techniques to improve and automate the software development and delivery process, streamlining the development cycle and ensuring the timely release of high-quality products.</p>
                    </div>
                    <div class="courseDetailContent careerprospects">
                        <input type="checkbox" id = "career">
                        <label for="career"><h1>Your Career Prospects <span class="material-symbols-outlined">keyboard_arrow_right</span></h1></label>

                        <p>You will gain the expertise required to build engaging web and/or mobile applications.
                            You can implement the underlying cloud infrastructure and technologies necessary for rapid deployment of these applications to the world.
                            You have the opportunity to use DevOps techniques to improve and automate the software development and delivery process, streamlining the development cycle and ensuring the timely release of high-quality products.</p>
                    </div>
                    
                    
                </div>
                <div class="courseDetailsWrapper mt-3">
                    <div class="courseHeaderWrapper">
                        <h1>Course Modules </h1>
                            <p>Students will have to complete 60 credits in each semester. In total, a student has to complete 480 credits to be eligible for the award of a Bachelor of Computer Science (Full Stack Development).</p>
                    </div>
                   <!-- YEAR I — SEM I -->
<div class="courseDetailContent moduleDropdown">
    <input type="checkbox" id="year1sem1">
    <label for="year1sem1">
        <h1>Year I, Sem I <span class="material-symbols-outlined">keyboard_arrow_right</span></h1>
    </label>

    <p>
        <strong>Introduction to Computing</strong><br>
        A foundational module covering basic computer operations, digital literacy, and essential problem-solving techniques.
        <br><br>

        <strong>Programming Basics</strong><br>
        Students learn variables, data types, loops, and conditions through simple hands-on coding exercises.
        <br><br>

        <strong>Web Foundations</strong><br>
        An introduction to HTML and CSS for building basic responsive web pages.
        <br><br>

        <strong>Mathematics for IT</strong><br>
        Covers logical reasoning, sets, functions, and basic statistics relevant to computing.
        <br><br>

        <strong>Communication Skills I</strong><br>
        Focuses on academic writing and effective oral communication for university-level study.
    </p>
</div>

<!-- YEAR I — SEM II -->
<div class="courseDetailContent moduleDropdown">
    <input type="checkbox" id="year1sem2">
    <label for="year1sem2">
        <h1>Year I, Sem II <span class="material-symbols-outlined">keyboard_arrow_right</span></h1>
    </label>

    <p>
        <strong>Object-Oriented Programming</strong><br>
        Students are introduced to objects, classes, inheritance, and abstraction using a high-level language.
        <br><br>

        <strong>Front-End Development I</strong><br>
        Covers advanced HTML, CSS, and JavaScript fundamentals to create interactive web pages.
        <br><br>

        <strong>Networking Essentials</strong><br>
        Learn basic networking concepts including IP addressing, routers, switches, and protocols.
        <br><br>

        <strong>Database Fundamentals</strong><br>
        Introduction to SQL, relational models, and simple query writing.
        <br><br>

        <strong>Communication Skills II</strong><br>
        Builds on previous communication modules with a focus on professional writing.
    </p>
</div>

<!-- YEAR II — SEM I -->
<div class="courseDetailContent moduleDropdown">
    <input type="checkbox" id="year2sem1">
    <label for="year2sem1">
        <h1>Year II, Sem I <span class="material-symbols-outlined">keyboard_arrow_right</span></h1>
    </label>

    <p>
        <strong>Advanced Programming</strong><br>
        Deep dive into data structures, algorithms, and memory management concepts.
        <br><br>

        <strong>Systems Analysis</strong><br>
        Covers requirement gathering, system modelling, and documentation processes.
        <br><br>

        <strong>Operating Systems Concepts</strong><br>
        Learn about processes, threads, scheduling, memory management, and file systems.
        <br><br>

        <strong>Web Development II</strong><br>
        Introduces JavaScript frameworks and modern front-end workflows.
        <br><br>

        <strong>Statistics for Computing</strong><br>
        Focus on probability, distributions, regression, and data interpretation.
    </p>
</div>

<!-- YEAR II — SEM II -->
<div class="courseDetailContent moduleDropdown">
    <input type="checkbox" id="year2sem2">
    <label for="year2sem2">
        <h1>Year II, Sem II <span class="material-symbols-outlined">keyboard_arrow_right</span></h1>
    </label>

    <p>
        <strong>Software Engineering</strong><br>
        Students learn SDLC models, version control, testing, and collaborative development.
        <br><br>

        <strong>Database Systems II</strong><br>
        Covers relational design, normalization, and query optimization.
        <br><br>

        <strong>Computer Architecture</strong><br>
        Explores CPU design, instruction cycles, and memory hierarchy.
        <br><br>

        <strong>Cloud Fundamentals</strong><br>
        Introduction to cloud platforms, virtualization, and deployment workflows.
        <br><br>

        <strong>UI/UX Design Basics</strong><br>
        Learn design principles, user-centered workflows, and prototyping techniques.
    </p>
</div>

<!-- YEAR III — SEM I -->
<div class="courseDetailContent moduleDropdown">
    <input type="checkbox" id="year3sem1">
    <label for="year3sem1">
        <h1>Year III, Sem I <span class="material-symbols-outlined">keyboard_arrow_right</span></h1>
    </label>

    <p>
        <strong>Data Analytics I</strong><br>
        Foundations of data processing, visualization, and basic machine learning concepts.
        <br><br>

        <strong>Full-Stack Development I</strong><br>
        Students build complete web applications using a backend framework.
        <br><br>

        <strong>Cybersecurity Principles</strong><br>
        Covers authentication, encryption, threat modelling, and secure coding.
        <br><br>

        <strong>Mobile Development I</strong><br>
        Introduction to building mobile applications using cross-platform tools.
        <br><br>

        <strong>Research Methods I</strong><br>
        Learn academic research approaches, proposal writing, and literature review.
    </p>
</div>

<!-- YEAR III — SEM II -->
<div class="courseDetailContent moduleDropdown">
    <input type="checkbox" id="year3sem2">
    <label for="year3sem2">
        <h1>Year III, Sem II <span class="material-symbols-outlined">keyboard_arrow_right</span></h1>
    </label>

    <p>
        <strong>Data Analytics II</strong><br>
        Advanced analytics techniques, machine learning models, and tools.
        <br><br>

        <strong>Full-Stack Development II</strong><br>
        Back-end architecture, API design, and production deployment.
        <br><br>

        <strong>DevOps and CI/CD</strong><br>
        Automation, continuous integration, continuous delivery, and containerization.
        <br><br>

        <strong>Mobile Development II</strong><br>
        Advanced mobile app development with state management and APIs.
        <br><br>

        <strong>Research Methods II</strong><br>
        Students refine proposals and prepare for the capstone project.
    </p>
</div>

<!-- YEAR IV — SEM I -->
<div class="courseDetailContent moduleDropdown">
    <input type="checkbox" id="year4sem1">
    <label for="year4sem1">
        <h1>Year IV, Sem I <span class="material-symbols-outlined">keyboard_arrow_right</span></h1>
    </label>

    <p>
        <strong>Advanced Cloud Computing</strong><br>
        Students work with real cloud services, orchestration tools, and distributed systems.
        <br><br>

        <strong>Security Engineering</strong><br>
        In-depth study of network security, penetration testing, and risk assessment.
        <br><br>

        <strong>Enterprise Systems</strong><br>
        Focuses on large-scale systems design and integration.
        <br><br>

        <strong>Elective I</strong><br>
        A specialized elective chosen based on student interest.
        <br><br>

        <strong>Project Planning</strong><br>
        Preparation for the final-year capstone with proposal and design documentation.
    </p>
</div>

<!-- YEAR IV — SEM II -->
<div class="courseDetailContent moduleDropdown">
    <input type="checkbox" id="year4sem2">
    <label for="year4sem2">
        <h1>Year IV, Sem II <span class="material-symbols-outlined">keyboard_arrow_right</span></h1>
    </label>

    <p>
        <strong>Capstone Project</strong><br>
        A semester-long independent project demonstrating mastery of acquired skills.
        <br><br>

        <strong>Industry Internship</strong><br>
        Hands-on industry placement providing real-world experience.
        <br><br>

        <strong>Professional Practice</strong><br>
        Modules covering ethics, workplace readiness, and professional communication.
        <br><br>

        <strong>Elective II</strong><br>
        Students choose a second advanced elective.
        <br><br>

        <strong>Seminar Series</strong><br>
        Guest lectures and presentations from industry practitioners.
    </p>
</div>


                </div>
            </div>
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
