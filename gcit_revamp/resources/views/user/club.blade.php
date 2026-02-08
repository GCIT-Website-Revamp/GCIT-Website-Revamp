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
                <a>Student Services</a>
            </div>
            <div class="contentWrapper">
                <h1>CCA Clubs</h1>
                <p>At GCIT, Co-Curricular Activities (CCA) are at the heart of a vibrant and inclusive campus life. Through
                    diverse clubs, societies, sports, creative platforms, and community initiatives, students explore their
                    passions, build leadership skills, and grow beyond the classroom. These student-led and faculty-guided
                    activities nurture creativity, teamwork, resilience, and well-being, shaping confident, socially
                    responsible, and future-ready graduates.</p>
            </div>
        </div>
    </div>
    <div class="pageContentWrapper detailsWrapper">
        <div class="section eventsWrapper">

            <div class="mainContent courseContent">
                @forelse ($clubs as $index => $club)
                    <a href="/clubDetails/{{ $club->id }}" class="card">
                        <div class="cardContent clubContent">
                            <h1>{{ $club->name }}</h1>


                            <p class="multi-truncate">
                                {{ Str::limit(strip_tags($club->description), 550) }}
                            </p>


                        </div>
                    </a>
                @empty
                    <p>No clubs found.</p>
                @endforelse
            </div>
            <div class="otherCourseContainer otherDepartment">
                <div class="header">
                    <h1>More on Student Services</h1>
                </div>
                <div class="otherContent">
                    <h1>Other Services</h1>
                    <a href="/clubs">CCA Clubs</a>
                    <a href="/resources/Student-Welfare">Student Welfare</a>
                </div>
            </div>
        </div>
    </div>
@endsection