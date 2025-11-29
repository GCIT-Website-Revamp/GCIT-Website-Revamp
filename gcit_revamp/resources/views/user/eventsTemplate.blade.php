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
            <h1>News & Events</h1>
            <p>Explore the latest stories and milestones from GCIT — from campus events and student achievements to research highlights and industry collaborations. Stay connected with the people and projects shaping Bhutan’s innovation and technology landscape.</p>
        </div>
    </div>
</div>
<div class="pageContentWrapper">
    <div class="section">
        <div class="mainContent">
            @forelse ($events as $index => $event)
                <div class="card">
                    <img src="{{ asset('storage/' . $event->image) }}" alt="">
                    <div class="cardContent">
                        <span class="date">{{ \Carbon\Carbon::parse($event->date)->format('F d, Y') }}</span>
                        <h1>{{ $event->name }}</h1>
                        <p class="multi-truncate">{{ $event->description ?? '—' }}</p>
                        <a href="">
                            <span class="material-symbols-outlined">expand_circle_right</span>
                            Read More
                        </a>
                    </div>
                </div>
            @empty
                <p>No events found.</p>
            @endforelse
        </div>
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
                        <input type="checkbox">
                        <p>All News & Events</p>
                    </div>
                    <div class="filter">
                        <input type="checkbox">
                        <p>Events</p>
                    </div>
                    <div class="filter">
                        <input type="checkbox">
                        <p>News</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
