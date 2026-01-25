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
                        <img class="hero-image" style="display:none;">
                    </div>
                    <div class="descriptionWrapper">
                        <h1 class="hero-header">Empowering the Next Generation of Innovators</h1>
                        <p class="subtitle">Driving Bhutan’s digital transformation through excellence in education,
                            research, and technology.</p>
                    </div>
                </div>
            </div>
            <div class="">

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

            <div class="introHeader">
                <div class="header">
                    <div class="heading-row">
                        <h1 class="main-header">
                            <span class="left">Discover <span class="green">GCIT: </span></span>
                        </h1>
                    </div>

                    <div class="heading-row">
                        <h1 class="main-header">
                            <span class="left">The Intersection of<span class="orange"> Agentic Development, Wisdom
                                </span>and
                                <span class="orange">Innovation</span>
                        </h1>
                    </div>
                </div>
                <p class="lightText">GCIT is more than an institution. It is a dynamic and creative technological
                    environment
                    where students and faculty members emerge as tech scientist and future leaders for the world. Rooted in
                    Bhutanese values of the GNH culture, the college combines civilization, design and technology to prepare
                    learners for a meaningful career and lifestyle for the contemporary digital reality.
                </p>
            </div>
            <div class="ctaWrapper">
                <div class="ctaBtn">
                    <a href="/about">Learn More</a>
                </div>
                <a href="https://www.rub.edu.bt/index.php/admission-criteria-and-tuition-fee-for-the-academic-year-2024/"
                    class="secondaryCta">
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
                    <x-icons.connect />
                </div>
                <div class="cardContent">
                    <h1>Tech Ecosystem & Interconnectivity</h1>
                    <p>From the Himalayas to the International World, public & private institutions and organizations
                        collaborate closely with GCIT for talent, knowledge and capital formation. We have support in
                        accelerators and incubators with deep developer communities.
                    </p>
                </div>
            </div>
            <div class="card">
                <div class="iconWrapper">
                    <!-- <video src="{{ asset('videos/Pegadogy.webm') }}" autoplay muted loop playsinline preload="metadata"> -->
                    <x-icons.circuit />
                </div>
                <div class="cardContent">
                    <h1>Authentic Real-World Pedagogy
                    </h1>
                    <p>We integrate tangible industry challenges directly into our curriculum. Connecting learning to
                        real-life situations using meaningful applied projects that fosters critical thinking and practical
                        computing & design skills for life, work and world readiness.

                    </p>
                </div>
            </div>
            <div class="card">
                <div class="iconWrapper">
                    <x-icons.handshake />
                </div>
                <div class="cardContent">
                    <h1>Technopreneurship Mindset </h1>
                    <p>A Paradigm that integrates technology into an Entrepreneurial learning framework for enabling
                        effective Start-Ups & Unicorns. We drive vibrant and sustainable start-ups for the economy of
                        adaptability, resilience and strategic pivoting.</p>
                </div>
            </div>
        </div>
        <div class="courseWrapper">
            <div class="header sectionWrapper">
                <h1 class="main-header">Our 2 Anchoring Schools</h1>
            </div>
            <div class="courseContent" id="expandableCourseSection">
                <div class="course overlayWrapper socWrapper">
                    <div class="courseBG bgLeft backgroundWrapper">
                        <div class="overlay"></div>
                        <video src="{{ asset('videos/SOFC.mp4') }}" autoplay muted loop playsinline preload="metadata">
                    </div>
                    <input type="checkbox" id="socToggle" hidden>
                    <div class="courseCoverTitle">
                        <h1>School of Future Computing</h1>
                        <hr class="courseH1-divider">
                        <div class="hiddenInfo">
                            
                            <p>GCIT’s School of Future Computing (SFC) is a visionary Bachelor of Computer Science programme
                                dedicated to preparing and graduating students for a world transformed by rapid
                                technological evolution. We place strong emphasis in specialised pathways in AI & Fullstack
                                Development, Blockchain Software Development and Cyber Security that are all grounded in
                                modern software and computing technology stacks. Complementing these core tracks, our SFC
                                offers innovative Smart City and Technopreneurship electives to broaden students’
                                perspectives and entrepreneurial capabilities. Empowering students to transform technical
                                ideas into viable and smart start-ups is a strong commitment for GCIT, not just in nurturing
                                talents but intellectual dialogues with the future. Students will also benefit from GCIT’s
                                robust industry partners which provide access to exclusive project portfolios, mentorships,
                                hackathons and recruitment opportunities. Beyond technical and skills-based mastery, the
                                School of Future Computing’s curriculum enables ethics, governance and human-centered design
                                ensuring our graduates will be responsible innovators capable of shaping inclusive, secure
                                and leading sustainable digital futures. </p>

                            <div class="ctaBtn">
                                <a href="/course/soc">Learn More</a>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="course overlayWrapper siddWrapper">
                    <div class="courseBG bgRight backgroundWrapper ">
                        <div class="overlay"></div>
                        <video src="{{ asset('videos/SIDD.mp4') }}" autoplay muted loop playsinline preload="metadata">
                    </div>
                    <input type="checkbox" id="siddToggle" hidden>
                    <div class="courseCoverTitle">
                        <h1>School of Interactive Design and Development</h1>
                        <hr class="courseH1-divider">
                        <div class="hiddenInfo">
                            
                            <p>GCIT’s School of Interactive Design and Development (SIDD) is a dynamic Bachelor program
                                where artistry, technology and human-centered design converge to shape futuristic haptics,
                                optics and kinematics digital experiences. The curriculum emphasises User Interface (UI)
                                Design, User Experience (UX) research, Front-End Development and co-creation with Agentic AI
                                for building intelligent applications and systems. Iterative prototyping, ethical designs
                                and cross-disciplinary electives in Smart City and Technopreneurship will broaden learners’
                                perspectives and entrepreneurial capabilities in crafting engaging and transformative
                                digital experiences of tomorrow. Beyond the classroom, students will actively participate
                                and engage in creative problem solving, projects that mirror real-world industry practices
                                and maintaining design and technical skills with professional-standard technology stacks.
                                Students will also benefit from GCIT’s robust industry partnerships which provide access to
                                exclusive full-semester internship, portfolio reviews, hackathons and recruitment
                                opportunities. Our SIDD graduates remain forward thinking from the ability to build adaptive
                                interfaces that evolve based on user behavior to designing game mechanics powered by
                                multimodal models to crafting smart autonomous environments for immersive creations. </p>

                            <div class="ctaBtn">
                                <a href="/course/sidd">Learn More</a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
        <div class="messageWrapper sectionPadding">
            <div class="messageContainer">
                <div class="messageContent" id="message-text-col">
                    <h1 class="main-header">A Message From the President</h1>
                    <h3 class="presidentName">Audrey Low</h3>
                    <hr class="president-divider">

                    <div class="messageTextContent">
                        <div id="visible-message-text">
                            <span class="greeting"><strong>Kuzuzangpo la!</strong></span>

                            <p>Welcome to GCIT, a global institution situated within the Himalayas in Bhutan. The meteoric
                                rise of computing with the emergence of Agentic Development, Decentralise Open Ecosystems
                                and LLMs mark an exciting era in the revolution of design and technology education.</p>

                            <p>At GCIT, we are a dedicated college formed as the intelligent twin of the Royal University of
                                Bhutan to nurture faculty members and graduate students to be the future in Computer Science
                                & Interactive Design and Development.</p>
                        </div>

                        <div id="expanded-message-content" class="message-expand-wrapper">
                            <p>Our vision and purpose recognises that autonomous learning, smart pedagogies along with
                                experiential knowledge will be the norm in lifelong global education. We continue to strive
                                by teaching with cognitive interactions and true to life experiences, focusing on advancing
                                tech in service to a hyper-connected society. You will find that GCIT's curriculum is deeply
                                integrated in students' active exploration and their ongoing prospective careers. Together
                                with our staff, students and industry pioneers, we also conduct applied research where
                                computing and technology is the conduit for planetary stewardship, economic vitality and
                                symbiosis with humanity.</p>

                            <p>As you navigate through our website, you will find detailed information about our courses,
                                admission requirements, student development, personas of our faculty members and, among many
                                other interesting highlights. Certainly, if you are our prospective student, parent or
                                stakeholder, we invite you to further explore with GCIT, our achievements, our growing
                                infrastructure of new labs & facilities and our unyielding committment to paving the way for
                                intellectual exchange and strategic international partnerships.</p>

                            <p>Click the star icon or bookmark our handle as your favourite digital URL giving you quick
                                access to staying in touch with us. If you have any queries and would like to connect with
                                GCIT, please do not hesitate to reach out to us at <a href="mailto:info.gcit@rub.edu.bt"
                                    style="color:var(--color-primary); text-decoration: underline;">info.gcit@rub.edu.bt</a>.
                            </p>

                            <p><strong>Kadrinche la.</strong></p>
                        </div>
                    </div>

                    <button type="button" id="message-toggle-btn" class="readMoreBtn">Read More</button>
                </div>

                <!-- Right side: President image -->
                <div class="presidentImgWrapper" id="message-img-col">
                    <img src="{{ asset('images/staff/president.png') }}" alt="President Audrey Low" id="president-img">
                </div>
            </div>
        </div>
        <div class="homeProjectWrapper">

            <div class="homeProjectDetails">
                <div class="projectMessage">

                    <h1>Impact Through Innovation</h1>
                    <p>We work with leading organizations to develop solutions and create meaningful technological impact
                        for Bhutan and beyond.</p>
                    <div class="prjLink">
                        <a href="/project">More Projects</a>
                    </div>
                </div>

                <!-- PROJECT NAME SLIDER -->
                <div class="projectName desktopPRJSlider">
                    <div class="prjSlider">

                        <span class="material-symbols-outlined left">expand_circle_right</span>

                        <div class="homeSliderTrack">
                            <a href="">
                                <h1 class="homeSlide"></h1>
                            </a>
                        </div>

                        <span class="material-symbols-outlined right">expand_circle_right</span>

                    </div>


                </div>
            </div>

            <div class="projectBanner" id="projectBanner" data-projects='@json($projects)'>
                <a id="homeImgProjectLink" href="">
                    <div class="homeProjectImgWrapper">
                        <img id="activeBanner" class="bannerFront" />
                    </div>
                </a>
                <div class="projectName mobilePRJSlider">
                    <div class="prjSlider">

                        <span class="material-symbols-outlined left">expand_circle_right</span>

                        <div class="homeSliderTrack">
                            <a href="">
                                <h1 class="homeSlide"></h1>
                            </a>
                        </div>

                        <span class="material-symbols-outlined right">expand_circle_right</span>

                    </div>


                </div>
            </div>
        </div>

        <div class="homeAnnouncementWrapper sectionWrapper">
            <div class="homeAnnouncementHeader">
                <div class="headerContent">
                    <h1 class="main-header headerHomeAnnouncement">Recent Announcements</h1>

                </div>
                <div class="headerLink">
                    <a href="/announcements">View More</a>
                </div>
            </div>
            <div class="homeAnnouncementContent">
                <div class="cardAnnouncement">
                    @foreach ($announcements->take(2) as $item)
                        <a href="/post/announcement/{{ $item->id }}" class="card">
                            <div>
                                <span class="date">
                                    <span class="material-symbols-outlined">calendar_month</span>
                                    {{ \Carbon\Carbon::parse($item->date)->format('F d, Y') }}
                                </span>
                                <h1>{{ $item->name }}</h1>
                                <p class="multi-truncate">{!! Str::limit($item->description, 150) !!}</p>


                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="suggestionWrapper homeSuggestion">
                    @foreach ($announcements->skip(2)->take(3) as $item)
                        <a class="suggestion" href="/post/announcement/{{ $item->id }}">
                            <span class="date">
                                <span class="material-symbols-outlined">calendar_month</span>
                                {{ \Carbon\Carbon::parse($item->date)->format('F d, Y') }}
                            </span>
                            <h1>{{ $item->name }}</h1>

                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="homeEventWrapper">
            <div class="eventMessage">
                <h1 class="main-header">News & Events</h1>
                <p>Stay synchronized with the latest happenings at GCIT, encompassing student achievements, learning
                    initiatives, campus celebrations, and the strategic collaborations driving our shared digital future.
                </p>
                <a href="/news&events">Explore More</a>
            </div>
            @foreach ($events as $item)
                <a class="event overlayWrapper" href="/post/events/{{ $item->id }}">
                    <div class="overlay"></div>
                    <img src="{{ asset('storage/' . $item->image) }}" alt="">
                    <div class="eventContent">
                        <p class="date">{{ \Carbon\Carbon::parse($item->date)->format('F d, Y') }}</p>
                        <h1>{{$item->name}}</h1>

                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection