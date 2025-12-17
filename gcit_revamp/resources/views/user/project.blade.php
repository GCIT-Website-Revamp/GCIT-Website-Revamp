@extends('layout.app')

@section('title', 'Home')

@section('content')
   <div class="">
            <div class="projectContent">
                <div class="highlightWrapper">
                    <!-- <div class="blackBar"></div> -->
                    <div class="projectHighlight"
                        id="projectHighlight"
                        data-projects='@json($projects)'>

                        <div class="highlight backgroundWrapper">
                            <div class="overlay"></div>

                            <img id="heroImage"
                                src=""
                                alt="">
                            <div class="sectionWrapper highlightContentContainer">
                                <div class="content">
                                    <h1 id="heroTitle"></h1>
                                    <p id="heroDesc">
                                    
                                    </p>
                                    <a id="heroLink" href="#">Explore More</a>
                                </div>

                                <div class="highlightNav">
                                    <button class="highlightBtn left">
                                        <span class="material-symbols-outlined">chevron_left</span>
                                    </button>
                                    <button class="highlightBtn right">
                                        <span class="material-symbols-outlined">chevron_right</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
        <div class="projectHeaderWrapper sectionWrapper">
            <!-- <img src="{{asset('Images/projectBackground.png')}}" alt=""> -->
                <div class="breadCrumbs">
                    <a href="/">Home</a>
                    <span class="material-symbols-outlined">keyboard_arrow_right</span>
                    <a href="/">Initiatives</a>
                </div>
                <div class="projectHeaderContent">
                    <h1>Highlight Projects</h1>
                    <p>Explore innovative student projects that bridge creativity and technology. From AI-driven solutions to blockchain applications and interactive design prototypes, these projects showcase GCIT’s commitment to real-world learning and problem-solving that makes an impact.</p>
                </div>
        </div>
     
        <!-- <div class="projectAllHeader">
            <h1>Capstone Projects</h1>
            <p>At GCIT, capstone projects represent the culmination of students’ academic journeys — a chance to transform classroom learning into practical, real-world solutions. These projects highlight creativity, technical excellence, and innovation across diverse fields such as Full Stack Development, AI & Data Science, Blockchain, Cybersecurity, and Interactive Design.</p>
        </div> -->
        <div class="sectionWrapper noPadding">

            <div class="section eventsWrapper paddingContainer">
                <button class="filterToggle">
                <span class="material-symbols-outlined">filter_list</span>
                Filter
                </button>
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
    </div>
</div>

@endsection
