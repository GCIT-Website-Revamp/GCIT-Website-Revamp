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
            <a href="/">Initiatives</a>
        </div>
        <div class="contentWrapper">
            <h1>Announcements</h1>
            <p>Stay informed about GCIT’s latest news, milestones, and community initiatives. From student achievements and academic advancements to research projects and institutional collaborations, explore how GCIT continues to drive innovation and excellence in Bhutan’s digital education landscape.</p>
        </div>
    </div>
</div>
<div class="pageContentWrapper">
    <div class="eventsWrapper">
        <button class="filterToggle">
            <span class="material-symbols-outlined">filter_list</span>
        Filter
        </button>
        <div class="mainContent announcementContent">
            <p class="noResults" style="display:none;">
  No matching results found.
</p>

            @forelse ($announcements as $index => $announcement)
            <div class="card" data-tag = "{{$announcement->category}}">
                <div class="cardContent">
                    <h1>{{ $announcement->name }}</h1>
                    <p class = "multi-truncate">{!! Str::limit($announcement->description,80) !!}</p>
                    <div class="subContentContainer">
                        <span class="date"><span class="material-symbols-outlined">calendar_month</span>{{ \Carbon\Carbon::parse($announcement->date)->format('F d, Y') }}</span>
                        <a href="/post/announcement/{{ $announcement->id }}"><span class="material-symbols-outlined">expand_circle_right</span>Read More</a>
                    </div>
                </div>
            </div>
            @empty
                <p>No Announcements Yet</p>
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
                    <h1>Categories</h1>
                </div>
                <div class="filterContainer">
                    
                   
                    <div class="filter">
                        <input type="checkbox" value = "Announcements">
                        <p>Announcements</p>
                    </div>
                    <div class="filter">
                        <input type="checkbox" value="Tender">
                        <p>Tender</p>
                    </div>
                    <div class="filter">
                        <input type="checkbox" value="Vacancy">
                        <p>Vacancy</p>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
