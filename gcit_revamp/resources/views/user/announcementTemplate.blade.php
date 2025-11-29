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
            <h1>Announcements</h1>
            <p>Stay informed about GCIT’s latest news, milestones, and community initiatives. From student achievements and academic advancements to research projects and institutional collaborations, explore how GCIT continues to drive innovation and excellence in Bhutan’s digital education landscape.</p>
        </div>
    </div>
</div>
<div class="pageContentWrapper">
    <div class="section">
        <div class="mainContent announcementContent">
            @forelse ($announcements as $index => $announcement)
            <div class="card">
                <div class="cardContent">
                    <h1>{{ $announcement->name }}</h1>
                    <p class = "multi-truncate">{{ $announcement->description}}</p>
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
                        <p>All Updates</p>
                    </div>
                    <div class="filter">
                        <input type="checkbox">
                        <p>Announcements</p>
                    </div>
                    <div class="filter">
                        <input type="checkbox">
                        <p>Tender</p>
                    </div>
                    <div class="filter">
                        <input type="checkbox">
                        <p>Vacancy</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
