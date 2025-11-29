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
            <a href="">Updates</a>
        </div>
        <div class="contentWrapper">
            <h1>Courses</h1>
            <p>GCIT offers future-focused programs that combine strong technical foundations with creative problem-solving. Each course is designed to bridge theory with practice, preparing students to innovate in fields such as Full Stack Development, Artificial Intelligence & Data Science, Blockchain Technology, Cybersecurity, and Interactive Design & Development — empowering them to drive Bhutan’s digital transformation.</p>
        </div>
    </div>
</div>
<div class="pageContentWrapper">
    <div class="section">
        <div class="mainContent courseContent">
            <div class="card">
                <img src="{{ asset('images/events/dummyEventImg.png') }}" alt="">
                <div class="cardContent">
                    <span class="coursePreHeader">Bachelors of Computer Science</span>
                    <h1>AI Development & Data Science</h1>
                    <p class = "multi-truncate">GCIT offers specialized programs designed to equip students with both technical expertise and creative problem-solving skills. Courses span areas such as Full Stack Development, Artificial Intelligence & Data Science, Blockchain Technology, Cybersecurity,</p>
                    <a href=""><span class="material-symbols-outlined">expand_circle_right</span>Read More</a>
                </div>
            </div>
            <div class="card">
                <img src="{{ asset('images/events/dummyEventImg.png') }}" alt="">
                <div class="cardContent">
                    <span class="coursePreHeader">Bachelors of Computer Science</span>
                    <h1>GCIT Graduation Day 2025</h1>
                    <p class = "multi-truncate">GCIT offers specialized programs designed to equip students with both technical expertise and creative problem-solving skills. Courses span areas such as Full Stack Development, Artificial Intelligence & Data Science, Blockchain Technology, Cybersecurity,</p>
                    <a href=""><span class="material-symbols-outlined">expand_circle_right</span>Read More</a>
                </div>
            </div>
            <div class="card">
                <img src="{{ asset('images/events/dummyEventImg.png') }}" alt="">
                <div class="cardContent">
                    <span class="coursePreHeader">Bachelors of Computer Science</span>
                    <h1>GCIT Graduation Day 2025</h1>
                    <p class = "multi-truncate">GCIT offers specialized programs designed to equip students with both technical expertise and creative problem-solving skills. Courses span areas such as Full Stack Development, Artificial Intelligence & Data Science, Blockchain Technology, Cybersecurity,</p>
                    <a href=""><span class="material-symbols-outlined">expand_circle_right</span>Read More</a>
                </div>
            </div>
            <div class="card">
                <img src="{{ asset('images/events/dummyEventImg.png') }}" alt="">
                <div class="cardContent">
                    <span class="coursePreHeader">Bachelors of Computer Science</span>
                    <h1>GCIT Graduation Day 2025</h1>
                    <p class = "multi-truncate">GCIT offers specialized programs designed to equip students with both technical expertise and creative problem-solving skills. Courses span areas such as Full Stack Development, Artificial Intelligence & Data Science, Blockchain Technology, Cybersecurity,</p>
                    <a href=""><span class="material-symbols-outlined">expand_circle_right</span>Read More</a>
                </div>
            </div>
        </div>
        <div class="filterWrapper">
            <div class="headerWrapper">
                <h1>Filters</h1>
            </div>
            <div class="filterContent">
                <div class="filterHeader">
                    <h1>Courses by Schools</h1>
                </div>
                <div class="filterContainer">

                    <div class="filter">
                        <input type="checkbox">
                        <p>All Courses</p>
                    </div>
                    <div class="filter">
                        <input type="checkbox">
                        <p>School of Computer Science</p>
                    </div>
                    <div class="filter">
                        <input type="checkbox">
                        <p>Interactive Design & Development</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
