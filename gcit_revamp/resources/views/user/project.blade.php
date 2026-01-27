@extends('layout.app')

@section('title', 'Home')

@section('content')
    <div class="">
        <div class="projectContent">
            <div class="pageBannerWrapper projectListBanner">
                <div class="backgroundWrapper">
                    <div class="overlay"></div>
                    <img src="{{ asset('images/pageBanner.png') }}" alt="">
                </div>
                <div class="bannerContent sectionWrapper">
                    <div class="breadCrumbs">
                        <a href="/">Home</a>
                        <span class="material-symbols-outlined">keyboard_arrow_right</span>
                        <a>Initiatives</a>
                    </div>
                    <div class="contentWrapper">
                        <h1>Industry Projects</h1>
                        <p>Explore innovative student projects that bridge creativity and technology. From AI-driven
                            solutions to blockchain applications and interactive design prototypes, these projects showcase
                            GCIT's commitment to real-world learning and problem-solving that makes an impact.</p>
                    </div>
                </div>
            </div>
            
            {{-- ✅ FIXED: Match announcement page structure --}}
            <div class="pageContentWrapper detailsWrapper">
                <div class="eventsWrapper">
                    <button class="filterToggle">
                        <span class="material-symbols-outlined">filter_list</span>
                        Filter
                    </button>
                    
                    <div class="mainContent courseContent">
                        <p class="noResults" style="display:none;">
                            No matching results found.
                        </p>
                        
                        @foreach ($projects as $item)
                            <a href="/post/project/{{ $item->id }}" class="card" data-tag="{{ $item->type }}">
                                <img src="{{ asset('storage/' . $item->image) }}" alt="">
                                <div class="cardContent">
                                    <p>{{ $item->type }}</p>
                                    <h1>{{ $item->name }}</h1>
                                    <p class="multi-truncate">{!! Str::limit($item->description, 250) !!}</p>
                                </div>
                            </a>
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
                                    <h1>Projects By Courses</h1>
                                </div>
                                <div class="filterContainer">
                                    <div class="filter">
                                        <input type="checkbox" value="Fullstack & AI">
                                        <p>Fullstack & AI</p>
                                    </div>
                                    <div class="filter">
                                        <input type="checkbox" value="Blockchain">
                                        <p>Blockchain</p>
                                    </div>
                                    <div class="filter">
                                        <input type="checkbox" value="Interactive Design & Development">
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