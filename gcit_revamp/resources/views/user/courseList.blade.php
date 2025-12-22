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
            <a href="">Home</a>
            <span class="material-symbols-outlined">keyboard_arrow_right</span>
            <p>Study</p>
        </div>
        <div class="contentWrapper">
            <h1>Courses</h1>
            <p>GCIT offers future-focused programs that combine strong technical foundations with creative problem-solving. Each course is designed to bridge theory with practice, preparing students to innovate in fields such as Full Stack Development, Artificial Intelligence & Data Science, Blockchain Technology, Cybersecurity, and Interactive Design & Development — empowering them to drive Bhutan’s digital transformation.</p>
        </div>
    </div>
</div>
<div class="pageContentWrapper">
    <div class="section eventsWrapper">
        <button class="filterToggle">
            Filter
            <span class="material-symbols-outlined">filter_list</span>
        </button>

        <div class="mainContent courseContent">
            @forelse ($courses as $index => $course)
            <div class="card" data-tag = "{{$course->type}}">
                <img src="{{ asset('storage/' . $course->image) }}" alt="">
                <div class="cardContent">
                    <span class="coursePreHeader">{{ $course->type }}</span>
                    <h1>{{ $course->name }}</h1>
                    <p class = "multi-truncate">{{ $course->description }}</p>
                    <a href="/courseDetails/{{ $course->id }}"><span class="material-symbols-outlined">expand_circle_right</span>Read More</a>
                </div>
            </div>
            @empty
                <p>No courses found.</p>
            @endforelse
        </div>
        <div class="filterColumn">

            <div class="filterWrapper">
                <div class="filterCloseWrapper">
                    <button class="filterClose">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
                <div class="headerWrapper">
                    <h1>Filters</h1>
                </div>
                <div class="filterContent">
                    <div class="filterHeader">
                        <h1>Courses by Schools</h1>
                    </div>
                    <div class="filterContainer">
                        <div class="filter">
                            <input type="checkbox" value = "School of Computer Science">
                            <p>School of Computer Science</p>
                        </div>
                        <div class="filter">
                            <input type="checkbox" value = "School of Interactive Design and Development">
                            <p>Interactive Design & Development</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
