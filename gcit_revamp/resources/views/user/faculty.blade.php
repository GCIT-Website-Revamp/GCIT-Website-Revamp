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
           
        </div>
        <div class="contentWrapper ">
            <h1>Faculty</h1>
            <p>The Faculty comprises accomplished academic professionals dedicated to delivering high-quality, technology-focused education, applied research, and academic services in line with the College’s mandate and standards. Faculty members design and deliver industry-relevant curricula, mentor students, and foster innovation-driven learning through research, technopreneurship, and real-world projects. Organized across departments and schools, the Faculty promotes technological innovation, entrepreneurial thinking, and ethical practice. Through strong industry engagement and project-based learning, it supports the College’s vision of producing competent, innovative, and industry-ready graduates who contribute to national development and the digital economy.</p>
        </div>
    </div>
</div>
<div class="pageContentWrapper detailsWrapper">
    <div class="section eventsWrapper">
        <button class="filterToggle">
           <span class="material-symbols-outlined">filter_list</span>
           Filter
       </button>
        <div class="facultyWrapper">
            <div class="staffProfileWrapper">
                @foreach ($faculties as $faculty)
                    <div class="staff" data-tags='@json(is_string($faculty->category) ? json_decode($faculty->category, true) : $faculty->category)'>
                        <img src="{{ asset('storage/' . $faculty->image) }}" alt="">
                        <div class="staffDescription">
                            <h1>{{ $faculty->title }}</h1>
                            <p>{{ $faculty->description }}</p>
                        </div>
                    </div>
                @endforeach
                </div>
                <div class="filterColumn">
                    <div class="filterWrapper">
                        <div class="headerWrapper">
                            <h1>Filters</h1>
                        </div>
                        <div class="filterContent">
                            <div class="filterHeader">
                                <h1>Categories</h1>
                            </div>
                            <div class="filterContainer">
                                <div class="filter">
                                    <input type="checkbox" value="AI & Fullstack Department">
                                    <p>AI & Fullstack Department</p>
                                </div>
                                <div class="filter">
                                    <input type="checkbox" value="Blockchain Department">
                                    <p>Blockchain Department</p>
                                </div>
                                <div class="filter">
                                    <input type="checkbox" value="Cyber Security Department">
                                    <p>Cyber Security Department</p>
                                </div>
                                <div class="filter">
                                    <input type="checkbox" value="Interactive Design & Development">
                                    <p>Interactive Design & Development</p>
                                </div>
                                <div class="filter">
                                    <input type="checkbox" value="Faculty Leadership Team">
                                    <p>Faculty Leadership Team</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
        </div>
    </div>
</div>
@endsection
