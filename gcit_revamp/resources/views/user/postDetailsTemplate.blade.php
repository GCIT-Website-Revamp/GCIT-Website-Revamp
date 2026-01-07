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
         @if($project)
            <div class="contentWrapper">
                <h1>{{ $project->name }}</h1>
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
                <p>{!! $event->description !!}</p>
                @endif
                @if($announcement)
                <p>{!! $announcement->description !!}</p>
                @endif
                @if($project)
                <img src="{{ asset('storage/' . $project->image) }}" alt="">
                <p>{!! $project->description !!}</p>
                <p>Year of Completion: {{ $project->year }}</p>
                <p>Project Guide: {{ $project->guideTeam->name }}</p>
                <p>Developers:</p>
                <ol>
                @foreach(explode(',', $project->developers) as $dev)
                    <li>{{ trim($dev) }}</li>
                @endforeach
                </ol>
                @endif
                <div class="btnWrapper">
                    @if($previous)
                        <a href="{{ url('post/'.$type.'/' . $previous->id) }}">
                            <button class="left">
                                <span class="material-symbols-outlined">keyboard_arrow_right</span>
                                Previous
                            </button>
                        </a>
                    @endif

                    @if($next)
                        <a href="{{ url('post/'.$type.'/' . $next->id) }}">
                            <button class="right">
                                Next
                                <span class="material-symbols-outlined">keyboard_arrow_right</span>
                            </button>
                        </a>
                    @endif
                </div>
            </div>
            <div class="suggestionWrapper">
                @if($latestAnnouncements)
                    @forelse ($latestAnnouncements as $index => $item)
                    <div class="suggestion">
                        <span class="date"><span class="material-symbols-outlined">calendar_month</span>{{ \Carbon\Carbon::parse($item->date)->format('F d, Y') }}</span>
                        <h1>{{ $item->name }}</h1>
                        <a href="/post/announcement/{{ $item->id }}"><span class="material-symbols-outlined">expand_circle_right</span>Read More</a>
                    </div>
                    @empty
                    @endforelse
                @endif

                @if($latestEvents)
                    @forelse ($latestEvents as $index => $item)
                    <div class="suggestion">
                        <span class="date"><span class="material-symbols-outlined">calendar_month</span>{{ \Carbon\Carbon::parse($item->date)->format('F d, Y') }}</span>
                        <h1>{{ $item->name }}</h1>
                        <a href="/post/events/{{ $item->id }}"><span class="material-symbols-outlined">expand_circle_right</span>Read More</a>
                    </div>
                    @empty
                    @endforelse
                @endif

                @if($latestProjects)
                    @forelse ($latestProjects as $index => $item)
                    <div class="suggestion">
                        <span class="date"><span class="material-symbols-outlined">calendar_month</span>{{ \Carbon\Carbon::parse($item->date)->format('F d, Y') }}</span>
                        <h1>{{ $item->name }}</h1>
                        <a href="/post/project/{{ $item->id }}"><span class="material-symbols-outlined">expand_circle_right</span>Read More</a>
                    </div>
                    @empty
                    @endforelse
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
