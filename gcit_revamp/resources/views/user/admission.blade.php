@extends('layout.app')

@section('title', 'Home')

@section('content')

    <!-- <div class="pageBannerWrapper courseContentContainer">
        <div class="backgroundWrapper">
            <div class="overlay"></div>
            <img src="{{ asset('images/pageBanner.png') }}" alt="">
        </div>
        <div class="bannerContent sectionWrapper">
            <div class="breadCrumbs">
                <a href="/">Home</a>
                <span class="material-symbols-outlined">keyboard_arrow_right</span>
                <a>Study</a>
                <span class="material-symbols-outlined">keyboard_arrow_right</span>
                <a href="/course">Courses</a>
            </div>
            <div class="contentWrapper">
                <h1>Admissions</h1>
            </div>
        </div>
    </div> -->
    <div class="pageBannerWrapper">
        <div class="backgroundWrapper">
            <div class="overlay"></div>
            <img src="{{ asset('images/pageBanner.png') }}" alt="">
        </div>
        <div class="bannerContent sectionWrapper courseContentBanner">
          <div class="breadCrumbs">
                <a href="/">Home</a>
                <span class="material-symbols-outlined">keyboard_arrow_right</span>
                <a>Study</a>
                <span class="material-symbols-outlined">keyboard_arrow_right</span>
                <a href="/course">Courses</a>
            </div>
             <div class="contentWrapper">
                <h1>Admissions</h1>
            </div>
        </div>
    </div>
    <div class="pageContentWrapper courseContentContainer detailsWrapper">
        <input type="checkbox" id="courseMenuToggle" hidden>

        <label for="courseMenuToggle" class="courseMenuBtn">
            <span class="material-symbols-outlined">menu</span>
        </label>
        <div class="section sectionPaddingDetails">
            <div class="courseDetailsSection">
                <div class="courseDetailsContainer">
                        
                        <div class="sideMenu">
                            <div class="menuHeader">
                                <label for="courseMenuToggle">
                                    <span class="material-symbols-outlined">menu_open</span>
                                    Quick Index
                                </label>
                            </div>

                            <div class="menuSection">
                                <div class="header">
                                    <div class="circle"></div>
                                    <h1>Our Next Intake</h1>
                                </div>
                                <a href="#intake-overview">Admissions Overview</a>
                                <a href="#intake-timeline">Admission Timeline</a>
                            </div>

                            <div class="menuSection">
                                <div class="header">
                                    <div class="circle"></div>
                                    <h1>GCIT Undergraduate Programme</h1>
                                </div>
                                <a href="#gcit-available">Available Programmes</a>
                                <a href="#gcit-eligibility">Eligibility & Selection</a>
                            </div>

                            <div class="menuSection">
                                <div class="header">
                                    <div class="circle"></div>
                                    <h1>Joint Study Programme</h1>
                                </div>
                                <a href="#joint-available">Available Programme</a>
                                <a href="#joint-eligibility">Eligibility & Selection</a>
                            </div>

                            <div class="menuSection">
                                <div class="header">
                                    <div class="circle"></div>
                                    <h1>Additional Information</h1>
                                </div>
                                <a href="#documents">Required Documents</a>
                                <a href="#enquiries">Admission Enquiries</a>
                            </div>
                        </div>

                        <div class="courseDetails">
                        <div class="courseDetailsWrapper greyContainer">

                            <section id="intake">
                                <div class="courseHeaderWrapper admissionWrap">
                                    <h1 class="sectionTitle green">Our Next Intake</h1>
                                </div>

                                <div id="intake-overview" class="miniAdmissionSection">
                                    <h2 class="sectionTitle orange">Admissions Open: July 2026 Intake</h2>
                                    <div class="courseHeaderWrapper">
                                        <p>
                                            Gyalpozhing College of Information Technology (GCIT) is pleased to announce that applications are now open for our <strong>Undergraduate Programme</strong> and our <strong>Joint Study Programme in collaboration with Jigme Namgyel Engineering College (JNEC).</strong>
                                        </p>
                                        <br>
                                        <p>
                                            Interested students must apply online via the official portal within the specified window:<br>
                                            <strong>Application Portal:</strong> <a href="https://admission.gcit.edu.bt" target="_blank" class="orange">https://admission.gcit.edu.bt</a><br>
                                            <strong>Application Period:</strong> <strong class="orange">March 1</strong> – <strong class="orange">March 15, 2026.</strong>
                                        </p>
                                        <img src="{{ asset('images/admission-group.png') }}" alt="GCIT Students" class="admissionImg" style="margin-top: 20px;">
                                    </div>
                                </div>

                                <div id="intake-timeline" class="miniAdmissionSection">
                                    <h2 class="sectionTitle orange">Admission Timeline</h2>
                                    <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
                                        <thead>
                                            <tr style="text-align: left; border-bottom: 2px solid #ddd;">
                                                <th style="padding: 10px 0;">Activity</th>
                                                <th style="padding: 10px 0;">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="padding: 8px 0; border-bottom: 1px solid #eee;"><strong>Online Application Window</strong></td>
                                                <td style="padding: 8px 0; border-bottom: 1px solid #eee;">March 1 – March 15, 2026</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px 0; border-bottom: 1px solid #eee;"><strong>Notification of Shortlisted Candidates (for CTT)</strong></td>
                                                <td style="padding: 8px 0; border-bottom: 1px solid #eee;">March 31 – April 2, 2026</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px 0; border-bottom: 1px solid #eee;"><strong>Computational Thinking Test (CTT) Day</strong></td>
                                                <td style="padding: 8px 0; border-bottom: 1px solid #eee;">April 11, 2026</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px 0; border-bottom: 1px solid #eee;"><strong>Notification of Shortlisted Candidates (for Interview)</strong></td>
                                                <td style="padding: 8px 0; border-bottom: 1px solid #eee;">April 10, 2026</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px 0; border-bottom: 1px solid #eee;"><strong>Online Interview Period</strong></td>
                                                <td style="padding: 8px 0; border-bottom: 1px solid #eee;">April 12 – April 16, 2026</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px 0; border-bottom: 1px solid #eee;"><strong>Final Selection Notification (Email & Call)</strong></td>
                                                <td style="padding: 8px 0; border-bottom: 1px solid #eee;">April 17, 2026</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px 0;"><strong>Official Result Web Publication</strong></td>
                                                <td style="padding: 8px 0;">April 17, 2026</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </section>

                            <section id="gcit">
                                <div class="courseHeaderWrapper admissionWrap">
                                    <h1 class="sectionTitle green">GCIT Undergraduate Programme</h1>
                                </div>

                                <div id="gcit-available" class="miniAdmissionSection">
                                    <h2 class="sectionTitle orange">Available Programmes</h2>
                                    <p>
                                        Gyalpozhing College of Information Technology (GCIT) offers Bachelor’s programmes meticulously designed to cultivate technical excellence and foster innovative problem-solving in the digital age:
                                    </p><br>
                                    <ul>
                                        <li><strong>Bachelor of Computer Science</strong></li>
                                        <li><strong>Bachelor of Interactive Design and Development</strong></li>
                                    </ul>
                                </div>

                                <div id="gcit-eligibility" class="miniAdmissionSection">
                                    <h2 class="sectionTitle orange">Eligibility & Selection</h2>
                                    <p><strong>Academic Eligibility:</strong></p>
                                    <ul>
                                        <li>Applicants must be Class XII graduates with a minimum of <strong>50% in Mathematics or Business Mathematics</strong>.</li>
                                    </ul>
                                    <br>
                                    <p><strong>Ability Rating Point Criteria:</strong></p>
                                    <ul>
                                        <li>Mathematics / Business Mathematics × 5</li>
                                        <li>English × 2</li>
                                        <li>Three (3) other subjects × 1</li>
                                    </ul>
                                    <br>
                                    <p><strong>Selection Process:</strong></p>
                                    <ul>
                                        <li>Shortlisted applicants must sit for the <strong>Computational Thinking Test (CTT)</strong>. Candidates will be further shortlisted for a personal interview based on CTT scores.</li>
                                        <li><strong>Final Selection Formula:</strong> 40% Ability Rating points, 40% CTT score, and 20% personal interview.</li>
                                    </ul>
                                </div>
                            </section>

                            <section id="joint">
                                <div class="courseHeaderWrapper admissionWrap">
                                    <h1 class="sectionTitle green">Joint Study Programme</h1>
                                </div>

                                <div id="joint-available" class="miniAdmissionSection">
                                    <h2 class="sectionTitle orange">Available Programme</h2>
                                    <p>
                                        The Joint Study Programme integrates the specialized expertise of both GCIT and JNEC to provide a rigorous and comprehensive academic pathway in cybersecurity:
                                    </p><br>
                                    <ul>
                                        <li><strong>Bachelor of Computer Science in Cyber Security</strong></li>
                                    </ul>
                                    <br>
                                    <p><strong>Study Pathway:</strong></p>
                                    <ul>
                                        <li><strong>Years 1 & 2:</strong> Hosted at Jigme Namgyel Engineering College (JNEC), Dewathang.</li>
                                        <li><strong>Years 3 & 4:</strong> Hosted at Gyalpozhing College of Information Technology (GCIT), Thimphu.</li>
                                    </ul>
                                </div>

                                <div id="joint-eligibility" class="miniAdmissionSection">
                                    <h2 class="sectionTitle orange">Eligibility & Selection</h2>
                                    <p><strong>Academic Eligibility:</strong></p>
                                    <ul>
                                        <li>Open to Class XII <strong>Science graduates</strong> with a pass in Mathematics.</li>
                                    </ul>
                                    <br>
                                    <p><strong>Ability Rating Point Criteria:</strong></p>
                                    <ul>
                                        <li>Mathematics × 5</li>
                                        <li>Physics × 5</li>
                                        <li>English × 5</li>
                                        <li>Two (2) other subjects × 1</li>
                                    </ul>
                                    <br>
                                    <p><strong>Selection Process:</strong></p>
                                    <ul>
                                        <li>Shortlisted applicants are required to undergo the <strong>Computational Thinking Test (CTT)</strong>.</li>
                                        <li><strong>Final Selection Formula:</strong> 50% Ability Rating points and 50% CTT score.</li>
                                    </ul>
                                </div>
                            </section>

                            <section id="additional">
                                <div class="courseHeaderWrapper admissionWrap">
                                    <h1 class="sectionTitle green">Additional Information</h1>
                                </div>

                                <div id="documents" class="miniAdmissionSection">
                                    <h2 class="sectionTitle orange">Required Documentation</h2>
                                    <p>Selected candidates must provide the following documents during the official registration process (Original + 1 Copy):</p>
                                    <ul>
                                        <li>Class X Marksheet and Pass Certificate.</li>
                                        <li>Class XII Marksheet and Pass Certificate.</li>
                                        <li>Citizenship Identity Card (CID).</li>
                                        <li>School Leaving Certificate and Transfer Certificate.</li>
                                        <li>Five (5) recent passport-sized photographs.</li>
                                        <li><strong>Completed</strong> Registration Form and Undertaking Form.</li>
                                    </ul>
                                </div>

                                <div id="enquiries" class="miniAdmissionSection">
                                    <h2 class="sectionTitle orange">Admission Enquiries</h2>
                                    <p>For further information regarding the application process, please contact:</p>
                                    <p style="margin-top: 10px;">
                                        <strong>Yonten Jamtsho</strong>, Assistant Director: 17762973<br>
                                        <strong>Jigme Dema</strong>, Student Record Officer: 77345257<br>
                                        <strong>Email:</strong> admission.gcit@rub.edu.bt
                                    </p>
                                </div>
                            </section>

                        </div>
                    </div>

                    <div class="otherCourseContainer">
                        <div class="header">
                            <h1>More on Study</h1>
                        </div>
                        <div class="otherContent">
                            <h1>Other Services</h1>
                            <a href="/clubs">Clubs</a>
                            <a href="/resources/ICT">ICT</a>
                            <a href="/resources/Student-Welfare">Student Welfare</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection