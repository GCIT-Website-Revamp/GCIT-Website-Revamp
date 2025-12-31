@extends('layout.app')

@section('title', 'Home')

@section('content')

<div class="pageBannerWrapper">
    <div class="backgroundWrapper">
        <div class="overlay"></div>
        <img src="{{ asset('images/pageBanner.png') }}" alt="">
    </div>
    <div class="bannerContent sectionWrapper">
        <div class="breadCrumbs">
            <a href="/">Home</a>
            <span class="material-symbols-outlined">keyboard_arrow_right</span>
            <a>Support & Services</a>
        </div>
        <div class="contentWrapper">
            <h1>Admissions</h1>
        </div>
    </div>
</div>
<div class="pageContentWrapper">
    <div class="section">
        <div class="postWrapper departmentWrapper">
            <div class="post">
               
<section id="admission-criteria">
  <h1>Admission Criteria – Gyalpozhing College of Information Technology (GCIT)</h1>

  <p>
    Admission to undergraduate programmes at GCIT is governed by the
    <a href="https://www.rub.edu.bt/index.php/admission-criteria-and-tuition-fee-for-the-academic-year-2024/">Royal University of Bhutan (RUB) admission regulations</a>
    and the college’s specific entry requirements. Eligible applicants must meet the criteria and submit required documentation within the published application period.
  </p>

  <!-- General Eligibility -->
  <h2>1. General Eligibility</h2>
  <p>
    Applicants must satisfy the general entrance requirements prescribed by the Royal University of Bhutan:
  </p>
  <ul>
    <li>Completion of the Bhutan Higher Secondary Education Certificate (BHSEC) or an equivalent qualification.</li>
    <li>Pass in Dzongkha as required under RUB admission policy, or successful completion of a RUB-administered language assessment where applicable.</li>
    <li>Proficiency in English, typically demonstrated through Class XII results or equivalent recognised assessment.</li>
  </ul>

  <!-- Programme-Specific Requirements -->
  <h2>2. Programme-Specific Requirements</h2>
  <p>
    Applicants seeking admission to GCIT undergraduate programmes must meet the following criteria:
  </p>
  <ul>
    <li>Class XII pass with a minimum performance in Mathematics or Business Mathematics as specified for ICT-related programmes.</li>
    <li>Selection is competitive and based on merit ranking in accordance with RUB’s ability rating and subject weighting system.</li>
  </ul>
  <p>
    Merit ranking and subject weighting, including Mathematics and English, are determined centrally by RUB and published on the official RUB admissions portal each year.
  </p>

  <!-- Selection and Merit Ranking -->
  <h2>3. Selection and Merit Ranking</h2>
  <p>
    Selection of candidates is based on academic performance and merit ranking as defined by RUB’s admission policy. Performance in Class XII subjects is used for computing ability rating points, which are ranked to determine offers of admission.
  </p>

  <!-- Required Documentation -->
  <h2>4. Required Documentation</h2>
  <p>
    Applicants must submit the following documents as part of the application process:
  </p>
  <ul>
    <li>Completed RUB online application form within the specified admission period.</li>
    <li>Class X and Class XII mark sheets and certificates (originals and copies).</li>
    <li>Citizenship Identity Card or valid passport for international applicants.</li>
    <li>Documentation demonstrating English proficiency where applicable.</li>
  </ul>

  <!-- Application Process -->
  <h2>5. Application Process</h2>
  <ol>
    <li>Applicants must apply through the RUB centralised online application portal during the published admission window.</li>
    <li>Submitted applications are verified for eligibility and shortlisted based on academic merit.</li>
    <li>Final admission offers are issued by RUB/GCIT based on merit ranking and available seats.</li>
  </ol>
  <p>
    Applications received after the deadline or that do not meet eligibility requirements will not be considered.
  </p>

  <!-- Additional Information -->
  <h2>6. Additional Information</h2>
  <p>
    Admission to GCIT programmes is competitive due to limited intake relative to the number of qualifying applicants. Prospective students are encouraged to review the official RUB admission announcements for programme-specific details and annual updates.
  </p>
  <p>
    GCIT reserves the right to update criteria in alignment with RUB policies and institutional governance.
  </p>
</section>

            </div>
            
              <div class="otherCourseContainer paddingContainer otherDepartment">
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
