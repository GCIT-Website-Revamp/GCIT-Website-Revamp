@extends('layout.app')

@section('title', 'Home')

@section('content')
    <div class="heroBannerWrapper">
        <div class="background">
            <div class="overlay"></div>
        </div>
        <div class="bannerContentWrapper">
            <div class="contentContainr">

                <div class="bannerContent">
                    <div class="media">
                        <video class="hero-video" autoplay muted loop playsinline>
                            <source src="{{ asset('videos/gcit-MPH.mp4') }}" type="video/mp4">
                        </video>
                    </div>
                    <div class="descriptionWrapper">
                        <h1 class = "hero-header">Empowering the Next Generation of Innovators</h1>
                        <p class = "subtitle" >Driving Bhutan’s digital transformation through excellence in education, research, and technology.</p>
                    </div>
                </div>
            </div>
            <div class="contentSlider">
                <div class="leftBtn">
                    <span class="material-symbols-outlined">expand_circle_right</span>
                </div>
               <div class="sliderWrapper">
                    <div class="sliderTrack"></div>
                </div>

                <div class="rightBtn">
                    <span class="material-symbols-outlined">expand_circle_right</span>
                </div>
            </div>
        </div>
    </div>

    <div class="pageContentWrapper">
        <div class="section aboutGCIT">
            <div class="header">
                <div class="heading-row">
                    <h1 class="main-header">
                        <span class="left">Discover</span>
                        <span class="right green">GCIT :</span>
                    </h1>
                </div>

                <div class="heading-row">
                    <h1 class="main-header">
                        <span class="left">A Place to</span>
                        <span class="right"><span class="orange">Accelerate</span>, <span class="orange">Innovate</span>, and <span class="orange">Learn</span></span>
                    </h1>
                </div>
            </div>
            <p class="lightText">GCIT is more than an institution — it is a creative and technological hub where students grow as innovators and leaders.
Rooted in Bhutanese values of harmony and community, the college combines technology, design, and culture to prepare learners for meaningful careers in a digital world.</p>
            <div class="ctaWrapper">
                <div class="ctaBtn">
                    <a href="">Learn More</a>
                </div>
                <a href="" class = "secondaryCta">
                    Admissions
                    <span class="material-symbols-outlined">
                    keyboard_arrow_right
                    </span>
                </a>
            </div>
        </div>
        <div class="section cardWrapper">
            <div class="card">
                <div class="iconWrapper">
                     <x-icons.globe class="globe-icon" />
                </div>
                <div class="cardContent">
                    <h1>Worldwide Recognition</h1>
                    <h2>Our Students Compete Globally</h2>
                    <p>Our graduates secure roles at top international tech firms, showcasing skills that open doors to high-demand careers across global markets</p>
                </div>
            </div>
            <div class="card">
                <div class="iconWrapper">
                    <x-icons.circuit class="circuit-icon" />
                </div>
                <div class="cardContent">
                    <h1>Global Faculty, <br> Read World Pedagogy</h1>
                    <h2>We Bring Industry to the Classroom </h2>
                    <p>Our programs are led by experienced local and international faculty, blending global best practices with hands-on learning.</p>
                </div>
            </div>
            <div class="card">
                <div class="iconWrapper">
                     <x-icons.handshake class="globe-icon" />
                </div>
                <div class="cardContent">
                    <h1>Industry Collaboration & Recognition</h1>
                    <h2>We Build Career-Ready Pathways </h2>
                    <p>We work closely with industry to create internships and joint projects that equip students with real-world experience and career-ready skills.</p>
                </div>
            </div>
        </div>
        <div class="courseWrapper">
            <div class="header">
                <h1>Our Two <br> Anchoring Schools</h1>
            </div>
            <div class="courseContent">
                <div class="course overlayWrapper">
                    <div class="courseBG bgLeft backgroundWrapper">
                        <div class="overlay"></div>
                        <img src="{{ asset('images/courseBG.png') }}" alt="">
                    </div>
                    <div class="courseCoverTitle">
                        <h1>School of Computer Science</h1>
                        <p>Ready to become a web development wizard? Our Full Stack Development degree program offers a comprehensive education in the latest tools and technologies needed to design and develop complex web and mobile applications. You’ll cover both front-end and back-end development, gaining valuable skills in HTML, CSS, JavaScript, databases, and server-side languages like NodeJS and Java. Plus you’ll get hands-on experience with popular…</p>
                        <div class="ctaBtn">
                            <a href="">Learn More</a>
                        </div>
                    </div>    
                      <div class="courseLinkWrapper">
                        <a href="">Full Stack Development <span class="material-symbols-outlined">keyboard_arrow_right</span></a>
                        <a href="">Blockchain Development <span class="material-symbols-outlined">keyboard_arrow_right</span></a>
                        <a href="">AI Development & Data Science <span class="material-symbols-outlined">keyboard_arrow_right</span></a>
                        <a href="">Cybersecurity <span class="material-symbols-outlined">keyboard_arrow_right</span></a>
                    </div>    
                </div>
                <div class="course overlayWrapper">
                    <div class="courseBG bgRight backgroundWrapper">
                        <div class="overlay"></div>
                        <img src="{{ asset('images/courseBG.png') }}" alt="">
                    </div>
                    <div class="courseCoverTitle">
                        <h1>School of Interactive Design and Development</h1>
                        <p>Get ready to elevate your design skills and create functional and visually stunning UI designs. Our program offers comprehensive guidance from experienced lecturers who will walk you through the entire UI Design Process, including wireframing, prototyping, and creating high-fidelity designs using industry-standard tools. Gain expertise in designing user-friendly and intuitive interfaces, building a portfolio of your own UI designs, and unlocking opportunities for UI-related careers worldwide.</p>
                        <div class="ctaBtn">
                            <a href="">Learn More</a>
                        </div>
                    </div>
                    <div class="courseLinkWrapper">
                        <a href="">User Interface Design <span class="material-symbols-outlined">keyboard_arrow_right</span></a>
                        <a href="">User Experience Design <span class="material-symbols-outlined">keyboard_arrow_right</span></a>
                        <a href="">Frontend Engineer <span class="material-symbols-outlined">keyboard_arrow_right</span></a>
                        <a href="">Cybersecurity <span class="material-symbols-outlined">keyboard_arrow_right</span></a>
                    </div>    
                </div>
            </div>
        </div>
        <div class="messageWrapper sectionPadding">
            <div class="header">
                <h1>A Message From the President</h1>
            </div>
            <div class="messageContainer">
                <div class="message">
                    <div class="quote"></div>
                    <div class="message">
                        <span>Kuzuzangpo la!</span>
                        <p>Welcome to GCIT campus and thank you for your interest in Gyalpozhing College of Information Technology. We are a leading institution that specialises in modern education and we offer both the Computer Science and Interactive Design & Development Degree.
 
The uniqueness of GCIT is the way we have fun in teaching and nurturing future-ready students. We embrace disruptions and challenges through a transformative education experience that champions: Code, Hack, Develop, Design, Innovate and Gamify.

As you navigate through our website, you will find detailed information about our courses, admission requirements, student development, personas of our faculty members and, among many other interesting highlights. Certainly, if you are our prospective student, parent or community stakeholder, we invite you to further explore and discover what GCIT has to offer.

Add a tab or bookmark our website or if you have any questions and would like to connect with us, please do not hesitate to reach out to us.</p>
                        <span>Audrey Low</span>
                        <span>President, Gyalpozhing College of Information Technology</span>
                    </div>
                </div>
                <div class="presidentImg">
                    <img src="" alt="">
                </div>
            </div>
        </div>
    </div>
@endsection
