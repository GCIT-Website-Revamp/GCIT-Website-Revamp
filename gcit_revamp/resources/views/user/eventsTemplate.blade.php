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
            <a>Initiatives</a>
        </div>
        <div class="contentWrapper">
            <h1>News & Events</h1>
            <p>Explore the latest stories and milestones from GCIT — from campus events and student achievements to research highlights and industry collaborations. Stay connected with the people and projects shaping Bhutan’s innovation and technology landscape.</p>
        </div>
    </div>
</div>
<div class="pageContentWrapper detailsWrapper">
    <div class="eventsWrapper">
         <button class="filterToggle">
            <span class="material-symbols-outlined">filter_list</span>
        Filter
        </button>
        <div class="mainContent">
            <p class="noResults" style="display:none;">
            No matching results found.
            </p>

            @forelse ($events as $index => $event)
                <div class="card" data-tag = "{{$event->category}}">
                    <img src="{{ asset('storage/' . $event->image) }}" alt="">
                    <a href="/post/events/{{ $event->id }}" class="cardContent">
                        <span class="date">{{ \Carbon\Carbon::parse($event->date)->format('F d, Y') }}</span>
                        <h1>{{ $event->name }}</h1>
                        <p class="multi-truncate">{!! Str::limit($event->description, 100) !!}</p>
                      
                    </a>
                </div>
            @empty
            <p>No Events Yet</p>
            @endforelse
        </div>
        <div class="filterColumn">
            <div class="filterSpacer"></div>
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
                        <input type="checkbox" value = "Events">
                        <p>Events</p>
                    </div>
                    <div class="filter">
                        <input type="checkbox" value = "News">
                        <p>News</p>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
