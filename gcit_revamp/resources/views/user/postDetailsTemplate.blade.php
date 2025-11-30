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
        @if($event)
            <div class="contentWrapper">
                <h1>{{ $event->name }}</h1>
            </div>
        @endif
        @if($announcement)
            <div class="contentWrapper">
                <h1>{{ $announcement->name }}</h1>
            </div>
        @endif
    </div>
</div>
<div class="pageContentWrapper">
    <div class="section">
        <div class="postWrapper">
            <div class="post">
                @if($event)
                <img src="{{ asset('storage/' . $event->image) }}" alt="">
                <p>{!! nl2br(e($event->description)) !!}</p>
                @endif
                @if($announcement)
                <p>{!! nl2br(e($announcement->description)) !!}</p>
                @endif
                    <div class="btnWrapper">
                        <button class="left"><span class="material-symbols-outlined">keyboard_arrow_right</span>Previous
                        </button>
                        <button class="right">
                            Next<span class="material-symbols-outlined">keyboard_arrow_right</span>
                        </button>
                      
                    </div>
            </div>
            <div class="suggestionWrapper">
                @if($latestAnnouncements)
                    @forelse ($latestAnnouncements as $index => $item)
                    <div class="suggestion">
                        <span class="date"><span class="material-symbols-outlined">calendar_month</span>{{ \Carbon\Carbon::parse($item->date)->format('F d, Y') }}</span>
                        <h1>{{ $item->name }}</h1>
                        <a href=""><span class="material-symbols-outlined">expand_circle_right</span>Read More</a>
                    </div>
                    @empty
                    @endforelse
                @endif

                @if($latestEvents)
                    @forelse ($latestEvents as $index => $item)
                    <div class="suggestion">
                        <span class="date"><span class="material-symbols-outlined">calendar_month</span>{{ \Carbon\Carbon::parse($item->date)->format('F d, Y') }}</span>
                        <h1>{{ $item->name }}</h1>
                        <a href=""><span class="material-symbols-outlined">expand_circle_right</span>Read More</a>
                    </div>
                    @empty
                    @endforelse
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
