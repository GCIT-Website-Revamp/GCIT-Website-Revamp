@extends('layout.app')

@section('title', 'Home')

@section('content')
    <div class="heroBannerWrapper">
        <div class="background">
            <div class="overlay"></div>
        </div>
        <div class="bannerContentWrapper">
             <div class="heroBackground">
                <div class="media">
                    <video class="hero-video" autoplay muted loop playsinline></video>
                        <img class="hero-image" style="display:none;">
                    <div class="overlay"></div>
                </div>
            </div>
            <div class="contentContainr">
                <div class="bannerContent">
                    <div class="media">
                        <video class="hero-video" autoplay muted loop playsinline></video>
                        <img class="hero-image" style="display:none;">
                    </div>
                    <div class="descriptionWrapper">
                        <h1 class = "hero-header">Empowering the Next Generation of Innovators</h1>
                        <p class = "subtitle" >Driving Bhutan’s digital transformation through excellence in education, research, and technology.</p>
                    </div>
                </div>
            </div>
            <div class="sectionWrapper">

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
    </div>

    <div class="">
        <div class="section aboutGCIT sectionWrapper">
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
                    <a href="/about">Learn More</a>
                </div>
                <a href="https://www.rub.edu.bt/index.php/admission-criteria-and-tuition-fee-for-the-academic-year-2024/" class = "secondaryCta">
                    Admissions
                    <span class="material-symbols-outlined">
                    keyboard_arrow_right
                    </span>
                </a>
            </div>
        </div>
        <div class="section cardWrapper sectionWrapper">
            <div class="card">
                <div class="iconWrapper">
                    <x-icons.connect class="connect-icon" />
                </div>
                <div class="cardContent">
                    <h1>Co-Development at the Forefront</h1>
                    <p>Our graduates secure roles at top international tech firms, showcasing skills that open doors to high-demand careers across global markets</p>
                </div>
            </div>
            <div class="card">
                <div class="iconWrapper">
                    <x-icons.circuit class="circuit-icon" />
                </div>
                <div class="cardContent">
                    <h1>Integrated Real-World Pedagogy </h1>
                    <p>We integrate industry challenges directly into our curriculum, allowing students to tackle authentic problems through capstone projects and experiential learning</p>
                </div>
            </div>
            <div class="card">
                <div class="iconWrapper">
                     <x-icons.handshake class="globe-icon" />
                </div>
                <div class="cardContent">
                    <h1>Technopreneurship Mindset </h1>
                    <p>Guided by the ICE Model (Inspire–Challenge–Empower) and rooted in GNH values, we nurture developers to think with entrepreneurial vision and purpose.</p>
                </div>
            </div>
        </div>
        <div class="courseWrapper">
            <div class="header sectionWrapper">
                <h1>Our Two <br> Anchoring Schools</h1>
            </div>
            <div class="courseContent">
                <div class="course overlayWrapper socWrapper">
                    <div class="courseBG bgLeft backgroundWrapper">
                        <div class="overlay"></div>
                        <img src="{{ asset('images/soc.png') }}" alt="">
                    </div>
                    <div class="courseCoverTitle">
                        <h1>School of Computer Science</h1>
                        <p>Ready to become a web development wizard? Our Full Stack Development degree program offers a comprehensive education in the latest tools and technologies needed to design and develop complex web and mobile applications. You’ll cover both front-end and back-end development, gaining valuable skills in HTML, CSS, JavaScript, databases, and server-side languages like NodeJS and Java. Plus you’ll get hands-on experience with popular…</p>
                        <div class="ctaBtn">
                            <a href="">Learn More</a>
                        </div>
                    </div>    
                     
                </div>
                <div class="course overlayWrapper siddWrapper">
                    <div class="courseBG bgRight backgroundWrapper ">
                        <div class="overlay"></div>
                        <img src="{{ asset('images/sidd.jpg') }}" alt="">
                    </div>
                    <div class="courseCoverTitle">
                        <h1>School of Interactive Design and Development</h1>
                        <p>Get ready to elevate your design skills and create functional and visually stunning UI designs. Our program offers comprehensive guidance from experienced lecturers who will walk you through the entire UI Design Process, including wireframing, prototyping, and creating high-fidelity designs using industry-standard tools. Gain expertise in designing user-friendly and intuitive interfaces, building a portfolio of your own UI designs, and unlocking opportunities for UI-related careers worldwide.</p>
                        <div class="ctaBtn">
                            <a href="">Learn More</a>
                        </div>
                    </div>
                       
                </div>
            </div>
            <div class="courseLinkContainer">
                 <div class="courseLinkWrapper">
                    @foreach ($bsc as $item)
                        <a href="/courseDetails/{{ $item->id }}">{{ $item->name }} <span class="material-symbols-outlined">keyboard_arrow_right</span></a>
                    @endforeach
                    </div>    
                    <div class="courseLinkWrapper">
                        @if($sidd)
                            <a href="/courseDetails/{{ $sidd->id }}">Frontend Engineer<span class="material-symbols-outlined">keyboard_arrow_right</span></a>
                            <a href="/courseDetails/{{ $sidd->id }}">User Experience Research<span class="material-symbols-outlined">keyboard_arrow_right</span></a>
                            <a href="/courseDetails/{{ $sidd->id }}">User Interface Design<span class="material-symbols-outlined">keyboard_arrow_right</span></a>
                        @endif
                    </div> 
            </div>
        </div>
        <div class="messageWrapper sectionPadding">
            <div class="header">
                <h1>A Message From the President</h1>
            </div>
            <div class="messageContainer">
                <div class="message">
                    <div class="messageContent">
                        <span>Kuzuzangpo la!</span>
                        <p>Welcome to GCIT campus and thank you for your interest in Gyalpozhing College of Information Technology. We are a leading institution that specialises in modern education and we offer both the Computer Science and Interactive Design & Development Degree.
                        <br><br>
                        The uniqueness of GCIT is the way we have fun in teaching and nurturing future-ready students. We embrace disruptions and challenges through a transformative education experience that champions: Code, Hack, Develop, Design, Innovate and Gamify.
                        <br><br>
                        
                        As you navigate through our website, you will find detailed information about our courses, admission requirements, student development, personas of our faculty members and, among many other interesting highlights. Certainly, if you are our prospective student, parent or community stakeholder, we invite you to further explore and discover what GCIT has to offer.
                        <br><br>

                        Add a tab or bookmark our website or if you have any questions and would like to connect with us, please do not hesitate to reach out to us.</p>
                        <span class = "presidentName">Audrey Low</span>
                        <span class = "presidentTitle">President, Gyalpozhing College of Information Technology</span>
                    </div>
                </div>
                <div class="presidentImg">
                    <img src="{{ asset('images/staff/president.png') }}" alt="">
                </div>
            </div>
        </div>
        <div class="homeProjectWrapper">

    <div class="homeProjectDetails">
        <div class="projectMessage">
            <h1>Creating <span>Impact</span> Through Innovation</h1>
            <p>We work with leading organizations to drive innovation and create meaningful technological solutions for Bhutan and beyond</p>
            <a href="/project">More Projects <span class="material-symbols-outlined">keyboard_arrow_right</span></a>
        </div>

        <!-- PROJECT NAME SLIDER -->
        <div class="projectName desktopPRJSlider">
            <div class="prjSlider">

                <span class="material-symbols-outlined left">expand_circle_right</span>

                <div class="homeSliderTrack">
                    <a href=""><h1 class="homeSlide"></h1></a>
                </div>

                <span class="material-symbols-outlined right">expand_circle_right</span>

            </div>

            <div class="prjLink ctaWrapper">
                <a href="">View Details</a>
            </div>
        </div>
    </div>

    <div class="projectBanner" id="projectBanner" data-projects='@json($projects)'>
        <img id="activeBanner" class="bannerFront" />
        <div class="projectName mobilePRJSlider">
            <div class="prjSlider">

                <span class="material-symbols-outlined left">expand_circle_right</span>

                <div class="homeSliderTrack">
                    <a href=""><h1 class="homeSlide"></h1></a>
                </div>

                <span class="material-symbols-outlined right">expand_circle_right</span>

            </div>

            <div class="prjLink ctaWrapper">
                <a href="">View Details</a>
            </div>
        </div>
    </div>
</div>

        <div class="homeAnnouncementWrapper">
            <div class="homeAnnouncementHeader">
                <div class="headerContent">
                    <h1>Announcements</h1>
                    <p>Explore announcements that showcase GCIT’s commitment to learning, research, and community engagement.</p>
                </div>
                <div class="headerLink">
                    <a href="/announcements">View More</a>
                </div>
            </div>
            <div class="homeAnnouncementContent">
                <div class="cardAnnouncement">
                    @foreach ($announcements->take(2) as $item)
                        <div class="card">
                            <span class="date">
                                <span class="material-symbols-outlined">calendar_month</span>
                                {{ \Carbon\Carbon::parse($item->date)->format('F d, Y') }}
                            </span>
                            <h1>{{ $item->name }}</h1>
                            <p class="multi-truncate">{!! Str::limit($item->description, 250) !!}</p>
                            <a href="/post/announcement/{{ $item->id }}">
                                <span class="material-symbols-outlined">expand_circle_right</span>
                                Read More
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="suggestionWrapper homeSuggestion">
                    @foreach ($announcements->skip(2)->take(3) as $item)
                        <div class="suggestion">
                            <span class="date">
                                <span class="material-symbols-outlined">calendar_month</span>
                                {{ \Carbon\Carbon::parse($item->date)->format('F d, Y') }}
                            </span>
                            <h1>{{ $item->name }}</h1>
                            <a href="/post/announcement/{{ $item->id }}">
                                <span class="material-symbols-outlined">expand_circle_right</span>
                                Read More
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="homeEventWrapper">
            <div class="eventMessage">
                <h1>News & Events</h1>
                <p>Stay up to date with the latest happenings at GCIT — from student achievements and research showcases to innovation challenges, collaborations, and campus celebrations. Discover how our community continues to shape Bhutan’s digital future.</p>
                <a href="/news&events">Explore More</a>
            </div>
            @foreach ($events as $item)
                <div class="event overlayWrapper">
                    <div class="overlay"></div>
                    <img src="{{ asset('storage/' . $item->image) }}" alt="">
                    <div class="eventContent">
                        <p class="date">{{ \Carbon\Carbon::parse($item->date)->format('F d, Y') }}</p>
                        <h1>{{$item->name}}</h1>
                        <a href="/post/events/{{ $item->id }}"><span class="material-symbols-outlined">expand_circle_right</span>Read More</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
