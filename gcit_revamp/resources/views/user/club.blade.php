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
            <p>Student Services</p>
        </div>
        <div class="contentWrapper">
            <h1>Clubs</h1>
            <p>GCIT offers future-focused programs that combine strong technical foundations with creative problem-solving. Each course is designed to bridge theory with practice, preparing students to innovate in fields such as Full Stack Development, Artificial Intelligence & Data Science, Blockchain Technology, Cybersecurity, and Interactive Design & Development — empowering them to drive Bhutan’s digital transformation.</p>
        </div>
    </div>
</div>
<div class="pageContentWrapper">
    <div class="section eventsWrapper">
        <button class="filterToggle">
                <span class="material-symbols-outlined">filter_list</span>
                Filter
                </button>
        <div class="mainContent courseContent">
            @forelse ($clubs as $index => $club)
            <div class="card">
                <div class="cardContent clubContent">
                    <h1>{{ $club->name }}</h1>


                    <p class="multi-truncate">
                        {{ Str::limit(strip_tags($club->description), 550) }}
                    </p>

                    <a href="/clubDetails/{{ $club->id }}"><span class="material-symbols-outlined">expand_circle_right</span>Read More</a>
                </div>
            </div>
            @empty
                <p>No clubs found.</p>
            @endforelse
        </div>
        <div class="otherCourseContainer paddingContainer otherDepartment">
                    <div class="header">
                        <h1>More on Students</h1>
                    </div>
                    <div class="otherContent">
                        <h1>Other Services</h1>
                            <a href="/Clubs">Clubs</a>
                            <a href="/resources/ICT">ICT</a>
                            <a href="/resources/Student-Welfare">Student Welfare</a>
                    </div>
        </div>
    </div>
</div>
@endsection
