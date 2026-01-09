@extends('layout.app')

@section('title', 'Home')

@section('content')

    <div class="pageBannerWrapper courseContentContainer">
        <div class="backgroundWrapper">
            <div class="overlay"></div>
            <img src="{{ asset('images/pageBanner.png') }}" alt="">
        </div>
        <div class="bannerContent sectionWrapper noPadding">
            <div class="breadCrumbs">
                <a href="/">Home</a>
                <span class="material-symbols-outlined">keyboard_arrow_right</span>
                <a>Study</a>
                <span class="material-symbols-outlined">keyboard_arrow_right</span>
                <a href = "/course">Courses</a>
            </div>
            <div class="contentWrapper">
                <h1>Admissions</h1>

            </div>
        </div>
    </div>
    <div class="pageContentWrapper courseContentContainer">
        <input type="checkbox" id="courseMenuToggle" hidden>

    <label for="courseMenuToggle" class="courseMenuBtn">
        <span class="material-symbols-outlined">menu</span>
    </label>
        <div class="section">
            <div class="courseDetailsSection">  
                <div class="courseDetailsContainer">
                        <div class="sideMenu">
                            <div class="menuHeader">
                                <label for="courseMenuToggle">
                                    <span class="material-symbols-outlined">menu</span>
                                    Quick Index

                                </label>
                            </div>
                            <div class="menuSection">
                                <div class="header">
                                    <div class="circle"></div>
                                    <h1>Our Next Intake</h1>
                                </div>
                                <a href="#intake">Upcoming Intakes</a>
                            
                            </div>
                            <div class="menuSection">
                                <div class="header">
                                    <div class="circle"></div>
                                    <h1>Admission Criteria</h1>
                                </div>
                                <a href="#eligibility">General Eligibility</a>
                                <a href="#programme">Program-Specific Requirement</a>
                                <a href="#selection">Selection and Merit Ranking</a>
                                <a href="#documents">Required Documentation</a>
                                <a href="#process">Application Process</a>
                                <a href="#additional">Additional Information</a>
                            </div>
                        </div>
                        <div class="courseDetails">
                    <div class="courseDetailsWrapper greyContainer">

                        {{-- Our Next Intake --}}
                        <section id="intake">
                                    <div class="courseHeaderWrapper">
                                            <h1>Our Next Intake: </h1>
                                            <p>The online application for Gyalpozhing College of Information Technology will open on
                                            <strong class="orange"> 1st March </strong>and <strong class = "orange">close on 15th March 2026.</strong></p>
                                            <br>
                                            <p>
                                                Students wishing to seek admission into GCIT may apply through the Royal University of Bhutan
                                                (RUB) centralized admission portal within the announced application period.
                                            </p>

                                            <img src="{{ asset('images/admission-group.png') }}" alt="GCIT Students" class="admissionImg">
                                        </div>
                    


                        </section>

                        {{-- Admission Criteria --}}
                        <section id="criteria">
                            <div class="courseHeaderWrapper admissionWrap">
                                <h1 class="sectionTitle green">Admission Criteria:</h1>
                                
                                <p>
                                    Admission to undergraduate programmes at GCIT is governed by the <a href="https://www.rub.edu.bt/index.php/admission-criteria-and-tuition-fee-for-the-academic-year-2024/"> Royal University of Bhutan (RUB)
                                        admission regulations</a> and the college’s programme-specific entry requirements.
                                        Eligible applicants must meet the criteria and submit all required documentation within the
                                        published application period.
                                    </p>
                            </div>
                        </section>

                        {{-- General Eligibility --}}
                        <section id="eligibility" class = "miniAdmissionSection">
                            <h2 class="sectionTitle orange">General Eligibility</h2>
                            <ul>
                                <li>Completion of the Bhutan Higher Secondary Education Certificate (BHSEC) or an equivalent qualification.</li>
                                <li>Pass in Dzongkha as required under RUB admission policy or successful completion of a RUB-administered language assessment where applicable.</li>
                                <li>Proficiency in English, typically demonstrated through Class XII results or an equivalent recognised assessment.</li>
                            </ul>
                        </section>

                        {{-- Programme Specific --}}
                        <section id="programme" class = "miniAdmissionSection">
                            <h2 class="sectionTitle orange">Programme-Specific Requirements</h2>
                            <ul>
                                <li>Applicants must have passed Class XII with minimum performance in Mathematics or Business Mathematics as specified for ICT-related programmes.</li>
                                <li>Selection is competitive and based on merit ranking in accordance with RUB’s ability rating and subject weighting system.</li>
                            </ul>

                            <p>
                                Merit ranking and subject weighting, including Mathematics and English, are determined centrally by RUB
                                and published annually on the official RUB admissions portal.
                            </p>
                        </section>

                        {{-- Selection --}}
                        <section id="selection" class = "miniAdmissionSection">
                            <h2 class="sectionTitle orange">Selection and Merit Ranking</h2>
                            <p>
                                Selection of candidates is based on academic performance and merit ranking as prescribed by RUB.
                                Class XII subject performance is used to compute ability rating points, which are ranked to determine
                                offers of admission.
                            </p>
                        </section>

                        {{-- Required Docs --}}
                        <section id="documents" class = "miniAdmissionSection">
                            <h2 class="sectionTitle orange">Required Documentation</h2>
                            <ul>
                                <li>Completed RUB online application form submitted within the admission period.</li>
                                <li>Class X and Class XII mark sheets and certificates.</li>
                                <li>Citizenship Identity Card (or valid passport for international applicants).</li>
                                <li>Proof of English proficiency where applicable.</li>
                            </ul>
                        </section>

                        {{-- Application Process --}}
                        <section id="process" class = "miniAdmissionSection">
                            <h2 class="sectionTitle orange">Application Process</h2>
                            <ol>
                                <li>Apply through the RUB centralized online application portal.</li>
                                <li>Applications are verified for eligibility and shortlisted based on academic merit.</li>
                                <li>Final admission offers are issued by RUB/GCIT based on merit ranking and seat availability.</li>
                            </ol>

                            <p>
                                Applications received after the deadline or that do not meet eligibility requirements will not be considered.
                            </p>
                        </section>

                        {{-- Additional Info --}}
                        <section id="additional" class = "miniAdmissionSection">
                            <h2 class="sectionTitle orange">Additional Information</h2>
                            <p>
                                Admission to GCIT programmes is competitive due to limited intake relative to the number of qualifying applicants.
                                Applicants are encouraged to review official RUB admission announcements for programme-specific details
                                and annual updates.
                            </p>
                            <br>
                            <p>
                                GCIT reserves the right to update admission criteria in alignment with RUB policies and institutional governance.
                            </p>
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
@endsection