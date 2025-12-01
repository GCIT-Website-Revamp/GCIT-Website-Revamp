@extends('layout.app')

@section('title', 'Home')

@section('content')
<div class="projectHeaderWrapper">
    <img src="{{asset('Images/projectBackground.png')}}" alt="">
        <div class="breadCrumbs">
            <a href="">Home</a>
            <span class="material-symbols-outlined">keyboard_arrow_right</span>
            <a href="">Impact</a>
        </div>
        <div class="projectHeaderContent">
            <h1>Highlight Projects</h1>
            <p>Explore innovative student projects that bridge creativity and technology. From AI-driven solutions to blockchain applications and interactive design prototypes, these projects showcase GCIT’s commitment to real-world learning and problem-solving that makes an impact.</p>
        </div>
</div>
<div class="">
    <div class="projectContent">
        <div class="highlightWrapper">
            <div class="blackBar"></div>
            <div class="projectHighlight">
                <div class="highlight backgroundWrapper">
                    <div class="overlay"></div>
                    <img src="{{asset('Images/projects/dummyImg.png')}}" alt="">
                    <div class="content">
                        <h1>Finance Application</h1>
                        <p>Driving Bhutan’s digital transformation through excellence in education, research, and technology.</p>
                        <a href="">Explore More</a>
                    </div>
                    <div class="highlightSliderTrack">
                        <div class="highlightSlider"
                        data-title="Gyalsung Allocation System"
                        data-desc="Enabling rapid and smart allocation for all gyalsung related activities.">
                            <div class="activeHighlight"></div>
                            <img src="{{asset('Images/projects/dummyImg2.png')}}" alt="">
                        </div>
                        <div class="highlightSlider"
                        data-title="Parking.bt"
                        data-desc="Transforming the parking sector of Bhutan, one city at a time.">
                            <div class="sliderImgOverlay"></div>
                            <img src="{{asset('Images/projects/dummyImg3.png')}}" alt="">
                        </div>
                        <div class="highlightSlider"
                         data-title="Gyalsung Allocation System"
                        data-desc="Enabling rapid and smart allocation for all gyalsung related activities.">
                            <div class="sliderImgOverlay"></div>
                            <img src="{{asset('Images/projects/dummyImg2.png')}}" alt="">
                        </div>
                        <div class="highlightSlider"
                        data-title="Parking.bt"
                        data-desc="Transforming the parking sector of Bhutan, one city at a time.">
                            <div class="sliderImgOverlay"></div>
                            <img src="{{asset('Images/projects/dummyImg3.png')}}" alt="">
                        </div>
                        <div class="highlightSlider"
                         data-title="Gyalsung Allocation System"
                        data-desc="Enabling rapid and smart allocation for all gyalsung related activities.">
                            <div class="sliderImgOverlay"></div>
                            <img src="{{asset('Images/projects/dummyImg2.png')}}" alt="">
                        </div>
                        <div class="highlightSlider"
                        data-title="Parking.bt"
                        data-desc="Transforming the parking sector of Bhutan, one city at a time.">
                            <div class="sliderImgOverlay"></div>
                            <img src="{{asset('Images/projects/dummyImg3.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="projectAllHeader">
            <h1>Capstone Projects</h1>
            <p>At GCIT, capstone projects represent the culmination of students’ academic journeys — a chance to transform classroom learning into practical, real-world solutions. These projects highlight creativity, technical excellence, and innovation across diverse fields such as Full Stack Development, AI & Data Science, Blockchain, Cybersecurity, and Interactive Design.</p>
        </div>
        <div class="section eventsWrapper">
        <div class="mainContent courseContent">
            @foreach ($projects as $item)
                <div class="card">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="">
                    <div class="cardContent">
                        <h1>{{ $item->name }}</h1>
                        <p class = "multi-truncate">{!! Str::limit($item->description, 250) !!}</p>
                        <a href="/post/project/{{ $item->id }}"><span class="material-symbols-outlined">expand_circle_right</span>Read More</a>
                    </div>
                </div>
            @endforeach
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
</div>

@endsection
